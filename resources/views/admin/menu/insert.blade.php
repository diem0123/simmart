@extends('masteradmin')
@section('title', 'Thêm mới Menu')
@section('noidung')

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Thêm mới menu
			<small class="pull-right">
			</small>
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
										<label >Ảnh (*khuyến khích file .png)</label>
										<div id="image-preview">
											<label for="image-upload" id="image-label">Tải ảnh lên</label>
											<input type="file" name="photo" id="image-upload" />
										</div>										
									</div>


								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Tên menu</label>
										<input value="{{old('name')}}" type="text" class="form-control" name="name" placeholder="Tên danh mục">
										@if($errors->has('name'))
										<div class="error">{{$errors->first('name')}}</div>
										@endif
									</div>
									<div class="form-group">
										<label>Đường dẫn</label> (* kèm theo http/https)
										<input value="{{old('slug')}}" type="text" class="form-control" name="slug" placeholder="https://www.facebook.com/">
										@if($errors->has('slug'))
										<div class="error">{{$errors->first('slug')}}</div>
										@endif
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
										<label>Danh mục cha</label>
										<select name="parentid" class="form-control">
											<option value=""></option>
											<option value="0"><strong>LÀM DANH MỤC LỚN NHẤT</strong></option>
											@foreach($parent as $ok)
											<option value="{{$ok->id}}">{{$ok->name}}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group" style="margin-top: 40px;">
										<button class=" btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Lưu[Mới]</button>
										<a onclick="areyouok()"  class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Thoát</a>
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
														<a href="{{url('admin/menu')}}" class="btn btn-danger">OK</a>
														<button type="button" class="btn btn-default" data-dismiss="modal">Trở lại</button>
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
        	},
        	parentid: {
        		validators: {
        			notEmpty: {
        				message: 'Loại cha chưa được chọn'
        			}
        		}
        	}
        }
    });
	});
</script>


<!-- @include('admin.modules.required') -->

@endsection