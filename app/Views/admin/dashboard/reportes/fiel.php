<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<?php helper('fiel_helper'); ?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center mb-4">
				<h1 class="mb-4 text-center font-weight-bold">FIEL DE USUARIOS</h1>
				<a class="link link-primary" href="<?= base_url('admin/dashboard/reportes') ?>" role="button"><i class="fas fa-reply"></i> REGRESAR A REPORTES</a>
			</div>
			<div class="col-12">
				<div class="card shadow border-0">
					<div class="card-body">
						<div class="row" style="font-size:10px!important;">
							<div class="col-12" style="overflow:auto;">
								<table id="usuarios_fiel" class="table table-bordered table-striped table-sm">
									<thead>
										<tr>
											<th class="text-center">ROL</th>
											<th class="text-center">NOMBRE</th>
											<th class="text-center">TIENE FIEL</th>
											<th class="text-center">VIGENCIA</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($body_data->usuario as $index => $user) { ?>
											<?php
											helper('fiel_helper');
											$user_id = $user->ID;
											$directory = FCPATH . 'uploads/FIEL/' . $user_id;
											$file_key = $user_id . '_key.key';
											$file_cer = $user_id . '_cer.cer';
											$file_text = $user_id . "_data.txt";
											?>
											<tr>
												<td class="text-center"><?= $user->NOMBRE_ROL ?></td>
												<td class="text-center"><?= $user->NOMBRE ?> <?= $user->APELLIDO_PATERNO ?>
													<?= $user->APELLIDO_MATERNO ?></td>
												</td>

												<?php
												$user_id = $user->ID;
												$directory = FCPATH . 'uploads/FIEL/' . $user_id;
												$file_key = $user_id . '_key.key';
												$file_cer = $user_id . '_cer.cer';
												?>
												<?php if (file_exists($directory . '/' . $file_key) && file_exists($directory . '/' . $file_cer)) { ?>
													<td class="text-center font-weight-bold">SI</td>
												<?php } else { ?>
													<td class="text-center">NO</td>
												<?php } ?>
												<?php if (file_exists($directory . '/' . $file_key) && file_exists($directory . '/' . $file_cer)) : ?>
												<?php else : ?>
												<?php endif; ?>
												<?php if (file_exists($directory . '/' . $file_key) && file_exists($directory . '/' . $file_cer)) { ?>
													<?php if (file_exists($directory . '/' . $file_text)) { ?>
														<?php $validacion = (object)validarFiel($user_id);
														if ($validacion->valida) { ?>
															<?php if ($validacion->restante >= 60) { ?>
																<td class="text-center font-weight-bold bg-success">DÍAS
																	RESTANTES:
																	<?= $validacion->restante ?>
																</td>
															<?php } else { ?>
																<td class="text-center font-weight-bold bg-warning">DÍAS RESTANTES:
																	<?= $validacion->restante ?>
																</td>
															<?php } ?>
														<?php } else { ?>
															<td class="text-center font-weight-bold bg-danger">FIEL INVÁLIDA</td>
														<?php } ?>
													<?php } else { ?>
														<td class="text-center font-weight-bold bg-warning">NO SE PUEDE VALIDAR VIGENCIA
														</td>
													<?php } ?>
												<?php } else { ?>
													<td class="text-center font-weight-bold">-</td>
												<?php } ?>
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

<?php if (session()->getFlashdata('message_error')) : ?>
	<script>
		Swal.fire({
			icon: 'error',
			html: '<strong><?= session()->getFlashdata('message') ?></strong>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<?php if (session()->getFlashdata('message_success')) : ?>
	<script>
		Swal.fire({
			icon: 'success',
			html: '<strong><?= session()->getFlashdata('message_success') ?></strong>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<?php if (session()->getFlashdata('message_warning')) : ?>
	<script>
		Swal.fire({
			icon: 'warning',
			html: '<strong><?= session()->getFlashdata('message_warning') ?></strong>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<script>
	$(function() {
		$("#usuarios_fiel").DataTable({
			responsive: false,
			lengthChange: false,
			autoWidth: true,
			ordering: true,
			order: [
				[2, 'desc'],
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
	function collapse_filter() {
		if (document.querySelector('#filtros').classList.contains('show')) {
			document.querySelector('#filtros').classList.remove('show');
		} else {
			document.querySelector('#filtros').classList.add('show');
		}
	}
</script>
<?php if (isset($body_data->filterParams)) { ?>
	<script>
		let form = document.querySelector('#formExcel');

		form.addEventListener('submit', function(event) {
			event.preventDefault();
			text = `
			<p>
				El reporte sera generado de acuerdo a la siguiente información<br>
				<ul style="text-align:left;">
						<li><span style="font-weight:bold;">Municipio:</span> <?= isset($body_data->filterParams->MUNICIPIONOMBRE) ? $body_data->filterParams->MUNICIPIONOMBRE : '' ?></li>
						<li><span style="font-weight:bold;">Agente:</span> <?= isset($body_data->filterParams->AGENTENOMBRE) ? $body_data->filterParams->AGENTENOMBRE : '' ?></li>
						<li><span style="font-weight:bold;">Fecha inicio:</span> <?= isset($body_data->filterParams->fechaInicio) ? $body_data->filterParams->fechaInicio : '' ?></li>
						<li><span style="font-weight:bold;">Fecha cierre:</span> <?= isset($body_data->filterParams->fechaFin) ? $body_data->filterParams->fechaFin : '' ?></li>
						<li><span style="font-weight:bold;">Hora inicio:</span> <?= isset($body_data->filterParams->horaInicio) ? $body_data->filterParams->horaInicio : '' ?></li>
						<li><span style="font-weight:bold;">Hora fin:</span> <?= isset($body_data->filterParams->horaFin) ? $body_data->filterParams->horaFin : '' ?></li>
						<li><span style="font-weight:bold;">Estatus:</span> <?= isset($body_data->filterParams->STATUS) ? $body_data->filterParams->STATUS : '' ?></li>
				</ul>
			</p>
			`
			Swal.fire({
				icon: 'question',
				html: text,
				showCancelButton: true,
				cancelButtonText: 'No generar',
				confirmButtonColor: '#bf9b55',
				confirmButtonText: 'Generar excel',
			}).then((result) => {
				if (result.isConfirmed) {
					form.submit();
				} else if (result.isDenied) {

				}
			})
		});
	</script>
	<script>
		$(document).on('change', '#status', function() {
			var fechaFin = document.getElementById('fechaFin');
			var horaFin = document.getElementById('horaFin');

			var seleccion = $(this).val();
			switch (seleccion) {
				case 'ABIERTO':
					fechaFin.disabled = true;
					horaFin.disabled = true;

					break;
				case 'FIRMADO':
					fechaFin.disabled = false;
					horaFin.disabled = false;
					break;

			}
		});
	</script>
<?php } ?>

<?= $this->endSection() ?>
