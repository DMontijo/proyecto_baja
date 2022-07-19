<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php $session = session(); ?>
<div class="row" id="videoDen">
	<div id="card1" class="col-3">
		<div class="card rounded bg-white shadow" style="height: 190px;">
			<div class="card-body p-4">
				<div class="row">
					<div class="col-12 mb-1">
						<select class="form-control" id="year_select"></select>
					</div>
					<div class="col-12">
						<div class="input-group mb-1">
							<input type="text" class="form-control" id="input_folio_atencion" placeholder="Folio" value="<?= isset($body_data->folio) ? $body_data->folio : '' ?>">
						</div>
					</div>
				</div>
				<button id="buscar-btn" class="btn btn-secondary btn-block" role="button"><i class="fas fa-search"></i> Buscar</button>
				<button id="buscar-nuevo-btn" class="btn btn-primary btn-block h-100 d-none m-0 p-0" role="button"><i class="fas fa-search"></i> Buscar nuevo</button>
			</div>
		</div>
	</div>
	<div id="card2" class="col-3 d-none">
		<div class="card rounded bg-white shadow" style="min-height: 190px;">
			<div class="card-body">
				<label class="font-weight-bold">Delito:</label>
				<input class="form-control" type="text" id="delito_dash">
				<label class="font-weight-bold">Descripción:</label>
				<textarea class="form-control" id="delito_descr_dash"></textarea>
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
		<?php if (session('USUARIOVIDEO') && session('TOKENVIDEO')) { ?>
			<div class="card rounded bg-white shadow">
				<div class="card-body embed-responsive embed-responsive-1by1 shadow rounded">
					<iframe src="<?= "https://videodenunciaserver1.fgebc.gob.mx/pde?u=" . session('USUARIOVIDEO') . "&token=" . session('TOKENVIDEO') ?>" frameborder="0" allow="camera *;microphone *"></iframe>
				</div>
			</div>
		<?php } else { ?>
			<div class="card rounded bg-white shadow">
				<div class="card-body">
					<h2>NO CUENTAS CON TOKEN PARA VIDEODENUNCIA</h2>
				</div>
			</div>
		<?php } ?>
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
				<textarea class="form-control" id="notas_mp" placeholder="Descripción del caso..." rows="10" required maxlength="300" oninput="mayuscTextarea(this)"></textarea>
			</div>
		</div>
	</div>
