<div class="modal fade shadow" id="contrasena_modal_firma_doc" tabindex="-1" role="dialog" aria-labelledby="passworddoc_modalLabel" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-dialog-centered mw-100 w-50">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-primary justify-content-center">
				<h5 class="modal-title text-white font-weight-bold" id="password_modalLabel">Contraseña de FIEL</h5>
				<h5 class="modal-title text-white font-weight-bold d-none" id="password_verifying">Firmando documento</h5>
			</div>

			<div class="modal-body text-center" id="load">
				
			<form method="POST" action="<?php echo base_url('admin/dashboard/firmar_documentos') ?>" class="needs-validation row" novalidate>
					<div class="col-12 mb-3">
						<input type="text" class="form-control d-none" id="expediente_modal" name="expediente_modal" required>
						<input type="text" class="form-control d-none" id="year_modal" name="year_modal" required>
						<input type="password" class="form-control" id="constrasena_modal" name="constrasena_modal" autocomplete="off" required>
						<div class="invalid-feedback">
							La contraseña es obligatoria
						</div>
					</div>
					<div class="col-12">
						<button type="submit" class="btn btn-secondary font-weight-bold">FIRMAR DOCUMENTOS</button>
					</div>
				</form>
			</div>
			<div id="loading" class="modal-body text-center d-none" style="min-height:170px;">
				<div class="d-flex justify-content-center">
					<div class="spinner-border text-primary" role="status">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
