<!-- Id Field -->
<div class="form-group row col-6">
  {!! Form::label('id', 'Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $restaurantsPayout->id !!}</p>
  </div>
</div>

<!-- Restaurant Id Field -->
<div class="form-group row col-6">
  {!! Form::label('restaurant_id', 'Restaurant Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $restaurantsPayout->restaurant_id !!}</p>
  </div>
</div>

<!-- Method Field -->
<div class="form-group row col-6">
  {!! Form::label('method', 'Method:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $restaurantsPayout->method !!}</p>
  </div>
</div>

<!-- Amount Field -->
<div class="form-group row col-6">
  {!! Form::label('amount', 'Amount:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $restaurantsPayout->amount !!}</p>
  </div>
</div>

<!-- Paid Date Field -->
<div class="form-group row col-6">
  {!! Form::label('paid_date', 'Paid Date:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $restaurantsPayout->paid_date !!}</p>
  </div>
</div>

<!-- Note Field -->
<div class="form-group row col-6">
  {!! Form::label('note', 'Note:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $restaurantsPayout->note !!}</p>
  </div>
</div>

<!-- Created At Field -->
<div class="form-group row col-6">
  {!! Form::label('created_at', 'Created At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $restaurantsPayout->created_at !!}</p>
  </div>
</div>

<!-- Updated At Field -->
<div class="form-group row col-6">
  {!! Form::label('updated_at', 'Updated At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $restaurantsPayout->updated_at !!}</p>
  </div>
</div>

