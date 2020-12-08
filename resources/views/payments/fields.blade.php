@if($customFields)
    <h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
    <!-- Price Field -->
    <div class="form-group row ">
        {!! Form::label('price', trans("lang.payment_price"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::number('price', null,  ['class' => 'form-control','placeholder'=>  trans("lang.payment_price_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_price_help") }}
            </div>
        </div>
    </div>
    <!-- User Id Field -->
    <div class="form-group row ">
        {!! Form::label('user_id', trans("lang.favorite_user_id"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('user_id', $user, null, ['class' => 'select2 form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.favorite_user_id_help") }}</div>
        </div>
    </div>

    <!-- Method Field -->
    <div class="form-group row ">
        {!! Form::label('method', trans("lang.payment_method"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('method', null,  ['class' => 'form-control','placeholder'=>  trans("lang.payment_method_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_method_help") }}
            </div>
        </div>
    </div>
    
</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

    <!-- Description Field -->
    <div class="form-group row ">
        {!! Form::label('description', trans("lang.payment_description"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('description', null,  ['class' => 'form-control','placeholder'=>  trans("lang.payment_description_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.payment_description_help") }}
            </div>
        </div>
    </div>

    <!-- Status Field -->
    <div class="form-group row ">
        {!! Form::label('status', trans("lang.payment_status"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('status',
            [
            'Waiting for Client' => 'Waiting for Client',
            'Not Paid' => trans('lang.order_not_paid'),
            'Paid' => trans('lang.order_paid'),
            ]
            , $payment->status, ['class' => 'select2 form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.payment_status_help") }}</div>
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
    <button type="submit" class="btn btn-{{setting('theme_color')}}"><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.payment')}}</button>
    <a href="{!! route('payments.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
