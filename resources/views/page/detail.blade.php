@extends('master')
@section('title', $row->name)
@section('meta')
<meta name="author" content="Sim số đẹp">
<meta property="og:url" itemprop="url" content="http://cungnhaulen.top/{{$row->slug}}" />
<meta property="og:image" itemprop="thumbnailUrl" content="{{asset('images/'.$row->img)}}" />
<meta content="news" itemprop="genre" name="medium"/>
<meta name="description" content="{{$row->metadesc}}">
<meta name="keywords" content="{{$row->metakeyword}}">
@endsection
@section('content')
<div class="container" style="max-width: 800px;">
	<div class="row">
		<h3><strong>Thông tin gói cước: <span style="color:blue;">{{$row->name}}</span></strong></h3>
		@if($row->datadetail!=null)
		<p><strong>Data</strong>: {!!$row->datadetail!!}</p>
		@else
		<p><strong>Data:</strong> {{$row->data}}</p>
		@endif

		@if(($row->salesmsin!=null) || ($row->salesmsout!=null))
		<p> <strong>Tin nhắn khuyến mãi: </strong>
			@if($row->salesmsin!=null) 
			{{$row->salesmsin}} sms nội mạng
			@endif

			@if($row->salesmsout!=null)
			, {{$row->salesmsout}} sms nội mạng
			@endif
		</p>
		@endif

		@if(($row->salecallin!=null) || ($row->salecallout!=null))
		<p> <strong>Cuộc gọi khuyến mãi:</strong> 
			@if($row->salecallin!=null) 
			{{$row->salecallin}} phút nội mạng
			@endif

			@if($row->salecallout!=null)
			, {{$row->salecallout}} phút mạng
			@endif
		</p>
		@endif

		@if($row->minutecall !=null)
		<p><strong>Phút gọi:</strong> {{$row->minutecall}}</p>
		@endif
		@if($row->saletime !=null)
		<p><strong>Thời gian khuyến mãi:</strong> {{$row->saletime}}</p>
		@endif

		@if($row->cycle !=null)
		<p><strong>Chu kỳ:</strong> {{$row->cycle}}</p>
		@endif

		@if($row->phigoi !=null)
		<p><strong>Phí gói:</strong> {{$row->phigoi}}</p>
		@endif

		@if($row->cuphap !=null)
		<p><strong>Cú pháp</strong>: {!!$row->cuphap!!}</p>
		@endif

		@if($row->price_sale ==0)
		<p><strong>Giá:</strong> {{number_format($row->price)}}<sup>đ</sup></p>
		@else
		<p><strong>Giá gốc:</strong> <strike>{{number_format($row->price)}}<sup>đ</sup></strike> </p>
		<p><strong>Giá Khuyến mãi:</strong> {{number_format($row->price_sale)}}<sup>đ</sup></p>
		@endif

		@if($row->saleother!=null)
		<p><strong>Khuyến mãi khác:</strong> {!!$row->saleother!!}</p>
		@endif

		@if($row->chuthich!=null)
		<p><strong>Chú thích: </strong> {!!$row->chuthich!!}</p>
		@endif

		@if($row->detail!=null)
		<p><strong>Chi tiết: </strong> {!!$row->detail!!}</p>
		@endif
	</div>
</div>
@endsection