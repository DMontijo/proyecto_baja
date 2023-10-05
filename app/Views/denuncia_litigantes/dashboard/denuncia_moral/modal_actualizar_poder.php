<div class="modal fade" id="actualizarPoderModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="agregarDireccionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-xl">
        <div class="modal-content border-0">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white fw-bold" id="podernLabel">Añadir poder
                </h5>
                <button id="poder_close_btn" type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">

                <form id="form_actualizar_poder" action="" method="post" class="row" novalidate>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="poder_volumen_new" class="form-label fw-bold">Poder volumen:</label>
                        <input type="text" class="form-control" id="poder_volumen_new" name="poder_volumen_new">
                        <div class="invalid-feedback">
                            Por favor, ingresa el volumen.
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="poder_notario_new" class="form-label fw-bold">Número notario:</label>
                        <input type="text" class="form-control" id="poder_notario_new" name="poder_notario_new">
                        <div class="invalid-feedback">
                            Por favor, ingresa el número notario.
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="poder_no_poder_new" class="form-label fw-bold">Número de poder:</label>
                        <input type="text" class="form-control" id="poder_no_poder_new" name="poder_no_poder_new">
                        <div class="invalid-feedback">
                            Por favor, ingresa el número poder.
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label class="form-label fw-bold" for="fecha_inicio_poder_new">Fecha de expedición de poder</label>
                        <input type="date" name="fecha_inicio_poder_new" class="form-control" id="fecha_inicio_poder_new">
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label class="form-label fw-bold" for="fecha_fin_poder_new">Fecha de vigencia del poder</label>
                        <input type="date" name="fecha_fin_poder_new" class="form-control" id="fecha_fin_poder_new">
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="poder_archivo_new" class="form-label fw-bold input-required">Archivo del poder notarial:</label>
                        <input type="file" class="form-control" id="poder_archivo_new" name="poder_archivo_new" required>
                        <img id="poder_foto" class="img-fluid" src="" style="max-width:300px;">
                    </div>

                    <div class="col-12">
                        <hr>
                    </div>

                    <div class="col-12 text-center">
                        <button id="form_actualizar_poder_btn" type="submit" class="btn btn-secondary">
                            <div id="spinner" class="spinner-border text-primary d-none" role="status"></div>
                            <span id="text">Añadir</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>