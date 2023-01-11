<div class="modal fade" id="documentos_modal" tabindex="-1" aria-labelledby="documentos_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-xl">
        <div class="modal-content border-0">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white fw-bold" id="boletos_modalLabel">Constancia de extravío de documentos
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <form action="<?= base_url() ?>/constancia_extravio/dashboard/solicitar_constancia" method="post"
                    enctype="multipart/form-data" class="row needs-validation" novalidate>

                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3 d-none">
                        <label for="nombre" class="form-label fw-bold input-required">Nombre:</label>
                        <input class="form-control" id="nombre" name="nombre"
                            value="<?= $body_data->denunciante->NOMBRE ?>" disabled>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3 d-none">
                        <label for="apellido_p" class="form-label fw-bold input-required">Apellido paterno:</label>
                        <input class="form-control" id="apellido_p" name="apellido_p"
                            value="<?= $body_data->denunciante->APELLIDO_PATERNO ?>" disabled>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3 d-none">
                        <label for="apellido_m" class="form-label fw-bold input-required">Apellido materno:</label>
                        <input class="form-control" id="apellido_m" name="apellido_m"
                            value="<?= $body_data->denunciante->APELLIDO_MATERNO ?>" disabled>
                    </div>
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
                        <input type="date" class="form-control" id="fecha" name="fecha" max="<?= date("Y-m-d") ?>"
                            required>
                        <div class="invalid-feedback">
                            La fecha del extravío es obligatoria
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="tipodoc" class="form-label fw-bold input-required">Tipo de documento:</label>
                        <select class="form-select" id="tipodoc" name="tipodoc" required>
                            <option selected disabled value="">Elige el tipo de documento</option>
                            <?php foreach ($body_data->identificacion as $index => $identificacion) { ?>
                            <option value="<?= $identificacion->DOCUMENTOEXTRAVIOTIPODESCR  ?>">
                                <?= $identificacion->DOCUMENTOEXTRAVIOTIPODESCR ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, selecciona un tipo de documento.
                        </div>
                    </div>

                    <div id="boletos_container" class=" col-12 m-0 p-0 d-none">
                        <div class="row m-0 p-0">

                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                                <label for="apellido_m" class="form-label fw-bold input-required">No. boleto:</label>
                                <input class="form-control" type="text" id="noboletos" name="noboletos">
                                <div class="invalid-feedback">
                                    El número de boleto es obligatorio
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                                <label for="apellido_m" class="form-label fw-bold input-required">No. talon:</label>
                                <input class="form-control" type="text" id="notalon" name="notalon">
                                <div class="invalid-feedback">
                                    El número de talon es obligatorio
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                                <label for="apellido_m" class="form-label fw-bold input-required">Nombre del
                                    sorteo:</label>
                                <input class="form-control" type="text" id="nombreSorteo" name="nombreSorteo">
                                <div class="invalid-feedback">
                                    El nombre del sorteo es obligatorio
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                                <label for="fecha" class="form-label fw-bold input-required">Fecha del sorteo:</label>
                                <input type="date" class="form-control" id="fechaSorteo" name="fechaSorteo">
                                <div class="invalid-feedback">
                                    La fecha del sorteo es obligatoria
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                                <label for="apellido_m" class="form-label fw-bold input-required">Permiso de
                                    gobernación:</label>
                                <input class="form-control" type="text" id="permisoGobernacion"
                                    name="permisoGobernacion">
                                <div class="invalid-feedback">
                                    El permiso de gobernación es obligatorio
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                                <label for="apellido_m" class="form-label fw-bold ">Permiso gobernación de
                                    colaboradores:</label>
                                <input class="form-control" type="text" id="permisoGColaboradores"
                                    name="permisoGColaboradores">
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3" id="numerodocumento_container">
                        <label for="nodocumento" class="form-label fw-bold">No. documento:</label>
                        <input class="form-control" type="text" id="nodocumento" name="nodocumento">
                    </div>


                    <div id="pasaporte_container" class="col-12 m-0 p-0 d-none">
                        <div class="row m-0 p-0">
                            <hr>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                                <label for="cita" class="form-label fw-bold input-required">¿Tienes cita para el
                                    pasaporte?</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="cita" id="cita" value="SI">
                                    <label class="form-check-label" for="cita">SI</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="cita" id="cita" value="NO">
                                    <label class="form-check-label" for="cita">NO</label>
                                </div>
                            </div>
                            <div id="municipio_cita-container" class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3 d-none">
                                <label for="municipio_cita" class="form-label fw-bold input-required">Municipio de la
                                    cita:</label>
                                <select class="form-select" id="municipio_cita" name="municipio_cita">
                                    <option selected disabled value="">Elige el municipio del extravío</option>
                                    <?php foreach ($body_data->municipios as $index => $municipio) { ?>
                                    <option value="<?= $municipio->MUNICIPIOID ?>"> <?= $municipio->MUNICIPIODESCR ?>
                                    </option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor, selecciona un municipio.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr>
                    </div>
                    <div id="documentos_container" class="col-12 m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-12 mb-3">
                                <label for="solicitante" class="form-label fw-bold">¿El documento está a nombre del
                                    solicitante?</label>
                                <input type="checkbox" id="solicitante" name="solicitante">
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                                <label for="fecha" class="form-label fw-bold input-required">Documento a nombre
                                    de:</label>
                                <input type="text" class="form-control" id="duenonamedoc" name="duenonamedoc" required>
                                <div class="invalid-feedback">
                                    El dueño es obligatorio
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                                <label for="duenoapdoc" class="form-label fw-bold input-required">Apellido
                                    paterno:</label>
                                <input class="form-control" type="text" id="duenoapdoc" name="duenoapdoc" required>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                                <label for="apellido_m" class="form-label fw-bold">Apellido materno:</label>
                                <input class="form-control" type="text" id="duenoamdoc" name="duenoamdoc">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-secondary">Solicitar constancia</button>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <input class="form-control" id="extravio" name="extravio" hidden>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
let select_tipo_doc = document.querySelector("#tipodoc")

// const option = document.createElement('option');
// option.value = 'BOLETOS DE SORTEO';
// option.text = 'BOLETOS DE SORTEO';
// select_tipo_doc.add(option, null);
var solicitante = document.querySelector("input[name=solicitante]");

solicitante.addEventListener('change', function(e) {
    if (e.target.checked) {
        document.getElementById("duenonamedoc").value = document.getElementById("nombre").value
        document.getElementById("duenoapdoc").value = document.getElementById("apellido_p").value
        document.getElementById("duenoamdoc").value = document.getElementById("apellido_m").value
    } else {
        document.getElementById("duenonamedoc").value = '';
        document.getElementById("duenoapdoc").value = '';
        document.getElementById("duenoamdoc").value = '';
    }
});

document.querySelector('#tipodoc').addEventListener('change', (e) => {

    if (e.target.value == 'BOLETOS DE SORTEOS') {

        document.getElementById('extravio').value = 'BOLETOS DE SORTEO';
        document.querySelector('#boletos_container').classList.remove('d-none');
        document.querySelector('#numerodocumento_container').classList.add('d-none');
        document.querySelector('#documentos_container').classList.add('d-none');
        document.querySelector('#pasaporte_container').classList.add('d-none');

        document.querySelector('#permisoGobernacion').setAttribute('required', true)
        document.querySelector('#fechaSorteo').setAttribute('required', true)
        document.querySelector('#nombreSorteo').setAttribute('required', true)
        document.querySelector('#notalon').setAttribute('required', true)
        document.querySelector('#noboletos').setAttribute('required', true)

        document.querySelector('#duenonamedoc').required = false;
        document.querySelector('#duenoapdoc').required = false;


        document.getElementById('duenonamedoc').value = '';
        document.getElementById('duenoapdoc').value = '';
        document.getElementById('duenoamdoc').value = '';

        document.getElementById('nodocumento').value = '';

        document.querySelectorAll('input[name="cita"]').forEach((cita) => {
            cita.removeAttribute('required');
        });
        document.querySelector('#municipio_cita-container').classList.add('d-none');
        document.querySelector('#municipio_cita').removeAttribute('required');
        document.querySelector('#municipio_cita').value = '';

    } else if (e.target.value == 'PASAPORTE MEXICANO') {

        document.getElementById('extravio').value = 'DOCUMENTOS';
        document.querySelector('#pasaporte_container').classList.remove('d-none');
        document.querySelector('#boletos_container').classList.add('d-none');

        document.querySelectorAll('input[name="cita"]').forEach((cita) => {
            cita.setAttribute('required', true);
        });
        document.querySelector('input[name="cita"]:checked') ? document.querySelector(
            'input[name="cita"]:checked').checked = false : null;
        document.querySelector('#permisoGobernacion').setAttribute('required', false)
        document.querySelector('#fechaSorteo').setAttribute('required', false)
        document.querySelector('#nombreSorteo').setAttribute('required', false)
        document.querySelector('#notalon').setAttribute('required', false)
        document.querySelector('#noboletos').setAttribute('required', false)
        document.querySelector('#documentos_container').classList.remove('d-none');

    } else {

        document.getElementById('extravio').value = 'DOCUMENTOS';

        document.querySelector('#boletos_container').classList.add('d-none');
        document.querySelector('#documentos_container').classList.remove('d-none');

        document.querySelector('#pasaporte_container').classList.add('d-none');
        document.querySelectorAll('input[name="cita"]').forEach((cita) => {
            cita.removeAttribute('required');
        });
        document.querySelector('#municipio_cita-container').classList.add('d-none');
        document.querySelector('#municipio_cita').removeAttribute('required');
        document.querySelector('#municipio_cita').value = '';
        document.querySelector('input[name="cita"]:checked') ? document.querySelector(
            'input[name="cita"]:checked').checked = false : null;

        document.querySelector('#permisoGobernacion').setAttribute('required', false)
        document.querySelector('#fechaSorteo').setAttribute('required', false)
        document.querySelector('#nombreSorteo').setAttribute('required', false)
        document.querySelector('#notalon').setAttribute('required', false)
        document.querySelector('#noboletos').setAttribute('required', false)
    }
});

document.querySelectorAll('input[name="cita"]').forEach(input => {
    input.addEventListener('change', (e) => {
        if (document.querySelector('input[name="cita"]:checked').value == "SI") {
            document.querySelector('#municipio_cita-container').classList.remove('d-none');
            document.querySelector('#municipio_cita').setAttribute('required', true)
        } else {
            document.querySelector('#municipio_cita-container').classList.add('d-none');
            document.querySelector('#municipio_cita').removeAttribute('required');
        }
    })
});
</script>