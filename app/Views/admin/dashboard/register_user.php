<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<style>
    .card-header{
        background: #092b47 !important;
    }
</style>
<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Registro de usuarios <small>Justicia</small></h3>
                    </div>
                    <form id="form" name="form" class="needs-validation" novalidate>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nombreU"  class="form-label fw-bold input-required">Nombre</label>
                                <input type="text" name="nombreU" class="form-control" id="nombreU" placeholder="Escribe el nombre" required>
                                <div class="invalid-feedback">
                                    El nombre es obligatorio
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="apellido_paterno">Apellido paterno</label>
                                <input type="text" name="apellido_paterno" class="form-control" id="apellido_paterno" placeholder="Escribe el apellido paterno" required>
                                <div class="invalid-feedback">
                                    El apellido paterno es obligatorio
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="apellido_materno">Apellido materno</label>
                                <input type="text" name="apellido_materno" class="form-control" id="apellido_materno" placeholder="Escribe el apellido materno">
                            </div>
                            <div class="form-group">
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
                            <div class="form-group">
                                <label for="correo">Correo electrónico</label>
                                <input type="email" name="correo" class="form-control" id="correo" placeholder="Escribe el correo electrónico" required>
                                <div class="invalid-feedback">
                                    El correo electrónico es obligatorio
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Escribe la contraseña" required>
                                <div class="invalid-feedback">
                                    La contraseña es obligatoria
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="huellaD">Huella digital</label>
                                <input type="text" name="huellaD" class="form-control" id="huellaD" required>
                                <div class="invalid-feedback">
                                    La huella digital es obligatoria
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="huellaD">Firma digital SAT</label>
                                <input class="form-control" type="file" id="firmaSAT" name="firmaSAT" required>
                                <div class="invalid-feedback">
                                    La firma digital SAT es obligatoria
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="perfil">Perfil del usuario</label>
                                <select class="form-control" id="perfil" name="perfil" required>
                                    <option selected disabled value="">Elige el perfil</option>
                                    <option value="1">Administrador</option>
                                    <option value="2">Auxiliar</option>
                                    <option value="3">Ministerio público</option>
                                    <option value="4">Coordinador del centro</option>
                                </select>
                                <div class="invalid-feedback">
                                    El perfil del usuario es obligatorio
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="terms" class="custom-control-input" id="check" required>
                                    <label class="custom-control-label" for="check">Estoy de acuerdo con el registro</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id ="submit" type="submit" class="btn btn-primary">Registrar usuario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    (function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        if(form.checkValidity()){       
            event.preventDefault();
            alert("Se ha registrado con exito")
          }
        
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
  /*(function () {
  'use strict'
  var forms = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
         if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()    
        }  
          if(form.checkValidity()){       
            event.preventDefault();
            alert("Se ha registrado con exito")
          }
        
        form.classList.add('was-validated')
      //  alert(form.checkValidity());
 
      }, false)
    })
})()*/
</script>
<?= $this->endSection() ?>