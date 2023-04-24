<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center mb-4">
				<h1 class="mb-4 text-center font-weight-bold">REGISTRO DE CANALIZACIONES Y DERIVACIONES</h1>
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
										<form action="<?= base_url() ?>/admin/dashboard/registro_candev" method="post" enctype="multipart/form-data" class="row needs-validation" novalidate>
											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="municipio" class="form-label font-weight-bold">Municipio:</label>
												<select class="form-control" id="MUNICIPIOID" name="MUNICIPIOID" required>
													<option selected value="">Todos los municipios</option>
													<?php foreach ($body_data->municipios as $index => $municipio) { ?>
														<option <?= isset($body_data->filterParams->MUNICIPIOID) ? ($body_data->filterParams->MUNICIPIOID == $municipio->MUNICIPIOID ? 'selected' : '') : null ?> value="<?= $municipio->MUNICIPIOID ?>"> <?= $municipio->MUNICIPIODESCR ?> </option>
													<?php } ?>
												</select>
											</div>

											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="agente" class="form-label font-weight-bold">Agente:</label>
												<select class="form-control" id="AGENTEATENCIONID" name="AGENTEATENCIONID" required>
													<option selected value="">Todos los agentes</option>
													<?php foreach ($body_data->empleados as $index => $empleado) { ?>
														<option <?= isset($body_data->filterParams->AGENTEATENCIONID) ? ($body_data->filterParams->AGENTEATENCIONID == $empleado->ID ? 'selected' : '') : null ?> value="<?= $empleado->ID ?>"> <?= $empleado->NOMBRE . ' ' . $empleado->APELLIDO_PATERNO . ' ' . $empleado->APELLIDO_MATERNO ?> </option>
													<?php } ?>
												</select>
											</div>

											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="agente" class="form-label font-weight-bold">Tipo de salida:</label>
												<select class="form-control" id="SALIDA" name="SALIDA" required>
													<?php if (!isset($body_data->filterParams->SALIDA)) { ?>
														<option selected value="">TODOS</option>
														<option value="CANALIZADO">CANALIZACIÓN</option>
														<option value="DERIVADO">DERIVACIÓN</option>
													<?php } else { ?>
														<option <?= ($body_data->filterParams->SALIDA == '' ? 'selected' : '') ?> value="">TODOS</option>
														<option <?= ($body_data->filterParams->SALIDA == 'CANALIZADO' ? 'selected' : '') ?> value="CANALIZADO">CANALIZACIÓN</option>
														<option <?= ($body_data->filterParams->SALIDA == 'DERIVADO' ? 'selected' : '') ?> value="DERIVADO">DERIVACIÓN</option>
													<?php } ?>
												</select>
											</div>

											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="fecha" class="form-label font-weight-bold">Fecha de inicio:</label>
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
												<a href="<?= base_url('admin/dashboard/registro_candev') ?>" class="btn btn-secondary font-weight-bold" id="btnFiltroFolio" name="btnFiltroFolio">Borrar filtro</a>
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
									<form id="formExcel" action="<?= base_url() ?>/admin/dashboard/generar_excel_canadev" method="post" enctype="multipart/form-data" class="needs-validation d-inline-block ml-auto" novalidate>
										<?php foreach ($body_data->filterParams as $index => $value) { ?>
											<input type="hidden" id="<?= $index ?>" name="<?= $index ?>" value="<?= $value ?>">
										<?php } ?>
										<button type="submit" class="btn btn-success font-weight-bold" id="btnExcel" name="btnExcel">Exportar reporte a excel</button>
									</form>
								<?php } ?>
							</div>
						</div>
						<div class="row">
							<div class="col-12" style="overflow-x:auto;">
								<table id="registro_candev" class="table table-bordered table-striped table-sm" style="font-size:12px;">
									<thead>
										<tr>
											<th class="text-center">FOLIO</th>
											<th class="text-center">FECHA DE ATENCIÓN</th>
											<th class="text-center" style="min-width:150px;">EXPEDIENTE</th>
											<th class="text-center" style="min-width:150px;">MODULO QUE EXPIDE</th>
											<th class="text-center" style="min-width:150px;">MUNICIPIO QUE ATIENDE</th>
											<th class="text-center" style="min-width:150px;">SERVIDOR PUBLICO SOLICITANTE</th>
											<th class="text-center" style="min-width:150px;">DELITO</th>
											<th class="text-center" style="min-width:150px;">NOMBRE DE LA VICTIMA/OFENDIDO</th>
											<th class="text-center" style="min-width:150px;">APELLIDO PATERNO</th>
											<th class="text-center" style="min-width:150px;">APELLIDO MATERNO</th>
											<th class="text-center" style="min-width:150px;">SALIDA</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($body_data->dataInfo as $index => $orden) {
											$array = isset($orden->EXPEDIENTEID) ? str_split($orden->EXPEDIENTEID) : '';
										?>
											<tr>
												<td class="text-center font-weight-bold"><?= $orden->FOLIOID ?></td>
												<td class="text-center"><?= date("d/m/Y", strtotime($orden->HECHOFECHA)) ?></td>
												<td class="text-center"><?= isset($orden->EXPEDIENTEID) ? $array[1] . $array[2] . $array[4] . $array[5] . '-' . $array[6] . $array[7] . $array[8] . $array[9] . '-' . $array[10] . $array[11] . $array[12] . $array[13] . $array[14] : '' ?></td>
												<td class="text-center">CENTRO DE DENUNCIA TECNÓLOGICA</td>
												<td class="text-center"><?= $orden->MUNICIPIODESCR ?></td>
												<td class="text-center"><?= $orden->NOMBRE_MP . ' ' . $orden->APATERNO_MP . ' ' . $orden->AMATERNO_MP ?></td>
												<td class="text-center"><?= $orden->HECHODELITO ?></td>
												<td class="text-center"><?= $orden->NOMBRE ?></td>
												<td class="text-center"><?= $orden->PRIMERAPELLIDO ?></td>
												<td class="text-center"><?= $orden->SEGUNDOAPELLIDO ?></td>
												<td class="text-center"><?= $orden->STATUS ?></td>
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
		$("#registro_candev").DataTable({
			responsive: false,
			lengthChange: false,
			autoWidth: true,
			ordering: true,
			searching: true,
			pageLength: 100,
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
						<li><span style="font-weight:bold;">Fecha inicio:</span> <?= isset($body_data->filterParams->fechaInicio) ? $body_data->filterParams->fechaInicio : '' ?></li>
						<li><span style="font-weight:bold;">Fecha cierre:</span> <?= isset($body_data->filterParams->fechaFin) ? $body_data->filterParams->fechaFin : '' ?></li>
						<li><span style="font-weight:bold;">Hora inicio:</span> <?= isset($body_data->filterParams->horaInicio) ? $body_data->filterParams->horaInicio : '' ?></li>
						<li><span style="font-weight:bold;">Hora cierre:</span> <?= isset($body_data->filterParams->horaFin) ? $body_data->filterParams->horaFin : '' ?></li>
						<li><span style="font-weight:bold;">Agente:</span> <?= isset($body_data->filterParams->AGENTEATENCIONID) ? $body_data->filterParams->nombreAgente : '' ?></li>
						<li><span style="font-weight:bold;">Municipio:</span> <?= isset($body_data->filterParams->MUNICIPIOID) ? $body_data->filterParams->municipioDescr : '' ?></li>
						<li><span style="font-weight:bold;">Tipo de salida:</span> <?= isset($body_data->filterParams->SALIDA) ? $body_data->filterParams->SALIDA : '' ?></li>
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
