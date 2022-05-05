<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      
<div class="container">
<h1 class="text-center fw-bolder pb-1 text-blue">DATOS DE LA DENUNCIA</h1>
<p class="text-center pb-5">Los campos con un <span class="asterisco-rojo">*</span> son obligatorios</p>

<form id="form" name="form" class="row g-3 needs-validation" novalidate>
          <div class="col-12 col-sm-6 col-md-4">
            <label for="estado-name" class="form-label fw-bold input-required">Estado:</label>
            <input disabled class="form-control"value="Baja California Norte" name="estado" required>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <label for="municipio-text" class="form-label fw-bold input-required">Municipio:</label>
            <select class="form-select"  id="municipio" name="municipio" required>
                <option selected disabled value="">Elige el municipio</option>
                <option value="1">Ensenada</option>
                <option value="2">Mexicali</option>
                <option value="3">Tijuana</option>
                </select>
                <div class="invalid-feedback">
                  Por favor, selecciona un municipio.
                </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4" id="divLocalidad" style="display:none;">
            <label for="localidad-text" class="form-label fw-bold input-required">Localidad del delito:</label>
            <select class="form-select"  id="localidad" name="localidad" required>
                <option selected disabled value="">Elige la localidad</option>
                <option value="1">Ciudad morelos</option>
                <option value="2">Hechicera</option>
                <option value="3">Mexicali</option>
                </select>
                <div class="invalid-feedback">
                  Por favor, selecciona una localidad.
                </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4" id="divColonia" style="display:none;">
            <label for="colonia-text" class="form-label fw-bold input-required">Colonia del delito:</label>
            <select class="form-select"  id="colonia" name="colonia" required>
                <option selected disabled value="">Elige la colonia</option>
                <option value="1">Ciudad morelos</option>
                <option value="2">Hechicera</option>
                <option value="3">Mexicali</option>
                </select>
                <div class="invalid-feedback">
                  Por favor, selecciona una colonia.
                </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4" id="divCalle" style="display:none;">
            <label for="calle-text" class="form-label fw-bold input-required">Calle o avenida del delito:</label>
            <input type="text" class="form-control" id="calle" name="calle" maxlength="150" required>
            <div class="invalid-feedback">
              Por favor, anexa una calle o avenida.
            </div>
        </div> 
        <div class="col-12 col-sm-6 col-md-4" id="divnoExterior" style="display:none;">
            <label for="noExterior-text" class="form-label fw-bold input-required">No. exterior del delito:</label>
            <input type="text"  class="form-control"id="noExterior" name="noExterior" required>
            <div class="invalid-feedback">
              Por favor, anexa un numero exterior del delito.
            </div>
        </div>  
        <div class="col-12 col-sm-6 col-md-4" id="divnoInterior" style="display:none;">
            <label for="noInterior-text" class="form-label fw-bold">No. interior del delito:</label>
            <input type="text"  class="form-control"id="noInterior" name="noInterior">
            <div class="invalid-feedback">
              Por favor, anexa un numero interior del delito.
            </div>
        </div> 
        <div class="col-12 col-sm-6 col-md-4" id="divLugar" style="display:none;">
            <label for="lugar-text" class="form-label fw-bold input-required">Lugar del delito:</label>
            <select class="form-select"  id="lugar" name="lugar" required>
                <option selected disabled value="">Elige el lugar del delito</option>
                <option value="1">Instituciones privadas</option>
                <option value="2">Centro escolar</option>
                <option value="3">Centro recreativo</option>
                </select>
                <div class="invalid-feedback">
                  Por favor, selecciona un lugar.
                </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4" id="divclasLugar" style="display:none;">
            <label for="claslugar-text" class="form-label fw-bold input-required">Clasificación del lugar:</label>
            <select class="form-select"  id="claslugar" name="claslugar" required>
                <option selected disabled value="">Elige la clasificación lugar del delito</option>
                <option value="1">Escuela</option>
                <option value="2">Centro comercial</option>
                <option value="3">Centro</option>
                </select>
                <div class="invalid-feedback">
                  Por favor, selecciona un lugar.
                </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4" id="divFecha" style="display:none;">
            <label for="fecha-text" class="form-label fw-bold input-required">Fecha y hora del delito:</label>
            <input type="datetime-local" class="form-control" id="fecha" name="fecha" required>
            <div class="invalid-feedback">
              Por favor, anexa una fecha y hora.
            </div>
        </div>  
          <div class="col-12 col-sm-6 col-md-4" id="divDelitos" style="display:none;">
            <label for="delito-text" class="form-label fw-bold input-required">Delitos:</label>
            <select class="form-select" id="delito" name="delito" onchange="cambiar()" onClick="mostrar()" required>
                <option selected disabled value="">Elige la categoria</option>
                <option value="1">Fraude</option>
                <option value="2">Robo</option>
                <option value="3">Extravío</option>
            </select>
            <div class="invalid-feedback">
             Por favor, selecciona una categoria.
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4" id="divFraude" style="display:none;">
            <label for="subcategoria1-text" class="form-label fw-bold input-required">Subcategoria:</label>
            <select class="form-select" id="subcategoria" name="subcategoria">
                <option selected disabled value="">Elige la subcategoria</option>
                <option id="1" value="1"  style='display:none;'>Fraude empresarial</option>
                <option id="1" value="2" style='display:none;'>Fraude electoral</option>
                <option id="1" value="3" style='display:none;'>Fraude monetario</option>
                <option id="2" value="4" style='display:none;'>Robo de cartera</option>
                <option id="2" value="5" style='display:none;'>Robo vehicular</option>
                <option id="2" value="6" style='display:none;'>Robo en la casa</option>
                <option id="3" value="7" style='display:none;'>Extravio de credenciales</option>
                <option id="3" value="8" style='display:none;'>Extravio de cartera</option>
                <option id="3" value="9" style='display:none;'>Extravio de personas</option>
                </select>
                <div class="invalid-feedback">
                  Por favor, seleccion una subcategoria.
                </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4" id="divObjeto" style="display:none;">
            <label for="objetoImplicado-text" class="form-label fw-bold input-required">Describa el objeto implicado:</label>
            <textarea class="form-control" id="objetoImplicado" name="objetoImplicado" maxlength="150" required></textarea>
            <div class="invalid-feedback">
              Por favor, describe el objeto implicado.
            </div>
        </div>   
          <div class="col-12 col-sm-6 col-md-4" id="divNarracion" style="display:none;">
            <label for="description-text" class="form-label fw-bold input-required">Narración breve del hecho:</label>
            <textarea class="form-control" id="description" name="description" maxlength="150" required></textarea>
            <div class="invalid-feedback">
              Por favor, anexa una descripcion.
            </div>
            <span class="help-block">
                <p id="mensaje_ayuda" class="help-block">Cuerpo del mensaje de alerta</p>
            </span>
        </div>   
    <div  class="col-12 col-sm-6 col-md-4" id="divCheck" style="display:none;">
      <label class="form-label fw-bold" for="imputado-check">¿Identifica al causante del delito?</label>
      <input class="form-check-input is-invalid" type="checkbox" id="checkImputado" name="checkImputado">
    </div>
    <div class="row g-3 "id="divImputado" style="display:none;">
     <h1 class="text-center fw-bolder pb-1 text-blue">DATOS DEL IMPUTADO</h1>
     <div class="col-12 col-sm-6 col-md-4">
            <label for="nombre" class="form-label fw-bold input-required">Nombre(s)</label>
            <input type="text" class="form-control" id="nombres_imputado" name="nombres_imputado">
            <div class="invalid-feedback">
                El nombre es obligatorio
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="apellido_paterno" class="form-label fw-bold input-required">Apellido paterno</label>
            <input type="text" class="form-control" id="apellido_paterno_imputado" name="apellido_paterno_imputado">
            <div class="invalid-feedback">
                El apellido paterno es obligatorio
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="apellido_materno" class="form-label fw-bold ">Apellido materno</label>
            <input type="text" class="form-control" id="apellido_materno_imputado" name="apellido_materno_imputado">
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="fecha_nacimiento" class="form-label fw-bold">Fecha de nacimiento</label>
            <input type="date" class="form-control" id="fecha_nacimiento_imputado" name="fecha_nacimiento_imputado" >
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="sexo" class="form-label fw-bold">Sexo biológico</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="sexo_imputado" id="H" checked>
                <label class="form-check-label" for="flexRadioDefault1">Hombre</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="sexo_imputado" id="M" >
                <label class="form-check-label" for="flexRadioDefault2">Mujer</label>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="municipio" class="form-label fw-bold">Municipio del imputado</label>
            <select class="form-select" id="municipio_imputado" name="municipio_imputado" >
                <option selected disabled value="">Elige el municipio</option>
                <option value="1">Ensenada</option>
                <option value="2">Mexicali</option>
                <option value="2">Playas del rosarito</option>
                <option value="3">Tecate</option>
                <option value="4">Tijuana</option>
            </select>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="localidad" class="form-label fw-bold">Localidad del imputado</label>
            <select class="form-select" id="localidad_imputado" name="localidad_imputado" >
                <option selected disabled value="">Elige la localidad</option>
                <option value="1">Villa del campo</option>
                <option value="2">Camalú</option>
                <option value="2">Primo Tapia</option>
                <option value="3">Delta</option>
                <option value="4">San Felipe</option>
            </select>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <label for="localidad" class="form-label fw-bold">Colonia del imputado</label>
            <select class="form-select" id="localidad_imputado" name="localidad_imputado">
                <option selected disabled value="">Elige la colonia</option>
                <option value="1">La Candelaria</option>
                <option value="2">Puerto Don Juan</option>
                <option value="2">Vicente Guerrero</option>
                <option value="3">Pedregal de Cabo San Lucas</option>
                <option value="4">Viva la Plaza</option>
            </select>
        </div>
    </div>
        <button id ="submit" type="submit" class="btn btn-primary" >Capturar delito</button>
 </form>
