<?= $this->extend('client/templates/register_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container m-auto">
	<div class="col-12">
		<div class="card bg-primary shadow mb-4" style="font-size:14px;background:url(<?= base_url('/assets/img/banner/LINEAS_BANNER.png') ?>);background-repeat: no-repeat;background-size: cover !important;background-position-y: top;border-radius:10px;">
			<div class="row p-4">
				<div class="col-12">
					<div class="row">
						<div class="col-12 col-md-6">
							<a class="p-0 my-3" href="tel:911" role="button"><img src="<?= base_url('/assets/img/banner/911_BANNER.png') ?>" class="img-fluid"></a>
						</div>
						<div class="col-12 col-md-6 mt-4 mt-md-0">
							<a class="p-0 my-3" href="tel:8003432220" role="button" role="button"><img src="<?= base_url('/assets/img/banner/089_BANNER.png') ?>" class="img-fluid"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card shadow py-4 px-3 border-0">
		<div class="card-body">
			<h1 id="titulo" class="text-center fw-bolder pb-1 text-blue">DATOS DEL DENUNCIANTE</h1>
			<p class="text-center pb-5">Los campos con un <span class="asterisco-rojo">*</span> son obligatorios</p>

			<div class="progress">
				<div id="progress-bar" aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" class="progress-bar progress-bar-striped progress-bar-animated bg-yellow" role="progressbar"></div>
			</div>

			<form id="form_register" name="form_register" class="row g-3 needs-validation py-5" action="<?= base_url() ?>/constancia_extravio/create_constancia" method="POST" enctype="multipart/form-data" novalidate>
				<div class="col-12">
					<div class="row">
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="nombre" class="form-label fw-bold input-required">Nombre(s)</label>
							<input type="text" class="form-control" id="nombre" name="nombre" maxlength="100" required>
							<div class="invalid-feedback">
								El nombre es obligatorio
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="apellido_paterno" class="form-label fw-bold input-required">Apellido paterno</label>
							<input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" maxlength="100" required>
							<div class="invalid-feedback">
								El apellido paterno es obligatorio
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="apellido_materno" class="form-label fw-bold ">Apellido materno</label>
							<input type="text" class="form-control" id="apellido_materno" name="apellido_materno" maxlength="100">
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="correo" class="form-label fw-bold input-required">Correo electrónico</label>
							<div class="input-group">
								<span class="input-group-text" id="correo_vanity"><i class="bi bi-envelope-fill"></i></span>
								<input type="email" class="form-control" name="correo" id="correo" aria-describedby="correo_vanity" maxlength="100" required>
							</div>
							<div class="invalid-feedback">
								El correo esta erroneo
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                        <label for="telefono" class="form-label fw-bold input-required">Número de télefono</label>
                        <input type="number" class="form-control" id="telefono" name="telefono" required min="111111" max="99999999999999999999" minlenght="6" maxlength="20" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                        <!-- <small>Mínimo 6 digitos</small> -->
                        <input type="number" id="codigo_pais" name="codigo_pais" maxlength="3" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" hidden>
                    </div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="fecha_nacimiento" class="form-label fw-bold input-required">Fecha de nacimiento</label>
							<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required max="<?= date("Y-m-d") ?>">
							<div class="invalid-feedback">
								La fecha de nacimiento es obligatoria
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="edad" class="form-label fw-bold input-required">Edad</label>
							<input class="form-control" id="edad" name="edad" maxlength="3" type="text">
						</div>
						
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="sexo" class="form-label fw-bold input-required">Sexo</label>
							<br>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="sexo" id="sexo" value="M" required>
								<label class="form-check-label" for="flexRadioDefault1">MASCULINO</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="sexo" id="sexo" value="F" required>
								<label class="form-check-label" for="flexRadioDefault2">FEMENINO</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 mt-5 text-center">
					<button class="btn btn-primary" type="submit" id="submit-btn"><i class="bi bi-check-circle-fill"></i> Validar mi información</button>
				</div>
			</form>
		</div>
	</div>
</div>


<script>
	(function() {
		'use strict'
		var forms = document.querySelectorAll('.needs-validation');
		var inputsText = document.querySelectorAll('input[type="text"]');
		var inputsEmail = document.querySelectorAll('input[type="email"]');
		let form = document.querySelector('#form_register');

		form.addEventListener('submit', function(event) {
			if (!form.checkValidity()) {
				event.preventDefault();
				event.stopPropagation();
				enviar_datos();
			} else {
				event.preventDefault();
				enviar_datos();
			}
			form.classList.add('was-validated')
		}, false)
	});


		document.querySelector('#fecha_nacimiento').addEventListener('change', (e) => {
			let fecha = e.target.value + 'T00:00:00';
			let hoy = new Date();
			let cumpleanos = new Date(fecha);
			let edad = hoy.getFullYear() - cumpleanos.getFullYear();
			let m = hoy.getMonth() - cumpleanos.getMonth();

			if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
				edad--;
			}

			document.querySelector('#edad').value = edad;
		});

		document.querySelector('#fecha_nacimiento').addEventListener('blur', (e) => {
			let fecha = e.target.value;
			let hoy = new Date();
			let cumpleanos = new Date(fecha);
			let edad = hoy.getFullYear() - cumpleanos.getFullYear();
			let m = hoy.getMonth() - cumpleanos.getMonth();

			if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
				edad--;
			}
			if (edad < 18) {
				Swal.fire({
					icon: 'error',
					title: 'No podemos procesar tu solicitud',
					text: 'Debes ser mayor de edad para realizar tu registro.',
					confirmButtonColor: '#bf9b55',
				});

				e.target.value = '';
			}
		});

		function enviar_datos() {
		let nombre = document.querySelector("#nombre").value ? document.querySelector("#nombre").value : '';
		let apellido1 = document.querySelector("#apellido_paterno").value ? document.querySelector("#apellido_paterno").value : '';
		let apellido2 = document.querySelector("#apellido_materno").value ? document.querySelector("#apellido_materno").value : '';
		let correo = document.querySelector("#correo").value ? document.querySelector("#correo").value : '';
		let fechanac = document.querySelector("#fecha_nacimiento").value ? document.querySelector("#fecha_nacimiento").value : '';
		let edad = document.querySelector("#edad").value;
		let sexo = document.querySelector('input[name="sexo"]:checked').value ? document.querySelector('input[name="sexo"]:checked').value : '';

		}
</script>
<?= $this->endSection() ?>
