<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center mb-4">
				<h1 class="mb-4 text-center font-weight-bold">CONSTANCIAS DE EXTRAVIO ABIERTAS</h1>
			</div>
			<div class="col-12">
				<div class="card shadow border-0">
					<div class="card-body">
						<table id="extravios_abiertos" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th class="text-center">ID</th>
									<th class="text-center">FECHA</th>
									<th class="text-center">TIPO DE CONSTANCIA</th>
									<th class="text-center">ESTADO</th>
									<th class="text-center"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($body_data as $index => $constancia) { ?>
									<tr>
										<td class="text-center font-weight-bold"><?= $constancia->IDCONSTANCIAEXTRAVIO ?></td>
										<td class="text-center"><?= $constancia->FECHAREGISTRO ?></td>
										<td class="text-center"><?= $constancia->EXTRAVIO ?></td>
										<td class="text-center"><?= $constancia->STATUS ?></td>
										<td class="text-center"><a type="button" href="<?= base_url('/admin/dashboard/constancia_extravio_show?folio=' . $constancia->IDCONSTANCIAEXTRAVIO . '&year=' . $constancia->ANO) ?>" class="btn btn-primary text-white"><i class="fas fa-eye"></i> VER SOLICITUD</a></td>
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
