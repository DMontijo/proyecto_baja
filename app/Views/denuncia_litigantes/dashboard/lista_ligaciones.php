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
									<th scope="col">VENCIMIENTO DE PODER</th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($body_data->ligaciones as $index => $ligar) { ?>
									<tr>
										<th scope="row"><?= $ligar->RAZONSOCIAL  ?></th>
										<td><?= $ligar->MARCACOMERCIAL ?></td>
										<td><?= $ligar->RFC ?></td>

										<?php if ($ligar->RELACIONAR == 'N' && empty($ligar->RECHAZAR)) { ?>
											<td class="text-center text-warning fw-bold">AUN NO HA SIDO ACEPTADO</td>
										<?php } else if ($ligar->RELACIONAR == 'S') { ?>
											<td class="text-center text-success fw-bold">ACEPTADO</td>
										<?php } else if ($ligar->RECHAZAR == 'S') {  ?>
											<td class="text-center text-danger fw-bold">RECHAZADO</td>

										<?php } ?>


										<?php $date1 = new DateTime($ligar->FECHAFINPODER);
											$date2 = new DateTime(date("Y-m-d"));	
											$diff = $date1->diff($date2);
											if(intval($diff->format('%d')) <= 3) { ?>
											<td class="text-center text-danger fw-bold"> <?= intval($diff->format('%d')); ?> DÍAS</td>
										<?php } else  { ?> 
											<td class="text-center text-success fw-bold"> <?= intval($diff->format('%d')); ?> DÍAS</td>
										<?php } ?>
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