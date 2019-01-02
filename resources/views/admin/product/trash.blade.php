@extends('masteradmin')
@section('title', 'Số sim đang chuyển')
@section('noidung')

<!-- Content Wrapper. Contains page content -->


<div class="content-wrapper"> <!-- id="contents" -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Quản lý số sim
      <small>Gồm {{$count}} số sim vận chuyển</small>
    </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol> -->
    </section>
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
                        <a href="" class="btn btn-info <?php if(($row->stateid)!=1 &&($row->stateid)!=2) echo "disabled"; ?>" ><i class="fa fa-wrench" aria-hidden="true"></i> Khôi phục</a>
                        <a href="" class="btn btn-danger <?php if(($row->stateid)!=1 &&($row->stateid)!=2) echo "disabled"; ?>"><i class="fa fa-trash-o"></i> Xóa</a>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
                	<!-- <table class="table table-hover table-bordered " id="myTable">
                                      <thead>
                                        <tr style="background: #365cf5;color:white;">
                                          <th class="text-center">Số sim</th>
                                          <th class="text-center">Nhà mạng</th>
                                          <th class="text-center">Giá</th>
                                          <th class="text-center">Loại</th>
                                          <th class="text-center">Trạng thái</th>
                                          <th class="text-center">Thay đổi</th>
                                          <th class="text-center">Chức năng</th>
                                          
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($data as $row)
                                          <tr>
                                            <td class="text-center"><strong>{{$row->number}}</strong></td>
                                            <td class="text-center">
                                              @foreach($nm as $nmm)
                                                @if($row->nhamang == $nmm->id)
                                                  {{$nmm->name}}
                                                @endif
                                              @endforeach
                                              
                                            </td>
                                            <td class="text-center">{{number_format($row->price)}} <sup>vnđ</sup></td>
                                            <td class="text-center">
                                            @foreach($cate as $cat)
                                                @if($row->catid == $cat->id)
                                                  {{$cat->name}}
                                                @endif
                                              @endforeach
                                            </td>
                                            <td class="text-center">
                                              @foreach($state as $stt)
                                                @if($stt->id == $row->stateid)
                                                  {!!$stt->name!!}
                                                @endif
                                              @endforeach
                  
                                            </td>
                                            <td class="text-center">
                                              
                                              
                                              @if($row->stateid == 1)
                                              <a href="" class="btn btn-danger"><i class="fa fa-times-circle-o" aria-hidden="true"></i> Ngưng bán</a>
                                              @endif
                  
                                               @if(($row->stateid == 2) || ($row->stateid==6))
                                              <a href="" class="btn btn-success"><i class="fa fa-undo" aria-hidden="true"></i> Bán lại</a>
                                              @endif
                  
                                              @if(($row->stateid != 2) && ($row->stateid!=1) && ($row->stateid!=6))
                                              <a href="" class="btn btn-info disabled"><i class="fa fa-ban" aria-hidden="true"></i> Chưa xác định</a>
                                              @endif
                  
                                              
                                            </td>
                                            <td class="text-center">
                                              <a href="" class="btn btn-info"><i class="fa fa-wrench" aria-hidden="true"></i> Sửa</a>
                                              <a href="" class="btn btn-danger"><i class="fa fa-trash-o"></i> Xóa</a>
                                            </td>
                                            
                                            
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
                      @include('admin.modules.required')

                      @endsection