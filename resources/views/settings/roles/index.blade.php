@extends('layouts.settings.default')
@section('settings_title',trans('lang.role_table'))
@section('settings_content')
    @include('flash::message')
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                @can('permissions.index')
                <li class="nav-item">
                    <a class="nav-link" href="{!! route('permissions.index') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.permission_table')}}</a>
                </li>
                @endcan
                @can('permissions.create')
                <li class="nav-item">
                    <a class="nav-link" href="{!! route('permissions.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.permission_create')}}</a>
                </li>
                @endcan
                @can('roles.index')
                <li class="nav-item">
                    <a class="nav-link active" href="{!! route('roles.index') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.role_table')}}</a>
                </li>
                @endcan
                @can('roles.create')
                <li class="nav-item">
                    <a class="nav-link" href="{!! route('roles.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.role_create')}}</a>
                </li>
                @endcan

                @include('layouts.right_toolbar', compact('dataTable'))
            </ul>
        </div>
        <div class="card-body">
            @include('settings.roles.table')
            <div class="clearfix"></div>
        </div>
    </div>
@endsection

