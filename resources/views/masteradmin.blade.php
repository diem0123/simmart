<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="{{asset('images/login.png')}}">
  <link rel="stylesheet" href="{{asset('css/bootstrap.minn.css')}}">
  <link rel="stylesheet" href="{{asset('css/styleadmin.css')}}">
  <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
  <link rel="stylesheet" href="{{asset('js/fontawesome-all.js')}}">
  <link rel="stylesheet" href="{{asset('font-awesome-4.7.0/css/font-awesome.css')}}">
  <link rel="stylesheet" href="{{asset('css/tb.css')}}">
  <script src="{{asset('js/jquery.minn.js')}}"></script>
  <script src="{{asset('js/bootstrap.minn.js')}}"></script>
  <script src="{{asset('js/adminlte.minn.js')}}"></script>
  <script src="{{asset('js/tb.js')}}"></script>
  <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
  <script src="{{asset('js/search.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/bootstrapvalidator.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/jquery.validate.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/jquery.validation.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/uploadreview.js')}}"></script>

  
</head>
<style>
#load{
  width:100%;
  height:100%;
  position:fixed;
  z-index:9999;
  background:url("https://www.creditmutuel.fr/cmne/fr/banques/webservices/nswr/images/loading.gif") no-repeat center center rgba(0,0,0,0.5)
}
.nav-link:hover{
  color:blue; 
}
#image-preview {
  width: 100%;
  height: 300px;
  position: relative;
  overflow: hidden;
  background-color: #ffffff;
  color: #ecf0f1;
}
#image-preview input {
  line-height: 200px;
  font-size: 200px;
  position: absolute;
  opacity: 0;
  z-index: 10;
}
#image-preview label {
  position: absolute;
  z-index: 5;
  opacity: 0.8;
  cursor: pointer;
  background-color: #bdc3c7;
  width: 200px;
  height: 50px;
  font-size: 20px;
  line-height: 50px;
  text-transform: uppercase;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  margin: auto;
  text-align: center;
}
#image-preview_res {
  width: 100%;
  height: 300px;
  position: relative;
  overflow: hidden;
  background-color: #ffffff;
  color: #ecf0f1;
}
#image-preview_res input {
  line-height: 200px;
  font-size: 200px;
  position: absolute;
  opacity: 0;
  z-index: 10;
}
#image-preview_res label {
  position: absolute;
  z-index: 5;
  opacity: 0.8;
  cursor: pointer;
  background-color: #bdc3c7;
  width: 200px;
  height: 50px;
  font-size: 20px;
  line-height: 50px;
  text-transform: uppercase;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  margin: auto;
  text-align: center;
}
</style>
<div id="load">

</div>


<script>
  document.onreadystatechange = function () {
    var state = document.readyState
    if (state == 'interactive') {
     document.getElementById('contents').style.visibility="hidden";
   } else if (state == 'complete') {
    setTimeout(function(){
     document.getElementById('interactive');
     document.getElementById('load').style.visibility="hidden";
     document.getElementById('contents').style.visibility="visible";
   },0);
  }
}
</script>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <script>
      $(document).ready(function(){
        $('#myTable').DataTable();
      });
    </script>
    @include('admin.modules.header')
    @include('admin.modules.listmenu')
    @yield('noidung')
    @include('admin.modules.popup')
    @include('admin.modules.footer')
    <script type="text/javascript">
      $(document).ready(function() {
        $.uploadPreview({
          input_field: "#image-upload",
          preview_box: "#image-preview",
          label_field: "#image-label"
        });
      });
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
        $.uploadPreview({
          input_field: "#image-upload_res",
          preview_box: "#image-preview_res",
          label_field: "#image-label_res"
        });
      });
    </script>
    <script language="Javascript">
      $(function () {
        $("#browse").change(function () {
          if (typeof (FileReader) != "undefined") {
            var dvPreview = $("#preview");
            dvPreview.html("");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            $($(this)[0].files).each(function () {
              var file = $(this);
              if (regex.test(file[0].name.toLowerCase())) {
                var reader = new FileReader();
                reader.onload = function (e) {
                  var img = $("<img />");
                  img.attr("style", "height:100px;width: 100px;margin-right:8px;margin-top:5px;");
                  img.attr("class", "thumnail");
                  img.attr("src", e.target.result);
                  dvPreview.append(img);
                }
                reader.readAsDataURL(file[0]);
              } else {
                alert(file[0].name + " is not a valid image file.");
                dvPreview.html("");
                return false;
              }
            });
          } else {
            alert("This browser does not support HTML5 FileReader.");
          }
        });
      });
    </script>
  </body>
  </html>