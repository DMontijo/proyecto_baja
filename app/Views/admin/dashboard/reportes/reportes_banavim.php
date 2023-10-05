<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center mb-4">
				<h1 class="mb-4 text-center font-weight-bold">REPORTE BANAVIM</h1>
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
										<form action="<?= base_url() ?>/admin/dashboard/reportes_banavim" method="post" enctype="multipart/form-data" class="row needs-validation" novalidate>
											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="municipio" class="form-label font-weight-bold">Municipio:</label>
												<select class="form-control" id="municipio" name="municipio" required>
													<option selected value="">Todos los municipios</option>
													<?php foreach ($body_data->municipios as $index => $municipio) { ?>
														<option <?= isset($body_data->filterParams->MUNICIPIOID) ? ($body_data->filterParams->MUNICIPIOID == $municipio->MUNICIPIOID ? 'selected' : '') : null ?> value="<?= $municipio->MUNICIPIOID ?>"> <?= $municipio->MUNICIPIODESCR ?> </option>
													<?php } ?>
												</select>
											</div>

											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="agente" class="form-label font-weight-bold">Agente que atiende:</label>
												<select class="form-control" id="agente" name="agente" required>
													<option selected value="">Todos los agentes</option>
													<?php foreach ($body_data->empleados as $index => $empleado) { ?>
														<option <?= isset($body_data->filterParams->AGENTEATENCIONID) ? ($body_data->filterParams->AGENTEATENCIONID == $empleado->ID ? 'selected' : '') : null ?> value="<?= $empleado->ID ?>"> <?= $empleado->NOMBRE . ' ' . $empleado->APELLIDO_PATERNO . ' ' . $empleado->APELLIDO_MATERNO ?> </option>
													<?php } ?>
												</select>
											</div>
											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="tipo_orden" class="form-label font-weight-bold">Tipo orden de protección:</label>
												<select class="form-control" id="tipo_orden" name="tipo_orden" required>
													<option selected value="">Todos los tipos</option>
													<?php foreach ($body_data->tiposOrden as $index => $tipoOrden) { ?>
														<option <?= isset($body_data->filterParams->TIPOORDEN) ? ($body_data->filterParams->TIPOORDEN == $tipoOrden->TITULO ? 'selected' : '') : null ?> value="<?= $tipoOrden->TITULO ?>"><?= $tipoOrden->TITULO ?></option>
													<?php } ?>
												</select>
											</div>

											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="fechaInicio" class="form-label font-weight-bold">Fecha de inicio:</label>
												<input type="date" class="form-control" id="fechaInicio" name="fechaInicio" max="<?= date("Y-m-d") ?>" value="<?= isset($body_data->filterParams->fechaInicio) ? $body_data->filterParams->fechaInicio : '' ?>">
											</div>

											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="fecha" class="form-label font-weight-bold">Fecha de cierre:</label>
												<input type="date" class="form-control" id="fechaFin" name="fechaFin" max="<?= date("Y-m-d") ?>" value="<?= isset($body_data->filterParams->fechaFin) ? $body_data->filterParams->fechaFin : '' ?>">
											</div>

											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="hora" class="form-label font-weight-bold">Hora de inicio:</label>
												<input type="time" class="form-control" id="horaInicio" name="horaInicio" value="<?= isset($body_data->filterParams->horaInicio) ? $body_data->filterParams->horaInicio : '' ?>">
											</div>

											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="hora" class="form-label font-weight-bold">Hora de cierre:</label>
												<input type="time" class="form-control" id="horaFin" name="horaFin" value="<?= isset($body_data->filterParams->horaFin) ? $body_data->filterParams->horaFin : '' ?>">
											</div>
											<div class="col-12 text-right">
												<a href="<?= base_url('admin/dashboard/reporte_banavim') ?>" class="btn btn-secondary font-weight-bold" id="btnFiltroFolio" name="btnFiltroFolio">Borrar filtro</a>
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
					<div class="card-body">
						<div class="row mb-3">
							<div class="col-12 text-right">

								<?php if (isset($body_data->filterParams)) { ?>
									<!-- Form para aplicar mismo filtro utilizado para crear el archivo de excel-->
									<form id="formExcel" action="<?= base_url() ?>/admin/dashboard/generar_excel_banavim" method="post" class="needs-validation" novalidate>
										<?php foreach ($body_data->filterParams as $index => $value) { ?>
											<input type="hidden" id="<?= $index ?>" name="<?= $index ?>" value="<?= $value ?>">
										<?php } ?>
										<div class="col-12 text-right p-0 pb-2">
											<button type="submit" class="btn btn-success font-weight-bold" id="btnExcel" name="btnExcel">Exportar a excel</button>
										</div>
									</form>
								<?php } ?>
							</div>
							<div class="col-12" style="overflow-x:auto;">
								<table id="banavim" class="table table-bordered table-striped table-sm" style="font-size:10px;">
									<thead>
										<tr>
											<th class="text-center">FOLIO</th>
											<th class="text-center">FECHA DE EXPEDICIÓN</th>
											<th class="text-center" style="min-width:100px;">NO. EXPEDIENTE</th>
											<th class="text-center">MODULO QUE EXPIDE</th>
											<th class="text-center">MUNICIPIO QUE ATIENDE</th>
											<th class="text-center" style="min-width:150px;">SERVIDOR PUBLICO SOLICITANTE</th>
											<th class="text-center">DELITO</th>
											<th class="text-center">TIPO ORDEN DE PROTECCIÓN</th>
											<th class="text-center">VICTIMA/OFENDIDO</th>
											<th class="text-center">EDAD</th>
											<th class="text-center">¿VICTIMA LESIONADA?</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($body_data->dataOrdenes as $index => $banavim) {
											$arrayExpediente = str_split($banavim->EXPEDIENTEID);
											$expedienteid = $arrayExpediente[1] . $arrayExpediente[2] . $arrayExpediente[4] . $arrayExpediente[5] . '-' . $arrayExpediente[6] . $arrayExpediente[7] . $arrayExpediente[8] . $arrayExpediente[9] . '-' . $arrayExpediente[10] . $arrayExpediente[11] . $arrayExpediente[12] . $arrayExpediente[13] . $arrayExpediente[14];
										?>
											<tr>
												<td class="text-center font-weight-bold"><?= $banavim->FOLIOID . '/' . $banavim->ANO ?></td>
												<td class="text-center"><?= $banavim->FECHAFIRMA ?  date("d/m/Y", strtotime($banavim->FECHAFIRMA)) : '' ?></td>
												<td class="text-center font-weight-bold"><?= $expedienteid ? $expedienteid . '/' . $banavim->TIPOEXPEDIENTECLAVE: '' ?></td>
												<td class="text-center">CENTRO DE DENUNCIA TECNÓLOGICA</td>
												<td class="text-center"><?= $banavim->MUNICIPIODESCR ?></td>
												<td class="text-center"><?= $banavim->NOMBRE_MP ?></td>
												<td class="text-center"><?= $banavim->DELITOMODALIDADDESCR ?></td>
												<td class="text-center"><?= $banavim->TIPODOC ?></td>
												<td class="text-center"><?= $banavim->NOMBRE_VTM ?></td>
												<td class="text-center"><?= $banavim->EDADCANTIDAD ? $banavim->EDADCANTIDAD . " AÑOS" : "" ?></td>
												<td class="text-center"><?= $banavim->LESIONES ?></td>

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
		$("#banavim").DataTable({
			responsive: false,
			lengthChange: false,
			autoWidth: true,
			ordering: true,
			order: [
				// [0, 'asc'],
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
						<li><span style="font-weight:bold;">Municipio:</span> <?= isset($body_data->filterParams->MUNICIPIONOMBRE) ? $body_data->filterParams->MUNICIPIONOMBRE : '' ?></li>
						<li><span style="font-weight:bold;">Agente que atiende:</span> <?= isset($body_data->filterParams->AGENTENOMBRE) ? $body_data->filterParams->AGENTENOMBRE : '' ?></li>
						<li><span style="font-weight:bold;">Fecha inicio:</span> <?= isset($body_data->filterParams->fechaInicio) ? $body_data->filterParams->fechaInicio : '' ?></li>
						<li><span style="font-weight:bold;">Fecha cierre:</span> <?= isset($body_data->filterParams->fechaFin) ? $body_data->filterParams->fechaFin : '' ?></li>
						<li><span style="font-weight:bold;">Hora inicio:</span> <?= isset($body_data->filterParams->horaInicio) ? $body_data->filterParams->horaInicio : '' ?></li>
						<li><span style="font-weight:bold;">Hora fin:</span> <?= isset($body_data->filterParams->horaFin) ? $body_data->filterParams->horaFin : '' ?></li>
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