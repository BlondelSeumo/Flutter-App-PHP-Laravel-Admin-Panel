@extends('layouts.app')
@push('css_lib')
    <!-- select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
    {{--dropzone--}}
    <link rel="stylesheet" href="{{asset('plugins/dropzone/bootstrap.min.css')}}">
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{!! trans('lang.media_title') !!} <small>{{trans('lang.media_desc')}}</small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('lang.dashboard')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('lang.medias')}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="clearfix"></div>
        @include('flash::message')
        <div id="mediaModal" class="card">
            <div class="card-header">
                <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                    <li class="nav-item">
                        <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.media_table')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="createMedia"><i class="fa fa-plus mr-2"></i>{{trans('lang.media_create')}}</a>
                    </li>
                    <div class="ml-auto d-inline-flex">
                        <li class="nav-item">
                            <div style="width: 200px;" id="selectCollection" class="ml-auto pb-2 mx-2">
                                <select name="collection_name" id="collectionName" class="form-control-sm form-control select2"> </select>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pt-1 pb-35" data-size="150" href="#"><i class="fa fa-th"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pt-1 pb-35" data-size="200" href="#"><i class="fa fa-th-large"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pt-1 pb-35" data-size="300" href="#"><i class="fa fa-square"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pt-1 pb-35" id="refreshMedia" href="#"><i class="fa fa-refresh"></i> {{trans('lang.refresh')}}</a>
                        </li>

                    </div>
                </ul>
            </div>
            <div class="card-body">
                <!-- Preview Field -->
                <div id="createMediaField" class="row">
                    <div class="col-12">
                        <div style="width: 100%" class="dropzone default" id="default" data-field="default">
                            <input type="hidden" name="default">
                        </div>
                        <a href="#" id="doneMedia" class="btn btn-outline-{{setting('theme_color','primary')}} btn-sm float-right mt-1">{{ trans('lang.done')}}</a>
                        <div class="form-text text-muted">
                            {{ trans("lang.media_default_help") }}
                        </div>
                    </div>
                    <div class="clearfix my-5"></div>
                </div>
                <div class="row medias-items">
                    <div class="card loader">
                        <div class="overlay">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection
@push('scripts_lib')
    <!-- select2 -->
    <script src="{{asset('plugins/select2/select2.min.js')}}"></script>
    {{--dropzone--}}
    <script src="{{asset('plugins/dropzone/dropzone.js')}}"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
    </script>
@endpush

@prepend('scripts')
<script type="text/javascript">

    /**
     * show DropZone to upload media
     * when click on createMedia link on card header
     **/

    $('#mediaModal #createMedia').on('click', function (event) {
        event.preventDefault();
        $('#mediaModal #createMediaField').css('display', 'block');
        mediaDropZone[0].dropzone.options.init();
    });

    /**
     * close DropZone after upload media
     * when we click on done button
     **/
    $('#mediaModal #doneMedia').on('click', function (event) {
        event.preventDefault();
        $('#mediaModal #createMediaField').css('display', 'none');
        mediaDropZone[0].dropzone.options.init();
        $('#mediaModal #refreshMedia').trigger('click');
    });

    /**
     * dropzone to add media to default collection
     */
    var mediaDropZone = $(".dropzone.default").dropzone({
        url: "{!!url('uploads/store')!!}",
        addRemoveLinks: true,
        accept: function (file, done) {
            dzAccept(file, done, this.element, "{!!config('medialibrary.icons_folder')!!}");
        },
        sending: function (file, xhr, formData) {
            dzSending(this, file, formData, '{!! csrf_token() !!}');
        },
        complete: function (file) {
            $('#mediaModal #refreshMedia').trigger('click');
            if (file._removeLink) {
                file._removeLink.textContent = this.options.dictRemoveFile;
            }
            if (file.previewElement) {
                return file.previewElement.classList.add("dz-complete");
            }
        },
        removedfile: function (file) {
            var _this = $('.card.clickble').find('button[data-uuid="' + file.upload.uuid + '"]');
            $.post("{!! url('uploads/clear') !!}",
                {
                    _token: '{!! csrf_token() !!}',
                    uuid: file.upload.uuid,
                }, function (data) {
                    if (data && data.data === true) {
                        _this.parent('.card.clickble').parent('div.media-item').slideUp();
                        if (file.previewElement != null && file.previewElement.parentNode != null) {
                            file.previewElement.parentNode.removeChild(file.previewElement);
                        }
                    } else {
                        swal({title: "{{trans('lang.error')}}", confirmButtonText: "{{trans('lang.ok')}}",
                            text: data.message,type: "error", confirmButtonClass: "btn-danger"});
                    }
                }).fail(function () {
                swal({title: "{{trans('lang.error')}}", confirmButtonText: "{{trans('lang.ok')}}",
                    text: data.message,type: "error", confirmButtonClass: "btn-danger"});
            });
        }
    });
</script>
@endprepend


