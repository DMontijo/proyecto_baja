<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
<div class="container-fluid">
	<div class="row">
		<div class="col-12 text-center mb-4">
			<h1 class="mb-4 text-center font-weight-bold">FOLIOS GENERADOS</h1>
			<a class="link link-primary" href="<?= base_url('admin/dashboard/reportes') ?>" role="button"><i class="fas fa-reply"></i> REGRESAR A REPORTES</a>
		</div>
		<div class="col-12">
			<div class="card shadow border-0">
				<div class="card-body">
					<div class="card-body p-4">
						<div class="modal-body">
							<form action="<?= base_url() ?>/admin/dashboard/reportes_folios_esp" method="post" enctype="multipart/form-data" class="row needs-validation" novalidate>
								<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
									<label for="municipio" class="form-label fw-bold ">Municipio:</label>
										</br>
									<select class="form-select" id="MUNICIPIOID" name="MUNICIPIOID">
										<option selected disabled value="">Elige el municipio</option>
										<?php foreach ($body_data->municipios as $index => $municipio) { ?>
											<option value="<?= $municipio->MUNICIPIOID ?>"> <?= $municipio->MUNICIPIODESCR ?> </option>
										<?php } ?>
									</select>
								</div>
								<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
									<label for="municipio" class="form-label fw-bold ">Empleado:</label>
									<select class="form-select" id="AGENTEATENCIONID" name="AGENTEATENCIONID">
										<option selected disabled value="">Elige un empleado</option>
										<?php foreach ($body_data->empleados as $index => $empleado) { ?>
											<option value="<?= $empleado->ID ?>"> <?= $empleado->NOMBRE.' '.$empleado->APELLIDO_PATERNO.' '.$empleado->APELLIDO_MATERNO ?> </option>
										<?php } ?>
									</select>
								</div>
								<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
									<label for="fecha" class="form-label fw-bold ">Fecha de inicio:</label>
									<input type="date" class="form-control" id="fechaInicio" name="fechaInicio"  max="<?= date("Y-m-d") ?>">
								</div>
								<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
									<label for="fecha" class="form-label fw-bold ">Fecha de cierre:</label>
									<input type="date" class="form-control" id="fechaFin" name="fechaFin"  max="<?= date("Y-m-d") ?>">
								</div>
								<div class="col-12 col-sm-6 mb-3">
									<label for="hora" class="form-label font-weight-bold">Hora de inicio:</label>
									<input type="time" class="form-control" id="horaInicio" name="horaInicio">
								</div>
								<div class="col-12 col-sm-6 mb-3">
									<label for="hora" class="form-label font-weight-bold">Hora de cierre:</label>
									<input type="time" class="form-control" id="horaFin" name="horaFin">
								</div>
								<div class="col-12 mb-3 text-center">
									<button type="submit" class="btn btn-primary font-weight-bold" id="btnFiltroFolio" name="btnFiltroFolio">Filtrar</button>
								</div>
							</form>
						</div>
					</div>
					<table id="expedientes_generados" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th class="text-center">ID</th>
								<th class="text-center">AÑO</th>
								<th class="text-center">EXPEDIENTE</th>
								<th class="text-center">FECHASALIDA</th>
								<th class="text-center">NOMBRE DEL DENUNCIANTE</th>
								<th class="text-center">NOMBRE DEL AGENTE</th>
								<th class="text-center">ESTADO DE ATENCION</th>
								<th class="text-center">MUNICIPIO DE ATENCION</th>
								<th class="text-center">STATUS DE EXPEDIENTE</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								//var_dump($body_data);
								//exit();
								foreach ($body_data->result as $index => $folio) { ?>
								<tr>
									<td class="text-center font-weight-bold"><?= $folio->FOLIOID ?></td>
									<td class="text-center"><?= $folio->ANO ?></td>
									<td class="text-center"><?= $folio->EXPEDIENTEID ?></td>
									<td class="text-center"><?= $folio->FECHASALIDA ?></td>
									<td class="text-center"><?= $folio->N_DENUNCIANTE.' '.$folio->APP_DENUNCIANTE.' '.$folio->APM_DENUNCIANTE ?></td>
									<td class="text-center"><?= $folio->N_AGENT.' '.$folio->APP_AGENT.' '.$folio->APM_AGENT ?></td>
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
