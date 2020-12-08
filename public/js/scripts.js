/*
 * File name: scripts.js
 * Last modified: 2020.04.30 at 08:21:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

$(document).ready(function () {
    let select2;
    let options;
    if ($('.icheck input').length > 0) {
        $('.icheck input').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue',
            increaseArea: '20%' // optional
        });
    }
    if ($('textarea').length > 0) {
        $('textarea').summernote({
            height: 200
        });
    }
    if ($('.datepicker').length > 0) {
        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            maxViewMode: 2,
            todayHighlight: true
        });
    }
    if ($('select.select2').length > 0) {
        options = {};
        select2 = $('select.select2');

        if(select2.data('tags')){
            options.tags = select2.data('tags');
        }
        select2.select2(options);
    }
    if ($('select.select2.not-required').length > 0) {
        options = {};
        select2 = $('select.select2.not-required');
        $.each(select2, function (i, element) {
            options.placeholder = $(element).data('empty');
            options.allowClear = true;
            $(element).select2(options);
            options = {};
        });
    }

    $('[data-toggle=tooltip]').tooltip();

    $('.main-sidebar .sidebar').slimScroll({
        position: 'right',
        height: '92vh',
        color: '#fff',
        railVisible: true,
    });
})

function render(props) {
    return function (tok, i) {
        return (i % 2) ? props[tok] : tok;
    };
}

function dzComplete(_this, file, mockFile = '', mediaMockFile = '') {
    if (mockFile !== '') {
        _this.removeFile(mockFile);
        mockFile = '';
    }
    if (mediaMockFile !== '' && _this.element.id === mediaMockFile.collection_name) {
        _this.removeFile(mediaMockFile);
        mediaMockFile = '';
    }
    if (file._removeLink) {
        file._removeLink.textContent = _this.options.dictRemoveFile;
    }
    if (file.previewElement) {
        return file.previewElement.classList.add("dz-complete");
    }
}

function dzRemoveFile(file, mockFile = '', existRemoveUrl = '', collection, modelId, newRemoveUrl, csrf) {
    if (file.previewElement != null && file.previewElement.parentNode != null) {
        file.previewElement.parentNode.removeChild(file.previewElement);
    }
    //if(file.status === 'success'){
    if (mockFile !== '') {
        mockFile = '';
        $.post(existRemoveUrl,
            {
                _token: csrf,
                id: modelId,
                collection: collection,
            });
    } /*else {
        $.post(newRemoveUrl,
            {
                _token: csrf,
                uuid: file.upload.uuid
            });
    }*/
    //}
}

function dzSending(_this, file, formData, csrf) {
    _this.element.children[0].value = file.upload.uuid;
    formData.append('_token', csrf);
    formData.append('field', _this.element.dataset.field);
    formData.append('uuid', file.upload.uuid);
}

function dzMaxfile(_this, file) {
    _this.removeAllFiles();
    _this.addFile(file);
}

function dzInit(_this,mockFile,thumb) {
    _this.options.addedfile.call(_this, mockFile);
    _this.options.thumbnail.call(_this, mockFile, thumb);
    mockFile.previewElement.classList.add('dz-success');
    mockFile.previewElement.classList.add('dz-complete');
}

function dzAccept(file, done, dzElement = '.dropzone', iconBaseUrl) {
    var ext = file.name.split('.').pop().toLowerCase();
    if(['jpg','png','gif','jpeg','bmp'].indexOf(ext) === -1){
        var thumbnail = $(dzElement).find('.dz-preview.dz-file-preview .dz-image:last');
        var icon = iconBaseUrl+"/"+ext+".png";
        thumbnail.css('background-image', 'url('+icon+')');
        thumbnail.css('background-size', 'contain');
    }
    done();
}
