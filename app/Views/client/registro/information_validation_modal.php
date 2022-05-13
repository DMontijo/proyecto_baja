<div class="modal fade" id="information_validation" tabindex="-1" aria-labelledby="resetLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="bs">Validación de informacion</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate>
                    <div class="mb-3" id="divValidationDatos">
                        <label for="nombre" class="col-form-label">Nombre: </label>
                        <input type="text" class="form-control" id="nombre" name="nombre" disabled>
                        <label for="apellido_paterno" class="col-form-label">Apellido paterno: </label>
                        <input type="text" class="form-control" id="apellido1" name="apellido_paterno" disabled>
                        <label for="apellido_materno" class="col-form-label">Apellido materno: </label>
                        <input type="text" class="form-control" id="apellido2" name="apellido_materno" disabled>
                        <label for="correo" class="col-form-label">Correo electronico: </label>
                        <input type="text" class="form-control" id="correom" name="correo" disabled>
                        <label for="fecha_nacimiento" class="col-form-label">Fecha de nacimiento: </label>
                        <input type="text" class="form-control" id="fechanacimiento" name="fecha_nacimiento" disabled>
                        <label for="edad" class="col-form-label">Edad: </label>
                        <input type="text" class="form-control" id="edadm" name="edadm" disabled>
                        <label for="sexo" class="col-form-label">Sexo biologico: </label>
                        <input type="text" class="form-control" id="sexom" name="sexo" disabled>
                        <label for="cp" class="col-form-label">Código Postal: </label>
                        <input type="text" class="form-control" id="cpm" name="cpm" disabled>
                        <label for="pais" class="col-form-label">Pais: </label>
                        <input type="text" class="form-control" id="paism" name="paism" disabled>
                        <label for="estadom" class="col-form-label">Estado del denunciante: </label>
                        <input type="text" class="form-control" id="estadom" name="estadom" disabled>
                        <label for="municipio" class="col-form-label">Municipio: </label>
                        <input type="text" class="form-control" id="municipiom" name="municipio" disabled>
                        <label for="localidad" class="col-form-label">Localidad: </label>
                        <input type="text" class="form-control" id="localidadm" name="localidad" disabled>
                        <label for="colonia_select" class="col-form-label">Colonia: </label>
                        <input type="text" class="form-control" id="coloniam" name="coloniam" disabled>
                        <label for="calle" class="col-form-label">Calle o avenida: </label>
                        <input type="text" class="form-control" id="callem" name="calle" disabled>
                        <label for="exterior" class="col-form-label">Número exterior: </label>
                        <input type="text" class="form-control" id="exteriorm" name="exterior" disabled>
                        <label for="tel" class="col-form-label">Número de télefono: </label>
                        <input type="text" class="form-control" id="telefonom" name="telefonom" disabled>
                        <label for="tel2" class="col-form-label">Número de télefono 2: </label>
                        <input type="text" class="form-control" id="telefonomo" name="telefonomo" disabled>
                        <!---<label for="interior" class="col-form-label">Numero interior: </label>
                        <input type="text" class="form-control" id="interiorm" name="interior" disabled>-->
                        <label for="identificacion" class="col-form-label">Tipo identificacion: </label>
                        <input type="text" class="form-control" id="identificacionm" name="identificacion" disabled>
                        <label for="numi" class="col-form-label">Número de identificacion: </label>
                        <input type="text" class="form-control" id="numi" name="numi" disabled>
                        <label for="edoc" class="col-form-label">Estado civil: </label>
                        <input type="text" class="form-control" id="edocm" name="edocm" disabled>
                        <label for="ocup" class="col-form-label">Ocupación: </label>
                        <input type="text" class="form-control" id="ocupacionm" name="ocupacionm" disabled>
                        <label for="discapacidad" class="col-form-label">Discapacidad: </label>
                        <input type="text" class="form-control" id="discapacidadm" name="discapacidadm" disabled>
                        <label for="orientacion" class="col-form-label">Orientación sexual: </label>
                        <input type="text" class="form-control" id="orientacionm" name="orientacionm" disabled>
                        <label for="idioma" class="col-form-label">Idioma: </label>
                        <input type="text" class="form-control" id="idiomam" name="idiomam" disabled>
                        <label for="identificacion" class="col-form-label">Foto de identificacion: </label>
                        <img id="imgSalidaModal" class="form-control" />
                        <label for="identificacion" class="col-form-label">Firma digital: </label>
                        <img id="imgFirma" class="form-control" />
                    </div>
                    <button type="submit" id="submit" data-bs-target="#otp_validation_modal" data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-primary">Validar informacion</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('otp_validation_modal.php') ?>
