<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">

	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center mb-4">
				<h1 class="mb-4 text-center font-weight-bold">REGISTRO DIARIO</h1>
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
										<form action="<?= base_url() ?>/admin/dashboard/registro_diario" method="post" enctype="multipart/form-data" class="row needs-validation" novalidate>
											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="agente_registro" class="form-label font-weight-bold">Agente:</label>
												<select class="form-control" id="agente_registro" name="agente_registro">
													<option selected value="">Todos los agentes</option>
													<?php foreach ($body_data->empleados as $index => $empleado) { ?>
														<option <?= isset($body_data->filterParams->AGENTEATENCIONID) ? ($body_data->filterParams->AGENTEATENCIONID == $empleado->ID ? 'selected' : '') : null ?> value="<?= $empleado->ID ?>"> <?= $empleado->NOMBRE . ' ' . $empleado->APELLIDO_PATERNO . ' ' . $empleado->APELLIDO_MATERNO ?> </option>
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

											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="status" class="form-label font-weight-bold">Expediente:</label>
												<select class="form-control" id="status" name="status" required>
													<option selected disabled value=""></option>
													<option <?= isset($body_data->filterParams->STATUS) ? ($body_data->filterParams->STATUS == 'TODOS' ? 'selected' : '') : null ?> value="TODOS">TODOS LOS FOLIOS/EXPEDIENTES</option>
													<option <?= isset($body_data->filterParams->STATUS) ? ($body_data->filterParams->STATUS == 'SIN' ? 'selected' : '') : null ?> value="SIN">SIN EXPEDIENTE</option>
													<option <?= isset($body_data->filterParams->STATUS) ? ($body_data->filterParams->STATUS == 'CON' ? 'selected' : '') : null ?> value="CON">CON EXPEDIENTE</option>
												</select>
											</div>
											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="status" class="form-label font-weight-bold">Tipo:</label>
												<select class="form-control" id="tipo" name="tipo" required>
													<option selected value="">Todos los tipos...</option>
													<option <?= isset($body_data->filterParams->TIPODENUNCIA) ? ($body_data->filterParams->TIPODENUNCIA == 'VD' ? 'selected' : '') : null ?> value="VD">CDTEC</option>
													<option <?= isset($body_data->filterParams->TIPODENUNCIA) ? ($body_data->filterParams->TIPODENUNCIA == 'TE' ? 'selected' : '') : null ?> value="TE">TELEFÓNICA</option>
													<option <?= isset($body_data->filterParams->TIPODENUNCIA) ? ($body_data->filterParams->TIPODENUNCIA == 'DA' ? 'selected' : '') : null ?> value="DA">DENUNCIA ANÓNIMA</option>
													<option <?= isset($body_data->filterParams->TIPODENUNCIA) ? ($body_data->filterParams->TIPODENUNCIA == 'EL' ? 'selected' : '') : null ?> value="EL">ELECTRÓNICA</option>

												</select>
											</div>
											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="status" class="form-label font-weight-bold">Tipo de expediente:</label>
												<select class="form-control" id="tipoExp" name="tipoExp" required>
													<option selected value="">Todos los tipos</option>
													<option <?= isset($body_data->filterParams->TIPOEXP) ? ($body_data->filterParams->TIPOEXP == '1' ? 'selected' : '') : null ?> value="1">(NUC) CASO DE INVESTIGACION </option>
													<option <?= isset($body_data->filterParams->TIPOEXP) ? ($body_data->filterParams->TIPOEXP == '4' ? 'selected' : '') : null ?> value="4">(NAC) ACTA CIRCUNSTANCIADA</option>
													<option <?= isset($body_data->filterParams->TIPOEXP) ? ($body_data->filterParams->TIPOEXP == '5' ? 'selected' : '') : null ?> value="5">(RAC) REGISTRO DE ATENCION CIUDADANA</option>
												</select>
											</div>
											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="status" class="form-label font-weight-bold">Genero:</label>
												<select class="form-control" id="genero" name="genero" required>
													<option selected value="">Ambos</option>
													<option <?= isset($body_data->filterParams->GENERO) ? ($body_data->filterParams->GENERO == 'M' ? 'selected' : '') : null ?> value="M">MASCULINO</option>
													<option <?= isset($body_data->filterParams->GENERO) ? ($body_data->filterParams->GENERO == 'F' ? 'selected' : '') : null ?> value="F">FEMENINO</option>
												</select>
											</div>
											<div class="col-12 text-right">
												<a href="<?= base_url('admin/dashboard/registro_diario') ?>" class="btn btn-secondary font-weight-bold" id="btnFiltroFolio" name="btnFiltroFolio">Borrar filtro</a>
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
							<div class="col-12 text-right">
								<?php if (isset($body_data->filterParams)) { ?>
									<!-- Form para aplicar mismo filtro utilizado para crear el archivo de excel-->
									<form id="formExcel" action="<?= base_url() ?>/admin/dashboard/generar_excel_registro_diario" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
										<?php foreach ($body_data->filterParams as $index => $value) { ?>
											<input type="hidden" id="<?= $index ?>" name="<?= $index ?>" value="<?= $value ?>">
										<?php } ?>
										<div class="col-12 text-right p-0">
											<button type="submit" class="btn btn-success font-weight-bold" id="btnExcel" name="btnExcel">Exportar reporte a excel</button>
										</div>
									</form>
								<?php } ?>
							</div>
						</div>
						<div class="row" style="font-size:10px;">
							<div class="col-12" style="overflow:auto;">
								<table id="registro_diario" class="table table-bordered table-striped table-sm">
									<thead>
										<tr>
											<th class="text-center">FOLIO</th>
											<th class="text-center">AÑO</th>
											<th class="text-center">MEDIO</th>
											<th class="text-center" style="min-width:150px;">EXPEDIENTE</th>
											<th class="text-center">FECHA DE SALIDA</th>
											<th class="text-center">ESTADO FOLIO</th>
											<th class="text-center">NOMBRE DEL DENUNCIANTE</th>
											<th class="text-center">NOMBRE DEL AGENTE</th>
											<th class="text-center">MUNICIPIO DE ATENCIÓN</th>
										</tr>
									</thead>
									<tbody>

										<?php
										foreach ($body_data->result as $index => $folio) {
											$expedienteid = '';
											if (isset($folio->EXPEDIENTEID)) {
												$arrayExpediente = str_split($folio->EXPEDIENTEID);
												$expedienteid = $arrayExpediente[1] . $arrayExpediente[2] . $arrayExpediente[4] . $arrayExpediente[5] . '-' . $arrayExpediente[6] . $arrayExpediente[7] . $arrayExpediente[8] . $arrayExpediente[9] . '-' . $arrayExpediente[10] . $arrayExpediente[11] . $arrayExpediente[12] . $arrayExpediente[13] . $arrayExpediente[14];
											}

											$tipo = '';
											if ($folio->TIPODENUNCIA == 'VD') {
												$tipo = 'VIDEO';
											} else if ($folio->TIPODENUNCIA == 'DA') {
												$tipo = 'ANÓNIMA';
											} else if ($folio->TIPODENUNCIA == 'TE') {
												$tipo = 'TELEFÓNICA';
											}else{
												$tipo = 'ELECTRÓNICA';

											}
										?>
											<tr>
												<td class="text-center font-weight-bold"><?= $folio->FOLIOID ?></td>
												<td class="text-center"><?= $folio->ANO ?></td>
												<td class="text-center"><?= $tipo ?></td>
												<td class="text-center font-weight-bold"><?= $expedienteid ? $expedienteid . '/' . $folio->TIPOEXPEDIENTECLAVE :  '' ?></td>
												<td class="text-center"><?= date('d-m-Y', strtotime($folio->FECHASALIDA)) ?></td>
												<td class="text-center"><?= $folio->STATUS ?></td>
												<td class="text-center"><?= $folio->N_DENUNCIANTE . ' ' . $folio->APP_DENUNCIANTE . ' ' . $folio->APM_DENUNCIANTE ?></td>
												<td class="text-center"><?= $folio->N_AGENT . ' ' . $folio->APP_AGENT . ' ' . $folio->APM_AGENT ?></td>
												<td class="text-center"><?= $folio->MUNICIPIODESCR ?></td>
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
		$("#registro_diario").DataTable({
			responsive: false,
			lengthChange: false,
			autoWidth: true,
			ordering: true,
			order: [
				[0, 'desc'],
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
		// alert(document.getElementById('agente_registro').innerHTML);
		let form = document.querySelector('#formExcel');

		form.addEventListener('submit', function(event) {
			event.preventDefault();
			text = `
			<p>
				El reporte sera generado de acuerdo a la siguiente información<br>
				<ul style="text-align:left;">
						<li><span style="font-weight:bold;">Agente:</span> <?= isset($body_data->filterParams->AGENTENOMBRE) ? $body_data->filterParams->AGENTENOMBRE : '' ?></li>
						<li><span style="font-weight:bold;">Fecha inicio:</span> <?= isset($body_data->filterParams->fechaInicio) ? $body_data->filterParams->fechaInicio : '' ?></li>
						<li><span style="font-weight:bold;">Fecha cierre:</span> <?= isset($body_data->filterParams->fechaFin) ? $body_data->filterParams->fechaFin : '' ?></li>
						<li><span style="font-weight:bold;">Hora inicio:</span> <?= isset($body_data->filterParams->horaInicio) ? $body_data->filterParams->horaInicio : '' ?></li>
						<li><span style="font-weight:bold;">Hora fin:</span> <?= isset($body_data->filterParams->horaFin) ? $body_data->filterParams->horaFin : '' ?></li>
						<li><span style="font-weight:bold;">Estatus:</span> <?= isset($body_data->filterParams->STATUS) ? ($body_data->filterParams->STATUS == 'CON' ? 'CON EXPEDIENTE' : ($body_data->filterParams->STATUS == 'SIN' ? 'SIN EXPEDIENTE' : 'TODOS LOS FOLIOS/EXPEDIENTES')) : '' ?></li>
						<li><span style="font-weight:bold;">Genero:</span> <?= isset($body_data->filterParams->GENERO) ? ($body_data->filterParams->GENERO == 'M' ? 'MASCULINO' : ($body_data->filterParams->GENERO == 'F' ? 'FEMENINO' : '')) : '' ?></li>
						<li><span style="font-weight:bold;">Tipo:</span> <?= isset($body_data->filterParams->TIPODENUNCIA) ? ($body_data->filterParams->TIPODENUNCIA == 'VD' ? 'CDTEC' : ($body_data->filterParams->TIPODENUNCIA == 'DA' ? 'ANÓNIMA' : 'TODOS')) : 'TODOS' ?></li>
						<li><span style="font-weight:bold;">Tipo de expediente:</span>
						<?= isset($body_data->filterParams->TIPOEXP) ? ($body_data->filterParams->TIPOEXP == '1' ? '(NUC) CASO DE INVESTIGACION' : ($body_data->filterParams->TIPOEXP == '4' ? '(NAC) ACTA CIRCUNSTANCIADA' : ($body_data->filterParams->TIPOEXP == '5' ? '(RAC) REGISTRO DE ATENCION CIUDADANA' : 'TODOS'))) : 'TODOS' ?></li>
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
