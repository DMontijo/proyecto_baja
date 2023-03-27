<?= $this->extend('client/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php include 'geolocalizacion_modal.php' ?>

<?php $session = session(); ?>
<style>
	.video_denunciante {
		width: 20%;
		height: 17%;
		position: relative;
		top: 0;
		left: 0;
		z-index: 1;
		margin: 1%;
		border-radius: 5%;
	}

	.video_usuario {
		width: 100%;
		height: 90%;
		position: relative;
	}

	video {
		width: 100%;
	}
</style>
<div class="container-fluid mb-5">
	<div class="input-group mb-1">
		<input type="text" class="form-control d-none" id="input_uuid" value="<?= $body_data->UUID ?>">
		<input type="text" class="form-control d-none" id="input_folio" value="<?php echo $_GET['folio'] ?>">
		<input type="text" class="form-control d-none" id="input_priority" value="<?php echo $_GET['prioridad'] ?>">
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
		<div class="col-12 p-0 m-0">
			<div class="card text-center">
				<div class="card-body p-0 m-0">
					<!-- <div class="ratio ratio-16x9 justify-content-center"> -->
					<!-- <iframe style="min-height:600px;" src="<?= 'https://videodenunciaserver1.fgebc.gob.mx/videollamada?folio=' . $body_data->folio . '&nombre=' . $session->NOMBRE . ' ' . $session->APELLIDO_PATERNO . ' ' . $session->APELLIDO_MATERNO . '&delito=' . $body_data->delito . '&descripcion=' . $body_data->descripcion . '&idioma=' . $body_data->idioma . '&edad=' . $body_data->edad . '&perfil=' . $body_data->perfil . '&sexo=' . $body_data->sexo . '&prioridad=' . $body_data->prioridad . '&sexo_denunciante=' . $body_data->sexo_denunciante ?>" frameborder="0" allowfullscreen allow="camera *;microphone *"></iframe> -->


					<div id="sc1" class="sc text-center d-flex justify-content-center align-items-center" style="min-height:600px;">
						<div id="texto_inicial" class="p-3 text-center" style="max-width:500px;">
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
						<div class="video_denunciante" style="display: none;" id="video_d"></div>
					</div>
					<div id="sc2" class="sc">
						<div class="video_usuario" style="display: none;" id="video_m">

						</div>

					</div>

					<!-- </div> -->

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
