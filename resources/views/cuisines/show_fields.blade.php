<!-- Id Cuisine -->
<div class="form-group row col-6">
  {!! Form::label('id', 'Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $cuisine->id !!}</p>
  </div>
</div>

<!-- Name Cuisine -->
<div class="form-group row col-6">
  {!! Form::label('name', 'Name:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $cuisine->name !!}</p>
  </div>
</div>

<!-- Description Cuisine -->
<div class="form-group row col-6">
  {!! Form::label('description', 'Description:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $cuisine->description !!}</p>
  </div>
</div>

<!-- Image Cuisine -->
<div class="form-group row col-6">
  {!! Form::label('image', 'Image:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $cuisine->image !!}</p>
  </div>
</div>

<!-- Restaurants Cuisine -->
<div class="form-group row col-6">
  {!! Form::label('restaurants', 'Restaurants:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $cuisine->restaurants !!}</p>
  </div>
</div>

<!-- Created At Cuisine -->
<div class="form-group row col-6">
  {!! Form::label('created_at', 'Created At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $cuisine->created_at !!}</p>
  </div>
</div>

<!-- Updated At Cuisine -->
<div class="form-group row col-6">
  {!! Form::label('updated_at', 'Updated At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $cuisine->updated_at !!}</p>
  </div>
</div>

