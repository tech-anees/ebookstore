@extends('admin/layout/master')
@section('page-title')
  Edit Book
@endsection
@section('main-content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<section class="content">

  <!-- SELECT2 EXAMPLE -->
  <!-- form start -->
  <form name="formEdit" id="formEdit" method="POST" action="{{ route('book.update', $book->id) }}" enctype="multipart/form-data">
    @csrf
    @method('put')
  <div class="box box-primary">
    <!-- /.box-header -->
    <div class="box-body">
      <!-- row start -->
      <div class="row"> 
            <div class="col-xs-6">
              
             <div class="form-group">
                <label for="title">Title <span class="text text-red">*</span></label>
                  <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ $book->title }}">
                </div>

                <div class="form-group">
                <label for="slug">Slug <span class="text text-red">*</span></label>
                  <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" value="{{ $book->slug }}">
                </div>
                <div class="form-group">
                  <label>Category <span class="text text-red">*</span></label>
                  <select class="form-control" name="category_id" id="category_id" style="width: 100%;">
                    <option value="0">-- Select Category --</option>
                      @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ ($category->id == $book->category_id) ? 'selected' : null }} >{{ $category->title }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Author <span class="text text-red">*</span></label>
                  <select class="form-control" name="author_id" id="author_id" style="width: 100%;">
                    @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ ($author->id == $book->author_id) ? 'selected' : null }}>{{ $author->title }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="availability">Availability <span class="text text-red">*</span></label>
                  <input type="text" class="form-control" name="availability" id="availability" placeholder="Availability" value="{{ $book->availability }}">
                </div>
                <div class="form-group">
              <label for="price">Price: <span class="text text-red">*</span></label> 
              <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="{{ $book->price }}">
             </div>
              <div class="form-group">
                <label for="publisher">Publisher</label>
                <input type="text" class="form-control" name="publisher" id="publisher" placeholder="Publisher" value="{{ $book->publisher }}">
              </div>
              <div class="form-group">
                <label>Country of Publisher <span class="text text-red">*</span></label>
                <select class="form-control select2" name="country_of_publisher" id="country_of_publisher" style="width: 100%;">
                  <option value="none"> -- Select Country -- </option>
                  <option value="pakistan"> Pakistan </option>
                </select>
              </div>
              <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" class="form-control" name="isbn" id="isbn" placeholder="ISBN" value="{{ $book->isbn }}">
              </div>

                <div class="form-group">
                  <label for="isbn_10">ISBN-10</label>
                  <input type="text" class="form-control" name="isbn_10" id="isbn_10" placeholder="ISBN-10" value="{{ $book->isbn_10 }}">
                </div>
            </div>
             
            <div class="col-xs-6">
                <div class="form-group">
                  <label for="book_img">Book Image</label>
                  <input type="file" class="form-control" name="book_img" id="book_img"  value="{{ $book->book_img }}">
                  <small class="label label-warning">Cover Photo will be uploaded</small>
                </div>
                <div class="form-group">
                  <img src="/uploads/{{ $book->book_img }}" id="showImage" width="60" height="60" class="rounded avatar-lg" alt="No image found">
                </div>
                <div class="form-group">
                  <label for="book_upload">Book Upload</label>
                  <input type="file" class="form-control" name="book_upload" id="book_upload"  value="{{ $book->book_upload }}">
                  <small class="label label-warning">Book (PDF) will be uploaded </small>
                </div>
              <div class="form-group">
                  <label for="audience">Audience</label>
                  <input type="text" class="form-control" name="audience" id="audience" placeholder="Audience" value="{{ $book->audience }}">
                </div>

                <div class="form-group">
                  <label for="format">Format</label>
                  <input type="text" class="form-control" name="format" id="format" placeholder="Format" value="{{ $book->format }}">
                </div>

                <div class="form-group">
                  <label for="language">Language</label>
                  <input type="text" class="form-control" name="language" id="language" placeholder="Language" value="{{ $book->language }}">
                </div>
                <div class="form-group">
                  <label for="total_pages">Total Pages</label>
                  <input type="text" class="form-control" name="total_pages" id="total_pages" placeholder="Total Pages" value="{{ $book->total_pages }}">
                </div>
                <div class="form-group">
                  <label for="edition_number">Edition Number</label>
                  <input type="text" class="form-control" name="edition_number" id="edition_number" placeholder="Edition Number" value="{{ $book->edition_number }}">
                </div>

                <div class="form-group">
                  <label>Recommended</label>
                  <select class="form-control" name="recommended" id="recommended" style="width: 100%;">
                    <option value="none">-- Select Recommended --</option>
                    <option value="1" {{ ($book->recommended == '1') ? 'selected' : null }}>1</option>
                    <option value="0" {{ ($book->recommended == '0') ? 'selected' : null }}>0</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="description">Description <span class="text text-red">*</span></label>
                  <textarea class="form-control" name="description" rows="5" id="description" placeholder="Description">{{ $book->description }}</textarea>
                </div>
            </div>
        </div>

          <!-- row end -->

    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('book.index') }}" type="reset" class="btn btn-danger">Cancel</a>
      </div>
  </div>
</form>

<script type="text/javascript">
  $(document).ready(function(){
    $("#book_img").change(function(event){
      var reader = new FileReader();
      reader.onload = function(event){
        $("#showImage").attr('src', event.target.result);
      }
      reader.readAsDataURL(event.target.files['0']);
    });
  });
</script>
</section>
@endsection