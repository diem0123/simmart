<?php 
use App\Models\Info;
use App\Models\Dichvu;
$data = Info::all();
$data2 = Dichvu::all();
?>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12">
                <h4 style="border-bottom: 1px solid white;padding-bottom: 7px;"><strong>Thông tin công ty</strong></h4>
                <div style="margin-top: 15px;"></div>
                @foreach($data as $row)
                <div class="row" style="padding-left: 15px;">
                    @if($row->icon!=null)
                    <img src="{{asset('images/'.$row->icon)}}" style="width: 20px;height: 20px;">&nbsp;&nbsp;
                    @endif
                    <a href="{{$row->slug}}"><span style="font-size: 0.8em;">{{$row->name}}</span></a>
                </div>
                @endforeach
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">

                <h4 style="border-bottom: 1px solid white;padding-bottom: 7px;"><strong>Dịch vụ</strong></h4>
                <div style="margin-top: 15px;"></div>
                @foreach($data2 as $row2)
                <div class="row" style="padding-left: 15px;">
                    @if($row2->icon!=null)
                    <img src="{{asset('images/'.$row2->icon)}}" style="width: 20px;height: 20px;">&nbsp;&nbsp;
                    @endif
                    <a href="{{$row2->slug}}"><span style="font-size: 0.8em;">{{$row2->name}}</span></a>
                </div>
                @endforeach
                
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
                <h4 style="border-bottom: 1px solid white;padding-bottom: 7px;"><strong>Đăng ký nhận thông tin</strong></h4>
                <div style="margin-top: 15px;"></div>
                <p style="font-size: 0.8em;">Đăng ký để nhận thông tin mới nhất từ chúng tôi</p>
                <form id="registrationForm" action="{{url('register_mail')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    
                    <input type="text" placeholder="Email của bạn" class="send" name="send">
                    
                    <div class="form-group">
                        <button class="btnsend" type="submit"><strong>Đăng ký</strong></button>
                    </div>
                </form>
            </div>
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
            send: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'Chưa nhập Email'
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
        </div>
    </div>
</footer>






































<a href="#" id="back-to-top" title="Back to top">&uarr;</a>
<script>
	if ($('#back-to-top').length) {
    var scrollTrigger = 100, // px
    backToTop = function () {
        var scrollTop = $(window).scrollTop();
        if (scrollTop > scrollTrigger) {
            $('#back-to-top').addClass('show');
        } else {
            $('#back-to-top').removeClass('show');
        }
    };
    backToTop();
    $(window).on('scroll', function () {
        backToTop();
    });
    $('#back-to-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
}
</script>