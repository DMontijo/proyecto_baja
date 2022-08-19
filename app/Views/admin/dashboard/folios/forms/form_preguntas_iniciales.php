<form id="preguntas_form" action="" method="post" class="row needs-validation" novalidate>
	<div class="col-12 mb-4">
		<h3 class="font-weight-bold mb-3 text-center">PREGUNTAS INICIALES</h3>
	</div>
	<div class="col-6 mb-3">
		<label for="es_menor" class="form-label font-weight-bold">¿Ofendido es menor de edad?</label>
		<select class="form-control" id="es_menor" name="es_menor" required>
			<option selected disabled value="">Selecciona la respuesta</option>
			<option value="SI">SI</option>
			<option value="NO">NO</option>
		</select>
	</div>
	<div class="col-6 mb-3">
		<label for="es_tercera_edad" class="form-label font-weight-bold">¿Ofendido es de la tercera edad?</label>
		<select class="form-control" id="es_tercera_edad" name="es_tercera_edad" required>
			<option selected disabled value="">Selecciona la respuesta</option>
			<option value="SI">SI</option>
			<option value="NO">NO</option>
		</select>
	</div>
	<div class="col-6 mb-3">
		<label for="tiene_discapacidad" class="form-label font-weight-bold">¿Ofendido tiene alguna discapacidad?</label>
		<select class="form-control" id="tiene_discapacidad" name="tiene_discapacidad" required>
			<option selected disabled value="">Selecciona la respuesta</option>
			<option value="SI">SI</option>
			<option value="NO">NO</option>
		</select>
	</div>
	<div class="col-6 mb-3">
		<label for="es_vulnerable" class="form-label font-weight-bold input-required">¿Ofendido es de un grupo vulnerable?</label>
		<select class="form-control" id="es_vulnerable" name="es_vulnerable" required>
			<option selected disabled value="">Selecciona la respuesta</option>
			<option value="SI">SI</option>
			<option value="NO">NO</option>
		</select>
	</div>
	<div class="col-6 mb-3">
		<label for="vulnerable_descripcion" class="form-label font-weight-bold input-required">Grupo vulnerable descripción</label>
		<input type="text" class="form-control" id="vulnerable_descripcion" name="vulnerable_descripcion">
	</div>
	<div class="col-6 mb-3">
		<label for="fue_con_arma" class="form-label font-weight-bold">¿Delito fue cometido con arma de fuego, arma blanca u objeto contundente?</label>
		<select class="form-control" id="fue_con_arma" name="fue_con_arma" required>
			<option selected disabled value="">Selecciona la respuesta</option>
			<option value="SI">SI</option>
			<option value="NO">NO</option>
		</select>
	</div>
	<div class="col-6 mb-3">
		<label for="lesiones" class="form-label font-weight-bold">¿Ofendido tiene lesiones?</label>
		<select class="form-control" id="lesiones" name="lesiones" required>
			<option selected disabled value="">Selecciona la respuesta</option>
			<option value="SI">SI</option>
			<option value="NO">NO</option>
		</select>
	</div>
	<div class="col-6 mb-3">
		<label for="lesiones_visibles" class="form-label font-weight-bold">¿Lesiones son visibles?</label>
		<select class="form-control" id="lesiones_visibles" name="lesiones_visibles" required>
			<option selected disabled value="">Selecciona la respuesta</option>
			<option value="SI">SI</option>
			<option value="NO">NO</option>
		</select>
	</div>
	<div class="col-6 mb-3">
		<label for="esta_desaparecido" class="form-label font-weight-bold">¿Ofendido se encuentra desaparecido?</label>
		<select class="form-control" id="esta_desaparecido" name="esta_desaparecido" required>
			<option selected disabled value="">Selecciona la respuesta</option>
			<option value="SI">SI</option>
			<option value="NO">NO</option>
		</select>
	</div>
</form>
