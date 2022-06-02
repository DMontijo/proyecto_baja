<div class="row" method="POST">
	<h3 class="text-center fw-bolder pb-3 text-blue">Datos del adulto acompañante</h3>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nombre_adulto" class="form-label fw-bold">Nombre(s)</label>
		<input type="text" class="form-control" id="nombre_adulto" name="nombre_adulto" autofocus>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="ape_paterno_adulto" class="form-label fw-bold">Apellido paterno</label>
		<input type="text" class="form-control" id="ape_paterno_adulto" name="ape_paterno_adulto">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="ape_materno_adulto" class="form-label fw-bold">Apellido materno</label>
		<input type="text" class="form-control" id="ape_materno_adulto" name="ape_materno_adulto">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="pais_adulto" class="form-label fw-bold">País</label>
		<input type="text" class="form-control" id="pais_adulto" name="pais_adulto">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="estado_adulto" class="form-label fw-bold">Estado</label>
		<input type="text" class="form-control" id="estado_adulto" name="estado_adulto">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="municipio_adulto" class="form-label fw-bold">Municipio</label>
		<input type="text" class="form-control" id="municipio_adulto" name="municipio_adulto">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="calle_adulto" class="form-label fw-bold">Calle</label>
		<input type="text" class="form-control" id="calle_adulto" name="calle_adulto">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="numero_ext_adulto" class="form-label fw-bold">Número exterior</label>
		<input type="text" class="form-control" id="numero_ext_adulto" name="numero_ext_adulto">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="numero_int_adulto" class="form-label fw-bold">Número interior</label>
		<input type="text" class="form-control" id="numero_int_adulto" name="numero_int_adulto">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="cp_adulto" class="form-label fw-bold">Código Postal</label>
		<input type="text" class="form-control" id="cp_adulto" name="cp_adulto">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="fecha_nac_adulto" class="form-label fw-bold">Fecha de nacimiento</label>
		<input type="date" class="form-control" id="fecha_nac_adulto" name="fecha_nac_adulto">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="edad_adulto" class="form-label fw-bold">Edad</label>
		<input class="form-control" id="edad_adulto" name="edad_adulto" type="text" disabled>
	</div>

</div>


<script>
	$(function() {
		$('#fecha_nac_adulto').on('change', calcularEdad);
	});

	function calcularEdad() {
		fecha = $(this).val();
		var hoy = new Date();
		var cumpleanos = new Date(fecha);
		var edad = hoy.getFullYear() - cumpleanos.getFullYear();
		var m = hoy.getMonth() - cumpleanos.getMonth();

		if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
			edad--;
		}
		$('#edad_adulto').val(edad);
	}
</script>
