<div class="row">
	<h3 class="fw-bold text-center text-blue pb-3">Persona moral</h3>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="empresa" class="form-label fw-bold input-required">Empresa:</label>
		<select class="form-select" id="empresa" name="empresa" required>
			<option selected disabled value="">Elige la empresa</option>
			<?php foreach ($body_data->empresas as $index => $empresa) { ?>
				<option value="<?= $empresa->PERSONAMORALID ?>"> <?= $empresa->RAZONSOCIAL ?> </option>
			<?php } ?>
		</select>
		<div class="invalid-feedback">
			Selecciona la empresa
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="marca_comercial_d" class="form-label fw-bold">Marca comercial:</label>
		<input type="text" class="form-control" id="marca_comercial_d" name="marca_comercial_d">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="razon_social" class="form-label fw-bold input-required">Razón social:</label>
		<input type="text" class="form-control" id="razon_social" name="razon_social" required>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="rfc_empresa" class="form-label fw-bold input-required">RFC:</label>
		<input type="text" class="form-control" id="rfc_empresa" name="rfc_empresa" required>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="giro_empresa_denuncia" class="form-label fw-bold input-required">Giro de la empresa:</label>
		<select class="form-select" id="giro_empresa_denuncia" name="giro_empresa_denuncia" required>
			<option selected disabled value="">Elige el giro</option>
			<?php foreach ($body_data->giros as $index => $giro) { ?>
				<option value="<?= $giro->PERSONAMORALGIROID ?>"> <?= $giro->PERSONAMORALGIRODESCR ?> </option>
			<?php } ?>
		</select>
		<div class="invalid-feedback">
			Por favor, selecciona un giro.
		</div>
	</div>
	<!-- <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="poder_volumen" class="form-label fw-bold">Volumen:</label>
		<input type="text" class="form-control" id="poder_volumen" name="poder_volumen">
	</div>

	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="poder_no_poder" class="form-label fw-bold">Número de poder:</label>
		<input type="text" class="form-control" id="poder_no_poder" name="poder_no_poder">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="poder_no_notario" class="form-label fw-bold">Número de notario:</label>
		<input type="text" class="form-control" id="poder_no_notario" name="poder_no_notario">
	</div> -->
</div>
<div class="row" id="contenedor-direcciones">
	<h3 class="fw-bold text-center text-blue pb-3">Dirección de notificacion</h3>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="direccion" class="form-label fw-bold input-required">Dirección:</label>
		<select class="form-select" id="direccion" name="direccion" required>
			<option selected disabled value="">Elige la dirección</option>
		</select>
		<div class="invalid-feedback">
			Selecciona la empresa
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="correo_empresa" class="form-label fw-bold input-required">Correo electrónico</label>
		<div class="input-group">
			<span class="input-group-text" id="correo_vanity"><i class="bi bi-envelope-fill"></i></span>
			<input type="email" class="form-control" name="correo_empresa" id="correo_empresa" aria-describedby="correo_vanity" maxlength="100" required>
		</div>
		<div class="invalid-feedback">
			El correo esta erroneo
		</div>
	</div>


	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="estado_empresa" class="form-label fw-bold input-required">Estado:</label>
		<select class="form-select" id="estado_empresa" name="estado_empresa" required readonly>
			<option selected disabled value="">Elige el estado</option>
			<?php foreach ($body_data->estados as $index => $estado) { ?>
				<option value="<?= $estado->ESTADOID ?>"> <?= $estado->ESTADODESCR ?> </option>
			<?php } ?>
		</select>
		<div class="invalid-feedback">
			Por favor, selecciona un estado.
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="municipio_empresa" class="form-label fw-bold input-required">Municipio:</label>
		<select class="form-select" id="municipio_empresa" name="municipio_empresa" required>
			<option selected disabled value="">Elige el municipio</option>
		</select>
		<div class="invalid-feedback">
			Por favor, selecciona un municipio.
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="localidad_empresa" class="form-label fw-bold input-required">Localidad:</label>
		<select class="form-select" id="localidad_empresa" name="localidad_empresa" required>
			<option selected disabled value="">Elige la localidad</option>
		</select>
		<div class="invalid-feedback">
			Por favor, selecciona una localidad.
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="zona_empresa" class="form-label fw-bold">Zona:</label>
		<input type="text" class="form-control" id="zona_empresa" name="zona_empresa" maxlength="10" required>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="colonia" class="form-label fw-bold input-required">Colonia</label>
		<select class="form-select" id="colonia_select_empresa" name="colonia_select_empresa" required>
			<option selected disabled value="">Selecciona la colonia</option>
		</select>
		<input type="text" class="form-control d-none" id="colonia_input_empresa" name="colonia_input_empresa" maxlength="100" required>
		<small id="colonia-message" class="text-primary fw-bold">Si no encuentras la colonia selecciona otro</small>
		<div class="invalid-feedback">
			La colonia es obligatoria
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="calle_empresa" class="form-label fw-bold input-required">Calle:</label>
		<input class="form-control" type="text" id="calle_empresa" name="calle_empresa" required>
		<div class="invalid-feedback">
			La calle es obligatorio
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="n_empresa" class="form-label fw-bold input-required">Número exterior</label>
		<input type="text" class="form-control" id="n_empresa" name="n_empresa" maxlength="10" required>
		<div class="invalid-feedback">
			El número exterior es obligatorio
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="ninterior_empresa" class="form-label fw-bold">Número interior</label>
		<input type="text" class="form-control" id="ninterior_empresa" name="ninterior_empresa" maxlength="10">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="referencia_empresa" class="form-label fw-bold">Referencias</label>
		<input type="text" class="form-control" id="referencia_empresa" name="referencia_empresa" maxlength="300">
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
		<label for="telefono_empresa" class="form-label fw-bold input-required ">Télefono </label>
		<input type="number" class="form-control" id="telefono_empresa" name="telefono_empresa" required minlenght="10" maxlength="10" oninput="clearInputPhone(event);" pattern="[0-9]+">
		<small>El campo número debe tener 10 dígitos</small>
		<div class="invalid-feedback">
			El campo número debe tener 10 dígitos
		</div>
		<input type="number" id="codigo_pais" name="codigo_pais" maxlength="3" hidden>
	</div>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">

		<!-- Botón para agregar una dirección adicional -->
		<button id="agregar-direccion" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarDireccionModal">Agregar otra dirección</button>
	</div>
