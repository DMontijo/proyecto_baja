<?= $this->extend('denuncia_litigantes/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php $session = session(); ?>
<div class="row">
	<div class="col-12">
		<div class="card rounded shadow border-0">
			<div class="card-body py-5 p-sm-5">
				<div class="container text-center">
					<h1 class="text-center fw-bolder pb-1 text-blue">SUBIR ARCHIVOS</h1>
					<p class="text-center fw-bold text-blue ">Recuerda subir solo uno a la vez.</p>

					<form id="subirDocForm" name="subirDocForm" action="<?= base_url() ?>/denuncia_litigantes/dashboard/subir_documentos" method="POST" enctype="multipart/form-data" class="row needs-validation" novalidate>
						<div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
							<label for="documento_extra" class="form-label fw-bold ">Documento:</label>
							<input type="text" class="form-control" id="folio" name="folio" value="<?= $_GET['folio']?>" hidden>
							<input type="text" class="form-control" id="year" name="year" value="<?= $_GET['year']?>" hidden>

							<input class="form-control" type="file" id="documento_extra" name="documento_extra" accept="image/jpeg, image/jpg, image/png, application/pdf" required>
							<img class="img-fluid d-none py-2" src="" id="img_preview_carta" name="img_preview_carta">

						</div>

						<button type="submit" id="subirDocSubmit" name="subirDocSubmit" class="btn btn-primary">Subir documentos</button>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>
<?php if (session()->getFlashdata('message_success')) : ?>
	<script>
		Swal.fire({
			icon: 'success',
			html: '<strong><?= session()->getFlashdata('message_success') ?></strong>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<?php if (session()->getFlashdata('message_error')) : ?>
	<script>
		Swal.fire({
			icon: 'error',
			html: '<strong><?= session()->getFlashdata('message') ?></strong>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<script>
	(function() {
		'use strict'
		var forms = document.querySelectorAll('.needs-validation');
		var inputsText = document.querySelectorAll('input[type="text"]');
		var inputsEmail = document.querySelectorAll('input[type="email"]');
		var radiosDesaparecido = document.getElementsByName('esta_desaparecido');
		var submitBtn = document.querySelector('#subirDocSubmit');

		Array.prototype.slice.call(forms)
			.forEach(function(form) {
				form.addEventListener('submit', (event) => {
					if (!form.checkValidity()) {
						event.preventDefault();
						event.stopPropagation();
						submitBtn.removeAttribute('disabled');
					} else {
						event.preventDefault();
						submitBtn.setAttribute('disabled', true);
						document.querySelector('#subirDocForm').submit();
					}
					form.classList.add('was-validated')
				}, false)
			})


		document.querySelector('#documento_extra').addEventListener('change', async (e) => {

			let preview = document.querySelector('#img_preview_carta');

			if (e.target.files && e.target.files[0]) {
				if (e.target.files[0].type == "image/jpeg" || e.target.files[0].type == "image/png" || e.target.files[0].type == "image/jpg") {
					if (e.target.files[0].size > 2000000) {
						const blob = await comprimirImagen(e.target.files[0], 50);
						if (blob.size > 2000000) {
							e.target.value = '';

							preview.classList.add('d-none');
							preview.setAttribute('src', '');
							Swal.fire({
								icon: 'error',
								text: 'No puedes subir un archivo mayor a 2 mb.',
								confirmButtonColor: '#bf9b55',
							});
							return;
						} else {
							const image = await blobToBase64(blob);
							console.log(image);

							preview.classList.remove('d-none');
							preview.setAttribute('src', image);
						}
					} else {
						let reader = new FileReader();
						reader.onload = function(e) {

							preview.classList.remove('d-none');
							preview.setAttribute('src', e.target.result);
						}
						reader.readAsDataURL(e.target.files[0]);
					}

				} else {
					if (e.target.files[0].size > 2000000) {
						e.target.value = '';
						preview.classList.add('d-none');
						preview.setAttribute('src', '');
						Swal.fire({
							icon: 'error',
							text: 'No puedes subir un archivo mayor a 2 MB.',
							confirmButtonColor: '#bf9b55',
						});
						return;
					} else {
						let reader = new FileReader();
						reader.onload = function(e) {
							documento_identidad.value = e.target.result;
							documento_identidad_modal.setAttribute('src', e.target.result);
							preview.classList.remove('d-none');
							preview.setAttribute('src', e.target.result);
						}
						reader.readAsDataURL(e.target.files[0]);
					}
				}
			}
		});

		function blobToBase64(blob) {
			return new Promise((resolve, _) => {
				const reader = new FileReader();
				reader.onloadend = () => resolve(reader.result);
				reader.readAsDataURL(blob);
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

	})();
</script>
<?= $this->endSection() ?>