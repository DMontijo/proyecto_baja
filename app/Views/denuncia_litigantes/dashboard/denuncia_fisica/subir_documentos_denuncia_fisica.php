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
					<h1 class="text-center fw-bolder pb-1 text-blue">SUBIR ARCHIVO DE DENUNCIA POR ESCRITO Y ANEXOS</h1>
					<p class="text-center fw-bold text-blue ">Recuerda subir solo uno a la vez.</p>
					<div class="alert alert-warning" role="alert">
						La denuncia por escrito es obligatoria, adjunte la misma para poder finalizar su atención.
					</div>
					<form id="subirDocForm" name="subirDocForm" action="<?= base_url() ?>/denuncia_litigantes/dashboard/subir_documentos" method="POST" enctype="multipart/form-data" class="row needs-validation" novalidate>
						<div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
							<label for="documento_extra_denuncia_escrita" class="form-label fw-bold ">Documento:</label>
							<input type="text" class="form-control d-none" id="folio" name="folio" value="<?= $_GET['folio'] ?>">
							<input type="text" class="form-control d-none" id="year" name="year" value="<?= $_GET['year'] ?>">

							<input class="form-control" type="file" id="documento_extra_denuncia_escrita" name="documento_extra_denuncia_escrita" accept="image/jpeg, image/jpg, image/png, application/pdf" required>
							<img class="img-fluid d-none py-2" src="" style="width:50%;" id="img_preview_carta" name="img_preview_carta">
							<!-- <a id="descargar_documento" class="btn btn-primary d-none" download="">
								Descargar archivo
							</a> -->
							<div id="title-doc" class="d-none"></div>

						</div>

						<button type="submit" id="subirDocSubmit" name="subirDocSubmit" class="btn btn-primary">Subir documentos</button>
					</form>
					<hr>
					<div id="adicionados" class="d-none"></div>

					<table id="table-archivos" class="table table-striped table-hover table-bordered mt-3">
						<thead>
							<tr class="text-center bg-blue text-white">
								<th scope="col" width="90%">ARCHIVOS SUBIDOS</th>
								<th scope="col" width="10%"></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($body_data->archivos as $index => $archivo) { ?>
								<tr id="<?= $index ?>">
									<td class="fw-bold col-3 text-center p-3"><?= $archivo->ARCHIVODESCR . '.' . $archivo->EXTENSION ?> </td>
									<td class="fw-bold col-3 text-center p-3">
										<button class="btn btn-primary"><a id="downloadArchivo" href="<?= $archivo->ARCHIVO; ?>" download="<?= $archivo->ARCHIVODESCR . '.' . $archivo->EXTENSION; ?>"></a><i class="bi bi-download"></i></button>
										<button type='button' id="deleteArchivobtn" class='btn btn-primary' onclick='deleteArchivo(<?= $archivo->FOLIOARCHIVOID ?>)'><i class='bi bi-trash'></i></button>
									</td>

								</tr>
							<?php } ?>
						</tbody>
					</table>
					<div class="row p-2">
						<div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
							<button onclick="redirigir()" type="button" id="finalizarDenuncia" name="finalizarDenuncia" class="btn btn-secondary w-100" disabled>
								<?php if ($body_data->status == "PENDIENTE") { ?>
									CREAR DENUNCIA
								<?php } else { ?>
									He finalizado de agregar documentación y anexos correspondientes.
								<?php } ?>
							</button>
						</div>
					</div>

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
	function redirigir() {
		window.location.href = `<?= base_url() ?>/denuncia_litigantes/dashboard/pantalla_final`;
	}

	function deleteArchivo(archivoid) {
		$.ajax({
			data: {
				'archivoid': archivoid,
				'folio': folio.value,
				'year': year.value,
			},
			url: "<?= base_url('/denuncia_litigantes/dashboard/delete-archivo-by-id') ?>",
			method: "POST",
			dataType: "json",
			beforeSend: function() {
				const deleteButtons = document.querySelectorAll('#deleteArchivobtn');
				deleteButtons.forEach(button => button.disabled = true);
			},
			success: function(response) {
				if (response.status == 1) {
					const archivos = response.archivos.archivosexternos;
					//llena la tabla de archivos externos
					Swal.fire({
						icon: 'success',
						text: 'Archivo eliminado correctamente',
						confirmButtonColor: '#bf9b55',
					});
					let tabla_archivos = document.querySelectorAll(
						'#table-archivos tr');
					tabla_archivos.forEach(row => {
						if (row.id !== '') {
							row.remove();
						}
					});
					llenarTablaArchivosExternos(archivos);
					const deleteButtons = document.querySelectorAll('#deleteArchivobtn');
					deleteButtons.forEach(button => button.disabled = false);
				} else {
					const deleteButtons = document.querySelectorAll('#deleteArchivobtn');
					deleteButtons.forEach(button => button.disabled = false);
				}
			}
		});
	}

	function llenarTablaArchivosExternos(archivos) {
		console.log(archivos);

		for (let i = 0; i < archivos.length; i++) {
			console.log(archivos);
			const btnDescargar = `<button class="btn btn-primary"><a id="downloadArchivo" href="${archivos[i].ARCHIVO} " download="${archivos[i].ARCHIVODESCR} + '.'+ ${archivos[i].EXTENSION} "></a><i class="bi bi-download"></i></button>`
			console.log(btnDescargar);

			var btnEliminarArchivo =
				`<button type='button' id="deleteArchivobtn" class='btn btn-primary' onclick='deleteArchivo(${archivos[i].FOLIOARCHIVOID})'><i class='bi bi-trash'></i></button>`;
			console.log("btnEliminarArchivo: ", btnEliminarArchivo);

			var fila =
				`<tr id="row${i}">` +
				`<td class="fw-bold col-3 text-center p-3">${archivos[i].ARCHIVODESCR} </td>` +
				`<td class="fw-bold col-3 text-center p-3">${btnDescargar}${btnEliminarArchivo}</td>` +
				`</tr>`;

			$('#table-archivos tr:first').after(fila);
			$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
			var nFilas = $("#table-archivos tr").length;
			$("#adicionados").append(nFilas - 1);
			///Funcion de descarga de archivos
			console.log("document.querySelector('#downloadArchivo'): ", document.querySelector('#downloadArchivo'));

		}
	}
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

		setInterval(() => {
			const data = {
				'folio': document.querySelector('#folio').value,
				'year': document.querySelector('#year').value,
			};

			$.ajax({
				data: data,
				url: "<?= base_url('/data/getStatusFolio') ?>",
				method: "GET",
				dataType: "json",
				success: function(response) {
					if (response.data.STATUS == "ABIERTO") {
						document.getElementById('finalizarDenuncia').disabled = false;
						document.getElementById('subirDocSubmit').disabled = true;
						document.getElementById('finalizarDenuncia').textContent = "He finalizado de agregar documentación y anexos correspondientes."
					} else {
						document.getElementById('finalizarDenuncia').disabled = true;
						document.getElementById('finalizarDenuncia').textContent = "CREAR DENUNCIA.";

					}
				}
			});
		}, 5000);



		document.querySelector('#documento_extra_denuncia_escrita').addEventListener('change', async (e) => {
			let file = e.target.files[0];
			let preview = document.querySelector('#img_preview_carta');
			let title_doc = document.getElementById('title-doc');
			// let downloadLink = document.getElementById('descargar_documento');

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
							document.getElementById('subirDocSubmit').disabled = false;
							const image = await blobToBase64(blob);
							console.log(image);

							preview.classList.remove('d-none');
							preview.setAttribute('src', image);
							// downloadLink.classList.remove('d-none');
							// downloadLink.href = e.target.result;
							// downloadLink.download = file.name;
							title_doc.classList.remove('d-none')
							title_doc.innerHTML = file.name;
							preview.classList.remove('d-none');
						}
					} else {
						// document.getElementById('subirDocSubmit').disabled = false;

						let reader = new FileReader();
						reader.onload = function(e) {
							// downloadLink.classList.remove('d-none');
							// downloadLink.href = e.target.result;
							// downloadLink.download = file.name;
							title_doc.classList.remove('d-none')
							title_doc.innerHTML = file.name;
							preview.classList.remove('d-none');
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
						// document.getElementById('subirDocSubmit').disabled = false;

						let reader = new FileReader();
						reader.onload = function(e) {
							// downloadLink.classList.remove('d-none');
							// downloadLink.href = e.target.result;
							// downloadLink.download = file.name;
							title_doc.classList.remove('d-none')
							title_doc.innerHTML = file.name;
							preview.classList.remove('d-none');
							preview.setAttribute('src', '<?= base_url() ?>/assets/img/file.png');
						}


						reader.readAsDataURL(e.target.files[0]);

					}
				}
			}
		});


		//Funion para prevenir cerrar la ventana durante la asignacion de una denuncia.
		function preventCloseWindow() {
			window.removeEventListener("beforeunload", null, false);
			window.addEventListener("beforeunload", (evento) => {
				evento.preventDefault();
				evento.returnValue = "Si cierras no se subirá la denuncia por escrito";
				return "Si cierras no se subirá la denuncia por escrito";
			});
		}

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