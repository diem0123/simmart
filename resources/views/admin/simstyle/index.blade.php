@extends('masteradmin')
@section('title', 'Quản lý loại sim')
@section('noidung')


<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Quản lý loại sim
      <small>Gồm {{$count}} loại sim</small>
    </h1>
    </section>
    <div class="row" style="padding: 15px;padding-bottom:5px;margin-top: 10px;">
      <div class="col-md-4">
        <input type="search" class="form-control click" required id="searchhh" placeholder="Nhập từ khóa để tìm" name="keysearch" value="" >
      </div>
      <div class="col-md-8" style="padding-left: ">
        <small class="pull-right">
          <a onclick="insert()" class="btn btn-info"><i class="fa fa-plus-circle"></i> Thêm mới</a>
          <div id="insert" class="modal fade" role="dialog" style="margin-top: 50px;">

          <form id="registrationForm" action="{{url('admin/simstyle/postinsert')}}" method="POST" enctype="multipart/form-data">
           {{csrf_field()}}
           <div class="modal-dialog">
            <div class="modal-content"  style="width: 60%;margin-left: 130px;border-radius: 5px;">
              <div class="modal-header" style="background: green;color:white;padding: 0px;">
                <button style="padding-top: 5px;padding-right: 15px;" type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-category text-center">Thêm mới</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Tên loại sim</label>
                  <input value="{{old('name')}}" type="text" class="form-control" name="name" placeholder="Tên loại sim">
                </div>
              </div>
              <div class="modal-footer" style="padding-top: 10px;padding-bottom: 10px;">
                <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Lưu [mới]</button>
              </div>
            </div>
          </div>
        </form>
      </div>


         <a onclick="deleteall()"class="btn btn-danger"><i class="fa fa-trash-o"></i> Xóa tất cả</a>
         <div id="deleteall" class="modal fade" role="dialog" style="margin-top: 50px;">
        <div class="modal-dialog">
          <div class="modal-content"  style="width: 60%;margin-left: 130px;border-radius: 5px;">
            <div class="modal-header" style="background: #dd4b39;color:white;padding: 0px;">
              <button style="padding-top: 5px;padding-right: 15px;" type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-category text-center">Cảnh báo</h4>
            </div>
            <div class="modal-body text-center">
              <p style="font-size: 1.3em;">Bạn chắc chắn xóa tất cả? Nhấn <strong>OK</strong> để xóa</p>
            </div>
            <div class="modal-footer" style="padding-top: 10px;padding-bottom: 10px;">
              <a href="{{url('admin/simstyle/deleteall')}}" class="btn btn-danger">OK</a>
              <button type="button" class="btn btn-default" data-dismiss="modal">Trở lại</button>
            </div>
          </div>
        </div>
      </div>

         <script>
          function insert(){
            $(document).ready(function() {
              $("#insert").modal("show")
            })
          }
          function deleteall(){
            $(document).ready(function() {
              $("#deleteall").modal("show")
            })
          }
        </script>
        </small>
      </div>
    </div>
    <section class="content" style="padding-top: 5px;">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body" style="padding-left: 30px;padding-right: 30px;">
              <div class="row">
                <div class="data">
                  <?php $dem = count($data); ?>
                  <div class="colhead" <?php if($dem>8){echo "style='padding-right:15px;'";} ?>>
                    <div class="col3" style="border-left: none;"><h4><strong>ID</strong></h4></div>
                    <div class="col3"><h4><strong>Tên loại sim</strong></h4></div>
                    <div class="col3"><h4><strong>Chức năng</strong></h4></div>
                  </div>
                  <div class="scrolll" id="style-1">
                    <div class="searchable-container">
                      <?php $d=0; ?>
                      @foreach($data as $row)
                      <div class="itemss sud">
                        <div class="value3" style="padding-top: 8px;">{{$row->id}}</div>
                        <div class="value3" style="padding-top: 8px;">{{$row->name}}</div>
                        <div class="value3">
                          <a href="{{url('admin/simstyle/update/'.$row->id)}}" class="btn btn-info" ><i class="fa fa-wrench" aria-hidden="true"></i> Sửa</a>
                          <a onclick="areyouok{{$d}}()" class="btn btn-danger" ><i class="fa fa-trash-o"></i> Xóa</a>
                          <script>
                            function areyouok{{$d}}(){
                              $(document).ready(function() {
                                $("#areyouok{{$d}}").modal("show")
                              })
                            }
                          </script>
                          <div id="areyouok{{$d}}" class="modal fade" role="dialog" style="margin-top: 50px;">
                            <div class="modal-dialog">
                              <!-- Modal content-->
                              <div class="modal-content"  style="width: 60%;margin-left: 130px;border-radius: 5px;">
                                <div class="modal-header" style="background: #dd4b39;color:white;padding: 0px;">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-category">Thông báo</h4>
                                </div>
                                <div class="modal-body">
                                  <p>Bạn có chắc chắn xóa? nhấn OK để xóa</p>
                                </div>
                                <div class="modal-footer" style="padding-top: 10px;padding-bottom: 10px;">
                                  <a href="{{url('admin/simstyle/delete/'.$row->id)}}" class="btn btn-danger">OK</a>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Trở lại</button>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                      <?php $d++; ?>
                      @endforeach
                    </div>
                  </div>
                </div>

              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('admin.modules.required')
  <script>
  $(document).ready(function() {
    $('#registrationForm').bootstrapValidator({
      feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
      },
      fields: {
        name: {
          message: 'The username is not valid',
          validators: {
            notEmpty: {
              message: 'Tên loại sim không được bỏ trống'
            }
          }
        }
      }
    });
  });
</script>

  @endsection