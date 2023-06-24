<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<h2 class="text-center font-weight-bold mb-3">NUEVO ROL</h2>
	<div class="card shadow border-0 rounded">
		<div class="card-body">
			<form class="g-3 needs-validation" action="<?= base_url() ?>/admin/dashboard/create_rol" method="POST" enctype="multipart/form-data">

				<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3" style="margin: 0 auto;">
					<label class="font-weight-bold" for="rol_input">Rol de usuario</label>
					<input type="text" name="rol_input" class="form-control" id="rol_input" required>
				</div>
				<div class="col-12 pt-5 text-center">
					<button type="submit" id="btn-submit" class="btn btn-primary font-weight-bold">

						CREAR ROL
					</button>
				</div>
			</form>
		</div>
		<div class="col-12 mt-3" style="overflow-x:scroll;">
	<table id="table-rol" class="table table-bordered table-striped" data-page-length='50' style="width:100%">
		<thead>
			<tr>
				<th class="text-center">ROLES REGISTRADOS</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($body_data->roles as $index => $rol) { ?>
				<tr>
					<td class="text-center"><?= $rol->NOMBRE_ROL?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	</div>
	</div>
	

</section>
<script>
	$(function() {
		$("#table-rol").DataTable({
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
