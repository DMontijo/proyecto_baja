<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center mb-4">
				<h1 class="mb-4 text-center font-weight-bold">FOLIOS EN PROCESO</h1>
				<a class="link link-primary" href="<?= base_url('admin/dashboard/folios') ?>" role="button"><i class="fas fa-reply"></i> REGRESAR A FOLIOS</a>
			</div>
			<div class="col-12">
				<div class="card shadow border-0">
					<div class="card-body">
						<table id="folios_sin_firma" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th class="text-center">FOLIO</th>
									<th class="text-center">DELITO</th>
									<th class="text-center">EN ATENCION POR</th>
									<th class="text-center"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($body_data as $index => $folio) { ?>
									<tr>
										<td class="text-center"><?= $folio->FOLIOID ?></td>
										<td class="text-center"><?= $folio->HECHODELITO ?></td>
										<td class="text-center"><?= $folio->NOMBRE ?> <?= $folio->APELLIDO_PATERNO ?> <?= $folio->APELLIDO_MATERNO ?></td>
										<td class="text-center">
											<form id="<?= 'form_' . $folio->FOLIOID ?>" action="<?= base_url('admin/dashboard/liberar_folio') ?>" method="POST">
												<input type="text" name="folio" value="<?= $folio->FOLIOID ?>" hidden>
												<input type="text" name="year" value="<?= $folio->ANO ?>" hidden>
												<button type="submit" class="btn btn-primary">LIBERAR</button>
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
			responsive: false,
			lengthChange: true,
			autoWidth: false,
			ordering: true,
			language: {
				url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
			}
		}).buttons().container().appendTo('#videollamadasA_wrapper .col-md-6:eq(0)');
	});
</script>

<?= $this->endSection() ?>
