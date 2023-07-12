<div class="row">
	<h3 class="fw-bold text-center text-blue pb-3">Lugar del hecho</h3>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="delito_moral" class="form-label fw-bold input-required">Delito a denunciar:</label>
		<select class="form-select" id="delito_moral" name="delito_moral" required>
			<option selected disabled value="">Elige el delito</option>
			<?php foreach ($body_data->delitosUsuarios as $index => $delitos) { ?>
				<option value="<?= $delitos->DELITO ?>"> <?= $delitos->DELITO ?> </option>
			<?php } ?>
		</select>
		<div class="invalid-feedback">
			Selecciona el delito
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3 d-none" id="radio_documentos_vehiculo">
		<label for="documentos_vehiculo_moral" class="form-label font-weight-bold input-required">¿Cuentas con algún documento en ese momento para verificar la serie y las placas del auto?</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="documentos_vehiculo_moral" id="documentos_vehiculo_moral" value="N" required checked>
			<label class="form-check-label" for="documentos_vehiculo_moral">NO</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="documentos_vehiculo_moral" id="documentos_vehiculo_moral" value="S" required>
			<label class="form-check-label" for="documentos_vehiculo">SÍ</label>
		</div>


		<div class="form-check form-check-inline d-none">
			<input class="form-check-input" type="radio" name="documentos_vehiculo" id="documentos_vehiculo" value="O">
			<label class="form-check-label" for="documentos_vehiculo">OTRO</label>
		</div>
		<div class="invalid-feedback">
			Por favor, anexa una calle o avenida.
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="municipio_moral" class="form-label fw-bold">Municipio del delito:</label>
		<select class="form-select" id="municipio_moral" name="municipio_moral">
			<option selected disabled value="">Elige el municipio</option>
			<?php foreach ($body_data->municipios as $index => $municipio) { ?>
				<option value="<?= $municipio->MUNICIPIOID ?>"> <?= $municipio->MUNICIPIODESCR ?> </option>
			<?php } ?>
		</select>
		<div class="invalid-feedback">
			Por favor, selecciona un municipio.
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="localidad_moral" class="form-label fw-bold">Localidad del delito</label>
		<select class="form-select" id="localidad_moral" name="localidad_moral">
			<option selected disabled value="">Selecciona la localidad</option>
		</select>
		<div class="invalid-feedback">
			La localidad es obligatoria
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="colonia" class="form-label fw-bold">Colonia del delito</label>
		<select class="form-select" id="colonia_select_moral" name="colonia_select_moral">
			<option selected disabled value="">Selecciona la colonia</option>
		</select>
		<input type="text" class="form-control d-none" id="colonia_moral" name="colonia_moral" maxlength="50">
		<small class="text-primary fw-bold">Si no encuentras tu colonia selecciona otro</small>
		<div class="invalid-feedback">
			La colonia es obligatoria
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="calle_moral" class="form-label fw-bold ">Calle o avenida del delito:</label>
		<input type="text" class="form-control" id="calle_moral" name="calle_moral" maxlength="50">
		<div class="invalid-feedback">
			Por favor, anexa una calle o avenida.
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="exterior_moral" class="form-label fw-bold">No. exterior del delito:</label>
		<input type="text" class="form-control" id="exterior_moral" name="exterior_moral" maxlength="10">
		<div class="invalid-feedback">
			Por favor, anexa un número exterior del delito.
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="interior_moral" class="form-label fw-bold">No. interior del delito:</label>
		<input type="text" class="form-control" id="interior_moral" maxlength="10" name="interior_moral">
		<div class="invalid-feedback">
			Por favor, anexa un número interior del delito.
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="lugar_moral" class="form-label fw-bold input-required">Lugar del delito:</label>
		<select class="form-select" id="lugar_moral" name="lugar_moral" required>
			<option selected disabled value="">Elige el lugar del delito</option>
			<?php foreach ($body_data->lugares as $index => $lugar) { ?>
				<option value="<?= $lugar->HECHOLUGARID ?>"> <?= $lugar->HECHODESCR ?> </option>
			<?php } ?>
		</select>
		<div class="invalid-feedback">
			Por favor, selecciona un lugar.
		</div>
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3 d-flex align-items-center">
		<input class="form-check-input" type="checkbox" id="check_ubi" name="check_ubi">
		<label class="form-check-label fw-bold" for="check_ubi">
			Ubicación exacta del delito
		</label>
		<input type="text" class="form-control d-none" id="latitud_moral" name="latitud_moral">

		<input type="text" class="form-control d-none" id="longitud_moral" name="longitud_moral">
	</div>
	<div class="col-12 mb-3">
		<div class="d-none" id="map_moral" name="map_moral"></div>
	</div>
	<!-- <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="clasificacion" class="form-label fw-bold">Clasificación del lugar</label>
		<select class="form-select" id="clasificacion" name="clasificacion">
			<option selected disabled value="">Elige la clasificacion</option>
		</select>
	</div> -->
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="fecha_moral" class="form-label fw-bold input-required">Fecha del delito:</label>
		<input type="date" class="form-control" id="fecha_moral" name="fecha_moral" max="<?= date("Y-m-d") ?>" required>
		<div class="invalid-feedback">
			La fecha del delito es obligatoria
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="hora_moral" class="form-label fw-bold input-required">Hora del delito:</label>
		<input type="time" class="form-control" id="hora_moral" name="hora_moral" required>
		<!-- <small>Debe estar en formato de 24 horas.</small> -->
		<div class="invalid-feedback">
			La hora del delito es obligatoria
		</div>
	</div>
	<!-- <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="carta_poder_moral" class="form-label fw-bold input-required">Carta poder:</label>
		<input class="form-control" type="file" id="carta_poder_moral" name="carta_poder_moral" accept="image/jpeg, image/jpg, image/png, application/pdf" required>
		<img class="img-fluid d-none py-2" src="" id="img_preview_carta" name="img_preview_carta">

	</div> -->
	<div class="col-12 mb-3">
		<label for="descripcion_breve_moral" class="form-label fw-bold input-required">Descripción breve del delito</label>
		<textarea class="form-control" id="descripcion_breve_moral" name="descripcion_breve_moral" rows="10" maxlength="1000" oninput="mayuscTextarea(this)" onkeyup="contarCaracteres(this)" required></textarea>
		<small id="numCaracter">1000 caracteres restantes</small>
	</div>
	<div class="col-12 mb-3 text-left text-md-center">
		<label for="responsable" class="form-label fw-bold input-required">¿Conoce al posible responsable del delito?</label>
		<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="responsable" value="SI" required>
			<label class="form-check-label" for="flexRadioDefault1">SI</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="responsable" value="NO" required checked>
			<label class="form-check-label" for="flexRadioDefault2">NO</label>
		</div>
	</div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8Y8sKd0VSyZcl9kPdCewI2mpXh95AJ-8&callback=initMapMoral&v=weekly" defer></script>

