<div class="row">
	<h3 class="fw-bold text-center text-blue pb-3">Persona moral</h3>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="rfc_empresa" class="form-label fw-bold input-required">RFC:</label>
		<input type="text" class="form-control" id="rfc_empresa" name="rfc_empresa" required>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="marca_comercial_d" class="form-label fw-bold">Marca comercial:</label>
		<input type="text" class="form-control" id="marca_comercial_d" name="marca_comercial_d">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="razon_social" class="form-label fw-bold input-required">Razón social:</label>
		<input type="text" class="form-control" id="razon_social" name="razon_social" required>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="giro_empresa_denuncia" class="form-label fw-bold input-required">Giro de la empresa:</label>
		<select class="form-select" id="giro_empresa_denuncia" name="giro_empresa_denuncia" required>
			<option selected disabled value="">Elige el giro</option>
			<?php foreach ($body_data->giros as $index => $giro) { ?>
				<option value="<?= $giro->PERSONAMORALGIROID ?>"> <?= $giro->PERSONAMORALGIRODESCR ?> </option>
			<?php } ?>
		</select>
		<div class="invalid-feedback">
			Por favor, selecciona un giro.
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="correo_empresa" class="form-label fw-bold input-required">Correo electrónico</label>
		<div class="input-group">
			<span class="input-group-text" id="correo_vanity"><i class="bi bi-envelope-fill"></i></span>
			<input type="email" class="form-control" name="correo_empresa_c" id="correo_empresa_c" aria-describedby="correo_vanity" maxlength="100" required>
		</div>
		<div class="invalid-feedback">
			El correo esta erroneo
		</div>
	</div>
	<!-- <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="poder_volumen" class="form-label fw-bold">Volumen:</label>
		<input type="text" class="form-control" id="poder_volumen" name="poder_volumen">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="poder_no_poder" class="form-label fw-bold">Número de poder:</label>
		<input type="text" class="form-control" id="poder_no_poder" name="poder_no_poder">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="poder_no_notario" class="form-label fw-bold">Número de notario:</label>
		<input type="text" class="form-control" id="poder_no_notario" name="poder_no_notario">
	</div> -->
</div>
<div class="row">
<h3 class="fw-bold text-center text-blue pb-3">Dirección de la persona moral</h3>
<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="estado_empresa" class="form-label fw-bold input-required">Estado:</label>
		<select class="form-select" id="estado_empresa_c" name="estado_empresa_c" required>
			<option selected disabled value="">Elige el estado</option>
			<?php foreach ($body_data->estados as $index => $estado) { ?>
				<option value="<?= $estado->ESTADOID ?>"> <?= $estado->ESTADODESCR ?> </option>
			<?php } ?>
		</select>
		<div class="invalid-feedback">
			Por favor, selecciona un estado.
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="municipio_empresa" class="form-label fw-bold input-required">Municipio:</label>
		<select class="form-select" id="municipio_empresa_c" name="municipio_empresa_c" required>
			<option selected disabled value="">Elige el municipio</option>
		</select>
		<div class="invalid-feedback">
			Por favor, selecciona un municipio.
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="localidad_empresa" class="form-label fw-bold input-required">Localidad:</label>
		<select class="form-select" id="localidad_empresa_c" name="localidad_empresa_c" required>
			<option selected disabled value="">Elige la localidad</option>
		</select>
		<div class="invalid-feedback">
			Por favor, selecciona una localidad.
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="colonia" class="form-label fw-bold input-required">Colonia</label>
		<select class="form-select" id="colonia_select_empresa_c" name="colonia_select_empresa_c" required>
			<option selected disabled value="">Selecciona la colonia</option>
		</select>
		<input type="text" class="form-control d-none" id="colonia_input_empresa_c" name="colonia_input_empresa_c" maxlength="100" required>
		<small id="colonia-message" class="text-primary fw-bold">Si no encuentras la colonia selecciona otro</small>
		<div class="invalid-feedback">
			La colonia es obligatoria
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="calle_empresa" class="form-label fw-bold input-required">Calle:</label>
		<input class="form-control" type="text" id="calle_empresa_c" name="calle_empresa_c" required>
		<div class="invalid-feedback">
			La calle es obligatorio
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="n_empresa" class="form-label fw-bold input-required">Número exterior</label>
		<input type="text" class="form-control" id="n_empresa_c" name="n_empresa_c" maxlength="10" required>
		<div class="invalid-feedback">
			El número exterior es obligatorio
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="ninterior_empresa" class="form-label fw-bold">Número interior</label>
		<input type="text" class="form-control" id="ninterior_empresa_c" name="ninterior_empresa_c" maxlength="10">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="referencia_empresa" class="form-label fw-bold">Referencias</label>
		<input type="text" class="form-control" id="referencia_empresa_c" name="referencia_empresa_c" maxlength="300">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="telefono_empresa" class="form-label fw-bold input-required ">Télefono </label>
		<input type="number" class="form-control" id="telefono_empresa_c" name="telefono_empresa_c" required minlenght="10" maxlength="10" oninput="clearInputPhone(event);" pattern="[0-9]+">
		<small>El campo número debe tener 10 dígitos</small>
		<div class="invalid-feedback">
			El campo número debe tener 10 dígitos
		</div>
		<input type="number" id="codigo_pais" name="codigo_pais" maxlength="3" hidden>
	</div>
