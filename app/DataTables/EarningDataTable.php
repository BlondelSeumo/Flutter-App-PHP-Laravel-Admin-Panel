<?php

namespace App\DataTables;

use App\Models\CustomField;
use App\Models\Earning;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class EarningDataTable extends DataTable
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
            ->editColumn('restaurant.name', function ($earning) {
                return getLinksColumnByRouteName([$earning->restaurant], "restaurants.edit",'id','name');
            })

            ->editColumn('updated_at', function ($earning) {
                return getDateColumn($earning, 'updated_at');
            })
            ->editColumn('total_earning', function ($earning) {
                return getPriceColumn($earning,'total_earning');
            })
            ->editColumn('admin_earning', function ($earning) {
                return getPriceColumn($earning,'admin_earning');
            })
            ->editColumn('restaurant_earning', function ($earning) {
                return getPriceColumn($earning,'restaurant_earning');
            })
            ->editColumn('delivery_fee', function ($earning) {
                return getPriceColumn($earning,'delivery_fee');
            })
            ->editColumn('tax', function ($earning) {
                return getPriceColumn($earning,'tax');
            })
            ->addColumn('action', 'earnings.datatables_actions')
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
                'data' => 'restaurant.name',
                'title' => trans('lang.earning_restaurant_id'),

            ],
            [
                'data' => 'total_orders',
                'title' => trans('lang.earning_total_orders'),

            ],
            [
                'data' => 'total_earning',
                'title' => trans('lang.earning_total_earning'),

            ],
            [
                'data' => 'admin_earning',
                'title' => trans('lang.earning_admin_earning'),

            ],
            [
                'data' => 'restaurant_earning',
                'title' => trans('lang.earning_restaurant_earning'),

            ],
            [
                'data' => 'delivery_fee',
                'title' => trans('lang.earning_delivery_fee'),

            ],
            [
                'data' => 'tax',
                'title' => trans('lang.earning_tax'),

            ],
            [
                'data' => 'updated_at',
                'title' => trans('lang.earning_updated_at'),
                'searchable' => false,
            ]
        ];

        $hasCustomField = in_array(Earning::class, setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFieldsCollection = CustomField::where('custom_field_model', Earning::class)->where('in_table', '=', true)->get();
            foreach ($customFieldsCollection as $key => $field) {
                array_splice($columns, $field->order - 1, 0, [[
                    'data' => 'custom_fields.' . $field->name . '.view',
                    'title' => trans('lang.earning_' . $field->name),
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
    public function query(Earning $model)
    {
        if (auth()->user()->hasRole('admin')) {
            return $model->newQuery()->with("restaurant")->select('earnings.*');
        }else if((auth()->user()->hasRole('manager'))){
            return $model->newQuery()->with("restaurant")
                ->join("user_restaurants", "user_restaurants.restaurant_id", "=", "earnings.restaurant_id")
                ->where('user_restaurants.user_id', auth()->id())->select('earnings.*');
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
        return 'earningsdatatable_' . time();
    }
}