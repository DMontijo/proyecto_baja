<form id="persona_fisica_form_da" action="" method="post" class="row p-0 m-0 needs-validation" novalidate>
	<input type="hidden" class="form-control" id="pf_id_da" name="pf_id_da">
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="tipo_identificacion_pf_da" class="form-label font-weight-bold">Tipo identificación</label>
		<select class="form-control" id="tipo_identificacion_pf_da" name="tipo_identificacion_pf_da">
			<option selected value=""></option>
			<?php foreach ($body_data->tiposIdentificaciones as $index => $identificaciones) { ?>
				<option value="<?= $identificaciones->PERSONATIPOIDENTIFICACIONID ?>"> <?= $identificaciones->PERSONATIPOIDENTIFICACIONDESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="numero_identidad_pf_da" class="form-label font-weight-bold">Numero de identificación</label>
		<input type="text" class="form-control" id="numero_identidad_pf_da" name="numero_identidad_pf_da">
	</div>
	<div class="col-12">
		<hr>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nombre_pf_da" class="form-label font-weight-bold">Nombre(s)</label>
		<input type="text" class="form-control" id="nombre_pf_da" name="nombre_pf_da" maxlength="100">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="apellido_paterno_pf_da" class="form-label font-weight-bold">Apellido paterno</label>
		<input type="text" class="form-control" id="apellido_paterno_pf_da" name="apellido_paterno_pf_da" maxlength="50">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="apellido_materno_pf_da" class="form-label font-weight-bold">Apellido materno</label>
		<input type="text" class="form-control" id="apellido_materno_pf_da" name="apellido_materno_pf_da" maxlength="50">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nacionalidad_pf_da" class="form-label font-weight-bold">Nacionalidad</label>
		<select class="form-control" id="nacionalidad_pf_da" name="nacionalidad_pf_da">
			<option selected value=""></option>
			<?php foreach ($body_data->nacionalidades as $index => $nacionalidades) { ?>
				<option value="<?= $nacionalidades->PERSONANACIONALIDADID ?>"> <?= $nacionalidades->PERSONANACIONALIDADDESCR ?> </option>
			<?php } ?>
		</select>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="idioma_pf_da" class="form-label font-weight-bold">Idioma</label>
		<select class="form-control" id="idioma_pf_da" name="idioma_pf_da">
			<option selected value=""></option>
			<?php foreach ($body_data->idiomas as $index => $idiomas) { ?>
				<option value="<?= $idiomas->PERSONAIDIOMAID ?>"> <?= $idiomas->PERSONAIDIOMADESCR ?> </option>
			<?php } ?>
		</select>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="edoorigen_pf_da" class="form-label font-weight-bold">Estado origen</label>
		<select class="form-control" id="edoorigen_pf_da" name="edoorigen_pf_da">
			<option selected value=""></option>
			<?php foreach ($body_data->estados as $index => $estados) { ?>
				<option value="<?= $estados->ESTADOID ?>"> <?= $estados->ESTADODESCR ?> </option>
			<?php } ?>
		</select>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="munorigen_pf_da" class="form-label font-weight-bold">Municipio origen</label>
		<select class="form-control" id="munorigen_pf_da" name="munorigen_pf_da">
			<option selected value=""></option>
		</select>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="telefono_pf_da" class="form-label font-weight-bold">Teléfono</label><br>
		<input type="number" class="form-control" id="telefono_pf_da" name="telefono_pf_da" max="99999999999999999999" minlenght="6" maxlength="20" oninput="clearInputPhone(event);">
		<input type="number" id="codigo_pais_pf_da" name="codigo_pais_pf_da" maxlength="3" hidden>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="telefono_pf_da_2" class="form-label font-weight-bold">Teléfono adicional</label><br>
		<input type="number" class="form-control" id="telefono_pf_da_2" name="telefono_pf_da_2" max="99999999999999999999" minlenght="6" maxlength="20" oninput="clearInputPhone(event);">
		<input type="number" id="codigo_pais_pf_da_2" name="codigo_pais_pf_da_2" maxlength="3" hidden>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="correo_pf_da" class="form-label font-weight-bold">Correo</label>
		<input type="email" class="form-control" id="correo_pf_da" name="correo_pf_da" maxlength="100">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="fecha_nacimiento_pf_da" class="form-label font-weight-bold">Fecha de Nacimiento</label>
		<input type="date" class="form-control" id="fecha_nacimiento_pf_da" name="fecha_nacimiento_pf_da" max="<?= date("Y-m-d") ?>">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="edad_pf_da" class="form-label font-weight-bold">Edad</label>
		<input type="number" class="form-control" id="edad_pf_da" name="edad_pf_da" maxlength="3">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="edoc_pf_da" class="form-label font-weight-bold">Estado civil</label>
		<select class="form-control" id="edoc_pf_da" name="edoc_pf_da">
			<option selected value=""></option>
			<?php foreach ($body_data->edoCiviles as $index => $edoCiviles) { ?>
				<option value="<?= $edoCiviles->PERSONAESTADOCIVILID ?>"> <?= $edoCiviles->PERSONAESTADOCIVILDESCR ?> </option>
			<?php } ?>
		</select>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="sexo_pf_da" class="form-label font-weight-bold">Sexo</label>
		<select class="form-control" id="sexo_pf_da" name="sexo_pf_da">
			<option selected value=""></option>
			<option value="F">FEMENINO</option>
			<option value="M">MASCULINO</option>
		</select>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="ocupacion_pf_da" class="form-label font-weight-bold">Profesión u Oficio</label>
		<select class="form-control" id="ocupacion_pf_da" name="ocupacion_pf_da">
			<option selected value=""></option>
			<?php foreach ($body_data->ocupaciones as $index => $ocupaciones) { ?>
				<option value="<?= $ocupaciones->PERSONAOCUPACIONID ?>"> <?= $ocupaciones->PERSONAOCUPACIONDESCR ?> </option>
			<?php } ?>
		</select>
		<input type="text" class="form-control d-none" id="ocupacion_pf_da_m" name="ocupacion_pf_da_m" maxlength="100">

	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="escolaridad_pf_da" class="form-label font-weight-bold">Escolaridad</label>
		<select class="form-control" id="escolaridad_pf_da" name="escolaridad_pf_da">
			<option selected value=""></option>
			<?php foreach ($body_data->escolaridades as $index => $escolaridades) { ?>
				<option value="<?= $escolaridades->PERSONAESCOLARIDADID ?>"> <?= $escolaridades->PERSONAESCOLARIDADDESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12">
		<label for="descripcionFisica_pf_da" class="form-label font-weight-bold">Descripción física</label>
		<textarea class="form-control" name="descripcionFisica_pf_da" id="descripcionFisica_pf_da" cols="30" rows="5" maxlength="300" oninput="mayuscTextarea(this)"></textarea>
	</div>
	<div class="col-12">
		<hr>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="calidad_juridica_pf_da" class="form-label font-weight-bold">Calidad Jurídica</label>
		<select class="form-control" id="calidad_juridica_pf_da" name="calidad_juridica_pf_da">
			<option selected value=""></option>
			<?php foreach ($body_data->calidadJuridica as $index => $calidadJuridica) { ?>
				<option value="<?= $calidadJuridica->PERSONACALIDADJURIDICAID ?>"> <?= $calidadJuridica->PERSONACALIDADJURIDICADESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="apodo_pf_da" class="form-label font-weight-bold">Apodo</label>
		<input type="text" class="form-control" id="apodo_pf_da" name="apodo_pf_da" maxlength="100">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="denunciante_pf_da" class="form-label font-weight-bold">Denunciante</label>
		<select class="form-control" id="denunciante_pf_da" name="denunciante_pf_da">
			<option selected value=""></option>
			<option value="S">Si</option>
			<option value="N">No</option>
		</select>
	</div>
	<div class="col-12">
		<hr>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="facebook_pf_da" class="form-label font-weight-bold">Facebook</label>
		<input type="text" class="form-control" id="facebook_pf_da" name="facebook_pf_da" maxlength="200">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="instagram_pf_da" class="form-label font-weight-bold">Instagram</label>
		<input type="text" class="form-control" id="instagram_pf_da" name="instagram_pf_da" maxlength="200">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="twitter_pf_da" class="form-label font-weight-bold">Twitter</label>
		<input type="text" class="form-control" id="twitter_pf_da" name="twitter_pf_da" maxlength="200">
	</div>
	<div class="col-12 my-4 text-center">
		<button type="submit" class="btn btn-primary font-weight-bold">ACTUALIZAR PERSONA FÍSICA</button>
	</div>
</form>
