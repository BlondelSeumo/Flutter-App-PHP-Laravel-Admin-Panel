<!-- Id Field -->
<div class="form-group row col-6">
  {!! Form::label('id', 'Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $notification->id !!}</p>
  </div>
</div>

<!-- Title Field -->
<div class="form-group row col-6">
  {!! Form::label('title', 'Title:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $notification->title !!}</p>
  </div>
</div>

<!-- Notification Type Id Field -->
<div class="form-group row col-6">
  {!! Form::label('notification_type_id', 'Notification Type Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $notification->notification_type_id !!}</p>
  </div>
</div>

<!-- User Id Field -->
<div class="form-group row col-6">
  {!! Form::label('user_id', 'User Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $notification->user_id !!}</p>
  </div>
</div>

<!-- Read Field -->
<div class="form-group row col-6">
  {!! Form::label('read', 'Read:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $notification->read !!}</p>
  </div>
</div>

<!-- Created At Field -->
<div class="form-group row col-6">
  {!! Form::label('created_at', 'Created At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $notification->created_at !!}</p>
  </div>
</div>

<!-- Updated At Field -->
<div class="form-group row col-6">
  {!! Form::label('updated_at', 'Updated At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $notification->updated_at !!}</p>
  </div>
</div>

