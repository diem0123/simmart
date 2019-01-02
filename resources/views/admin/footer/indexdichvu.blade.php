@extends('masteradmin')
@section('title', 'Dịch vụ')
@section('noidung')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dịch vụ
			<small>Gồm {{count($data)}} dịch vụ</small>
		</h1>
	</section>
	<div class="row" style="padding: 15px;padding-bottom:5px;margin-top: 10px;">
		<div class="col-md-4">
			<input type="search" class="form-control click" required id="searchhh" placeholder="Nhập từ khóa để tìm" name="keysearch" value="" >
		</div>
		<div class="col-md-8" style="padding-left: ">
			<small class="pull-right">
				<a href="{{url('admin/footer/dichvu/insert')}}" class="btn btn-info"><i class="fa fa-plus-circle"></i> Thêm mới</a>
				<a onclick="areyouokdeleteall()" class="btn btn-danger"><i class="fa fa-trash-o"></i> Xóa tất cả</a>
				<script>
					function areyouokdeleteall(){
						$(document).ready(function() {
							$("#areyouokdeleteall").modal("show")
						})
					}
				</script>
				<div id="areyouokdeleteall" class="modal fade" role="dialog" style="margin-top: 50px;">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content"  style="width: 60%;margin-left: 130px;border-radius: 5px;">
							<div class="modal-header" style="background: #dd4b39;color:white;padding: 0px;">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-category text-center">Thông báo</h4>
							</div>
							<div class="modal-body text-center">
								<p style="font-size: 1.3em;">Bạn có chắc chắn xóa hết? nhấn OK để xóa</p>
							</div>
							<div class="modal-footer" style="padding-top: 10px;padding-bottom: 10px;">
								<a href="{{url('admin/dichvu/deleteall')}}" class="btn btn-danger">OK</a>
								<button type="button" class="btn btn-default" data-dismiss="modal">Trở lại</button>
							</div>
						</div>

					</div>
				</div>
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
									<div class="col3" style="border-left: none;"><h4><strong>Icon</strong></h4></div>
									<div class="col3"><h4><strong>Dịch vụ</strong></h4></div>
									<div class="col3"><h4><strong>Chức năng</strong></h4></div>
								</div>
								<div class="scrolll" id="style-1">
									<div class="searchable-container">
										<?php $d=0; ?>
										@foreach($data as $row)
										<div class="itemss sud">
											<div class="value3">
												@if($row->icon!=null)
												<img style="width: 100px; height: 100px;" src="{{asset('images/'.$row->icon)}}">
												@else
												<i>Trống</i>
												@endif
											</div>
											<div class="value3" style="padding-top: 8px;">{{$row->name}}</div>
											<div class="value3">
												<a href="{{url('admin/footer/dichvu/update/'.$row->id)}}" class="btn btn-info" ><i class="fa fa-wrench" aria-hidden="true"></i> Sửa</a>
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
																<a href="{{url('admin/footer/dichvu/delete/'.$row->id)}}" class="btn btn-danger">OK</a>
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
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@include('admin.modules.required')

@endsection