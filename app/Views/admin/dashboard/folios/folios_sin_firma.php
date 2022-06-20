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
									<th>FOLIO</th>
									<th>EXPEDIENTE</th>
									<th>FECHA</th>
									<th>DELITO</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($body_data as $index => $folio) { ?>
									<tr>
										<td><?= $folio->FOLIOID ?></td>
										<td><?= $folio->EXPEDIENTEID ?></td>
										<td><?= $folio->FECHAREGISTRO ?></td>
										<td><?= $folio->DELITODENUNCIA ?></td>
										<td>
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
