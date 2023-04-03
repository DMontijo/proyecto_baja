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
									<th class="text-center" style="min-width:150px;">EXPEDIENTE</th>
									<th class="text-center">OFENDIDO</th>
									<th class="text-center">IMPUTADO</th>
									<th class="text-center">ATENDIDO POR</th>
									<th class="text-center">VIDEOS</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($body_data->folio as $index => $folio) {
									$expedienteid = '';
									if (isset($folio->EXPEDIENTEID)) {
										$arrayExpediente = str_split($folio->EXPEDIENTEID);
										$expedienteid =  $arrayExpediente[1] . $arrayExpediente[2] . $arrayExpediente[4] . $arrayExpediente[5] . '-' . $arrayExpediente[6] . $arrayExpediente[7] . $arrayExpediente[8] . $arrayExpediente[9] . '-' . $arrayExpediente[10] . $arrayExpediente[11] . $arrayExpediente[12] . $arrayExpediente[13] . $arrayExpediente[14];
									} ?>
									<tr>
										<td class="text-center"><?= ($expedienteid ? $expedienteid : '') . '/' . $folio->TIPOEXPEDIENTECLAVE ?></td>
										<td class="text-center"><?= isset($folio->OFENDIDO) ? $folio->OFENDIDO : '' ?></td>
										<td class="text-center"><?= isset($folio->IMPUTADO_NOMBRE) ? $folio->IMPUTADO_NOMBRE : '' ?></td>
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


<div class="modal fade shadow" id="videos_expediente_modal" tabindex="-1" role="dialog" aria-labelledby="videosModalLabel" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-dialog-centered mw-100 w-75">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-primary justify-content-center">
				<h5 class="modal-title font-weight-bold text-white">VIDEOS DEL EXPEDIENTE REGISTRADOS</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>

			</div>

			<div class="modal-body text-center" id="">
				<div class="table-responsive">
					<table id="table-videos" class="table table-bordered table-hover table-striped table-light">
						<tr>
							<th class="text-center bg-primary text-white">VIDEO</th>
							<th class="text-center bg-primary text-white">MARCA DE TIEMPO</th>

						</tr>
					</table>
				</div>

			</div>
		</div>
	</div>
</div>

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
	var tabla_videos = document.getElementById('table-videos').innerHTML;

	function viewVideo(year, folio) {
		data = {
			'folio': year + '-' + folio,

		};
		$.ajax({
			data: data,
			url: "<?= base_url('/data/get-video-link') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				const videos = response.responseVideos;
				const marcas = response.marcasVideo;
				console.log(videos);
				console.log(marcas);
				llenarTablaVideos(videos, marcas);
				$('#videos_expediente_modal').modal('show');
			}
		});

	}

	function llenarTablaVideos(videos, marcas) {
		for (let i = 0; i < videos.length; i++) {
			if (videos[i].uri != null) {
				marcasVideoArray = [];
				if (videos[i].id == marcas.id) {
					let marcasVideo = marcas.recordingMarks;
					marcas.recordingMarks.forEach(marcas => {
						if (marcas.messageText != null) {
							marcasVideoArray += marcas.markTime + ' ' + marcas.messageText + `<br>`;
						}
					});
				}
				var fila =
					`<tr id="row${i}">` +
					`<td class="text-center" value="" style="max-width:30vw;"><video src="${videos[i].url}" width="100%" height="100%" controls></video></td>` +
					`<td class="text-center" value="">${marcasVideoArray}</td>` +
					`</tr>`;

				$('#table-videos tr:first').after(fila);
				$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
				var nFilas = $("#archvideosivos tr").length;
				$("#adicionados").append(nFilas - 1);
			}


		}
	}

	$('#videos_expediente_modal').on('hidden.bs.modal', function() {
		document.getElementById('table-videos').innerHTML = tabla_videos
	});
</script>

<?= $this->endSection() ?>