</div>


<div class="modal fade" id="myModal"class="myModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel2">Derechos del ofendido</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      Testimonios y carga de la prueba

        El Comité está obligado a examinar toda la información que le faciliten las partes interesadas. Esta siempre ha de ser escrita. Hasta el momento el Comité no está facultado para realizar investigaciones independientes.

        En varios casos relativos al derecho a la vida, la tortura y los malos tratos, así como detenciones arbitrarias y desapariciones, el Comité ha determinado que la carga de la prueba no puede recaer exclusivamente sobre el denunciante de la violación.  El Comité mantiene también que no basta con que el Estado Parte refute en términos generales una denuncia de violación de los derechos humanos de una persona.

        Opiniones individuales

        El Comité de Derechos Humanos funciona por medio de consenso, pero sus distintos miembros pueden agregar opiniones individuales a los dictamenes del Comité y cuando las comunicaciones hayan sido declaradas inadmisibles.

        Resultados

        Como consecuencia de las decisiones del Comité respecto de algunas denuncias presentadas con arreglo al Protocolo Facultativo varios países han modificado su legislación. En otros casos, se ha puesto en libertad a los presos y se ha indemnizado a las víctimas de violaciones de derechos humanos. En 1990, el Comité estableció un mecanismo por el cual trata de fiscalizar más de cerca si los Estados dan curso a los dictamenes adoptadas por él sobre el fondo de los casos; las primeras reacciones de los Estados Partes han sido alentadoras.
      </div>
      <div class="modal-footer">
        <button  type="button"class="btn btn-secondary" id="ko" data-bs-dismiss="modal">Regresar</button>
        <button  id="ok"type="button" class="btn btn-primary" >Aceptar terminos</button>
      </div>
    </div>
  </div>
