@extends('admin/layout/master')
@section('page-title')
  Edit Media
@endsection
@section('main-content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<section class="content">
  <form name="form-Edit" id="form-Edit" method="POST" action="{{ route('media.update', $media->id) }}" enctype="multipart/form-data">
  @csrf
  @method('put')
  <div class="box box-primary">
    <div class="box-body">
      <div class="row"> 
          <div class="col-xs-6">
            <div class="form-group">
                <label for="title">Title <span class="text text-red">*</span></label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ $media->title }}">
              </div>

              <div class="form-group">
              <label for="slug">Slug <span class="text text-red">*</span></label>
                <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" value="{{ $media->slug }}">
              </div>
             
              <div class="form-group">
                <label>Media Type <span class="text text-red">*</span></label>
                  <select name="media_type" id="media_type" class="form-control" style="width: 100%;">
                    <option value="none">-- Select Media Type --</option>
                    <option value="slider" {{ ($media->media_feature == 'slider') ? 'selected' : null }}>Slider</option>
                    <option value="gallery" {{ ($media->media_feature == 'gallery') ? 'selected' : null }}>Gallery</option>
                </select>
              </div>
            </div>
        <div class="col-xs-6">
           <div class="form-group">
              <label for="media_img">Media Image <span class="text text-red">*</span></label>
              <input type="file" name="media_img" class="form-control" id="media_img">
            </div>
            <div class="form-group">
              <img src="/uploads/{{ $media->media_img }}" id="showImage" width="60" height="60" class="rounded avatar-lg" alt="No Image found">
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter ...">{{ $media->description }}</textarea>
             </div>
          </div>
        </div>
    </div>
    <div class="box-footer">
        <a type="submit" class="btn btn-primary">Update</a>
        <a href="{{ route('media.index') }}" type="reset" class="btn btn-danger">Cancel</a>
      </div>
  </div>
</form>
<script type="text/javascript">
  $(document).ready(function() {
    $("#media_img").change(function(event) {
      var reader = new FileReader();
      reader.onload = function(event) {
        $("#showImage").attr('src', event.target.result);
      }

      reader.readAsDataURL(event.target.files['0']);

    });
  });
</script>
</section>
@endsection