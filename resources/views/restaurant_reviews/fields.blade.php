@if($customFields)
<h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
<!-- Review Field -->
<div class="form-group row ">
  {!! Form::label('review', trans("lang.restaurant_review_review"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::textarea('review', null, ['class' => 'form-control','placeholder'=>
     trans("lang.restaurant_review_review_placeholder")  ]) !!}
    <div class="form-text text-muted">{{ trans("lang.restaurant_review_review_help") }}</div>
  </div>
</div>

<!-- Rate Field -->
<div class="form-group row ">
  {!! Form::label('rate', trans("lang.restaurant_review_rate"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::number('rate', null,  ['class' => 'form-control','placeholder'=>  trans("lang.restaurant_review_rate_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.restaurant_review_rate_help") }}
    </div>
  </div>
</div>
</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

<!-- User Id Field -->
<div class="form-group row ">
  {!! Form::label('user_id', trans("lang.restaurant_review_user_id"),['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::select('user_id', $user, null, ['class' => 'select2 form-control']) !!}
    <div class="form-text text-muted">{{ trans("lang.restaurant_review_user_id_help") }}</div>
  </div>
</div>


<!-- Restaurant Id Field -->
<div class="form-group row ">
  {!! Form::label('restaurant_id', trans("lang.restaurant_review_restaurant_id"),['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::select('restaurant_id', $restaurant, null, ['class' => 'select2 form-control']) !!}
    <div class="form-text text-muted">{{ trans("lang.restaurant_review_restaurant_id_help") }}</div>
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
  <button type="submit" class="btn btn-{{setting('theme_color')}}" ><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.restaurant_review')}}</button>
  <a href="{!! route('restaurantReviews.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
