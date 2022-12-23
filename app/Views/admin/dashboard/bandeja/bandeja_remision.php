<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center mb-4">
				<h1 class="mb-4 text-center font-weight-bold">Remisión de folio con expediente</h1>
			</div>
			<div class="col-12">
				<div class="card shadow border-0" style="overflow-x:auto;">
					<div class="card-body">
						<form id="form_remision" class="row needs-validation" action="<?= base_url() ?>/admin/dashboard/bandeja_remision" method="POST" novalidate>
							<input autocomplete="off" type="text" name="expediente" class="form-control" id="expediente" value="<?= $body_data->expedienteid ?>" hidden required>
							<input autocomplete="off" type="text" name="municipio" class="form-control" id="municipio" value="<?= $body_data->municipio ?>" hidden required>
							<div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-3">
								<label for="estado_pfd" class="form-label font-weight-bold">Oficina</label>
								<select class="form-control" id="oficina" name="oficina" required>
									<option selected value=""></option>
									<?php foreach ($body_data->oficinas as $index => $oficina) { ?>
										<option value="<?= $oficina->OFICINAID ?>"> <?= $oficina->OFICINADESCR ?> </option>
									<?php } ?>
								</select>
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-3">
								<label for="estado_pfd" class="form-label font-weight-bold">Empleado</label>
								<select class="form-control" id="empleado" name="empleado" required>
									<option selected value=""></option>
								</select>
							</div>
							<div class="col-12 text-center">
								<button type="submit" class="btn btn-primary"><i class="fas fa-cloud-upload-alt mr-2"></i> REMITIR </button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	const form_remision = document.querySelector('#form_remision');
	const oficina = document.querySelector('#oficina');
	const empleados = document.querySelector('#empleado');


	form_remision.addEventListener('submit', function(event) {
		if (!form_remision.checkValidity()) {
			event.preventDefault();
		}
		form_remision.classList.add('was-validated')
	}, false)

	oficina.addEventListener('change', (e) => {
		$.ajax({
			data: {
				'municipio': '<?= $body_data->municipio ?>',
				'oficina': e.target.value,
			},
			url: "<?= base_url('/data/get-empleados-by-municipio-and-oficina') ?>",
			method: "POST",
			dataType: "json",
		}).done(function(data) {
			clearSelect(empleado);
			data.forEach(emp => {
				let option = document.createElement("option");
				option.text = emp.NOMBRE + ' ' + emp.PRIMERAPELLIDO + ' ' + emp.SEGUNDOAPELLIDO;
				option.value = emp.EMPLEADOID;
				empleado.add(option);
			});
			empleado.value = '';
		}).fail(function(jqXHR, textStatus) {
			clearSelect(empleado);
		});
	});

	function clearSelect(select_element) {
		for (let i = select_element.options.length; i >= 1; i--) {
			select_element.remove(i);
		}
	}
</script>
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

<?= $this->endSection() ?>
