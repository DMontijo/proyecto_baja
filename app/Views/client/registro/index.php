<div class="container">
    <h1 class="text-center fw-bolder pb-1 text-blue">DATOS DEL DENUNCIANTE</h1>
    <p class="text-center pb-5">Los campos con un <span class="asterisco-rojo">*</span> son obligatorios</p>
    <form class="row g-3 needs-validation" novalidate>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="nombre" class="form-label fw-bold input-required">Nombre(s)</label>
            <input type="text" class="form-control" id="nombres" name="nombre" required>
            <div class="invalid-feedback">
                El nombre es obligatorio
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="apellido_paterno" class="form-label fw-bold input-required">Apellido paterno</label>
            <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" required>
            <div class="invalid-feedback">
                El apellido paterno es obligatorio
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="apellido_materno" class="form-label fw-bold ">Apellido materno</label>
            <input type="text" class="form-control" id="apellido_materno" name="apellido_materno">
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="municipio" class="form-label fw-bold input-required">Municipio del denunciante</label>
            <select class="form-select" id="municipio" name="municipio" required>
                <option selected disabled value="">Elige el municipio</option>
                <option value="1">ENSENADA</option>
                <option value="2">MEXICALI</option>
                <option value="2">PLAYAS DE ROSARITO</option>
                <option value="3">TECATE</option>
                <option value="4">TIJUANA</option>
            </select>
            <div class="invalid-feedback">
                El municipio es obligatorio
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="localidad" class="form-label fw-bold input-required">Localidad del denunciante</label>
            <select class="form-select" id="localidad" name="localidad" required>
                <option selected disabled value="">Elige la localidad</option>
                <option value="1">LOCALIDAD</option>
                <option value="2">LOCALIDAD</option>
                <option value="2">LOCALIDAD</option>
                <option value="3">LOCALIDAD</option>
                <option value="4">LOCALIDAD</option>
            </select>
            <div class="invalid-feedback">
                La localidad es obligatoria
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="localidad" class="form-label fw-bold input-required">Colonia del denunciante</label>
            <select class="form-select" id="localidad" name="localidad" required>
                <option selected disabled value="">Elige la colonia</option>
                <option value="1">COLONIA</option>
                <option value="2">COLONIA</option>
                <option value="2">COLONIA</option>
                <option value="3">COLONIA</option>
                <option value="4">COLONIA</option>
            </select>
            <div class="invalid-feedback">
                La localidad es obligatoria
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="calle" class="form-label fw-bold input-required">Calle o Avenida del denunciante</label>
            <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" required>
            <div class="invalid-feedback">
                La calle o avenida es obligatoria
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="fecha_nacimiento" class="form-label fw-bold input-required">Fecha de nacimiento</label>
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
            <div class="invalid-feedback">
                La fecha de nacimiento es obligatoria
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="correo" class="form-label fw-bold input-required">Correo electrónico</label>
            <input type="email" class="form-control" id="correo" name="correo" required>
            <div class="invalid-feedback">
                El correo esta erroneo
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="codigo_ine" class="form-label fw-bold input-required">Codigo del INE</label>
            <input type="text" class="form-control" id="codigo_ine" name="codigo_ine" required>
            <div class="invalid-feedback">
                El código del INE es obligatorio
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="ine_frente" class="form-label fw-bold input-required">Subir INE frente</label>
            <input class="form-control" type="file" id="ine_frente" name="ine_frente" required>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="ine_reverso" class="form-label fw-bold input-required">Subir INE reverso</label>
            <input class="form-control" type="file" id="ine_reverso" name="ine_reverso" required>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="sexo" class="form-label fw-bold input-required">Sexo biológico</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="sexo" id="H" checked required>
                <label class="form-check-label" for="flexRadioDefault1">Hombre</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="sexo" id="M" required>
                <label class="form-check-label" for="flexRadioDefault2">Mujer</label>
            </div>
        </div>
        <div class="col-12">
            <?php include('e_firma_canva.php') ?>
        </div>
        <div class="col-12 text-center">
            <button class="btn btn-primary " type="button" data-bs-toggle="modal"
                data-bs-target="#otp_validation">Guardar</button>
            <!-- <button type="submit" class="btn btn-primary">Registrarme</button> -->
        </div>
    </form>
</div>
<?php include('otp_validation_modal.php') ?>