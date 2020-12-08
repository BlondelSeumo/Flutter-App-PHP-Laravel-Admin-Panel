@if($customFields)
<h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
<!-- Description Field -->
<div class="form-group row ">
  {!! Form::label('description', trans("lang.delivery_address_description"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('description', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_description_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.delivery_address_description_help") }}
    </div>
  </div>
</div>

<!-- Address Field -->
<div class="form-group row ">
  {!! Form::label('address', trans("lang.delivery_address_address"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('address', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_address_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.delivery_address_address_help") }}
    </div>
  </div>
</div>

<!-- Latitude Field -->
<div class="form-group row ">
  {!! Form::label('latitude', trans("lang.delivery_address_latitude"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('latitude', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_latitude_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.delivery_address_latitude_help") }}
    </div>
  </div>
</div>
</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

<!-- Longitude Field -->
<div class="form-group row ">
  {!! Form::label('longitude', trans("lang.delivery_address_longitude"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('longitude', null,  ['class' => 'form-control','placeholder'=>  trans("lang.delivery_address_longitude_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.delivery_address_longitude_help") }}
    </div>
  </div>
</div>

<!-- 'Boolean Is Default Field' -->
<div class="form-group row ">
  {!! Form::label('is_default', trans("lang.delivery_address_is_default"),['class' => 'col-3 control-label text-right']) !!}
  <div class="checkbox icheck">
    <label class="col-9 ml-2 form-check-inline">
      {!! Form::hidden('is_default', 0) !!}
      {!! Form::checkbox('is_default', 1, null) !!}
    </label>
  </div>
</div>


<!-- User Id Field -->
<div class="form-group row ">
  {!! Form::label('user_id', trans("lang.delivery_address_user_id"),['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::select('user_id', $user, null, ['class' => 'select2 form-control']) !!}
    <div class="form-text text-muted">{{ trans("lang.delivery_address_user_id_help") }}</div>
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
  <button type="submit" class="btn btn-{{setting('theme_color')}}" ><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.delivery_address')}}</button>
  <a href="{!! route('deliveryAddresses.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
