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
    {{--Color Picker--}}
    <link rel="stylesheet" href="{{asset('plugins/colorpicker/bootstrap-colorpicker.min.css')}}">
@endpush
@section('settings_title',trans('lang.app_setting_mobile'))
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
                <h5 class="col-12 pb-4"><i class="mr-3 fa fa-map"></i>{!! trans('lang.app_setting_google_maps_key') !!}</h5>

                <div class="form-group row col-12">
                    {!! Form::label('google_maps_key', trans('lang.app_setting_google_maps_key'), ['class' => 'col-2 control-label text-right']) !!}
                    <div class="col-10">
                        {!! Form::text('google_maps_key', setting('google_maps_key',"AIzaSyAT07iMlfZ9bJt1gmGj9KhJDLFY8srI6dA"),  ['class' => 'form-control','placeholder'=>  trans('lang.app_setting_google_maps_key_placeholder')]) !!}
                        <div class="form-text text-muted">
                            {!! trans('lang.app_setting_google_maps_key_help') !!}
                        </div>
                    </div>
                </div>

                <!-- Theme Color Field -->
                <div class="form-group row col-6">
                    {!! Form::label('distance_unit', trans("lang.app_setting_distance_unit"),['class' => 'col-4 control-label text-right']) !!}
                    <div class="col-8">
                        {!! Form::select('distance_unit',
                        [
                        'km' => trans('lang.app_setting_km'),
                        'mi' => trans('lang.app_setting_mi'),
                        ]
                        , setting('distance_unit','km'), ['class' => 'select2 form-control']) !!}
                        <div class="form-text text-muted">{{ trans("lang.app_setting_distance_unit_help") }}</div>
                    </div>
                </div>

                <h5 class="col-12 pb-4 custom-field-container"><i class="mr-3 fa fa-globe"></i>{!! trans('lang.app_setting_language') !!}</h5>

                <!-- Lang Field -->
                <div class="form-group row col-6">
                    {!! Form::label('mobile_language', trans("lang.app_setting_mobile_language"),['class' => 'col-4 control-label text-right']) !!}
                    <div class="col-8">
                        {!! Form::select('mobile_language', $mobileLanguages, setting('mobile_language','en'), ['class' => 'select2 form-control']) !!}
                        <div class="form-text text-muted">{{ trans("lang.app_setting_mobile_language_help") }}</div>
                    </div>
                </div>

                <h5 class="col-12 pb-4 custom-field-container"><i class="mr-3 fa fa-mobile-phone"></i>{!! trans('lang.app_setting_version') !!}</h5>

                <!-- app_version Field -->
                <div class="form-group row col-6">
                    {!! Form::label('app_version', trans('lang.app_setting_app_version'), ['class' => 'col-4 control-label text-right']) !!}
                    <div class="col-8">
                        {!! Form::text('app_version', setting('app_version',"1.0.0"),  ['class' => 'form-control','placeholder'=>  trans('lang.app_setting_app_version_placeholder')]) !!}
                        <div class="form-text text-muted">
                            {!! trans('lang.app_setting_app_version_help') !!}
                        </div>
                    </div>
                </div>
                <!-- 'Boolean enable_facebook Field' -->
                <div class="form-group row col-6">
                    {!! Form::label('enable_version', trans('lang.app_setting_enable_version'),['class' => 'col-4 control-label text-right']) !!}
                    <div class="checkbox icheck">
                        <label class="w-100 ml-2 form-check-inline">
                            {!! Form::hidden('enable_version', null) !!}
                            {!! Form::checkbox('enable_version', 1, setting('enable_version', true)) !!}
                        </label>
                    </div>
                </div>

                <!-- Submit Field -->
                <div class="form-group mt-4 col-12 text-right">
                    <button type="submit" class="btn btn-{{setting('theme_color')}}">
                        <i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.app_setting')}}
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
    <script src="{{asset('plugins/colorpicker/bootstrap-colorpicker.min.js')}}"></script>
    <script type="text/javascript">
        // $("input[name$='color']").colorpicker({
        $(".colorpicker-component, input[name$='color']").colorpicker({
            customClass: 'colorpicker',
            format: 'hex',
            sliders: {
                saturation: {
                    maxLeft: 200,
                    maxTop: 200
                },
                hue: {
                    maxTop: 200
                },
                alpha: {
                    maxTop: 200
                }
            }
        });
        Dropzone.autoDiscover = false;
        var dropzoneFields = [];
    </script>
@endpush