</div>
<script>
	const inputFolio = document.querySelector('#input_folio_atencion');
	const inputF = document.getElementById('input_folio_atencion').value;
	const buscar_btn = document.querySelector('#buscar-btn');
	const buscar_nuevo_btn = document.querySelector('#buscar-nuevo-btn');
	const info_folio_btn = document.querySelector('#info-folio-btn');
	const notas_mp = document.querySelector('#notas_mp');
	const year_select = document.querySelector('#year_select');

	const card1 = document.querySelector('#card1');
	const card2 = document.querySelector('#card2');
	const card3 = document.querySelector('#card3');
	const card4 = document.querySelector('#card4');
	const card5 = document.querySelector('#card5');
	var respuesta;

	const mayuscTextarea = (e) => {
		e.value = e.value.toUpperCase();
	}

	function llenarYearSelect() {
		let select = document.querySelector('#year_select');
		let currentTime = new Date();
		let year = currentTime.getFullYear()

		for (let i = year; i >= 2000; i--) {
			let option = document.createElement("option");
			option.text = i;
			option.value = i;
			select.add(option);
		}

		select.value = year;
	}

	llenarYearSelect();

	buscar_btn.addEventListener('click', (e) => {
		$.ajax({
			data: {
				'folio': inputFolio.value,
				'year': year_select.value
			},
			url: "<?= base_url('/data/get-folio-information') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				// console.log(response);
				respuesta = (response);
				if (response.status === 1) {
					const folio = response.folio;
					const preguntas = response.preguntas_iniciales;
					const personas = response.personas;
					const domicilios = response.domicilios;
					const vehiculos = response.vehiculos;
					const folioM = response.folioMunicipio;
					const folioC = response.folioColonia;
					const foliol = response.folioLugar;

					inputFolio.classList.add('d-none');
					buscar_btn.classList.add('d-none');
					year_select.classList.add('d-none');
					buscar_nuevo_btn.classList.remove('d-none');

					card2.classList.remove('d-none');
					card3.classList.remove('d-none');
					card4.classList.remove('d-none');
					card5.classList.remove('d-none');

					document.querySelector('#delito_dash').value = folio.HECHODELITO;
					document.querySelector('#delito_descr_dash').value = folio.HECHONARRACION;

					//PREGUNTAS INICIALES
					document.querySelector('#es_menor').value = preguntas.ES_MENOR;
					document.querySelector('#es_tercera_edad').value = preguntas.ES_TERCERA_EDAD;
					document.querySelector('#tiene_discapacidad').value = preguntas.TIENE_DISCAPACIDAD;
					document.querySelector('#es_vulnerable').value = preguntas.ES_GRUPO_VULNERABLE;
					document.querySelector('#vulnerable_descripcion').value = preguntas.ES_GRUPO_VULNERABLE_DESCR;
					document.querySelector('#tiene_discapacidad').value = preguntas.TIENE_DISCAPACIDAD;
					document.querySelector('#fue_con_arma').value = preguntas.FUE_CON_ARMA;
					document.querySelector('#esta_desaparecido').value = preguntas.ESTA_DESAPARECIDO;
					document.querySelector('#lesiones').value = preguntas.LESIONES;
					document.querySelector('#lesiones_visibles').value = preguntas.LESIONES_VISIBLES;

					//DENUNCIA
					document.querySelector('#delito').value = folio.HECHODELITO;
					document.querySelector('#municipio').value = folioM.MUNICIPIODESCR;
					document.querySelector('#colonia').value = folioC ? folioC.COLONIADESCR : folio.HECHOCOLONIADESCR;
					document.querySelector('#calle').value = folio.HECHOCALLE;
					document.querySelector('#exterior').value = folio.HECHONUMEROCASA;
					document.querySelector('#interior').value = folio.HECHONUMEROCASAINT;
					document.querySelector('#lugar').value = foliol.HECHODESCR;
					document.querySelector('#hora').value = folio.HECHOHORA;
					document.querySelector('#fecha').value = folio.HECHOFECHA;
					if (folio.HECHOFECHA) {
						let date = new Date(folio.HECHOFECHA);
						let dateToTijuanaString = date.toLocaleString('en-US', {
							timeZone: 'America/Tijuana'
						});
						let dateTijuana = new Date(dateToTijuanaString);
						dateTijuana.setDate(dateTijuana.getDate() + 1);
						var options = {
							year: 'numeric',
							month: 'long',
							day: 'numeric'
						};
						document.querySelector('#fecha').value = (dateTijuana.toLocaleDateString("es-ES", options)).toUpperCase();
					} else {
						document.querySelector('#fecha').value = '';
					}
					document.querySelector('#narracion').value = folio.HECHONARRACION;

					if (folio.HECHODELITO == "ROBO DE VEHÍCULO") {
						$('#v-pills-vehiculos-tab').css('display', 'block');

					} else {
						$('#v-pills-vehiculos-tab').css('display', 'NONE');
					}


					//PERSONAS
					for (let i = 0; i < personas.length; i++) {
						var btn = `<button type='button'  class='btn btn-primary' onclick='viewPersonaFisica(${personas[i].PERSONAFISICAID},${personas[i].CALIDADJURIDICAID})'><i class='fas fa-eye'></i></button>`

						var fila =
							`<tr id="row${i}">` +
							`<td class="text-center">${personas[i].DENUNCIANTE=='S'?'<strong>DENUNCIANTE</strong>':''}</td>` +
							`<td class="text-center">${personas[i].NOMBRE}</td>` +
							`<td class="text-center">${personas[i].PERSONACALIDADJURIDICADESCR}</td>` +
							`<td class="text-center">${btn}</td>` +
							`</tr>`;

						$('#table-personas tr:first').after(fila);
						$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
						var nFilas = $("#personas tr").length;
						$("#adicionados").append(nFilas - 1);
					}

					//VEHICULOS
					for (let i = 0; i < vehiculos.length; i++) {
						var btnVehiculo = `<button type='button' class='btn btn-primary' onclick='viewVehiculo(${vehiculos[i].VEHICULOID})'><i class='fas fa-eye'></i></button>`;

						var fila3 =
							`<tr id="row${i}">` +
							`<td class="text-center">DESCONOCIDO</td>` +
							`<td class="text-center">DESCONOCIDO</td>` +
							`<td class="text-center">${btnVehiculo}</td>` +
							`</tr>`;

						$('#table-vehiculos tr:first').after(fila3);
						$("#adicionados").text("");
						var nFilas = $("#vehiculos tr").length;
						$("#vehiculos").append(nFilas - 1);
					}

				} else if (response.status === 2) {
					card2.classList.add('d-none');
					card3.classList.add('d-none');
					card4.classList.add('d-none');
					card5.classList.add('d-none');
					Swal.fire({
						icon: 'error',
						html: 'El folio ya fue atentido por el agente<br><strong>' + response.agente + '</strong><br><br><strong>' + response.motivo + '</strong>',
						confirmButtonColor: '#bf9b55',
					})
				} else {
					card2.classList.add('d-none');
					card3.classList.add('d-none');
					card4.classList.add('d-none');
					card5.classList.add('d-none');
					Swal.fire({
						icon: 'error',
						text: 'El folio no existe, verificalo de nuevo.',
						confirmButtonColor: '#bf9b55',
					})
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log('Error');
			}
		});
	});

	function borrarTodo() {
		let currentTime = new Date();
		let year = currentTime.getFullYear()
		buscar_nuevo_btn.classList.add('d-none');
		inputFolio.classList.remove('d-none');
		inputFolio.value = "";
		year_select.classList.remove('d-none');
		year_select.value = year;
		buscar_btn.classList.remove('d-none');

		tabla_personas = document.querySelectorAll('#table-personas tr');
		tabla_vehiculos = document.querySelectorAll('#table-vehiculos tr');

		tabla_personas.forEach(row => {
			if (row.id !== '') {
				row.remove();
			}
		});

		tabla_vehiculos.forEach(row => {
			if (row.id !== '') {
				row.remove();
			}
		});

		card2.classList.add('d-none');
		card3.classList.add('d-none');
		card4.classList.add('d-none');
		card5.classList.add('d-none');

		document.querySelector('#delito_dash').value = '';
		document.querySelector('#delito_descr_dash').value = '';

		//PREGUNTAS INICIALES
		document.querySelector('#es_menor').value = '';
		document.querySelector('#es_tercera_edad').value = '';
		document.querySelector('#tiene_discapacidad').value = '';
		document.querySelector('#es_vulnerable').value = '';
		document.querySelector('#vulnerable_descripcion').value = '';
		document.querySelector('#fue_con_arma').value = '';
		document.querySelector('#esta_desaparecido').value = '';
		document.querySelector('#lesiones').value = '';
		document.querySelector('#lesiones_visibles').value = '';

		//DENUNCIA
		document.querySelector('#delito').value = '';
		document.querySelector('#municipio').value = '';
		document.querySelector('#colonia').value = '';
		document.querySelector('#calle').value = '';
		document.querySelector('#exterior').value = '';
		document.querySelector('#interior').value = '';
		document.querySelector('#lugar').value = '';
		document.querySelector('#hora').value = '';
		document.querySelector('#fecha').value = '';
		document.querySelector('#narracion').value = '';

		$('#v-pills-vehiculos-tab').css('display', 'NONE');
	}

	buscar_nuevo_btn.addEventListener('click', () => {
		borrarTodo();
	});

	function viewPersonaFisica(id, calidadId) {
		$.ajax({
			data: {
				'id': id,
				'folio': inputFolio.value,
				'year': year_select.value,
				'calidadId': calidadId
			},
			url: "<?= base_url('/data/get-persona-fisica-by-id') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				// console.log(response);
				if (response.status == 1) {

					//PERSONA
					let calidad = response.calidadjuridica;
					let personaid = response.personaid;
					let tipoi = response.tipoidentificacion;
					let nacionalidad = response.nacionalidad;
					let edocivil = response.edocivil;
					let pidioma = response.idioma;
					let desaparecida = response.personaDesaparecida;
					let edoOrigen = response.estadoOrigen;
					let munOrigen = response.municipioOrigen;
					let ocupacion = response.ocupacion;
					let escolaridad = response.escolaridad;
					if (personaid.DENUNCIANTE == 'S') {
						// console.log(personaid.FOTO);
						document.querySelector('#fisica_foto').setAttribute('src', personaid.FOTO);
						document.querySelector('#fisica_foto').classList.remove('d-none');
						document.querySelector('#contenedor_fisica_foto').classList.remove('d-none');
					} else {
						document.querySelector('#fisica_foto').setAttribute('src', '');
						document.querySelector('#fisica_foto').classList.add('d-none');
						document.querySelector('#contenedor_fisica_foto').classList.add('d-none');
					}

					document.querySelector('#calidad_juridicaP').value = calidad.PERSONACALIDADJURIDICADESCR ? calidad.PERSONACALIDADJURIDICADESCR : '';
					document.querySelector('#nombrePersona').value = personaid.NOMBRE ? personaid.NOMBRE : '';
					document.querySelector('#apellido_paternoP').value = personaid.PRIMERAPELLIDO ? personaid.PRIMERAPELLIDO : '';
					document.querySelector('#apellido_maternoP').value = personaid.SEGUNDOAPELLIDO ? personaid.SEGUNDOAPELLIDO : '';
					document.querySelector('#sexoP').value = personaid.SEXO ? (personaid.SEXO == 'F' ? 'FEMENINO' : 'MASCULINO') : '';

					if (personaid.TIPOIDENTIFICACIONID == null) {
						document.querySelector('#tipoiP').value = '';
					} else {
						document.querySelector('#tipoiP').value = tipoi.PERSONATIPOIDENTIFICACIONDESCR;
					}
					if (personaid.NACIONALIDADID == null) {
						document.querySelector('#nacionalidadp').value = '';
					} else {
						document.querySelector('#nacionalidadp').value = nacionalidad.PERSONANACIONALIDADDESCR;
					}
					if (personaid.ESTADOCIVILID == null) {
						document.querySelector('#edocp').value = '';
					} else {
						document.querySelector('#edocp').value = edocivil.PERSONAESTADOCIVILDESCR;
					}
					if (personaid.PERSONAIDIOMAID == null) {
						document.querySelector('#idiomap').value = '';
					} else {
						document.querySelector('#idiomap').value = pidioma.PERSONAIDIOMADESCR;
					}
					if (personaid.FECHANACIMIENTO) {
						let date = new Date(personaid.FECHANACIMIENTO);
						let dateToTijuanaString = date.toLocaleString('en-US', {
							timeZone: 'America/Tijuana'
						});
						let dateTijuana = new Date(dateToTijuanaString);
						dateTijuana.setDate(dateTijuana.getDate() + 1);
						var options = {
							year: 'numeric',
							month: 'long',
							day: 'numeric'
						};
						document.querySelector('#fecha_nacimientoP').value = (dateTijuana.toLocaleDateString("es-ES", options)).toUpperCase();
					} else {
						document.querySelector('#fecha_nacimientoP').value = '';
					}

					document.querySelector('#edadP').value = personaid.EDADCANTIDAD ? personaid.EDADCANTIDAD : '';
					document.querySelector('#numero_identidadP').value = personaid.NUMEROIDENTIFICACION ? personaid.NUMEROIDENTIFICACION : '';
					document.querySelector('#telefonoP').value = `+${personaid.CODIGOPAISTEL?personaid.CODIGOPAISTEL:''} - ${personaid.TELEFONO ? personaid.TELEFONO : ''}`;
					document.querySelector('#telefonoP2').value = `+${personaid.CODIGOPAISTEL2?personaid.CODIGOPAISTEL2:''} - ${personaid.TELEFONO2 ? personaid.TELEFONO2 : ''}`;
					document.querySelector('#apodo').value = personaid.APODO ? personaid.APODO : '';
					document.querySelector('#correoP').value = personaid.CORREO ? personaid.CORREO : '';

					document.querySelector('#edoorigenp').value = edoOrigen ? edoOrigen.ESTADODESCR : '';
					document.querySelector('#munorigenp').value = munOrigen ? munOrigen.MUNICIPIODESCR : '';
					document.querySelector('#escolaridadP').value = escolaridad ? escolaridad.PERSONAESCOLARIDADDESCR : '';
					document.querySelector('#ocupacionP').value = ocupacion ? ocupacion.PERSONAOCUPACIONDESCR : '';
					document.querySelector('#descripcionFisicaP').value = personaid.DESCRIPCION_FISICA ? personaid.DESCRIPCION_FISICA : '';


					//PERSONA DESAPARECIDA
					if (personaid.DESAPARECIDA == 'S') {

						for (let index = 0; index < desaparecida.length; index++) {
							document.querySelector('#estaturaD').value = desaparecida[index].ESTATURA;
							document.querySelector('#pesoD').value = desaparecida[index].PESO;
							document.querySelector('#complexionD').value = desaparecida[index].COMPLEXION;
							document.querySelector('#colortezD').value = desaparecida[index].COLOR_TEZ;
							document.querySelector('#senasD').value = desaparecida[index].SENAS;
							//	document.querySelector('#identidadD').value = desaparecida[index].IDENTIDAD;
							document.querySelector('#colorCD').value = desaparecida[index].COLOR_CABELLO;
							document.querySelector('#tamanoCD').value = desaparecida[index].TAM_CABELLO;
							document.querySelector('#formaCD').value = desaparecida[index].FORMA_CABELLO;
							document.querySelector('#colorOD').value = desaparecida[index].COLOR_OJOS;
							document.querySelector('#tipoFD').value = desaparecida[index].FRENTE;
							document.querySelector('#cejaD').value = desaparecida[index].CEJA;
							document.querySelector('#discapacidadD').value = desaparecida[index].DISCAPACIDAD;
							document.querySelector('#origenD').value = desaparecida[index].ORIGEN;
							if (desaparecida[index].DIA_DESAPARICION) {
								let date = new Date(desaparecida[index].DIA_DESAPARICION);
								let dateToTijuanaString = date.toLocaleString('en-US', {
									timeZone: 'America/Tijuana'
								});
								let dateTijuana = new Date(dateToTijuanaString);
								dateTijuana.setDate(dateTijuana.getDate() + 1);
								var options = {
									year: 'numeric',
									month: 'long',
									day: 'numeric'
								};
								document.querySelector('#diaDesaparicion').value = (dateTijuana.toLocaleDateString("es-ES", options)).toUpperCase();
							} else {
								document.querySelector('#diaDesaparicion').value = '';
							}
							document.querySelector('#lugarDesaparicion').value = desaparecida[index].LUGAR_DESAPARICION;
							document.querySelector('#vestimentaD').value = desaparecida[index].VESTIMENTA;
							document.querySelector('#parentescoD').value = desaparecida[index].PARENTESCO;
							if (desaparecida[index].FOTOGRAFIA) {
								document.querySelector('#fisica_foto').setAttribute('src', 'data:' + desaparecida[index].FOTOGRAFIA);
								document.querySelector('#fisica_foto').classList.remove('d-none');
								document.querySelector('#contenedor_fisica_foto').classList.remove('d-none');
							} else {
								document.querySelector('#fisica_foto').setAttribute('src', '');
								document.querySelector('#fisica_foto').classList.add('d-none');
								document.querySelector('#contenedor_fisica_foto').classList.add('d-none');
							}
							document.querySelector('#autorizaFoto').value = desaparecida[index].AUTORIZA_FOTO == 'S' ? 'SI' : 'NO';
						}

						document.getElementById("personadesaparecida").style.display = "block";

					} else {
						document.getElementById("personadesaparecida").style.display = "none";
					}

					//DOMICILIO
					if (response.domicilio.persondom) {
						let domicilio = response.domicilio.persondom;
						let estadoDom = response.domicilio.estado;
						let municipioDom = response.domicilio.municipio;
						let localidadDom = response.domicilio.localidad;
						let coloniaDom = response.domicilio.colonia;

						var qestado = document.querySelector('#estadoper').value;
						var qmunicipio = document.querySelector('#municipiop').value;
						var qlocalidad = document.querySelector('#localidadp').value;

						if (estadoDom == null) {
							document.querySelector('#estadoper').value = '';
						} else {
							document.querySelector('#estadoper').value = estadoDom.ESTADODESCR;
						}
						if (municipioDom == null) {
							document.querySelector('#municipiop').value = '';
						} else {
							document.querySelector('#municipiop').value = municipioDom.MUNICIPIODESCR;
						}
						if (localidadDom == null) {
							document.querySelector('#localidadp').value = '';
						} else {
							document.querySelector('#localidadp').value = localidadDom.LOCALIDADDESCR;
						}

						document.querySelector('#coloniap').value = domicilio.COLONIAID != 0 ? (coloniaDom ? coloniaDom.COLONIADESCR : '') : domicilio.COLONIADESCR;
						document.querySelector('#cp').value = domicilio.CP;
						document.querySelector('#callep').value = domicilio.CALLE;
						document.querySelector('#exteriorp').value = domicilio.NUMEROCASA;
						document.querySelector('#interiorp').value = domicilio.NUMEROINTERIOR;
						document.querySelector('#zonap').value = domicilio.ZONA ? (domicilio.ZONA == 'U' ? 'URBANA' : 'RURAL') : '';
					} else {
						document.querySelector('#estadoper').value = '';
						document.querySelector('#estadoper').value = '';
						document.querySelector('#municipiop').value = '';
						document.querySelector('#municipiop').value = '';
						document.querySelector('#localidadp').value = '';
						document.querySelector('#localidadp').value = '';
						document.querySelector('#coloniap').value = '';
						document.querySelector('#cp').value = '';
						document.querySelector('#callep').value = '';
						document.querySelector('#exteriorp').value = '';
						document.querySelector('#interiorp').value = '';
						document.querySelector('#zonap').value = '';
					}

					$('#folio_persona_fisica_modal').modal('show');
				} else {
					Swal.fire({
						icon: 'error',
						html: 'No se encontro a la persona física',
						confirmButtonColor: '#bf9b55',
					})
				}
			}
		});
	}

	function viewDomicilio(id) {
		$.ajax({
			data: {
				'folio': document.querySelector('#input_folio_atencion').value,
				'id': id
			},
			url: "<?= base_url('/data/get-persona-domicilio-by-id') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				const pais = response.pais;
				const persondom = response.persondom;
				const estado = response.estado;
				const municipio = response.municipio;
				const localidad = response.localidad;
				const colonia = response.colonia;

				var qestado = document.querySelector('#estadoper').value;
				var qmunicipio = document.querySelector('#municipiop').value;
				var qlocalidad = document.querySelector('#localidadp').value;

				if (persondom.ESTADOID == null) {
					document.querySelector('#estadoper').value = '';
				} else {
					document.querySelector('#estadoper').value = estado.ESTADODESCR;
				}
				if (persondom.MUNICIPIOID == null) {
					document.querySelector('#municipiop').value = '';
				} else {
					document.querySelector('#municipiop').value = municipio.MUNICIPIODESCR;
				}
				if (persondom.LOCALIDADID == null) {
					document.querySelector('#localidadp').value = '';
				} else {
					document.querySelector('#localidadp').value = localidad.LOCALIDADDESCR;
				}

				document.querySelector('#coloniap').value = persondom.COLONIAID != 0 ? colonia.COLONIADESCR : persondom.COLONIADESCR;
				document.querySelector('#cp').value = persondom.CP;
				document.querySelector('#callep').value = persondom.CALLE;
				document.querySelector('#exteriorp').value = persondom.NUMEROCASA;
				document.querySelector('#interiorp').value = persondom.NUMEROINTERIOR;
				document.querySelector('#zonap').value = persondom.ZONA ? (persondom.ZONA == 'U' ? 'URBANA' : 'RURAL') : '';
				$('#folio_domicilio_modal').modal('show');
			}
		});
	}

	function viewVehiculo(id) {
		$.ajax({
			data: {
				'folio': document.querySelector('#input_folio_atencion').value,
				'id': id
			},
			url: "<?= base_url('/data/get-persona-vehiculo-by-id') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				const vehiculo = response.vehiculo;
				const color = response.color;
				const estadov = response.estadov;
				const tipov = response.tipov;
				if (vehiculo.TIPOID == null) {
					document.querySelector('#tipo_vehiculo').value = "NULL";
				} else {
					document.querySelector('#tipo_vehiculo').value = tipov.VEHICULOTIPODESCR;
				}
				document.querySelector('#color_vehiculo').value = color ? color.VEHICULOCOLORDESCR : '';
				document.querySelector('#foto_vehiculo').setAttribute('src', 'data:image/jpg;base64,' + vehiculo.FOTO);
				document.querySelector('#downloadImage').setAttribute('href', 'data:image/jpg;base64,' + vehiculo.FOTO);
				document.querySelector('#description_vehiculo').value = vehiculo.SENASPARTICULARES;
				document.querySelector('#doc_vehiculo').setAttribute('src', 'data:image/jpg;base64,' + vehiculo.DOCUMENTO);
				document.querySelector('#downloadDoc').setAttribute('href', 'data:image/jpg;base64,' + vehiculo.DOCUMENTO);

				$('#folio_vehiculo_modal').modal('show');
			}
		});
	}

	$(document).on('hidden.bs.modal', '#info_folio_modal', function() {
		let tabs = document.querySelectorAll('#info_tabs .nav-link');
		let contents = document.querySelectorAll('#info_content .tab-pane');
		tabs.forEach(element => {
			element.classList.remove('active');
		});
		contents.forEach(element => {
			element.classList.remove('show');
			element.classList.remove('active');
		});
		tabs[0].classList.add('active');
		contents[0].classList.add('show');
		contents[0].classList.add('active');
	})

	$(document).on('hidden.bs.modal', '#folio_persona_fisica_modal', function() {
		let tabs = document.querySelectorAll('#persona_tabs .nav-item .nav-link');
		let contents = document.querySelectorAll('#persona_content .tab-pane');
		tabs.forEach(element => {
			element.classList.remove('active');
		});
		contents.forEach(element => {
			element.classList.remove('show');
			element.classList.remove('active');
		});
		tabs[0].classList.add('active');
		contents[0].classList.add('show');
		contents[0].classList.add('active');
	})
</script>

<?php include('video_denuncia_modals/info_folio_modal.php') ?>
<?php include('video_denuncia_modals/salida_modal.php') ?>
<?php include('video_denuncia_modals/persona_modal.php') ?>
<?php include('video_denuncia_modals/vehiculo_modal.php') ?>
<?php include('video_denuncia_modals/domicilio_modal.php') ?>
<?php $this->endSection() ?>
