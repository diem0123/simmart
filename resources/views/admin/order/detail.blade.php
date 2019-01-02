@extends('masteradmin')
@section('title',$row->idorder)
@section('noidung')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		Đơn hàng {{$row->idorder}}
		<small class="pull-right">
		<a href="{{url('admin/order')}}" class="btn btn-danger"><i class="fa fa-undo"></i> Trở lại</a>
		</small>
		</h1>
		
		<!-- <ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol> -->
	</section>
	
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<!-- /.box-header -->
					<div class="box-body" style="padding-left: 30px;padding-right: 30px;">
						<div class="row">
							<form action="" method="POST" enctype="multipart/form-data">
								{{csrf_field()}}
								<div class="col-md-6">
									
									<table class="table table-hover table-bordered">
										<tr>
											<td>Số hóa đơn</td>
											<td>{{$row->idorder}}</td>
										</tr>
										<tr>
											<td>Số sim</td>
											<td>@foreach($pro as $so)
												@if($row->productid == $so->id)
												<strong>{{$so->number}}</strong>
												@endif
												@endforeach
											</td>
										</tr>
										
										<tr>
											<td>Giới tính</td>
											<td>
												@if($row->sex==1)
												Nam
												@else
												Nữ
												@endif
												
											</td>
										</tr>
										<tr>
											<td>Tên khách hàng</td>
											<td>{{$row->fullname}}</td>
										</tr>
										@if($row->address != null)
										<tr>
											<td>Địa chỉ nhận hàng</td>
											<td>{{$row->address}}</td>
										</tr>
										@endif
										<tr>
											<td>Số điện thoại</td>
											<td>0{{$row->phone}}</td>
										</tr>
										<tr>
											<td>CMND</td>
											<td>{{$row->cmnd}}</td>
										</tr>
										@if($row->email !=null)
										<tr>
											<td>Email</td>
											<td>{{$row->email}}</td>
										</tr>
										@endif
										<tr>
											<td>Ngày đặt</td>
											<td>{{$row->created_at}}</td>
										</tr>
										
										
									</table>
									
								</div>
								<div class="col-md-6">
									<table class="table table-bordered table-hover">
										<tr>
											<td>Ngày giao</td>
											<td><input type="date" value="{{$row->shipdate}}" name="shipdate" class="form-control"></td>
										</tr>
										<tr>
											<td>Giờ giao</td>
											<td>
												@for($i=1;$i<25;$i++)
												@if($i == $row->shiptime)
												Trước {{$row->shiptime}} giờ
												@endif
												@endfor
											</td>
										</tr>
										<tr>
											<td>Giá sim</td>
											<td>{{number_format($row->price)}} <sup>vnđ</sup></td>
										</tr>
										<tr>
											<td>Giá Gói khuyến mãi</td>
											<td>{{number_format($row->price_cat)}} <sup>vnđ</sup></td>
										</tr>
										<tr>
											<td>Giá chuyển hàng</td>
											<td>{{number_format($ship->ship)}} <sup>vnđ</sup></td>
										</tr>
										<tr>
											<td>Tổng cộng</td>
											<td><strong style="color:red;">
												{{number_format($ship->ship+$row->price+$row->price_cat)}} <sup>vnđ</sup>
											</strong></td>
										</tr>
										<tr>
											<td>Trạng thái hóa đơn</td>
											<td>
												@foreach($state as $stt)
												@if($stt->id == $row->stateid)
												{!!$stt->name!!}
												@endif
												@endforeach
											</td>
										</tr>
										<tr>
											<td>Chức năng</td>
											<td>
												@if($row->stateid==3)
												<button type="submit" class="btn btn-success" ><i class="fa fa-check-circle-o"></i> Xác nhận đơn hàng</button>
												<a onclick="areyouok()"  class="btn btn-danger"><i class="fa fa-ban" ></i> Hủy đơn hàng</a>
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
																<p>Xác nhận <strong>hủy</strong> hóa đơn ? Nhấn OK để hủy</p>
															</div>
															<div class="modal-footer" style="padding-top: 10px;padding-bottom: 10px;">
																<a href="{{url('admin/order/cancel/'.$row->id)}}" class="btn btn-danger">OK</a>
																<button type="button" class="btn btn-default" data-dismiss="modal">Trở lại</button>
															</div>
														</div>
														
													</div>
												</div>
												<br>
												@endif
												@if($row->stateid==4)
												<a href="{{url('admin/order/money/'.$row->id)}}" class="btn btn-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Thanh toán xong</a>
												<a href="{{url('admin/order/cancel/'.$row->id)}}" class="btn btn-danger"><i class="fa fa-ban" ></i> Hủy đơn hàng</a>
												<br>
												@endif
												@if(($row->stateid==5) || ($row->stateid==6))
												<a onclick="areyouokdelete()" class="btn btn-danger"><i class="fa fa-ban" ></i> Xóa luôn</a><br>
												@endif
											</td>
										</tr>
										<script>
											function areyouokdelete(){
												$(document).ready(function() {
													$("#areyouokdelete").modal("show")
												})
											}
										</script><div id="areyouokdelete" class="modal fade" role="dialog" style="margin-top: 50px;">
											<div class="modal-dialog">
												<div class="modal-content"  style="width: 60%;margin-left: 130px;border-radius: 5px;">
													<div class="modal-header" style="background: #dd4b39;color:white;padding: 0px;">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-category text-center">Thông báo</h4>
													</div>
													<div class="modal-body text-center">
														<p>Xác nhận <strong>hủy</strong> hóa đơn ? Nhấn OK để hủy</p>
													</div>
													<div class="modal-footer" style="padding-top: 10px;padding-bottom: 10px;">
														<a href="{{url('admin/order/deleteback/'.$row->id)}}" class="btn btn-danger">OK</a>
														<button type="button" class="btn btn-default" data-dismiss="modal">Trở lại</button>
													</div>
												</div>
												
											</div>
										</div>
										
									</table>
								</div>
							</form>
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
	
	<div class="content">
		<div class="box">
			<div class="box-body" style="padding-left: 30px;padding-right: 30px;">
				
				{{-- /* =============== > TÍNH CƯỚC VẬN CHUYỂN < =============== */ --}}
{{-- 				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="input-group">
							<span class="input-group-btn">
								<button style="width:149px" class="btn btn-primary" type="button">Tỉnh/TP (gửi)</button>
							</span>
							<input id="pick_province1" name="pick_province" class="form-control" type="text" placeholder="Nhập (tỉnh/thành phố) gửi hàng">
						</div>
						<div style="border-bottom: 1px solid #fff; margin: 3px"></div>
						<div class="input-group">
							<span class="input-group-btn">
								<button style="width:149px" class="btn btn-primary" type="button">Quận/Huyện (gửi)</button>
							</span>
							<input id="pick_district1" name="pick_district" class="form-control" type="text" placeholder="Nhập (quận/huyện) gửi hàng">
						</div>
						
						
						<br><div class="input-group">
							<span class="input-group-btn">
								<button style="width:149px" class="btn btn-primary" type="button">Tỉnh/TP (nhận)</button>
							</span>
							<input name="province" class="form-control" type="text" placeholder="Nhập (tỉnh/thành phố) nhận hàng">
						</div>
						<div style="border-bottom: 1px solid #fff; margin: 3px"></div>
						<div class="input-group">
							<span class="input-group-btn">
								<button style="width:149px" class="btn btn-primary" type="button">Quận/Huyện (nhận)</button>
							</span>
							<input name="district" class="form-control" type="text" placeholder="Nhập (quận/huyện) nhận hàng">
						</div>
						<div style="border-bottom: 1px solid #fff; margin: 3px"></div>
						<div class="input-group">
							<span class="input-group-btn">
								<button style="width:149px" class="btn btn-primary" type="button">Số nhà (nhận)</button>
							</span>
							<input name="address" class="form-control" type="text" placeholder="Nhập (số nhà) nhận hàng">
						</div>
						<br><div class="input-group">
							<span class="input-group-btn">
								<button style="width:149px" class="btn btn-primary" type="button">Cân nặng</button>
							</span>
							<input name="weight" class="form-control" type="text" placeholder="Nhập khối lượng hàng (đvt: gam)">
						</div>
						
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<center>
						<br><br><label>Cước phí (giao hàng tiết kiệm)</label>
						<br>
						<button id="tinhcuoc" class="btn btn-primary" type="button">Tính cước</button>
						<h3 id="price" style="color: red"></h3>
						</center>
					</div>
				</div> --}}
				{{-- /* =============== > / TÍNH CƯỚC VẬN CHUYỂN < =============== */ --}}
				
				{{-- /* =============== > GỬI ĐƠN HÀNG CHO DỊCH VỤ VẬN CHUYỂN < =============== */ --}}
{{-- 				<div style="border-bottom: 1px solid #fff; margin: 12px"></div>
				
				<section class="panel panel-primary">
					<header class="ck_top panel-heading">
						Gửi đơn hàng cho (Giao hàng tiết kiệm) vận chuyển
						<span class="pull-right ck_icon glyphicon glyphicon-chevron-right"></span>
					</header>
					<div class="ck_content panel-body">
						<div style="border-bottom: 1px solid #fff; margin: 3px"></div>
						<div class="input-group">
							<span class="input-group-btn">
								<button style="width:149px" class="btn btn-primary" type="button">Số hóa đơn</button>
							</span>
							<input name="id" value="{{$row->idorder}}" class="form-control" type="text" placeholder="Nhập số hóa đơn">
						</div>
						<div style="border-bottom: 1px solid #fff; margin: 3px"></div>
						<div class="input-group">
							<span class="input-group-btn">
								<button style="width:149px" class="btn btn-primary" type="button">Người gửi</button>
							</span>
							<input name="pick_name" class="form-control" type="text" placeholder="Nhập tên người liên hệ lấy hàng hóa">
						</div>
						<div style="border-bottom: 1px solid #fff; margin: 3px"></div>
						<div class="input-group">
							<span class="input-group-btn">
								<button style="width:149px" class="btn btn-primary" type="button">Điện thoại (nơi gửi)</button>
							</span>
							<input name="pick_tel" class="form-control" type="text" placeholder="Nhập số điện thoại liên hệ nơi lấy hàng hóa">
						</div>
						<div style="border-bottom: 1px solid #fff; margin: 3px"></div>
						<div class="input-group">
							<span class="input-group-btn">
								<button style="width:149px" class="btn btn-primary" type="button">Địa chỉ ngắn gọn</button>
							</span>
							<input name="pick_address" class="form-control" type="text" placeholder="Nhập Địa chỉ ngắn gọn để lấy nhận hàng hóa">
						</div>
						<div style="border-bottom: 1px solid #fff; margin: 3px"></div>
						<div class="input-group">
							<span class="input-group-btn">
								<button style="width:149px" class="btn btn-primary" type="button">Tỉnh/TP (gửi)</button>
							</span>
							<input id="pick_province2" name="pick_province" class="form-control" type="text" placeholder="Nhập (tỉnh/thành phố) gửi hàng">
						</div>
						<div style="border-bottom: 1px solid #fff; margin: 3px"></div>
						<div class="input-group">
							<span class="input-group-btn">
								<button style="width:149px" class="btn btn-primary" type="button">Quận/Huyện (gửi)</button>
							</span>
							<input id="pick_district2" name="pick_district" class="form-control" type="text" placeholder="Nhập (quận/huyện) gửi hàng">
						</div>
						<div style="border-bottom: 1px solid #fff; margin: 3px"></div>
						<div class="input-group">
							<span class="input-group-btn">
								<button style="width:149px" class="btn btn-primary" type="button">Người nhận</button>
							</span>
							<input name="name" class="form-control" type="text" placeholder="Nhập tên người nhận hàng">
						</div>
						<div style="border-bottom: 1px solid #fff; margin: 3px"></div>
						<div class="input-group">
							<span class="input-group-btn">
								<button style="width:149px" class="btn btn-primary" type="button">Điện thoại (nơi nhận)</button>
							</span>
							<input name="tel" class="form-control" type="text" placeholder="Nhập số điện thoại người nhận hàng hóa">
						</div>
						<div style="border-bottom: 1px solid #fff; margin: 3px"></div>
						<div class="input-group">
							<span class="input-group-btn">
								<button style="width:149px" class="btn btn-primary" type="button">Địa chỉ chi tiết</button>
							</span>
							<input name="address" class="form-control" type="text" placeholder="Nhập địa chỉ chi tiết của người nhận hàng">
						</div>
						<div style="border-bottom: 1px solid #fff; margin: 3px"></div>
						<div class="input-group">
							<span class="input-group-btn">
								<button style="width:149px" class="btn btn-primary" type="button">Tỉnh/TP (nhận)</button>
							</span>
							<input name="province" class="form-control" type="text" placeholder="Nhập tỉnh/thành phố của người nhận hàng hóa">
						</div>
						<div style="border-bottom: 1px solid #fff; margin: 3px"></div>
						<div class="input-group">
							<span class="input-group-btn">
								<button style="width:149px" class="btn btn-primary" type="button">Quận/Huyện (nhận)</button>
							</span>
							<input name="district" class="form-control" type="text" placeholder="Nhập quận/huyện của người nhận hàng hóa">
						</div>
						<div style="border-bottom: 1px solid #fff; margin: 3px"></div>
						<div class="input-group">
							<span class="input-group-btn">
								<button style="width:149px" class="btn btn-primary" type="button">Thu hộ</button>
							</span>
							<input name="pick_money" class="form-control" type="text" placeholder="Nhập số tiền cần thu hộ. Nếu bằng 0 thì không thu hộ tiền. Tính theo VNĐ">
						</div>
						<div style="border-bottom: 1px solid #fff; margin: 3px"></div>
						<div class="input-group">
							<span class="input-group-btn">
								<button style="width:149px" class="btn btn-primary" type="button">Ghi chú</button>
							</span>
							<input name="note" class="form-control" type="text" placeholder="Nhập thông tin cần lưu ý">
						</div>
					</div>
				</section> --}}
				{{-- /* =============== > / GỬI ĐƠN HÀNG CHO DỊCH VỤ VẬN CHUYỂN < =============== */ --}}
				
			</div>
		</div>
	</div>
