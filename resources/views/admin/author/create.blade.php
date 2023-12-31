@extends('admin/layout/master')
@section('page-title')
  Create Author
@endsection
@section('main-content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<section class="content">
  <form name="formCreate" id="formCreate" method="POST" action="{{ route('author.store') }}" enctype="multipart/form-data">
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
      @error('slug')
        <div class="label label-danger">{{ $message }}</div>
      @enderror
      </div>

      <div class="form-group @error('designation') has-error @enderror">
        <label for="designation">Designation <span class="text text-red">*</span></label>
        <input type="text" name="designation" class="form-control" id="designation" placeholder="Designation">
      @error('designation')
        <div class="label label-danger">{{ $message }}</div>
      @enderror
      </div>

      <div class="form-group @error('dob') has-error @enderror">
        <label for="dob">Date of birth: <span class="text text-red">*</span></label> 
        <input type="date" name="dob" class="form-control" id="dob" placeholder="Date of Birth">
      @error('dob')
        <div class="label label-danger">{{ $message }}</div>
      @enderror
      </div>

      <div class="form-group @error('email') has-error @enderror">
        <label for="email">Email <span class="text text-red">*</span></label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Email">
      @error('email')
        <div class="label label-danger">{{ $message }}</div>
      @enderror
      </div>

      <div class="form-group @error('Country') has-error @enderror">
        <label>Country <span class="text text-red">*</span></label>
          <select name="country" id="country" class="form-control select2" style="width: 100%;">
          <option value="none">-- Select Country --</option>
          <option value="pakistan"> Pakistan </option>
        </select>
      @error('country')
        <div class="label label-danger">{{ $message }}</div>
      @enderror
      </div>

      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone">
      </div>

      <div class="form-group">
        <label>Description</label>
        <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter ..."></textarea>
      </div>
    </div>

      <div class="col-xs-6">
       <div class="form-group">
          <label for="author_img">Author Image <span class="text text-red">*</span></label>
          <input type="file" name="author_img" class="form-control" id="author_img">
        </div>
        <div class="form-group">
          <img src="{{ url('uploads/no-img.jpg') }}" id="showImage" width="60" height="60" class="rounded avatar-lg" alt="No image found">
        </div>

        <div class="form-group">
          <label for="facebook_id">Facebook ID</label>
          <input type="text" name="facebook_id" class="form-control" id="facebook_id" placeholder="Facebook ID">
        </div>

        <div class="form-group">
          <label for="twitter_id">Twitter ID</label>
          <input type="text" name="twitter_id" class="form-control" id="twitter_id" placeholder="Twitter ID">
        </div>

        <div class="form-group">
          <label for="youtube_id">YouTube ID</label>
          <input type="text" name="youtube_id" class="form-control" id="youtube_id" placeholder="YouTube ID">
        </div>

        <div class="form-group">
        <label for="pinterest_id">Pinterest ID</label>
          <input type="text" name="pinterest_id" class="form-control" id="pinterest_id" placeholder="Pinterest ID">
        </div>

        <div class="form-group">
          <label>Author Feature</label>
          <select class="form-control" name="recommended" id="recommended" style="width: 100%;">
            <option value="none">-- Select Recommended --</option>
            <option value="yes">Yes</option>
            <option value="no">No</option>
          </select>
        </div>
     </div>
   </div>
 </div>
  <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
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
        designation: {
            required : true,
        }, 
        dob: {
            required : true,
        }, 
        email: {
            required : true,
            email: true
        }, 
    },
    messages :{
        title: {
            required : 'Title should not be empty!',
        },
        slug: {
            required : 'Slug should not be empty!',
        },
        designation: {
            required : 'Designation should not be empty!',
        },
        dob: {
            required : 'Date of birth should not be empty!',
        },
        email: {
            required : 'Email should not be empty!',
            email: 'Type a correct email address',
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
    $("#author_img").change(function(event) {
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