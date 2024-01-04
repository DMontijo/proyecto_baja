<div class="row p-0 m-0">
    <input type="hidden" class="form-control" id="pm_id" name="pm_id">

    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="razon_social_pm" class="form-label font-weight-bold">Razón social</label>
        <input type="text" class="form-control" id="razon_social_pm" name="razon_social_pm">
    </div>
    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="marca_comercial_pm" class="form-label font-weight-bold">Marca comercial</label>
        <input type="text" class="form-control" id="marca_comercial_pm" name="marca_comercial_pm">
    </div>

    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="estado_pm" class="form-label font-weight-bold">Estado</label>
        <select class="form-control" id="estado_pm" name="estado_pm">
            <option selected value=""></option>
            <?php foreach ($body_data->estados as $index => $estados) { ?>
                <option value="<?= $estados->ESTADOID ?>"> <?= $estados->ESTADODESCR ?> </option>
            <?php } ?>
        </select>
    </div>

    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="municipio_pm" class="form-label font-weight-bold">Municipio</label>
        <select class="form-control" id="municipio_pm" name="municipio_pm">
            <option selected value=""></option>
        </select>
    </div>

    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="localidad_pm" class="form-label font-weight-bold">Localidad</label>
        <select class="form-control" id="localidad_pm" name="localidad_pm">
            <option selected value=""></option>
        </select>
    </div>

    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="colonia_pm_select" class="form-label font-weight-bold">Colonia</label>
        <select class="form-control" id="colonia_pm_select" name="colonia_pm_select">
            <option selected value=""></option>
        </select>
        <input type="text" class="form-control d-none" id="colonia_pm" name="colonia_pm" maxlength="100">
    </div>

    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="calle_pm" class="form-label font-weight-bold">Calle</label>
        <input type="text" class="form-control" id="calle_pm" name="calle_pm">
    </div>

    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="n_exterior_pm" class="form-label font-weight-bold">Número exterior</label>
        <input type="text" class="form-control" id="n_exterior_pm" name="n_exterior_pm">
    </div>
    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="n_interior_pm" class="form-label font-weight-bold">Número interior</label>
        <input type="text" class="form-control" id="n_interior_pm" name="n_interior_pm">
    </div>
    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="referencia_pm" class="form-label font-weight-bold">Referencia</label>
        <input type="text" class="form-control" id="referencia_pm" name="referencia_pm">
    </div>
    <div class="col-12">
        <hr>
    </div>
    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="telefono_pm" class="form-label font-weight-bold">Teléfono</label><br>
        <input type="number" class="form-control" id="telefono_pm" name="telefono_pm" max="99999999999999999999" minlenght="6" maxlength="20" oninput="clearInputPhone(event);">
        <input type="number" id="codigo_pais_pf" name="codigo_pais_pf" maxlength="3" hidden>
    </div>


    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="correo_pm" class="form-label font-weight-bold">Correo</label>
        <input type="email" class="form-control" id="correo_pm" name="correo_pm" maxlength="100">
    </div>
    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="giro_pm" class="form-label font-weight-bold">Giro empresarial</label>
        <select class="form-control" id="giro_pm" name="giro_pm">
            <option selected value=""></option>
            <?php foreach ($body_data->giros as $index => $giro) { ?>
                <option value="<?= $giro->PERSONAMORALGIROID ?>"> <?= $giro->PERSONAMORALGIRODESCR ?> </option>
            <?php } ?>
        </select>
    </div>
</div>