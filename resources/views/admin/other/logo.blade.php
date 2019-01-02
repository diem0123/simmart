@extends('masteradmin')
@section('title', 'Logo & phí ship')
@section('noidung')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Quản lý Logo & phí ship
    </h1>
  </section>
  <section class="content" style="padding-top: 5px;">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-body" style="padding-left: 30px;padding-right: 30px;">
            <div class="row">
              <div class="data">
                
                  <div class="row">
                    <form action="{{url('admin/postlogo')}}" id="registrationForm" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Ảnh Logo (*khuyến khích file .png)</label>
                        <div id="image-preview" style="background-image: url({{asset('images/'.$row->logo)}});background-size: 240px 153px;background-repeat: no-repeat;width: 240px;height: 153px;">

                          <label style="font-size: 1em;"id="image-label">Giữ ảnh cũ hoặc đổi</label>
                          <input type="file" name="photo" id="image-upload" />
                        </div>
                        <p><strong>Kích thước tỉ lệ 140x53(px)</strong></p>                 
                      </div>
                      <div class="form-group">
                        <label>Trạng thái</label>
                        <select name="stateid" class="form-control">
                          @foreach($state as $stt)
                          @if($row->stateid == $stt->id)
                          <option value="{{$stt->id}}" selected>{!!$stt->name!!}</option>
                          @else
                          <option value="{{$stt->id}}">{!!$stt->name!!}</option>
                          @endif
                          @endforeach
                        </select>
                      </div>
                      <button style="margin-top: 5px;" class="btn btn-warning" type="submit"><i class="fa fa-wrench" ></i>&nbsp; Cập nhật</button>
                    </div>
                    </form>
                    <div class="col-md-2 text-center">
                      
                    </div>
                    <form action="{{url('admin/postpriceship')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Phí chuyển hàng</label>
                        <input type="text" name="ship" class="form-control" value="{{$ship->ship}}">
                      </div>
                      <button style="margin-top: 5px;" class="btn btn-warning" type="submit"><i class="fa fa-wrench" ></i>&nbsp; Cập nhật</button>
                      
                    </div>

                  </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection