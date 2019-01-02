@extends('masteradmin')
@section('title', 'Thêm mới nhà mạng')
@section('noidung')
<div class="content-wrapper">
	<section class="content-header">
    <h1>
      Cập nhật nhà mạng {{$row->name}}
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
							    <label>Tên nhà mạng</label>
							    <input value="{{old('name',$row->name)}}" type="text" class="form-control" name="name">
							    @if($errors->has('name'))
								<div class="error">{{$errors->first('name')}}</div>
								@endif
							</div>
						</div>
						<div class="col-md-4" style="margin-top: 25px;">
							<div class="form-group">
							<button class=" btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Lưu[sửa]</button>
							<a onclick="areyouok()" class=" btn btn-danger" type="submit"><i class="fa fa-undo"></i> Trở lại</a>
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
														<a href="{{url('admin/nhamang')}}" class="btn btn-danger">OK</a>
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
                        message: 'Tên nhà mạng không được bỏ trống'
                    }
                }
            }
        }
    });
});
</script>


<!-- @include('admin.modules.required') -->

@endsection