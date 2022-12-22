<div class="modal fade" id="info_folio_modal" tabindex="-1" role="dialog" aria-labelledby="infoFolioModal" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-dialog-centered mw-100 w-75">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-primary text-white">
				<h5 class="modal-title font-weight-bold">INFORMACIÓN DE LA DENUNCIA</h5>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body bg-light">
				<div class="row">
					<div class="col-3">
						<div class="nav flex-column nav-pills" id="info_tabs" role="tablist" aria-orientation="vertical">
							<a class="nav-link active" id="v-pills-denuncia-tab" data-toggle="pill" href="#v-pills-denuncia" role="tab" aria-controls="v-pills-denuncia" aria-selected="false"><i class="fas fa-file-alt"></i> DENUNCIA</a>
							<a class="nav-link" id="v-pills-preguntas-iniciales-tab" data-toggle="pill" href="#v-pills-preguntas-iniciales" role="tab" aria-controls="v-pills-preguntas-iniciales" aria-selected="true"><i class="fas fa-home"></i> PREGUNTAS INICIALES</a>
							<a class="nav-link" id="v-pills-personas-tab" data-toggle="pill" href="#v-pills-personas" role="tab" aria-controls="v-pills-personas" aria-selected="false"><i class="fas fa-users"></i> PERSONAS</a>
							<a class="nav-link" id="v-pills-vehiculos-tab" data-toggle="pill" href="#v-pills-vehiculos" role="tab" aria-controls="v-pills-vehiculos" aria-selected="false"><i class="fas fa-car"></i> VEHICULOS</a>
							<a class="nav-link" id="v-pills-parentesco-tab" data-toggle="pill" href="#v-pills-parentesco" role="tab" aria-controls="v-pills-parentesco" aria-selected="false"><i class="fas fa-handshake"></i> PARENTESCO</a>
							<a class="nav-link" id="v-pills-delitos-cometidos-tab" data-toggle="pill" href="#v-pills-delitos-cometido" role="tab" aria-controls="v-pills-delitos-cometido" aria-selected="false"><i class='fas fa-user-alt-slash'></i> DELITOS COMETIDOS</a>
							<a class="nav-link" id="v-pills-delitos-tab" data-toggle="pill" href="#v-pills-asignar-delitos" role="tab" aria-controls="v-pills-asignar-delitos" aria-selected="false"><i class='fas fa-handshake-slash'></i> DELITOS</a>
							<a class="nav-link" id="v-pills-objetos-involucrados-tab" data-toggle="pill" href="#v-pills-objetos-involucrados" role="tab" aria-controls="v-pills-objetos-involucrados" aria-selected="false"><i class="fas fa-box"></i> OBJETOS INVOLUCRADOS</a>

						</div>
					</div>
					<div class="col-9">
						<div class="tab-content" id="info_content">
							<div class="tab-pane fade show active" id="v-pills-denuncia" role="tabpanel" aria-labelledby="v-pills-denuncia-tab">
								<?= view('admin/dashboard/folios/forms/form_denuncia') ?>
							</div>
							<div class="tab-pane fade" id="v-pills-preguntas-iniciales" role="tabpanel" aria-labelledby="v-pills-preguntas-iniciales-tab">
								<?= view('admin/dashboard/folios/forms/form_preguntas_iniciales') ?>
							</div>
							<div class="tab-pane fade" id="v-pills-personas" role="tabpanel" aria-labelledby="v-pills-personas-tab">
								<div id="adicionados" class="d-none"></div>
								<table id="table-personas" class="table table-bordered table-hover table-striped table-light">
									<tr>
										<th class="text-center bg-primary text-white"></th>
										<th class="text-center bg-primary text-white" id="nombreP" name="nombreP">NOMBRE</th>
										<th class="text-center bg-primary text-white" id="calidadP" name="calidadP">Calidad Jurídica</th>
										<th class="text-center bg-primary text-white">VER</th>
									</tr>
								</table>
							</div>
							<div class="tab-pane fade" id="v-pills-parentesco" role="tabpanel" aria-labelledby="v-pills-parentesco-tab">

								<div id="adicionados" class="d-none"></div>
								<div class="table-responsive">
									<table id="table-parentesco" class="table table-bordered table-hover table-striped table-light">
										<tr>
											<th class="text-center bg-primary text-white" id="nombrePF1" name="nombrePF1">PERSONA FISICA 1</th>
											<th class="text-center bg-primary text-white" id="parentescoRelacion" name="parentescoRelacion">PARENTESCO</th>
											<th class="text-center bg-primary text-white" id="nombrePF2" name="nombrePF2">PERSONA FISICA 2</th>
										</tr>
									</table>
								</div>

							</div>
							<div class="tab-pane fade" id="v-pills-delitos-cometido" role="tabpanel" aria-labelledby="v-pills-delitos-cometidos-tab">
								<div id="adicionados" class="d-none"></div>
								<div class="table-responsive">
									<table id="table-delito-cometidos" class="table table-bordered table-hover table-striped table-light">
										<tr>
											<th class="text-center bg-primary text-white" id="nombreImputado" name="nombreImputado">IMPUTADO</th>
											<th class="text-center bg-primary text-white" id="delitoCometido" name="delitoCometido">DELITO COMETIDO</th>
											<!-- <th class="text-center bg-primary text-white">ELIMINAR</th> -->

										</tr>
									</table>
								</div>

							</div>
							<div class="tab-pane fade" id="v-pills-asignar-delitos" role="tabpanel" aria-labelledby="v-pills-delitos-tab">
								<div id="adicionados" class="d-none"></div>
								<div class="table-responsive">
									<table id="table-delitos" class="table table-bordered table-hover table-striped table-light">
										<tr>
											<th class="text-center bg-primary text-white" id="nombreImputado" name="nombreImputado">IMPUTADO</th>
											<th class="text-center bg-primary text-white" id="delitoCometido" name="delitoCometido">DELITO COMETIDO</th>
											<th class="text-center bg-primary text-white" id="nombreVictima" name="nombreVictima">VÍCTIMA / OFENDIDO</th>

										</tr>
									</table>
								</div>
							</div>
							<div class="tab-pane fade" id="v-pills-objetos-involucrados" role="tabpanel" aria-labelledby="v-pills-objetos-involucrados-tab">
								<div id="adicionados" class="d-none"></div>
								<div class="table-responsive">
									<table id="table-objetos-involucrados" class="table table-bordered table-hover table-striped table-light">
										<tr>
											<th class="text-center bg-primary text-white" id="objeto" name="objeto">CLASIFICACIÓN</th>
											<th class="text-center bg-primary text-white" id="clasificacion" name="clasificacion">SUBCLASIFICACIÓN</th>
											<th class="text-center bg-primary text-white"></th>

										</tr>
									</table>
								</div>
							</div>
							<div class="tab-pane fade" id="v-pills-vehiculos" role="tabpanel" aria-labelledby="v-pills-vehiculos-tab">
								<table id="table-vehiculos" class="table table-bordered table-hover table-striped table-light">
									<tr>
										<th class="text-center bg-primary text-white">PLACAS</th>
										<th class="text-center bg-primary text-white">SERIE</th>
										<th class="text-center bg-primary text-white"></th>
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
<script>
	$("input").prop('disabled', true);
	$("select").prop('disabled', true);
	$("textarea").prop('disabled', true);
</script>
<?php include('persona_modal.php') ?>
<?php include('vehiculo_modal.php') ?>
