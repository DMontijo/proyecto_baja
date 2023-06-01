<form id="persona_fisica_domicilio_form_da" action="" method="post" class="row p-0 m-0 needs-validation" novalidate>
	<input type="hidden" class="form-control" id="pf_id_da" name="pf_id_da">
	<input type="hidden" class="form-control" id="pfd_id_da" name="pfd_id_da">
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="pais_pfd_da" class="form-label font-weight-bold">País</label>
		<select class="form-control" id="pais_pfd_da" name="pais_pfd_da">
			<option selected value=""></option>
			<?php foreach ($body_data->paises as $index => $pais) { ?>
				<option value="<?= $pais->ISO_2 ?>"> <?= strtoupper($pais->NAME) ?> </option>
			<?php } ?>
		</select>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="estado_pfd_da" class="form-label font-weight-bold">Estado</label>
		<select class="form-control" id="estado_pfd_da" name="estado_pfd_da">
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
		<label for="localidad_pfd_da" class="form-label font-weight-bold">Localidad</label>
		<select class="form-control" id="localidad_pfd_da" name="localidad_pfd_da">
			<option selected value=""></option>
		</select>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="colonia_pfd_da_select" class="form-label font-weight-bold">Colonia</label>
		<select class="form-control" id="colonia_pfd_da_select" name="colonia_pfd_da_select">
			<option selected value=""></option>
		</select>
		<input type="text" class="form-control d-none" id="colonia_pfd_da" name="colonia_pfd_da" maxlength="100">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="cp_pfd_da" class="form-label font-weight-bold">Código postal</label>
		<input type="number" class="form-control" id="cp_pfd_da" name="cp_pfd_da" maxlength="10">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="calle_pfd_da" class="form-label font-weight-bold">Calle</label>
		<input type="text" class="form-control" id="calle_pfd_da" name="calle_pfd_da" maxlength="100">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
	<label for="exterior" class="form-label  font-weight-bold" id="lblExterior_pfd_da">Número exterior</label>
		<input type="text" class="form-control" id="exterior_pfd_da" name="exterior_pfd_da" maxlength="10">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="interior_pfd_da" class="form-label font-weight-bold"  id="lblInterior_pfd_da">Número interior</label>
		<input type="text" class="form-control" id="interior_pfd_da" name="interior_pfd_da" maxlength="10">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="referencia_pfd_da" class="form-label font-weight-bold">Referencia</label>
		<input type="text" class="form-control" id="referencia_pfd_da" name="referencia_pfd_da" maxlength="300">
	</div>
	<div class="col-12 mt-4 mb-4">
		<input class="form-check-input" type="checkbox" id="checkML_pfd_da" name="checkML_pfd_da">
		<label class="form-check-label fw-bold" for="checkML_pfd_da">
			¿La dirección contiene manzana y lote?
		</label>
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