<script>

	//Funcion para eliminar los optiones de un select
	function clearSelect(select_element) {
		for (let i = select_element.options.length; i >= 1; i--) {
			select_element.remove(i);
		}
	}
	///deshabilita los select hasta que dependen de otros
	document.querySelector('#localidad_moral').disabled = true;
	document.querySelector('#colonia_select_moral').disabled = true;


	
	// document.querySelector('#lugar').addEventListener('change', (e) => {
	// 	let select_clasificacion = document.querySelector('#clasificacion');

	// 	clearSelect(select_clasificacion);

	// 	data = {
	// 		'lugar_id': e.target.value,
	// 	}

	// 	$.ajax({
	// 		data: data,
	// 		url: "<?= base_url('/data/get-clasificacion-by-lugar') ?>",
	// 		method: "POST",
	// 		dataType: "json",
	// 		success: function(response) {
	// 			let clasificaciones = response.data;

	// 			clasificaciones.forEach(clasificacion => {
	// 				var option = document.createElement("option");
	// 				option.text = clasificacion.HECHOCLASIFICACIONLUGARDESCR;
	// 				option.value = clasificacion.HECHOCLASIFICACIONLUGARID;
	// 				select_clasificacion.add(option);
	// 			});
	// 		},
	// 		error: function(jqXHR, textStatus, errorThrown) {}
	// 	});
	// });

	let map_moral, infoWindowMoral;
	let markerMoral = null;
	let currentMoral = null;
	//inicializa el mapa del hecho
	const initMapMoral = () => {
		const position = {
			lat: 32.521036,
			lng: -117.015543
		};
		const BAJACALIFORNIA_BOUNDS = {
			north: 32.718754,
			south: 28,
			west: -118.407649,
			east: -112.65424,
			// 28,-118.407649 – 32.718754,-112.65424
			// Check bound in https://developers-dot-devsite-v2-prod.appspot.com/map_morals/documentation/utils/geocoder
		};
		map_moral = new google.maps.Map(document.getElementById("map_moral"), {
			center: position,
			zoom: 10,
			gestureHandling: "cooperative",
			// restriction: {
			//     latLngBounds: BAJACALIFORNIA_BOUNDS,
			//     strictBounds: false,
			// },
		});

		google.maps.event.addListener(map_moral, "click", (event) => {
			addMarkerMoral(event.latLng, map_moral, 'evento');
		});

		infoWindowMoral = new google.maps.InfoWindow();

		const locationButton = document.createElement("button");
		locationButton.style.backgroundColor = "#fff";
		locationButton.style.border = "2px solid #fff";
		locationButton.style.borderRadius = "3px";
		locationButton.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
		locationButton.style.color = "rgb(25,25,25)";
		locationButton.style.cursor = "pointer";
		locationButton.style.fontFamily = "Roboto,Arial,sans-serif";
		locationButton.style.fontSize = "16px";
		locationButton.style.lineHeight = "38px";
		locationButton.style.margin = "8px 0 22px";
		locationButton.style.padding = "0 5px";
		locationButton.style.textAlign = "center";
		locationButton.textContent = "Mi ubicación";
		locationButton.title = "Clic para ir a tu ubicación actual.";
		locationButton.type = "button";
		locationButton.classList.add("custom-map-control-button");
		map_moral.controls[google.maps.ControlPosition.TOP_CENTER].push(
			locationButton
		);

		currentPositionMoral();


		locationButton.addEventListener("click", () => {
			currentPositionMoral();
		});
	};
	//obtiene la posicion actual
	const currentPositionMoral = () => {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(	
				(position) => {
					const pos = {
						lat: position.coords.latitude,
						lng: position.coords.longitude,
					};

					map_moral.setCenter(pos);
					addMarkerMoral(pos, map_moral, 'current');
					map_moral.setZoom(15);
				},
				() => {
					handleLocationErrorMoral(true, infoWindowMoral, map_moral.getCenter());
				}
			);
		} else {
			handleLocationErrorMoral(false, infoWindowMoral, map_moral.getCenter());
		}
	};

	//obtiene los errores de la localizacion
	const handleLocationErrorMoral = (browserHasGeolocation, infoWindowMoral, pos) => {
		infoWindowMoral.setPosition(pos);
		infoWindowMoral.setContent(
			browserHasGeolocation ?
			"Error: The Geolocation service failed." :
			"Error: Your browser doesn't support geolocation."
		);
		infoWindowMoral.open(map_moral);
	};

	//marca en el mapa la posicion del hecho
	const addMarkerMoral = (position, map_moral, prov) => {

		markerMoral ? (markerMoral.setMap(null), (markerMoral = null)) : null;
		markerMoral = new google.maps.Marker({
			position,
		});
		if (prov == 'current') {
			document.getElementById('longitud_moral').value = position['lng'];
			document.getElementById('latitud_moral').value = position['lat'];

		} else {
			document.getElementById('longitud_moral').value = position;
			let stringpos = document.getElementById('longitud_moral').value
			if (typeof stringpos == 'string') {
				stringpos = stringpos.replace('(', '');
				stringpos = stringpos.replace(')', '');
				stringpos = stringpos.replace(' ', '');

				let arr = stringpos.split(',');
				const positionMake = {
					lat: arr[0],
					lng: arr[1]
				};
				document.getElementById('longitud_moral').value = positionMake['lng'];
				document.getElementById('latitud_moral').value = positionMake['lat'];

			}
		}


		// map.setCenter(position);
		markerMoral.setMap(map_moral);
	};

	window.initMapMoral = initMapMoral;

	//Funcion para contar carcateres de un elemento
	function contarCaracteres(obj) {
		var maxLength = 1000;
		var strLength = obj.value.length;
		var charRemain = (maxLength - strLength);

		if (charRemain < 0) {
			document.getElementById("numCaracter").innerHTML = '<span style="color: red;">Has superado el límite de ' + maxLength + ' caracteres </span>';
		} else {
			document.getElementById("numCaracter").innerHTML = charRemain + ' caracteres restantes';
		}
	}
</script>
