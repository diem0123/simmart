<!DOCTYPE html>
<html>
<head>
	<title>Đăng nhập</title>
	<!-- <base href="http://localhost/demo_sim/"> -->
	<link rel="icon" href="{{asset('images/login.png')}}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/css/font-awesome.min.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('css/index.css')}}"/>
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-theme.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="public/css/responsive.css">
	<style>
	body{background: #eee url(http://3.bp.blogspot.com/_9MHWX9_nZmk/S-r8ynEEd8I/AAAAAAAABlo/PICNl3nyBVg/s1600/FUNDO_CINZA_WILIAN.jpg);}
	html,body{
		position: relative;
		height: 100%;
	}

	.login-container{
		position: relative;
		width: 300px;
		margin: 80px auto;
		padding: 20px 40px 40px;
		text-align: center;
		background: #fff;
		border: 1px solid #ccc;
	}

	#output{
		position: absolute;
		width: 300px;
		top: -75px;
		left: 0;
		color: #fff;
	}

	#output.alert-success{
		background: rgb(25, 204, 25);
	}

	#output.alert-danger{
		background: rgb(228, 105, 105);
	}


	.login-container::before,.login-container::after{
		content: "";
		position: absolute;
		width: 100%;height: 100%;
		top: 3.5px;left: 0;
		background: #fff;
		z-index: -1;
		-webkit-transform: rotateZ(4deg);
		-moz-transform: rotateZ(4deg);
		-ms-transform: rotateZ(4deg);
		border: 1px solid #ccc;

	}

	.login-container::after{
		top: 5px;
		z-index: -2;
		-webkit-transform: rotateZ(-2deg);
		-moz-transform: rotateZ(-2deg);
		-ms-transform: rotateZ(-2deg);

	}

	.avatar{
		width: 100px;height: 100px;
		margin: 10px auto 30px;
		border-radius: 100%;
		border: 2px solid #aaa;
		background-size: cover;
	}

	.form-box input{
		width: 100%;
		padding: 10px;
		text-align: center;
		height:40px;
		border: 1px solid #ccc;;
		background: #fafafa;
		transition:0.2s ease-in-out;

	}

	.form-box input:focus{
		outline: 0;
		background: #eee;
	}

	.form-box input[type="text"]{
		border-radius: 5px 5px 0 0;
		text-transform: lowercase;
	}

	.form-box input[type="password"]{
		border-radius: 0 0 5px 5px;
		border-top: 0;
	}

	.form-box button.login{
		margin-top:15px;
		padding: 10px 20px;
	}

	.animated {
		-webkit-animation-duration: 1s;
		animation-duration: 1s;
		-webkit-animation-fill-mode: both;
		animation-fill-mode: both;
	}

	@-webkit-keyframes fadeInUp {
		0% {
			opacity: 0;
			-webkit-transform: translateY(20px);
			transform: translateY(20px);
		}

		100% {
			opacity: 1;
			-webkit-transform: translateY(0);
			transform: translateY(0);
		}
	}

	@keyframes fadeInUp {
		0% {
			opacity: 0;
			-webkit-transform: translateY(20px);
			-ms-transform: translateY(20px);
			transform: translateY(20px);
		}

		100% {
			opacity: 1;
			-webkit-transform: translateY(0);
			-ms-transform: translateY(0);
			transform: translateY(0);
		}
	}

	.fadeInUp {
		-webkit-animation-name: fadeInUp;
		animation-name: fadeInUp;
	}
</style>
</head>
<body>
	<div class="container">
		<div class="login-container">
			<div id="output"></div>
			<h4><strong>Đăng nhập hệ thống</strong></h4>
			<div class="avatar"><img src="{{asset('images/user.png')}}" style="width: 100%;"></div>
			<div class="form-box">
				<form action="" method="POST" enctype="multipart/form-data">
					{{csrf_field()}}
					<input name="user" value="{{old('user')}}" type="text" placeholder="Tài khoản">
					<input type="password" name="password" value="{{old('password')}}" placeholder="Mật khẩu">
					@if($errors->has('user'))
					<div class="error">{{$errors->first('user')}}</div>
					@endif
					@if($errors->has('password'))
					<div class="error">{{$errors->first('password')}}</div>
					@endif
					@if(session('message'))
						<div class="error">{{session('message')}}</div>
					@endif
					<button class="btn btn-info btn-block login" type="submit">Đăng nhập</button>
				</form>
			</div>
		</div>

	</div>

	<script>

		$(function(){
			var textfield = $("input[name=user]");
			$('button[type="submit"]').click(function(e) {
				e.preventDefault();
                //little validation just to check username
                if (textfield.val() != "") {
                    //$("body").scrollTo("#output");
                    $("#output").addClass("alert alert-success animated fadeInUp").html("Welcome back " + "<span style='text-transform:uppercase'>" + textfield.val() + "</span>");
                    $("#output").removeClass(' alert-danger');
                    $("input").css({
                    	"height":"0",
                    	"padding":"0",
                    	"margin":"0",
                    	"opacity":"0"
                    });
                    //change button text 
                    $('button[type="submit"]').html("continue")
                    .removeClass("btn-info")
                    .addClass("btn-default").click(function(){
                    	$("input").css({
                    		"height":"auto",
                    		"padding":"10px",
                    		"opacity":"1"
                    	}).val("");
                    });
                    
                    //show avatar
                    $(".avatar").css({
                    	"background-image": "url('https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRL1uzmgyrfPwUC7UwnOFHFtkAhQrAUYufbLzWvOt9N8pRt1zlV')"
                    });
                } else {
                    //remove success mesage replaced with error message
                    $("#output").removeClass(' alert alert-success');
                    $("#output").addClass("alert alert-danger animated fadeInUp").html("sorry enter a username ");
                }
                //console.log(textfield.val());

            });
		});

	</script>
	@include('admin.modules.popup')


	
	<script type="text/javascript" src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
</body>
</html>