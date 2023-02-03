<?= $this->extend('templates/derivaciones_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
	<h1 class="text-center mb-5 fw-bolder">DIRECTORIO DE CANALIZACIONES</h1>
	<div class="row">
		<div class="col-12 m-auto" style="max-width:900px;">
			<nav>
				<div class="nav nav-tabs" id="nav-tab" role="tablist">
					<button class="nav-link fw-bolder active" id="nav-ensenada-tab" data-bs-toggle="tab" data-bs-target="#nav-ensenada" type="button" role="tab" aria-controls="nav-ensenada" aria-selected="false">ENSENADA</button>
					<button class="nav-link fw-bolder" id="nav-mexicali-tab" data-bs-toggle="tab" data-bs-target="#nav-mexicali" type="button" role="tab" aria-controls="nav-mexicali" aria-selected="false">MEXICALI</button>
					<button class="nav-link fw-bolder" id="nav-tecate-tab" data-bs-toggle="tab" data-bs-target="#nav-tecate" type="button" role="tab" aria-controls="nav-tecate" aria-selected="false">TECATE</button>
					<button class="nav-link fw-bolder" id="nav-tijuana-tab" data-bs-toggle="tab" data-bs-target="#nav-tijuana" type="button" role="tab" aria-controls="nav-tijuana" aria-selected="true">TIJUANA</button>
					<button class="nav-link fw-bolder" id="nav-rosarito-tab" data-bs-toggle="tab" data-bs-target="#nav-rosarito" type="button" role="tab" aria-controls="nav-rosarito" aria-selected="false">ROSARITO</button>
				</div>
			</nav>
			<div class="tab-content" id="nav-tabContent" style="overflow-x: auto;">
				<div class="tab-pane fade" id="nav-tijuana" role="tabpanel" aria-labelledby="nav-tijuana-tab">
					<table id="table-tijuana" class="table table-striped table-hover table-bordered mt-3">
						<thead>
							<tr class="text-center bg-blue text-white">
								<th scope="col">INSTITUCIÓN</th>
								<th scope="col">DOMICILIO</th>
								<th scope="col">TÉLEFONO</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($body_data->canalizacionesTijuana as $index => $canalizacion) { ?>
								<tr>
									<td class="fw-bold col-3 text-center p-3"><?= $canalizacion->INSTITUCIONREMISIONDESCR ?></td>
									<td class="col-6 text-center p-3"><?= $canalizacion->DOMICILIO ?></td>
									<td class="col-3 text-center p-3"><?= $canalizacion->TELEFONO ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="tab-pane fade" id="nav-rosarito" role="tabpanel" aria-labelledby="nav-rosarito-tab">
					<table id="table-rosarito" class="table table-striped table-hover table-bordered mt-3">
						<thead>
							<tr class="text-center bg-blue text-white">
								<th scope="col">INSTITUCIÓN</th>
								<th scope="col">DOMICILIO</th>
								<th scope="col">TÉLEFONO</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($body_data->canalizacionesRosarito as $index => $canalizacion) { ?>
								<tr>
									<td class="fw-bold col-3 text-center p-3"><?= $canalizacion->INSTITUCIONREMISIONDESCR ?></td>
									<td class="col-6 text-center p-3"><?= $canalizacion->DOMICILIO ?></td>
									<td class="col-3 text-center p-3"><?= $canalizacion->TELEFONO ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="tab-pane fade" id="nav-mexicali" role="tabpanel" aria-labelledby="nav-mexicali-tab">
					<table id="table-mexicali" class="table table-striped table-hover table-bordered mt-3">
						<thead>
							<tr class="text-center bg-blue text-white">
								<th scope="col">INSTITUCIÓN</th>
								<th scope="col">DOMICILIO</th>
								<th scope="col">TÉLEFONO</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($body_data->canalizacionesMexicali as $index => $canalizacion) { ?>
								<tr>
									<td class="fw-bold col-3 text-center p-3"><?= $canalizacion->INSTITUCIONREMISIONDESCR ?></td>
									<td class="col-6 text-center p-3"><?= $canalizacion->DOMICILIO ?></td>
									<td class="col-3 text-center p-3"><?= $canalizacion->TELEFONO ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="tab-pane fade" id="nav-tecate" role="tabpanel" aria-labelledby="nav-tecate-tab">
					<table id="table-tecate" class="table table-striped table-hover table-bordered mt-3">
						<thead>
							<tr class="text-center bg-blue text-white">
								<th scope="col">INSTITUCIÓN</th>
								<th scope="col">DOMICILIO</th>
								<th scope="col">TÉLEFONO</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($body_data->canalizacionesTecate as $index => $canalizacion) { ?>
								<tr>
									<td class="fw-bold col-3 text-center p-3"><?= $canalizacion->INSTITUCIONREMISIONDESCR ?></td>
									<td class="col-6 text-center p-3"><?= $canalizacion->DOMICILIO ?></td>
									<td class="col-3 text-center p-3"><?= $canalizacion->TELEFONO ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="tab-pane fade show active" id="nav-ensenada" role="tabpanel" aria-labelledby="nav-ensenada-tab">
					<table id="table-ensenada" class="table table-striped table-hover table-bordered mt-3">
						<thead>
							<tr class="text-center bg-blue text-white">
								<th scope="col">INSTITUCIÓN</th>
								<th scope="col">DOMICILIO</th>
								<th scope="col">TÉLEFONO</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($body_data->canalizacionesEnsenada as $index => $canalizacion) { ?>
								<tr>
									<td class="fw-bold col-3 text-center p-3"><?= $canalizacion->INSTITUCIONREMISIONDESCR ?></td>
									<td class="col-6 text-center p-3"><?= $canalizacion->DOMICILIO ?></td>
									<td class="col-3 text-center p-3"><?= $canalizacion->TELEFONO ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

</div>
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
			pageLength: 200,
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
			pageLength: 200,
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
			pageLength: 200,
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
			pageLength: 200,
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
			pageLength: 200,
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
