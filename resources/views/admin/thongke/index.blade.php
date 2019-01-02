@extends('masteradmin')
@section('title', 'Thống kê tháng '.$date)
@section('noidung')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Thông kê tháng {{$date}}
      <small></small>
    </h1>
  </section>
  <div class="row" style="padding: 15px;padding-bottom:5px;margin-top: 10px;">
    <div class="col-md-4">
      <input type="search" class="form-control click" required id="searchhh" placeholder="Nhập từ khóa để tìm" name="keysearch">

    </div>
    <div class="col-md-4">
      <a href="{{url('admin/thongke/export/'.$date)}}" class="btn btn-success"><i class="fa fa-download"></i> Tải về Excel</a>
      
  </div>
    <div class="col-md-4 text-right">

      <a onclick="deleteall()" class="btn btn-danger"><i class="fa fa-trash-o"></i> Xóa tất cả</a>
      <a href="{{url('admin')}}" class="btn btn-warning"><i class="fa fa-undo"></i> Trở lại</a>
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
              <a href="{{url('admin/thongke/deletedate/'.$date)}}" class="btn btn-danger">OK</a>
              <button type="button" class="btn btn-default" data-dismiss="modal">Trở lại</button>
            </div>
          </div>
        </div>
      </div>

      <script>
        function deleteall(){
            $(document).ready(function() {
              $("#deleteall").modal("show")
            })
          }
      </script>
    </div>
</div>
<section class="content" style="padding-top: 5px;">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body" style="padding-left: 30px;padding-right: 30px;">
          <div class="row">
            <div class="data">
              <div class="colhead">
                <div class="col5" style="border-left: none;"><h4><strong>Tên KH</strong></h4></div>
                <div class="col5"><h4><strong>CMND</strong></h4></div>
                <div class="col5"><h4><strong>Sim đã bán</strong></h4></div>
                <div class="col5"><h4><strong>Thời gian thanh toán</strong></h4></div>
                <div class="col5"><h4><strong>Giá thanh toán</strong></h4></div>
              </div>
              <div class="scrolll" id="style-1"  style="height: 380px;">
                <div class="searchable-container">
                  <?php $sum = 0; ?>
                  <?php $count = 0; ?>
                  @foreach($data as $row)
                  <?php $year = substr($row->date, 0,4); $month = substr($row->date, 5,2); 
                    $time = $month."-".$year;
                   ?>
                  @if($date == $time)
                  <?php $sum +=$row->price; 
                      $count = count($data);
                  ?>
                  <div class="itemss sud">
                    <div class="value5">{{$row->fullname}}</div>
                    <div class="value5">{{$row->cmnd}}</div>
                    <div class="value5">{{$row->number}}</div>
                    <div class="value5">{{$row->created_at}}</div>
                    <div class="value5"><strong style="color:red;">{{number_format($row->price)}}<sup>đ</sup></strong></div>
                  </div>
                  @endif
                  @endforeach

                </div>
              </div>
            </div>
            <div class="text-right" style="margin-top: 5px;padding-right:60px;">
              <p>TỔNG DOANH THU TRONG THÁNG {{$date}} : &nbsp;&nbsp;&nbsp;<strong style="color:red;font-size: 1.6em;"> {{number_format($sum)}}<sup>đ</sup></strong>
              </p>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>

@endsection