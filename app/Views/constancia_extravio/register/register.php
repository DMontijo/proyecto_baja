<?= $this->extend('client/templates/register_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container m-auto ">
	<div class="card shadow py-4 px-3 border-0">
		<div class="card-body">
			<h1 id="titulo" class="text-center fw-bolder pb-1 text-blue">REGISTRO NUEVO</h1>
			<p class="text-center pb-5">Los campos con un <span class="asterisco-rojo">*</span> son obligatorios</p>

			<form id="form_register" name="form_register" class="row g-3 needs-validation py-5" action="<?= base_url() ?>/constancia_extravio/create" method="POST" novalidate>
				<div class="col-12">
					<div class="row">
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="nombre" class="form-label fw-bold input-required">Nombre(s)</label>
							<input type="text" class="form-control" id="nombre" name="nombre" maxlength="50" required>
							<div class="invalid-feedback">
								El nombre es obligatorio
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="apellido_paterno" class="form-label fw-bold input-required">Apellido paterno</label>
							<input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" maxlength="50" required>
							<div class="invalid-feedback">
								El apellido paterno es obligatorio
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="apellido_materno" class="form-label fw-bold ">Apellido materno</label>
							<input type="text" class="form-control" id="apellido_materno" name="apellido_materno" maxlength="50">
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
							<input type="number" class="form-control" id="telefono" name="telefono" required max="99999999999999999999" minlenght="6" maxlength="20" oninput="clearInputPhone(event);">
							<!-- <small>Mínimo 6 digitos</small> -->
							<input type="number" id="codigo_pais" name="codigo_pais" maxlength="3" hidden>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="telefono2" class="form-label fw-bold">Número de télefono adicional</label>
							<input type="number" class="form-control" id="telefono2" name="telefono2" max="99999999999999999999" minlenght="6" maxlength="20" oninput="clearInputPhone(event);">
							<!-- <small>Mínimo 6 digitos</small> -->
							<input type="number" id="codigo_pais_2" name="codigo_pais_2" maxlength="3" hidden>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
							<label for="fecha_nacimiento" class="form-label fw-bold input-required">Fecha de nacimiento</label>
							<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required max="<?= ((int)date("Y")) - 18 . '-' . date("m") . '-' . date("d") ?>">
							<div class="invalid-feedback">
								La fecha de nacimiento es obligatoria
							</div>
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
							<div class="invalid-feedback">
								El sexo es obligatorio.
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 mt-5 text-center">
					<button class="btn btn-primary" type="submit" id="submit-btn"><i class="bi bi-check-circle-fill"></i> Registrarme</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php if (session()->getFlashdata('message')) : ?>
	<script>
		Swal.fire({
			icon: 'error',
			text: '<?= session()->getFlashdata('message') ?>',
			confirmButtonColor: '#bf9b55',
		})
	</script>
<?php endif; ?>
<script>
	let input = document.querySelector("#telefono");
	let input2 = document.querySelector("#telefono2");
	let inputPais = document.querySelector("#codigo_pais");
	let inputPais2 = document.querySelector("#codigo_pais_2");

	function clearInputPhone(e) {
		e.target.value = e.target.value.replace(/-/g, "");
		if (e.target.value.length > e.target.maxLength) {
			e.target.value = e.target.value.slice(0, e.target.maxLength);
		};
	}

	let iti = window.intlTelInput(input, {
		separateDialCode: true,
		initialCountry: "MX",
	});
	let iti2 = window.intlTelInput(input2, {
		separateDialCode: true,
		initialCountry: "MX",
	});

	const getData = () => {
		inputPais.value = parseInt(iti.getSelectedCountryData().dialCode);
		inputPais2.value = parseInt(iti2.getSelectedCountryData().dialCode);
	};

	input.addEventListener('change', getData);
	input.addEventListener('keyup', getData);
	input.addEventListener('blur', getData);

	input2.addEventListener('change', getData);
	input2.addEventListener('keyup', getData);
	input2.addEventListener('blur', getData);
</script>
<script>
	(function() {
		'use strict'
		var forms = document.querySelectorAll('.needs-validation');
		var inputsText = document.querySelectorAll('input[type="text"]');
		var inputsEmail = document.querySelectorAll('input[type="email"]');
		let form = document.querySelector('#form_register');

		inputsText.forEach((input) => {
			input.addEventListener('input', function(event) {
				event.target.value = clearText(event.target.value).toUpperCase();
			}, false)
		})

		inputsEmail.forEach((input) => {
			input.addEventListener('input', function(event) {
				event.target.value = clearText(event.target.value).toLowerCase();
			}, false)
		})

		form.addEventListener('submit', function(event) {
			if (!form.checkValidity()) {
				event.preventDefault();
				event.stopPropagation();
			}
			form.classList.add('was-validated')
		}, false)

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

		document.querySelector('#correo').addEventListener('blur', (e) => {
			let regex = /\S+@\S+\.\S+/
			if (regex.test(e.target.value)) {
				$.ajax({
					data: {
						'email': e.target.value
					},
					url: "<?= base_url('/data/exist-email-solicitantes') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						if (response.exist === 1) {

							Swal.fire({
								icon: 'error',
								text: 'El correo ya se encuentra registrado, ingresa uno diferente.',
								confirmButtonColor: '#bf9b55',
							});
							e.target.value = '';
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			}
		});

		function clearText(text) {
			text
				.normalize('NFD')
				.replace(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi, "$1")
				.normalize();
			return text.replaceAll('´', '');
		}
	})()
</script>
<?= $this->endSection() ?>
