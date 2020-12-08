@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header content-header{{setting('fixed_header')}}">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{trans('lang.setting')}} <small>{{trans('lang.setting_desc')}}</small></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> {{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item active">@yield('settings_title')</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="content">
    <div class="clearfix"></div>
    @include('flash::message')
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-3">
            @include('layouts.settings.menu')
        </div>
        <div class="col-md-9">
            @yield('settings_content')
        </div>
    </div>
</div>
@endsection
