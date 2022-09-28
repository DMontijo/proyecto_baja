<form id="form_parentesco_insert" action="" method="post" class="row p-0 m-0 needs-validation" novalidate>

	<div class="col-12">
		<p class="font-weight-bold text-center mt-3">PARENTESCO</p>
	</div>
	<hr>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="personaFisica1_I" class="form-label font-weight-bold">Persona fisica 1</label>
		<select class="form-control" id="personaFisica1_I" name="personaFisica1_I" required>
			<option selected value="" disabled></option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="parentesco_mf_I" class="form-label font-weight-bold">Parentesco</label>
		<select class="form-control" id="parentesco_mf_I" name="parentesco_mf_I" required>
			<option selected value="" disabled></option>
			<?php
			foreach ($body_data->parentesco as $index => $parentesco) { ?>
				<option value="<?= $parentesco->PERSONAPARENTESCOID ?>"> <?= $parentesco->PERSONAPARENTESCODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="personaFisica2_I" class="form-label font-weight-bold">Persona fisica 2</label>
		<select class="form-control" id="personaFisica2_I" name="personaFisica2_I" required>
			<option selected value=""></option>

		</select>
	</div>

	<div class="col-12 mb-3 text-center">
		<button type="submit" id="insertParentesco" name="insertParentesco" class="btn btn-primary font-weight-bold">AGREGAR PARENTESCO</button>
	</div>

</form>
