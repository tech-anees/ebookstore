@extends('admin/layout/master')
@section('page-title')
  Manage Media
@endsection
@section('main-content')
<section class="content">
   <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"> 
            <a class="btn btn-danger btn-xm"><i class="fa fa-eye"></i></a>
            <a class="btn btn-danger btn-xm"><i class="fa fa-eye-slash"></i></a>
            <a class="btn btn-danger btn-xm"><i class="fa fa-trash"></i></a>
            <a href="{{ route('media.create') }}" class="btn btn-default btn-xm"><i class="fa fa-plus"></i></a>
          </h3>
          <div class="box-tools">
            <form method="get" action="/admin/media">
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
          @if($medias)
          <table class="table table-bordered">
            <thead style="background-color: #F8F8F8;">
              <tr>
                <th width="4%"><input type="checkbox" name="" id="checkAll"></th>
                <th width="20%">Title</th>
                <th width="20%">Media Type</th>
                <th width="20%">Meida Image</th>
                <th width="10%">Status</th>
                <th width="10%">Manage</th>
              </tr>
            </thead>
            @foreach($medias as $media)
            <tr>
              <td><input type="checkbox" name="" id="" class="checkSingle"></td>
              <td>{{ $media->title }}</td>
              <td>{{ $media->media_type }}</td>
              <td>
                @if($media->media_img == 'No image found')
                  <img src="/uploads/no-img.jpg" width="80" height="80" class="img-thumbnail" alt="No image found" >
                @else
                  <img src="/uploads/{{ $media->media_img }}" width="80" height="80" class="img-thumbnail" alt="{{ $media->title }}">
                @endif
              </td>
              <td>
                @if($media->status == 'DEACTIVE')
                <a href="{{ route('media.status', $media->id) }}" class="btn btn-danger btn-sm singleStatus"><i class="fa fa-thumbs-down"></i></a>
                @else
                <a href="{{ route('media.status', $media->id) }}" class="btn btn-info btn-sm singleStatus"><i class="fa fa-thumbs-up"></i></a>
                @endif
              </td>
              <td>
                  <a href="{{ route('media.edit', $media->id) }}" class="btn btn-info btn-flat btn-sm"> <i class="fa fa-edit"></i></a>
                  <a href="{{ route('media.delete', $media->id) }}"class="btn btn-danger btn-flat btn-sm singleDelete"> <i class="fa fa-trash-o"></i></a>
              </td>
            </tr>
            @endforeach
        </table>
        </div>
        <!-- /.box-body -->
          <div class="box-footer clearfix">
          <div class="row">
            <div class="col-sm-6">
                <span style="display:block;font-size:15px;line-height:34px;margin:20px 0;">
                  Showing {{($medias->currentpage()-1)*$medias->perpage()+1}} to {{ $medias->currentpage()*$medias->perpage()}}
                  of {{ $medias->total()}} entries
                </span>
            </div>
          <div class="col-sm-6 text-right">
            {!! $medias->links() !!}
          </div>
      </div>
    </div>
    </div>
    @else
      <div class="alert alert-danger">No record found</div>
    @endif
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
            $(".singleDelete").on('click', function(event){
                event.preventDefault();

                if (confirm('Are you sure you want to DELETE this?')) {
                    var self = $(this);
                    var href = self.attr('href');

                    $.get(href, function(data){
                        if (data == 'true') 
                        {
                            self.closest('tr').css('background-color','red').fadeOut(1000);
                            self.remove();
                        }
                    });
                }
                else{
                    return false;
                }
            });
        });
    </script>
@endsection