</div>
<script>
  (function () {
  'use strict'
  var forms = document.querySelectorAll('.needs-validation')
  var miCheckbox = document.getElementById('checkImputado');
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
         if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()    
        } 
        if(miCheckbox.checked){
                $('#nombres_imputado').prop("required", true);
                $('#apellido_paterno_imputado').prop("required", true);   
          if(form.checkValidity()){       
            event.preventDefault();
            $('#myModal').modal('show');
          }
        }
        form.classList.add('was-validated')
      //  alert(form.checkValidity());
 
      }, false)
    })
})()
    $('#mensaje_ayuda').text('150 carácteres restantes');
  $('#description').keydown(function () {
      var max = 150;
      var len = $(this).val().length;
      if (len >= max) {
          $('#mensaje_ayuda').text('Has llegado al límite');// Aquí enviamos el mensaje a mostrar          
          $('#mensaje_ayuda').addClass('text-danger');
          $('#description').addClass('is-invalid');                   
      } 
      else {
          var ch = max - len;
          $('#mensaje_ayuda').text(ch + ' carácteres restantes');
          $('#mensaje_ayuda').removeClass('text-danger');            
          $('#description').removeClass('is-invalid');                       
      }
  }); 
</script>
<script>
   $("#municipio").change(function() {
      if($("#municipio").val() !== "0"){
        divC = document.getElementById("divLocalidad");
           divC.style.display = "";
         }else{
            divC = document.getElementById("divLocalidad");
           divC.style.display="none";
      }
    });
    $("#localidad").change(function() {
      if($("#localidad").val() !== "0"){
        divC = document.getElementById("divColonia");
           divC.style.display = "";
         }else{
            divC = document.getElementById("divColonia");
           divC.style.display="none";
      }
    });
    $("#colonia").change(function() {
      if($("#colonia").val() !== "0"){
        divC = document.getElementById("divCalle");
           divC.style.display = "";
         }else{
            divC = document.getElementById("divCalle");
           divC.style.display="none";
      }
    });
    $("#calle").change(function() {
      if($("#calle").val() !== "0"){
        divC = document.getElementById("divnoExterior");
           divC.style.display = "";
         }else{
            divC = document.getElementById("divnoExterior");
           divC.style.display="none";
      }
    });
    $("#noExterior").change(function() {
      if($("#noExterior").val() !== "0"){
        divC = document.getElementById("divnoInterior");
           divC.style.display = "";
         }else{
            divC = document.getElementById("divnoInterior");
           divC.style.display="none";
      }
    });
    $("#noInterior").change(function() {
      if($("#noInterior").val() !== "0"){
        divC = document.getElementById("divLugar");
           divC.style.display = "";
         }else{
            divC = document.getElementById("divLugar");
           divC.style.display="";
      }
    });
    $("#lugar").change(function() {
      if($("#lugar").val() !== "0"){
        divC = document.getElementById("divclasLugar");
           divC.style.display = "";
         }else{
            divC = document.getElementById("divclasLugar");
           divC.style.display="none";
      }
    });
    $("#claslugar").change(function() {
      if($("#claslugar").val() !== "0"){
        divC = document.getElementById("divFecha");
           divC.style.display = "";
         }else{
            divC = document.getElementById("divFecha");
           divC.style.display="none";
      }
    });
    $("#fecha").change(function() {
      if($("#fecha").val() !== "0"){
        divC = document.getElementById("divDelitos");
           divC.style.display = "";
         }else{
            divC = document.getElementById("divDelitos");
           divC.style.display="none";
      }
    });
    $("#delito").change(function() {
      if($("#delito").val() !== "0"){
        divC = document.getElementById("divFraude");
           divC.style.display = "";
         }else{
            divC = document.getElementById("divFraude");
           divC.style.display="none";
      }
    });
    $("#subcategoria").change(function() {
      if($("#subcategoria").val() !== "0"){
        divC = document.getElementById("divObjeto");
           divC.style.display = "";
         }else{
            divC = document.getElementById("divObjeto");
           divC.style.display="none";
      }
    });
    $("#objetoImplicado").change(function() {
      if($("#objetoImplicado").val() !== "0"){
        divC = document.getElementById("divNarracion");
           divC.style.display = "";
         }else{
            divC = document.getElementById("divNarracion");
           divC.style.display="none";
      }
    });
    $("#description").change(function() {
      if($("#description").val() !== "0"){
        divC = document.getElementById("divCheck");
           divC.style.display = "";
         }else{
            divC = document.getElementById("divCheck");
           divC.style.display="none";
      }
    });
    $("#checkImputado").change(function() {
      if($("#checkImputado").val() !== "0"){
        divC = document.getElementById("divImputado");
           divC.style.display = "";
         }else{
            divC = document.getElementById("divImputado");
           divC.style.display="none";
      }
    });
    function cambiar() {
	var x = document.getElementById("subcategoria");
  var vacio = new Option("Elige una opción","");
	x.options[x.options.length] = vacio;
	x.selectedIndex = vacio;
}
function mostrar(){
	var categoria = document.getElementById("delito").value;
	var x = document.getElementById("subcategoria");	
	var i;
	for (i = 0; i < x.length; i++) {
		if (x.options[i].id == categoria){
		    x.options[i].style.display = 'block';
		} else {
		    x.options[i].style.display = 'none';
		}
	}

}
</script>