</div>
<script>
	//Funcion para eliminar los optiones de un select
	function clearSelect(select_element) {
		for (let i = select_element.options.length; i >= 1; i--) {
			select_element.remove(i);
		}
	}

	let map, infoWindow;
	let marker = null;
	let current = null;
	//inicializa el mapa del hecho
	const initMap = () => {
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
			// Check bound in https://developers-dot-devsite-v2-prod.appspot.com/maps/documentation/utils/geocoder
		};
		map = new google.maps.Map(document.getElementById("map"), {
			center: position,
			zoom: 10,
			gestureHandling: "cooperative",
			// restriction: {
			//     latLngBounds: BAJACALIFORNIA_BOUNDS,
			//     strictBounds: false,
			// },
		});

		google.maps.event.addListener(map, "click", (event) => {
			addMarker(event.latLng, map, 'evento');
		});

		infoWindow = new google.maps.InfoWindow();

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
		map.controls[google.maps.ControlPosition.TOP_CENTER].push(
			locationButton
		);

		currentPosition();


		locationButton.addEventListener("click", () => {
			currentPosition();
		});
	};
	//obtiene la posicion actual
	const currentPosition = () => {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(
				(position) => {
					const pos = {
						lat: position.coords.latitude,
						lng: position.coords.longitude,
					};

					map.setCenter(pos);
					addMarker(pos, map, 'current');
					map.setZoom(15);
				},
				() => {
					handleLocationError(true, infoWindow, map.getCenter());
				}
			);
		} else {
			handleLocationError(false, infoWindow, map.getCenter());
		}
	};

	//obtiene los errores de la localizacion
	const handleLocationError = (browserHasGeolocation, infoWindow, pos) => {
		infoWindow.setPosition(pos);
		infoWindow.setContent(
			browserHasGeolocation ?
			"Error: The Geolocation service failed." :
			"Error: Your browser doesn't support geolocation."
		);
		infoWindow.open(map);
	};

	//marca en el mapa la posicion del hecho
	const addMarker = (position, map, prov) => {

		marker ? (marker.setMap(null), (marker = null)) : null;
		marker = new google.maps.Marker({
			position,
		});
		if (prov == 'current') {
			document.getElementById('longitud').value = position['lng'];
			document.getElementById('latitud').value = position['lat'];

		} else {
			document.getElementById('longitud').value = position;
			let stringpos = document.getElementById('longitud').value
			if (typeof stringpos == 'string') {
				stringpos = stringpos.replace('(', '');
				stringpos = stringpos.replace(')', '');
				stringpos = stringpos.replace(' ', '');

				let arr = stringpos.split(',');
				const positionMake = {
					lat: arr[0],
					lng: arr[1]
				};
				document.getElementById('longitud').value = positionMake['lng'];
				document.getElementById('latitud').value = positionMake['lat'];

			}
		}


		// map.setCenter(position);
		marker.setMap(map);
	};

	window.initMap = initMap;

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