@push('scripts')
    <script type="text/template" data-template="mediaitem">
        <div class="media-item m-2">
            <div class="card clickble">
                <button data-uuid="${uuid}" class="btn btn-sm btn-danger delete-media"><i class="fa fa-remove"></i> Delete
                </button>
                <img class="card-img"
                     src="${src}"
                     data-name="${file_name}"
                     data-type="${mime_type}"
                     data-size="${size}"
                     data-uuid="${uuid}"
                     alt="Card image">
                <div class="card-footer">
                    <small>${name} (${formated_size})</small><br> <small class="text-muted">${updated_at}</small>
                </div>
            </div>
        </div>
    </script>

    <script type="text/javascript">

        /**
         * Initialize delete media buttons
         * and bind hover event to media thumbnails
         **/
        function initDeleteButtons() {
            $('#mediaModal .card.clickble .delete-media').on('click', function () {
                var _this = $(this);
                $.post("{!! url('uploads/clear') !!}",
                    {
                        _token: '{!! csrf_token() !!}',
                        uuid: $(this).data('uuid'),
                    }, function (data) {
                        if (data && data.data === true) {
                            _this.parent('.card.clickble').parent('div.media-item').slideUp();
                            console.log(mediaDropZone[0].dropzone.files);
                            mediaDropZone[0].dropzone.files.forEach(function (file) {
                                if (file.upload.uuid === _this.data('uuid')) {
                                    if (file.previewElement != null && file.previewElement.parentNode != null) {
                                        file.previewElement.parentNode.removeChild(file.previewElement);
                                    }
                                }
                            })
                        } else if(data){
                            swal({title: "{{trans('lang.error')}}", confirmButtonText: "{{trans('lang.ok')}}",
                                text: data.message,type: "error", confirmButtonClass: "btn-danger"});
                        }
                    }).fail(function () {
                    swal({title: "{{trans('lang.error')}}", confirmButtonText: "{{trans('lang.ok')}}",
                        text: data.message,type: "error", confirmButtonClass: "btn-danger"});
                });
            });
            $('#mediaModal .card.clickble').hover(function () {
                $('#mediaModal .card.clickble .delete-media').css('display', 'none');
                var btn = $(this).find('.delete-media');
                btn.css('display', 'block');
            });
        }

        /**
         * initialize collections filter
         * by default it select default collection
         **/
        function initSelectCollection() {
            var select = $('#selectCollection #collectionName');
            $.ajax({
                url: "{!! url('uploads/collectionsNames') !!}",
                type: 'GET',
                success: function (data, status) {
                    const collections = Object.keys(data.data).map(i => data.data[i])
                    collections.forEach(function (coll) {
                        select.append('<option value="' + coll.value + '">' + coll.title + '</option>');
                    })
                    select.val('default').trigger('change');
                }
            });
        }

        /**
         * resize thumbnails buttons
         * and store current size in local storage service
         * */
        $('#mediaModal li.nav-item a[data-size]').on('click', function () {
            $('#mediaModal li.nav-item a[data-size]').attr('class', 'nav-link pt-1 text-secondary pb-35');
            $(this).removeClass('text-secondary').addClass('active');
            var size = $(this).data('size');
            var mediaItems = $('#mediaModal .medias-items')
                .find('.media-item')
                .css('width', size + 'px');
            localStorage.setItem('smart_admin_media_size', size + '');
        });


        /**
         * load size of thumbnail from local storage
         * and initialize media thumbnails size
         *
         * called when all medias loaded successfully
         * */
        function initMediaItemsSize() {
            $('#mediaModal li.nav-item a[data-size]').attr('class', 'nav-link pt-1 text-secondary pb-35');
            if (typeof localStorage !== 'undefined') {
                var mediaSize = localStorage.getItem('smart_admin_media_size');
                if (mediaSize) {
                    $('#mediaModal li.nav-item a[data-size = "' + mediaSize + '"]').trigger('click');
                }
            }
        }

        /**
         * load media with ajax
         * and reset the thumbnails
         */
        function loadMedia(url) {

            var itemTpl = $('script[data-template="mediaitem"]').text().split(/\$\{(.+?)\}/g);
            var items = [];
            var mediaItems = $('#mediaModal .medias-items');
            $.ajax({
                url: url,
                type: 'GET',
                success: function (data, status) {
                    if (status === 'success') {
                        data = JSON.parse(data);
                        data.forEach(function (item) {
                            items.push({
                                src: item.thumb,
                                file_name: item.file_name,
                                mime_type: item.mime_type,
                                size: item.size,
                                formated_size: item.formated_size,
                                uuid: item.custom_properties.uuid,
                                name: item.name,
                                updated_at: item.updated_at,
                            });
                        });
                    } else {
                        mediaItems.find('.card.loader').html('Error please refresh page or use (Ctrl+F5)');
                    }
                },
                error: function (data, status, error) {
                    mediaItems.find('.card.loader').html('Error please refresh page or use (Ctrl+F5)');
                },
                complete: function (data, status) {
                    if (status === 'success') {
                        mediaItems.html(items.map(function (item) {
                            return itemTpl.map(render(item)).join('');
                        }));
                        mediaItems.find('.card.loader').remove();
                        initMediaItemsSize();
                        initDeleteButtons();
                    } else {
                        mediaItems.find('.card.loader').html('Error please refresh page or use (Ctrl+F5)');
                    }
                }
            });
        }

        /**
         * click to refresh media
         */
        $('#mediaModal #refreshMedia').on('click', function () {
            loadMedia("{!! url('uploads/all') !!}/default");
            initSelectCollection();
        });

        /**
         * load media when select collection changed
         */
        $('#selectCollection #collectionName').on('change', function () {
            loadMedia("{!! url('uploads/all') !!}/" + $(this).val());
        });

        $(document).ready(function () {
            $('#mediaModal #refreshMedia').trigger('click');
        });
    </script>
@endpush

