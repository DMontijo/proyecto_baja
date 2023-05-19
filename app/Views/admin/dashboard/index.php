<?= $this->extend('admin/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?php $rolesToMonitor = [1, 2, 6, 7, 11]; ?>
<?php
helper('fiel_helper');
$session = session();
$user_id = session('ID');
$directory = FCPATH . 'uploads/FIEL/' . $user_id;
$file_key = $user_id . '_key.key';
$file_cer = $user_id . '_cer.cer';
$file_text = $user_id . "_data.txt";
?>
<?= $this->section('content') ?>
<div class="row">
	<div class="col-12">
		<?php if (file_exists($directory . '/' . $file_key) && file_exists($directory . '/' . $file_cer)) { ?>
			<?php if (file_exists($directory . '/' . $file_text)) { ?>
				<?php $validacion = (object)validarFiel($user_id);
				if ($validacion->valida) { ?>
					<?php if ($validacion->restante >= 60) { ?>
						<div class="alert alert-success text-right font-weight-bold" role="alert">
							FIEL CARGADA CORRECTAMENTE - VIGENCIA: <?= $validacion->fechafinal ?><br>
							DÍAS RESTANTES: <?= $validacion->restante ?>
						</div>
					<?php } else { ?>
						<div class="alert alert-warning text-right font-weight-bold" role="alert">
							FIEL CARGADA CORRECTAMENTE - VIGENCIA: <?= $validacion->fechafinal ?><br>
							DÍAS RESTANTES: <?= $validacion->restante ?>
						</div>
					<?php } ?>
				<?php } else { ?>
					<div class="alert alert-danger text-right font-weight-bold" role="alert">
						FIEL INVÁLIDA
					</div>
				<?php } ?>
			<?php } else { ?>
				<div class="alert alert-success text-right font-weight-bold" role="alert">
					FIEL CARGADA CORRECTAMENTE - VIGENCIA: NO SE PUEDE VALIDAR
				</div>
			<?php } ?>
		<?php } else { ?>
			<div class="alert alert-warning text-right font-weight-bold" role="alert">
				NO TIENES UNA FIEL CARGADA
			</div>
		<?php } ?>
	</div>
	<?php if (in_array(session('ROLID'), $rolesToMonitor)) { ?>
		<div class="col-12 col-md-4 mb-4">
			<div class="card shadow" style="border-radius:5px; height:100%!important;">
				<div class="card-body text-center">
					<h5 class="card-title">AGENTES ACTIVOS PARA VIDEODENUNCIA</h5>
					<h4 class="font-weight-bold" id="card_active_users">-</h4>
					<a type="button" href="<?= base_url('admin/dashboard/usuarios_activos') ?>" class="btn btn-primary font-weight-bold mt-4 text-white">VER MÁS</a>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-4 mb-4">
			<div class="card shadow" style="border-radius:5px; height:100%!important;">
				<div class="card-body text-center">
					<h5 class="card-title">AGENTES EN LLAMADA</h5>
					<h4 class="font-weight-bold" id="card_en_llamada">-</h4>
					<a type="button" href="<?= base_url('admin/dashboard/usuarios_en_llamada') ?>" class="btn btn-primary font-weight-bold mt-4 text-white">VER MÁS</a>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-4 mb-4">
			<div class="card shadow" style="border-radius:5px; height:100%!important;">
				<div class="card-body text-center">
					<h5 class="card-title">LLAMADAS EN FILA</h5>
					<h4 class="font-weight-bold" id="lista_prioridad_users">-</h4>
					<a type="button" href="<?= base_url('admin/dashboard/lista_prioridad') ?>" class="btn btn-primary font-weight-bold mt-4 text-white">VER MÁS</a>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-4 mb-4">
			<div class="card shadow" style="border-radius:5px; height:100%!important;">
				<div class="card-body text-center">
					<h5 class="card-title">USUARIOS DENTRO DE LA PLATAFORMA</h5>
					<h4 class="font-weight-bold"><?= $body_data->sesiones_admin ?></h4>
					<a type="button" href="<?= base_url('admin/dashboard/sesiones_activas') ?>" class="btn btn-primary font-weight-bold mt-4 text-white">VER MÁS</a>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-4 mb-4">
			<div class="card shadow" style="border-radius:5px; height:100%!important;">
				<div class="card-body text-center">
					<h5 class="card-title">DENUNCIANTES DENTRO DE LA PLATAFORMA</h5>
					<h4 class="font-weight-bold"><?= $body_data->sesiones_denunciantes ?></h4>
					<a type="button" href="<?= base_url('admin/dashboard/sesiones_activas') ?>" class="btn btn-primary font-weight-bold mt-4 text-white">VER MÁS</a>
				</div>
			</div>
		</div>
		<div class="col-12 mb-3">
			<hr>
		</div>
		<div class="col-12 col-md-4 mb-4">
			<div class="card shadow" style="border-radius:5px; height:100%!important;">
				<div class="card-body text-center">
					<h5 class="card-title">FOLIOS ABIERTOS</h5>
					<h4 class="font-weight-bold"><?= $body_data->cantidad_abiertos ?></h4>
					<a type="button" href="<?= base_url('admin/dashboard/folios_abiertos') ?>" class="btn btn-primary font-weight-bold mt-4 text-white">VER MÁS</a>
				</div>
			</div>
		</div>
	<?php }; ?>
	<div class="col-12 col-md-4 mb-4">
		<div class="card shadow" style="border-radius:5px; height:100%!important;">
			<div class="card-body text-center">
				<h5 class="card-title">EXPEDIENTES GENERADOS <br>HOY</h5>
				<h4 class="font-weight-bold"><?= $body_data->cantidad_expedientes ?></h4>
				<a type="button" href="<?= base_url('admin/dashboard/folios_expediente') ?>" class="btn btn-primary font-weight-bold mt-4 text-white">VER MÁS</a>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-4 mb-4">
		<div class="card shadow" style="border-radius:5px; height:100%!important;">
			<div class="card-body text-center">
				<h5 class="card-title">DERIVACIONES GENERADAS <br>HOY</h5>
				<h4 class="font-weight-bold"><?= $body_data->cantidad_derivados ?></h4>
				<a type="button" href="<?= base_url('admin/dashboard/folios_derivados') ?>" class="btn btn-primary font-weight-bold mt-4 text-white">VER MÁS</a>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-4 mb-4">
		<div class="card shadow" style="border-radius:5px; height:100%!important;">
			<div class="card-body text-center">
				<h5 class="card-title">CANALIZACIONES GENERADAS <br>HOY</h5>
				<h4 class="font-weight-bold"><?= $body_data->cantidad_canalizados ?></h4>
				<a type="button" href="<?= base_url('admin/dashboard/folios_canalizados') ?>" class="btn btn-primary font-weight-bold mt-4 text-white">VER MÁS</a>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-4 mb-4">
		<div class="card shadow" style="border-radius:5px; height:100%!important;">
			<div class="card-body text-center">
				<h5 class="card-title">DOCUMENTOS ASIGNADOS <br>PARA FIRMAR</h5>
				<h4 class="font-weight-bold"><?= $body_data->cantidad_documentos ?></h4>
				<a type="button" href="<?= base_url('admin/dashboard/documentos') ?>" class="btn btn-primary font-weight-bold mt-4 text-white">VER MÁS</a>
			</div>
		</div>
	</div>
	<div class="col-12 mb-3">
		<hr>
	</div>
	<div class="col-12 col-md-4 mb-4">
		<div class="card shadow" style="border-radius:5px; height:100%!important;">
			<div class="card-body text-center">
				<h5 class="card-title">OFICINAS DE EXPEDIENTES</h5>
				<a type="button" href="<?= base_url('admin/dashboard/folios_abiertos') ?>" class="btn btn-primary font-weight-bold mt-4 text-white">ACTUALIZAR</a>
			</div>
		</div>
	</div>
</div>
<script src="https://cdn.socket.io/4.6.0/socket.io.min.js" integrity="sha384-c79GN5VsunZvi+Q/WObgk2in0CbZsHnjEqvFxC5DxHn9lTfNce2WW6h2pH6u/kF+" crossorigin="anonymous"></script>

<script src="<?= base_url() ?>/assets/js/index_activos.js" type="module"></script>
<?php if (in_array(session('ROLID'), $rolesToMonitor)) { ?>
	<!-- <script>
		window.onload = function() {
			setInterval(() => {
			}, 50000);
		}
	</script> -->
<?php }; ?>
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