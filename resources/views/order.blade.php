<b>ĐƠN HÀNG {{$order->id}} vừa đặt</b>
<table border="1" >
	<tr>
		<td>Số sim</td>
		<td><strong>{{$sim}}</strong></td>
	</tr>
	<tr>
		<td>Giá sim</td>
		<td><strong style="color:red;">{{$gia_sim}}</strong></td>
	</tr>
	<tr>
		<td>Khách hàng</td>
		<td><strong><?php if($gioi_tinh==1) echo "Anh"; else echo "Chị"; ?> {{$order->ten_kh}}</strong></td>
	</tr>
	
	<tr>
		<td>Địa chỉ khách hàng</td>
		<td>{{$order->dia_chi}}</td>
	</tr>
	<tr>
		<td>Số điện thoại</td>
		<td>0{{$order->sdt_kh}}</td>
	</tr>
	
	<tr>
		<td>Ngày đặt hàng</td>
		<td>{{$order->created_at}}</td>
	</tr>
	<tr>
		<td>Ngày khách yêu cầu giao hàng</td>
		<td>{{$shipdate}}</td>
	</tr>
	<tr>
		<td>Tổng thanh toán (chưa tính ship)</td>
		<td><strong style="font-size: 1.4em;color:red;">{{number_format($order->tien_thu_ho + 0)}}<sup>đ</sup></strong></td>
	</tr>

</table>