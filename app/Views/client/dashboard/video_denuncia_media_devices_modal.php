<div class="modal fade" id="media_devices_modal" tabindex="-1" aria-labelledby="media_devices_modal" aria-hidden="true"  data-bs-backdrop="static">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">

			<div id="media-devices-alert">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">Concede permisos al navegador para audio y video</h5>
				</div>
				<div class="modal-body text-center">
					<div class="row">
						<div class="col-12">
							<p class="fw-bolder">Acepta los permisos de audio y video</p>
						</div>
					</div>
				</div>
			</div>


			<div hidden id="media-devices-selectors">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">Selecciona dispositivos</h5>
				</div>
				<div class="modal-body text-center">

					
					<div class="row">
						<div class="col-12">
							<p class="fw-bolder">Seleccione entrada de audio</p>
						</div>
						<div class="col-12" id="listDevicesAudio">
							<select style="max-width: 100%;" class="select-audio form-control" name="listaDeDispositivosAudio" id="listaDeDispositivosAudio"></select>
						</div>
						<div class="col-12">
                            <audio id="audio"></audio>
						</div>
					</div>

					<div class="row">
						<div class="col-12">
							<p class="fw-bolder">Seleccione entrada de video</p>
						</div>
						<div class="col-12" id="listDevicesVideo">
							<select class="form-control" name="listaDeDispositivosVideo" id="listaDeDispositivosVideo"></select>
						</div>
						<div class="col-12">
							<div class="ratio ratio-16x9" id="videoDiv">
								<video class="rounded" id="video" muted autoplay playsinline></video>
								<canvas id="canvas" name="canvas"class="d-none"></canvas>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12">
							<button disabled type="button" class="btn btn-primary" id="acceptConfiguration">Aceptar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
