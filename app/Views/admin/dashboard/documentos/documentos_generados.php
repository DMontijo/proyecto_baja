<?= $this->extend('admin/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php include('modal_validation_password_doc.php') ?>
<?php include('modal_validation_password_doc_id.php') ?>

<?php include('app/Views/admin/dashboard/video_denuncia_modals/documentos_modal.php') ?>
<?php include 'app/Views/admin/dashboard/video_denuncia_modals/documentos_modal_editar.php' ?>
<?php include 'app/Views/admin/dashboard/video_denuncia_modals/change_status_doc.php' ?>
<?php include('app/Views/admin/dashboard/video_denuncia_modals/encargados_modal.php') ?>
<?php include('app/Views/admin/dashboard/video_denuncia_modals/asignar_agente_modal.php') ?>

<?php include 'app/Views/admin/dashboard/video_denuncia_modals/documentos_modal_wyswyg.php' ?>
<?php include 'app/Views/admin/dashboard/video_denuncia_modals/send_email_modal.php' ?>
<?php include 'app/Views/admin/dashboard/video_denuncia_modals/send_email_modal_docunitario.php' ?>

<?php include 'app/Views/admin/dashboard/video_denuncia_modals/load_save_archivos_modal.php' ?>
<section class="content">
	<div class="container-fluid">
		<div class="col-12 text-center mb-4">
			<a class="link link-primary" href="<?= base_url('admin/dashboard/documentos') ?>" role="button"><i class="fas fa-reply"></i> REGRESAR A DOCUMENTOS ASIGNADOS</a>
		</div>
		<div class="row">
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<button type="button" style="min-height:120px;" class="btn btn-primary mb-3 w-100" data-toggle="modal" id="generarDocumento" data-target="#documentos_modal_wyswyg"><i class="fas fa-file"></i> Agregar documento</button>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<button type="button" style="min-height:120px;" class="btn btn-primary mb-3 w-100" data-toggle="modal" id="firmarDocumento" data-target="#contrasena_modal_doc"><i class="fas fa-file-signature"></i> Firmar documentos</button>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<button type="button" style="min-height:120px;" class="btn btn-primary mb-3 w-100" data-toggle="modal" id="enviarDocumento" data-target="#sendEmailDocModal"><i class="fas fa-paper-plane"></i> Enviar documentos</button>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<button type="button" style="min-height:120px;" class="btn btn-primary mb-3 w-100" id="subirDocumento" name="subirDocumento" data-toggle="modal" data-target="#subirDocumentosModal"><i class="fas fa-upload"></i> Subir a Justicia Net</button>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<button type="button" style="min-height:120px;" class="btn btn-primary mb-3 w-100" id="refrescarPagina" name="refrescarPagina" onclick="location.reload()"><i class="fas fa-undo-alt"></i> Refrescar</button>
			</div>
			<div class="col-12" style="font-size:11px;overflow:auto;">
				<div class="table-responsive table-bordered">
					<table id="table-documentos" class="table table-bordered table-hover table-striped table-light table-sm">
						<tr>
							<th class="text-center bg-primary text-white" id="tipodoc" name="tipodoc">NOMBRE</th>
							<th class="text-center bg-primary text-white">ESTADO</th>
							<th class="text-center bg-primary text-white">GENERADO POR</th>
							<th class="text-center bg-primary text-white">ASIGNADO A</th>
							<th class="text-center bg-primary text-white">ASIGNAR AGENTE</th>
							<th class="text-center bg-primary text-white">ASIGNAR ENCARGADO</th>
							<th class="text-center bg-primary text-white" style="min-width:300px;">ACCIONES</th>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<?php if ($body_data->foliorow[0]->AGENTEASIGNADOID != NULL) { ?>
	<script>
		// document.getElementById('subirDocumento').disabled = true;
		// document.getElementById('generarDocumento').disabled = true;
	</script>
<?php } ?>
<?php if ($body_data->foliorow[0]->TIPODENUNCIA == "DA") { ?>
	<script>
		// document.getElementById('enviarDocumento').disabled = true;
	</script>
<?php } ?>
<?php if ($body_data->foliorow[0]->STATUS == "CANALIZADO" || $body_data->foliorow[0]->STATUS == "DERIVADO") { ?>
	<script>
		document.getElementById('enviarDocumento').disabled = true;
		document.getElementById('subirDocumento').disabled = true;
		// document.getElementById('btn_remitir').disabled = true;
	</script>
<?php } ?>
<?php if ($body_data->foliorow[0]->STATUS != "EXPEDIENTE" && $body_data->foliorow[0]->TIPODENUNCIA == "VD") { ?>
	<script>
		document.getElementById('enviarDocumento').disabled = false;
	</script>
<?php } ?>
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
<?php if (session('ROLID') == 4 || session('ROLID') == 8 || session('ROLID') == 10) : ?>
	<script>
		document.getElementById('firmarDocumento').disabled = true;
	</script>
<?php endif; ?>


<script>
	$(document).ready(function() {
		let select_victima_documento = document.querySelector("#victima_modal_documento");
		let select_imputado_documento = document.querySelector("#imputado_modal_documento");
		let btn_enviarcorreoDoc = document.querySelector('#enviarcorreoDoc');
		let btn_enviarcorreoDocUni = document.querySelector('#enviarcorreoDocUnitario');

		let btn_archivos_externos = document.querySelector('#subirDocumento');
		let resultado = getParameterByName('q');

		function isParameterByName(name) {
			let regex = new RegExp('[?&]' + name + '=');
			return regex.test(window.location.href);
		}

		if (isParameterByName('expediente')) {
			const data = {
				'folio': getParameterByName('folio'),
				'expediente': getParameterByName('expediente'),
				'year': getParameterByName('year'),
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
							option.text = victima.NOMBRE + ' ' + victima.PRIMERAPELLIDO + ' | ' + victima.PERSONACALIDADJURIDICADESCR;
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
						let option_sms = document.createElement('option');
						option_sms.value = '';
						option_sms.text = 'Seleccionar un correo...';
						option_sms.disabled = true;
						option_sms.selected = true;
						select_mail_send.add(option_sms, null);
						correos.forEach(correo => {
							if (correo != '') {
								const option = document.createElement('option');
								option.value = correo.CORREO;
								option.text = correo.CORREO;
								select_mail_send.add(option, null);
							}
						});
						$('#send_mail_select_uni').empty();
						let send_mail_select_uni = document.querySelector("#send_mail_select_uni");
						let option_smsu = document.createElement('option');
						option_smsu.value = '';
						option_smsu.text = 'Seleccionar un correo...';
						option_smsu.disabled = true;
						option_smsu.selected = true;
						send_mail_select_uni.add(option_smsu, null);
						correos.forEach(correo => {
							const option = document.createElement('option');
							option.value = correo.CORREO;
							option.text = correo.CORREO;
							send_mail_select_uni.add(option, null);
						});
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {}
			});

		} else {
			const data = {
				'folio': getParameterByName('folio'),
				'year': getParameterByName('year'),
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
							option.text = victima.NOMBRE + ' ' + victima.PRIMERAPELLIDO + ' | ' + victima.PERSONACALIDADJURIDICADESCR;
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
						$('#send_mail_select_uni').empty();
						let send_mail_select_uni = document.querySelector("#send_mail_select_uni");
						correos.forEach(correo => {
							const option = document.createElement('option');
							option.value = correo.CORREO;
							option.text = correo.CORREO;
							send_mail_select_uni.add(option, null);
						});
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {}
			});

		}
		var selectPlantilla = document.querySelector('#plantilla');
		let plantilla = document.querySelector("#plantilla");
		var btn_guardarFolioDoc = document.querySelector('#guardarFolioDoc');
		var btn_actualizarFolioDoc = document.querySelector('#actualizarFolioDoc');
		let select_uma = document.querySelector("#uma_select");
		let select_proceso = document.querySelector("#tipoproceso_select");
		let select_notificacion = document.querySelector("#tiponotificacion_select");
		var options = select_uma.options;
		$('#documentos_modal_wyswyg').on('show.bs.modal', function(event) {
			<?php if (session('ROLID') == 4 || session('ROLID') == 8 || session('ROLID') == 10) { ?>
				const data = {
					'folio': <?php echo $_GET['folio'] ?>,
					'year': <?php echo $_GET['year'] ?>,
				};
				$.ajax({
					data: data,
					url: "<?= base_url('/data/get-documentos-by-folio') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						console.log(response);
						if (response.status == 1) {
							const div_usuarios = document.querySelector('#usuarios');
							document.querySelector('#empleado_asignado').setAttribute('required', false);
							div_usuarios.classList.add('d-none');
							Swal.fire({
								icon: 'warning',
								text: 'Este folio, ya tiene agente asignado para firmar. Se autoasignará al mismo agente.',
								confirmButtonColor: '#bf9b55',
							});

						} else {
							const div_usuarios = document.querySelector('#usuarios');
							div_usuarios.classList.remove('d-none');
							document.querySelector('#empleado_asignado').setAttribute('required', true);
						}

					}
				});
			<?php } else { ?>
				document.querySelector('#empleado_asignado').setAttribute('required', false);

			<?php } ?>
		});
		<?php if ($body_data->foliorow[0]->MUNICIPIOASIGNADOID == 1 || $body_data->foliorow[0]->INSTITUCIONREMISIONMUNICIPIOID	== 1) { ?>
			eliminarUMAByMunicipio("ENSENADA");
		<?php } else if ($body_data->foliorow[0]->MUNICIPIOASIGNADOID == 6 || $body_data->foliorow[0]->INSTITUCIONREMISIONMUNICIPIOID	== 6) { ?>
			eliminarUMAByMunicipio("ENSENADA - SAN QUINTIN");
		<?php } else if ($body_data->foliorow[0]->MUNICIPIOASIGNADOID == 2 || $body_data->foliorow[0]->INSTITUCIONREMISIONMUNICIPIOID	== 2) { ?>
			eliminarUMAByMunicipio("MEXICALI");
		<?php } else if ($body_data->foliorow[0]->MUNICIPIOASIGNADOID == 7 || $body_data->foliorow[0]->INSTITUCIONREMISIONMUNICIPIOID	== 7) { ?>
			eliminarUMAByMunicipio("MEXICALI - SAN FELIPE");
		<?php } else if ($body_data->foliorow[0]->MUNICIPIOASIGNADOID == 4 || $body_data->foliorow[0]->INSTITUCIONREMISIONMUNICIPIOID	== 4) { ?>
			for (var i = options.length - 1; i >= 0; i--) {
				var option = options[i];
				var value = option.value;
				if (!value.includes("ZONA COSTA - LA MESA") && !value.includes("ZONA COSTA - MARIANO MATAMOROS") && !value.includes("ZONA COSTA - ZONA RIO")) {
					option.parentNode.removeChild(option);
				}
			}
		<?php } else if ($body_data->foliorow[0]->MUNICIPIOASIGNADOID == 5 || $body_data->foliorow[0]->INSTITUCIONREMISIONMUNICIPIOID	== 5) { ?>
			eliminarUMAByMunicipio("ZONA COSTA - PLAYAS ROSARITO");
		<?php } else if ($body_data->foliorow[0]->MUNICIPIOASIGNADOID == 3 || $body_data->foliorow[0]->INSTITUCIONREMISIONMUNICIPIOID	== 3) { ?>
			eliminarUMAByMunicipio("ZONA COSTA - TECATE");
		<?php } ?>

		function eliminarUMAByMunicipio(uma) {
			for (var i = options.length - 1; i >= 0; i--) {
				var option = options[i];
				var value = option.value;
				if (!value.includes(uma)) {
					option.parentNode.removeChild(option);
				}
			}
		}


		// for (var i = 0; i < options.length; i++) {
		// 	var option = options[i];
		// 	var value = option.value;
		// 	if (!value.includes("MEXICALI")) {

		// 	}
		// }

		// var toolbarOptions = [
		// 	['bold', 'italic', 'underline', 'strike'],
		// 	['blockquote', 'code-block'],
		// 	[{
		// 		'header': 1
		// 	}, {
		// 		'header': 2
		// 	}],
		// 	[{
		// 		'list': 'ordered'
		// 	}, {
		// 		'list': 'bullet'
		// 	}],
		// 	[{
		// 		'script': 'sub'
		// 	}, {
		// 		'script': 'super'
		// 	}],
		// 	[{
		// 		'indent': '-1'
		// 	}, {
		// 		'indent': '+1'
		// 	}],
		// 	[{
		// 		'direction': 'rtl'
		// 	}],
		// 	[{
		// 		'size': ['small', false, 'large', 'huge']
		// 	}],
		// 	[{
		// 		'header': [1, 2, 3, 4, 5, 6, false]
		// 	}],
		// 	[{
		// 		'color': []
		// 	}, {
		// 		'background': []
		// 	}],
		// 	[{
		// 		'align': []
		// 	}],
		// 	['clean']
		// ];
		// var quill = new Quill('#documento', {
		// 	modules: {
		// 		toolbar: toolbarOptions,
		// 	},
		// 	theme: 'snow' // or 'bubble'
		// });
		var tiny = tinymce.init({
			selector: '#documento',
			width: 792,
			height: 800,
			// font_size_formats: '11pt',
			plugins: 'quickbars table image link lists advlist media autoresize code',
			toolbar: 'undo redo | blocks  fontsize | bold italic | alignleft aligncenter alignright alignjustify | indent outdent | bullist numlist | code',
		});
		var tiny2 = tinymce.init({
			selector: '#documento_editar',
			width: 792,
			height: 800,
			// font_size_formats: '11pt',
			plugins: 'quickbars table image link lists advlist media autoresize code',
			toolbar: 'undo redo | blocks  fontsize | bold italic | alignleft aligncenter alignright alignjustify | indent outdent | bullist numlist | code',
		});
		// var quill2 = new Quill('#documento_editar', {
		// 	modules: {
		// 		toolbar: toolbarOptions,
		// 	},
		// 	theme: 'snow' // or 'bubble'
		// });
		btn_actualizarFolioDoc.addEventListener('click', (event) => {
			let contenidoModificado = tinymce.get("documento_editar").getContent();
			actualizarDocumento(contenidoModificado);
		}, false);

		selectPlantilla.addEventListener("change", function() {
			if (plantilla.value == "CITATORIO") {
				document.getElementById("div_uma").style.display = "block";
				document.getElementById("div_proceso").style.display = "block";
				document.getElementById("div_noti").style.display = "block";

				document.querySelector('#uma_select').setAttribute('required', true);
				document.querySelector('#tiponotificacion_select').setAttribute('required', true);
				document.querySelector('#tipoproceso_select').setAttribute('required', true);
			} else {
				document.getElementById("div_uma").style.display = "none";
				document.getElementById("div_proceso").style.display = "none";
				document.getElementById("div_noti").style.display = "none";

				document.querySelector('#uma_select').setAttribute('required', false);
				document.querySelector('#tiponotificacion_select').setAttribute('required', false);
				document.querySelector('#tipoproceso_select').setAttribute('required', false);

			}

			if (plantilla.value != "CONSTANCIA DE EXTRAVÍO") {
				document.getElementById("involucrados").style.display = "block";
				select_imputado_documento.addEventListener("change", function() {
					// $('#documentos_modal_wyswyg').modal('hide');
					// $('#documentos_modal').modal('show');
					obtenerPlantillas(plantilla.value, select_victima_documento.value,
						select_imputado_documento.value);
				})

			} else {
				document.getElementById("involucrados").style.display = "none";
				document.getElementById("div_uma").style.display = "none";
				document.getElementById("div_noti").style.display = "none";
				document.getElementById("div_proceso").style.display = "none";
			}

		});


		function obtenerPlantillas(tipoPlantilla, victima, imputado) {


			<?php if (session('ROLID') == 4 || session('ROLID') == 8 || session('ROLID') == 10) { ?>
				console.log("victima");
				console.log(document.querySelector('#victima_modal_documento').value == '');

				if (tipoPlantilla == "CITATORIO") {
					if ((document.querySelector('#victima_modal_documento').value != '') && document.querySelector('#empleado_asignado').getAttribute('required') == "true" && document.querySelector('#empleado_asignado').value != '' && select_uma.getAttribute('required') == "true" && select_uma.value != '' && select_notificacion.getAttribute('required') == "true" && select_notificacion.value != '' && select_proceso.getAttribute('required') == "true" && select_proceso.value != '' && tipoPlantilla == 'CITATORIO') {
						$('#documentos_modal_wyswyg').modal('hide');
						$('#documentos_modal').modal('show');

					} else if ((document.querySelector('#victima_modal_documento').value == '') || (document.querySelector('#empleado_asignado').getAttribute('required') == "true" && document.querySelector('#empleado_asignado').value == '') || (select_uma.getAttribute('required') == "true" && select_uma.value == '') || (select_notificacion.getAttribute('required') == "true" && select_notificacion.value == '') || (select_proceso.getAttribute('required') == "true" && select_proceso.value == '') && tipoPlantilla == 'CITATORIO') {

						Swal.fire({
							icon: 'error',
							text: 'Favor de llenar los campos mostrados en la pantalla',
							confirmButtonColor: '#bf9b55',
						});
					} else if ((document.querySelector('#victima_modal_documento').value != '') && document.querySelector('#empleado_asignado').getAttribute('required') == "false" && document.querySelector('#empleado_asignado').value == '' && select_uma.getAttribute('required') == "true" && select_uma.value != '' && select_notificacion.getAttribute('required') == "true" && select_notificacion.value != '' && select_proceso.getAttribute('required') == "true" && select_proceso.value != '' && tipoPlantilla == 'CITATORIO') {
						$('#documentos_modal_wyswyg').modal('hide');
						$('#documentos_modal').modal('show');

					}

				} else {
					if (document.querySelector('#empleado_asignado').getAttribute('required') == "true" && document.querySelector('#empleado_asignado').value == '') {
						Swal.fire({
							icon: 'error',
							text: 'Favor de asignar a un Agente de Ministerio Público',
							confirmButtonColor: '#bf9b55',
						});
					} else if (document.querySelector('#empleado_asignado').getAttribute('required') == "true" && document.querySelector('#empleado_asignado').value != '') {
						$('#documentos_modal_wyswyg').modal('hide');
						$('#documentos_modal').modal('show');
					} else if (document.querySelector('#empleado_asignado').getAttribute('required') == "false" && document.querySelector('#empleado_asignado').value == '') {
						$('#documentos_modal_wyswyg').modal('hide');
						$('#documentos_modal').modal('show');
					}


				}




			<?php } else { ?>

				console.log("victima");
				console.log(document.querySelector('#victima_modal_documento').value == '');

				if (select_uma.getAttribute('required') == "true" && select_uma.value != '' && select_notificacion.getAttribute('required') == "true" && select_notificacion.value != '' && select_proceso.getAttribute('required') == "true" && select_proceso.value != '' && document.querySelector('#victima_modal_documento').value != '' && tipoPlantilla == 'CITATORIO') {
					$('#documentos_modal_wyswyg').modal('hide');
					$('#documentos_modal').modal('show');

				} else if ((document.querySelector('#victima_modal_documento').value == '') || (select_uma.getAttribute('required') == "true" && select_uma.value == '') || (document.querySelector('#victima_modal_documento').value == '') || (select_notificacion.getAttribute('required') == "true" && select_notificacion.value == '') || (select_proceso.getAttribute('required') == "true" && select_proceso.value == '') && tipoPlantilla == 'CITATORIO') {

					Swal.fire({
						icon: 'error',
						text: 'Favor de llenar los campos mostrados en la pantalla',
						confirmButtonColor: '#bf9b55',
					});
				}



				if (select_uma.getAttribute('required') == "false" && tipoPlantilla != 'CITATORIO') {
					$('#documentos_modal_wyswyg').modal('hide');
					$('#documentos_modal').modal('show');
				}
			<?php } ?>

			if (document.getElementById('uma_select').value) {
				const data = {
					'folio': <?php echo $_GET['folio'] ?>,
					'year': <?php echo $_GET['year'] ?>,
					'titulo': tipoPlantilla,
					'victima': victima,
					'imputado': imputado,
					'uma': document.getElementById('uma_select').value,
					'notificacion': select_notificacion.value,
					'proceso': select_proceso.value

				};
				console.log(data);
				$.ajax({
					method: 'POST',
					url: "<?= base_url('/data/get-plantilla') ?>",
					data: data,
					dataType: 'JSON',
					success: function(response) {
						console.log(response);
						if (response.status == 1) {
							const plantilla = response.plantilla;
							tinymce.get("documento").setContent(plantilla.PLACEHOLDER);
							// document.querySelector("#victima_modal_documento").value = '';
							// document.querySelector("#imputado_modal_documento").value = '';
							document.getElementById('uma_select').value = ''
							document.getElementById('tiponotificacion_select').value = ''
							document.getElementById('tipoproceso_select').value = ''

							document.getElementById("involucrados").style.display = "none";
							document.getElementById("div_uma").style.display = "none";
							document.getElementById("div_proceso").style.display = "none";
							document.getElementById("div_noti").style.display = "none";
						} else {
							tinymce.get("documento").setContent('PLANTILLA VACÍA O CON ERROR');
							// document.querySelector("#victima_modal_documento").value = '';
							// document.querySelector("#imputado_modal_documento").value = '';
							document.getElementById('uma_select').value = ''
							document.getElementById('tiponotificacion_select').value = ''
							document.getElementById('tipoproceso_select').value = ''
							document.getElementById("involucrados").style.display = "none";
							document.getElementById("div_uma").style.display = "none";
							document.getElementById("div_proceso").style.display = "none";
							document.getElementById("div_noti").style.display = "none";
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						// console.error(textStatus);
						tinymce.get("documento").setContent('PLANTILLA VACÍA O CON ERROR');
						// document.querySelector("#victima_modal_documento").value = '';
						// document.querySelector("#imputado_modal_documento").value = '';
						document.querySelector("#plantilla").value = '';
						document.getElementById('uma_select').value = ''
						document.getElementById('tiponotificacion_select').value = ''
						document.getElementById('tipoproceso_select').value = ''
						document.getElementById("div_proceso").style.display = "none";
						document.getElementById("div_noti").style.display = "none";
						document.getElementById("involucrados").style.display = "none";
						document.getElementById("div_uma").style.display = "none";

					}
				});
			} else {

				const data = {
					'folio': <?php echo $_GET['folio'] ?>,
					'year': <?php echo $_GET['year'] ?>,
					'titulo': tipoPlantilla,
					'victima': victima,
					'imputado': imputado,
				};
				console.log(data);
				$.ajax({
					method: 'POST',
					url: "<?= base_url('/data/get-plantilla') ?>",
					data: data,
					dataType: 'JSON',
					success: function(response) {
						console.log(response);
						if (response.status == 1) {
							const plantilla = response.plantilla;
							if (select_uma.getAttribute('required') == "true") {
								tinymce.get("documento").setContent(plantilla.PLACEHOLDER);
								// document.querySelector("#victima_modal_documento").value = '';
								// document.querySelector("#imputado_modal_documento").value = '';
								document.getElementById('uma_select').value = '';
								document.getElementById('tiponotificacion_select').value = ''
								document.getElementById('tipoproceso_select').value = ''
								document.getElementById("div_proceso").style.display = "none";
								document.getElementById("div_noti").style.display = "none";
							} else {
								tinymce.get("documento").setContent(plantilla.PLACEHOLDER);
								// document.querySelector("#victima_modal_documento").value = '';
								// document.querySelector("#imputado_modal_documento").value = '';
								document.getElementById('uma_select').value = ''
								document.getElementById("involucrados").style.display = "none";
								document.getElementById("div_uma").style.display = "none";
								document.getElementById('tiponotificacion_select').value = ''
								document.getElementById('tipoproceso_select').value = ''
								document.getElementById("div_proceso").style.display = "none";
								document.getElementById("div_noti").style.display = "none";
							}
						} else {
							if (select_uma.getAttribute('required') == "true") {
								tinymce.get("documento").setContent('PLANTILLA VACÍA O CON ERROR');
								// document.querySelector("#victima_modal_documento").value = '';
								// document.querySelector("#imputado_modal_documento").value = '';
								document.getElementById('uma_select').value = ''
								document.querySelector("#plantilla").value = '';
								document.getElementById('tiponotificacion_select').value = ''
								document.getElementById('tipoproceso_select').value = ''
								document.getElementById("div_proceso").style.display = "none";
								document.getElementById("div_noti").style.display = "none";
							} else {
								tinymce.get("documento").setContent('PLANTILLA VACÍA O CON ERROR');
								// document.querySelector("#victima_modal_documento").value = '';
								// document.querySelector("#imputado_modal_documento").value = '';
								document.getElementById('uma_select').value = ''
								document.querySelector("#plantilla").value = '';
								document.getElementById("involucrados").style.display = "none";
								document.getElementById("div_uma").style.display = "none";
								document.getElementById('tiponotificacion_select').value = ''
								document.getElementById('tipoproceso_select').value = ''
								document.getElementById("div_proceso").style.display = "none";
								document.getElementById("div_noti").style.display = "none";
							}
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						// console.log(jqXHR, textStatus, errorThrown);
						tinymce.get("documento").setContent('PLANTILLA VACÍA O CON ERROR');
						document.querySelector("#victima_modal_documento").value = '';
						document.querySelector("#imputado_modal_documento").value = '';
						document.querySelector("#plantilla").value = '';
						document.getElementById('uma_select').value = ''
						document.getElementById("involucrados").style.display = "none";
						document.getElementById("div_uma").style.display = "none";
						document.getElementById('tiponotificacion_select').value = ''
						document.getElementById('tipoproceso_select').value = ''
						document.getElementById("div_proceso").style.display = "none";
						document.getElementById("div_noti").style.display = "none";
					}
				});
			}



		}
		btn_guardarFolioDoc.addEventListener('click', (event) => {
			let contenidoModificado = tinymce.get("documento").getContent();
			// console.log(plantilla.value);
			insertarDocumento(contenidoModificado, plantilla.value);
		}, false);

		function insertarDocumento(contenido, tipoPlantilla) {
			<?php if ($body_data->foliorow[0]->TIPODENUNCIA == "DA") { ?>
				Swal.fire({
					title: 'Este documento no será enviado',
					showDenyButton: true,
					showCancelButton: false,
					confirmButtonText: 'Confirmar',
					confirmButtonColor: '#bf9b55',
				}).then((result) => {
					/* Read more about isConfirmed, isDenied below */


					if (result.isConfirmed) {
						if (isParameterByName('expediente')) {

							const data = {
								'folio': getParameterByName('folio'),
								'expediente': getParameterByName('expediente'),
								'year': getParameterByName('year'),
								'placeholder': contenido,
								'titulo': tipoPlantilla,
								'statusenvio': 0,
								'agente_asignado': document.querySelector('#empleado_asignado').value,
								'victimaid': document.querySelector('#victima_modal_documento').value,
								'imputado': document.querySelector('#imputado_modal_documento').value,


							};
							insertarDoc(data);
						} else {
							const data = {
								'folio': getParameterByName('folio'),
								'year': getParameterByName('year'),
								'placeholder': contenido,
								'titulo': tipoPlantilla,
								'statusenvio': 0,
								'agente_asignado': document.querySelector('#empleado_asignado').value,
								'victimaid': document.querySelector('#victima_modal_documento').value,
								'imputado': document.querySelector('#imputado_modal_documento').value,

							};
							insertarDoc(data);
						}
					}
				})
			<?php } else { ?>
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
						if (isParameterByName('expediente')) {
							const data = {
								'folio': getParameterByName('folio'),
								'expediente': getParameterByName('expediente'),
								'year': getParameterByName('year'),
								'placeholder': contenido,
								'titulo': tipoPlantilla,
								'statusenvio': 1,
								'agente_asignado': document.querySelector('#empleado_asignado').value,
								'victimaid': document.querySelector('#victima_modal_documento').value,
								'imputado': document.querySelector('#imputado_modal_documento').value,

							};
							insertarDoc(data);
						} else {
							const data = {
								'folio': getParameterByName('folio'),
								'year': getParameterByName('year'),
								'placeholder': contenido,
								'titulo': tipoPlantilla,
								'statusenvio': 1,
								'agente_asignado': document.querySelector('#empleado_asignado').value,
								'victimaid': document.querySelector('#victima_modal_documento').value,
								'imputado': document.querySelector('#imputado_modal_documento').value,

							};
							insertarDoc(data);

						}
					} else {
						if (isParameterByName('expediente')) {
							const data = {
								'folio': getParameterByName('folio'),
								'expediente': getParameterByName('expediente'),
								'year': getParameterByName('year'),
								'placeholder': contenido,
								'titulo': tipoPlantilla,
								'statusenvio': 0,
								'agente_asignado': document.querySelector('#empleado_asignado').value,
								'victimaid': document.querySelector('#victima_modal_documento').value,
								'imputado': document.querySelector('#imputado_modal_documento').value,

							};
							insertarDoc(data);
						} else {
							const data = {
								'folio': getParameterByName('folio'),
								'year': getParameterByName('year'),
								'placeholder': contenido,
								'titulo': tipoPlantilla,
								'statusenvio': 0,
								'agente_asignado': document.querySelector('#empleado_asignado').value,
								'victimaid': document.querySelector('#victima_modal_documento').value,
								'imputado': document.querySelector('#imputado_modal_documento').value,

							};
							insertarDoc(data);

						}

					}
				})
			<?php } ?>

		}

		function insertarDoc(data) {
			$.ajax({
				data: data,
				url: "<?= base_url('/admin/dashboard/insert-documentosWSYWSG') ?>",
				method: "POST",
				dataType: "json",
				success: function(response) {


					if (response.status == 1) {
						tinymce.get("documento").setContent('');
						document.querySelector("#victima_modal_documento").value = '';
						document.querySelector("#imputado_modal_documento").value = '';
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
					} else {
						Swal.fire({
							icon: 'error',
							text: 'Documento no agregado',
							confirmButtonColor: '#bf9b55',
						});
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
					// console.log(response);
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
						document.querySelector('#password_modalLabel').classList.remove(
							'd-none');
						document.querySelector('#loading').classList.add('d-none');
						document.querySelector('#password_verifying').classList.add('d-none');
						btn_firmar_doc.disabled = false;

					}
				},

				error: function(jqXHR, textStatus, errorThrown) {}
			});
		}, false);

		var btn_firmar_doc_id = document.querySelector('#firmar_documento_modal_id');
		btn_firmar_doc_id.addEventListener('click', (event) => {
			$.ajax({
				data: {
					'folio_id': document.querySelector('#folio_id').value,
					'documento_id': document.querySelector('#documento_id').value,
					'contrasena_doc': document.querySelector('#contrasena_doc').value,
					'year_doc': document.querySelector('#year_doc').value,
				},
				url: "<?= base_url('/admin/dashboard/firmar_documentos_id') ?>",
				method: "POST",
				dataType: "json",
				beforeSend: function() {
					document.querySelector('#load_doc').classList.add('d-none');
					document.querySelector('#password_modalLabel_doc_id').classList.add('d-none');
					document.querySelector('#loading_doc_id').classList.remove('d-none');
					document.querySelector('#password_verifying_doc_id').classList.remove('d-none');
					btn_firmar_doc_id.disabled = true;
				},
				success: function(response) {
					// console.log(response);
					if (response.status == 1) {

						Swal.fire({
							icon: 'success',
							text: 'Documento firmado correctamente',
							confirmButtonColor: '#bf9b55',
						});
						document.querySelector('#contrasena_doc').value = '';
						$('#contrasena_modal_doc_id').modal('hide');
						location.reload();

					} else if (response.status == 0) {

						Swal.fire({
							icon: 'error',
							text: response.message_error,
							confirmButtonColor: '#bf9b55',
						});
						document.querySelector('#load_doc').classList.remove('d-none');
						document.querySelector('#password_modalLabel_doc_id').classList.remove(
							'd-none');
						document.querySelector('#loading_doc_id').classList.add('d-none');
						document.querySelector('#password_verifying_doc_id').classList.add('d-none');
						btn_firmar_doc_id.disabled = false;

					}
				},

				error: function(jqXHR, textStatus, errorThrown) {}
			});
		}, false);
		btn_enviarcorreoDoc.addEventListener('click', (event) => {
			const data = {
				'send_mail_select': document.querySelector('#send_mail_select').value,
				'expediente_modal_correo': getParameterByName('expediente'),
				'year_modal_correo': getParameterByName('year'),
				'folio': getParameterByName('folio'),

			};
			$.ajax({
				data: data,
				url: "<?= base_url('/admin/dashboard/send-documentos-correo') ?>",
				method: "POST",
				dataType: "json",
				beforeSend: function() {
					document.querySelector('#load_mail').classList.add('d-none');
					document.querySelector('#enviar_modalLabel').classList.add('d-none');
					document.querySelector('#loading_mail').classList.remove('d-none');
					document.querySelector('#password_verifying_mail').classList.remove(
						'd-none');
					btn_enviarcorreoDoc.disabled = true;
				},
				success: function(response) {
					console.log(response);
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
						document.querySelector('#password_verifying_mail').classList.add(
							'd-none');
						btn_enviarcorreoDoc.disabled = false;
						location.reload();

					} else if (response.status == 2) {
						Swal.fire({
							icon: 'error',
							text: 'No hay documentos a enviar',
							confirmButtonColor: '#bf9b55',
						});
						$('#sendEmailDocModal').modal('hide');
						document.querySelector('#load_mail').classList.remove('d-none');
						document.querySelector('#enviar_modalLabel').classList.remove('d-none');
						document.querySelector('#loading_mail').classList.add('d-none');
						document.querySelector('#password_verifying_mail').classList.add(
							'd-none');
						btn_enviarcorreoDoc.disabled = false;
					} else if (response.status == 3) {
						Swal.fire({
							icon: 'error',
							text: 'Debes seleccionar un correo para enviar',
							confirmButtonColor: '#bf9b55',
						});
						$('#sendEmailDocModal').modal('hide');
						document.querySelector('#load_mail').classList.remove('d-none');
						document.querySelector('#enviar_modalLabel').classList.remove('d-none');
						document.querySelector('#loading_mail').classList.add('d-none');
						document.querySelector('#password_verifying_mail').classList.add(
							'd-none');
						btn_enviarcorreoDoc.disabled = false;
					} else {
						Swal.fire({
							icon: 'error',
							text: 'No fue posible enviar los documentos',
							confirmButtonColor: '#bf9b55',
						});
						$('#sendEmailDocModal').modal('hide');
						document.querySelector('#load_mail').classList.remove('d-none');
						document.querySelector('#enviar_modalLabel').classList.remove('d-none');
						document.querySelector('#loading_mail').classList.add('d-none');
						document.querySelector('#password_verifying_mail').classList.add(
							'd-none');
						btn_enviarcorreoDoc.disabled = false;
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.error(jqXHR, textStatus, errorThrown);
					Swal.fire({
						icon: 'error',
						text: 'No fue posible enviar los documentos',
						confirmButtonColor: '#bf9b55',
					});
					$('#sendEmailDocModal').modal('hide');
					document.querySelector('#load_mail').classList.remove('d-none');
					document.querySelector('#enviar_modalLabel').classList.remove('d-none');
					document.querySelector('#loading_mail').classList.add('d-none');
					document.querySelector('#password_verifying_mail').classList.add(
						'd-none');
					btn_enviarcorreoDoc.disabled = false;
				}
			});


		}, false);
		btn_enviarcorreoDocUni.addEventListener('click', (event) => {
			const data = {
				'send_mail_select': document.querySelector('#send_mail_select_uni').value,
				'expediente_modal_correo': getParameterByName('expediente'),
				'year_modal_correo': document.querySelector("#year_modal_correo_uni").value,
				'folio': document.querySelector("#folio_modal_correo_uni").value,
				'folio_doc': document.querySelector("#foliodoc_modal_correo_uni").value
			};

			$.ajax({
				data: data,
				url: "<?= base_url('/admin/dashboard/send-documentos-correo-by-id') ?>",
				method: "POST",
				dataType: "json",
				beforeSend: function() {
					document.querySelector('#load_mail_uni').classList.add('d-none');
					document.querySelector('#enviar_modalLabelUni').classList.add('d-none');
					document.querySelector('#loading_mail_uni').classList.remove('d-none');
					document.querySelector('#password_verifying_mail_uni').classList.remove(
						'd-none');
					btn_enviarcorreoDocUni.disabled = true;
				},
				success: function(response) {
					console.log(response);
					if (response.status == 1) {
						Swal.fire({
							icon: 'success',
							text: 'Documento enviado correctamente.',
							confirmButtonColor: '#bf9b55',
						});
						$('#sendEmailDocModalUni').modal('hide');
						document.querySelector('#load_mail_uni').classList.remove('d-none');
						document.querySelector('#enviar_modalLabelUni').classList.remove('d-none');
						document.querySelector('#loading_mail_uni').classList.add('d-none');
						document.querySelector('#password_verifying_mail_uni').classList.add(
							'd-none');
						btn_enviarcorreoDocUni.disabled = false;
						location.reload();

					} else if (response.status == 2) {
						Swal.fire({
							icon: 'error',
							text: 'No hay documentos a enviar',
							confirmButtonColor: '#bf9b55',
						});
						$('#sendEmailDocModalUni').modal('hide');
						document.querySelector('#load_mail_uni').classList.remove('d-none');
						document.querySelector('#enviar_modalLabelUni').classList.remove('d-none');
						document.querySelector('#loading_mail_uni').classList.add('d-none');
						document.querySelector('#password_verifying_mail_uni').classList.add(
							'd-none');
						btn_enviarcorreoDocUni.disabled = false;
					} else if (response.status == 3) {
						Swal.fire({
							icon: 'error',
							text: 'Debes seleccionar un correo para enviar',
							confirmButtonColor: '#bf9b55',
						});
						$('#sendEmailDocModal').modal('hide');
						document.querySelector('#load_mail').classList.remove('d-none');
						document.querySelector('#enviar_modalLabel').classList.remove('d-none');
						document.querySelector('#loading_mail').classList.add('d-none');
						document.querySelector('#password_verifying_mail').classList.add(
							'd-none');
						btn_enviarcorreoDoc.disabled = false;
					} else {
						Swal.fire({
							icon: 'error',
							text: 'No fue posible enviar el documento',
							confirmButtonColor: '#bf9b55',
						});
						$('#sendEmailDocModal').modal('hide');
						document.querySelector('#load_mail').classList.remove('d-none');
						document.querySelector('#enviar_modalLabel').classList.remove('d-none');
						document.querySelector('#loading_mail').classList.add('d-none');
						document.querySelector('#password_verifying_mail').classList.add(
							'd-none');
						btn_enviarcorreoDoc.disabled = false;
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					Swal.fire({
						icon: 'error',
						text: 'No fue posible enviar el documento',
						confirmButtonColor: '#bf9b55',
					});
					$('#sendEmailDocModal').modal('hide');
					document.querySelector('#load_mail').classList.remove('d-none');
					document.querySelector('#enviar_modalLabel').classList.remove('d-none');
					document.querySelector('#loading_mail').classList.add('d-none');
					document.querySelector('#password_verifying_mail').classList.add(
						'd-none');
					btn_enviarcorreoDoc.disabled = false;
				}
			});


		}, false);

		btn_archivos_externos.addEventListener('click', (event) => {
			$('#subirDocumentosModal').modal('show');
			$('#subirDocumentosModal').show();
			if (isParameterByName('expediente')) {

				const data = {
					'folio': getParameterByName('folio'),
					'expediente': getParameterByName('expediente'),
					'year': getParameterByName('year'),
				};
				$.ajax({
					data: data,
					url: "<?= base_url('/data/save-archivos-externos') ?>",
					method: "POST",
					dataType: "json",
					beforeSend: function() {
						document.querySelector('#loading_sub_doc').classList.remove('d-none');
						document.querySelector('#verifying_documentos').classList.remove('d-none');
						btn_archivos_externos.disabled = true;
					},
					success: function(response) {
						// console.log(response);
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
						} else if (response.status == 4) {
							Swal.fire({
								icon: 'error',
								text: "Hay archivos sin firmar",
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
			}
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
				var btn =
					`<button type='button'  class='btn btn-primary my-2 btn-sm' onclick='viewDocumento(${documentos[i].FOLIODOCID})' disabled><i class="fas fa-edit"></i></button>`

				var btnFirmar =
					`<button type='button'  class='btn btn-primary my-2 btn-sm' onclick='firmarDocumento(${documentos[i].FOLIODOCID})' disabled><i class="fas fa-signature"></i></button>`
				var btnpdf = `<form class="d-inline-block" method="POST" action="<?php echo base_url('/data/download-pdf-documento') ?>">
													<input type="text" class="form-control" name="folio" value="<?= $_GET['folio'] ?>" hidden>
													<input type="text" class="form-control" name="year" value="<?= $_GET['year'] ?>" hidden>
													<input type="text" class="form-control" name="docid" value="${documentos[i].FOLIODOCID}" hidden>

													<button type="submit" class="btn btn-primary my-2 btn-sm">
														PDF
													</button>
												</form>`
				var btnxml = `<form class="d-inline-block" method="POST" action="<?php echo base_url('/data/download-xml-documento') ?>">
													<input type="text" class="form-control" name="folio" value="<?= $_GET['folio'] ?>" hidden>
													<input type="text" class="form-control" name="year" value="<?= $_GET['year'] ?>" hidden>
													<input type="text" class="form-control" name="docid" value="${documentos[i].FOLIODOCID}" hidden>

													<button type="submit" class="btn btn-primary my-2 btn-sm">
														XML
													</button>
												</form>`
				var btnCambiarStatus = `<button type='button'  class='btn btn-primary my-2 btn-sm' onclick='cambiarStatusDoc(${documentos[i].FOLIODOCID}, ${documentos[i].STATUSENVIO}, "${documentos[i].ENVIADO}", ${documentos[i].FOLIOID}, ${documentos[i].ANO})'><i class="fas fa-dice"></i></button>`
				var btnEnviar = `<button type='button'  class='btn btn-primary my-2 btn-sm' onclick='firmarUnitarioModal(${documentos[i].FOLIODOCID},${documentos[i].FOLIOID}, ${documentos[i].ANO})'><i class="fas fa-paper-plane"></i></button>`
				var btnAsignarEncargado = `<button type='button'  class='btn btn-primary my-2 btn-sm' onclick='asignarEncargado(${documentos[i].FOLIODOCID},${documentos[i].FOLIOID}, ${documentos[i].ANO})' disabled><i class="fas fa-user-tag"></i></button>`
				var btnAsignarAgente = `<button type='button'  class='btn btn-primary my-2 btn-sm' onclick='asignarAgente(${documentos[i].FOLIODOCID},${documentos[i].FOLIOID}, ${documentos[i].ANO})' disabled><i class="fas fa-user-tag"></i></button>`

			} else {
				var btn =
					`<button type='button'  class='btn btn-primary my-2 btn-sm' onclick='viewDocumento(${documentos[i].FOLIODOCID})'><i class="fas fa-edit"></i></button>`
				var btnpdf = `<form class="d-inline-block" method="POST" action="<?php echo base_url('/data/download-pdf-documento') ?>">
													<input type="text" class="form-control" name="folio" value="<?= $_GET['folio'] ?>" hidden>
													<input type="text" class="form-control" name="year" value="<?= $_GET['year'] ?>" hidden>
													<input type="text" class="form-control" name="docid" value="${documentos[i].FOLIODOCID}" hidden>

													<button type="submit" class="btn btn-primary my-2 btn-sm" disabled>
														PDF
													</button>
												</form>`
				var btnxml = `<form class="d-inline-block" method="POST" action="<?php echo base_url('/data/download-xml-documento') ?>">
													<input type="text" class="form-control" name="folio" value="<?= $_GET['folio'] ?>" hidden>
													<input type="text" class="form-control" name="year" value="<?= $_GET['year'] ?>" hidden>
													<input type="text" class="form-control" name="docid" value="${documentos[i].FOLIODOCID}" hidden>

													<button type="submit" class="btn btn-primary my-2 btn-sm" disabled>
														XML
													</button>
												</form>`
				var btnFirmar =
					`<button type='button'  class='btn btn-primary my-2 btn-sm' onclick='firmarDocumento(${documentos[i].FOLIOID}, ${documentos[i].ANO}, ${documentos[i].FOLIODOCID})'><i class="fas fa-signature"></i></button>`
				var btnCambiarStatus = `<button type='button'  class='btn btn-primary my-2 btn-sm' onclick='cambiarStatusDoc(${documentos[i].FOLIODOCID}, ${documentos[i].STATUSENVIO}, "${documentos[i].ENVIADO}", ${documentos[i].FOLIOID}, ${documentos[i].ANO})'><i class="fas fa-dice"></i></button>`
				var btnEnviar = `<button type='button'  class='btn btn-primary my-2 btn-sm' onclick='firmarUnitarioModal(${documentos[i].FOLIODOCID},${documentos[i].FOLIOID}, ${documentos[i].ANO})' disabled><i class="fas fa-paper-plane"></i></button>`
				var btnAsignarEncargado = `<button type='button'  class='btn btn-primary my-2 btn-sm' onclick='asignarEncargado(${documentos[i].FOLIODOCID},${documentos[i].FOLIOID}, ${documentos[i].ANO})'><i class="fas fa-user-tag"></i></button>`
				var btnAsignarAgente = `<button type='button'  class='btn btn-primary my-2 btn-sm' onclick='asignarAgente(${documentos[i].FOLIODOCID},${documentos[i].FOLIOID}, ${documentos[i].ANO})'><i class="fas fa-user-tag"></i></button>`

			}
			var btnBorrar = '';
			var asignados = 'SIN AGENTE O ENCARGADO ASIGNADO';
			if (documentos[i].ENVIADO == 'N') {
				btnBorrar =
					`<button type='button'  class='btn btn-primary my-2 btn-sm' onclick='borrarDocumento(${documentos[i].FOLIOID}, ${documentos[i].ANO}, ${documentos[i].FOLIODOCID})'><i class="fas fa-trash"></i></button>`
			}
			if (documentos[i].ENCARGADO_NOMBRE) {
				asignados =
					documentos[i].ENCARGADO_NOMBRE + ' ' +
					documentos[i].AP_ENCARGADO + ' ' +
					documentos[i].AM_ENCARGADO;
			} else if (documentos[i].AGENTE_NOMBRE) {
				asignados = documentos[i].AGENTE_NOMBRE + ' ' + documentos[i].AP_AGENTE + ' ' + documentos[i].AM_AGENTE;
			}
			var fila =
				`<tr id="row${i}">` +
				`<td class="text-center">${documentos[i].TIPODOC}</td>` +
				`<td class="text-center">${documentos[i].STATUS}</td>` +
				`<td class="text-center">${documentos[i].AGENTER_NOMBRE} ${documentos[i].AGENTER_AP} ${documentos[i].AGENTER_AM}</td>` +
				`<td class="text-center">${asignados} </td>` +
				`<td class="text-center">${btnAsignarAgente}</td>` +
				`<td class="text-center">${btnAsignarEncargado}</td>` +
				`<td class="text-center">${btn} ${btnpdf} ${btnxml} ${btnFirmar} ${btnCambiarStatus} ${btnEnviar} ${btnBorrar}</td>` +
				`</tr>`;

			$('#table-documentos tr:first').after(fila);
			$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
			var nFilas = $("#documentos tr").length;
			$("#adicionados").append(nFilas - 1);
		}
	}

	function asignarAgente(documento, folio, ano) {
		$('#asignarAgenteModal').modal('show');
		const btn_asignar_agente = document.querySelector('#enviarAgente');

		btn_asignar_agente.addEventListener('click', (e) => {
			btn_asignar_agente.disabled = true;
			$.ajax({
				data: {
					'foliodocid': documento,
					'folio': folio,
					'year': ano,
					'agenteid': document.querySelector('#selectAgente').value
				},
				url: "<?= base_url('/data/update-agente-asignado') ?>",
				method: "POST",
				dataType: "json",
				success: function(response) {
					const documentos = response.documentos;
					if (response.status == 1) {
						btn_asignar_agente.disabled = false;
						let tabla_documentos = document.querySelectorAll('#table-documentos tr');
						tabla_documentos.forEach(row => {
							if (row.id !== '') {
								row.remove();
							}
						});
						llenarTablaDocumentos(documentos);

						Swal.fire({
							icon: 'success',
							text: 'Agente asignado correctamente',
							confirmButtonColor: '#bf9b55',
						});
						$('#asignarAgenteModal').modal('hide');
					}

				},
				error: function(jqXHR, textStatus, errorThrown) {
					btn_asignar_agente.disabled = false;

				}
			});
		});

	}

	function asignarEncargado(documento, folio, ano) {
		$('#encargadosModal').modal('show');
		const btn_asignar_encargado = document.querySelector('#enviarEncargado');

		btn_asignar_encargado.addEventListener('click', (e) => {
			btn_asignar_encargado.disabled = true;
			$.ajax({
				data: {
					'foliodocid': documento,
					'folio': folio,
					'year': ano,
					'encargadoid': document.querySelector('#selectEncargado').value
				},
				url: "<?= base_url('/data/update-encargado') ?>",
				method: "POST",
				dataType: "json",
				success: function(response) {
					const documentos = response.documentos;
					if (response.status == 1) {
						btn_asignar_encargado.disabled = false;
						let tabla_documentos = document.querySelectorAll('#table-documentos tr');
						tabla_documentos.forEach(row => {
							if (row.id !== '') {
								row.remove();
							}
						});
						llenarTablaDocumentos(documentos);

						Swal.fire({
							icon: 'success',
							text: 'Encargado asignado correctamente',
							confirmButtonColor: '#bf9b55',
						});
						$('#encargadosModal').modal('hide');
					}

				},
				error: function(jqXHR, textStatus, errorThrown) {
					btn_asignar_encargado.disabled = false;

				}
			});
		});

	}

	function firmarDocumento(folio, ano, foliodocid) {
		document.querySelector('#folio_id').value = folio;
		document.querySelector('#documento_id').value = foliodocid;
		document.querySelector('#year_doc').value = ano;
		$('#contrasena_modal_doc_id').modal('show');

	}

	function firmarUnitarioModal(foliodocid, folio, ano) {

		$('#sendEmailDocModalUni').modal('show');
		document.querySelector("#foliodoc_modal_correo_uni").value = foliodocid;
		document.querySelector("#folio_modal_correo_uni").value = folio;
		document.querySelector("#year_modal_correo_uni").value = ano;

	}

	function cambiarStatusDoc(foliodocid, status_envio, enviado, folio, ano) {

		$('#change_status_modal').modal('show');
		document.querySelector("#status_doc_envio").value = status_envio;
		document.querySelector("#status_req_envio").value = enviado;
		console.log(enviado);
		document.querySelector("#status_doc_id").value = foliodocid;
		document.querySelector("#folio_id_doc").value = folio;
		document.querySelector("#ano_doc").value = ano;

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
					// var toolbarOptions = [
					// 	['bold', 'italic', 'underline', 'strike'],
					// 	['blockquote', 'code-block'],
					// 	[{
					// 		'header': 1
					// 	}, {
					// 		'header': 2
					// 	}],
					// 	[{
					// 		'list': 'ordered'
					// 	}, {
					// 		'list': 'bullet'
					// 	}],
					// 	[{
					// 		'script': 'sub'
					// 	}, {
					// 		'script': 'super'
					// 	}],
					// 	[{
					// 		'indent': '-1'
					// 	}, {
					// 		'indent': '+1'
					// 	}],
					// 	[{
					// 		'direction': 'rtl'
					// 	}],
					// 	[{
					// 		'size': ['small', false, 'large', 'huge']
					// 	}],
					// 	[{
					// 		'header': [1, 2, 3, 4, 5, 6, false]
					// 	}],
					// 	[{
					// 		'color': []
					// 	}, {
					// 		'background': []
					// 	}],
					// 	[{
					// 		'align': []
					// 	}],
					// 	['clean']
					// ];
					// var quill2 = new Quill('#documento_editar', {
					// 	modules: {
					// 		toolbar: toolbarOptions,
					// 	},
					// 	theme: 'snow'
					// });
					tinymce.get("documento_editar").setContent(documento_id);
					// quill2.root.innerHTML = documento_id;
					document.querySelector('#docid').value = foliodocid;

				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus);
			}
		});
	}

	function getParameterByName(name, url = window.location.href) {
		name = name.replace(/[\[\]]/g, "\\$&");
		var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
			results = regex.exec(url);
		if (!results) return null;
		if (!results[2]) return '';
		return decodeURIComponent(results[2].replace(/\+/g, " "));
	}

	function remitir() {
		window.location.href = `<?= base_url('/admin/dashboard/bandeja_remision?folio=') ?>${getParameterByName('folio')}&year=${getParameterByName('year')}&municipioasignado=${getParameterByName('municipioasignado')}&expediente=${getParameterByName('expediente')}`;
	}

	function borrarDocumento(folio, ano, foliodocid) {
		Swal.fire({
			title: '¿Estas seguro de eliminar el documento?',
			text: "¡Esta operacion es irevertible!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#bf9b55',
			confirmButtonText: '¡Si, eliminar!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					data: {
						'docid': foliodocid,
						'folio': <?php echo $_GET['folio'] ?>,
						'year': <?php echo $_GET['year'] ?>,
					},
					url: "<?= base_url('/data/delete-documento') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						if (response.status == 1) {
							Swal.fire(
								'Documento eliminado',
								'El documento se ha eliminado correctamente.',
								'success'
							).then(
								location.reload()
							)
						} else {
							Swal.fire(
								'¡Borrar!',
								'El documento no se elimino.',
								'error'
							).then(
								location.reload()
							)
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus);
						Swal.fire(
							'¡Borrar!',
							'El documento no se elimino.',
							'error'
						).then(
							location.reload()
						)
					}
				});
			}
		})
	}
</script>

<?= $this->endSection() ?>
