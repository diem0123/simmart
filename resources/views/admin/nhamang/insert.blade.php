@extends('masteradmin')
@section('title', 'Thêm mới nhà mạng')
@section('noidung')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
    <h1>
      Thêm mới nhà mạng
      <small class="pull-right">
				<a href="{{url('admin/nhamang')}}" class="btn btn-danger"><i class="fa fa-undo"></i> Trở lại</a>
			</small>

    </h1>

    </section>

<!-- Main content -->
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
							    <label>Tên nhà mạng</label>
							    <input placeholder="Nhập tên nhà mạng vào đây" type="text" class="form-control" name="name">
							    @if($errors->has('name'))
								<div class="error">{{$errors->first('name')}}</div>
								@endif
							</div>
						</div>
						<div class="col-md-4" style="margin-top: 25px;">
							<div class="form-group">
							<button class=" btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Lưu[mới]</button>
							<a href="{{url('admin/nhamang')}}" class="btn btn-danger"><i class="fa fa-undo"></i> Trở lại</a>
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