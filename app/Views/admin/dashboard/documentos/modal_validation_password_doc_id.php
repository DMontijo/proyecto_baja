<div class="modal fade" id="contrasena_modal_doc_id" tabindex="-1" aria-labelledby="passworddoc_modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content border-0">
			<div class="modal-header bg-primary justify-content-center">
				<h5 class="modal-title text-white font-weight-bold" id="password_modalLabel_doc_id">Contraseña de FIEL</h5>
				<h5 class="modal-title text-white font-weight-bold d-none" id="password_verifying_doc_id">Firmando documento...</h5>
			</div>
			<div class="modal-body text-center" id="load_doc">
				<div class="col-12 mb-3">
					<input type="text" class="form-control" id="folio_id" name="folio_id"hidden required>
					<input type="text" class="form-control" id="documento_id" name="documento_id"  hidden required>

					<input type="text" class="form-control" id="year_doc" name="year_doc" hidden required>
					<input type="password" class="form-control" id="contrasena_doc" name="contrasena_doc" type="text" autocomplete="off" required>
					<div class="invalid-feedback">
						La contraseña es obligatoria
					</div>
				</div>
				<div class="col-12">
					<button type="button" id="firmar_documento_modal_id" name="firmar_documento_modal" class="btn btn-secondary font-weight-bold">Firmar documento</button>
				</div>
			</div>
			<div id="loading_doc_id" class="modal-body text-center d-none" style="min-height:170px;">
				<div class="d-flex justify-content-center">
					<div class="spinner-border text-primary" role="status">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
