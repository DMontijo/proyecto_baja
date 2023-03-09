<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center mb-4">
				<h1 class="mb-4 text-center font-weight-bold">FOLIOS ABIERTOS</h1>
				<a class="link link-primary" href="<?= base_url('admin/dashboard/folios') ?>" role="button"><i class="fas fa-reply"></i> REGRESAR A FOLIOS</a>
			</div>
			<div class="col-12">
				<div class="card shadow border-0" style="overflow-x:auto;">
					<div class="card-body">
						<table id="folios_abiertos" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th class="text-center">FOLIO</th>
									<th class="text-center">FECHA</th>
									<th class="text-center">DELITO</th>
									<th class="text-center">DENUNCIANTE</th>
									<th class="text-center">ESTADO</th>
									<th class="text-center"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($body_data->folio as $index => $folio) { ?>
									<tr>
										<td class="text-center"><?= $folio->FOLIOID ?></td>
										<td class="text-center"><?= date('d-m-Y',strtotime($folio->FECHAREGISTRO)) ?></td>
										<td class="text-center"><?= $folio->HECHODELITO ?></td>
										<td class="text-center"><?= $folio->NOMBRE ?> <?= $folio->APELLIDO_PATERNO ?> <?= $folio->APELLIDO_MATERNO ? $folio->APELLIDO_MATERNO : '' ?></td>
										<td class="text-center"><?= $folio->STATUS ?></td>
										<td class="text-center"><a type="button" href="<?= base_url('/admin/dashboard/video-denuncia?folio=') . $folio->FOLIOID ?>" class="btn btn-primary text-white"><i class="fas fa-eye"></i></a></td>
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
		$("#folios_abiertos").DataTable({
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
