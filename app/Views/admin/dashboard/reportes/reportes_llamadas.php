<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center mb-4">
				<h1 class="mb-4 text-center font-weight-bold">REGISTRO DE LLAMADAS</h1>
				<a class="link link-primary" href="<?= base_url('admin/dashboard/reportes') ?>" role="button"><i class="fas fa-reply"></i> REGRESAR A REPORTES</a>
			</div>
			<div class="col-12">
				<div class="card shadow border-0 p-0">
					<div class="card-body">
						<div id="accordion">
							<div class="card m-0">
								<div class="card-header bg-light m-0 p-0" id="headingOne">

									<h3 class="mb-0 p-0">
										<button class="btn btn-link btn-block font-weight-bold text-left p-3 d-flex justify-content-between" onclick="collapse_filter()">
											FILTROS <i class="fas fa-angle-down"></i>
										</button>
									</h3>
								</div>

								<div id="filtros" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
									<div class="card-body">
										<form action="<?= base_url() ?>/admin/dashboard/reporte_llamadas" method="post" enctype="multipart/form-data" class="row needs-validation" novalidate>
											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="agente_registro" class="form-label font-weight-bold">Agente:</label>
												<select class="form-control" id="agenteId" name="agenteId" required>
													<option selected value="">Todos los agentes</option>
													<?php foreach ($body_data->empleados as $index => $empleado) { ?>
														<option <?= isset($body_data->filterParams->agentUuid) ? ($body_data->filterParams->agentUuid == $empleado->ID ? 'selected' : '') : null ?> value="<?= $empleado->ID ?>">
															<?= $empleado->NOMBRE ?>
														</option>
													<?php } ?>
												</select>
											</div>

											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="fecha" class="form-label font-weight-bold">Fecha de inicio:</label>
												<input type="datetime-local" class="form-control" id="fechaInicio" name="fechaInicio" max="<?= date("Y-m-d") ?>" value="<?= isset($body_data->filterParams->sessionStartedAt) ? date('d-m-Y H:i:s', strtotime($body_data->filterParams->sessionStartedAt)) : '' ?>">
											</div>

											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="fecha" class="form-label font-weight-bold">Fecha de cierre:</label>
												<input type="datetime-local" class="form-control" id="fechaFin" name="fechaFin" max="<?= date("Y-m-d") ?>" value="<?= isset($body_data->filterParams->sessionFinishedAt) ? date('d-m-Y H:i:s', strtotime($body_data->filterParams->sessionFinishedAt)) : '' ?>">
											</div>

											<div class="col-12 text-right">
												<a href="<?= base_url('admin/dashboard/reporte_llamadas') ?>" class="btn btn-secondary font-weight-bold" id="btnFiltroFolio" name="btnFiltroFolio">Borrar filtro</a>
												<button type="submit" class="btn btn-primary font-weight-bold" id="btnFiltroFolio" name="btnFiltroFolio">Filtrar</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="card shadow border-0">
					<div class="card-body" style="overflow-x:auto;">
						<div class="row mb-3">
							<div class="col-12 d-flex justify-content-center align-items-center">
								<?php if (isset($body_data->filterParams)) { ?>
									<!-- Form para aplicar mismo filtro utilizado para crear el archivo de excel-->
									<form id="formExcel" action="<?= base_url() ?>/admin/dashboard/generar_excel_llamadas" method="post" enctype="multipart/form-data" class="needs-validation d-inline-block ml-auto" novalidate>
										<?php foreach ($body_data->filterParams as $index => $value) { ?>
											<input type="hidden" id="<?= $index ?>" name="<?= $index ?>" value="<?= $value ?>">
										<?php } ?>
										<button type="submit" class="btn btn-success font-weight-bold" id="btnExcel" name="btnExcel">Exportar reporte a excel</button>
									</form>
								<?php } ?>
							</div>
						</div>
						<div class="row" style="font-size:10px;">
							<div class="col-12" style="overflow:auto;">
								<table id="registro_llamadas" class="table table-bordered table-striped table-sm">
									<thead>
										<tr>
											<th class="text-center">FOLIO</th>
											<th class="text-center">INICIO</th>
											<th class="text-center">FIN</th>
											<th class="text-center">AGENTE</th>
											<th class="text-center">DENUNCIANTE</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($body_data->llamadas as $index => $llamada) { ?>
											<tr>
												<td class="text-center font-weight-bold"><?= $llamada->guestConnectionId->folio ?></td>
												<td class="text-center"><?= date('d-m-Y H:i:s', strtotime($llamada->sessionStartedAt)) ?></td>
												<td class="text-center"><?= $llamada->sessionFinishedAt != null ? date('d-m-Y H:i:s', strtotime($llamada->sessionFinishedAt)) : '-' ?></td>
												<td class="text-center"><?= $llamada->agentConnectionId->agent->fullName ?></td>
												<td class="text-center"><?= $llamada->guestConnectionId->uuid->details->NOMBRE . ' ' . $llamada->guestConnectionId->uuid->details->APELLIDO_PATERNO ?></td>
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

<script>
	$(function() {
		$("#registro_llamadas").DataTable({
			responsive: false,
			lengthChange: false,
			autoWidth: true,
			ordering: true,
			order: [
				[1, 'desc'],
			],
			searching: true,
			pageLength: 25,
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
		//Datos de confirmacion del filtro

		form.addEventListener('submit', function(event) {
			event.preventDefault();
			text = `
			<p>
				El reporte sera generado de acuerdo a la siguiente información<br>
				<ul style="text-align:left;">
						<li><span style="font-weight:bold;">Fecha inicio:</span> <?= isset($body_data->filterParams->sessionStartedAt) ? $body_data->filterParams->sessionStartedAt : '' ?></li>
						<li><span style="font-weight:bold;">Fecha cierra:</span> <?= isset($body_data->filterParams->sessionFinishedAt) ? $body_data->filterParams->sessionFinishedAt : '' ?></li>
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
<?php } ?>
<?= $this->endSection() ?>