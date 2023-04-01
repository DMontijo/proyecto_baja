<?= $this->extend('client/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php include 'geolocalizacion_modal.php' ?>

<?php $session = session(); ?>
<style>
	#video_container {
		width: 100%;
		min-height: 70vh;
	}

	#secondary_videos_container {
		max-width: 200px;
		min-width: 150px;
		padding: 10px;
		background-color: transparent;
		height: calc(70vh - 70px);
		margin-top: -70vh;
		margin-left: auto;
		overflow-y: auto;
		transition: 0.5s;
	}

	@media only screen and (max-width: 600px) {
		#secondary_videos_container {
			max-width: 150px;
			min-width: 150px;
		}
	}

	#secondary_videos_container:hover {
		background-color: rgba(0, 0, 0, .3);
	}

	.secondary_video {
		width: 100%;
		height: 100px;
		z-index: 2 !important;
		margin-bottom: 10px;
		background-color: aquamarine;
		box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 0.3);
		-webkit-box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 0.3);
		-moz-box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 0.3);
	}

	#secondary_video_details {
		background-color: transparent;
		width: 100%;
		height: 100px;
		display: flex;
		flex-direction: column;
		justify-content: space-between;
	}

	#secondary_video_details_name {
		white-space: nowrap;
		text-overflow: ellipsis;
		overflow: hidden;
		/* max-width: 300px; */
		font-weight: bold;
		font-size: 8px;
		padding: 3px;
		text-align: center;
		background-color: rgba(255, 255, 255, .5);
	}

	#secondary_video_details_devices {
		display: inline-block;
		background-color: rgba(255, 255, 255, .5);
		padding: 3px;
		margin-left: auto;
	}

	#main_video {
		width: 100% !important;
		min-height: 70vh;
		background-color: aqua;
	}

	#main_video_details {
		display: flex;
		align-items: center;
		justify-content: center;
		opacity: .3;
		transition: 0.5s;
	}

	#main_video_details:hover {
		opacity: 1;
	}

	#main_video_details_name {
		display: inline-block;
		white-space: nowrap;
		text-overflow: ellipsis;
		overflow: hidden;
		max-width: 300px;
		font-weight: bold;
	}

	#tools-group {
		padding: 10px;
		background-color: rgba(0, 0, 0, 0);
		height: 70px;
		display: flex;
		justify-content: center;
		align-items: center;
		margin-top: -70px;
		z-index: 1;
		transition: 0.5s;
	}

	#tools-group:hover {
		background-color: rgba(0, 0, 0, .3);
	}

	video {
		width: 100% !important;
		height: 100% !important;
	}
