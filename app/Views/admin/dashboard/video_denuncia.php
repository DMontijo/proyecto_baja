<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
	<div class="col-8">
		<div class="embed-responsive embed-responsive-16by9 shadow rounded">
			<iframe class="embed-responsive-item" src="https://smartbc.assertivebusiness.com.mx/videollamada?name=Agente"></iframe>
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
				<button type="button" class="btn btn-primary btn-block" data-toggle="collapse" href="#data_ciudadano" role="button" aria-expanded="false" aria-controls="data_ciudadano">Datos del ciudadano</button>
				<div class="collapse mt-3" id="data_ciudadano">
					<p class="font-weight-bold">ABDIEL OTONIEL FLORES GONZÁLEZ</p>
					<p>Robo</p>
					<p>01-11-1995</p>
				</div>
			</div>
		</div>

		<div class="card rounded bg-white shadow">
			<div class="card-body">
				<label for="notas">Notas:</label>
				<textarea class="form-control" id="notas" placeholder="Notas del caso..." rows="10" required></textarea>
			</div>
		</div>

	</div>
</div>

<?php $this->endSection() ?>
