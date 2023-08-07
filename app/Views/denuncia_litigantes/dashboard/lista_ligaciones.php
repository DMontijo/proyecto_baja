	<?= $this->extend('denuncia_litigantes/templates/dashboard_template') ?>

	<?= $this->section('title') ?>
	<?php echo $header_data->title ?>
	<?= $this->endSection() ?>

	<?= $this->section('content') ?>
	<div class="row" style="min-height:83vh;">
		<div class="col-12">
			<div class="card text-center overflow-auto shadow rounded">
				<div class="card-body p-0 py-3 p-sm-5">
					<h1 class="card-title fw-bold">MIS SOLICITUDES DE LIGACIONES</h1>
					<?php if (count($body_data->ligaciones) > 0) { ?>
						<table class="table table-striped table-hover mt-5">
							<thead>
								<tr>
									<th scope="col">RAZÓN SOCIAL</th>
									<th scope="col">MARCA COMERCIAL</th>
									<th scope="col">RFC</th>
									<th scope="col">VENCIMIENTO DE PODER</th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($body_data->ligaciones as $index => $ligar) { ?>
									<tr>
										<th scope="row"><?= $ligar->RAZONSOCIAL  ?></th>
										<td><?= $ligar->MARCACOMERCIAL ?></td>
										<td><?= $ligar->RFC ?></td>

										<?php if (isset($ligar->FECHAFINPODER)) {
											$date1 = new DateTime($ligar->FECHAFINPODER);
											$date2 = new DateTime(date("Y-m-d"));
											$diff = $date1->diff($date2);
											if (intval($diff->format('%d')) <= 3) { ?>
												<td class="text-center text-danger fw-bold"> <?= intval($diff->format('%d')); ?> DÍAS</td>
											<?php } else { ?>
												<td class="text-center text-success fw-bold"> <?= intval($diff->format('%d')); ?> DÍAS</td>
											<?php } ?>
										<?php } else { ?>
											<td class="text-center">SIN FECHA REGISTRADA</td>
										<?php } ?>
				
									<?php } ?>

									</tr>
							</tbody>
						</table>
					<?php } else { ?>
						<p class="mt-5 text-yellow fw-bolder"> <i class="bi bi-archive"></i> Aún no haz levantado ninguna solicitud de ligación</p>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<?php include('modal_form_ligar_empresa.php') ?>

	<script>
		$('#ligarEmpresaModal').on('show.bs.modal', function(event) {
			var etiqueta = $(event.relatedTarget)
			var personamoralid = etiqueta.data('idpersonamoral');
			var denuncianteid = etiqueta.data('iddenunciante')

			console.log(personamoralid);
			const data = {
				'personamoralid': personamoralid,
				'denuncianteid': denuncianteid,

			};
			$.ajax({
				data: data,
				url: "<?= base_url('/data/getRelacionLitigantes') ?>",
				method: "POST",
				dataType: "json",
				success: function(response) {
					console.log(response);
					if (response.data) {
						const ligadura = response.data;
						document.getElementById("empresa").value = ligadura.PERSONAMORALID;
						document.getElementById("empresa").addEventListener("mousedown", function(event) {
							event.preventDefault();
						});
						document.getElementById("poder_volumen").value = ligadura.PODERVOLUMEN;
						document.getElementById("poder_notario").value = ligadura.PODERNONOTARIO;
						document.getElementById("poder_no_poder").value = ligadura.PODERNOPODER;
						document.getElementById("fecha_inicio_poder").value = ligadura.FECHAINICIOPODER;
						document.getElementById("fecha_fin_poder").value = ligadura.FECHAFINPODER;
						document.getElementById("cargo").value = ligadura.CARGO;
						document.getElementById("descr_cargo").value = ligadura.DESCRIPCIONCARGO;

						document.getElementById("poder_archivo").required = false;
						if (ligadura.PODERARCHIVO) {
							extension = (((ligadura.PODERARCHIVO.split(';'))[0]).split('/'))[1];
							if (extension == 'pdf' || extension == 'doc') {
								document.querySelector('#poder_foto').setAttribute('src', '<?= base_url() ?>/assets/img/file.png');
							} else {
								document.querySelector('#poder_foto').setAttribute('src', ligadura.PODERARCHIVO);
							}
						}
					} else {
						Swal.fire({
							icon: 'error',
							text: 'No se pudo obtener la información',
							confirmButtonColor: '#bf9b55',
						});
						$('#ligarEmpresaModal').modal('hide');

					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(jqXHR, textStatus, errorThrown);
					Swal.fire({
						icon: 'error',
						text: 'No se pudo obtener la información',
						confirmButtonColor: '#bf9b55',
					});
				}
			});
		})
	</script>
	<?= $this->endSection() ?>