<?php

namespace App\DataTables;

use App\Models\CustomField;
use App\Models\DriversPayout;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class DriversPayoutDataTable extends DataTable
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
            ->editColumn('updated_at', function ($drivers_payout) {
                return getDateColumn($drivers_payout, 'updated_at');
            })
            ->editColumn('amount', function ($drivers_payout) {
                return getPriceColumn($drivers_payout, 'amount');
            })
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
                'data' => 'user.name',
                'title' => trans('lang.drivers_payout_user_id'),

            ],
            [
                'data' => 'method',
                'title' => trans('lang.drivers_payout_method'),

            ],
            [
                'data' => 'amount',
                'title' => trans('lang.drivers_payout_amount'),

            ],
            [
                'data' => 'paid_date',
                'title' => trans('lang.drivers_payout_paid_date'),

            ],
            [
                'data' => 'note',
                'title' => trans('lang.drivers_payout_note'),

            ],
            [
                'data' => 'updated_at',
                'title' => trans('lang.drivers_payout_updated_at'),
                'searchable' => false,
            ]
        ];

        $hasCustomField = in_array(DriversPayout::class, setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFieldsCollection = CustomField::where('custom_field_model', DriversPayout::class)->where('in_table', '=', true)->get();
            foreach ($customFieldsCollection as $key => $field) {
                array_splice($columns, $field->order - 1, 0, [[
                    'data' => 'custom_fields.' . $field->name . '.view',
                    'title' => trans('lang.drivers_payout_' . $field->name),
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
    public function query(DriversPayout $model)
    {
        if(auth()->user()->hasRole('admin')){
            return $model->newQuery()->with("user")->select('drivers_payouts.*');
        }elseif(auth()->user()->hasRole('driver')){
            return $model->newQuery()->with("user")->where('drivers_payouts.user_id',auth()->id())->select('drivers_payouts.*');
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
        return 'drivers_payoutsdatatable_' . time();
    }
}