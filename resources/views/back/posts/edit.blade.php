@extends('back.layout')

@section('title', 'Rounds of invitations')

@section('top-scripts')
@parent
    <link rel="stylesheet" href="/back/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('content-header')
    Posts
        <small>edit post/small>
@endsection

@section('breadcrumb')
@parent
    <li><a href="/admin/posts"><i class="fa fa-folder"></i>  Posts</a></li>
    <li><a href="/admin/posts/new"><i class="fa fa-pencil"></i>  Edit post</a></li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Edit post</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="/admin/posts/edit" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="{{$post->id}}">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputTitle" class="col-sm-3 control-label">Title</label>
                        <div class="col-sm-9">
                            <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Title" value="{{old('title', $post->title)}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputText" class="col-sm-3 control-label">Text</label>
                        <div class="col-sm-9">
                            <textarea name="text" class="form-control" id="inputText" rows="20">{{old('text', $post->text)}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTitle" class="col-sm-3 control-label">Tags</label>
                        <div class="col-sm-9">
                            <input type="text" name="tags" class="form-control" id="inputTags" placeholder="one-word tags list " value="{{old('tags', $post->tagsList())}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRefdate" class="col-sm-4 control-label">Published at</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="inputRefdate" name="publisheddate" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="{{old('publisheddate',date('d/m/Y', strtotime($post->published_at)))}}">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="inputReftime" name="publishedtime" data-inputmask="'alias': 'hh:mm:ss'" data-mask value="{{old('publishedtime',date('H:i:s', strtotime($post->published_at)))}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="picture" class="col-sm-3 control-label">Picture</label>
                        <div class="col-sm-9">
                            <input type="file" id="picture" name="picture">
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
          <button type="submit" class="btn btn-info pull-right">Save post</button> 
          <a href="/admin/posts/delete/{{$post->id}}" class="btn btn-danger pull-right" style="margin-right: 0.2em;">Delete post</a>
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
    <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>

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

    <script>
      $(function () {
        CKEDITOR.replace('inputText');
      });
    </script>
@endsection