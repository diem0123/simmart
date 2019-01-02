@extends('masteradmin')
@section('title',$row->orderid)
@section('noidung')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Khách hàng: {{$row->name}}
			<small class="pull-right">
				
			</small>
		</h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-body" style="padding-left: 30px;padding-right: 30px;">
					<div class="row">
						<form action="" method="POST" enctype="multipart/form-data">
							{{csrf_field()}}
							<div class="col-md-6">
								
								<table class="table table-hover table-bordered"> 
									<tr>
										<td>Số hóa đơn</td>
										<td>{{$row->orderid}}</td>
									</tr>
									<tr>
										<td>Số sim</td>
										<td>{{$row->productid}}
										</td>
									</tr>
									<tr>
										<td>Tổng Giá (đã tính ship)</td>
										<td>{{number_format($row->price)}} <sup>đ</sup></td>
									</tr>

									<tr>
										<td>Tên khách hàng</td>
										<td>{{$row->name}}</td>
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
									<tr>
										<td>Trạng thái</td>
										<td>
											@foreach($order as $or)
												@if($row->orderid == $or->idorder)
													@foreach($state as $stt)
														@if($stt->id == $or->stateid)
															{!!$stt->name!!}
														@endif
													@endforeach
												@endif
											@endforeach
										</td>
									</tr>

									
								</table>

							</div>
							<div class="col-md-6">
								<a href="{{url('admin/infor_customer')}}" class="btn btn-danger"><i class="fa fa-undo"></i> Trở lại</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</div>

@endsection