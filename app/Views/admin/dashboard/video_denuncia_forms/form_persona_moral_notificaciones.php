<form id="persona_moral_notificaciones_form" action="" method="post" enctype="multipart/form-data" class="row p-0 m-0 needs-validation" novalidate>
    <input type="hidden" class="form-control" id="n_id" name="n_id">
    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="estado_pm_noti" class="form-label font-weight-bold">Estado</label>
        <select class="form-control" id="estado_pm_noti" name="estado_pm_noti">
            <option selected value=""></option>
            <?php foreach ($body_data->estados as $index => $estados) { ?>
                <option value="<?= $estados->ESTADOID ?>"> <?= $estados->ESTADODESCR ?> </option>
            <?php } ?>
        </select>
    </div>

    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="municipio_pm_noti" class="form-label font-weight-bold">Municipio</label>
        <select class="form-control" id="municipio_pm_noti" name="municipio_pm_noti">
            <option selected value=""></option>
        </select>
    </div>

    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="localidad_pm_noti" class="form-label font-weight-bold">Localidad</label>
        <select class="form-control" id="localidad_pm_noti" name="localidad_pm_noti">
            <option selected value=""></option>
        </select>
    </div>

    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="colonia_pm_noti_select" class="form-label font-weight-bold">Colonia</label>
        <select class="form-control" id="colonia_pm_noti_select" name="colonia_pm_noti_select">
            <option selected value=""></option>
        </select>
        <input type="text" class="form-control d-none" id="colonia_pm_noti" name="colonia_pm_noti" maxlength="100">
    </div>

    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="calle_pm_noti" class="form-label font-weight-bold">Calle</label>
        <input type="text" class="form-control" id="calle_pm_noti" name="calle_pm_noti">
    </div>

    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="n_exterior_pm_noti" class="form-label font-weight-bold">Número exterior</label>
        <input type="text" class="form-control" id="n_exterior_pm_noti" name="n_exterior_pm_noti">
    </div>
    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="n_interior_pm_noti" class="form-label font-weight-bold">Número interior</label>
        <input type="text" class="form-control" id="n_interior_pm_noti" name="n_interior_pm_noti">
    </div>
    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="referencia_pm_noti" class="form-label font-weight-bold">Referencia</label>
        <input type="text" class="form-control" id="referencia_pm_noti" name="referencia_pm_noti">
    </div>
    <div class="col-12">
        <hr>
    </div>
    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="telefono_pm_noti" class="form-label font-weight-bold">Teléfono</label><br>
        <input type="number" class="form-control" id="telefono_pm_noti" name="telefono_pm_noti" max="99999999999999999999" minlenght="6" maxlength="20" oninput="clearInputPhone(event);">
        <input type="number" id="codigo_pais_pf" name="codigo_pais_pf" maxlength="3" hidden>
    </div>


    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="correo_pm_noti" class="form-label font-weight-bold">Correo</label>
        <input type="email" class="form-control" id="correo_pm_noti" name="correo_pm_noti" maxlength="100">
    </div>
</form>
<script>
    var form = document.getElementById('persona_moral_notificaciones_form');

    // Recorre todos los elementos del formulario y establece el atributo 'readonly'
    for (var i = 0; i < form.elements.length; i++) {
        form.elements[i].disabled = true;
    }
</script>