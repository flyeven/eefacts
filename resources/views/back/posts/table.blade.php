@extends('back.layout')

@section('title', 'Manage posts')

@section('top-scripts')
@parent
    <link rel="stylesheet" href="/back/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('content-header')
    Posts
        <small>manage / publish your posts</small>
@endsection

@section('breadcrumb')
@parent
    <li><a href="/admin/posts"><i class="fa fa-pencil"></i>Posts list</a></li>
@endsection

@section('content')
    @if(session('status'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i> Info</h4>
                    {{session('status')}} This alert is dismissable.
                </div>
            </div>
        </div>
    @endif
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">List of posts</h3>
            <a class="btn btn-primary pull-right" style="margin-right: 5px;" href="/admin/posts/new"><i class="fa fa-plus"></i> Add new post</a>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="posts-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Published at</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td><a href="/admin/posts/edit/{{$post->id}}" target="_self">{{$post->title}}</a></td>
                            <td>{{$post->published_at}}
                            <td>{{$post->created_at}}
                            <td>{{$post->updated_at}}
                            <td>{{$post->type}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
@endsection

@section('scripts')
@parent
    <script src="/back/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/back/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
      $('.sidebar-menu').each(function () {
        var list = $(this).find('li').each(function(){
          $(this).removeClass('active');
          if($(this).html().indexOf('posts') > 0){
            $(this).addClass('active');
          }
        })
      });
    </script>
        <script>
      $(function () {
       
        $('#posts-table').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "order": [[ 3, "desc" ]],
          "info": true,
          "autoWidth": true
        });
      });
    </script>
@endsection
