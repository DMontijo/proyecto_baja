<div class="modal fade" id="vehiculo_modal" tabindex="-1" aria-labelledby="vehiculo_modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-xl">
		<div class="modal-content border-0">
			<div class="modal-header bg-primary">
				<h5 class="modal-title text-white fw-bold" id="boletos_modalLabel">Constancia de extravío de placas</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body bg-light">
				<form action="<?= base_url() ?>/constancia_extravio/dashboard/solicitar_constancia" method="post" enctype="multipart/form-data" class="row needs-validation" novalidate>

					<!-- <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="nombre" class="form-label fw-bold input-required">Nombre:</label>
						<input class="form-control" id="nombre" name="nombre" value="<?= $body_data->denunciante->NOMBRE ?>" disabled>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="apellido_p" class="form-label fw-bold input-required">Apellido paterno:</label>
						<input class="form-control" id="apellido_p" name="apellido_p" value="<?= $body_data->denunciante->APELLIDO_PATERNO ?>" disabled>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="apellido_m" class="form-label fw-bold input-required">Apellido materno:</label>
						<input class="form-control" id="apellido_m" name="apellido_m" value="<?= $body_data->denunciante->APELLIDO_MATERNO ?>" disabled>
					</div> -->

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="municipio" class="form-label fw-bold input-required">Municipio:</label>
						<select class="form-select" id="municipio" name="municipio" required>
							<option selected disabled value="">Elige el municipio del extravío</option>
							<?php foreach ($body_data->municipios as $index => $municipio) { ?>
								<option value="<?= $municipio->MUNICIPIOID ?>"> <?= $municipio->MUNICIPIODESCR ?> </option>
							<?php } ?>
						</select>
						<div class="invalid-feedback">
							Por favor, selecciona un municipio.
						</div>
					</div>
					<!-- <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="descripcion" class="form-label fw-bold input-required">Descripción:</label>
                        <input class="form-control" type="text" id="descripcion" name="descripcion" required>
                        <div class="invalid-feedback">
                            Por favor, añade una descripción.
                        </div>
                    </div> -->
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="apellido_m" class="form-label fw-bold input-required">Domicilio:</label>
						<input class="form-control" type="text" id="domicilio" name="domicilio" required>
						<div class="invalid-feedback">
							El domicilio es obligatorio
						</div>
					</div>

					<!-- <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="telefono" class="form-label fw-bold input-required">Número de télefono</label>
						<input type="number" class="form-control" id="telefono" name="telefono" value="<?= $body_data->denunciante->TELEFONO ?>" disabled>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="correo" class="form-label fw-bold input-required">Correo electrónico</label>
						<input type="email" class="form-control" name="correo" id="correo" value="<?= $session->CORREO ?>" disabled>
						<div class="invalid-feedback">
							El correo esta erroneo
						</div>
					</div> -->

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="lugar" class="form-label fw-bold input-required">Lugar del extravío:</label>
						<select class="form-select" id="lugar" name="lugar" required>
							<option selected disabled value="">Elige el lugar del extravío</option>
							<?php foreach ($body_data->lugares as $index => $lugar) {
								if (!strpos($lugar->HECHODESCR, '(CON ARMA BLANCA)') && !strpos($lugar->HECHODESCR, '(CON ARMA DE FUEGO)')) { ?>
									<option value="<?= $lugar->HECHOLUGARID ?>"> <?= $lugar->HECHODESCR ?> </option>
							<?php
								}
							} ?>
						</select>
						<div class="invalid-feedback">
							Por favor, selecciona un lugar.
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="fecha" class="form-label fw-bold input-required">Fecha del extravío:</label>
						<input type="date" class="form-control" id="fecha" name="fecha" max="<?= date("Y-m-d") ?>" required>
						<div class="invalid-feedback">
							La fecha del extravío es obligatoria
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="serieV" class="form-label fw-bold">Serie del vehículo:</label>
						<input class="form-control" type="text" id="serieV" name="serieV">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="noplaca" class="form-label fw-bold input-required">No. placa:</label>
						<input class="form-control" type="text" id="noplaca" name="noplaca" required>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="apellido_m" class="form-label fw-bold input-required">Posición de la placa:</label>
						<select class="form-select" id="posicionPlaca" name="posicionPlaca" required>
							<option selected disabled value="">Selecciona la posición de la placa</option>
							<option value="PLACA DELANTERA">PLACA DELANTERA</option>
							<option value="PLACA TRASERA">PLACA TRASERA</option>
							<option value="AMBAS PLACAS">AMBAS PLACAS</option>
						</select>
						<div class="invalid-feedback">
							La posición de la placa es obligatoria
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="marca" class="form-label fw-bold input-required">Marca vehículo:</label>
						<input class="form-control" type="text" id="marca" name="marca" required>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="modelo" class="form-label fw-bold input-required">Modelo vehículo:</label>
						<input class="form-control" type="text" id="modelo" name="modelo" required>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="lugar" class="form-label fw-bold input-required">Año del vehiculo:</label>
						<select class="form-select" id="anio" name="anio" required>
							<option selected disabled value="">Elige el año del vehiculo </option>
							<?php for ($i = 1900; $i <= date('Y') + 1; $i++) {
								echo "<option value='" . $i . "'>" . $i . "</option>";
							} ?>
						</select>
						<div class="invalid-feedback">
							Por favor, selecciona un año.
						</div>
					</div>

					<div class="col-12 text-center">
						<button type="submit" class="btn btn-secondary">Solicitar constancia</button>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<input class="form-control" id="extravio" name="extravio" value="PLACAS" hidden>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
