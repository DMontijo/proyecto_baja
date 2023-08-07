<?= $this->extend('denuncia_litigantes/templates/dashboard_template') ?>

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
					<table class="table table-striped table-bordered table-hover mt-5 table-sm ">
						<thead>
							<tr class="bg-blue">
								<th scope="col" class="text-white">FOLIO</th>
								<th scope="col" class="text-white" style="width:300px;">EXPEDIENTE</th>
								<th scope="col" class="text-white">FECHA Y HORA DE LA DENUNCIA</th>
								<th scope="col" class="text-white">DELITO MENCIONADO</th>
								<th scope="col" class="text-white">ESTADO</th>
								<th scope="col" class="text-white">MUNICIPIO</th>
								<th scope="col" class="text-white">OFICINA</th>
								<th scope="col" class="text-white"></th>

							</tr>
						</thead>
						<tbody>
							<?php foreach ($body_data->folios as $index => $folio) {
								$expedienteid = '';
								if (isset($folio->EXPEDIENTEID)) {
									$arrayExpediente = str_split($folio->EXPEDIENTEID);
									$expediente_guiones =  $arrayExpediente[1] . $arrayExpediente[2] . $arrayExpediente[4] . $arrayExpediente[5] . '-' . $arrayExpediente[6] . $arrayExpediente[7] . $arrayExpediente[8] . $arrayExpediente[9] . '-' . $arrayExpediente[10] . $arrayExpediente[11] . $arrayExpediente[12] . $arrayExpediente[13] . $arrayExpediente[14];
								} ?>

								<tr>
									<td class="text-center fw-bold"><?= $folio->FOLIOID . '/' . $folio->ANO ?></td>
									<td class="text-center fw-bold" style="width:300px;"><?= $folio->EXPEDIENTEID ? ($expediente_guiones ? $expediente_guiones . '/' . $folio->TIPOEXPEDIENTECLAVE : '')  : $folio->FOLIOID . '/' . $folio->ANO ?></td>
									<td class="text-center"><?= $folio->FECHAREGISTRO ?></td>
									<td class="text-center"><?= $folio->HECHODELITO ?></td>
									<td class="text-center"><?= $folio->STATUS == 'EXPEDIENTE' ? ($folio->ESTADOENJUSTICIA != '' ? $folio->ESTADOENJUSTICIA : 'EN TRÁMITE') : ($folio->STATUS == 'ABIERTO' ? 'EN TRÁMITE' : $folio->STATUS) ?></td>
									<td class="text-center"><?= $folio->EXPEDIENTEID ? $folio->MUNICIPIODESCR : '-' ?></td>
									<td class="text-center"><?= $folio->STATUS == 'EXPEDIENTE' ? ($folio->OFICINAENJUSTICIA != '' ? $folio->OFICINAENJUSTICIA : '') : ($folio->OFICINAID ? $folio->OFICINADESCR : '') ?></td>
									<td>
										<a type="button" class="text-decoration-none btn btn-success" href="<?= base_url('/denuncia_litigantes/dashboard/subir_documentos_folio?folio=' . $folio->FOLIOID . '&year=' . $folio->ANO) ?>">
											<!-- /denuncia_litigantes/dashboard/subir_documentos_folio?folio= .$folio->FOLIOID -->
											<i class="bi bi-file-earmark-plus-fill"></i>
										</a>
									</td>
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