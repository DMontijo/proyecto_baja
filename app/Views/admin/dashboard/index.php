<?= $this->extend('admin/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?php $rolesToMonitor = [1, 2, 6, 7, 11]; ?>

<?= $this->section('content') ?>
<div class="row">
	<?php if (in_array(session('ROLID'), $rolesToMonitor)) { ?>
		<div class="col-4">
			<div class="card shadow" style="border-radius:10px;">
				<div class="card-body text-center">
					<h5 class="card-title">USUARIOS ACTIVOS</h5>
					<h4 class="font-weight-bold" id="card_active_users">0</h4>
					<a type="button" href="<?= base_url('admin/dashboard/usuarios_activos') ?>" class="btn btn-primary font-weight-bold mt-4 text-white">VER MÁS</a>
				</div>
			</div>
		</div>
	<?php }; ?>
	<div class="col-4">
		<div class="card shadow" style="border-radius:10px;">
			<div class="card-body text-center">
				<h5 class="card-title">FOLIOS GENERADOS</h5>
				<h4 class="font-weight-bold"><?= $body_data->cantidad_folios ?></h4>
				<a type="button" href="<?= base_url('admin/dashboard/folios') ?>" class="btn btn-primary font-weight-bold mt-4 text-white">VER MÁS</a>
			</div>
		</div>
	</div>
	<div class="col-4">
		<div class="card shadow" style="border-radius:10px;">
			<div class="card-body text-center">
				<h5 class="card-title">EXPEDIENTES GENERADOS</h5>
				<h4 class="font-weight-bold"><?= $body_data->cantidad_expedientes ?></h4>
				<a type="button" href="<?= base_url('admin/dashboard/folios_expediente') ?>" class="btn btn-primary font-weight-bold mt-4 text-white">VER MÁS</a>
			</div>
		</div>
	</div>
	<div class="col-4">
		<div class="card shadow" style="border-radius:10px;">
			<div class="card-body text-center">
				<h5 class="card-title">DERIVACIONES GENERADAS</h5>
				<h4 class="font-weight-bold"><?= $body_data->cantidad_derivados ?></h4>
				<a type="button" href="<?= base_url('admin/dashboard/folios_derivados') ?>" class="btn btn-primary font-weight-bold mt-4 text-white">VER MÁS</a>
			</div>
		</div>
	</div>
	<div class="col-4">
		<div class="card shadow" style="border-radius:10px;">
			<div class="card-body text-center">
				<h5 class="card-title">CANALIZACIONES GENERADAS</h5>
				<h4 class="font-weight-bold"><?= $body_data->cantidad_canalizados ?></h4>
				<a type="button" href="<?= base_url('admin/dashboard/folios_canalizados') ?>" class="btn btn-primary font-weight-bold mt-4 text-white">VER MÁS</a>
			</div>
		</div>
	</div>
</div>
<script>
	window.onload = function() {
		getUsuarios();
		setInterval(() => {
			getUsuarios();
		}, 10000);

	}
	const getUsuarios = () => {
		$.ajax({
			data: {
				'u': 24,
				'token': '198429b7cc8a2a5733d97bc13153227dd5017555',
				'a': 'status'
			},
			url: "<?= base_url('/data/get-active-users') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				document.querySelector('#card_active_users').innerHTML = response.count;
			},
			error: function(jqXHR, textStatus, errorThrown) {
				document.querySelector('#card_active_users').innerHTML = 0;
			}
		});
	}
</script>
<?php if (session()->getFlashdata('acceso_denegado')) : ?>
	<script>
		Swal.fire({
			icon: 'error',
			html: '<strong><?= session()->getFlashdata('acceso_denegado') ?></strong>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<?= $this->endSection() ?>
