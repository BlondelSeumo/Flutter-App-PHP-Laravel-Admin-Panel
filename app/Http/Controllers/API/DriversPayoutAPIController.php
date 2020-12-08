<?php

namespace App\Http\Controllers\API;


use App\Models\DriversPayout;
use App\Repositories\DriversPayoutRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Response;
use Prettus\Repository\Exceptions\RepositoryException;
use Flash;

/**
 * Class DriversPayoutController
 * @package App\Http\Controllers\API
 */

class DriversPayoutAPIController extends Controller
{
    /** @var  DriversPayoutRepository */
    private $driversPayoutRepository;

    public function __construct(DriversPayoutRepository $driversPayoutRepo)
    {
        $this->driversPayoutRepository = $driversPayoutRepo;
    }

    /**
     * Display a listing of the DriversPayout.
     * GET|HEAD /driversPayouts
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try{
            $this->driversPayoutRepository->pushCriteria(new RequestCriteria($request));
            $this->driversPayoutRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $driversPayouts = $this->driversPayoutRepository->all();

        return $this->sendResponse($driversPayouts->toArray(), 'Drivers Payouts retrieved successfully');
    }

    /**
     * Display the specified DriversPayout.
     * GET|HEAD /driversPayouts/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        /** @var DriversPayout $driversPayout */
        if (!empty($this->driversPayoutRepository)) {
            $driversPayout = $this->driversPayoutRepository->findWithoutFail($id);
        }

        if (empty($driversPayout)) {
            return $this->sendError('Drivers Payout not found');
        }

        return $this->sendResponse($driversPayout->toArray(), 'Drivers Payout retrieved successfully');
    }
}
