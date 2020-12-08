<!-- Id Field -->
<div class="form-group row col-6">
  {!! Form::label('id', 'Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $foodReview->id !!}</p>
  </div>
</div>

<!-- Review Field -->
<div class="form-group row col-6">
  {!! Form::label('review', 'Review:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $foodReview->review !!}</p>
  </div>
</div>

<!-- Rate Field -->
<div class="form-group row col-6">
  {!! Form::label('rate', 'Rate:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $foodReview->rate !!}</p>
  </div>
</div>

<!-- User Id Field -->
<div class="form-group row col-6">
  {!! Form::label('user_id', 'User Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $foodReview->user_id !!}</p>
  </div>
</div>

<!-- Food Id Field -->
<div class="form-group row col-6">
  {!! Form::label('food_id', 'Food Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $foodReview->food_id !!}</p>
  </div>
</div>

<!-- Created At Field -->
<div class="form-group row col-6">
  {!! Form::label('created_at', 'Created At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $foodReview->created_at !!}</p>
  </div>
</div>

<!-- Updated At Field -->
<div class="form-group row col-6">
  {!! Form::label('updated_at', 'Updated At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $foodReview->updated_at !!}</p>
  </div>
</div>

