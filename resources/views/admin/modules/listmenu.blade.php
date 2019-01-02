<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{asset('images/'.Session::get('login')->img)}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{Session::get('login')->fullname}}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <?php $url =  Request::segment(1)."/".Request::segment(2);  ?>
    <?php $url1 = url()->current(); ?>
    <ul class="sidebar-menu" data-widget="tree">

      <li class="<?php if($url1==route('gettitle')) echo "active"; ?>">
        <a href="{{url('admin/title')}}">
          <i class="fa fa-dashboard"></i> <span>Thông tin gói cước</span>
        </a>
      </li>
      <li class="treeview <?php if($url1==route('getcategory') || $url1==route('getinsertcategory') ) echo "active"; ?>">
        <a href="#">
          <i class="fa fa-files-o"></i>
          <span>Gói cước</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if($url1==route('getcategory')){echo "class='active'";} ?>><a href="{{url('admin/category')}}"><i class="fa fa-circle-o"></i> Tất cả gói cước</a></li>
          <li <?php if($url1==route('getinsertcategory')){echo "class='active'";} ?>><a href="{{url('admin/category/insert')}}"><i class="fa fa-circle-o"></i> Thêm gói cước</a></li>

        </ul>
      </li>

      <li class="<?php if($url1==route('getsimstyle')) echo "active"; ?>">
        <a href="{{url('admin/simstyle')}}">
          <i class="fa fa-files-o"></i>
          <span>Loại sim</span>
        </a>
      </li>
      <li class="<?php if($url1==route('getnhamang')) echo "active"; ?>">
        <a href="{{url('admin/nhamang')}}">
          <i class="fa fa-files-o"></i>
          <span>Nhà mạng</span>
        </a>
      </li>
      <li class="treeview <?php if($url1==route('getproduct') || $url1==route('getinsertproduct') || $url1==route('getshippingproduct')) echo "active"; ?>">
        <a href="#">
          <i class="fa fa-pie-chart"></i>
          <span>Số sim</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li  <?php if($url1==route('getproduct')){echo "class='active'";} ?> ><a href="{{url('admin/product')}}"><i class="fa fa-circle-o"></i> Tất cả số sim</a></li>
          <li <?php if($url1==route('getinsertproduct')){echo "class='active'";} ?>><a href="{{url('admin/product/insert')}}"><i class="fa fa-circle-o"></i> Thêm số sim</a></li>
          <li <?php if($url1==route('getshippingproduct')){echo "class='active'";} ?>><a href="{{url('admin/product/shipping')}}"><i class="fa fa-circle-o"></i> Số sim đã thanh toán</a></li>
        </ul>
      </li>
      <li class="treeview <?php if($url1==route('getorder') || $url1==route('getship') || $url1==route('getorderpay') || $url1==route('getorderfail')) echo "active"; ?>">
        <a href="#">
          <i class="fa fa-laptop"></i>
          <span>Đơn hàng</span>
          <span class="pull-right-container">
            <?php use App\Models\Order;$count=Order::where('stateid',3)->get(); ?>
            @if(count($count))
            <small class="label pull-right bg-yellow">{{count($count)}}</small>
            @else
            <i class="fa fa-angle-left pull-right"></i>
            @endif
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if($url1==route('getorder')){echo "class='active'";}  ?>><a href="{{url('admin/order')}}"><i class="fa fa-circle-o"></i> Đơn hàng đã đặt</a></li>
          <li <?php if($url1==route('getship')){echo "class='active'";}  ?>><a href="{{url('admin/order/ship')}}"><i class="fa fa-circle-o"></i> Đơn hàng đang chuyển</a></li>
          <li <?php if($url1==route('getorderpay')){echo "class='active'";}  ?>> <a href="{{url('admin/order/pay')}}"><i class="fa fa-circle-o"></i> Đơn hàng đã thanh toán</a></li>
          <li <?php if($url1==route('getorderfail')){echo "class='active'";}  ?>><a href="{{url('admin/order/fail')}}"><i class="fa fa-circle-o"></i> Đơn hàng đã hủy</a></li>
        </ul>
      </li>

      <li class="treeview <?php if($url1==route('/duyetdonhang') || $url1==route('/trangthai')) echo "active"; ?>">
        <a href="#">
          <i class="fa fa-laptop"></i>
          <span>API Giao hàng tiết kiệm</span>
        </a>
        <ul class="treeview-menu">
          <li <?php if($url1==route('/duyetdonhang')){echo "class='active'";}  ?>>
            <a href="{{url('/api/duyetdonhang')}}">
              <i class="fa fa-circle-o"></i>Duyệt đơn hàng
            </a>
          </li>

          <li <?php if($url1==route('/trangthai')){echo "class='active'";}  ?>>
            <a href="{{url('/api/trangthai')}}">
              <i class="fa fa-circle-o"></i>Trạng thái các đơn hàng
            </a>
          </li>
        </ul>
      </li>

      <li <?php if($url1==route('/file')){echo "class='active'";}  ?>>
        <a href="{{url('/api/file')}}">
          <i class="fa fa-circle-o"></i>Quản lý File
        </a>
      </li>

      <li class="<?php if($url1==route('getinfor_customer')) echo "active"; ?>">
        <a href="{{url('admin/infor_customer')}}">
          <i class="fa fa-edit"></i> <span>Khách hàng đã đặt</span>
        </a>
      </li>
      <li class="treeview <?php if($url1==route('getmenu') || $url1==route('getinsertmenu')) echo "active"; ?>">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>Menu</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if($url1==route('getmenu')) echo "class='active'"; ?>><a href="{{url('admin/menu')}}"><i class="fa fa-circle-o"></i> Tất cả loại menu</a></li>
          <li <?php if($url1==route('getinsertmenu')) echo "class='active'"; ?>><a href="{{url('admin/menu/insert')}}"><i class="fa fa-circle-o"></i> Thêm loại menu</a></li>
        </ul>
      </li>

      <li class="treeview <?php if($url1==route('getdichvu') || $url1==route('getinfoo') ) echo "active"; ?>">
        <a href="#">
          <i class="fa fa-edit"></i> <span>Footer</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if($url1==route('getdichvu')){echo "class='active'";} ?>><a href="{{url('admin/footer/dichvu')}}"><i class="fa fa-circle-o"></i> Dịch vụ</a></li>
          <li <?php if($url1==route('getinfoo')){echo "class='active'";} ?>><a href="{{url('admin/footer/info')}}"><i class="fa fa-circle-o"></i> Thông tin công ty</a></li>

        </ul>
      </li>
      <li class="<?php if($url1==route('getlogo')) echo "active"; ?>">
        <a href="{{url('admin/logo')}}">
          <i class="fa fa-edit"></i> <span>Logo & phí vận chuyển</span>
        </a>
      </li>

      <li class="<?php if($url1==route('getdashboard')) echo "active"; ?>">
        <a href="{{url('admin')}}">
          <i class="fa fa-edit"></i> <span>Thống kê doanh số</span>
        </a>
      </li>

      <li class="<?php if($url1==route('seo')) echo "active"; ?>">
        <a href="{{url('admin/seo')}}">
          <i class="fa fa-edit"></i> <span>Seo trang chủ</span>
        </a>
      </li>
    </li>
  </ul>
</section>
<!-- /.sidebar -->
</aside>