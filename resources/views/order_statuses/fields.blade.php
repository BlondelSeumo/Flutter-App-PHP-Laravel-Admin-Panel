@if($customFields)
<h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
<!-- Status Field -->
<div class="form-group row ">
  {!! Form::label('status', trans("lang.order_status_status"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::text('status', null,  ['class' => 'form-control','placeholder'=>  trans("lang.order_status_status_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.order_status_status_help") }}
    </div>
  </div>
</div>
</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
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
  <button type="submit" class="btn btn-{{setting('theme_color')}}" ><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.order_status')}}</button>
  <a href="{!! route('orderStatuses.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
