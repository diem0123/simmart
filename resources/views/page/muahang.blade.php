@extends('master')
@section('title', 'Đặt hàng')
@section('content')
<div class="container" style="max-width:800px;margin: auto; background: #f0f0f0; min-height: 500px;">
	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-6">
			<span style="color: #288ad6" id="back">Trở về</span>
		</div>
		
	</div>
	<div class="content" style="background: white; margin: 10px; box-shadow: 0px 1px 14px;padding:10px 20px 10px 20px;">
		<div class="row" >
			<div class="col-md-2">
				<img src="{{asset('images/Sim.jpg')}}" width="50px;">
			</div>
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">
						Sim: <span style="color: #288ad6"><strong>{{$row->number}}</strong>: <span id="gia_sim" style="color: red; font-weight: bold;">{{number_format($row->price)}} ₫</span> </span>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php $gia="";
						if($cat->price_sale!=0){
							$gia = $cat->price_sale;
						}else{
							$gia = $cat->price;
						}
						?>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="row">
					
				</div>
				<div class="row">
					
					
				</div>
			</div>
		</div>
		<hr>
		<div  style="padding: 5px; background: #f0f0f0">
			<p style="font-weight: bold;">THÔNG TIN GÓI CƯỚC</p>
			<p style="font-weight: bold; color: #288ad6">{{$cat->name}}</p>
			<p><i class="fas fa-circle dot"></i> {{$cat->minutecall}}</p>
			<p><i class="fas fa-circle dot"></i> {{$cat->datadetail}}</p>
			<p><i class="fas fa-circle dot"></i> Cú pháp: {{$cat->cuphap}}</p>
			<p><i class="fas fa-circle dot"></i> Phí gói: {{$cat->phigoi}}</p>
			<p><i class="fas fa-circle dot"></i> Chú thích: {!!$cat->chuthich!!}</p>
		</div>
		<hr>
{{-- 		<div class="row" style="margin: 0px; padding: 5px;">
			<div class="col-md-6 col-sm-6 col-xs-6 ">
				<p>Phí giao hàng</p>
				<p style="font-weight: bold;">Cần thành toán</p>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-6" style="text-align: right;">
				<p>+ {{number_format($ship->ship)}}<sup>đ</sup></p>
				<strong><p style="color: red">{{number_format($row->price+$ship->ship)}}<sup>đ</sup></p></strong>
			</div>
		</div> --}}

		<form id="registrationForm" method="POST" enctype="multipart/form-data">
			<div  style="padding: 5px; background: #f0f0f0">
				<p style="font-weight: bold;">THÔNG TIN CỦA QUÝ KHÁCH</p>

				<div class="row" style="margin: 0px; padding: 5px;">

					{{csrf_field()}}
					<input type="hidden" name="productid" value="{{$row->id}}">
					<input type="hidden" name="state" value="{{$row->stateid}}">
					<input type="hidden" name="price" value="{{$row->price}}">
					<input type="hidden" name="number" value="{{$row->number}}">
					<input type="hidden" name="pricecat" value="{{$gia}}">
					<input type="hidden" name="ship" value="{{$ship->ship}}">
					<div id="male_female">
						<span>
							<input type="radio" id="male_f" name="male_f" value="1" checked="checked" >
							<label for="">Anh</label>
						</span>
						<span style="margin-left: 20px;">
							<input type="radio" id="male_f2" name="male_f" value="2">
							<label for="">Chị</label>
						</span>
						<!--//giới tính-->
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="fullname" placeholder="Nhập họ và tên bạn (Bắt buộc)" />
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="phone" placeholder="Nhập số điện thoại của bạn (Bắt buộc)" />
					</div>

					<div class="form-group">
						<input type="text" class="form-control" name="email" placeholder="Nhập Email của bạn (Bắt buộc)" />
					</div>

					<div id="home" class="tab-pane fade in active">
						<div class="row" style="margin-top: 20px;">
							<div class="col-md-6 col-sm-6 col-xs-6" >
								
								<select class="form-control" name="data_tinh" id="data_tinh" data-dependent="quan">
					              <option value="0" disable="true" selected="true">Tỉnh, thành</option>
					                @foreach ($province as $data_province)
					                  <option value="{{$data_province->matp}}">{{ $data_province->name }}</option>
					                @endforeach
					            </select>
								<input type="hidden" class="form-control" name="tinh" id="tinh" value="">
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6">
								<select class="form-control" name="data_quan" id="data_quan">
					              <option value="" disable="true" selected="true">Quận, huyện</option>
					            </select>								
								<input type="hidden" class="form-control" name="quan" id="quan" value="">
							</div>
						</div>
						<div class="row" style="margin-top: 10px;">
							<div class="col-md-6 col-sm-6 col-xs-6">
								<select class="form-control" name="data_phuong" id="data_phuong">
					              <option value="" disable="true" selected="true">Chọn phường, xã, thị trấn...</option>
					            </select>
								<input class="form-control" type="hidden" name="phuong" id="phuong" placeholder="" >
					        </div>
							<div class="col-md-6 col-sm-6 col-xs-6">
								<input  type="text" class="form-control" placeholder="Số nhà, tên đường" name="sonha">
							</div>
						</div>

						<div class="row" style="margin-top: 20px;">
							<p style="padding-left: 20px;">Thời gian giao hàng</p>
							<div class="col-md-6 col-sm-6 col-xs-6">
								<input onchange="zzzzzzzz(this.value)"  id="shipdate" type="date" name="shipdate" class="form-control" value="Chọn ngày giao hàng">
								<div style="color:red;" id="error"></div>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-6">
								<select name="shiptime" id="" class="form-control">
									<option value="18">Trước 18 giờ</option>
									<option value="19">Trước 19 giờ</option>
									<option value="20">Trước 20 giờ</option>
									<option value="21">Trước 21 giờ</option>
									<option value="22">Trước 22 giờ</option>
								</select>
							</div>
						</div>
					</div>
					{{-- <button  type="submit" class="btnmua"><strong>ĐẶT MUA</strong></button> --}}

				</div>
			</div>
			<hr>
			<div  style="padding: 5px; background: #f0f0f0">
				<p style="font-weight: bold;">PHƯƠNG THỨC GIAO HÀNG</p>
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<button id="giao_hang_cham" class="btn btn-primary" type="button">Giao hàng chậm từ 1-2 ngày</button>
						<div style="border-bottom: 1px solid rgba(0,0,0,0); margin: 10px"></div>
						<button id="hoa_toc" class="btn btn-primary" type="button">Giao hàng hỏa tốc</button>
						<div style="border-bottom: 1px solid rgba(0,0,0,0); margin: 10px"></div>
						<button id="tai_sieu_thi" class="btn btn-primary" type="button">Nhận tại siêu thị</button>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<center>
							<h4 style="color: #428BCA"><b>Phí giao hàng</b></h4>
							<b id="price_sim"></b>
						</center>
					</div>
				</div>
			</div>

			<hr>
			<div  style="padding: 5px; background: #f0f0f0">
				<p style="font-weight: bold;">TỔNG CỘNG</p>
				<div class="row" style="margin-bottom: 15px">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<center>
							<br>
							Sim + Ship
						</center>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<center>
							<b id="price_total"></b>
							<button class="btn btn-danger btnmua" type="submit">Đặt Mua</button>
						</center>
					</div>
				</div>
			</div>

		</form>
	</div>
