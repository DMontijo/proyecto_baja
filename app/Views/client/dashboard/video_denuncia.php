<?= $this->extend('client/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php $session = session(); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card text-center">
				<div class="card-body p-0 m-0">
					<div class="ratio ratio-16x9">
						<iframe src="<?= 'http://videodenunciaserver1.fgebc.gob.mx/videollamada?folio=' . $body_data->folio . '&nombre=' . $session->NOMBRE . ' ' . $session->APELLIDO_PATERNO . ' ' . $session->APELLIDO_MATERNO . '&delito=' . $body_data->delito . '&idioma=' . $body_data->idioma . '&edad=' . $body_data->edad . '&perfil=' . $body_data->perfil . '&sexo=' . $body_data->sexo . '&prioridad=' . $body_data->prioridad ?>" frameborder="0" allow="camera *;microphone *"></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>
