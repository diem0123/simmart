@extends('masteradmin')
@section('title', 'Trạng thái đơn hàng')
@section('noidung')
<link href="{{ asset('/public/trangthai_lib/css/trangthai.css') }}" rel="stylesheet" media="all" type="text/css" />
<div class="content-wrapper">
	<div class="content">

		{{-- /* =============== > TRẠNG THÁI ĐƠN HÀNG < =============== */ --}}
		<table id="data_sort" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Ngày giờ</th>
					<th>Mã đơn hàng</th>
					<th>Trạng thái</th>
					<th>Số nhà (gửi)</th>
					<th>Tên đường (gửi)</th>
					<th>Điện thoại (gửi)</th>
					<th>Tên người gửi</th>
					<th>Số nhà (nhận)</th>
					<th>Tên đường (nhận)</th>
					<th>Điện thoại (nhận)</th>
					<th>Tên người nhận</th>
					<th>Hủy đơn hàng</th>
				</tr>
			</thead>

			<tfoot>
				<tr>
					<th>Ngày giờ</th>
					<th>Mã đơn hàng</th>
					<th>Trạng thái</th>
					<th>Số nhà (gửi)</th>
					<th>Tên đường (gửi)</th>
					<th>Điện thoại (gửi)</th>
					<th>Tên người gửi</th>
					<th>Số nhà (nhận)</th>
					<th>Tên đường (nhận)</th>
					<th>Điện thoại (nhận)</th>
					<th>Tên người nhận</th>
					<th>Hủy đơn hàng</th>
				</tr>
			</tfoot>

			<tbody>
				@foreach ($obj->data as $v)
				<tr>
					<td>{{$v->created}}</td>
					<td>{{$v->alias}}</td>
					<td>{{$v->status}}</td>
					<td>{{$v->pick_first_address}}</td>
					<td>{{$v->pick_last_address}}</td>
					<td>{{$v->pick_tel}}</td>
					<td>{{$v->pick_fullname}}</td>
					<td>{{$v->customer_first_address}}</td>
					<td>{{$v->customer_last_address}}</td>
					<td>{{$v->customer_tel}}</td>
					<td>{{$v->customer_fullname}}</td>
					<td><button code="{{$v->alias}}" class="huy_don btn-xs btn-danger" type="button">Hủy</button></td>
				</tr>			
				@endforeach

			</tbody>
		</table>
		{{-- /* =============== > / TRẠNG THÁI ĐƠN HÀNG < =============== */ --}}

	</div>

</div>

<script src="{{ asset('/public/trangthai_lib/js/trangthai.js') }}" type="text/javascript"></script>
<script type="text/javascript">
	$(function () {
		$(document).on('click', '.huy_don',function(){
			var code = $(this).attr('code');

			$.get("/chon-so/api/huydonhang", {
				code: code
			}, function(data){
				json = JSON.parse(data);
				// console.log(json);
				if (json.success == true) {
					alert('Đã hủy đơn hàng thành công');
				}else{
					if (json.message == 'Đơn hàng đã ở trạng thái hủy') {
						alert('Đơn hàng đã ở trạng thái hủy');
					}
				}
			});
		});
	});
</script>
@endsection