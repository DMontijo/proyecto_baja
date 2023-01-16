<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4 text-center font-weight-bold">CONSTANCIAS DE EXTRAVÍO</h1>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow border-0 text-center">
                    <div class="card-body p-2" style="height:200px;">
                        <a href="<?= base_url('admin/dashboard/constancias_extravio_abiertas') ?>"
                            class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-file-alt"></i> Abiertas<br><br> <span class="font-weight-bold"
                                style="font-size:20px;"><?= $body_data->abiertas ?></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow border-0 text-center">
                    <div class="card-body p-2" style="height:200px;">
                        <a href="<?= base_url('admin/dashboard/constancias_extravio_firmadas') ?>"
                            class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-box-open"></i> Firmadas <br><br> <span class="font-weight-bold"
                                style="font-size:20px;"><?= $body_data->firmadas ?></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow border-0 text-center">
                    <div class="card-body p-2" style="height:200px;">
                        <a href="<?= base_url('admin/dashboard/constancias_extravio_proceso') ?>"
                            class="btn btn-primary btn-block h-100 d-flex flex-column justify-content-center align-items-center d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-box-open"></i> En proceso <br><br> <span class="font-weight-bold"
                                style="font-size:20px;"><?= $body_data->proceso ?></span>
                        </a>
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
<script>
window.onload = function() {
    setInterval(() => {
        location.reload();
    }, 120000);
}
</script>
<?= $this->endSection() ?>