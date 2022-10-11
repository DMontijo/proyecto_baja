<?= $this->extend('admin/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php include('modal_validation_password_doc.php') ?>
<?php include('app/Views/admin/dashboard/video_denuncia_modals/documentos_modal.php') ?>
<?php include 'app/Views/admin/dashboard/video_denuncia_modals/documentos_modal_editar.php' ?>
<?php include 'app/Views/admin/dashboard/video_denuncia_modals/documentos_modal_wyswyg.php' ?>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<button type="button" class="btn btn-primary mb-3" data-toggle="modal" id="firmarDocumento" data-target="#contrasena_modal_doc"><i class="fas fa-file-signature"></i> Firmar documento</button>
				<button type="button" class="btn btn-primary mb-3" data-toggle="modal" id="generarDocumento" data-target="#documentos_modal_wyswyg"><i class="fas fa-file-signature"></i> Agregar documentos</button>
				<button type="button" class="btn btn-primary mb-3" data-toggle="modal" id="generarDocumento" data-target="#documentos_generados_modal_v"><i class="fas fa-file-signature"></i> Editar documentos</button>

				<?php
				foreach ($body_data->documentos as $key => $documento) { ?>

					<h5 class="card-title"><?php echo $documento->TIPODOC ?></h5>
					<div class="card shadow border-0">
						<div class="card-body" name="document" id="document" style="margin: 2%;">
							<div class="card-text" id="documentos-show-edit-<?= $key?>" name="documentos-show-edit" data-id="<?= $documento->FOLIODOCID ?>">
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
	var selectPlantilla = document.querySelector('#plantilla');
	let plantilla = document.querySelector("#plantilla");
	var btn_guardarFolioDoc = document.querySelector('#guardarFolioDoc');
	var btn_actualizarFolioDocGen = document.querySelector('#actualizarFolioDocGenerado');

	// console.log(array_documento);
	let ciclo = <?php echo count($body_data->documentos) ?>;
	var quill = new Quill('#documento', {
		theme: 'snow'
	});


	for (let index = 0; index < ciclo; index++) {

		var quill2 = new Quill('#documentos-show-edit-' + index, {
			theme: 'snow',
			
		});
	// 	// var edit = document.getElementById('documentos-show-edit-' + index);
	// 	// var data_id_valor = edit.getAttribute('data-id');	
	}

	// 	let contenidoModificado = quill2.container.firstChild.innerHTML;

	// 	// btn_actualizarFolioDocGen.addEventListener('click', (event) => {
	// 	// 	alert(index);
	// 	// // 	let contenidoModificado = quill2.container.firstChild.innerHTML;

	// 		// actualizarDocumento(data_id_valor, contenidoModificado);
	// 	// }, false);
	// }




	selectPlantilla.addEventListener("change", function() {
		$('#documentos_modal_wyswyg').modal('hide');
		$('#documentos_modal').modal('show');


		obtenerPlantillas(plantilla.value);

	});



	function obtenerPlantillas(tipoPlantilla) {

		const data = {

			'expediente': <?php echo $_GET['expediente'] ?>,
			'year': <?php echo $_GET['year'] ?>,
			'titulo': tipoPlantilla,
		};
		$.ajax({
			method: 'POST',
			url: "<?= base_url('/data/get-plantilla') ?>",
			data: data,
			dataType: 'JSON',
			success: function(response) {
				const plantillas = response.plantilla;
				quill.root.innerHTML = plantillas.PLACEHOLDER;


			},
		});
	}
	btn_guardarFolioDoc.addEventListener('click', (event) => {
		let contenidoModificado = quill.container.firstChild.innerHTML;
		insertarDocumento(contenidoModificado, plantilla.value);
	}, false);
	// btn_actualizarFolioDocGen.addEventListener('click', (event) => {
	// 	alert("hola");
	// 	let contenidoModificado = quill2.container.firstChild.innerHTML;

	// 	// actualizarDocumento(contenidoModificado);
	// }, false);

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
			success: function(response) {
				if (response.status == 1) {

					Swal.fire({
						icon: 'success',
						text: 'Documento firmado correctamente',
						confirmButtonColor: '#bf9b55',
					});
					document.querySelector('#contrasena').value = '';
					$('#contrasena_modal_doc').modal('hide');

				}
			},
			error: function(jqXHR, textStatus, errorThrown) {}
		});
	}, false);

	function actualizarDocumento(data_id_valor, placeholder) {

		console.log(data_id_valor);
		console.log(placeholder);

		// const data = {
		// 	'folio': <?php echo $_GET['folio'] ?>,
		// 	'year': <?php echo $_GET['folio'] ?>,
		// 	'foliodocid': data_id_valor,
		// 	'placeholder': placeholder
		// };
		// $.ajax({
		// 	data: data,
		// 	url: "<?= base_url('/data/update-documento-by-id') ?>",
		// 	method: "POST",
		// 	dataType: "json",
		// 	success: function(response) {
		// 		if (response.status == 1) {
		// 			Swal.fire({
		// 				icon: 'success',
		// 				text: 'Documento actualizado correctamente',
		// 				confirmButtonColor: '#bf9b55',
		// 			});
		// 		} else {
		// 			Swal.fire({
		// 				icon: 'error',
		// 				text: 'No se actualizó el documento',
		// 				confirmButtonColor: '#bf9b55',
		// 			});
		// 		}
		// 	},
		// 	error: function(jqXHR, textStatus, errorThrown) {
		// 		console.log(textStatus);
		// 	}
		// });

	}
	function llenarTablaDocumentos(documentos) {
		for (let i = 0; i < documentos.length; i++) {
			var btn = `<button type='button'  class='btn btn-primary' onclick='viewDocumento(${documentos[i].FOLIODOCID})'><i class="fas fa-eye"></i></button>`

			var fila =
				`<tr id="row${i}">` +
				`<td class="text-center">${documentos[i].TIPODOC}</td>` +
				`<td class="text-center">${documentos[i].STATUS}</td>` +
				`<td class="text-center">${btn}</td>` +
				`</tr>`;

			$('#table-documentos tr:first').after(fila);
			$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
			var nFilas = $("#documentos tr").length;
			$("#adicionados").append(nFilas - 1);
		}
	}
</script>

<?= $this->endSection() ?>