<form id="persona_fisica_domicilio_form_da" action="" method="post" class="row p-0 m-0 needs-validation" novalidate>
	<input type="hidden" class="form-control" id="pf_id" name="pf_id">
	<input type="hidden" class="form-control" id="pfd_id" name="pfd_id">
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="pais_pfd" class="form-label font-weight-bold">País</label>
		<select class="form-control" id="pais_pfd" name="pais_pfd">
			<option selected value=""></option>
			<?php foreach ($body_data->paises as $index => $pais) { ?>
				<option value="<?= $pais->ISO_2 ?>"> <?= strtoupper($pais->NAME) ?> </option>
			<?php } ?>
		</select>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="estado_pfd" class="form-label font-weight-bold">Estado</label>
		<select class="form-control" id="estado_pfd" name="estado_pfd">
			<option selected value=""></option>
			<?php foreach ($body_data->estados as $index => $estados) { ?>
				<option value="<?= $estados->ESTADOID ?>"> <?= $estados->ESTADODESCR ?> </option>
			<?php } ?>
		</select>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="municipio_pfd_da" class="form-label font-weight-bold">Municipio</label>
		<select class="form-control" id="municipio_pfd_da" name="municipio_pfd_da">
			<option selected value=""></option>
		</select>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="localidad_pfd" class="form-label font-weight-bold">Localidad</label>
		<select class="form-control" id="localidad_pfd" name="localidad_pfd">
			<option selected value=""></option>
		</select>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="colonia_pfd_select" class="form-label font-weight-bold">Colonia</label>
		<select class="form-control" id="colonia_pfd_select" name="colonia_pfd_select">
			<option selected value=""></option>
		</select>
		<input type="text" class="form-control d-none" id="colonia_pfd" name="colonia_pfd" maxlength="100">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="cp_pfd" class="form-label font-weight-bold">Código postal</label>
		<input type="number" class="form-control" id="cp_pfd" name="cp_pfd" maxlength="10">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="calle_pfd" class="form-label font-weight-bold">Calle</label>
		<input type="text" class="form-control" id="calle_pfd" name="calle_pfd" maxlength="100">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="exterior_pfd" class="form-label font-weight-bold">Número exterior</label>
		<input type="text" class="form-control" id="exterior_pfd" name="exterior_pfd" maxlength="10">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="interior_pfd" class="form-label font-weight-bold">Número interior</label>
		<input type="text" class="form-control" id="interior_pfd" name="interior_pfd" maxlength="10">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="referencia_pfd" class="form-label font-weight-bold">Referencia</label>
		<input type="text" class="form-control" id="referencia_pfd" name="referencia_pfd" maxlength="300">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="manzana_pfd" class="form-label font-weight-bold">Manzana</label>
		<input type="text" class="form-control" id="manzana_pfd" name="manzana_pfd" maxlength="300">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="lote_pfd" class="form-label font-weight-bold">Lote</label>
		<input type="text" class="form-control" id="lote_pfd" name="lote_pfd" maxlength="300">
	</div>
	<div class="col-12 my-4 text-center">
		<button type="submit" class="btn btn-primary font-weight-bold">ACTUALIZAR DOMICILIO</button>
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