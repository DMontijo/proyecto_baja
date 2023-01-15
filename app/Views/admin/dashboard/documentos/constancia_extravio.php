<?= $this->extend('admin/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" id="firmarConstancia"
                    data-target="#contrasena_modal"><i class="fas fa-file-signature"></i> Firmar constancia</button>
                <div class="card shadow border-0">
                    <div class="card-body" name="certificado" id="certificado" style="margin: 2%;">
                        <p style="font-size:11pts;font-family:Arial;">
                            <?php echo $body_data->constanciaExtravio->PLACEHOLDER ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if (session()->getFlashdata('message_error')) : ?>
<script>
Swal.fire({
    icon: 'error',
    html: '<strong><?= session()->getFlashdata('message') ?></strong>',
    confirmButtonColor: '#bf9b55',
})
</script>
<?php endif; ?>
<?php if (session()->getFlashdata('message_success')) : ?>
<script>
Swal.fire({
    icon: 'success',
    html: '<strong><?= session()->getFlashdata('message_success') ?></strong>',
    confirmButtonColor: '#bf9b55',
})
</script>
<?php endif; ?>
<?php if (session()->getFlashdata('message_warning')) : ?>
<script>
Swal.fire({
    icon: 'warning',
    html: '<strong><?= session()->getFlashdata('message_warning') ?></strong>',
    confirmButtonColor: '#bf9b55',
})
</script>
<?php endif; ?>
<?php include('modal_validation_password.php') ?>

<?= $this->endSection() ?>