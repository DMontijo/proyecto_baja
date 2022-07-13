<?= $this->extend('templates/derivaciones_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
	<h1 class="text-center mb-5 fw-bolder">CATÁLOGO DE DERIVACIONES</h1>
	<nav>
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
			<button class="nav-link fw-bolder active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-tijuana" type="button" role="tab" aria-controls="nav-home" aria-selected="true">TIJUANA - ROSARITO</button>
			<button class="nav-link fw-bolder" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-mexicali" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">MEXICALI - TECATE</button>
			<button class="nav-link fw-bolder" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-ensenada" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">ENSENADA</button>
		</div>
	</nav>
	<div class="tab-content" id="nav-tabContent" style="overflow-x: auto;">
		<div class="tab-pane fade show active" id="nav-tijuana" role="tabpanel" aria-labelledby="nav-tijuana-tab">
			<table id="table-tijuana" class="table table-striped table-hover mt-2">
				<thead>
					<tr class="text-center">
						<!-- <th>Municipio</th> -->
						<th>INSTITUCIÓN</th>
						<th>DOMICILIO</th>
						<th>TÉLEFONO</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($body_data->derivacionesTijuana as $index => $derivacion) { ?>
						<tr>
							<!-- <td><?= $derivacion->MUNICIPIO ?></td> -->
							<td class="fw-bold"><?= $derivacion->INSTITUCIONREMISIONDESCR ?></td>
							<td><a href="https://www.google.com.mx/maps/place/<?= $derivacion->DOMICILIO ?>" target="_blank"><?= $derivacion->DOMICILIO ?></a></td>
							<td><?= $derivacion->TELEFONO ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="tab-pane fade" id="nav-mexicali" role="tabpanel" aria-labelledby="nav-mexicali-tab">
			<table id="table-mexicali" class="table table-striped table-hover mt-2">
				<thead>
					<tr class="text-center">
						<!-- <th>Municipio</th> -->
						<th>INSTITUCIÓN</th>
						<th>DOMICILIO</th>
						<th>TÉLEFONO</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($body_data->derivacionesMexicali as $index => $derivacion) { ?>
						<tr>
							<!-- <td><?= $derivacion->MUNICIPIO ?></td> -->
							<td class="fw-bold"><?= $derivacion->INSTITUCIONREMISIONDESCR ?></td>
							<td><a href="https://www.google.com.mx/maps/place/<?= $derivacion->DOMICILIO ?>" target="_blank"><?= $derivacion->DOMICILIO ?></a></td>
							<td><?= $derivacion->TELEFONO ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="tab-pane fade" id="nav-ensenada" role="tabpanel" aria-labelledby="nav-ensenada-tab">
			<table id="table-ensenada" class="table table-striped table-hover mt-2">
				<thead>
					<tr class="text-center">
						<!-- <th>Municipio</th> -->
						<th>INSTITUCIÓN</th>
						<th>DOMICILIO</th>
						<th>TÉLEFONO</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($body_data->derivacionesEnsenada as $index => $derivacion) { ?>
						<tr>
							<!-- <td><?= $derivacion->MUNICIPIO ?></td> -->
							<td class="fw-bold"><?= $derivacion->INSTITUCIONREMISIONDESCR ?></td>
							<td><a href="https://www.google.com.mx/maps/place/<?= $derivacion->DOMICILIO ?>" target="_blank"><?= $derivacion->DOMICILIO ?></a></td>
							<td><?= $derivacion->TELEFONO ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?= $this->endSection() ?>
