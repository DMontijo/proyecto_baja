<div class="modal fade shadow" id="encargadosModal" tabindex="-1" role="dialog" aria-labelledby="encargadosModalLabel" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-dialog-centered mw-100 w-50">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-primary justify-content-center">
				<h5 class="modal-title font-weight-bold text-white">ASIGNAR ENCARGADOS</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>

			</div>

			<div class="modal-body text-center" id="">
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
					<label for="selectEncargado" class="form-label font-weight-bold">Encargado:</label>
					<select id="selectEncargado" class="form-control">
						<option disabled selected value="">Selecciona un encargado</option>
						<?php foreach ($body_data->encargados as $index => $encargado) { ?>
							<option value="<?= $encargado->	ID ?>"> <?= $encargado->NOMBRE . ' '. $encargado->APELLIDO_PATERNO . ' ' . $encargado->APELLIDO_MATERNO ?> </option>

						<?php } ?>
					</select>
				</div>
				<button class="btn btn-success" id="enviarEncargado"> Enviar</button>
			</div>
		</div>
	</div>
</div>
<script>
	$("#encargadosModal").on('hidden.bs.modal', function() {
		document.getElementById('selectEncargado').value = '';
	});
</script>