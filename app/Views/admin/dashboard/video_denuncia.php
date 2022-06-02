<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
	<div class="col-8">
		<div class="embed-responsive embed-responsive-1by1 shadow rounded">
			<iframe class="embed-responsive-item" src="https://smartbc.assertivebusiness.com.mx/videollamada?name=Agente" allow="camera *;microphone *"></iframe>
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
				<button class="btn btn-secondary float-right" role="button">Buscar</button>
			</div>
		</div>

		<div class="card rounded bg-white shadow">
			<div class="card-body">
				<div class="accordion" id="accordionExample">

					<div class="btn btn-primary btn-block py-2 mb-2 font-weight-bold" id="heading_datos_ciudadano" type="button" data-toggle="collapse" data-target="#datos_ciudadano" aria-expanded="true" aria-controls="datos_ciudadano">
						DATOS DEL CIUDADANO
					</div>
					<div id="datos_ciudadano" class="collapse" aria-labelledby="heading_datos_ciudadano" data-parent="#accordionExample">
						<p class="font-weight-bold">OTONIEL FLORES GONZALEZ</p>
						<p>01-11-1995</p>
						<p>26 AÑOS</p>
						<p>HOMBRE</p>
						<p>MÉXICO</p>
						<p>JALISCO</p>
						<p>GUADALAJARA</p>
						<p>SOFTWARE DEVELOPER</p>
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

<?php $this->endSection() ?>
