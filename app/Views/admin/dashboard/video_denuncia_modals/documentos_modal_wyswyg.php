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
				<div id="usuarios" name="usuarios" class="d-none">
					<label for="empleado_asignado" class="form-label font-weight-bold">Agente:</label>

					<select class="form-control" id="empleado_asignado" name="empleado_asignado">
						<option disabled selected value=""></option>
						<?php
						foreach ($body_data->empleados as $index => $empleado) { ?>
							<option value="<?= $empleado->ID  ?>"> <?= $empleado->NOMBRE . ' ' . $empleado->APELLIDO_PATERNO . ' ' . $empleado->APELLIDO_MATERNO ?></option>
						<?php } ?>
					</select>
					<br>
				</div>
				<label for="plantilla" class="form-label font-weight-bold">Plantilla:</label>

				<select class="form-control" id="plantilla" name="plantilla">
					<option disabled selected value="">Selecciona plantilla...</option>
					<?php
					foreach ($body_data->plantillas as $index => $plantilla) { ?>
						<option value="<?= $plantilla->TITULO  ?>"> <?= $plantilla->TITULO ?></option>
					<?php } ?>
				</select>
				<br>
				<div id="div_uma" name="div_uma" style="display: none;">
					<label for="uma" class="form-label font-weight-bold">UMA:</label>

					<select class="form-control" id="uma_select" name="uma_select">
						<option disabled selected value="">Selecciona UMA...</option>
						<option value="ENSENADA - SAN QUINTIN">ENSENADA - SAN QUINTIN</option>
						<option value="ENSENADA - PRADERAS DEL CIPRES">ENSENADA - PRADERAS DEL CIPRES</option>
						<option value="MEXICALI - CD MORELOS">MEXICALI - CD MORELOS</option>
						<option value="MEXICALI - GPE VICTORIA">MEXICALI - GPE VICTORIA</option>
						<option value="MEXICALI - ORIENTE">MEXICALI - ORIENTE</option>
						<option value="MEXICALI - PONIENTE (ANAHUAC)">MEXICALI - PONIENTE (ANAHUAC)</option>
						<option value="MEXICALI - RIO NUEVO">MEXICALI - RIO NUEVO</option>
						<option value="MEXICALI - SAN FELIPE">MEXICALI - SAN FELIPE</option>
						<option value="ZONA COSTA - LA MESA">ZONA COSTA - LA MESA</option>
						<option value="ZONA COSTA - MARIANO MATAMOROS">ZONA COSTA - MARIANO MATAMOROS</option>
						<option value="ZONA COSTA - PLAYAS ROSARITO">ZONA COSTA - PLAYAS ROSARITO</option>
						<option value="ZONA COSTA - TECATE">ZONA COSTA - TECATE</option>
						<option value="ZONA COSTA - ZONA RIO">ZONA COSTA - ZONA RIO</option>
					</select>
				</div>
				<br>
				<div id="involucrados" name="involucrados" style="display: none;">
					<label for="victima_modal_documento" class="form-label font-weight-bold">Víctima:</label>

					<select class="form-control" id="victima_modal_documento" name="victima_modal_documento">
						<option disabled selected value="">Selecciona victíma...</option>
					</select>
					<br>
					<label for="imputado_modal_documento" class="form-label font-weight-bold">Imputado:</label>

					<select class="form-control" id="imputado_modal_documento" name="imputado_modal_documento">
						<option disabled selected value="">Selecciona imputado...</option>
					</select>
				</div>


			</div>
		</div>
	</div>
</div>
<?php include 'documentos_modal.php' ?>
