<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="row">
		<div class="col-12 text-center mb-4">
			<h2 class="font-weight-bold mb-3">EDITAR LIGACIÓN</h2>
			<a class="link link-primary" href="<?= base_url('admin/dashboard/lista_ligaciones') ?>" role="button"><i class="fas fa-reply"></i> Regresar a lista de ligaciones</a>
		</div>
		<div class="col-12">
			<div class="card shadow border-0 rounded">
				<div class="card-body">
					<form id="form-actualizar-ligadura" class="g-3 needs-validation" action="<?= base_url() ?>/admin/dashboard/editar_ligacion" method="POST" enctype="multipart/form-data" novalidate>
						<div class="row">
							<input type="text" name="id" value="<?= $body_data->ligacion->ID ?>" hidden readonly>
							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label class="font-weight-bold" for="marca_comercial">Marca comercial</label>
								<input type="text" name="marca_comercial" class="form-control" id="marca_comercial" value="<?= $body_data->personasmorales->MARCACOMERCIAL ?>" required disabled>
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label class="font-weight-bold" for="razon_social">Razón social</label>
								<input type="text" name="razon_social" class="form-control" id="razon_social" value="<?= $body_data->personasmorales->RAZONSOCIAL ?>" required disabled>
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label class="font-weight-bold" for="rfc">RFC</label>
								<input type="text" name="rfc" class="form-control" id="rfc" value="<?= $body_data->personasmorales->RFC ?>" disabled>
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label class="font-weight-bold" for="litigante">Litigante</label>
								<input type="text" name="litigante" class="form-control" id="litigante" value="<?= $body_data->litigante->NOMBRE ?> <?= $body_data->litigante->APELLIDO_PATERNO ?> <?= $body_data->litigante->APELLIDO_MATERNO ?>" disabled>
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label class="font-weight-bold input-required" for="cargo">Cargo en persona moral</label>
								<select class="form-control" id="cargo" name="cargo" required>
								<option <?= $body_data->ligacion->CARGO == NULL ? 'selected' : '' ?> value="" disabled>Selecciona el cargo</option>

									<option <?= $body_data->ligacion->CARGO == 'LITIGANTE' ? 'selected' : '' ?> value="LITIGANTE">LITIGANTE</option>
									<option <?= $body_data->ligacion->CARGO == 'APODERADO' ? 'selected' : '' ?> value="APODERADO">APODERADO</option>
								</select>
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label class="font-weight-bold input-required" for="relacionar">Aceptar</label>
								<select class="form-control" id="relacionar" name="relacionar" required>
									<option <?= $body_data->ligacion->RELACIONAR == 'N' ? 'selected' : '' ?> value="N">NO</option>
									<option <?= $body_data->ligacion->RELACIONAR == 'S' ? 'selected' : '' ?> value="S">SI</option>
								</select>
							</div>

							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label class="font-weight-bold" for="fecha_inicio_poder">Fecha inicio de poder</label>
								<input type="date" name="fecha_inicio_poder" class="form-control" id="fecha_inicio_poder" value="<?= $body_data->ligacion->FECHAINICIOPODER ?>">
							</div>
							<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
								<label class="font-weight-bold" for="fecha_fin_poder">Fecha fin de poder</label>
								<input type="date" name="fecha_fin_poder" class="form-control" id="fecha_fin_poder" value="<?= $body_data->ligacion->FECHAFINPODER ?>">
							</div>

							
							<div class="col-12 text-center">
								<a id="downloadArchivo" download="<?= $body_data->personasmorales->RFC ?>_<?= $body_data->litigante->NOMBRE ?>_<?= $body_data->litigante->APELLIDO_PATERNO ?>_<?= $body_data->litigante->APELLIDO_MATERNO ?>" href="<?= $body_data->ligacion->PODERARCHIVO ?>">
									<?php if (isset($body_data->tipoarchivo) && ($body_data->tipoarchivo == 'image/png' || $body_data->tipoarchivo == 'image/jpg' || $body_data->tipoarchivo == 'image/jpeg')) { ?>
										<img src='<?= $body_data->ligacion->PODERARCHIVO ?>' width="50%"></img>
									<?php } else if(isset($body_data->tipoarchivo) &&($body_data->tipoarchivo != 'image/png' || $body_data->tipoarchivo != 'image/jpg' || $body_data->tipoarchivo != 'image/jpeg')){ ?>
										<img src='<?= base_url() ?>/assets/img/file.png' width="30%"></img>
									<?php } ?>
								</a>
							</div>

							<div class="col-12 pt-5 text-center">
								<button type="submit" id="btn-submit-datos" class="btn btn-primary font-weight-bold">
									ACTUALIZAR LIGACION
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script>
		(function() {
			'use strict';
			//Declaracion de elementos
			const inputsText = document.querySelectorAll('input[type="text"]');
			const inputsEmail = document.querySelectorAll('input[type="email"]');
			const municipio = document.querySelector('#municipio');
			const oficina_select = document.querySelector('#oficina');
			const form_actualizar_ligadura = document.querySelector('#form-actualizar-ligadura');

			document.querySelector('#relacionar').addEventListener('change', (e) => {
				if (e.target.value == "S") {
					document.querySelector('#fecha_inicio_poder').setAttribute('required', true);
					document.querySelector('#fecha_fin_poder').setAttribute('required', true);
				}
			});

			//Convierte todos los input text a mayusculas
			inputsText.forEach((input) => {
				input.addEventListener('input', function(event) {
					event.target.value = clearText(event.target.value).toUpperCase();
				}, false)
			});
			//Convierte todos los input email a minusculas

			inputsEmail.forEach((input) => {
				input.addEventListener('input', function(event) {
					event.target.value = clearText(event.target.value).toLowerCase();
				}, false)
			});




			//VAlidacion de formularios submit
			form_actualizar_ligadura.addEventListener('submit', function(event) {
				document.querySelector('#btn-submit-datos').setAttribute('disabled', true);
				if (!form_actualizar_ligadura.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
					document.querySelector('#btn-submit-datos').removeAttribute('disabled');
					form_actualizar_ligadura.classList.add('was-validated')

				}
				form_actualizar_ligadura.classList.add('was-validated');
			}, false);
		})();
		//Elimina todos los caracteres especiales del texto

		function clearText(text) {
			return text
				.normalize('NFD')
				.replaceAll(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi, "$1")
				.normalize()
				.replaceAll('´', '');
		}
		//Elimina todos los options de un select

		function clearSelect(select_element) {
			for (let i = select_element.options.length; i >= 1; i--) {
				select_element.remove(i);
			}
		}
	</script>
	<?= $this->endSection() ?>