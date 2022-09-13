<form id="form_delitos_cometidos_insert" action="" method="post" class="row p-0 m-0 needs-validation" novalidate>

	<div class="col-12">
		<p class="font-weight-bold text-center mt-3">ASIGNAR DELITOS</p>
	</div>
	<hr>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="imputado_delito_cometido" class="form-label font-weight-bold">Imputado</label>
		<select class="form-control" id="imputado_delito_cometido" name="imputado_I" required> 
			<option selected value="" disabled></option>

			<?php foreach ($body_data->imputados as $index => $imputado) { ?>
				
				<option value="<?= $imputado->PERSONAFISICAID ?>"> <?= $imputado->NOMBRE . ' ' . $imputado->PRIMERAPELLIDO ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="delito_cometido_fisimpdelito" class="form-label font-weight-bold">Delito cometido</label>
		<select class="form-control" id="delito_cometido_fisimpdelito" name="delito_cometido_fisimpdelito" required>
			<option selected value="" disabled></option>
			<?php
			foreach ($body_data->delitosModalidad as $index => $delitoModalidad) { ?>
				<option value="<?= $delitoModalidad->DELITOMODALIDADID ?>"> <?= $delitoModalidad->DELITOMODALIDADDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 mb-3 text-center">
		<button type="submit" id="insertDelitoCometido" name="insertDelitoCometido" class="btn btn-primary font-weight-bold">AGREGAR DELITO COMETIDO</button>
	</div>

</form>