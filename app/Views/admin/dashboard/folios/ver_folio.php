<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php $session = session(); ?>
<div class="row" id="videoDen">
	<div id="card1" class="col-12 col-sm-6 col-md-4">
		<div class="card rounded bg-white shadow" style="height: 240px;">
			<div class="card-body p-4">
				<div class="row d-none">
					<div class="col-12">
						<select class="form-control d-none" id="year_select" name="year_select">
							<?php for ($i = date('Y'); $i >= 2020; $i--) { ?>
								<option <?= $i == date('Y') ? 'selected' : null  ?> value="<?= $i ?>"><?= $i ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12">
						<div class="input-group mb-1">
							<input type="text" class="form-control d-none" id="input_folio_atencion" placeholder="Folio" value="<?= isset($body_data->folio) ? $body_data->folio : '' ?>">
						</div>
					</div>
				</div>
				<button id="buscar-btn" class="btn btn-secondary btn-block h-100 m-0 p-0" role="button"><i class="fas fa-search"></i> BUSCAR</button>
				<button id="buscar-nuevo-btn" class="btn btn-primary btn-block h-100 d-none m-0 p-0" role="button"><i class="fas fa-search"></i> BUSCAR NUEVO</button>
			</div>
		</div>
	</div>
	<div id="card2" class="col-12 col-sm-6 col-md-4 d-none">
		<div class="card rounded bg-white shadow" style="min-height: 240px;">
			<div class="card-body">
				<label class="font-weight-bold">Delito:</label>
				<input class="form-control" type="text" id="delito_dash">
				<label class="font-weight-bold">Descripción:</label>
				<textarea class="form-control" id="delito_descr_dash" rows="4"></textarea>
			</div>
		</div>
	</div>
	<div id="card3" class="col-12 col-sm-6 col-md-4 d-none">
		<div class="card rounded bg-white shadow" style="height: 240px;">
			<div class="card-body">
				<button id="info-folio-btn" class="btn btn-primary btn-block h-100" role="button" data-toggle="modal" data-target="#info_folio_modal"><i class="fas fa-file-alt"></i> INFORMACIÓN DEL CASO</button>
			</div>
		</div>
	</div>
</div>
<script>
	const inputFolio = document.querySelector('#input_folio_atencion');
	const buscar_btn = document.querySelector('#buscar-btn');
	const buscar_nuevo_btn = document.querySelector('#buscar-nuevo-btn');
	const info_folio_btn = document.querySelector('#info-folio-btn');
	const year_select = document.querySelector('#year_select');

	const card1 = document.querySelector('#card1');
	const card2 = document.querySelector('#card2');
	const card3 = document.querySelector('#card3');
	var respuesta;

	const mayuscTextarea = (e) => {
		e.value = e.value.toUpperCase();
	}

	buscar_btn.addEventListener('click', (e) => {
		$.ajax({
			data: {
				'folio': inputFolio.value,
				'year': year_select.value,
				'search': true
			},
			url: "<?= base_url('/data/get-folio-information') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				console.log(response);
				respuesta = response;
				if (response.status === 1) {
					const folio = response.folio;
					const preguntas = response.preguntas_iniciales;
					const personas = response.personas;
					const domicilios = response.domicilios;
					const vehiculos = response.vehiculos;

					inputFolio.classList.add('d-none');
					buscar_btn.classList.add('d-none');
					year_select.classList.add('d-none');
					buscar_nuevo_btn.classList.remove('d-none');

					card2.classList.remove('d-none');
					card3.classList.remove('d-none');

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
					document.querySelector('#delito_delito').value = folio.HECHODELITO;
					document.querySelector('#municipio_delito').value = folio.HECHOMUNICIPIOID;
					if (folio.HECHOLOCALIDADID) {
						let data = {
							'estado_id': 2,
							'municipio_id': folio.HECHOMUNICIPIOID
						};

						$.ajax({
							data: data,
							url: "<?= base_url('/data/get-localidades-by-municipio') ?>",
							method: "POST",
							dataType: "json",
							success: function(response) {
								let localidades = response.data;
								let select_localidad = document.querySelector('#localidad_delito');

								localidades.forEach(localidad => {
									var option = document.createElement("option");
									option.text = localidad.LOCALIDADDESCR;
									option.value = localidad.LOCALIDADID;
									select_localidad.add(option);
								});

								select_localidad.value = folio.HECHOLOCALIDADID;
							},
							error: function(jqXHR, textStatus, errorThrown) {}
						});
					} else {
						document.querySelector('#localidad_delito').value = '';
					}

					if (folio.HECHOCOLONIAID) {
						document.querySelector('#colonia_delito').classList.add('d-none');
						document.querySelector('#colonia_delito_select').classList.remove('d-none');
						let data = {
							'estado_id': 2,
							'municipio_id': folio.HECHOMUNICIPIOID,
							'localidad_id': folio.HECHOLOCALIDADID
						};
						$.ajax({
							data: data,
							url: "<?= base_url('/data/get-colonias-by-estado-municipio-localidad') ?>",
							method: "POST",
							dataType: "json",
							success: function(response) {
								let select_colonia = document.querySelector('#colonia_delito_select');
								let input_colonia = document.querySelector('#colonia_delito');
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

								select_colonia.value = folio.HECHOCOLONIAID;
								input_colonia.value = '-';
							},
							error: function(jqXHR, textStatus, errorThrown) {

							}
						});
					} else {
						document.querySelector('#colonia_delito').classList.remove('d-none');
						document.querySelector('#colonia_delito_select').classList.add('d-none');
						var option = document.createElement("option");
						option.text = 'OTRO';
						option.value = '0';
						document.querySelector('#colonia_delito_select').add(option);
						document.querySelector('#colonia_delito_select').value = '0';
						document.querySelector('#colonia_delito').value = folio.HECHOCOLONIADESCR;
					}

					document.querySelector('#calle_delito').value = folio.HECHOCALLE;
					document.querySelector('#exterior_delito').value = folio.HECHONUMEROCASA;
					document.querySelector('#interior_delito').value = folio.HECHONUMEROCASAINT;
					document.querySelector('#lugar_delito').value = folio.HECHOLUGARID;
					document.querySelector('#hora_delito').value = folio.HECHOHORA;
					document.querySelector('#fecha_delito').value = folio.HECHOFECHA;
					document.querySelector('#narracion_delito').value = folio.HECHONARRACION;

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
					Swal.fire({
						icon: 'error',
						html: response.status,
						confirmButtonColor: '#bf9b55',
					});
				} else if (response.status === 3) {
					card2.classList.add('d-none');
					card3.classList.add('d-none');
					let texto = 'El folio ya fue atentido por el agente<br><strong>' + response.agente + '</strong><br><br><strong>' + response.motivo + '</strong>';
					if (response.motivo == 'EXPEDIENTE') {
						texto = texto + '<br><strong>' + response.expediente + '</strong>';
					}
					Swal.fire({
						icon: 'error',
						html: texto,
						confirmButtonColor: '#bf9b55',
					})
				} else {
					card2.classList.add('d-none');
					card3.classList.add('d-none');
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
		document.querySelector('#delito_delito').value = '';
		document.querySelector('#municipio_delito').value = '';
		document.querySelector('#localidad_delito').value = '';
		document.querySelector('#colonia_delito').value = '';
		document.querySelector('#colonia_delito_select').value = '';
		document.querySelector('#calle_delito').value = '';
		document.querySelector('#exterior_delito').value = '';
		document.querySelector('#interior_delito').value = '';
		document.querySelector('#lugar_delito').value = '';
		document.querySelector('#hora_delito').value = '';
		document.querySelector('#fecha_delito').value = '';
		document.querySelector('#narracion_delito').value = '';
		clearSelect(document.querySelector('#colonia_delito_select'));
		clearSelect(document.querySelector('#localidad_delito'));

		$('#v-pills-vehiculos-tab').css('display', 'NONE');
	}

	buscar_nuevo_btn.addEventListener('click', () => {
		history.back();
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
					let figura = response.figura;
					let cabelloColor = response.cabelloColor;
					let cabelloTamano = response.cabelloTamano;
					let frenteForma = response.frenteForma;
					let ojoColor = response.ojoColor;
					let cabelloEstilo = response.cabelloEstilo;
					let cejaForma = response.cejaForma;
					let pielColor = response.pielColor;
					let parentesco = response.parentesco;
					let folio = response.folio;

					if (personaid.DENUNCIANTE == 'S' && personaid.FOTO) {
						document.querySelector('#fisica_foto').setAttribute('src', personaid.FOTO);
						extension = (((personaid.FOTO.split(';'))[0]).split('/'))[1];
						document.querySelector('#fisica_foto_download').setAttribute('href', personaid.FOTO);
						document.querySelector('#fisica_foto_download').setAttribute('download', personaid.NOMBRE ? personaid.NOMBRE + '_' + personaid.PERSONAFISICAID + '_' + personaid.FOLIOID + '_' + personaid.ANO + '.' + extension : personaid.PERSONAFISICAID + '_' + personaid.FOLIOID + '_' + personaid.ANO + '.' + extension);
						document.querySelector('#contenedor_fisica_foto').classList.remove('d-none');
					} else {
						document.querySelector('#fisica_foto').setAttribute('src', '');
						document.querySelector('#fisica_foto_download').setAttribute('href', '');
						document.querySelector('#fisica_foto_download').setAttribute('download', '');
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
						document.querySelector('#estaturaD').value = desaparecida.ESTATURA;
						document.querySelector('#pesoD').value = desaparecida.PESO;
						document.querySelector('#complexionD').value = figura.FIGURADESCR;
						document.querySelector('#colortezD').value = pielColor.PIELCOLORDESCR;
						document.querySelector('#senasD').value = desaparecida.SENASPARTICULARES;
						//	document.querySelector('#identidadD').value = desaparecida.IDENTIDAD;
						document.querySelector('#colorCD').value = cabelloColor.CABELLOCOLORDESCR;
						document.querySelector('#tamanoCD').value = cabelloTamano.CABELLOTAMANODESCR;
						document.querySelector('#formaCD').value = cabelloEstilo.CABELLOESTILODESCR;
						document.querySelector('#colorOD').value = ojoColor.OJOCOLORDESCR;
						document.querySelector('#tipoFD').value = frenteForma.FRENTEFORMADESCR;
						document.querySelector('#cejaD').value = cejaForma.CEJAFORMADESCR;
						document.querySelector('#discapacidadD').value = desaparecida.DISCAPACIDADDESCR;
						//document.querySelector('#origenD').value = desaparecida.ORIGEN;
						if (desaparecida.FECHADESAPARICION) {
							let date = new Date(desaparecida.FECHADESAPARICION);
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
						document.querySelector('#lugarDesaparicion').value = desaparecida.LUGARDESAPARICION;
						document.querySelector('#vestimentaD').value = desaparecida.VESTIMENTA;
						document.querySelector('#parentescoD').value = parentesco.PERSONAPARENTESCODESCR;
						if (personaid.FOTO) {
							document.querySelector('#fisica_foto').setAttribute('src',personaid.FOTO);
							extension = (((personaid.FOTO.split(';'))[0]).split('/'))[1];
							document.querySelector('#fisica_foto_download').setAttribute('href', personaid.FOTO);
							document.querySelector('#fisica_foto_download').setAttribute('download', personaid.NOMBRE ? personaid.NOMBRE + '_' + personaid.PERSONAFISICAID + '_' + personaid.FOLIOID + '_' + personaid.ANO + '.' + extension : personaid.PERSONAFISICAID + '_' + personaid.FOLIOID + '_' + personaid.ANO + '.' + extension);
							document.querySelector('#contenedor_fisica_foto').classList.remove('d-none');
						} else {
							document.querySelector('#fisica_foto').setAttribute('src', '');
							document.querySelector('#fisica_foto_download').setAttribute('href', '');
							document.querySelector('#fisica_foto_download').setAttribute('download', '');
							document.querySelector('#contenedor_fisica_foto').classList.add('d-none');
						}
						document.querySelector('#autorizaFoto').value = folio.LOCALIZACIONPERSONAMEDIOS == 'S' ? 'SI' : 'NO';

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
				'id': id,
				'folio': inputFolio.value,
				'year': year_select.value,
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
				'id': id,
				'folio': inputFolio.value,
				'year': year_select.value,
			},
			url: "<?= base_url('/data/get-persona-vehiculo-by-id') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				if (response.status == 1) {
					const vehiculo = response.vehiculo;
					const color = response.color;
					const tipov = response.tipov;
					if (vehiculo.TIPOID == null) {
						document.querySelector('#tipo_vehiculo').value = "";
					} else {
						document.querySelector('#tipo_vehiculo').value = tipov.VEHICULOTIPODESCR;
					}
					document.querySelector('#color_vehiculo').value = color ? color.VEHICULOCOLORDESCR : '';
					document.querySelector('#description_vehiculo').value = vehiculo.SENASPARTICULARES;

					if (vehiculo.FOTO) {
						extension = (((vehiculo.FOTO.split(';'))[0]).split('/'))[1];
						document.querySelector('#foto_vehiculo').setAttribute('src', vehiculo.FOTO);
						document.querySelector('#downloadImage').setAttribute('href', vehiculo.FOTO);
						document.querySelector('#downloadImage').setAttribute('download', vehiculo.FOLIOID + '_' + vehiculo.ANO + '_' + vehiculo.VEHICULOID + '_vehiculo.' + extension);
						document.querySelector('#downloadImage').classList.remove('d-none');
					} else {
						document.querySelector('#foto_vehiculo').setAttribute('src', '<?= base_url() ?>/assets/img/no_image.jpeg');
						document.querySelector('#downloadImage').setAttribute('href', '');
						document.querySelector('#downloadImage').setAttribute('download', '');
						document.querySelector('#downloadImage').classList.add('d-none');
					}
					if (vehiculo.DOCUMENTO) {
						extension = (((vehiculo.DOCUMENTO.split(';'))[0]).split('/'))[1];
						if (extension == 'pdf' || extension == 'doc') {
							document.querySelector('#doc_vehiculo').setAttribute('src', '<?= base_url() ?>/assets/img/file.png');
						} else {
							document.querySelector('#doc_vehiculo').setAttribute('src', vehiculo.DOCUMENTO);
						}
						document.querySelector('#downloadDoc').setAttribute('href', vehiculo.DOCUMENTO);
						document.querySelector('#downloadDoc').setAttribute('download', vehiculo.FOLIOID + '_' + vehiculo.ANO + '_' + vehiculo.VEHICULOID + '_documento.' + extension);
						document.querySelector('#downloadDoc').classList.remove('d-none');
					} else {
						document.querySelector('#doc_vehiculo').setAttribute('src', '<?= base_url() ?>/assets/img/no_image.jpeg');
						document.querySelector('#downloadDoc').setAttribute('href', '');
						document.querySelector('#downloadDoc').setAttribute('download', '');
						document.querySelector('#downloadDoc').classList.add('d-none');
					}
					$('#folio_vehiculo_modal').modal('show');
				} else {
					Swal.fire({
						icon: 'error',
						html: 'No se encontró el vehículo.',
						confirmButtonColor: '#bf9b55',
					});
				}
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

	//DELITO FORM ******************************************************************
	window.onload = function() {
		(function() {
			'use strict'
			var form_delito = document.querySelector('#denuncia_form');
			var form_preguntas = document.querySelector('#preguntas_form');
			var inputsText = document.querySelectorAll('input[type="text"]');

			document.querySelector('#buscar-btn').click();

			form_delito.addEventListener('submit', (event) => {
				if (!form_delito.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
					form_preguntas.classList.add('was-validated')
				} else {
					event.preventDefault();
					event.stopPropagation();
					form_preguntas.classList.remove('was-validated')
					actualizarDenuncia();
				}
				form_delito.classList.add('was-validated')
			}, false);

			form_preguntas.addEventListener('submit', (event) => {
				if (!form_preguntas.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
					form_preguntas.classList.add('was-validated')
				} else {
					event.preventDefault();
					event.stopPropagation();
					form_preguntas.classList.remove('was-validated')
					actualizarPreguntas();
				}
			}, false);

			inputsText.forEach((input) => {
				input.addEventListener('input', (event) => {
					event.target.value = clearText(event.target.value).toUpperCase();
				}, false)
			});

			document.querySelector('#narracion_delito').addEventListener('input', (event) => {
				event.target.value = clearText(event.target.value).toUpperCase();
			}, false)

			document.querySelector('#municipio_delito').addEventListener('change', (e) => {
				let select_localidad = document.querySelector('#localidad_delito');
				let select_colonia = document.querySelector('#colonia_delito_select');
				let input_colonia = document.querySelector('#colonia_delito');

				let estado = 2;
				let municipio = e.target.value;

				clearSelect(select_localidad);
				clearSelect(select_colonia);
				select_colonia.classList.remove('d-none');
				input_colonia.classList.add('d-none');

				select_localidad.value = '';
				select_colonia.value = '';
				input_colonia.value = '';

				let data = {
					'estado_id': estado,
					'municipio_id': municipio
				};

				$.ajax({
					data: data,
					url: "<?= base_url('/data/get-localidades-by-municipio') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						let localidades = response.data;
						console.log('Localidades');
						clearSelect(select_localidad);
						clearSelect(select_colonia);
						localidades.forEach(localidad => {
							var option = document.createElement("option");
							option.text = localidad.LOCALIDADDESCR;
							option.value = localidad.LOCALIDADID;
							select_localidad.add(option);
						});
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			});

			document.querySelector('#localidad_delito').addEventListener('change', (e) => {
				let select_colonia = document.querySelector('#colonia_delito_select');
				let input_colonia = document.querySelector('#colonia_delito');

				let estado = 2;
				let municipio = document.querySelector('#municipio_delito').value;
				let localidad = e.target.value;

				clearSelect(select_colonia);
				select_colonia.classList.remove('d-none');
				input_colonia.classList.add('d-none');

				select_colonia.value = '';
				input_colonia.value = '';

				let data = {
					'estado_id': estado,
					'municipio_id': municipio,
					'localidad_id': localidad
				};

				$.ajax({
					data: data,
					url: "<?= base_url('/data/get-colonias-by-estado-municipio-localidad') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						clearSelect(select_colonia);
						console.log(response);
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
					error: function(jqXHR, textStatus, errorThrown) {

					}
				});
			});

			document.querySelector('#colonia_delito_select').addEventListener('change', (e) => {
				let select_colonia = document.querySelector('#colonia_delito_select');
				let input_colonia = document.querySelector('#colonia_delito');

				if (e.target.value === '0') {
					select_colonia.classList.add('d-none');
					input_colonia.classList.remove('d-none');
					input_colonia.value = '';
					input_colonia.focus();
				} else {
					input_colonia.value = '-';
				}
			});

			function actualizarDenuncia() {
				const data = {
					'folio': document.querySelector('#input_folio_atencion').value,
					'year': document.querySelector('#year_select').value,
					'delito_delito': document.querySelector('#delito_delito').value,
					'municipio_delito': document.querySelector('#municipio_delito').value,
					'localidad_delito': document.querySelector('#localidad_delito').value,
					'colonia_delito': document.querySelector('#colonia_delito').value,
					'colonia_delito_select': document.querySelector('#colonia_delito_select').value,
					'calle_delito': document.querySelector('#calle_delito').value,
					'exterior_delito': document.querySelector('#exterior_delito').value,
					'interior_delito': document.querySelector('#interior_delito').value,
					'lugar_delito': document.querySelector('#lugar_delito').value,
					'fecha_delito': document.querySelector('#fecha_delito').value,
					'hora_delito': document.querySelector('#hora_delito').value,
					'narracion_delito': document.querySelector('#narracion_delito').value,
				};
				$.ajax({
					data: data,
					url: "<?= base_url('/data/update-denuncia-by-id') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						if (response.status = 1) {
							Swal.fire({
								icon: 'success',
								text: 'Denuncia actualizada correctamente',
								confirmButtonColor: '#bf9b55',
							});
						} else {
							Swal.fire({
								icon: 'error',
								text: 'No se actualizó la denuncia',
								confirmButtonColor: '#bf9b55',
							});
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						Swal.fire({
							icon: 'error',
							text: 'No se actualizó la denuncia',
							confirmButtonColor: '#bf9b55',
						});
					}
				});
			}

			function actualizarPreguntas() {
				const data = {
					'folio': document.querySelector('#input_folio_atencion').value,
					'year': document.querySelector('#year_select').value,
					'es_menor': document.querySelector('#es_menor').value,
					'es_tercera_edad': document.querySelector('#es_tercera_edad').value,
					'tiene_discapacidad': document.querySelector('#tiene_discapacidad').value,
					'es_vulnerable': document.querySelector('#es_vulnerable').value,
					'vulnerable_descripcion': document.querySelector('#vulnerable_descripcion').value,
					'fue_con_arma': document.querySelector('#fue_con_arma').value,
					'lesiones': document.querySelector('#lesiones').value,
					'lesiones_visibles': document.querySelector('#lesiones_visibles').value,
					'esta_desaparecido': document.querySelector('#esta_desaparecido').value,
				};
				$.ajax({
					data: data,
					url: "<?= base_url('/data/update-preguntas-by-id') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						console.log(response);
						if (response.status = 1) {
							Swal.fire({
								icon: 'success',
								text: 'Preguntas actualizadas correctamente',
								confirmButtonColor: '#bf9b55',
							});
						} else {
							Swal.fire({
								icon: 'error',
								text: 'No se actualizaron las preguntas',
								confirmButtonColor: '#bf9b55',
							});
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						Swal.fire({
							icon: 'error',
							text: 'No se actualizaron las preguntas',
							confirmButtonColor: '#bf9b55',
						});
					}
				});
			}

		})();
	};
	//DELITO END FORM ******************************************************************
</script>

<?php include('modals/info_folio_modal.php') ?>
<?php include('modals/persona_modal.php') ?>
<?php include('modals/vehiculo_modal.php') ?>
<?php include('modals/domicilio_modal.php') ?>
<?php $this->endSection() ?>
