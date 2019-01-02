<script>
  $(document).ready(function() {
    $("#shoz").modal("show")
  })
</script>
@if(session('message'))
<div class="container">
  <div class="modal fade" id="shoz" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background: #5bc0de;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center" style="color:white;">Thông báo</h4>
        </div>
        <div class="modal-body">
          <p>{{session('message')}}.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">OK </button>
        </div>
      </div>
    </div>
  </div>
</div>
 @endif