</style>
<div class="container-fluid mb-5">
	<div class="input-group mb-1">
		<input type="text" class="form-control d-none" id="input_uuid" value="<?= $body_data->UUID ?>">
		<input type="text" class="form-control d-none" id="input_folio" value="<?php echo $_GET['folio'] ?>">
		<input type="text" class="form-control d-none" id="input_priority" value="<?php echo $_GET['prioridad'] ?>">
		<input type="text" class="form-control d-none" id="input_delito" value="<?php echo $_GET['delito'] ?>">

	</div>
	<div class="row d-block">
		<div class="col-12 p-0 m-0 mb-3">
			<div class="card">
				<div class="card-body">
					<form id="form_archivos_externos" method="post" enctype="multipart/form-data">
						<input type="text" class="form-control" id="folio" name="folio" hidden>
						<input type="text" class="form-control" id="year" name="year" hidden>
						<input type="text" class="form-control" id="autor" name="autor" hidden>

						<div class="row" style="font-size:10px;">
							<div class="col-12 col-sm-6 offset-sm-3">
								<p class="p-0 m-0"><strong>Documentos a anexar</strong></p>
								<small>En caso de requerir subir un documento durante la entrevista favor de subirlo en esta sección</small>
								<input type="file" class="form-control" id="documentoArchivo" name="documentoArchivo" accept="image/jpeg, image/jpg, image/png, .doc, .pdf">
								<img id="viewDocumentoArchivo" class="img-fluid" src="" style="max-width:100px;">
								<button type="submit" class="btn-sm btn-primary" style="width: 100%;">Subir documentos</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-12 p-0 m-0" id="pantalla_inicial">
			<div class="card text-center">
				<div class="card-body p-0 m-0 p-5 d-flex justify-content-center align-items-center">
					<div class="text-center" style="max-width:500px;">
						<img src="<?= base_url() ?>/assets/img/loader.gif" alt="Loader FGEBC" class="mb-3">
						<p class="fw-bold">
							¡Tu solicitud se ha registrado con éxito!
						</p>
						<p>En unos minutos serás atendido por personal del Centro de Denuncia Tecnológica,
							<strong>permanece en línea.</strong>
						</p>
						<p>
							De presentarse fallas de conexión recarga la página web o ingresa nuevamente con tu usuario
							de lo contrario nos pondremos en contacto contigo.
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 p-0 m-0" id="pantalla_final" style=" display:none;">
			<div class="card text-center">
				<div class="card-body p-0 m-0 p-5 d-flex justify-content-center align-items-center">
					<div class="text-center" style="max-width:500px;">
						<img src="<?= base_url() ?>/assets/img/FGEBC.png" alt="Loader FGEBC" class="mb-3" style="width:250px;">
						<p class="fw-bold">ESTIMADO (A) USUARIO (A),<br>¡GRACIAS POR SELECCIONAR EL SERVICIO DE VIDEO DENUNCIA!</p>
						<p>En la Fiscalía General del Estado de Baja California día a día trabajamos para garantizarte un fácil acceso a la justicia desde cualquier lugar del mundo.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 p-0 m-0" >
			<div class="card text-center">
				<div class="card-body p-0 m-0">
					<div class="row">
						<div class="col-12">
							<div id="video_container" style=" display:none;">
								<div id="main_video">
									<div id="main_video_details">
										<div class="btn-group btn-group-toggle mt-3">
											<button class="btn btn-sm btn-light" id="main_video_details_name" name="main_video_details_name">
												LIC. ALFREDO JIMENEZ PEREZ
											</button>
											<button class="btn btn-sm btn-danger" id="recording" name="recording" style="display: none;">
												<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
													<circle cx="8" cy="8" r="8" />
												</svg>
												REC
											</button>
											<button class="btn btn-sm btn-success" id="recording_stop" name="recording_stop"  style="display: none;">
												GRABACIÓN FINALIZADA
											</button>
											<button class="btn btn-sm btn-secondary" id="audio_denunciante_prendido" name="audio_denunciante_prendido" title="Tu audio esta prendido" style="display: none;">
												<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-mic-fill" viewBox="0 0 16 16">
													<path d="M5 3a3 3 0 0 1 6 0v5a3 3 0 0 1-6 0V3z" />
													<path d="M3.5 6.5A.5.5 0 0 1 4 7v1a4 4 0 0 0 8 0V7a.5.5 0 0 1 1 0v1a5 5 0 0 1-4.5 4.975V15h3a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1h3v-2.025A5 5 0 0 1 3 8V7a.5.5 0 0 1 .5-.5z" />
												</svg>
											</button>

											<button class="btn btn-sm btn-secondary" id="audio_denunciante_apagado"  name="audio_denunciante_apagado"  title="Tu audio esta apagado" style="display: none;">

											<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-mic-mute-fill" viewBox="0 0 16 16">
													<path d="M13 8c0 .564-.094 1.107-.266 1.613l-.814-.814A4.02 4.02 0 0 0 12 8V7a.5.5 0 0 1 1 0v1zm-5 4c.818 0 1.578-.245 2.212-.667l.718.719a4.973 4.973 0 0 1-2.43.923V15h3a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1h3v-2.025A5 5 0 0 1 3 8V7a.5.5 0 0 1 1 0v1a4 4 0 0 0 4 4zm3-9v4.879L5.158 2.037A3.001 3.001 0 0 1 11 3z" />
													<path d="M9.486 10.607 5 6.12V8a3 3 0 0 0 4.486 2.607zm-7.84-9.253 12 12 .708-.708-12-12-.708.708z" />
												</svg>
											</button>

											<button class="btn btn-sm btn-secondary" id="camara_prendida_denunciante" name="camara_prendida_denunciante" title="Tu camara esta prendida" style="display: none;">
												<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-camera-video-fill" viewBox="0 0 16 16">
													<path fill-rule="evenodd" d="M0 5a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 4.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 13H2a2 2 0 0 1-2-2V5z" />
												</svg>
												
											</button>

											<button class="btn btn-sm btn-secondary" id="camara_apagada_denunciante"  name="camara_apagada_denunciante" title="Tu camara esta apagada" style="display: none;">
											<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-camera-video-off-fill" viewBox="0 0 16 16">
													<path fill-rule="evenodd" d="M10.961 12.365a1.99 1.99 0 0 0 .522-1.103l3.11 1.382A1 1 0 0 0 16 11.731V4.269a1 1 0 0 0-1.406-.913l-3.111 1.382A2 2 0 0 0 9.5 3H4.272l6.69 9.365zm-10.114-9A2.001 2.001 0 0 0 0 5v6a2 2 0 0 0 2 2h5.728L.847 3.366zm9.746 11.925-10-14 .814-.58 10 14-.814.58z" />
												</svg>
											</button>
										</div>
									</div>
								</div>
								<div id="tools" class="row">
									<div class="col-12">
										<div id="tools-group">
											<div class="btn-group shadow" role="group">
												<button class="btn btn-lg btn-secondary" id="toogle-video" name="toogle-video">
												<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-camera-video-fill" viewBox="0 0 16 16"  id="camara_prendida_denunciante_b" name="camara_prendida_denunciante_b" style="display: block;">
													<path fill-rule="evenodd" d="M0 5a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 4.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 13H2a2 2 0 0 1-2-2V5z" />
												</svg>
												<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-camera-video-off-fill" viewBox="0 0 16 16"id="camara_apagada_denunciante_b"  name="camara_apagada_denunciante_b"style="display: none;" >
													<path fill-rule="evenodd" d="M10.961 12.365a1.99 1.99 0 0 0 .522-1.103l3.11 1.382A1 1 0 0 0 16 11.731V4.269a1 1 0 0 0-1.406-.913l-3.111 1.382A2 2 0 0 0 9.5 3H4.272l6.69 9.365zm-10.114-9A2.001 2.001 0 0 0 0 5v6a2 2 0 0 0 2 2h5.728L.847 3.366zm9.746 11.925-10-14 .814-.58 10 14-.814.58z" />
												</svg>
												</button>
												<button class="btn btn-lg btn-secondary" id="toogle-audio" name="toogle-audio">
													<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-mic-fill" viewBox="0 0 16 16"  id="audio_denunciante_prendido_b" name="audio_denunciante_prendido_b" title="Tu audio esta prendido" style="display: block;">
													<path d="M5 3a3 3 0 0 1 6 0v5a3 3 0 0 1-6 0V3z" />
													<path d="M3.5 6.5A.5.5 0 0 1 4 7v1a4 4 0 0 0 8 0V7a.5.5 0 0 1 1 0v1a5 5 0 0 1-4.5 4.975V15h3a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1h3v-2.025A5 5 0 0 1 3 8V7a.5.5 0 0 1 .5-.5z" />

													</svg>

													<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-mic-mute-fill" viewBox="0 0 16 16"  id="audio_denunciante_apagado_b"  name="audio_denunciante_apagado_b"  title="Tu audio esta apagado" style="display: none;">
													<path d="M13 8c0 .564-.094 1.107-.266 1.613l-.814-.814A4.02 4.02 0 0 0 12 8V7a.5.5 0 0 1 1 0v1zm-5 4c.818 0 1.578-.245 2.212-.667l.718.719a4.973 4.973 0 0 1-2.43.923V15h3a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1h3v-2.025A5 5 0 0 1 3 8V7a.5.5 0 0 1 1 0v1a4 4 0 0 0 4 4zm3-9v4.879L5.158 2.037A3.001 3.001 0 0 1 11 3z" />
													<path d="M9.486 10.607 5 6.12V8a3 3 0 0 0 4.486 2.607zm-7.84-9.253 12 12 .708-.708-12-12-.708.708z" />
												</svg>
												</button>
											</div>
										</div>
									</div>
								</div>
								<div id="secondary_videos_container">
									<div class="secondary_video" id="secondary_video">
										<div id="secondary_video_details">
											<div class="font-weigth-bold" id="secondary_video_details_name">ABDIEL OTONIEL FLORES GONZÁLEZ</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>

		<br>

	</div>
