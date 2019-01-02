<style>
@media screen and (max-width: 500px){.sear{padding-right: 0px;}}
header{background: rgba(255,255,255,0.5);padding-top: 5px;padding-bottom: 5px;}
.logo{width: 100%;height: 30px;}
.logo img{width: 140px;height: 53px;}
.sear{padding-top: 8px;}
@media screen and (max-width: 500px){.logo img{height: 32px;}.sear{padding-right: 0px;padding-top: 0px;}}
@media screen and (max-width: 1000px){.logo img{height: 40px;}}
.cat{min-width: 50px;height: 50px;float: left;padding-left: 10px;padding-right: 10px;}
.cat img{width: 40px;height: 40px;}
.name-top{font-size: 0.8em;margin-top: -4px;}
.cat:hover{background: rgba(0,0,0,0.1);}
</style>
<?php 
use App\Models\Menu;
$menu = Menu::where('stateid',1)->where('parentid',0)->get();
use App\Models\Logo;
$logo = Logo::where('id',1)->where('stateid',1)->get();
?>
<header style="border-bottom: 1px solid #eeeeee;">
	<div class="container">
		<div class="row">
			<div class="col-md-1 col-sm-10 col-xs-10">
				<div class="logo">
					@foreach($logo as $lo)
					<a href="{{url('/')}}"><img src="{{asset('images/'.$lo->logo)}}" class="img-responsive"></a>
					@endforeach
				</div>			
			</div>
			<div style="right:0px;" class="col-md-10 col-sm-2 col-xs-2" >
				<div class="pull-left">
					<?php $cc=3; ?>
					@foreach($menu as $list)
					<?php $submenu1 = Menu::where('stateid',1)->where('parentid',$list->id)->get(); ?>
					<div class="cat hidden-xs hidden-sm">
						<a href="{{$list->slug}}" style="color: inherit;text-decoration: none;">
							<center>	
								<img src="{{asset('images/'.$list->icon)}}" title="{{$list->name}}">
							</center>
							<center>	
								<div class="name-top">{{$list->name}}</div>
							</center>
						</a>
						@if(count($submenu1))
						<div class="dmm">
							<div class="row">
								@foreach($submenu1 as $sub1)
								<?php $submenu2 = Menu::where('stateid',1)->where('parentid',$sub1->id)->get(); ?>
								<div class="col-md-3" style="padding: 0px;">
									<strong><a style="font-size: 1em;" href="{{$sub1->slug}}">{{$sub1->name}}</a></strong>
									@if(count($submenu2))
									<div style="border-top: 1px solid #eeeeee;margin-left: 10px;"></div>
									<div class="row" style="padding-left: 15px;">
										@foreach($submenu2 as $sub2)
										<div class="col-md-12" style="padding: 0px;">
											<a href="{{$sub2->slug}}">{{$sub2->name}}</a>
										</div>
										@endforeach
									</div>
									@endif
								</div>
								@endforeach
							</div>
						</div>
						@endif
					</div>
					@endforeach
					<a href="javascript:void(0)"><div id="icon" style="font-size: 1.5em;" class="icon hidden-md hidden-lg">
						<i class="fa fa-bars"></i>
					</div></a>				
				</div>
			</div>
			<div class="col-md-1 hidden-xs hidden-sm" style="margin-top: 7px;">
				<form action="{{url('ketquatimkiem')}}" method="POST" enctype="multipart/form-data" >
					{{csrf_field()}}
					<div class="input-group1">
						<input name="keyword" type="text" class="form-control" placeholder="Tìm kiếm..." style="background:none;border-radius: 15px 0px 0px 15px;border-right: none;border:1px solid #eeeeee;">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit"  style="background:none;border-left:none;border-radius: 0px 15px 15px 0px;border:1px solid #eeeeee;"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</form>
			</div>

		</div>
	</div>
	<div id="subres" class="sub_res">
		@foreach($menu as $list)
		<div class="cha">
			@if($list->slug!="")
			<a href="{{$list->slug}}" >
				<img src="{{asset('images/'.$list->icon)}}" title="{{$list->name}}">&nbsp;&nbsp;
				<span style="top: 107px;"><strong>{{$list->name}}</strong></span>
			</a>
			@else
			<a href="#">
				<img src="{{asset('images/'.$list->icon)}}" title="{{$list->name}}">&nbsp;&nbsp;
				<span style="top: 107px;"><strong>{{$list->name}}</strong></span>
			</a>
			@endif
			
			<?php $cap1 = Menu::where('parentid',$list->id)->get(); ?>
			@if(count($cap1))
			<div class="sub_res2">
				@foreach($cap1 as $zzz)
				<a <?php if($zzz->slug!=""){echo "href='".$zzz->slug."'";} ?> "><strong>{{$zzz->name}}</strong></a>
				<?php $cap2 = Menu::where('parentid',$zzz->id)->get(); ?>
				@if(count($cap2))
				@foreach($cap2 as $xxx)
				<a <?php if($zzz->slug!=""){echo "href='".$xxx->slug."'";} ?> style="padding-left: 30px;">{{$xxx->name}}</a>
				@endforeach
				@endif
				@endforeach
			</div>
			@endif
		</div>
		@endforeach

	</div>
	<style>
	.sub_res2{display: none;}
	.cha:hover .sub_res2{display: block;max-height: 2000px;}
</style>




<script> 
	$(document).ready(function(){
		$("#icon").click(function(){
			$("#subres").slideToggle("slow");
		});
		$(".wrapper").mouseover(function(){
			$("#subres").slideUp("slow");
		});
	});
</script>
</header >