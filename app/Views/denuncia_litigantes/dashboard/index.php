<?= $this->extend('denuncia_litigantes/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php $session = session(); ?>
<div class="row" style="min-height:83vh;">
    <div class="col-12">
        <h4 id="titulo" class="text-center text-blue fw-bold my-4">BIENVENID@ <?= $session->NOMBRE ?> <?= $session->APELLIDO_PATERNO ?> <?= $session->APELLIDO_MATERNO ?></h4>

        <div class="card rounded shadow border-0">
            <div class="card-body py-5">
                <div class="container">
                    <h1 class="text-center fw-bolder pb-1 text-blue">MODULO PERSONAS MORALES Y LITIGANTES</h1>
                    <p class="text-center fw-bold text-blue ">Llene los campos siguientes para continuar su denuncia</p>
                    <p class="text-center pb-3">Los campos con un <span class="asterisco-rojo">*</span> son obligatorios</p>
                    <div class="progress mb-4">
                        <div id="progress-bar" aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" class="progress-bar progress-bar-striped progress-bar-animated bg-yellow" role="progressbar"></div>
                    </div>
                </div>
            </div>
            <section class="p-3">
                <form id="litigantes_form" action="" method="post" enctype="multipart/form-data" class="row needs-validation" novalidate>

                    <div id="principal" class="d-none step">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                            <label for="tipo_persona" class="form-label fw-bold input-required">Tipo persona</label>
                            <select class="form-control" id="tipo_persona" name="tipo_persona" required>
                                <option selected disabled value="">Seleccione el tipo de persona de la denuncia</option>
                                <?php if (session('PERFIL') == "LITIGANTE") { ?>
                                    <option value="FISICA">PERSONA FISICA</option>
                                <?php } ?>

                                <option value="MORAL">PERSONA MORAL</option>

                            </select>

                        </div>
                        <!-- <div id="datos_create_moral" class="col-12 d-none">
                            <?php include('denuncia_moral/form_create_moral.php') ?>
                        </div> -->
                    </div>
                    <!-- DATOS EMPRESA -->
                    <div id="datos_moral" class="col-12 d-none step">
                        <?php include('denuncia_moral/form_moral.php') ?>
                    </div>
                    <!-- DATOS EMPRESA -->
                    <div id="datos_ligacion" class="col-12 d-none step">
                        <?php include('denuncia_moral/form_ligacion.php') ?>
                    </div>
                    <!-- DATOS DELITO -->
                    <div id="datos_delito_moral" class="col-12 d-none step">
                        <?php include('denuncia_moral/form_delito.php') ?>
                    </div>


                    <!-- DATOS PERSONA FISICA -->

                    <!-- DATOS DELITO    -->
                    <div id="datos_delito" class="col-12 d-none step">
                        <?php include('denuncia_fisica/form_delito.php') ?>
                    </div>
                    <div id="datos_ofendido" class="col-12 d-none step">
                        <?php include('denuncia_fisica/form_ofendido.php') ?>
                    </div>
                    <!-- DATOS DESAPARECIDO -->
                    <div id="datos_desaparecido" class="col-12 d-none step">
                        <?php include('denuncia_fisica/form_persona_desaparecida.php') ?>
                    </div>
                    <!-- DATOS VEHICULO ROBADO -->
                    <div id="datos_robo_vehiculo" class="col-12 d-none step">
                        <?php include('denuncia_fisica/form_robo_vehiculo.php') ?>
                    </div>
                    <div id="datos_robo_vehiculo_completo" class="col-12 d-none step">
                        <?php include('denuncia_fisica/form_robo_vehiculo_sp.php') ?>
                    </div>

                    <!-- DATOS POSIBLE RESPONSABLE -->
                    <div id="datos_imputado" class="col-12 d-none step">
                        <?php include('denuncia_moral/form_imputado.php') ?>
                    </div>

                    <!-- PASO FINAL -->
                    <div id="paso_final" class="col-12 step d-none step">
                        <div class="row">
                            <div class="col-12 text-center">
                                <p class="fw-bold">Haz completado la información</p>


                                <p class="text-center">
                                    <i class="bi bi-exclamation-triangle"> Es muy importante que antes de iniciar tu video denuncia aceptes los derechos de víctima u ofendido.</i>
                                    <br>
                                    Para consultar la constancia de Derechos, da clic <a target="_blank" href="" data-bs-toggle="modal" data-bs-target="#exampleModal">aquí</a>
                                    <br><br>
                                </p>


                                <!-- <div class="row">
										<div class="col-12 col-sm-6 offset-sm-3">
											<p class="p-0 m-0"><strong>Documentos a anexar</strong></p>
											<small>Si deseas anexar cualquier documento o imagén para la videodenuncia, hazlo aqui.</small>
											<input type="file" class="form-control" id="documentosArchivo" name="documentosArchivo[]" accept="image/jpeg, image/jpg, image/png, .doc, .pdf" multiple>
											<img id="viewDocumentoArchivo" class="img-fluid" src="" style="max-width:100px;">
										</div>
									</div> -->
                                <br>


                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" name="derechos_imputado" id="derechos_imputado" required>
                                    <span class="fw-bold">Confirmo que he leído y conozco los derechos de víctima u ofendido</span>
                                    <div class="invalid-feedback">
                                        Debes confirmar de leído los derechos de víctima u ofendido para continuar.
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <input class="form-check-input" type="checkbox" id="notificaciones_check" name="notificaciones_check" required>
                                    <label class="fw-bold" for="notificaciones_check">
                                        Acepto y autorizo como medio de notificaciones: teléfono, correo electrónico y domicilio registrado.
                                    </label>
                                    <div class="invalid-feedback">
                                        Debes aceptar el envío de notificaciones para continuar.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-5 text-center">
                        <button class="btn btn-primary mb-3 d-none" id="prev-btn" type="button"> <i class="bi bi-caret-left-fill"></i> Anterior</button>
                        <button class="btn btn-primary mb-3" id="next-btn" type="button"> Siguiente <i class="bi bi-caret-right-fill"></i> </button>
                        <button class="btn btn-primary mb-3 d-none" type="submit" id="submit-btn"><i class="bi bi-camera-video-fill"></i> Presentar denuncia escrita</button>
                    </div>
                </form>
            </section>
            <!-- <section class="p-3">
                <div class="row justify-content-center">

                    <?php if (session('PERFIL') == "LITIGANTE") { ?>
                        <div class="col-12 col-md-6 col-lg-6 text-center">
                            <div class="card text-center bg-transparent border-0">
                                <div class="card-body">
                                    <a href="<?= base_url() ?>/denuncia_litigantes/dashboard/denuncia_persona_fisica" class="text-decoration-none">
                                        <img src="<?= base_url() ?>/assets/img/icons/personafisica_btn.png" class="w-50" alt="Denuncia persona física">
                                        <p class="fw-bold fs-5 mt-2  text-dark ">Persona Física</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="col-12 col-md-6 col-lg-6 text-center">
                        <div class="card text-center bg-transparent border-0">
                            <div class="card-body">
                                <a href="<?= base_url() ?>/denuncia_litigantes/dashboard/modulo" class="text-decoration-none">
                                    <img src="<?= base_url() ?>/assets/img/icons/personamoral_btn.png" class="w-50" alt="Denuncia persona moral">
                                    <p class="fw-bold fs-5 mt-2  text-dark ">Persona Moral</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
        </section> -->
        </div>
    </div>
</div>

<?php include('denuncia_moral/modal_agregar_direccion.php') ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8Y8sKd0VSyZcl9kPdCewI2mpXh95AJ-8&callback=initMap&v=weekly" async></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8Y8sKd0VSyZcl9kPdCewI2mpXh95AJ-8&callback=initMapMoral&v=weekly" async></script>

<script>
    var steps = document.querySelectorAll('.step');
    const prevBtn = document.querySelector('#prev-btn');
    const nextBtn = document.querySelector('#next-btn');
    const solicitarCambioBtn = document.querySelector('#solicitar-cambio');

    const submitBtn = document.querySelector('#submit-btn');
    const progress = document.querySelector('#progress-bar');
    var stepCount = steps.length - 1;
    var width = 100 / stepCount;
    var currentStep = 0;
    //Funcion para convertir el elemento a mayusculoas
    const mayuscTextarea = (e) => {
            e.value = e.value.toUpperCase();
        }
        (function() {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            var inputsText = document.querySelectorAll('input[type="text"]');
            var inputsEmail = document.querySelectorAll('input[type="email"]');
            let direccion = document.querySelector('#direccion');
            let empresaid = '';
            let poder = '';
            let correo_empresa = document.querySelector('#correo_empresa');
            let estado_empresa = document.querySelector('#estado_empresa');
            let municipio_empresa = document.querySelector('#municipio_empresa');
            let localidad_empresa = document.querySelector('#localidad_empresa');
            let colonia_select_empresa = document.querySelector('#colonia_select_empresa');
            let municipio_empresa_c = document.querySelector('#municipio_empresa_c');
            let localidad_empresa_c = document.querySelector('#localidad_empresa_c');
            let colonia_select_empresa_c = document.querySelector('#colonia_select_empresa_c');
            let colonia_input_empresa_c = document.querySelector('#colonia_input_empresa_c');
            let colonia_input_empresa = document.querySelector('#colonia_input_empresa');
            let calle_empresa = document.querySelector('#calle_empresa');
            let n_empresa = document.querySelector('#n_empresa');
            let ninterior_empresa = document.querySelector('#ninterior_empresa');
            let referencia_empresa = document.querySelector('#referencia_empresa');
            let telefono_empresa = document.querySelector('#telefono_empresa');
            let zona_empresa = document.querySelector('#zona_empresa');
            const form_agregar_direccion = document.querySelector('#form_agregar_direccion');
            const form_direccion_btn = document.querySelector('#form_direccion_btn');
            const datos_delito = document.querySelector('#datos_delito');
            const litigantes_form = document.querySelector('#litigantes_form');
            const documentos_close_btn = document.querySelector('#direccion_close_btn');
            const spinner_documentos = document.querySelector('#form_direccion_btn #spinner');
            const btn_text_documentos = document.querySelector('#form_direccion_btn #text');

            // const datos_create_moral = document.getElementById('datos_create_moral');
            //Convierte todos los input text a mayusculas
            inputsText.forEach((input) => {
                input.addEventListener('input', function(event) {
                    event.target.value = clearText(event.target.value).toUpperCase();
                }, false)
            })

            //Convierte todos los inout email a minusculas
            inputsEmail.forEach((input) => {
                input.addEventListener('input', function(event) {
                    event.target.value = clearText(event.target.value).toLowerCase();
                }, false)
            })
            document.querySelector('#descripcion_breve').addEventListener('input', (event) => {
                event.target.value = clearText(event.target.value).toUpperCase();
            }, false)

            //Form add notificacion
            form_agregar_direccion.addEventListener('submit', (event) => {
                if (!form_agregar_direccion.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    documentos_close_btn.classList.add('d-none')
                    form_direccion_btn.disabled = false;
                    spinner_documentos.classList.add('d-none');
                    btn_text_documentos.classList.remove('d-none');
                    form_agregar_direccion.classList.add('was-validated')
                } else {
                    event.preventDefault();
                    event.stopPropagation();
                    form_direccion_btn.disabled = true;
                    documentos_close_btn.classList.remove('d-none')
                    spinner_documentos.classList.remove('d-none');
                    btn_text_documentos.classList.remove('d-none');
                    form_agregar_direccion.classList.remove('was-validated')
                    agregarDireccionNotificion();
                }
            }, false);
            //Elimina los caracteres especiales del texto
            function clearText(text) {
                return text
                    .normalize('NFD')
                    .replaceAll(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi, "$1")
                    .normalize()
                    .replaceAll('´', '');
            }
            // Array.prototype.slice.call(forms)
            //     .forEach(function(form) {
            //         form.addEventListener('submit', (event) => {
            //             if (!form.checkValidity()) {
            //                 event.preventDefault();
            //                 event.stopPropagation();
            //                 submitBtn.removeAttribute('disabled');
            //                 console.log(forms);
            //             } else {
            //                 event.preventDefault();
            //                 submitBtn.setAttribute('disabled', true);
            //                 document.querySelector('#litigantes_form').submit();
            //                 console.log("form valido");

            //             }
            //             form.classList.add('was-validated')
            //         }, false)
            //     })
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', (event) => {
                    const elements = form.elements;
                    let invalidField = null;

                    for (let i = 0; i < elements.length; i++) {
                        if (!elements[i].checkValidity()) {
                            invalidField = elements[i];
                            break;
                        }
                    }

                    if (invalidField) {
                        event.preventDefault();
                        event.stopPropagation();
                        submitBtn.removeAttribute('disabled');
                        console.log("Formulario que falla:", form);
                        console.log("Campo que no se está llenando:", invalidField.name);
                    } else {
                        event.preventDefault();
                        submitBtn.setAttribute('disabled', true);
                        document.querySelector('#litigantes_form').submit();
                        console.log("Formulario válido");
                    }

                    form.classList.add('was-validated');
                }, false);
            });
            let map, infoWindow;
            let marker = null;
            let current = null;
            const initMapMoral = () => {
                const position = {
                    lat: 32.521036,
                    lng: -117.015543
                };
                const BAJACALIFORNIA_BOUNDS = {
                    north: 32.718754,
                    south: 28,
                    west: -118.407649,
                    east: -112.65424,
                    // 28,-118.407649 – 32.718754,-112.65424
                    // Check bound in https://developers-dot-devsite-v2-prod.appspot.com/maps/documentation/utils/geocoder
                };
                map = new google.maps.Map(document.getElementById("map_moral"), {
                    center: position,
                    zoom: 10,
                    gestureHandling: "cooperative",
                    // restriction: {
                    //     latLngBounds: BAJACALIFORNIA_BOUNDS,
                    //     strictBounds: false,
                    // },
                });

                google.maps.event.addListener(map, "click", (event) => {
                    addMarkerMoral(event.latLng, map, 'evento');
                });

                infoWindow = new google.maps.InfoWindow();

                const locationButton = document.createElement("button");
                locationButton.style.backgroundColor = "#fff";
                locationButton.style.border = "2px solid #fff";
                locationButton.style.borderRadius = "3px";
                locationButton.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
                locationButton.style.color = "rgb(25,25,25)";
                locationButton.style.cursor = "pointer";
                locationButton.style.fontFamily = "Roboto,Arial,sans-serif";
                locationButton.style.fontSize = "16px";
                locationButton.style.lineHeight = "38px";
                locationButton.style.margin = "8px 0 22px";
                locationButton.style.padding = "0 5px";
                locationButton.style.textAlign = "center";
                locationButton.textContent = "Mi ubicación";
                locationButton.title = "Clic para ir a tu ubicación actual.";
                locationButton.type = "button";
                locationButton.classList.add("custom-map-control-button");
                map.controls[google.maps.ControlPosition.TOP_CENTER].push(
                    locationButton
                );

                currentPosition();


                locationButton.addEventListener("click", () => {
                    currentPosition();
                });


            };

            const initMap = () => {
                const position = {
                    lat: 32.521036,
                    lng: -117.015543
                };
                const BAJACALIFORNIA_BOUNDS = {
                    north: 32.718754,
                    south: 28,
                    west: -118.407649,
                    east: -112.65424,
                    // 28,-118.407649 – 32.718754,-112.65424
                    // Check bound in https://developers-dot-devsite-v2-prod.appspot.com/maps/documentation/utils/geocoder
                };
                map = new google.maps.Map(document.getElementById("map"), {
                    center: position,
                    zoom: 10,
                    gestureHandling: "cooperative",
                    // restriction: {
                    //     latLngBounds: BAJACALIFORNIA_BOUNDS,
                    //     strictBounds: false,
                    // },
                });

                google.maps.event.addListener(map, "click", (event) => {
                    addMarker(event.latLng, map, 'evento');
                });

                infoWindow = new google.maps.InfoWindow();

                const locationButton = document.createElement("button");
                locationButton.style.backgroundColor = "#fff";
                locationButton.style.border = "2px solid #fff";
                locationButton.style.borderRadius = "3px";
                locationButton.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
                locationButton.style.color = "rgb(25,25,25)";
                locationButton.style.cursor = "pointer";
                locationButton.style.fontFamily = "Roboto,Arial,sans-serif";
                locationButton.style.fontSize = "16px";
                locationButton.style.lineHeight = "38px";
                locationButton.style.margin = "8px 0 22px";
                locationButton.style.padding = "0 5px";
                locationButton.style.textAlign = "center";
                locationButton.textContent = "Mi ubicación";
                locationButton.title = "Clic para ir a tu ubicación actual.";
                locationButton.type = "button";
                locationButton.classList.add("custom-map-control-button");
                map.controls[google.maps.ControlPosition.TOP_CENTER].push(
                    locationButton
                );

                currentPosition();


                locationButton.addEventListener("click", () => {
                    currentPosition();
                });




            };
            //obtiene la posicion actual
            const currentPosition = () => {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            const pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude,
                            };

                            map.setCenter(pos);
                            addMarker(pos, map, 'current');
                            map.setZoom(15);
                        },
                        () => {
                            handleLocationError(true, infoWindow, map.getCenter());
                        }
                    );
                } else {
                    handleLocationError(false, infoWindow, map.getCenter());
                }
            };

            //marca en el mapa la posicion del hecho
            const addMarker = (position, map, prov) => {

                marker ? (marker.setMap(null), (marker = null)) : null;
                marker = new google.maps.Marker({
                    position,
                });
                if (prov == 'current') {
                    document.getElementById('longitud').value = position['lng'];
                    document.getElementById('latitud').value = position['lat'];

                } else {
                    document.getElementById('longitud').value = position;
                    let stringpos = document.getElementById('longitud').value
                    if (typeof stringpos == 'string') {
                        stringpos = stringpos.replace('(', '');
                        stringpos = stringpos.replace(')', '');
                        stringpos = stringpos.replace(' ', '');

                        let arr = stringpos.split(',');
                        const positionMake = {
                            lat: arr[0],
                            lng: arr[1]
                        };
                        document.getElementById('longitud').value = positionMake['lng'];
                        document.getElementById('latitud').value = positionMake['lat'];

                    }
                }


                // map.setCenter(position);
                marker.setMap(map);
            };

            //marca en el mapa la posicion del hecho
            const addMarkerMoral = (position, map, prov) => {

                marker ? (marker.setMap(null), (marker = null)) : null;
                marker = new google.maps.Marker({
                    position,
                });
                if (prov == 'current') {
                    document.getElementById('longitud_moral').value = position['lng'];
                    document.getElementById('latitud_moral').value = position['lat'];

                } else {
                    document.getElementById('longitud_moral').value = position;
                    let stringpos = document.getElementById('latitud_moral').value
                    if (typeof stringpos == 'string') {
                        stringpos = stringpos.replace('(', '');
                        stringpos = stringpos.replace(')', '');
                        stringpos = stringpos.replace(' ', '');

                        let arr = stringpos.split(',');
                        const positionMake = {
                            lat: arr[0],
                            lng: arr[1]
                        };
                        document.getElementById('longitud_moral').value = positionMake['lng'];
                        document.getElementById('latitud_moral').value = positionMake['lat'];

                    }
                }


                // map.setCenter(position);
                marker.setMap(map);
            };

            //obtiene los errores de la localizacion
            const handleLocationError = (browserHasGeolocation, infoWindow, pos) => {
                infoWindow.setPosition(pos);
                infoWindow.setContent(
                    browserHasGeolocation ?
                    "Error: The Geolocation service failed." :
                    "Error: Your browser doesn't support geolocation."
                );
                infoWindow.open(map);
            };
            var check_ubi_moral = document.getElementById('check_ubi_moral');

            // datos_create_moral.classList.remove('d-none')
            //Evento para abrir la ubicacion exacta (mapa)
            check_ubi_moral.addEventListener('click', function() {
                let mapa = document.querySelector('#map_moral');

                if (check_ubi_moral.checked) {
                    mapa.classList.remove('d-none');
                    mapa.style.width = '100%';
                    mapa.style.height = '400px';
                    document.querySelector('#check_ubi_moral').value = "on";

                } else {
                    mapa.classList.add('d-none');
                    document.querySelector('#check_ubi_moral').value = "off";


                }

            });
            var check_ubi = document.getElementById('check_ubi');


            //Evento para abrir la ubicacion exacta (mapa)
            check_ubi.addEventListener('click', function() {
                let mapa = document.querySelector('#map');

                if (check_ubi.checked) {
                    mapa.classList.remove('d-none');
                    mapa.style.width = '100%';
                    mapa.style.height = '400px';
                    document.querySelector('#check_ubi').value = "on";

                } else {
                    mapa.classList.add('d-none');
                    document.querySelector('#check_ubi').value = "off";


                }
            });
            const formularioOriginal = litigantes_form.innerHTML;
            const tipo_persona = document.getElementById("tipo_persona");
            tipo_persona.addEventListener('change', (e) => {
                if (e.target.value == "MORAL") {
                    initMapMoral();
                    litigantes_form.action = `<?= base_url() ?>/denuncia_litigantes/dashboard/create_denuncia_persona_moral`
                } else {
                    initMap();
                    litigantes_form.action = `<?= base_url() ?>/denuncia_litigantes/dashboard/create_denuncia_persona_fisica`



                }
            });
            document.querySelector('#correo_empresa_c').blur();
            document.querySelector('#correo_empresa_extra').blur();

            document.querySelector('#rfc_empresa').blur();
            document.querySelector('#estado_empresa_c').addEventListener('change', (e) => {
                let select_municipio = document.querySelector('#municipio_empresa_c');

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
            document.querySelector('#municipio_empresa_c').addEventListener('change', (e) => {
                let select_localidad = document.querySelector('#localidad_empresa_c');
                let select_colonia = document.querySelector('#colonia_select_empresa_c');
                let input_colonia = document.querySelector('#colonia_input_empresa_c');

                let estado = document.querySelector('#estado_empresa_c').value;
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

            document.querySelector('#localidad_empresa_c').addEventListener('change', (e) => {
                let select_colonia = document.querySelector('#colonia_select_empresa_c');
                let input_colonia = document.querySelector('#colonia_input_empresa_c');

                let estado = document.querySelector('#estado_empresa_c').value;
                let municipio = document.querySelector('#municipio_empresa_c').value;
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

            document.querySelector('#colonia_select_empresa_c').addEventListener('change', (e) => {
                let select_colonia = document.querySelector('#colonia_select_empresa_c');
                let input_colonia = document.querySelector('#colonia_input_empresa_c');

                if (e.target.value === '0') {
                    select_colonia.classList.add('d-none');
                    input_colonia.classList.remove('d-none');
                    input_colonia.value = '';
                    input_colonia.focus();
                } else {
                    input_colonia.value = '-';
                }
            });

            document.querySelector('#estado_empresa').addEventListener('change', (e) => {
                let select_municipio = document.querySelector('#municipio_empresa');

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
            document.querySelector('#municipio_empresa').addEventListener('change', (e) => {
                let select_localidad = document.querySelector('#localidad_empresa');
                let select_colonia = document.querySelector('#colonia_select_empresa');
                let input_colonia = document.querySelector('#colonia_input_empresa');

                let estado = document.querySelector('#estado_empresa').value;
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

            document.querySelector('#localidad_empresa').addEventListener('change', (e) => {
                let select_colonia = document.querySelector('#colonia_select_empresa');
                let input_colonia = document.querySelector('#colonia_input_empresa');

                let estado = document.querySelector('#estado_empresa').value;
                let municipio = document.querySelector('#municipio_empresa').value;
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

            document.querySelector('#colonia_select_empresa').addEventListener('change', (e) => {
                let select_colonia = document.querySelector('#colonia_select_empresa');
                let input_colonia = document.querySelector('#colonia_input_empresa');

                if (e.target.value === '0') {
                    select_colonia.classList.add('d-none');
                    input_colonia.classList.remove('d-none');
                    input_colonia.value = '';
                    input_colonia.focus();
                } else {
                    input_colonia.value = '-';
                }
            });

            document.querySelector('#correo_empresa_c').addEventListener('blur', (e) => {
                let regex = /\S+@\S+\.\S+/

                if (regex.test(e.target.value)) {
                    $.ajax({
                        data: {
                            'email': e.target.value,
                            'rfc': document.getElementById('rfc_empresa').value

                        },
                        url: "<?= base_url('/data/exist-email-empresarial') ?>",
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
            document.querySelector('#correo_empresa_extra').addEventListener('blur', (e) => {
                let regex = /\S+@\S+\.\S+/

                if (regex.test(e.target.value)) {
                    $.ajax({
                        data: {
                            'email': e.target.value,
                            'personamoralid': empresaid,

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
            const mousedownHandler = function(event) {
                event.preventDefault();
            };

            document.querySelector('#rfc_empresa').addEventListener('blur', (e) => {
                if ((e.target.value)) {
                    $.ajax({
                        data: {
                            'rfc': e.target.value
                        },
                        url: "<?= base_url('/data/exist-rfc') ?>",
                        method: "POST",
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            if (response.exist === 1) {
                                const personamoral = response.moral;
                                // e.target.value = '';
                                // Swal.fire({
                                //     icon: 'error',
                                //     text: 'El RFC ya se encuenta registrado.',
                                //     confirmButtonColor: '#bf9b55',
                                // });
                                if (personamoral.ESTADOID) {
                                    let data = {
                                        'estado_id': personamoral.ESTADOID
                                    };
                                    $.ajax({
                                        data: data,
                                        url: "<?= base_url('/data/get-municipios-by-estado') ?>",
                                        method: "POST",
                                        dataType: "json",
                                        success: function(response) {
                                            let municipios = response.data;
                                            municipios.forEach(municipio => {
                                                let option = document.createElement("option");
                                                option.text = municipio.MUNICIPIODESCR;
                                                option.value = municipio.MUNICIPIOID;
                                                document.querySelector('#municipio_empresa_c').add(option);
                                            });
                                            document.querySelector('#municipio_empresa_c').value = personamoral.MUNICIPIOID ? personamoral.MUNICIPIOID : '';
                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {}
                                    });
                                } else {
                                    document.querySelector('#municipio_empresa_c').value = '';
                                }
                                if (personamoral.LOCALIDADID) {
                                    let data = {
                                        'estado_id': personamoral.ESTADOID,
                                        'municipio_id': personamoral.MUNICIPIOID
                                    };

                                    $.ajax({
                                        data: data,
                                        url: "<?= base_url('/data/get-localidades-by-municipio') ?>",
                                        method: "POST",
                                        dataType: "json",
                                        success: function(response) {
                                            let localidades = response.data;
                                            let select_localidad = document.querySelector(
                                                '#localidad_empresa_c');

                                            localidades.forEach(localidad => {
                                                var option = document.createElement("option");
                                                option.text = localidad.LOCALIDADDESCR;
                                                option.value = localidad.LOCALIDADID;
                                                select_localidad.add(option);
                                            });

                                            select_localidad.value = personamoral.LOCALIDADID;
                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {}
                                    });
                                } else {
                                    document.querySelector('#localidad_empresa_c').value = '';
                                }

                                if (personamoral.COLONIAID && personamoral.COLONIAID != '0') {
                                    document.querySelector('#colonia_input_empresa_c').classList.add('d-none');
                                    document.querySelector('#colonia_select_empresa_c').classList.remove('d-none');
                                    let data = {
                                        'estado_id': personamoral.ESTADOID,
                                        'municipio_id': personamoral.MUNICIPIOID,
                                        'localidad_id': personamoral.LOCALIDADID
                                    };
                                    $.ajax({
                                        data: data,
                                        url: "<?= base_url('/data/get-colonias-by-estado-municipio-localidad') ?>",
                                        method: "POST",
                                        dataType: "json",
                                        success: function(response) {
                                            let select_colonia = document.querySelector(
                                                '#colonia_select_empresa_c');
                                            let input_colonia = document.querySelector(
                                                '#colonia_input_empresa_c');
                                            let colonias = response.data;

                                            colonias.forEach(colonia => {
                                                var option = document.createElement("option");
                                                option.text = colonia.COLONIADESCR;
                                                option.value = colonia.COLONIAID;
                                                select_colonia.add(option);
                                            });

                                            var option = document.createElement("option");
                                            option.text = 'OTRO';
                                            option.value = '0';
                                            select_colonia.add(option);

                                            select_colonia.value = personamoral.COLONIAID;
                                            console.log(personamoral.COLONIAID);
                                            input_colonia.value = '-';
                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {

                                        }
                                    });
                                } else if (personamoral.COLONIAID == '0') {
                                    document.querySelector('#colonia_input_empresa_c').classList.remove('d-none');
                                    document.querySelector('#colonia_select_empresa_c').classList.add('d-none');
                                    var option = document.createElement("option");
                                    option.text = 'OTRO';
                                    option.value = '0';
                                    document.querySelector('#colonia_select_empresa_c').add(option);
                                    document.querySelector('#colonia_select_empresa_c').value = '0';
                                    document.querySelector('#colonia_input_empresa_c').value = personamoral.COLONIADESCR;
                                } else {
                                    document.querySelector('#colonia_input_empresa_c').classList.remove('d-none');
                                    document.querySelector('#colonia_select_empresa_c').classList.add('d-none');
                                    var option = document.createElement("option");
                                    option.text = 'OTRO';
                                    option.value = '0';
                                    document.querySelector('#colonia_select_empresa_c').add(option);
                                    document.querySelector('#colonia_select_empresa_c').value = '0';
                                    document.querySelector('#colonia_input_empresa_c').value = personamoral.COLONIADESCR;
                                }


                                document.getElementById('razon_social').value = personamoral.RAZONSOCIAL;
                                document.getElementById('marca_comercial_d').value = personamoral.MARCACOMERCIAL ? personamoral.MARCACOMERCIAL : '';
                                document.getElementById('giro_empresa_denuncia').value = personamoral.PERSONAMORALGIROID;
                                document.getElementById('correo_empresa_c').value = personamoral.CORREO;
                                document.getElementById('calle_empresa_c').value = personamoral.CALLE;
                                document.getElementById('n_empresa_c').value = personamoral.NUMERO;
                                document.getElementById('telefono_empresa_c').value = personamoral.TELEFONO;
                                document.getElementById('estado_empresa_c').value = personamoral.ESTADOID;

                                document.getElementById('poder_volumen').value = personamoral.PODERVOLUMEN ? personamoral.PODERVOLUMEN : '';
                                document.getElementById('poder_notario').value = personamoral.PODERNOTARIO ? personamoral.PODERNOTARIO : '';
                                document.getElementById('poder_no_poder').value = personamoral.PODERNOPODER ? personamoral.PODERNOPODER : '';
                                document.getElementById('fecha_inicio_poder').value = personamoral.FECHAINICIOPODER ? personamoral.FECHAINICIOPODER : '';
                                document.getElementById('fecha_fin_poder').value = personamoral.FECHAFINPODER ? personamoral.FECHAFINPODER : '';
                                document.getElementById('cargo').value = personamoral.CARGO;
                                document.getElementById('descr_cargo').value = personamoral.DESCRIPCIONCARGO ? personamoral.DESCRIPCIONCARGO : '';
                                if (personamoral.PODERARCHIVO) {
                                    $("#poder_archivo").removeAttr("required");
                                    let extension = (((personamoral.PODERARCHIVO.split(';'))[0]).split('/'))[1];
                                    if (extension == 'pdf' || extension == 'doc') {
                                        document.querySelector('#poder_foto').setAttribute('src', '<?= base_url() ?>/assets/img/file.png');
                                    } else {
                                        document.querySelector('#poder_foto').setAttribute('src', personamoral.PODERARCHIVO);
                                    }
                                    document.getElementById('poder_archivo').disabled = true;
                                    document.getElementById('solicitar-cambio').classList.remove('d-none');
                                    document.getElementById('poder_volumen').readOnly = true;
                                    document.getElementById('poder_notario').readOnly = true;
                                    document.getElementById('poder_no_poder').readOnly = true;
                                    document.getElementById('fecha_inicio_poder').readOnly = true;
                                    document.getElementById('fecha_fin_poder').readOnly = true;
                                    document.getElementById('cargo').readOnly = true;
                                    document.getElementById('descr_cargo').readOnly = true;
                                    document.getElementById("cargo").addEventListener("mousedown", mousedownHandler);


                                }

                                correo_empresa.readOnly = true;
                                estado_empresa.readOnly = true;
                                municipio_empresa.readOnly = true;
                                localidad_empresa.readOnly = true;
                                zona_empresa.readOnly = true;
                                colonia_input_empresa.readOnly = true;
                                colonia_select_empresa.readOnly = true;
                                calle_empresa.readOnly = true;
                                n_empresa.readOnly = true;
                                ninterior_empresa.readOnly = true;
                                referencia_empresa.readOnly = true;
                                telefono_empresa.readOnly = true;
                                document.getElementById("estado_empresa").addEventListener("mousedown", mousedownHandler);
                                document.getElementById("municipio_empresa").addEventListener("mousedown", mousedownHandler);
                                document.getElementById("localidad_empresa").addEventListener("mousedown", mousedownHandler);
                                document.getElementById("colonia_select_empresa").addEventListener("mousedown", mousedownHandler);

                                document.getElementById('agregar-direccion').disabled = false;
                                empresaid = response.personamoralid;
                                clearSelect(direccion)
                                let direcciones = response.notificaciones;
                                direcciones.forEach(direccion => {
                                    let option = document.createElement("option");
                                    option.text = direccion.CALLE + ',' + direccion.COLONIADESCR;
                                    option.value = direccion.NOTIFICACIONID;
                                    document.querySelector('#direccion').add(option);
                                });
                                $("#direccion").attr("required");
                                direccion.classList.add('input-required');
                                direccion.disabled = false;
                            } else {
                                document.getElementById('razon_social').value = "";
                                document.getElementById('marca_comercial_d').value = "";
                                document.getElementById('giro_empresa_denuncia').value = "";
                                document.getElementById('correo_empresa_c').value = "";
                                document.getElementById('calle_empresa_c').value = "";
                                document.getElementById('n_empresa_c').value = "";
                                document.getElementById('telefono_empresa_c').value = "";
                                document.getElementById('estado_empresa_c').value = "";
                                clearSelect(municipio_empresa_c);
                                clearSelect(localidad_empresa_c);
                                clearSelect(colonia_select_empresa_c)
                                clearSelect(municipio_empresa);
                                clearSelect(localidad_empresa);
                                clearSelect(colonia_select_empresa)
                                colonia_input_empresa_c.classList.add('d-none');
                                colonia_select_empresa_c.classList.remove('d-none');
                                document.getElementById('correo_empresa').value = "";
                                document.getElementById('calle_empresa').value = "";
                                document.getElementById('n_empresa').value = "";
                                document.getElementById('zona_empresa').value = "";
                                document.getElementById('telefono_empresa').value = "";
                                poder = "S";
                                $("#poder_archivo").attr("required");
                                document.getElementById('poder_archivo').disabled = false;
                                document.getElementById('cargo').value = "";
                                document.getElementById("poder_foto").removeAttribute("src");
                                document.getElementById('solicitar-cambio').classList.add('d-none');
                                document.getElementById('poder_volumen').readOnly = false;
                                document.getElementById('poder_notario').readOnly = false;
                                document.getElementById('poder_no_poder').readOnly = false;
                                document.getElementById('fecha_inicio_poder').readOnly = false;
                                document.getElementById('fecha_fin_poder').readOnly = false;
                                document.getElementById('cargo').readOnly = false;
                                document.getElementById('descr_cargo').readOnly = false;
                                document.getElementById("cargo").removeEventListener("mousedown", mousedownHandler);
                                direccion.value = "";
                                $("#direccion").removeAttr("required");
                                direccion.classList.remove('input-required');
                                direccion.disabled = true;
                                document.getElementById('agregar-direccion').disabled = true;
                                zona_empresa.disabled = true;
                                correo_empresa.readOnly = false;
                                estado_empresa.readOnly = false;
                                municipio_empresa.readOnly = false;
                                localidad_empresa.readOnly = false;
                                zona_empresa.readOnly = false;
                                colonia_input_empresa.readOnly = false;
                                colonia_select_empresa.readOnly = false;
                                calle_empresa.readOnly = false;
                                n_empresa.readOnly = false;
                                ninterior_empresa.readOnly = false;
                                referencia_empresa.readOnly = false;
                                telefono_empresa.readOnly = false;
                                document.getElementById("estado_empresa").removeEventListener("mousedown", mousedownHandler);
                                document.getElementById("municipio_empresa").removeEventListener("mousedown", mousedownHandler);
                                document.getElementById("localidad_empresa").removeEventListener("mousedown", mousedownHandler);
                                document.getElementById("colonia_select_empresa").removeEventListener("mousedown", mousedownHandler);

                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {}
                    });
                };
            })
            document.querySelector('#direccion').addEventListener('change', (e) => {
                let data = {
                    'personamoralid': empresaid,
                    'notificacionid': e.target.value,

                }

                $.ajax({
                    data: data,
                    url: "<?= base_url('/data/get-notificacion-by-empresa') ?>",
                    method: "POST",
                    dataType: "json",
                    success: function(responsemaster) {
                        correo_empresa.value = responsemaster.data.CORREO;
                        estado_empresa.value = responsemaster.data.ESTADOID;
                        zona_empresa.value = responsemaster.data.ZONA == 'U' ? "URBANA" : "RURAL";
                        calle_empresa.value = responsemaster.data.CALLE;
                        n_empresa.value = responsemaster.data.NUMERO;
                        ninterior_empresa.value = responsemaster.data.NUMEROINTERIOR != "" || responsemaster.data.NUMEROINTERIOR != null ? responsemaster.data.NUMEROINTERIOR : '';
                        referencia_empresa.value = responsemaster.data.REFERENCIA != "" || responsemaster.data.REFERENCIA != null ? responsemaster.data.REFERENCIA : '';
                        telefono_empresa.value = responsemaster.data.TELEFONO;


                        if (responsemaster.data.ESTADOID) {
                            let data = {
                                'estado_id': responsemaster.data.ESTADOID
                            };
                            $.ajax({
                                data: data,
                                url: "<?= base_url('/data/get-municipios-by-estado') ?>",
                                method: "POST",
                                dataType: "json",
                                success: function(response) {
                                    let municipios = response.data;
                                    clearSelect(municipio_empresa)

                                    municipios.forEach(municipio => {
                                        let option = document.createElement("option");
                                        option.text = municipio.MUNICIPIODESCR;
                                        option.value = municipio.MUNICIPIOID;
                                        document.querySelector('#municipio_empresa').add(option);
                                    });
                                    municipio_empresa.value = responsemaster.data.MUNICIPIOID;

                                },
                                error: function(jqXHR, textStatus, errorThrown) {}
                            });
                        } else {
                            document.querySelector('#municipio_empresa').value = '';
                        }
                        if (responsemaster.data.ESTADOID && responsemaster.data.MUNICIPIOID && responsemaster.data.LOCALIDADID) {
                            let data = {
                                'estado_id': responsemaster.data.ESTADOID,
                                'municipio_id': responsemaster.data.MUNICIPIOID
                            };

                            $.ajax({
                                data: data,
                                url: "<?= base_url('/data/get-localidades-by-municipio') ?>",
                                method: "POST",
                                dataType: "json",
                                success: function(response) {
                                    clearSelect(localidad_empresa)

                                    let localidades = response.data;
                                    localidades.forEach(localidad => {
                                        var option = document.createElement("option");
                                        option.text = localidad.LOCALIDADDESCR;
                                        option.value = localidad.LOCALIDADID;
                                        localidad_empresa.add(option);
                                    });

                                    localidad_empresa.value = responsemaster.data.LOCALIDADID;
                                },
                                error: function(jqXHR, textStatus, errorThrown) {}
                            });
                        } else {
                            document.querySelector('#localidad_empresa').value = '';
                        }
                        if (responsemaster.data.ESTADOID && responsemaster.data.MUNICIPIOID && responsemaster.data.LOCALIDADID && responsemaster.data.COLONIAID) {
                            colonia_input_empresa.classList.add('d-none');
                            colonia_select_empresa.classList.remove('d-none');
                            let data = {
                                'estado_id': responsemaster.data.ESTADOID,
                                'municipio_id': responsemaster.data.MUNICIPIOID,
                                'localidad_id': responsemaster.data.LOCALIDADID
                            };
                            $.ajax({
                                data: data,
                                url: "<?= base_url('/data/get-colonias-by-estado-municipio-localidad') ?>",
                                method: "POST",
                                dataType: "json",
                                success: function(response) {
                                    clearSelect(colonia_select_empresa)

                                    let colonias = response.data;
                                    colonias.forEach(colonia => {
                                        var option = document.createElement("option");
                                        option.text = colonia.COLONIADESCR;
                                        option.value = colonia.COLONIAID;
                                        colonia_select_empresa.add(option);
                                    });

                                    var option = document.createElement("option");
                                    option.text = 'OTRO';
                                    option.value = '0';
                                    colonia_select_empresa.add(option);
                                    colonia_select_empresa.value = responsemaster.data.COLONIAID;
                                    colonia_input_empresa.value = '-';
                                },
                                error: function(jqXHR, textStatus, errorThrown) {}
                            });
                        } else {
                            colonia_input_empresa.classList.remove('d-none');
                            colonia_select_empresa.classList.add('d-none');
                            var option = document.createElement("option");
                            option.text = 'OTRO';
                            option.value = '0';
                            colonia_select_empresa.add(option);
                            colonia_select_empresa.value = '0';
                            colonia_input_empresa.value = responsemaster.data.COLONIADESCR ? responsemaster.data
                                .COLONIADESCR : '';
                        }


                    }
                });
            });
            //Funcion para eliminar los optiones de un select
            function clearSelect(select_element) {
                for (let i = select_element.options.length; i >= 1; i--) {
                    select_element.remove(i);
                }
            }
            //Convierte todo el elemento a mayusculas
            function mayuscTextarea(e) {
                e.value = e.value.toUpperCase();
            }

            //Funcion para contar carcateres de un elemento
            function contarCaracteres(obj) {
                var maxLength = 1000;
                var strLength = obj.value.length;
                var charRemain = (maxLength - strLength);

                if (charRemain < 0) {
                    document.getElementById("numCaracter").innerHTML = '<span style="color: red;">Has superado el límite de ' + maxLength + ' caracteres </span>';
                } else {
                    document.getElementById("numCaracter").innerHTML = charRemain + ' caracteres restantes';
                }
            }

            //Steps

            chargeCurrentStep(currentStep);

            // submitBtn.addEventListener('click',()=>{
            //     console.log("click");
            //     litigantes_form.submit();

            // })
            document.getElementById('datos_imputado').classList.remove('step');
            const responsable_moral = document.querySelectorAll('input[name="responsable_moral"]');
            responsable_moral.forEach(button => {
                button.addEventListener('change', () => {
                    if (button.value === 'SI') {
                        document.getElementById('datos_imputado').classList.add('step');
                    } else if (button.value === 'NO') {
                        document.getElementById('datos_imputado').classList.remove('step');
                    }
                });
            });

            const campos = litigantes_form.elements;
            for (let i = 0; i < campos.length; i++) {
                const campo = campos[i];
                campo.dataset.required = campo.hasAttribute('required');
            }
            nextBtn.addEventListener('click', () => {
                //Agrega steps de acuerdo a las preguntas iniciales
                var vista = document.querySelectorAll('.step');
                if (tipo_persona.value == "MORAL") {
                    console.log("aqui");
                    if (validarStepMoral(vista[currentStep].id)) {

                        document.getElementById('datos_delito').classList.remove('step');
                        document.getElementById('datos_desaparecido').classList.remove('step');
                        // document.getElementById('datos_robo_vehiculo').classList.remove('step');
                        // document.getElementById('datos_robo_vehiculo_completo').classList.remove('step');
                        document.getElementById('datos_ofendido').classList.remove('step');

                        const datos_delito = document.getElementById('datos_delito');
                        const datos_desaparecido = document.getElementById('datos_desaparecido');
                        const datos_robo_vehiculo = document.getElementById('datos_robo_vehiculo');
                        const datos_robo_vehiculo_completo = document.getElementById('datos_robo_vehiculo_completo');
                        const datos_ofendido = document.getElementById('datos_ofendido');

                        const requiredFields1 = datos_delito.querySelectorAll('[required]');
                        requiredFields1.forEach(field => {
                            field.removeAttribute('required');
                        });
                        const requiredFields2 = datos_desaparecido.querySelectorAll('[required]');
                        requiredFields2.forEach(field => {
                            field.removeAttribute('required');
                        });
                        const requiredFields3 = datos_robo_vehiculo.querySelectorAll('[required]');
                        requiredFields3.forEach(field => {
                            field.removeAttribute('required');
                        });
                        const requiredFields4 = datos_robo_vehiculo_completo.querySelectorAll('[required]');
                        requiredFields4.forEach(field => {
                            field.removeAttribute('required');
                        });
                        const requiredFields5 = datos_ofendido.querySelectorAll('[required]');
                        requiredFields5.forEach(field => {
                            field.removeAttribute('required');
                        });
                        if (document.querySelector("#delito_moral").value == "PERSONA DESAPARECIDA") {
                            $("input[name=documentos_vehiculo_moral][value='O']").prop("checked", true);
                            document.getElementById('datos_robo_vehiculo').classList.remove('step');
                            document.getElementById('datos_robo_vehiculo_completo').classList.remove('step');
                            document.getElementById('datos_desaparecido').classList.add('step');
                        }

                        $('#delito_moral').change(function() {

                            if (document.querySelector("#delito_moral").value == "ROBO DE VEHÍCULO") {
                                var radio_doc_vehiculo = document.getElementById("radio_documentos_vehiculo");
                                radio_doc_vehiculo.classList.remove('d-none');
                                if (document.getElementById('documentos_vehiculo_moral').value == 'S') {
                                    document.getElementById('datos_robo_vehiculo_completo').classList.add('step');
                                    document.getElementById('datos_robo_vehiculo').classList.remove('step');
                                } else if (document.getElementById('documentos_vehiculo_moral').value == 'N') {
                                    document.getElementById('datos_robo_vehiculo').classList.add('step');
                                    document.getElementById('datos_robo_vehiculo_completo').classList.remove('step');
                                }
                                // document.querySelector('input[name="documentos_vehiculo"]:checked').value = 'N';
                                // document.querySelector('#documentos_vehiculo > [value="N"]').checked = true;	
                                // $("input[name=documentos_vehiculo][value='N']").prop("checked",true);

                                $('input[type=radio][name=documentos_vehiculo_moral]').change(function() {
                                    if (this.value == 'S') {
                                        console.log("si");
                                        document.getElementById('datos_robo_vehiculo_completo').classList.add('step');
                                        document.getElementById('datos_robo_vehiculo').classList.remove('step');
                                    } else if (this.value == 'N') {
                                        document.getElementById('datos_robo_vehiculo').classList.add('step');
                                        document.getElementById('datos_robo_vehiculo_completo').classList.remove('step');
                                    }

                                });
                            } else {
                                var radio_doc_vehiculo = document.getElementById("radio_documentos_vehiculo");

                                radio_doc_vehiculo.classList.add('d-none');
                                $("input[name=documentos_vehiculo_moral][value='O']").prop("checked", true);
                                document.getElementById('datos_robo_vehiculo').classList.remove('step');
                                document.getElementById('datos_robo_vehiculo_completo').classList.remove('step');



                            }
                        })
                        steps = document.querySelectorAll('.step');
                        var stepCount = steps.length - 1;
                        var width = 100 / stepCount;

                        currentStep++;
                        let previousStep = currentStep - 1;
                        if ((currentStep > 0) && (currentStep <= stepCount)) {
                            prevBtn.classList.remove('d-none');
                            prevBtn.classList.add('d-inline-block');
                            steps[currentStep].classList.remove('d-none');
                            steps[currentStep].classList.add('d-block');
                            steps[previousStep].classList.remove('d-block');
                            steps[previousStep].classList.add('d-none');
                            if (currentStep === stepCount) {
                                submitBtn.classList.remove('d-none');
                                submitBtn.classList.add('d-inline-block');
                                nextBtn.classList.remove('d-inline-block');
                                nextBtn.classList.add('d-none');
                            }
                        }
                        progress.style.width = `${currentStep*width}%`
                        document.querySelector('#titulo').scrollIntoView();
                    } else {
                        // console.log('NO SE VALIDO');
                        submitBtn.click();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Debes llenar todos los campos requeridos para avanzar',
                            confirmButtonColor: '#bf9b55',
                        })
                    }

                } else if (tipo_persona.value == "FISICA") {

                    if (validarStep(vista[currentStep].id)) {
                        // quitarRequired();
                        document.getElementById('datos_ofendido').classList.add('step');
                        //Remover de persona moral
                        document.getElementById('datos_moral').classList.remove('step');
                        document.getElementById('datos_ligacion').classList.remove('step');
                        document.getElementById('datos_delito_moral').classList.remove('step');


                        document.getElementById('datos_desaparecido').classList.remove('step');
                        
                        const datos_delito = document.getElementById('datos_delito');
                        const datos_moral = document.getElementById('datos_moral');
                        const datos_ligacion = document.getElementById('datos_ligacion');

                        const datos_robo_vehiculo = document.getElementById('datos_robo_vehiculo');
                        const datos_robo_vehiculo_completo = document.getElementById('datos_robo_vehiculo_completo');
                        const datos_ofendido = document.getElementById('datos_ofendido');

                        const requiredFields1 = datos_moral.querySelectorAll('[required]');
                        requiredFields1.forEach(field => {
                            field.removeAttribute('required');
                        });
                        const requiredFields6 = datos_ligacion.querySelectorAll('[required]');
                        requiredFields6.forEach(field => {
                            field.removeAttribute('required');
                        });
                        const requiredFields7 = datos_delito_moral.querySelectorAll('[required]');
                        requiredFields7.forEach(field => {
                            field.removeAttribute('required');
                        });
                        const requiredFields2 = datos_desaparecido.querySelectorAll('[required]');
                        requiredFields2.forEach(field => {
                            field.removeAttribute('required');
                        });
                        const requiredFields3 = datos_robo_vehiculo.querySelectorAll('[required]');
                        requiredFields3.forEach(field => {
                            field.removeAttribute('required');
                        });
                        const requiredFields4 = datos_robo_vehiculo_completo.querySelectorAll('[required]');
                        requiredFields4.forEach(field => {
                            field.removeAttribute('required');
                        });

                        if (document.querySelector("#delito").value == "PERSONA DESAPARECIDA") {
                            $("input[name=documentos_vehiculo_p][value='O']").prop("checked", true);
                            document.getElementById('datos_robo_vehiculo').classList.remove('step');
                            document.getElementById('datos_robo_vehiculo_completo').classList.remove('step');
                            document.getElementById('datos_desaparecido').classList.add('step');
                        }

                        $('#delito').change(function() {

                            if (document.querySelector("#delito").value == "ROBO DE VEHÍCULO") {
                                var radio_doc_vehiculo = document.getElementById("radio_documentos_vehiculo_p");
                                radio_doc_vehiculo.classList.remove('d-none');
                                if (document.getElementById('documentos_vehiculo_p').value == 'S') {
                                    document.getElementById('datos_robo_vehiculo_completo').classList.add('step');
                                    document.getElementById('datos_robo_vehiculo').classList.remove('step');
                                } else if (document.getElementById('documentos_vehiculo_p').value == 'N') {
                                    document.getElementById('datos_robo_vehiculo').classList.add('step');
                                    document.getElementById('datos_robo_vehiculo_completo').classList.remove('step');
                                }
                                // document.querySelector('input[name="documentos_vehiculo"]:checked').value = 'N';
                                // document.querySelector('#documentos_vehiculo > [value="N"]').checked = true;	
                                // $("input[name=documentos_vehiculo][value='N']").prop("checked",true);

                                $('input[type=radio][name=documentos_vehiculo_p]').change(function() {
                                    if (this.value == 'S') {
                                        console.log("si");
                                        document.getElementById('datos_robo_vehiculo_completo').classList.add('step');
                                        document.getElementById('datos_robo_vehiculo').classList.remove('step');
                                    } else if (this.value == 'N') {
                                        document.getElementById('datos_robo_vehiculo').classList.add('step');
                                        document.getElementById('datos_robo_vehiculo_completo').classList.remove('step');
                                    }

                                });
                            } else {
                                var radio_doc_vehiculo = document.getElementById("radio_documentos_vehiculo_p");

                                radio_doc_vehiculo.classList.add('d-none');
                                $("input[name=documentos_vehiculo_p][value='O']").prop("checked", true);
                                document.getElementById('datos_robo_vehiculo').classList.remove('step');
                                document.getElementById('datos_robo_vehiculo_completo').classList.remove('step');



                            }
                        })
                        if (document.querySelector('input[name="responsable"]:checked').value == "NO") {
                            document.getElementById('datos_imputado').classList.remove('step');
                        } else {
                            document.getElementById('datos_imputado').classList.add('step');
                        }

                        steps = document.querySelectorAll('.step');
                        var stepCount = steps.length - 1;
                        var width = 100 / stepCount;

                        currentStep++;
                        let previousStep = currentStep - 1;
                        if ((currentStep > 0) && (currentStep <= stepCount)) {
                            prevBtn.classList.remove('d-none');
                            prevBtn.classList.add('d-inline-block');
                            steps[currentStep].classList.remove('d-none');
                            steps[currentStep].classList.add('d-block');
                            steps[previousStep].classList.remove('d-block');
                            steps[previousStep].classList.add('d-none');
                            if (currentStep === stepCount) {
                                submitBtn.classList.remove('d-none');
                                submitBtn.classList.add('d-inline-block');
                                nextBtn.classList.remove('d-inline-block');
                                nextBtn.classList.add('d-none');
                            }
                        }
                        progress.style.width = `${currentStep*width}%`
                        document.querySelector('#titulo').scrollIntoView();
                    } else {
                        // console.log('NO SE VALIDO');
                        submitBtn.click();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Debes llenar todos los campos requeridos para avanzar',
                            confirmButtonColor: '#bf9b55',
                        })
                    }
                }

                return false;
            });

            prevBtn.addEventListener('click', () => {
                //Modifica estilos cuando se regresa un step
                if (currentStep > 0) {
                    currentStep--;
                    let previousStep = currentStep + 1;
                    prevBtn.classList.add('d-none');
                    prevBtn.classList.add('d-inline-block');
                    steps[currentStep].classList.remove('d-none');
                    steps[currentStep].classList.add('d-block')
                    steps[previousStep].classList.remove('d-block');
                    steps[previousStep].classList.add('d-none');
                    if (currentStep < stepCount) {
                        submitBtn.classList.remove('d-inline-block');
                        submitBtn.classList.add('d-none');
                        nextBtn.classList.remove('d-none');
                        nextBtn.classList.add('d-inline-block');
                        prevBtn.classList.remove('d-none');
                        prevBtn.classList.add('d-inline-block');
                        document.getElementById('datos_delito').classList.add('step');
                        document.getElementById('datos_desaparecido').classList.add('step');
                        document.getElementById('datos_robo_vehiculo').classList.add('step');
                        document.getElementById('datos_robo_vehiculo_completo').classList.add('step');
                        document.getElementById('datos_ofendido').classList.add('step');
                        document.getElementById('datos_moral').classList.add('step');
                        document.getElementById('datos_ligacion').classList.add('step');
                        document.getElementById('datos_delito_moral').classList.add('step');

                        const datos_delito = document.getElementById('datos_delito');
                        const datos_moral = document.getElementById('datos_moral');
                        const datos_ligacion = document.getElementById('datos_ligacion');
                        const datos_delito_moral = document.getElementById('datos_delito_moral');
                        const datos_desaparecido = document.getElementById('datos_desaparecido');

                        const datos_robo_vehiculo = document.getElementById('datos_robo_vehiculo');
                        const datos_robo_vehiculo_completo = document.getElementById('datos_robo_vehiculo_completo');
                        const datos_ofendido = document.getElementById('datos_ofendido');

                        const campos = litigantes_form.elements;
                        for (let i = 0; i < campos.length; i++) {
                            const campo = campos[i];
                            if (campo.dataset.required === 'true') {
                                campo.setAttribute('required', '');
                            } else {
                                campo.removeAttribute('required');
                            }
                        }
                    }
                }

                if (currentStep === 0) {
                    prevBtn.classList.remove('d-inline-block');
                    prevBtn.classList.add('d-none');

                }

                progress.style.width = `${currentStep*width}%`
            });
            solicitarCambioBtn.addEventListener('click', () => {
                $.ajax({
                    data: {
                        'personamoralid': empresaid,

                    },
                    url: "<?= base_url('/data/solicitar_cambio') ?>",
                    method: "POST",
                    dataType: "json",
                    success: function(response) {
                        if (response.status === 1) {
                            Swal.fire({
                                icon: 'success',
                                text: 'Se ha solicitado el cambio.',
                                confirmButtonColor: '#bf9b55',
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {}
                });
            });

            //Funcion mostrar o ocultar los elementos de paso según el número especificado, y también actualiza el ancho del progreso.
            function chargeCurrentStep(num) {
                steps.forEach((step, index) => {
                    if (num === index) {
                        step.classList.remove('d-none');
                    } else {
                        step.classList.remove('d-block');
                        step.classList.add('d-none');
                    }
                })
                progress.style.width = `${currentStep*width}%`
            }
            //Funcion para validar los elementos requeridos de cada step
            function validarStepMoral(step) {
                switch (step) {
                    // case 'principal':
                    //     if (
                    //         document.querySelector('#razon_social_c').value != '' &&
                    //         document.querySelector('#rfc_c').value != '' &&
                    //         document.querySelector('#giro_empresa_c').value != '' &&
                    //         document.querySelector('#correo_empresa_c').value != '' &&
                    //         document.querySelector('#estado_empresa_c').value != '' &&
                    //         document.querySelector('#municipio_empresa_c').value != '' &&
                    //         document.querySelector('#localidad_empresa_c').value != '' &&
                    //         document.querySelector('#calle_empresa_c').value != '' &&
                    //         document.querySelector('#n_empresa_c').value != '' &&
                    //         document.querySelector('#telefono_empresa_c').value != ''
                    //     ) {
                    //         return true;
                    //     } else {
                    //         return false;
                    //     }
                    //     break;
                    case 'datos_moral':
                        if (
                            document.querySelector('#razon_social').value != '' &&
                            document.querySelector('#rfc_empresa').value != '' &&
                            document.querySelector('#giro_empresa_denuncia').value != '' &&
                            document.querySelector('#estado_empresa_c').value != '' &&
                            document.querySelector('#municipio_empresa_c').value != '' &&
                            document.querySelector('#localidad_empresa_c').value != '' &&
                            document.querySelector('#calle_empresa_c').value != '' &&
                            document.querySelector('#n_empresa_c').value != '' &&
                            document.querySelector('#telefono_empresa_c').value != '' &&
                            document.querySelector('#correo_empresa_c').value != '' &&
                            document.querySelector('#estado_empresa').value != '' &&
                            document.querySelector('#municipio_empresa').value != '' &&
                            document.querySelector('#localidad_empresa').value != '' &&
                            document.querySelector('#calle_empresa').value != '' &&
                            document.querySelector('#n_empresa').value != '' &&
                            document.querySelector('#telefono_empresa').value != ''
                        ) {
                            return true;
                        } else {
                            return false;
                        }
                        break;

                    case 'datos_ligacion':
                        if (poder == '') {
                            if (
                                document.querySelector('#cargo').value != ''
                            ) {
                                return true;
                            } else {
                                return false;
                            }
                        } else if (poder == 'S') {
                            if (
                                document.querySelector('#poder_archivo').value != '' &&
                                document.querySelector('#cargo').value != ''
                            ) {
                                return true;
                            } else {
                                return false;
                            }
                        }

                        break;


                    case 'datos_delito_moral':
                        let date1 = new Date(document.querySelector('#fecha_moral').value);
                        let date2 = new Date("<?= date("Y-m-d") ?>");
                        if (date1 > date2) {
                            document.querySelector('#fecha_moral').value = '';
                        }
                        if (
                            document.querySelector('#delito_moral').value != '' &&
                            document.querySelector('#lugar_moral').value != '' &&
                            document.querySelector('#fecha_moral').value != '' &&
                            document.querySelector('#hora_moral').value != '' &&
                            document.querySelector('input[name="responsable_moral"]:checked') &&
                            document.querySelector('#descripcion_breve_moral').value != ''
                        ) {
                            return true;
                        } else {
                            return false;
                        }
                        break;

                    case 'datos_imputado':
                        if (true) {
                            return true
                        } else {
                            return false;
                        }
                        break;
                    default:
                        return true;
                        break;
                }
                return true;
            }

            //Funcion para validar los elementos requeridos de cada step
            function validarStep(step) {
                switch (step) {
                    case 'datos_ofendido':
                        if (
                            document.querySelector('#nombre_ofendido').value != ''
                        ) {
                            return true
                        } else {
                            return false
                        }
                        break;
                    case 'datos_desaparecido':
                        if (
                            document.querySelector('#nombre_des').value != '' &&
                            document.querySelector('#apellido_paterno_des').value != '' &&
                            document.querySelector('#edad_des').value != '' &&
                            document.querySelector('input[name="sexo_des"]:checked') &&
                            document.querySelector('#nacionalidad_des').value != '' &&
                            document.querySelector('#estado_origen_des').value != '' &&
                            document.querySelector('#municipio_origen_des').value != ''
                        ) {
                            return true
                        } else {
                            return false
                        }
                        break;
                    case 'datos_delito':
                        let date1 = new Date(document.querySelector('#fecha').value);
                        let date2 = new Date("<?= date("Y-m-d") ?>");
                        if (date1 > date2) {
                            document.querySelector('#fecha').value = '';
                        }
                        if (
                            document.querySelector('#delito').value != '' &&
                            document.querySelector('#lugar').value != '' &&
                            document.querySelector('#fecha').value != '' &&
                            document.querySelector('#hora').value != '' &&
                            document.querySelector('input[name="responsable"]:checked') &&
                            document.querySelector('#descripcion_breve').value != ''
                        ) {
                            return true;
                        } else {
                            return false;
                        }
                        break;
                    case 'datos_robo_vehiculo':
                        if (true) {
                            return true;
                        } else {
                            return false;
                        }
                        break;
                    case 'datos_imputado':
                        if (true) {
                            return true
                        } else {
                            return false;
                        }
                        break;
                    default:
                        return true;
                        break;
                }
                return true;
            }

            /**Funcion para quitar requeridos de persona moral */
            function quitarRequired() {
                const requiredFields = Array.prototype.slice.call(forms)
                    .reduce((fields, form) => {
                        const formFields = form.querySelectorAll('[required]');
                        for (let i = 0; i < formFields.length; i++) {
                            if (!formFields[i].classList.contains('step')) {
                                fields.push(formFields[i]);
                            }
                        }
                        return fields;
                    }, []);

                requiredFields.forEach(field => {
                    field.removeAttribute('required');
                });
            }

            //Funcion para agregar direcciones
            function agregarDireccionNotificion() {
                const data = {
                    'personamoralid': empresaid,
                    'estado_empresa_extra': document.querySelector('#estado_empresa_extra').value,
                    'municipio_empresa_extra': document.querySelector('#municipio_empresa_extra').value,
                    'localidad_empresa_extra': document.querySelector('#localidad_empresa_extra').value,
                    'colonia_select_empresa_extra': document.querySelector('#colonia_select_empresa_extra').value,
                    'colonia_input_empresa_extra': document.querySelector('#colonia_input_empresa_extra').value,
                    'calle_empresa_extra': document.querySelector('#calle_empresa_extra').value,
                    'n_empresa_extra': document.querySelector('#n_empresa_extra').value,
                    'ninterior_empresa_extra': document.querySelector('#ninterior_empresa_extra').value,
                    'referencia_empresa_extra': document.querySelector('#referencia_empresa_extra').value,
                    'telefono_empresa_extra': document.querySelector('#telefono_empresa_extra').value,
                    'correo_empresa_extra': document.querySelector('#correo_empresa_extra').value
                };
                // console.log(data);
                $.ajax({
                    data: data,
                    url: "<?= base_url('/data/create-direccion-notificacion') ?>",
                    method: "POST",
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 1) {
                            document.getElementById("form_agregar_direccion").reset();
                            clearSelect(direccion)
                            let direcciones = response.notificaciones;
                            direcciones.forEach(direccion => {
                                let option = document.createElement("option");
                                option.text = direccion.CALLE + ',' + direccion.COLONIADESCR;
                                option.value = direccion.NOTIFICACIONID;
                                document.querySelector('#direccion').add(option);
                            });
                            Swal.fire({
                                icon: 'success',
                                text: 'Dirección de notificación ingresado correctamente',
                                confirmButtonColor: '#bf9b55',
                            });
                            $('#agregarDireccionModal').modal('hide');

                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: 'No se agregó la información del parentesco',
                                confirmButtonColor: '#bf9b55',
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus);
                    }
                });
            }

        })();
</script>
<?= $this->endSection() ?>