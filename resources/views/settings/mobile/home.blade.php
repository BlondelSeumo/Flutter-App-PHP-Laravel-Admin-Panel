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
                    <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-cog mr-2"></i>{{trans('lang.app_setting_mobile_'.$tab)}}</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            {!! Form::open(['url' => ['settings/update'], 'method' => 'patch']) !!}
            <div class="row">
                <h5 class="col-12 pb-4"><i class="mr-3 fa fa-tasks"></i>{!! trans('lang.app_setting_mobile_section_builder') !!}</h5>
                @for($i = 1 ; $i <= 12 ; $i++)
                <!-- Theme Color Field -->
                <div class="form-group row col-12">
                    {!! Form::label('home_section_'.$i, trans("lang.app_setting_mobile_section_desc")." - $i",['class' => 'col-3 control-label']) !!}
                    <div class="col-6">
                        {!! Form::select('home_section_'.$i,
                        [
                        'empty' => trans('lang.app_setting_mobile_empty'),
                        'search' => trans('lang.app_setting_mobile_search'),
                        'slider' => trans('lang.app_setting_mobile_slider'),
                        'top_restaurants_heading' => trans('lang.app_setting_mobile_top_restaurants_heading'),
                        'top_restaurants' => trans('lang.app_setting_mobile_top_restaurants'),
                        'trending_week_heading' => trans('lang.app_setting_mobile_trending_week_heading'),
                        'trending_week' => trans('lang.app_setting_mobile_trending_week'),
                        'categories' => trans('lang.app_setting_mobile_categories'),
                        'categories_heading' => trans('lang.app_setting_mobile_categories_heading'),
                        'popular_heading' => trans('lang.app_setting_mobile_popular_heading'),
                        'popular' => trans('lang.app_setting_mobile_popular'),
                        'recent_reviews_heading' => trans('lang.app_setting_mobile_recent_reviews_heading'),
                        'recent_reviews' => trans('lang.app_setting_mobile_recent_reviews'),
                        ]
                        , setting('home_section_'.$i,'empty'), ['class' => 'select2 form-control']) !!}
                        <div class="form-text text-muted">{{ trans("lang.app_setting_mobile_section_help") }}</div>
                    </div>
                </div>
                @endfor

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
