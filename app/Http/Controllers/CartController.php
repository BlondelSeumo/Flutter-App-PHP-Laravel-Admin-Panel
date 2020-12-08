<?php

namespace App\Http\Controllers;

use App\DataTables\CartDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Repositories\CartRepository;
use App\Repositories\CustomFieldRepository;
use App\Repositories\FoodRepository;
use App\Repositories\UserRepository;
use App\Repositories\ExtraRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class CartController extends Controller
{
    /** @var  CartRepository */
    private $cartRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;

    /**
     * @var FoodRepository
     */
    private $foodRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ExtraRepository
     */
    private $extraRepository;

    public function __construct(CartRepository $cartRepo, CustomFieldRepository $customFieldRepo, FoodRepository $foodRepo
        , UserRepository $userRepo
        , ExtraRepository $extraRepo)
    {
        parent::__construct();
        $this->cartRepository = $cartRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->foodRepository = $foodRepo;
        $this->userRepository = $userRepo;
        $this->extraRepository = $extraRepo;
    }

    /**
     * Display a listing of the Cart.
     *
     * @param CartDataTable $cartDataTable
     * @return Response
     */
    public function index(CartDataTable $cartDataTable)
    {
        return $cartDataTable->render('carts.index');
    }

    /**
     * Show the form for creating a new Cart.
     *
     * @return Response
     */
    public function create()
    {
        $food = $this->foodRepository->pluck('name', 'id');
        $user = $this->userRepository->pluck('name', 'id');
        $extra = $this->extraRepository->pluck('name', 'id');
        $extrasSelected = [];
        $hasCustomField = in_array($this->cartRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->cartRepository->model());
            $html = generateCustomField($customFields);
        }
        return view('carts.create')->with("customFields", isset($html) ? $html : false)->with("food", $food)->with("user", $user)->with("extra", $extra)->with("extrasSelected", $extrasSelected);
    }

    /**
     * Store a newly created Cart in storage.
     *
     * @param CreateCartRequest $request
     *
     * @return Response
     */
    public function store(CreateCartRequest $request)
    {
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->cartRepository->model());
        try {
            $cart = $this->cartRepository->create($input);
            $cart->customFieldsValues()->createMany(getCustomFieldsValues($customFields, $request));

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.cart')]));

        return redirect(route('carts.index'));
    }

    /**
     * Display the specified Cart.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cart = $this->cartRepository->findWithoutFail($id);

        if (empty($cart)) {
            Flash::error('Cart not found');

            return redirect(route('carts.index'));
        }

        return view('carts.show')->with('cart', $cart);
    }

    /**
     * Show the form for editing the specified Cart.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cart = $this->cartRepository->findWithoutFail($id);
        $food = $this->foodRepository->pluck('name', 'id');
        $user = $this->userRepository->pluck('name', 'id');
        $extra = $this->extraRepository->pluck('name', 'id');
        $extrasSelected = $cart->extras()->pluck('extras.id')->toArray();

        if (empty($cart)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.cart')]));

            return redirect(route('carts.index'));
        }
        $customFieldsValues = $cart->customFieldsValues()->with('customField')->get();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->cartRepository->model());
        $hasCustomField = in_array($this->cartRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('carts.edit')->with('cart', $cart)->with("customFields", isset($html) ? $html : false)->with("food", $food)->with("user", $user)->with("extra", $extra)->with("extrasSelected", $extrasSelected);
    }

    /**
     * Update the specified Cart in storage.
     *
     * @param int $id
     * @param UpdateCartRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCartRequest $request)
    {
        $cart = $this->cartRepository->findWithoutFail($id);

        if (empty($cart)) {
            Flash::error('Cart not found');
            return redirect(route('carts.index'));
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->cartRepository->model());
        try {
            $cart = $this->cartRepository->update($input, $id);
            $input['extras'] = isset($input['extras']) ? $input['extras'] : [];

            foreach (getCustomFieldsValues($customFields, $request) as $value) {
                $cart->customFieldsValues()
                    ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.cart')]));

        return redirect(route('carts.index'));
    }

    /**
     * Remove the specified Cart from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cart = $this->cartRepository->findWithoutFail($id);

        if (empty($cart)) {
            Flash::error('Cart not found');

            return redirect(route('carts.index'));
        }

        $this->cartRepository->delete($id);

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.cart')]));

        return redirect(route('carts.index'));
    }

    /**
     * Remove Media of Cart
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $cart = $this->cartRepository->findWithoutFail($input['id']);
        try {
            if ($cart->hasMedia($input['collection'])) {
                $cart->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
