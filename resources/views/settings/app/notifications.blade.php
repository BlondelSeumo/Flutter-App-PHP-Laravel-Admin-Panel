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
@section('settings_title',trans('lang.app_setting_notifications'))
@section('settings_content')
    @include('flash::message')
    @include('adminlte-templates::common.errors')
    <div class="clearfix"></div>
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                <li class="nav-item">
                    <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-cog mr-2"></i>{{trans('lang.app_setting_'.$tab)}}</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            {!! Form::open(['url' => ['settings/update'], 'method' => 'patch']) !!}
            <div class="row">
                <h5 class="col-12 pb-4"><i class="mr-3 fa fa-bell"></i>{!! trans('lang.app_setting_notifications') !!}</h5>
                <!-- 'Boolean enable_facebook Field' -->
                <div class="form-group row col-12">
                    {!! Form::label('enable_notifications', trans('lang.app_setting_enable_notifications'),['class' => 'col-2 control-label text-right']) !!}
                    <div class="checkbox icheck">
                        <label class="w-100 ml-2 form-check-inline">
                            {!! Form::hidden('enable_notifications', null) !!}
                            {!! Form::checkbox('enable_notifications', 1, setting('enable_notifications', false)) !!}
                            <span class="ml-2">{!! trans('lang.app_setting_enable_notifications_help') !!}</span>
                        </label>
                    </div>
                </div>
                <!-- facebook_app_id Field -->
                <div class="form-group row col-12">
                    {!! Form::label('fcm_key', trans('lang.app_setting_fcm_key'), ['class' => 'col-2 control-label text-right']) !!}
                    <div class="col-10">
                        {!! Form::text('fcm_key', setting('fcm_key'),  ['class' => 'form-control','placeholder'=>  trans('lang.app_setting_fcm_key_placeholder')]) !!}
                        <div class="form-text text-muted">
                            {!! trans('lang.app_setting_fcm_key_help') !!}
                        </div>
                    </div>
                </div>

                <!-- firebase_api_key Field -->
                <div class="form-group row col-6">
                    {!! Form::label('firebase_api_key', trans('lang.app_setting_firebase_api_key'), ['class' => 'col-4 control-label text-right']) !!}
                    <div class="col-8">
                        {!! Form::text('firebase_api_key', setting('firebase_api_key'),  ['class' => 'form-control','placeholder'=>  trans('lang.app_setting_firebase_api_key_placeholder')]) !!}
                        <div class="form-text text-muted">
                            {!! trans('lang.app_setting_firebase_api_key_help') !!}
                        </div>
                    </div>
                </div>

                <!-- firebase_auth_domain Field -->
                <div class="form-group row col-6">
                    {!! Form::label('firebase_auth_domain', trans('lang.app_setting_firebase_auth_domain'), ['class' => 'col-4 control-label text-right']) !!}
                    <div class="col-8">
                        {!! Form::text('firebase_auth_domain', setting('firebase_auth_domain'),  ['class' => 'form-control','placeholder'=>  trans('lang.app_setting_firebase_auth_domain_placeholder')]) !!}
                        <div class="form-text text-muted">
                            {!! trans('lang.app_setting_firebase_auth_domain_help') !!}
                        </div>
                    </div>
                </div>

                <!-- firebase_database_url Field -->
                <div class="form-group row col-6">
                    {!! Form::label('firebase_database_url', trans('lang.app_setting_firebase_database_url'), ['class' => 'col-4 control-label text-right']) !!}
                    <div class="col-8">
                        {!! Form::text('firebase_database_url', setting('firebase_database_url'),  ['class' => 'form-control','placeholder'=>  trans('lang.app_setting_firebase_database_url_placeholder')]) !!}
                        <div class="form-text text-muted">
                            {!! trans('lang.app_setting_firebase_database_url_help') !!}
                        </div>
                    </div>
                </div>

                <!-- firebase_project_id Field -->
                <div class="form-group row col-6">
                    {!! Form::label('firebase_project_id', trans('lang.app_setting_firebase_project_id'), ['class' => 'col-4 control-label text-right']) !!}
                    <div class="col-8">
                        {!! Form::text('firebase_project_id', setting('firebase_project_id'),  ['class' => 'form-control','placeholder'=>  trans('lang.app_setting_firebase_project_id_placeholder')]) !!}
                        <div class="form-text text-muted">
                            {!! trans('lang.app_setting_firebase_project_id_help') !!}
                        </div>
                    </div>
                </div>

                <!-- firebase_storage_bucket Field -->
                <div class="form-group row col-6">
                    {!! Form::label('firebase_storage_bucket', trans('lang.app_setting_firebase_storage_bucket'), ['class' => 'col-4 control-label text-right']) !!}
                    <div class="col-8">
                        {!! Form::text('firebase_storage_bucket', setting('firebase_storage_bucket'),  ['class' => 'form-control','placeholder'=>  trans('lang.app_setting_firebase_storage_bucket_placeholder')]) !!}
                        <div class="form-text text-muted">
                            {!! trans('lang.app_setting_firebase_storage_bucket_help') !!}
                        </div>
                    </div>
                </div>

                <!-- firebase_messaging_sender_id Field -->
                <div class="form-group row col-6">
                    {!! Form::label('firebase_messaging_sender_id', trans('lang.app_setting_firebase_messaging_sender_id'), ['class' => 'col-4 control-label text-right']) !!}
                    <div class="col-8">
                        {!! Form::text('firebase_messaging_sender_id', setting('firebase_messaging_sender_id'),  ['class' => 'form-control','placeholder'=>  trans('lang.app_setting_firebase_messaging_sender_id_placeholder')]) !!}
                        <div class="form-text text-muted">
                            {!! trans('lang.app_setting_firebase_messaging_sender_id_help') !!}
                        </div>
                    </div>
                </div>

                <!-- firebase_app_id Field -->
                <div class="form-group row col-6">
                    {!! Form::label('firebase_app_id', trans('lang.app_setting_firebase_app_id'), ['class' => 'col-4 control-label text-right']) !!}
                    <div class="col-8">
                        {!! Form::text('firebase_app_id', setting('firebase_app_id'),  ['class' => 'form-control','placeholder'=>  trans('lang.app_setting_firebase_app_id_placeholder')]) !!}
                        <div class="form-text text-muted">
                            {!! trans('lang.app_setting_firebase_app_id_help') !!}
                        </div>
                    </div>
                </div>

                <!-- firebase_measurement_id Field -->
                <div class="form-group row col-6">
                    {!! Form::label('firebase_measurement_id', trans('lang.app_setting_firebase_measurement_id'), ['class' => 'col-4 control-label text-right']) !!}
                    <div class="col-8">
                        {!! Form::text('firebase_measurement_id', setting('firebase_measurement_id'),  ['class' => 'form-control','placeholder'=>  trans('lang.app_setting_firebase_measurement_id_placeholder')]) !!}
                        <div class="form-text text-muted">
                            {!! trans('lang.app_setting_firebase_measurement_id_help') !!}
                        </div>
                    </div>
                </div>

                <!-- Submit Field -->
                <div class="form-group mt-4 col-12 text-right">
                    <button type="submit" class="btn btn-{{setting('theme_color')}}">
                        <i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.app_setting_notification')}}
                    </button>
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
