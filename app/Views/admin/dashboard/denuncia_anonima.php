<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php $session = session(); ?>

<div class="row">
	<div class="col-12">
		<div class="card rounded bg-white shadow">
			<div class="card-body">
				<h1 class="text-center font-weight-bold">DENUNCIA ANÓNIMA</h1>
				<div class="row">
					<div class="col-12 pt-5">
						<h3 class="font-weight-bold text-center text-blue pb-3">INFORMACIÓN DEL HECHO</h3>
					</div>

					<div class="col-12 col-sm-6 mb-3">
						<label for="fecha" class="form-label font-weight-bold">Fecha del delito:</label>
						<input type="date" class="form-control" id="fecha" name="fecha" max="<?= date("Y-m-d") ?>">
					</div>
					<div class="col-12 col-sm-6 mb-3">
						<label for="hora" class="form-label font-weight-bold">Hora del delito:</label>
						<input type="time" class="form-control" id="hora" name="hora">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<label for="municipio" class="form-label font-weight-bold">Municipio:</label>
							<select class="form-control" id="municipio" name="municipio">
								<option selected disabled value="">Elige el municipio</option>
								<?php foreach ($body_data->municipios as $index => $municipio) { ?>
									<option value="<?= $municipio->MUNICIPIOID ?>"> <?= $municipio->MUNICIPIODESCR ?> </option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<label for="localidad" class="form-label font-weight-bold">Localidad:</label>
							<select class="form-control" id="localidad" name="localidad">
								<option selected disabled value="">Elige la localidad</option>
								<?php foreach ($body_data->localidades as $index => $localidad) { ?>
									<option value="<?= $localidad->LOCALIDADID ?>"> <?= $localidad->LOCALIDADDESCR ?> </option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<label for="colonia" class="form-label font-weight-bold">Colonia:</label>
							<select class="form-control" id="colonia_select" name="colonia_select">
								<option selected disabled value="">Selecciona la colonia</option>
							</select>
							<input type="text" class="form-control d-none" id="colonia" name="colonia" maxlength="100">
						</div>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="calle" class="form-label font-weight-bold">Calle o avenida:</label>
						<input type="text" class="form-control" id="calle" name="calle">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="exterior" class="form-label font-weight-bold">No. exterior:</label>
						<input type="text" class="form-control" id="exterior" name="exterior">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="interior" class="form-label font-weight-bold">No. interior:</label>
						<input type="text" class="form-control" id="interior" name="interior">
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="referencias" class="form-label font-weight-bold">Referencias</label>
						<input type="text" class="form-control" id="referencias" name="referencias">
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<label for="lugar" class="form-label font-weight-bold">Lugar:</label>
							<select class="form-control" id="lugar" name="lugar">
								<option selected disabled value="">Elige el lugar del delito</option>
								<?php foreach ($body_data->lugares as $index => $lugar) { ?>
									<option value="<?= $lugar->HECHOLUGARID ?>"> <?= $lugar->HECHODESCR ?> </option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="armas" class="form-label font-weight-bold">Armas:</label>
						<textarea class="form-control" id="armas" name="armas" row="10" oninput="mayuscTextarea(this)"></textarea>
					</div>

					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<label for="notas" class="form-label font-weight-bold">Notas:</label>
						<textarea class="form-control" id="notas" name="notas" row="10" oninput="mayuscTextarea(this)"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-12 pt-5">
						<h3 class="font-weight-bold text-center text-blue pb-3">DELITOS COMETIDOS</h3>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<label for="delito" class="form-label font-weight-bold">Delito:</label>
							<select class="form-control" id="delito" name="delito">
								<option selected disabled value="">Elige el delito</option>
								<?php foreach ($body_data->delitosUsuarios as $index => $delito) { ?>
									<option value="<?= $delito->ID ?>"> <?= $delito->DELITO ?> </option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<br>
							<button class="btn btn-primary" id="habilitar-delito" name="habilitar-delito">+</button>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 pt-5">
						<h3 class="font-weight-bold text-center text-blue pb-3">PERSONAS INVOLUCRADAS</h3>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<label for="victima_conocido" class="form-label font-weight-bold">¿Se conoce a la victima?:</label>
							<select class="form-control" id="victima_conocido" name="victima_conocido">
								<option selected disabled value=""></option>
								<option value="1">Si </option>
								<option value="2">No </option>
							</select>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<label for="victima_nombre" class="form-label font-weight-bold">Nombre:</label>
							<select class="form-control" id="victima_nombre" name="victima_nombre">
							<option selected disabled value=""></option>
								<option value="1">Si </option>
								<option value="2">No </option>
							</select>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<label for="victima_ap1" class="form-label font-weight-bold">Apellido paterno:</label>
							<input class="form-control" id="victima_ap1" name="victima_ap1">
							
							</input>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<label for="victia_ap2" class="form-label font-weight-bold">Apellido materno:</label>
							<input class="form-control" id="victia_ap2" name="victia_ap2">
							
							</input>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
						<div class="form-group">
							<br>
							<button class="btn btn-primary" id="habilitar-delito" name="habilitar-delito">+</button>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<script>
	var inputsText = document.querySelectorAll('input[type="text"]');
	var inputsEmail = document.querySelectorAll('input[type="email"]');

	inputsText.forEach((input) => {
		input.addEventListener('input', (event) => {
			event.target.value = clearText(event.target.value).toUpperCase();
		}, false)
	});

	inputsEmail.forEach((input) => {
		input.addEventListener('input', (event) => {
			event.target.value = clearText(event.target.value).toLowerCase();
		}, false)
	});

	function mayuscTextarea(e) {
		e.value = e.value.toUpperCase();
	}

	function clearSelect(select_element) {
		for (let i = select_element.options.length; i >= 1; i--) {
			select_element.remove(i);
		}
	}

	function clearText(text) {
		text
			.normalize('NFD')
			.replace(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi, "$1")
			.normalize();
		return text.replaceAll('´', '');
	}

	document.querySelector('#municipio').addEventListener('change', (e) => {
		let select_colonia = document.querySelector('#colonia_select');
		let colonia = document.querySelector('#colonia');

		let estado = 2;
		let municipio = e.target.value;

		clearSelect(select_colonia);

		let data = {
			'estado_id': estado,
			'municipio_id': municipio
		};

		select_colonia.classList.remove('d-none');
		colonia.classList.add('d-none');

		$.ajax({
			data: data,
			url: "<?= base_url('/data/get-colonias-by-estado-and-municipio') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				let colonias = response.data;

				colonias.forEach(colonia => {
					var option = document.createElement("option");
					option.text = colonia.COLONIADESCR;
					option.value = colonia.COLONIAID;
					select_colonia.add(option);
				});
				var option = document.createElement("option");
				option.text = 'OTRO';
				option.value = '0';
				select_colonia.add(option);
			},
			error: function(jqXHR, textStatus, errorThrown) {}
		});
	});

	document.querySelector('#colonia_select').addEventListener('change', (e) => {
		let select_colonia = document.querySelector('#colonia_select');
		let input_colonia = document.querySelector('#colonia');

		if (e.target.value === '0') {
			select_colonia.classList.add('d-none');
			input_colonia.classList.remove('d-none');
			input_colonia.focus();
		} else {
			input_colonia.value = e.target.value;
		}
	});
</script>

<?php $this->endSection() ?>