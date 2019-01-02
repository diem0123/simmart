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
					<th>Số hóa đơn</th>
					<th>Số sim</th>
					<th>Giá sim</th>
					<th>Phí Ship</th>
					<th>Ngày đặt</th>
					
					<th>Gửi đơn hàng cho (GHTK)</th>
					<th>Tên Khách hàng</th>
					<th>Số điện thoại</th>
					<th>Tỉnh/TP</th>
					<th>Quận Huyện</th>
					<th>Địa chỉ</th>
				</tr>
			</thead>

			<tfoot>
				<tr>
					<th>Số hóa đơn</th>
					<th>Số sim</th>
					<th>Giá sim</th>
					<th>Phí Ship</th>
					<th>Ngày đặt</th>
					
					<th>Gửi đơn hàng cho (GHTK)</th>
					<th>Tên Khách hàng</th>
					<th>Số điện thoại</th>
					<th>Tỉnh/TP</th>
					<th>Quận Huyện</th>
					<th>Địa chỉ</th>
				</tr>
			</tfoot>

			<tbody>
				@foreach ($data as $v)
				<tr id="{{$v->id}}">
					<td>{{$v->id_don_hang}}</td>
					<td>{{$v->so_sim}}</td>
					<td>{{$v->tien_thu_ho}}</td>
					<td>{{$v->phi_ship}}</td>
					<td>{{$v->created_at}}</td>
					
					<td style="text-align: center;">
						<button id="cau_hinh" data-toggle="modal" data-target="#myModal" class="xs-btn btn-primary" type="button">Cấu hình</button>
						<button id="del" class="xs-btn btn-danger" type="button">Xóa</button>
					</td>
					<td>{{$v->ten_kh}}</td>
					<td>{{$v->sdt_kh}}</td>
					<td>{{$v->tinh_tp}}</td>
					<td>{{$v->quan_huyen}}</td>
					<td>{{$v->dia_chi}}</td>
				</tr>			
				@endforeach

			</tbody>
		</table>

		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog" style="width:80%">

				<div class="modal-content">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Cấu hình gửi đơn hàng</h4>
					</div>

					<div class="modal-body">
						Chọn kho hàng:
						<select id="chon_kho_hang" class="form-control">
							<option value="">Chọn kho hàng</option>
							@foreach ($kho_hang as $v)
							<option value="{{$v->id}}">{{$v->ten_chu_shop}}</option>
							@endforeach
						</select>
					</div>

					<div class="modal-footer">
						<button id="send" type="button" class="btn btn-danger">Gửi</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>

				</div>

			</div>
		</div>		
		{{-- /* =============== > / TRẠNG THÁI ĐƠN HÀNG < =============== */ --}}

	</div>

</div>

<script src="{{ asset('/public/trangthai_lib/js/trangthai.js') }}" type="text/javascript"></script>
<script src="{{ asset('/public/trangthai_lib/storage/js.storage.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
	$(function () {
		storage = Storages.localStorage;
		$(document).on('click', '#cau_hinh',function(){
			var id = $(this).closest('tr').attr('id');
			storage.set('cau_hinh', id);
		});

		$(document).on('click', '#send',function(){

			var chon_kho_hang = $('#chon_kho_hang').val();
			if (!chon_kho_hang) {
				alert('Bạn chưa chọn kho hàng');
			}else{
				var id_kho_hang = $('#chon_kho_hang').val();
				var id_order = storage.get('cau_hinh');
			}


			var hostname = $(location).attr('hostname');

				var geturl = '/chon-so/api/taodonhang' 
				//var geturl = 'https://'+ hostname + "/chon-so/api/taodonhang"

			$.get(geturl, {
				id_kho_hang: id_kho_hang,
				id_order: id_order
			}, function(data){
				json = JSON.parse(data);
					console.log(json);
					if (json.success == true) {
						alert('Đơn hàng đã được gửi thành công');
						storage.set('kieu_thanh_toan', '');
						window.location.reload();
					}else{
						if (json.message == "address, Value is required and can't be empty") {
							alert('Bạn chưa nhập đầy đủ địa chỉ');
						}
						if (json.error.code == "ORDER_ID_EXIST") {
							alert('Đơn hàng đã tồn tại trên hệ thống');
						}
					}
				});				
		});

		$(document).on('click', '#del',function(){
			var id = $(this).closest('tr').attr('id');
			var hostname = $(location).attr('hostname');

				var geturl = '/chon-so/api/delduyetdonhang' 

				//var geturl = 'https://'+ hostname + "/chon-so/api/delduyetdonhang"

			$.get(geturl, {
				id: id
			}, function(data){
				if (data == "ok") {
					window.location.reload();
				}
			});			
		});
	});

</script>
@endsection