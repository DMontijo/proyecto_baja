<div class="modal fade shadow" id="llamadaModal" tabindex="-1" role="dialog" aria-labelledby="llamadaModalLabel" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-dialog-centered mw-100 w-50">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-primary justify-content-center">
			<h5 class="modal-title font-weight-bold text-white">LLAMADA ENTRANTE</h5>

			</div>

			<div class="modal-body text-center" id="">
			<div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
					<label for="folio_llamada" class="form-label font-weight-bold">Folio:</label>
					<input type="text" class="form-control" id="folio_llamada" name="folio_llamada" disabled>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
					<label for="nombre_denunciante" class="form-label font-weight-bold">Nombre del denunciante:</label>
					<input type="text" class="form-control" id="nombre_denunciante" name="nombre_denunciante" disabled>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
					<label for="genero_denunciante" class="form-label font-weight-bold">Sexo del denunciante:</label>
					<input type="text" class="form-control" id="genero_denunciante" name="genero_denunciante" disabled>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
					<label for="correo_deunciante" class="form-label font-weight-bold">Correo del denunciante:</label>
					<input type="text" class="form-control" id="correo_deunciante" name="correo_deunciante" disabled>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
					<label for="idioma_denunciante" class="form-label font-weight-bold">Idioma del denunciante:</label>
					<input type="text" class="form-control" id="idioma_denunciante" name="idioma_denunciante" disabled>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
					<label for="delito_denunciante_llamada" class="form-label font-weight-bold">Delito:</label>
					<input type="text" class="form-control" id="delito_denunciante_llamada" name="delito_denunciante_llamada" disabled>
				</div>

				
				<button class="btn btn-success" id="aceptar"> Aceptar</button>

				<button class="btn btn-danger" id="rechazar"> Rechazar</button>

			</div>
			<div id="loading_sub_doc" class="modal-body text-center d-none" style="min-height:170px;">
				<div class="d-flex justify-content-center">
					<div class="spinner-border text-primary" role="status">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>