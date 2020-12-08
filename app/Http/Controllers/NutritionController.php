<?php

namespace App\Http\Controllers;

use App\Criteria\Foods\FoodsOfUserCriteria;
use App\Criteria\Nutrition\NutritionOfUserCriteria;
use App\DataTables\NutritionDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateNutritionRequest;
use App\Http\Requests\UpdateNutritionRequest;
use App\Repositories\NutritionRepository;
use App\Repositories\CustomFieldRepository;
use App\Repositories\FoodRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class NutritionController extends Controller
{
    /** @var  NutritionRepository */
    private $nutritionRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;

    /**
     * @var FoodRepository
     */
    private $foodRepository;

    public function __construct(NutritionRepository $nutritionRepo, CustomFieldRepository $customFieldRepo, FoodRepository $foodRepo)
    {
        parent::__construct();
        $this->nutritionRepository = $nutritionRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->foodRepository = $foodRepo;
    }

    /**
     * Display a listing of the Nutrition.
     *
     * @param NutritionDataTable $nutritionDataTable
     * @return Response
     */
    public function index(NutritionDataTable $nutritionDataTable)
    {
        return $nutritionDataTable->render('nutrition.index');
    }

    /**
     * Show the form for creating a new Nutrition.
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function create()
    {
        $this->foodRepository->pushCriteria(new FoodsOfUserCriteria(auth()->id()));
        $food = $this->foodRepository->groupedByRestaurants();
        $hasCustomField = in_array($this->nutritionRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->nutritionRepository->model());
            $html = generateCustomField($customFields);
        }
        return view('nutrition.create')->with("customFields", isset($html) ? $html : false)->with("food", $food);
    }

    /**
     * Store a newly created Nutrition in storage.
     *
     * @param CreateNutritionRequest $request
     *
     * @return Response
     */
    public function store(CreateNutritionRequest $request)
    {
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->nutritionRepository->model());
        try {
            $nutrition = $this->nutritionRepository->create($input);
            $nutrition->customFieldsValues()->createMany(getCustomFieldsValues($customFields, $request));

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.nutrition')]));

        return redirect(route('nutrition.index'));
    }

    /**
     * Display the specified Nutrition.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function show($id)
    {
        $this->nutritionRepository->pushCriteria(new NutritionOfUserCriteria(auth()->id()));
        $nutrition = $this->nutritionRepository->findWithoutFail($id);

        if (empty($nutrition)) {
            Flash::error('Nutrition not found');

            return redirect(route('nutrition.index'));
        }

        return view('nutrition.show')->with('nutrition', $nutrition);
    }

    /**
     * Show the form for editing the specified Nutrition.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function edit($id)
    {
        $this->nutritionRepository->pushCriteria(new NutritionOfUserCriteria(auth()->id()));
        $nutrition = $this->nutritionRepository->findWithoutFail($id);
        if (empty($nutrition)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.nutrition')]));

            return redirect(route('nutrition.index'));
        }

        $this->foodRepository->pushCriteria(new FoodsOfUserCriteria(auth()->id()));
        $food = $this->foodRepository->groupedByRestaurants();
        $customFieldsValues = $nutrition->customFieldsValues()->with('customField')->get();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->nutritionRepository->model());
        $hasCustomField = in_array($this->nutritionRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('nutrition.edit')->with('nutrition', $nutrition)->with("customFields", isset($html) ? $html : false)->with("food", $food);
    }

    /**
     * Update the specified Nutrition in storage.
     *
     * @param int $id
     * @param UpdateNutritionRequest $request
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function update($id, UpdateNutritionRequest $request)
    {
        $this->nutritionRepository->pushCriteria(new NutritionOfUserCriteria(auth()->id()));
        $nutrition = $this->nutritionRepository->findWithoutFail($id);

        if (empty($nutrition)) {
            Flash::error('Nutrition not found');
            return redirect(route('nutrition.index'));
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->nutritionRepository->model());
        try {
            $nutrition = $this->nutritionRepository->update($input, $id);


            foreach (getCustomFieldsValues($customFields, $request) as $value) {
                $nutrition->customFieldsValues()
                    ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.nutrition')]));

        return redirect(route('nutrition.index'));
    }

    /**
     * Remove the specified Nutrition from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function destroy($id)
    {
        $this->nutritionRepository->pushCriteria(new NutritionOfUserCriteria(auth()->id()));
        $nutrition = $this->nutritionRepository->findWithoutFail($id);

        if (empty($nutrition)) {
            Flash::error('Nutrition not found');

            return redirect(route('nutrition.index'));
        }

        $this->nutritionRepository->delete($id);

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.nutrition')]));

        return redirect(route('nutrition.index'));
    }

    /**
     * Remove Media of Nutrition
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $nutrition = $this->nutritionRepository->findWithoutFail($input['id']);
        try {
            if ($nutrition->hasMedia($input['collection'])) {
                $nutrition->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
