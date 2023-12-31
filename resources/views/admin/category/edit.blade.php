@extends('admin/layout/master')
@section('page-title')
  Edit Category
@endsection
@section('main-content')
<section class="content">

  <!-- SELECT2 EXAMPLE -->
  <!-- form start -->
  <form name="form-Edit" id="form-Edit" method="POST" action="{{ route('category.update', $category->id) }}">
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
                  <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ $category->title }}">
                </div>

                <div class="form-group">
                <label for="slug">Slug <span class="text text-red">*</span></label>
                  <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" value="{{ $category->slug }}">
                </div>
                <div class="form-group">
                <label>Description</label>
                <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter ...">{{ $category->description }}</textarea>
              </div>
            </div>
        </div>
          <!-- row end -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <a type="submit" class="btn btn-primary">Submit</a>
        <a href="{{ route('category.index') }}" type="reset" class="btn btn-danger">Cancel</a>
      </div>
  </div>
</form>
  <!-- /.box -->

  <!-- form end -->

</section>
@endsection