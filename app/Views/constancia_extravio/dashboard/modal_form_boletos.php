<div class="modal fade" id="boletos_modal" tabindex="-1" aria-labelledby="boletos_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-xl">
        <div class="modal-content border-0">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white fw-bold" id="boletos_modalLabel">Constancia de extravío de boletos
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <form action="<?= base_url() ?>/constancia_extravio/dashboard/solicitar_constancia" method="post"
                    class="row needs-validation" novalidate>

                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="municipio" class="form-label fw-bold input-required">Municipio extravío:</label>
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
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="apellido_m" class="form-label fw-bold input-required">Domicilio:</label>
                        <input class="form-control" type="text" id="domicilio" name="domicilio" maxlength="300"
                            required>
                        <div class="invalid-feedback">
                            El domicilio es obligatorio
                        </div>
                    </div>

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
                            El lugar de extravío es obligatorio
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="fecha" class="form-label fw-bold input-required">Fecha del extravío:</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" max="<?= date("Y-m-d") ?>"
                            required>
                        <div class="invalid-feedback">
                            La fecha del extravío es obligatoria
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="apellido_m" class="form-label fw-bold input-required">No. boleto:</label>
                        <input class="form-control" type="text" id="noboletos" name="noboletos" required>
                        <div class="invalid-feedback">
                            El número de boleto es obligatorio
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="apellido_m" class="form-label fw-bold input-required">No. talon:</label>
                        <input class="form-control" type="text" id="notalon" name="notalon" required>
                        <div class="invalid-feedback">
                            El número de talon es obligatorio
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="apellido_m" class="form-label fw-bold input-required">Nombre del sorteo:</label>
                        <input class="form-control" type="text" id="nombreSorteo" name="nombreSorteo" required>
                        <div class="invalid-feedback">
                            El nombre del sorteo es obligatorio
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="fecha" class="form-label fw-bold input-required">Fecha del sorteo:</label>
                        <input type="date" class="form-control" id="fechaSorteo" name="fechaSorteo" required>
                        <div class="invalid-feedback">
                            La fecha del sorteo es obligatoria
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="apellido_m" class="form-label fw-bold input-required">Permiso de
                            gobernación:</label>
                        <input class="form-control" type="text" id="permisoGobernacion" name="permisoGobernacion"
                            required>
                        <div class="invalid-feedback">
                            El permiso de gobernación es obligatorio
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="apellido_m" class="form-label fw-bold ">Permiso gobernación de
                            colaboradores:</label>
                        <input class="form-control" type="text" id="permisoGColaboradores" name="permisoGColaboradores">
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-secondary">Solicitar constancia</button>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <input class="form-control" id="extravio" name="extravio" value="BOLETOS DE SORTEO" hidden>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
