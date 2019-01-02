@extends('master')

@section('title', 'Trang chủ')

@section('meta')

<?php use App\Models\Seo; $seoo = Seo::where('id',1)->first(); ?>

<meta property="og:url" itemprop="url" content="{{$seoo->url}}" />

<meta property="og:image" itemprop="thumbnailUrl" content="{{asset('images/'.$logo->logo)}}" />

<meta content="news" itemprop="genre" name="medium"/>

<meta name="description" content="{{$seoo->metadesc}}">

<meta name="keywords" content="{{$seoo->metakey}}">

@endsection

@section('content')

<style>.respon{display: none;}.default{display: block;}

@media only screen and (max-width: 700px){.respon{display: block;}.default{display: none;}}

</style>

<?php 

use App\Models\Title;

use App\Models\Category;

?>

@include('popup')

<div class="default">

	<?php $d=0; ?>

	@foreach($title as $row)

	<div class="row" style="padding-left: 15px;margin-top: 20px;">

		<h4><strong>{{$row->name}}</strong></h4>

		<p>{{$row->review}}</p>

	</div>

	<?php $cat = Category::where('titid',$row->id)->where('stateid',1)->get();?>

	@foreach($cat as $row1)

	<div class="col-md-4 col-sm-6 col-xs-12" style="padding-left: 0px;margin-bottom: 10px;">

		<div class="content-main">

			<div class="row">

				<div class="col-md-4 col-sm-4 col-xs-4 image" style="padding-right: 0px;">

					<a href="" data-toggle="modal" data-target="#myModal{{$d}}">

						<img src="{{asset('images/'.$row1->img)}}" title="{{$row1->name}}" class="resposive" style="width: 110px; height: 160px;">

					</a>

				</div>

				<div class="modal fade" id="myModal{{$d}}" role="dialog">

					<div class="modal-dialog">

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

						@if($row1->salesmsin!=null)

							<div class="col-md-4 col-sm-4 col-xs-4 time_call_sms info_s" style=" padding: 0px;">

									<p><i class="fas fa-comment" style="color:#85d0f5; opacity: 0.9"></i></p>

									<b>{{$row1->salesmsin}} sms</b><br><span>nội mạng</span>

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

@endforeach

</div>





