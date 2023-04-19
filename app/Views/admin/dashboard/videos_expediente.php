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
				<div class="card shadow border-0">
					<div class="card-body">
						<div class="row">
							<div class="col-12" style="overflow-x:auto;">
								<table id="folios_expediente" class="table table-bordered table-striped table-sm" style="font-size:12px;">
									<thead>
										<tr>
											<th class="text-center">FOLIO</th>
											<th class="text-center">AÑO</th>
											<th class="text-center" style="min-width:150px;">EXPEDIENTE</th>
											<th class="text-center" style="min-width:150px;">DELITO</th>
											<th class="text-center" style="min-width:150px;">OFENDIDO</th>
											<th class="text-center" style="min-width:150px;">IMPUTADO</th>
											<th class="text-center" style="min-width:150px;">ATENDIDO POR</th>
											<th class="text-center" style="min-width:150px;">FECHA REGISTRO</th>
											<th class="text-center" style="min-width:150px;">FECHA SALIDA</th>
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
												<td class="text-center font-weight-bold"><?= $folio->FOLIOID ?></td>
												<td class="text-center font-weight-bold"><?= $folio->ANO ?></td>
												<td class="text-center font-weight-bold"><?= ($expedienteid ? $expedienteid : '') . '/' . $folio->TIPOEXPEDIENTECLAVE ?></td>
												<td class="text-center"><?= $folio->DELITOMODALIDADDESCR ?></td>
												<td class="text-center"><?= isset($folio->OFENDIDOS) ? $folio->OFENDIDOS : '' ?></td>
												<td class="text-center"><?= isset($folio->IMPUTADOS) ? $folio->IMPUTADOS : '' ?></td>
												<td class="text-center"><?= $folio->NOMBREAGENTE ?></td>
												<td class="text-center"><?= date('d-m-Y H:i:s', strtotime($folio->FECHAREGISTRO)) ?></td>
												<td class="text-center"><?= date('d-m-Y H:i:s', strtotime($folio->FECHASALIDA)) ?></td>

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
		</div>
	</div>
</section>


<div class="modal fade shadow" id="videos_expediente_modal" tabindex="-1" role="dialog" aria-labelledby="videosModalLabel" aria-hidden="true" data-backdrop="true">
	<div class="modal-dialog modal-dialog-centered mw-100 w-50">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-primary justify-content-center">
				<h5 class="modal-title font-weight-bold text-white">VIDEOS DEL EXPEDIENTE REGISTRADOS</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body text-center" id="">
				<div class="row" id="videos_expediente_spinner">
					<div class="col-12">
						<div class="spinner-border text-primary" role="status">
							<span class="sr-only">Cargando...</span>
						</div>
						<p>CARGANDO ...</p>
					</div>
				</div>
				<div class="row d-none" id="videos_expediente_empty">
					<div class="col-12">
						<p class="text-primary">
							No hay videos grabados en este expediente.
						</p>
					</div>
				</div>
				<div class="table-responsive">
					<table id="table-videos" class="table table-bordered table-hover table-striped table-light d-none">
						<tr>
							<th class="text-center bg-primary text-white">VIDEO</th>
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
				[0, 'desc'],
				[1, 'desc'],
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
			'folio': folio + '/' + year,
		};
		$('#videos_expediente_modal').modal('show');
		document.getElementById('videos_expediente_spinner').classList.remove('d-none');
		document.getElementById('videos_expediente_empty').classList.add('d-none');
		document.getElementById('table-videos').classList.add('d-none');
		clearTablaVideos();
		$.ajax({
			data: data,
			url: "<?= base_url('/data/get-video-link') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				let videos = response.responseVideos.filter(video => video.url);
				if (videos.length > 0) {
					llenarTablaVideos(videos);
					document.getElementById('videos_expediente_spinner').classList.add('d-none');
					document.getElementById('videos_expediente_empty').classList.add('d-none');
					document.getElementById('table-videos').classList.remove('d-none');
				} else {
					document.getElementById('videos_expediente_spinner').classList.add('d-none');
					document.getElementById('videos_expediente_empty').classList.remove('d-none');
					document.getElementById('table-videos').classList.add('d-none');
				}
			}
		});

	}

	function llenarTablaVideos(videos) {
		for (let i = 0; i < videos.length; i++) {
			if (videos[i].url != null) {
				var fila =
					`<tr id="row${i}">` +
					`<td class="text-center" value="" style="max-width:30vw;">
						<video src="${videos[i].url}" width="100%" height="100%" controls controlsList="nodownload"></video>
					</td>` +
					`</tr>`;
				$('#table-videos tr:first').after(fila);
				$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
				var nFilas = $("#archvideosivos tr").length;
				$("#adicionados").append(nFilas - 1);
			}
		}
	}

	function clearTablaVideos() {
		let tabla_videos = document.querySelectorAll('#table-videos tr');
		tabla_videos.forEach(row => {
			if (row.id !== '') {
				row.remove();
			}
		});
	}

	$('#videos_expediente_modal').on('hidden.bs.modal', function() {
		document.getElementById('table-videos').innerHTML = tabla_videos
	});
</script>

<?= $this->endSection() ?>
