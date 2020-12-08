<!-- Id Field -->
<div class="form-group row col-6">
  {!! Form::label('id', 'Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $cart->id !!}</p>
  </div>
</div>

<!-- Food Id Field -->
<div class="form-group row col-6">
  {!! Form::label('food_id', 'Food Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $cart->food_id !!}</p>
  </div>
</div>

<!-- User Id Field -->
<div class="form-group row col-6">
  {!! Form::label('user_id', 'User Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $cart->user_id !!}</p>
  </div>
</div>

<!-- Extras Field -->
<div class="form-group row col-6">
  {!! Form::label('extras', 'Extras:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $cart->extras !!}</p>
  </div>
</div>

<!-- Quantity Field -->
<div class="form-group row col-6">
  {!! Form::label('quantity', 'Quantity:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $cart->quantity !!}</p>
  </div>
</div>

<!-- Created At Field -->
<div class="form-group row col-6">
  {!! Form::label('created_at', 'Created At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $cart->created_at !!}</p>
  </div>
</div>

<!-- Updated At Field -->
<div class="form-group row col-6">
  {!! Form::label('updated_at', 'Updated At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $cart->updated_at !!}</p>
  </div>
</div>