</div>
</div>
<script type="text/javascript" src="<?= base_url() ?>/assets/agent/assets/openvidu-browser-2.25.0.min.js"></script>
<script src="https://cdn.socket.io/4.6.0/socket.io.min.js" integrity="sha384-c79GN5VsunZvi+Q/WObgk2in0CbZsHnjEqvFxC5DxHn9lTfNce2WW6h2pH6u/kF+" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>/assets/js/video_denuncia_client.js" type="module"></script>
<script>
	const folio_get = `<?php echo $_GET['folio'] ?>`;

	let arr = folio_get.split('-')
	const year = arr[0];
	const folio = arr[1];

	document.getElementById('folio').value = folio;
	document.getElementById('year').value = year;

	document.querySelector('#documentoArchivo').addEventListener('change', (e) => {
		let preview = document.querySelector('#viewDocumentoArchivo');
		if (e.target.files && e.target.files[0]) {
			let reader = new FileReader();
			reader.onload = function(e) {
				preview.setAttribute('src', e.target.result);
			}
			reader.readAsDataURL(e.target.files[0]);
		}
	});

	document.getElementById('form_archivos_externos').addEventListener('submit', function(evt) {
		evt.preventDefault();
		crearArchivos();
	})

	function crearArchivos() {
		var packetData = new FormData();
		packetData.append("documentoArchivo", $("#documentoArchivo")[0].files[0]);
		packetData.append("folio", document.getElementById('folio').value);
		packetData.append("year", document.getElementById('year').value);
		$.ajax({
			url: "<?= base_url('/data/create_archivos') ?>",
			method: "POST",
			dataType: 'json',
			contentType: false,
			data: packetData,
			processData: false,
			cache: false,
			success: function(response) {
				const archivos = response.archivos;
				if (response.status == 1) {
					console.log(document.querySelectorAll('#table-archivos'));
					Swal.fire({
						icon: 'success',
						text: 'Archivo agregado correctamente',
						confirmButtonColor: '#bf9b55',
					});
					let preview = document.querySelector('#viewDocumentoArchivo');

					document.getElementById('documentoArchivo').value = '';
					preview.setAttribute('src', '');

				} else if (response.status == 0) {
					Swal.fire({
						icon: 'error',
						text: 'Los archivos no se pudieron subir',
						confirmButtonColor: '#bf9b55',
					});
				} else if (response.status == 2) {
					Swal.fire({
						icon: 'error',
						text: 'Debes subir un documento',
						confirmButtonColor: '#bf9b55',
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus);
			}
		});

	}
</script>

<?= $this->endSection() ?>
