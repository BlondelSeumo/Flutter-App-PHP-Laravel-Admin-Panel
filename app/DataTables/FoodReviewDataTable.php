<?php
/**
 * File name: FoodReviewDataTable.php
 * Last modified: 2020.05.04 at 09:04:19
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\DataTables;

use App\Criteria\FoodReviews\OrderFoodReviewsOfUserCriteria;
use App\Criteria\FoodReviews\FoodReviewsOfUserCriteria;
use App\Models\CustomField;
use App\Models\FoodReview;
use App\Repositories\FoodReviewRepository;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class FoodReviewDataTable extends DataTable
{
    /**
     * custom fields columns
     * @var array
     */
    public static $customFields = [];
    private $foodReviewRepo;
    private $myReviews;


    public function __construct(FoodReviewRepository $foodReviewRepo)
    {
        $this->foodReviewRepo = $foodReviewRepo;
        $this->myReviews = $this->foodReviewRepo->getByCriteria(new FoodReviewsOfUserCriteria(auth()->id()))->pluck('id')->toArray();
    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        $columns = array_column($this->getColumns(), 'data');
        $dataTable = $dataTable
            ->editColumn('updated_at', function ($food_review) {
                return getDateColumn($food_review, 'updated_at');
            })
            ->addColumn('action', function ($food_review) {
                return view('food_reviews.datatables_actions', ['id' => $food_review->id, 'myReviews' => $this->myReviews])->render();
            })
            ->rawColumns(array_merge($columns, ['action']));

        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function query(FoodReview $model)
    {
        $this->foodReviewRepo->resetCriteria();
        $this->foodReviewRepo->pushCriteria(new OrderFoodReviewsOfUserCriteria(auth()->id()));
        return $this->foodReviewRepo->with("user")->with("food")->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['title'=>trans('lang.actions'),'width' => '80px', 'printable' => false, 'responsivePriority' => '100'])
            ->parameters(array_merge(
                config('datatables-buttons.parameters'), [
                    'language' => json_decode(
                        file_get_contents(base_path('resources/lang/' . app()->getLocale() . '/datatable.json')
                        ), true)
                ]
            ));
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $columns = [
            [
                'data' => 'review',
                'title' => trans('lang.food_review_review'),

            ],
            [
                'data' => 'rate',
                'title' => trans('lang.food_review_rate'),

            ],
            [
                'data' => 'user.name',
                'title' => trans('lang.food_review_user_id'),

            ],
            [
                'data' => 'food.name',
                'title' => trans('lang.food_review_food_id'),

            ],
            [
                'data' => 'updated_at',
                'title' => trans('lang.food_review_updated_at'),
                'searchable' => false,
            ]
        ];

        $hasCustomField = in_array(FoodReview::class, setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFieldsCollection = CustomField::where('custom_field_model', FoodReview::class)->where('in_table', '=', true)->get();
            foreach ($customFieldsCollection as $key => $field) {
                array_splice($columns, $field->order - 1, 0, [[
                    'data' => 'custom_fields.' . $field->name . '.view',
                    'title' => trans('lang.food_review_' . $field->name),
                    'orderable' => false,
                    'searchable' => false,
                ]]);
            }
        }
        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'food_reviewsdatatable_' . time();
    }

    /**
     * Export PDF using DOMPDF
     * @return mixed
     */
    public function pdf()
    {
        $data = $this->getDataForPrint();
        $pdf = PDF::loadView($this->printPreview, compact('data'));
        return $pdf->download($this->filename() . '.pdf');
    }
}