<header class="main-header">
    <a href="{{url('admin')}}" class="logo">
      <span class="logo-mini">QTHT</span>
      <span class="logo-lg"><i class="fa fa-home"></i> Trang chủ</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('images/'.Session::get('login')->img)}}" class="user-image">
              <span class="hidden-xs">{{Session::get('login')->fullname}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="{{asset('images/'.Session::get('login')->img)}}" class="img-circle" alt="User Image">
                <p>
                  {{Session::get('login')->fullname}}
                  <small>Email: {{Session::get('login')->email}}</small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{url('admin/user/update/'.Session::get('login')->id)}}" class="btn btn-default btn-flat">Chỉnh sửa thông tin</a>
                </div>
                <div class="pull-right">
                  <a href="{{url('admin/logout')}}" class="btn btn-default btn-flat">Đăng xuất</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>

    </nav>
  </header>