<div class="modal fade" id="otp_validation_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="otp_validation_modal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white justify-content-center">
				<h5 class="modal-title" id="bs">Validación de correo</h5>
			</div>
			<div class="modal-body text-center">
				<div class="mb-3" id="divCorreo">
					<label for="correo_otp" class="col-form-label">Ingresa el código que llego a tu correo electrónico.</label>
					<input type="text" class="form-control text-center" id="correo_otp" name="correo_otp" required pattern="\d{6}" maxlength="6" placeholder="Código de 6 dígitos númericos.">
				</div>
				<button id="resend_btn" class="btn btn-secondary" role="button" type="submit"><i class="bi bi-arrow-clockwise"></i> Solicitar de nuevo</button>
				<button id="validate_btn" class="btn btn-primary" role="button" type="submit"><i class="bi bi-check-circle-fill"></i> Validar correo</button>
			</div>
		</div>
	</div>
</div>

<script>
	//Validate OTP
	document.querySelector('#validate_btn').addEventListener('click', (e) => {
		let input_otp = document.getElementById('correo_otp').value;
		let data = {
			'email': document.querySelector('#correo').value
		}
		e.target.setAttribute('disabled', true);
		document.querySelector('#resend_btn').setAttribute('disabled', true);
		$.ajax({
			data: data,
			method: "post",
			url: "<?php echo base_url('/data/getLastOTP'); ?>",
			dataType: "json",
			success: function(response) {
				console.log(data);
				let otp = response.data.CODIGO_OTP;
				let fechaVencimiento = response.data.VENCIMIENTO;
				let date = new Date();

				const formatDate = (current_datetime) => {
					let formatted_date = current_datetime.getFullYear().toString().padStart(4, '0') + "-" + (current_datetime.getMonth() + 1).toString().padStart(2, '0') + "-" + current_datetime.getDate().toString().padStart(2, '0') + " " + current_datetime.getHours().toString().padStart(2, '0') + ":" + current_datetime.getMinutes().toString().padStart(2, '0') + ":" + current_datetime.getSeconds().toString().padStart(2, '0');
					return formatted_date;
				}

				if (otp == input_otp) {
					console.log('Si son iguales');
					if (fechaVencimiento > formatDate(date)) {
						let form = document.querySelector('#form_register');
						e.target.removeAttribute('disabled');
						document.querySelector('#resend_btn').removeAttribute('disabled');
						form.submit();
					} else {
						console.log('Vencido');
						Swal.fire({
							icon: 'error',
							title: 'Error',
							text: 'El código ingresado ya venció, solicita uno nuevo.',
							confirmButtonColor: '#bf9b55',
						}).then(() => {
							e.target.removeAttribute('disabled');
							document.querySelector('#resend_btn').removeAttribute('disabled');
						})
					}
				} else {
					console.log('Codigo incorrecto');
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: 'El código ingresado es incorrecto.',
						confirmButtonColor: '#bf9b55',
					}).then(() => {
						e.target.removeAttribute('disabled');
						document.querySelector('#resend_btn').removeAttribute('disabled');
					})
				}

			},
			error: function(jqXHR, textStatus, errorThrown) {
				e.target.removeAttribute('disabled');
				document.querySelector('#resend_btn').removeAttribute('disabled');
			}
		});
	});

	//Resend OTP
	document.querySelector('#resend_btn').addEventListener('click', (e) => {

		e.target.setAttribute('disabled', true);
		document.querySelector('#validate_btn').setAttribute('disabled', true);
		var data = {
			'email': document.querySelector('#correo').value
		}

		$.ajax({
			data: data,
			method: "post",
			url: "<?php echo base_url('/data/sendOTP'); ?>",
			dataType: "json",
			success: function(data) {
				console.log(data);
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
