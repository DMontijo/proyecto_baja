<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center mb-4">
				<h1 class="mb-4 text-center font-weight-bold">CONSTANCIAS EXTRAVIOS ABIERTOS</h1>
			</div>
			<div class="col-12">
				<div class="card shadow border-0">
					<div class="card-body">
						<table id="extravios_abiertos" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>CONSTANCIA</th>
									<th>FECHA</th>
									<th>DELITO</th>
									<th>ESTADO</th>
									<th>CONSTANCIA</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($body_data as $index => $constancia) { ?>
									<tr>
										<th scope="row"><?= $constancia->IDCERTIFICADOEXTRAVIADO ?></th>
										<td><?= $constancia->HECHOFECHA ?></td>
										<td><?= $constancia->EXTRAVIO ?></td>
										<td><?= $constancia->STATUS ?></td>
										<td><a type="button" href="<?= base_url('/admin/dashboard/constanciaExtravio?folio=') . $constancia->IDCERTIFICADOEXTRAVIADO ?>" class="btn btn-primary text-white"><i class="fas fa-download"></i> DESCARGAR</a></td>

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
		$("#extravios_abiertos").DataTable({
			"responsive": true,
			"lengthChange": false,
			"autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print", ]
		}).buttons().container().appendTo('#videollamadasA_wrapper .col-md-6:eq(0)');
	});
</script>

<?= $this->endSection() ?>
