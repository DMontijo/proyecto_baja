<div class="modal fade" id="info_folio_modal" tabindex="-1" role="dialog" aria-labelledby="infoFolioModal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered mw-100 w-75">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h5 class="modal-title font-weight-bold">INFORMACIÓN DE LA DENUNCIA</h5>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-3">
						<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
							<a class="nav-link active" id="v-pills-preguntas-iniciales-tab" data-toggle="pill" href="#v-pills-preguntas-iniciales" role="tab" aria-controls="v-pills-preguntas-iniciales" aria-selected="true"><i class="fas fa-home"></i> PREGUNTAS INICIALES</a>
							<a class="nav-link" id="v-pills-denuncia-tab" data-toggle="pill" href="#v-pills-denuncia" role="tab" aria-controls="v-pills-denuncia" aria-selected="false"><i class="fas fa-file-alt"></i> DENUNCIA</a>
							<a class="nav-link" id="v-pills-personas-tab" data-toggle="pill" href="#v-pills-personas" role="tab" aria-controls="v-pills-personas" aria-selected="false"><i class="fas fa-users"></i> PERSONAS</a>
							<a class="nav-link" id="v-pills-domicilios-tab" data-toggle="pill" href="#v-pills-domicilios" role="tab" aria-controls="v-pills-domicilios" aria-selected="false"><i class="fas fa-map-marker-alt"></i> DOMICILIOS</a>
							<a class="nav-link" id="v-pills-vehiculos-tab" data-toggle="pill" href="#v-pills-vehiculos" role="tab" aria-controls="v-pills-vehiculos" aria-selected="false" style="display: none;"><i class="fas fa-car"></i> VEHICULOS</a>

						</div>
					</div>
					<div class="col-9">
						<div class="tab-content" id="v-pills-contenido">
							<div class="tab-pane fade show active" id="v-pills-preguntas-iniciales" role="tabpanel" aria-labelledby="v-pills-preguntas-iniciales-tab">
								<?php echo view('/admin/dashboard/video_denuncia_forms/form_preguntas_iniciales'); ?>
							</div>
							<div class="tab-pane fade" id="v-pills-denuncia" role="tabpanel" aria-labelledby="v-pills-denuncia-tab">
								<?php echo view('/admin/dashboard/video_denuncia_forms/form_denuncia'); ?>
							</div>
							<div class="tab-pane fade" id="v-pills-personas" role="tabpanel" aria-labelledby="v-pills-personas-tab">
								<div id="adicionados" class="d-none"></div>
								<table id="table-personas" class="table table-bordered table-striped">
									<tr>
										<th class="text-center" id="nombreP" name="nombreP">NOMBRE</th>
										<th class="text-center" id="calidadP" name="calidadP">CALIDAD JURIDICA</th>
										<th></th>
									</tr>
								</table>
							</div>
							<div class="tab-pane fade" id="v-pills-domicilios" role="tabpanel" aria-labelledby="v-pills-domicilios-tab">
								<table id="table-domicilio" class="table table-bordered table-striped">
									<tr>
										<th class="text-center">NOMBRE</th>
										<th class="text-center">CALIDAD JURIDICA</th>
										<th></th>
									</tr>
								</table>
							</div>
							<div class="tab-pane fade" id="v-pills-vehiculos" role="tabpanel" aria-labelledby="v-pills-vehiculos-tab">
								<table id="table-vehiculos" class="table table-bordered table-striped">
									<tr>
										<th class="text-center">PLACAS</th>
										<th class="text-center">SERIE</th>
										<th></th>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include('persona_modal.php') ?>
<?php include('vehiculo_modal.php') ?>
<?php include('domicilio_modal.php') ?>