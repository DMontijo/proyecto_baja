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
										<option value="DERIVADO">DERIVACION</option>
										<option value="CANALIZADO">CANALIZACION</option>
										<option value="NAC">NAC</option>
									</select>
								</div>
								<div id="notas" class="form-group">
									<label for="exampleFormControlTextarea1">Notas de derivación o canalización.</label>
									<textarea id="notas_derivacion" class="form-control" placeholder="Motivo de derivación o canalizacion" rows="10" maxlength="300"></textarea>
								</div>
								<button type="button" id="btn-finalizar-derivacion" class="btn btn-primary">FINALIZAR</button>
							</div>
							<div class="tab-pane fade" id="v-pills-delitos" role="tabpanel" aria-labelledby="v-pills-delitos-tab">
								<?php echo view('/admin/dashboard/video_denuncia_forms/form_denuncia'); ?>
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

<script>
	const tipoSalida = document.querySelector('#tipo_salida');
	const btnFinalizar = document.querySelector('#btn-finalizar-derivacion');
	const notas_derivacion = document.querySelector('#btn-finalizar-derivacion');

	tipoSalida.addEventListener('change', (e) => {
		if (e.target.value !== 'NAC') {
			document.querySelector('#v-pills-delitos-tab').classList.add('d-none');
			document.querySelector('#v-pills-documentos-tab').classList.add('d-none');
			document.querySelector('#notas').classList.remove('d-none');
			btnFinalizar.classList.remove('d-none');
		} else {
			document.querySelector('#v-pills-delitos-tab').classList.remove('d-none');
			document.querySelector('#v-pills-documentos-tab').classList.remove('d-none');
			document.querySelector('#notas').classList.add('d-none');
			btnFinalizar.classList.add('d-none');
		}
	})

	btnFinalizar.addEventListener('click', () => {
		let salida = tipoSalida.value;
		let descripcion = document.querySelector('#notas_derivacion').value;

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
					document.querySelector('#tipo_salida').value = "DERIVADO";
					document.querySelector('#notas_derivacion').value = '';
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
					})
				}
			}).fail(function(jqXHR, textStatus) {});
		} else {
			Swal.fire({
				icon: 'error',
				text: 'Debes colocar un motivo de derivación o canalización para continuar.',
				confirmButtonColor: '#bf9b55',
			}).then((e) => {
				tipoSalida.value = 'DERIVADO';
				descripcion.value = '';
			})
		}

		function cerrarModal() {
			$('.fade').remove();
			$('body').removeClass('modal-open');
		}

	});
</script>
