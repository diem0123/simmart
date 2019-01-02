@extends('masteradmin')
@section('title', 'Khách hàng đã đặt')
@section('noidung')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Khách hàng đã đặt
</section>
<div class="row" style="padding: 15px;padding-bottom:5px;margin-top: 10px;">
	<div class="col-md-4">
		<input type="search" class="form-control click" required id="searchhh" placeholder="Nhập từ khóa để tìm" name="keysearch" value="" >
	</div>
	<div class="col-md-8" style="padding-left: ">
		<small class="pull-right">
			<a onclick="areyouokdelete()" class="btn btn-danger"><i class="fa fa-trash-o"></i> Xóa Tất cả</a>
			<div id="areyouokdelete" class="modal fade" role="dialog" style="margin-top: 50px;">
				<div class="modal-dialog">
					<div class="modal-content"  style="width: 60%;margin-left: 130px;border-radius: 5px;">
						<div class="modal-header" style="background: #dd4b39;color:white;padding: 0px;">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-category text-center">Cảnh báo</h4>
						</div>
						<div class="modal-body text-center">
							<p style="font-size: 1.1em;">Bạn có chắc chắn xóa tất cả? nhấn OK để xóa</p>
						</div>
						<div class="modal-footer" style="padding-top: 10px;padding-bottom: 10px;">
							<a href="{{url('admin/infor_customer/deleteall')}}"  class="btn btn-danger">OK</a>
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
<section class="content" style="padding-top: 5px;">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-body" style="padding-left: 30px;padding-right: 30px;">
					<div class="row">
						<div class="data">
							<?php $dem = count($data); ?>
							<div class="colhead" <?php if($dem>8){echo "style='padding-right:15px;'";} ?>>
								<div class="col7" style="border-left: none;"><h4><strong>Khách hàng</strong></h4></div>
								<div class="col7"><h4><strong>Số hóa đơn</strong></h4></div>
								<div class="col7"><h4><strong>Sim đã mua</strong></h4></div>
								<div class="col7"><h4><strong>CMND</strong></h4></div>
								<div class="col7"><h4><strong>Tổng thanh toán</strong></h4></div>
								<div class="col7"><h4><strong>Ngày đặt hàng</strong></h4></div>
								
								<div class="col7"><h4><strong>Chức năng</strong></h4></div>
							</div>
							<div class="scrolll" id="style-1">
								<div class="searchable-container">
									<?php $d=0; ?>
									@if(count($data))
									@foreach($data as $row)
									<div class="itemss sud">
										<div class="value" style="padding-top: 8px;">
											{{$row->name}}
										</div>
										<div class="value" style="padding-top: 8px;">
											{{$row->orderid}}
										</div>
										<div class="value" style="padding-top: 8px;">
											{{$row->productid}}
										</div>
										<div class="value" style="padding-top: 8px;">
											{{$row->cmnd}}
										</div>
										<div class="value" style="padding-top: 8px;">
											<strong>{{number_format($row->price)}}<sup>đ</sup></strong>
										</div>
										<div class="value" style="padding-top: 8px;">
											{{$row->created_at}}
										</div>
										

										<div class="value">
											<a href="{{url('admin/infor_customer/detail/'.$row->id)}}" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
											<a onclick="areyouok{{$d}}()" class="btn btn-danger" >
												<i class="fa fa-trash-o"></i> Xóa</a>
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
															<a href="{{url('admin/infor_customer/delete/'.$row->id)}}" class="btn btn-danger">OK</a>
															<button type="button" class="btn btn-default" data-dismiss="modal">Trở lại</button>
														</div>
													</div>

												</div>
											</div>
										</div>
									</div>
									<?php $d++; ?>
									@endforeach
									@else
										<h4 class="text-center" style="color:red;">Khách hàng đặt hàng trống</h4>
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
@include('admin.modules.required')

@endsection