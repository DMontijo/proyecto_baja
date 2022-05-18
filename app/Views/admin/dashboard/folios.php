<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<script src="<?= base_url() ?>/assets/DataTables/jquery/jquery.min.js"></script>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<h3 class="mb-4">FOLIOS</h3>
				<div class="card shadow border-0">
					<div class="card-body">
						<table id="folios_atendidos" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>Nombre del denunciante</th>
									<th>Fecha</th>
									<th>Folio</th>
									<th>Salida</th>
									<th>Estado</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<?php for ($i = 0; $i < 20; $i++) { ?>
										<td><?= $i ?></td>
										<td>Andrea Gutierrez</td>
										<td>18/05/2021</td>
										<td>44<?= $i ?>HC</td>
										<td>NUC</td>
										<td>INVESTIGACIÓN</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	$(function() {
		$("#folios_atendidos").DataTable({
			"responsive": true,
			"lengthChange": false,
			"autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print", ]
		}).buttons().container().appendTo('#videollamadasA_wrapper .col-md-6:eq(0)');
	});
</script>

<?= $this->endSection() ?>
