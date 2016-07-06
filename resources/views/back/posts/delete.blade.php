@extends('back.layout')

@section('title', 'Rounds of invitations')

@section('top-scripts')
@parent
    <link rel="stylesheet" href="/back/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('content-header')
    Posts
        <small>delete post</small>
@endsection

@section('breadcrumb')
@parent
    <li><a href="/admin/posts"><i class="fa fa-pencil"></i>  Posts</a></li>
    <li><a href="/admin/posts/new"><i class="fa fa-trash"></i>  Delete post</a></li>
@endsection

@section('content')
<div class="row">
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-warning"></i> Alert!</h4> Are you sure you want to delete this record?
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Delete post</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="/admin/posts/delete" method="POST">
                <input type="hidden" name="id" value="{{$post->id}}">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputTitle" class="col-sm-4 control-label">Title</label>
                        <div class="col-sm-8">
                            <input disabled="disabled" type="text" name="title" class="form-control" id="inputTitle" placeholder="Title" value="{{old('title', $post->title)}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputText" class="col-sm-4 control-label">Text</label>
                        <div class="col-sm-8">
                            {!!old('text', $post->text)!!}
                        </div>
                    </div>
                   
                    @if ($errors->any())
                      <div class="box-body">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li class="text-red">{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
        </div><!-- /.box-body -->
        <div class="box-footer">
          <a href="/admin/posts/" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-danger pull-right">Delete post</button>
        </div><!-- /.box-footer -->
      </form>
    </div>
    </div>
  </div>
@endsection

@section('scripts')
@parent
    <script src="/back/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="/back/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="/back/plugins/input-mask/jquery.inputmask.extensions.js"></script>

     <script> $("[data-mask]").inputmask(); </script>

    <script type="text/javascript">
      $('.sidebar-menu').each(function () {
        var list = $(this).find('li').each(function(){
          $(this).removeClass('active');
          if($(this).html().indexOf('Posts') > 0){
            $(this).addClass('active');
          }
        })
      });
    </script>


@endsection
