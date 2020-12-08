<!-- Id Field -->
<div class="form-group row col-6">
  {!! Form::label('id', 'Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $food->id !!}</p>
  </div>
</div>

<!-- Name Field -->
<div class="form-group row col-6">
  {!! Form::label('name', 'Name:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $food->name !!}</p>
  </div>
</div>

<!-- Image Field -->
<div class="form-group row col-6">
  {!! Form::label('image', 'Image:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $food->image !!}</p>
  </div>
</div>

<!-- Price Field -->
<div class="form-group row col-6">
  {!! Form::label('price', 'Price:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $food->price !!}</p>
  </div>
</div>

<!-- Discount Price Field -->
<div class="form-group row col-6">
  {!! Form::label('discount_price', 'Discount Price:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $food->discount_price !!}</p>
  </div>
</div>

<!-- Description Field -->
<div class="form-group row col-6">
  {!! Form::label('description', 'Description:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $food->description !!}</p>
  </div>
</div>

<!-- Ingredients Field -->
<div class="form-group row col-6">
  {!! Form::label('ingredients', 'Ingredients:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $food->ingredients !!}</p>
  </div>
</div>

<!-- Weight Field -->
<div class="form-group row col-6">
  {!! Form::label('weight', 'Weight:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $food->weight !!}</p>
  </div>
</div>

<!-- Featured Field -->
<div class="form-group row col-6">
  {!! Form::label('featured', 'Featured:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $food->featured !!}</p>
  </div>
</div>

<!-- Restaurant Id Field -->
<div class="form-group row col-6">
  {!! Form::label('restaurant_id', 'Restaurant Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $food->restaurant_id !!}</p>
  </div>
</div>

<!-- Category Id Field -->
<div class="form-group row col-6">
  {!! Form::label('category_id', 'Category Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $food->category_id !!}</p>
  </div>
</div>

<!-- Created At Field -->
<div class="form-group row col-6">
  {!! Form::label('created_at', 'Created At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $food->created_at !!}</p>
  </div>
</div>

<!-- Updated At Field -->
<div class="form-group row col-6">
  {!! Form::label('updated_at', 'Updated At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $food->updated_at !!}</p>
  </div>
</div>

