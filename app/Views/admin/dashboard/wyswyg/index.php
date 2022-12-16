<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center mb-4">
				<h1 class="mb-4 text-center font-weight-bold">DOCUMENTOS </h1>
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
										<form action="<?= base_url() ?>/admin/dashboard/documentos" method="post" enctype="multipart/form-data" class="row needs-validation" novalidate>
											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="agente_registro" class="form-label font-weight-bold">Agente:</label>
												<select class="form-control" id="agente_registro" name="agente_registro" required>
													<?php foreach ($body_data->empleados as $index => $empleado) { ?>
														<option <?= isset($body_data->filterParams->AGENTEID) ? ($body_data->filterParams->AGENTEID == $empleado->ID ? 'selected' : '') : null ?> value="<?= $empleado->ID ?>"> <?= $empleado->NOMBRE . ' ' . $empleado->APELLIDO_PATERNO . ' ' . $empleado->APELLIDO_MATERNO ?> </option>
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

											<!-- <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="status" class="form-label font-weight-bold">Expediente:</label>
												<select class="form-control" id="status" name="status" required>
													<option selected disabled value=""></option>
												


												</select>
											</div> -->

											<div class="col-12 text-right">
												<a href="<?= base_url('admin/dashboard/documentos') ?>" class="btn btn-secondary font-weight-bold" id="btnFiltroDoc" name="btnFiltroDoc">Borrar filtro</a>
												<button type="submit" class="btn btn-primary font-weight-bold" id="btnFiltroFolio" name="btnFiltroFolio">Filtrar</button>
											</div>
										</form>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card shadow border-0" style="overflow-x:auto;">
					<div class="card-body">
						<table id="extravios_abiertos" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th class="text-center">EXPEDIENTE ID</th>
									<th class="text-center">FECHA</th>
									<th class="text-center">ESTADO</th>
									<th class="text-center"></th>
								</tr>
							</thead>
							<tbody>

								<?php foreach ($body_data->result as $index => $documentos) { ?>
									<tr>
										<td class="text-center font-weight-bold"><?= $documentos->EXPEDIENTEID ?></td>
										<td class="text-center"><?= $documentos->FECHAREGISTRO ?></td>
										<td class="text-center"><?= $documentos->STATUS ?></td>
										<td class="text-center"><a type="button" href="<?= base_url('/admin/dashboard/documentos_show?expediente=' . $documentos->EXPEDIENTEID . '&year=' . $documentos->ANO . '&folio=' . $documentos->FOLIOID) ?>" class="btn btn-primary text-white"><i class="fas fa-eye"></i> VER SOLICITUD</a></td>
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
		$("#extravios_abiertos").DataTable({
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
	function collapse_filter() {
		if (document.querySelector('#filtros').classList.contains('show')) {
			document.querySelector('#filtros').classList.remove('show');
		} else {
			document.querySelector('#filtros').classList.add('show');
		}
	}
</script>
<?= $this->endSection() ?>