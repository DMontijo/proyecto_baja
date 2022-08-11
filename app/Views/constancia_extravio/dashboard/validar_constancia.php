<?= $this->extend('constancia_extravio/templates/constancia_realizada_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php

?>
<section class="content">
	<div class="container-fluid">
		<div class="row" style="min-height:83vh;">
			<?php if ($body_data->constancia) { ?>
				<div class="col-12 col-md-8 offset-md-2 pt-5">
					<h2 class="fw-bold pb-5 text-center">CONSTANCIA VÁLIDA <i class="bi bi-check-circle-fill text-success"></i></h2>
					<div class="card">
						<div class="card-body" style="overflow-x: auto;">
							<table class="table table-striped table-bordered m-0">
								<tr>
									<td class="fw-bold text-end">FOLIO:</td>
									<td class="text-start"><?= $body_data->constancia->CONSTANCIAEXTRAVIOID ? $body_data->constancia->CONSTANCIAEXTRAVIOID : '' ?></td>
								</tr>
								<tr>
									<td class="fw-bold text-end">AÑO:</td>
									<td class="text-start"><?= $body_data->constancia->ANO ? $body_data->constancia->ANO : '' ?></td>
								</tr>
								<tr>
									<td class="fw-bold text-end">SOLICITANTE:</td>
									<td class="text-start"><?= $body_data->constancia->NOMBRESOLICITANTE ? $body_data->constancia->NOMBRESOLICITANTE : '' ?></td>
								</tr>
								<tr>
									<td class="fw-bold text-end">AGENTE FIRMANTE:</td>
									<td class="text-start"><?= $body_data->constancia->RAZONSOCIALFIRMA ? $body_data->constancia->RAZONSOCIALFIRMA : '' ?></td>
								</tr>
								<tr>
									<td class="fw-bold text-end">RFC FIRMANTE:</td>
									<td class="text-start"><?= $body_data->constancia->RFCFIRMA ? $body_data->constancia->RFCFIRMA : '' ?></td>
								</tr>
								<tr>
									<td class="fw-bold text-end">NÚMERO CERTIFICADO FIRMANTE:</td>
									<td class="text-start"><?= $body_data->constancia->NCERTIFICADOFIRMA ? $body_data->constancia->NCERTIFICADOFIRMA : '' ?></td>
								</tr>
								<tr>
									<td class="fw-bold text-end">FECHA FIRMA:</td>
									<td class="text-start"><?= $body_data->constancia->FECHAFIRMA ? $body_data->constancia->FECHAFIRMA : '' ?></td>
								</tr>
								<tr>
									<td class="fw-bold text-end">HORA FIRMA:</td>
									<td class="text-start"><?= $body_data->constancia->HORAFIRMA ? $body_data->constancia->HORAFIRMA : '' ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			<?php } else { ?>
				<div class="col-12 d-flex justify-content-center align-items-center flex-column text-center">
					<i class="bi bi-x-octagon-fill text-danger" style="font-size:100px;"></i>
					<h2>LA CONSTANCIA SOLICITADA NO EXISTE EN EL SISTEMA</h2>
				</div>
			<?php } ?>
		</div>
	</div>
</section>
<?php if (session()->getFlashdata('peticion')) : ?>
	<script>
		Swal.fire({
			icon: 'success',
			text: '<?= session()->getFlashdata('peticion') ?>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<?= $this->endSection() ?>
