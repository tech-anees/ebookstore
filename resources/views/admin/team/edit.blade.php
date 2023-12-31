@extends('admin/layout/master')
@section('page-title')
    Edit Team
@endsection
@section('main-content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<section class="content">
    <!-- SELECT2 EXAMPLE -->
    <!-- form start -->
    <form name="form-Edit" id="form-Edit" method="POST" action="{{ route('team.update', $team->id) }}" enctype="multipart/form-data">
   @csrf
   @method('put')
<div class="box box-primary">
<!-- /.box-header -->
<div class="box-body">
    <!-- row start -->
    <div class="row">
        <div class="col-xs-6">
            <div class="form-group">
                <label for="fullname">Fullname <span class="text text-red">*</span></label>
                <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Fullname" value="{{ $team->fullname }}">
            </div>
            <div class="form-group">
                <label for="designation">Designation <span class="text text-red">*</span></label>
                <input type="text" name="designation" class="form-control" id="designation" placeholder="Designation" value="{{ $team->designation }}">
            </div>
            <div class="form-group">
                <label for="telephone">Telephone</label>
                <input type="text" name="telephone" class="form-control" id="telephone" placeholder="Telephone" value="{{ $team->telephone }}">
            </div>
            <div class="form-group">
                <label for="mobile">Mobile</label>
                <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Mobile" value="{{ $team->mobile }}">
            </div>
            <div class="form-group">
                <label for="email">Email <span class="text text-red">*</span></label>
                <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="{{ $team->email }}">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter ...">{{ $team->description }}</textarea>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <label for="team_img">Team Image <span class="text text-red">*</span></label>
                <input type="file" name="team_img" class="form-control" id="team_img">
            </div>
            <div class="form-group">
                <img src="/uploads/{{ $team->team_img }}" id="showImage" width="60" height="60" class="rounded avatar-lg" alt="No image found">
            </div>
            <div class="form-group">
                <label for="facebook_id">Facebook ID <span class="text text-red">*</span></label>
                <input type="text" name="facebook_id" class="form-control" id="facebook_id" placeholder="Facebook ID" value="{{ $team->facebook_id }}">
            </div>
            <div class="form-group">
                <label for="twitter_id">Twitter ID <span class="text text-red">*</span></label>
                <input type="text" name="twitter_id" class="form-control" id="twitter_id" placeholder="Twitter ID" value="{{ $team->twitter_id }}">
            </div>
            <div class="form-group">
                <label for="pinterest_id">Pinterest ID <span class="text text-red">*</span></label>
                <input type="text" name="pinterest_id" class="form-control" id="pinterest_id" placeholder="Pinterest ID" value="{{ $team->pinterest_id }}">
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
</section>
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
@endsection