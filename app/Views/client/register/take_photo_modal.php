<div class="modal fade" id="take_photo_modal" tabindex="-1" aria-labelledby="take_photo_modal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h5 class="modal-title">Tomar foto</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body text-center">
				<div class="row">
					<div class="col-12">
						<p class="fw-bolder">Selecciona el dispositivo</p>
					</div>
					<div class="col-6 offset-3 mb-3">
						<select class="form-select" name="listaDeDispositivos" id="listaDeDispositivos"></select>
					</div>
					<div class="col-12 mb-3">
						<button class="btn btn-primary" id="btn-photo"><i class="bi bi-camera"></i> Tomar foto</button>
						<div id="estado" class="alert alert-warning d-none mt-3">
							No se puede acceder a la cámara, o no diste permiso.
						</div>
					</div>
					<div class="col-12">
						<div class="ratio ratio-16x9">
							<video class="rounded" muted="muted" id="video"></video>
							<canvas id="canvas" name="canvas" class="d-none"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
