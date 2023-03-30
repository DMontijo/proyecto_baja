<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center mb-4">
				<h1 class="mb-4 text-center font-weight-bold">VIDEOS DE EXPEDIENTES</h1>
			</div>
			<div class="col-12">
				<div class="card shadow border-0" style="overflow-x:auto;">
					<div class="card-body">
						<table id="folios_expediente" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th class="text-center">TIPO</th>
									<th class="text-center" style="min-width:150px;">EXPEDIENTE</th>
									<th class="text-center">OFENDIDO</th>
									<th class="text-center">IMPUTADO</th>
									<th class="text-center">ATENDIDO POR</th>
									<th class="text-center">VIDEO</th>
								
								</tr>
							</thead>
							<tbody>
								<?php foreach ($body_data->folio as $index => $folio) 
								{
									$expedienteid = '';
									if (isset($folio->EXPEDIENTEID)) {
										$arrayExpediente = str_split($folio->EXPEDIENTEID);
										$expedienteid =  $arrayExpediente[1] . $arrayExpediente[2] . $arrayExpediente[4] . $arrayExpediente[5] . '-' . $arrayExpediente[6] . $arrayExpediente[7] . $arrayExpediente[8] . $arrayExpediente[9] . '-' . $arrayExpediente[10] . $arrayExpediente[11] . $arrayExpediente[12] . $arrayExpediente[13] . $arrayExpediente[14];
									} ?>
									<tr>
										<td class="text-center"><?= $folio->TIPOEXPEDIENTECLAVE ?></td>

										<td class="text-center"><?= $expedienteid ? $expedienteid : '' ?></td>
										<td class="text-center"><?= isset($folio->OFENDIDO)?$folio->OFENDIDO:'' ?></td>

										<td class="text-center"><?= isset($folio->IMPUTADO_NOMBRE)?$folio->IMPUTADO_NOMBRE:'' ?></td>

										<td class="text-center"><?= $folio->NOMBRE ?> <?= $folio->APELLIDO_PATERNO ?> <?= $folio->APELLIDO_MATERNO ?></td>
										<td class="text-center"><button type="button" class="btn btn-primary" onclick="viewVideo(<?= $folio->ANO ?>,<?= $folio->FOLIOID ?>)"><i class="fas fa-video"></i></button></td>
									</tr>
								<?php }?>
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
		$("#folios_expediente").DataTable({
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
<script>
	function viewVideo(year, folio) {
		data = {
			'folio': year + '-' + folio,
			'min': '2000-01-01',
			'max': '<?= date("Y-m-d") ?>'
		};
		console.log(data);

		$.ajax({
				data: data,
				url: "<?= base_url('/data/get-video-link') ?>",
				method: "POST",
				dataType: "json",
				success: function(response) {
					console.log(response);
				}
				});
		
	}
</script>

<?= $this->endSection() ?>
