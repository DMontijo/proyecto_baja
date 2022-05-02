<div class="container">
    <h1 class="text-center fw-bolder pb-5 text-blue">DATOS PERSONALES</h1>
    <form class="row g-3 needs-validation" novalidate>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="nombres" class="form-label fw-bold">Nombres</label>
            <input type="text" class="form-control" id="nombres" name="nombres" required>
            <div class="invalid-feedback">
                El nombre es obligatorio
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="apellido_paterno" class="form-label fw-bold">Apellido paterno</label>
            <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" required>
            <div class="invalid-feedback">
                El apellido paterno es obligatorio
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="apellido_materno" class="form-label fw-bold">Apellido materno</label>
            <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" required>
            <div class="invalid-feedback">
                El apellido materno es obligatorio
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="fecha_nacimiento" class="form-label fw-bold">Fecha de nacimiento</label>
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
            <div class="invalid-feedback">
                La fecha de nacimiento es obligatoria
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="correo" class="form-label fw-bold">Correo electrónico</label>
            <input type="email" class="form-control" id="correo" name="correo" required>
            <div class="invalid-feedback">
                El correo esta erroneo
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="codigo_ine" class="form-label fw-bold">Codigo del INE</label>
            <input type="text" class="form-control" id="codigo_ine" name="codigo_ine" required>
            <div class="invalid-feedback">
                El código del INE es obligatorio
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="ine_frente" class="form-label fw-bold">Subir INE frente</label>
            <input class="form-control" type="file" id="ine_frente" name="ine_frente" required>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="ine_reverso" class="form-label fw-bold">Subir INE reverso</label>
            <input class="form-control" type="file" id="ine_reverso" name="ine_reverso" required>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="sexo" class="form-label fw-bold">Sexo biológico</label>
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
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Continuar</button>
            </div>
        </div>
    </form>
</div>