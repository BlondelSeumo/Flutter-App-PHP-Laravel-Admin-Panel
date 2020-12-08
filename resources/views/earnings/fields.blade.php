@if($customFields)
<h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
<!-- Restaurant Id Field -->
<div class="form-group row ">
  {!! Form::label('restaurant_id', trans("lang.earning_restaurant_id"),['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::select('restaurant_id', $restaurant, null, ['class' => 'select2 form-control']) !!}
    <div class="form-text text-muted">{{ trans("lang.earning_restaurant_id_help") }}</div>
  </div>
</div>


<!-- Total Orders Field -->
<div class="form-group row ">
  {!! Form::label('total_orders', trans("lang.earning_total_orders"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::number('total_orders', null,  ['class' => 'form-control','placeholder'=>  trans("lang.earning_total_orders_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.earning_total_orders_help") }}
    </div>
  </div>
</div>

<!-- Total Earning Field -->
<div class="form-group row ">
  {!! Form::label('total_earning', trans("lang.earning_total_earning"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::number('total_earning', null,  ['class' => 'form-control','placeholder'=>  trans("lang.earning_total_earning_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.earning_total_earning_help") }}
    </div>
  </div>
</div>

<!-- Admin Earning Field -->
<div class="form-group row ">
  {!! Form::label('admin_earning', trans("lang.earning_admin_earning"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::number('admin_earning', null,  ['class' => 'form-control','placeholder'=>  trans("lang.earning_admin_earning_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.earning_admin_earning_help") }}
    </div>
  </div>
</div>
</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

<!-- Restaurant Earning Field -->
<div class="form-group row ">
  {!! Form::label('restaurant_earning', trans("lang.earning_restaurant_earning"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::number('restaurant_earning', null,  ['class' => 'form-control','placeholder'=>  trans("lang.earning_restaurant_earning_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.earning_restaurant_earning_help") }}
    </div>
  </div>
</div>

<!-- Delivery Fee Field -->
<div class="form-group row ">
  {!! Form::label('delivery_fee', trans("lang.earning_delivery_fee"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::number('delivery_fee', null,  ['class' => 'form-control','placeholder'=>  trans("lang.earning_delivery_fee_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.earning_delivery_fee_help") }}
    </div>
  </div>
</div>

<!-- Tax Field -->
<div class="form-group row ">
  {!! Form::label('tax', trans("lang.earning_tax"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::number('tax', null,  ['class' => 'form-control','placeholder'=>  trans("lang.earning_tax_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.earning_tax_help") }}
    </div>
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
  <button type="submit" class="btn btn-{{setting('theme_color')}}" ><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.earning')}}</button>
  <a href="{!! route('earnings.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
