<div class="modal fade" id="otp_validation_modal" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="otp_validation_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white justify-content-center">
                <h5 class="modal-title" id="bs">Validación de correo</h5>
            </div>
            <div id="load" class="modal-body text-center">
                <div class="mb-3" id="divCorreo">
                    <label for="correo_otp" class="col-form-label">Ingresa el código de 6 dígitos que llegó a tu correo
                        electrónico.</label>
                    <input type="text" class="form-control text-center" id="correo_otp" name="correo_otp" required
                        pattern="\d{6}" maxlength="6" placeholder="Código de 6 dígitos númericos.">
                </div>
                <button id="resend_btn" class="btn btn-secondary" role="button" type="submit"><i
                        class="bi bi-arrow-clockwise"></i> Solicitar de nuevo</button>
                <button id="validate_btn" class="btn btn-primary" role="button" type="submit"><i
                        class="bi bi-check-circle-fill"></i> Validar correo</button>
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
        'email': document.querySelector('#correo').value,
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
            console.log(response);
            if (response.status == 200) {
                if (response.valid) {
                    const form = document.querySelector('#form_register');
                    form.submit();
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
            // let otp = response.data.CODIGO_OTP;
            // let fechaVencimiento = response.data.VENCIMIENTO;
            // let datelocal = new Date();
            // let dateToTijuanaString = datelocal.toLocaleString('en-US', {
            //     timeZone: 'America/Tijuana'
            // });
            // let dateTijuana = new Date(dateToTijuanaString);

            // const formatDate = (current_datetime) => {
            //     let formatted_date = current_datetime.getFullYear().toString().padStart(4,
            //         '0') + "-" + (current_datetime.getMonth() + 1).toString().padStart(2, '0') +
            //         "-" + current_datetime.getDate().toString().padStart(2, '0') + " " +
            //         current_datetime.getHours().toString().padStart(2, '0') + ":" +
            //         current_datetime.getMinutes().toString().padStart(2, '0') + ":" +
            //         current_datetime.getSeconds().toString().padStart(2, '0');
            //     return formatted_date;
            // }

            // if (otp == input_otp) {
            //     if (fechaVencimiento > formatDate(dateTijuana)) {
            //         let form = document.querySelector('#form_register');
            //         form.submit();
            //     } else {
            //         Swal.fire({
            //             icon: 'error',
            //             title: 'Error',
            //             text: 'El código ingresado ya venció, solicita uno nuevo.',
            //             confirmButtonColor: '#bf9b55',
            //         }).then(() => {
            //             document.querySelector('#load').classList.remove('d-none');
            //             document.querySelector('#loading').classList.add('d-none');
            //         })
            //     }
            // } else {
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Error',
            //         text: 'El código ingresado es incorrecto.',
            //         confirmButtonColor: '#bf9b55',
            //     }).then(() => {
            //         document.querySelector('#load').classList.remove('d-none');
            //         document.querySelector('#loading').classList.add('d-none');
            //     })
            // }

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
                // e.target.removeAttribute('disabled');
                // document.querySelector('#resend_btn').removeAttribute('disabled');
            })
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