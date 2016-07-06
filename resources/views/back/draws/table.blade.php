@extends('back.layout')

@section('title', 'Rounds of invitations')

@section('top-scripts')
@parent
    <link rel="stylesheet" href="/back/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('content-header')
    Draws
        <small>manage rounds of invitations</small>
@endsection

@section('breadcrumb')
@parent
    <li><a href="/admin/draws"><i class="fa fa-hand-paper-o"></i>  Rounds of invitations</a></li>
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
            <h3 class="box-title">Previous rounds of invitations</h3>
            <a class="btn btn-primary pull-right" style="margin-right: 5px;" href="/admin/draws/new"><i class="fa fa-plus"></i> Add new round</a>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="draws-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Reference date</th>
                        <th>CRS Score</th>
                        <th>Invitations</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($draws as $draw)
                        <tr>
                            <td>{{$draw->number}}</td>
                            <td><a href="/admin/draws/edit/{{$draw->id}}" target="_self">{{$draw->valid_at}}</a></td>
                            <td>{{$draw->score}}</td>
                            <td>{{$draw->invitations}}</td>
                            <td>{{$draw->type}}</td>
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
          if($(this).html().indexOf('Draws') > 0){
            $(this).addClass('active');
          }
        })
      });
    </script>
        <script>
      $(function () {
       
        $('#draws-table').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "order": [[ 1, "desc" ]],
          "info": true,
          "autoWidth": true
        });
      });
    </script>
@endsection
