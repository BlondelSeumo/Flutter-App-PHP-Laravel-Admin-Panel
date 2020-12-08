@if($customFields)
<h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
<!-- Question Field -->
<div class="form-group row ">
  {!! Form::label('question', trans("lang.faq_question"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::textarea('question', null, ['class' => 'form-control','placeholder'=>
     trans("lang.faq_question_placeholder")  ]) !!}
    <div class="form-text text-muted">{{ trans("lang.faq_question_help") }}</div>
  </div>
</div>

<!-- Answer Field -->
<div class="form-group row ">
  {!! Form::label('answer', trans("lang.faq_answer"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::textarea('answer', null, ['class' => 'form-control','placeholder'=>
     trans("lang.faq_answer_placeholder")  ]) !!}
    <div class="form-text text-muted">{{ trans("lang.faq_answer_help") }}</div>
  </div>
</div>
</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

<!-- Faq Category Id Field -->
<div class="form-group row ">
  {!! Form::label('faq_category_id', trans("lang.faq_faq_category_id"),['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::select('faq_category_id', $faqCategory, null, ['class' => 'select2 form-control']) !!}
    <div class="form-text text-muted">{{ trans("lang.faq_faq_category_id_help") }}</div>
  </div>
</div>

</div>
@if($customFields)
<div class="clearfix"></div>
<div class="col-12 custom-field-container">
  <h5 class="col-12 pb-4">{!! trans('lang.custom_field_plural') !!}</h5>
  {!! $customFields !!}
</div>
@endif
<!-- Submit Field -->
<div class="form-group col-12 text-right">
  <button type="submit" class="btn btn-{{setting('theme_color')}}" ><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.faq')}}</button>
  <a href="{!! route('faqs.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
