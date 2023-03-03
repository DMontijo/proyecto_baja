<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center mb-4">
				<h1 class="mb-4 text-center font-weight-bold">Bandeja de remisión</h1>
			</div>
			<div class="col-12">
				<div class="card shadow border-0" style="overflow-x:auto;">
					<div class="card-body">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="ensenada-tab" data-toggle="tab" href="#ensenada" role="tab" aria-controls="ensenada" aria-selected="true">Ensenada - <?= count($body_data->ensenada->result) ?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="mexicali-tab" data-toggle="tab" href="#mexicali" role="tab" aria-controls="mexicali" aria-selected="false">Mexicali - <?= count($body_data->mexicali->result) ?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="tecate-tab" data-toggle="tab" href="#tecate" role="tab" aria-controls="tecate" aria-selected="false">Tecate - <?= count($body_data->tecate->result) ?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="tijuana-tab" data-toggle="tab" href="#tijuana" role="tab" aria-controls="tijuana" aria-selected="false">Tijuana - <?= count($body_data->tijuana->result) ?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="rosarito-tab" data-toggle="tab" href="#rosarito" role="tab" aria-controls="rosarito" aria-selected="false">Playas de Rosarito - <?= count($body_data->rosarito->result) ?></a>
							</li>
						</ul>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="ensenada" role="tabpanel" aria-labelledby="ensenada-tab">
								<table id="table-ensenada" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th class="text-center">FOLIO</th>
											<th class="text-center">EXPEDIENTE</th>
											<th class="text-center">MUNICIPIO ASIGNADO</th>
											<th class="text-center">DOMICILIO DEL HECHO</th>
											<th class="text-center">DELITOS INVOLUCRADOS</th>
											<th class="text-center"></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($body_data->ensenada->result as $index => $folio) {
											$expedienteid = '';
											if (isset($folio->EXPEDIENTEID)) {
												$arrayExpediente = str_split($folio->EXPEDIENTEID);
												$expedienteid = $arrayExpediente[1] . $arrayExpediente[2] . $arrayExpediente[4] . $arrayExpediente[5] . '-' . $arrayExpediente[6] . $arrayExpediente[7] . $arrayExpediente[8] . $arrayExpediente[9] . '-' . $arrayExpediente[10] . $arrayExpediente[11] . $arrayExpediente[12] . $arrayExpediente[13] . $arrayExpediente[14];
											} ?>
											<tr>
												<td class="text-center"><?= $folio->FOLIOID . '/' . $folio->ANO ?></td>
												<td class="text-center"><?= $expedienteid ? $expedienteid : '' ?></td>
												<td class="text-center"><?= $folio->MUNICIPIODESCR ?></td>
												<td class="text-center"><?= $folio->HECHOCALLE ?></td>
												<td class="text-center"><?= $folio->DELITOMODALIDADDESCR ?></td>
												<td class="text-center">
													<a type="button" href="<?= base_url('/admin/dashboard/bandeja_remision?folio=') . $folio->FOLIOID . '&year=' . $folio->ANO . '&municipioasignado=' . $folio->MUNICIPIOASIGNADOID . '&expediente=' . $folio->EXPEDIENTEID ?>" class="btn btn-primary text-white">REMITIR</a>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="tab-pane fade" id="mexicali" role="tabpanel" aria-labelledby="mexicali-tab">
								<table id="table-mexicali" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th class="text-center">EXPEDIENTEID</th>
											<th class="text-center">MUNICIPIO ASIGNADO</th>
											<th class="text-center">DOMICILIO DEL HECHO</th>
											<th class="text-center">DELITOS INVOLUCRADOS</th>
											<th class="text-center"></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($body_data->mexicali->result as $index => $folio) {
											$expedienteid = '';
											if (isset($folio->EXPEDIENTEID)) {
												$arrayExpediente = str_split($folio->EXPEDIENTEID);
												$expedienteid = $arrayExpediente[1] . $arrayExpediente[2] . $arrayExpediente[4] . $arrayExpediente[5] . '-' . $arrayExpediente[6] . $arrayExpediente[7] . $arrayExpediente[8] . $arrayExpediente[9] . '-' . $arrayExpediente[10] . $arrayExpediente[11] . $arrayExpediente[12] . $arrayExpediente[13] . $arrayExpediente[14];
											} ?>
											<tr>
												<td class="text-center"><?= $expedienteid ? $expedienteid : '' ?></td>
												<td class="text-center"><?= $folio->MUNICIPIODESCR ?></td>
												<td class="text-center"><?= $folio->HECHOCALLE ?></td>
												<td class="text-center"><?= $folio->DELITOMODALIDADDESCR ?></td>
												<td class="text-center">
													<a type="button" href="<?= base_url('/admin/dashboard/bandeja_remision?folio=') . $folio->FOLIOID . '&year=' . $folio->ANO . '&municipioasignado=' . $folio->MUNICIPIOASIGNADOID . '&expediente=' . $folio->EXPEDIENTEID ?>" class="btn btn-primary text-white">REMITIR</a>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="tab-pane fade" id="tecate" role="tabpanel" aria-labelledby="tecate-tab">
								<table id="table-tecate" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th class="text-center">EXPEDIENTEID</th>
											<th class="text-center">MUNICIPIO ASIGNADO</th>
											<th class="text-center">DOMICILIO DEL HECHO</th>
											<th class="text-center">DELITOS INVOLUCRADOS</th>
											<th class="text-center"></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($body_data->tecate->result as $index => $folio) {
											$expedienteid = '';
											if (isset($folio->EXPEDIENTEID)) {
												$arrayExpediente = str_split($folio->EXPEDIENTEID);
												$expedienteid = $arrayExpediente[1] . $arrayExpediente[2] . $arrayExpediente[4] . $arrayExpediente[5] . '-' . $arrayExpediente[6] . $arrayExpediente[7] . $arrayExpediente[8] . $arrayExpediente[9] . '-' . $arrayExpediente[10] . $arrayExpediente[11] . $arrayExpediente[12] . $arrayExpediente[13] . $arrayExpediente[14];
											} ?>
											<tr>
												<td class="text-center"><?= $expedienteid ? $expedienteid : '' ?></td>
												<td class="text-center"><?= $folio->MUNICIPIODESCR ?></td>
												<td class="text-center"><?= $folio->HECHOCALLE ?></td>
												<td class="text-center"><?= $folio->DELITOMODALIDADDESCR ?></td>
												<td class="text-center">
													<a type="button" href="<?= base_url('/admin/dashboard/bandeja_remision?folio=') . $folio->FOLIOID . '&year=' . $folio->ANO . '&municipioasignado=' . $folio->MUNICIPIOASIGNADOID . '&expediente=' . $folio->EXPEDIENTEID ?>" class="btn btn-primary text-white">REMITIR</a>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="tab-pane fade" id="tijuana" role="tabpanel" aria-labelledby="tijuana-tab">
								<table id="table-tijuana" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th class="text-center">EXPEDIENTEID</th>
											<th class="text-center">MUNICIPIO ASIGNADO</th>
											<th class="text-center">DOMICILIO DEL HECHO</th>
											<th class="text-center">DELITOS INVOLUCRADOS</th>
											<th class="text-center"></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($body_data->tijuana->result as $index => $folio) {
											$expedienteid = '';
											if (isset($folio->EXPEDIENTEID)) {
												$arrayExpediente = str_split($folio->EXPEDIENTEID);
												$expedienteid = $arrayExpediente[1] . $arrayExpediente[2] . $arrayExpediente[4] . $arrayExpediente[5] . '-' . $arrayExpediente[6] . $arrayExpediente[7] . $arrayExpediente[8] . $arrayExpediente[9] . '-' . $arrayExpediente[10] . $arrayExpediente[11] . $arrayExpediente[12] . $arrayExpediente[13] . $arrayExpediente[14];
											} ?>
											<tr>
												<td class="text-center"><?= $expedienteid ? $expedienteid : '' ?></td>
												<td class="text-center"><?= $folio->MUNICIPIODESCR ?></td>
												<td class="text-center"><?= $folio->HECHOCALLE ?></td>
												<td class="text-center"><?= $folio->DELITOMODALIDADDESCR ?></td>
												<td class="text-center">
													<a type="button" href="<?= base_url('/admin/dashboard/bandeja_remision?folio=') . $folio->FOLIOID . '&year=' . $folio->ANO . '&municipioasignado=' . $folio->MUNICIPIOASIGNADOID . '&expediente=' . $folio->EXPEDIENTEID ?>" class="btn btn-primary text-white">REMITIR</a>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="tab-pane fade" id="rosarito" role="tabpanel" aria-labelledby="rosarito-tab">
								<table id="table-rosarito" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th class="text-center">EXPEDIENTEID</th>
											<th class="text-center">MUNICIPIO ASIGNADO</th>
											<th class="text-center">DOMICILIO DEL HECHO</th>
											<th class="text-center">DELITOS INVOLUCRADOS</th>
											<th class="text-center"></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($body_data->rosarito->result as $index => $folio) {
											$expedienteid = '';
											if (isset($folio->EXPEDIENTEID)) {
												$arrayExpediente = str_split($folio->EXPEDIENTEID);
												$expedienteid = $arrayExpediente[1] . $arrayExpediente[2] . $arrayExpediente[4] . $arrayExpediente[5] . '-' . $arrayExpediente[6] . $arrayExpediente[7] . $arrayExpediente[8] . $arrayExpediente[9] . '-' . $arrayExpediente[10] . $arrayExpediente[11] . $arrayExpediente[12] . $arrayExpediente[13] . $arrayExpediente[14];
											} ?>
											<tr>
												<td class="text-center"><?= $expedienteid ? $expedienteid : '' ?></td>
												<td class="text-center"><?= $folio->MUNICIPIODESCR ?></td>
												<td class="text-center"><?= $folio->HECHOCALLE ?></td>
												<td class="text-center"><?= $folio->DELITOMODALIDADDESCR ?></td>
												<td class="text-center">
													<a type="button" href="<?= base_url('/admin/dashboard/bandeja_remision?folio=') . $folio->FOLIOID . '&year=' . $folio->ANO . '&municipioasignado=' . $folio->MUNICIPIOASIGNADOID . '&expediente=' . $folio->EXPEDIENTEID ?>" class="btn btn-primary text-white">REMITIR</a>
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
		$("#table-ensenada").DataTable({
			responsive: false,
			lengthChange: false,
			autoWidth: true,
			ordering: true,
			order: [
				[0, 'asc'],
			],
			searching: true,
			pageLength: 100,
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
		$("#table-mexicali").DataTable({
			responsive: false,
			lengthChange: false,
			autoWidth: true,
			ordering: true,
			order: [
				[0, 'asc'],
			],
			searching: true,
			pageLength: 100,
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
		$("#table-tecate").DataTable({
			responsive: false,
			lengthChange: false,
			autoWidth: true,
			ordering: true,
			order: [
				[0, 'asc'],
			],
			searching: true,
			pageLength: 100,
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
		$("#table-tijuana").DataTable({
			responsive: false,
			lengthChange: false,
			autoWidth: true,
			ordering: true,
			order: [
				[0, 'asc'],
			],
			searching: true,
			pageLength: 100,
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
		$("#table-rosarito").DataTable({
			responsive: false,
			lengthChange: false,
			autoWidth: true,
			ordering: true,
			order: [
				[0, 'asc'],
			],
			searching: true,
			pageLength: 100,
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
