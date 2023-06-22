<div class="modal fade" id="ligarEmpresaModal" tabindex="-1" aria-labelledby="ligarEmpresaModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-xl">
        <div class="modal-content border-0">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white fw-bold" id="ligarEmpresaModalLabel">Ligar a una empresa</h5>
                <button id="placas_close_btn" type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <form id="form_ligar_empresa" action="<?= base_url() ?>/denuncia_litigantes/dashboard/ligar_empresa" method="post" class="row needs-validation" enctype="multipart/form-data" novalidate>

                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="empresa" class="form-label fw-bold input-required">Empresa:</label>
                        <select class="form-select" id="empresa" name="empresa" required>
                            <option selected disabled value="">Elige una empresa</option>
                            <?php foreach ($body_data->empresas as $index => $empresa) { ?>
                                <option value="<?= $empresa->PERSONAMORALID  ?>"> <?= $empresa->MARCACOMERCIAL ?> </option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, selecciona un municipio.
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="poder_volumen" class="form-label fw-bold input-required">Poder volumen:</label>
                        <input class="form-control" id="poder_volumen" name="poder_volumen" required>
                        <div class="invalid-feedback">
                            Por favor, ingresa el volumen.
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="poder_notario" class="form-label fw-bold input-required">Número notario:</label>
                        <input class="form-control" id="poder_notario" name="poder_notario" required>
                        <div class="invalid-feedback">
                            Por favor, ingresa el número notario.
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="poder_no_poder" class="form-label fw-bold input-required">Número de poder:</label>
                        <input class="form-control" id="poder_no_poder" name="poder_no_poder" required>
                        <div class="invalid-feedback">
                            Por favor, ingresa el número poder.
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="poder_archivo" class="form-label fw-bold input-required">Fotografía poder:</label>
                        <input type="file" class="form-control" id="poder_archivo" name="poder_archivo" required>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12 text-center">
                        <button id="form_ligar_empresa_btn" type="submit" class="btn btn-secondary">
                            <div id="spinner" class="spinner-border text-primary d-none" role="status"></div>
                            <span id="text">Ligar</span>
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