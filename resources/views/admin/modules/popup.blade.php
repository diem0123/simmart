@if(session('message'))
<div id="myModall" class="modal fade" role="dialog" style="margin-top: 50px;">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content"  style="width: 60%;margin-left: 130px;border-radius: 5px;">
			<div class="modal-header" style="background: #4157ff;color:white;padding: 0px;">
				<button type="button" class="close" data-dismiss="modal" style="margin-top: 5px;margin-right: 5px;">&times;</button>
				<h4 class="modal-category text-center">Thông báo</h4>
			</div>
			<div class="modal-body text-center">
				<p>{{session('message')}}</p>
			</div>
			<div class="modal-footer" style="padding-top: 10px;padding-bottom: 10px;">
				<button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
			</div>
		</div>

	</div>
</div>

@endif

<script>

	$(document).ready(function() {
		$("#myModall").modal("show")
	})
</script>