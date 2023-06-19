<div class="modal fade" id="vehiculo_modal" tabindex="-1" aria-labelledby="vehiculo_modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-xl">
        <div class="modal-content border-0">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white fw-bold" id="boletos_modalLabel">Constancia de extravío de placas</h5>
                <button id="placas_close_btn" type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <form id="form_placas" action="<?= base_url() ?>/constancia_extravio/dashboard/solicitar_constancia" method="post" class="row needs-validation" novalidate>

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
                        <input class="form-control" type="text" id="domicilio" name="domicilio" required>
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
                        <label for="tipo_placa" class="form-label fw-bold input-required">Tipo de placa:</label>
                        <select class="form-select" id="tipo_placa" name="tipo_placa" required>
                            <option value="NACIONALES">PLACAS NACIONALES</option>
                            <option value="EXTRANJERAS">PLACAS EXTRANJERAS</option>
                            <option selected value="ESTATALES">PLACAS ESTATALES</option>
                        </select>
                        <div class="invalid-feedback">
                            La posición de la placa es obligatoria
                        </div>
                                  
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
                        <button id="form_placas_btn" type="submit" class="btn btn-secondary">
                            <div id="spinner" class="spinner-border text-primary d-none" role="status"></div>
                            <span id="text">Solicitar constancia</span>
                        </button>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <input class="form-control" id="extravio" name="extravio" value="PLACAS" hidden>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const form_placas = document.querySelector('#form_placas');
    const form_placas_btn = document.querySelector('#form_placas_btn');
    const placas_close_btn = document.querySelector('#placas_close_btn');
    const spinner_placas = document.querySelector('#form_placas_btn #spinner');
    const btn_text_placas = document.querySelector('#form_placas_btn #text');

    form_placas.addEventListener('submit', function(event) {
        if (!form_placas.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            form_placas_btn.disabled = false;
            placas_close_btn.classList.remove('d-none')
            spinner_placas.classList.add('d-none');
            btn_text_placas.classList.remove('d-none');
        } else {
            placas_close_btn.classList.add('d-none')
            form_placas_btn.disabled = true;
            spinner_placas.classList.remove('d-none');
            btn_text_placas.classList.add('d-none');
        }
        form_placas.classList.add('was-validated')
    }, false);
</script>