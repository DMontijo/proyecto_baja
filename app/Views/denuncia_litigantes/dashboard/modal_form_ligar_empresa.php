<div class="modal fade" id="ligarEmpresaModal" tabindex="-1" aria-labelledby="ligarEmpresaModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-xl">
        <div class="modal-content border-0">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white fw-bold" id="ligarEmpresaModalLabel">Ligar a una persona moral</h5>
                <button id="placas_close_btn" type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <form id="form_ligar_empresa" action="<?= base_url() ?>/denuncia_litigantes/dashboard/ligar_empresa" method="post" class="row needs-validation" enctype="multipart/form-data" novalidate>

                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="empresa" class="form-label fw-bold input-required">Persona moral:</label>
                        <select class="form-select" id="empresa" name="empresa" required>
                            <option selected disabled value="">Elige una persona moral</option>
                            <?php foreach ($body_data->empresas as $index => $empresa) { ?>
                                <option value="<?= $empresa->PERSONAMORALID  ?>"> <?= $empresa->RAZONSOCIAL ?> </option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, selecciona un municipio.
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="poder_volumen" class="form-label fw-bold">Poder volumen:</label>
                        <input class="form-control" id="poder_volumen" name="poder_volumen">
                        <div class="invalid-feedback">
                            Por favor, ingresa el volumen.
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="poder_notario" class="form-label fw-bold">Número notario:</label>
                        <input class="form-control" id="poder_notario" name="poder_notario">
                        <div class="invalid-feedback">
                            Por favor, ingresa el número notario.
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="poder_no_poder" class="form-label fw-bold">Número de poder:</label>
                        <input class="form-control" id="poder_no_poder" name="poder_no_poder">
                        <div class="invalid-feedback">
                            Por favor, ingresa el número poder.
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label class="form-label fw-bold" for="fecha_inicio_poder">Fecha inicio de poder</label>
                        <input type="date" name="fecha_inicio_poder" class="form-control" id="fecha_inicio_poder">
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label class="form-label fw-bold" for="fecha_fin_poder">Fecha fin de poder</label>
                        <input type="date" name="fecha_fin_poder" class="form-control" id="fecha_fin_poder">
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="poder_archivo" class="form-label fw-bold input-required">Fotografía poder:</label>
                        <input type="file" class="form-control" id="poder_archivo" name="poder_archivo" required>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="cargo" class="form-label fw-bold input-required">¿Cúal es tu cargo en la persona moral?</label>
                        <select class="form-select" id="cargo" name="cargo" required>
                            <option selected disabled value="">Selecciona su cargo en la persona moral</option>
                            <option value="APODERADO">APODERADO</option>
                            <option value="LITIGANTE">LITIGANTE</option>

                        </select>
                        <div class="invalid-feedback">
                            El tipo de identificación es obligatorio.
                        </div>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12 text-center">
                        <button id="form_ligar_empresa_btn" type="submit" class="btn btn-secondary">
                            <div id="spinner" class="spinner-border text-primary d-none" role="status"></div>
                            <span id="text">Ligarme a una persona moral</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const form_ligar_empresa = document.querySelector('#form_ligar_empresa');
    const form_ligar_empresa_btn = document.querySelector('#form_ligar_empresa_btn');
    const placas_close_btn = document.querySelector('#placas_close_btn');
    const spinner_placas = document.querySelector('#form_ligar_empresa_btn #spinner');
    const btn_text_placas = document.querySelector('#form_ligar_empresa_btn #text');

    form_ligar_empresa.addEventListener('submit', function(event) {
        if (!form_ligar_empresa.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            form_ligar_empresa_btn.disabled = false;
            placas_close_btn.classList.remove('d-none')
            spinner_placas.classList.add('d-none');
            btn_text_placas.classList.remove('d-none');
        } else {
            placas_close_btn.classList.add('d-none')
            form_ligar_empresa_btn.disabled = true;
            spinner_placas.classList.remove('d-none');
            btn_text_placas.classList.add('d-none');
        }
        form_ligar_empresa.classList.add('was-validated')
    }, false);
</script>