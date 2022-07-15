<div class="modal fade" id="boletos_modal" tabindex="-1" aria-labelledby="boletos_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 1.5em;">
            <div class="modal-header bg-primary justify-content-center" style="border-radius: 1.5em 1.5em 0 0;">
                <h3 class="modal-title text-white fw-bold" id="boletos_modalLabel">Constancia de extravío de boletos</h3>
            </div>
            <div class="modal-body fs-5 text-center">
                <form action="<?= base_url() ?>/constancia_extravio/dashboard/solicitar_constancia" method="post" enctype="multipart/form-data" class="row needs-validation" novalidate>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
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
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="estado" class="form-label fw-bold input-required">Estado:</label>
                        <select class="form-select" id="estado" name="estado" required>
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
                        <label for="municipio" class="form-label fw-bold input-required">Municipio:</label>
                        <select class="form-select" id="municipio" name="municipio" required>
                            <option selected disabled>Elige el municipio</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, selecciona un municipio.
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="apellido_m" class="form-label fw-bold input-required">Descripción:</label>
                        <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="apellido_m" class="form-label fw-bold input-required">Domicilio:</label>
                        <input class="form-control" type="text" id="domicilio" name="domicilio">
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="telefono" class="form-label fw-bold input-required">Número de télefono</label>
                        <input type="number" class="form-control" id="telefono" name="telefono" value="<?= $body_data->denunciante->TELEFONO ?>" disabled>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="correo" class="form-label fw-bold input-required">Correo electrónico</label>
                        <div class="input-group">
                            <span class="input-group-text" id="correo_vanity"><i class="bi bi-envelope-fill"></i></span>
                            <input type="email" class="form-control" name="correo" id="correo" value="<?= $session->CORREO ?>" disabled>
                        </div>
                        <div class="invalid-feedback">
                            El correo esta erroneo
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="lugar" class="form-label fw-bold input-required">Lugar del delito:</label>
                        <select class="form-select" id="lugar" name="lugar" required>
                            <option selected disabled value="">Elige el lugar del delito</option>
                            <?php foreach ($body_data->lugares as $index => $lugar) { ?>
                                <option value="<?= $lugar->HECHOLUGARID ?>"> <?= $lugar->HECHODESCR ?> </option>
                            <?php } ?>
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
                        <label for="apellido_m" class="form-label fw-bold input-required">Hora del extravío:</label>
                        <input class="form-control" type="time" id="hora" name="hora">
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="apellido_m" class="form-label fw-bold input-required">No. boleto:</label>
                        <input class="form-control" type="text" id="noboletos" name="noboletos">
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="apellido_m" class="form-label fw-bold input-required">No. talon:</label>
                        <input class="form-control" type="text" id="notalon" name="notalon">
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="apellido_m" class="form-label fw-bold input-required">Nombre del sorteo:</label>
                        <input class="form-control" type="text" id="nombreSorteo" name="nombreSorteo">
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="fecha" class="form-label fw-bold input-required">Fecha del sorteo:</label>
                        <input type="date" class="form-control" id="fechaSorteo" name="fechaSorteo" max="<?= date("Y-m-d") ?>" required>
                        <div class="invalid-feedback">
                            La fecha del sorteo es obligatoria
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="apellido_m" class="form-label fw-bold input-required">Permiso de gobernación:</label>
                        <input class="form-control" type="text" id="permisoGobernacion" name="permisoGobernacion">
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="apellido_m" class="form-label fw-bold input-required">Permiso de gobernación de colaboradores:</label>
                        <input class="form-control" type="text" id="permisoGColaboradores" name="permisoGColaboradores">
                    </div>
                    <div class="modal-footer justify-content-center">
                        <div class="d-grid gap-2 d-md-flex col-12 mx-auto justify-content-md-center">
                            <button type="submit" class="btn btn-secondary btn-lg">Enviar solicitud</button>

                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <input class="form-control" id="extravio" name="extravio" value="BOLETOS" hidden>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>

<script>
   
   document.querySelector('#estado').addEventListener('change', (e) => {
        let select_municipio = document.querySelector('#municipio');
        clearSelect(select_municipio);

        let data = {
            'estado_id': e.target.value,
        }

        $.ajax({
            data: data,
            url: "<?= base_url('/data/get-municipios-by-estado') ?>",
            method: "POST",
            dataType: "json",
            success: function(response) {
                let municipios = response.data;

                municipios.forEach(municipio => {
                    var option = document.createElement("option");
                    option.text = municipio.MUNICIPIODESCR;
                    option.value = municipio.MUNICIPIOID;
                    select_municipio.add(option);
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {}
        });
    });

    function clearSelect(select_element) {
        for (let i = select_element.options.length; i >= 1; i--) {
            select_element.remove(i);
        }
    }
</script>
</script>