<div class="respon" >

	<?php $i=0; ?>

	@foreach($title as $row3)

	<div class="row" style="padding-left: 15px;margin-top: 20px;">

		<h5><strong>{{$row3->name}}</strong></h5>

	</div>

	<?php $cat = Category::where('titid',$row3->id)->get();?>

	<div id="myCarousel{{$i}}" class="carousel slide" data-ride="carousel">

		<!-- Indicators -->

		<ol class="carousel-indicators">

			<?php $d=0; ?>

			@foreach($cat as $value4)

			@if($d==0)

			<li data-target="#myCarousel{{$i}}" data-slide-to="{{$d}}" class="active"></li>

			@else

			<li data-target="#myCarousel{{$i}}" data-slide-to="{{$d}}"></li>

			@endif

			<?php $d++; ?>

			@endforeach

		</ol>



		<!-- Wrapper for slides -->

		<div class="carousel-inner">

			<?php $k=0; ?>

			@foreach($cat as $value3)

			@if($k==0)

			<div class="item active" style="border-radius: 15px 15px 0px 0px;">



				<div class="title_res">

					<img src="{{asset('images/'.$value3->img_res)}}" style="width: 100%;height: 43px;">

				</div>

				<div class="content_res">

					<p><strong>{{$value3->data}}</strong> Data</p>

					@if($value3->salecallin!=null)

					<p><strong>{{$value3->salecallin}} phút</strong> nội mạng</p>

					@else

						@if($value3->salecallout!=null)

						<p><strong>{{$value3->salecallout}} phút</strong> ngoại mạng</p>

						@else

							@if($value3->salesmsin!=null)

							<p><strong>{{$value3->salesmsin}} sms</strong> nội mạng</p>

							@else

							<p><strong>{{$value3->salesmsout}} sms</strong> ngoại mạng</p>

							@endif

						@endif

					@endif

					

					@if($value3->salesmsout!=null)

					<p style="border-bottom: 1px solid #eeeeee;padding-bottom: 3px;">

						<strong>{{$value3->salesmsout}} sms</strong> ngoại mạng

					</p>

					@else

						@if($value3->salesmsin!=null)

						<p style="border-bottom: 1px solid #eeeeee;padding-bottom: 3px;">

							<strong>{{$value3->salesmsin}} sms</strong> nội mạng

						</p>

						@else

							@if($value3->salecallout!=null)

							<p style="border-bottom: 1px solid #eeeeee;padding-bottom: 3px;">

							<strong>{{$value3->salecallout}} phút</strong> ngoại mạng

							</p>

							@else

							<p style="border-bottom: 1px solid #eeeeee;padding-bottom: 3px;">

							<strong>{{$value3->salecallin}} phút</strong> nội mạng

							</p>

							@endif

						@endif

					@endif

					

					@if($value3->title1!=null)

					<p><i class="fa fa-check-circle-o" style="color:green;"></i> {{$value3->title1}}</p>

					@endif

					@if($value3->title2!=null)

					<p><i class="fa fa-check-circle-o" style="color:green;"></i> {{$value3->title2}}</p>

					@endif

					<div class="row" style="margin-top: 5px;">

						<div class="col-sm-7 col-xs-6" style="padding-top: 6px;">

							@if($value3->price_sale ==0)

							<strong>Giá:</strong> <span style="color:red;"><strong>{{number_format($value3->price)}}<sup>đ</sup></strong></span>

							@else

							<strong>Giá gốc:</strong><span style="color:red;"><strong>

								<strike>{{number_format($value3->price)}}</strike><sup>đ</sup></strong></span>

							<br>

							<strong>Giá KM:</strong> <span style="color:red;"><strong>

								{{number_format($value3->price_sale)}}<sup>đ</sup></strong></span><br>





							@endif

							<a href="#" data-toggle="modal" data-target="#myModal2{{$k}}" style="color:#288ad6">Xem chi tiết</a>

							<div class="modal fade" id="myModal2{{$k}}" role="dialog">

							<div class="modal-dialog">

								<div class="modal-content">

									<div class="modal-header" style="background: yellow;">

										<button type="button" class="close" data-dismiss="modal">&times;</button>

										<h4 class="modal-title text-center"><strong>{{$value3->name}}</strong></h4>

									</div>

									<div class="modal-body" style="padding:10px 0px 15px 10px;">

										<div class="scrollbar" id="style-1">

											<table  class="table-bordered table table-hover">

												@if($value3->datadetail != null)

												<tr>

													<td style="width: 100px;">Data</td>

													<td>{{$value3->datadetail}}</td>

												</tr>

												@endif

												@if($value3->minutecall != null)

												<tr>

													<td>Phút gọi</td>

													<td>

														{{$value3->minutecall}} 

													</td>

												</tr>

												@endif

												<tr>

													<td>SMS</td>

													<td>

														@if($value3->salesmsin != null)

														Nội mạng: {{$row1->salesmsin}} sms <br>

														@endif

														@if($value3->salesmsout != null)

														Ngoại mạng: {{$row1->salesmsout}} sms

														@endif

													</td>

												</tr>

												@if($value3->saletime != null)

												<tr>

													<td>Thời gian KM</td>

													<td>{{$value3->saletime}}</td>

												</tr>

												@endif

												@if($value3->saleother != null)

												<tr>

													<td>KM khác</td>

													<td>{!!$value3->saleother!!}</td>

												</tr>

												@endif

	

												@if($value3->cycle != null)

												<tr>

													<td>Chu kì</td>

													<td>{{$value3->cycle}}</td>

												</tr>

												@endif

	

												@if($value3->phigoi != null)

												<tr>

													<td>Phí gói</td>

													<td>{{$value3->phigoi}}</td>

												</tr>

												@endif

	

												@if($value3->cuphap != null)

												<tr>

													<td>Cú pháp</td>

													<td>{{$value3->cuphap}}</td>

												</tr>

												@endif

	

	

												@if($value3->chuthich != null)

												<tr>

													<td colspan="2">{!!$value3->chuthich!!}</td>

												</tr>

												@endif

	

	

											</table>

	

										</div>

									</div>

									<div class="modal-footer">

										<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>

									</div>

								</div>

	

							</div>

						</div>

						</div>

						<div class="votenum col-sm-5 col-xs-6 text-right">

							<a href="{{url('san-pham/'.$value3->slug)}}"><strong>CHỌN SỐ</strong></a>

						</div>

					</div>

				</div>

	

			</div>

			@else

			<div class="item">



				<div class="title_res">

					<img src="{{asset('images/'.$value3->img_res)}}" style="width: 100%;">

				</div>

				<div class="content_res">

					<p><strong>{{$value3->data}}</strong> Data</p>

					<p><strong>{{$value3->salecallin}} phút</strong> nội mạng</p>

					<p style="border-bottom: 1px solid #eeeeee;padding-bottom: 3px;"><strong>{{$value3->salesmsin}} sms</strong> nội mạng</p>

					

					<p><i class="fa fa-check-circle-o" style="color:green;"></i> {{$value3->title1}}</p>

					<p><i class="fa fa-check-circle-o" style="color:green;"></i> {{$value3->title2}}</p>

					<div class="row" style="margin-top: 5px;">

						<div class="col-sm-6 col-xs-6" style="padding-top: 6px;">

							<strong>Giá:</strong> <span style="color:red;"><strong>{{number_format($value3->price)}}<sup>đ</sup></strong></span>

							<br>

							<a href="#" data-toggle="modal" data-target="#myModal2{{$k}}" style="color:#288ad6">Xem chi tiết</a>

							<div class="modal fade" id="myModal2{{$k}}" role="dialog">

							<div class="modal-dialog">

								<div class="modal-content">

									<div class="modal-header" style="background: yellow;">

										<button type="button" class="close" data-dismiss="modal">&times;</button>

										<h4 class="modal-title text-center"><strong>{{$value3->name}}</strong></h4>

									</div>

									<div class="modal-body" style="padding:10px 0px 15px 10px;">

										<div class="scrollbar" id="style-1">

											<table  class="table-bordered table table-hover">

												@if($value3->datadetail != null)

												<tr>

													<td style="width: 100px;">Data</td>

													<td>{{$value3->datadetail}}</td>

												</tr>

												@else

												@if($value3->data!=null)

												<tr>

													<td style="width: 100px;">Data</td>

													<td>{{$value3->data}}</td>

												</tr>

												@endif



												@endif

												@if($value3->minutecall != null)

												<tr>

													<td>Phút gọi</td>

													<td>

														{{$value3->minutecall}} 

													</td>

												</tr>

												@endif

												<tr>

													<td>SMS</td>

													<td>

														@if($value3->salesmsin != null)

														Nội mạng: {{$row1->salesmsin}} sms<br>

														@endif

														@if($value3->salesmsout != null)

														Ngoại mạng: {{$row1->salesmsout}} sms

														@endif

													</td>

												</tr>

												@if($value3->saletime != null)

												<tr>

													<td>Thời gian KM</td>

													<td>{{$value3->saletime}}</td>

												</tr>

												@endif

												@if($value3->saleother != null)

												<tr>

													<td>KM khác</td>

													<td>{!!$value3->saleother!!}</td>

												</tr>

												@endif

	

												@if($value3->cycle != null)

												<tr>

													<td>Chu kì</td>

													<td>{{$value3->cycle}}</td>

												</tr>

												@endif

	

												@if($value3->phigoi != null)

												<tr>

													<td>Phí gói</td>

													<td>{{$value3->phigoi}}</td>

												</tr>

												@endif

	

												@if($value3->cuphap != null)

												<tr>

													<td>Cú pháp</td>

													<td>{{$value3->cuphap}}</td>

												</tr>

												@endif

	

	

												@if($value3->chuthich != null)

												<tr>

													<td colspan="2">{!!$value3->chuthich!!}</td>

												</tr>

												@endif

	

	

											</table>

	

										</div>

									</div>

									<div class="modal-footer">

										<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>

									</div>

								</div>

	

							</div>

						</div>

						</div>

						<div class="votenum col-sm-6 col-xs-6 text-right">

							<a href="{{url('san-pham/'.$value3->slug)}}"><strong>CHỌN SỐ</strong></a>

						</div>

					</div>

				</div>



			</div>

			@endif

			<?php $k++; ?>

			@endforeach

		</div>



		<!-- Left and right controls -->

		<a class="carousel-control" href="#myCarousel{{$i}}" data-slide="prev"></a>

		<a style="background-image: none;" class="right carousel-control" href="#myCarousel{{$i}}" data-slide="next"></a>

	</div>

	<?php $i++; ?>

	@endforeach



	<!-- 	

	







<!-- <script>

	$(document).ready(function() {

		$("#showwz").modal("show")

	})

</script>



-->







<script>

	<?php for($k=0;$k<20;$k++): ?>

		var slideIndex{{$k}} = 1;

		showDivs{{$k}}(slideIndex{{$k}});



		function plusDivs{{$k}}(n) {

			showDivs{{$k}}(slideIndex{{$k}} += n);

		}





		function showDivs{{$k}}(n) {

			var i;

			var x = document.getElementsByClassName("mySlides{{$k}}");

			if (n > x.length) {slideIndex{{$k}} = 1}    

				if (n < 1) {slideIndex{{$k}} = x.length}

					for (i = 0; i < x.length; i++) {

						x[i].style.display = "none";  

					}

					x[slideIndex{{$k}}-1].style.display = "block";  

				}

			<?php endfor; ?>



		</script>

	</div>









	@endsection