</div><!-- content -->
</div>


<script src="{{asset('public/storage/js.storage.min.js')}}" type="text/javascript"></script>



<!--------- New Code ----------->

<!------------- End  New Code ---------------->




<script type="text/javascript">
	$(function () {
		storage = Storages.localStorage;

		$('.btnmua').click(function(event) {
			if (storage.get('kieu_thanh_toan') == 1) {
				event.preventDefault();

				var province = $('[name="tinh"]').val();
				var district = $('[name="quan"]').val();
				var address = $('[name="sonha"]').val();
				var name = $('[name="fullname"]').val();
				var tel = $('[name="phone"]').val();
				var id = {{$row->id}};
				var pick_money = {{$row->price}};
				var so_sim = {{$row->number}};
				var phi_ship = $('#price_sim').text();
				//loi sua
				var shipdate = $('input[name="shipdate"]').val();
				var gioi_tinh = $('input[name="male_f"]:checked').val();
				var gia_sim = $('span#gia_sim').text();
				//

				var hostname = $(location).attr('hostname');
				var geturl = "/chon-so/api/luudonhang";
				//var geturl = 'https://'+ hostname + "/chon-so/api/taodonhang"
				$.get(geturl, {
					id: id,
					province: province,
					district: district,
					address: address,
					tel: tel,
					pick_money: pick_money,
					name: name,
					so_sim: so_sim,
					phi_ship: phi_ship,
					//loi sua
					shipdate:shipdate,
					gioi_tinh:gioi_tinh,
					gia_sim:gia_sim
					//
				}, function(data){
					console.log(data);
					if (data == 'false') {
						alert('Thông tin của bạn chưa đầy đủ');
					}else{
						alert('Thông tin mua hàng đã được cập nhật');
						storage.remove('kieu_thanh_toan');
						$(location).attr('href','http://'+hostname);
					}					
				});				
			}
		});

		$('#tai_sieu_thi').click(function() {
			$('#price_sim').text('0 VNĐ');
			storage.set('kieu_thanh_toan', 3);
		});

		$('#hoa_toc').click(function() {
			$('#price_sim').text('Bộ phận kinh doanh sẽ liên hệ trực tiếp với quý khách');
			storage.set('kieu_thanh_toan', 2);
		});

		$('#giao_hang_cham').click(function() {
			storage.set('kieu_thanh_toan', 1);


			var province = $('[name="tinh"]').val();
			var district = $('[name="quan"]').val();
			var address = $('[name="sonha"]').val();


			var hostname = $(location).attr('hostname');
			var geturltinhcuoc = "/chon-so/api/tinhcuocvanchuyen"
			//var geturltinhcuoc = 'https://'+ hostname + "/chon-so/api/tinhcuocvanchuyen"

			$.get(geturltinhcuoc, {
				province: province,
				district: district,
				address: address
			}, function(data){

				json = JSON.parse(data);
				if (json.success == false) {
					$('#price_sim').text('Bạn chưa nhập đủ thông tin mua hàng.');
				}
				if (json.fee.delivery == false) {
					$('#price_sim').text('Xin lỗi! Địa điểm không được hỗ trợ giao hàng.');
				}else{
					price_format = (json.fee.fee + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"); 
					$('#price_sim').text(price_format+' VNĐ');

					total = {{$row->price}} + json.fee.fee;
					total = (total + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"); 
					$('#price_total').text(total + " VNĐ");
				}
			});
		});
	});
</script>

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
        	fullname: { 
        		message: 'The username is not valid',
        		validators: {
        			notEmpty: {
        				message: 'Họ tên không được bỏ trống'
        			}
        		}
        	},
        	phone: {
        		validators: {
        			notEmpty: {
        				message: 'Số điện thoại không được bỏ trống'
        			},
        			numberic:{
        				message: 'Số điện thoại không hợp lệ'
        			},
        			stringLength: {
        				min: 9,
        				max: 12,
        				message: 'Số điện thoại không hợp lệ'
        			},
        			regexp: {
        				regexp: /^[Z0-9_]+$/,
        				message: 'Số sim phải là số'
        			}
        		}
        	},
        	email: {
        		validators: {
        			notEmpty: {
        				message: 'Email không được bỏ trống'
        			},
        			emailAddress:{
        				message: 'Email phải có phần @'
        			}
        		}
        	}
        }
    });
	});
