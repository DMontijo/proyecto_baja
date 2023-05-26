<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php $rolesToMonitor = [1, 11]; ?>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center mb-4">
				<h1 class="mb-4 text-center font-weight-bold">SESIONES ACTIVAS EN EL CDTEC</h1>
			</div>
			<div class="col-12">
				<div class="card shadow border-0" style="overflow-x:auto;">
					<div class="card-body">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="usuarios-tab" data-toggle="tab" href="#usuarios" role="tab" aria-controls="usuarios" aria-selected="true">Usuarios</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="denunciantes-tab" data-toggle="tab" href="#denunciantes" role="tab" aria-controls="denunciantes" aria-selected="false">Denunciantes</a>
							</li>
						</ul>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active mt-4" id="usuarios" role="tabpanel" aria-labelledby="usuarios-tab">
								<table id="table-usuarios" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th class="text-center">AGENTE</th>
											<th class="text-center">NAVEGADOR</th>
											<th class="text-center">SISTEMA OPERATIVO</th>
											<th class="text-center">FECHA INICIO SESIÓN</th>
											<?php if (in_array(session('ROLID'), $rolesToMonitor)) { ?>
												<th class="text-center"></th>
											<?php }; ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($body_data->sesionesAdmin->result as $index => $sesionesAdmin) { ?>
											<tr>
												<td class="text-center"><?= $sesionesAdmin->NOMBRE . ' ' . $sesionesAdmin->APELLIDO_PATERNO ?></td>
												<td class="text-center"><?= $sesionesAdmin->AGENTE_HTTP ?></td>
												<td class="text-center"><?= $sesionesAdmin->AGENTE_SO ?></td>
												<td class="text-center"><?= $sesionesAdmin->FECHAINICIO ?></td>
												<?php if (in_array(session('ROLID'), $rolesToMonitor)) { ?>
													<td class="text-center">
														<a href="<?= base_url('/admin/dashboard/cerrar_sesiones_general?id_usuario=') . $sesionesAdmin->ID_USUARIO ?>" class="btn btn-primary text-white"> CERRAR SESIÓN</a>
													</td>
												<?php }; ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="tab-pane fade mt-4" id="denunciantes" role="tabpanel" aria-labelledby="denunciantes-tab">
								<table id="table-denunciantes" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th class="text-center">DENUNCIANTE</th>
											<th class="text-center">NAVEGADOR</th>
											<th class="text-center">SISTEMA OPERATIVO</th>
											<th class="text-center">FECHA INICIO SESIÓN</th>
											<?php if (in_array(session('ROLID'), $rolesToMonitor)) { ?>
												<th class="text-center"></th>
											<?php }; ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($body_data->sesionesDenunciantes->result as $index => $sesionesDenunciantes) { ?>
											<tr>
												<td class="text-center"><?= $sesionesDenunciantes->NOMBRE . ' ' . $sesionesDenunciantes->APELLIDO_PATERNO ?></td>
												<td class="text-center"><?= $sesionesDenunciantes->DENUNCIANTE_HTTP ?></td>
												<td class="text-center"><?= $sesionesDenunciantes->DENUNCIANTE_SO ?></td>
												<td class="text-center"><?= $sesionesDenunciantes->FECHAINICIO ?></td>
												<?php if (in_array(session('ROLID'), $rolesToMonitor)) { ?>
													<td class="text-center">
														<a href="<?= base_url('/admin/dashboard/cerrar_sesiones_general?id_denunciante=') . $sesionesDenunciantes->ID_DENUNCIANTE ?>" class="btn btn-primary text-white"> CERRAR SESIÓN</a>
													</td>
												<?php }; ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php if (session()->getFlashdata('message_success')) : ?>
	<script>
		Swal.fire({
			icon: 'success',
			html: '<strong><?= session()->getFlashdata('message_success') ?></strong>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<script>
	$(function() {
		$("#table-usuarios").DataTable({
			responsive: false,
			lengthChange: false,
			autoWidth: true,
			ordering: true,
			order: [
				[3, 'desc'],
			],
			searching: true,
			pageLength: 25,
			// dom: 'Bfrtip',
			// buttons: [
			// 	'copy', 'excel', 'pdf'
			// ],
			language: {
				url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-MX.json'
			}
		});
	});
	$(function() {
		$("#table-denunciantes").DataTable({
			responsive: false,
			lengthChange: false,
			autoWidth: true,
			ordering: true,
			order: [
				[3, 'desc'],
			],
			searching: true,
			pageLength: 25,
			// dom: 'Bfrtip',
			// buttons: [
			// 	'copy', 'excel', 'pdf'
			// ],
			language: {
				url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-MX.json'
			}
		});
	});
</script>
<?= $this->endSection() ?>
