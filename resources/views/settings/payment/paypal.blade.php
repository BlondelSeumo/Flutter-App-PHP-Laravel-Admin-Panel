@extends('layouts.settings.default')
@push('css_lib')
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/iCheck/flat/blue.css')}}">
    <!-- select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
    {{--dropzone--}}
    <link rel="stylesheet" href="{{asset('plugins/dropzone/bootstrap.min.css')}}">
@endpush
@section('settings_title',trans('lang.user_table'))
@section('settings_content')
    @include('flash::message')
    @include('adminlte-templates::common.errors')
    <div class="clearfix"></div>
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                <li class="nav-item">
                    <a class="nav-link active" href="{!! url('settings/payment/paypal') !!}"><i class="fa fa-envelope mr-2"></i>{{trans('lang.app_setting_paypal')}}@if(setting('enable_paypal', false))<span class="badge ml-2 badge-success">{{trans('lang.active')}}</span>@endif</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{!! url('settings/payment/stripe') !!}"><i class="fa fa-envelope-o mr-2"></i>{{trans('lang.app_setting_stripe')}}@if(setting('enable_stripe',false))<span class="badge ml-2 badge-success">{{trans('lang.active')}}</span>@endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{!! url('settings/payment/razorpay') !!}"><i class="fa fa-envelope-o mr-2"></i>{{trans('lang.app_setting_razorpay')}}@if(setting('enable_razorpay',false))<span class="badge ml-2 badge-success">{{trans('lang.active')}}</span>@endif
                    </a>
                </li>

                <div class="ml-auto d-inline-flex">
                    @can('currencies.index')
                        <li class="nav-item">
                            <a class="nav-link" href="{!! route('currencies.index') !!}"><i class="fa fa-dollar mr-2"></i>{{trans('lang.currency_table')}}</a>
                        </li>
                    @endcan
                </div>
            </ul>
        </div>
        <div class="card-body">
            {!! Form::open(['url' => ['settings/update'], 'method' => 'patch']) !!}
            <div class="row">
                <!-- 'Boolean enable_facebook Field' -->
                <div class="form-group row col-12">
                    {!! Form::label('enable_paypal', trans('lang.app_setting_enable_paypal'),['class' => 'col-2 control-label text-right']) !!}
                    <div class="checkbox icheck">
                        <label class="w-100 ml-2 form-check-inline">
                            {!! Form::hidden('enable_paypal', null) !!}
                            {!! Form::checkbox('enable_paypal', 1, setting('enable_paypal', false)) !!}
                            <span class="ml-2">{!! trans('lang.app_setting_enable_paypal_help') !!}</span>
                        </label>
                    </div>
                </div>

                <!-- 'Boolean enable_facebook Field' -->
                <div class="form-group row col-12">
                    {!! Form::label('paypal_mode', trans('lang.app_setting_paypal_mode'),['class' => 'col-2 control-label text-right']) !!}
                    <div class="checkbox icheck">
                        <label class="w-100 ml-2 form-check-inline">
                            {!! Form::hidden('paypal_mode', null) !!}
                            {!! Form::checkbox('paypal_mode', 1, setting('paypal_mode', false)) !!}
                            <span class="ml-2">{!! trans('lang.app_setting_paypal_mode_help') !!}</span>
                        </label>
                    </div>
                </div>

                <!-- paypal_username Field -->
                <div class="form-group row col-6">
                    {!! Form::label('paypal_username', trans('lang.app_setting_paypal_username'), ['class' => 'col-4 control-label text-right']) !!}
                    <div class="col-8">
                        {!! Form::text('paypal_username', setting('paypal_username'),  ['class' => 'form-control','placeholder'=>  trans('lang.app_setting_paypal_username_placeholder')]) !!}
                        <div class="form-text text-muted">
                            {!! trans('lang.app_setting_paypal_username_help') !!}
                        </div>
                    </div>
                </div>

                <!-- paypal_password Field -->
                <div class="form-group row col-6">
                    {!! Form::label('paypal_password', trans('lang.app_setting_paypal_password'), ['class' => 'col-4 control-label text-right']) !!}
                    <div class="col-8">
                        {!! Form::text('paypal_password', setting('paypal_password'),  ['class' => 'form-control','placeholder'=>  trans('lang.app_setting_paypal_password_placeholder')]) !!}
                        <div class="form-text text-muted">
                            {!! trans('lang.app_setting_paypal_password_help') !!}
                        </div>
                    </div>
                </div>


                <!-- facebook_app_secret Field -->
                <div class="form-group row col-6">
                    {!! Form::label('paypal_secret', trans('lang.app_setting_paypal_secret'), ['class' => 'col-4 control-label text-right']) !!}
                    <div class="col-8">
                        {!! Form::text('paypal_secret', setting('paypal_secret'),  ['class' => 'form-control','placeholder'=>  trans('lang.app_setting_paypal_secret_placeholder')]) !!}
                        <div class="form-text text-muted">
                            {!! trans('lang.app_setting_paypal_secret_help') !!}
                        </div>
                    </div>
                </div>

                <!-- paypal_app_app_id Field -->
                <div class="form-group row col-6">
                    {!! Form::label('paypal_app_id', trans('lang.app_setting_paypal_app_id'), ['class' => 'col-4 control-label text-right']) !!}
                    <div class="col-8">
                        {!! Form::text('paypal_app_id', setting('paypal_app_id'),  ['class' => 'form-control','placeholder'=>  trans('lang.app_setting_paypal_app_id_placeholder')]) !!}
                        <div class="form-text text-muted">
                            {!! trans('lang.app_setting_paypal_app_id_help') !!}
                        </div>
                    </div>
                </div>
                <!-- Submit Field -->
                <div class="form-group mt-4 col-12 text-right">
                    <button type="submit" class="btn btn-{{setting('theme_color')}}"><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.app_setting_payment')}}</button>
                    <a href="{!! route('users.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
                </div>

            </div>
            {!! Form::close() !!}
            <div class="clearfix"></div>
        </div>
    </div>
    </div>
    @include('layouts.media_modal',['collection'=>null])
@endsection
@push('scripts_lib')
    <!-- iCheck -->
    <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
    <!-- select2 -->
    <script src="{{asset('plugins/select2/select2.min.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    {{--dropzone--}}
    <script src="{{asset('plugins/dropzone/dropzone.js')}}"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        var dropzoneFields = [];
    </script>
@endpush
