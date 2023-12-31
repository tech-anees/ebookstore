@extends('admin/layout/master')
@section('page-title')
  Create Book
@endsection
@section('main-content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<section class="content">

  <!-- SELECT2 EXAMPLE -->
  <!-- form start -->
  <form name="formCreate" id="formCreate" method="POST" action="{{ route('book.store') }}" enctype="multipart/form-data">
    @csrf
  <div class="box box-primary">
    <!-- /.box-header -->
    <div class="box-body">
      <!-- row start -->
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
              
              <div class="form-group" @error('category_id') has-error @enderror>
                <label>Category <span class="text text-red">*</span></label>
                  <select class="form-control" name="category_id" id="category_id" style="width: 100%;">
                    <option value="0">-- Select Category --</option>
                      @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                      @endforeach
                  </select>
                  @error('category_id')
                    <div class="label label-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group" @error('author_id') has-error @enderror>
                  <label>Author <span class="text text-red">*</span></label>
                    <select class="form-control" name="author_id" id="author_id" style="width: 100%;">
                    @foreach($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->title }}</option>
                    @endforeach
                  </select>
                  @error('author_id')
                    <div class="label label-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group @error('availability') has-error @enderror">
                  <label for="availability">Availability <span class="text text-red">*</span></label>
                  <input type="text" class="form-control" name="availability" id="availability" placeholder="Availability">
                  @error('text')
                    <div class="label label-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group @error('price') has-error @enderror">
                  <label for="price">Price: <span class="text text-red">*</span></label> 
                  <input type="text" class="form-control" name="price" id="price" placeholder="Price">
                  @error('price')
                    <div class="label label-danger">{{ $message }}</div>
                  @enderror
                </div>
              
              <div class="form-group @error('publisher') has-error @enderror">
                <label for="publisher">Publisher</label>
                <input type="text" class="form-control" name="publisher" id="publisher" placeholder="Publisher">
              @error('publisher')
                <div class="label label-danger">{{ $message }}</div>
              @enderror
              </div>

              <div class="form-group @error('country_of_publisher') has-error @enderror">
                <label>Country of Publisher <span class="text text-red">*</span></label>
                  <select class="form-control select2" name="country_of_publisher" id="country_of_publisher" style="width: 100%;">
                    <option value="none"> -- Select Country -- </option>
                    <option value="pakistan">Pakistan</option>
                  </select>
                @error('country_of_publisher')
                  <div class="label label-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" class="form-control" name="isbn" id="isbn" placeholder="ISBN">
              </div>

              <div class="form-group">
                <label for="isbn_10">ISBN-10</label>
                <input type="text" class="form-control" name="isbn_10" id="isbn_10" placeholder="ISBN-10">
              </div>
            </div>

          <div class="col-xs-6">
            <div class="form-group">
              <label for="book_img">Book Image</label>
               <input type="file" class="form-control" name="book_img" id="book_img" >
              <small class="label label-warning">Cover Photo will be uploaded</small>
            </div>
            <div class="form-group">
              <img src="{{ url('uploads/no-img.jpg') }}" id="showImage" width="60" height="60" class="rounded avatar-lg" alt="No Image found">
            </div>
            <div class="form-group">
              <label for="book_upload">Book Upload</label>
                <input type="file" class="form-control" name="book_upload" id="book_upload" >
              <small class="label label-warning">Book (PDF) will be uploaded </small>
            </div>

            <div class="form-group">
                <label for="audience">Audience</label>
                <input type="text" class="form-control" name="audience" id="audience" placeholder="Audience">
              </div>

              <div class="form-group">
                <label for="format">Format</label>
                <input type="text" class="form-control" name="format" id="format" placeholder="Format">
              </div>

              <div class="form-group">
                <label for="language">Language</label>
                <input type="text" class="form-control" name="language" id="language" placeholder="Language">
              </div>

              <div class="form-group @error('total_pages') has-error @enderror">
                <label for="total_pages">Total Pages</label>
                <input type="text" class="form-control" name="total_pages" id="total_pages" placeholder="Total Pages">
                @error('total_pages')
                  <div class="label label-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group @error('edition_number') has-error @enderror">
                <label for="edition_number">Edition Number</label>
                  <input type="text" class="form-control" name="edition_number" id="edition_number" placeholder="Edition Number">
                  @error('edition_number')
                    <div class="label label-danger">{{ $message }}</div>
                  @enderror
              </div>

              <div class="form-group">
                <label>Recommended</label>
                  <select class="form-control" name="recommended" id="recommended" style="width: 100%;">
                    <option value="none">-- Select Recommended --</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                  </select>
              </div>

              <div class="form-group">
                <label for="description">Description <span class="text text-red">*</span></label>
                <textarea class="form-control" name="description" rows="5" id="description" placeholder="Description"></textarea>
              </div>
          </div>
        </div>
    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('book.index') }}" type="reset" class="btn btn-danger">Cancel</a>
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
        publisher: {
            required : true,
        },
        country_of_publisher: {
            required: true,
        },
        total_pages: {
          required: true,
        },
        edition_number: {
          required: true,
        },
    },
    messages :{
        title: {
            required : 'Title should not be empty!',
        },
        slug: {
            required : 'Slug should not be empty!',
        },
        publisher: {
            required : 'Publisher should not be empty!',
        },
        country_of_publisher : {
          required: 'please select any one country.',
        },
        total_pages : {
          required : 'total_pages should not be empty!',
        },
        edition_number : {
          required : 'edition_number should not be empty!',
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