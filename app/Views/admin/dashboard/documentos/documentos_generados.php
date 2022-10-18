<?= $this->extend('admin/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php include('modal_validation_password_doc.php') ?>
<?php include('app/Views/admin/dashboard/video_denuncia_modals/documentos_modal.php') ?>
<?php include 'app/Views/admin/dashboard/video_denuncia_modals/documentos_modal_editar.php' ?>
<?php include 'app/Views/admin/dashboard/video_denuncia_modals/documentos_modal_wyswyg.php' ?>
<?php include 'app/Views/admin/dashboard/video_denuncia_modals/send_email_modal.php' ?>
<?php include 'app/Views/admin/dashboard/video_denuncia_modals/prueba.php' ?>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<button type="button" class="btn btn-primary mb-3" data-toggle="modal" id="firmarDocumento" data-target="#contrasena_modal_doc"><i class="fas fa-file-signature"></i> Firmar documento</button>
				<button type="button" class="btn btn-primary mb-3" data-toggle="modal" id="generarDocumento" data-target="#documentos_modal_wyswyg"><i class="fas fa-file-archive"></i> Agregar documentos</button>
				<button type="button" class="btn btn-primary mb-3" data-toggle="modal" id="edtarDocumento" data-target="#documentos_generados_modal_v"><i class="fas fa-pencil-alt"></i> Editar documentos</button>
				<button type="button" class="btn btn-primary mb-3" data-toggle="modal" id="enviarDocumento" data-target="#sendEmailDocModal"><i class="fas fa-mail-bulk"></i> Enviar documentos pendientes</button>
				<button type="button" class="btn btn-primary mb-3" id="subirDocumento" name="subirDocumento" data-toggle="modal" data-target="#subirDocumentosModal"><i class="fas fa-archive"></i> Subir documentos</button>

				<?php
				foreach ($body_data->documentos as $key => $documento) { ?>
					<h5 class="card-title"><?php echo $documento->TIPODOC ?> | <?php echo $documento->STATUS ?></h5>
					<div class="card shadow border-0">
						<div class="card-body" name="document" id="document" style="margin: 2%;">
							<div class="card-text" id="documentos-show-edit-<?= $key ?>" name="documentos-show-edit" data-id="<?= $documento->FOLIODOCID ?>">
								<?php echo $documento->PLACEHOLDER ?>
							</div>
						</div>



					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
<div class="modal fade" id="documentos_generados_modal_v" role="dialog" aria-labelledby="documentosGeneradosvModal" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-dialog-centered mw-100 w-75">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-primary text-white">
				<h5 class="modal-title font-weight-bold">DOCUMENTOS GENERADOS</h5>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body bg-light">
				<div class="row">
					<div class="col-12">
						<div class="tab-content">



							<div class="table-responsive">
								<table id="table-documentos" class="table table-bordered table-hover table-striped table-light">
									<tr>
										<th class="text-center bg-primary text-white" id="tipodoc" name="tipodoc">TIPO DE DOCUMENTO</th>
										<th class="text-center bg-primary text-white">STATUS</th>
										<th class="text-center bg-primary text-white"></th>
										<th class="text-center bg-primary text-white"></th>
										<th class="text-center bg-primary text-white"></th>

									</tr>
								</table>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php if (session()->getFlashdata('message_error')) : ?>
		<script>
			Swal.fire({
				icon: 'error',
				html: '<strong><?= session()->getFlashdata('message') ?></strong>',
				confirmButtonColor: '#bf9b55',
			})
		</script>
	<?php endif; ?>
	<?php if (session()->getFlashdata('message_success')) : ?>
		<script>
			Swal.fire({
				icon: 'success',
				html: '<strong><?= session()->getFlashdata('message_success') ?></strong>',
				confirmButtonColor: '#bf9b55',
			})
		</script>
	<?php endif; ?>
	<?php if (session()->getFlashdata('message_warning')) : ?>
		<script>
			Swal.fire({
				icon: 'warning',
				html: '<strong><?= session()->getFlashdata('message_warning') ?></strong>',
				confirmButtonColor: '#bf9b55',
			})
		</script>
	<?php endif; ?>

	<script>
		$(document).ready(function() {
			let select_victima_documento = document.querySelector("#victima_modal_documento");
			let select_imputado_documento = document.querySelector("#imputado_modal_documento");
			let btn_enviarcorreoDoc = document.querySelector('#enviarcorreoDoc');
			let btn_archivos_externos = document.querySelector('#subirDocumento');

			const data = {
				'folio': <?php echo $_GET['folio'] ?>,
				'expediente': <?php echo $_GET['expediente'] ?>,
				'year': <?php echo $_GET['year'] ?>,
			};
			$.ajax({
				data: data,
				url: "<?= base_url('/data/get-documentos') ?>",
				method: "POST",
				dataType: "json",
				success: function(response) {
					if (response.status == 1) {
						const documentos = response.documentos;
						const imputados = response.imputados;
						const victimas = response.victimas;
						const correos = response.correos;
						let tabla_documentos = document.querySelectorAll('#table-documentos tr');
						tabla_documentos.forEach(row => {
							if (row.id !== '') {
								row.remove();
							}
						});
						llenarTablaDocumentos(documentos);
						const option_vacio = document.createElement('option');
						option_vacio.value = '';
						option_vacio.text = '';
						option_vacio.disabled = true;
						option_vacio.selected = true;
						const option_vacio_imp = document.createElement('option');
						option_vacio_imp.value = '';
						option_vacio_imp.text = '';
						option_vacio_imp.disabled = true;
						option_vacio_imp.selected = true;
						$('#victima_modal_documento').empty();

						select_victima_documento.add(option_vacio, null);

						victimas.forEach(victima => {
							const option = document.createElement('option');
							option.value = victima.PERSONAFISICAID;
							option.text = victima.NOMBRE + ' ' + victima.PRIMERAPELLIDO;
							select_victima_documento.add(option, null);
						});
						$('#imputado_modal_documento').empty();
						select_imputado_documento.add(option_vacio_imp, null);

						imputados.forEach(imputado => {
							const option = document.createElement('option');
							option.value = imputado.PERSONAFISICAID;
							option.text = imputado.NOMBRE + ' ' + imputado.PRIMERAPELLIDO;
							select_imputado_documento.add(option, null);
						});
						$('#send_mail_select').empty();
						let select_mail_send = document.querySelector("#send_mail_select");
						correos.forEach(correo => {
							const option = document.createElement('option');
							option.value = correo.CORREO;
							option.text = correo.CORREO;
							select_mail_send.add(option, null);
						});

					}
				},
				error: function(jqXHR, textStatus, errorThrown) {}
			});

			var selectPlantilla = document.querySelector('#plantilla');
			let plantilla = document.querySelector("#plantilla");
			var btn_guardarFolioDoc = document.querySelector('#guardarFolioDoc');
			var btn_actualizarFolioDoc = document.querySelector('#actualizarFolioDoc');

			var quill = new Quill('#documento', {
				theme: 'snow'
			});
			var quill2 = new Quill('#documento_editar', {
				theme: 'snow'
			});

			btn_actualizarFolioDoc.addEventListener('click', (event) => {
				let contenidoModificado = quill2.container.firstChild.innerHTML;
				actualizarDocumento(contenidoModificado);
			}, false);

			selectPlantilla.addEventListener("change", function() {

				if (plantilla.value != "CONSTANCIA DE EXTRAVÍO") {
					document.getElementById("involucrados").style.display = "block";
					select_imputado_documento.addEventListener("change", function() {
						$('#documentos_modal_wyswyg').modal('hide');
						$('#documentos_modal').modal('show');
						obtenerPlantillas(plantilla.value, select_victima_documento.value, select_imputado_documento.value);

					})

				} else {
					document.getElementById("involucrados").style.display = "none";
				}

			});



			function obtenerPlantillas(tipoPlantilla, victima, imputado) {

				const data = {

					'expediente': <?php echo $_GET['expediente'] ?>,
					'year': <?php echo $_GET['year'] ?>,
					'titulo': tipoPlantilla,
					'victima': victima,
					'imputado': imputado,

				};
				$.ajax({
					method: 'POST',
					url: "<?= base_url('/data/get-plantilla') ?>",
					data: data,
					dataType: 'JSON',
					success: function(response) {
						const plantillas = response.plantilla;
						quill.root.innerHTML = plantillas.PLACEHOLDER;
						document.querySelector("#victima_modal_documento").value = '';
						document.querySelector("#imputado_modal_documento").value = '';
						document.getElementById("involucrados").style.display = "none";


					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus);
					}
				});
			}
			btn_guardarFolioDoc.addEventListener('click', (event) => {
				let contenidoModificado = quill.container.firstChild.innerHTML;
				console.log(plantilla.value);
				insertarDocumento(contenidoModificado, plantilla.value);
			}, false);

			function insertarDocumento(contenido, tipoPlantilla) {
				Swal.fire({
					title: '¿Este documento tiene que ser enviado?',
					showDenyButton: true,
					showCancelButton: true,
					confirmButtonText: 'Si',
					confirmButtonColor: '#bf9b55',
					denyButtonText: 'No',
					cancelButtonText: 'No',
				}).then((result) => {
					/* Read more about isConfirmed, isDenied below */
					if (result.isConfirmed) {
						const data = {
							'folio': <?php echo $_GET['folio'] ?>,
							'expediente': <?php echo $_GET['expediente'] ?>,
							'year': <?php echo $_GET['year'] ?>,
							'placeholder': contenido,
							'municipio': 2,
							'titulo': tipoPlantilla,
							'statusenvio': 1
						};
						insertarDoc(data);

					} else {
						const data = {
							'folio': <?php echo $_GET['folio'] ?>,
							'expediente': <?php echo $_GET['expediente'] ?>,
							'year': <?php echo $_GET['year'] ?>,
							'placeholder': contenido,
							'municipio': 2,
							'titulo': tipoPlantilla,
							'statusenvio': 0
						};
						insertarDoc(data);

					}
				})


			}

			function insertarDoc(data) {
				$.ajax({
					data: data,
					url: "<?= base_url('/admin/dashboard/insert-documentosWSYWSG') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {


						if (response.status == 1) {
							const documentos = response.documentos;
							Swal.fire({
								icon: 'success',
								text: 'Documento ingresado correctamente',
								confirmButtonColor: '#bf9b55',
							});

							$('#documentos_modal').modal('hide');
							let tabla_documentos = document.querySelectorAll('#table-documentos tr');
							tabla_documentos.forEach(row => {
								if (row.id !== '') {
									row.remove();
								}
							});
							llenarTablaDocumentos(documentos);
							document.querySelector("#plantilla").value = '';
							location.reload();
						}



					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			}
			var btn_firmar_doc = document.querySelector('#firmar_documento_modal');

			btn_firmar_doc.addEventListener('click', (event) => {
				$.ajax({
					data: {
						'folio': document.querySelector('#folio').value,
						'expediente_modal': document.querySelector('#expediente').value,
						'contrasena': document.querySelector('#contrasena').value,
						'year_modal': <?php echo $_GET['year'] ?>,
					},
					url: "<?= base_url('/admin/dashboard/firmar_documentos') ?>",
					method: "POST",
					dataType: "json",
					beforeSend: function() {
						document.querySelector('#load').classList.add('d-none');
						document.querySelector('#password_modalLabel').classList.add('d-none');
						document.querySelector('#loading').classList.remove('d-none');
						document.querySelector('#password_verifying').classList.remove('d-none');
						btn_firmar_doc.disabled = true;
					},
					success: function(response) {
						if (response.status == 1) {

							Swal.fire({
								icon: 'success',
								text: 'Documento firmado correctamente',
								confirmButtonColor: '#bf9b55',
							});
							document.querySelector('#contrasena').value = '';
							$('#contrasena_modal_doc').modal('hide');
							location.reload();

						} else if (response.status == 0) {

							Swal.fire({
								icon: 'error',
								text: response.message_error,
								confirmButtonColor: '#bf9b55',
							});
							document.querySelector('#load').classList.remove('d-none');
							document.querySelector('#password_modalLabel').classList.remove('d-none');
							document.querySelector('#loading').classList.add('d-none');
							document.querySelector('#password_verifying').classList.add('d-none');
							btn_firmar_doc.disabled = false;

						}
					},

					error: function(jqXHR, textStatus, errorThrown) {}
				});
			}, false);
			btn_enviarcorreoDoc.addEventListener('click', (event) => {
				$.ajax({
					data: {
						'expediente_modal_correo': <?php echo $_GET['expediente'] ?>,
						'send_mail_select': document.querySelector('#send_mail_select').value,
						'year_modal_correo': <?php echo $_GET['year'] ?>,
					},
					url: "<?= base_url('/admin/dashboard/send-documentos-correo') ?>",
					method: "POST",
					dataType: "json",
					beforeSend: function() {
						document.querySelector('#load_mail').classList.add('d-none');
						document.querySelector('#enviar_modalLabel').classList.add('d-none');
						document.querySelector('#loading_mail').classList.remove('d-none');
						document.querySelector('#password_verifying_mail').classList.remove('d-none');
						btn_enviarcorreoDoc.disabled = true;
					},
					success: function(response) {
						if (response.status == 1) {
							Swal.fire({
								icon: 'success',
								text: 'Correo enviado correctamente',
								confirmButtonColor: '#bf9b55',
							});
							$('#sendEmailDocModal').modal('hide');
							document.querySelector('#load_mail').classList.remove('d-none');
							document.querySelector('#enviar_modalLabel').classList.remove('d-none');
							document.querySelector('#loading_mail').classList.add('d-none');
							document.querySelector('#password_verifying_mail').classList.add('d-none');
							btn_enviarcorreoDoc.disabled = false;

						}
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			}, false);
			btn_archivos_externos.addEventListener('click', (event) => {
				$('#subirDocumentosModal').modal('show');
				$('#subirDocumentosModal').show();
				$.ajax({
					data: {
						'folio': <?php echo $_GET['folio'] ?>,
						'expediente': <?php echo $_GET['expediente'] ?>,
						'year': <?php echo $_GET['year'] ?>,
					},
					url: "<?= base_url('/data/save-archivos-externos') ?>",
					method: "POST",
					dataType: "json",
					beforeSend: function() {
						document.querySelector('#loading_sub_doc').classList.remove('d-none');
						document.querySelector('#verifying_documentos').classList.remove('d-none');
						btn_archivos_externos.disabled = true;
					},
					success: function(response) {
						if (response.status == 1) {
							$('#subirDocumentosModal').modal('hide');
							$('#subirDocumentosModal').hide();
							document.querySelector('#loading_sub_doc').classList.add('d-none');
							document.querySelector('#verifying_documentos').classList.add('d-none');
							btn_archivos_externos.disabled = false;
							Swal.fire({
								icon: 'success',
								text: 'Archivos externos subidos correctamente',
								confirmButtonColor: '#bf9b55',
							});

						} else if (response.status == 0) {

							Swal.fire({
								icon: 'error',
								text: "No se subieron los archivos",
								confirmButtonColor: '#bf9b55',
							});
							$('#subirDocumentosModal').modal('hide');
							$('#subirDocumentosModal').hide();
							document.querySelector('#loading_sub_doc').classList.add('d-none');
							document.querySelector('#verifying_documentos').classList.add('d-none');
							btn_archivos_externos.disabled = false;
						} else if (response.status == 3) {
							Swal.fire({
								icon: 'success',
								text: "Los archivos ya estan registrados",
								confirmButtonColor: '#bf9b55',
							});
							$('#subirDocumentosModal').modal('hide');
							$('#subirDocumentosModal').hide();
							document.querySelector('#loading_sub_doc').classList.add('d-none');
							document.querySelector('#verifying_documentos').classList.add('d-none');
							btn_archivos_externos.disabled = false;
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			}, false);



			function actualizarDocumento(placeholder) {
				const data = {
					'folio': <?php echo $_GET['folio'] ?>,
					'year': <?php echo $_GET['year'] ?>,
					'foliodocid': document.querySelector('#docid').value,
					'placeholder': placeholder
				};
				$.ajax({
					data: data,
					url: "<?= base_url('/data/update-documento-by-id') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						if (response.status == 1) {
							const documentos = response.documentos;
							let tabla_documentos = document.querySelectorAll('#table-documentos tr');
							tabla_documentos.forEach(row => {
								if (row.id !== '') {
									row.remove();
								}
							});
							llenarTablaDocumentos(documentos);
							Swal.fire({
								icon: 'success',
								text: 'Documento actualizado correctamente',
								confirmButtonColor: '#bf9b55',
							});
							location.reload();

						} else {
							Swal.fire({
								icon: 'error',
								text: 'No se actualizó el documento',
								confirmButtonColor: '#bf9b55',
							});
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus);
					}
				});

			}


		});

		function llenarTablaDocumentos(documentos) {
			for (let i = 0; i < documentos.length; i++) {
				if (documentos[i].STATUS == 'FIRMADO') {
					var btn = `<button type='button'  class='btn btn-primary' onclick='viewDocumento(${documentos[i].FOLIODOCID})' disabled><i class="fas fa-eye"></i></button>`
					var btnpdf = `<form class="d-inline-block" method="POST" action="<?php echo base_url('/data/download-pdf-documento') ?>">
													<input type="text" class="form-control" id="folio" name="folio" value="<?= $_GET['folio'] ?>" hidden>
													<input type="text" class="form-control" id="year" name="year" value="<?= $_GET['year'] ?>" hidden>
													<input type="text" class="form-control" id="docid" name="docid" value="${documentos[i].FOLIODOCID}" hidden>

													<button type="submit" class="btn btn-primary mb-3">
														PDF
													</button>
												</form>`
					var btnxml = `<form class="d-inline-block" method="POST" action="<?php echo base_url('/data/download-xml-documento') ?>">
													<input type="text" class="form-control" id="folio" name="folio" value="<?= $_GET['folio'] ?>" hidden>
													<input type="text" class="form-control" id="year" name="year" value="<?= $_GET['year'] ?>" hidden>
													<input type="text" class="form-control" id="docid" name="docid" value="${documentos[i].FOLIODOCID}" hidden>

													<button type="submit" class="btn btn-primary mb-3">
														XML
													</button>
												</form>`

				} else {
					var btn = `<button type='button'  class='btn btn-primary' onclick='viewDocumento(${documentos[i].FOLIODOCID})'><i class="fas fa-eye"></i></button>`
				}
				var fila =
					`<tr id="row${i}">` +
					`<td class="text-center">${documentos[i].TIPODOC}</td>` +
					`<td class="text-center">${documentos[i].STATUS}</td>` +
					`<td class="text-center">${btn}</td>` +
					`<td class="text-center">${btnpdf}</td>` +
					`<td class="text-center">${btnxml}</td>` +

					`</tr>`;

				$('#table-documentos tr:first').after(fila);
				$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
				var nFilas = $("#documentos tr").length;
				$("#adicionados").append(nFilas - 1);
			}
		}

		function viewDocumento(foliodocid) {
			jQuery('.ql-toolbar').remove();
			$('#documentos_generados_modal_v').modal('hide');
			$('#documentos_modal_editar').modal('show');
			$.ajax({
				data: {
					'docid': foliodocid,
					'folio': <?php echo $_GET['folio'] ?>,
					'year': <?php echo $_GET['year'] ?>,
				},
				url: "<?= base_url('/data/get-documento-tabla') ?>",
				method: "POST",
				dataType: "json",
				success: function(response) {
					if (response.status == 1) {
						let documento_id = response.documentoporid;
						var quill2 = new Quill('#documento_editar', {
							theme: 'snow'
						});
						quill2.root.innerHTML = documento_id;
						document.querySelector('#docid').value = foliodocid;

					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus);
				}
			});
		}
	</script>

	<?= $this->endSection() ?>