<?php
/**
 * File name: CuisineDataTable.php
 * Last modified: 2020.05.04 at 09:04:18
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\DataTables;

use App\Models\CustomField;
use App\Models\Cuisine;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class CuisineDataTable extends DataTable
{
    /**
     * custom cuisines columns
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
            ->editColumn('image', function ($cuisine) {
                return getMediaColumn($cuisine, 'image');
            })
            ->editColumn('updated_at', function ($cuisine) {
                return getDateColumn($cuisine, 'updated_at');
            })
            ->editColumn('restaurants', function ($cuisine) {
                return getLinksColumnByRouteName($cuisine->restaurants, 'restaurants.edit', 'id', 'name');
            })
            ->addColumn('action', 'cuisines.datatables_actions')
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
                'title' => trans('lang.cuisine_name'),

            ],
            [
                'data' => 'image',
                'title' => trans('lang.cuisine_image'),
                'searchable' => false, 'orderable' => false, 'exportable' => false, 'printable' => false,
            ],
            (auth()->check() && auth()->user()->hasAnyRole(['admin', 'manager'])) ? [
                'data' => 'restaurants',
                'title' => trans('lang.cuisine_restaurants'),
                'searchable' => false,

            ] : null,
            [
                'data' => 'updated_at',
                'title' => trans('lang.cuisine_updated_at'),
                'searchable' => false,
            ]
        ];
        $columns = array_filter($columns);

        $hasCustomField = in_array(Cuisine::class, setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFieldsCollection = CustomField::where('custom_field_model', Cuisine::class)->where('in_table', '=', true)->get();
            foreach ($customFieldsCollection as $key => $cuisine) {
                array_splice($columns, $cuisine->order - 1, 0, [[
                    'data' => 'custom_fields.' . $cuisine->name . '.view',
                    'title' => trans('lang.cuisine_' . $cuisine->name),
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
    public function query(Cuisine $model)
    {
        return $model->newQuery();
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
        return 'cuisinesdatatable_' . time();
    }
}