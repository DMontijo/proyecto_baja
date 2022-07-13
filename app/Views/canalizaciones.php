<?= $this->extend('templates/derivaciones_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
	<h1 class="text-center mb-5 fw-bolder">CATÁLOGO DE CANALIZACIONES</h1>
	<nav>
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
			<button class="nav-link fw-bolder active" id="nav-tijuana-tab" data-bs-toggle="tab" data-bs-target="#nav-tijuana" type="button" role="tab" aria-controls="nav-tijuana" aria-selected="true">TIJUANA</button>
			<button class="nav-link fw-bolder" id="nav-rosarito-tab" data-bs-toggle="tab" data-bs-target="#nav-rosarito" type="button" role="tab" aria-controls="nav-rosarito" aria-selected="false">ROSARITO</button>
			<button class="nav-link fw-bolder" id="nav-mexicali-tab" data-bs-toggle="tab" data-bs-target="#nav-mexicali" type="button" role="tab" aria-controls="nav-mexicali" aria-selected="false">MEXICALI</button>
			<button class="nav-link fw-bolder" id="nav-tecate-tab" data-bs-toggle="tab" data-bs-target="#nav-tecate" type="button" role="tab" aria-controls="nav-tecate" aria-selected="false">TECATE</button>
			<button class="nav-link fw-bolder" id="nav-ensenada-tab" data-bs-toggle="tab" data-bs-target="#nav-ensenada" type="button" role="tab" aria-controls="nav-ensenada" aria-selected="false">ENSENADA</button>
		</div>
	</nav>
	<div class="tab-content" id="nav-tabContent" style="overflow-x: auto;">
		<div class="tab-pane fade show active" id="nav-tijuana" role="tabpanel" aria-labelledby="nav-tijuana-tab">
			<table id="table-tijuana" class="table table-striped table-hover mt-2">
				<thead>
					<tr class="text-center">
						<th>INSTITUCIÓN</th>
						<th>DOMICILIO</th>
						<th>TÉLEFONO</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($body_data->canalizacionesTijuana as $index => $canalizacion) { ?>
						<tr>
							<td class="fw-bold"><?= $canalizacion->INSTITUCIONREMISIONDESCR ?></td>
							<td><?= $canalizacion->DOMICILIO ?></td>
							<td><?= $canalizacion->TELEFONO ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="tab-pane fade" id="nav-rosarito" role="tabpanel" aria-labelledby="nav-rosarito-tab">
			<table id="table-rosarito" class="table table-striped table-hover mt-2">
				<thead>
					<tr class="text-center">
						<th>INSTITUCIÓN</th>
						<th>DOMICILIO</th>
						<th>TÉLEFONO</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($body_data->canalizacionesRosarito as $index => $canalizacion) { ?>
						<tr>
							<td class="fw-bold"><?= $canalizacion->INSTITUCIONREMISIONDESCR ?></td>
							<td><?= $canalizacion->DOMICILIO ?></td>
							<td><?= $canalizacion->TELEFONO ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="tab-pane fade" id="nav-mexicali" role="tabpanel" aria-labelledby="nav-mexicali-tab">
			<table id="table-mexicali" class="table table-striped table-hover mt-2">
				<thead>
					<tr class="text-center">
						<th>INSTITUCIÓN</th>
						<th>DOMICILIO</th>
						<th>TÉLEFONO</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($body_data->canalizacionesMexicali as $index => $canalizacion) { ?>
						<tr>
							<td class="fw-bold"><?= $canalizacion->INSTITUCIONREMISIONDESCR ?></td>
							<td><?= $canalizacion->DOMICILIO ?></td>
							<td><?= $canalizacion->TELEFONO ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="tab-pane fade" id="nav-tecate" role="tabpanel" aria-labelledby="nav-tecate-tab">
			<table id="table-tecate" class="table table-striped table-hover mt-2">
				<thead>
					<tr class="text-center">
						<th>INSTITUCIÓN</th>
						<th>DOMICILIO</th>
						<th>TÉLEFONO</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($body_data->canalizacionesTecate as $index => $canalizacion) { ?>
						<tr>
							<td class="fw-bold"><?= $canalizacion->INSTITUCIONREMISIONDESCR ?></td>
							<td><?= $canalizacion->DOMICILIO ?></td>
							<td><?= $canalizacion->TELEFONO ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="tab-pane fade" id="nav-ensenada" role="tabpanel" aria-labelledby="nav-ensenada-tab">
			<table id="table-ensenada" class="table table-striped table-hover mt-2">
				<thead>
					<tr class="text-center">
						<th>INSTITUCIÓN</th>
						<th>DOMICILIO</th>
						<th>TÉLEFONO</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($body_data->canalizacionesEnsenada as $index => $canalizacion) { ?>
						<tr>
							<td class="fw-bold"><?= $canalizacion->INSTITUCIONREMISIONDESCR ?></td>
							<td><?= $canalizacion->DOMICILIO ?></td>
							<td><?= $canalizacion->TELEFONO ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?= $this->endSection() ?>
