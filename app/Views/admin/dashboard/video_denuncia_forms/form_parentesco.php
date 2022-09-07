<form id="form_parentesco" action="" method="post" class="row p-0 m-0 needs-validation" novalidate>

	<div class="col-12">
		<p class="font-weight-bold text-center mt-3">PARENTESCO</p>
	</div>
	<hr>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="personaFisica1" class="form-label font-weight-bold">Persona fisica 1</label>
		<select class="form-control" id="personaFisica1" name="personaFisica1" disabled>
			<option selected value="" disabled></option>
			<?php foreach ($body_data->personafisica as $index => $personafisica) { ?>
				<option value="<?= $personafisica->PERSONAFISICAID ?>"> <?= $personafisica->NOMBRE . ' ' . $personafisica->SEGUNDOAPELLIDO ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="parentesco_mf" class="form-label font-weight-bold">Parentesco</label>
		<select class="form-control" id="parentesco_mf" name="parentesco_mf">
			<option selected value="" disabled></option>

			<?php
			foreach ($body_data->parentesco as $index => $parentesco) { ?>
				<option value="<?= $parentesco->PERSONAPARENTESCOID ?>"> <?= $parentesco->PERSONAPARENTESCODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="personaFisica2" class="form-label font-weight-bold">Persona fisica 2</label>
		<select class="form-control" id="personaFisica2" name="personaFisica2" disabled>
			<option selected value="" disabled></option>
			<?php foreach ($body_data->personafisica as $index => $personafisica) { ?>
				<option value="<?= $personafisica->PERSONAFISICAID ?>"> <?= $personafisica->NOMBRE . ' ' . $personafisica->SEGUNDOAPELLIDO ?> </option>
			<?php } ?>
		</select>
	</div>

	<div class="col-12 mb-3 text-center">
		<button type="submit" id="updateParentesco" name="updateParentesco" class="btn btn-primary font-weight-bold">ACTUALIZAR PARENTESCO</button>
	</div>
</form>