<?= $this->extend('client/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php $session = session(); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12 text-center" style="font-size:10px;">
			Para un correcto funcionamiento utilice <a href="https://www.google.com/chrome/" target="_blank">google chrome</a>.<br>
			Si esta utilizando un dispositivo móvil de clic en <b>iniciar en el navegador</b>.
		</div>
		<div class="col-12 p-0 m-0">
			<div class="card text-center">
				<div class="card-body p-0 m-0">
					<div class="ratio ratio-16x9">
						<iframe style="min-height:600px;" src="<?= 'https://videodenunciaserver1.fgebc.gob.mx/videollamada?folio=' . $body_data->folio . '&nombre=' . $session->NOMBRE . ' ' . $session->APELLIDO_PATERNO . ' ' . $session->APELLIDO_MATERNO . '&delito=' . $body_data->delito . '&descripcion=' . $body_data->descripcion . '&idioma=' . $body_data->idioma . '&edad=' . $body_data->edad . '&perfil=' . $body_data->perfil . '&sexo=' . $body_data->sexo . '&prioridad=' . $body_data->prioridad . '&sexo_denunciante=' . $body_data->sexo_denunciante ?>" frameborder="0" allowfullscreen allow="camera *;microphone *"></iframe>
					</div>

				</div>
			</div>
			<br>
			<div class="card ">
				<form id="form_archivos_externos" method="post" enctype="multipart/form-data">
					<input type="text" class="form-control" id="folio" name="folio">
					<input type="text" class="form-control" id="year" name="year">
					<input type="text" class="form-control" id="autor" name="autor">
					<input type="text" class="form-control" id="archivodescr" name="archivodescr">

					<div class="row ">

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3 m-3">
							<label for="documentoArchivo" class="form-label font-weight-bold" style="font-weight: bold;">Documentos a anexar.</label>
							<input type="file" class="form-control" id="documentoArchivo" name="documentoArchivo" accept="image/jpeg, image/jpg, image/png, .doc, .pdf">
							<img id="viewDocumentoArchivo" class="img-fluid m-3" src="" style="max-width:100px;">

						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3 m-4">

							<button type="submit" class="btn-sm btn-primary  m-4" style="width: 100%;">Enviar documentos</button>
						</div>
					</div>
				</form>

			</div>

		</div>
	</div>
</div>
</div>
<script>
	const folio_get = `<?php echo $_GET['folio'] ?>`;
	const autor_get = `<?php echo $session->NOMBRE . ' ' . $session->APELLIDO_PATERNO . ' ' . $session->APELLIDO_MATERNO ?>`;
	const archivodescr_get = `<?php echo $_GET['delito'] ?>`;

	let arr = folio_get.split('-')
	const year = arr[0];
	const folio = arr[1];

	document.getElementById('folio').value = folio;
	document.getElementById('year').value = year;
	document.getElementById('autor').value = autor_get;
	document.getElementById('archivodescr').value = archivodescr_get;

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

	document.getElementById('form_archivos_externos').addEventListener('submit', function(evt){
    evt.preventDefault();
	crearArchivos();
})
	function crearArchivos() {
		var packetData = new FormData();
		packetData.append("documentoArchivo", $("#documentoArchivo")[0].files[0]);
		packetData.append("folio", document.getElementById('folio').value);
		packetData.append("year", document.getElementById('year').value);
		packetData.append("autor", document.getElementById('autor').value);
		packetData.append("archivodescr", document.getElementById('archivodescr').value);
		$.ajax({
			url: "<?= base_url('/data/create_archivos') ?>",
			method: "POST",
                dataType: 'json',
                contentType: false,
                data: packetData,
                processData: false,
                cache: false,
			success: function(response) {
				console.log(response);
				if (response.status == 1) {
					Swal.fire({
						icon: 'success',
						text: 'Archivo agregado correctamente',
						confirmButtonColor: '#bf9b55',
					});
					let preview = document.querySelector('#viewDocumentoArchivo');

					document.getElementById('documentoArchivo').value = '';
					preview.setAttribute('src', '');

				} else if(response.status==0){
					Swal.fire({
						icon: 'error',
						text: 'Los archivos no se pudieron subir',
						confirmButtonColor: '#bf9b55',
					});
				}else if(response.status==2){
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