<?= $this->extend('admin/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?php $rolesToMonitor = [1, 2, 6, 7, 11]; ?>
<?php $rolesToAdmin = [1]; ?>

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
	<?php if (in_array(session('ROLID'), $rolesToMonitor)) { ?>
		<div class="col-12 text-right pb-3">
			<button type="button" id="btnActualizarExpedientes" name="btnActualizarExpedientes" class="btn btn-primary font-weight-bold text-white" data-toggle="tooltip" data-placement="top" title="Botón para sincronizar las coordinaciones de los expedientes con Justicia Net.">
				<i class="fas fa-sync-alt"></i> SINCRONIZAR EXPEDIENTES
			</button>
		</div>
	<?php } ?>
	<?php if (in_array(session('ROLID'), $rolesToAdmin)) { ?>

		<div class="col-12 text-right pb-3">
			<button type="button" id="btnSubirPericiales" name="btnSubirPericiales" class="btn btn-primary font-weight-bold text-white" data-toggle="tooltip" data-placement="top" title="Botón para sincronizar las coordinaciones de los expedientes con Justicia Net.">
				<i class="fas fa-sync-alt"></i> SUBIR PERICIALES
			</button>
		</div>
	<?php } ?>

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
</div>
<script src="https://cdn.socket.io/4.6.0/socket.io.min.js?v=<?= rand() ?>" integrity="sha384-c79GN5VsunZvi+Q/WObgk2in0CbZsHnjEqvFxC5DxHn9lTfNce2WW6h2pH6u/kF+" crossorigin="anonymous"></script>

<script src="<?= base_url() ?>/assets/js/index_activos.js?v=<?= rand() ?>" type="module"></script>

<script>
	$(function() {
		$('[data-toggle="tooltip"]').tooltip()
	});
	var btnActualizarExpedientes = document.querySelector('#btnActualizarExpedientes');

	//Evento para actualizar las oficinas de los expedientes cuando se actualizan en Justicia. Sirve para sincronizarlo con VIdeodenuncia
	btnActualizarExpedientes.addEventListener('click', (e) => {

		$.ajax({
			url: "<?= base_url('/data/update-oficinas-by-justicia') ?>",
			timeout: 7200000,
			method: "GET",
			dataType: "json",
			beforeSend: function() {
				btnActualizarExpedientes.disabled = true;;
				Swal.fire({
					icon: 'info',
					title: 'Sincronizando expedientes con Justicia Net.',
					showConfirmButton: false,
					timer: 2000,
					timerProgressBar: true,
				});
			},
			success: function(response) {
				btnActualizarExpedientes.disabled = false;
				console.log('Respuesta actualización expedientes:', response)

				if (response.status == 1) {
					Swal.fire({
						icon: 'success',
						title: 'Sincronizado exitosamente.',
						text: response.message,
						showConfirmButton: false,
						timer: 5000,
						timerProgressBar: true,
					});
				} else {
					Swal.fire({
						icon: 'error',
						title: 'Error en sincronización',
						text: response.message,
						showConfirmButton: false,
						timer: 2000,
						timerProgressBar: true,
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				btnActualizarExpedientes.disabled = false;
				Swal.fire({
					icon: 'error',
					title: 'Error en sincronización',
					text: 'No fue posible sincronizar los expedientes con Justicia Net.',
					showConfirmButton: false,
					timer: 2000,
					timerProgressBar: true,
				});
				console.error('Error de boton de sincronización:', errorThrown);
				btnActualizarExpedientes.click();
			}
		});
	}, false);

	var btnSubirPericiales = document.querySelector('#btnSubirPericiales');

	//Evento para actualizar las oficinas de los expedientes cuando se actualizan en Justicia. Sirve para sincronizarlo con VIdeodenuncia
	btnSubirPericiales.addEventListener('click', (e) => {

		$.ajax({
			url: "<?= base_url('/data/subir-periciales') ?>",
			method: "GET",
			dataType: "json",
			beforeSend: function() {
				btnSubirPericiales.disabled = true;;
				Swal.fire({
					icon: 'info',
					title: 'Sincronizando expedientes con Justicia Net.',
					showConfirmButton: false,
					timer: 2000,
					timerProgressBar: true,
				});
			},
			success: function(response) {
				btnSubirPericiales.disabled = false;
				console.log('Respuesta actualización expedientes:', response)

				if (response.status == 1) {
					Swal.fire({
						icon: 'success',
						title: 'Sincronizado exitosamente.',
						text: response.message,
						showConfirmButton: false,
						timer: 5000,
						timerProgressBar: true,
					});
				} else {
					Swal.fire({
						icon: 'error',
						title: 'Error en sincronización',
						text: response.message,
						showConfirmButton: false,
						timer: 2000,
						timerProgressBar: true,
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				btnSubirPericiales.disabled = false;
				Swal.fire({
					icon: 'error',
					title: 'Error en sincronización',
					text: 'No fue posible sincronizar los expedientes con Justicia Net.',
					showConfirmButton: false,
					timer: 2000,
					timerProgressBar: true,
				});
				console.error('Error de boton de sincronización:', textStatus);
			}
		});
	}, false);
</script>
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