</div>
<div class="row" id="contenedor-direcciones">
	<h3 class="fw-bold text-center text-blue pb-3">Dirección de notificación</h3>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="direccion" class="form-label fw-bold input-required">Dirección:</label>
		<select class="form-select" id="direccion" name="direccion" required>
			<option selected disabled value="">Elige la dirección</option>
		</select>
		<div class="invalid-feedback">
			Selecciona la dirección
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="correo_empresa" class="form-label fw-bold input-required">Correo electrónico</label>
		<div class="input-group">
			<span class="input-group-text" id="correo_vanity"><i class="bi bi-envelope-fill"></i></span>
			<input type="email" class="form-control" name="correo_empresa" id="correo_empresa" aria-describedby="correo_vanity" maxlength="100" required>
		</div>
		<div class="invalid-feedback">
			El correo esta erroneo
		</div>
	</div>


	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="estado_empresa" class="form-label fw-bold input-required">Estado:</label>
		<select class="form-select" id="estado_empresa" name="estado_empresa" required readonly>
			<option selected disabled value="">Elige el estado</option>
			<?php foreach ($body_data->estados as $index => $estado) { ?>
				<option value="<?= $estado->ESTADOID ?>"> <?= $estado->ESTADODESCR ?> </option>
			<?php } ?>
		</select>
		<div class="invalid-feedback">
			Por favor, selecciona un estado.
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="municipio_empresa" class="form-label fw-bold input-required">Municipio:</label>
		<select class="form-select" id="municipio_empresa" name="municipio_empresa" required>
			<option selected disabled value="">Elige el municipio</option>
		</select>
		<div class="invalid-feedback">
			Por favor, selecciona un municipio.
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="localidad_empresa" class="form-label fw-bold input-required">Localidad:</label>
		<select class="form-select" id="localidad_empresa" name="localidad_empresa" required>
			<option selected disabled value="">Elige la localidad</option>
		</select>
		<div class="invalid-feedback">
			Por favor, selecciona una localidad.
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="zona_empresa" class="form-label fw-bold">Zona:</label>
		<input type="text" class="form-control" id="zona_empresa" name="zona_empresa" maxlength="10" required>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="colonia" class="form-label fw-bold input-required">Colonia</label>
		<select class="form-select" id="colonia_select_empresa" name="colonia_select_empresa" required>
			<option selected disabled value="">Selecciona la colonia</option>
		</select>
		<input type="text" class="form-control d-none" id="colonia_input_empresa" name="colonia_input_empresa" maxlength="100" required>
		<small id="colonia-message" class="text-primary fw-bold">Si no encuentras la colonia selecciona otro</small>
		<div class="invalid-feedback">
			La colonia es obligatoria
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="calle_empresa" class="form-label fw-bold input-required">Calle:</label>
		<input class="form-control" type="text" id="calle_empresa" name="calle_empresa" required>
		<div class="invalid-feedback">
			La calle es obligatorio
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="n_empresa" class="form-label fw-bold input-required">Número exterior</label>
		<input type="text" class="form-control" id="n_empresa" name="n_empresa" maxlength="10" required>
		<div class="invalid-feedback">
			El número exterior es obligatorio
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="ninterior_empresa" class="form-label fw-bold">Número interior</label>
		<input type="text" class="form-control" id="ninterior_empresa" name="ninterior_empresa" maxlength="10">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="referencia_empresa" class="form-label fw-bold">Referencias</label>
		<input type="text" class="form-control" id="referencia_empresa" name="referencia_empresa" maxlength="300">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="telefono_empresa" class="form-label fw-bold input-required ">Télefono </label>
		<input type="number" class="form-control" id="telefono_empresa" name="telefono_empresa" required minlenght="10" maxlength="10" oninput="clearInputPhone(event);" pattern="[0-9]+">
		<small>El campo número debe tener 10 dígitos</small>
		<div class="invalid-feedback">
			El campo número debe tener 10 dígitos
		</div>
		<input type="number" id="codigo_pais" name="codigo_pais" maxlength="3" hidden>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">

		<!-- Botón para agregar una dirección adicional -->
		<button id="agregar-direccion" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarDireccionModal" disabled>Agregar otra dirección</button>
	</div>
</div>