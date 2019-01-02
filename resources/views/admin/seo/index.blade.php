@extends('masteradmin')
@section('title', 'SEO Trang chủ')
@section('noidung')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      SEO Trang chủ
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
                  <form action="{{url('admin/seo/updateseo')}}" id="registrationForm" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Tiêu đề trang</label>
                        <input name="title" type="text" class="form-control" value="{{$row->title}}">
                      </div>
                      <div class="form-group">
                        <label>Meta Desc</label>
                        <input name="metadesc" type="text" class="form-control" value="{{$row->metadesc}}">
                      </div>
                      <div class="form-group">
                        <label>Meta Keywords</label>
                        <input name="metakey" type="text" class="form-control" value="{{$row->metakey}}">
                      </div>

                      <div class="form-group">
                        <label>Tọa độ</label>
                        <input name="toado" type="text" class="form-control" value="{{$row->toado}}">
                      </div>
                      <div class="form-group">
                        <label>Tên giám đốc</label>
                        <input name="author" type="text" class="form-control" value="{{$row->author}}">
                      </div>
                    </div>

                    
                    <div class="col-md-4">
                      
                      <div class="form-group">
                        <label>Địa chỉ</label>
                        <input name="address" type="text" class="form-control" value="{{$row->address}}">
                      </div>

                      <div class="form-group">
                        <label>Mã vùng</label>
                        <input name="code" type="text" class="form-control" value="{{$row->code}}">
                      </div>

                      <div class="form-group">
                        <label>Đường dẫn trang chủ</label>
                        <input name="url" type="text" class="form-control" value="{{$row->url}}">
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