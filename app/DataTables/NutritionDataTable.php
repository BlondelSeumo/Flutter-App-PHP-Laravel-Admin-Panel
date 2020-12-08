<?php

namespace App\DataTables;

use App\Models\Nutrition;
use App\Models\CustomField;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Barryvdh\DomPDF\Facade as PDF;

class NutritionDataTable extends DataTable
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
            ->editColumn('updated_at', function ($nutrition) {
                return getDateColumn($nutrition, 'updated_at');
            })
            ->editColumn('food.name', function ($nutrition) {
                return getLinksColumnByRouteName([$nutrition->food->toArray()], 'foods.edit','id','name');
            })
            ->editColumn('food.restaurant.name', function ($nutrition) {
                return getLinksColumnByRouteName([$nutrition->food->restaurant->toArray()], 'restaurants.edit', 'id', 'name');
            })
            ->addColumn('action', 'nutrition.datatables_actions')
            ->rawColumns(array_merge($columns, ['action']));

        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Nutrition $model)
    {
        if (auth()->user()->hasRole('admin')) {
            return $model->newQuery()->with("food")->with('food.restaurant')->select('nutrition.*');
        } else if(auth()->user()->hasRole('manager')){
            return $model->newQuery()->with("food")->with('food.restaurant')
                ->join("foods","foods.id","=","nutrition.food_id")
                ->join("user_restaurants", "user_restaurants.restaurant_id", "=", "foods.restaurant_id")
                ->where('user_restaurants.user_id', auth()->id())
                ->select('nutrition.*');
        }else{
            return $model->newQuery()->with("food")->with('food.restaurant')->select('nutrition.*');
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
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $columns = [
            [
                'data' => 'name',
                'title' => trans('lang.nutrition_name'),

            ],
            [
                'data' => 'quantity',
                'title' => trans('lang.nutrition_quantity'),

            ],
            [
                'data' => 'food.name',
                'title' => trans('lang.nutrition_food_id'),

            ],
            [
                'data' => 'food.restaurant.name',
                'title' => trans('lang.restaurant'),

            ],
            [
                'data' => 'updated_at',
                'title' => trans('lang.nutrition_updated_at'),
                'searchable' => false,
            ]
        ];

        $hasCustomField = in_array(Nutrition::class, setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFieldsCollection = CustomField::where('custom_field_model', Nutrition::class)->where('in_table', '=', true)->get();
            foreach ($customFieldsCollection as $key => $field) {
                array_splice($columns, $field->order - 1, 0, [[
                    'data' => 'custom_fields.' . $field->name . '.view',
                    'title' => trans('lang.nutrition_' . $field->name),
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
        return 'nutritiondatatable_' . time();
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