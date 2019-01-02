@extends('masteradmin')
@section('title', 'Thêm mới gói cước')
@section('noidung')

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Thêm mới gói cước
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
								<div class="col-md-3">
									<div class="form-group">
										<label >Ảnh </label>
										<div id="image-preview" style="height: 187px;width: 132px;">
											<label style="font-size: 0.8em;" id="image-label">Tải ảnh lên</label>
											<input type="file" name="photo" id="image-upload" />
										</div>										
									</div>
									<i><b>Kích thước tỉ lệ: 187x132(px)</b></i><br><br>

									<div class="form-group">
										<label >Ảnh tiêu đề </label>
										<div id="image-preview_res" style="height: 43px;width: 250px;">
											<label style="font-size: 0.8em;" id="image-label_res">Tải ảnh lên</label>
											<input type="file" name="photores" id="image-upload_res" />
										</div>										
									</div>
									<i><b>Kích thước tỉ lệ: 43x250(px)</b></i>


								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Nhóm thông tin gói cước</label>
										<select name="title" class="form-control">
											<option></option>
											@foreach($title as $tit)
											<option value="{{$tit->id}}">{{$tit->name}}</option>
											@endforeach
										</select>
										
										@if($errors->has('title'))
										<div class="error">{{$errors->first('title')}}</div>
										@endif
									</div>
									<div class="form-group">
										<label>Tên gói cước</label>
										<input value="{{old('name')}}" type="text" class="form-control" name="name" placeholder="Tên gói cước">
										@if($errors->has('name'))
										<div class="error">{{$errors->first('name')}}</div>
										@endif
									</div>
									<div class="form-group">
										<label>Đường dẫn</label> (có thể bỏ trống để lấy tự động)
										<input value="{{old('slug')}}" type="text" class="form-control" name="slug" placeholder="https://www.facebook.com/">
									</div>
									<div class="form-group">
										<label>Dung lượng Data</label>
										<input value="{{old('data')}}" type="text" class="form-control" name="data" placeholder="2,5 GB">
									</div>
									<div class="form-group">
										<label>Chi tiết dung lượng Data</label>
										<textarea class="form-control" name="datadetail" cols="20" rows="2">{{old('datadetail')}}</textarea>
									</div>
									<div class="form-group">
										<label>KM SMS nội mạng</label> <i>(chỉ nhập số)</i>
										<input value="{{old('salesmsin')}}" type="text" class="form-control" name="salesmsin" placeholder="số sms ">
									</div>
									<div class="form-group">
										<label>KM SMS ngoại mạng</label> <i>(chỉ nhập số)</i>
										<input value="{{old('salesmsout')}}" type="text" class="form-control" name="salesmsout" placeholder="số sms">
									</div>
									<div class="form-group">
										<label>KM phút nội mạng</label> <i>(chỉ nhập số)</i>
										<input value="{{old('salecallin')}}" type="text" class="form-control" name="salecallin" placeholder="số phút">
									</div>
									<div class="form-group">
										<label>KM phút ngoại mạng</label> <i>(chỉ nhập số)</i>
										<input value="{{old('salecallout')}}" type="text" class="form-control" name="salecallout" placeholder="số phút">
									</div>
									<div class="form-group">
										<label>Phút gọi</label>
										<input value="{{old('minutecall')}}" type="text" class="form-control" name="minutecall" placeholder="Miễn phí tất cả cuộc gọi nội mạng < 10 phút.">
									</div>
									<div class="form-group">
										<label>Thời gian khuyến mãi</label>
										<input value="{{old('saletime')}}" type="text" class="form-control" name="saletime" placeholder="12 tháng">
									</div>
									<div class="form-group">
										<label>Chu kỳ</label>
										<input value="{{old('cycle')}}" type="text" class="form-control" name="cycle" placeholder="30 ngày tính từ lần đăng ký/ gia hạn thành công.">
									</div>
									<div class="form-group">
										<label>Phí gói</label>
										<textarea class="form-control" name="phigoi" cols="20" rows="3">{{old('phigoi')}}</textarea>
									</div>
									<div class="form-group">
										<label>Cú pháp</label>
										<textarea class="form-control" name="cuphap" cols="20" rows="3">{{old('cuphap')}}</textarea>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<label>Giá</label> <i>(vnđ)</i>
										<input value="{{old('price')}}" type="text" class="form-control" name="price" placeholder="100000">
									</div>
									<div class="form-group"> 
										<label>Giá KM</label> <i>(nếu có)</i> 
										<input value="{{old('price_sale')}}" type="text" class="form-control" name="price_sale" placeholder="0đ">
									</div>
									<div class="form-group">
										<label>Tiêu đề KM 1</label> <i>(Hiện ở trang chủ)</i>
										<input value="{{old('title1')}}" type="text" class="form-control" name="title1" placeholder="Tháng đầu miễn phí">
									</div>
									<div class="form-group">
										<label>Tiêu đề KM 2</label> <i>(Hiện ở trang chủ)</i>
										<input value="{{old('title2')}}" type="text" class="form-control" name="title2" placeholder="Các tháng sau 50k">
									</div>
									
									<div class="form-group">
										<label>KM khác</label>
										<textarea class="form-control" name="saleother" cols="20" rows="3">{{old('saleother')}}</textarea>
									</div>
									<div class="form-group">
										<label>Chú thích</label>
										<textarea class="form-control" name="chuthich" cols="20" rows="3">{{old('chuthich')}}</textarea>
									</div>
									<div class="form-group">
										<label>Giới thiệu chi tiết gói cước</label> <i>(nội dung trang chi tiết)</i>
										<textarea class="form-control" name="detail" cols="30" rows="10">{{old('chuthich')}}</textarea>
									</div>
									<script>CKEDITOR.replace('detail')</script>
									<div class="form-group">
										<label>MetaDesc</label> (SEO WEBSITE)
										<textarea class="form-control" name="metedesc" cols="20" rows="3">{{old('metadesc')}}</textarea>
									</div>
									<div class="form-group">
										<label>MetaKeywords</label> (SEO WEBSITE)
										<textarea class="form-control" name="metakeyword" cols="20" rows="3">{{old('metakeyword')}}</textarea>
									</div>		
									<div class="form-group">
										<label>Trạng thái</label>
										<select name="stateid" class="form-control">
											@foreach($state as $stt)
											<option value="{{$stt->id}}">{!!$stt->name!!}</option>
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
														<a href="{{url('admin/category')}}" class="btn btn-danger">OK</a>
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
        				message: 'Tên gói cước không được bỏ trống'
        			}
        		}
        	},
        	title: {
        		validators: {
        			notEmpty: {
        				message: 'Nhóm tiêu đề chưa được chọn'
        			}
        		}
        	},
        	price: {
        		validators: {
        			notEmpty: {
        				message: 'Giá tiền chưa nhập'
        			},
        			numberic: {
                    	message: 'Định dạng không hợp lệ'
                    },
					regexp: {
                        regexp: /^[Z0-9_]+$/,
                        message: 'Số sim phải là số'
                    }
        		}
        	},
        	data: {
        		validators: {
        			notEmpty: {
        				message: 'Dung lượng không được bỏ trống'
        			}
        		}
        	},
        	photo: {
        		validators: {
        			notEmpty: {
        				message: 'Ảnh đại diện không được bỏ trống'
        			}
        		}
        	},
        	photores: {
        		validators: {
        			notEmpty: {
        				message: 'Ảnh tiêu đề không được bỏ trống'
        			}
        		}
        	},
        	detail: {
        		validators: {
        			notEmpty: {
        				message: 'Chi tiết gói cước không được bỏ trống'
        			}
        		}
        	},
        	title1: {
        		validators: {
        			notEmpty: {
        				message: 'Tiêu đề KM 1 không được bỏ trống'
        			}
        		}
        	},
        	salesmsin: {
        		validators: {
        			numberic: {
                    	message: 'Chỉ nhập số'
                    },
					regexp: {
                        regexp: /^[Z0-9_]+$/,
                        message: 'Chỉ nhập số'
                    }
        		}
        	},
        	salesmsout: {
        		validators: {
        			numberic: {
                    	message: 'Chỉ nhập số'
                    },
					regexp: {
                        regexp: /^[Z0-9_]+$/,
                        message: 'Chỉ nhập số'
                    }
        		}
        	},
        	salecallout: {
        		validators: {
        			numberic: {
                    	message: 'Chỉ nhập số'
                    },
					regexp: {
                        regexp: /^[Z0-9_]+$/,
                        message: 'Chỉ nhập số'
                    }
        		}
        	},
        	salecallin: {
        		validators: {
        			numberic: {
                    	message: 'Chỉ nhập số'
                    },
					regexp: {
                        regexp: /^[Z0-9_]+$/,
                        message: 'Chỉ nhập số'
                    }
        		}
        	},
        }
    });
	});
</script>


<!-- @include('admin.modules.required') -->

@endsection