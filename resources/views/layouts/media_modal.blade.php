<div id="mediaModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-stretch">
                <h5 class="modal-title flex-grow-1">{!! trans('lang.media_title') !!}</h5>
                <div style="width: 250px;" id="selectCollection" class="ml-auto mr-3">
                    <select name="collection_name" id="collection_name" class="form-control select2">
                    </select>
                </div>

                <div id="resizeItems" class="ml-auto btn-group">
                    <button type="button" data-size="2" class="btn btn-outline-secondary"><i class="fa fa-th"></i></button>
                    <button type="button" data-size="3" class="btn btn-primary"><i class="fa fa-th-large"></i></button>
                    <button type="button" data-size="4" class="btn btn-outline-secondary"><i class="fa fa-square"></i></button>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row medias-items">
                    <div class="card loader">
                        <div class="overlay">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <span>{!! trans('lang.media_hint') !!}</span>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{!! trans('lang.close') !!}</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/template" data-template="mediaitem">
        <div class="col-sm-3">
            <div class="card clickble">
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
        var triggerButton;
        var dropzoneIndex = '';

        /**
        * add selected media to dropzone
        */
        function initDropzone(index = '') {
            var dz = dropzoneFields[index][0];
            $('#mediaModal .card.clickble').on('click', function () {
                var img = $(this).find('.card-img');
                console.log(dz.mockFile);
                if (dz.mockFile !== '') {
                    dz.dropzone.removeFile(dz.mockFile);
                }
                var mockFile = {name: img.data('name'), size: img.data('size'), type: img.data('type'), upload: {uuid: img.data('uuid')}};
                dz.mockFile = mockFile;
                dz.dropzone.element.children[0].value = img.data('uuid');
                dz.dropzone.options.addedfile.call(dz.dropzone, mockFile);
                dz.dropzone.options.thumbnail.call(dz.dropzone, mockFile, img.attr('src'));
                dz.dropzone.previewsContainer.lastChild.classList.add('dz-success');
                dz.dropzone.previewsContainer.lastChild.classList.add('dz-complete');
                $('#mediaModal').modal('hide');
            });
        }

        function initSelectCollection(){
            var select = $('#selectCollection #collection_name');
            $.ajax({
                url: "{!! url('uploads/collectionsNames') !!}",
                type: 'GET',
                success: function (data, status) {
                    const collections = Object.keys(data.data).map(i => data.data[i])
                    collections.forEach(function (coll) {
                        if(coll.value === dropzoneIndex){
                            select.append('<option selected value="'+coll.value+'">'+coll.title+'</option>');
                            select.val(coll.value).trigger('change');
                        }else{
                            select.append('<option value="'+coll.value+'">'+coll.title+'</option>');
                        }
                    })
                }
            });
        }

        /**
         * resize buttons
         * */
        $('#mediaModal #resizeItems button').on('click',function () {
            $('#mediaModal #resizeItems button').attr('class','btn btn-outline-secondary');
            $(this).removeClass('btn-outline-secondary').addClass('btn-primary')
            var size = $(this).data('size');
            var mediaItems = $('#mediaModal .medias-items')
                .find('div[class^="col-sm"]')
                .removeAttr( "class" )
                .addClass('col-sm-'+size);
        });

        /**
         * load media with ajax
         */
        function loadMedia(url) {

            var itemTpl = $('script[data-template="mediaitem"]').text().split(/\$\{(.+?)\}/g);
            var items = [];
            var mediaItems = $('#mediaModal .medias-items');
            $.ajax({
                url: url,
                type: 'GET',
                success: function (data, status) {
                    if(status === 'success'){
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
                    }else{
                        mediaItems.find('.card.loader').html('Error please refresh page or use (Ctrl+F5)');
                    }
                },
                error : function(data, status, error){
                    mediaItems.find('.card.loader').html('Error please refresh page or use (Ctrl+F5)');
                },
                complete: function (data, status) {
                    if (status === 'success') {
                        mediaItems.html(items.map(function (item) {
                            return itemTpl.map(render(item)).join('');
                        }));
                        mediaItems.find('.card.loader').remove();
                        initDropzone(dropzoneIndex);
                    }else{
                        mediaItems.find('.card.loader').html('Error please refresh page or use (Ctrl+F5)');
                    }
                }
            });
        }
        $('#mediaModal').on('show.bs.modal',function (event) {
            triggerButton = $(event.relatedTarget) // Button that triggered the modal
            dropzoneIndex = triggerButton.data('dropzone'); // Extract info from data-* attributes
            loadMedia("{!! url('uploads/all') !!}/"+dropzoneIndex);
            initSelectCollection();
        });
        $('#selectCollection #collection_name').on('change',function () {
            loadMedia("{!! url('uploads/all') !!}/"+$(this).val());
        })
    </script>
@endpush