@extends('masteradmin')
@section('title', 'Cập nhật Dịch vụ')
@section('noidung')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Cập nhật {{$row->name}}
		</h1>
	</section>
	<section class="content" style="padding-top: 5px;">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-body" style="padding-left: 30px;padding-right: 30px;">
						<form id="registrationForm" method="POST" enctype="multipart/form-data">
							{{csrf_field()}}
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Icon (*khuyến khích file .png)</label>
										<div id="image-preview" style="background-image: url({{asset('images/'.$row->icon)}});background-size: 100% 100%;background-repeat: no-repeat;">

											<label for="image-upload" id="image-label">Giữ ảnh cũ hoặc đổi</label>
											<input type="file" name="photo" id="image-upload" />
										</div>										
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Dịch vụ</label>
										<input value="{{old('name',$row->name)}}" type="text" class="form-control" name="name">
										@if($errors->has('name'))
										<div class="error">{{$errors->first('name')}}</div>
										@endif
									</div>
									<div class="form-group">
										<label>Đường dẫn</label> (* nếu có)
										<input value="{{old('slug',$row->slug)}}" type="text" class="form-control" name="slug">
										@if($errors->has('slug'))
										<div class="error">{{$errors->first('slug')}}</div>
										@endif
									</div>
									<div class="form-group">
										<button class=" btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Lưu[Sửa]</button>
										<a onclick="areyouok()"  class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Thoát</a>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group" style="margin-top: 40px;">
										
										<script>
											function areyouok(){
												$(document).ready(function() {
													$("#areyouok").modal("show")
												})
											}
										</script><div id="areyouok" class="modal fade" role="dialog" style="margin-top: 50px;">
											<div class="modal-dialog">
												<!-- Modal content-->
												<div class="modal-content"  style="width: 60%;margin-left: 130px;border-radius: 5px;">
													<div class="modal-header" style="background: #dd4b39;color:white;padding: 0px;">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-category text-center">Thông báo</h4>
													</div>
													<div class="modal-body text-center">
														<p>Thoát mà không <strong>Lưu</strong> ? Nhấn OK để thoát</p>
													</div>
													<div class="modal-footer" style="padding-top: 10px;padding-bottom: 10px;">
														<a href="{{url('admin/footer/dichvu')}}" class="btn btn-danger">OK</a>
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
        	name: {
        		message: 'The username is not valid',
        		validators: {
        			notEmpty: {
        				message: 'Tên danh mục không được bỏ trống'
        			}
        		}
        	}	
        }
    });
	});
</script>


<!-- @include('admin.modules.required') -->

@endsection