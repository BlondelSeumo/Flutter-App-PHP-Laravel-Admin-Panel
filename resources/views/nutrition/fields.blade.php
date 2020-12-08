@if($customFields)
<h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
<!-- Name Field -->
<div class="form-group row ">
  {!! Form::label('name', trans("lang.nutrition_name"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('name', null,  ['class' => 'form-control','placeholder'=>  trans("lang.nutrition_name_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.nutrition_name_help") }}
    </div>
  </div>
</div>

<!-- Quantity Field -->
<div class="form-group row ">
  {!! Form::label('quantity', trans("lang.nutrition_quantity"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::number('quantity', null,  ['class' => 'form-control','placeholder'=>  trans("lang.nutrition_quantity_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.nutrition_quantity_help") }}
    </div>
  </div>
</div>
</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

<!-- Food Id Field -->
<div class="form-group row ">
  {!! Form::label('food_id', trans("lang.nutrition_food_id"),['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::select('food_id', $food, null, ['class' => 'select2 form-control']) !!}
    <div class="form-text text-muted">{{ trans("lang.nutrition_food_id_help") }}</div>
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
  <button type="submit" class="btn btn-{{setting('theme_color')}}" ><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.nutrition')}}</button>
  <a href="{!! route('nutrition.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
