	<?= $this->extend('denuncia_litigantes/templates/dashboard_template') ?>

	<?= $this->section('title') ?>
	<?php echo $header_data->title ?>
	<?= $this->endSection() ?>

	<?= $this->section('content') ?>
	<div class="row" style="min-height:83vh;">
		<div class="col-12">
			<div class="card text-center overflow-auto shadow rounded">
				<div class="card-body p-0 py-3 p-sm-5">
					<h1 class="card-title fw-bold">MIS SOLICITUDES DE LIGACIONES</h1>
					<?php if (count($body_data->ligaciones) > 0) { ?>
						<table class="table table-striped table-hover mt-5">
							<thead>
								<tr>
									<th scope="col">RAZÓN SOCIAL</th>
									<th scope="col">MARCA COMERCIAL</th>
									<th scope="col">RFC</th>
									<th scope="col">ESTADO</th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($body_data->ligaciones as $index => $ligar) { ?>
									<tr>
										<th scope="row"><?= $ligar->RAZONSOCIAL  ?></th>
										<td><?= $ligar->MARCACOMERCIAL ?></td>
										<td><?= $ligar->RFC ?></td>
										<td><?= $ligar->RELACIONAR == 'N' ? "AUN NO HA SIDO ACEPTADO" : "ACEPTADO" ?></td>

										</td>
									<?php } ?>

									</tr>
							</tbody>
						</table>
					<?php } else { ?>
						<p class="mt-5 text-yellow fw-bolder"> <i class="bi bi-archive"></i> Aún no haz levantado ninguna solicitud de ligación</p>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<?= $this->endSection() ?>