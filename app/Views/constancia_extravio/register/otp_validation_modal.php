<div class="modal fade" id="otp_validation_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="otp_validation_modal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white justify-content-center">
				<h5 class="modal-title" id="bs">Validación de teléfono</h5>
			</div>
			<div id="load" class="modal-body text-center">
				<div class="mb-3" id="divCorreo">
					<label for="correo_otp" class="col-form-label">Ingresa el código de 6 dígitos que llegó a tu correo electrónico y/o mensajes SMS.</label>
					<input type="text" class="form-control text-center" id="correo_otp" name="correo_otp" required pattern="\d{6}" maxlength="6" placeholder="Código de 6 dígitos númericos.">
				</div>
				<button id="resend_btn" class="btn btn-secondary" role="button" type="submit"><i class="bi bi-arrow-clockwise"></i> Solicitar de nuevo</button>
				<button id="validate_btn" class="btn btn-primary" role="button" type="submit"><i class="bi bi-check-circle-fill"></i> Validar teléfono</button>
			</div>
			<div id="loading" class="modal-body text-center d-none" style="min-height:170px;">
				<div class="d-flex justify-content-center">
					<div class="spinner-border text-primary" role="status">
						<span class="visually-hidden">Cargando...</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	//Validate OTP
	document.querySelector('#validate_btn').addEventListener('click', (e) => {
		let input_otp = document.getElementById('correo_otp').value;
		let data = {
			'email': '<?= $body_data->user->CORREO ?>',
			'codigo': document.getElementById('correo_otp').value
		}
		document.querySelector('#load').classList.add('d-none');
		document.querySelector('#loading').classList.remove('d-none');
		$.ajax({
			data: data,
			method: "post",
			url: "<?php echo base_url('/data/validateOTP'); ?>",
			dataType: "json",
			success: function(response) {
				if (response.status == 200) {
					if (response.valid) {
						const form = document.querySelector('#form_perfil');
						form_datos.submit();
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Error',
							text: 'El código ingresado ya venció, solicita uno nuevo.',
							confirmButtonColor: '#bf9b55',
						}).then(() => {
							document.querySelector('#load').classList.remove('d-none');
							document.querySelector('#loading').classList.add('d-none');
						})
					}
				} else if (response.status == 500) {
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: response.message,
						confirmButtonColor: '#bf9b55',
					}).then(() => {
						document.querySelector('#load').classList.remove('d-none');
						document.querySelector('#loading').classList.add('d-none');
					})
				} else {
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: 'Hubo un error, intentelo de nuevo.',
						confirmButtonColor: '#bf9b55',
					}).then(() => {
						document.querySelector('#load').classList.remove('d-none');
						document.querySelector('#loading').classList.add('d-none');
					})
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				Swal.fire({
					icon: 'error',
					title: 'Error',
					text: 'Hubo un error, intentelo de nuevo.',
					confirmButtonColor: '#bf9b55',
				}).then(() => {
					document.querySelector('#load').classList.remove('d-none');
					document.querySelector('#loading').classList.add('d-none');
				})
			}
		});
	});

	//Resend OTP
	document.querySelector('#resend_btn').addEventListener('click', (e) => {

		e.target.setAttribute('disabled', true);
		document.querySelector('#validate_btn').setAttribute('disabled', true);
		var data = {
			'email': document.querySelector('#correo').value,
			'telefono': document.querySelector('#telefono').value
		}

		$.ajax({
			data: data,
			method: "post",
			url: "<?php echo base_url('/data/sendOTP'); ?>",
			dataType: "json",
			success: function(data) {
				e.target.removeAttribute('disabled');
				document.querySelector('#validate_btn').removeAttribute('disabled');
			},
			error: function(jqXHR, textStatus, errorThrown) {
				e.target.removeAttribute('disabled');
				document.querySelector('#validate_btn').removeAttribute('disabled');
			}
		});

	});

	//Only numbers OTP
	document.querySelector('#correo_otp').addEventListener('input', (e) => {
		e.target.value = e.target.value.replace(/[^0-9]/g, '')
	});
</script>
