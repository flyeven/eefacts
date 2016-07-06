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
    <li><a href="/admin/draws/new"><i class="fa fa-trash"></i>  Delete draw</a></li>
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
                <h3 class="box-title">Delete round of invitations</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="/admin/draws/delete" method="POST">
                <input type="hidden" name="id" value="{{$draw->id}}">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputOfficialNumber" class="col-sm-4 control-label">Official number</label>
                        <div class="col-sm-8">
                            <input type="text" disabled="disabled" name="number" class="form-control" id="inputOfficialNumber" placeholder="Official number (ex. 28)" value="{{old('number', $draw->number)}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCRS" class="col-sm-4 control-label">Lowest CRS Score</label>
                        <div class="col-sm-8">
                            <input type="text" disabled="disabled" name="score" class="form-control" id="inputCRS" placeholder="Lowest CRS Score (ex. 431)" value="{{old('score', $draw->score)}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputInvitations" class="col-sm-4 control-label">No. of invitations</label>
                        <div class="col-sm-8">
                            <input type="text" disabled="disabled" name="invitations" class="form-control" id="inputInvitations" placeholder="No. of invitations" value="{{old('invitations', $draw->invitations)}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRefdate" class="col-sm-4 control-label">Reference datetime</label>
                        <div class="col-sm-4">
                            <input type="text" disabled="disabled" class="form-control" id="inputRefdate" name="refdate" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="{{old('refdate',date('d/m/Y', strtotime($draw->valid_at)))}}">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" disabled="disabled" class="form-control" id="inputReftime" name="reftime" data-inputmask="'alias': 'hh:mm:ss'" data-mask value="{{old('reftime',date('H:i:s', strtotime($draw->valid_at)))}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStartissue" class="col-sm-4 control-label">Issuing period</label>
                        <div class="col-sm-4">
                            <input type="text" disabled="disabled" class="form-control" id="inputStartissue" name="startissue" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="{{old('startissue',date('d/m/Y', strtotime($draw->start_at)))}}">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" disabled="disabled" class="form-control" id="inputEndissue" name="endissue" data-inputmask="'alias': 'dd/mm/yyyy'" value="{{old('endissue',date('d/m/Y', strtotime($draw->end_at)))}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    @if($draw->type % 2 == 0)
                                        <input type="checkbox" disabled="disabled" checked="checked" name="fswp"> Federal Skilled Worker Program
                                    @else
                                        <input type="checkbox" disabled="disabled" name="fswp"> Federal Skilled Worker Program
                                    @endif
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    @if($draw->type % 3 == 0)
                                        <input type="checkbox" disabled="disabled" checked="checked" name="fstp"> Federal Skilled Trades Program
                                    @else
                                        <input type="checkbox"  disabled="disabled" name="fstp"> Federal Skilled Trades Program
                                    @endif
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    @if($draw->type % 5 == 0)
                                        <input type="checkbox" disabled="disabled" checked="checked" name="cec"> Canadian Experience Class
                                    @else
                                        <input type="checkbox" disabled="disabled" name="cec"> Canadian Experience Class
                                    @endif
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    @if($draw->type % 7 == 0)
                                        <input type="checkbox" disabled="disabled" checked="checked" name="pnp"> Provincial Nominee Program
                                    @else
                                        <input type="checkbox" disabled="disabled" name="pnp"> Provincial Nominee Program
                                    @endif
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
          <button type="submit" class="btn btn-danger pull-right">Delete draw</button>
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
