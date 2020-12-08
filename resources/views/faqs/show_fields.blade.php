<!-- Id Field -->
<div class="form-group row col-6">
  {!! Form::label('id', 'Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $faq->id !!}</p>
  </div>
</div>

<!-- Question Field -->
<div class="form-group row col-6">
  {!! Form::label('question', 'Question:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $faq->question !!}</p>
  </div>
</div>

<!-- Answer Field -->
<div class="form-group row col-6">
  {!! Form::label('answer', 'Answer:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $faq->answer !!}</p>
  </div>
</div>

<!-- Faq Category Id Field -->
<div class="form-group row col-6">
  {!! Form::label('faq_category_id', 'Faq Category Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $faq->faq_category_id !!}</p>
  </div>
</div>

<!-- Created At Field -->
<div class="form-group row col-6">
  {!! Form::label('created_at', 'Created At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $faq->created_at !!}</p>
  </div>
</div>

<!-- Updated At Field -->
<div class="form-group row col-6">
  {!! Form::label('updated_at', 'Updated At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $faq->updated_at !!}</p>
  </div>
</div>

