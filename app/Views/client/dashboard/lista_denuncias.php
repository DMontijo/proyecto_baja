<?= $this->extend('client/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
	<div class="col-12">
		<div class="card text-center overflow-auto shadow rounded">
			<div class="card-body p-0 py-3 p-sm-5">
				<h1 class="card-title fw-bold">MIS DENUNCIAS</h1>
				<?php if (count($body_data->folios) > 0) { ?>
					<table class="table table-striped table-hover mt-5">
						<thead>
							<tr>
								<th scope="col">FOLIO</th>
								<th scope="col">AÑO</th>
								<th scope="col">FECHA Y HORA DE LA DENUNCIA</th>
								<th scope="col">DELITO MENCIONADO</th>
								<th scope="col">ESTADO</th>
								<th scope="col">EXPEDIENTE</th>
								<!-- <th scope="col">VIDEO</th> -->
							</tr>
						</thead>
						<tbody>
							<?php foreach ($body_data->folios as $index => $folio) { ?>
								<tr>
									<td class="text-center"><?= $folio->FOLIOID ?></td>
									<td class="text-center"><?= $folio->ANO ?></td>
									<td class="text-center"><?= $folio->FECHAREGISTRO ?></td>
									<td class="text-center"><?= $folio->HECHODELITO ?></td>
									<td class="text-center"><?= $folio->STATUS ?></td>
									<td class="text-center"><?= $folio->EXPEDIENTEID ? $folio->EXPEDIENTEID : '-' ?></td>
									<!-- <td class="text-center">
										<?php //if ($folio->EXPEDIENTEID) : ?>
											<button type="button" class="btn btn-primary" onclick="viewVideo(<?= $folio->ANO ?>,<?= $folio->FOLIOID ?>)"><i class="bi bi-play-btn"></i></button>
										<?php //else : ?>
											-
										<?php //endif; ?>
									</td> -->
								</tr>
							<?php } ?>
						</tbody>
					</table>
				<?php } else { ?>
					<p class="mt-5 text-yellow fw-bolder"> <i class="bi bi-archive"></i> Aún no haz levantado ninguna denuncia</p>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>
