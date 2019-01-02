@extends('masteradmin')
@section('title', 'Thêm mới số sim')
@section('noidung')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Thêm mới số sim
		</h1>
	</section>
	<section class="content" style="padding-top: 5px;">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<!-- /.box-header -->
					<div class="box-body" style="padding-left: 30px;padding-right: 30px;">
						<form id="registrationForm" method="POST" enctype="multipart/form-data">
							{{csrf_field()}}
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Số sim</label>
										<input placeholder="Nhập số sim vào đây" type="text" class="form-control" name="number">
										@if($errors->has('number'))
										<div class="error">{{$errors->first('number')}}</div>
										@endif
									</div>
									<div class="form-group">
										<label>Giá bán</label>
										<input placeholder="Nhập giá bán vào đây" type="text" class="form-control" name="price">
									</div>
									<div class="form-group">
										<label>Trạng thái</label>
										<select name="stateid" class="form-control">
											@foreach($state as $stt)
											<option value="{{$stt->id}}">{!!$stt->name!!}</option>
											@endforeach

										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Loại khuyến mãi</label>
										<select name="catid" class="form-control">
											<option></option>
											@foreach($cat as $cate)
											<option value="{{$cate->id}}">{{$cate->name}}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group">
										<label>Nhà mạng</label>
										<select name="nhamang" class="form-control">
											<option></option>
											@foreach($nm as $nms)
											<option value="{{$nms->id}}">{{$nms->name}}</option>
											@endforeach

										</select>
									</div>
									<div class="form-group">
										<label>Loại sim</label>
										<select name="styleid" class="form-control">
											<option></option>
											@foreach($style as $sty)
											<option value="{{$sty->id}}">{{$sty->name}}</option>
											@endforeach

										</select>
									</div>
									
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<button class=" btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Lưu[mới]</button>
										<a onclick="areyouok()" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Trở lại</a>
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
														<p>Thoát mà không <strong>Lưu</strong> ? Nhấn OK để thoát</p>
													</div>
													<div class="modal-footer" style="padding-top: 10px;padding-bottom: 10px;">
														<a href="{{url('admin/product')}}" class="btn btn-danger">OK</a>
														<button type="button" class="btn btn-default" data-dismiss="modal">Trở lại</button>
													</div>
												</div>

											</div>
										</div>
									</div>
								</div>

							</div>
						</form>
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
<script>
	$(document).ready(function() {
		$('#registrationForm').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
        	valid: 'glyphicon glyphicon-ok',
        	invalid: 'glyphicon glyphicon-remove',
        	validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	number: {
        		message: 'The username is not valid',
        		validators: {
        			notEmpty: {
        				message: 'Số sim không được bỏ trống'
        			},
        			numberic: {
        				message: 'Định dạng không hợp lệ'
        			},
        			stringLength: {
        				min: 9,
        				max: 12,
        				message: 'Độ dài không hợp lệ'
        			},
        			regexp: {
        				regexp: /^[Z0-9_]+$/,
        				message: 'Số sim phải là số'
        			}
        		}
        	},
        	price: {
        		validators: {
        			notEmpty: {
        				message: 'Giá không được bỏ trống'
        			},
        			numberic: {
        				message: 'Định dạng không hợp lệ'
        			},
        			regexp: {
        				regexp: /^[Z0-9_]+$/,
        				message: 'Giá không hợp lệ'
        			}
        		}
        	},
        	catid: {
        		validators: {
        			notEmpty: {
        				message: 'Loại khuyến mãi chưa được chọn'
        			}
        		}
        	},
        	nhamang: {
        		validators: {
        			notEmpty: {
        				message: 'Nhà mạng chưa được chọn'
        			}
        		}
        	},
        	styleid: {
        		validators: {
        			notEmpty: {
        				message: 'Loại sim chưa được chọn'
        			}
        		}
        	}


        }
    });
	});
</script>


<!-- @include('admin.modules.required') -->

@endsection