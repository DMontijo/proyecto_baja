<form id="form_asignar_arbol_delictual_insert" action="" method="post" class="row p-0 m-0 needs-validation" novalidate>

	<div class="col-12">
		<p class="font-weight-bold text-center mt-3">DELITOS</p>
	</div>
	<hr>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="victima_ofendido" class="form-label font-weight-bold">Victima u Ofendido</label>
		<select class="form-control" id="victima_ofendido" name="victima_ofendido" required>
			<option selected value="" disabled></option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="delito_cometido" class="form-label font-weight-bold">Delito cometido</label>
		<select class="form-control" id="delito_cometido" name="delito_cometido" required>
			<option selected value="" disabled>Selecciona ...</option>
			<?php
			foreach ($body_data->delitosModalidad as $index => $delitoModalidad) { ?>
				<option value="<?= $delitoModalidad->DELITOMODALIDADID ?>"> <?= $delitoModalidad->DELITOMODALIDADDESCR ?></option>
			<?php } ?>

		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="imputado_arbol" class="form-label font-weight-bold">Imputado</label>
		<select class="form-control" id="imputado_arbol" name="imputado_arbol" required>
			<option selected value="" disabled></option>
		</select>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" id="tentativa" name="tentativa" value="S">
			<label class="form-check-label font-weight-bold" for="tentativa">
				Tentativa
			</label>
		</div>

	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" id="conviolencia" name="conviolencia" value="S">
			<label class="form-check-label font-weight-bold" for="conviolencia">
				Con violencia
			</label>
		</div>

	</div>
	<div class="col-12 mb-3 text-center">
		<button type="submit" id="insertArbol" name="insertArbol" class="btn btn-primary font-weight-bold">AGREGAR DELITO</button>
	</div>

</form>
<script>
	(function() {
		'use strict'

		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.querySelectorAll('.needs-validation')

		// Loop over them and prevent submission
		Array.prototype.slice.call(forms)
			.forEach(function(form) {
				form.addEventListener('submit', function(event) {
					if (!form.checkValidity()) {
						event.preventDefault()
						event.stopPropagation()
					}

					form.classList.add('was-validated')
				}, false)
			})
	})()
</script>
