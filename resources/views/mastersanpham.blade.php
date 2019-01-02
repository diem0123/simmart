<!DOCTYPE html>
<html>
<head>
	<?php use App\Models\Seo; $seo = Seo::where('id',1)->first(); ?>
	<title>@yield('title') - {{$seo->title}}</title>
	<meta name="author" content="{{$seo->author}}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="geo.region" content="VN-57" />
	<meta name="geo.placename" content="{{$seo->address}}" />
	<meta name="geo.position" content="{{$seo->toado}}" />
	<meta name="ICBM" content="{{$seo->toado}}" />
	@yield('meta')
	<link rel="icon" href="{{asset('images/favicon.png')}}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/css/font-awesome.min.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('css/index.css')}}"/>
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-theme.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}">

	<script type="text/javascript" src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
	<script src="{{asset('js/jquery.minn.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	
	<script src="{{asset('js/search.js')}}"></script>
	
	

	
	<style type="text/css">
	body{
		margin: 0px;
		padding: 0px;
	}

</style>
</head>
<body>
	@include('header')
	<div class="wrapper">
		<div class="container" id="container" style="min-height: 400px;">
			@include('search')
			@yield('content')

		</div>
	</div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.0';
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

@include('footer')
</body>
</html>