<?= $this->extend('client/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

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
		/* background-color: white; */
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

	.secondary_video {
		width: 100%;
		height: 100px;
		z-index: 1 !important;
		margin-bottom: 10px;
		background-color: black;
	}

	#secondary_video_details {
		/* background-color: transparent; */
		width: 100%;
	}

	#secondary_video video {
		box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 1);
		-webkit-box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 1);
		-moz-box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 1);
		width: 100% !important;
		height: 100% !important;
		border: white 2px solid;
	}

	#main_video {
		width: 100% !important;
		min-height: 70vh;
		max-height: 70vh;
		background-color: black;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	#main_video video {
		max-width: 100%;
		max-height: 70vh;
	}

	#main_video_details {
		display: flex;
		align-items: center;
		justify-content: center;
		transition: 0.5s;
		position: absolute;
		width: 100%;
		top: 0;
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
</style>
<div class="container-fluid mb-5">
	<div class="input-group mb-1">
		<input type="text" class="form-control d-none" id="input_uuid" value="<?= $body_data->UUID ?>">
		<input type="text" class="form-control d-none" id="input_folio" value="<?php echo $_GET['folio'] ?>">
		<input type="text" class="form-control d-none" id="input_priority" value="<?php echo $_GET['prioridad'] ?>">
		<input type="text" class="form-control d-none" id="input_delito" value="<?php echo $_GET['delito'] ?>">
		<input type="text" class="form-control d-none" id="input_descripcion" value="<?php echo $_GET['descripcion'] ?>">
		<input type="text" class="form-control d-none" id="input_base_url_endcall" value="<?= base_url('/denuncia/dashboard/end-videocall') ?>">
	</div>
	<div class="row d-block">
		<div class="col-12 p-0 m-0 mb-3" id="documentos_anexar_card" style="display:none;">
			<div class="card">
				<div class="card-body">

					<form id="form_archivos_externos" method="post" enctype="multipart/form-data">
						<input type="text" class="form-control" id="folio" name="folio" hidden>
						<input type="text" class="form-control" id="year" name="year" hidden>
						<input type="text" class="form-control" id="autor" name="autor" hidden>

						<div class="row" style="font-size:10px;">
							<div class="col-12 col-sm-6 offset-sm-3">
								<p class="p-0 m-0"><strong>Documentos a anexar</strong></p>
								<small>En caso de requerir subir un documento durante la entrevista favor de subirlo en esta sección.</small>
								<input type="file" class="form-control" id="documentoArchivo" name="documentoArchivo" accept="image/jpeg, image/jpg, image/png, .doc, .pdf">
								<img id="viewDocumentoArchivo" class="img-fluid" src="" style="max-width:100px;">
								<button type="submit" class="btn-sm btn-primary" style="width: 100%;">Subir documento</button>
							</div>
						</div>
					</form>

					<div id="documentos_anexar_spinner" class="row text-center d-none" style="font-size:10px;">
						<div class="col-12 col-sm-6 offset-sm-3">
							<div class="spinner-border text-primary" role="status">
								<span class="visually-hidden">Subiendo...</span>
							</div>
							<h5 class="text-center">Subiendo</h5>
						</div>
					</div>

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
						<div class="d-grid gap-2">
							<a href="<?= base_url('/denuncia/dashboard/denuncias') ?>" type="button" name="" id="" class="btn btn-primary">IR A MIS DENUNCIAS</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 p-0 m-0">
			<div class="card text-center">
				<div class="card-body p-0 m-0">
					<div class="row">
						<div class="col-12">
							<div id="video_container" style=" display:none;">
								<div id="main_video">
									<div id="main_video_details">
										<div class="btn-group btn-group-toggle mt-3 shadow">
											<button class="btn btn-sm btn-light" id="main_video_details_name" name="main_video_details_name"></button>
										</div>
									</div>
								</div>
								<div id="secondary_videos_container">
									<div class="secondary_video" id="secondary_video">
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

	async function crearArchivos() {
		document.getElementById('form_archivos_externos').classList.add('d-none');
		document.getElementById('documentos_anexar_spinner').classList.remove('d-none');
		let documento;
		if ($("#documentoArchivo")[0].files && $("#documentoArchivo")[0].files[0]) {
			if ($("#documentoArchivo")[0].files[0].type == "image/jpeg" || $("#documentoArchivo")[0].files[0].type == "image/png" || $("#documentoArchivo")[0].files[0].type == "image/jpg") {
				documento = await comprimirImagen($("#documentoArchivo")[0].files[0], 50);
			} else {
				documento = $("#documentoArchivo")[0].files[0];
			}
		} else {
			document.getElementById('form_archivos_externos').classList.remove('d-none');
			document.getElementById('documentos_anexar_spinner').classList.add('d-none');
			Swal.fire({
				icon: 'error',
				text: 'Debes seleccionar un documento.',
				showConfirmButton: false,
				timer: 1000
			});
			return
		}
		var packetData = new FormData();
		packetData.append("documentoArchivo", documento);
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
				document.getElementById('form_archivos_externos').classList.remove('d-none');
				document.getElementById('documentos_anexar_spinner').classList.add('d-none');
				if (response.status == 1) {
					console.log(document.querySelectorAll('#table-archivos'));
					Swal.fire({
						icon: 'success',
						text: 'Documento agregado correctamente.',
						showConfirmButton: false,
						timer: 1000
					});
					let preview = document.querySelector('#viewDocumentoArchivo');

					document.getElementById('documentoArchivo').value = '';
					preview.setAttribute('src', '');

				} else if (response.status == 0) {
					Swal.fire({
						icon: 'error',
						text: 'No se subio el documento.',
						showConfirmButton: false,
						timer: 1000
					});
				} else if (response.status == 2) {
					Swal.fire({
						icon: 'error',
						text: 'Debes seleccionar un documento.',
						showConfirmButton: false,
						timer: 1000
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus);
				document.getElementById('form_archivos_externos').classList.remove('d-none');
				document.getElementById('documentos_anexar_spinner').classList.add('d-none');
				Swal.fire({
					icon: 'error',
					text: 'No se subio el documento.',
					showConfirmButton: false,
					timer: 1000
				});
			}
		});

	}

	function comprimirImagen(imagenComoArchivo, porcentajeCalidad) {
		return new Promise((resolve, reject) => {
			const $canvas = document.createElement("canvas");
			const imagen = new Image();
			imagen.onload = () => {
				$canvas.width = imagen.width;
				$canvas.height = imagen.height;
				$canvas.getContext("2d").drawImage(imagen, 0, 0);
				$canvas.toBlob(
					(blob) => {
						if (blob === null) {
							return reject(blob);
						} else {
							resolve(blob);
						}
					},
					"image/jpeg", porcentajeCalidad / 100
				);
			};
			imagen.src = URL.createObjectURL(imagenComoArchivo);
		});
	};
</script>

<?= $this->endSection() ?>
