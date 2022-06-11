<!-- <div class="modal fade" id="info_folio" tabindex="-1" aria-labelledby="info_folio" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered  modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h5 class="modal-title" id="bs">INFORMACIÓN DE LA DENUNCIA</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

			</div>
		</div>
	</div>
</div> -->
<div class="modal fade" id="info_folio" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog mw-100 w-75">
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
							<a class="nav-link active" id="v-pills-principal-tab" data-toggle="pill" href="#v-pills-principal" role="tab" aria-controls="v-pills-principal" aria-selected="true">PRINCIPAL</a>
							<a class="nav-link" id="v-pills-personas-tab" data-toggle="pill" href="#v-pills-personas" role="tab" aria-controls="v-pills-personas" aria-selected="false">PERSONAS</a>
							<a class="nav-link" id="v-pills-domicilios-tab" data-toggle="pill" href="#v-pills-domicilios" role="tab" aria-controls="v-pills-domicilios" aria-selected="false">DOMICILIOS</a>
							<a class="nav-link" id="v-pills-automoviles-tab" data-toggle="pill" href="#v-pills-automoviles" role="tab" aria-controls="v-pills-automoviles" aria-selected="false">AUTOMOVILES</a>
						</div>
					</div>
					<div class="col-9">
						<div class="tab-content" id="v-pills-contenido">
							<div class="tab-pane fade show active" id="v-pills-principal" role="tabpanel" aria-labelledby="v-pills-principal-tab">
								<h3 class="text-center font-weight">DENUNCIANTE</h3>
								<?php echo view('/admin/dashboard/video_denuncia_forms/denunciante_form'); ?>
								<hr>
								<h2>DENUNCIANTE</h2>
							</div>
							<div class="tab-pane fade" id="v-pills-personas" role="tabpanel" aria-labelledby="v-pills-personas-tab">
								<table id="folios_atendidos" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>NOMBRE</th>
											<th>Nombre del denunciante</th>
											<th>Fecha</th>
											<th>Folio</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
											<tr>
												<th scope="row"></th>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
									</tbody>
								</table>
							</div>
							<div class="tab-pane fade" id="v-pills-domicilios" role="tabpanel" aria-labelledby="v-pills-domicilios-tab">...</div>
							<div class="tab-pane fade" id="v-pills-automoviles" role="tabpanel" aria-labelledby="v-pills-automoviles-tab">...</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	const links = document.querySelectorAll('#nav-caso .nav-link');
	console.log(links);
</script>
