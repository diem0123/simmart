@extends('masteradmin')
@section('title', 'Số sim đã thanh toán')
@section('noidung')

<!-- Content Wrapper. Contains page content -->


<div class="content-wrapper"> <!-- id="contents" -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Quản lý số sim
      <small>Gồm {{$count}} số sim đã thanh toán</small>
    </h1>
  </section>
  <div class="row" style="padding: 15px;padding-bottom:5px;margin-top: 10px;">
    <div class="col-md-4">
      <input type="search" class="form-control click" required id="searchhh" placeholder="Nhập từ khóa để tìm" name="keysearch" value="" >
    </div>
    <div class="col-md-8">
      <small class="pull-right">
        <a onclick="areyouokdelete()" class="btn btn-danger"><i class="fa fa-trash-o"></i> Xóa Tất cả</a>
        <div id="areyouokdelete" class="modal fade" role="dialog" style="margin-top: 50px;">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content"  style="width: 60%;margin-left: 130px;border-radius: 5px;">
              <div class="modal-header" style="background: #dd4b39;color:white;padding: 0px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-category text-center">Cảnh báo</h4>
              </div>
              <div class="modal-body text-center">
                <p style="font-size: 1.1em;">Bạn có chắc chắn xóa tất cả? nhấn OK để xóa</p>
              </div>
              <div class="modal-footer" style="padding-top: 10px;padding-bottom: 10px;">
                <a href="{{url('admin/product/deleteallship')}}"  class="btn btn-danger">OK</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Trở lại</button>
              </div>
            </div>

          </div>
        </div>
        <script>
          function areyouokdelete(){
            $(document).ready(function() {
              $("#areyouokdelete").modal("show")
            })
          }
        </script>
      </small>
      

    </div>
    <div class="col-md-3">

    </div>
  </div>
  <!-- Main content -->
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
                  <div class="col7" style="border-left: none;"><h4><strong>Số sim</strong></h4></div>
                  <div class="col7"><h4><strong>Nhà mạng</strong></h4></div>
                  <div class="col7"><h4><strong>Giá</strong></h4></div>
                  <div class="col7"><h4><strong>Loại</strong></h4></div>
                  <div class="col7"><h4><strong>Trạng thái</strong></h4></div>
                  <div class="col7"><h4><strong>Thay đổi</strong></h4></div>
                  <div class="col7"><h4><strong>Chức năng</strong></h4></div>
                </div>
                <div class="scrolll" id="style-1">
                  <div class="searchable-container">
                    @if($dem!=0)
                    @foreach($data as $row)
                    <div class="itemss sud">
                      <div class="value" style="padding-top: 8px;">{{$row->number}}</div>
                      <div class="value" style="padding-top: 8px;">
                        @foreach($nm as $nmm)
                        @if($row->nhamang == $nmm->id)
                        {{$nmm->name}}
                        @endif
                        @endforeach
                      </div>
                      <div class="value" style="padding-top: 8px;">{{number_format($row->price)}} <sup>vnđ</sup></div>
                      <div class="value" style="padding-top: 8px;">
                        @foreach($cate as $cat)
                        @if($row->catid == $cat->id)
                        {{$cat->name}}
                        @endif
                        @endforeach
                      </div>
                      <div class="value" style="padding-top: 8px;">
                        @foreach($state as $stt)
                        @if($stt->id == $row->stateid)
                        {!!$stt->name!!}
                        @endif
                        @endforeach
                      </div>
                      <div class="value">
                       @if($row->stateid == 1)
                       <a href="" class="btn btn-danger"><i class="fa fa-times-circle-o" aria-hidden="true"></i> Ngưng bán</a>
                       @endif

                       @if(($row->stateid == 2) || ($row->stateid==6))
                       <a href="" class="btn btn-success"><i class="fa fa-undo" aria-hidden="true"></i> Bán lại</a>
                       @endif

                       @if(($row->stateid != 2) && ($row->stateid!=1) && ($row->stateid!=6))
                       <a href="" class="btn btn-info disabled"><i class="fa fa-ban" aria-hidden="true"></i> Chưa xác định</a>
                       @endif
                     </div>
                     <div class="value">
                      <a href="" class="btn btn-info <?php if(($row->stateid)!=1 &&($row->stateid)!=2) echo "disabled"; ?>" ><i class="fa fa-wrench" aria-hidden="true"></i> Sửa</a>
                      <a href="" class="btn btn-danger <?php if(($row->stateid)!=1 &&($row->stateid)!=2) echo "disabled"; ?>"><i class="fa fa-trash-o"></i> Xóa</a>
                    </div>
                  </div>
                  @endforeach
                </div>
                @else
              <p style="color:red;text-align: center;">Trống</p>
              @endif
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

@endsection