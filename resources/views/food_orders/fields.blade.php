@if($customFields)
<h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
<!-- Price Field -->
<div class="form-group row ">
  {!! Form::label('price', trans("lang.food_order_price"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::number('price', null,  ['class' => 'form-control','placeholder'=>  trans("lang.food_order_price_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.food_order_price_help") }}
    </div>
  </div>
</div>

<!-- Quantity Field -->
<div class="form-group row ">
  {!! Form::label('quantity', trans("lang.food_order_quantity"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::number('quantity', null,  ['class' => 'form-control','placeholder'=>  trans("lang.food_order_quantity_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.food_order_quantity_help") }}
    </div>
  </div>
</div>

<!-- Food Id Field -->
<div class="form-group row ">
  {!! Form::label('food_id', trans("lang.food_order_food_id"),['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::select('food_id', $food, null, ['class' => 'select2 form-control']) !!}
    <div class="form-text text-muted">{{ trans("lang.food_order_food_id_help") }}</div>
  </div>
</div>

</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

<!-- Extras Field -->
<div class="form-group row ">
  {!! Form::label('extras[]', trans("lang.food_order_extras"),['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::select('extras[]', $extra, $extrasSelected, ['class' => 'select2 form-control' , 'multiple'=>'multiple']) !!}
    <div class="form-text text-muted">{{ trans("lang.food_order_extras_help") }}</div>
  </div>
</div>


<!-- Order Id Field -->
<div class="form-group row ">
  {!! Form::label('order_id', trans("lang.food_order_order_id"),['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::select('order_id', $order, null, ['class' => 'select2 form-control']) !!}
    <div class="form-text text-muted">{{ trans("lang.food_order_order_id_help") }}</div>
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
  <button type="submit" class="btn btn-{{setting('theme_color')}}" ><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.food_order')}}</button>
  <a href="{!! route('foodOrders.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
