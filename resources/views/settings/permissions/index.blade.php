@extends('layouts.settings.default')
@push('css_lib')
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/iCheck/flat/blue.css')}}">
@endpush
@section('settings_title',trans('lang.permission_table'))

@section('settings_content')
    @include('flash::message')
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs align-items-end card-header-tabs w-100">

                <li class="nav-item">
                    <a class="nav-link active" href="{!! route('permissions.index') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.permission_table')}}</a>
                </li>
                @can('permissions.create')
                <li class="nav-item">
                    <a class="nav-link" href="{!! route('permissions.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.permission_create')}}</a>
                </li>
                @endcan
                @can('roles.index')
                <li class="nav-item">
                    <a class="nav-link" href="{!! route('roles.index') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.role_table')}}</a>
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
            @include('settings.permissions.table')
            <div class="clearfix"></div>
        </div>
    </div>
@endsection
@push('scripts_lib')
    <!-- iCheck -->
    <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
@endpush

