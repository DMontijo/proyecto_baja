<div class="modal fade shadow" id="insert_persona_victima_modal_denuncia" role="dialog" aria-labelledby="personaFisicaDenunciaModalInsertLabel" aria-hidden="true" data-backdrop="">
	<div class="modal-dialog modal-dialog-centered mw-100 w-75">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-blue text-white">
				<h5 class="modal-title font-weight-bold">REGISTRO DE NUEVA PERSONA FÍSICA</h5>
				<button type="button" class="close text-white" id="close" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body bg-light" style="height:70vh;overflow-y:auto;">
				<form id="persona_fisica_form_insert_denunciaA" name="persona_fisica_form_insert_denunciaA" action="" method="post" class="row needs-validation" novalidate>
					<div class="col-12 mb-3">
						<h3 class="font-weight-bold mb-4 text-center">DATOS DE LA PERSONA FÍSICA</h3>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="calidad_juridica_pf" class="form-label font-weight-bold">Calidad Jurídica</label>
						<select class="form-control" id="calidad_juridica_new" name="calidad_juridica_new" required>
							<option selected value=""></option>
							<?php foreach ($body_data->calidadJuridica as $index => $calidadJuridica) { ?>
								<option value="<?= $calidadJuridica->PERSONACALIDADJURIDICAID ?>"> <?= $calidadJuridica->PERSONACALIDADJURIDICADESCR ?> </option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="desaparecida_new" class="form-label font-weight-bold">Desaparecida</label>
						<select class="form-control" id="desaparecida_new" name="desaparecida_new">
							<option selected disabled value=""></option>
							<option value="S">SI</option>
							<option value="N">NO</option>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="nombre_new" class="form-label font-weight-bold">Nombre(s)</label>
						<input type="text" class="form-control" id="nombre_new" name="nombre_new" maxlength="100" required>
						<div class="invalid-feedback">
							El nombre es obligatorio
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="apellido_paterno_new" class="form-label font-weight-bold">Apellido paterno</label>
						<input type="text" class="form-control" id="apellido_paterno_new" name="apellido_paterno_new" maxlength="50">

					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="apellido_materno_new" class="form-label font-weight-bold">Apellido materno</label>
						<input type="text" class="form-control" id="apellido_materno_new" name="apellido_materno_new" maxlength="50">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="fecha_nacimiento_new" class="form-label font-weight-bold">Fecha de nacimiento</label>
						<input type="date" data-date="" data-date-format="DD MMMM YYYY" class="form-control" id="fecha_nacimiento_new" name="fecha_nacimiento_new" max="<?= ((int)date("Y")) - 18 . '-' . date("m") . '-' . date("d") ?>">

					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="edad_new" class="form-label font-weight-bold">Edad aproximada</label>
						<input type="number" class="form-control" id="edad_new" name="edad_new">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="sexo_new" class="form-label font-weight-bold">Sexo</label>
						<br>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="sexo_new" id="sexo_new" value="M">
							<label class="form-check-label" for="sexo_new">MASCULINO</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="sexo_new" id="sexo_new" value="F">
							<label class="form-check-label" for="sexo_new">FEMENINO</label>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="telefono_new" class="form-label font-weight-bold">Número de teléfono</label>
						<input type="number" class="form-control" id="telefono_new" name="telefono_new" max="99999999999999999999" minlenght="6" maxlength="20" oninput="clearInputPhone(event);">
						<!-- <small>Mínimo 6 digitos</small> -->
						<input type="number" id="codigo_pais_new" name="codigo_pais_new" maxlength="3" hidden>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="telefono_new2" class="form-label font-weight-bold">Número de teléfono adicional</label>
						<input type="number" class="form-control" id="telefono_new2" name="telefono_new2" max="99999999999999999999" minlenght="6" maxlength="20" oninput="clearInputPhone(event);">
						<!-- <small>Mínimo 6 digitos</small> -->
						<input type="number" id="codigo_pais_2_new" name="codigo_pais_2_new" maxlength="3" hidden>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="correo_new" class="form-label font-weight-bold">Correo electrónico</label>
						<div class="input-group">
							<input type="email" class="form-control" name="correo_new" id="correo_new" maxlength="100">
						</div>
						<div class="invalid-feedback">
							El correo esta erroneo
						</div>
					</div>
					<div class="col-12">
						<h3 class="font-weight-bold mb-4 text-center">DATOS DE ORIGEN</h3>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="nacionalidad_new" class="form-label font-weight-bold">Nacionalidad</label>
						<select class="form-control" id="nacionalidad_new" name="nacionalidad_new">
							<option selected disabled value="">Selecciona la nacionalidad</option>
							<?php foreach ($body_data->nacionalidades as $index => $nac) { ?>
								<option value="<?= $nac->PERSONANACIONALIDADID ?>" <?= $nac->PERSONANACIONALIDADDESCR == 'MEXICANA' ? 'selected' : '' ?>> <?= $nac->PERSONANACIONALIDADDESCR ?> </option>
							<?php } ?>
						</select>
						<div class="invalid-feedback">
							La nacionalidad es obligatoria.
						</div>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="estado_select_origen_new" class="form-label font-weight-bold">Estado origen</label>
						<select class="form-control" id="estado_select_origen_new" name="estado_select_origen_new">
							<option selected disabled value="">Selecciona el estado</option>
							<?php foreach ($body_data->estados as $index => $estado) { ?>
								<option value="<?= $estado->ESTADOID ?>"> <?= $estado->ESTADODESCR ?> </option>
							<?php } ?>
						</select>
						<div class="invalid-feedback">
							El estado es obligatorio
						</div>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="municipio_select_origen_new" class="form-label font-weight-bold">Municipio origen</label>
						<select class="form-control" id="municipio_select_origen_new" name="municipio_select_origen_new">
							<option selected disabled value="">Selecciona el municipio</option>
						</select>
						<div class="invalid-feedback">
							El municipio es obligatorio
						</div>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="idioma_new" class="form-label font-weight-bold">Idioma</label>
						<select class="form-control" id="idioma_new" name="idioma_new">
							<option selected disabled value="">Selecciona el idioma</option>
							<?php foreach ($body_data->idiomas as $index => $nac) { ?>
								<option value="<?= $nac->PERSONAIDIOMAID ?>" <?= $nac->PERSONAIDIOMADESCR == 'ESPAÑOL' ? 'selected' : '' ?>> <?= $nac->PERSONAIDIOMADESCR ?> </option>
							<?php } ?>
						</select>
						<div class="invalid-feedback">
							Debes elegir un idioma
						</div>
					</div>
					<div class="col-12">
						<h3 class="font-weight-bold mb-4 text-center">DOMICILIO ACTUAL</h3>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="pais_select_new" class="form-label font-weight-bold">País</label>
						<select class="form-control" id="pais_select_new" name="pais_select_new">
							<?php foreach ($body_data->paises as $index => $pais) { ?>
								<option value="<?= $pais->ISO_2 ?>" <?= $pais->ISO_2 == 'MX' ? 'selected' : '' ?>> <?= mb_strtoupper($pais->NAME, 'UTF-8') ?> </option>
							<?php } ?>
						</select>
						<div class="invalid-feedback">
							El país es obligatorio
						</div>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="estado_select_new" class="form-label font-weight-bold">Estado</label>
						<select class="form-control" id="estado_select_new" name="estado_select_new">
							<option selected disabled value="">Selecciona el estado</option>
							<?php foreach ($body_data->estados as $index => $estado) { ?>
								<option value="<?= $estado->ESTADOID ?>"> <?= $estado->ESTADODESCR ?> </option>
							<?php } ?>
						</select>
						<div class="invalid-feedback">
							El estado es obligatorio
						</div>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="municipio_select_new" class="form-label font-weight-bold">Municipio</label>
						<select class="form-control" id="municipio_select_new" name="municipio_select_new">
							<option selected disabled value="">Selecciona el municipio</option>
						</select>
						<div class="invalid-feedback">
							El municipio es obligatorio
						</div>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="localidad_select_new" class="form-label font-weight-bold">Localidad</label>
						<select class="form-control" id="localidad_select_new" name="localidad_select_new">
							<option selected disabled value="">Selecciona la localidad</option>
						</select>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="colonia_select_new" class="form-label font-weight-bold">Colonia</label>
						<select class="form-control" id="colonia_select_new" name="colonia_select_new">
							<option selected disabled value="">Selecciona la colonia</option>
						</select>
						<input type="text" class="form-control d-none" id="colonia_new" name="colonia_new" maxlength="100">
						<small id="colonia_new-message" class="text-primary fw-bold d-none">Si no encuentras tu colonia selecciona otro</small>
						<div class="invalid-feedback">
							La colonia es obligatoria
						</div>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="cp_new" class="form-label font-weight-bold">Código postal</label>
						<input type="number" class="form-control" id="cp_new" maxlength="10" oninput="clearInputPhone(event);" name="cp_new">
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="calle_new" class="form-label font-weight-bold">Calle</label>
						<input type="text" class="form-control" id="calle_new" name="calle_new" maxlength="100">
						<div class="invalid-feedback">
							La calle es obligatoria
						</div>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="exterior_new" class="form-label font-weight-bold" id="lblExterior_new">Número exterior</label>
						<input type="text" class="form-control" id="exterior_new" name="exterior_new" maxlength="10">
						<div class="invalid-feedback">
							El número exterior es obligatorio
						</div>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="interior_new" class="form-label font-weight-bold" id="lblInterior_new">Número interior</label>
						<input type="text" class="form-control" id="interior_new" name="interior_new" maxlength="10">
					</div>
					<div class="col-12 mt-4 mb-4">
						<input class="form-check-input" type="checkbox" id="checkML_new" name="checkML_new">
						<label class="form-check-label fw-bold" for="checkML_new">
							¿La dirección contiene manzana y lote?
						</label>
					</div>
					<div class="col-12">
						<h3 class="font-weight-bold mb-4 text-center">DATOS DE IDENTIFICACIÓN</h3>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="identificacion_new" class="form-label font-weight-bold">Identificación</label>
						<select class="form-control" id="identificacion_new" name="identificacion_new">
							<option selected disabled value="">Selecciona la identificación</option>
							<?php foreach ($body_data->tiposIdentificaciones as $index => $identificacion) { ?>
								<option value="<?= $identificacion->PERSONATIPOIDENTIFICACIONID ?>"> <?= $identificacion->PERSONATIPOIDENTIFICACIONDESCR ?> </option>
							<?php } ?>
						</select>
						<div class="invalid-feedback">
							El tipo de identificación es obligatorio.
						</div>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="numero_ide_new" class="form-label font-weight-bold">Número de identificación</label>
						<input type="text" class="form-control" id="numero_ide_new" name="numero_ide_new">
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="e_civil_new" class="form-label font-weight-bold">Estado civil</label>
						<select class="form-control" id="e_civil_new" name="e_civil_new">
							<option selected disabled value="">Selecciona su estado civil</option>
							<?php foreach ($body_data->edoCiviles as $index => $edo) { ?>
								<option value="<?= $edo->PERSONAESTADOCIVILID ?>"> <?= $edo->PERSONAESTADOCIVILDESCR ?> </option>
							<?php } ?>
						</select>
						<div class="invalid-feedback">
							El estado civil es obligatorio.
						</div>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="escolaridad_new" class="form-label font-weight-bold">Escolaridad</label>
						<select class="form-control" id="escolaridad_new" name="escolaridad_new">
							<option selected disabled value="">Selecciona la escolaridad</option>
							<?php foreach ($body_data->escolaridades as $index => $escolaridad) { ?>
								<option value="<?= $escolaridad->PERSONAESCOLARIDADID ?>"> <?= $escolaridad->PERSONAESCOLARIDADDESCR ?> </option>
							<?php } ?>
						</select>
						<div class="invalid-feedback">
							La escolaridad es obligatoria
						</div>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="ocupacion_new" class="form-label font-weight-bold">Ocupación</label>
						<select class="form-control" id="ocupacion_new" name="ocupacion_new">
							<option selected disabled value="">Selecciona la ocupacion</option>
							<?php foreach ($body_data->ocupaciones as $index => $ocupacion) { ?>
								<option value="<?= $ocupacion->PERSONAOCUPACIONID ?>"> <?= $ocupacion->PERSONAOCUPACIONDESCR ?> </option>
							<?php } ?>
						</select>
						<input type="text" class="form-control d-none" id="ocupacion_descr_new" name="ocupacion_descr_new" maxlength="100">
						<small id="ocupacion-new-message" class="text-primary fw-bold d-none">Si no encuentras tu ocupación selecciona otro</small>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="discapacidad_new" class="form-label font-weight-bold">¿Padece alguna discapacidad?</label>
						<input type="text" class="form-control" id="discapacidad_new" name="discapacidad_new" maxlength="100">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="leer_new" class="form-label font-weight-bold">¿Sabe leer?</label>
						<br>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="leer_new" id="leer_new" value="S">
							<label class="form-check-label" for="flexRadioDefault1">Si</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="leer_new" id="leer_new" value="N">
							<label class="form-check-label" for="flexRadioDefault2">No</label>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="escribir_new" class="form-label font-weight-bold">¿Sabe escribir?</label>
						<br>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="escribir_new" id="escribir_new" value="S">
							<label class="form-check-label" for="flexRadioDefault1">Si</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="escribir_new" id="escribir_new" value="N">
							<label class="form-check-label" for="flexRadioDefault2">No</label>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="facebook_new" class="form-label font-weight-bold">Facebook</label>
						<div class="input-group">
							<span class="input-group-text" id="facebook_vanity"><i class='fab fa-facebook'></i></span>
							<input type="text" class="form-control" name="facebook_new" id="facebook_new" aria-describedby="facebook_vanity" maxlength="200">
						</div>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="instagram_new" class="form-label font-weight-bold">Instagram</label>
						<div class="input-group">
							<span class="input-group-text" id="instagram_vanity"><i class='fab fa-instagram'></i></span>
							<input type="text" class="form-control" name="instagram_new" id="instagram_new" aria-describedby="instagram_vanity" maxlength="200">
						</div>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="twitter_new" class="form-label font-weight-bold">Twitter</label>
						<div class="input-group">
							<span class="input-group-text" id="twitter_vanity"><i class='fab fa-twitter'></i></span>
							<input type="text" class="form-control" name="twitter_new" id="twitter_new" aria-describedby="twitter_vanity" maxlength="200">
						</div>
					</div>
					<div class="col-12">
						<h3 class="font-weight-bold mb-4 text-center">MEDIA FILIACION</h3>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="etnia_mf1" class="form-label font-weight-bold">Etnia</label>
						<select class="form-control" id="etnia_mf1" name="etnia_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->etnia as $index => $etnia) { ?>
								<option value="<?= $etnia->PERSONAETNIAID ?>"> <?= $etnia->PERSONAETNIADESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="estatura_mf1" class="form-label font-weight-bold">Estatura (cm)</label>
						<input type="number" class="form-control" id="estatura_mf1" name="estatura_mf1">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="peso_mf1" class="form-label font-weight-bold">Peso (kg)</label>
						<input type="number" class="form-control" id="peso_mf1" name="peso_mf1">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="complexion_mf1" class="form-label font-weight-bold">Complexión</label>
						<select class="form-control" id="complexion_mf1" name="complexion_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->figura as $index => $figura) { ?>
								<option value="<?= $figura->FIGURAID ?>"> <?= $figura->FIGURADESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="colortez_mf1" class="form-label font-weight-bold">Color de tez</label>
						<select class="form-control" id="colortez_mf1" name="colortez_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->pielColor as $index => $pielColor) { ?>
								<option value="<?= $pielColor->PIELCOLORID ?>"> <?= $pielColor->PIELCOLORDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="caratez_mf1" class="form-label font-weight-bold">Tez de la cara</label>
						<select class="form-control" id="caratez_mf1" name="caratez_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->caraTez as $index => $caraTez) { ?>
								<option value="<?= $caraTez->CARATEZID ?>"> <?= $caraTez->CARATEZDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="senas_mf1" class="form-label font-weight-bold">Señas particulares</label>
						<input type="text" class="form-control" id="senas_mf1" name="senas_mf1" maxlength="200">
					</div>
					<!-- <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="identidad_mf1" class="form-label font-weight-bold">Identidad</label>
						<input type="text" class="form-control" id="identidad_mf1" name="identidad_mf1" maxlength="200">
					</div> -->
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="colorC_mf1" class="form-label font-weight-bold">Color del cabello</label>
						<select class="form-control" id="colorC_mf1" name="colorC_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->cabelloColor as $index => $cabelloColor) { ?>
								<option value="<?= $cabelloColor->CABELLOCOLORID ?>"> <?= $cabelloColor->CABELLOCOLORDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="tamanoC_mf1" class="form-label font-weight-bold">Tamaño del cabello</label>
						<select class="form-control" id="tamanoC_mf1" name="tamanoC_mf1">
							<option disabled disabled selected value=""></option>

							<?php
							foreach ($body_data->cabelloTamano as $index => $cabelloTamano) { ?>
								<option value="<?= $cabelloTamano->CABELLOTAMANOID ?>"> <?= $cabelloTamano->CABELLOTAMANODESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="formaC_mf1" class="form-label font-weight-bold">Forma del cabello</label>
						<select class="form-control" id="formaC_mf1" name="formaC_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->cabelloEstilo as $index => $cabelloEstilo) { ?>
								<option value="<?= $cabelloEstilo->CABELLOESTILOID  ?>"> <?= $cabelloEstilo->CABELLOESTILODESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="peculiarC_mf1" class="form-label font-weight-bold">Cabello peculiar</label>
						<select class="form-control" id="peculiarC_mf1" name="peculiarC_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->cabelloPeculiar as $index => $cabelloPeculiar) { ?>
								<option value="<?= $cabelloPeculiar->CABELLOPECULIARID  ?>"> <?= $cabelloPeculiar->CABELLOPECULIARDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="cabello_descr_mf1" class="form-label font-weight-bold">Descripción del cabello</label>
						<input type="text" class="form-control" id="cabello_descr_mf1" name="cabello_descr_mf1" maxlength="200">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="colocacion_ojos_mf1" class="form-label font-weight-bold">Colocación de ojos</label>
						<select class="form-control" id="colocacion_ojos_mf1" name="colocacion_ojos_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->ojoColocacion as $index => $ojoColocacion) { ?>
								<option value="<?= $ojoColocacion->OJOCOLOCACIONID ?>"> <?= $ojoColocacion->OJOCOLOCACIONDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="forma_ojos_mf1" class="form-label font-weight-bold">Forma de ojos</label>
						<select class="form-control" id="forma_ojos_mf1" name="forma_ojos_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->ojoForma as $index => $ojoForma) { ?>
								<option value="<?= $ojoForma->OJOFORMAID ?>"> <?= $ojoForma->OJOFORMADESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="tamano_ojos_mf1" class="form-label font-weight-bold">Tamaño de ojos</label>
						<select class="form-control" id="tamano_ojos_mf1" name="tamano_ojos_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->ojoTamano as $index => $ojoTamano) { ?>
								<option value="<?= $ojoTamano->OJOTAMANOID ?>"> <?= $ojoTamano->OJOTAMANODESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="colorO_mf1" class="form-label font-weight-bold">Color de ojos</label>
						<select class="form-control" id="colorO_mf1" name="colorO_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->ojoColor as $index => $ojoColor) { ?>
								<option value="<?= $ojoColor->OJOCOLORID ?>"> <?= $ojoColor->OJOCOLORDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="peculiaridad_ojos_mf1" class="form-label font-weight-bold">Peculiaridad de ojos</label>
						<select class="form-control" id="peculiaridad_ojos_mf1" name="peculiaridad_ojos_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->ojoPeculiar as $index => $ojoPeculiar) { ?>
								<option value="<?= $ojoPeculiar->OJOPECULIARID ?>"> <?= $ojoPeculiar->OJOPECULIARDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="frente_altura_mf1" class="form-label font-weight-bold">Altura de la frente</label>
						<select class="form-control" id="frente_altura_mf1" name="frente_altura_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->frenteAltura as $index => $frenteAltura) { ?>
								<option value="<?= $frenteAltura->FRENTEALTURAID ?>"> <?= $frenteAltura->FRENTEALTURADESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="frente_anchura_mf1" class="form-label font-weight-bold">Anchura de la frente</label>
						<select class="form-control" id="frente_anchura_mf1" name="frente_anchura_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->frenteAnchura as $index => $frenteAnchura) { ?>
								<option value="<?= $frenteAnchura->FRENTEANCHURAID ?>"> <?= $frenteAnchura->FRENTEANCHURADESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="tipoF_mf1" class="form-label font-weight-bold">Tipo de frente</label>
						<select class="form-control" id="tipoF_mf1" name="tipoF_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->frenteForma as $index => $frenteForma) { ?>
								<option value="<?= $frenteForma->FRENTEFORMAID ?>"> <?= $frenteForma->FRENTEFORMADESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="frente_peculiar_mf1" class="form-label font-weight-bold">Frente peculiar</label>
						<select class="form-control" id="frente_peculiar_mf1" name="frente_peculiar_mf1">
							<option disabled selected value=""></option>
							<?php
							foreach ($body_data->frentePeculiar as $index => $frentePeculiar) { ?>
								<option value="<?= $frentePeculiar->FRENTEPECULIARID ?>"> <?= $frentePeculiar->FRENTEPECULIARDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="colocacion_ceja_mf1" class="form-label font-weight-bold">Colocación de la ceja</label>
						<select class="form-control" id="colocacion_ceja_mf1" name="colocacion_ceja_mf1">
							<option disabled selected value=""></option>
							<?php
							foreach ($body_data->cejaColocacion as $index => $cejaColocacion) { ?>
								<option value="<?= $cejaColocacion->CEJACOLOCACIONID ?>"> <?= $cejaColocacion->CEJACOLOCACIONDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="ceja_mf1" class="form-label font-weight-bold">Forma de la ceja</label>
						<select class="form-control" id="ceja_mf1" name="ceja_mf1">
							<option disabled selected value=""></option>
							<?php
							foreach ($body_data->cejaForma as $index => $cejaForma) { ?>
								<option value="<?= $cejaForma->CEJAFORMAID ?>"> <?= $cejaForma->CEJAFORMADESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="contextura_ceja_mf1" class="form-label font-weight-bold">Contextura de la ceja</label>
						<select class="form-control" id="contextura_ceja_mf1" name="contextura_ceja_mf1">
							<option disabled selected value=""></option>

							<?php
							foreach ($body_data->cejaContextura as $index => $cejaContextura) { ?>
								<option value="<?= $cejaContextura->CONTEXTURAID ?>"> <?= $cejaContextura->CONTEXTURADESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="tamano_ceja_mf1" class="form-label font-weight-bold">Tamaño de la ceja</label>
						<select class="form-control" id="tamano_ceja_mf1" name="tamano_ceja_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->cejaTamano as $index => $cejaTamano) { ?>
								<option value="<?= $cejaTamano->CEJATAMANOID ?>"> <?= $cejaTamano->CEJATAMANODESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="grosor_ceja_mf1" class="form-label font-weight-bold">Grosor de la ceja</label>
						<select class="form-control" id="grosor_ceja_mf1" name="grosor_ceja_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->cejaGrosor as $index => $cejaGrosor) { ?>
								<option value="<?= $cejaGrosor->CEJAGROSORID ?>"> <?= $cejaGrosor->CEJAGROSORDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="nariz_tipo_mf1" class="form-label font-weight-bold">Tipo de nariz</label>
						<select class="form-control" id="nariz_tipo_mf1" name="nariz_tipo_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->narizTipo as $index => $narizTipo) { ?>
								<option value="<?= $narizTipo->NARIZTIPOID ?>"> <?= $narizTipo->NARIZTIPODESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="nariz_tamano_mf1" class="form-label font-weight-bold">Tamaño de nariz</label>
						<select class="form-control" id="nariz_tamano_mf1" name="nariz_tamano_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->narizTamano as $index => $narizTamano) { ?>
								<option value="<?= $narizTamano->NARIZTAMANOID ?>"> <?= $narizTamano->NARIZTAMANODESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="nariz_base_mf1" class="form-label font-weight-bold">Base de nariz</label>
						<select class="form-control" id="nariz_base_mf1" name="nariz_base_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->narizBase as $index => $narizBase) { ?>
								<option value="<?= $narizBase->NARIZBASEID ?>"> <?= $narizBase->NARIZBASEDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="nariz_peculiar_mf1" class="form-label font-weight-bold">Peculiaridad de nariz</label>
						<select class="form-control" id="nariz_peculiar_mf1" name="nariz_peculiar_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->narizPeculiar as $index => $narizPeculiar) { ?>
								<option value="<?= $narizPeculiar->NARIZPECULIARID ?>"> <?= $narizPeculiar->NARIZPECULIARDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="nariz_descr_mf1" class="form-label font-weight-bold">Descripción de la nariz</label>
						<input type="text" class="form-control" id="nariz_descr_mf1" name="nariz_descr_mf1">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="bigote_forma_mf1" class="form-label font-weight-bold">Forma del bigote</label>
						<select class="form-control" id="bigote_forma_mf1" name="bigote_forma_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->bigoteForma as $index => $bigoteForma) { ?>
								<option value="<?= $bigoteForma->BIGOTEFORMAID ?>"> <?= $bigoteForma->BIGOTEFORMADESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="bigote_tamaño_mf1" class="form-label font-weight-bold">Tamaño del bigote</label>
						<select class="form-control" id="bigote_tamaño_mf1" name="bigote_tamaño_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->bigoteTamano as $index => $bigoteTamano) { ?>
								<option value="<?= $bigoteTamano->BIGOTETAMANOID ?>"> <?= $bigoteTamano->BIGOTETAMANODESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="bigote_grosor_mf1" class="form-label font-weight-bold">Grosor del bigote</label>
						<select class="form-control" id="bigote_grosor_mf1" name="bigote_grosor_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->bigoteGrosor as $index => $bigoteGrosor) { ?>
								<option value="<?= $bigoteGrosor->BIGOTEGROSORID ?>"> <?= $bigoteGrosor->BIGOTEGROSORDESCR ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="bigote_peculiar_mf1" class="form-label font-weight-bold">Peculiaridad del bigote</label>
						<select class="form-control" id="bigote_peculiar_mf1" name="bigote_peculiar_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->bigotePeculiar as $index => $bigotePeculiar) { ?>
								<option value="<?= $bigotePeculiar->BIGOTEPECULIARID ?>"> <?= $bigotePeculiar->BIGOTEPECULIARDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="bigote_descr_mf1" class="form-label font-weight-bold">Descripción del bigote</label>
						<input type="text" class="form-control" id="bigote_descr_mf1" name="bigote_descr_mf1">
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="cara_forma_mf1" class="form-label font-weight-bold">Forma de la cara</label>
						<select class="form-control" id="cara_forma_mf1" name="cara_forma_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->caraForma as $index => $caraForma) { ?>
								<option value="<?= $caraForma->CARAFORMAID ?>"> <?= $caraForma->CARAFORMADESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="cara_tamano_mf1" class="form-label font-weight-bold">Tamaño de la cara</label>
						<select class="form-control" id="cara_tamano_mf1" name="cara_tamano_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->caraTamano as $index => $caraTamano) { ?>
								<option value="<?= $caraTamano->CARATAMANOID ?>"> <?= $caraTamano->CARATAMANODESCR ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="boca_tamano_mf1" class="form-label font-weight-bold">Tamaño de la boca</label>
						<select class="form-control" id="boca_tamano_mf1" name="boca_tamano_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->bocaTamano as $index => $bocaTamano) { ?>
								<option value="<?= $bocaTamano->BOCATAMANOID ?>"> <?= $bocaTamano->BOCATAMANODESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="boca_peculiar_mf1" class="form-label font-weight-bold">Peculiaridad de la boca</label>
						<select class="form-control" id="boca_peculiar_mf1" name="boca_peculiar_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->bocaPeculiar as $index => $bocaPeculiar) { ?>
								<option value="<?= $bocaPeculiar->BOCAPECULIARID ?>"> <?= $bocaPeculiar->BOCAPECULIARDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="labio_grosor_mf1" class="form-label font-weight-bold">Grosor de los labios</label>
						<select class="form-control" id="labio_grosor_mf1" name="labio_grosor_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->labioGrosor as $index => $labioGrosor) { ?>
								<option value="<?= $labioGrosor->LABIOGROSORID ?>"> <?= $labioGrosor->LABIOGROSORDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="labio_longitud_mf1" class="form-label font-weight-bold">Tamaño de los labios</label>
						<select class="form-control" id="labio_longitud_mf1" name="labio_longitud_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->labioLongitud as $index => $labioLongitud) { ?>
								<option value="<?= $labioLongitud->LABIOLONGITUDID ?>"> <?= $labioLongitud->LABIOLONGITUDDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="labio_posicion_mf1" class="form-label font-weight-bold">Posición de los labios</label>
						<select class="form-control" id="labio_posicion_mf1" name="labio_posicion_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->labioPosicion as $index => $labioPosicion) { ?>
								<option value="<?= $labioPosicion->LABIOPOSICIONID ?>"> <?= $labioPosicion->LABIOPOSICIONDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="labio_peculiar_mf1" class="form-label font-weight-bold">Peculiaridad de los labios</label>
						<select class="form-control" id="labio_peculiar_mf1" name="labio_peculiar_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->labioPeculiar as $index => $labioPeculiar) { ?>
								<option value="<?= $labioPeculiar->LABIOPECULIARID ?>"> <?= $labioPeculiar->LABIOPECULIARDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="dientes_tamano_mf1" class="form-label font-weight-bold">Tamaño de los dientes</label>
						<select class="form-control" id="dientes_tamano_mf1" name="dientes_tamano_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->dienteTamano as $index => $dienteTamano) { ?>
								<option value="<?= $dienteTamano->DIENTETAMANOID ?>"> <?= $dienteTamano->DIENTETAMANODESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="dientes_tipo_mf1" class="form-label font-weight-bold">Tipo de dientes</label>
						<select class="form-control" id="dientes_tipo_mf1" name="dientes_tipo_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->dienteTipo as $index => $dienteTipo) { ?>
								<option value="<?= $dienteTipo->DIENTETIPOID ?>"> <?= $dienteTipo->DIENTETIPODESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="dientes_peculiar_mf1" class="form-label font-weight-bold">Peculiaridad de los dientes</label>
						<select class="form-control" id="dientes_peculiar_mf1" name="dientes_peculiar_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->dientePeculiar as $index => $dientePeculiar) { ?>
								<option value="<?= $dientePeculiar->DIENTEPECULIARID ?>"> <?= $dientePeculiar->DIENTEPECULIARDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="dientes_descr_mf1" class="form-label font-weight-bold">Descripción de los dientes</label>
						<input type="text" class="form-control" id="dientes_descr_mf1" name="dientes_descr_mf1">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="barbilla_forma_mf1" class="form-label font-weight-bold">Forma de la barbilla</label>
						<select class="form-control" id="barbilla_forma_mf1" name="barbilla_forma_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->barbillaForma as $index => $barbillaForma) { ?>
								<option value="<?= $barbillaForma->BARBILLAFORMAID ?>"> <?= $barbillaForma->BARBILLAFORMADESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="barbilla_tamano_mf1" class="form-label font-weight-bold">Tamaño de la barbilla</label>
						<select class="form-control" id="barbilla_tamano_mf1" name="barbilla_tamano_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->barbillaTamano as $index => $barbillaTamano) { ?>
								<option value="<?= $barbillaTamano->BARBILLATAMANOID ?>"> <?= $barbillaTamano->BARBILLATAMANODESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="barbilla_inclinacion_mf1" class="form-label font-weight-bold">Inclinación de la barbilla</label>
						<select class="form-control" id="barbilla_inclinacion_mf1" name="barbilla_inclinacion_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->barbillaInclinacion as $index => $barbillaInclinacion) { ?>
								<option value="<?= $barbillaInclinacion->BARBILLAINCLINACIONID ?>"> <?= $barbillaInclinacion->BARBILLAINCLINACIONDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="barbilla_peculiar_mf1" class="form-label font-weight-bold">Peculiaridad de la barbilla</label>
						<select class="form-control" id="barbilla_peculiar_mf1" name="barbilla_peculiar_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->barbillaPeculiar as $index => $barbillaPeculiar) { ?>
								<option value="<?= $barbillaPeculiar->BARBILLAPECULIARID ?>"> <?= $barbillaPeculiar->BARBILLAPECULIARDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="barbilla_descr_mf1" class="form-label font-weight-bold">Descripción de la barbilla</label>
						<input type="text" class="form-control" id="barbilla_descr_mf1" name="barbilla_descr_mf1">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="barba_tamano_mf1" class="form-label font-weight-bold">Tamaño de la barba</label>
						<select class="form-control" id="barba_tamano_mf1" name="barba_tamano_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->barbaTamano as $index => $barbaTamano) { ?>
								<option value="<?= $barbaTamano->BARBATAMANOID ?>"> <?= $barbaTamano->BARBATAMANODESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="barba_peculiar_mf1" class="form-label font-weight-bold">Peculiaridad de la barba</label>
						<select class="form-control" id="barba_peculiar_mf1" name="barba_peculiar_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->barbaPeculiar as $index => $barbaPeculiar) { ?>
								<option value="<?= $barbaPeculiar->BARBAPECULIARID ?>"> <?= $barbaPeculiar->BARBAPECULIARDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="barba_descr_mf1" class="form-label font-weight-bold">Descripción de la barba</label>
						<input type="text" class="form-control" id="barba_descr_mf1" name="barba_descr_mf1">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="cuello_tamano_mf1" class="form-label font-weight-bold">Tamaño del cuello</label>
						<select class="form-control" id="cuello_tamano_mf1" name="cuello_tamano_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->cuelloTamano as $index => $cuelloTamano) { ?>
								<option value="<?= $cuelloTamano->CUELLOTAMANOID ?>"> <?= $cuelloTamano->CUELLOTAMANODESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="cuello_grosor_mf1" class="form-label font-weight-bold">Grosor del cuello</label>
						<select class="form-control" id="cuello_grosor_mf1" name="cuello_grosor_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->cuelloGrosor as $index => $cuelloGrosor) { ?>
								<option value="<?= $cuelloGrosor->CUELLOGROSORID ?>"> <?= $cuelloGrosor->CUELLOGROSORDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="cuello_peculiar_mf1" class="form-label font-weight-bold">Peculiaridad del cuello</label>
						<select class="form-control" id="cuello_peculiar_mf1" name="cuello_peculiar_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->cuelloPeculiar as $index => $cuelloPeculiar) { ?>
								<option value="<?= $cuelloPeculiar->CUELLOPECULIARID ?>"> <?= $cuelloPeculiar->CUELLOPECULIARDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="cuello_descr_mf1" class="form-label font-weight-bold">Descripción del cuello</label>
						<input type="text" class="form-control" id="cuello_descr_mf1" name="cuello_descr_mf1">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="hombro_posicion_mf1" class="form-label font-weight-bold">Posición de los hombros</label>
						<select class="form-control" id="hombro_posicion_mf1" name="hombro_posicion_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->hombroPosicion as $index => $hombroPosicion) { ?>
								<option value="<?= $hombroPosicion->HOMBROPOSICIONID ?>"> <?= $hombroPosicion->HOMBROPOSICIONDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="hombro_tamano_mf1" class="form-label font-weight-bold">Tamaño de los hombros</label>
						<select class="form-control" id="hombro_tamano_mf1" name="hombro_tamano_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->hombroLongitud as $index => $hombroLongitud) { ?>
								<option value="<?= $hombroLongitud->HOMBROLONGITUDID ?>"> <?= $hombroLongitud->HOMBROLONGITUDDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="hombro_grosor_mf1" class="form-label font-weight-bold">Grosor de los hombros</label>
						<select class="form-control" id="hombro_grosor_mf1" name="hombro_grosor_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->hombroGrosor as $index => $hombroGrosor) { ?>
								<option value="<?= $hombroGrosor->HOMBROGROSORID ?>"> <?= $hombroGrosor->HOMBROGROSORDESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="lobulo_mf1" class="form-label font-weight-bold">Lóbulo de la oreja</label>
						<select class="form-control" id="lobulo_mf1" name="lobulo_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->orejaLobulo as $index => $orejaLobulo) { ?>
								<option value="<?= $orejaLobulo->OREJALOBULOID ?>"> <?= $orejaLobulo->OREJALOBULODESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="forma_oreja_mf1" class="form-label font-weight-bold">Forma de la oreja</label>
						<select class="form-control" id="forma_oreja_mf1" name="forma_oreja_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->orejaLobulo as $index => $orejaLobulo) { ?>
								<option value="<?= $orejaLobulo->OREJALOBULOID ?>"> <?= $orejaLobulo->OREJALOBULODESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="tamano_oreja_mf1" class="form-label font-weight-bold">Tamaño de la oreja</label>
						<select class="form-control" id="tamano_oreja_mf1" name="tamano_oreja_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->orejaTamano as $index => $orejaTamano) { ?>
								<option value="<?= $orejaTamano->OREJATAMANOID ?>"> <?= $orejaTamano->OREJATAMANODESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="estomago_mf1" class="form-label font-weight-bold">Tipo de estómago</label>
						<select class="form-control" id="estomago_mf1" name="estomago_mf1">
							<option disabled disabled selected value=""></option>
							<?php
							foreach ($body_data->estomago as $index => $estomago) { ?>
								<option value="<?= $estomago->ESTOMAGOID  ?>"> <?= $estomago->ESTOMAGODESCR ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="estomago_descr_mf1" class="form-label font-weight-bold">Descripción del estómago</label>
						<input type="text" class="form-control" id="estomago_descr_mf1" name="estomago_descr_mf1" maxlength="200">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="discapacidad_mf1" class="form-label font-weight-bold">Discapacidad</label>
						<input type="text" class="form-control" id="discapacidad_mf1" name="discapacidad_mf1" maxlength="200">
					</div>
					<!-- <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="origen_mf1" class="form-label font-weight-bold">Origen</label>
						<input type="text" class="form-control" id="origen_mf1" name="origen_mf1">
					</div> -->
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="diaDesaparicion1" class="form-label font-weight-bold">Dia de desaparición</label>
						<input type="date" data-date="" data-date-format="DD MMMM YYYY" class="form-control" id="diaDesaparicion1" name="diaDesaparicion1" max="<?= date("Y-m-d") ?>">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="lugarDesaparicion" class="form-label font-weight-bold">Lugar de desaparición</label>
						<input type="text" class="form-control" id="lugarDesaparicion1" name="lugarDesaparicion1" maxlength="200">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="vestimenta_mf1" class="form-label font-weight-bold">Vestimenta</label>
						<input type="text" class="form-control" id="vestimenta_mf1" name="vestimenta_mf1" maxlength="200">
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="ocupacion_mf1" class="form-label font-weight-bold">Profesión u Oficio</label>
						<select class="form-control" id="ocupacion_mf1" name="ocupacion_mf1">
							<option disabled disabled selected value=""></option>
							<?php foreach ($body_data->ocupaciones as $index => $ocupaciones) { ?>
								<option value="<?= $ocupaciones->PERSONAOCUPACIONID ?>"> <?= $ocupaciones->PERSONAOCUPACIONDESCR ?> </option>
							<?php } ?>
						</select>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="escolaridad_mf1" class="form-label font-weight-bold">Escolaridad</label>
						<select class="form-control" id="escolaridad_mf1" name="escolaridad_mf1">
							<option disabled disabled selected value=""></option>
							<?php foreach ($body_data->escolaridades as $index => $escolaridades) { ?>
								<option value="<?= $escolaridades->PERSONAESCOLARIDADID ?>"> <?= $escolaridades->PERSONAESCOLARIDADDESCR ?> </option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 mb-3 text-center">
						<button type="submit" id="insertPersonaFisica" name="insertPersonaFisica" class="btn btn-primary font-weight-bold">AGREGAR PERSONA FÍSICA</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
<script>
	document.querySelector('#ocupacion_new').addEventListener('change', (e) => {
		let select_ocupacion = document.querySelector('#ocupacion_new');
		let input_ocupacion = document.querySelector('#ocupacion_descr_new');

		if (e.target.value === '999') {
			select_ocupacion.classList.add('d-none');
			input_ocupacion.classList.remove('d-none');
			input_ocupacion.value = "";
			input_ocupacion.focus();
		} else {
			input_ocupacion.value = "";
		}
	});
	document.querySelector('#estado_select_origen_new').addEventListener('change', (e) => {
		let select_municipio = document.querySelector('#municipio_select_origen_new');


		clearSelect(select_municipio);


		select_municipio.value = '';


		let data = {
			'estado_id': e.target.value,
		}

		$.ajax({
			data: data,
			url: "<?= base_url('/data/get-municipios-by-estado') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				let municipios = response.data;

				municipios.forEach(municipio => {
					var option = document.createElement("option");
					option.text = municipio.MUNICIPIODESCR;
					option.value = municipio.MUNICIPIOID;
					select_municipio.add(option);
				});
			},
			error: function(jqXHR, textStatus, errorThrown) {}
		});

	});

	document.querySelector('#estado_select_new').addEventListener('change', (e) => {
		let select_municipio = document.querySelector('#municipio_select_new');
		let select_colonia = document.querySelector('#colonia_select_new');
		let input_colonia = document.querySelector('#colonia_new');

		clearSelect(select_municipio);


		select_municipio.value = '';


		let data = {
			'estado_id': e.target.value,
		}

		$.ajax({
			data: data,
			url: "<?= base_url('/data/get-municipios-by-estado') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				let municipios = response.data;

				municipios.forEach(municipio => {
					var option = document.createElement("option");
					option.text = municipio.MUNICIPIODESCR;
					option.value = municipio.MUNICIPIOID;
					select_municipio.add(option);
				});
			},
			error: function(jqXHR, textStatus, errorThrown) {}
		});
		if (e.target.value != 2) {
			var option = document.createElement("option");
			option.text = 'OTRO';
			option.value = '0';
			select_colonia.add(option);
			select_colonia.value = '0';
			input_colonia.value = '-';
			select_colonia.classList.add('d-none');
			input_colonia.classList.remove('d-none');
		}
	});
	document.querySelector('#municipio_select_new').addEventListener('change', (e) => {
		let select_localidad = document.querySelector('#localidad_select_new');
		let select_colonia = document.querySelector('#colonia_select_new');
		let input_colonia = document.querySelector('#colonia_new');

		let estado = document.querySelector('#estado_select_new').value;
		let municipio = e.target.value;

		clearSelect(select_localidad);
		clearSelect(select_colonia);

		select_localidad.value = '';

		let data = {
			'estado_id': estado,
			'municipio_id': municipio
		};

		$.ajax({
			data: data,
			url: "<?= base_url('/data/get-localidades-by-municipio') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				let localidades = response.data;

				localidades.forEach(localidad => {
					var option = document.createElement("option");
					option.text = localidad.LOCALIDADDESCR;
					option.value = localidad.LOCALIDADID;
					select_localidad.add(option);
				});
			},
			error: function(jqXHR, textStatus, errorThrown) {}
		});
	});

	document.querySelector('#localidad_select_new').addEventListener('change', (e) => {
		let select_colonia = document.querySelector('#colonia_select_new');
		let input_colonia = document.querySelector('#colonia_new');

		let estado = document.querySelector('#estado_select_new').value;
		let municipio = document.querySelector('#municipio_select_new').value;
		let localidad = e.target.value;

		clearSelect(select_colonia);
		select_colonia.value = '';

		let data = {
			'estado_id': estado,
			'municipio_id': municipio,
			'localidad_id': localidad
		};

		console.log(data);

		if (estado == 2) {
			select_colonia.classList.remove('d-none');
			input_colonia.classList.add('d-none');
			input_colonia.value = '-';
			$.ajax({
				data: data,
				url: "<?= base_url('/data/get-colonias-by-estado-municipio-localidad') ?>",
				method: "POST",
				dataType: "json",
				success: function(response) {
					let colonias = response.data;

					colonias.forEach(colonia => {
						var option = document.createElement("option");
						option.text = colonia.COLONIADESCR;
						option.value = colonia.COLONIAID;
						select_colonia.add(option);
					});

					var option = document.createElement("option");
					option.text = 'OTRO';
					option.value = '0';
					select_colonia.add(option);
				},
				error: function(jqXHR, textStatus, errorThrown) {}
			});

		} else {
			var option = document.createElement("option");
			option.text = '';
			option.value = '';
			select_colonia.add(option);
			select_colonia.value = '';
			input_colonia.value = '';
			select_colonia.classList.add('d-none');
			input_colonia.classList.remove('d-none');
		}
	});

	document.querySelector('#colonia_select_new').addEventListener('change', (e) => {
		let select_colonia = document.querySelector('#colonia_select_new');
		let input_colonia = document.querySelector('#colonia_new');

		if (e.target.value === '0') {
			select_colonia.classList.add('d-none');
			input_colonia.classList.remove('d-none');
			input_colonia.value = '';
		} else {
			select_colonia.classList.remove('d-none');
			input_colonia.classList.add('d-none');
			input_colonia.value = '-';
		}
	});
	// $("#insert_persona_victima_modal_denuncia").one("hidden.bs.modal", function() {
	// 	document.getElementById("persona_fisica_form_insert_denunciaA").reset();
	// 		});

</script>
