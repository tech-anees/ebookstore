@extends('admin/layout/master')
@section('page-title')
  Manage Category
@endsection
@section('main-content')
<section class="content">
  
  <!-- /.row -->
<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"> 
            <a id="statusActiveAll" class="btn btn-danger btn-xm"><i class="fa fa-eye"></i></a>
            <a id="statusDeactiveAll" class="btn btn-danger btn-xm"><i class="fa fa-eye-slash"></i></a>
            <a id="deleteAll" class="btn btn-danger btn-xm"><i class="fa fa-trash"></i></a>
            <a href="{{ route('category.create') }}" class="btn btn-default btn-xm"><i class="fa fa-plus"></i></a>
      </h3>
      <div class="box-tools">
        <form method="get" action="/admin/category">
        <div class="input-group input-group-sm" style="width: 250px;">
          <input type="text" name="s" value="{{ (request()->get('s')) ? request()->get('s') : null }}" class="form-control pull-right" placeholder="Search">
          <div class="input-group-btn">
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </form>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      @if($categories)
      <form name="formView" id="formView" action="">
      <table class="table table-bordered">
        <thead style="background-color: #F8F8F8;">
          <tr>
            <th width="4%"><input type="checkbox" name="" id="checkAll"></th>
            <th width="70%">Title</th>
            <th width="10%">Status</th>
            <th width="10%">Manage</th>
          </tr>
        </thead>
        @foreach($categories as $category)
        <tr>
          <td><input type="checkbox" name="checkAll[]" value="{{ $category->id }}" class="checkSingle"></td>
          <td>{{ $category->title }}</td>
          <td>
            @if($category->status == 'DEACTIVE')
            <a href="{{ route('category.status', $category->id) }}"class="btn btn-danger btn-sm singleStatus"><i class="fa fa-thumbs-down"></i></a>
            @else
            <a href="{{ route('category.status', $category->id) }}" class="btn btn-info btn-sm singleStatus"><i class="fa fa-thumbs-up"></i></a>
            @endif
          </td>
          <td>
              <a href="{{ route('category.edit', $category->id) }}" class="btn btn-info btn-flat btn-sm"> <i class="fa fa-edit"></i></a>
              <a href="{{ route('category.delete', $category->id) }}"class="btn btn-danger btn-flat btn-sm singleDelete"> <i class="fa fa-trash-o"></i></a>
          </td>
        </tr>
        @endforeach
    </table>
  </form>
    </div>
    <!-- /.box-body -->
      <div class="box-footer clearfix">
                <div class="row">
                    <div class="col-sm-6">
                        <span style="display:block;font-size:15px;line-height:34px;margin:20px 0;">
                            Showing {{($categories->currentpage()-1)*$categories->perpage()+1}} to {{ $categories->currentpage()*$categories->perpage()}}
                            of {{ $categories->total()}} Entries
                          </span>
                    </div>
                <div class="col-sm-6 text-right">
                    {!! $categories->links() !!}
                </div>
        </div>
    </div>
  </div>
    @else
      <div class="alert alert-danger">No record found</div>
    @endif
      <!-- /.box-body -->
  </div>


</section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // SINGLE STATUS
            $(".singleStatus").on('click', function(event) {
                event.preventDefault();
                
                var self = $(this);
                var href = self.attr('href');

                self.html('<img src="/assets/admin/dist/js/loader.gif" width="28" height="28">');
                
               $.get(href, function(data) {
                    if (data == 'ACTIVE') {
                        self.closest('a').removeClass('btn btn-danger btn-sm');
                        self.closest('a').addClass('btn btn-info btn-sm');
                        self.html('<i class="fa fa-thumbs-up"></i>');
                    }
                    else {
                        self.closest('a').removeClass('btn btn-info btn-sm');
                        self.closest('a').addClass('btn btn-danger btn-sm');
                        self.html('<i class="fa fa-thumbs-down"></i>');   
                    }
               });
            });

            // SINGLE DELETE
            $(".singleDelete").on('click', function(event) {
                event.preventDefault(); //disabled link funcationality.
                
                if (confirm('Are you sure you want to delete this?')) {
                    var self = $(this);
                    var href = self.attr('href');

                    $.get(href, function(data) {
                        if (data == 'true') 
                        {
                            self.closest('tr').css('background-color', 'red').fadeOut(1000);
                            self.remove();
                        }
                    });
                }
                else {
                    return false;
                }
            });
 
            // ACTIVE ALL STATUS
            $("#statusActiveAll").on('click', function(event) {
                event.preventDefault();
                
                if ($(".checkSingle:checked").length > 0 ) {
                    var formSerials = $("#formView").serialize();
                    $.get('{{ route('category.status.active') }}', formSerials, function(data) {
                        if (data > 0) {
                            window.location.href = '/admin/category';
                        }
                    });
                } else {
                    alert("Please select atleast one");
                }
            });



            // DEACTIVE ALL STATUS
            $("#statusDeactiveAll").on('click', function(event) {
                event.preventDefault();
                
                if ($(".checkSingle:checked").length > 0 ) {
                    var formSerials = $("#formView").serialize();
                    $.get('{{ route('category.status.deactive') }}', formSerials, function(data) {
                        if (data > 0) {
                            window.location.href = '/admin/category';
                        }
                    });
                } else {
                    alert("Please select atleast one");
                }
            });
            // DELETE ALL
            $("#deleteAll").on('click', function(event) {
                event.preventDefault();
                
                if ($(".checkSingle:checked").length > 0 ) {
                    var formSerials = $("#formView").serialize();
                    $.get('{{ route('category.delete.all') }}', formSerials, function(data) {
                        if (data > 0) {
                            window.location.href = '/admin/category';
                        }
                    });
                } else {
                    alert("Please select atleast one");
                }
            });
        });            



    </script>
@endsection