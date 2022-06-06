<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php $session = session(); ?>
<div class="row">
	<div class="col-8">
		<div class="embed-responsive embed-responsive-1by1 shadow rounded">
			<iframe src="<?= 'http://videodenunciaserver1.fgebc.gob.mx/videollamada?name=' . $session->NOMBRE . ' ' . $session->APELLIDO_PATERNO ?>" frameborder="0" allow="camera *;microphone *"></iframe>
		</div>
	</div>

	<div class="col-4">

		<div class="card rounded bg-white shadow">
			<div class="card-body">
				<div class="form-group">
					<div class="input-group mb-2">
						<input type="text" class="form-control" id="input_folio_atencion" placeholder="Folio de atención...">
					</div>
				</div>
				<button id="buscar-btn" class="btn btn-secondary float-right" role="button" onclick="buscarFolio();">Buscar</button>
			</div>
		</div>

		<div class="card rounded bg-white shadow">
			<div class="card-body">
				<ul>
					<li><a href="<?= base_url('assets/documentos/Codigo_Penal_Estatal_2022.pdf') ?>" target="_blank"><i class="fas fa-file-alt"></i> Código Penal Estatal</a></li>
				</ul>
			</div>
		</div>

		<div class="card rounded bg-white shadow">
			<div class="card-body">
				<div class="row p-0 m-0">
					<div class="col-6 p-1">
						<button class="btn btn-primary btn-block float-right" role="button">Derivación</button>
					</div>
					<div class="col-6 p-1">
						<button class="btn btn-primary btn-block float-right" role="button">NUC</button>
					</div>
				</div>
			</div>
		</div>

		<div class="card rounded bg-white shadow">
			<div class="card-body">
				<div class="accordion" id="accordionExample">
					<div class="btn btn-primary btn-block py-2 mb-2 font-weight-bold" id="heading_datos_ciudadano" type="button" data-toggle="collapse" data-target="#datos_ciudadano" aria-expanded="true" aria-controls="datos_ciudadano">
						DATOS DEL CIUDADANO
					</div>
					<div id="datos_ciudadano" class="collapse" aria-labelledby="heading_datos_ciudadano" data-parent="#accordionExample">
						<p class="font-weight-bold" id="nombre"></p>
						<p id="fecha_nacimiento"></p>
						<p id="delito"></p>
					</div>

					<div class="btn btn-primary btn-block py-2 mb-2 font-weight-bold" id="heading_otros_datos" type="button" data-toggle="collapse" data-target="#otros_datos" aria-expanded="true" aria-controls="otros_datos">
						OTROS DATOS
					</div>
					<div id="otros_datos" class="collapse" aria-labelledby="heading_otros_datos" data-parent="#accordionExample">
						Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quas, sequi! Nobis in sint non assumenda maiores labore delectus inventore quis beatae eum. Illo dicta quaerat praesentium eius cumque, corrupti consequatur.
					</div>
				</div>
			</div>
		</div>

		<div class="card rounded bg-white shadow">
			<div class="card-body">
				<label class="font-weight-bold" for="notas">Notas:</label>
				<textarea class="form-control" id="notas" placeholder="Notas del caso..." rows="10" required></textarea>
			</div>
		</div>
	</div>
</div>
<script src="<?= base_url() ?>/assets/DataTables/jquery/jquery.min.js"></script>
<script type="application/javascript">
	function buscarFolio() {
		console.log('Dando clic');
		$.ajax({
			data: {
				'folio': document.querySelector('#input_folio_atencion').value
			},
			url: "<?= base_url('/data/get-folio-information') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				console.log(response);
				document.querySelector('#nombre').innerHTML = response.denunciante.NOMBRE;
				document.querySelector('#delito').innerHTML = response.delito.DELITO;
			},
			error: function(jqXHR, textStatus, errorThrown) {}
		});
	}
</script>

<?php $this->endSection() ?>
