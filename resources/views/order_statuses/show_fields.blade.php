<!-- Id Field -->
<div class="form-group row col-6">
  {!! Form::label('id', 'Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $orderStatus->id !!}</p>
  </div>
</div>

<!-- Status Field -->
<div class="form-group row col-6">
  {!! Form::label('status', 'Status:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $orderStatus->status !!}</p>
  </div>
</div>

<!-- Created At Field -->
<div class="form-group row col-6">
  {!! Form::label('created_at', 'Created At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $orderStatus->created_at !!}</p>
  </div>
</div>

<!-- Updated At Field -->
<div class="form-group row col-6">
  {!! Form::label('updated_at', 'Updated At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $orderStatus->updated_at !!}</p>
  </div>
</div>

