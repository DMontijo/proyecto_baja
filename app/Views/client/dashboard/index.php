<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card rounded bg-yellow shadow text-center mb-4">
                <div class="card-body">
                    <h1 class="fw-bolder text-blue">Espera</h1>
                    <div class="row">
                        <div class="col-12 col-md-6 offset-md-3">
                            <p class="fw-bolder">
                                Recuerda que para atender los delitos de "Lorem ipsum dolor sit", "Lorem ipsum dolor sit", "Lorem ipsum dolor sit", "Lorem ipsum dolor sit", "Lorem ipsum dolor sit", es necesario comunicarte al 00000000000;
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card rounded shadow">
                <div class="card-body p-0 py-3 p-sm-5">
                    <div class="container">
                        <h1 class="text-center fw-bolder pb-1 text-blue">DENUNCIA</h1>
                        <p class="text-center fw-bold text-blue ">Llena los campos siguientes para continuar tu denuncia</p>
                        <p class="text-center pb-5">Los campos con un <span class="asterisco-rojo">*</span> son obligatorios</p>
                        <form action="<?= base_url() ?>/denuncia/dashboard/video-denuncia" class="row needs-validation" novalidate>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <label for="municipio" class="form-label fw-bold input-required">Municipio:</label>
                                <select class="form-select" id="municipio" name="municipio" required>
                                    <option selected disabled value="">Elige el municipio</option>
                                    <option value="1">Ensenada</option>
                                    <option value="2">Mexicali</option>
                                    <option value="3">Tijuana</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor, selecciona un municipio.
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <label for="localidad" class="form-label fw-bold input-required">Localidad del delito:</label>
                                <select class="form-select" id="localidad" name="localidad" required>
                                    <option selected disabled value="">Elige la localidad</option>
                                    <option value="1">Ciudad morelos</option>
                                    <option value="2">Hechicera</option>
                                    <option value="3">Mexicali</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor, selecciona una localidad.
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <label for="colonia-text" class="form-label fw-bold input-required">Colonia del delito:</label>
                                <select class="form-select" id="colonia" name="colonia" required>
                                    <option selected disabled value="">Elige la colonia</option>
                                    <option value="1">Ciudad morelos</option>
                                    <option value="2">Hechicera</option>
                                    <option value="3">Mexicali</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor, selecciona una colonia.
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <label for="calle" class="form-label fw-bold input-required">Calle o avenida del delito:</label>
                                <input type="text" class="form-control" id="calle" name="calle" required>
                                <div class="invalid-feedback">
                                    Por favor, anexa una calle o avenida.
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <label for="exterior" class="form-label fw-bold input-required">No. exterior del delito:</label>
                                <input type="text" class="form-control" id="exterior" name="exterior" required>
                                <div class="invalid-feedback">
                                    Por favor, anexa un numero exterior del delito.
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <label for="lugar" class="form-label fw-bold input-required">Lugar del delito:</label>
                                <select class="form-select" id="lugar" name="lugar" required>
                                    <option selected disabled value="">Elige el lugar del delito</option>
                                    <option value="1">Instituciones privadas</option>
                                    <option value="2">Centro escolar</option>
                                    <option value="3">Centro recreativo</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor, selecciona un lugar.
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <label for="fecha" class="form-label fw-bold input-required">Fecha y hora del delito:</label>
                                <input type="datetime-local" class="form-control" id="fecha" name="fecha" required>
                                <div class="invalid-feedback">
                                    Por favor, anexa una fecha y hora.
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <label for="delito-text" class="form-label fw-bold input-required">Delito:</label>
                                <select class="form-select" id="delito" name="delito" required>
                                    <option selected disabled value="">Elige la categoria</option>
                                    <option value="1">Frude</option>
                                    <option value="2">Robo</option>
                                    <option value="3">Extravío</option>
                                </select>
                                <div class="invalid-feedback">
                                    Selecciona el delito
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <label for="objetoImplicado-text" class="form-label fw-bold input-required">Describa el objeto implicado:</label>
                                <textarea class="form-control" id="objetoImplicado" name="objetoImplicado" required></textarea>
                                <div class="invalid-feedback">
                                    Por favor, describe el objeto implicado.
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <label for="description-text" class="form-label fw-bold input-required">Descripcion:</label>
                                <textarea class="form-control" id="description" name="description" maxlength="150" required></textarea>
                                <div class="invalid-feedback">
                                    Por favor, anexa una breve descripcion del delito
                                </div>
                                <div id="mensaje_ayuda" class="form-text">150 carácteres restantes</div>
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn btn-primary mt-5" type="submit"><i class="bi bi-camera-video-fill"></i> Iniciar denuncia</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    (function() {
        'use strict'

        var forms = document.querySelectorAll('.needs-validation')

        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
    
    $('#description').keyup(function() {
        let ch = 150 - $(this).val().length;
        $('#mensaje_ayuda').text(ch + ' carácteres restantes');
    });
</script>