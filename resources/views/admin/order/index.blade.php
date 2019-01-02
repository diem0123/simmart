@extends('masteradmin')
@section('title', 'Quản lý đơn hàng')
@section('noidung')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Quản lý đơn hàng
      <small>Gồm {{$count}} đơn hàng chưa xác nhận</small>
    </h1>
  </section>
  <div class="ser">
    <input type="search" class="form-control click" required id="searchhh" placeholder="Nhập từ khóa để tìm" name="keysearch" value="" >
  </div>
  <section class="content" style="padding-top: 5px;">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-body" style="padding-left: 30px;padding-right: 30px;">
            <div class="row">

              <div class="data">
                <?php $dem = count($data); ?>
                <div class="colhead" <?php if($dem>8){echo "style='padding-right:15px;'";} ?> >
                  <div class="col7" style="border-left: none;"><h4><strong>Số hóa đơn</strong></h4></div>
                  <div class="col7"><h4><strong>Số sim</strong></h4></div>
                  <div class="col7"><h4><strong>Tổng giá</strong></h4></div>
                  <div class="col7"><h4><strong>Ngày đặt</strong></h4></div>
                  <div class="col7"><h4><strong>Trạng thái</strong></h4></div>
                  <div class="col7"><h4><strong>Xác nhận</strong></h4></div>
                  <div class="col7"><h4><strong>Chức năng</strong></h4></div>
                  
                </div>
                <div class="scrolll" id="style-1">
                  <div class="searchable-container">
                    @if(count($data))
                    @foreach($data as $row)
                    <div class="itemss sud">
                      <div class="value" style="padding-top: 8px;">{{$row->idorder}}</div>
                      <div class="value" style="padding-top: 8px;">
                        @foreach($pro as $so)
                        @if($row->productid == $so->id)
                        {{$so->number}}
                        @endif
                        @endforeach
                      </div>

                      <div class="value" style="padding-top: 8px;">{{number_format($row->price+$row->price_cat+$ship->ship)}}</div>

                      <div class="value" style="padding-top: 8px;">{{$row->created_at}}</div>

                      <div class="value" style="padding-top: 8px;">
                        @foreach($state as $stt)
                        
                        @if($stt->id == $row->stateid)
                        {!!$stt->name!!}
                        @endif

                        @endforeach
                      </div>
                      
                      <div class="value">
                        <a href="{{url('admin/order/confirm/'.$row->id)}}" class="btn btn-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Xác nhận</a>
                      </div>
                      <div class="value">
                       <a href="{{url('admin/order/detail/'.$row->id)}}" class="btn btn-info">Xem</a>
                       <a onclick="areyouok()"  class="btn btn-danger">Hủy HĐ</a>
                       <script>
                        function areyouok(){
                          $(document).ready(function() {
                            $("#areyouok").modal("show")
                          })
                        }
                      </script><div id="areyouok" class="modal fade" role="dialog" style="margin-top: 50px;">
                        <div class="modal-dialog">
                          <div class="modal-content"  style="width: 60%;margin-left: 130px;border-radius: 5px;">
                            <div class="modal-header" style="background: #dd4b39;color:white;padding: 0px;">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-category text-center">Thông báo</h4>
                            </div>
                            <div class="modal-body text-center">
                              <p>Xác nhận hủy hóa đơn ? Nhấn OK để hủy</p>
                            </div>
                            <div class="modal-footer" style="padding-top: 10px;padding-bottom: 10px;">
                              <a href="{{url('admin/order/cancel/'.$row->id)}}" class="btn btn-danger">OK</a>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Trở lại</button>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                  @else
                  <div class="text-center" style="padding-top: 5px;color:red;"><h3>Chưa có đơn hàng nào đặt cả !</h3></div>
                  @endif
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