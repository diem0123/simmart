	<script>

		$(document).ready(function() {
			$("#myModall").modal("show")
		})
	</script>
	@if ($errors->any())
	<div class="modal fade" id="myModall" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><span class="text-danger">Warning</span></h4>
				</div>
				<div class="modal-body">
					<p>@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
	@endif