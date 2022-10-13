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
			<?php if ($body_data->documento) { ?>
				<div class="col-12 col-md-8 offset-md-2 pt-5">
					<h2 class="fw-bold pb-5 text-center">DOCUMENTO VÁLIDO <i class="bi bi-check-circle-fill text-success"></i></h2>
					<div class="card">
						<div class="card-body" style="overflow-x: auto;">
							<table class="table table-striped table-bordered m-0">
								<tr>
									<td class="fw-bold text-end">EXPEDIENTE:</td>
									<td class="text-start"><?= $body_data->documento->NUMEROEXPEDIENTE ? $body_data->documento->NUMEROEXPEDIENTE : '' ?></td>
								</tr>
								<tr>
									<td class="fw-bold text-end">AGENTE FIRMANTE:</td>
									<td class="text-start"><?= $body_data->documento->RAZONSOCIALFIRMA ? $body_data->documento->RAZONSOCIALFIRMA : '' ?></td>
								</tr>
								<tr>
									<td class="fw-bold text-end">RFC FIRMANTE:</td>
									<td class="text-start"><?= $body_data->documento->RFCFIRMA ? $body_data->documento->RFCFIRMA : '' ?></td>
								</tr>
								<tr>
									<td class="fw-bold text-end">NÚMERO CERTIFICADO FIRMANTE:</td>
									<td class="text-start"><?= $body_data->documento->NCERTIFICADOFIRMA ? $body_data->documento->NCERTIFICADOFIRMA : '' ?></td>
								</tr>
								<tr>
									<td class="fw-bold text-end">FECHA FIRMA:</td>
									<td class="text-start"><?= $body_data->documento->FECHAFIRMA ? $body_data->documento->FECHAFIRMA : '' ?></td>
								</tr>
								<tr>
									<td class="fw-bold text-end">HORA FIRMA:</td>
									<td class="text-start"><?= $body_data->documento->HORAFIRMA ? $body_data->documento->HORAFIRMA : '' ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			<?php } else { ?>
				<div class="col-12 d-flex justify-content-center align-items-center flex-column text-center">
					<i class="bi bi-x-octagon-fill text-danger" style="font-size:100px;"></i>
					<h2>EL DOCUMENTO SOLICITADO NO EXISTE EN EL SISTEMA</h2>
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
