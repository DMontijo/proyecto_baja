<?= $this->extend('client/templates/register_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container m-auto">
	<h1 class="text-center fw-bolder pb-1 text-blue">DATOS DEL DENUNCIANTE</h1>

	<p class="text-center pb-5">Los campos con un <span class="asterisco-rojo">*</span> son obligatorios</p>
	<form class="row g-3 needs-validation" novalidate>
		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="nombre" class="form-label fw-bold input-required">Nombre(s)</label>
			<input type="text" class="form-control" id="nombres" name="nombre" required>
			<div class="invalid-feedback">
				El nombre es obligatorio
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="apellido_paterno" class="form-label fw-bold input-required">Apellido paterno</label>
			<input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" required>
			<div class="invalid-feedback">
				El apellido paterno es obligatorio
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="apellido_materno" class="form-label fw-bold ">Apellido materno</label>
			<input type="text" class="form-control" id="apellido_materno" name="apellido_materno">
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="correo" class="form-label fw-bold input-required">Correo electrónico</label>
			<input type="email" class="form-control" id="correo" name="correo" required>
			<div class="invalid-feedback">
				El correo esta erroneo
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="fecha_nacimiento" class="form-label fw-bold input-required">Fecha de nacimiento</label>
			<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
			<div class="invalid-feedback">
				La fecha de nacimiento es obligatoria
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="edad" class="form-label fw-bold">Edad</label>
			<input class="form-control" id="edad" name="edad" value="" type="text" disabled>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="sexo" class="form-label fw-bold input-required">Sexo biológico</label>
			<br>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="sexo" id="H" required>
				<label class="form-check-label" for="flexRadioDefault1">HOMBRE</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="sexo" id="M" required>
				<label class="form-check-label" for="flexRadioDefault2">MUJER</label>
			</div>
		</div>
		<div class="col-12">
			<div class="alert alert-warning text-center fw-bold d-none" id="menor" role="alert">
				Eres menor de edad.<br>
				Para continuar es preferente que estes acompañado por un adulto.
			</div>
		</div>

		<div class="col-12">
			<hr>
		</div>

		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="cp" class="form-label fw-bold input-required">Código postal</label>
			<input type="number" class="form-control" id="cp" name="cp" required>
			<div class="invalid-feedback">
				El código postal es obligatorio
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="pais" class="form-label fw-bold input-required">País del denunciante</label>
			<!-- <select class="form-select" id="select_pais" name="select_pais" onchange="activatePaisInput(event)" required>
				<option value="MEXICO" selected>MÉXICO</option>
				<option value="ESTADOS UNIDOS">ESTADOS UNIDOS</option>
				<option value="OTRO">OTRO</option>
			</select> -->
			<input type="text" class="form-control" id="pais" name="pais" required>
			<div class="invalid-feedback">
				El país es obligatorio
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="estado" class="form-label fw-bold input-required">Estado del denunciante</label>
			<input type="text" class="form-control" id="estado" name="estado" required>
			<div class="invalid-feedback">
				El estado es obligatorio
			</div>
		</div>

		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="municipio" class="form-label fw-bold input-required">Municipio del denunciante</label>
			<input type="text" class="form-control" id="municipio" name="municipio" required>
			<div class="invalid-feedback">
				El municipio es obligatorio
			</div>
		</div>

		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="localidad" class="form-label fw-bold">Localidad del denunciante</label>
			<input type="text" class="form-control" id="localidad" name="localidad">
			<div class="invalid-feedback">
				La localidad es obligatoria
			</div>
		</div>


		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="colonia" class="form-label fw-bold input-required">Colonia del denunciante</label>
			<input type="text" class="form-control" id="colonia" name="colonia" required>
			<div class="invalid-feedback">
				La colonia es obligatoria
			</div>
		</div>
		<!-- <div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="colonia" class="form-label fw-bold input-required">Colonia del denunciante</label>
			<select class="form-select" id="colonia_select" name="colonia_select" onchange="activateColoniaInput(event)" required>
				<option selected disabled value="">Seleccione la colonia</option>
				<option value="1">COLONIA</option>
				<option value="2">COLONIA</option>
				<option value="2">COLONIA</option>
				<option value="3">COLONIA</option>
				<option value="4">COLONIA</option>
				<option value="0">[NO APARECE MI COLONIA]</option>
			</select>
			<input type="text" class="form-control d-none" id="colonia" name="colonia" required>
			<div class="invalid-feedback">
				La colonia es obligatoria
			</div>
		</div> -->
		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="calle" class="form-label fw-bold input-required">Calle o Avenida del denunciante</label>
			<input type="text" class="form-control" id="calle" name="calle" required>
			<div class="invalid-feedback">
				La calle o avenida es obligatoria
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="exterior" class="form-label fw-bold input-required">Número exterior</label>
			<input type="text" class="form-control" id="exterior" name="exterior" required>
			<div class="invalid-feedback">
				El número exterior es obligatorio
			</div>
		</div>
		<!-- <div class="col-12 col-sm-6 col-md-6 col-lg-2">
            <label for="interior" class="form-label fw-bold">Número interior</label>
            <input type="text" class="form-control" id="interior" name="interior">
        </div> -->
		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="telefono" class="form-label fw-bold input-required">Número de télefono</label>
			<input type="number" class="form-control" id="telefono" name="telefono" required>
			<div class="invalid-feedback">
				El número télefono es obligatorio
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="telefono2" class="form-label fw-bold">Número de télefono 2 (opcional)</label>
			<input type="number" class="form-control" id="telefono2" name="telefono2">
		</div>

		<div class="col-12">
			<hr>
		</div>

		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="identificacion" class="form-label fw-bold input-required">Identificación</label>
			<select class="form-select" id="identificacion" name="identificacion" required>
				<option selected disabled value="">Seleccione la identificación</option>
				<option value="CREDENCIAL_PARA_VOTAR">CREDENCIAL PARA VOTAR</option>
				<option value="LICENCIA_DE_CONDUCIR">LICENCIA DE CONDUCIR</option>
				<option value="CARTA_DE_NATURALIZACION">CARTA DE NATURALIZACIÓN</option>
				<option value="CARTILLA_MILITAR">CARTILLA MILITAR</option>
				<option vaulue="CURP">CURP</option>
				<option vaulue="CEDULA_PROFESIONAL">CÉDULA PROFESIONAL</option>
				<option vaulue="CREDENCIAL_EMPLEO">CREDENCIAL DE EMPLEO</option>
				<option vaulue="CREDENCIAL_ESTUDIANTE">CREDENCIAL DE ESTUDIANTE</option>
				<option vaulue="CREDENCIAL_IMSS">CREDENCIAL DE AFILIACIÓN AL IMSS</option>
				<option vaulue="CREDENCIAL_ISSSTE">CREDENCIAL DE AFILIACIÓN AL ISSSTE</option>
				<option vaulue="CREDENCIAL_ISSSTECALI">CREDENCIAL DE AFILIACIÓN AL ISSSTECALI</option>
				<option vaulue="CREDENCIAL_INAPAM">CREDENCIAL INAPAM</option>
				<option vaulue="PASAPORTE">PASAPORTE</option>
				<option vaulue="CERTIFICADO_ESCOLAR">CERTIFICADO ESCOLAR</option>
				<option vaulue="BOLETA_CALIFICACIONES">BOLETA DE CALIFICACIONES</option>
				<option vaulue="ACTA_NACIMIENTO"> ACTA DE NACIMIENTO</option>
				<option vaulue="TARJETA_BANCARIA">TARJETA BANCARIA</option>
				<option vaulue="GAFETE">GAFETE</option>
				<option vaulue="CONSTANCIA_ESTUDIOS">CONSTANCIA DE ESTUDIOS</option>
				<option vaulue="NINGUNA">NINGUNA</option>
			</select>
			<div class="invalid-feedback">
				El tipo de identificación es obligatorio.
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="numero_ide" class="form-label fw-bold">Número de identificación</label>
			<input type="text" class="form-control" id="numero_ide" name="numero_ide">
		</div>


		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="e_civil" class="form-label fw-bold">Estado civil</label>
			<select class="form-select" id="e_civil" name="e_civil" required>
				<option selected disabled value="">Seleccione su estado civil...</option>
				<option value="SOLTERO">SOLTERO</option>
				<option value="CASADO">CASADO</option>
				<option value="DIVORCIADO">DIVORCIADO</option>
				<option value="SEPARCION EN PROCESO JUDICIAL">SEPARCION EN PROCESO JUDICIAL</option>
				<option value="VIUDO">VIUDO</option>
				<option value="CONCUBINATO">CONCUBINATO</option>
			</select>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="ocupacion" class="form-label fw-bold">Ocupación</label>
			<input type="text" class="form-control" id="ocupacion" name="ocupacion">
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="orientacion" class="form-label fw-bold input-required">Orientación sexual</label>
			<input type="text" class="form-control" id="orientacion" name="orientacion" required>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="discapacidad" class="form-label fw-bold input-required">¿Padece alguna discapacidad?</label>
			<select class="form-select" id="discapacidad" name="discapacidad" onchange="" required>
				<option selected disabled value="">Seleccione si padece alguna discapacidad</option>
				<option value="D_VISUAL">VISUAL</option>
				<option value="D_FISICA">FISICA</option>
				<option value="D_AUDITIVA">AUDITIVA</option>
				<option vaulue="D_NINGUNA">NINGUNA</option>
			</select>
			<div class="invalid-feedback">
				El campo discapacidad es obligatorio.
			</div>
		</div>

		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="idioma" class="form-label fw-bold input-required">Idioma</label>
			<select class="form-select" id="idioma" name="idioma" required>
				<option selected disabled value="">Seleccione el idioma</option>
				<option value="ES">ESPAÑOL</option>
				<option value="EN">INGLES</option>
			</select>
			<div class="invalid-feedback">
				Debes elegir un idioma
			</div>
		</div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			<label for="documento" class="form-label fw-bold input-required">Foto de identificación</label>
			<input class="form-control" type="file" id="documento" name="documento" accept="image/*" capture="user" required multiple>
			<div class="form-text">Para tomar foto <a class="link-yellow" type="button" data-bs-toggle="modal" data-bs-target="#take_photo_modal">clic aquí <i class="bi bi-camera-fill"></i></a></div>
		</div>

		<div class="col-12">
			<hr>
		</div>
		
		<div class="col-12">
			<?php include('e_firma_canva.php') ?>
		</div>

		<div class="col-12 text-center items-center mt-2">
			<input class="form-check-input" type="checkbox" value="" id="notificaciones_check" required>
			<label class="form-check-label" for="notificaciones_check">
				Acepto envío de notificaciones
			</label>
			<div class="invalid-feedback">
				Debes aceptar el envío de mnotificaciones para continuar
			</div>
		</div>
		<div class="col-12 text-center">
			<button class="btn btn-primary " type="submit">REGISTRARME</button>
		</div>
	</form>
</div>
<?php include('take_photo_modal.php') ?>
<?php include('information_validation_modal.php') ?>
<script>
	function readURL(input) {
		if (input.files && input.files[0]) { //Revisamos que el input tenga contenido
			var reader = new FileReader(); //Leemos el contenido

			reader.onload = function(e) { //Al cargar el contenido lo pasamos como atributo de la imagen de arriba
				$('#imgSalidaModal').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#documento").change(
		() => { //Cuando el input cambie (se cargue un nuevo archivo) se va a ejecutar de nuevo el cambio de imagen y se verá reflejado.
			readURL(this);
		});

	function enviar_datos() {
		let nombre = $("#nombres").val();
		let apellido1 = $("#apellido_paterno").val();
		let apellido2 = $("#apellido_materno").val();
		let fechanac = $("#fecha_nacimiento").val();
		let municipio = $("#municipio").val();
		let localidad = $("#localidad").val();
		let colonia = $("#colonia_select").val();
		let calle = $("#calle").val();
		let nexterior = $("#exterior").val();
		let ninterior = $("#interior").val();
		let correo = $("#correo").val();
		let tipo = $("#identificacion").val();
		let activoFijo = document.querySelector('input[name="sexo"]:checked').value;
		$('#information_validation').modal('show');
		$('#nombre').val(nombre);
		$('#apellido1').val(apellido1);
		$('#apellido2').val(apellido2);
		$('#fechanacimiento').val(fechanac);
		$('#municipiom').val(municipio);
		$('#localidadm').val(localidad);
		$('#coloniam').val(colonia);
		$('#callem').val(calle);
		$('#exteriorm').val(nexterior);
		$('#interiorm').val(ninterior);
		$('#correom').val(correo);
		$('#identificacionm').val(tipo);
		$('#sexom').val(activoFijo);
		$('#information_validation').modal('show');
	}
</script>
<script>
	(function() {
		'use strict'
		var forms = document.querySelectorAll('.needs-validation');
		var inputsText = document.querySelectorAll('input[type="text"]');
		var inputsEmail = document.querySelectorAll('input[type="email"]');

		Array.prototype.slice.call(forms)
			.forEach(function(form) {
				form.addEventListener('submit', function(event) {
					event.preventDefault();

					if (!form.checkValidity()) {
						event.stopPropagation();
					} else {
						enviar_datos();
						// $('#otp_validation_modal').modal('show');
					}

					form.classList.add('was-validated')
				}, false)
			})

		inputsText.forEach((input) => {
			input.addEventListener('input', function(event) {
				event.target.value = event.target.value.toUpperCase();
			}, false)
		})

		inputsEmail.forEach((input) => {
			input.addEventListener('input', function(event) {
				event.target.value = event.target.value.toLowerCase();
			}, false)
		})
	})()

	const activateColoniaInput = (e) => {
		let select_colonia = document.getElementById('colonia_select');
		let colonia = document.getElementById('colonia');

		if (e.target.value === '0') {
			select_colonia.classList.add('d-none');
			colonia.value = '';
			colonia.classList.remove('d-none');
			colonia.focus();
		} else {
			colonia.value = e.target.value;
		}
	};

	const activatePaisInput = (e) => {
		let select_pais = document.getElementById('select_pais');
		let pais = document.getElementById('pais');

		if (e.target.value === 'OTRO') {
			select_pais.classList.add('d-none');
			pais.value = '';
			pais.classList.remove('d-none');
			pais.focus();
		} else {
			pais.value = e.target.value;
		}
	};

	$(function() {
		$('#fecha_nacimiento').on('change', calcularEdad);
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
		$('#edad').val(edad);
		if (edad < 18) {
			document.getElementById("menor").classList.remove('d-none');
		} else {
			document.getElementById("menor").classList.add('d-none');
		}
	}

	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
		return new bootstrap.Tooltip(tooltipTriggerEl)
	});
</script>

<?= $this->endSection() ?>
