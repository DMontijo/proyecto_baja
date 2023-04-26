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
						<div id="loading_general" name="loading_general" class="text-center d-none" style="min-height:50px;">
							<div class="justify-content-center">
								<div class="spinner-border text-primary" role="status">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12 text-center">
								<a class="btn btn-primary" target="_blank" href="http://172.16.24.161/remision/consulta/" role="button">RECOMENDACIONES REMISIÓN</a>
							</div>
						</div>
						<form id="form_remision" class="row needs-validation" action="<?= base_url() ?>/admin/dashboard/bandeja_remision" method="POST" novalidate>
							<input autocomplete="off" type="text" name="expediente" class="form-control" id="expediente" value="<?= $body_data->expedienteid ?>" hidden required>
							<input autocomplete="off" type="text" name="municipio" class="form-control" id="municipio" value="<?= $body_data->municipio ?>" hidden required>
							<div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-3">
								<label for="estado_pfd" class="form-label font-weight-bold">Coordinación: </label>
								<select class="form-control" id="coordinacion" name="coordinacion" required>
									<option selected value=""></option>
									<?php foreach ($body_data->coordinacion as $index => $coordinacion) { ?>
										<option value="<?= $coordinacion->OFICINAID .' '.$coordinacion->AREAID.' '.$coordinacion->EMPLEADOIDRESPONSABLEAREA ?>"> <?= $coordinacion->OFICINADESCR ?> </option>
									<?php } ?>
								</select>
							</div>

							<div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-3">
								<label for="estado_pfd" class="form-label font-weight-bold">Unidad: </label>
								<select class="form-control" id="unidad" name="unidad">
									<option selected value=""></option>
									
								</select>
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-3 d-none">
								<input id="oficinaid" name="oficinaid"/>
								<input id="empleadoid" name="empleadoid"/>
								<input id="areaid" name="areaid"/>
								<input id="tipoOficina" name="tipoOficina"/>

							</div>

							<div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-3">

							<!-- <div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-3">
								<label for="estado_pfd" class="form-label font-weight-bold">Empleado</label>
								<select class="form-control" id="empleado" name="empleado" required>
									<option selected value=""></option>
								</select>
							</div> -->
							<div class="col-12 text-center">
								<button type="submit" class="btn btn-primary" id="btn_remitir"><i class="fas fa-cloud-upload-alt mr-2"></i> REMITIR </button>
							</div>
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
	const coordinacion = document.querySelector('#coordinacion');
	const unidad = document.querySelector('#unidad');

	const empleados = document.querySelector('#empleado');

	form_remision.addEventListener('submit', function(event) {
		if (!form_remision.checkValidity()) {
			event.preventDefault();
		}
		document.querySelector('#loading_general').classList.remove('d-none');
		document.getElementById('btn_remitir').disabled = true;
		form_remision.classList.add('was-validated')
	}, false)

	coordinacion.addEventListener('change', (e) => {
		console.log(e.target.value.split(" ")[0]);
		$.ajax({
			data: {
				'municipio': '<?= $body_data->municipio ?>',
				'coordinacion': e.target.value.split(" ")[0],
			},
			url: "<?= base_url('/data/get-unidades-by-municipio-and-coordinacion') ?>",
			method: "POST",
			dataType: "json",
		}).done(function(data) {
			console.log(data.data);
			document.getElementById('oficinaid').value= e.target.value.split(" ")[0]
			document.getElementById('empleadoid').value= e.target.value.split(" ")[2];
			document.getElementById('areaid').value= e.target.value.split(" ")[1];
			document.getElementById('tipoOficina').value= 'COORDINACION';

			const unidades = data.data;
			clearSelect(unidad);
			unidades.forEach(unidade => {
				let option = document.createElement("option");
				option.text = unidade.OFICINADESCR;
				option.value = unidade.OFICINAID;
				unidad.add(option);
			});
			unidad.value = '';
		}).fail(function(jqXHR, textStatus) {
			clearSelect(unidad);
		});
	});

	unidad.addEventListener('change', (e) => {
		$.ajax({
			data: {
				'municipio': '<?= $body_data->municipio ?>',
				'unidad': e.target.value,
			},
			url: "<?= base_url('/data/get-agent-by-municipio-and-unidad') ?>",
			method: "POST",
			dataType: "json",
		}).done(function(data) {
			console.log(data);
			document.getElementById('oficinaid').value=data.data[0].OFICINAID_MP;
			document.getElementById('empleadoid').value=data.data[0].EMPLEADOID_MP;
			document.getElementById('areaid').value=data.data[0].AREAID_MP;
			document.getElementById('tipoOficina').value= 'UNIDAD';

			console.log(data.data[0].EMPLEADOID_MP);
		}).fail(function(jqXHR, textStatus) {
			console.log(textStatus);
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
