<div class="modal fade shadow" id="documentos_modal_wyswyg" tabindex="-1" role="dialog" aria-labelledby="DocumentoswyswygModal" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-100 w-50">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-blue text-white">
				<h5 class="modal-title font-weight-bold">DOCUMENTOS</h5>
				<button type="button" class="close text-primary" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body bg-light">

				<label for="plantilla" class="form-label font-weight-bold">Plantilla:</label>

				<select class="form-control" id="plantilla" name="plantilla">
					<option disabled selected value=""></option>
					<?php
					foreach ($body_data->plantillas as $index => $plantilla) { ?>
						<option value="<?= $plantilla->TITULO  ?>"> <?= $plantilla->TITULO ?></option>
					<?php } ?>
				</select>
				<br>
				<div id="involucrados" name="involucrados" style="display: none;">
					<label for="victima_modal_documento" class="form-label font-weight-bold">Víctima:</label>

					<select class="form-control" id="victima_modal_documento" name="victima_modal_documento">
						<option disabled selected value=""></option>
					</select>
					<br>
					<label for="imputado_modal_documento" class="form-label font-weight-bold">Imputado:</label>

					<select class="form-control" id="imputado_modal_documento" name="imputado_modal_documento">
						<option disabled selected value=""></option>
					</select>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include 'documentos_modal.php' ?>
