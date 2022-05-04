<form id="form" name="form" class="needs-validation" novalidate>
    <div class="mb-3">
        <label for="estado-name" class="col-form-label">Estado:</label>
        <input disabled class="form-control" value="Baja California Norte" name="estado" required>
    </div>
    <div class="mb-3">
        <label for="municipio" class="col-form-label">Municipio:</label>
        <select class="form-select" id="municipio" name="municipio" required>
            <option selected disabled value="">Elige el municipio</option>
            <option value="1">Ensenada</option>
            <option value="2">Mexicali</option>
            <option value="3">Tijuana</option>
        </select>
        <div class="invalid-feedback">
            Por favor, selecciona un municipio.
        </div>
    </div>
    <div class="mb-3">
        <label for="municipio-text" class="col-form-label">Municipio:</label>
        <select class="form-select" id="municipio" name="municipio" required>
            <option selected disabled value="">Elige el municipio</option>
            <option value="1">Ensenada</option>
            <option value="2">Mexicali</option>
            <option value="3">Tijuana</option>
        </select>
        <div class="invalid-feedback">
            Por favor, selecciona un municipio.
        </div>
    </div>
    <div class="mb-3" id="divDelitos" style="display:none;">
        <label for="delito-text" class="col-form-label">Delitos:</label>
        <select class="form-select" id="delito" name="delito" required>
            <option selected disabled value="">Elige la categoria</option>
            <option value="1">Frude</option>
            <option value="2">Robo</option>
            <option value="3">Extravío</option>
        </select>
        <div class="invalid-feedback">
            Por favor, selecciona una categoria.
        </div>
    </div>
    <div class="mb-3" id="divFraude" style="display:none;">
        <label for="subcategoria1-text" class="col-form-label">Fraude:</label>
        <select class="form-select" id="fraude" name="fraude" required>
            <option selected disabled value="">Elige la subcategoria</option>
            <option value="1">Frude empresarial</option>
            <option value="2">Fraude electoral</option>
            <option value="3">Fraude monetario</option>
        </select>
        <div class="invalid-feedback">
            Por favor, seleccion una subcategoria.
        </div>
    </div>
    <div class="mb-3" id="divRobo" style="display:none;">
        <label for="subcategoria2-text" class="col-form-label">Robo:</label>
        <select class="form-select" id="robo" name="robo" required>
            <option selected disabled value="">Elige la subcategoria</option>
            <option value="1">Robo de cartera</option>
            <option value="2">Robo vehicular</option>
            <option value="3">Robo en la casa</option>
        </select>
        <div class="invalid-feedback">
            Por favor, seleccion una subcategoria.
        </div>
    </div>
    <div class="mb-3" id="divExtravio" style="display:none;">
        <label for="subcategoria3-text" class="col-form-label">Extravio:</label>
        <select class="form-select" id="extravio" name="extravio" required>
            <option selected disabled value="">Elige la subcategoria</option>
            <option value="1">Extravio de credenciales</option>
            <option value="2">Extravio de cartera</option>
            <option value="3">Extravio de personas</option>
        </select>
        <div class="invalid-feedback">
            Por favor, seleccion una subcategoria.
        </div>
    </div>
    <div class="mb-3">
        <label for="description-text" class="col-form-label">Descripcion:</label>
        <textarea class="form-control" id="description" name="description" maxlength="150" required></textarea>
        <div class="invalid-feedback">
            Por favor, anexa una descripcion.
        </div>
        <span class="help-block">
            <p id="mensaje_ayuda" class="help-block">Cuerpo del mensaje de alerta</p>
        </span>
    </div>
    <button id="submit" type="submit" class="btn btn-primary">Capturar delito</button>
</form>

<div class="modal fade" id="myModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Derechos del ofendido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Testimonios y carga de la prueba

                El Comité está obligado a examinar toda la información que le faciliten las partes interesadas.
                Esta siempre ha de ser escrita. Hasta el momento el Comité no está facultado para realizar
                investigaciones independientes.

                En varios casos relativos al derecho a la vida, la tortura y los malos tratos, así como
                detenciones arbitrarias y desapariciones, el Comité ha determinado que la carga de la prueba no
                puede recaer exclusivamente sobre el denunciante de la violación. El Comité mantiene también que
                no basta con que el Estado Parte refute en términos generales una denuncia de violación de los
                derechos humanos de una persona.

                Opiniones individuales

                El Comité de Derechos Humanos funciona por medio de consenso, pero sus distintos miembros pueden
                agregar opiniones individuales a los dictamenes del Comité y cuando las comunicaciones hayan
                sido declaradas inadmisibles.

                Resultados

                Como consecuencia de las decisiones del Comité respecto de algunas denuncias presentadas con
                arreglo al Protocolo Facultativo varios países han modificado su legislación. En otros casos, se
                ha puesto en libertad a los presos y se ha indemnizado a las víctimas de violaciones de derechos
                humanos. En 1990, el Comité estableció un mecanismo por el cual trata de fiscalizar más de cerca
                si los Estados dan curso a los dictamenes adoptadas por él sobre el fondo de los casos; las
                primeras reacciones de los Estados Partes han sido alentadoras.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="ko" data-bs-dismiss="modal">Regresar</button>
                <button id="ok" type="button" class="btn btn-primary">Aceptar terminos</button>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
})()
$('#mensaje_ayuda').text('150 carácteres restantes');
$('#description').keydown(function() {
    var max = 150;
    var len = $(this).val().length;
    if (len >= max) {
        $('#mensaje_ayuda').text('Has llegado al límite'); // Aquí enviamos el mensaje a mostrar          
        $('#mensaje_ayuda').addClass('text-danger');
        $('#description').addClass('is-invalid');
    } else {
        var ch = max - len;
        $('#mensaje_ayuda').text(ch + ' carácteres restantes');
        $('#mensaje_ayuda').removeClass('text-danger');
        $('#description').removeClass('is-invalid');
    }
});
</script>
<script>
$("#municipio").change(function() {
    if ($("#municipio").val() !== "0") {
        divC = document.getElementById("divDelitos");
        divC.style.display = "";
    } else {
        divC = document.getElementById("divDelitos");
        divC.style.display = "none";
    }
});
$("#delito").change(function() {
    if ($("#delito").val() == "1") {
        divC = document.getElementById("divFraude");
        divC.style.display = "";
        divT = document.getElementById("divRobo");
        divT.style.display = "none";
        divT = document.getElementById("divExtravio");
        divT.style.display = "none";

    } else if ($("#delito").val() == "2") {
        divC = document.getElementById("divFraude");
        divC.style.display = "none";
        divT = document.getElementById("divRobo");
        divT.style.display = "";
        divT = document.getElementById("divExtravio");
        divT.style.display = "none";
    } else if ($("#delito").val() == "3") {
        divC = document.getElementById("divFraude");
        divC.style.display = "none";
        divT = document.getElementById("divRobo");
        divT.style.display = "none";
        divT = document.getElementById("divExtravio");
        divT.style.display = "";
    }
});
/*$(document).ready(function () {
    $('#submit').on('click', function(e) {
      e.preventDefault();

      $('#myModal').modal('show');
    });
    
});*/
</script>