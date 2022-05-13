<div class="modal fade" id="information_validation" tabindex="-1" aria-labelledby="resetLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered  modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h5 class="modal-title" id="bs">Validación de informacion</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="needs-validation g-3" novalidate>
					<div class="mb-3" id="divValidationDatos">
						<label for="nombre" class="col-form-label">Nombre: </label>
						<input type="text" class="form-control" id="nombre" name="nombre" disabled>
						<label for="apellido_paterno" class="col-form-label">Apellido paterno: </label>
						<input type="text" class="form-control" id="apellido1" name="apellido_paterno" disabled>
						<label for="apellido_materno" class="col-form-label">Apellido materno: </label>
						<input type="text" class="form-control" id="apellido2" name="apellido_materno" disabled>
						<label for="fecha_nacimiento" class="col-form-label">Fecha de nacimiento: </label>
						<input type="text" class="form-control" id="fechanacimiento" name="fecha_nacimiento" disabled>
						<label for="municipio" class="col-form-label">Municipio: </label>
						<input type="text" class="form-control" id="municipiom" name="municipio" disabled>
						<label for="localidad" class="col-form-label">Localidad: </label>
						<input type="text" class="form-control" id="localidadm" name="localidad" disabled>
						<label for="colonia_select" class="col-form-label">Colonia: </label>
						<input type="text" class="form-control" id="coloniam" name="colonia_select" disabled>
						<label for="calle" class="col-form-label">Calle o avenida: </label>
						<input type="text" class="form-control" id="callem" name="calle" disabled>
						<label for="exterior" class="col-form-label">Numero exterior: </label>
						<input type="text" class="form-control" id="exteriorm" name="exterior" disabled>
						<label for="interior" class="col-form-label">Numero interior: </label>
						<input type="text" class="form-control" id="interiorm" name="interior" disabled>
						<label for="correo" class="col-form-label">Correo electronico: </label>
						<input type="text" class="form-control" id="correom" name="correo" disabled>
						<label for="identificacion" class="col-form-label">Tipo identificacion: </label>
						<input type="text" class="form-control" id="identificacionm" name="identificacion" disabled>
						<label for="identificacion" class="col-form-label">Foto de identificacion: </label>
						<img id="imgSalidaModal" class="form-control" />
						<label for="sexo" class="col-form-label">Sexo biologico: </label>
						<input type="text" class="form-control" id="sexom" name="sexo" disabled>
						<label for="identificacion" class="col-form-label">Firma digital: </label>
						<img id="imgFirma" class="form-control" />
					</div>
					<button type="submit" id="submit" data-bs-target="#otp_validation_modal" data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-primary">Mi información esta correcta</button>
				</form>
			</div>
		</div>
	</div>
</div>
<?php include('otp_validation_modal.php') ?>
