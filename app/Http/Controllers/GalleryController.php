<?php
/**
 * File name: GalleryController.php
 * Last modified: 2020.04.30 at 08:21:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers;

use App\Criteria\Galleries\GalleriesOfUserCriteria;
use App\DataTables\GalleryDataTable;
use App\Http\Requests\CreateGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Repositories\CustomFieldRepository;
use App\Repositories\GalleryRepository;
use App\Repositories\RestaurantRepository;
use App\Repositories\UploadRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class GalleryController extends Controller
{
    /** @var  GalleryRepository */
    private $galleryRepository;

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

    public function __construct(GalleryRepository $galleryRepo, CustomFieldRepository $customFieldRepo, UploadRepository $uploadRepo
        , RestaurantRepository $restaurantRepo)
    {
        parent::__construct();
        $this->galleryRepository = $galleryRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->uploadRepository = $uploadRepo;
        $this->restaurantRepository = $restaurantRepo;
    }

    /**
     * Display a listing of the Gallery.
     *
     * @param GalleryDataTable $galleryDataTable
     * @return Response
     */
    public function index(GalleryDataTable $galleryDataTable)
    {
        return $galleryDataTable->render('galleries.index');
    }

    /**
     * Show the form for creating a new Gallery.
     *
     * @return Response
     */
    public function create()
    {
        if (auth()->user()->hasRole('admin')){
            $restaurant = $this->restaurantRepository->pluck('name', 'id');
        }else{
            $restaurant = $this->restaurantRepository->myRestaurants()->pluck('name', 'id');
        }

        $hasCustomField = in_array($this->galleryRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->galleryRepository->model());
            $html = generateCustomField($customFields);
        }
        return view('galleries.create')->with("customFields", isset($html) ? $html : false)->with("restaurant", $restaurant);
    }

    /**
     * Store a newly created Gallery in storage.
     *
     * @param CreateGalleryRequest $request
     *
     * @return Response
     */
    public function store(CreateGalleryRequest $request)
    {
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->galleryRepository->model());
        try {
            $gallery = $this->galleryRepository->create($input);
            $gallery->customFieldsValues()->createMany(getCustomFieldsValues($customFields, $request));
            if (isset($input['image']) && $input['image']) {
                $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
                $mediaItem = $cacheUpload->getMedia('image')->first();
                $mediaItem->copy($gallery, 'image');
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.gallery')]));

        return redirect(route('galleries.index'));
    }

    /**
     * Display the specified Gallery.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $gallery = $this->galleryRepository->findWithoutFail($id);

        if (empty($gallery)) {
            Flash::error('Gallery not found');

            return redirect(route('galleries.index'));
        }

        return view('galleries.show')->with('gallery', $gallery);
    }

    /**
     * Show the form for editing the specified Gallery.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function edit($id)
    {
        $this->galleryRepository->pushCriteria(new GalleriesOfUserCriteria(auth()->id()));
        $gallery = $this->galleryRepository->findWithoutFail($id);
        if (empty($gallery)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.gallery')]));
            return redirect(route('galleries.index'));
        }
        if (auth()->user()->hasRole('admin')){
            $restaurant = $this->restaurantRepository->pluck('name', 'id');
        }else{
            $restaurant = $this->restaurantRepository->myRestaurants()->pluck('name', 'id');
        }
        $customFieldsValues = $gallery->customFieldsValues()->with('customField')->get();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->galleryRepository->model());
        $hasCustomField = in_array($this->galleryRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('galleries.edit')->with('gallery', $gallery)->with("customFields", isset($html) ? $html : false)->with("restaurant", $restaurant);
    }

    /**
     * Update the specified Gallery in storage.
     *
     * @param int $id
     * @param UpdateGalleryRequest $request
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function update($id, UpdateGalleryRequest $request)
    {
        $this->galleryRepository->pushCriteria(new GalleriesOfUserCriteria(auth()->id()));
        $gallery = $this->galleryRepository->findWithoutFail($id);

        if (empty($gallery)) {
            Flash::error('Gallery not found');
            return redirect(route('galleries.index'));
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->galleryRepository->model());
        try {
            $gallery = $this->galleryRepository->update($input, $id);

            if (isset($input['image']) && $input['image']) {
                $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
                $mediaItem = $cacheUpload->getMedia('image')->first();
                $mediaItem->copy($gallery, 'image');
            }
            foreach (getCustomFieldsValues($customFields, $request) as $value) {
                $gallery->customFieldsValues()
                    ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.gallery')]));

        return redirect(route('galleries.index'));
    }

    /**
     * Remove the specified Gallery from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function destroy($id)
    {
        $this->galleryRepository->pushCriteria(new GalleriesOfUserCriteria(auth()->id()));
        $gallery = $this->galleryRepository->findWithoutFail($id);

        if (empty($gallery)) {
            Flash::error('Gallery not found');

            return redirect(route('galleries.index'));
        }

        $this->galleryRepository->delete($id);

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.gallery')]));

        return redirect(route('galleries.index'));
    }

    /**
     * Remove Media of Gallery
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $gallery = $this->galleryRepository->findWithoutFail($input['id']);
        try {
            if ($gallery->hasMedia($input['collection'])) {
                $gallery->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
