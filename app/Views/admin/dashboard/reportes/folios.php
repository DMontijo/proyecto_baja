<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center mb-4">
				<h1 class="mb-4 text-center font-weight-bold">REPORTE DE FOLIOS</h1>
				<a class="link link-primary" href="<?= base_url('admin/dashboard/reportes') ?>" role="button"><i class="fas fa-reply"></i> REGRESAR A REPORTES</a>
			</div>
			<div class="col-12">
				<div class="card shadow border-0 p-0">
					<div class="card-body">
						<div id="accordion">
							<div class="card">
								<div class="card-header bg-light" id="headingOne">
									<h3 class="mb-0">
										<button class="btn btn-link btn-block font-weight-bold text-left" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
											FILTROS
										</button>
									</h3>
								</div>

								<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
									<div class="card-body">
										<form action="<?= base_url() ?>/admin/dashboard/reportes_folios_esp" method="post" enctype="multipart/form-data" class="row needs-validation" novalidate>
											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="MUNICIPIOID" class="form-label font-weight-bold">Municipio:</label>
												<select class="form-control" id="MUNICIPIOID" name="MUNICIPIOID" required>
													<option selected disabled value="">Selecciona el municipio</option>
													<?php foreach ($body_data->municipios as $index => $municipio) { ?>
														<option value="<?= $municipio->MUNICIPIOID ?>"> <?= $municipio->MUNICIPIODESCR ?> </option>
													<?php } ?>
												</select>
											</div>
											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="AGENTEATENCIONID" class="form-label font-weight-bold">Agente:</label>
												<select class="form-control" id="AGENTEATENCIONID" name="AGENTEATENCIONID" required>
													<option selected disabled value="">Selecciona un agente</option>
													<?php foreach ($body_data->empleados as $index => $empleado) { ?>
														<option value="<?= $empleado->ID ?>"> <?= $empleado->NOMBRE . ' ' . $empleado->APELLIDO_PATERNO . ' ' . $empleado->APELLIDO_MATERNO ?> </option>
													<?php } ?>
												</select>
											</div>
											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="fecha" class="form-label font-weight-bold">Fecha de inicio:</label>
												<input type="date" class="form-control" id="fechaInicio" name="fechaInicio" max="<?= date("Y-m-d") ?>">
											</div>
											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="fecha" class="form-label font-weight-bold">Fecha de cierre:</label>
												<input type="date" class="form-control" id="fechaFin" name="fechaFin" max="<?= date("Y-m-d") ?>">
											</div>
											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="hora" class="form-label font-weight-bold">Hora de inicio:</label>
												<input type="time" class="form-control" id="horaInicio" name="horaInicio">
											</div>
											<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
												<label for="hora" class="form-label font-weight-bold">Hora de cierre:</label>
												<input type="time" class="form-control" id="horaFin" name="horaFin">
											</div>
											<div class="col-12 text-center">
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
									<th class="text-center">FECHA DE SALIDA</th>
									<th class="text-center">NOMBRE DEL DENUNCIANTE</th>
									<th class="text-center">NOMBRE DEL AGENTE</th>
									<th class="text-center">ESTADO DE ATENCION</th>
									<th class="text-center">MUNICIPIO DE ATENCION</th>
									<th class="text-center">ESTADO</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($body_data->result as $index => $folio) { ?>
									<tr>
										<td class="text-center font-weight-bold"><?= $folio->FOLIOID ?></td>
										<td class="text-center"><?= $folio->ANO ?></td>
										<td class="text-center"><?= $folio->EXPEDIENTEID ?></td>
										<td class="text-center"><?= $folio->FECHASALIDA ?></td>
										<td class="text-center"><?= $folio->N_DENUNCIANTE . ' ' . $folio->APP_DENUNCIANTE . ' ' . $folio->APM_DENUNCIANTE ?></td>
										<td class="text-center"><?= $folio->N_AGENT . ' ' . $folio->APP_AGENT . ' ' . $folio->APM_AGENT ?></td>
										<td class="text-center"><?= $folio->ESTADODESCR ?></td>
										<td class="text-center"><?= $folio->MUNICIPIODESCR ?></td>
										<td class="text-center"><?= $folio->STATUS ?></td>
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
			lengthChange: true,
			autoWidth: false,
			ordering: true,
			language: {
				url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
			}
		}).buttons().container().appendTo('#videollamadasA_wrapper .col-md-6:eq(0)');
	});
</script>

<?= $this->endSection() ?>
