@extends('layouts.settings.default')
@push('css_lib')
  <!-- select2 -->
  <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@endpush
@section('settings_title',trans('lang.currency'))
@section('settings_content')
  @include('flash::message')
  @include('adminlte-templates::common.errors')
  <div class="clearfix"></div>
  <div class="card">
    <div class="card-header">
      <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item">
          <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.currency_table')}}</a>
        </li>
        @can('currencies.create')
          <li class="nav-item">
            <a class="nav-link" href="{!! route('currencies.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.currency_create')}}</a>
          </li>
        @endcan
        @include('layouts.right_toolbar', compact('dataTable'))
      </ul>
    </div>
    <div class="card-body">
      @include('settings.currencies.table')
      <div class="clearfix"></div>
    </div>
  </div>
  @include('layouts.media_modal',['collection'=>null])
@endsection

@push('scripts_lib')
  <!-- select2 -->
  <script src="{{asset('plugins/select2/select2.min.js')}}"></script>
@endpush

