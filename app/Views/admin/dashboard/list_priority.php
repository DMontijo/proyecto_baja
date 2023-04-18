<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3 class="mb-4 font-weight-bold text-center">LLAMADAS EN FILA</h3>
				<div class="card shadow border-0 rounded">
					<div class="card-body">
						<div class="row">
							<div class="col-12 mt-3" style="overflow-x:scroll;">
								<p id="message" class="mb-3 text-primary font-weight-bold text-center"> No hay ninguna llamada en fila</p>

								<table id="table-cola" class="table table-bordered table-hover table-striped d-none">
									<thead>
										<tr>
											<th class="text-center">FOLIO</th>
											<th class="text-center">NOMBRE DEL DENUNCIANTE</th>
											<th class="text-center">GÉNERO</th>
											<th class="text-center">IDIOMA</th>
											<th class="text-center">DELITO</th>
											<th class="text-center">PRIORIDAD</th>
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
<script src="https://cdn.socket.io/4.6.0/socket.io.min.js" integrity="sha384-c79GN5VsunZvi+Q/WObgk2in0CbZsHnjEqvFxC5DxHn9lTfNce2WW6h2pH6u/kF+" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>/assets/js/priority_list.js" type="module"></script>
<?= $this->endSection() ?>
