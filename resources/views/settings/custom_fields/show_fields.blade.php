<!-- Id Field -->
<div class="form-group row col-6">
  {!! Form::label('id', 'Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $customField->id !!}</p>
  </div>
</div>

<!-- Name Field -->
<div class="form-group row col-6">
  {!! Form::label('name', 'Name:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $customField->name !!}</p>
  </div>
</div>

<!-- Type Field -->
<div class="form-group row col-6">
  {!! Form::label('type', 'Type:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $customField->type !!}</p>
  </div>
</div>

<!-- Disabled Field -->
<div class="form-group row col-6">
  {!! Form::label('disabled', 'Disabled:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $customField->disabled !!}</p>
  </div>
</div>

<!-- Required Field -->
<div class="form-group row col-6">
  {!! Form::label('required', 'Required:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $customField->required !!}</p>
  </div>
</div>

<!-- In Table Field -->
<div class="form-group row col-6">
  {!! Form::label('in_table', 'In Table:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $customField->in_table !!}</p>
  </div>
</div>

<!-- Bootstrap Column Field -->
<div class="form-group row col-6">
  {!! Form::label('bootstrap_column', 'Bootstrap Column:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $customField->bootstrap_column !!}</p>
  </div>
</div>

<!-- Order Field -->
<div class="form-group row col-6">
  {!! Form::label('order', 'Order:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $customField->order !!}</p>
  </div>
</div>

<!-- Custom Field Model Field -->
<div class="form-group row col-6">
  {!! Form::label('custom_field_model', 'Custom Field Model:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $customField->custom_field_model !!}</p>
  </div>
</div>

<!-- Created At Field -->
<div class="form-group row col-6">
  {!! Form::label('created_at', 'Created At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $customField->created_at !!}</p>
  </div>
</div>

<!-- Updated At Field -->
<div class="form-group row col-6">
  {!! Form::label('updated_at', 'Updated At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $customField->updated_at !!}</p>
  </div>
</div>

