<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3 class="mb-4 font-weight-bold text-center">USUARIOS</h3>
				<div class="card shadow border-0 rounded">
					<div class="card-body">
						<div class="row">
							<div class="col-12">
								<!-- <a type="button" id="new_user" href="<?= base_url('/admin/dashboard/nuevo_usuario') ?>" class="btn btn-primary float-right">
									<i class="fas fa-user-plus mr-3"></i> Nuevo usuario
								</a> -->
							</div>
							<div class="col-12 mt-3" style="overflow-x:scroll;">
								<table id="table-usuarios" class="table table-bordered table-striped" data-page-length='50' style="width:100%">
									<thead>
										<tr>
											<th class="text-center">ROL</th>
											<th class="text-center">NOMBRE</th>
											<th class="text-center">SEXO</th>
											<th class="text-center">CORREO</th>
											<th class="text-center">ZONA</th>
											<th class="text-center">FIEL</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($body_data as $index => $user) { ?>
											<tr>
												<td class="text-center"><?= $user->NOMBRE_ROL ?></td>
												<td class="text-center"><?= $user->NOMBRE ?> <?= $user->APELLIDO_PATERNO ?>
													<?= $user->APELLIDO_MATERNO ?></td>
												<td class="text-center"><?= $user->SEXO == 'F' ? 'FEMENINO' : 'MASCULINO' ?>
												</td>
												<td class="text-center"><?= $user->CORREO ?></td>
												<td class="text-center"><?= $user->NOMBRE_ZONA ?></td>
												<td class="text-center font-weight-bold">
													<?php
													$user_id = $user->ID;
													$directory = FCPATH . 'uploads/FIEL/' . $user_id;
													$file_key = $user_id . '_key.key';
													$file_cer = $user_id . '_cer.cer';
													?>
													<?php if (file_exists($directory . '/' . $file_key) && file_exists($directory . '/' . $file_cer)) : ?>
														TIENE FIEL CARGADA
													<?php else : ?>
														-
													<?php endif; ?>
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
		$("#table-usuarios").DataTable({
			responsive: false,
			lengthChange: true,
			autoWidth: false,
			ordering: true,
			language: {
				url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
			}
		}).buttons().container().appendTo('#videollamadasA_wrapper .col-md-6:eq(0)');
	});
</script>
<?= $this->endSection() ?>
