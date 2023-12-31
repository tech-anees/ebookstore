@extends('admin/layout/master')
@section('page-title')
  Create Media
@endsection
@section('main-content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<section class="content">

  <!-- SELECT2 EXAMPLE -->
  <!-- form start -->
  <form name="formCreate" id="formCreate" method="POST" action="{{ route('media.store') }}" enctype="multipart/form-data">
    @csrf
<div class="box box-primary">
<div class="box-body">
  <div class="row"> 
    <div class="col-xs-6">
      <div class="form-group @error('title') has-error @enderror">
        <label for="title">Title <span class="text text-red">*</span></label>
          <input type="text" name="title" class="form-control" id="title" placeholder="Title">
          @error('title')
            <div class="label label-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group @error('slug') has-error @enderror">
        <label for="slug">Slug <span class="text text-red">*</span></label>
          <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug">
          @error('title')
            <div class="label label-danger">{{ $message }}</div>
          @enderror        
        </div>

        <div class="form-group">
          <label>Media Type <span class="text text-red">*</span></label>
          <select name="media_type" id="media_type" class="form-control" style="width: 100%;">
            <option value="none">-- Select Media Type --</option>
            <option value="slider">Slider</option>
            <option value="gallery">Gallery</option>
          </select>
          @error('media_type')
            <div class="label label-danger">{{ $message }}</div>
          @enderror 
        </div>
      </div>     
    <div class="col-xs-6">
       <div class="form-group">
          <label for="media_img">Media Image <span class="text text-red">*</span></label>
          <input type="file" name="media_img" class="form-control" id="media_img">
        </div>
        <div class="form-group">
          <img src="{{ url('uploads/no-img.jpg') }}" id="showImage" width="80" height="80" class="rounded avatar-lg" alt="No Image found">
        </div>

        <div class="form-group">
          <label>Description</label>
          <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter ..."></textarea>
         </div>
      </div>
    </div>
</div>
<div class="box-footer">
    <button type="submit" class="btn btn-primary">Update</button>
    <button type="reset" class="btn btn-danger">Cancel</button>
  </div>
</div>
</form>
<script type="text/javascript">
  $(document).ready(function (){
    $('#formCreate').validate({
      rules: {
        title: {
            required : true,
        },
        slug: {
            required : true,
        }, 
        media_type : true,
    },
    messages :{
        title: {
            required : 'Title should not be empty!',
        },
        slug: {
            required : 'Slug should not be empty!',
        },
        media_type: {
            required : 'Please choose any one Media_type',
        },
      },
      errorPlacement: function (error,element) {
        error.addClass('label label-danger');
        error.insertAfter(element);
      },
      highlight : function(element, errorClass, validClass){
        $(element).closest('.form-group').addClass('has-error');
      },
      unhighlight : function(element, errorClass, validClass){
        $(element).closest('.form-group').removeClass('has-error');
      },
    });
  });
</script>
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