<?php

namespace App\Http\Controllers\API;


use App\Models\Cuisine;
use App\Repositories\CuisineRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Response;
use Prettus\Repository\Exceptions\RepositoryException;
use Flash;

/**
 * Class CuisineController
 * @package App\Http\Controllers\API
 */

class CuisineAPIController extends Controller
{
    /** @var  CuisineRepository */
    private $cuisineRepository;

    public function __construct(CuisineRepository $cuisineRepo)
    {
        $this->cuisineRepository = $cuisineRepo;
    }

    /**
     * Display a listing of the Cuisine.
     * GET|HEAD /cuisines
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try{
            $this->cuisineRepository->pushCriteria(new RequestCriteria($request));
            $this->cuisineRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $cuisines = $this->cuisineRepository->all();

        return $this->sendResponse($cuisines->toArray(), 'Cuisines retrieved successfully');
    }

    /**
     * Display the specified Cuisine.
     * GET|HEAD /cuisines/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        /** @var Cuisine $cuisine */
        if (!empty($this->cuisineRepository)) {
            $cuisine = $this->cuisineRepository->findWithoutFail($id);
        }

        if (empty($cuisine)) {
            return $this->sendError('Cuisine not found');
        }

        return $this->sendResponse($cuisine->toArray(), 'Cuisine retrieved successfully');
    }
}
