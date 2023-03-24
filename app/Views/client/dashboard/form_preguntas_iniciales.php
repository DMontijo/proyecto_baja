<div class="row">
	<div class="col-12 mb-3">
		<label for="es_menor" class="form-label fw-bold input-required">¿La víctima del delito es menor de edad?</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="es_menor" value="SI" required>
			<label class="form-check-label" for="flexRadioDefault1">SI</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="es_menor" value="NO" required>
			<label class="form-check-label" for="flexRadioDefault2">NO</label>
		</div>
	</div>
	<div class="col-12 mb-3 d-none" id="menor_alert">
		<div class="alert alert-warning" role="alert">
			El menor debe estar acompañado de un adulto
		</div>
	</div>
	<div class="col-12 mb-3 d-none" id="es_mayor">
		<label for="es_tercera_edad" class="form-label fw-bold input-required">¿La víctima es de la tercera edad?</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="es_tercera_edad" value="SI" required>
			<label class="form-check-label" for="flexRadioDefault1">SI</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="es_tercera_edad" value="NO" required>
			<label class="form-check-label" for="flexRadioDefault2">NO</label>
		</div>
	</div>
	<div class="col-12 mb-3 d-none" id="es_ofendido">
		<label for="es_ofendido" class="form-label fw-bold input-required">¿Eres tú la víctima?</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="es_ofendido" value="SI" required>
			<label class="form-check-label" for="flexRadioDefault1">SI</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="es_ofendido" value="NO" selected required>
			<label class="form-check-label" for="flexRadioDefault2">NO</label>
		</div>
	</div>
	<div class="col-12 mb-3">
		<label for="tiene_discapacidad" class="form-label fw-bold input-required">¿La víctima del delito tiene alguna discapacidad?</label>
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
		<label for="es_vulnerable" class="form-label fw-bold input-required">¿La víctima pertenece a algún grupo vulnerable?
			<a href="#!" data-bs-toggle="tooltip" data-toggle="tooltip" data-bs-placement="right" title="Niños, niñas y adolescentes. Personas lesbianas, gays, bisexuales, transgéneros o intersexuales (LGBTI) Personas con algún tipo de discapacidad física o mental. Personas extranjeras."><i class="bi bi-info-circle-fill"></i></a>
		</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="es_vulnerable" value="SI" required>
			<label class="form-check-label" for="flexRadioDefault1">SI</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="es_vulnerable" value="NO" required>
			<label class="form-check-label" for="flexRadioDefault2">NO</label>
		</div>
	</div>
	<div id="vulnerable_container" class="col-12 mb-3 d-none">
		<label for="vulnerable_descripcion" class="form-label fw-bold input-required">Describe cual</label>
		<input type="text" class="form-control" id="vulnerable_descripcion" name="vulnerable_descripcion" maxlength="100">
	</div>
	<div class="col-12 mb-3">
		<label for="fue_con_arma" class="form-label fw-bold input-required">¿El delito a denunciar fue cometido con arma de fuego, arma blanca u objeto contundente?</label>
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
		<label for="lesiones" class="form-label fw-bold input-required">¿La víctima presenta lesiones?</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="lesiones" value="SI" required>
			<label class="form-check-label" for="flexRadioDefault1">SI</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="lesiones" value="NO" required>
			<label class="form-check-label" for="flexRadioDefault2">NO</label>
		</div>
	</div>
	<div class="col-12 mb-3 d-none" id="lesiones_visibles_form">
		<label for="lesiones_visibles" class="form-label fw-bold input-required">¿Las lesiones son visibles?</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="lesiones_visibles" value="SI" required>
			<label class="form-check-label" for="flexRadioDefault1">SI</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="lesiones_visibles" value="NO" checked required>
			<label class="form-check-label" for="flexRadioDefault2">NO</label>
		</div>
	</div>
	<div class="col-12 mb-3">
		<label for="esta_desaparecido" class="form-label fw-bold input-required">¿La víctima se encuentra desaparecido?</label>
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
</div>

<style>
	/* .tooltip {
		background-color: #092B47;
		color: #fff;
		border: none;
		border-radius: 0;
		padding: 8px;
		font-size: 14px;
		text-align: center !important;
	}
	 */
	.tooltip-inner {
		background-color: #092B47 !important;
		color: white;
		border-radius: 5%;
		box-shadow: 0 0 5px black;
	}

	.bs-tooltip-top .arrow::before,
	.bs-tooltip-auto[x-placement^="top"] .arrow::before {
		border-top-color: #092B47 !important;
	}

	.bs-tooltip-right .arrow::before,
	.bs-tooltip-auto[x-placement^="right"] .arrow::before {
		border-right-color: #092B47 !important;
	}


	.bs-tooltip-bottom .arrow::before,
	.bs-tooltip-auto[x-placement^="bottom"] .arrow::before {
		border-bottom-color: #092B47 !important;
	}


	.bs-tooltip-left .arrow::before,
	.bs-tooltip-auto[x-placement^="left"] .arrow::before {
		border-left-color: #092B47 !important;
	}
</style>

<script>
	let radiosMenor = document.querySelectorAll('input[name="es_menor"]');
	let radiosDesaparecido = document.querySelectorAll('input[name="esta_desaparecido"]');
	let radiosOfendido = document.querySelectorAll('input[name="es_ofendido"]');
	let radiosLesiones = document.querySelectorAll('input[name="lesiones"]');
	let radiosVulnerable = document.querySelectorAll('input[name="es_vulnerable"]');

	$(function() {
		$('[data-toggle="tooltip"]').tooltip()
	})
	radiosMenor.forEach((radio) => {
		radio.addEventListener('click', (e) => {
			if (e.target.value === 'SI') {
				document.getElementById('es_mayor').classList.add('d-none');
				document.getElementById('es_ofendido').classList.add('d-none');
				document.getElementById('menor_alert').classList.remove('d-none');

				document.querySelector('#es_mayor [value="NO"]').checked = true;
				document.querySelector('#es_ofendido [value="NO"]').checked = true;
			} else {
				document.getElementById('es_mayor').classList.remove('d-none');
				document.getElementById('es_ofendido').classList.remove('d-none');
				document.getElementById('menor_alert').classList.add('d-none');

				document.querySelector('#es_mayor [value="NO"]').checked = false;
				document.querySelector('#es_ofendido [value="NO"]').checked = false;
			}
		})
	});

	radiosDesaparecido.forEach((radio) => {
		radio.addEventListener('click', (e) => {
			if (e.target.value === 'SI') {
				document.querySelector('#delito').value = 'PERSONA DESAPARECIDA';
			} else {
				document.querySelector('#delito').value = '';
			}
		})
	});

	// radiosLesiones.forEach((radio) => {
	// 	radio.addEventListener('click', (e) => {
	// 		if (e.target.value === 'SI') {
	// 			document.querySelector('#lesiones_visibles_form').classList.remove('d-none');
	// 			// document.querySelector('#lesiones_visibles_form [value="NO"]').checked = false;
	// 		} else {
	// 			document.querySelector('#lesiones_visibles_form').classList.add('d-none');
	// 			document.querySelector('#lesiones_visibles_form [value="NO"]').checked = true;
	// 		}
	// 	})
	// });

	radiosVulnerable.forEach((radio) => {
		radio.addEventListener('click', (e) => {
			if (e.target.value === 'SI') {
				document.querySelector('#vulnerable_container').classList.remove('d-none');
			} else {
				document.querySelector('#vulnerable_container').classList.add('d-none');
			}
		})
	});
</script>
