<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center mb-4">
				<h1 class="mb-4 text-center font-weight-bold">BUSQUEDA DE FOLIO</h1>
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
										<form action="<?= base_url() ?>/admin/dashboard/buscar_folio" method="post" enctype="multipart/form-data" class="row needs-validation" novalidate>
											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="folio" class="form-label font-weight-bold">Folio:</label>
												<input type="number" class="form-control" id="folio" name="folio" value="<?= isset($body_data->filterParams->FOLIOID) ? $body_data->filterParams->FOLIOID : '' ?>">
											</div>
											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="year" class="form-label font-weight-bold">Año:</label>
												<select class="form-control" id="year" name="year">
													<option selected value="">Todos los años</option>
													<?php for ($i = date('Y'); $i >= 2020; $i--) { ?>
														<option <?= isset($body_data->filterParams->ANO) ? ($body_data->filterParams->ANO == $i ? 'selected' : '') : null ?> value="<?= $i ?>"><?= $i ?></option>
													<?php } ?>
												</select>
											</div>

											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="municipio" class="form-label font-weight-bold">Municipio:</label>
												<select class="form-control" id="municipio" name="municipio">
													<option selected value="">Todos los municipios</option>
													<?php foreach ($body_data->municipios as $index => $municipio) { ?>
														<option <?= isset($body_data->filterParams->MUNICIPIOID) ? ($body_data->filterParams->MUNICIPIOID == $municipio->MUNICIPIOID ? 'selected' : '') : null ?> value="<?= $municipio->MUNICIPIOID ?>"> <?= $municipio->MUNICIPIODESCR ?> </option>
													<?php } ?>
												</select>
											</div>

											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="agente" class="form-label font-weight-bold">Agente:</label>
												<select class="form-control" id="agente" name="agente" value="<?= isset($body_data->filterParams->AGENTEATENCIONID) ? $body_data->filterParams->AGENTEATENCIONID : '' ?>">
													<option selected value="">Todos los agentes</option>
													<?php foreach ($body_data->empleados as $index => $empleado) { ?>
														<option <?= isset($body_data->filterParams->AGENTEATENCIONID) ? ($body_data->filterParams->AGENTEATENCIONID == $empleado->ID ? 'selected' : '') : null ?> value="<?= $empleado->ID ?>"> <?= $empleado->NOMBRE . ' ' . $empleado->APELLIDO_PATERNO . ' ' . $empleado->APELLIDO_MATERNO ?> </option>
													<?php } ?>
												</select>
											</div>

											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="fecha_inicio" class="form-label font-weight-bold">Fecha de inicio:</label>
												<input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" max="<?= date("Y-m-d") ?>" value="<?= isset($body_data->filterParams->fechaInicio) ? $body_data->filterParams->fechaInicio : '' ?>">
											</div>

											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="fecha_fin" class="form-label font-weight-bold">Fecha de cierre:</label>
												<input type="date" class="form-control" id="fecha_fin" name="fecha_fin" max="<?= date("Y-m-d") ?>" value="<?= isset($body_data->filterParams->fechaFin) ? $body_data->filterParams->fechaFin : '' ?>">
											</div>

											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="status" class="form-label font-weight-bold">Estatus:</label>
												<select class="form-control" id="status" name="status" required>
													<option selected value="">Todos los estatus</option>
													<option <?= isset($body_data->filterParams->STATUS) ? ($body_data->filterParams->STATUS == 'EXPEDIENTE' ? 'selected' : '') : null ?> value="EXPEDIENTE">EXPEDIENTE</option>
													<option <?= isset($body_data->filterParams->STATUS) ? ($body_data->filterParams->STATUS == 'CANALIZADO' ? 'selected' : '') : null ?> value="CANALIZADO">CANALIZADO</option>
													<option <?= isset($body_data->filterParams->STATUS) ? ($body_data->filterParams->STATUS == 'DERIVADO' ? 'selected' : '') : null ?> value="DERIVADO">DERIVADO</option>
												</select>
											</div>

											<div class="col-12 text-right">
												<a href="<?= base_url('admin/dashboard/buscar_folio') ?>" class="btn btn-secondary font-weight-bold" id="btnFiltroFolio" name="btnFiltroFolio">Borrar filtro</a>
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
						<table id="expedientes_generados" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th class="text-center">ID</th>
									<th class="text-center">AÑO</th>
									<th class="text-center">EXPEDIENTE</th>
									<th class="text-center">ESTADO</th>
									<th class="text-center">NOMBRE DEL DENUNCIANTE</th>
									<th class="text-center">NOMBRE DEL AGENTE</th>
									<th class="text-center"></th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($body_data->result as $index => $folio) { ?>
									<tr>
										<td class="text-center font-weight-bold"><?= $folio->FOLIOID ?></td>
										<td class="text-center"><?= $folio->ANO ?></td>
										<td class="text-center"><?= $folio->EXPEDIENTEID ?></td>
										<td class="text-center"><?= $folio->STATUS ?></td>
										<td class="text-center"><?= $folio->N_DENUNCIANTE . ' ' . $folio->APP_DENUNCIANTE . ' ' . $folio->APM_DENUNCIANTE ?></td>
										<td class="text-center"><?= $folio->N_AGENT . ' ' . $folio->APP_AGENT . ' ' . $folio->APM_AGENT ?></td>
										<td class="text-center">
											<form action="<?= base_url('/admin/dashboard/ver_folio') ?>" method="post">
												<input type="hidden" name="folio" value="<?= $folio->FOLIOID ?>">
												<button type="submit" class="btn btn-primary text-white"><i class="fas fa-eye"></i></button>
											</form>
										</td>
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


<?php if (session()->getFlashdata('message_success')) : ?>
	<script>
		Swal.fire({
			icon: 'success',
			text: '<?= session()->getFlashdata('message_success') ?>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<?php if (session()->getFlashdata('message_error')) : ?>
	<script>
		Swal.fire({
			icon: 'error',
			text: '<?= session()->getFlashdata('message_error') ?>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<script>
	$(function() {
		$("#expedientes_generados").DataTable({
			responsive: false,
			lengthChange: false,
			autoWidth: true,
			ordering: true,
			order: [
				[0, 'desc'],
				[1, 'desc']
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

	function collapse_filter() {
		if (document.querySelector('#filtros').classList.contains('show')) {
			document.querySelector('#filtros').classList.remove('show');
		} else {
			document.querySelector('#filtros').classList.add('show');
		}
	}
</script>

<?= $this->endSection() ?>