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
						<form id="form_remision_rac" class="row needs-validation" action="<?= base_url() ?>/admin/dashboard/bandeja_rac" method="POST" novalidate>
							<input autocomplete="off" type="text" name="expediente" class="form-control" id="expediente" value="<?= $body_data->expedienteid ?>" hidden required>
							<input autocomplete="off" type="text" name="municipio" class="form-control" id="municipio" value="<?= $body_data->municipio ?>" hidden required>
							<div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-3">
								<label for="procedimiento" class="form-label font-weight-bold">Tipo procedimiento</label>
								<select class="form-control" id="procedimiento" name="procedimiento" required>
									<option selected value=""></option>
									<option value="1">MEDIACIÓN</option>
									<option value="2">CONCILIACIÓN</option>
									<option value="3">JUSTICIA RESTAURATIVA</option>
								</select>
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-3">
								<label for="modulo" class="form-label font-weight-bold">Modulo</label>
								<select class="form-control" id="modulo" name="modulo" required>
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
	const form_remision_rac = document.querySelector('#form_remision_rac');
	const modulo = document.querySelector('#modulo');


	form_remision_rac.addEventListener('submit', function(event) {
		if (!form_remision_rac.checkValidity()) {
			event.preventDefault();
		}
		form_remision_rac.classList.add('was-validated')
	}, false)


	$.ajax({
		data: {
			'municipio': '<?= $body_data->municipio ?>',
		},
		url: "<?= base_url('/data/get-modulos') ?>",
		method: "POST",
		dataType: "json",
	}).done(function(response) {
		console.log(response);
		clearSelect(modulo);
		response.forEach(response => {
			let option = document.createElement("option");
			option.text = response.AREADESCR;
			option.value = response.AREAID;
			modulo.add(option);
		});
		modulo.value = '';
	}).fail(function(jqXHR, textStatus) {
		clearSelect(modulo);
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
