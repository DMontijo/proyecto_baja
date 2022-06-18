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

	tipoSalida.addEventListener('change', (e) => {
		const notas_caso_salida = document.querySelector('#notas_caso_salida');
		const notas_caso_mp = document.querySelector('#notas_mp');
		notas_caso_salida.value = notas_caso_mp.value;

		console.log(notas_caso_mp.value);

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
		if (tipoSalida.value !== 'NAC') {
			let salida = tipoSalida.value;
			let descripcion = document.querySelector('#notas_caso_salida').value;

			btnFinalizar.setAttribute('disabled', true);
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
							btnFinalizar.removeAttribute('disabled');
							buscar_nuevo_btn.classList.add('d-none');
							inputFolio.classList.remove('d-none');
							buscar_btn.classList.remove('d-none');

							card2.classList.add('d-none');
							card3.classList.add('d-none');
							card4.classList.add('d-none');
							card5.classList.add('d-none');
							notas_mp.value = '';
							inputFolio.value = '';
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

		}

	});
</script>
