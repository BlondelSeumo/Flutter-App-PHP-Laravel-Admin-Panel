<?php

namespace App\Http\Controllers\API;


use App\Models\ExtraGroup;
use App\Repositories\ExtraGroupRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Response;
use Prettus\Repository\Exceptions\RepositoryException;
use Flash;

/**
 * Class ExtraGroupController
 * @package App\Http\Controllers\API
 */

class ExtraGroupAPIController extends Controller
{
    /** @var  ExtraGroupRepository */
    private $extraGroupRepository;

    public function __construct(ExtraGroupRepository $extraGroupRepo)
    {
        $this->extraGroupRepository = $extraGroupRepo;
    }

    /**
     * Display a listing of the ExtraGroup.
     * GET|HEAD /extraGroups
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try{
            $this->extraGroupRepository->pushCriteria(new RequestCriteria($request));
            $this->extraGroupRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $extraGroups = $this->extraGroupRepository->all();

        return $this->sendResponse($extraGroups->toArray(), 'Extra Groups retrieved successfully');
    }

    /**
     * Display the specified ExtraGroup.
     * GET|HEAD /extraGroups/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        /** @var ExtraGroup $extraGroup */
        if (!empty($this->extraGroupRepository)) {
            $extraGroup = $this->extraGroupRepository->findWithoutFail($id);
        }

        if (empty($extraGroup)) {
            return $this->sendError('Extra Group not found');
        }

        return $this->sendResponse($extraGroup->toArray(), 'Extra Group retrieved successfully');
    }
}
