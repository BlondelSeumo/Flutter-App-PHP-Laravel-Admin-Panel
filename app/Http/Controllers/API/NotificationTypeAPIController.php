<?php

namespace App\Http\Controllers\API;


use App\Models\NotificationType;
use App\Repositories\NotificationTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Response;
use Prettus\Repository\Exceptions\RepositoryException;
use Flash;

/**
 * Class NotificationTypeController
 * @package App\Http\Controllers\API
 */

class NotificationTypeAPIController extends Controller
{
    /** @var  NotificationTypeRepository */
    private $notificationTypeRepository;

    public function __construct(NotificationTypeRepository $notificationTypeRepo)
    {
        $this->notificationTypeRepository = $notificationTypeRepo;
    }

    /**
     * Display a listing of the NotificationType.
     * GET|HEAD /notificationTypes
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try{
            $this->notificationTypeRepository->pushCriteria(new RequestCriteria($request));
            $this->notificationTypeRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $notificationTypes = $this->notificationTypeRepository->all();

        return $this->sendResponse($notificationTypes->toArray(), 'Notification Types retrieved successfully');
    }

    /**
     * Display the specified NotificationType.
     * GET|HEAD /notificationTypes/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        /** @var NotificationType $notificationType */
        if (!empty($this->notificationTypeRepository)) {
            $notificationType = $this->notificationTypeRepository->findWithoutFail($id);
        }

        if (empty($notificationType)) {
            return $this->sendError('Notification Type not found');
        }

        return $this->sendResponse($notificationType->toArray(), 'Notification Type retrieved successfully');
    }
}
