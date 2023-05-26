<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="mb-4 text-center font-weight-bold">PERMISOS REGISTRADOS</h1>
				<div class="card shadow border-0 rounded">
					<div class="card-body">
						<div class="row">
							<div class="col-12">
								<a type="button" id="new_rol" href="<?= base_url('/admin/dashboard/nuevo_asignacion_permisos') ?>" class="btn btn-primary float-right" style="margin: 10px;">
									<i class="fas fa-scroll mr-3"></i> Nueva asignación de permisos
								</a>
								
								<a type="button" id="new_rol" href="<?= base_url('/admin/dashboard/nuevo_rol') ?>" class="btn btn-secondary float-right" style="margin: 10px;">
									<i class="fas fa-user-plus mr-3"></i> Nuevo rol
								</a>
							</div>
							
							<div class="col-12 mt-3" style="overflow-x:scroll;">
								<table id="table-rol-permiso" class="table table-bordered table-striped" data-page-length='50' style="width:100%">
									<thead>
										<tr>
											<th class="text-center">ROL</th>
											<th class="text-center">PERMISO</th>
											
											<th class="text-center"></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($body_data->rolPermisoDescr as $index => $rolpermiso) { ?>
											<tr>
												<td class="text-center"><?= $rolpermiso['NOMBRE_ROL'] ?></td>
												
												<td class="text-center"><?= $rolpermiso['PERMISODESCR'] ?></td>
											

												<td class="text-center">
													<a type="button" class="btn btn-danger" href="<?= base_url('admin/dashboard/eliminar_asignacion_permiso?rol=' . $rolpermiso['ROLID'].'&permiso='. $rolpermiso['PERMISOID']) ?>">
														<i class="fas fa-trash"></i>
													</a>
												</td>
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
<script>
	$(function() {
		$("#table-rol-permiso").DataTable({
			responsive: false,
			lengthChange: false,
			autoWidth: true,
			ordering: true,
			order: [
				[0, 'asc'],
				[2, 'asc'],
				[1, 'asc'],
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
