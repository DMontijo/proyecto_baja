<div class="modal fade" id="information_denunciaT_validation" tabindex="-1" aria-labelledby="information_validation" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered  modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h5 class="modal-title" id="bs">Validación de informacion</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12">
						<div class="card shadow bg-blue mb-3">
							<div class="card-body text-white text-center">
								Verifica que todos tus datos esten correctos. De no estar correctos cierra este mensaje y editalos.
							</div>
						</div>
					</div>
					<div class="col-12">
					<label for="denuncia_modal" class="form-label fw-bold">Datos de la Denuncia.</label>
					</div>
					<div class="col-12 col-sm-6 mb-3">
						<label for="delito_modalT" class="form-label fw-bold">Delito: </label>
						<input type="text" class="form-control" id="delito_modalT" name="delito_modalT" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="municipio_modalT" class="form-label fw-bold">Municipio del delito: </label>
						<input type="text" class="form-control" id="municipio_modalT" name="municipio_modalT" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="calle_modalT" class="form-label fw-bold">Calle del delito: </label>
						<input type="text" class="form-control" id="calle_modalT" name="calle_modalT" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="exterior_modalT" class="form-label fw-bold">Número exterior: </label>
						<input type="text" class="form-control" id="exterior_modalT" name="exterior_modalT" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="interior_modalT" class="form-label fw-bold">Número interior: </label>
						<input type="text" class="form-control" id="interior_modalT" name="interior_modalT" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="colonia_modalT" class="form-label fw-bold">Colonia del delito: </label>
						<input type="text" class="form-control" id="colonia_modalT" name="colonia_modalT" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="lugar_modalT" class="form-label fw-bold">Lugar del delito</label>
						<input class="form-control" id="lugar_modalT" name="lugar_modalT" type="text" disabled>
					</div>
					
					<div class="col-12 col-sm-6 mb-3">
						<label for="clasificacion_modalT" class="form-label fw-bold">Clasificación del delito</label>
						<input class="form-control" id="clasificacion_modalT" name="clasificacion_modalT" type="text" disabled>
					</div>
					<div class="col-12 col-sm-6 mb-3">
						<label for="fechadel_modalT" class="form-label fw-bold">Fecha del delito</label>
						<input class="form-control" id="fechadel_modalT" name="fechadel_modalT" type="text" disabled>
					</div>
					<div class="col-12">
						<hr>
					</div>
					
					<div class="col-12 text-center">
						<button type="button" id="submit" onclick="window.location.href='<?= base_url() ?>/denuncia/dashboard/video-denuncia'"class="btn btn-primary mt-4">Mi información esta correcta</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
