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
								<input type="text" class="form-control" id="input_folio_atencion" placeholder="Folio de atención..." value="402002202200001">
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
	<div id="card3" class="col-3 d-none">
		<div class="card rounded bg-white shadow" style="height: 190px;">
			<div class="card-body">
				<button id="info-folio-btn" class="btn btn-primary btn-block h-100" role="button" data-toggle="modal" data-target="#info_folio_modal"><i class="fas fa-file-alt"></i> INFORMACIÓN DEL CASO</button>
			</div>
		</div>
	</div>
	<div id="card4" class="col-3 d-none">
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
			<iframe src="https://videodenunciaserver1.fgebc.gob.mx/pde?u=33&token=7b2a0523176a9dd9f28b694b44de4d5a4edcff31" frameborder="0" allow="camera *;microphone *" style="margin-top:-130px;"></iframe>
		</div>
	</div>
	<div id="card5" class="col-3 d-none">
		<div class="card rounded bg-white shadow">
			<div class="card-body">
				<div class="row">
					<div class="col-12 overflow-auto">
						<a class="btn btn-primary btn-block" target="_blank" href="https://www.diputados.gob.mx/LeyesBiblio/ref/cpf.htm"><i class="fas fa-file-alt"></i> Código Penal Federal</a>
						<a class="btn btn-primary btn-block" target="_blank" href="https://www.congresobc.gob.mx/Contenido/Actividades_Legislativas/Leyes_Codigos.aspx"><i class="fas fa-file-alt"></i> Código Penal Estatal</a>
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
<?php include('video_denuncia_modals/persona_modal.php') ?>
<?php include('video_denuncia_modals/vehiculo_modal.php') ?>
<?php include('video_denuncia_modals/domicilio_modal.php') ?>

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
				console.log(response);
				if (response.status === 1) {
					card2.classList.remove('d-none');
					card3.classList.remove('d-none');
					card4.classList.remove('d-none');
					card5.classList.remove('d-none');
					const folio = response.folio;
					const preguntas = response.preguntas_iniciales;
					const personas = response.personas;
					const domicilios = response.domicilios;
					const vehiculos = response.vehiculos;
					document.querySelector('#delito_dash').value = folio.DELITODENUNCIA;
					document.querySelector('#delito_descr_dash').value = folio.HECHONARRACION;

					document.querySelector('#es_menor').value = preguntas.ES_MENOR;
					document.querySelector('#eres_tu').value = preguntas.ERES_TU;
					document.querySelector('#es_tercera_edad').value = preguntas.ES_TERCERA_EDAD;
					document.querySelector('#tiene_discapacidad').value = preguntas.TIENE_DISCAPACIDAD;
					document.querySelector('#fue_con_arma').value = preguntas.FUE_CON_ARMA;
					document.querySelector('#esta_desaparecido').value = preguntas.ESTA_DESAPARECIDO;
					document.querySelector('#lesiones').value = preguntas.LESIONES;
					document.querySelector('#lesiones_visibles').value = preguntas.LESIONES_VISIBLES;

					$("#table-personas").DataTable({
						"responsive": true,
						"lengthChange": false,
						"autoWidth": false,
					}).buttons().container().appendTo('#videollamadasA_wrapper .col-md-6:eq(0)');
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
