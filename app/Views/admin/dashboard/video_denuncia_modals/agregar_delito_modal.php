<div class="modal fade shadow" id="delito_modal" tabindex="-1" role="dialog" aria-labelledby="DelitoModal" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-dialog-centered mw-100 w-50">
		<div class="modal-content">
			<div class="modal-header bg-secondary text-primary">
				<h5 class="modal-title font-weight-bold">DELITO</h5>
				<button type="button" class="close text-primary" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body">
				<form id="form_agregar_delito">
					<?= view('admin/dashboard/video_denuncia_forms/form_delito') ?>
					<div class="row mt-4">
						<div class="col-12">
							<button type="submit" class="btn btn-primary">AGREGAR DELITO</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
