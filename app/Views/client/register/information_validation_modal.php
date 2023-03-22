<div class="modal fade" id="information_validation" tabindex="-1" aria-labelledby="information_validation" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered  modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h5 class="modal-title" id="bs">Validación de informacion</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12">
						<div class="card shadow bg-blue mb-3">
							<div class="card-body text-white text-center fw-bold">
								Verifica que todos tus datos esten correctos.<br><br>De no estar correctos cierra este mensaje y regresa al paso correspondiente con el boton anterior y edítalos.
							</div>
						</div>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="nombre_modal" class="form-label fw-bold">Nombre(s): </label>
						<input type="text" class="form-control" id="nombre_modal" name="nombre_modal" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="apellido_paterno_modal" class="form-label fw-bold">Apellido paterno: </label>
						<input type="text" class="form-control" id="apellido_paterno_modal" name="apellido_paterno_modal" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="apellido_materno_modal" class="form-label fw-bold">Apellido materno: </label>
						<input type="text" class="form-control" id="apellido_materno_modal" name="apellido_materno_modal" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="fecha_nacimiento_modal" class="form-label fw-bold">Fecha de nacimiento: </label>
						<input type="text" class="form-control" id="fecha_nacimiento_modal" name="fecha_nacimiento_modal" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="sexo_modal" class="form-label fw-bold">Sexo: </label>
						<input type="text" class="form-control" id="sexo_modal" name="sexo_modal" disabled>
					</div>

					<div class="col-12">
						<hr>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="correo_modal" class="form-label fw-bold">Correo electronico: </label>
						<input type="text" class="form-control" id="correo_modal" name="correo_modal" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="telefono_modal" class="form-label fw-bold">Número de teléfono: </label>
						<input type="text" class="form-control" id="telefono_modal" name="telefono_modal" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="telefono2_modal" class="form-label fw-bold">Número de teléfono adicional: </label>
						<input type="text" class="form-control" id="telefono2_modal" name="telefono2_modal" disabled>
					</div>

					<div class="col-12">
						<hr>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="nacionalidad_modal" class="form-label fw-bold ">Nacionalidad:</label>
						<input type="text" class="form-control" id="nacionalidad_modal" name="nacionalidad_modal" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="idioma_modal" class="form-label fw-bold">Idioma: </label>
						<input type="text" class="form-control" id="idioma_modal" name="idioma_modal" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="estado_origen_modal" class="form-label fw-bold">Estado origen: </label>
						<input type="text" class="form-control" id="estado_origen_modal" name="estado_origen_modal" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="municipio_origen_modal" class="form-label fw-bold">Municipio origen: </label>
						<input type="text" class="form-control" id="municipio_origen_modal" name="municipio_origen_modal" disabled>
					</div>

					<div class="col-12">
						<hr>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="pais_modal" class="form-label fw-bold">País: </label>
						<select class="form-select" id="pais_modal" name="pais_modal" required disabled>
							<option selected disabled value="">Selecciona...</option>
							<?php foreach ($body_data->paises as $index => $pais) { ?>
								<option value="<?= $pais->ISO_2 ?>" <?= $pais->ISO_2 == 'MX' ? 'selected' : '' ?>> <?= mb_strtoupper($pais->NAME, 'UTF-8') ?> </option>
							<?php } ?>
						</select>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="estado_modal" class="form-label fw-bold">Estado: </label>
						<input type="text" class="form-control" id="estado_modal" name="estado_modal" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="municipio_modal" class="form-label fw-bold">Municipio: </label>
						<input type="text" class="form-control" id="municipio_modal" name="municipio_modal" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="localidad_modal" class="form-label fw-bold">Localidad: </label>
						<input type="text" class="form-control" id="localidad_modal" name="localidad_modal" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="colonia_modal" class="form-label fw-bold">Colonia: </label>
						<input type="text" class="form-control" id="colonia_modal" name="colonia_modal" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="cp_modal" class="form-label fw-bold">Código Postal: </label>
						<input type="text" class="form-control" id="cp_modal" name="cp_modal" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="calle_modal" class="form-label fw-bold">Calle o avenida: </label>
						<input type="text" class="form-control" id="calle_modal" name="calle_modal" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="exterior_modal" class="form-label fw-bold">Número exterior: </label>
						<input type="text" class="form-control" id="exterior_modal" name="exterior_modal" disabled>
					</div>
					<div class="col-12 col-sm-6 mb-3">
						<label for="interior_modal" class="form-label fw-bold">Número interior: </label>
						<input type="text" class="form-control" id="interior_modal" name="interior_modal" disabled>
					</div>

					<div class="col-12">
						<hr>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="identificacion_modal" class="form-label fw-bold">Tipo identificación: </label>
						<select class="form-select" id="identificacion_modal" name="identificacion_modal" required disabled>
							<option selected disabled value="">Selecciona...</option>
							<?php foreach ($body_data->tiposIdentificaciones as $index => $identificacion) { ?>
								<option value="<?= $identificacion->PERSONATIPOIDENTIFICACIONID ?>"> <?= $identificacion->PERSONATIPOIDENTIFICACIONDESCR ?> </option>
							<?php } ?>
						</select>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="numero_ide_modal" class="form-label fw-bold">Número de identificación: </label>
						<input type="text" class="form-control" id="numero_ide_modal" name="numero_ide_modal" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="e_civil_modal" class="form-label fw-bold">Estado civil: </label>
						<select class="form-select" id="e_civil_modal" name="e_civil_modal" required disabled>
							<option selected disabled value="">Selecciona...</option>
							<?php foreach ($body_data->edoCiviles as $index => $edo) { ?>
								<option value="<?= $edo->PERSONAESTADOCIVILID ?>"> <?= $edo->PERSONAESTADOCIVILDESCR ?> </option>
							<?php } ?>
						</select>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="escolaridad_modal" class="form-label fw-bold ">Escolaridad:</label>
						<input class="form-control" id="escolaridad_modal" name="escolaridad_modal" type="text" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="ocupacion_modal" class="form-label fw-bold">Ocupación: </label>
						<input type="text" class="form-control" id="ocupacion_modal" name="ocupacion_modal" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="discapacidad_modal" class="form-label fw-bold">Discapacidad: </label>
						<input type="text" class="form-control" id="discapacidad_modal" name="discapacidad_modal" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="leer_modal" class="form-label fw-bold">¿Sabe leer?: </label>
						<input type="text" class="form-control" id="leer_modal" name="leer_modal" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="escribir_modal" class="form-label fw-bold">¿Sabe escribir?: </label>
						<input type="text" class="form-control" id="escribir_modal" name="escribir_modal" disabled>
					</div>

					<div class="col-12">
						<hr>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="facebook_modal" class="form-label fw-bold">Facebook: </label>
						<input type="text" class="form-control" id="facebook_modal" name="facebook_modal" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="instagram_modal" class="form-label fw-bold">Instagram: </label>
						<input type="text" class="form-control" id="instagram_modal" name="instagram_modal" disabled>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="twitter_modal" class="form-label fw-bold">Twitter: </label>
						<input type="text" class="form-control" id="twitter_modal" name="twitter_modal" disabled>
					</div>

					<div class="col-12">
						<hr>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label class="form-label fw-bold">Fotos de identificación: </label>
						<img id="img_identificacion_modal" class="form-control" />
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label class="form-label fw-bold">Firma digital: </label>
						<img id="img_firma_modal" class="form-control" />
					</div>
					<div class="col-12 text-center mb-4">
						<button type="submit" id="valid_information_btn" class="btn btn-primary mt-4">Mi información está correcta</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include('otp_validation_modal.php') ?>
<script>
	document.querySelector('#valid_information_btn').addEventListener('click', (e) => {

		e.target.setAttribute('disabled', true);
		var data = {
			'email': document.querySelector('#correo').value
		}

		$.ajax({
			data: data,
			method: "post",
			url: "<?php echo base_url('/data/sendOTP'); ?>",
			dataType: "json",
			success: function(data) {
				e.target.removeAttribute('disabled');
				$('#information_validation').modal('hide');
				$('#otp_validation_modal').modal('show');
			},
			error: function(jqXHR, textStatus, errorThrown) {
				e.target.removeAttribute('disabled');
				console.log(jqXHR);
			}
		});
	});
</script>
