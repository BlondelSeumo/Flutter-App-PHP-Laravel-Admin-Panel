@extends('layouts.settings.default')
@push('css_lib')
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/iCheck/flat/blue.css')}}">
    <!-- select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@endpush
@section('settings_title',trans('lang.user_table'))
@section('settings_content')
    @include('flash::message')
    @include('adminlte-templates::common.errors')
    <div class="clearfix"></div>
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                @foreach($languages as $code => $language)
                    <li class="nav-item">
                        <a class="nav-link @if($tab === $code) active @endif" href="{!! url('settings/translation/'.$code) !!}"><i class="fa fa-language mr-2"></i>{{trans('lang.app_setting_'.$code)}}
                        </a>
                    </li>
                @endforeach
{{--                <div class="ml-auto d-inline-flex">--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link pt-1" href="{{url('settings/sync-translation')}}"><i class="fa fa-refresh"></i> {{trans('lang.sync_translation')}}--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </div>--}}
            </ul>
        </div>
        <div class="card-body">
            {!! Form::open(['url' => ['settings/translate'], 'method' => 'patch']) !!}
            {!! Form::hidden('_current_lang', $tab) !!}
            <div class="row">
                <div class="col-3 nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    @foreach($langFiles as $filename => $lang)
                        <a class="nav-link" id="v-pills-{{$filename}}-tab" data-toggle="pill" href="#v-pills-{{$filename}}" role="tab" aria-controls="v-pills-{{$filename}}">{{title_case($filename)}}</a>
                    @endforeach
                </div>
                <div class="col-9 tab-content" id="v-pills-tabContent">
                    {{--['user' => ['en' => 'user.php', 'nl' => 'user.php']]--}}
                    @foreach($langFiles as $filename => $lang)
                        <div class="tab-pane fade" id="v-pills-{{$filename}}" role="tabpanel" aria-labelledby="v-pills-{{$filename}}-tab">
                            @foreach(\Illuminate\Support\Facades\Lang::get($filename.'',[],$tab) as $key => $item)
                                @if(!is_array($item))
                                    @component('layouts.components.lang_item',[
                                    'item' => $item,
                                    'name' => $filename.'|'.$key,
                                    'key' => $key,
                                    'keyWithFileName' => $filename.'.'.$key])
                                    @endcomponent
                                @elseif(is_array($item))
                                    {{--lang item contains array value--}}
                                    @foreach($item as $childKey => $childItem)
                                        @if(!is_array($childItem))
                                            @component('layouts.components.lang_item',[
                                                'item' => $childItem,
                                                'name' => $filename.'|'.$key.'|'.$childKey,
                                                'key' => $key.'.'.$childKey,
                                                'keyWithFileName' => $filename.".".$key.".".$childKey])
                                            @endcomponent
                                        @elseif(is_array($childItem))
                                            @foreach($childItem as $childKey2 => $childItem2)
                                                @if(!is_array($childItem2))
                                                    @component('layouts.components.lang_item',[
                                                        'item' => $childItem2,
                                                        'name' => $filename.'|'.$key.'|'.$childKey.'|'.$childKey2,
                                                        'key' => $key.'.'.$childKey.'.'.$childKey2,
                                                        'keyWithFileName' => $filename.".".$key.".".$childKey.".".$childKey2])
                                                    @endcomponent
                                                @elseif(is_array($childItem2))
                                                    @foreach($childItem2 as $childKey3 => $childItem3)
                                                        @if(!is_array($childItem3))
                                                            @component('layouts.components.lang_item',[
                                                                'item' => $childItem3,
                                                                'name' => $filename.'|'.$key.'|'.$childKey.'|'.$childKey2.'|'.$childKey3,
                                                                'key' => $key.'.'.$childKey.'.'.$childKey2.'.'.$childKey3,
                                                                'keyWithFileName' => $filename.".".$key.".".$childKey.".".$childKey2.".".$childKey3])
                                                            @endcomponent
                                                        @elseif(is_array($childItem3))
                                                            @foreach($childItem3 as $childKey4 => $childItem4)
                                                                @if(!is_array($childItem4))
                                                                    @component('layouts.components.lang_item',[
                                                                        'item' => $childItem4,
                                                                        'name' => $filename.'|'.$key.'|'.$childKey.'|'.$childKey2.'|'.$childKey3.'|'.$childKey4,
                                                                        'key' => $key.'.'.$childKey.'.'.$childKey2.'.'.$childKey3.'.'.$childKey4,
                                                                        'keyWithFileName' => $filename.".".$key.".".$childKey.".".$childKey2.".".$childKey3.".".$childKey4])
                                                                    @endcomponent
                                                                @elseif(is_array($childItem4))
                                                                    @foreach($childItem4 as $childKey5 => $childItem5)
                                                                        @if(!is_array($childItem5))
                                                                            @component('layouts.components.lang_item',[
                                                                                'item' => $childItem5,
                                                                                'name' => $filename.'|'.$key.'|'.$childKey.'|'.$childKey2.'|'.$childKey3.'|'.$childKey4.'|'.$childKey5,
                                                                                'key' => $key.'.'.$childKey.'.'.$childKey2.'.'.$childKey3.'.'.$childKey4.'.'.$childKey5,
                                                                                'keyWithFileName' => $filename.".".$key.".".$childKey.".".$childKey2.".".$childKey3.".".$childKey4.".".$childKey5])
                                                                            @endcomponent
                                                                        @elseif(is_array($childItem5))
                                                                            @foreach($childItem5 as $childKey6 => $childItem6)
                                                                                @if(!is_array($childItem6))
                                                                                    @component('layouts.components.lang_item',[
                                                                                        'item' => $childItem6,
                                                                                        'name' => $filename.'|'.$key.'|'.$childKey.'|'.$childKey2.'|'.$childKey3.'|'.$childKey4.'|'.$childKey5.'|'.$childKey6,
                                                                                        'key' => $key.'.'.$childKey.'.'.$childKey2.'.'.$childKey3.'.'.$childKey4.'.'.$childKey5.'.'.$childKey6,
                                                                                        'keyWithFileName' => $filename.".".$key.".".$childKey.".".$childKey2.".".$childKey3.".".$childKey4.".".$childKey5.".".$childKey6])
                                                                                    @endcomponent
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                            <div class="form-group row new-trans">
                                <div class="col-4">
                                    {!! Form::text('new_key', null,  ['data-file'=>$filename,'class' => 'form-control form-control-sm new-key','placeholder'=> trans('lang.new_lang_key')]) !!}
                                </div>
                                <div class="input-group input-group-sm col-8">
                                    {!! Form::text('new_value', null,  ['data-file'=>$filename, 'class' => 'form-control new-value','placeholder'=> trans('lang.new_lang_value')]) !!}
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-success add-lang-item" type="button">{{__('lang.add')}}</button>
                                    </div>
                                </div>
                                <div class="form-text offset-4 px-2 text-muted">
                                    {{trans('lang.new_lang_value')}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Submit Field -->
                <div class="form-group mt-4 col-12 text-right">
                    <button type="submit" class="btn btn-{{setting('theme_color')}}">
                        <i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.app_setting_translation')}}</button>
                    <a href="{!! route('users.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
                </div>
            </div>
            {!! Form::close() !!}
            <div class="clearfix"></div>
        </div>
    </div>
    </div>
    @include('layouts.media_modal',['collection'=>null])
@endsection
@push('scripts_lib')
    <!-- iCheck -->
    <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
    <!-- select2 -->
    <script src="{{asset('plugins/select2/select2.min.js')}}"></script>
@endpush
@push('scripts')
    <script type="text/javascript">

        /**
         * Select the first tab when all the page loaded
         */
        $('#v-pills-tab a:first-child').tab("show")

        /**
         * change the name attr by the value
         */
        $(".new-trans .new-key").keyup(function (event) {
            var keyInput = $(this).val();
            var valueInput = $(this).parents(".new-trans").find(".new-value");
            keyInput = keyInput.replace(/[^\w\.]/gi, '');
            if (keyInput.split('.').length > 3) {
                keyInput = keyInput.replace(/\./g, '_');
            } else {
                keyInput = keyInput.replace(/\./g, '|');
            }
            // TODO Validate keyInput
            keyInput = valueInput.data('file') + '|' + keyInput.trim();
            valueInput.attr("name", keyInput);
        });

        /**
         * delete lang item
         */
        $('.delete-lang-item').on('click', function () {
            // TODO Replace with pretty alert
            if (confirm("{{trans('lang.confirm_delete_message')}}")) {
                $(this).parents('div.form-group.row').slideUp().remove();
            }
        });

        // /**
        //  * */
        // $(document).ready(function () {
        //     var label = $('div.form-group.row label');
        //     console.log(label);
        //     if(label.parent('.form-group.row').find('.input-group input').val() === ''){
        //         label.addClass('text-danger');
        //     }
        // })

        /**
         * add new lang item
         */
        $('.add-lang-item').on('click', function () {
            var newTrans = $(this).parents('div.new-trans');
            var name = newTrans.find('input.new-value').attr('name');
            var value = newTrans.find('input.new-value').val();
            var key = newTrans.find('input.new-key').val();
            var langItemTmpl =
                `<div class="form-group row">
                <label for="${name}" class="col-4 control-label text-right">${key}</label>
                <div class="input-group input-group-sm col-8">
                    <input class="form-control" placeholder="${key}" name="${name}" type="text" value="${value}" id="${name}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-danger delete-lang-item" type="button">{{trans('lang.delete')}}</button>
                    </div>
                </div>
                <div class="form-text offset-4 px-2 text-muted">
                    ${value}
                </div>
            </div>`;
            var added = newTrans.before(langItemTmpl);
            newTrans.find('input.new-value').removeAttr('name');
            newTrans.find('input.new-value').val(null);
            newTrans.find('input.new-key').val(null);
            if (added) {
                $('.delete-lang-item').on('click', function () {
                    // TODO Replace with pretty alert
                    if (confirm("{{trans('lang.confirm_delete_message')}}")) {
                        $(this).parents('div.form-group.row').slideUp().remove();
                    }
                });
            }
        });

    </script>
@endpush

