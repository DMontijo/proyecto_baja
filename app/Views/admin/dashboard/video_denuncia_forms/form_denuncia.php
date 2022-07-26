<div class="row">
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="delito" class="form-label font-weight-bold">Delito:</label>
		<input class="form-control" id="delito" name="delito">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="municipio" class="form-label font-weight-bold">Municipio:</label>
		<input class="form-control" id="municipio" name="municipio">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="colonia" class="form-label font-weight-bold">Colonia del delito</label>
		<input type="text" class="form-control" id="colonia" name="colonia" maxlength="100">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="calle" class="form-label font-weight-bold">Calle o avenida del delito:</label>
		<input type="text" class="form-control" id="calle" name="calle">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="exterior" class="form-label font-weight-bold">No. exterior del delito:</label>
		<input type="text" class="form-control" id="exterior" name="exterior">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="interior" class="form-label font-weight-bold">No. interior del delito:</label>
		<input type="text" class="form-control" id="interior" name="interior">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="lugar" class="form-label font-weight-bold">Lugar del delito:</label>
		<input class="form-control" id="lugar" name="lugar">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="fecha" class="form-label font-weight-bold">Fecha del delito:</label>
		<input type="text" class="form-control" id="fecha" name="fecha" max="<?= date("Y-m-d") ?>">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="hora" class="form-label font-weight-bold">Hora del delito:</label>
		<input type="time" class="form-control" id="hora" name="hora">
	</div>
	<div class="col-12 mb-3">
		<label for="narracion" class="form-label font-weight-bold">Descripción del delito:</label>
		<textarea type="text" class="form-control" id="narracion" name="narracion" rows="5"></textarea>
	</div>
</div>
