<form id="persona_fisica_form_insert" action="" method="post" class="row needs-validation" novalidate>
	<div class="col-12 mb-3">
		<h3 class="font-weight-bold mb-4 text-center">DATOS DE LA PERSONA FÍSICA</h3>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="calidad_juridica_pf" class="form-label font-weight-bold">Calidad Jurídica</label>
		<select class="form-control" id="calidad_juridica_new" name="calidad_juridica_new" required>
			<option selected value=""></option>
			<?php foreach ($body_data->calidadJuridica as $index => $calidadJuridica) { ?>
				<option value="<?= $calidadJuridica->PERSONACALIDADJURIDICAID ?>"> <?= $calidadJuridica->PERSONACALIDADJURIDICADESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="desaparecida_new" class="form-label font-weight-bold">Desaparecida</label>
		<select class="form-control" id="desaparecida_new" name="desaparecida_new">
			<option selected disabled value=""></option>
			<option value="S">SI</option>
			<option value="N">NO</option>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nombre_new" class="form-label font-weight-bold">Nombre(s)</label>
		<input type="text" class="form-control" id="nombre_new" name="nombre_new" maxlength="100" required>
		<div class="invalid-feedback">
			El nombre es obligatorio
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="apellido_paterno_new" class="form-label font-weight-bold">Apellido paterno</label>
		<input type="text" class="form-control" id="apellido_paterno_new" name="apellido_paterno_new" maxlength="50">
		<div class="invalid-feedback">
			El apellido paterno es obligatorio
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="apellido_materno_new" class="form-label font-weight-bold">Apellido materno</label>
		<input type="text" class="form-control" id="apellido_materno_new" name="apellido_materno_new" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="fecha_nacimiento_new" class="form-label font-weight-bold">Fecha de nacimiento</label>
		<input type="date" class="form-control" id="fecha_nacimiento_new" name="fecha_nacimiento_new" max="<?= ((int)date("Y")) - 18 . '-' . date("m") . '-' . date("d") ?>">
		<div class="invalid-feedback">
			La fecha de nacimiento es obligatoria
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="edad_new" class="form-label font-weight-bold">Edad aproximada</label>
		<input type="number" class="form-control" id="edad_new" name="edad_new">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="sexo_new" class="form-label font-weight-bold">Sexo</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="sexo_new" id="sexo_new" value="M">
			<label class="form-check-label" for="sexo_new">MASCULINO</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="sexo_new" id="sexo_new" value="F">
			<label class="form-check-label" for="sexo_new">FEMENINO</label>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="telefono_new" class="form-label font-weight-bold">Número de télefono</label>
		<input type="number" class="form-control" id="telefono_new" name="telefono_new" max="99999999999999999999" minlenght="6" maxlength="20" oninput="clearInputPhone(event);">
		<!-- <small>Mínimo 6 digitos</small> -->
		<input type="number" id="codigo_pais_new" name="codigo_pais_new" maxlength="3" hidden>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="telefono_new2" class="form-label font-weight-bold">Número de télefono adicional</label>
		<input type="number" class="form-control" id="telefono_new2" name="telefono_new2" max="99999999999999999999" minlenght="6" maxlength="20" oninput="clearInputPhone(event);">
		<!-- <small>Mínimo 6 digitos</small> -->
		<input type="number" id="codigo_pais_2_new" name="codigo_pais_2_new" maxlength="3" hidden>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="correo_new" class="form-label font-weight-bold">Correo electrónico</label>
		<div class="input-group">
			<input type="email" class="form-control" name="correo_new" id="correo_new" maxlength="100">
		</div>
		<div class="invalid-feedback">
			El correo esta erroneo
		</div>
	</div>
	<div class="col-12">
		<h3 class="font-weight-bold mb-4 text-center">DATOS DE ORIGEN</h3>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nacionalidad_new" class="form-label font-weight-bold">Nacionalidad</label>
		<select class="form-control" id="nacionalidad_new" name="nacionalidad_new">
			<option selected disabled value="">Selecciona la nacionalidad</option>
			<?php foreach ($body_data->nacionalidades as $index => $nac) { ?>
				<option value="<?= $nac->PERSONANACIONALIDADID ?>" <?= $nac->PERSONANACIONALIDADDESCR == 'MEXICANA' ? 'selected' : '' ?>> <?= $nac->PERSONANACIONALIDADDESCR ?> </option>
			<?php } ?>
		</select>
		<div class="invalid-feedback">
			La nacionalidad es obligatoria.
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="estado_select_origen_new" class="form-label font-weight-bold">Estado origen</label>
		<select class="form-control" id="estado_select_origen_new" name="estado_select_origen_new">
			<option selected disabled value="">Selecciona el estado</option>
			<?php foreach ($body_data->estados as $index => $estado) { ?>
				<option value="<?= $estado->ESTADOID ?>"> <?= $estado->ESTADODESCR ?> </option>
			<?php } ?>
		</select>
		<div class="invalid-feedback">
			El estado es obligatorio
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="municipio_select_origen_new" class="form-label font-weight-bold">Municipio origen</label>
		<select class="form-control" id="municipio_select_origen_new" name="municipio_select_origen_new">
			<option selected disabled value="">Selecciona el municipio</option>
		</select>
		<div class="invalid-feedback">
			El municipio es obligatorio
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="idioma_new" class="form-label font-weight-bold">Idioma</label>
		<select class="form-control" id="idioma_new" name="idioma_new">
			<option selected disabled value="">Selecciona el idioma</option>
			<?php foreach ($body_data->idiomas as $index => $nac) { ?>
				<option value="<?= $nac->PERSONAIDIOMAID ?>" <?= $nac->PERSONAIDIOMADESCR == 'ESPAÑOL' ? 'selected' : '' ?>> <?= $nac->PERSONAIDIOMADESCR ?> </option>
			<?php } ?>
		</select>
		<div class="invalid-feedback">
			Debes elegir un idioma
		</div>
	</div>
	<div class="col-12">
		<h3 class="font-weight-bold mb-4 text-center">DOMICILIO ACTUAL</h3>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="pais_select_new" class="form-label font-weight-bold">País</label>
		<select class="form-control" id="pais_select_new" name="pais_select_new">
			<?php foreach ($body_data->paises as $index => $pais) { ?>
				<option value="<?= $pais->ISO_2 ?>" <?= $pais->ISO_2 == 'MX' ? 'selected' : '' ?>> <?= mb_strtoupper($pais->NAME, 'UTF-8') ?> </option>
			<?php } ?>
		</select>
		<div class="invalid-feedback">
			El país es obligatorio
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="estado_select_new" class="form-label font-weight-bold">Estado</label>
		<select class="form-control" id="estado_select_new" name="estado_select_new">
			<option selected disabled value="">Selecciona el estado</option>
			<?php foreach ($body_data->estados as $index => $estado) { ?>
				<option value="<?= $estado->ESTADOID ?>"> <?= $estado->ESTADODESCR ?> </option>
			<?php } ?>
		</select>
		<div class="invalid-feedback">
			El estado es obligatorio
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="municipio_select_new" class="form-label font-weight-bold">Municipio</label>
		<select class="form-control" id="municipio_select_new" name="municipio_select_new">
			<option selected disabled value="">Selecciona el municipio</option>
		</select>
		<div class="invalid-feedback">
			El municipio es obligatorio
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="localidad_select_new" class="form-label font-weight-bold">Localidad</label>
		<select class="form-control" id="localidad_select_new" name="localidad_select_new">
			<option selected disabled value="">Selecciona la localidad</option>
		</select>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="colonia_select_new" class="form-label font-weight-bold">Colonia</label>
		<select class="form-control" id="colonia_select_new" name="colonia_select_new">
			<option selected disabled value="">Selecciona la colonia</option>
		</select>
		<input type="text" class="form-control d-none" id="colonia_new" name="colonia_new" maxlength="100">
		<small id="colonia_new-message" class="text-primary fw-bold d-none">Si no encuentras tu colonia selecciona otro</small>
		<div class="invalid-feedback">
			La colonia es obligatoria
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="cp_new" class="form-label font-weight-bold">Código postal</label>
		<input type="number" class="form-control" id="cp_new" maxlength="10" oninput="clearInputPhone(event);" name="cp_new">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="calle_new" class="form-label font-weight-bold">Calle</label>
		<input type="text" class="form-control" id="calle_new" name="calle_new" maxlength="100">
		<div class="invalid-feedback">
			La calle es obligatoria
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="exterior_new" class="form-label font-weight-bold">Número exterior</label>
		<input type="text" class="form-control" id="exterior_new" name="exterior_new" maxlength="10">
		<div class="invalid-feedback">
			El número exterior es obligatorio
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="interior_new" class="form-label font-weight-bold">Número interior</label>
		<input type="text" class="form-control" id="interior_new" name="interior_new" maxlength="10">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="manzana_new" class="form-label font-weight-bold">Manzana</label>
		<input type="text" class="form-control" id="manzana_new" name="manzana_new" maxlength="100">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="lote_new" class="form-label font-weight-bold">Lote</label>
		<input type="text" class="form-control" id="lote_new" name="lote_new" maxlength="100">
	</div>
	<div class="col-12">
		<h3 class="font-weight-bold mb-4 text-center">DATOS DE IDENTIFICACIÓN</h3>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="identificacion_new" class="form-label font-weight-bold">Identificación</label>
		<select class="form-control" id="identificacion_new" name="identificacion_new">
			<option selected disabled value="">Selecciona la identificación</option>
			<?php foreach ($body_data->tiposIdentificaciones as $index => $identificacion) { ?>
				<option value="<?= $identificacion->PERSONATIPOIDENTIFICACIONID ?>"> <?= $identificacion->PERSONATIPOIDENTIFICACIONDESCR ?> </option>
			<?php } ?>
		</select>
		<div class="invalid-feedback">
			El tipo de identificación es obligatorio.
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="numero_ide_new" class="form-label font-weight-bold">Número de identificación</label>
		<input type="text" class="form-control" id="numero_ide_new" name="numero_ide_new">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="e_civil_new" class="form-label font-weight-bold">Estado civil</label>
		<select class="form-control" id="e_civil_new" name="e_civil_new">
			<option selected disabled value="">Selecciona su estado civil</option>
			<?php foreach ($body_data->edoCiviles as $index => $edo) { ?>
				<option value="<?= $edo->PERSONAESTADOCIVILID ?>"> <?= $edo->PERSONAESTADOCIVILDESCR ?> </option>
			<?php } ?>
		</select>
		<div class="invalid-feedback">
			El estado civil es obligatorio.
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="escolaridad_new" class="form-label font-weight-bold">Escolaridad</label>
		<select class="form-control" id="escolaridad_new" name="escolaridad_new">
			<option selected disabled value="">Selecciona la escolaridad</option>
			<?php foreach ($body_data->escolaridades as $index => $escolaridad) { ?>
				<option value="<?= $escolaridad->PERSONAESCOLARIDADID ?>"> <?= $escolaridad->PERSONAESCOLARIDADDESCR ?> </option>
			<?php } ?>
		</select>
		<div class="invalid-feedback">
			La escolaridad es obligatoria
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="ocupacion_new" class="form-label font-weight-bold">Ocupación</label>
		<select class="form-control" id="ocupacion_new" name="ocupacion_new">
			<option selected disabled value="">Selecciona la ocupacion</option>
			<?php foreach ($body_data->ocupaciones as $index => $ocupacion) { ?>
				<option value="<?= $ocupacion->PERSONAOCUPACIONID ?>"> <?= $ocupacion->PERSONAOCUPACIONDESCR ?> </option>
			<?php } ?>
		</select>
		<input type="text" class="form-control d-none" id="ocupacion_descr_new" name="ocupacion_descr_new" maxlength="100">
		<small id="ocupacion-new-message" class="text-primary fw-bold d-none">Si no encuentras tu ocupación selecciona otro</small>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="discapacidad_new" class="form-label font-weight-bold">¿Padece alguna discapacidad?</label>
		<input type="text" class="form-control" id="discapacidad_new" name="discapacidad_new" maxlength="100">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="leer_new" class="form-label font-weight-bold">¿Sabe leer?</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="leer_new" id="leer_new" value="S">
			<label class="form-check-label" for="flexRadioDefault1">Si</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="leer_new" id="leer_new" value="N">
			<label class="form-check-label" for="flexRadioDefault2">No</label>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="escribir_new" class="form-label font-weight-bold">¿Sabe escribir?</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="escribir_new" id="escribir_new" value="S">
			<label class="form-check-label" for="flexRadioDefault1">Si</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="escribir_new" id="escribir_new" value="N">
			<label class="form-check-label" for="flexRadioDefault2">No</label>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="facebook_new" class="form-label font-weight-bold">Facebook</label>
		<div class="input-group">
			<span class="input-group-text" id="facebook_vanity"><i class='fab fa-facebook'></i></span>
			<input type="text" class="form-control" name="facebook_new" id="facebook_new" aria-describedby="facebook_vanity" maxlength="200">
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="instagram_new" class="form-label font-weight-bold">Instagram</label>
		<div class="input-group">
			<span class="input-group-text" id="instagram_vanity"><i class='fab fa-instagram'></i></span>
			<input type="text" class="form-control" name="instagram_new" id="instagram_new" aria-describedby="instagram_vanity" maxlength="200">
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="twitter_new" class="form-label font-weight-bold">Twitter</label>
		<div class="input-group">
			<span class="input-group-text" id="twitter_vanity"><i class='fab fa-twitter'></i></span>
			<input type="text" class="form-control" name="twitter_new" id="twitter_new" aria-describedby="twitter_vanity" maxlength="200">
		</div>
	</div>


	<div class="col-12 mb-3 text-center">
		<button type="submit" id="insertPersonaFisica" name="insertPersonaFisica" class="btn btn-primary font-weight-bold">AGREGAR PERSONA FÍSICA</button>
	</div>
</form>

<script>
	(function() {
		'use strict'

		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.querySelectorAll('.needs-validation')

		// Loop over them and prevent submission
		Array.prototype.slice.call(forms)
			.forEach(function(form) {
				form.addEventListener('submit', function(event) {
					if (!form.checkValidity()) {
						event.preventDefault()
						event.stopPropagation()
					}

					form.classList.add('was-validated')
				}, false)
			})
	})()
	document.querySelector('#ocupacion_new').addEventListener('change', (e) => {
		let select_ocupacion = document.querySelector('#ocupacion_new');
		let input_ocupacion = document.querySelector('#ocupacion_descr_new');

		if (e.target.value === '999') {
			select_ocupacion.classList.add('d-none');
			input_ocupacion.classList.remove('d-none');
			input_ocupacion.value = "";
			input_ocupacion.focus();
		} else {
			input_ocupacion.value = e.target.value;
		}
	});
</script>