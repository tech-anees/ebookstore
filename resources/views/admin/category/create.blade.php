@extends('admin/layout/master')
@section('page-title')
  Create Category
@endsection
@section('main-content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<section class="content">

  <!-- SELECT2 EXAMPLE -->
  <!-- form start -->
  <form name="formCreate" id="formCreate" method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
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

            <div class="form-group @error('slug') has-error @enderror ">
            <label for="slug">Slug <span class="text text-red">*</span></label>
              <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug">
              @error('slug')
              <div class="label label-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="form-group">
            <label>Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter ..."></textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="{{ route('category.index') }}" type="reset" class="btn btn-danger">Cancel</a>
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
        slug :{
          required : true,
        },
      },
      messages : {
        title: {
            required : 'Title should not be empty!',
        },
        slug: {
            required : 'Slug should not be empty!',
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
</section>
@endsection