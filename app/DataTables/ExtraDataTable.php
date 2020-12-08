<?php
/**
 * File name: ExtraDataTable.php
 * Last modified: 2020.04.30 at 08:21:09
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\DataTables;

use App\Models\CustomField;
use App\Models\Extra;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class ExtraDataTable extends DataTable
{
    /**
     * custom fields columns
     * @var array
     */
    public static $customFields = [];

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        $columns = array_column($this->getColumns(), 'data');
        $dataTable = $dataTable
            ->editColumn('image', function ($extra) {
                return getMediaColumn($extra, 'image');
            })
            ->editColumn('price', function ($extra) {
                return getPriceColumn($extra, 'price');
            })
            ->editColumn('food.name', function ($extra) {
                return getLinksColumnByRouteName([$extra->food->toArray()], 'foods.edit','id','name');
            })
            ->editColumn('food.restaurant.name', function ($extra) {
                return getLinksColumnByRouteName([$extra->food->restaurant->toArray()], 'restaurants.edit', 'id', 'name');
            })
            ->editColumn('updated_at', function ($extra) {
                return getDateColumn($extra, 'updated_at');
            })
            ->addColumn('action', 'extras.datatables_actions')
            ->rawColumns(array_merge($columns, ['action']));

        return $dataTable;
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
                'data' => 'name',
                'title' => trans('lang.extra_name'),

            ],
            [
                'data' => 'image',
                'title' => trans('lang.extra_image'),
                'searchable' => false, 'orderable' => false, 'exportable' => false, 'printable' => false,
            ],
            [
                'data' => 'price',
                'title' => trans('lang.extra_price'),

            ],
            [
                'data' => 'food.name',
                'title' => trans('lang.food'),

            ],
            [
                'data' => 'food.restaurant.name',
                'title' => trans('lang.restaurant'),

            ],
            [
                'data' => 'extra_group.name',
                'name' => 'extraGroup.name',
                'title' => trans('lang.extra_group'),

            ],
            [
                'data' => 'updated_at',
                'title' => trans('lang.extra_updated_at'),
                'searchable' => false,
            ]
        ];

        $hasCustomField = in_array(Extra::class, setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFieldsCollection = CustomField::where('custom_field_model', Extra::class)->where('in_table', '=', true)->get();
            foreach ($customFieldsCollection as $key => $field) {
                array_splice($columns, $field->order - 1, 0, [[
                    'data' => 'custom_fields.' . $field->name . '.view',
                    'title' => trans('lang.extra_' . $field->name),
                    'orderable' => false,
                    'searchable' => false,
                ]]);
            }
        }
        return $columns;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Extra $model)
    {
        if (auth()->user()->hasRole('admin')) {
            return $model->newQuery()->with("food")->with("extraGroup")->with('food.restaurant');
        } else if (auth()->user()->hasRole('manager')) {
            return $model->newQuery()->with("food")->with("extraGroup")->with('food.restaurant')
                ->join("foods", "extras.food_id", "=", "foods.id")
                ->join("user_restaurants", "foods.restaurant_id", "=", "user_restaurants.restaurant_id")
                ->where('user_restaurants.user_id', auth()->id())
                ->groupBy("extras.id")
                ->select('extras.*');
        } else {
            return $model->newQuery()->with("food")->with("extraGroup")->with('food.restaurant');
        }
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
     * Export PDF using DOMPDF
     * @return mixed
     */
    public function pdf()
    {
        $data = $this->getDataForPrint();
        $pdf = PDF::loadView($this->printPreview, compact('data'));
        return $pdf->download($this->filename() . '.pdf');
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'extrasdatatable_' . time();
    }
}