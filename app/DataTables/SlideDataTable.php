<?php

namespace App\DataTables;

use App\Models\Slide;
use App\Models\CustomField;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Barryvdh\DomPDF\Facade as PDF;

class SlideDataTable extends DataTable
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
            ->editColumn('image', function ($slide) {
                return getMediaColumn($slide, 'image');
            })
            ->editColumn('updated_at', function ($slide) {
                return getDateColumn($slide, 'updated_at');
            })
            ->editColumn('enabled', function ($slide) {
                return getBooleanColumn($slide, 'enabled');
            })
            ->addColumn('action', 'slides.datatables_actions')
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
                'data' => 'order',
                'title' => trans('lang.slide_order'),

            ],
            [
                'data' => 'text',
                'title' => trans('lang.slide_text'),

            ],
            [
                'data' => 'button',
                'title' => trans('lang.slide_button'),

            ],
            [
                'data' => 'image',
                'title' => trans('lang.slide_image'),
                'searchable' => false, 'orderable' => false, 'exportable' => false, 'printable' => false,
            ],
            [
                'data' => 'food.name',
                'title' => trans('lang.slide_food_id'),

            ],
            [
                'data' => 'restaurant.name',
                'title' => trans('lang.slide_restaurant_id'),

            ],
            [
                'data' => 'enabled',
                'title' => trans('lang.slide_enabled'),

            ],
            [
                'data' => 'updated_at',
                'title' => trans('lang.slide_updated_at'),
                'searchable' => false,
            ]
        ];

        $hasCustomField = in_array(Slide::class, setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFieldsCollection = CustomField::where('custom_field_model', Slide::class)->where('in_table', '=', true)->get();
            foreach ($customFieldsCollection as $key => $field) {
                array_splice($columns, $field->order - 1, 0, [[
                    'data' => 'custom_fields.' . $field->name . '.view',
                    'title' => trans('lang.slide_' . $field->name),
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
    public function query(Slide $model)
    {
        return $model->newQuery()->with("food")->with("restaurant");
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
            ->addAction(['width' => '80px', 'printable' => false, 'responsivePriority' => '100'])
            ->parameters(array_merge(
                config('datatables-buttons.parameters'), [
                    'language' => json_decode(
                        file_get_contents(base_path('resources/lang/' . app()->getLocale() . '/datatable.json')
                        ), true),
                    'order' => [ [0, 'asc'] ],
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
        return 'slidesdatatable_' . time();
    }
}