<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php $session = session(); ?>
<div class="row">
	<div id="card1" class="col-3">
		<div class="card rounded bg-white shadow" style="height: 150px;">
			<div class="card-body">
				<div class="form-group">
					<div class="input-group mb-2">
						<input type="text" class="form-control" id="input_folio_atencion" placeholder="Folio de atención..." value="2022062">
					</div>
				</div>
				<button id="buscar-btn" class="btn btn-secondary float-right" role="button">Buscar</button>
			</div>
		</div>
	</div>
	<div id="card2" class="col-3 d-none">
		<div class="card rounded bg-white shadow" style="height: 150px;">
			<div class="card-body">
				<p><span class="font-weight-bold">Delito:</span> <span id="delito_dash">Robo</span></p>
				<p><span class="font-weight-bold">Descripción:</span> <span id="delito_descr_dash">Me robarón mi télefono.</span></p>
			</div>
		</div>
	</div>
	<div id="card3" class="col-3">
		<div class="card rounded bg-white shadow" style="height: 150px;">
			<div class="card-body">
				<button id="info-folio-btn" class="btn btn-primary btn-block" role="button" data-toggle="modal" data-target="#info_folio">INFORMACIÓN DEL CASO</button>
			</div>
		</div>
	</div>
	<div id="card4" class="col-3 d-none">
		<div class="card rounded bg-white shadow" style="height: 150px;">
			<div class="card-body">

			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col">
		<div class="embed-responsive embed-responsive-1by1 shadow rounded">
			<!-- <iframe src="https://videodenunciaserver1.fgebc.gob.mx/pde?u=24&token=198429b7cc8a2a5733d97bc13153227dd5017555" frameborder="0" allow="camera *;microphone *" style="margin-top:-130px;"></iframe> -->
		</div>
	</div>
	<div id="card5" class="col-3 d-none">
		<div class="card rounded bg-white shadow">
			<div class="card-body">
				<ul>
					<li><a href="<?= base_url('assets/documentos/Codigo_Penal_Estatal_2022.pdf') ?>" target="_blank"><i class="fas fa-file-alt"></i> Código Penal Estatal</a></li>
				</ul>
			</div>
		</div>
		<div class="card rounded bg-white shadow">
			<div class="card-body">
				<label class="font-weight-bold" for="notas">Notas:</label>
				<textarea class="form-control" id="notas_mp" placeholder="Notas del caso..." rows="10" required></textarea>
			</div>
		</div>
	</div>
</div>

<?php include('video_denuncia_modals/info_folio_modal.php') ?>
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
					document.querySelector('#delito_dash').innerHTML = response.delito.DELITO;
					document.querySelector('#delito_descr_dash').innerHTML = response.delito.DELITO;
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

	// info_folio_btn.addEventListener('click',() => {
	// 	$('#info_folio').modal('show');
	// })
</script>

<?php $this->endSection() ?>
