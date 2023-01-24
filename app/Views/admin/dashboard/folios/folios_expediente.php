<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center mb-4">
				<h1 class="mb-4 text-center font-weight-bold">FOLIOS CON EXPEDIENTE</h1>
				<a class="link link-primary" href="<?= base_url('admin/dashboard/folios') ?>" role="button"><i class="fas fa-reply"></i> REGRESAR A FOLIOS</a>
			</div>
			<div class="col-12">
				<div class="card shadow border-0" style="overflow-x:auto;">
					<div class="card-body">
						<table id="folios_expediente" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th class="text-center">FOLIO</th>
									<th class="text-center">FECHA FOLIO</th>
									<th class="text-center">EXPEDIENTE</th>
									<th class="text-center">DELITO</th>
									<th class="text-center">ESTADO</th>
									<th class="text-center">ÁREA ASIGNADA</th>
									<th class="text-center">ATENDIDO POR</th>
									<th class="text-center">VIDEO</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($body_data->folio as $index => $folio) {
									$expedienteid = '';
									if (isset($folio->EXPEDIENTEID)) {
										$arrayExpediente = str_split($folio->EXPEDIENTEID);
										$expedienteid = $arrayExpediente[0] . '-' . $arrayExpediente[1] . $arrayExpediente[2] . '-' .  $arrayExpediente[3] . $arrayExpediente[4] . $arrayExpediente[5] . '-' . $arrayExpediente[6] . $arrayExpediente[7] . $arrayExpediente[8] . $arrayExpediente[9] . '-' . $arrayExpediente[10] . $arrayExpediente[11] . $arrayExpediente[12] . $arrayExpediente[13] . $arrayExpediente[14];
									} ?>

									<tr>
										<td class="text-center"><?= $folio->FOLIOID ?></td>
										<td class="text-center"><?= $folio->FECHAREGISTRO ?></td>
										<td class="text-center"><?= $expedienteid ? $expedienteid : '' ?></td>
										<td class="text-center"><?= $folio->HECHODELITO ?></td>
										<td class="text-center"><?= $folio->STATUS . ' ' . $folio->TIPOEXPEDIENTEDESCR ?></td>
										<td class="text-center"><?= $folio->AREADESCR ?></td>

										<td class="text-center"><?= $folio->NOMBRE ?> <?= $folio->APELLIDO_PATERNO ?> <?= $folio->APELLIDO_MATERNO ?></td>
										<td class="text-center"><button type="button" class="btn btn-primary" onclick="viewVideo(<?= $folio->ANO ?>,<?= $folio->FOLIOID ?>)"><i class="fas fa-video"></i></button></td>
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
		}).done(function(data) {
			let grabacion = "";
			let enlace = 'https://fgebc-records.s3.amazonaws.com/'
			if (data.data.length > 0) {
				array = data.data.reverse();
				array.forEach(element => {
					if (element.Grabación != '') {
						grabacion = element.Grabación
					}
				});
				if (grabacion == '') {
					Swal.fire({
						icon: 'error',
						title: 'No hay video grabado',
						confirmButtonColor: '#bf9b55',
					})
				} else {
					window.open(enlace + grabacion, "_blank");
				}
			} else {
				Swal.fire({
					icon: 'error',
					title: 'No hay video grabado',
					confirmButtonColor: '#bf9b55',
				})
			}
		}).fail(function(jqXHR, textStatus) {
			Swal.fire({
				icon: 'error',
				title: 'Hubo un error',
				text: 'Contácte con soporte técnico',
				confirmButtonColor: '#bf9b55',
			})
		});
	}
</script>

<?= $this->endSection() ?>
