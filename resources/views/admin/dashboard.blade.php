@extends('masteradmin')
@section('title', 'Quản lý hệ thống')
@section('noidung')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Thống kê doanh số bán hàng
      <small>Tổng cộng {{count($data)}} hóa đơn đã thanh toán</small>
    </h1>
  </section>
  <div class="row" style="padding: 15px;padding-bottom:5px;margin-top: 10px;">
    <div class="col-md-4">
      <input type="search" class="form-control click" required id="searchhh" placeholder="Nhập từ khóa để tìm" name="keysearch">

    </div>
    <div class="col-md-4">
      <a href="{{'admin/export'}}" class="btn btn-success"><i class="fa fa-download"></i> Tải về Excel</a>
    </div>
    <div class="col-md-4 text-right">

      <a onclick="deleteall()" class="btn btn-danger"><i class="fa fa-trash-o"></i> Xóa tất cả</a>
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
              <a href="{{url('admin/dumama')}}" class="btn btn-danger">OK</a>
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
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-body" style="padding-left: 30px;padding-right: 30px;">
            <div class="row">
              <table class="table table-hover table-bordered" id="myTable">
                <thead style="background: green;color:white;">
                  <tr>
                    <th class="text-left">Tên KH</th>
                    <th class="text-center">CMND</th>
                    <th class="text-center">Số sim đã bán</th>
                    <th class="text-center">Giá thanh toán</th>
                    <th class="text-center">Thời gian thanh toán</th>
                    <th class="text-center">Xem doanh thu trong tháng</th>

                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $row)
                  <tr>
                    <td>{{$row->fullname}}</td>
                    <td class="text-center">{{$row->cmnd}}</td>
                    <td class="text-center">{{$row->number}}</td>
                    <td class="text-center"><strong>{{number_format($row->price)}}<sup>đ</sup></strong></td>
                    <td class="text-center">{{$row->created_at}}</td>
                    <?php $slug=substr($row->date, 5,2)."-".substr($row->date, 0,4); ?>
                    <td class="text-center"><a href="{{url('admin/thongke/'.$slug)}}" class="btn btn-info">Tháng {{substr($row->date, 5,2)}} - {{substr($row->date, 0,4)}}</a></td>
                  </tr>
                  @endforeach
                  
                  
                </tbody>

              </table>
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-6" style="border:1px solid #eeeeee;"><h5>Thống kế</h5></div>
                      <div class="col-md-6" style="border:1px solid #eeeeee;"><h5>Tổng</h5></div>
                    </div>
                    <div class="row" style="border-bottom: 1px solid #eeeeee;">
                      <div class="col-md-6" style="border:1px solid #eeeeee;border-bottom: none;">Tổng số hóa đơn bán được</div>
                      <div class="col-md-6" style="border:1px solid #eeeeee;border-bottom: none;"><strong style="color:red;">{{count($data)}}</strong></div>
                    </div>
                    <div class="row">
                      <div class="col-md-6" style="border:1px solid #eeeeee;border-bottom: none;">Tổng số hóa đơn đã hủy</div>
                      <div class="col-md-6" style="border:1px solid #eeeeee;border-bottom: none;">{{count($data2)}}</div>
                    </div>
                    <div class="row">
                      <div class="col-md-6" style="border:1px solid #eeeeee;">Tổng doanh thu đã đạt được</div>
                      <div class="col-md-6" style="border:1px solid #eeeeee;"><strong style="color:red;">{{number_format($sum)}}<sup>đ</sup></strong></div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection