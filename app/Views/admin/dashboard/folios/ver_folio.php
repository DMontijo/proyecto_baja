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
	$("input").prop('disabled', true);
	$("select").prop('disabled', true);
	$("textarea").prop('disabled', true);
</script>
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
					const relacion_parentesco = response.parentescoRelacion;
					const parentesco = response.parentesco;
					const personaiduno = response.personaiduno;
					const personaidDos = response.personaidDos;
					const relacionFisFis = response.relacionFisFis;
					const fisicaImpDelito = response.fisicaImpDelito;
					const delitosModalidadFiltro = response.delitosModalidadFiltro;
					const personafisica = response.personafisica;
					const imputados = response.imputados;
					const victimas = response.victimas;
					const objetos = response.objetos;

					inputFolio.classList.add('d-none');
					buscar_btn.classList.add('d-none');
					year_select.classList.add('d-none');
					buscar_nuevo_btn.classList.remove('d-none');

					card2.classList.remove('d-none');
					card3.classList.remove('d-none');

					document.querySelector('#delito_dash').value = folio.HECHODELITO;
					document.querySelector('#delito_descr_dash').value = folio.HECHONARRACION;

					$('#propietario_update').empty();
					let select_propietario_update = document.querySelector("#propietario_update")
					personas.forEach(persona => {
						const option = document.createElement('option');
						option.value = persona.PERSONAFISICAID;
						option.text = persona.NOMBRE + ' ' + persona.PRIMERAPELLIDO;
						select_propietario_update.add(option, null);
					});
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
						var btn = `<button type='button'  class='btn btn-primary' onclick='viewPersonaFisica(${personas[i].PERSONAFISICAID})'><i class='fas fa-eye'></i></button>`

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
					//Relacion parentesco
					for (let i = 0; i < relacion_parentesco.length; i++) {

						// var btn = `<button type='button'  class='btn btn-primary' onclick='view_form_parentesco(${relacion_parentesco[i].PERSONAFISICAID1})'><i class="fas fa-eye"></i></button>`


						var fila2 =
							`<tr id="row${i}">` +
							`<td class="text-center">${personaiduno[i].NOMBRE}</td>` +
							`<td class="text-center">${parentesco[i].PERSONAPARENTESCODESCR}</td>` +
							`<td class="text-center">${personaidDos[i].NOMBRE}</td>` +
							// `<td class="text-center">${btn}</td>` +
							`</tr>`;

						$('#table-parentesco tr:first').after(fila2);
						$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
						var nFilas = $("#parentesco tr").length;
						$("#adicionados").append(nFilas - 1);

					}
					//Relacions fisfis
					for (let i = 0; i < relacionFisFis.length; i++) {
						// var btn = `<button type='button'  class='btn btn-primary' onclick='eliminarArbolDelictivo(${relacionFisFis[i].PERSONAFISICAIDVICTIMA},${relacionFisFis[i].PERSONAFISICAIDIMPUTADO},${relacionFisFis[i].DELITOMODALIDADID})'><i class='fa fa-trash'></i></button>`

						var fila =
							`<tr id="row${i}">` +
							`<td class="text-center">${relacionFisFis[i].NOMBREI}</td>` +
							`<td class="text-center">${relacionFisFis[i].DELITOMODALIDADDESCR}</td>` +
							`<td class="text-center">${relacionFisFis[i].NOMBREV}</td>` +
							// `<td class="text-center">${btn}</td>` +
							`</tr>`;

						$('#table-delitos tr:first').after(fila);
						$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
						var nFilas = $("#delitos tr").length;
						$("#adicionados").append(nFilas - 1);
					}
					//Relacion imputado delito
					for (let i = 0; i < fisicaImpDelito.length; i++) {
						// var btn = `<button type='button'  class='btn btn-primary' onclick='eliminarImputadoDelito(${impDelito[i].PERSONAFISICAID},${impDelito[i].DELITOMODALIDADID})'><i class='fa fa-trash'></i></button>`

						var fila =
							`<tr id="row${i}">` +
							`<td class="text-center" value="${fisicaImpDelito[i].PERSONAFISICAID}">${fisicaImpDelito[i].NOMBRE}</td>` +
							`<td class="text-center" value="${fisicaImpDelito[i].DELITOMODALIDADID}">${fisicaImpDelito[i].DELITOMODALIDADDESCR}</td>` +
							// `<td class="text-center">${btn}</td>` +
							`</tr>`;

						$('#table-delito-cometidos tr:first').after(fila);
						$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
						var nFilas = $("#delito-cometidos tr").length;
						$("#adicionados").append(nFilas - 1);
					}

					//Objetos involucrados
					console.log(response);
					for (let i = 0; i < objetos.length; i++) {
						var btnEditar = `<button type='button'  class='btn btn-primary' onclick='viewObjetoInvolucrado(${objetos[i].OBJETOID})'><i class='fa fa-eye'></i></button>`

						var fila =
							`<tr id="row${i}">` +
							`<td class="text-center" value="${objetos[i].CLASIFICACIONID}">${objetos[i].OBJETOCLASIFICACIONDESCR}</td>` +
							`<td class="text-center" value="${objetos[i].SUBCLASIFICACIONID}">${objetos[i].OBJETOSUBCLASIFICACIONDESCR}</td>` +
							`<td class="text-center">${btnEditar}</td>` +
							`</tr>`;

						$('#table-objetos-involucrados tr:first').after(fila);
						$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
						var nFilas = $("#objetos-involucrados tr").length;
						$("#adicionados").append(nFilas - 1);
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
		tabla_parentesco = document.querySelectorAll('#table-parentesco tr');
		tabla_relacion_fis_fis = document.querySelectorAll('#table-delitos tr');
		tabla_delito_cometido = document.querySelectorAll('#table-delito-cometidos tr');


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
		tabla_parentesco.forEach(row => {
			if (row.id !== '') {
				row.remove();
			}
		});
		tabla_relacion_fis_fis.forEach(row => {
			if (row.id !== '') {
				row.remove();
			}
		});
		tabla_delito_cometido.forEach(row => {
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

		//PERSONA FISICA
		document.querySelectorAll('#pf_id').forEach(element => {
			element.value = '';
		});
		document.querySelector('#tipo_identificacion_pf').value = '';
		document.querySelector('#numero_identidad_pf').value = '';
		document.querySelector('#nombre_pf').value = '';
		document.querySelector('#apellido_paterno_pf').value = '';
		document.querySelector('#apellido_materno_pf').value = '';
		document.querySelector('#nacionalidad_pf').value = '';
		document.querySelector('#idioma_pf').value = '';
		document.querySelector('#edoorigen_pf').value = '';
		document.querySelector('#munorigen_pf').value = '';
		document.querySelector('#telefono_pf').value = '';
		document.querySelector('#codigo_pais_pf').value = '';
		document.querySelector('#telefono_pf_2').value = '';
		document.querySelector('#codigo_pais_pf_2').value = '';
		document.querySelector('#correo_pf').value = '';
		document.querySelector('#fecha_nacimiento_pf').value = '';
		document.querySelector('#edad_pf').value = '';
		document.querySelector('#edoc_pf').value = '';
		document.querySelector('#sexo_pf').value = '';
		document.querySelector('#ocupacion_pf').value = '';
		document.querySelector('#escolaridad_pf').value = '';
		document.querySelector('#descripcionFisica_pf').value = '';
		document.querySelector('#calidad_juridica_pf').value = '';
		document.querySelector('#apodo_pf').value = '';
		document.querySelector('#denunciante_pf').value = '';
		document.querySelector('#facebook_pf').value = '';
		document.querySelector('#instagram_pf').value = '';
		document.querySelector('#twitter_pf').value = '';
		clearSelect(document.querySelector('#munorigen_pf'));

		//DOMICILIO PERSONA FISICA
		document.querySelector('#pfd_id').value = '';
		document.querySelector('#pais_pfd').value = '';
		document.querySelector('#estado_pfd').value = '';
		document.querySelector('#municipio_pfd').value = '';
		document.querySelector('#localidad_pfd').value = '';
		document.querySelector('#colonia_pfd_select').value = '';
		document.querySelector('#colonia_pfd').value = '';
		document.querySelector('#cp_pfd').value = '';
		document.querySelector('#calle_pfd').value = '';
		document.querySelector('#exterior_pfd').value = '';
		document.querySelector('#interior_pfd').value = '';
		document.querySelector('#referencia_pfd').value = '';
		document.querySelector('#zona_pfd').value = '';
		clearSelect(document.querySelector('#municipio_pfd'));
		clearSelect(document.querySelector('#localidad_pfd'));
		clearSelect(document.querySelector('#colonia_pfd_select'));

		//PARENTESCO
		document.querySelector('#parentesco_mf_I').value = '';
		document.querySelector('#personaFisica1_I').value = '';
		document.querySelector('#personaFisica2_I').value = '';
		document.querySelector('#parentesco_mf').value = '';
		document.querySelector('#personaFisica1').value = '';
		document.querySelector('#personaFisica2').value = '';

		//ARBOL DELICTUAL
		document.querySelector('#imputado_arbol').value = '';
		document.querySelector('#delito_cometido').value = '';
		document.querySelector('#victima_ofendido').value = '';

		//DELITOS COMETIDOS

		document.querySelector('#imputado_delito_cometido').value = '';
		document.querySelector('#delito_cometido_fisimpdelito').value = '';

		//RESET FORM
		document.getElementById("form_asignar_arbol_delictual_insert").reset();
		document.getElementById("form_parentesco_insert").reset();
		document.getElementById("form_delitos_cometidos_insert").reset();


		$('#v-pills-vehiculos-tab').css('display', 'NONE');
	}

	buscar_nuevo_btn.addEventListener('click', () => {
		history.back();
	});
	function viewObjetoInvolucrado(objetoid) {
				$('#folio_objetos_ver').modal('show');
				$.ajax({
					data: {
						'objetoid': objetoid,
						'folio': inputFolio.value,
						'year': year_select.value,
					},
					url: "<?= base_url('/data/get-objeto-involucrado-by-id') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						let objeto = response.objetoInvolucrado;
						let objeto_sub = response.objetosub;
						document.querySelector('#objeto_id').value = objeto.OBJETOID ? objeto.OBJETOID : '';
						document.querySelector('#situacion_objeto_update').value = objeto.SITUACION ? objeto.SITUACION : '';
						document.querySelector('#objeto_update_clasificacion').value = objeto.CLASIFICACIONID ? objeto.CLASIFICACIONID : '';
						// document.querySelector('#objeto_update_subclasificacion').value = objeto_sub.OBJETOSUBCLASIFICACIONID ? objeto_sub.OBJETOSUBCLASIFICACIONID : '';
						$('#objeto_update_subclasificacion').empty();
						let select_objeto_update_subclasificacion = document.querySelector("#objeto_update_subclasificacion");

						objeto_sub.forEach(objeto_sub => {
							const option = document.createElement('option');
							option.value = objeto_sub.SUBCLASIFICACIONID;
							option.text = objeto_sub.OBJETOSUBCLASIFICACIONDESCR;
							select_objeto_update_subclasificacion.add(option, null);
						});

						document.querySelector('#marca_objeto_update').value = objeto.MARCA ? objeto.MARCA : '';
						document.querySelector('#serie_objeto_update').value = objeto.NUMEROSERIE ? objeto.CANTIDAD : '';
						document.querySelector('#cantidad_objeto_update').value = objeto.CANTIDAD ? objeto.CANTIDAD : '';
						document.querySelector('#valor_objeto_update').value = objeto.VALOR ? objeto.VALOR : '';
						document.querySelector('#tipo_moneda_update').value = objeto.TIPOMONEDAID ? objeto.TIPOMONEDAID : '';
						document.querySelector('#descripcion_detallada_update').value = objeto.DESCRIPCIONDETALLADA ? objeto.DESCRIPCIONDETALLADA : '';
						document.querySelector('#propietario_update').value = objeto.PERSONAFISICAIDPROPIETARIO ? objeto.PERSONAFISICAIDPROPIETARIO : '';
						document.querySelector('#participa_estado_objeto_update').value = objeto.PARTICIPAESTADO ? objeto.PARTICIPAESTADO : '';

					}
				});
			}
	function viewPersonaFisica(id) {
		$.ajax({
			data: {
				'id': id,
				'folio': inputFolio.value,
				'year': year_select.value,
			},
			url: "<?= base_url('/data/get-persona-fisica-by-id') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				if (response.status == 1) {
					//PERSONA FISICA
					let personaFisica = response.personaFisica;
					//mediafiliacion 
					let mediaFiliacion = response.personaFisicaMediaFiliacion;
					let folio = response.folio;
					let parentesco = response.parentesco;
					let relacion_parentesco = response.parentescoRelacion;
					let idPersonaFisica = response.idPersonaFisica;
					document.querySelectorAll('#pf_id').forEach(element => {
						element.value = id;
					});
					if (personaFisica.FOTO) {
						document.querySelector('#fisica_foto').setAttribute('src', personaFisica.FOTO);
						extension = (((personaFisica.FOTO.split(';'))[0]).split('/'))[1];
						document.querySelector('#fisica_foto_download').setAttribute('href', personaFisica.FOTO);
						document.querySelector('#fisica_foto_download').setAttribute('download', personaFisica.NOMBRE ? personaFisica.NOMBRE + '_' + personaFisica.PERSONAFISICAID + '_' + personaFisica.FOLIOID + '_' + personaFisica.ANO + '.' + extension : personaFisica.PERSONAFISICAID + '_' + personaFisica.FOLIOID + '_' + personaFisica.ANO + '.' + extension);
						document.querySelector('#contenedor_fisica_foto').classList.remove('d-none');
					} else {
						document.querySelector('#fisica_foto').setAttribute('src', '');
						document.querySelector('#fisica_foto_download').setAttribute('href', '');
						document.querySelector('#fisica_foto_download').setAttribute('download', '');
						document.querySelector('#contenedor_fisica_foto').classList.add('d-none');
					}
					document.querySelector('#calidad_juridica_pf').value = personaFisica.CALIDADJURIDICAID ? personaFisica.CALIDADJURIDICAID : '';
					document.querySelector('#nombre_pf').value = personaFisica.NOMBRE ? personaFisica.NOMBRE : '';
					document.querySelector('#apellido_paterno_pf').value = personaFisica.PRIMERAPELLIDO ? personaFisica.PRIMERAPELLIDO : '';
					document.querySelector('#apellido_materno_pf').value = personaFisica.SEGUNDOAPELLIDO ? personaFisica.SEGUNDOAPELLIDO : '';
					document.querySelector('#sexo_pf').value = personaFisica.SEXO ? personaFisica.SEXO : '';
					document.querySelector('#tipo_identificacion_pf').value = personaFisica.TIPOIDENTIFICACIONID ? personaFisica.TIPOIDENTIFICACIONID : '';
					document.querySelector('#nacionalidad_pf').value = personaFisica.NACIONALIDADID ? personaFisica.NACIONALIDADID : '';
					document.querySelector('#edoc_pf').value = personaFisica.ESTADOCIVILID ? personaFisica.ESTADOCIVILID : '';
					document.querySelector('#idioma_pf').value = personaFisica.PERSONAIDIOMAID ? personaFisica.PERSONAIDIOMAID : '';
					document.querySelector('#fecha_nacimiento_pf').value = personaFisica.FECHANACIMIENTO ? personaFisica.FECHANACIMIENTO : '';
					document.querySelector('#edad_pf').value = personaFisica.EDADCANTIDAD ? personaFisica.EDADCANTIDAD : '';
					document.querySelector('#numero_identidad_pf').value = personaFisica.NUMEROIDENTIFICACION ? personaFisica.NUMEROIDENTIFICACION : '';
					document.querySelector('#codigo_pais_pf').value = personaFisica.CODIGOPAISTEL ? personaFisica.CODIGOPAISTEL : '52';
					document.querySelector('#codigo_pais_pf_2').value = personaFisica.CODIGOPAISTEL2 ? personaFisica.CODIGOPAISTEL2 : '52';

					document.querySelector('#telefono_pf').value = personaFisica.TELEFONO ? personaFisica.TELEFONO : '';
					document.querySelector('#telefono_pf_2').value = personaFisica.TELEFONO2 ? personaFisica.TELEFONO2 : '';
					document.querySelector('#apodo_pf').value = personaFisica.APODO ? personaFisica.APODO : '';
					document.querySelector('#correo_pf').value = personaFisica.CORREO ? personaFisica.CORREO : '';
					document.querySelector('#edoorigen_pf').value = personaFisica.ESTADOORIGENID ? personaFisica.ESTADOORIGENID : '';
					if (personaFisica.ESTADOORIGENID) {
						let data = {
							'estado_id': personaFisica.ESTADOORIGENID
						};
						$.ajax({
							data: data,
							url: "<?= base_url('/data/get-municipios-by-estado') ?>",
							method: "POST",
							dataType: "json",
							success: function(response) {
								let municipios = response.data;
								municipios.forEach(municipio => {
									let option = document.createElement("option");
									option.text = municipio.MUNICIPIODESCR;
									option.value = municipio.MUNICIPIOID;
									document.querySelector('#munorigen_pf').add(option);
								});
								document.querySelector('#munorigen_pf').value = personaFisica.MUNICIPIOORIGENID ? personaFisica.MUNICIPIOORIGENID : '';
							},
							error: function(jqXHR, textStatus, errorThrown) {}
						});
					} else {
						document.querySelector('#munorigen_pf').value = '';
					}
					document.querySelector('#escolaridad_pf').value = personaFisica.ESCOLARIDADID ? personaFisica.ESCOLARIDADID : '';
					document.querySelector('#ocupacion_pf').value = personaFisica.OCUPACIONID ? personaFisica.OCUPACIONID : '';
					document.querySelector('#descripcionFisica_pf').value = personaFisica.DESCRIPCION_FISICA ? personaFisica.DESCRIPCION_FISICA : '';
					document.querySelector('#facebook_pf').value = personaFisica.FACEBOOK ? personaFisica.FACEBOOK : '';
					document.querySelector('#instagram_pf').value = personaFisica.INSTAGRAM ? personaFisica.INSTAGRAM : '';
					document.querySelector('#twitter_pf').value = personaFisica.TWITTER ? personaFisica.TWITTER : '';
					document.querySelector('#denunciante_pf').value = personaFisica.DENUNCIANTE ? personaFisica.DENUNCIANTE : '';
					//PERSONA FISICA END
					//MEDIAFILIACION
					if (mediaFiliacion) {

						document.querySelector('#estatura_mf').value = mediaFiliacion.ESTATURA;
						document.querySelector('#peso_mf').value = mediaFiliacion.PESO;

						document.querySelector('#complexion_mf').value = mediaFiliacion.FIGURAID ? mediaFiliacion.FIGURAID : '';

						document.querySelector('#colortez_mf').value = mediaFiliacion.PIELCOLORID ? mediaFiliacion.PIELCOLORID : '';
						document.querySelector('#senas_mf').value = mediaFiliacion.SENASPARTICULARES;
						// document.querySelector('#identidadD').value = mediaFiliacion.IDENTIDAD ? mediaFiliacion.IDENTIDAD:'';
						document.querySelector('#colorC_mf').value = mediaFiliacion.CABELLOCOLORID ? mediaFiliacion.CABELLOCOLORID : '';
						document.querySelector('#tamanoC_mf').value = mediaFiliacion.CABELLOTAMANOID ? mediaFiliacion.CABELLOTAMANOID : '';
						document.querySelector('#formaC_mf').value = mediaFiliacion.CABELLOESTILOID ? mediaFiliacion.CABELLOESTILOID : '';
						document.querySelector('#peculiarC_mf').value = mediaFiliacion.CABELLOPECULIARID ? mediaFiliacion.CABELLOPECULIARID : '';

						document.querySelector('#peculiarC_mf').value = mediaFiliacion.CABELLOPECULIARID ? mediaFiliacion.CABELLOPECULIARID : '';
						document.querySelector('#cabello_descr_mf').value = mediaFiliacion.CABELLODESCR ? mediaFiliacion.CABELLODESCR : '';
						document.querySelector('#colocacion_ojos_mf').value = mediaFiliacion.OJOCOLOCACIONID ? mediaFiliacion.OJOCOLOCACIONID : '';
						document.querySelector('#forma_ojos_mf').value = mediaFiliacion.OJOFORMAID ? mediaFiliacion.OJOFORMAID : '';
						document.querySelector('#tamano_ojos_mf').value = mediaFiliacion.OJOTAMANOID ? mediaFiliacion.OJOTAMANOID : '';
						document.querySelector('#colorO_mf').value = mediaFiliacion.OJOCOLORID ? mediaFiliacion.OJOCOLORID : '';

						document.querySelector('#peculiaridad_ojos_mf').value = mediaFiliacion.OJOPECULIARID ? mediaFiliacion.OJOPECULIARID : '';
						document.querySelector('#frente_altura_mf').value = mediaFiliacion.FRENTEALTURAID ? mediaFiliacion.FRENTEALTURAID : '';
						document.querySelector('#frente_anchura_ms').value = mediaFiliacion.FRENTEANCHURAID ? mediaFiliacion.FRENTEANCHURAID : '';
						document.querySelector('#tipoF_mf').value = mediaFiliacion.FRENTEFORMAID ? mediaFiliacion.FRENTEFORMAID : '';
						document.querySelector('#frente_peculiar_mf').value = mediaFiliacion.FRENTEPECULIARID ? mediaFiliacion.FRENTEPECULIARID : '';
						document.querySelector('#colocacion_ceja_mf').value = mediaFiliacion.CEJACOLOCACIONID ? mediaFiliacion.CEJACOLOCACIONID : '';
						document.querySelector('#ceja_mf').value = mediaFiliacion.CEJAFORMAID ? mediaFiliacion.CEJAFORMAID : '';

						document.querySelector('#tamano_ceja_mf').value = mediaFiliacion.CEJATAMANOID ? mediaFiliacion.CEJATAMANOID : '';
						document.querySelector('#grosor_ceja_mf').value = mediaFiliacion.CEJAGROSORID ? mediaFiliacion.CEJAGROSORID : '';
						document.querySelector('#nariz_tipo_mf').value = mediaFiliacion.CEJATAMANOID ? mediaFiliacion.CEJATAMANOID : '';
						document.querySelector('#nariz_tamano_mf').value = mediaFiliacion.NARIZTAMANOID ? mediaFiliacion.NARIZTAMANOID : '';
						document.querySelector('#nariz_base_mf').value = mediaFiliacion.NARIZBASEID ? mediaFiliacion.NARIZBASEID : '';
						document.querySelector('#nariz_peculiar_mf').value = mediaFiliacion.NARIZPECULIARID ? mediaFiliacion.NARIZPECULIARID : '';
						document.querySelector('#nariz_descr_mf').value = mediaFiliacion.NARIZDESCR ? mediaFiliacion.NARIZDESCR : '';
						document.querySelector('#bigote_forma_mf').value = mediaFiliacion.BIGOTEFORMAID ? mediaFiliacion.BIGOTEFORMAID : '';
						document.querySelector('#bigote_tamaño_mf').value = mediaFiliacion.BIGOTETAMANOID ? mediaFiliacion.BIGOTETAMANOID : '';
						document.querySelector('#bigote_grosor_mf').value = mediaFiliacion.BIGOTEGROSORID ? mediaFiliacion.BIGOTEGROSORID : '';
						document.querySelector('#bigote_peculiar_mf').value = mediaFiliacion.BIGOTEPECULIARID ? mediaFiliacion.BIGOTEPECULIARID : '';
						document.querySelector('#bigote_descr_mf').value = mediaFiliacion.BIGOTEDESCR ? mediaFiliacion.BIGOTEDESCR : '';
						document.querySelector('#boca_tamano_mf').value = mediaFiliacion.BOCATAMANOID ? mediaFiliacion.BOCATAMANOID : '';
						document.querySelector('#boca_peculiar_mf').value = mediaFiliacion.BOCAPECULIARID ? mediaFiliacion.BOCAPECULIARID : '';
						document.querySelector('#labio_grosor_mf').value = mediaFiliacion.LABIOGROSORID ? mediaFiliacion.LABIOGROSORID : '';
						document.querySelector('#labio_longitud_mf').value = mediaFiliacion.LABIOLONGITUDID ? mediaFiliacion.LABIOLONGITUDID : '';
						document.querySelector('#labio_posicion_mf').value = mediaFiliacion.LABIOPOSICIONID ? mediaFiliacion.LABIOPOSICIONID : '';
						document.querySelector('#labio_peculiar_mf').value = mediaFiliacion.LABIOPECULIARID ? mediaFiliacion.LABIOPECULIARID : '';
						document.querySelector('#dientes_tamano_mf').value = mediaFiliacion.DIENTETAMANOID ? mediaFiliacion.DIENTETAMANOID : '';
						document.querySelector('#dientes_tipo_mf').value = mediaFiliacion.DIENTETIPOID ? mediaFiliacion.DIENTETIPOID : '';
						document.querySelector('#dientes_peculiar_mf').value = mediaFiliacion.DIENTEPECULIARID ? mediaFiliacion.DIENTEPECULIARID : '';
						document.querySelector('#dientes_descr_mf').value = mediaFiliacion.DIENTEDESCR ? mediaFiliacion.DIENTEDESCR : '';
						document.querySelector('#barbilla_forma_mf').value = mediaFiliacion.BARBILLAFORMAID ? mediaFiliacion.BARBILLAFORMAID : '';
						document.querySelector('#barbilla_tamano_mf').value = mediaFiliacion.BARBILLATAMANOID ? mediaFiliacion.BARBILLATAMANOID : '';
						document.querySelector('#barbilla_inclinacion_mf').value = mediaFiliacion.BARBILLAINCLINACIONID ? mediaFiliacion.BARBILLAINCLINACIONID : '';
						document.querySelector('#barbilla_peculiar_mf').value = mediaFiliacion.BARBILLAPECULIARID ? mediaFiliacion.BARBILLAPECULIARID : '';
						document.querySelector('#barbilla_descr_mf').value = mediaFiliacion.BARBILLADESCR ? mediaFiliacion.BARBILLADESCR : '';
						document.querySelector('#barba_tamano_mf').value = mediaFiliacion.BARBATAMANOID ? mediaFiliacion.BARBATAMANOID : '';
						document.querySelector('#barba_peculiar_mf').value = mediaFiliacion.BARBAPECULIARID ? mediaFiliacion.BARBAPECULIARID : '';
						document.querySelector('#barba_descr_mf').value = mediaFiliacion.BARBADESCR ? mediaFiliacion.BARBADESCR : '';
						document.querySelector('#cuello_tamano_mf').value = mediaFiliacion.CUELLOTAMANOID ? mediaFiliacion.CUELLOTAMANOID : '';
						document.querySelector('#cuello_grosor_mf').value = mediaFiliacion.CUELLOGROSORID ? mediaFiliacion.CUELLOGROSORID : '';
						document.querySelector('#cuello_peculiar_mf').value = mediaFiliacion.CUELLOPECULIARID ? mediaFiliacion.CUELLOPECULIARID : '';
						document.querySelector('#cuello_descr_mf').value = mediaFiliacion.CUELLODESCR ? mediaFiliacion.CUELLODESCR : '';
						document.querySelector('#hombro_posicion_mf').value = mediaFiliacion.HOMBROPOSICIONID ? mediaFiliacion.HOMBROPOSICIONID : '';
						document.querySelector('#hombro_tamano_mf').value = mediaFiliacion.HOMBROTAMANOID ? mediaFiliacion.HOMBROTAMANOID : '';
						document.querySelector('#hombro_grosor_mf').value = mediaFiliacion.HOMBROGROSORID ? mediaFiliacion.HOMBROGROSORID : '';
						document.querySelector('#estomago_mf').value = mediaFiliacion.ESTOMAGOID ? mediaFiliacion.ESTOMAGOID : '';
						document.querySelector('#estomago_descr_mf').value = mediaFiliacion.ESTOMAGOID ? mediaFiliacion.ESTOMAGOID : '';



						document.querySelector('#discapacidad_mf').value = mediaFiliacion.DISCAPACIDADDESCR;
						// document.querySelector('#origen_mf').value = mediaFiliacion.ORIGEN;

						document.querySelector('#diaDesaparicion').value = mediaFiliacion.FECHADESAPARICION ? mediaFiliacion.FECHADESAPARICION : '';

						document.querySelector('#lugarDesaparicion').value = mediaFiliacion.LUGARDESAPARICION;
						document.querySelector('#vestimenta_mf').value = mediaFiliacion.VESTIMENTADESCR;

						document.querySelector('#autorizaFoto').value = folio.LOCALIZACIONPERSONAMEDIOS == 'S' ? 'S' : 'N';
						document.querySelector('#escolaridad_mf').value = mediaFiliacion.ESCOLARIDADID ? mediaFiliacion.ESCOLARIDADID : '';
						document.querySelector('#ocupacion_mf').value = mediaFiliacion.OCUPACIONID ? mediaFiliacion.OCUPACIONID : '';

						document.querySelector('#contextura_ceja_mf').value = mediaFiliacion.CONTEXTURAID ? mediaFiliacion.CONTEXTURAID : '';
						document.querySelector('#cara_forma_mf').value = mediaFiliacion.CARAFORMAID ? mediaFiliacion.CARAFORMAID : '';
						document.querySelector('#cara_tamano_mf').value = mediaFiliacion.CARATAMANOID ? mediaFiliacion.CARATAMANOID : '';
						document.querySelector('#caratez_mf').value = mediaFiliacion.CARATEZID ? mediaFiliacion.CARATEZID : '';
						document.querySelector('#lobulo_mf').value = mediaFiliacion.OREJALOBULOID ? mediaFiliacion.OREJALOBULOID : '';
						document.querySelector('#forma_oreja_mf').value = mediaFiliacion.OREJAFORMAID ? mediaFiliacion.OREJAFORMAID : '';
						document.querySelector('#tamano_oreja_mf').value = mediaFiliacion.OREJATAMANOID ? mediaFiliacion.OREJATAMANOID : '';

						document.querySelector('#hombro_tamano_mf').value = mediaFiliacion.HOMBROLONGITUDID ? mediaFiliacion.HOMBROLONGITUDID : '';



						document.querySelector('#escolaridad_mf').value = mediaFiliacion.PERSONAESCOLARIDADID ? mediaFiliacion.PERSONAESCOLARIDADID : '';

					}
					//PARENTESCO

					// if (relacion_parentesco) {
					// 	document.querySelector('#parentesco_mf').value = parentesco.PERSONAPARENTESCOID ? parentesco.PERSONAPARENTESCOID : '';
					// 	document.querySelector('#personaFisica1').value = relacion_parentesco.PERSONAFISICAID1 ? relacion_parentesco.PERSONAFISICAID1 : '';
					// 	document.querySelector('#personaFisica2').value = idPersonaFisica ? idPersonaFisica : '';
					// 	document.getElementById("updateParentesco").style.display="block";
					// 	document.getElementById("insertParentesco").style.display="none";


					// } 
					// if(relacion_parentesco == null) {
					// 	document.querySelector('#parentesco_mf').value = '';
					// 	document.querySelector('#personaFisica1').value = '';
					// 	document.querySelector('#personaFisica2').value = idPersonaFisica ? idPersonaFisica : '';
					// 	document.getElementById("insertParentesco").style.display="block";
					// 	document.getElementById("updateParentesco").style.display="none";

					// }
					
					//DOMICILIO
					let domicilio = response.personaFisicaDomicilio;

					document.querySelector('#pfd_id').value = domicilio.DOMICILIOID;

					document.querySelector('#pais_pfd').value = domicilio.PAIS ? domicilio.PAIS : '';
					document.querySelector('#estado_pfd').value = domicilio.ESTADOID ? domicilio.ESTADOID : '';
					if (domicilio.ESTADOID && domicilio.MUNICIPIOID) {
						let data = {
							'estado_id': domicilio.ESTADOID
						};
						$.ajax({
							data: data,
							url: "<?= base_url('/data/get-municipios-by-estado') ?>",
							method: "POST",
							dataType: "json",
							success: function(response) {
								let municipios = response.data;
								municipios.forEach(municipio => {
									let option = document.createElement("option");
									option.text = municipio.MUNICIPIODESCR;
									option.value = municipio.MUNICIPIOID;
									document.querySelector('#municipio_pfd').add(option);
								});
								document.querySelector('#municipio_pfd').value = domicilio.MUNICIPIOID ? domicilio.MUNICIPIOID : '';
							},
							error: function(jqXHR, textStatus, errorThrown) {}
						});
					} else {
						document.querySelector('#municipio_pfd').value = '';
					}

					if (domicilio.ESTADOID && domicilio.MUNICIPIOID && domicilio.LOCALIDADID) {
						let data = {
							'estado_id': domicilio.ESTADOID,
							'municipio_id': domicilio.MUNICIPIOID
						};

						$.ajax({
							data: data,
							url: "<?= base_url('/data/get-localidades-by-municipio') ?>",
							method: "POST",
							dataType: "json",
							success: function(response) {
								let localidades = response.data;
								let select_localidad = document.querySelector('#localidad_pfd');

								localidades.forEach(localidad => {
									var option = document.createElement("option");
									option.text = localidad.LOCALIDADDESCR;
									option.value = localidad.LOCALIDADID;
									select_localidad.add(option);
								});

								select_localidad.value = domicilio.LOCALIDADID;
							},
							error: function(jqXHR, textStatus, errorThrown) {}
						});
					} else {
						document.querySelector('#localidad_pfd').value = '';
					}

					if (domicilio.ESTADOID && domicilio.MUNICIPIOID && domicilio.LOCALIDADID && domicilio.COLONIAID) {
						document.querySelector('#colonia_pfd').classList.add('d-none');
						document.querySelector('#colonia_pfd_select').classList.remove('d-none');
						let data = {
							'estado_id': domicilio.ESTADOID,
							'municipio_id': domicilio.MUNICIPIOID,
							'localidad_id': domicilio.LOCALIDADID
						};
						$.ajax({
							data: data,
							url: "<?= base_url('/data/get-colonias-by-estado-municipio-localidad') ?>",
							method: "POST",
							dataType: "json",
							success: function(response) {
								let select_colonia = document.querySelector('#colonia_pfd_select');
								let input_colonia = document.querySelector('#colonia_pfd');
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

								select_colonia.value = domicilio.COLONIAID;
								input_colonia.value = '-';
							},
							error: function(jqXHR, textStatus, errorThrown) {}
						});
					} else {
						document.querySelector('#colonia_pfd').classList.remove('d-none');
						document.querySelector('#colonia_pfd_select').classList.add('d-none');
						var option = document.createElement("option");
						option.text = 'OTRO';
						option.value = '0';
						document.querySelector('#colonia_pfd_select').add(option);
						document.querySelector('#colonia_pfd_select').value = '0';
						document.querySelector('#colonia_pfd').value = domicilio.COLONIADESCR ? domicilio.COLONIADESCR : '';
					}
					document.querySelector('#cp_pfd').value = domicilio.CP ? domicilio.CP : '';
					document.querySelector('#calle_pfd').value = domicilio.CALLE ? domicilio.CALLE : '';
					document.querySelector('#exterior_pfd').value = domicilio.NUMEROCASA ? domicilio.NUMEROCASA : '';
					document.querySelector('#interior_pfd').value = domicilio.NUMEROINTERIOR ? domicilio.NUMEROINTERIOR : '';
					document.querySelector('#referencia_pfd').value = domicilio.REFERENCIA ? domicilio.REFERENCIA : '';
					// document.querySelector('#zona_pfd').value = domicilio.ZONA ? domicilio.ZONA : '';

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
		let tabs = document.querySelectorAll('#persona_tabs .nav-item');
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
<?php include('modals/objetos_involucrados_modal.php') ?>

<?php $this->endSection() ?>