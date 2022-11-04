<div class="modal fade shadow" id="insert_fisfis_modal_denuncia" role="dialog" aria-labelledby="personaFisicaDenunciaModalInsertLabel" aria-hidden="true" data-backdrop="">
	<div class="modal-dialog modal-dialog-centered mw-100 w-75">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-blue text-white">
				<h5 class="modal-title font-weight-bold">REGISTRO DE ÁRBOL DELICTUAL</h5>
				<button type="button" class="close text-white" id="close" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body bg-light" style="height:70vh;overflow-y:auto;">
				<form id="form_fisfis_insert" action="" method="post" class="row p-0 m-0 needs-validation" novalidate>

					<div class="col-12">
						<p class="font-weight-bold text-center mt-3">DELITOS</p>
					</div>
					<hr>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="imputado_arbol" class="form-label font-weight-bold">Imputado</label>
						<select class="form-control" id="imputado_arbol" name="imputado_arbol" required>
							<option selected value="" disabled></option>
						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="delito_cometido" class="form-label font-weight-bold">Delito cometido</label>
						<select class="form-control" id="delito_cometido" name="delito_cometido" required>
							<option selected value="" disabled></option>
							<?php
							foreach ($body_data->delitosModalidad as $index => $delitoModalidad) { ?>
								<option value="<?= $delitoModalidad->DELITOMODALIDADID ?>"> <?= $delitoModalidad->DELITOMODALIDADDESCR ?></option>
							<?php } ?>

						</select>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="victima_ofendido" class="form-label font-weight-bold">Victima / Ofendido</label>
						<select class="form-control" id="victima_ofendido" name="victima_ofendido" required>
							<option selected value="" disabled></option>
						</select>
					</div>

					<div class="col-12 mb-3 text-center">
						<button type="submit" id="insertArbol" name="insertArbol" class="btn btn-primary font-weight-bold">AGREGAR DELITO</button>
					</div>

				</form>

			</div>
		</div>
	</div>
</div>