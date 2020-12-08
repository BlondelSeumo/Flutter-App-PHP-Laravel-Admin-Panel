<!-- Id Field -->
<div class="form-group row col-6">
  {!! Form::label('id', 'Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->id !!}</p>
  </div>
</div>

<!-- Description Field -->
<div class="form-group row col-6">
  {!! Form::label('description', 'Description:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->description !!}</p>
  </div>
</div>

<!-- Address Field -->
<div class="form-group row col-6">
  {!! Form::label('address', 'Address:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->address !!}</p>
  </div>
</div>

<!-- Latitude Field -->
<div class="form-group row col-6">
  {!! Form::label('latitude', 'Latitude:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->latitude !!}</p>
  </div>
</div>

<!-- Longitude Field -->
<div class="form-group row col-6">
  {!! Form::label('longitude', 'Longitude:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->longitude !!}</p>
  </div>
</div>

<!-- Is Default Field -->
<div class="form-group row col-6">
  {!! Form::label('is_default', 'Is Default:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->is_default !!}</p>
  </div>
</div>

<!-- User Id Field -->
<div class="form-group row col-6">
  {!! Form::label('user_id', 'User Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->user_id !!}</p>
  </div>
</div>

<!-- Created At Field -->
<div class="form-group row col-6">
  {!! Form::label('created_at', 'Created At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->created_at !!}</p>
  </div>
</div>

<!-- Updated At Field -->
<div class="form-group row col-6">
  {!! Form::label('updated_at', 'Updated At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $deliveryAddress->updated_at !!}</p>
  </div>
</div>

