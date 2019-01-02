@extends('master')
@section('title', 'Trang chủ')
@section('meta')
<meta name="author" content="Sim số đẹp">
<meta property="og:url" itemprop="url" content="http://cungnhaulen.top/" />
<meta property="og:image" itemprop="thumbnailUrl" content="{{asset('images/'.$logo->logo)}}" />
<meta content="news" itemprop="genre" name="medium"/>
<meta name="description" content="Liên hệ: 0973.333.184 -  Email: trongvienpro@gmail.com - Chuyên cung cấp máy tính Laptop Siêu bền, Rẽ và Còn đẹp mắt, nhiều mẫu mã cho bạn chọn">
<meta name="keywords" content="Sim số đẹp, Sim thần tài, Sim tứ quý, Sim số tăng, Sim giá rẻ, Sim bình dân, Sim thổ địa, Sim tam hoa, Sim tứ quý giữa, Sim ông địa, Sim Gánh - Đảo, Sim viettel, Sim mobile, Sim vina">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="geo.region" content="VN-57" />
<meta name="geo.placename" content="tp. Hồ Chí Minh" />
<meta name="geo.position" content="10.992984;106.655707" />
<meta name="ICBM" content="10.992984, 106.655707" />
@endsection
@section('content')
<style>
.respon{display: none;}
.default{display: block;}
@media only screen and (max-width: 700px){
	.respon{display: block;}
	.default{display: none;}
}
</style>
<?php
use App\Models\Category;
?>

@include('popup')

<h4 style="margin-top: 10px;"><strong>Kết quả tìm kiếm theo "{{$keyword}}"</strong></h4>

