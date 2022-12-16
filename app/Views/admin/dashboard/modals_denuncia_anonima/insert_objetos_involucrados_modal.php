<div class="modal fade shadow" id="insert_objetos_modal_denuncia" role="dialog" aria-labelledby="personaFisicaDenunciaModalInsertLabel" aria-hidden="true" data-backdrop="">
	<div class="modal-dialog modal-dialog-centered mw-100 w-75">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-blue text-white">
				<h5 class="modal-title font-weight-bold">REGISTRO DE OBJETOS INVOLUCRADOS</h5>
				<button type="button" class="close text-white" id="close" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body bg-light" style="height:70vh;overflow-y:auto;">
				<form id="form_objetos_involucrados" action="" method="post" class="row p-0 m-0 needs-validation" novalidate>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="situacion_objeto" class="form-label font-weight-bold">Situación</label>
						<select class="form-control" id="situacion_objeto" name="situacion_objeto">
							<option disabled selected value=""></option>
							<option value="R">Reportado robado</option>
							<option value="D">Puesto a disposición</option>
							<option value="E">Reportado extraviado</option>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="objeto_clasificacion" class="form-label font-weight-bold">Clasificación del objeto</label>
						<select class="form-control" id="objeto_clasificacion" name="objeto_clasificacion" required>
							<option disabled selected value=""></option>
							<?php foreach ($body_data->objetoclasificacion as $index => $objetoclasificacion) { ?>
								<option value="<?= $objetoclasificacion->OBJETOCLASIFICACIONID ?>"> <?= $objetoclasificacion->OBJETOCLASIFICACIONDESCR ?> </option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="objeto_subclasificacion" class="form-label font-weight-bold">Subclasificación del objeto</label>
						<select class="form-control" id="objeto_subclasificacion" name="objeto_subclasificacion" required>
							<option disabled selected value=""></option>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="marca_objeto" class="form-label font-weight-bold">Marca</label>
						<input type="text" class="form-control" id="marca_objeto" name="marca_objeto" maxlength="100">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="serie_objeto" class="form-label font-weight-bold">Número de serie</label>
						<input type="text" class="form-control" id="serie_objeto" name="serie_objeto" maxlength="100">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="cantidad_objeto" class="form-label font-weight-bold">Cantidad</label>
						<input type="number" class="form-control" id="cantidad_objeto" name="cantidad_objeto">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="valor_objeto" class="form-label font-weight-bold">Valor</label>
						<input type="text" class="form-control" id="valor_objeto" name="valor_objeto" maxlength="100">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="tipo_moneda" class="form-label font-weight-bold">Tipo de moneda</label>
						<select class="form-control" id="tipo_moneda" name="tipo_moneda">
							<option disabled selected value=""></option>
							<?php foreach ($body_data->tipomoneda as $index => $tipomoneda) { ?>
								<option value="<?= $tipomoneda->TIPOMONEDAID ?>"> <?= $tipomoneda->TIPOMONEDADESCR ?> </option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="descripcion_detallada" class="form-label font-weight-bold">Descripción detallada</label>
						<textarea class="form-control" id="descripcion_detallada" name="descripcion_detallada" maxlength="500" oninput="mayuscTextarea(this)"></textarea>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="propietario" class="form-label font-weight-bold">Propietario</label>
						<select class="form-control" id="propietario" name="propietario">
							<option disabled selected value=""></option>

						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="participa_estado_objeto" class="form-label font-weight-bold">Participa estado</label>
						<select class="form-control" id="participa_estado_objeto" name="participa_estado_objeto">
							<option disabled selected value=""></option>
							<option value="S">SI</option>
							<option value="N">NO</option>

						</select>
					</div>
					<div class="col-12 my-4 text-center">
						<button type="submit" class="btn btn-primary font-weight-bold">AGREGAR OBJETO INVOLUCRADO</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	let selectObjetoClasificacion = document.querySelector('#objeto_clasificacion');
	selectObjetoClasificacion.addEventListener("change", function() {
				let objetoSubclasificacion = document.querySelector("#objeto_subclasificacion")

				var datos = {
					"objeto_clasificacion_id": selectObjetoClasificacion.value,
				}

				$.ajax({
					method: 'POST',
					url: "<?= base_url('/data/get-objeto-sub-by-cat') ?>",
					data: datos,
					dataType: 'JSON',
					//data: {nombre:n},
					success: function(response) {
						const objetoSub = response.objetoSub;
						if (response.status == 1) {
							$('#objeto_subclasificacion').empty();

							objetoSub.forEach(element => {
								const option = document.createElement('option');
								option.value = element.OBJETOSUBCLASIFICACIONID;
								option.text = element.OBJETOSUBCLASIFICACIONDESCR;
								objetoSubclasificacion.add(option, null);
							});
						}
					},
				});
			});
</script>