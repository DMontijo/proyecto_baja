<div class="modal shadow" id="salida_modal" tabindex="-1" role="dialog" aria-labelledby="SalidaModal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered mw-100 w-75">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h5 class="modal-title font-weight-bold">SALIDA</h5>
				<button id="btn_salida_exit" type="button" class="close text-white" data-backdrop="false" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body">
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
									<label for="tipo_salida" class="font-weight-bold">Seleccione la salida</label>
									<select class="form-control" name="tipo_salida" id="tipo_salida">
										<option value="" selected disabled>Seleccione...</option>
										<option value="DERIVADO">DERIVACION</option>
										<option value="CANALIZADO">CANALIZACION</option>
										<option value="NAC">NAC</option>
									</select>
								</div>
								<div class="row mb-2">
									<div id="municipio_empleado_container" class="col-4 d-none">
										<label for="municipio_empleado" class="form-label font-weight-bold">Municipio</label>
										<select class="form-control" name="municipio_empleado" id="municipio_empleado">
											<option value="" selected disabled>Seleccione...</option>
											<option value="1">ENSENADA</option>
											<option value="2">MEXICALI</option>
											<option value="3">TECATE</option>
											<option value="4">TIJUANA</option>
											<option value="5">PLAYAS DE ROSARITO</option>
										</select>
									</div>
									<div id="oficina_empleado_container" class="col-4 d-none">
										<label for="oficina_empleado" class="form-label font-weight-bold">Oficina</label>
										<select class="form-control" name="oficina_empleado" id="oficina_empleado">
											<option value="" selected disabled>Seleccione...</option>
										</select>
									</div>
									<div id="empleado_container" class="col-4 d-none">
										<label for="empleado" class="form-label font-weight-bold">Asignar a</label>
										<select class="form-control" name="empleado" id="empleado">
											<option value="" selected disabled>Seleccione...</option>
										</select>
									</div>
								</div>
								<div id="notas" class="form-group">
									<label for="notas_caso_salida">Notas</label>
									<textarea id="notas_caso_salida" class="form-control" placeholder="Notas..." rows="10" maxlength="300"></textarea>
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
	const oficina_empleado_container = document.querySelector('#oficina_empleado_container');
	const empleado_container = document.querySelector('#empleado_container');

	const municipio_empleado = document.querySelector('#municipio_empleado');
	const oficina_empleado = document.querySelector('#oficina_empleado');
	const empleado = document.querySelector('#empleado');

	municipio_empleado.addEventListener('change', (e) => {
		clearSelect(oficina_empleado);
		clearSelect(empleado);
		oficina_empleado.value = '';
		empleado.value = '';

		$.ajax({
			data: {
				'municipio': e.target.value
			},
			url: "<?= base_url('/data/get-oficinas-by-municipio') ?>",
			method: "POST",
			dataType: "json",
		}).done(function(data) {
			clearSelect(oficina_empleado);
			data.forEach(oficina => {
				let option = document.createElement("option");
				option.text = oficina.OFICINADESCR;
				option.value = oficina.OFICINAID;
				oficina_empleado.add(option);
			});
			oficina_empleado.value = '';
		}).fail(function(jqXHR, textStatus) {
			clearSelect(oficina_empleado);
		});
	});

	oficina_empleado.addEventListener('change', (e) => {
		$.ajax({
			data: {
				'municipio': municipio_empleado.value,
				'oficina': e.target.value,
			},
			url: "<?= base_url('/data/get-empleados-by-municipio-and-oficina') ?>",
			method: "POST",
			dataType: "json",
		}).done(function(data) {
			clearSelect(empleado);
			data.forEach(emp => {
				let option = document.createElement("option");
				option.text = emp.NOMBRE + ' ' + emp.PRIMERAPELLIDO + ' ' + emp.SEGUNDOAPELLIDO;
				option.value = emp.EMPLEADOID;
				empleado.add(option);
			});
			empleado.value = '';
		}).fail(function(jqXHR, textStatus) {
			clearSelect(empleado);
		});
	});

	tipoSalida.addEventListener('change', (e) => {
		const notas_caso_salida = document.querySelector('#notas_caso_salida');
		const notas_caso_mp = document.querySelector('#notas_mp');
		notas_caso_salida.value = notas_caso_mp.value;

		if (e.target.value !== 'NAC') {
			document.querySelector('#v-pills-delitos-tab').classList.add('d-none');
			document.querySelector('#v-pills-documentos-tab').classList.add('d-none');

			municipio_empleado_container.classList.add('d-none');
			oficina_empleado_container.classList.add('d-none');
			empleado_container.classList.add('d-none');

		} else {
			municipio_empleado_container.classList.remove('d-none');
			oficina_empleado_container.classList.remove('d-none');
			empleado_container.classList.remove('d-none');
		}
	});

	btnAgregarDelito.addEventListener('click', (e) => {
		$('#delito_modal').modal('show');
	});


	btnFinalizar.addEventListener('click', () => {
		btnFinalizar.setAttribute('disabled', true);

		if (tipoSalida.value !== 'NAC') {
			let salida = tipoSalida.value;
			let descripcion = document.querySelector('#notas_caso_salida').value;
			data = {
				'folio': document.querySelector('#input_folio_atencion').value,
				'agenteId': <?= session('ID') ?>,
				'status': salida,
				'motivo': descripcion,
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
							buscar_btn.classList.remove('d-none');

							card2.classList.add('d-none');
							card3.classList.add('d-none');
							card4.classList.add('d-none');
							card5.classList.add('d-none');
							notas_mp.value = '';
							inputFolio.value = '';
							borrarTodo();
						})
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
					tipoSalida.value = 'DERIVADO';
					descripcion.value = '';
				});
			}
		} else {
			if (municipio_empleado.value != '' && oficina_empleado.value != '' && empleado.value != '') {
				let descripcion = document.querySelector('#notas_caso_salida').value;
				
				if (
					descripcion &&
					inputFolio.value != '' &&
					municipio_empleado.value != '' &&
					oficina_empleado.value != '' &&
					empleado.value != '') {
					data = {
						'folio': inputFolio.value,
						'municipio': municipio_empleado.value,
						'estado': 2,
						'notas': descripcion,
						'oficina': oficina_empleado.value,
						'empleado': empleado.value,
					}

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
								html: 'EXPEDIENTE <strong>' + data.expediente + '</strong> CREADO CORRECTAMENTE',
								confirmButtonColor: '#bf9b55',
							}).then((e) => {
								$("#salida_modal").modal("hide");
								$('body').removeClass('modal-open');
								$('.modal-backdrop').remove();
								buscar_nuevo_btn.classList.add('d-none');
								inputFolio.classList.remove('d-none');
								buscar_btn.classList.remove('d-none');
								municipio_empleado.value = '';
								oficina_empleado.value = '';
								empleado.value = '';

								card2.classList.add('d-none');
								card3.classList.add('d-none');
								card4.classList.add('d-none');
								card5.classList.add('d-none');
								notas_mp.value = '';
								inputFolio.value = '';
								borrarTodo();
							})
						}
						console.log(data);

					}).fail(function(jqXHR, textStatus) {
						console.log(jqXHR, textStatus);
						btnFinalizar.removeAttribute('disabled');
						Swal.fire({
							icon: 'error',
							text: 'Fallo la conexión, revisa con soporte técnico.',
							confirmButtonColor: '#bf9b55',
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
</script>