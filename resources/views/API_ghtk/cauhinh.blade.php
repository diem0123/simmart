@extends('masteradmin')
@section('title', 'Cấu hình gửi')
@section('noidung')
<div class="content-wrapper">
  <div class="content">

    @if(count($errors)>0)
    <div class="alert alert-warning">
      @foreach($errors->all() as $err)
      {{ $err }}<br>
      @endforeach
    </div>
    @endif

    {{-- /* =============== > GỬI ĐƠN HÀNG CHO DỊCH VỤ VẬN CHUYỂN < =============== */ --}}
    <form action="/api/cauhinh" method="post">
      {{csrf_field()}}
      <section class="panel panel-primary">
        <header class="ck_top panel-heading">
          Cấu hình thông tin người gửi
          <span class="pull-right ck_icon glyphicon glyphicon-chevron-right"></span>
        </header>
        <div class="ck_content panel-body">
          <div style="border-bottom: 1px solid #fff; margin: 3px"></div>
          <div class="input-group">
            <span class="input-group-btn">
              <button style="width:149px" class="btn btn-primary" type="button">Token (GHTK)</button>
            </span>
            <input value="{{$cauhinh->token}}" name="token" class="form-control" type="text" placeholder="Nhập token (Giao hàng tiết kiệm)">
          </div>
          <div style="border-bottom: 1px solid #fff; margin: 3px"></div>
          <div class="input-group">
            <span class="input-group-btn">
              <button style="width:149px" class="btn btn-primary" type="button">Người gửi</button>
            </span>
            <input value="{{$cauhinh->pick_name}}" name="pick_name" class="form-control" type="text" placeholder="Nhập tên người liên hệ lấy hàng hóa">
          </div>

          <div style="border-bottom: 1px solid #fff; margin: 3px"></div>
          <div class="input-group">
            <span class="input-group-btn">
              <button style="width:149px" class="btn btn-primary" type="button">Điện thoại (nơi gửi)</button>
            </span>
            <input value="{{$cauhinh->pick_tel}}" name="pick_tel" class="form-control" type="text" placeholder="Nhập số điện thoại liên hệ nơi lấy hàng hóa">
          </div>
          <div style="border-bottom: 1px solid #fff; margin: 3px"></div>
          <div class="input-group">
            <span class="input-group-btn">
              <button style="width:149px" class="btn btn-primary" type="button">Địa chỉ ngắn gọn</button>
            </span>
            <input value="{{$cauhinh->pick_address}}" name="pick_address" class="form-control" type="text" placeholder="Nhập Địa chỉ ngắn gọn để lấy nhận hàng hóa">
          </div>
          <div style="border-bottom: 1px solid #fff; margin: 3px"></div>
          <div class="input-group">
            <span class="input-group-btn">
              <button style="width:149px" class="btn btn-primary" type="button">Tỉnh/TP (gửi)</button>
            </span>
            <input id="pick_province2" value="{{$cauhinh->pick_province}}" name="pick_province" class="form-control" type="text" placeholder="Nhập (tỉnh/thành phố) gửi hàng">
          </div>
          <div style="border-bottom: 1px solid #fff; margin: 3px"></div>
          <div class="input-group">
            <span class="input-group-btn">
              <button style="width:149px" class="btn btn-primary" type="button">Quận/Huyện (gửi)</button>
            </span>
            <input id="pick_district2" value="{{$cauhinh->pick_district}}" name="pick_district" class="form-control" type="text" placeholder="Nhập (quận/huyện) gửi hàng">
          </div>
          <div style="border-bottom: 1px solid #fff; margin: 3px"></div>
          <center>
            <button class="btn btn-primary" type="submit">Lưu</button>
          </center>
        </div>
      </section>
    </form>
    {{-- /* =============== > / GỬI ĐƠN HÀNG CHO DỊCH VỤ VẬN CHUYỂN < =============== */ --}}
  </div>

</div>

<script
src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>

<script type="text/javascript">
  $(function () {
    $('.alert').delay(3000).slideUp();
  });
</script>
@endsection