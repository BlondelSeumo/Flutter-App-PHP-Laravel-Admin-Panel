<?php

namespace App\Http\Controllers;

use App\DataTables\NotificationDataTable;
use App\Http\Requests\CreateNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Repositories\CustomFieldRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class NotificationController extends Controller
{
    /** @var  NotificationRepository */
    private $notificationRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;

    private $userRepository;

    public function __construct(NotificationRepository $notificationRepo, CustomFieldRepository $customFieldRepo,
        UserRepository $userRepo)
    {
        parent::__construct();
        $this->notificationRepository = $notificationRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the Notification.
     *
     * @param NotificationDataTable $notificationDataTable
     * @return Response
     */
    public function index(NotificationDataTable $notificationDataTable)
    {
        return $notificationDataTable->render('notifications.index');
    }

    /**
     * Show the form for creating a new Notification.
     *
     * @return Response
     */
    public function create()
    {
        $user = $this->userRepository->pluck('name', 'id');

        $hasCustomField = in_array($this->notificationRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->notificationRepository->model());
            $html = generateCustomField($customFields);
        }
        return view('notifications.create')->with("customFields", isset($html) ? $html : false)->with("user", $user);
    }

    /**
     * Store a newly created Notification in storage.
     *
     * @param CreateNotificationRequest $request
     *
     * @return Response
     */
    public function store(CreateNotificationRequest $request)
    {
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->notificationRepository->model());
        try {
            $notification = $this->notificationRepository->create($input);
            $notification->customFieldsValues()->createMany(getCustomFieldsValues($customFields, $request));

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.notification')]));

        return redirect(route('notifications.index'));
    }

    /**
     * Display the specified Notification.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $notification = $this->notificationRepository->findWithoutFail($id);

        if (empty($notification)) {
            Flash::error('Notification not found');

            return redirect(route('notifications.index'));
        }
        try {
            //dd((new Carbon('now'))->format('Y-m-d H:i:s'));
            $notification = $this->notificationRepository->update(['read_at' => (new Carbon())], $id);

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        } catch (\Exception $e) {
            Flash::error($e->getMessage());
        }

        return redirect(route('notifications.index'));
    }

    /**
     * Show the form for editing the specified Notification.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $notification = $this->notificationRepository->findWithoutFail($id);
        $user = $this->userRepository->pluck('name', 'id');


        if (empty($notification)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.notification')]));

            return redirect(route('notifications.index'));
        }
        $customFieldsValues = $notification->customFieldsValues()->with('customField')->get();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->notificationRepository->model());
        $hasCustomField = in_array($this->notificationRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('notifications.edit')->with('notification', $notification)->with("customFields", isset($html) ? $html : false)->with("user", $user);
    }

    /**
     * Update the specified Notification in storage.
     *
     * @param int $id
     * @param UpdateNotificationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNotificationRequest $request)
    {
        $notification = $this->notificationRepository->findWithoutFail($id);

        if (empty($notification)) {
            Flash::error('Notification not found');
            return redirect(route('notifications.index'));
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->notificationRepository->model());
        try {
            $notification = $this->notificationRepository->update($input, $id);
            foreach (getCustomFieldsValues($customFields, $request) as $value) {
                $notification->customFieldsValues()
                    ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.notification')]));

        return redirect(route('notifications.index'));
    }

    /**
     * Remove the specified Notification from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $notification = $this->notificationRepository->findWithoutFail($id);

        if (empty($notification)) {
            Flash::error('Notification not found');

            return redirect(route('notifications.index'));
        }

        $this->notificationRepository->delete($id);

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.notification')]));

        return redirect(route('notifications.index'));
    }

    /**
     * Remove Media of Notification
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $notification = $this->notificationRepository->findWithoutFail($input['id']);
        try {
            if ($notification->hasMedia($input['collection'])) {
                $notification->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
