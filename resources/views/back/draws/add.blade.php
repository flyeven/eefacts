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
    <li><a href="/admin/draws/new"><i class="fa fa-plus"></i>  Add new draw</a></li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Add new round of invitations</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="/admin/draws/new" method="POST">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputOfficialNumber" class="col-sm-4 control-label">Official number</label>
                        <div class="col-sm-8">
                            <input type="text" name="number" class="form-control" id="inputOfficialNumber" placeholder="Official number (ex. 28)" value="{{old('number')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCRS" class="col-sm-4 control-label">Lowest CRS Score</label>
                        <div class="col-sm-8">
                            <input type="text" name="score" class="form-control" id="inputCRS" placeholder="Lowest CRS Score (ex. 431)" value="{{old('score')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputInvitations" class="col-sm-4 control-label">No. of invitations</label>
                        <div class="col-sm-8">
                            <input type="text" name="invitations" class="form-control" id="inputInvitations" placeholder="No. of invitations" value="{{old('invitations')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRefdate" class="col-sm-4 control-label">Reference datetime</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="inputRefdate" name="refdate" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="{{old('refdate')}}">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="inputReftime" name="reftime" data-inputmask="'alias': 'hh:mm:ss'" data-mask value="{{old('reftime')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStartissue" class="col-sm-4 control-label">Issuing period</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="inputStartissue" name="startissue" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="{{old('startissue')}}">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="inputEndissue" name="endissue" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="{{old('endissue')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" checked="checked" name="fswp"> Federal Skilled Worker Program
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" checked="checked" name="fstp"> Federal Skilled Trades Program
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" checked="checked" name="cec"> Canadian Experience Class
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" checked="checked" name="pnp"> Provincial Nominee Program
                                </label>
                            </div>
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
          <a href="/admin/draws/" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-info pull-right">Save draw</button>
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
          if($(this).html().indexOf('Draws') > 0){
            $(this).addClass('active');
          }
        })
      });
    </script>

    <script>
        $('#inputRefdate').on('blur', function() {
            
            $('#inputStartissue').val($('#inputRefdate').val());
            
            var ddmmyy = $('#inputRefdate').val().split("/");
            var date = new Date(ddmmyy[2], ddmmyy[1] - 1, ddmmyy[0]);
            date.setDate(date.getDate() + 1);
            var dd = date.getDate(); 
            var mm = date.getMonth()+1; //January is 0! 
            var yyyy = date.getFullYear(); 
            if(dd<10){dd='0'+dd} 
            if(mm<10){mm='0'+mm}
            var nextday = dd + "/" + mm + "/" + yyyy;

            $('#inputEndissue').val(nextday);
        });
    </script>

@endsection
