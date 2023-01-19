<div class="modal shadow" id="salida_modal" tabindex="-1" role="dialog" aria-labelledby="SalidaModal" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-dialog-centered mw-100 w-75">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-primary text-white">
				<h5 class="modal-title font-weight-bold">SALIDA</h5>
				<button id="btn_salida_exit" type="button" class="close text-white" data-backdrop="false" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body bg-light">
				<div class="row">
					<div class="col-3">
						<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
							<a class="nav-link active" id="v-pills-salida-tab" data-toggle="pill" href="#v-pills-salida" role="tab" aria-controls="v-pills-salida" aria-selected="true"><i class="fas fa-sign-out-alt"></i> Salida</a>
							<a class="nav-link d-none" id="v-pills-delitos-tab" data-toggle="pill" href="#v-pills-delitos" role="tab" aria-controls="v-pills-delitos" aria-selected="false"><i class="fas fa-people-arrows"></i> Delitos</a>
							<a class="nav-link d-none" id="v-pills-documentos-tab" data-toggle="pill" href="#v-pills-documentos" role="tab" aria-controls="v-pills-documentos" aria-selected="false"><i class="fas fa-file-alt"></i> Documentos</a>
						</div>
					</div>
					<div class="col-9">
						<div class="tab-content" id="v-pills-contenido">
							<div class="tab-pane fade show active" id="v-pills-salida" role="tabpanel" aria-labelledby="v-pills-salida-tab">
								<div class="form-group">
									<label for="tipo_salida" class="font-weight-bold">Selecciona la salida</label>
									<select class="form-control" name="tipo_salida" id="tipo_salida">
										<option value="" selected disabled>Selecciona...</option>
										<option value="DERIVADO">DERIVACION</option>
										<option value="CANALIZADO">CANALIZACION</option>
										<option value="ATENDIDA">DENUNCIA YA ATENDIDA</option>
										<?php foreach ($body_data->tipoExpediente as $index => $expediente) { ?>
											<option value="<?= $expediente->TIPOEXPEDIENTEID ?>"> <?= $expediente->TIPOEXPEDIENTEDESCR ?> </option>
										<?php } ?>
									</select>
								</div>
								<div class="row mb-2">
									<div id="municipio_empleado_container" class="col-12 d-none">
										<label for="municipio_empleado" class="form-label font-weight-bold">Municipio</label>
										<select class="form-control" name="municipio_empleado" id="municipio_empleado">
											<option value="" selected disabled>Selecciona...</option>
											<option value="1">ENSENADA</option>
											<option value="2">MEXICALI</option>
											<option value="3">TECATE</option>
											<option value="4">TIJUANA</option>
											<option value="5">PLAYAS DE ROSARITO</option>
										</select>
									</div>
								</div>
								<div class="row mb-2">
									<div id="derivaciones_container" class="col-12 d-none">
										<label for="derivaciones" class="form-label font-weight-bold">Derivaciones</label>
										<select class="form-control" name="derivaciones" id="derivaciones">
											<option value="" selected disabled>Selecciona...</option>
										</select>
									</div>
								</div>
								<div class="row mb-2">
									<div id="canalizaciones_container" class="col-12 d-none">
										<label for="canalizaciones" class="form-label font-weight-bold">Canalizaciones</label>
										<select class="form-control" name="canalizaciones" id="canalizaciones">
											<option value="" selected disabled>Selecciona...</option>
										</select>
									</div>
								</div>
								<div id="notas" class="form-group">
									<label for="notas_caso_salida">Notas</label>
									<textarea id="notas_caso_salida" class="form-control" placeholder="Notas..." rows="10" maxlength="300" oninput="mayuscTextarea(this)" onkeydown="pulsar(event)" onkeyup="contarCaracteresSalida(this)"></textarea>
									<small id="numCaracterSalida"> </small>

								</div>
								<button type="button" id="btn-finalizar-derivacion" class="btn btn-primary">FINALIZAR</button>
							</div>
							<div class="tab-pane fade" id="v-pills-delitos" role="tabpanel" aria-labelledby="v-pills-delitos-tab">
								<div class="row">
									<button type="button" id="btn-agregar-delito" class="btn btn-primary">
										<i class="fas fa-plus-circle"></i> Agregar delito
									</button>
								</div>
								<table class="table table-striped table-hover mt-2">
									<thead>
										<tr>
											<th scope="col text-center">FOLIO</th>
											<th scope="col text-center">DELITO</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div class="tab-pane fade" id="v-pills-documentos" role="tabpanel" aria-labelledby="v-pills-documentos-tab">
								<?php echo view('/admin/dashboard/video_denuncia_forms/form_denuncia'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include('agregar_delito_modal.php') ?>

<script>
	const tipoSalida = document.querySelector('#tipo_salida');
	const btnFinalizar = document.querySelector('#btn-finalizar-derivacion');
	const notas_caso_salida = document.querySelector('#notas_caso_salida');
	const btnAgregarDelito = document.querySelector('#btn-agregar-delito');

	const municipio_empleado_container = document.querySelector('#municipio_empleado_container');
	const municipio_empleado = document.querySelector('#municipio_empleado');
	const derivaciones_container = document.querySelector('#derivaciones_container');
	const derivaciones = document.querySelector('#derivaciones');
	const canalizaciones_container = document.querySelector('#canalizaciones_container');
	const canalizaciones = document.querySelector('#canalizaciones');

	tipoSalida.addEventListener('change', (e) => {
		const notas_caso_salida = document.querySelector('#notas_caso_salida');
		const notas_caso_mp = document.querySelector('#notas_mp');
		notas_caso_salida.value = notas_caso_mp.value;
		if (charRemain < 300) {
			document.getElementById("numCaracterSalida").innerHTML = charRemain + ' caracteres restantes';
		} else {
			document.getElementById("numCaracterSalida").innerHTML = '300 caracteres restantes';

		}


		if (!(e.target.value == 'DERIVADO' || e.target.value == 'CANALIZADO' || e.target.value == '1' || e.target.value == '4' || e.target.value == '5' || e.target.value == '6' || e.target.value == '7' || e.target.value == '8' || e.target.value == '9')) {
			document.querySelector('#v-pills-delitos-tab').classList.add('d-none');
			document.querySelector('#v-pills-documentos-tab').classList.add('d-none');

			municipio_empleado_container.classList.add('d-none');

		} else {
			municipio_empleado_container.classList.remove('d-none');
		}
		if (e.target.value == 'CANALIZADO') {
			canalizaciones_container.classList.remove('d-none');
			document.querySelector('#municipio_empleado').addEventListener('change', (e) => {

				let select_canalizacion = document.querySelector('#canalizaciones');
				clearSelect(select_canalizacion);
				select_canalizacion.value = '';

				let data = {
					'municipio': e.target.value,
				}
				$.ajax({
					data: data,
					url: "<?= base_url('/data/get-canalizacion-by-municipio') ?>",
					method: "POST",
					dataType: "json",
				}).done(function(response) {
					clearSelect(select_canalizacion);
					let canalizacion = response;
					if (canalizacion == '') {
						Swal.fire({
							icon: 'error',
							text: 'No se puede canalizar en este municipio.',
							confirmButtonColor: '#bf9b55',
						});
					}

					canalizacion.forEach(canalizacion => {
						var option = document.createElement("option");
						option.text = canalizacion.INSTITUCIONREMISIONDESCR;
						option.value = canalizacion.INSTITUCIONREMISIONID;
						select_canalizacion.add(option);
					});
				}).fail(function(jqXHR, textStatus) {
					clearSelect(select_canalizacion);
				});


			});
		} else {
			canalizaciones_container.classList.add('d-none');
			municipio_empleado.value = '';
		}

		if (e.target.value == 'DERIVADO') {
			derivaciones_container.classList.remove('d-none');
			document.querySelector('#municipio_empleado').addEventListener('change', (e) => {

				let select_derivacion = document.querySelector('#derivaciones');
				clearSelect(select_derivacion);
				select_derivacion.value = '';

				let data = {
					'municipio': e.target.value,
				}
				$.ajax({
					data: data,
					url: "<?= base_url('/data/get-derivacion-by-municipio') ?>",
					method: "POST",
					dataType: "json",
				}).done(function(response) {
					clearSelect(select_derivacion);
					let derivacion = response;
					if (derivacion == '') {
						Swal.fire({
							icon: 'error',
							text: 'No se puede derivar en este municipio.',
							confirmButtonColor: '#bf9b55',
						});
					}

					derivacion.forEach(derivacion => {
						var option = document.createElement("option");
						option.text = derivacion.INSTITUCIONREMISIONDESCR;
						option.value = derivacion.INSTITUCIONREMISIONID;
						select_derivacion.add(option);
					});
				}).fail(function(jqXHR, textStatus) {
					clearSelect(select_derivacion);
				});


			});
		} else {
			derivaciones_container.classList.add('d-none');
			municipio_empleado.value = '';
		}
	});

	btnAgregarDelito.addEventListener('click', (e) => {
		$('#delito_modal').modal('show');
	});


	btnFinalizar.addEventListener('click', () => {
		btnFinalizar.setAttribute('disabled', true);
		if (!(tipoSalida.value == '1' || tipoSalida.value == '4' || tipoSalida.value == '5' || tipoSalida.value == '6' || tipoSalida.value == '7' || tipoSalida.value == '8' || tipoSalida.value == '9')) {
			let salida = tipoSalida.value;
			let descripcion = document.querySelector('#notas_caso_salida').value;

			if (tipoSalida.value == 'DERIVADO' || tipoSalida.value == 'CANALIZADO') {
				if (derivaciones.value == '' && tipoSalida.value == 'DERIVADO' || canalizaciones.value == '' &&  tipoSalida.value == 'CANALIZADO' ) {
					Swal.fire({
						icon: 'error',
						text: 'No se puede derivar ó canalizar sin una oficina.',
						confirmButtonColor: '#bf9b55',
					});
					btnFinalizar.disabled = false;

				}else {
					data = {
						'folio': inputFolio.value,
						'year': year_select.value,
						'status': salida,
						'motivo': descripcion,
						'institutomunicipio': municipio_empleado.value,
						'institutoremision': derivaciones.value != '' && tipoSalida.value == 'DERIVADO'  ? derivaciones.value: canalizaciones.value,
					}
				}

			} else {
				data = {
					'folio': inputFolio.value,
					'year': year_select.value,
					'status': salida,
					'motivo': descripcion,
				}

			}

			if (descripcion) {
				$.ajax({
					data: data,
					url: "<?= base_url('/data/update-status-folio') ?>",
					method: "POST",
					dataType: "json",

				}).done(function(data) {
					btnFinalizar.removeAttribute('disabled');
					if (data.status == 1) {
						document.querySelector('#tipo_salida').value = "";
						document.querySelector('#notas_caso_salida').value = '';

						Swal.fire({
							icon: 'success',
							text: salida + ' CORRECTAMENTE',
							confirmButtonColor: '#bf9b55',
						}).then((e) => {
							$("#salida_modal").modal("hide");
							$('body').removeClass('modal-open');
							$('.modal-backdrop').remove();
							buscar_nuevo_btn.classList.add('d-none');
							inputFolio.classList.remove('d-none');
							// buscar_btn.classList.remove('d-none');
							let currentTime = new Date();
							let year = currentTime.getFullYear()

							year_select.classList.remove('d-none');
							year_select.value = year;
							year_select.disabled = true;
							inputFolio.disabled = true;

							card2.classList.add('d-none');
							card3.classList.add('d-none');
							card4.classList.add('d-none');
							card5.classList.add('d-none');

							folio_modal.value = inputFolio.value;
							expediente_modal.value = data.expediente;
							year_modal.value = year;
							expediente_modal_correo.value = data.expediente;
							year_modal_correo.value = year;
							card6.classList.remove('d-none');
							card7.classList.remove('d-none');
							card8.classList.remove('d-none');
							card11.classList.remove('d-none');

							if (inputDenuncia.value == 'DA') {
								card9.classList.add('d-none');
							} else {
								card9.classList.remove('d-none');

							}
						})
					} else {
						Swal.fire({
							icon: 'error',
							text: data.error,
							confirmButtonColor: '#bf9b55',
						});
					}
				}).fail(function(jqXHR, textStatus) {
					btnFinalizar.removeAttribute('disabled');
				});
			} else {
				btnFinalizar.removeAttribute('disabled');
				Swal.fire({
					icon: 'error',
					text: 'Debes colocar un motivo de derivación o canalización para continuar.',
					confirmButtonColor: '#bf9b55',
				}).then((e) => {
					if (tipoSalida.value == 'DERIVADO') {
						tipoSalida.value = 'DERIVADO';
						descripcion.value = '';
					} else if (tipoSalida.value == 'CANALIZADO') {
						tipoSalida.value = 'CANALIZADO';
						descripcion.value = '';
					}

				});
			}
		} else {
			if (municipio_empleado.value != '') {
				let descripcion = document.querySelector('#notas_caso_salida').value;

				if (
					descripcion &&
					inputFolio.value != '' &&
					municipio_empleado.value != '') {
					data = {
						'folio': inputFolio.value,
						'year': year_select.value,
						'municipio': municipio_empleado.value,
						'estado': 2,
						'notas': descripcion,
						'tipo_expediente': Number(tipoSalida.value)
					}
					const dataFolio = {
						'folio': inputFolio.value,
						'year': year_select.value,
						'municipio_empleado': municipio_empleado.value,

					};
					// $.ajax({

					// 	data: dataFolio,
					// 	url: "<?= base_url('/data/update-salida-folio') ?>",
					// 	method: "POST",
					// 	dataType: "json",
					// 	success: function(response) {
					// 		console.log(response);
					// 	},
					// 	error: function(jqXHR, textStatus, errorThrown) {}
					// });
					$.ajax({
						data: data,
						url: "<?= base_url('/data/save-in-justicia') ?>",
						method: "POST",
						dataType: "json",

					}).done(function(data) {
						btnFinalizar.removeAttribute('disabled');

						if (data.status == 1) {
							document.querySelector('#tipo_salida').value = "";
							document.querySelector('#notas_caso_salida').value = '';

							Swal.fire({
								icon: 'success',
								html: 'EXPEDIENTE <strong>' + expedienteConGuiones(data.expediente) + '</strong> CREADO CORRECTAMENTE',
								confirmButtonColor: '#bf9b55',
							}).then((e) => {
								$("#salida_modal").modal("hide");
								$('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								buscar_nuevo_btn.classList.add('d-none');
								inputFolio.classList.remove('d-none');
								inputExpediente.classList.remove('d-none');
								let currentTime = new Date();
								let year = currentTime.getFullYear()

								year_select.classList.remove('d-none');
								year_select.value = year;
								year_select.disabled = true;
								inputFolio.disabled = true;
								inputExpediente.disabled = true;
								// buscar_btn.classList.remove('d-none');
								// municipio_empleado.value = '';
								// oficina_empleado.value = '';
								// empleado.value = '';

								card2.classList.add('d-none');
								card3.classList.add('d-none');
								card4.classList.add('d-none');
								card5.classList.add('d-none');
								// notas_mp.value = '';
								// inputFolio.value = '';
								// borrarTodo();
								folio_modal.value = inputFolio.value;
								inputExpediente.value = data.expediente;
								expediente_modal.value = data.expediente;
								year_modal.value = year;
								expediente_modal_correo.value = data.expediente;
								year_modal_correo.value = year;
								card6.classList.remove('d-none');
								card7.classList.remove('d-none');
								card8.classList.remove('d-none');
								card9.classList.remove('d-none');
								card10.classList.remove('d-none');
								card11.classList.remove('d-none');
							});
						} else {
							Swal.fire({
								icon: 'error',
								text: data.error,
								confirmButtonColor: '#bf9b55',
							});
						}

					}).fail(function(jqXHR, textStatus) {
						console.log(jqXHR, textStatus);
						data = {
							'folio': inputFolio.value,
							'year': year_select.value,
						}
						$.ajax({
							data: data,
							url: "<?= base_url('/data/restore-folio-to-process') ?>",
							method: "POST",
							dataType: "json",

						}).done(function(data) {
							Swal.fire({
								icon: 'error',
								text: 'Fallo la conexión, revisa con soporte técnico.',
								confirmButtonColor: '#bf9b55',
							});
							btnFinalizar.removeAttribute('disabled');
						}).fail(function(jqXHR, textStatus) {
							Swal.fire({
								icon: 'error',
								text: 'Fallo la conexión, revisa con soporte técnico.',
								confirmButtonColor: '#bf9b55',
							});
							btnFinalizar.removeAttribute('disabled');
						});
					});
				} else {
					btnFinalizar.removeAttribute('disabled');
					Swal.fire({
						icon: 'error',
						text: 'Debes agregar comentarios y elegir una asignación para finalizar.',
						confirmButtonColor: '#bf9b55',
					});
				}


			} else {
				btnFinalizar.removeAttribute('disabled');
				Swal.fire({
					icon: 'error',
					text: 'Debes seleccionar un municipio, una oficina y una asignación',
					confirmButtonColor: '#bf9b55',
				});
			}
		}

	});

	function clearSelect(select_element) {
		for (let i = select_element.options.length; i >= 1; i--) {
			select_element.remove(i);
		}
	}

	function expedienteConGuiones(expediente) {
		const array = expediente.trim().split('');
		return array[0] + '-' + array[1] + array[2] + '-' + array[3] + array[4] + array[5] + '-' + array[6] + array[7] + array[8] + array[9] + '-' + array[10] + array[11] + array[12] + array[13] + array[14]
	}

	function contarCaracteresSalida(obj) {
		if (charRemain < 300) {
			var maxLength = charRemain;
		} else {
			var maxLength = 300;
		}
		var strLength = obj.value.length;
		var charRemainSalida = (maxLength - strLength);

		if (charRemainSalida < 0) {
			document.getElementById("numCaracterSalida").innerHTML = '<span style="color: red;">Has superado el límite de ' + maxLength + ' caracteres </span>';
		} else {
			document.getElementById("numCaracterSalida").innerHTML = charRemainSalida + ' caracteres restantes';
		}
	}
</script>