	<div class="row p-0 m-0">
		<input type="hidden" class="form-control" id="objeto_id" name="objeto_id">

		<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
			<label for="situacion_objeto_update" class="form-label font-weight-bold">Situación</label>
			<select class="form-control" id="situacion_objeto_update" name="situacion_objeto_update">
				<option disabled selected value=""></option>
				<option value="R">Reportado robado</option>
				<option value="D">Puesto a disposición</option>
				<option value="E">Reportado extraviado</option>
			</select>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
			<label for="objeto_update_clasificacion" class="form-label font-weight-bold">Clasificación del objeto</label>
			<select class="form-control" id="objeto_update_clasificacion" name="objeto_update_clasificacion">
				<option disabled selected value=""></option>
				<?php foreach ($body_data->objetoclasificacion as $index => $objetoclasificacion) { ?>
					<option value="<?= $objetoclasificacion->OBJETOCLASIFICACIONID ?>"> <?= $objetoclasificacion->OBJETOCLASIFICACIONDESCR ?> </option>
				<?php } ?>
			</select>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
			<label for="objeto_update_subclasificacion" class="form-label font-weight-bold">Subclasificación del objeto</label>
			<select class="form-control" id="objeto_update_subclasificacion" name="objeto_update_subclasificacion">
				<option disabled selected value=""></option>
			</select>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
			<label for="marca_objeto_update" class="form-label font-weight-bold">Marca</label>
			<input type="text" class="form-control" id="marca_objeto_update" name="marca_objeto_update" maxlength="100">
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
			<label for="serie_objeto_update" class="form-label font-weight-bold">Número de serie</label>
			<input type="text" class="form-control" id="serie_objeto_update" name="serie_objeto_update" maxlength="100">
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
			<label for="cantidad_objeto_update" class="form-label font-weight-bold">Cantidad</label>
			<input type="number" class="form-control" id="cantidad_objeto_update" name="cantidad_objeto_update">
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
			<label for="valor_objeto_update" class="form-label font-weight-bold">Valor</label>
			<input type="text" class="form-control" id="valor_objeto_update" name="valor_objeto_update" maxlength="100">
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
			<label for="tipo_moneda_update" class="form-label font-weight-bold">Tipo de moneda</label>
			<select class="form-control" id="tipo_moneda_update" name="tipo_moneda_update">
				<option disabled selected value=""></option>
				<?php foreach ($body_data->tipomoneda as $index => $tipomoneda) { ?>
					<option value="<?= $tipomoneda->TIPOMONEDAID ?>"> <?= $tipomoneda->TIPOMONEDADESCR ?> </option>
				<?php } ?>
			</select>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
			<label for="descripcion_detallada_update" class="form-label font-weight-bold">Descripción detallada</label>
			<textarea class="form-control" id="descripcion_detallada_update" name="descripcion_detallada_update" maxlength="500"></textarea>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
			<label for="propietario_update" class="form-label font-weight-bold">Propietario</label>
			<select class="form-control" id="propietario_update" name="propietario_update">
				<option disabled selected value=""></option>

			</select>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
			<label for="participa_estado_objeto_update" class="form-label font-weight-bold">Participa estado</label>
			<select class="form-control" id="participa_estado_objeto_update" name="participa_estado_objeto_update">
				<option disabled selected value=""></option>
				<option value="S">SI</option>
				<option value="N">NO</option>

			</select>
		</div>
		<div class="col-12 my-4 text-center">
			<button type="submit" class="btn btn-primary font-weight-bold">ACTUALIZAR OBJETO INVOLUCRADO</button>
		</div>
	</div>