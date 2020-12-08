<!-- Id Field -->
<div class="form-group row col-6">
  {!! Form::label('id', 'Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $coupon->id !!}</p>
  </div>
</div>

<!-- Code Field -->
<div class="form-group row col-6">
  {!! Form::label('code', 'Code:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $coupon->code !!}</p>
  </div>
</div>

<!-- Discount Field -->
<div class="form-group row col-6">
  {!! Form::label('discount', 'Discount:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $coupon->discount !!}</p>
  </div>
</div>

<!-- Discount Type Field -->
<div class="form-group row col-6">
  {!! Form::label('discount_type', 'Discount Type:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $coupon->discount_type !!}</p>
  </div>
</div>

<!-- Description Field -->
<div class="form-group row col-6">
  {!! Form::label('description', 'Description:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $coupon->description !!}</p>
  </div>
</div>

<!-- Food Id Field -->
<div class="form-group row col-6">
  {!! Form::label('food_id', 'Food Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $coupon->food_id !!}</p>
  </div>
</div>

<!-- Restaurant Id Field -->
<div class="form-group row col-6">
  {!! Form::label('restaurant_id', 'Restaurant Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $coupon->restaurant_id !!}</p>
  </div>
</div>

<!-- Category Id Field -->
<div class="form-group row col-6">
  {!! Form::label('category_id', 'Category Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $coupon->category_id !!}</p>
  </div>
</div>

<!-- Expires At Field -->
<div class="form-group row col-6">
  {!! Form::label('expires_at', 'Expires At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $coupon->expires_at !!}</p>
  </div>
</div>

<!-- Enabled Field -->
<div class="form-group row col-6">
  {!! Form::label('enabled', 'Enabled:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $coupon->enabled !!}</p>
  </div>
</div>

<!-- Created At Field -->
<div class="form-group row col-6">
  {!! Form::label('created_at', 'Created At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $coupon->created_at !!}</p>
  </div>
</div>

<!-- Updated At Field -->
<div class="form-group row col-6">
  {!! Form::label('updated_at', 'Updated At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $coupon->updated_at !!}</p>
  </div>
</div>

