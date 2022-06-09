<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php $session = session(); ?>
<div class="row">
	<div class="col-3">
		<div class="card rounded bg-white shadow" style="height: 150px;">
			<div class="card-body">
				<div class="form-group">
					<div class="input-group mb-2">
						<input type="text" class="form-control" id="input_folio_atencion" placeholder="Folio de atención...">
					</div>
				</div>
				<button id="buscar-btn" class="btn btn-secondary float-right" role="button" onclick="buscarFolio();">Buscar</button>
			</div>
		</div>
	</div>
	<div class="col-3">
		<div class="card rounded bg-white shadow" style="height: 150px;">
			<div class="card-body">
				<p><span class="font-weight-bold">Delito:</span> <span id="delito_dash">Robo</span></p>
				<p><span class="font-weight-bold">Descripción:</span> <span id="delito_descr_dash">Me robarón mi télefono.</span></p>
			</div>
		</div>
	</div>
	<div class="col-3">
		<div class="card rounded bg-white shadow" style="height: 150px;">
			<div class="form-group">
				<label for=""></label>
				<select class="form-control" name="" id="">
					<option></option>
					<option></option>
					<option></option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-3">
		<div class="card rounded bg-white shadow" style="height: 150px;">
			<div class="card-body">
				
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col">
		<div class="embed-responsive embed-responsive-1by1 shadow rounded">
			<iframe src="https://videodenunciaserver1.fgebc.gob.mx/pde?u=24&token=198429b7cc8a2a5733d97bc13153227dd5017555" frameborder="0" allow="camera *;microphone *" style="margin-top:-130px;"></iframe>
		</div>
	</div>
	<div class="col-3">
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
