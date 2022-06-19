
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
							<a class="nav-link" id="v-pills-denunciante-tab" data-toggle="pill" href="#v-pills-denunciante" role="tab" aria-controls="v-pills-denunciante" aria-selected="false"><i class="fas fa-user"></i> DENUNCIANTE</a>
							<a class="nav-link" id="v-pills-personas-tab" data-toggle="pill" href="#v-pills-personas" role="tab" aria-controls="v-pills-personas" aria-selected="false"><i class="fas fa-users"></i> PERSONAS</a>
							<a class="nav-link" id="v-pills-domicilios-tab" data-toggle="pill" href="#v-pills-domicilios" role="tab" aria-controls="v-pills-domicilios" aria-selected="false"><i class="fas fa-map-marker-alt"></i> DOMICILIOS</a>
							<!-- <a class="nav-link" id="v-pills-objetos-tab" data-toggle="pill" href="#v-pills-objetos" role="tab" aria-controls="v-pills-objetos" aria-selected="false"><i class="fas fa-box"></i> OBJETOS</a> -->
							<a class="nav-link" id="v-pills-vehiculos-tab" data-toggle="pill" href="#v-pills-vehiculos" role="tab" aria-controls="v-pills-vehiculos" aria-selected="false"><i class="fas fa-car"></i> VEHICULOS</a>
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
							<div class="tab-pane fade" id="v-pills-denunciante" role="tabpanel" aria-labelledby="v-pills-denunciante-tab">
								<?php echo view('/admin/dashboard/video_denuncia_forms/form_denunciante'); ?>
							</div>
							<div class="tab-pane fade" id="v-pills-personas" role="tabpanel" aria-labelledby="v-pills-personas-tab">
							<div id="adicionados" class="d-none"></div>
							<table id="table-personas" class="table table-bordered table-striped">
									<thead>
										<tr>
										<th class="text-center" id="id" name="id">ID</th>
											<th class="text-center" id="nombreP" name="nombreP">NOMBRE</th>
											<th class="text-center" id="calidadP" name="calidadP">CALIDAD JURIDICA</th>
											<th></th>
										</tr>
									</thead>
							
								<!--	<tbody>
										<tr>
										<td class="text-center" id="idT" name="idT">ID</td>
											<td class="text-center" id="nameT" name="nameT">OTONIEL FLORES GONZALEZ</td>
											<td class="text-center"id="calidadT" name="calidadT">DENUNCIANTE</td>
											<td class="text-center">
												<button type="button" class="btn btn-primary" onclick="viewPersonaFisica(1)"><i class="fas fa-eye"></i></button>
											</td>
										</tr>
									</tbody> -->
								</table>
							</div>
							<div class="tab-pane fade" id="v-pills-domicilios" role="tabpanel" aria-labelledby="v-pills-domicilios-tab">
								<table id="table-domicilio" class="table table-bordered table-striped">
								<thead>
										<tr>
											<th class="text-center">NOMBRE</th>
											<th class="text-center">CALIDAD JURIDICA</th>
											<th></th>
										</tr>
									</thead>
										<!--<tbody>
										<tr>
											<td class="text-center">OTONIEL FLORES GONZALEZ</td>
											<td class="text-center">DENUNCIANTE</td>
											<td class="text-center">
												<button type="button" class="btn btn-primary" onclick="viewDomicilio(1)"><i class="fas fa-eye"></i></button>
											</td>
										</tr>
									</tbody>-->
								</table>
							</div>
							<!-- <div class="tab-pane fade" id="v-pills-objetos" role="tabpanel" aria-labelledby="v-pills-objetos-tab">
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th class="text-center">PLACAS</th>
											<th class="text-center">SERIE</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center">FJH12312KJ</td>
											<td class="text-center">MXN123123ASJ-2</td>
											<td class="text-center">
												<button type="button" class="btn btn-primary"><i class="fas fa-eye"></i></button>
											</td>
										</tr>
									</tbody>
								</table>
							</div> -->
							<div class="tab-pane fade" id="v-pills-vehiculos" role="tabpanel" aria-labelledby="v-pills-vehiculos-tab">
								<table id="table-vehiculos" class="table table-bordered table-striped">
								<thead>
										<tr>
											<th class="text-center">PLACAS</th>
											<th class="text-center">SERIE</th>
											<th></th>
										</tr>
									</thead>
									<!--	<tbody>
										<tr>
											<td class="text-center">FJH12312KJ</td>
											<td class="text-center">MXN123123ASJ-2</td>
											<td class="text-center">
												<button type="button" class="btn btn-primary" onclick="viewVehiculo(1)"><i class="fas fa-eye"></i></button>
											</td>
										</tr>
									</tbody>-->
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
<script>
	//function viewPersonaFisica(id) {
	/*	$.ajax({
			url: "<?= base_url('/data/get-persona-fisica-by-id') ?>",
			type: "POST",
			dataType: "JSON",
			success: function(data)
			{
				console.log(data);
			/*	document.querySelector('#calidad_juridicaP').value = data.CALIDADJURIDICAID;
					
					document.querySelector('#nombrePersona').value = data.NOMBRE;
					document.querySelector('#apellido_paternoP').value = data.PRIMERAPELLIDO;
					document.querySelector('#apellido_maternoP').value = data.SEGUNDOAPELLIDO;
					document.querySelector('#sexoP').value = data.SEXO;
					document.querySelector('#fecha_nacimientoP').value = data.FECHANACIMIENTO;
					document.querySelector('#edadP').value = data.EDAD;
					document.querySelector('#numero_identidadP').value = data.NUMEROIDENTIDAD;
					document.querySelector('#telefonoP').value = data.TELEFONO;
					document.querySelector('#correoP').value = data.CORREO;
			}
	});*/
	//	$('#folio_persona_fisica_modal').modal('show');
	//}

	function viewDomicilio(persona) {
		$('#folio_domicilio_modal').modal('show');
	}

	function viewVehiculo(persona) {
		$('#folio_vehiculo_modal').modal('show');
	}
</script>
