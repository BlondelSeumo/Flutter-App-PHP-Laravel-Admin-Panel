@if($customFields)
<h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
<!-- Description Field -->
<div class="form-group row ">
  {!! Form::label('description', trans("lang.gallery_description"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::textarea('description', null, ['class' => 'form-control','placeholder'=>
     trans("lang.gallery_description_placeholder")  ]) !!}
    <div class="form-text text-muted">{{ trans("lang.gallery_description_help") }}</div>
  </div>
</div>

<!-- Image Field -->
<div class="form-group row">
  {!! Form::label('image', trans("lang.gallery_image"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <div style="width: 100%" class="dropzone image" id="image" data-field="image">
      <input type="hidden" name="image">
    </div>
    <a href="#loadMediaModal" data-dropzone="image" data-toggle="modal" data-target="#mediaModal" class="btn btn-outline-{{setting('theme_color','primary')}} btn-sm float-right mt-1">{{ trans('lang.media_select')}}</a>
    <div class="form-text text-muted w-50">
      {{ trans("lang.gallery_image_help") }}
    </div>
  </div>
</div>
@prepend('scripts')
<script type="text/javascript">
    var var1567114722110472716ble = '';
    @if(isset($gallery) && $gallery->hasMedia('image'))
    var1567114722110472716ble = {
        name: "{!! $gallery->getFirstMedia('image')->name !!}",
        size: "{!! $gallery->getFirstMedia('image')->size !!}",
        type: "{!! $gallery->getFirstMedia('image')->mime_type !!}",
        collection_name: "{!! $gallery->getFirstMedia('image')->collection_name !!}"};
    @endif
    var dz_var1567114722110472716ble = $(".dropzone.image").dropzone({
        url: "{!!url('uploads/store')!!}",
        addRemoveLinks: true,
        maxFiles: 1,
        init: function () {
        @if(isset($gallery) && $gallery->hasMedia('image'))
            dzInit(this,var1567114722110472716ble,'{!! url($gallery->getFirstMediaUrl('image','thumb')) !!}')
        @endif
        },
        accept: function(file, done) {
            dzAccept(file,done,this.element,"{!!config('medialibrary.icons_folder')!!}");
        },
        sending: function (file, xhr, formData) {
            dzSending(this,file,formData,'{!! csrf_token() !!}');
        },
        maxfilesexceeded: function (file) {
            dz_var1567114722110472716ble[0].mockFile = '';
            dzMaxfile(this,file);
        },
        complete: function (file) {
            dzComplete(this, file, var1567114722110472716ble, dz_var1567114722110472716ble[0].mockFile);
            dz_var1567114722110472716ble[0].mockFile = file;
        },
        removedfile: function (file) {
            dzRemoveFile(
                file, var1567114722110472716ble, '{!! url("galleries/remove-media") !!}',
                'image', '{!! isset($gallery) ? $gallery->id : 0 !!}', '{!! url("uplaods/clear") !!}', '{!! csrf_token() !!}'
            );
        }
    });
    dz_var1567114722110472716ble[0].mockFile = var1567114722110472716ble;
    dropzoneFields['image'] = dz_var1567114722110472716ble;
</script>
@endprepend
</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

<!-- Restaurant Id Field -->
<div class="form-group row ">
  {!! Form::label('restaurant_id', trans("lang.gallery_restaurant_id"),['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::select('restaurant_id', $restaurant, null, ['class' => 'select2 form-control']) !!}
    <div class="form-text text-muted">{{ trans("lang.gallery_restaurant_id_help") }}</div>
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
  <button type="submit" class="btn btn-{{setting('theme_color')}}" ><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.gallery')}}</button>
  <a href="{!! route('galleries.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
