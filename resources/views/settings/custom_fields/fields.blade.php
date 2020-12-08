<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
    <!-- Name Field -->
    <div class="form-group row ">
        {!! Form::label('name', trans("lang.custom_field_name"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('name', null,  ['class' => 'form-control','placeholder'=>  trans("lang.custom_field_name_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.custom_field_name_help") }}
            </div>
        </div>
    </div>

    <!-- Type Field -->
    <div class="form-group row ">
        {!! Form::label('type', trans("lang.custom_field_type"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('type', $customFieldsTypes, null, ['class' => 'select2 form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.custom_field_type_help") }}</div>
        </div>
    </div>

    <!-- values Field -->
    <div class="form-group row ">
        {!! Form::label('values[]', trans("lang.custom_field_values"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('values[]', array_combine($customFieldValues,$customFieldValues), $customFieldValues, ['data-tags'=>'true','multiple'=>'multiple', 'class' => 'select2 form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.custom_field_values_help") }}</div>
        </div>
    </div>
    
    {{--<!-- values Field -->--}}
    {{--<div class="form-group row ">--}}
        {{--{!! Form::label('values', trans("lang.custom_field_values"), ['class' => 'col-3 control-label text-right']) !!}--}}
        {{--<div class="col-9">--}}
            {{--{!! Form::text('values', null,  ['class' => 'form-control','placeholder'=>  trans("lang.custom_field_values_placeholder")]) !!}--}}
            {{--<div class="form-text text-muted">--}}
                {{--{{ trans("lang.custom_field_values_help") }}--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    <!-- 'Boolean Disabled Field' -->
    <div class="form-group row ">
        {!! Form::label('disabled', trans("lang.custom_field_disabled"),['class' => 'col-3 control-label text-right']) !!}
        <div class="checkbox icheck">
            <label class="col-9 ml-2 form-check-inline">
                {!! Form::hidden('disabled', 0) !!}
                {!! Form::checkbox('disabled', 1, null) !!}
            </label>
        </div>
    </div>

    <!-- 'Boolean Required Field' -->
    <div class="form-group row ">
        {!! Form::label('required', trans("lang.custom_field_required"),['class' => 'col-3 control-label text-right']) !!}
        <div class="checkbox icheck">
            <label class="col-9 ml-2 form-check-inline">
                {!! Form::hidden('required', 0) !!}
                {!! Form::checkbox('required', 1, null) !!}
            </label>
        </div>
    </div>

    <!-- 'Boolean In Table Field' -->
    <div class="form-group row ">
        {!! Form::label('in_table', trans("lang.custom_field_in_table"),['class' => 'col-3 control-label text-right']) !!}
        <div class="checkbox icheck">
            <label class="col-9 ml-2 form-check-inline">
                {!! Form::hidden('in_table', 0) !!}
                {!! Form::checkbox('in_table', 1, null) !!}
            </label>
        </div>
    </div>
</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">


    <!-- Bootstrap Column Field -->
    <div class="form-group row ">
        {!! Form::label('bootstrap_column', trans("lang.custom_field_bootstrap_column"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::number('bootstrap_column', null,  ['class' => 'form-control','placeholder'=>  trans("lang.custom_field_bootstrap_column_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.custom_field_bootstrap_column_help") }}
            </div>
        </div>
    </div>

    <!-- Order Field -->
    <div class="form-group row ">
        {!! Form::label('order', trans("lang.custom_field_order"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::number('order', null,  ['class' => 'form-control','placeholder'=>  trans("lang.custom_field_order_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.custom_field_order_help") }}
            </div>
        </div>
    </div>

    <!-- Custom Field Model Field -->
    <div class="form-group row ">
        {!! Form::label('custom_field_model', trans("lang.custom_field_custom_field_model"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('custom_field_model', $customFieldModels, null, ['class' => 'select2 form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.custom_field_custom_field_model_help") }}</div>
        </div>
    </div>

</div>
<!-- Submit Field -->
<div class="form-group col-12 text-right">
    <button type="submit" class="btn btn-{{setting('theme_color','primary')}}"><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.custom_field')}}</button>
    <a href="{!! route('customFields.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
