<?php

namespace App\Http\Controllers\API;


use App\Models\Nutrition;
use App\Repositories\NutritionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Response;
use Prettus\Repository\Exceptions\RepositoryException;
use Flash;

/**
 * Class NutritionController
 * @package App\Http\Controllers\API
 */

class NutritionAPIController extends Controller
{
    /** @var  NutritionRepository */
    private $nutritionRepository;

    public function __construct(NutritionRepository $nutritionRepo)
    {
        $this->nutritionRepository = $nutritionRepo;
    }

    /**
     * Display a listing of the Nutrition.
     * GET|HEAD /nutrition
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try{
            $this->nutritionRepository->pushCriteria(new RequestCriteria($request));
            $this->nutritionRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $nutrition = $this->nutritionRepository->all();

        return $this->sendResponse($nutrition->toArray(), 'Nutrition retrieved successfully');
    }

    /**
     * Display the specified Nutrition.
     * GET|HEAD /nutrition/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        /** @var Nutrition $nutrition */
        if (!empty($this->nutritionRepository)) {
            $nutrition = $this->nutritionRepository->findWithoutFail($id);
        }

        if (empty($nutrition)) {
            return $this->sendError('Nutrition not found');
        }

        return $this->sendResponse($nutrition->toArray(), 'Nutrition retrieved successfully');
    }
}
