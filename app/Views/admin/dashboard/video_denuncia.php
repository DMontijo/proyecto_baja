<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php $session = session(); ?>
<div class="row">
	<div id="card1" class="col-3">
		<div class="card rounded bg-white shadow" style="height: 190px;">
			<div class="card-body">
				<div class="row">
					<div class="col-12">
						<div class="form-group mb-1">
							<div class="input-group mb-1">
								<input type="text" class="form-control" id="input_folio_atencion" placeholder="Folio de atención..." value="123456">
							</div>
							<button id="buscar-btn" class="btn btn-secondary btn-block" role="button">Buscar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="card2" class="col-3 d-none">
		<div class="card rounded bg-white shadow" style="min-height: 190px;">
			<div class="card-body">
				<label class="font-weight-bold">Delito:</label>
				<input class="form-control" type="text" id="delito_dash">
				<label class="font-weight-bold">Descripción:</label>
				<textarea class="form-control" id="delito_descr_dash">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Illum suscipit iste commodi accusantium delectus, exercitationem ad vitae! Mollitia modi ut eveniet at. Eius laudantium deleniti ad odit fuga recusandae porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab nemo accusantium maior</textarea>
			</div>
		</div>
	</div>
	<div id="card3" class="col-3">
		<div class="card rounded bg-white shadow" style="height: 190px;">
			<div class="card-body">
				<button id="info-folio-btn" class="btn btn-primary btn-block h-100" role="button" data-toggle="modal" data-target="#info_folio_modal"><i class="fas fa-file-alt"></i> INFORMACIÓN DEL CASO</button>
			</div>
		</div>
	</div>
	<div id="card4" class="col-3">
		<div class="card rounded bg-white shadow" style="height: 190px;">
			<div class="card-body">
				<button id="salida-folio-btn" class="btn btn-primary btn-block h-100" role="button" data-toggle="modal" data-target="#salida_modal"><i class="fas fa-sign-out-alt"></i> DAR SALIDA</button>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col">
		<div class="bg-white embed-responsive embed-responsive-1by1 shadow rounded">
			<iframe src="https://videodenunciaserver1.fgebc.gob.mx/pde?u=24&token=198429b7cc8a2a5733d97bc13153227dd5017555" frameborder="0" allow="camera *;microphone *" style="margin-top:-130px;"></iframe>
		</div>
	</div>
	<div id="card5" class="col-3 d-none">
		<div class="card rounded bg-white shadow">
			<div class="card-body">
				<div class="row">
					<div class="col-12 overflow-auto">
						<a class="btn btn-primary btn-block" target="_blank" href="https://diputados.gob.mx/LeyesBiblio/ref/cpf.htm"><i class="fas fa-file-alt"></i> Código Penal Federal</a>
						<a class="btn btn-primary btn-block" target="_blank" href="https://diputados.gob.mx/LeyesBiblio/ref/cpf.htm"><i class="fas fa-file-alt"></i> Código Penal Estatal</a>
					</div>
				</div>
			</div>
		</div>
		<div class="card rounded bg-white shadow">
			<div class="card-body">
				<label class="font-weight-bold" for="notas">Breve descripción del caso:</label>
				<textarea class="form-control" id="notas_mp" placeholder="Descripción del caso..." rows="10" required></textarea>
			</div>
		</div>
	</div>
</div>

<?php include('video_denuncia_modals/info_folio_modal.php') ?>
<?php include('video_denuncia_modals/salida_modal.php') ?>
<script>
	const inputFolio = document.querySelector('#input_folio_atencion');
	const buscar_btn = document.querySelector('#buscar-btn');
	const info_folio_btn = document.querySelector('#info-folio-btn');
	const card1 = document.querySelector('#card1');
	const card2 = document.querySelector('#card2');
	const card3 = document.querySelector('#card3');
	const card4 = document.querySelector('#card4');
	const card5 = document.querySelector('#card5');

	buscar_btn.addEventListener('click', (e) => {
		$.ajax({
			data: {
				'folio': document.querySelector('#input_folio_atencion').value
			},
			url: "<?= base_url('/data/get-folio-information') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				if (response.status === 1) {
					card2.classList.remove('d-none');
					card3.classList.remove('d-none');
					card4.classList.remove('d-none');
					card5.classList.remove('d-none');
					document.querySelector('#delito_dash').value = response.delito.DELITO;
					document.querySelector('#delito_descr_dash').value = response.delito.DELITO;
				} else {
					card2.classList.add('d-none');
					card3.classList.add('d-none');
					card4.classList.add('d-none');
					card5.classList.add('d-none');
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {}
		});
	})
</script>

<?php $this->endSection() ?>
