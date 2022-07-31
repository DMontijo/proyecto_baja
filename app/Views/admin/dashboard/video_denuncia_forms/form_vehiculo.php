<div class="row">

	<div class="col-12">
		<p class="font-weight-bold text-center mt-3">GENERALES</p>
	</div>
	<hr>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="tipo_vehiculo" class="form-label font-weight-bold">Tipo de vehículo:</label>
		<input class="form-control" type="text" id="tipo_vehiculo" name="tipo_vehiculo">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="color_vehiculo" class="form-label font-weight-bold">Color:</label>
		<input class="form-control" type="text" id="color_vehiculo" name="color_vehiculo">
	</div>
	<div class="col-12 mb-3">
		<label for="description_vehiculo" class="form-label font-weight-bold">Otras características que permitan identificar el vehiculo:</label>
		<textarea class="form-control" id="description_vehiculo" name="description_vehiculo" rows="10"></textarea>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="foto_vehiculo" class="form-label font-weight-bold">Fotografía del vehículo:</label>
		<a class="btn btn-primary btn-block mb-4 font-weight-bold" id="downloadImage" download="">Descargar imagen</a>
		<img class="img-fluid mb-3" id="foto_vehiculo" name="foto_vehiculo" src="" alt="">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="doc_vehiculo" class="form-label font-weight-bold">Documento del vehículo:</label>
		<a class="btn btn-primary btn-block mb-4 font-weight-bold" id="downloadDoc" download="">Descargar documento</a>
		<img class="img-fluid mb-3" id="doc_vehiculo" name="doc_vehiculo" src="" alt="">
	</div>

</div>
