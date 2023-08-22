<div class="modal fade shadow" id="update_denuncia" role="dialog" aria-labelledby="update_denuncia" aria-hidden="true" data-backdrop="">
	<div class="modal-dialog modal-dialog-centered mw-100 w-75">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-blue text-white">
				<h5 class="modal-title font-weight-bold">ACTUALIZAR INFORMACIÓN DEL HECHO</h5>
				<button type="button" class="close text-white" id="close" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body bg-light" style="height:70vh;overflow-y:auto;">
				<form id="update_denuncia_form_da" action="" method="post" class="row needs-validation" novalidate>
					<div class="col-12 mb-3">
						<h3 class="font-weight-bold mb-4 text-center">INFORMACIÓN DEL HECHO</h3>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="municipio_delito_da" class="form-label font-weight-bold">Municipio:</label>
						<select class="form-control" id="municipio_delito_da" name="municipio_delito_da">
							<option selected disabled value="">Selecciona el municipio</option>
							<?php foreach ($body_data->municipios as $index => $municipio) { ?>
								<option value="<?= $municipio->MUNICIPIOID ?>"> <?= $municipio->MUNICIPIODESCR ?> </option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="localidad_delito_da" class="form-label font-weight-bold">Localidad:</label>
						<select class="form-control" id="localidad_delito_da" name="localidad_delito_da">
							<option selected disabled value="">Selecciona la localidad</option>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="colonia_delito_da" class="form-label font-weight-bold">Colonia</label>
						<input type="text" class="form-control d-none" id="colonia_delito_da" name="colonia_delito_da" maxlength="100">
						<select class="form-control" id="colonia_delito_select_da" name="colonia_delito_select_da">
							<option selected disabled value="">Selecciona la colonia</option>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="calle_delito_da" class="form-label font-weight-bold">Calle:</label>
						<input type="text" class="form-control" id="calle_delito_da" name="calle_delito_da" maxlength="100">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="exterior_delito_da" class="form-label font-weight-bold">No. exterior:</label>
						<input type="text" class="form-control" id="exterior_delito_da" name="exterior_delito_da" maxlength="10">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="interior_delito_da" class="form-label font-weight-bold">No. interior:</label>
						<input type="text" class="form-control" id="interior_delito_da" maxlength="10" name="interior_delito_da">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="lugar_delito_da" class="form-label font-weight-bold">Lugar:</label>
						<select class="form-control" id="lugar_delito_da" name="lugar_delito_da">
							<option selected disabled value="">Selecciona el lugar del delito</option>
							<?php foreach ($body_data->lugares as $index => $lugar) { ?>
								<option value="<?= $lugar->HECHOLUGARID ?>"> <?= $lugar->HECHODESCR ?> </option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="fecha_delito_da" class="form-label font-weight-bold">Fecha:</label>
						<input type="date" class="form-control" id="fecha_delito_da" name="fecha_delito_da" min="1900-01-01" max="<?= date("Y-m-d") ?>">
						<div class="invalid-feedback">
							La fecha del delito es no puede ser menor a 01-01-1900, ni mayor a la fecha actual.
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="hora_delito_da" class="form-label font-weight-bold">Hora:</label>
						<input type="time" class="form-control" id="hora_delito_da" name="hora_delito_da">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="autorizaFoto_da" class="form-label font-weight-bold">Autoriza foto en medios</label>
						<select class="form-control" id="autorizaFoto_da" name="autorizaFoto_da">
							<option disabled selected value=""></option>
							<option value="S">SI</option>
							<option value="N">NO</option>
						</select>
					</div>
					<div class="col-12 mb-3">
						<label for="notas_da" class="form-label font-weight-bold">Notas:</label>
						<textarea class="form-control" id="notas_da" name="notas_da" row="10" oninput="mayuscTextarea(this)" maxlength="1000"></textarea>
					</div>
					<div class="col-12 mb-3 text-center">
						<button type="submit" class="btn btn-primary font-weight-bold">ACTUALIZAR HECHO</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	//Funcion pata convertir todo el elemento en mayuscula
	function mayuscTextarea(e) {
		e.value = e.value.toUpperCase();
	}
</script>