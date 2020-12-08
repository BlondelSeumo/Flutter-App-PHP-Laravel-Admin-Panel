<?php

namespace App\DataTables;

use App\Models\CustomField;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Barryvdh\DomPDF\Facade as PDF;

class CustomFieldDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->editColumn('updated_at', function ($custom_field) {
                return getDateColumn($custom_field, 'updated_at');
            })
            ->editColumn('in_table', function ($custom_field) {
                return getBooleanColumn($custom_field, 'in_table');
            })
            ->editColumn('type', function ($custom_field) {
                return trans('lang.'.$custom_field->type);
            })

            ->editColumn('custom_field_model', function ($custom_field) {
                return trans('lang.'.getOnlyClassName($custom_field['custom_field_model']).'_plural');
            })

            ->addColumn('action', 'settings.custom_fields.datatables_actions')
            ->rawColumns(['action', 'disabled', 'required', 'in_table', 'updated_at']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CustomField $model)
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
            ->addAction(['title'=>trans('lang.actions'),'width' => '80px', 'printable' => false,'responsivePriority'=>'100'])
            ->parameters(array_merge(
                config('datatables-buttons.parameters'), [
                    'language' => json_decode(
                        file_get_contents(base_path('resources/lang/'.app()->getLocale().'/datatable.json')
                        ),true)
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
        return [
            [
                'data' => 'name',
                'title' => trans('lang.custom_field_name'),

            ],
            [
                'data' => 'type',
                'title' => trans('lang.custom_field_type'),

            ],
            [
                'data' => 'in_table',
                'title' => trans('lang.custom_field_in_table'),

            ],
            [
                'data' => 'order',
                'title' => trans('lang.custom_field_order'),

            ],
            [
                'data' => 'custom_field_model',
                'title' => trans('lang.custom_field_custom_field_model'),
            ],
            [
                'data' => 'updated_at',
                'title' => trans('lang.custom_field_updated_at'),
                'searchable' => false,
            ]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'custom_fieldsdatatable_' . time();
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