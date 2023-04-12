<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3 class="mb-4 font-weight-bold text-center">USUARIOS EN LLAMADA</h3>
				<div class="card shadow border-0 rounded">
					<div class="card-body">
						<div class="row">
							<div class="col-12 mt-3" style="overflow-x:scroll;">
								<p id="message" class="mb-3 text-primary font-weight-bold text-center"> No hay ningún usuario en llamada.</p>
								<table id="table-usuarios-en-llamada" class="table table-bordered table-hover table-striped d-none">
									<thead>
										<tr>
											<th class="text-center">NOMBRE</th>
											<th class="text-center">ESTADO</th>
											<th class="text-center">DENUNCIANTE</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript" src="<?= base_url() ?>/assets/agent/assets/openvidu-browser-2.25.0.min.js"></script>
<script src="https://cdn.socket.io/4.6.0/socket.io.min.js" integrity="sha384-c79GN5VsunZvi+Q/WObgk2in0CbZsHnjEqvFxC5DxHn9lTfNce2WW6h2pH6u/kF+" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>/assets/js/usuarios_en_llamada.js" type="module"></script>
<?= $this->endSection() ?>
