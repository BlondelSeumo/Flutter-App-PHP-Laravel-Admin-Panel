<?php
/**
 * File name: PermissionDataTable.php
 * Last modified: 2020.04.30 at 08:21:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\DataTables;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class PermissionDataTable extends DataTable
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
            ->editColumn('class',function ($permission){
                return explode('.',$permission->name)[0];
            })
            ->editColumn('roles', function ($permission) {
                return json_encode(['permission' => $permission->name, 'roles' => $permission->roles->pluck('name')->toArray()]);
            })
            ->addColumn('action', 'settings.permissions.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Permission $model)
    {
        return $model->newQuery()->with('roles');

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
            ->addAction(['title'=>trans('lang.actions'),'width' => '80px', 'printable' => false ,'responsivePriority'=>'100'])
            ->parameters(array_merge(
                config('datatables-buttons.parameters'), [
                    'language' => json_decode(
                        file_get_contents(base_path('resources/lang/'.app()->getLocale().'/datatable.json')
                        ),true),
                    'rowGroup'=>[
                        'dataSrc' => 'class'
                    ],
                    'colReorder'=>false,
                    "initComplete" => "function(settings){console.log('initComplete'); renderButtons( settings.sTableId); renderiCheck(settings.sTableId)}",
                    "stateSaveParams" => "function(settings){renderiCheck(settings.sTableId);}"
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
                'title' => trans('lang.permission_name'),
                'searchable' => true
            ],
            [
                'data' => 'class',
                'title' => trans('lang.permission_class'),
                'visible' => false,
                'className' => "hide",
                'searchable' => false
            ],
            [
                'data' => 'guard_name',
                'title' => trans('lang.permission_guard_name'),
                'searchable' => false,
            ],
            [
                'data' => 'roles',
                'title' => trans('lang.role_plural'),
                'visible' => false,
                'className' => "hide",
                'searchable' => false
            ],
        ];


        $roles = Role::select('id','name')->get();
        foreach ($roles as $role){
            $newColumn['data'] = 'roles';
            $newColumn['title'] = $role->name;
            $newColumn['searchable'] = 'false';
            $newColumn['exportable'] = 'false';
            $newColumn['printable'] = 'false';
            $newColumn['render'] = 'function(){return "<div class=\'checkbox icheck\'><label><input  type=\'checkbox\' name=\'namehere\' class=\'permission\' data-role-name=\'' . $role->name . '\' data-role-id=\'' . $role->id . '\' data-permission=\'"+data+"\'></label></div>"}';
            $columns[] = $newColumn;
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
        return 'permissionsdatatable_' . time();
    }
}