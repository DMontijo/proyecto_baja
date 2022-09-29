<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php
$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center mb-4">
				<h1 class="mb-4 text-center font-weight-bold">CONSTANCIAS DE EXTRAVÍO FIRMADAS</h1>
				<a class="link link-primary" href="<?= base_url('admin/dashboard/constancias') ?>" role="button"><i class="fas fa-reply"></i> REGRESAR A CONSTANCIAS</a>
			</div>
			<div class="col-12">
				<div class="card shadow border-0" style="overflow-x:auto;">
					<div class="card-body">
						<table id="extravios_abiertos" class="table table-bordered table-striped" data-page-length='50' style="width:100%">
							<thead>
								<tr>
									<th class="text-center">FOLIO</th>
									<th class="text-center">FECHA FIRMA</th>
									<th class="text-center">HORA FIRMA</th>
									<th class="text-center">LUGAR FIRMA</th>
									<th class="text-center">TIPO DE CONSTANCIA</th>
									<th class="text-center">AGENTE QUE FIRMÓ</th>
									<th class="text-center"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($body_data as $index => $constancia) { ?>
									<tr>
										<td class="text-center font-weight-bold"><?= $constancia->CONSTANCIAEXTRAVIOID . '/' . $constancia->ANO ?></td>
										<td class="text-center"><?= date("d-m-Y", strtotime($constancia->FECHAFIRMA)) ?></td>
										<td class="text-center"><?= date("H:i", strtotime($constancia->HORAFIRMA)) ?></td>
										<td class="text-center"><?= $constancia->LUGARFIRMA ?></td>
										<td class="text-center"><?= $constancia->EXTRAVIO == 'DOCUMENTOS'
																	? $constancia->TIPODOCUMENTO
																	: $constancia->EXTRAVIO ?></td>
										<td class="text-center"><?= $constancia->RAZONSOCIALFIRMA ?></td>
										<?php if ($constancia->STATUS == 'ABIERTO') { ?>
											<td class="text-center"><a type="button" href="<?= base_url('/admin/dashboard/constancia_extravio_show?folio=' . $constancia->CONSTANCIAEXTRAVIOID . '&year=' . $constancia->ANO) ?>" class="btn btn-primary text-white"><i class="fas fa-eye"></i> VER SOLICITUD</a></td>
										<?php } ?>
										<?php if ($constancia->STATUS == 'FIRMADO') { ?>
											<td class="text-center">
												<form class="d-inline-block" method="POST" action="<?php echo base_url('admin/dashboard/download_constancia_pdf') ?>">
													<input type="text" class="form-control" id="folio" name="folio" value="<?= $constancia->CONSTANCIAEXTRAVIOID ?>" hidden>
													<input type="text" class="form-control" id="year" name="year" value="<?= $constancia->ANO ?>" hidden>
													<button type="submit" class="btn btn-primary mb-3">
														PDF
													</button>
												</form>
												<form class="d-inline-block" method="POST" action="<?php echo base_url('admin/dashboard/download_constancia_xml') ?>">
													<input type="text" class="form-control" id="folio" name="folio" value="<?= $constancia->CONSTANCIAEXTRAVIOID ?>" hidden>
													<input type="text" class="form-control" id="year" name="year" value="<?= $constancia->ANO ?>" hidden>
													<button type="submit" class="btn btn-primary mb-0 mb-sm-3">
														XML
													</button>
												</form>
											</td>
										<?php } ?>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php if (session()->getFlashdata('message_error')) : ?>
	<script>
		Swal.fire({
			icon: 'error',
			html: '<strong><?= session()->getFlashdata('message') ?></strong>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<?php if (session()->getFlashdata('message_success')) : ?>
	<script>
		Swal.fire({
			icon: 'success',
			html: '<strong><?= session()->getFlashdata('message_success') ?></strong>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<?php if (session()->getFlashdata('message_warning')) : ?>
	<script>
		Swal.fire({
			icon: 'warning',
			html: '<strong><?= session()->getFlashdata('message_warning') ?></strong>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<script>
	$(function() {
		$("#extravios_abiertos").DataTable({
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
