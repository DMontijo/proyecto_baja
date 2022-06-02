<div class="row">
	<div class="col-12 mb-3">
		<label for="es_menor" class="form-label fw-bold input-required">¿La victima u ofendido del delito es menor de edad?</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="es_menor" value="SI" onclick="MostrarSiEresTu();" required>
			<label class="form-check-label" for="flexRadioDefault1">SI</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="es_menor" value="NO" onclick="EsconderSiEresTu();" required>
			<label class="form-check-label" for="flexRadioDefault2">NO</label>
		</div>
	</div>
	<div class="col-12 mb-3 d-none" id="eres_tu">
		<label for="eres_tu" class="form-label fw-bold input-required">¿Eres tú el menor de edad?</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="eres_tu" value="SI" onclick="alerta(event)" required>
			<label class="form-check-label" for="flexRadioDefault1">SI</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="eres_tu" value="NO" checked onclick="alerta(event)" required>
			<label class="form-check-label" for="flexRadioDefault2">NO</label>
		</div>
	</div>
	<div class="col-12 mb-3 d-none" id="es_mayor">
		<label for="es_tercera_edad" class="form-label fw-bold input-required">¿La victima u ofendido es de la tercera edad?</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="es_tercera_edad" value="SI" required>
			<label class="form-check-label" for="flexRadioDefault1">SI</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="es_tercera_edad" value="NO" required checked>
			<label class="form-check-label" for="flexRadioDefault2">NO</label>
		</div>
	</div>
	<div class="col-12 mb-3">
		<label for="tiene_discapacidad" class="form-label fw-bold input-required">¿La victima u ofendido del delito tiene alguna discapacidad?</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="tiene_discapacidad" value="SI" required>
			<label class="form-check-label" for="flexRadioDefault1">SI</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="tiene_discapacidad" value="NO" required>
			<label class="form-check-label" for="flexRadioDefault2">NO</label>
		</div>
	</div>
	<div class="col-12 mb-3">
		<label for="fue_con_arma" class="form-label fw-bold input-required">¿El delito a denuncias fue cometido con arma de fuego, arma blanca u objeto contundente?</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="fue_con_arma" value="SI" required>
			<label class="form-check-label" for="flexRadioDefault1">SI</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="fue_con_arma" value="NO" required>
			<label class="form-check-label" for="flexRadioDefault2">NO</label>
		</div>
	</div>
	<div class="col-12 mb-3">
		<label for="esta_desaparecido" class="form-label fw-bold input-required">¿La victima u ofendido se encuentra desaparecido?</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="esta_desaparecido" value="SI" required>
			<label class="form-check-label" for="flexRadioDefault1">SI</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="esta_desaparecido" value="NO" required>
			<label class="form-check-label" for="flexRadioDefault2">NO</label>
		</div>
	</div>
	<div class="col-12">
		<div class="alert alert-warning text-center fw-bold d-none" id="menor" role="alert">
			Para continuar debes estar acompañado por un adulto.
		</div>
	</div>
</div>



<script>
	function MostrarSiEresTu() {
		document.getElementById('eres_tu').classList.remove('d-none');
		document.getElementById('es_mayor').classList.add('d-none');
	}

	function EsconderSiEresTu() {
		document.getElementById('eres_tu').classList.add('d-none');
		document.getElementById('es_mayor').classList.remove('d-none');
	}

	function alerta(e) {
		console.log(e.target.value);
		if (e.target.value === 'SI') {
			document.getElementById('menor').classList.remove('d-none');
		}

		if (e.target.value === 'NO') {
			document.getElementById('menor').classList.add('d-none');
		}
	}
</script>
