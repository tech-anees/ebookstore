@extends('admin/layout/master')
@section('page-title')
    Create Team
@endsection
@section('main-content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<section class="content">
<form name="formCreate" id="formCreate" method="POST" action="{{ route('team.store') }}" enctype="multipart/form-data">
@csrf
<div class="box box-primary">
<div class="box-body">
    <div class="row">
        <div class="col-xs-6">
            <div class="form-group @error('fullname') has-error @enderror">
                <label for="fullname">Fullname <span class="text text-red">*</span></label>
                <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Fullname">
                @error('fullname')
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
            <div class="form-group">
                <label for="telephone">Telephone</label>
                <input type="text" name="telephone" class="form-control" id="telephone" placeholder="Telephone">
            </div>
            <div class="form-group @error('mobile') has-error @enderror">
                <label for="mobile">Mobile</label>
                <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Mobile">
                @error('mobile')
                    <div class="label label-danger">{{ $message }}</div>
                 @enderror
            </div>
            <div class="form-group @error('email') has-error @enderror">
                <label for="email">Email <span class="text text-red">*</span></label>
                <input type="text" name="email" class="form-control" id="email" placeholder="Email">
                @error('email')
                  <div class="label label-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group @error('profile') has-error @enderror">
                <label for="profile">Profile<span class="text text-red">*</span></label>
                <input type="text" name="profile" class="form-control" id="profile" placeholder="Profile">
                @error('profile')
                  <div class="label label-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter ..."></textarea>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <label for="team_img">Team Image <span class="text text-red">*</span></label>
                <input type="file" name="team_img" class="form-control" id="team_img">
            </div>
            <div class="form-group">
                <img src="{{ url('uploads/no-img.jpg') }}" id="showImage" width="60" height="60" class="rounded avatar-lg" alt="No image found">
            </div>
            <div class="form-group @error('facebook_id') has-error @enderror">
                <label for="facebook_id">Facebook ID <span class="text text-red">*</span></label>
                <input type="text" name="facebook_id" class="form-control" id="facebook_id" placeholder="Facebook ID">
                @error('facebook_id')
                  <div class="label label-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group @error('twitter_id') has-error @enderror">
                <label for="twitter_id">Twitter ID <span class="text text-red">*</span></label>
                <input type="text" name="twitter_id" class="form-control" id="twitter_id" placeholder="Twitter ID">
                @error('twitter_id')
                  <div class="label label-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group @error('pinterest_id') has-error @enderror">
                <label for="pinterest_id">Pinterest ID <span class="text text-red">*</span></label>
                <input type="text" name="pinterest_id" class="form-control" id="pinterest_id" placeholder="Pinterest ID">
                @error('pinterest_id')
                  <div class="label label-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="box-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('team.index') }}" type="reset" class="btn btn-danger">Cancel</a>
</div>
</div>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $('#formCreate').validate({
            rules:{
                fullname: {
                    required: true,
                },
                designation: {
                    required: true,
                },
                mobile: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                profile: {
                    required : true
                },
            },
            messages: {
                fullname: {
                    required: 'Fullname should not be empty!',
                },
                designation: {
                    required: 'Designation should not be empty!',
                },
                mobile: {
                    required: 'Mobile should not be empty!',
            },
            email: {
                required: 'Email should not be empty!',
                email: 'Type a correct email address',
            },
            profile: {
                required: 'Profile should not be empty!',
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
    $("#team_img").change(function(event) {
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