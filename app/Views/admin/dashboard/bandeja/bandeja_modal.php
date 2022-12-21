<div class="modal fade" id="bandeja_modal" tabindex="-1" role="dialog" aria-labelledby="bandejaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered mw-100 w-75">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bandejaLabel">INFORMACIÓN DEL EXPEDIENTE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="bandeja_form" action="" method="post" class="row needs-validation" novalidate>
          <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
            <label for="expedienteid" class="form-label font-weight-bold">EXPEDIENTE ID:</label>
            <input type="text" class="form-control" id="expedienteid" name="expedienteid" required disabled>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
            <label for="municipioa" class="form-label font-weight-bold">MUNICIPIO ASIGNADO:</label>
            <input type="text" class="form-control" id="municipioa" name="municipioa" required disabled>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
            <label for="domicilioh" class="form-label font-weight-bold">DOMICILIO DEL HECHO:</label>
            <input type="text" class="form-control" id="domicilioh" name="domicilioh" required disabled>
          </div>

          <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
            <label for="delitosa" class="form-label font-weight-bold">DELITOS INVOLUCRADOS:</label>
            <input type="text" class="form-control" id="delitosa" name="delitosa" required disabled>
          </div>
          <div id="oficina_empleado_container" class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
            <label for="oficina_empleado" class="form-label font-weight-bold">Oficina</label>
            <select class="form-control" name="oficina_empleado" id="oficina_empleado">
              <option value="" selected disabled>Selecciona...</option>
              <option value="792">CENTRO DE DENUNCIA TECNOLÓGICA</option>
            </select>
          </div>
          <div id="empleado_container" class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
            <label for="empleado" class="form-label font-weight-bold">Asignar a</label>
            <select class="form-control" name="empleado" id="empleado">
              <option value="" selected disabled>Selecciona...</option>
            </select>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3 justify-content-center">
            <button type="submit" class="btn btn-primary font-weight-bold">ASIGNAR SALIDA
            </button>
          </div>
      </div>
      </form>
    </div>

  </div>
</div>
<script>
  const oficina_empleado = document.querySelector('#oficina_empleado');
  const empleado = document.querySelector('#empleado');
  const expedienteid = document.querySelector('#expedienteid');

  var form_asignar_salida = document.querySelector('#bandeja_form');

  $.ajax({
    data: {
      'municipio': municipioasignadoid.innerHTML,
    },
    url: "<?= base_url('/data/get-oficinas-by-municipio') ?>",
    method: "POST",
    dataType: "json",
  }).done(function(data) {
    // console.log(data);
    data.forEach(oficina => {
      let option = document.createElement("option");
      option.text = oficina.OFICINADESCR;
      option.value = oficina.OFICINAID;
      oficina_empleado.add(option);
    });
    oficina_empleado.value = '';
  }).fail(function(jqXHR, textStatus) {});
  oficina_empleado.addEventListener('change', (e) => {
    $.ajax({
      data: {
        'municipio': municipioasignadoid.innerHTML,
        'oficina': e.target.value,
      },
      url: "<?= base_url('/data/get-empleados-by-municipio-and-oficina') ?>",
      method: "POST",
      dataType: "json",
    }).done(function(data) {
      clearSelect(empleado);
      data.forEach(emp => {
        let option = document.createElement("option");
        option.text = emp.NOMBRE + ' ' + emp.PRIMERAPELLIDO + ' ' + emp.SEGUNDOAPELLIDO;
        option.value = emp.EMPLEADOID;
        empleado.add(option);
      });
      empleado.value = '';
    }).fail(function(jqXHR, textStatus) {
      clearSelect(empleado);
    });
  });


  form_asignar_salida.addEventListener('submit', (event) => {
    if (!form_asignar_salida.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();
      form_asignar_salida.classList.add('was-validated')
    } else {
      event.preventDefault();
      event.stopPropagation();
      form_asignar_salida.classList.remove('was-validated')
      actualizarSalida();
    }
  }, false);

  function actualizarSalida() {
    if (oficina_empleado.value != '' && empleado.value != '') {
      data = {
        'expediente': expedienteid.value,
        'oficina': oficina_empleado.value,
        'empleado': empleado.value,
      }
      $.ajax({

        data: data,
        url: "<?= base_url('/data/update-folio-asignacion') ?>",
        method: "POST",
        dataType: "json",
        success: function(response) {

          if (response.status == 1) {
            Swal.fire({
              icon: 'success',
              text: 'Expediente asignado con exito',
              confirmButtonColor: '#bf9b55',
            });
            $('#bandeja_modal').modal('hide');
            location.reload();
          } else {
            Swal.fire({
              icon: 'error',
              text: 'Hubo un error al asignar el expediente',
              confirmButtonColor: '#bf9b55',
            });
          }


        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus)

        }
      });
    } else {
      Swal.fire({
        icon: 'error',
        text: 'Debes seleccionar una oficina y una asignación',
        confirmButtonColor: '#bf9b55',
      });
    }
  }
</script>