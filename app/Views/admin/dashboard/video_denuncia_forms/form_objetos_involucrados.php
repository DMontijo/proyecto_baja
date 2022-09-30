<form id="form_objetos_involucrados" action="" method="post" class="row p-0 m-0 needs-validation" novalidate>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="situacion_objeto" class="form-label font-weight-bold">Situación</label>
		<select class="form-control" id="situacion_objeto" name="situacion_objeto">
		<option disabled selected value=""></option>
			<option value="R">Reportado robado</option>
			<option value="D">Puesto a disposición</option>
			<option value="E">Reportado extraviado</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="objeto_clasificacion" class="form-label font-weight-bold">Clasificación del objeto</label>
		<select class="form-control" id="objeto_clasificacion" name="objeto_clasificacion">
		<option disabled selected value=""></option>
			<?php foreach ($body_data->objetoclasificacion as $index => $objetoclasificacion) { ?>
				<option value="<?= $objetoclasificacion->OBJETOCLASIFICACIONID?>"> <?= $objetoclasificacion->OBJETOCLASIFICACIONDESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="objeto_subclasificacion" class="form-label font-weight-bold">Subclasificación del objeto</label>
		<select class="form-control" id="objeto_subclasificacion" name="objeto_subclasificacion">
		<option disabled selected value=""></option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="marca_objeto" class="form-label font-weight-bold">Marca</label>
		<input type="text" class="form-control" id="marca_objeto" name="marca_objeto" maxlength="100">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="serie_objeto" class="form-label font-weight-bold">Número de serie</label>
		<input type="text" class="form-control" id="serie_objeto" name="serie_objeto" maxlength="100">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="cantidad_objeto" class="form-label font-weight-bold">Cantidad</label>
		<input type="number" class="form-control" id="cantidad_objeto" name="cantidad_objeto">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="valor_objeto" class="form-label font-weight-bold">Valor</label>
		<input type="text" class="form-control" id="valor_objeto" name="valor_objeto" maxlength="100">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="tipo_moneda" class="form-label font-weight-bold">Tipo de moneda</label>
		<select class="form-control" id="tipo_moneda" name="tipo_moneda">
		<option disabled selected value=""></option>
			<?php foreach ($body_data->tipomoneda as $index => $tipomoneda) { ?>
				<option value="<?= $tipomoneda->TIPOMONEDAID?>"> <?= $tipomoneda->TIPOMONEDADESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="descripcion_detallada" class="form-label font-weight-bold">Descripción detallada</label>
		<textarea class="form-control" id="descripcion_detallada" name="descripcion_detallada" maxlength="500"></textarea>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="propietario" class="form-label font-weight-bold">Propietario</label>
		<select class="form-control" id="propietario" name="propietario">
			<option disabled selected value=""></option>
			
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="participa_estado_objeto" class="form-label font-weight-bold">Participa estado</label>
		<select class="form-control" id="participa_estado_objeto" name="participa_estado_objeto">
		<option disabled selected value=""></option>
			<option value="S">SI</option>
			<option value="N">NO</option>

		</select>
	</div>
	<div class="col-12 my-4 text-center">
		<button type="submit" class="btn btn-primary font-weight-bold">AGREGAR OBJETO INVOLUCRADO</button>
	</div>
</form>