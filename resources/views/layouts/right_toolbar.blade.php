<div class="ml-auto d-inline-flex">
    <li class="nav-item dropdown">
        <a class="nav-link  dropdown-toggle pt-1" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-save"></i> {{trans('lang.export')}}
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" id="exportCsvDatatable" href="#"> <i class="fa fa-file-excel-o mr-2"></i>CSV</a>
            <a class="dropdown-item" id="exportExcelDatatable" href="#"> <i class="fa fa-file-excel-o mr-2"></i>Excel</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" id="exportPdfDatatable" href="#"> <i class="fa fa-file-pdf-o mr-2"></i>PDF</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link pt-1" id="refreshDatatable" href="#"><i class="fa fa-refresh"></i> {{trans('lang.refresh')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link pt-1" id="printDatatable" href="#"><i class="fa fa-print"></i> {{trans('lang.print')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link pt-1" id="resetDatatable" href="#"><i class="fa fa-undo"></i> {{trans('lang.reset')}}</a>
    </li>
    <li id="colVisDatatable" class="nav-item dropdown keepopen">
        <a class="nav-link dropdown-toggle pt-1" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-eye"></i> {{trans('lang.columns')}}
        </a>
        <div class="dropdown-menu">
            @foreach($dataTable->collection as $key => $item)
                <a class="dropdown-item text-bold" href="#" data-column="{{$key}}"> <i class="fa fa-check mr-2"></i>{{$item->title}}</a>
            @endforeach
        </div>
    </li>
    {{--@if(!isset($filtered))--}}
    {{--<li class="nav-item">--}}
        {{--<div style="min-width: 200px;" id="filter" class="ml-auto pb-2 mx-2">--}}
            {{--<select name="collection_name" id="selectFilter" multiple="true" data-closeOnSelect="false" class="form-control-sm form-control select2">--}}
                {{--@foreach($filtered as $key => $item)--}}
                    {{--<optgroup label="{{trans('lang.glass_'.$key)}}">--}}
                        {{--@foreach($item as $key2 => $item2)--}}
                            {{--<option label="{{$key2}}"--}}
                                    {{--@if(request($key, null) === $item2."")--}}
                                    {{--selected="true"--}}
                                    {{--@endif--}}
                                    {{--data-key='{{$key}}' value="{{$item2}}">{{$item2}}</option>--}}
                        {{--@endforeach--}}
                    {{--</optgroup>--}}
                {{--@endforeach--}}
            {{--</select>--}}
        {{--</div>--}}
    {{--</li>--}}
        {{--@endif--}}

        {{--<li class="nav-item">--}}
            {{--<div style="min-width: 200px;" id="filter" class="ml-auto pb-2 mx-2">--}}
                {{--<select name="collection_name" id="selectFilter" multiple="true" data-closeOnSelect="false" class="form-control-sm form-control">--}}
                {{--</select>--}}
            {{--</div>--}}
        {{--</li>--}}

</div>

@push('scripts')
    <script type="text/javascript">
        /**
         * load media when select collection changed
         */
        var params = [];
        var objParams = {};

        /**
         * initialise objParams with existing parameters in the url
         * @type {string}
         */
        {{--@if(isset($filtered))--}}
        {{--@foreach($filtered as $key => $item) @foreach($item as $key2 => $item2) @if(request($key, null) === $item2."")params[ '{{$key}}' ] = '{{$item2}}' ;@endif @endforeach @endforeach @endif--}}
            objParams = $.extend({}, params);
            objParams = $.param(objParams);

        $('#filter #selectFilter').on('select2:select', function (e) {
            $(e.params.data.element).parent('optgroup').children().each(function (element) {
                $(this)[0].selected = false;
            });
            $(e.params.data.element)[0].selected = true;

            $(this).trigger('change');
            params[$(e.params.data.element).data('key')] = $(e.params.data.element).attr('value');
            objParams = $.extend({}, params);
            objParams = $.param(objParams);
        });

        $('#filter #selectFilter').on('select2:unselect', function (e) {
            params[$(e.params.data.element).data('key')] = undefined;
            objParams = $.extend({}, params);
            objParams = $.param(objParams);
        });

        $('#filter #selectFilter').on("select2:closing", function (e) {
            window.location.href = window.location.href.split('?')[0] + "?" + objParams;
        });

        /**
         * initialize collections filter
         * by default it select default collection
         **/
        {{--function initFilterSelect2() {--}}
            {{--var select = $('#filter #selectFilter').select2({--}}
                {{--ajax: {--}}
                    {{--url: "{!! route('glasses.filter') !!}",--}}
                    {{--dataType: 'json',--}}
                    {{--processResults: function (result) {--}}
                        {{--return {--}}
                            {{--results: result.data--}}
                        {{--};--}}
                    {{--}--}}
                {{--}--}}
            {{--});--}}
            {{--$.ajax({--}}
                {{--url: "{!! url('glasses/filter') !!}",--}}
                {{--type: 'GET',--}}
                {{--success: function (data, status) {--}}
                    {{--const collections = Object.keys(data.data).map(i => data.data[i])--}}
                    {{--collections.forEach(function (coll) {--}}
                        {{--select.append('<option value="' + coll.value + '">' + coll.title + '</option>');--}}
                    {{--})--}}
                    {{--select.val('default').trigger('change');--}}
                {{--}--}}
            {{--});--}}
    {{--} --}}
    // initFilterSelect2();
</script>
@endpush