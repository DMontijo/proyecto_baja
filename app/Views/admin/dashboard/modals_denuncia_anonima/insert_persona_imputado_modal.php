<div class="modal fade shadow" id="insert_persona_imputado_modal_denuncia" role="dialog" aria-labelledby="personaFisicaDenunciaModalInsertLabel" aria-hidden="true" data-backdrop="">
	<div class="modal-dialog modal-dialog-centered mw-100 w-75">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-blue text-white">
				<h5 class="modal-title font-weight-bold">REGISTRO DE NUEVO IMPUTADO</h5>
				<button type="button" class="close text-white" id="close" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body bg-light" style="height:70vh;overflow-y:auto;">
				<form id="persona_imputado_form_insert" action="" method="post" class="row needs-validation" novalidate>

				<div id="datosImputado" name="datosImputado" class="row">
					<div class="col-12 pt-5">
						<h3 class="font-weight-bold text-center text-blue pb-3">IMPUTADO</h3>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<label for="imputado_nombre" class="form-label font-weight-bold">Nombre:</label>
							<select class="form-control" id="imputado_nombre" name="imputado_nombre">
								<option selected disabled value=""></option>
								<option value="1">Si </option>
								<option value="2">No </option>
							</select>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<label for="imputado_ap1" class="form-label font-weight-bold">Apellido paterno:</label>
							<input class="form-control" id="imputado_ap1" name="imputado_ap1">
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<label for="imputado_ap2" class="form-label font-weight-bold">Apellido materno:</label>
							<input class="form-control" id="imputado_ap2" name="imputado_ap2">

						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<label for="imputado_apodo" class="form-label font-weight-bold">Apodo:</label>
							<input class="form-control" id="imputado_apodo" name="imputado_apodo">
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<label for="imputado_alias" class="form-label font-weight-bold">Alias:</label>
							<input class="form-control" id="imputado_alias" name="imputado_alias">
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<label for="imputado_estatura" class="form-label font-weight-bold">Estatura:</label>
							<input class="form-control" id="imputado_estatura" name="imputado_estatura">
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<label for="imputado_sexo" class="form-label font-weight-bold">Sexo:</label>
							<input class="form-control" id="imputado_sexo" name="imputado_sexo">
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<label for="imputado_anteojos" class="form-label font-weight-bold">¿Usa anteojos?:</label>
							<input class="form-control" id="imputado_anteojos" name="imputado_anteojos">
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<label for="imputado_color_ojos" class="form-label font-weight-bold">Color de ojos:</label>
							<input class="form-control" id="imputado_color_ojos" name="imputado_color_ojos">
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<label for="imputado_color_cabello" class="form-label font-weight-bold">Color de cabello:</label>
							<input class="form-control" id="imputado_color_cabello" name="imputado_color_cabello">
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<label for="imputado_color_piel" class="form-label font-weight-bold">Color de piel:</label>
							<input class="form-control" id="imputado_color_piel" name="imputado_color_piel">
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<label for="imputado_complexion" class="form-label font-weight-bold">Complexión:</label>
							<input class="form-control" id="imputado_complexion" name="imputado_complexion">
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<label for="imputado_edad" class="form-label font-weight-bold">Edad:</label>
							<input class="form-control" id="imputado_edad" name="imputado_edad">
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<label for="imputado_descripcion_fisica" class="form-label font-weight-bold">Descripción física:</label>
							<input class="form-control" id="imputado_descripcion_fisica" name="imputado_descripcion_fisica">
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<label for="imputado_localizacion" class="form-label font-weight-bold">Localización:</label>
							<input class="form-control" id="imputado_localizacion" name="imputado_localizacion">
						</div>
					</div>
				</div>
					<div class="col-12 mb-3 text-center">
						<button type="submit" id="insertPersonaVictima" name="insertPersonaVictima" class="btn btn-primary font-weight-bold">AGREGAR VICTIMA</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
<script>
	$('#relacion_parentesco_modal_insert').on('hidden.bs.modal', function() {
		$(this).find('form').trigger('reset');
	});
</script>