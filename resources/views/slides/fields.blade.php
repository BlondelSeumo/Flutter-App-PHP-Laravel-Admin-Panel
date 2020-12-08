@if($customFields)
    <h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
    <!-- Order Field -->
    <div class="form-group row ">
        {!! Form::label('order', trans("lang.slide_order"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::number('order', null,  ['class' => 'form-control','placeholder'=>  trans("lang.slide_order_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.slide_order_help") }}
            </div>
        </div>
    </div>

    <!-- Text Field -->
    <div class="form-group row ">
        {!! Form::label('text', trans("lang.slide_text"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('text', null,  ['class' => 'form-control','placeholder'=>  trans("lang.slide_text_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.slide_text_help") }}
            </div>
        </div>
    </div>

    <!-- Button Field -->
    <div class="form-group row ">
        {!! Form::label('button', trans("lang.slide_button"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('button', null,  ['class' => 'form-control','placeholder'=>  trans("lang.slide_button_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.slide_button_help") }}
            </div>
        </div>
    </div>

    <!-- Text Position Field -->
    <div class="form-group row ">
        {!! Form::label('text_position', trans("lang.slide_text_position"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('text_position', [
            'top_start' => trans('lang.slide_top_start'),
            'top_center' => trans('lang.slide_top_center'),
            'top_end' => trans('lang.slide_top_end'),
            'center_start' => trans('lang.slide_center_start'),
            'center' => trans('lang.slide_center'),
            'center_end' => trans('lang.slide_center_end'),
            'bottom_start' => trans('lang.slide_bottom_start'),
            'bottom_center' => trans('lang.slide_bottom_center'),
            'bottom_end' => trans('lang.slide_bottom_end'),
            ], null, ['class' => 'select2 form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.slide_text_position_help") }}</div>
        </div>
    </div>

    <!-- Main Color Field -->
    <div class="form-group row">
        {!! Form::label('text_color', trans("lang.slide_text_color"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            <div id="main-colorpicker" class="input-group colorpicker-component">
                {!! Form::text('text_color', null,  ['class' => 'form-control','placeholder'=>  trans("lang.slide_text_color_placeholder"),'autocomplete' => 'off']) !!}
                <div class=" input-group-append ">
                    <span class="input-group-addon input-group-text"><i></i></span>
                </div>
            </div>
            <div class="form-text text-muted">
                {{ trans("lang.slide_text_color_help") }}
            </div>
        </div>
    </div>

    <!-- Button Color Field -->
    <div class="form-group row">
        {!! Form::label('button_color', trans("lang.slide_button_color"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            <div id="main-colorpicker" class="input-group colorpicker-component">
                {!! Form::text('button_color', null,  ['class' => 'form-control','placeholder'=>  trans("lang.slide_button_color_placeholder"),'autocomplete' => 'off']) !!}
                <div class=" input-group-append ">
                    <span class="input-group-addon input-group-text"><i></i></span>
                </div>
            </div>
            <div class="form-text text-muted">
                {{ trans("lang.slide_button_color_help") }}
            </div>
        </div>
    </div>

    <!-- Background Color Field -->
    <div class="form-group row">
        {!! Form::label('background_color', trans("lang.slide_background_color"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            <div id="main-colorpicker" class="input-group colorpicker-component">
                {!! Form::text('background_color', null,  ['class' => 'form-control','placeholder'=>  trans("lang.slide_background_color_placeholder"),'autocomplete' => 'off']) !!}
                <div class=" input-group-append ">
                    <span class="input-group-addon input-group-text"><i></i></span>
                </div>
            </div>
            <div class="form-text text-muted">
                {{ trans("lang.slide_background_color_help") }}
            </div>
        </div>
    </div>

</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">


    <!-- Indicator Color Field -->
    <div class="form-group row">
        {!! Form::label('indicator_color', trans("lang.slide_indicator_color"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            <div id="main-colorpicker" class="input-group colorpicker-component">
                {!! Form::text('indicator_color', null,  ['class' => 'form-control','placeholder'=>  trans("lang.slide_indicator_color_placeholder"),'autocomplete' => 'off']) !!}
                <div class=" input-group-append ">
                    <span class="input-group-addon input-group-text"><i></i></span>
                </div>
            </div>
            <div class="form-text text-muted">
                {{ trans("lang.slide_indicator_color_help") }}
            </div>
        </div>
    </div>

    <!-- Image Field -->
    <div class="form-group row">
        {!! Form::label('image', trans("lang.slide_image"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            <div style="width: 100%" class="dropzone image" id="image" data-field="image">
                <input type="hidden" name="image">
            </div>
            <a href="#loadMediaModal" data-dropzone="image" data-toggle="modal" data-target="#mediaModal" class="btn btn-outline-{{setting('theme_color','primary')}} btn-sm float-right mt-1">{{ trans('lang.media_select')}}</a>
            <div class="form-text text-muted w-50">
                {{ trans("lang.slide_image_help") }}
            </div>
        </div>
    </div>
    @prepend('scripts')
        <script type="text/javascript">
            var var1598988452806641953ble = '';
            @if(isset($slide) && $slide->hasMedia('image'))
                var1598988452806641953ble = {
                name: "{!! $slide->getFirstMedia('image')->name !!}",
                size: "{!! $slide->getFirstMedia('image')->size !!}",
                type: "{!! $slide->getFirstMedia('image')->mime_type !!}",
                collection_name: "{!! $slide->getFirstMedia('image')->collection_name !!}"
            };
                    @endif
            var dz_var1598988452806641953ble = $(".dropzone.image").dropzone({
                    url: "{!!url('uploads/store')!!}",
                    addRemoveLinks: true,
                    maxFiles: 1,
                    init: function () {
                        @if(isset($slide) && $slide->hasMedia('image'))
                        dzInit(this, var1598988452806641953ble, '{!! url($slide->getFirstMediaUrl('image','thumb')) !!}')
                        @endif
                    },
                    accept: function (file, done) {
                        dzAccept(file, done, this.element, "{!!config('medialibrary.icons_folder')!!}");
                    },
                    sending: function (file, xhr, formData) {
                        dzSending(this, file, formData, '{!! csrf_token() !!}');
                    },
                    maxfilesexceeded: function (file) {
                        dz_var1598988452806641953ble[0].mockFile = '';
                        dzMaxfile(this, file);
                    },
                    complete: function (file) {
                        dzComplete(this, file, var1598988452806641953ble, dz_var1598988452806641953ble[0].mockFile);
                        dz_var1598988452806641953ble[0].mockFile = file;
                    },
                    removedfile: function (file) {
                        dzRemoveFile(
                            file, var1598988452806641953ble, '{!! url("slides/remove-media") !!}',
                            'image', '{!! isset($slide) ? $slide->id : 0 !!}', '{!! url("uplaods/clear") !!}', '{!! csrf_token() !!}'
                        );
                    }
                });
            dz_var1598988452806641953ble[0].mockFile = var1598988452806641953ble;
            dropzoneFields['image'] = dz_var1598988452806641953ble;
        </script>
@endprepend

<!-- Image Fit Field -->
    <div class="form-group row ">
        {!! Form::label('image_fit', trans("lang.slide_image_fit"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('image_fit', [
            'cover' => trans('lang.slide_cover'),
            'fill' => trans('lang.slide_fill'),
            'contain' => trans('lang.slide_contain'),
            'fit_height' => trans('lang.slide_fit_height'),
            'fit_width' => trans('lang.slide_fit_width'),
            'none' => trans('lang.slide_none'),
            'scale_down' => trans('lang.slide_scale_down'),
            ], null, ['class' => 'select2 form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.slide_image_fit_help") }}</div>
        </div>
    </div>

    <!-- Food Id Field -->
    <div class="form-group row ">
        {!! Form::label('food_id', trans("lang.slide_food_id"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('food_id', $food, null, ['data-empty'=>trans("lang.slide_food_id_placeholder"),'class' => 'select2 not-required form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.slide_food_id_help") }}</div>
        </div>
    </div>

    <!-- Restaurant Id Field -->
    <div class="form-group row ">
        {!! Form::label('restaurant_id', trans("lang.slide_restaurant_id"),['data-empty'=>trans("lang.slide_restaurant_id_placeholder"),'class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('restaurant_id', $restaurant, null, ['class' => 'select2 not-required form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.slide_restaurant_id_help") }}</div>
        </div>
    </div>

    <!-- 'Boolean Enabled Field' -->
    <div class="form-group row">
        {!! Form::label('enabled', trans("lang.slide_enabled"),['class' => 'col-3 control-label text-right']) !!}
        {!! Form::hidden('enabled', 0, ['id'=>"hidden_enabled"]) !!}
        <div class="col-9 icheck-{{setting('theme_color')}}">
            {!! Form::checkbox('enabled', 1, null) !!}
            <label for="enabled"></label>
        </div>
    </div>

</div>
@if($customFields)
    <div class="clearfix"></div>
    <div class="col-12 custom-field-container">
        <h5 class="col-12 pb-4">{!! trans('lang.custom_field_plural') !!}</h5>
        {!! $customFields !!}
    </div>
@endif
<!-- Submit Field -->
<div class="form-group col-12 text-right">
    <button type="submit" class="btn btn-{{setting('theme_color')}}"><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.slide')}}</button>
    <a href="{!! route('slides.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
