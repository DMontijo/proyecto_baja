<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center mb-4">
				<h1 class="mb-4 text-center font-weight-bold">FOLIOS SIN FIRMA</h1>
				<a class="link link-primary" href="<?= base_url('admin/dashboard/folios') ?>" role="button"><i class="fas fa-reply"></i> REGRESAR A FOLIOS</a>
			</div>
			<div class="col-12">
				<div class="card shadow border-0">
					<div class="card-body">
						<table id="folios_sin_firma" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th class="text-center">FOLIO</th>
									<th class="text-center">EXPEDIENTE</th>
									<th class="text-center">FECHA</th>
									<th class="text-center">DELITO</th>
									<th class="text-center">ATENDIDO POR</th>
									<th class="text-center">NOTAS AGENTE</th>
									<th class="text-center"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($body_data as $index => $folio) { ?>
									<tr>
										<td class="text-center"><?= $folio->FOLIOID ?></td>
										<td class="text-center"><?= $folio->EXPEDIENTEID ?></td>
										<td class="text-center"><?= $folio->FECHAREGISTRO ?></td>
										<td class="text-center"><?= $folio->HECHODELITO ?></td>
										<td class="text-center"><?= $folio->NOMBRE ?> <?= $folio->APELLIDO_PATERNO ?> <?= $folio->APELLIDO_MATERNO ?></td>
										<td class="text-center"><?= $folio->NOTASAGENTE ?></td>
										<td class="text-center">
											<form id="<?= 'form_' . $folio->FOLIOID ?>" action="<?= base_url('admin/dashboard/firmar_folio') ?>" method="POST">
												<input type="text" name="folio" value="<?= $folio->FOLIOID ?>" hidden>
												<button type="submit" class="btn btn-primary">FIRMADO</button>
											</form>
										</td>
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
<script>
	$(function() {
		$("#folios_sin_firma").DataTable({
			"responsive": true,
			"lengthChange": false,
			"autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print", ]
		}).buttons().container().appendTo('#videollamadasA_wrapper .col-md-6:eq(0)');
	});
</script>

<?= $this->endSection() ?>