</div>
<!-- /.content-wrapper -->

@endsection

<script
src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>

<script type="text/javascript">
	$(function () {

		$(document).on('keyup', '#pick_province1',function(){
			$('#pick_province2').val($(this).val());
		});
		$(document).on('keyup', '#pick_province2',function(){
			$('#pick_province1').val($(this).val());
		});
		$(document).on('change', '#pick_province1',function(){
			$('#pick_province2').val($(this).val());
		});
		$(document).on('change', '#pick_province2',function(){
			$('#pick_province1').val($(this).val());
		});

		$(document).on('keyup', '#pick_district1',function(){
			$('#pick_district2').val($(this).val());
		});
		$(document).on('keyup', '#pick_district2',function(){
			$('#pick_district1').val($(this).val());
		});
		$(document).on('change', '#pick_district1',function(){
			$('#pick_district2').val($(this).val());
		});
		$(document).on('change', '#pick_district2',function(){
			$('#pick_district1').val($(this).val());
		});

		$(document).on('click', '#tinhcuoc',function(){
			var pick_province = $('[name="pick_province"]').val();
			var pick_district = $('[name="pick_district"]').val();
			var province = $('[name="province"]').val();
			var district = $('[name="district"]').val();
			var address = $('[name="address"]').val();
			var weight = $('[name="weight"]').val();
			$.ajax({
				url: '/api/tinhcuoc',
				type: 'POST',
				dataType: 'text',
				data : {
					send : 'ok',
					pick_province: pick_province,
					pick_district: pick_district,
					province: province,
					district: district,
					address: address,
					weight: weight
				},
				success:function(data) {
					obj = jQuery.parseJSON(data);
					console.log(obj);
					if (obj.success == false) {
						$('#price').text('Thông tin bạn nhập chưa đầy đủ');
					}else{
						if (obj.fee.delivery == false) {
							$('#price').text('Tuyến đường không được phục vụ');
						}else{
							price = (obj.fee.fee + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
							$('#price').text(price);
						}
					}
				}
			});
		});
	});
</script>