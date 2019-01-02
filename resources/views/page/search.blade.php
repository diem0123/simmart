@extends('master')
@section('title',$key)
@section('content')
<div class="row" style="margin: 0;">
	<h3>Bạn đang chọn: <strong>{{$row->name}}</strong></h3>
</div>
<div class="row">
	<div class="col-lg-6">
		<form id="form" action="{{url('san-pham/search')}}" method="POST" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="input-group">
				<input type="search" class="form-control click" required id="searchhh" placeholder="Nhập từ khóa" name="keysearch" value="" >
				<input type="hidden" name="catid" value="{{$row->id}}">
				<input type="hidden" id="keyser" value="<?php echo (isset($key)?($key):''); ?>">
				<span class="input-group-btn">
					<button class="btn btn-info" type="submit"><i class="fa fa-search"></i> Tìm</button>
				</span>
			</div><!-- /input-group -->
		</form>
		<div class="ex">
			<p>Nhập <strong>999</strong> và nhấn nút <strong>Tìm</strong> để tìm sim có chứa 999  </p>
			<p>Nhập <strong>098*</strong> và nhấn nút <strong>Tìm</strong> để tìm sim có 3 số đầu 098 </p>
			<p>Nhập <strong>*999</strong> và nhấn nút <strong>Tìm</strong> để tìm sim có 3 số cuối 999</p>
			<p>Nhập <strong>098*999</strong> và nhấn nút <strong>Tìm</strong> để tìm sim có đầu số 098 & 3 số cuối 999</p>
		</div>
		<script>
			$(document).ready(function(){
				$("#searchhh").click(function(){
					$(".ex").slideToggle();
				});
			});
		</script>
	</div><!-- /.col-lg-6 -->
</div>
<p><i>Gồm <strong>{{count($product)}}</strong> kết quả theo từ khóa <strong>{{$key}}</strong></i></p>
<div class="row" style="margin-top: 10px;">
	<div class="col-md-4 col-sm-12 col-xs-12">
		<div class="row" style="font-size: 0.9em;">
			<div class="col-md-3 col-sm-4 col-xs-4 hidden-sm hidden-xs" style="margin-top: 7px;">Lọc theo:</div>
			<div class="col-md-4 col-sm-5 col-xs-5">
				<select style="float: left;" name="simstyle" class="form-control sapxep" >

					<option value="0">Loại sim <i class="fa fa-chevron-down"></i></option>

					@foreach($style as $sty)
					<option value="{{$sty->id}}">{{$sty->name}}</option>
					@endforeach

				</select>
			</div>
			<div class="col-md-4 col-sm-5 col-xs-5">
				<select style="float: left;" name="simstyle" id="price" class="form-control " >
					<option value="0">Giá <i class="fa fa-chevron-down"></i></option>
					<option value="40000">40000</option>
					<option value="50000">50000</option>
					<option value="60000">60000</option>
					<option value="70000">70000</option>
					<option value="80000">80000</option>
					<option value="90000">90000</option>
					<option value="100000">100000</option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-2 hidden-xs"><span style="float:left;margin-top:7px;"><input id="10so" type="checkbox" value="10">Sim 10 số</span></div>
</div>

<div class="contentt">
	<div class="container" style="">
		<div class="row">
			<div class="col-md-3 col-sm-5 col-xs-5" style="padding-left: 0px;"><h5><strong>SIM SỐ</strong></h4></div>
			<div class="col-md-3 col-sm-3 col-xs-3 text-center"><h5><strong>GIÁ TIỀN</strong></h4></div>
			<div class="col-md-3 col-sm-2 col-xs-2 text-center"><h5><strong>NHÀ MẠNG</strong></h4></div>
			
		</div>
		<div class="row" style="">
		<div class="scrollbar2" id="style-1">
			<div class="danhsach" id="data">
				@foreach($product as $roww)
				<div class="row kiu">
					<!-- <div class="searchable-container"> -->
						<!-- <div class="itemss"> -->
							<div class="ku col-md-3 col-sm-5 col-xs-5" style="color:#2898e0;"><strong>{{$roww->number}}</strong>
							</div>
							<div class="ku col-md-3 col-xs-3 text-center" style="color:#d2021b;"><strong>{{number_format($roww->price)}}</strong><sup>đ</sup></div>
							<div class="ku col-md-3 col-sm-2 col-xs-2 text-center">
								@foreach($nm as $nmm)
								@if($nmm->id == $roww->nhamang)
								{{$nmm->name}}
								@endif
								@endforeach
							</div>
							<div class="ku col-md-3 col-sm-2 col-xs-2 text-center" style="color:#2898e0;"><a href="{{url('mua-hang/'.$roww->id)}}"><strong>MUA</strong></a></div>
						<!-- </div> -->
					<!-- </div> -->
				</div>

				@endforeach
			</div>
		</div>
		</div>
		<!-- <div style="margin-top: 30px;" class="container fb-comments" data-href="{{url('san-pham'.$row->slug)}}" data-width="100%" data-mobile data-numposts="10"></div> -->
	</div>
</div>


<!-- LỌC THEO LOẠI Ở TRANG SEARCH -->
<script>
	$(document).ready(function () {
		$(".sapxep").change(function() {
			var id = $(".sapxep").val()
			var cat = {{$row->id}};
			var key = $('#keyser').val();
			$.ajax({
				type: 'GET',
				url: "{{ route('proajaxsearch')}}",
				data: {id: id,cat:cat,key:key},
				success: function(data) {
					$(".danhsach").html(data);
                //alert(data);
            }
        });
		});
	});
</script>


<!-- LỌC THEO SỐ ĐIỆN THOẠI Ở TRANG SEARCH -->
<script language="javascript">
	document.getElementById('10so').onclick = function(e){
		if (this.checked){
			var id = $("#10so").val();
		}else{
			var id = 1;
		}
		var cat = {{$row->id}};
		var key = $('#keyser').val();
		$.ajax({
				type: 'GET',
				url: "{{ route('ajaxcheckspsearch')}}",
				data: {id: id,cat:cat,key:key},
				success: function(data) {
					$(".danhsach").html(data);
            }
        });

	};
</script>
<!-- LỌC THEO GIÁ TIỀN -->
<script>
	$(document).ready(function () {
		$("#price").change(function() {
			var price = $("#price").val()
			var cat = {{$row->id}};
			var key = $('#keyser').val();

				$.ajax({
				type: 'GET',
				url: "{{ route('proajaxsearchprice')}}",
				data: {price: price,cat:cat,key:key},
				success: function(data) {
					$(".danhsach").html(data);
                //alert(data);
            }
        });
		});
	});
</script>

@endsection()