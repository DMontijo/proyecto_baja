
<div class="row p-0 m-0">
    	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="etnia_mf" class="form-label font-weight-bold">Etnia</label>
		<select class="form-control" id="etnia_mf" name="etnia_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->etnia as $index => $etnia) { ?>
				<option value="<?= $etnia->PERSONAETNIAID ?>"> <?= $etnia->PERSONAETNIADESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="estatura_mf" class="form-label font-weight-bold">Estatura (cm)</label>
		<input type="number" class="form-control" id="estatura_mf" name="estatura_mf">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="peso_mf" class="form-label font-weight-bold">Peso (kg)</label>
		<input type="number" class="form-control" id="peso_mf" name="peso_mf">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="complexion_mf" class="form-label font-weight-bold">Complexión</label>
		<select class="form-control" id="complexion_mf" name="complexion_mf">
			<option disabled selected value=""></option>
			<?php
			foreach ($body_data->figura as $index => $figura) { ?>
				<option value="<?= $figura->FIGURAID ?>"> <?= $figura->FIGURADESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="colortez_mf" class="form-label font-weight-bold">Color de tez</label>
		<select class="form-control" id="colortez_mf" name="colortez_mf">
			<option disabled selected value=""></option>
			<?php
			foreach ($body_data->pielColor as $index => $pielColor) { ?>
				<option value="<?= $pielColor->PIELCOLORID ?>"> <?= $pielColor->PIELCOLORDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="caratez_mf" class="form-label font-weight-bold">Tez de la cara</label>
		<select class="form-control" id="caratez_mf" name="caratez_mf">
			<option disabled selected value=""></option>
			<?php
			foreach ($body_data->caraTez as $index => $caraTez) { ?>
				<option value="<?= $caraTez->CARATEZID ?>"> <?= $caraTez->CARATEZDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="senas_mf" class="form-label font-weight-bold">Señas particulares</label>
		<input type="text" class="form-control" id="senas_mf" name="senas_mf" maxlength="200">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="identidad_mf" class="form-label font-weight-bold">Identidad</label>
		<input type="text" class="form-control" id="identidad_mf" name="identidad_mf" maxlength="200">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="colorC_mf" class="form-label font-weight-bold">Color del cabello</label>
		<select class="form-control" id="colorC_mf" name="colorC_mf">
			<option disabled selected value=""></option>
			<?php
			foreach ($body_data->cabelloColor as $index => $cabelloColor) { ?>
				<option value="<?= $cabelloColor->CABELLOCOLORID ?>"> <?= $cabelloColor->CABELLOCOLORDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="tamanoC_mf" class="form-label font-weight-bold">Tamaño del cabello</label>
		<select class="form-control" id="tamanoC_mf" name="tamanoC_mf">
			<option disabled selected value=""></option>

			<?php
			foreach ($body_data->cabelloTamano as $index => $cabelloTamano) { ?>
				<option value="<?= $cabelloTamano->CABELLOTAMANOID ?>"> <?= $cabelloTamano->CABELLOTAMANODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="formaC_mf" class="form-label font-weight-bold">Forma del cabello</label>
		<select class="form-control" id="formaC_mf" name="formaC_mf">
			<option disabled selected value=""></option>
			<?php
			foreach ($body_data->cabelloEstilo as $index => $cabelloEstilo) { ?>
				<option value="<?= $cabelloEstilo->CABELLOESTILOID  ?>"> <?= $cabelloEstilo->CABELLOESTILODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="peculiarC_mf" class="form-label font-weight-bold">Cabello peculiar</label>
		<select class="form-control" id="peculiarC_mf" name="peculiarC_mf">
			<option disabled selected value=""></option>
			<?php
			foreach ($body_data->cabelloPeculiar as $index => $cabelloPeculiar) { ?>
				<option value="<?= $cabelloPeculiar->CABELLOPECULIARID  ?>"> <?= $cabelloPeculiar->CABELLOPECULIARDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="cabello_descr_mf" class="form-label font-weight-bold">Descripción del cabello</label>
		<input type="text" class="form-control" id="cabello_descr_mf" name="cabello_descr_mf" maxlength="200">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="colocacion_ojos_mf" class="form-label font-weight-bold">Colocación de ojos</label>
		<select class="form-control" id="colocacion_ojos_mf" name="colocacion_ojos_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->ojoColocacion as $index => $ojoColocacion) { ?>
				<option value="<?= $ojoColocacion->OJOCOLOCACIONID ?>"> <?= $ojoColocacion->OJOCOLOCACIONDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="forma_ojos_mf" class="form-label font-weight-bold">Forma de ojos</label>
		<select class="form-control" id="forma_ojos_mf" name="forma_ojos_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->ojoForma as $index => $ojoForma) { ?>
				<option value="<?= $ojoForma->OJOFORMAID ?>"> <?= $ojoForma->OJOFORMADESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="tamano_ojos_mf" class="form-label font-weight-bold">Tamaño de ojos</label>
		<select class="form-control" id="tamano_ojos_mf" name="tamano_ojos_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->ojoTamano as $index => $ojoTamano) { ?>
				<option value="<?= $ojoTamano->OJOTAMANOID ?>"> <?= $ojoTamano->OJOTAMANODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="colorO_mf" class="form-label font-weight-bold">Color de ojos</label>
		<select class="form-control" id="colorO_mf" name="colorO_mf">
			<option disabled selected value=""></option>
			<?php
			foreach ($body_data->ojoColor as $index => $ojoColor) { ?>
				<option value="<?= $ojoColor->OJOCOLORID ?>"> <?= $ojoColor->OJOCOLORDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="peculiaridad_ojos_mf" class="form-label font-weight-bold">Peculiaridad de ojos</label>
		<select class="form-control" id="peculiaridad_ojos_mf" name="peculiaridad_ojos_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->ojoPeculiar as $index => $ojoPeculiar) { ?>
				<option value="<?= $ojoPeculiar->OJOPECULIARID ?>"> <?= $ojoPeculiar->OJOPECULIARDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="frente_altura_mf" class="form-label font-weight-bold">Altura de la frente</label>
		<select class="form-control" id="frente_altura_mf" name="frente_altura_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->frenteAltura as $index => $frenteAltura) { ?>
				<option value="<?= $frenteAltura->FRENTEALTURAID ?>"> <?= $frenteAltura->FRENTEALTURADESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="frente_anchura_ms" class="form-label font-weight-bold">Anchura de la frente</label>
		<select class="form-control" id="frente_anchura_ms" name="frente_anchura_ms">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->frenteAnchura as $index => $frenteAnchura) { ?>
				<option value="<?= $frenteAnchura->FRENTEANCHURAID ?>"> <?= $frenteAnchura->FRENTEANCHURADESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="tipoF_mf" class="form-label font-weight-bold">Tipo de frente</label>
		<select class="form-control" id="tipoF_mf" name="tipoF_mf">
			<option disabled selected value=""></option>
			<?php
			foreach ($body_data->frenteForma as $index => $frenteForma) { ?>
				<option value="<?= $frenteForma->FRENTEFORMAID ?>"> <?= $frenteForma->FRENTEFORMADESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="frente_peculiar_mf" class="form-label font-weight-bold">Frente peculiar</label>
		<select class="form-control" id="frente_peculiar_mf" name="frente_peculiar_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->frentePeculiar as $index => $frentePeculiar) { ?>
				<option value="<?= $frentePeculiar->FRENTEPECULIARID ?>"> <?= $frentePeculiar->FRENTEPECULIARDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="colocacion_ceja_mf" class="form-label font-weight-bold">Colocación de la ceja</label>
		<select class="form-control" id="colocacion_ceja_mf" name="colocacion_ceja_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->cejaColocacion as $index => $cejaColocacion) { ?>
				<option value="<?= $cejaColocacion->CEJACOLOCACIONID ?>"> <?= $cejaColocacion->CEJACOLOCACIONDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="ceja_mf" class="form-label font-weight-bold">Forma de la ceja</label>
		<select class="form-control" id="ceja_mf" name="ceja_mf">
			<option disabled selected value=""></option>
			<?php
			foreach ($body_data->cejaForma as $index => $cejaForma) { ?>
				<option value="<?= $cejaForma->CEJAFORMAID ?>"> <?= $cejaForma->CEJAFORMADESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="contextura_ceja_mf" class="form-label font-weight-bold">Contextura de la ceja</label>
		<select class="form-control" id="contextura_ceja_mf" name="contextura_ceja_mf">
		<option disabled selected value=""></option>

			<?php
			foreach ($body_data->cejaContextura as $index => $cejaContextura) { ?>
				<option value="<?= $cejaContextura->CONTEXTURAID ?>"> <?= $cejaContextura->CONTEXTURADESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="tamano_ceja_mf" class="form-label font-weight-bold">Tamaño de la ceja</label>
		<select class="form-control" id="tamano_ceja_mf" name="tamano_ceja_mf">
		<option  disabled selected value=""></option>
			<?php
			foreach ($body_data->cejaTamano as $index => $cejaTamano) { ?>
				<option value="<?= $cejaTamano->CEJATAMANOID ?>"> <?= $cejaTamano->CEJATAMANODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="grosor_ceja_mf" class="form-label font-weight-bold">Grosor de la ceja</label>
		<select class="form-control" id="grosor_ceja_mf" name="grosor_ceja_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->cejaGrosor as $index => $cejaGrosor) { ?>
				<option value="<?= $cejaGrosor->CEJAGROSORID ?>"> <?= $cejaGrosor->CEJAGROSORDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nariz_tipo_mf" class="form-label font-weight-bold">Tipo de nariz</label>
		<select class="form-control" id="nariz_tipo_mf" name="nariz_tipo_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->narizTipo as $index => $narizTipo) { ?>
				<option value="<?= $narizTipo->NARIZTIPOID ?>"> <?= $narizTipo->NARIZTIPODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nariz_tamano_mf" class="form-label font-weight-bold">Tamaño de nariz</label>
		<select class="form-control" id="nariz_tamano_mf" name="nariz_tamano_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->narizTamano as $index => $narizTamano) { ?>
				<option value="<?= $narizTamano->NARIZTAMANOID ?>"> <?= $narizTamano->NARIZTAMANODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nariz_base_mf" class="form-label font-weight-bold">Base de nariz</label>
		<select class="form-control" id="nariz_base_mf" name="nariz_base_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->narizBase as $index => $narizBase) { ?>
				<option value="<?= $narizBase->NARIZBASEID ?>"> <?= $narizBase->NARIZBASEDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nariz_peculiar_mf" class="form-label font-weight-bold">Peculiaridad de nariz</label>
		<select class="form-control" id="nariz_peculiar_mf" name="nariz_peculiar_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->narizPeculiar as $index => $narizPeculiar) { ?>
				<option value="<?= $narizPeculiar->NARIZPECULIARID ?>"> <?= $narizPeculiar->NARIZPECULIARDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="nariz_descr_mf" class="form-label font-weight-bold">Descripción de la nariz</label>
		<input type="text" class="form-control" id="nariz_descr_mf" name="nariz_descr_mf">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="bigote_forma_mf" class="form-label font-weight-bold">Forma del bigote</label>
		<select class="form-control" id="bigote_forma_mf" name="bigote_forma_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->bigoteForma as $index => $bigoteForma) { ?>
				<option value="<?= $bigoteForma->BIGOTEFORMAID ?>"> <?= $bigoteForma->BIGOTEFORMADESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="bigote_tamaño_mf" class="form-label font-weight-bold">Tamaño del bigote</label>
		<select class="form-control" id="bigote_tamaño_mf" name="bigote_tamaño_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->bigoteTamano as $index => $bigoteTamano) { ?>
				<option value="<?= $bigoteTamano->BIGOTETAMANOID ?>"> <?= $bigoteTamano->BIGOTETAMANODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="bigote_grosor_mf" class="form-label font-weight-bold">Grosor del bigote</label>
		<select class="form-control" id="bigote_grosor_mf" name="bigote_grosor_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->bigoteGrosor as $index => $bigoteGrosor) { ?>
				<option value="<?= $bigoteGrosor->BIGOTEGROSORID ?>"> <?= $bigoteGrosor->BIGOTEGROSORDESCR ?></option>
			<?php } ?>
		</select>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="bigote_peculiar_mf" class="form-label font-weight-bold">Peculiaridad del bigote</label>
		<select class="form-control" id="bigote_peculiar_mf" name="bigote_peculiar_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->bigotePeculiar as $index => $bigotePeculiar) { ?>
				<option value="<?= $bigotePeculiar->BIGOTEPECULIARID ?>"> <?= $bigotePeculiar->BIGOTEPECULIARDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="bigote_descr_mf" class="form-label font-weight-bold">Descripción del bigote</label>
		<input type="text" class="form-control" id="bigote_descr_mf" name="bigote_descr_mf">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="cara_forma_mf" class="form-label font-weight-bold">Forma de la cara</label>
		<select class="form-control" id="cara_forma_mf" name="cara_forma_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->caraForma as $index => $caraForma) { ?>
				<option value="<?= $caraForma->CARAFORMAID ?>"> <?= $caraForma->CARAFORMADESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="cara_tamano_mf" class="form-label font-weight-bold">Tamaño de la cara</label>
		<select class="form-control" id="cara_tamano_mf" name="cara_tamano_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->caraTamano as $index => $caraTamano) { ?>
				<option value="<?= $caraTamano->CARATAMANOID ?>"> <?= $caraTamano->CARATAMANODESCR ?></option>
			<?php } ?>
		</select>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="boca_tamano_mf" class="form-label font-weight-bold">Tamaño de la boca</label>
		<select class="form-control" id="boca_tamano_mf" name="boca_tamano_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->bocaTamano as $index => $bocaTamano) { ?>
				<option value="<?= $bocaTamano->BOCATAMANOID ?>"> <?= $bocaTamano->BOCATAMANODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="boca_peculiar_mf" class="form-label font-weight-bold">Peculiaridad de la boca</label>
		<select class="form-control" id="boca_peculiar_mf" name="boca_peculiar_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->bocaPeculiar as $index => $bocaPeculiar) { ?>
				<option value="<?= $bocaPeculiar->BOCAPECULIARID ?>"> <?= $bocaPeculiar->BOCAPECULIARDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="labio_grosor_mf" class="form-label font-weight-bold">Grosor de los labios</label>
		<select class="form-control" id="labio_grosor_mf" name="labio_grosor_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->labioGrosor as $index => $labioGrosor) { ?>
				<option value="<?= $labioGrosor->LABIOGROSORID ?>"> <?= $labioGrosor->LABIOGROSORDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="labio_longitud_mf" class="form-label font-weight-bold">Tamaño de los labios</label>
		<select class="form-control" id="labio_longitud_mf" name="labio_longitud_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->labioLongitud as $index => $labioLongitud) { ?>
				<option value="<?= $labioLongitud->LABIOLONGITUDID ?>"> <?= $labioLongitud->LABIOLONGITUDDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="labio_posicion_mf" class="form-label font-weight-bold">Posición de los labios</label>
		<select class="form-control" id="labio_posicion_mf" name="labio_posicion_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->labioPosicion as $index => $labioPosicion) { ?>
				<option value="<?= $labioPosicion->LABIOPOSICIONID ?>"> <?= $labioPosicion->LABIOPOSICIONDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="labio_peculiar_mf" class="form-label font-weight-bold">Peculiaridad de los labios</label>
		<select class="form-control" id="labio_peculiar_mf" name="labio_peculiar_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->labioPeculiar as $index => $labioPeculiar) { ?>
				<option value="<?= $labioPeculiar->LABIOPECULIARID ?>"> <?= $labioPeculiar->LABIOPECULIARDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="dientes_tamano_mf" class="form-label font-weight-bold">Tamaño de los dientes</label>
		<select class="form-control" id="dientes_tamano_mf" name="dientes_tamano_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->dienteTamano as $index => $dienteTamano) { ?>
				<option value="<?= $dienteTamano->DIENTETAMANOID ?>"> <?= $dienteTamano->DIENTETAMANODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="dientes_tipo_mf" class="form-label font-weight-bold">Tipo de dientes</label>
		<select class="form-control" id="dientes_tipo_mf" name="dientes_tipo_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->dienteTipo as $index => $dienteTipo) { ?>
				<option value="<?= $dienteTipo->DIENTETIPOID ?>"> <?= $dienteTipo->DIENTETIPODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="dientes_peculiar_mf" class="form-label font-weight-bold">Peculiaridad de los dientes</label>
		<select class="form-control" id="dientes_peculiar_mf" name="dientes_peculiar_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->dientePeculiar as $index => $dientePeculiar) { ?>
				<option value="<?= $dientePeculiar->DIENTEPECULIARID ?>"> <?= $dientePeculiar->DIENTEPECULIARDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="dientes_descr_mf" class="form-label font-weight-bold">Descripción de los dientes</label>
		<input type="text" class="form-control" id="dientes_descr_mf" name="dientes_descr_mf">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="barbilla_forma_mf" class="form-label font-weight-bold">Forma de la barbilla</label>
		<select class="form-control" id="barbilla_forma_mf" name="barbilla_forma_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->barbillaForma as $index => $barbillaForma) { ?>
				<option value="<?= $barbillaForma->BARBILLAFORMAID ?>"> <?= $barbillaForma->BARBILLAFORMADESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="barbilla_tamano_mf" class="form-label font-weight-bold">Tamaño de la barbilla</label>
		<select class="form-control" id="barbilla_tamano_mf" name="barbilla_tamano_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->barbillaTamano as $index => $barbillaTamano) { ?>
				<option value="<?= $barbillaTamano->BARBILLATAMANOID ?>"> <?= $barbillaTamano->BARBILLATAMANODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="barbilla_inclinacion_mf" class="form-label font-weight-bold">Inclinación de la barbilla</label>
		<select class="form-control" id="barbilla_inclinacion_mf" name="barbilla_inclinacion_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->barbillaInclinacion as $index => $barbillaInclinacion) { ?>
				<option value="<?= $barbillaInclinacion->BARBILLAINCLINACIONID ?>"> <?= $barbillaInclinacion->BARBILLAINCLINACIONDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="barbilla_peculiar_mf" class="form-label font-weight-bold">Peculiaridad de la barbilla</label>
		<select class="form-control" id="barbilla_peculiar_mf" name="barbilla_peculiar_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->barbillaPeculiar as $index => $barbillaPeculiar) { ?>
				<option value="<?= $barbillaPeculiar->BARBILLAPECULIARID ?>"> <?= $barbillaPeculiar->BARBILLAPECULIARDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="barbilla_descr_mf" class="form-label font-weight-bold">Descripción de la barbilla</label>
		<input type="text" class="form-control" id="barbilla_descr_mf" name="barbilla_descr_mf">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="barba_tamano_mf" class="form-label font-weight-bold">Tamaño de la barba</label>
		<select class="form-control" id="barba_tamano_mf" name="barba_tamano_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->barbaTamano as $index => $barbaTamano) { ?>
				<option value="<?= $barbaTamano->BARBATAMANOID ?>"> <?= $barbaTamano->BARBATAMANODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="barba_peculiar_mf" class="form-label font-weight-bold">Peculiaridad de la barba</label>
		<select class="form-control" id="barba_peculiar_mf" name="barba_peculiar_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->barbaPeculiar as $index => $barbaPeculiar) { ?>
				<option value="<?= $barbaPeculiar->BARBAPECULIARID ?>"> <?= $barbaPeculiar->BARBAPECULIARDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="barba_descr_mf" class="form-label font-weight-bold">Descripción de la barba</label>
		<input type="text" class="form-control" id="barba_descr_mf" name="barba_descr_mf">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="cuello_tamano_mf" class="form-label font-weight-bold">Tamaño del cuello</label>
		<select class="form-control" id="cuello_tamano_mf" name="cuello_tamano_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->cuelloTamano as $index => $cuelloTamano) { ?>
				<option value="<?= $cuelloTamano->CUELLOTAMANOID ?>"> <?= $cuelloTamano->CUELLOTAMANODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="cuello_grosor_mf" class="form-label font-weight-bold">Grosor del cuello</label>
		<select class="form-control" id="cuello_grosor_mf" name="cuello_grosor_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->cuelloGrosor as $index => $cuelloGrosor) { ?>
				<option value="<?= $cuelloGrosor->CUELLOGROSORID ?>"> <?= $cuelloGrosor->CUELLOGROSORDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="cuello_peculiar_mf" class="form-label font-weight-bold">Peculiaridad del cuello</label>
		<select class="form-control" id="cuello_peculiar_mf" name="cuello_peculiar_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->cuelloPeculiar as $index => $cuelloPeculiar) { ?>
				<option value="<?= $cuelloPeculiar->CUELLOPECULIARID ?>"> <?= $cuelloPeculiar->CUELLOPECULIARDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="cuello_descr_mf" class="form-label font-weight-bold">Descripción del cuello</label>
		<input type="text" class="form-control" id="cuello_descr_mf" name="cuello_descr_mf">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="hombro_posicion_mf" class="form-label font-weight-bold">Posición de los hombros</label>
		<select class="form-control" id="hombro_posicion_mf" name="hombro_posicion_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->hombroPosicion as $index => $hombroPosicion) { ?>
				<option value="<?= $hombroPosicion->HOMBROPOSICIONID ?>"> <?= $hombroPosicion->HOMBROPOSICIONDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="hombro_tamano_mf" class="form-label font-weight-bold">Tamaño de los hombros</label>
		<select class="form-control" id="hombro_tamano_mf" name="hombro_tamano_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->hombroLongitud as $index => $hombroLongitud) { ?>
				<option value="<?= $hombroLongitud->HOMBROLONGITUDID ?>"> <?= $hombroLongitud->HOMBROLONGITUDDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="hombro_grosor_mf" class="form-label font-weight-bold">Grosor de los hombros</label>
		<select class="form-control" id="hombro_grosor_mf" name="hombro_grosor_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->hombroGrosor as $index => $hombroGrosor) { ?>
				<option value="<?= $hombroGrosor->HOMBROGROSORID ?>"> <?= $hombroGrosor->HOMBROGROSORDESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="lobulo_mf" class="form-label font-weight-bold">Lobulo de la oreja</label>
		<select class="form-control" id="lobulo_mf" name="lobulo_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->orejaLobulo as $index => $orejaLobulo) { ?>
				<option value="<?= $orejaLobulo->OREJALOBULOID ?>"> <?= $orejaLobulo->OREJALOBULODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="forma_oreja_mf" class="form-label font-weight-bold">Forma de la oreja</label>
		<select class="form-control" id="forma_oreja_mf" name="forma_oreja_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->orejaLobulo as $index => $orejaLobulo) { ?>
				<option value="<?= $orejaLobulo->OREJALOBULOID ?>"> <?= $orejaLobulo->OREJALOBULODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="tamano_oreja_mf" class="form-label font-weight-bold">Tamaño de la oreja</label>
		<select class="form-control" id="tamano_oreja_mf" name="tamano_oreja_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->orejaTamano as $index => $orejaTamano) { ?>
				<option value="<?= $orejaTamano->OREJATAMANOID ?>"> <?= $orejaTamano->OREJATAMANODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="estomago_mf" class="form-label font-weight-bold">Tipo de estómago</label>
		<select class="form-control" id="estomago_mf" name="estomago_mf">
		<option disabled selected value=""></option>
			<?php
			foreach ($body_data->estomago as $index => $estomago) { ?>
				<option value="<?= $estomago->ESTOMAGOID  ?>"> <?= $estomago->ESTOMAGODESCR ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="estomago_descr_mf" class="form-label font-weight-bold">Descripción del estómago</label>
		<input type="text" class="form-control" id="estomago_descr_mf" name="estomago_descr_mf" maxlength="200">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="discapacidad_mf" class="form-label font-weight-bold">Discapacidad</label>
		<input type="text" class="form-control" id="discapacidad_mf" name="discapacidad_mf" maxlength="200">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="origen_mf" class="form-label font-weight-bold">Origen</label>
		<input type="text" class="form-control" id="origen_mf" name="origen_mf">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="diaDesaparicion" class="form-label font-weight-bold">Dia de desaparición</label>
		<input type="text" class="form-control" id="diaDesaparicion" name="diaDesaparicion">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="lugarDesaparicion" class="form-label font-weight-bold">Lugar de desaparición</label>
		<input type="text" class="form-control" id="lugarDesaparicion" name="lugarDesaparicion" maxlength="200">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="vestimenta_mf" class="form-label font-weight-bold">Vestimenta</label>
		<input type="text" class="form-control" id="vestimenta_mf" name="vestimenta_mf" maxlength="200">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="ocupacion_mf" class="form-label font-weight-bold">Profesión u Oficio</label>
		<select class="form-control" id="ocupacion_mf" name="ocupacion_mf">
			<option disabled selected value=""></option>
			<?php foreach ($body_data->ocupaciones as $index => $ocupaciones) { ?>
				<option value="<?= $ocupaciones->PERSONAOCUPACIONID ?>"> <?= $ocupaciones->PERSONAOCUPACIONDESCR ?> </option>
			<?php } ?>
		</select>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="escolaridad_mf" class="form-label font-weight-bold">Escolaridad</label>
		<select class="form-control" id="escolaridad_mf" name="escolaridad_mf">
			<option disabled selected value=""></option>
			<?php foreach ($body_data->escolaridades as $index => $escolaridades) { ?>
				<option value="<?= $escolaridades->PERSONAESCOLARIDADID ?>"> <?= $escolaridades->PERSONAESCOLARIDADDESCR ?> </option>
			<?php } ?>
		</select>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="autorizaFoto" class="form-label font-weight-bold">Autoriza foto en medios</label>
		<select class="form-control" id="autorizaFoto" name="autorizaFoto">
			<option disabled selected value=""></option>
			<option value="S">SI</option>
			<option value="N">NO</option>
		</select>
	</div>
</div>
