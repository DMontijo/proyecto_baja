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
									<th class="text-center">VIDEO</th>
									<!-- <th></th> -->
								</tr>
							</thead>
							<tbody>
								<?php foreach ($body_data as $index => $folio) { ?>
									<tr>
										<td class="text-center"><?= $folio->FOLIOID ?></td>
										<td class="text-center"><?= $folio->FECHAREGISTRO ?></td>
										<td class="text-center"><?= $folio->EXPEDIENTEID ?></td>
										<td class="text-center"><?= $folio->DELITODENUNCIA ?></td>
										<td class="text-center"><?= $folio->STATUS ?></td>
										<td class="text-center"><button type="button" class="btn btn-primary" onclick="viewVideo(<?= $folio->FOLIOID ?>)"><i class="fas fa-video"></i></button></td>
										<!-- <td><button type="button" class="btn btn-primary"><i class="fas fa-eye"></i></button></td> -->
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
			"responsive": false,
			"lengthChange": false,
			"autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print", ]
		}).buttons().container().appendTo('#videollamadasA_wrapper .col-md-6:eq(0)');
	});
</script>
<script>
	function viewVideo(folio) {
		$.ajax({
			data: {
				'folio': folio
			},
			url: "<?= base_url('/data/get-video-link') ?>",
			method: "POST",
			dataType: "json",
		}).done(function(data) {
			let grabacion = "";
			let enlace = 'https://yocontigo-videodenuncias-video.s3.amazonaws.com/'
			if (data.data.length > 0) {
				console.log(data);
				data.data.forEach(element => {
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
