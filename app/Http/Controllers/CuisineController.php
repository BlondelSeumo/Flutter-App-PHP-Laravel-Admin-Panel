<?php

namespace App\Http\Controllers;

use App\DataTables\CuisineDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCuisineRequest;
use App\Http\Requests\UpdateCuisineRequest;
use App\Repositories\CuisineRepository;
use App\Repositories\CustomFieldRepository;
use App\Repositories\UploadRepository;
use App\Repositories\RestaurantRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class CuisineController extends Controller
{
    /** @var  CuisineRepository */
    private $cuisineRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;

    /**
     * @var UploadRepository
     */
    private $uploadRepository;
    /**
     * @var RestaurantRepository
     */
    private $restaurantRepository;

    public function __construct(CuisineRepository $cuisineRepo, CustomFieldRepository $customFieldRepo, UploadRepository $uploadRepo
        , RestaurantRepository $restaurantRepo)
    {
        parent::__construct();
        $this->cuisineRepository = $cuisineRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->uploadRepository = $uploadRepo;
        $this->restaurantRepository = $restaurantRepo;
    }

    /**
     * Display a listing of the Cuisine.
     *
     * @param CuisineDataTable $cuisineDataTable
     * @return Response
     */
    public function index(CuisineDataTable $cuisineDataTable)
    {
        return $cuisineDataTable->render('cuisines.index');
    }

    /**
     * Show the form for creating a new Cuisine.
     *
     * @return Response
     */
    public function create()
    {
        $restaurant = $this->restaurantRepository->pluck('name', 'id');
        $restaurantsSelected = [];
        $hasCustomField = in_array($this->cuisineRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->cuisineRepository->model());
            $html = generateCustomField($customFields);
        }
        return view('cuisines.create')->with("customFields", isset($html) ? $html : false)->with("restaurant", $restaurant)->with("restaurantsSelected", $restaurantsSelected);
    }

    /**
     * Store a newly created Cuisine in storage.
     *
     * @param CreateCuisineRequest $request
     *
     * @return Response
     */
    public function store(CreateCuisineRequest $request)
    {
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->cuisineRepository->model());
        try {
            $cuisine = $this->cuisineRepository->create($input);
            $cuisine->customFieldsValues()->createMany(getCustomFieldsValues($customFields, $request));
            if (isset($input['image']) && $input['image']) {
                $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
                $mediaItem = $cacheUpload->getMedia('image')->first();
                $mediaItem->copy($cuisine, 'image');
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.cuisine')]));

        return redirect(route('cuisines.index'));
    }

    /**
     * Display the specified Cuisine.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cuisine = $this->cuisineRepository->findWithoutFail($id);

        if (empty($cuisine)) {
            Flash::error('Cuisine not found');

            return redirect(route('cuisines.index'));
        }

        return view('cuisines.show')->with('cuisine', $cuisine);
    }

    /**
     * Show the form for editing the specified Cuisine.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cuisine = $this->cuisineRepository->findWithoutFail($id);
        $restaurant = $this->restaurantRepository->pluck('name', 'id');
        $restaurantsSelected = $cuisine->restaurants()->pluck('restaurants.id')->toArray();

        if (empty($cuisine)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.cuisine')]));

            return redirect(route('cuisines.index'));
        }
        $customFieldsValues = $cuisine->customFieldsValues()->with('customField')->get();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->cuisineRepository->model());
        $hasCustomField = in_array($this->cuisineRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('cuisines.edit')->with('cuisine', $cuisine)->with("customFields", isset($html) ? $html : false)->with("restaurant", $restaurant)->with("restaurantsSelected", $restaurantsSelected);
    }

    /**
     * Update the specified Cuisine in storage.
     *
     * @param int $id
     * @param UpdateCuisineRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCuisineRequest $request)
    {
        $cuisine = $this->cuisineRepository->findWithoutFail($id);

        if (empty($cuisine)) {
            Flash::error('Cuisine not found');
            return redirect(route('cuisines.index'));
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->cuisineRepository->model());
        try {
            $cuisine = $this->cuisineRepository->update($input, $id);
            $input['restaurants'] = isset($input['restaurants']) ? $input['restaurants'] : [];
            if (isset($input['image']) && $input['image']) {
                $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
                $mediaItem = $cacheUpload->getMedia('image')->first();
                $mediaItem->copy($cuisine, 'image');
            }
            foreach (getCustomFieldsValues($customFields, $request) as $value) {
                $cuisine->customFieldsValues()
                    ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.cuisine')]));

        return redirect(route('cuisines.index'));
    }

    /**
     * Remove the specified Cuisine from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cuisine = $this->cuisineRepository->findWithoutFail($id);

        if (empty($cuisine)) {
            Flash::error('Cuisine not found');

            return redirect(route('cuisines.index'));
        }

        $this->cuisineRepository->delete($id);

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.cuisine')]));

        return redirect(route('cuisines.index'));
    }

    /**
     * Remove Media of Cuisine
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $cuisine = $this->cuisineRepository->findWithoutFail($input['id']);
        try {
            if ($cuisine->hasMedia($input['collection'])) {
                $cuisine->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
