<!-- Id Field -->
<div class="form-group row col-6">
  {!! Form::label('id', 'Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $driver->id !!}</p>
  </div>
</div>

<!-- User Id Field -->
<div class="form-group row col-6">
  {!! Form::label('user_id', 'User Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $driver->user_id !!}</p>
  </div>
</div>

<!-- Delivery Fee Field -->
<div class="form-group row col-6">
  {!! Form::label('delivery_fee', 'Delivery Fee:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $driver->delivery_fee !!}</p>
  </div>
</div>

<!-- Total Orders Field -->
<div class="form-group row col-6">
  {!! Form::label('total_orders', 'Total Orders:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $driver->total_orders !!}</p>
  </div>
</div>

<!-- Earning Field -->
<div class="form-group row col-6">
  {!! Form::label('earning', 'Earning:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $driver->earning !!}</p>
  </div>
</div>

<!-- Available Field -->
<div class="form-group row col-6">
  {!! Form::label('available', 'Available:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $driver->available !!}</p>
  </div>
</div>

<!-- Created At Field -->
<div class="form-group row col-6">
  {!! Form::label('created_at', 'Created At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $driver->created_at !!}</p>
  </div>
</div>

<!-- Updated At Field -->
<div class="form-group row col-6">
  {!! Form::label('updated_at', 'Updated At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $driver->updated_at !!}</p>
  </div>
</div>

