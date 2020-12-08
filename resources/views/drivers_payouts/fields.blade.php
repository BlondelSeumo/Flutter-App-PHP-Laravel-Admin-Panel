@if($customFields)
<h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
<!-- User Id Field -->
<div class="form-group row ">
  {!! Form::label('user_id', trans("lang.drivers_payout_user_id"),['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::select('user_id', $user, null, ['class' => 'select2 form-control']) !!}
    <div class="form-text text-muted">{{ trans("lang.drivers_payout_user_id_help") }}</div>
  </div>
</div>


<!-- Method Field -->
<div class="form-group row ">
  {!! Form::label('method', trans("lang.drivers_payout_method"),['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::select('method', ['bank' => 'Bank'], null, ['class' => 'select2 form-control']) !!}
    <div class="form-text text-muted">{{ trans("lang.drivers_payout_method_help") }}</div>
  </div>
</div>


<!-- Amount Field -->
<div class="form-group row ">
  {!! Form::label('amount', trans("lang.drivers_payout_amount"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::number('amount', null,  ['class' => 'form-control','placeholder'=>  trans("lang.drivers_payout_amount_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.drivers_payout_amount_help") }}
    </div>
  </div>
</div>
</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

<!-- Note Field -->
<div class="form-group row ">
  {!! Form::label('note', trans("lang.drivers_payout_note"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::textarea('note', null, ['class' => 'form-control','placeholder'=>
     trans("lang.drivers_payout_note_placeholder")  ]) !!}
    <div class="form-text text-muted">{{ trans("lang.drivers_payout_note_help") }}</div>
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
  <button type="submit" class="btn btn-{{setting('theme_color')}}" ><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.drivers_payout')}}</button>
  <a href="{!! route('driversPayouts.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
