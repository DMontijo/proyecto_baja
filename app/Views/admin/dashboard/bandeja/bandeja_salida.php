<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center mb-4">
				<h1 class="mb-4 text-center font-weight-bold">Bandeja de salida</h1>
			</div>
			<div class="col-12">
				<div class="card shadow border-0" style="overflow-x:auto;">
					<div class="card-body">
						<table id="bandeja_salida" class="table table-bordered table-striped">
							<thead>
								<tr>

									<th class="text-center">EXPEDIENTEID</th>
									<th class="text-center">MUNICIPIO ASIGNADO</th>
									<th class="text-center  d-none">MUNICIPIO ID</th>

									<th class="text-center">DOMICILIO DEL HECHO</th>
									<th class="text-center">DELITOS INVOLUCRADOS</th>
									<th class="text-center"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($body_data->folio->result as $index => $folio) {
									$arrayExpediente = str_split($folio->EXPEDIENTEID);
									$expedienteid = $arrayExpediente[0] . '-' . $arrayExpediente[1] . $arrayExpediente[2] . '-' .  $arrayExpediente[3] . $arrayExpediente[4] . $arrayExpediente[5] . '-' . $arrayExpediente[6] . $arrayExpediente[7] . $arrayExpediente[8] .$arrayExpediente[9] . '-' . $arrayExpediente[10] . $arrayExpediente[11] . $arrayExpediente[12] .$arrayExpediente[13] .$arrayExpediente[14] ; ?>
									<tr>
										<td class="text-center" id="expediente"><?= $expedienteid ?></td>
										<td class="text-center" id="municipioasignado"><?= $folio->MUNICIPIODESCR ?></td>
										<td class="text-center d-none" id="municipioasignadoid"><?= $folio->MUNICIPIOID ?></td>
										<td class="text-center" id="domiciliodelito"><?= $folio->HECHOCALLE ?></td>
										<td class="text-center" id="delitosmodalidad"><?= $folio->DELITOMODALIDADDESCR ?></td>
										<td class="text-center">
											<a type="button" class="btn btn-primary" id="asignar_salida" name="asignar_salida"><i class="fas fa-eye"></i></a>
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
<script>
	const asignar_salida = document.querySelector('#asignar_salida');
	const expediente = document.querySelector('#expediente');
	const municipioasignado = document.querySelector('#municipioasignado');
	const municipioasignadoid = document.querySelector('#municipioasignadoid');

	const domiciliodelito = document.querySelector('#domiciliodelito');
	const delitosmodalidad = document.querySelector('#delitosmodalidad');

	asignar_salida.addEventListener('click', (e) => {
		document.querySelector('#expedienteid').value = expediente.innerHTML;
		document.querySelector('#municipioa').value = municipioasignado.innerHTML;
		document.querySelector('#domicilioh').value = domiciliodelito.innerHTML;
		document.querySelector('#delitosa').value = delitosmodalidad.innerHTML;
		$('#bandeja_modal').modal('show');
		
	});
	(function() {
		'use strict'

		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.querySelectorAll('.needs-validation')

		// Loop over them and prevent submission
		Array.prototype.slice.call(forms)
			.forEach(function(form) {
				form.addEventListener('submit', function(event) {
					if (!form.checkValidity()) {
						event.preventDefault()
						event.stopPropagation()
					}

					form.classList.add('was-validated')
				}, false)
			})
	})()
	$(function() {
		$("#bandeja_salida").DataTable({
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

	
	function clearSelect(select_element) {
		for (let i = select_element.options.length; i >= 1; i--) {
			select_element.remove(i);
		}
	}
</script>
<?php include 'bandeja_modal.php' ?>

<?= $this->endSection() ?>