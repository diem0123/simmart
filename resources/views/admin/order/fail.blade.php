@extends('masteradmin')
@section('title', 'Đơn hàng đã hủy')
@section('noidung')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Đơn hàng đã hủy
        <small>Gồm {{$count}} đơn hàng đã hủy</small>
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol> -->
    </section>
  <div class="row" style="padding: 15px;padding-bottom:5px;margin-top: 10px;">
    <div class="col-md-4">
      <input type="search" class="form-control click" required id="searchhh" placeholder="Nhập từ khóa để tìm" name="keysearch" value="" >
    </div>
    <div class="col-md-8" style="padding-left: ">
      <small class="pull-right">
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
              <a href="{{url('admin/order/deleteallfail')}}" class="btn btn-danger">OK</a>
              <button type="button" class="btn btn-default" data-dismiss="modal">Trở lại</button>
            </div>
          </div>
        </div>
      </div>
    </small>

    <script>
      function deleteall(){
        $(document).ready(function() {
          $("#deleteall").modal("show")
        })
      }
    </script>
  </div>
</div>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body" style="padding-left: 30px;padding-right: 30px;">
				    <div class="row">
              <div class="data">
                  <?php $dem = count($data); ?>
                  <div class="colhead" <?php if($dem>8){echo "style='padding-right:15px;'";} ?>>
                    <div class="col7" style="border-left: none;"><h4><strong>Số hóa đơn</strong></h4></div>
                    <div class="col7"><h4><strong>Số sim</strong></h4></div>
                    <div class="col7"><h4><strong>Giá</strong></h4></div>
                    <div class="col7"><h4><strong>Ngày đặt</strong></h4></div>
                    <div class="col7"><h4><strong>Trạng thái</strong></h4></div>
                    <div class="col7"><h4><strong>Xem</strong></h4></div>
                    <div class="col7"><h4><strong>Xóa</strong></h4></div>
                  </div>
                  <div class="scrolll">
                    <div class="searchable-container">
                      @if(count($data))
                      <?php $d=0; ?>
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
                        <div class="value" style="padding-top: 8px;">{{number_format($row->price+$row->price_cat+$ship->ship)}} <sup>vnđ</sup></div>
                        <div class="value" style="padding-top: 8px;">{{$row->createdate}}</div>
                        <div class="value" style="padding-top: 8px;">
                          @foreach($state as $stt)
                          @if($stt->id == $row->stateid)
                          {!!$stt->name!!}
                          @endif
                          @endforeach
                        </div>
                        <div class="value">
                         <a href="{{url('admin/order/detail/'.$row->id)}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                       </div>
                       <div class="value">
                        <a onclick="areyouok{{$d}}()" class="btn btn-danger"><i class="fa fa-ban" aria-hidden="true"></i> Xóa đơn hàng</a>
                      </div>
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
                                  <h4 class="modal-category text-center">Thông báo</h4>
                                </div>
                                <div class="modal-body text-center">
                                  <p>Bạn có chắc chắn Hủy đơn hàng? nhấn OK để hủy</p>
                                </div>
                                <div class="modal-footer" style="padding-top: 10px;padding-bottom: 10px;">
                                  <a href="{{url('admin/order/delete/'.$row->id)}}" class="btn btn-danger">OK</a>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Trở lại</button>
                                </div>
                              </div>

                            </div>
                          </div>  
                    </div>
                    <?php $d++; ?>
                    @endforeach
                    @else
                    <div class="text-center" style="padding-top: 5px;color:red;"><h3>Không có đơn hàng đã hủy !</h3></div>
                    @endif
                  </div>
                </div>
              </div>
                	<!-- <table class="table table-hover table-bordered" id="myTable">
                                      <thead>
                                        <tr>
                                          <th class="text-left">Số hóa đơn</th>
                                          <th class="text-center">Số sim</th>
                                          <th class="text-center">Giá</th>
                                          <th class="text-center">Ngày đặt</th>
                                          <th class="text-center">Trạng thái</th>
                                          <th class="text-center">Xem</th>
                  
                                          <th class="text-center">Xóa luôn</th>
                                          
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($data as $row)
                                          <tr>
                                            <td>{{$row->idorder}}</td>
                                            <td class="text-center">
                                              @foreach($pro as $so)
                                                @if($row->productid == $so->id)
                                                  {{$so->number}}
                                                @endif
                                              @endforeach
                                              
                                            </td>
                                            <td class="text-center">{{number_format($row->price)}} <sup>vnđ</sup></td>
                                            <td class="text-center">{{$row->createdate}}</td>
                                            <td class="text-center">
                                              @foreach($state as $stt)
                                                @if($stt->id == $row->stateid)
                                                  {!!$stt->name!!}
                                                @endif
                                              @endforeach
                  
                                            </td>
                                            <td class="text-center">
                                              <a href="{{url('admin/order/detail/'.$row->id)}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                            </td>
                                            
                                            <td class="text-center"><a href="{{url('admin/order/delete/'.$row->id)}}" class="btn btn-danger"><i class="fa fa-ban" aria-hidden="true"></i> Xóa đơn hàng</a></td>
                                          </tr>
                                          @endforeach
                  
                                        <div class="container-fluid">
                  
                                        </div>
                                      </tbody>
                  
                                    </table> -->
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
  
@endsection