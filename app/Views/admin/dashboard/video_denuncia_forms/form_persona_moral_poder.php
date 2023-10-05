<form id="persona_moral_poder_form" action="" method="post" enctype="multipart/form-data" class="row p-0 m-0 needs-validation" novalidate>
    <div id="contenedor_moral_poder" class="col-12 mb-5 d-none">
        <a id="moral_poder_download" download="" href="">
            <img id="moral_poder" class="img-fluid" src="" style="max-width:300px;">
            <br>
        </a>
    </div>
    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="volumen_pm" class="form-label font-weight-bold">Volumen</label>
        <input type="text" class="form-control" id="volumen_pm" name="volumen_pm">
    </div>
    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="notario_pm" class="form-label font-weight-bold">Número notario</label>
        <input type="text" class="form-control" id="notario_pm" name="notario_pm">
    </div>
    <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
        <label for="poder_pm" class="form-label font-weight-bold">Número poder</label>
        <input type="text" class="form-control" id="poder_pm" name="poder_pm">
    </div>
    <div class="col-12">
        <hr>
    </div>
    <div class="col-12  my-4 text-center">
        <div class="alert alert-warning text-center font-weight-bold d-none mt-2" id="alert_poder" role="alert">
            El poder del folio no coincide con el poder de la persona moral
        </div>
        <a type="button" class="btn btn-primary font-weight-bold text-white d-none" id="btnActualizarPoderFolio" name="btnActualizarPoderFolio">
            ACTUALIZAR PODER
        </a>
    </div>
    <div class="col-12 my-4 text-center">
    <div class="alert alert-warning text-center font-weight-bold d-none mt-2" id="alert_poder_reciente" role="alert">
            Existe un poder más actual, por favor revísalo en la persona moral
            Puedes dar click en el botón "Ir a editar persona moral" 
        </div>
        <a type="button" class="btn btn-primary" id="btnLigacion" name="btnLigacion">
            Ir a editar persona moral
        </a>
    </td>

</form>
<script>
    var form = document.getElementById('persona_moral_poder_form');

    // Recorre todos los elementos del formulario y establece el atributo 'readonly'
    for (var i = 0; i < form.elements.length; i++) {
        form.elements[i].disabled = true;
    }
</script>