<div class="default" style="margin-top: 20px;">
	<?php $d=0; ?>
	@foreach($cat as $row1)
	<div class="col-md-4 col-sm-6 col-xs-12" style="padding-left: 0px;margin-bottom: 10px;">
		<div class="content-main">
			<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-4 image" style="padding-right: 0px;">
					<a href="" data-toggle="modal" data-target="#myModal{{$d}}">
						<img src="{{asset('images/'.$row1->img)}}" title="{{$row1->name}}" class="resposive" style="width: 110px; height: 160px;">
					</a>
				</div>
				<!-- image -->
				<div class="modal fade" id="myModal{{$d}}" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content -->
						<div class="modal-content">
							<div class="modal-header" style="background: yellow;">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title text-center"><strong>{{$row1->name}}</strong></h4>
							</div>
							<div class="modal-body" style="padding:10px 0px 15px 10px;">
								<div class="scrollbar" id="style-1">
									<table  class="table-bordered table table-hover">
										@if($row1->datadetail != null)
										<tr>
											<td style="width: 100px;">Data</td>
											<td>{{$row1->datadetail}}</td>
										</tr>
										@else
										@if($row1->data!=null)
										<tr>
											<td style="width: 100px;">Data</td>
											<td>{{$row1->data}}</td>
										</tr>
										@endif
										@endif
										@if($row1->minutecall != null)
										<tr>
											<td>Phút gọi</td>
											<td>
												{{$row1->minutecall}}
											</td>
										</tr>
										@endif
										<tr>
											<td>SMS</td>
											<td>
												@if($row1->salesmsin != null)
												Nội mạng: {{$row1->salesmsin}} sms <br>
												@endif
												@if($row1->salesmsout != null)
												Ngoại mạng: {{$row1->salesmsout}} sms
												@endif
											</td>
										</tr>
										@if($row1->saletime != null)
										<tr>
											<td>Thời gian KM</td>
											<td>{{$row1->saletime}}</td>
										</tr>
										@endif
										@if($row1->saleother != null)
										<tr>
											<td>KM khác</td>
											<td>{!!$row1->saleother!!}</td>
										</tr>
										@endif

										@if($row1->cycle != null)
										<tr>
											<td>Chu kì</td>
											<td>{{$row1->cycle}}</td>
										</tr>
										@endif

										@if($row1->phigoi != null)
										<tr>
											<td>Phí gói</td>
											<td>{{$row1->phigoi}}</td>
										</tr>
										@endif

										@if($row1->cuphap != null)
										<tr>
											<td>Cú pháp</td>
											<td>{!!$row1->cuphap!!}</td>
										</tr>
										@endif


										@if($row1->chuthich != null)
										<tr>
											<td colspan="2">{!!$row1->chuthich!!}</td>
										</tr>
										@endif


									</table>


								</div>

							</div>
							<div class="row" style="padding-left: 25px;">
								<a href="{{$row1->slug}}" style="margin-top: 120px;"><i>Xem chi tiết</i></a>
							</div>
							
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
							</div>
						</div>

					</div>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-8 info" style="margin-left: 0px;font-size:0.8em;">
					<div class="row" style="margin-right: -5px;">
						<div class="col-md-12 col-sm-12 col-xs-12 info_items" style="padding-top: 5px;padding-right: 0px;padding-left: 0px;">
							<!-- data -->
							<div class="col-md-4 col-sm-4 col-xs-4 data info_s">
								<p><i class="fas fa-exchange-alt" style="color:#85d0f5; opacity: 0.9"></i></p>
								<b>{{$row1->data}}</b><br><span>Data</span>
							</div>
							<!-- goi noi mang -->
							@if($row1->salecallin!=null)
							<div class="col-md-4 col-sm-4 col-xs-4 time_call info_s" style="border-right: 1px solid #dadada; padding: 0px;border-left: 1px solid #dadada;">
								<p><i class="fas fa-phone" style="color:#85d0f5; opacity: 0.9"></i></p>
								<b>{{$row1->salecallin}} phút</b><br><span>Nội mạng</span>
							</div>
							@else
							<!-- goi ngoai mang -->
							@if($row1->salecallout!=null)
							<div class="col-md-4 col-sm-4 col-xs-4 time_call_sms info_s" style="border-right: 1px solid #dadada; padding: 0px;border-left: 1px solid #dadada;" >
								<p><i class="fas fa-phone" style="color:#85d0f5; opacity: 0.9"></i></p>
								<b>{{$row1->salecallout}} phút</b><br><span>Ngoại mạng</span>
							</div>
							@else
							<div class="col-md-4 col-sm-4 col-xs-4 time_call_sms info_s" style="border-right: 1px solid #dadada; padding: 0px;border-left: 1px solid #dadada;">
								<p><i class="fas fa-comment" style="color:#85d0f5; opacity: 0.9"></i></p>
								<b>{{$row1->salesmsout}} sms</b><br><span>Ngoại mạng</span>
							</div>
							@endif
							@endif
							@if($row1->salesmsout!=null)
							<div class="col-md-4 col-sm-4 col-xs-4 time_call_sms info_s" style="padding: 0px" >
								<p><i class="fas fa-comment" style="color:#85d0f5; opacity: 0.9"></i></p>
								<b>{{$row1->salesmsout}} sms</b><br><span>Ngoại mạng</span>
							</div>
							@else
							@if($row1->salesmsout!=null)
							<div class="col-md-4 col-sm-4 col-xs-4 time_call_sms info_s" style=" padding: 0px;">
								<p><i class="fas fa-comment" style="color:#85d0f5; opacity: 0.9"></i></p>
								<b>{{$row1->salecallin}} phút</b><br><span>Ngoại mạng</span>
							</div>
							@else
							<div class="col-md-4 col-sm-4 col-xs-4 time_call_sms info_s" style=" padding: 0px;" >
								<p><i class="fas fa-phone" style="color:#85d0f5; opacity: 0.9"></i></p>
								<b>{{$row1->salecallout}} phút</b><br><span>Ngoại mạng</span>
							</div>
							@endif
							@endif

							<div style="clear: both;"></div>
						</div>
					</div><!-- km1 -->

					<div class="row ">
						<div class="col-md-12 col-sm-12 col-xs-12">
							@if($row1->title1!=null)
							<span><i class="fas fa-check-circle" style="color:green"></i> {{$row1->title1}}</span><br>
							@endif
							@if($row1->title2!=null)
							<span><i class="fas fa-check-circle" style="color:green"></i> {{$row1->title2}}</span>
							@endif
						</div>
					</div>
					<div class="row" >
						<div class="col-md-7 col-sm-12 col-xs-12 price"  style="padding-right: 0px;">
							@if(($row1->price_sale)!=0)
							<span>Giá Gốc:</span>
							<strong style="color:red"> <strike>{{number_format($row1->price)}}</strike><sup>₫</sup></strong>
							<br>
							<span><strong>Giá KM:</strong></span>
							<strong style="color:red">{{number_format($row1->price_sale)}} <sup>₫</sup></strong>
							@else
							<span>Giá:</span>
							<strong style="color:red">{{number_format($row1->price)}}<sup>₫</sup></strong>
							@endif
						</div>
						<div class="col-md-5 col-sm-12 col-xs-12 mua">
							<a href="{{url('san-pham/'.$row1->slug)}}"><b>CHỌN SỐ</b></a>
						</div>
						<div style="clear: both;"></div>
					</div>
				</div><!-- info -->
				<div style="clear: both;"></div>
			</div>
		</div>
	</div>


	<?php $d++; ?>
	@endforeach
	<div style="clear: both;"></div>
</div>

@endsection