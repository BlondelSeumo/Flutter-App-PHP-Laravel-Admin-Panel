<?php

namespace App\Http\Controllers\API;


use App\Models\Earning;
use App\Repositories\EarningRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Response;
use Prettus\Repository\Exceptions\RepositoryException;
use Flash;

/**
 * Class EarningController
 * @package App\Http\Controllers\API
 */

class EarningAPIController extends Controller
{
    /** @var  EarningRepository */
    private $earningRepository;

    public function __construct(EarningRepository $earningRepo)
    {
        $this->earningRepository = $earningRepo;
    }

    /**
     * Display a listing of the Earning.
     * GET|HEAD /earnings
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try{
            $this->earningRepository->pushCriteria(new RequestCriteria($request));
            $this->earningRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $earnings = $this->earningRepository->all();

        return $this->sendResponse($earnings->toArray(), 'Earnings retrieved successfully');
    }

    /**
     * Display the specified Earning.
     * GET|HEAD /earnings/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        /** @var Earning $earning */
        if (!empty($this->earningRepository)) {
            $earning = $this->earningRepository->findWithoutFail($id);
        }

        if (empty($earning)) {
            return $this->sendError('Earning not found');
        }

        return $this->sendResponse($earning->toArray(), 'Earning retrieved successfully');
    }
}
