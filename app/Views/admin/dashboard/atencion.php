<?= $this->extend('admin/templates/admin_template') ?>
<?= $this->section('content') ?>

<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-9">
            <div class="card rounded bg-white shadow">
                <div class="card-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://smartbc.assertivebusiness.com.mx/videollamada?name=Agente"></iframe>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3">

            <div class="card rounded bg-white shadow">
                <div class="card-body p-1">
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" id="input_folio_atencion" placeholder="Folio de atención...">
                        </div>
                    </div>
                    <button class="btn btn-secondary float-right" role="button">Buscar</button>
                </div>
            </div>

            <div class="card rounded bg-white shadow">
                <div class="card-body p-1">
                    <label for="notas">Notas:</label>
                    <textarea class="form-control" id="notas" placeholder="Notas del caso..." rows="10" required></textarea>
                </div>
            </div>

            <div class="card rounded bg-white shadow">
                <div class="card-body p-1">
                    <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" href="#data_ciudadano" role="button" aria-expanded="false" aria-controls="data_ciudadano">Datos del ciudadano</button>
                    <div class="collapse" id="data_ciudadano">
                        <p>Otoniel Flores</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection() ?>