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
								<table id="table-usuarios" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th class="text-center">ROL</th>
											<th class="text-center">NOMBRE</th>
											<th class="text-center">SEXO</th>
											<th class="text-center">CORREO</th>
											<th class="text-center">ZONA</th>
											<!-- <th class="text-center">HUELLA</th> -->
											<th class="text-center">.CER</th>
											<th class="text-center">.KEY</th>
											<!-- <th class="text-center">FRASE</th> -->
											<!-- <th></th> -->
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
												<!-- <td class="text-center"><?= $user->HUELLA_DIGITAL ? 'SI' : '' ?></td> -->
												<td class="text-center"><?= $user->CERTIFICADOFIRMA ? 'SI' : '' ?></td>
												<td class="text-center"><?= $user->KEYFIRMA ? 'SI' : '' ?></td>
												<!-- <td class="text-center"><?= $user->FRASEFIRMA ? 'SI' : '' ?></td> -->
												<!-- <td class="text-center" style="width:200px;">
													<button type="button" class="btn btn-success" onclick="viewUser(<?= $user->ID ?>)"><i class="fas fa-eye"></i></button>
													<button type="button" class="btn btn-secondary" onclick="viewUser(<?= $user->ID ?>)"><i class="fas fa-edit"></i></button>
													<button type="button" class="btn btn-danger" onclick="viewUser(<?= $user->ID ?>)"><i class="fas fa-trash-alt"></i></button>
												</td> -->
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
			"autoWidth": true,
			"buttons": ["copy", "csv", "excel", "pdf", "print", ]
		}).buttons().container().appendTo('#videollamadasA_wrapper .col-md-6:eq(0)');
	});
</script>
<?= $this->endSection() ?>
