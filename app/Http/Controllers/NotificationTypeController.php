<?php

namespace App\Http\Controllers;

use App\DataTables\NotificationTypeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateNotificationTypeRequest;
use App\Http\Requests\UpdateNotificationTypeRequest;
use App\Repositories\NotificationTypeRepository;
use App\Repositories\CustomFieldRepository;
use App\Repositories\UploadRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class NotificationTypeController extends Controller
{
    /** @var  NotificationTypeRepository */
    private $notificationTypeRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;

    /**
  * @var UploadRepository
  */
private $uploadRepository;

    public function __construct(NotificationTypeRepository $notificationTypeRepo, CustomFieldRepository $customFieldRepo , UploadRepository $uploadRepo)
    {
        parent::__construct();
        $this->notificationTypeRepository = $notificationTypeRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->uploadRepository = $uploadRepo;
    }

    /**
     * Display a listing of the NotificationType.
     *
     * @param NotificationTypeDataTable $notificationTypeDataTable
     * @return Response
     */
    public function index(NotificationTypeDataTable $notificationTypeDataTable)
    {
        return $notificationTypeDataTable->render('notification_types.index');
    }

    /**
     * Show the form for creating a new NotificationType.
     *
     * @return Response
     */
    public function create()
    {
        
        
        $hasCustomField = in_array($this->notificationTypeRepository->model(),setting('custom_field_models',[]));
            if($hasCustomField){
                $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->notificationTypeRepository->model());
                $html = generateCustomField($customFields);
            }
        return view('notification_types.create')->with("customFields", isset($html) ? $html : false);
    }

    /**
     * Store a newly created NotificationType in storage.
     *
     * @param CreateNotificationTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateNotificationTypeRequest $request)
    {
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->notificationTypeRepository->model());
        try {
            $notificationType = $this->notificationTypeRepository->create($input);
            $notificationType->customFieldsValues()->createMany(getCustomFieldsValues($customFields,$request));
            if(isset($input['image']) && $input['image']){
    $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
    $mediaItem = $cacheUpload->getMedia('image')->first();
    $mediaItem->copy($notificationType, 'image');
}
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully',['operator' => __('lang.notification_type')]));

        return redirect(route('notificationTypes.index'));
    }

    /**
     * Display the specified NotificationType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $notificationType = $this->notificationTypeRepository->findWithoutFail($id);

        if (empty($notificationType)) {
            Flash::error('Notification Type not found');

            return redirect(route('notificationTypes.index'));
        }

        return view('notification_types.show')->with('notificationType', $notificationType);
    }

    /**
     * Show the form for editing the specified NotificationType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $notificationType = $this->notificationTypeRepository->findWithoutFail($id);
        
        

        if (empty($notificationType)) {
            Flash::error(__('lang.not_found',['operator' => __('lang.notification_type')]));

            return redirect(route('notificationTypes.index'));
        }
        $customFieldsValues = $notificationType->customFieldsValues()->with('customField')->get();
        $customFields =  $this->customFieldRepository->findByField('custom_field_model', $this->notificationTypeRepository->model());
        $hasCustomField = in_array($this->notificationTypeRepository->model(),setting('custom_field_models',[]));
        if($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('notification_types.edit')->with('notificationType', $notificationType)->with("customFields", isset($html) ? $html : false);
    }

    /**
     * Update the specified NotificationType in storage.
     *
     * @param  int              $id
     * @param UpdateNotificationTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNotificationTypeRequest $request)
    {
        $notificationType = $this->notificationTypeRepository->findWithoutFail($id);

        if (empty($notificationType)) {
            Flash::error('Notification Type not found');
            return redirect(route('notificationTypes.index'));
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->notificationTypeRepository->model());
        try {
            $notificationType = $this->notificationTypeRepository->update($input, $id);
            
            if(isset($input['image']) && $input['image']){
    $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
    $mediaItem = $cacheUpload->getMedia('image')->first();
    $mediaItem->copy($notificationType, 'image');
}
            foreach (getCustomFieldsValues($customFields, $request) as $value){
                $notificationType->customFieldsValues()
                    ->updateOrCreate(['custom_field_id'=>$value['custom_field_id']],$value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully',['operator' => __('lang.notification_type')]));

        return redirect(route('notificationTypes.index'));
    }

    /**
     * Remove the specified NotificationType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $notificationType = $this->notificationTypeRepository->findWithoutFail($id);

        if (empty($notificationType)) {
            Flash::error('Notification Type not found');

            return redirect(route('notificationTypes.index'));
        }

        $this->notificationTypeRepository->delete($id);

        Flash::success(__('lang.deleted_successfully',['operator' => __('lang.notification_type')]));

        return redirect(route('notificationTypes.index'));
    }

        /**
     * Remove Media of NotificationType
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $notificationType = $this->notificationTypeRepository->findWithoutFail($input['id']);
        try {
            if($notificationType->hasMedia($input['collection'])){
                $notificationType->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