</script>
<script>
	function zzzzzzzz(a){
		/*var a = getElementsById('shipdate').value();*/
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1;
		var yyyy = today.getFullYear();
		if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm}
			today = yyyy+""+mm+""+dd;
		var nam = a.substr(0,4);
		var thang = a.substr(5,2);
		var ngay = a.substr(8,2);
		var ngaychon = nam+thang+ngay;
		document.getElementById("error").innerHTML ="";
		if(ngaychon<today){
			document.getElementById("shipdate").value ="";
			document.getElementById("error").innerHTML =  "Ngày giao hàng không hợp lệ";
		}
	}
</script>

 <script type="text/javascript">
	$(document).ready(function(){

		$(document).on('change','#data_tinh',function(){
			// console.log("hmm its change");
			
			var id_tinh=$(this).val();
			//console.log(id_tinh);
			var div=$(this).parent();
			//console.log(div);
			var op=" ";


			$.ajax({
				type:'get',
				url:'{!!URL::to('tinhthanh')!!}',
				data:{'ID_PROVINCE':id_tinh},
				success:function(data){
					//console.log('success');

					console.log(data);
					$.each(data, function(index, districtsObj){
		            $('#tinh').val(districtsObj.name);
		          });

					
				},
				error:function(){

				}
			});


			$.ajax({
				type:'get',
				url:'{!!URL::to('listquanhuyen')!!}',
				data:{'ID_PROVINCE':id_tinh},
				success:function(data){
					//console.log('success');

					//console.log(data);

					//console.log(data.length);
					op+='<option value="0" selected disabled>Chọn quận, huyện...</option>';
					for(var i=0;i<data.length;i++){
					op+='<option value="'+data[i].maqh+'">'+data[i].name+'</option>';
					//console.log('<option value="'+data[i].NAME+'">'+data[i].NAME+'</option>');
				   }
				   $('#data_quan').html(" ");
				   $('#data_quan').append(op);
				},
				error:function(){

				}
			});

		});

		$(document).on('change','#data_quan',function(){
			// console.log("hmm its change");
			
			var id_quan=$(this).val();
			var opp = " ";
			//console.log(id_tinh);
			$.ajax({
				type:'get',
				url:'{!!URL::to('quanhuyen')!!}',
				data:{'ID_DIST':id_quan},
				success:function(data){
					//console.log('success');

					console.log(data);
					$.each(data, function(index, districtsObj){
		            $('#quan').val(districtsObj.name);
		          });

					
				},
				error:function(){

				}
			});

			$.ajax({
				type:'get',
				url:'{!!URL::to('listphuongxa')!!}',
				data:{'ID_DIST':id_quan},
				success:function(data){
					//console.log('success');

					//console.log(data);

					//console.log(data.length);
					opp+='<option value="0" selected disabled>Chọn phường, xã, thị trấn...</option>';
					for(var i=0;i<data.length;i++){
					opp+='<option value="'+data[i].xaid+'">'+data[i].name+'</option>';
					//console.log('<option value="'+data[i].NAME+'">'+data[i].NAME+'</option>');
				   }
				   $('#data_phuong').html(" ");
				   $('#data_phuong').append(opp);
				},
				error:function(){

				}
			});

		});
		$(document).on('change','#data_phuong',function(){
			// console.log("hmm its change");
			
			var id_phuongxa=$(this).val();
			//console.log(id_tinh);
			$.ajax({
				type:'get',
				url:'{!!URL::to('phuongxa')!!}',
				data:{'ID_XA':id_phuongxa},
				success:function(data){
					//console.log('success');

					console.log(data);
					$.each(data, function(index, districtsObj){
		            $('#phuong').val(districtsObj.name);
		          });

					
				},
				error:function(){

				}
			});			

		});

	});
</script>



@endsection