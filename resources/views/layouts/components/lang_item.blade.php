{{--$name = $filename.'|'.$key --}}
{{--$key = $key.'...' --}}
{{--$keyWithFileName = $filename.'.'.$key --}}

<div class="form-group row">
    {!! Form::label($name, $key,['class' => $item ?'col-4 control-label text-right':'col-4 control-label text-right text-danger']) !!}
    <div class="input-group input-group-sm col-8">
        {!! Form::text($name, $item,  ['class' => 'form-control','placeholder'=>  $keyWithFileName]) !!}
        <div class="input-group-append">
            <button class="btn btn-outline-danger delete-lang-item" type="button">{{__('lang.delete')}}</button>
        </div>
    </div>
    <div class="form-text offset-4 px-2 text-muted">
        {!! trans($keyWithFileName) !!}
    </div>
</div>