<div class="modal fade" id="agregarDireccionModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="agregarDireccionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-xl">
        <div class="modal-content border-0">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white fw-bold" id="direccionLabel">Añadir dirección de notificación
                </h5>
                <button id="direccion_close_btn" type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">

                <form id="form_agregar_direccion" action="" method="post" class="row" novalidate>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="correo_empresa_extra" class="form-label fw-bold input-required">Correo electrónico</label>
                        <div class="input-group">
                            <span class="input-group-text" id="correo_vanity"><i class="bi bi-envelope-fill"></i></span>
                            <input type="email" class="form-control" name="correo_empresa_extra" id="correo_empresa_extra" aria-describedby="correo_vanity" maxlength="100" required>
                        </div>
                        <div class="invalid-feedback">
                            El correo esta erroneo
                        </div>
                    </div>


                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="estado_empresa_extra" class="form-label fw-bold input-required">Estado:</label>
                        <select class="form-select" id="estado_empresa_extra" name="estado_empresa_extra" required>
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
                        <label for="municipio_empresa_extra" class="form-label fw-bold input-required">Municipio:</label>
                        <select class="form-select" id="municipio_empresa_extra" name="municipio_empresa_extra" required>
                            <option selected disabled value="">Elige el municipio</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, selecciona un municipio.
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="localidad_empresa_extra" class="form-label fw-bold input-required">Localidad:</label>
                        <select class="form-select" id="localidad_empresa_extra" name="localidad_empresa_extra" required>
                            <option selected disabled value="">Elige la localidad</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, selecciona una localidad.
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="colonia" class="form-label fw-bold input-required">Colonia</label>
                        <select class="form-select" id="colonia_select_empresa_extra" name="colonia_select_empresa_extra" required>
                            <option selected disabled value="">Selecciona la colonia</option>
                        </select>
                        <input type="text" class="form-control d-none" id="colonia_input_empresa_extra" name="colonia_input_empresa_extra" maxlength="100" required>
                        <small id="colonia-message" class="text-primary fw-bold">Si no encuentras la colonia selecciona otro</small>
                        <div class="invalid-feedback">
                            La colonia es obligatoria
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="calle_empresa_extra" class="form-label fw-bold input-required">Calle:</label>
                        <input class="form-control" type="text" id="calle_empresa_extra" name="calle_empresa_extra" required>
                        <div class="invalid-feedback">
                            La calle es obligatorio
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="n_empresa_extra" class="form-label fw-bold input-required">Número exterior</label>
                        <input type="text" class="form-control" id="n_empresa_extra" name="n_empresa_extra" maxlength="10" required>
                        <div class="invalid-feedback">
                            El número exterior es obligatorio
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="ninterior_empresa_extra" class="form-label fw-bold">Número interior</label>
                        <input type="text" class="form-control" id="ninterior_empresa_extra" name="ninterior_empresa_extra" maxlength="10">
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="referencia_empresa_extra" class="form-label fw-bold">Referencias</label>
                        <input type="text" class="form-control" id="referencia_empresa_extra" name="referencia_empresa_extra" maxlength="300">
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="telefono_empresa_extra" class="form-label fw-bold input-required ">Télefono </label>
                        <input type="number" class="form-control" id="telefono_empresa_extra" name="telefono_empresa_extra" required minlenght="10" maxlength="10" oninput="clearInputPhone(event);" pattern="[0-9]+">
                        <small>El campo número debe tener 10 dígitos</small>
                        <div class="invalid-feedback">
                            El campo número debe tener 10 dígitos
                        </div>
                        <input type="number" id="codigo_pais" name="codigo_pais" maxlength="3" hidden>
                    </div>

                    <div class="col-12">
                        <hr>
                    </div>

                    <div class="col-12 text-center">
                        <button id="form_direccion_btn" type="submit" class="btn btn-secondary">
                            <div id="spinner" class="spinner-border text-primary d-none" role="status"></div>
                            <span id="text">Añadir</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    //Declaracion de elementos
    const select_tipo_doc = document.querySelector("#tipodoc")
    const solicitante = document.querySelector("input[name=solicitante]");

    document.querySelector('#correo_empresa_extra').blur();

    document.querySelector('#estado_empresa_extra').addEventListener('change', (e) => {
        let select_municipio = document.querySelector('#municipio_empresa_extra');

        clearSelect(select_municipio);

        select_municipio.value = '';

        select_municipio.disabled = true;

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
                select_municipio.disabled = false;
            },
            error: function(jqXHR, textStatus, errorThrown) {}
        });
    });
    document.querySelector('#municipio_empresa_extra').addEventListener('change', (e) => {
        let select_localidad = document.querySelector('#localidad_empresa_extra');
        let select_colonia = document.querySelector('#colonia_select_empresa_extra');
        let input_colonia = document.querySelector('#colonia_input_empresa_extra');

        let estado = document.querySelector('#estado_empresa_extra').value;
        let municipio = e.target.value;

        clearSelect(select_localidad);
        clearSelect(select_colonia);

        select_colonia.disabled = true;
        select_localidad.disabled = true;

        select_localidad.value = '';

        let data = {
            'estado_id': estado,
            'municipio_id': municipio
        };

        $.ajax({
            data: data,
            url: "<?= base_url('/data/get-localidades-by-municipio') ?>",
            method: "POST",
            dataType: "json",
            success: function(response) {
                let localidades = response.data;

                localidades.forEach(localidad => {
                    var option = document.createElement("option");
                    option.text = localidad.LOCALIDADDESCR;
                    option.value = localidad.LOCALIDADID;
                    select_localidad.add(option);
                });
                select_localidad.disabled = false;
            },
            error: function(jqXHR, textStatus, errorThrown) {}
        });
    });

    document.querySelector('#localidad_empresa_extra').addEventListener('change', (e) => {
        let select_colonia = document.querySelector('#colonia_select_empresa_extra');
        let input_colonia = document.querySelector('#colonia_input_empresa_extra');

        let estado = document.querySelector('#estado_empresa_extra').value;
        let municipio = document.querySelector('#municipio_empresa_extra').value;
        let localidad = e.target.value;

        clearSelect(select_colonia);
        select_colonia.value = '';

        select_colonia.disabled = true;

        let data = {
            'estado_id': estado,
            'municipio_id': municipio,
            'localidad_id': localidad
        };

        console.log(data);

        if (estado == 2) {
            select_colonia.classList.remove('d-none');
            input_colonia.classList.add('d-none');
            input_colonia.value = '';
            $.ajax({
                data: data,
                url: "<?= base_url('/data/get-colonias-by-estado-municipio-localidad') ?>",
                method: "POST",
                dataType: "json",
                success: function(response) {
                    let colonias = response.data;

                    colonias.forEach(colonia => {
                        var option = document.createElement("option");
                        option.text = colonia.COLONIADESCR;
                        option.value = colonia.COLONIAID;
                        select_colonia.add(option);
                    });
                    select_colonia.disabled = false;

                    var option = document.createElement("option");
                    option.text = 'OTRO';
                    option.value = '0';
                    select_colonia.add(option);
                },
                error: function(jqXHR, textStatus, errorThrown) {

                }
            });

        } else {
            var option = document.createElement("option");
            option.text = 'OTRO';
            option.value = '0';
            select_colonia.add(option);
            select_colonia.value = '0';
            input_colonia.value = '';
            select_colonia.classList.add('d-none');
            input_colonia.classList.remove('d-none');
        }
    });

    document.querySelector('#colonia_select_empresa_extra').addEventListener('change', (e) => {
        let select_colonia = document.querySelector('#colonia_select_empresa_extra');
        let input_colonia = document.querySelector('#colonia_input_empresa_extra');

        if (e.target.value === '0') {
            select_colonia.classList.add('d-none');
            input_colonia.classList.remove('d-none');
            input_colonia.value = '';
            input_colonia.focus();
        } else {
            input_colonia.value = '-';
        }
    });

    document.querySelector('#correo_empresa_extra').addEventListener('blur', (e) => {
        let regex = /\S+@\S+\.\S+/

        if (regex.test(e.target.value)) {
            $.ajax({
                data: {
                    'email': e.target.value
                },
                url: "<?= base_url('/data/exist-email-notificacion') ?>",
                method: "POST",
                dataType: "json",
                success: function(response) {
                    if (response.exist === 1) {
                        e.target.value = '';
                        Swal.fire({
                            icon: 'error',
                            text: 'El correo ya se encuentra registrado, ingresa uno diferente.',
                            confirmButtonColor: '#bf9b55',
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {}
            });
        };
    })


    function clearSelect(select_element) {
        for (let i = select_element.options.length; i >= 1; i--) {
            select_element.remove(i);
        }
    }

    //Funcion para eliminar los guiones y verifica que el telefono sea de longitud 10
    function clearInputPhone(e) {
        e.target.value = e.target.value.replace(/-/g, "");
        if (e.target.value.length > e.target.maxLength) {
            e.target.value = e.target.value.slice(0, e.target.maxLength);
        };
        if (e.target.value.length < 10) {
            e.target.classList.add('is-invalid');
        } else {
            e.target.classList.remove('is-invalid');
        }
    }
  
</script>