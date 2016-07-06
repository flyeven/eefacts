@extends('back.layout')

@section('title', 'Dashboard')

@section('content-header')
    Dashboard
        <small>quick overview</small>
@endsection

@section('breadcrumb')
@parent
    <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i>  Dashboard</a></li>
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
  <!-- Default box -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-hand-paper-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Draws</span>
              <span class="info-box-number">{{$countDraws}}</span>
            </div><!-- /.info-box-content -->
          </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Users</span>
              <span class="info-box-number">{{$countUsers}}</span>
            </div><!-- /.info-box-content -->
          </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-area-chart"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Visits</span>
              <span class="info-box-number">0</span>
            </div><!-- /.info-box-content -->
          </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-bar-chart"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Unique IPs</span>
              <span class="info-box-number">0</span>
            </div><!-- /.info-box-content -->
          </div><!-- /.info-box -->
        </div><!-- /.col -->
    </div>
@endsection

@section('scripts')
@parent
    <script type="text/javascript">
      $('.sidebar-menu').each(function () {
        var list = $(this).find('li').each(function(){
          $(this).removeClass('active');
          if($(this).html().indexOf('Dashboard') > 0){
            $(this).addClass('active');
          }
        })
      });
    </script>
@endsection