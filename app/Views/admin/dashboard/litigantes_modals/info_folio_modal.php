<div class="modal fade" id="info_folio_modal" role="dialog" aria-labelledby="infoFolioModal" aria-hidden="true" data-backdrop="false">
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
							<a class="nav-link active" id="v-pills-archivos-externos-tab" data-toggle="pill" href="#v-pills-archivos-externos" role="tab" aria-controls="v-pills-archivos-externo" aria-selected="false"><i class="fas fa-file"></i> ARCHIVOS EXTERNOS</a>
							<a class="nav-link" id="v-pills-denuncia-tab" data-toggle="pill" href="#v-pills-denuncia" role="tab" aria-controls="v-pills-denuncia" aria-selected="false"><i class="fas fa-file-alt"></i> HECHO</a>
							<a class="nav-link" id="v-pills-personas-tab" data-toggle="pill" href="#v-pills-personas" role="tab" aria-controls="v-pills-personas" aria-selected="false"><i class="fas fa-users"></i> PERSONAS</a>
							<a class="nav-link" id="v-pills-personas-morales-tab" data-toggle="pill" href="#v-pills-personas-morales" role="tab" aria-controls="v-pills-personas-morales" aria-selected="true"><i class="fas fa-home"></i> PERSONAS MORALES</a>
							<a class="nav-link" id="v-pills-vehiculos-tab" data-toggle="pill" href="#v-pills-vehiculos" role="tab" aria-controls="v-pills-vehiculos" aria-selected="false"><i class="fas fa-car"></i> VEHICULOS</a>
							<a class="nav-link" id="v-pills-parentesco-tab" data-toggle="pill" href="#v-pills-parentesco" role="tab" aria-controls="v-pills-parentesco" aria-selected="false"><i class="fas fa-people-arrows"></i> PARENTESCOS</a>
							<a class="nav-link" id="v-pills-delitos-cometidos-tab" data-toggle="pill" href="#v-pills-delitos-cometido" role="tab" aria-controls="v-pills-delitos-cometido" aria-selected="false"><i class='fas fa-user-alt-slash'></i> DELITOS COMETIDOS</a>
							<a class="nav-link" id="v-pills-delitos-tab" data-toggle="pill" href="#v-pills-asignar-delitos" role="tab" aria-controls="v-pills-asignar-delitos" aria-selected="false"><i class="fas fa-user-ninja"></i> DELITOS</a>
							<a class="nav-link" id="v-pills-objetos-involucrados-tab" data-toggle="pill" href="#v-pills-objetos-involucrados" role="tab" aria-controls="v-pills-objetos-involucrados" aria-selected="false"><i class="fas fa-box"></i> OBJETOS INVOLUCRADOS</a>

							<!-- <a class="nav-link" id="v-pills-documentos-tab" data-toggle="pill" href="#v-pills-documentos" role="tab" aria-controls="v-pills-documentos" aria-selected="false"><i class="fas fa-file-archive"></i> DOCUMENTOS</a> -->

						</div>
					</div>
					<div class="col-9">
						<div class="tab-content" id="info_content">
							<div class="tab-pane fade  show active" id="v-pills-archivos-externos" role="tabpanel" aria-labelledby="v-pills-archivos-externos-tab">
								<div id="adicionados" class="d-none"></div>

								<div class="col-12 mb-2 p-0 text-right">
									<div id="loading_archivos" name="loading_archivos" class="text-center d-none" style="min-height:50px;">
										<div class="justify-content-center">
											<div class="spinner-border text-primary" role="status">
											</div>
										</div>
									</div>
									<button type="button" id="refrescarArchivos" name="refrescarArchivos" class="btn btn-primary font-weight-bold">ACTUALIZAR ARCHIVOS</button>
									<button type="button" id="agregarArchivosAdmin" name="agregarArchivosAdmin" class="btn btn-primary font-weight-bold"><i class="fas fa-plus mr-3"></i>AGREGAR ARCHIVOS</button>

								</div>
								<div class="table-responsive">
									<table id="table-archivos" class="table table-bordered table-hover table-striped table-light">
										<tr>
											<th class="text-center bg-primary text-white">DESCRIPCIÓN</th>
											<th class="text-center bg-primary text-white">DOCUMENTO</th>
											<th class="text-center bg-primary text-white"></th>
										</tr>
									</table>
								</div>
							</div>
							<div class="tab-pane fade" id="v-pills-denuncia" role="tabpanel" aria-labelledby="v-pills-denuncia-tab">
								<?php echo view('/admin/dashboard/video_denuncia_forms/form_denuncia'); ?>
							</div>
							<div class="tab-pane fade" id="v-pills-personas" role="tabpanel" aria-labelledby="v-pills-personas-tab">
								<div id="adicionados" class="d-none"></div>
								<div class="col-12 p-0 mb-2 text-right">
									<button type="button" id="insertPersonaFisicaModal" name="insertPersonaFisicaModal" class="btn btn-primary font-weight-bold"><i class="fas fa-plus mr-3"></i> AGREGAR PERSONA FÍSICA</button>
								</div>
								<div class="table-responsive">
									<table id="table-personas" class="table table-bordered table-hover table-striped table-light">
										<tr>
											<th class="text-center bg-primary text-white"></th>
											<th class="text-center bg-primary text-white" id="nombreP" name="nombreP">NOMBRE</th>
											<th class="text-center bg-primary text-white" id="calidadP" name="calidadP">CALIDAD JURÍDICA</th>
											<th class="text-center bg-primary text-white"></th>
										</tr>
									</table>
								</div>
							</div>
							<div class="tab-pane fade" id="v-pills-personas-morales" role="tabpanel" aria-labelledby="v-pills-personas-morales-tab">
								<div id="adicionados" class="d-none"></div>
								<div class="table-responsive">
									<table id="table-morales" class="table table-bordered table-hover table-striped table-light">
										<tr>
											<th class="text-center bg-primary text-white">DENOMINACION</th>
											<th class="text-center bg-primary text-white">MARCA COMERCIAL</th>
											<th class="text-center bg-primary text-white">LITIGANTE</th>
											<th class="text-center bg-primary text-white"></th>
										</tr>
									</table>
								</div>
							</div>
							<div class="tab-pane fade" id="v-pills-parentesco" role="tabpanel" aria-labelledby="v-pills-parentesco-tab">
								<div id="adicionados" class="d-none"></div>
								<div class="col-12 mb-2 p-0 text-right">
									<button type="button" id="insertParentescoModal" name="insertParentescoModal" class="btn btn-primary font-weight-bold"><i class="fas fa-plus mr-3"></i> AGREGAR PARENTESCO</button>
								</div>
								<div class="table-responsive">
									<table id="table-parentesco" class="table table-bordered table-hover table-striped table-light">
										<tr>
											<th class="text-center bg-primary text-white" id="nombrePF1" name="nombrePF1">PERSONA UNO</th>
											<th class="text-center bg-primary text-white" id="parentescoRelacion" name="parentescoRelacion">PARENTESCO</th>
											<th class="text-center bg-primary text-white" id="nombrePF2" name="nombrePF2">PERSONA DOS</th>
											<th class="text-center bg-primary text-white"></th>
											<th class="text-center bg-primary text-white"></th>
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
										</tr>
									</table>
								</div>

							</div>
							<div class="tab-pane fade" id="v-pills-asignar-delitos" role="tabpanel" aria-labelledby="v-pills-delitos-tab">
								<div id="adicionados" class="d-none"></div>
								<div class="col-12 mb-2 p-0 text-right">
									<button type="button" id="insertArbolDelictual" name="insertArbolDelictual" class="btn btn-primary font-weight-bold"><i class="fas fa-plus mr-3"></i>AGREGAR DELITO</button>
								</div>
								<div class="table-responsive">
									<table id="table-delitos-videodenuncia" class="table table-bordered table-hover table-striped table-light">
										<tr>
											<th class="text-center bg-primary text-white" id="nombreImputado" name="nombreImputado">IMPUTADO</th>
											<th class="text-center bg-primary text-white" id="delitoCometido" name="delitoCometido">DELITO COMETIDO</th>
											<th class="text-center bg-primary text-white" id="nombreVictima" name="nombreVictima">VÍCTIMA / OFENDIDO</th>
											<th class="text-center bg-primary text-white"></th>
										</tr>
									</table>
								</div>
							</div>
							<div class="tab-pane fade" id="v-pills-objetos-involucrados" role="tabpanel" aria-labelledby="v-pills-objetos-involucrados-tab">
								<div id="adicionados" class="d-none"></div>
								<div class="col-12 mb-2 p-0 text-right">
									<button type="button" id="modalObjetoInvolucrado" name="modalObjetoInvolucrado" class="btn btn-primary font-weight-bold"><i class="fas fa-plus mr-3"></i> OBJETO INVOLUCRADO</button>
								</div>
								<div class="table-responsive">
									<table id="table-objetos-involucrados" class="table table-bordered table-hover table-striped table-light">
										<tr>
											<th class="text-center bg-primary text-white" id="objeto" name="objeto">CLASIFICACIÓN</th>
											<th class="text-center bg-primary text-white" id="clasificacion" name="clasificacion">SUBCLASIFICACIÓN</th>
											<th class="text-center bg-primary text-white"></th>
											<th class="text-center bg-primary text-white"></th>

										</tr>
									</table>
								</div>
							</div>
							<div class="tab-pane fade" id="v-pills-vehiculos" role="tabpanel" aria-labelledby="v-pills-vehiculos-tab">
								<div class="col-12 mb-2 p-0 text-right">
									<button type="button" id="insertVehiculoModal" name="insertVehiculoModal" class="btn btn-primary font-weight-bold"><i class="fas fa-plus mr-3"></i>AGREGAR VEHÍCULO</button>
								</div>
								<div class="table-responsive">
									<table id="table-vehiculos" class="table table-bordered table-hover table-striped table-light">
										<tr>
											<th class="text-center bg-primary text-white">PLACAS</th>
											<th class="text-center bg-primary text-white">SERIE</th>
											<th class="text-center bg-primary text-white"></th>
										</tr>
									</table>
								</div>
							</div>


							<!-- <div class="tab-pane fade" id="v-pills-documentos" role="tabpanel" aria-labelledby="v-pills-documentos-tab">
								<?php //echo view('/admin/dashboard/video_denuncia_forms/form_documentos'); 
								?>
								<div id="adicionados" class="d-none"></div>
								
								<div class="table-responsive">
									<table id="table-documentos" class="table table-bordered table-hover table-striped table-light">
										<tr>
											<th class="text-center bg-primary text-white" id="tipodoc" name="tipodoc">TIPO DE DOCUMENTO</th>
											<th class="text-center bg-primary text-white">STATUS</th>
											<th class="text-center bg-primary text-white"></th>

										</tr>
									</table>
								</div>
							</div> -->

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>