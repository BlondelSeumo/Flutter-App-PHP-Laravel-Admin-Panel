<!-- Id Field -->
<div class="form-group row col-6">
  {!! Form::label('id', 'Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $currency->id !!}</p>
  </div>
</div>

<!-- Name Field -->
<div class="form-group row col-6">
  {!! Form::label('name', 'Name:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $currency->name !!}</p>
  </div>
</div>

<!-- Symbol Field -->
<div class="form-group row col-6">
  {!! Form::label('symbol', 'Symbol:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $currency->symbol !!}</p>
  </div>
</div>

<!-- Code Field -->
<div class="form-group row col-6">
  {!! Form::label('code', 'Code:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $currency->code !!}</p>
  </div>
</div>

<!-- Decimal Digits Field -->
<div class="form-group row col-6">
  {!! Form::label('decimal_digits', 'Decimal Digits:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $currency->decimal_digits !!}</p>
  </div>
</div>

<!-- Rounding Field -->
<div class="form-group row col-6">
  {!! Form::label('rounding', 'Rounding:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $currency->rounding !!}</p>
  </div>
</div>

<!-- Created At Field -->
<div class="form-group row col-6">
  {!! Form::label('created_at', 'Created At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $currency->created_at !!}</p>
  </div>
</div>

<!-- Updated At Field -->
<div class="form-group row col-6">
  {!! Form::label('updated_at', 'Updated At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $currency->updated_at !!}</p>
  </div>
</div>

