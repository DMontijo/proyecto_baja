<div class="modal fade shadow" id="asignarAgenteModal" tabindex="-1" role="dialog" aria-labelledby="asignarAgenteModalLabel" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-dialog-centered mw-100 w-50">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-primary justify-content-center">
				<h5 class="modal-title font-weight-bold text-white">ASIGNAR AGENTE</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>

			</div>

			<div class="modal-body text-center" id="">
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
					<label for="selectAgente" class="form-label font-weight-bold">AGENTE:</label>
					<select id="selectAgente" class="form-control">
						<option disabled selected value="">Selecciona un agente</option>
						<?php foreach ($body_data->empleados as $index => $empleados) { ?>
							<option value="<?= $empleados->ID ?>"> <?= $empleados->NOMBRE . ' '. $empleados->APELLIDO_PATERNO . ' ' . $empleados->APELLIDO_MATERNO ?> </option>

						<?php } ?>
					</select>
				</div>
				<button class="btn btn-primary" id="enviarAgente"> Enviar</button>
			</div>
		</div>
	</div>
</div>
<script>
		//Limpieza de elementos al cerrar modal
	$("#asignarAgenteModal").on('hidden.bs.modal', function() {
		document.getElementById('selectAgente').value = '';
	});
</script>