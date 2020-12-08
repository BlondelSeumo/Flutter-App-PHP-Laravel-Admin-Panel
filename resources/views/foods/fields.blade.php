@if($customFields)
    <h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
    <!-- Name Field -->
    <div class="form-group row ">
        {!! Form::label('name', trans("lang.food_name"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('name', null,  ['class' => 'form-control','placeholder'=>  trans("lang.food_name_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.food_name_help") }}
            </div>
        </div>
    </div>

    <!-- Image Field -->
    <div class="form-group row">
        {!! Form::label('image', trans("lang.food_image"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            <div style="width: 100%" class="dropzone image" id="image" data-field="image">
                <input type="hidden" name="image">
            </div>
            <a href="#loadMediaModal" data-dropzone="image" data-toggle="modal" data-target="#mediaModal" class="btn btn-outline-{{setting('theme_color','primary')}} btn-sm float-right mt-1">{{ trans('lang.media_select')}}</a>
            <div class="form-text text-muted w-50">
                {{ trans("lang.food_image_help") }}
            </div>
        </div>
    </div>
    @prepend('scripts')
        <script type="text/javascript">
            var var15671147171873255749ble = '';
            @if(isset($food) && $food->hasMedia('image'))
                var15671147171873255749ble = {
                name: "{!! $food->getFirstMedia('image')->name !!}",
                size: "{!! $food->getFirstMedia('image')->size !!}",
                type: "{!! $food->getFirstMedia('image')->mime_type !!}",
                collection_name: "{!! $food->getFirstMedia('image')->collection_name !!}"
            };
                    @endif
            var dz_var15671147171873255749ble = $(".dropzone.image").dropzone({
                    url: "{!!url('uploads/store')!!}",
                    addRemoveLinks: true,
                    maxFiles: 1,
                    init: function () {
                        @if(isset($food) && $food->hasMedia('image'))
                        dzInit(this, var15671147171873255749ble, '{!! url($food->getFirstMediaUrl('image','thumb')) !!}')
                        @endif
                    },
                    accept: function (file, done) {
                        dzAccept(file, done, this.element, "{!!config('medialibrary.icons_folder')!!}");
                    },
                    sending: function (file, xhr, formData) {
                        dzSending(this, file, formData, '{!! csrf_token() !!}');
                    },
                    maxfilesexceeded: function (file) {
                        dz_var15671147171873255749ble[0].mockFile = '';
                        dzMaxfile(this, file);
                    },
                    complete: function (file) {
                        dzComplete(this, file, var15671147171873255749ble, dz_var15671147171873255749ble[0].mockFile);
                        dz_var15671147171873255749ble[0].mockFile = file;
                    },
                    removedfile: function (file) {
                        dzRemoveFile(
                            file, var15671147171873255749ble, '{!! url("foods/remove-media") !!}',
                            'image', '{!! isset($food) ? $food->id : 0 !!}', '{!! url("uplaods/clear") !!}', '{!! csrf_token() !!}'
                        );
                    }
                });
            dz_var15671147171873255749ble[0].mockFile = var15671147171873255749ble;
            dropzoneFields['image'] = dz_var15671147171873255749ble;
        </script>
@endprepend

<!-- Price Field -->
    <div class="form-group row ">
        {!! Form::label('price', trans("lang.food_price"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::number('price', null,  ['class' => 'form-control','placeholder'=>  trans("lang.food_price_placeholder"),'step'=>"any", 'min'=>"0"]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.food_price_help") }}
            </div>
        </div>
    </div>

    <!-- Discount Price Field -->
    <div class="form-group row ">
        {!! Form::label('discount_price', trans("lang.food_discount_price"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::number('discount_price', null,  ['class' => 'form-control','placeholder'=>  trans("lang.food_discount_price_placeholder"),'step'=>"any", 'min'=>"0"]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.food_discount_price_help") }}
            </div>
        </div>
    </div>

    <!-- Description Field -->
    <div class="form-group row ">
        {!! Form::label('description', trans("lang.food_description"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::textarea('description', null, ['class' => 'form-control','placeholder'=>
             trans("lang.food_description_placeholder")  ]) !!}
            <div class="form-text text-muted">{{ trans("lang.food_description_help") }}</div>
        </div>
    </div>
</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

    <!-- Ingredients Field -->
    <div class="form-group row ">
        {!! Form::label('ingredients', trans("lang.food_ingredients"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::textarea('ingredients', null, ['class' => 'form-control','placeholder'=>
             trans("lang.food_ingredients_placeholder")  ]) !!}
            <div class="form-text text-muted">{{ trans("lang.food_ingredients_help") }}</div>
        </div>
    </div>

    <!-- unit Field -->
    <div class="form-group row ">
        {!! Form::label('unit', trans("lang.food_unit"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('unit', null,  ['class' => 'form-control','placeholder'=>  trans("lang.food_unit_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.food_unit_help") }}
            </div>
        </div>
    </div>

    <!-- package_items_count Field -->
    <div class="form-group row ">
        {!! Form::label('package_items_count', trans("lang.food_package_items_count"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::number('package_items_count', null,  ['class' => 'form-control','placeholder'=>  trans("lang.food_package_items_count_placeholder"),'step'=>"any", 'min'=>"0"]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.food_package_items_count_help") }}
            </div>
        </div>
    </div>

    <!-- Weight Field -->
    <div class="form-group row ">
        {!! Form::label('weight', trans("lang.food_weight"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::number('weight', null,  ['class' => 'form-control','placeholder'=>  trans("lang.food_weight_placeholder"),'step'=>"0.01", 'min'=>"0"]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.food_weight_help") }}
            </div>
        </div>
    </div>

    <!-- 'Boolean Featured Field' -->
    <div class="form-group row ">
        {!! Form::label('featured', trans("lang.food_featured"),['class' => 'col-3 control-label text-right']) !!}
        <div class="checkbox icheck">
            <label class="col-9 ml-2 form-check-inline">
                {!! Form::hidden('featured', 0) !!}
                {!! Form::checkbox('featured', 1, null) !!}
            </label>
        </div>
    </div>

    <!-- 'Boolean deliverable Field' -->
    <div class="form-group row ">
        {!! Form::label('deliverable', trans("lang.food_deliverable"),['class' => 'col-3 control-label text-right']) !!}
        <div class="checkbox icheck">
            <label class="col-9 ml-2 form-check-inline">
                {!! Form::hidden('deliverable', 0) !!}
                {!! Form::checkbox('deliverable', 1, null) !!}
            </label>
        </div>
    </div>

    <!-- Restaurant Id Field -->
    <div class="form-group row ">
        {!! Form::label('restaurant_id', trans("lang.food_restaurant_id"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('restaurant_id', $restaurant, null, ['class' => 'select2 form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.food_restaurant_id_help") }}</div>
        </div>
    </div>

    <!-- Category Id Field -->
    <div class="form-group row ">
        {!! Form::label('category_id', trans("lang.food_category_id"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('category_id', $category, null, ['class' => 'select2 form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.food_category_id_help") }}</div>
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
    <button type="submit" class="btn btn-{{setting('theme_color')}}"><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.food')}}</button>
    <a href="{!! route('foods.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
