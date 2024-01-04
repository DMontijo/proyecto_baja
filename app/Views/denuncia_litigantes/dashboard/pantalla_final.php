<?= $this->extend('denuncia_litigantes/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="col-12 p-0 m-0" id="pantalla_final">
            <div class="card text-center">
                <div class="card-body p-0 m-0 p-5 d-flex justify-content-center align-items-center">
                    <div class="text-center" style="max-width:500px;">
                        <img src="<?= base_url() ?>/assets/img/FGEBC.png" alt="Loader FGEBC" class="mb-3" style="width:250px;">
                        <p class="fw-bold">Su denuncia por escrito se ha recepcionado con éxito.</p>
                        <p> En un término no mayor a 48 horas le será notificado, por el medio electrónico autorizado, su número de expediente asignado.</p>
						<div class="col-12 mt-5 text-center">
                            <a href="<?= base_url('/denuncia_litigantes/dashboard') ?>" type="button" name="" id="" class="btn btn-primary"><i class="bi bi-file-font"></i> INICIAR NUEVA DENUNCIA</a>
                            <a href="<?= base_url('/denuncia/logout') ?>" type="button" name="" id="" class="btn btn-secondary"><i class="bi bi-box-arrow-left"></i> CERRAR SESIÓN</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (session()->getFlashdata('message_success')) : ?>
	<script>
		Swal.fire({
			icon: 'success',
			html: '<strong><?= session()->getFlashdata('message_success') ?></strong>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<?php if (session()->getFlashdata('message_error')) : ?>
	<script>
		Swal.fire({
			icon: 'error',
			html: '<strong><?= session()->getFlashdata('message') ?></strong>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<?= $this->endSection() ?>