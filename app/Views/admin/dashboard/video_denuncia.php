<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php $session = session(); ?>
<div class="row" id="videoDen">
	<div id="card1" class="col-12 col-sm-6 col-md-4 col-lg-3">
		<div class="card rounded bg-white shadow" style="height: 190px;">
			<div class="card-body p-4">
				<div class="row">
					<div class="col-12 mb-1">
						<select class="form-control" id="year_select" name="year_select">
							<?php for ($i = date('Y'); $i >= 2020; $i--) { ?>
								<option <?= $i == date('Y') ? 'selected' : null ?> value="<?= $i ?>"><?= $i ?></option>
							<?php } ?>
						</select>
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
	<div id="card2" class="col-12 col-sm-6 col-md-4 col-lg-3 d-none">
		<div class="card rounded bg-white shadow" style="min-height: 190px;">
			<div class="card-body">
				<label class="font-weight-bold">Delito:</label>
				<input class="form-control" type="text" id="delito_dash">
				<label class="font-weight-bold">Descripción:</label>
				<textarea class="form-control" id="delito_descr_dash"></textarea>
			</div>
		</div>
	</div>
	<div id="card3" class="col-12 col-sm-6 col-md-4 col-lg-3 d-none">
		<div class="card rounded bg-white shadow" style="height: 190px;">
			<div class="card-body">
				<button id="info-folio-btn" class="btn btn-primary btn-block h-100" role="button" data-toggle="modal" data-target="#info_folio_modal"><i class="fas fa-file-alt"></i> INFORMACIÓN DEL CASO</button>
			</div>
		</div>
	</div>
	<div id="card4" class="col-12 col-sm-6 col-md-4 col-lg-3 d-none">
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
	<div id="card5" class="col-12 col-sm-6 col-md-4 col-lg-3 d-none">
		<div class="card rounded bg-white shadow">
			<div class="card-body">
				<div class="row">
					<div class="col-12 text-center mb-3">
						<h5 class="font-weight-bold m-0">HORA</h5>
						<div id="clock"></div>
					</div>
					<div class="col-12 text-center">
						<h5 class="font-weight-bold m-0">FECHA</h5>
						<div id="date"></div>
					</div>
				</div>
			</div>
		</div>
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
				<textarea class="form-control" id="notas_mp" placeholder="Descripción del caso..." rows="10" required maxlength="300" oninput="mayuscTextarea(this)" onkeydown="pulsar(event)"></textarea>
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

	function startTime() {
		var today = new Date();
		var hr = today.getHours();
		var min = today.getMinutes();
		var sec = today.getSeconds();
		ap = "hrs.";
		hr = hr;
		// hr = (hr > 12) ? hr - 12 : hr;
		//Add a zero in front of numbers<10
		hr = checkTime(hr);
		min = checkTime(min);
		sec = checkTime(sec);
		document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec + " " + ap;

		var months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
		var days = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
		var curWeekDay = days[today.getDay()];
		var curDay = today.getDate();
		var curMonth = months[today.getMonth()];
		var curYear = today.getFullYear();
		var date = curWeekDay + ", " + curDay + " " + curMonth + " " + curYear;
		document.getElementById("date").innerHTML = date;

		var time = setTimeout(function() {
			startTime()
		}, 500);
	}

	function checkTime(i) {
		if (i < 10) {
			i = "0" + i;
		}
		return i;
	}

	function pulsar(e) {
		if (e.which === 13 && !e.shiftKey) {
			e.preventDefault();
			return false;
		}
	}

	function llenarTablaPersonas(personas) {
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
	}

	function view_form_parentesco($personafisica) {
		$.ajax({
			data: {
				'personafisica1': $personafisica,
				'folio': inputFolio.value,
				'year': year_select.value,
			},
			url: "<?= base_url('/data/get-parentesco-by-id') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				let parentesco = response.parentesco;
				let relacion_parentesco = response.parentescoRelacion;
				let idPersonaFisica = response.idPersonaFisica;
				// 	if (relacion_parentesco) {
				document.querySelector('#parentesco_mf').value = parentesco.PERSONAPARENTESCOID ? parentesco.PERSONAPARENTESCOID : '';
				document.querySelector('#personaFisica1').value = relacion_parentesco.PERSONAFISICAID1 ? relacion_parentesco.PERSONAFISICAID1 : '';
				document.querySelector('#personaFisica2').value = relacion_parentesco.PERSONAFISICAID2 ? relacion_parentesco.PERSONAFISICAID2 : '';
				document.getElementById("updateParentesco").style.display = "block";


				// } 
				// if(relacion_parentesco == null) {
				// 	document.querySelector('#parentesco_mf').value = '';
				// 	document.querySelector('#personaFisica1').value = '';
				// 	document.querySelector('#personaFisica2').value = idPersonaFisica ? idPersonaFisica : '';
				// 	document.getElementById("insertParentesco").style.display="block";
				// 	document.getElementById("updateParentesco").style.display="none";

				// }
				$('#relacion_parentesco_modal').modal('show');
			},
			error: function(jqXHR, textStatus, errorThrown) {}
		});
	}

	function llenarTablaParentesco(relacion_parentesco, personaiduno, personaidDos, parentesco) {


		for (let i = 0; i < relacion_parentesco.length; i++) {

			var btn = `<button type='button'  class='btn btn-primary' onclick='view_form_parentesco(${relacion_parentesco[i].PERSONAFISICAID1})'><i class="fas fa-pen"></i></button>`


			var fila2 =
				`<tr id="row${i}">` +
				`<td class="text-center">${personaiduno[i].NOMBRE}</td>` +
				`<td class="text-center">${parentesco[i].PERSONAPARENTESCODESCR}</td>` +
				`<td class="text-center">${personaidDos[i].NOMBRE}</td>` +
				`<td class="text-center">${btn}</td>` +
				`</tr>`;

			$('#table-parentesco tr:first').after(fila2);
			$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
			var nFilas = $("#parentesco tr").length;
			$("#adicionados").append(nFilas - 1);

		}
	}

	function llenarTablaFisFis(relacionFisFis) {
		for (let i = 0; i < relacionFisFis.length; i++) {
			var btn = `<button type='button'  class='btn btn-primary' onclick='eliminarArbolDelictivo(${relacionFisFis[i].PERSONAFISICAIDVICTIMA},${relacionFisFis[i].PERSONAFISICAIDIMPUTADO},${relacionFisFis[i].DELITOMODALIDADID})'><i class='fa fa-trash'></i></button>`

			var fila =
				`<tr id="row${i}">` +
				`<td class="text-center">${relacionFisFis[i].NOMBREI}</td>` +
				`<td class="text-center">${relacionFisFis[i].DELITOMODALIDADDESCR}</td>` +
				`<td class="text-center">${relacionFisFis[i].NOMBREV}</td>` +
				`<td class="text-center">${btn}</td>` +
				`</tr>`;

			$('#table-delitos tr:first').after(fila);
			$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
			var nFilas = $("#delitos tr").length;
			$("#adicionados").append(nFilas - 1);
		}
	}

	function eliminarImputadoDelito(personafisica, delitoModalidadId) {
		$.ajax({
			data: {
				'personafisica': personafisica,
				'delito': delitoModalidadId,
				'folio': inputFolio.value,
				'year': year_select.value,

			},
			url: "<?= base_url('/data/delete-fisimpdelito-by-folio') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				let tabla_impdelito = document.querySelectorAll('#table-delito-cometidos tr');
				tabla_impdelito.forEach(row => {
					if (row.id !== '') {
						row.remove();
					}
				});
				let fisicaImpDelito = response.fisicaImpDelito;
				llenarTablaImpDel(fisicaImpDelito);
				if (response.status == 1) {
					Swal.fire({
						icon: 'success',
						text: 'Delito del imputado eliminado correctamente',
						confirmButtonColor: '#bf9b55',
					});
				} else {
					Swal.fire({
						icon: 'error',
						text: 'No se elimino el delito del imputado',
						confirmButtonColor: '#bf9b55',
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {}
		});

	}

	function eliminarArbolDelictivo(personafisicavictima, personafisicaimputado, delitoModalidadId) {
		$.ajax({
			data: {
				'personafisicavictima': personafisicavictima,
				'personafisicaimputado': personafisicaimputado,
				'delito': delitoModalidadId,
				'folio': inputFolio.value,
				'year': year_select.value,

			},
			url: "<?= base_url('/data/delete-arbol_delictivo-by-folio') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				let tabla_arbol = document.querySelectorAll('#table-delitos tr');
				tabla_arbol.forEach(row => {
					if (row.id !== '') {
						row.remove();
					}
				});
				let relacionFisFis = response.relacionFisFis;
				llenarTablaFisFis(relacionFisFis);

				if (response.status == 1) {
					Swal.fire({
						icon: 'success',
						text: 'Árbol delictivo eliminado correctamente',
						confirmButtonColor: '#bf9b55',
					});
				} else {
					Swal.fire({
						icon: 'error',
						text: 'No se elimino el árbol delictivo',
						confirmButtonColor: '#bf9b55',
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus);
			}
		});

	}

	function llenarTablaImpDel(impDelito) {
		for (let i = 0; i < impDelito.length; i++) {
			var btn = `<button type='button'  class='btn btn-primary' onclick='eliminarImputadoDelito(${impDelito[i].PERSONAFISICAID},${impDelito[i].DELITOMODALIDADID})'><i class='fa fa-trash'></i></button>`

			var fila =
				`<tr id="row${i}">` +
				`<td class="text-center" value="${impDelito[i].PERSONAFISICAID}">${impDelito[i].NOMBRE}</td>` +
				`<td class="text-center" value="${impDelito[i].DELITOMODALIDADID}">${impDelito[i].DELITOMODALIDADDESCR}</td>` +
				`<td class="text-center">${btn}</td>` +
				`</tr>`;

			$('#table-delito-cometidos tr:first').after(fila);
			$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
			var nFilas = $("#delito-cometidos tr").length;
			$("#adicionados").append(nFilas - 1);
		}
	}

	function llenarTablaVehiculos(vehiculos) {
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
	}

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
				respuesta = response;
				document.getElementById("form_parentesco_insert").reset();

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
					//SELECT CON DELITOS DEL IMPUTADO
					$('#delito_cometido').empty();
					let select_delitos_imputado = document.querySelector("#delito_cometido")
					delitosModalidadFiltro.forEach(modalidad => {
						const option = document.createElement('option');
						option.value = modalidad.DELITOMODALIDADID;
						option.text = modalidad.DELITOMODALIDADDESCR;
						select_delitos_imputado.add(option, null);

					});

					$('#victima_ofendido').empty();
					let select_victima_ofendido = document.querySelector("#victima_ofendido")
					victimas.forEach(victima => {
						const option = document.createElement('option');
						option.value = victima.PERSONAFISICAID;
						option.text = victima.NOMBRE + ' ' + victima.PRIMERAPELLIDO;
						select_victima_ofendido.add(option, null);

					});

					$('#imputado_delito_cometido').empty();

					let select_imputado_delito_cometido = document.querySelector("#imputado_delito_cometido")

					imputados.forEach(imputado => {
						const option = document.createElement('option');
						option.value = imputado.PERSONAFISICAID;
						option.text = imputado.NOMBRE + ' ' + imputado.PRIMERAPELLIDO;
						select_imputado_delito_cometido.add(option, null);

					});
					$('#imputado_arbol').empty();

					let select_imputado_mputado = document.querySelector("#imputado_arbol")
					imputados.forEach(imputado => {
						const option = document.createElement('option');
						option.value = imputado.PERSONAFISICAID;
						option.text = imputado.NOMBRE + ' ' + imputado.PRIMERAPELLIDO;
						select_imputado_mputado.add(option, null);

					});
					$('#personaFisica1_I').empty();

					let select_personaFisica1_I = document.querySelector("#personaFisica1_I")
					personas.forEach(persona => {
						const option = document.createElement('option');
						option.value = persona.PERSONAFISICAID;
						option.text = persona.NOMBRE + ' ' + persona.PRIMERAPELLIDO;
						select_personaFisica1_I.add(option, null);

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
					llenarTablaPersonas(personas);

					//VEHICULOS
					llenarTablaVehiculos(vehiculos);

					//PARENTESCO
					llenarTablaParentesco(relacion_parentesco, personaiduno, personaidDos, parentesco);

					//ARBOL DELICTUAL
					llenarTablaFisFis(relacionFisFis);

					//DELITOS COMETIDOS
					llenarTablaImpDel(fisicaImpDelito);


				} else if (response.status === 2) {
					Swal.fire({
						icon: 'error',
						html: 'El folio se encuentra en atención.',
						confirmButtonColor: '#bf9b55',
					});
				} else if (response.status === 3) {
					card2.classList.add('d-none');
					card3.classList.add('d-none');
					card4.classList.add('d-none');
					card5.classList.add('d-none');
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
		tabla_parentesco = document.querySelectorAll('#table-personas tr');
		tabla_relacion_fis_fis = document.querySelectorAll('#table-delitos tr');

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

		//RESET FORM
		document.getElementById("form_asignar_arbol_delictual_insert").reset();
		document.getElementById("form_parentesco_insert").reset();


		$('#v-pills-vehiculos-tab').css('display', 'NONE');
	}

	buscar_nuevo_btn.addEventListener('click', () => {
		data = {
			'folio': inputFolio.value,
			'year': year_select.value,
		}
		$.ajax({
			data: data,
			url: "<?= base_url('/data/restore-folio') ?>",
			method: "POST",
			dataType: "json",

		}).done(function(data) {}).fail(function(jqXHR, textStatus) {
			Swal.fire({
				icon: 'error',
				text: 'El folio quedó en proceso, comunicate con soporte técnico para devolver el estado a abierto.',
				confirmButtonColor: '#bf9b55',
			});
		});
		borrarTodo();
	});

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
					personaFisica.CODIGOPAISTEL ? iti.setNumber('+' + personaFisica.CODIGOPAISTEL) : iti.setNumber('+52');
					personaFisica.CODIGOPAISTEL2 ? iti2.setNumber('+' + personaFisica.CODIGOPAISTEL2) : iti2.setNumber('+52');
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
					document.querySelector('#zona_pfd').value = domicilio.ZONA ? domicilio.ZONA : '';

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
						document.querySelector('#tipo_vehiculo').value = tipov.VEHICULOTIPOID;
					}
					document.querySelector('#color_vehiculo').value = color ? color.VEHICULOCOLORID : '';
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

	function clearInputPhone(e) {
		e.target.value = e.target.value.replace(/-/g, "");
		if (e.target.value.length > e.target.maxLength) {
			e.target.value = e.target.value.slice(0, e.target.maxLength);
		};
	}

	function mayuscTextarea(e) {
		e.value = e.value.toUpperCase();
	}

	//DELITO FORM ******************************************************************

	var iti
	var iti2

	window.onload = function() {
		startTime();

		(function() {
			'use strict'
			var form_delito = document.querySelector('#denuncia_form');
			var form_preguntas = document.querySelector('#preguntas_form');
			var form_persona_fisica = document.querySelector('#persona_fisica_form');
			var form_persona_fisica_domicilio = document.querySelector('#persona_fisica_domicilio_form');
			var form_media_filiacion = document.querySelector('#form_media_filiacion');
			var form_media_filiacion_insert = document.querySelector('#form_media_filiacion_insert');

			var form_vehiculo = document.querySelector('#form_vehiculo');
			var form_parentesco = document.querySelector('#form_parentesco');
			var form_parentesco_insert = document.querySelector('#form_parentesco_insert');
			var form_relacion_ido_insert = document.querySelector('#form_asignar_arbol_delictual_insert');
			var form_fisimpdelito = document.querySelector('#form_delitos_cometidos_insert');

			var selectPersonaFisica1 = document.querySelector('#personaFisica1_I');
			var form_persona_fisica_insert = document.querySelector('#persona_fisica_form_insert');


			var btn_insertar_parentesco = document.querySelector('#insertParentescoModal');
			var btn_insertar_persona_fisica = document.querySelector('#insertPersonaFisicaModal');
			var btn_asignar_delitos = document.querySelector('#insertArbolDelictual');
			var btn_delito_imputado = document.querySelector('#insertDelitoImputado');
			var btn_delito_cometido = document.querySelector('#insertDelitoCometido');


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

			form_delito.addEventListener('submit', (event) => {
				if (!form_delito.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
					form_preguntas.classList.add('was-validated')
				} else {
					event.preventDefault();
					event.stopPropagation();
					form_delito.classList.remove('was-validated')
					actualizarDenuncia();
				}
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

			form_persona_fisica.addEventListener('submit', (event) => {
				if (!form_persona_fisica.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
					form_persona_fisica.classList.add('was-validated')
				} else {
					event.preventDefault();
					event.stopPropagation();
					form_persona_fisica.classList.remove('was-validated')
					actualizarPersona();
				}
			}, false);

			form_persona_fisica_domicilio.addEventListener('submit', (event) => {
				if (!form_persona_fisica_domicilio.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
					form_persona_fisica_domicilio.classList.add('was-validated')
				} else {
					event.preventDefault();
					event.stopPropagation();
					form_persona_fisica_domicilio.classList.remove('was-validated')
					actualizarDomicilio();
				}
			}, false);

			form_media_filiacion.addEventListener('submit', (event) => {
				if (!form_media_filiacion.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
					form_media_filiacion.classList.add('was-validated')
				} else {
					event.preventDefault();
					event.stopPropagation();
					form_media_filiacion.classList.remove('was-validated')
					let id_personafisica = document.querySelector('#pf_id').value;

					actualizarPersonaMediaAfiliacion(id_personafisica);

					// console.log('Item:', ultimoid);
					// alert(ultimoid);
				}
			}, false);



			form_vehiculo.addEventListener('submit', (event) => {
				if (!form_vehiculo.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
					form_vehiculo.classList.add('was-validated')
				} else {
					event.preventDefault();
					event.stopPropagation();
					form_vehiculo.classList.remove('was-validated')
					actualizarVehiculo();
				}
			}, false);
			form_parentesco.addEventListener('submit', (event) => {
				if (!form_parentesco.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
					form_parentesco.classList.add('was-validated')
				} else {
					event.preventDefault();
					event.stopPropagation();
					form_parentesco.classList.remove('was-validated')
					actualizarParentesco();
				}
			}, false);
			btn_insertar_parentesco.addEventListener('click', (event) => {
				$('#relacion_parentesco_modal_insert').modal('show');
			}, false);
			btn_insertar_persona_fisica.addEventListener('click', (event) => {
				$('#insert_persona_fisica_modal').modal('show');
			}, false);
			btn_asignar_delitos.addEventListener('click', (event) => {
				$('#insert_asignar_arbol_delictual_modal').modal('show');
			}, false);
			btn_delito_imputado.addEventListener('click', (event) => {
				$('#insert_asignar_delitos_cometidos_modal').modal('show');
			}, false);


			form_parentesco_insert.addEventListener('submit', (event) => {
				if (!form_parentesco_insert.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
					form_parentesco_insert.classList.add('was-validated')
				} else {
					event.preventDefault();
					event.stopPropagation();
					form_parentesco_insert.classList.remove('was-validated')
					insertarParentesco();
				}
			}, false);
			form_persona_fisica_insert.addEventListener('submit', (event) => {
				if (!form_persona_fisica_insert.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
					form_persona_fisica_insert.classList.add('was-validated')
				} else {
					event.preventDefault();
					event.stopPropagation();
					form_persona_fisica_insert.classList.remove('was-validated')
					insertarPersonaFisica();
				}
			}, false);
			selectPersonaFisica1.addEventListener("change", function() {
				let personaFisica2_I = document.querySelector("#personaFisica2_I")

				var datos = {
					"id": selectPersonaFisica1.value,
					'folio': document.querySelector('#input_folio_atencion').value,
					'year': document.querySelector('#year_select').value,
				}

				$.ajax({
					method: 'POST',
					url: "<?= base_url('/data/get-personafisicofiltro') ?>",
					data: datos,
					dataType: 'JSON',
					//data: {nombre:n},
					success: function(response) {
						const personaFisicaFiltro = response.personaFiltro;

						if (response.status == 1) {
							$('#personaFisica2_I').empty();

							personaFisicaFiltro.forEach(element => {
								let primer_apellido = element.PRIMERAPELLIDO ? element.PRIMERAPELLIDO : '';
								const option = document.createElement('option');
								option.value = element.PERSONAFISICAID;
								option.text = element.NOMBRE + ' ' + primer_apellido;
								personaFisica2_I.add(option, null);
							});
						}
					},
				});
			});

			form_relacion_ido_insert.addEventListener('submit', (event) => {
				if (!form_relacion_ido_insert.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
					form_relacion_ido_insert.classList.add('was-validated')
				} else {
					event.preventDefault();
					event.stopPropagation();
					form_relacion_ido_insert.classList.remove('was-validated')
					insertarRelacionIDO();
				}
			}, false);
			form_fisimpdelito.addEventListener('submit', (event) => {
				if (!form_fisimpdelito.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
					form_fisimpdelito.classList.add('was-validated')
				} else {
					event.preventDefault();
					event.stopPropagation();
					form_fisimpdelito.classList.remove('was-validated')
					insertar_impdelito();
				}
			}, false);


			//DENUNCIA

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
						if (response.status == 1) {
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
			//DENUNCIA END

			//PREGUNTAS
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
						if (response.status == 1) {
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

			//PERSONA FISICA

			document.querySelector('#edoorigen_pf').addEventListener('change', (e) => {
				let select_municipio = document.querySelector('#munorigen_pf');
				clearSelect(select_municipio);
				select_municipio.value = '';
				let data = {
					'estado_id': e.target.value,
				}

				$.ajax({
					data: data,
					url: "<?= base_url('/data/get-municipios-by-estado') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						let municipios = response.data;

						municipios.forEach(municipio => {
							var option = document.createElement("option");
							option.text = municipio.MUNICIPIODESCR;
							option.value = municipio.MUNICIPIOID;
							select_municipio.add(option);
						});
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			});

			//INTL TEL INPUT START
			let input_phone = document.querySelector("#telefono_pf");
			let input2_phone = document.querySelector("#telefono_pf_2");
			let inputPais_phone = document.querySelector("#codigo_pais_pf");
			let inputPais2_phone = document.querySelector("#codigo_pais_pf_2");

			iti = window.intlTelInput(input_phone, {
				separateDialCode: true,
				// initialCountry: "MX",
			});
			iti2 = window.intlTelInput(input2_phone, {
				separateDialCode: true,
				// initialCountry: "MX",
			});

			const getData = () => {
				inputPais_phone.value = parseInt(iti.getSelectedCountryData().dialCode);
				inputPais2_phone.value = parseInt(iti2.getSelectedCountryData().dialCode);
			};

			input_phone.addEventListener('change', getData);
			input_phone.addEventListener('keyup', getData);
			input_phone.addEventListener('blur', getData);

			input2_phone.addEventListener('change', getData);
			input2_phone.addEventListener('keyup', getData);
			input2_phone.addEventListener('blur', getData);

			let input_pf = document.querySelector("#telefono_new");
			let input2_pf = document.querySelector("#telefono_new2");
			let inputPais_pf = document.querySelector("#codigo_pais_new");
			let inputPais2_pf = document.querySelector("#codigo_pais_2_new");

			let iti_pf = window.intlTelInput(input_pf, {
				separateDialCode: true,
				initialCountry: "MX",
			});
			let iti2_pf = window.intlTelInput(input2_pf, {
				separateDialCode: true,
				initialCountry: "MX",
			});

			const getData_PF = () => {
				inputPais_pf.value = parseInt(iti_pf.getSelectedCountryData().dialCode);
				inputPais2_pf.value = parseInt(iti2_pf.getSelectedCountryData().dialCode);
			};

			input_pf.addEventListener('change', getData_PF);
			input_pf.addEventListener('keyup', getData_PF);
			input_pf.addEventListener('blur', getData_PF);

			input2_pf.addEventListener('change', getData_PF);
			input2_pf.addEventListener('keyup', getData_PF);
			input2_pf.addEventListener('blur', getData_PF);

			//INTL TEL INPUT END

			//CREAR PERSONA FISICA
			document.querySelector('#fecha_nacimiento_new').addEventListener('change', (e) => {
				let fecha = e.target.value;
				let hoy = new Date();
				let cumpleanos = new Date(fecha);
				let edad = hoy.getFullYear() - cumpleanos.getFullYear();
				let m = hoy.getMonth() - cumpleanos.getMonth();

				if (m < 0 || (m === 0 && hoy.getDate() <= cumpleanos.getDate())) {
					edad--;
				}
				document.querySelector('#edad_new').value = edad;
			})

			document.querySelector('#nacionalidad_new').addEventListener('change', (e) => {
				let select_estado = document.querySelector('#estado_select_origen_new');
				let select_municipio = document.querySelector('#municipio_select_origen_new');

				clearSelect(select_municipio);

				if (e.target.value !== '82') {
					select_estado.value = '33';
					let data = {
						'estado_id': 33,
						'municipio_id': 1,
					}
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
								select_municipio.add(option);
							});
							select_municipio.value = '1';
						},
						error: function(jqXHR, textStatus, errorThrown) {}
					});

				} else {
					clearSelect(select_municipio);
					select_estado.value = '';
					select_municipio.value = '';
				}
			});

			document.querySelector('#estado_select_origen_new').addEventListener('change', (e) => {
				let select_municipio = document.querySelector('#municipio_select_origen_new');

				clearSelect(select_municipio);

				select_municipio.value = '';

				let data = {
					'estado_id': e.target.value,
				}

				$.ajax({
					data: data,
					url: "<?= base_url('/data/get-municipios-by-estado') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						let municipios = response.data;

						municipios.forEach(municipio => {
							var option = document.createElement("option");
							option.text = municipio.MUNICIPIODESCR;
							option.value = municipio.MUNICIPIOID;
							select_municipio.add(option);
						});
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			});

			document.querySelector('#pais_select_new').addEventListener('change', (e) => {

				let select_estado = document.querySelector('#estado_select_new');
				let select_municipio = document.querySelector('#municipio_select_new');
				let select_localidad = document.querySelector('#localidad_select_new');
				let select_colonia = document.querySelector('#colonia_select_new');

				let input_colonia = document.querySelector('#colonia_new');
				clearSelect(select_municipio);
				clearSelect(select_localidad);
				clearSelect(select_colonia);

				if (e.target.value !== 'MX') {

					select_estado.value = '33';

					let data = {
						'estado_id': 33,
						'municipio_id': 1,
					}

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
								select_municipio.add(option);
							});
							select_municipio.value = '1';
						},
						error: function(jqXHR, textStatus, errorThrown) {}
					});

					$.ajax({
						data: data,
						url: "<?= base_url('/data/get-localidades-by-municipio') ?>",
						method: "POST",
						dataType: "json",
						success: function(response) {
							let localidades = response.data;
							localidades.forEach(localidad => {
								let option = document.createElement("option");
								option.text = localidad.LOCALIDADDESCR;
								option.value = localidad.LOCALIDADID;
								select_localidad.add(option);
							});
							let option = document.createElement("option");
							option.text = 'OTRO';
							option.value = '0';

							select_colonia.add(option);
							select_localidad.value = '1';

							select_colonia.value = '0';
							select_colonia.classList.add('d-none');
							input_colonia.classList.remove('d-none');
							input_colonia.value = 'EXTRANJERO';
							document.querySelector('#calle').focus();
						},
						error: function(jqXHR, textStatus, errorThrown) {}
					});

					let option = document.createElement("option");
					option.text = 'OTRO';
					option.value = '0';

					select_colonia.add(option);

					select_colonia.value = '0';
					select_colonia.classList.add('d-none');
					input_colonia.classList.remove('d-none');
					input_colonia.value = 'EXTRANJERO';


				} else {
					clearSelect(select_municipio);
					clearSelect(select_localidad);
					clearSelect(select_colonia);

					select_estado.value = '';
					select_municipio.value = '';
					select_localidad.value = '';
					select_colonia.value = '';
					input_colonia.value = '';

					select_colonia.classList.remove('d-none');
					input_colonia.classList.add('d-none');
				}
			});

			document.querySelector('#estado_select_new').addEventListener('change', (e) => {
				let select_municipio = document.querySelector('#municipio_select_new');
				let select_localidad = document.querySelector('#localidad_select_new');
				let select_colonia = document.querySelector('#colonia_select_new');
				let input_colonia = document.querySelector('#colonia_new');

				clearSelect(select_municipio);
				clearSelect(select_localidad);
				clearSelect(select_colonia);

				select_municipio.value = '';
				select_localidad.value = '';
				select_colonia.value = '';
				input_colonia.value = '';

				select_colonia.classList.remove('d-none');
				input_colonia.classList.add('d-none');

				let data = {
					'estado_id': e.target.value,
				}

				$.ajax({
					data: data,
					url: "<?= base_url('/data/get-municipios-by-estado') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						let municipios = response.data;

						municipios.forEach(municipio => {
							var option = document.createElement("option");
							option.text = municipio.MUNICIPIODESCR;
							option.value = municipio.MUNICIPIOID;
							select_municipio.add(option);
						});
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
				if (e.target.value != 2) {
					var option = document.createElement("option");
					option.text = 'OTRO';
					option.value = '0';
					select_colonia.add(option);
					select_colonia.value = '0';
					input_colonia.value = '';
					select_colonia.classList.add('d-none');
					input_colonia.classList.remove('d-none');
				} else {
					document.querySelector('#colonia-message').classList.remove('d-none');
				}
			});

			document.querySelector('#municipio_select_new').addEventListener('change', (e) => {
				let select_localidad = document.querySelector('#localidad_select_new');
				let select_colonia = document.querySelector('#colonia_select_new');
				let input_colonia = document.querySelector('#colonia_new');

				let estado = document.querySelector('#estado_select_new').value;
				let municipio = e.target.value;

				clearSelect(select_localidad);
				clearSelect(select_colonia);

				select_localidad.value = '';

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

			document.querySelector('#localidad_select_new').addEventListener('change', (e) => {
				let select_colonia = document.querySelector('#colonia_select_new');
				let input_colonia = document.querySelector('#colonia_new');

				let estado = document.querySelector('#estado_select_new').value;
				let municipio = document.querySelector('#municipio_select_new').value;
				let localidad = e.target.value;

				clearSelect(select_colonia);
				select_colonia.value = '';

				let data = {
					'estado_id': estado,
					'municipio_id': municipio,
					'localidad_id': localidad
				};

				console.log(data);

				if (estado == 2) {
					select_colonia.classList.remove('d-none');
					input_colonia.classList.add('d-none');
					input_colonia.value = '';
					$.ajax({
						data: data,
						url: "<?= base_url('/data/get-colonias-by-estado-municipio-localidad') ?>",
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
						error: function(jqXHR, textStatus, errorThrown) {

						}
					});

				} else {
					var option = document.createElement("option");
					option.text = 'OTRO';
					option.value = '0';
					select_colonia.add(option);
					select_colonia.value = '0';
					input_colonia.value = '';
					select_colonia.classList.add('d-none');
					input_colonia.classList.remove('d-none');
				}
			});

			document.querySelector('#colonia_select_new').addEventListener('change', (e) => {
				let select_colonia = document.querySelector('#colonia_select_new');
				let input_colonia = document.querySelector('#colonia_new');

				if (e.target.value === '0') {
					select_colonia.classList.add('d-none');
					input_colonia.classList.remove('d-none');
					input_colonia.value = '';
					input_colonia.focus();
				} else {
					input_colonia.value = '-';
				}
			});


			//END CREAR PERSONA FISICA

			document.querySelector('#fecha_nacimiento_pf').addEventListener('change', (e) => {
				let fecha = e.target.value;
				let hoy = new Date();
				let cumpleanos = new Date(fecha);
				let edad = hoy.getFullYear() - cumpleanos.getFullYear();
				let m = hoy.getMonth() - cumpleanos.getMonth();

				if (m < 0 || (m === 0 && hoy.getDate() <= cumpleanos.getDate())) {
					edad--;
				}
				document.querySelector('#edad_pf').value = edad;
			})

			function clearInputPhone(e) {
				e.target.value = e.target.value.replace(/-/g, "");
				if (e.target.value.length > e.target.maxLength) {
					e.target.value = e.target.value.slice(0, e.target.maxLength);
				};
			}


			function actualizarPersona() {
				const data = {
					'folio': document.querySelector('#input_folio_atencion').value,
					'year': document.querySelector('#year_select').value,
					'pf_id': document.querySelector('#pf_id').value,
					'tipo_identificacion_pf': document.querySelector('#tipo_identificacion_pf').value,
					'numero_identidad_pf': document.querySelector('#numero_identidad_pf').value,
					'nombre_pf': document.querySelector('#nombre_pf').value,
					'apellido_paterno_pf': document.querySelector('#apellido_paterno_pf').value,
					'apellido_materno_pf': document.querySelector('#apellido_materno_pf').value,
					'nacionalidad_pf': document.querySelector('#nacionalidad_pf').value,
					'idioma_pf': document.querySelector('#idioma_pf').value,
					'edoorigen_pf': document.querySelector('#edoorigen_pf').value,
					'munorigen_pf': document.querySelector('#munorigen_pf').value,
					'telefono_pf': document.querySelector('#telefono_pf').value,
					'codigo_pais_pf': document.querySelector('#codigo_pais_pf').value,
					'telefono_pf_2': document.querySelector('#telefono_pf_2').value,
					'codigo_pais_pf_2': document.querySelector('#codigo_pais_pf_2').value,
					'correo_pf': document.querySelector('#correo_pf').value,
					'fecha_nacimiento_pf': document.querySelector('#fecha_nacimiento_pf').value,
					'edad_pf': document.querySelector('#edad_pf').value,
					'edoc_pf': document.querySelector('#edoc_pf').value,
					'sexo_pf': document.querySelector('#sexo_pf').value,
					'ocupacion_pf': document.querySelector('#ocupacion_pf').value,
					'escolaridad_pf': document.querySelector('#escolaridad_pf').value,
					'descripcionFisica_pf': document.querySelector('#descripcionFisica_pf').value,
					'calidad_juridica_pf': document.querySelector('#calidad_juridica_pf').value,
					'apodo_pf': document.querySelector('#apodo_pf').value,
					'denunciante_pf': document.querySelector('#denunciante_pf').value,
					'facebook_pf': document.querySelector('#facebook_pf').value,
					'instagram_pf': document.querySelector('#instagram_pf').value,
					'twitter_pf': document.querySelector('#twitter_pf').value,
				};

				$.ajax({
					data: data,
					url: "<?= base_url('/data/update-persona-fisica-by-id') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						if (response.status == 1) {
							let tabla_personas = document.querySelectorAll('#table-personas tr');
							tabla_personas.forEach(row => {
								if (row.id !== '') {
									row.remove();
								}
							});

							llenarTablaPersonas(response.personas);

							Swal.fire({
								icon: 'success',
								text: 'Persona física actualizada correctamente',
								confirmButtonColor: '#bf9b55',
							});
						} else {
							Swal.fire({
								icon: 'error',
								text: 'No se actualizó la información de la persona',
								confirmButtonColor: '#bf9b55',
							});
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						Swal.fire({
							icon: 'error',
							text: 'No se actualizó la información de la persona',
							confirmButtonColor: '#bf9b55',
						});
					}
				});
			}
			//DOMICILIO PERSONA FÍSICA

			document.querySelector('#pais_pfd').addEventListener('change', (e) => {

				let select_estado = document.querySelector('#estado_pfd');
				let select_municipio = document.querySelector('#municipio_pfd');
				let select_localidad = document.querySelector('#localidad_pfd');
				let select_colonia = document.querySelector('#colonia_pfd_select');

				let input_colonia = document.querySelector('#colonia_pfd');
				clearSelect(select_municipio);
				clearSelect(select_localidad);
				clearSelect(select_colonia);

				if (e.target.value !== 'MX') {

					select_estado.value = '33';

					let data = {
						'estado_id': 33,
						'municipio_id': 1,
					}

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
								select_municipio.add(option);
							});
							select_municipio.value = '1';
						},
						error: function(jqXHR, textStatus, errorThrown) {}
					});

					$.ajax({
						data: data,
						url: "<?= base_url('/data/get-localidades-by-municipio') ?>",
						method: "POST",
						dataType: "json",
						success: function(response) {
							let localidades = response.data;
							localidades.forEach(localidad => {
								let option = document.createElement("option");
								option.text = localidad.LOCALIDADDESCR;
								option.value = localidad.LOCALIDADID;
								select_localidad.add(option);
							});
							let option = document.createElement("option");
							option.text = 'OTRO';
							option.value = '0';

							select_colonia.add(option);
							select_localidad.value = '1';

							select_colonia.value = '0';
							select_colonia.classList.add('d-none');
							input_colonia.classList.remove('d-none');
							input_colonia.value = 'EXTRANJERO';
						},
						error: function(jqXHR, textStatus, errorThrown) {}
					});

					let option = document.createElement("option");
					option.text = 'OTRO';
					option.value = '0';

					select_colonia.add(option);

					select_colonia.value = '0';
					select_colonia.classList.add('d-none');
					input_colonia.classList.remove('d-none');
					input_colonia.value = 'EXTRANJERO';


				} else {
					clearSelect(select_municipio);
					clearSelect(select_localidad);
					clearSelect(select_colonia);

					select_estado.value = '';
					select_municipio.value = '';
					select_localidad.value = '';
					select_colonia.value = '';
					input_colonia.value = '';

					select_colonia.classList.remove('d-none');
					input_colonia.classList.add('d-none');
				}
			});

			document.querySelector('#estado_pfd').addEventListener('change', (e) => {
				let select_municipio = document.querySelector('#municipio_pfd');
				let select_localidad = document.querySelector('#localidad_pfd');
				let select_colonia = document.querySelector('#colonia_pfd_select');
				let input_colonia = document.querySelector('#colonia_pfd');

				clearSelect(select_municipio);
				clearSelect(select_localidad);
				clearSelect(select_colonia);

				select_municipio.value = '';
				select_localidad.value = '';
				select_colonia.value = '';
				input_colonia.value = '';

				select_colonia.classList.remove('d-none');
				input_colonia.classList.add('d-none');

				let data = {
					'estado_id': e.target.value,
				}

				$.ajax({
					data: data,
					url: "<?= base_url('/data/get-municipios-by-estado') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						let municipios = response.data;

						municipios.forEach(municipio => {
							var option = document.createElement("option");
							option.text = municipio.MUNICIPIODESCR;
							option.value = municipio.MUNICIPIOID;
							select_municipio.add(option);
						});
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
				if (e.target.value != 2) {
					var option = document.createElement("option");
					option.text = 'OTRO';
					option.value = '0';
					select_colonia.add(option);
					select_colonia.value = '0';
					input_colonia.value = '-';
					select_colonia.classList.add('d-none');
					input_colonia.classList.remove('d-none');
				}
			});

			document.querySelector('#municipio_pfd').addEventListener('change', (e) => {
				let select_localidad = document.querySelector('#localidad_pfd');
				let select_colonia = document.querySelector('#colonia_pfd_select');
				let input_colonia = document.querySelector('#colonia_pfd');

				let estado = document.querySelector('#estado_pfd').value;
				let municipio = e.target.value;

				clearSelect(select_localidad);
				clearSelect(select_colonia);

				select_localidad.value = '';

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

			document.querySelector('#localidad_pfd').addEventListener('change', (e) => {
				let select_colonia = document.querySelector('#colonia_pfd_select');
				let input_colonia = document.querySelector('#colonia_pfd');

				let estado = document.querySelector('#estado_pfd').value;
				let municipio = document.querySelector('#municipio_pfd').value;
				let localidad = e.target.value;

				clearSelect(select_colonia);
				select_colonia.value = '';

				let data = {
					'estado_id': estado,
					'municipio_id': municipio,
					'localidad_id': localidad
				};

				console.log(data);

				if (estado == 2) {
					select_colonia.classList.remove('d-none');
					input_colonia.classList.add('d-none');
					input_colonia.value = '-';
					$.ajax({
						data: data,
						url: "<?= base_url('/data/get-colonias-by-estado-municipio-localidad') ?>",
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

				} else {
					var option = document.createElement("option");
					option.text = '';
					option.value = '';
					select_colonia.add(option);
					select_colonia.value = '';
					input_colonia.value = '';
					select_colonia.classList.add('d-none');
					input_colonia.classList.remove('d-none');
				}
			});

			document.querySelector('#colonia_pfd_select').addEventListener('change', (e) => {
				let select_colonia = document.querySelector('#colonia_pfd_select');
				let input_colonia = document.querySelector('#colonia_pfd');

				if (e.target.value === '0') {
					select_colonia.classList.add('d-none');
					input_colonia.classList.remove('d-none');
					input_colonia.value = '';
				} else {
					select_colonia.classList.remove('d-none');
					input_colonia.classList.add('d-none');
					input_colonia.value = '-';
				}
			});

			function actualizarDomicilio() {
				const data = {
					'folio': document.querySelector('#input_folio_atencion').value,
					'year': document.querySelector('#year_select').value,
					'pf_id': document.querySelector('#pf_id').value,
					'pfd_id': document.querySelector('#pfd_id').value,
					'pais_pfd': document.querySelector('#pais_pfd').value,
					'estado_pfd': document.querySelector('#estado_pfd').value,
					'municipio_pfd': document.querySelector('#municipio_pfd').value,
					'localidad_pfd': document.querySelector('#localidad_pfd').value,
					'colonia_pfd_select': document.querySelector('#colonia_pfd_select').value,
					'colonia_pfd': document.querySelector('#colonia_pfd').value,
					'cp_pfd': document.querySelector('#cp_pfd').value,
					'calle_pfd': document.querySelector('#calle_pfd').value,
					'exterior_pfd': document.querySelector('#exterior_pfd').value,
					'interior_pfd': document.querySelector('#interior_pfd').value,
					'referencia_pfd': document.querySelector('#referencia_pfd').value,
					'zona_pfd': document.querySelector('#zona_pfd').value,
				};

				$.ajax({
					data: data,
					url: "<?= base_url('/data/update-persona-fisica-domicilio-by-id') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						console.log(response);
						if (response.status == 1) {
							Swal.fire({
								icon: 'success',
								text: 'Domicilio actualizado correctamente',
								confirmButtonColor: '#bf9b55',
							});
						} else {
							Swal.fire({
								icon: 'error',
								text: 'No se actualizó el domicilio',
								confirmButtonColor: '#bf9b55',
							});
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						Swal.fire({
							icon: 'error',
							text: 'No se actualizó el domicilio',
							confirmButtonColor: '#bf9b55',
						});
					}
				});
			}

			function actualizarPersonaMediaAfiliacion(id) {
				const data = {
					'folio': document.querySelector('#input_folio_atencion').value,
					'year': document.querySelector('#year_select').value,
					'pf_id': id,
					'ocupacion_mf': document.querySelector('#ocupacion_mf').value ? document.querySelector('#ocupacion_mf').value : document.querySelector('#ocupacion_mf1').value,
					'estatura_mf': document.querySelector('#estatura_mf').value ? document.querySelector('#estatura_mf').value : document.querySelector('#estatura_mf1').value,
					'peso_mf': document.querySelector('#peso_mf').value ? document.querySelector('#peso_mf').value : document.querySelector('#peso_mf1').value,
					'senas_mf': document.querySelector('#senas_mf').value ? document.querySelector('#senas_mf').value : document.querySelector('#senas_mf1').value,
					'colortez_mf': document.querySelector('#colortez_mf').value ? document.querySelector('#colortez_mf').value : document.querySelector('#colortez_mf1').value,
					'complexion_mf': document.querySelector('#complexion_mf').value ? document.querySelector('#complexion_mf').value : document.querySelector('#complexion_mf1').value,
					'contextura_ceja_mf': document.querySelector('#contextura_ceja_mf').value ? document.querySelector('#contextura_ceja_mf').value : document.querySelector('#contextura_ceja_mf1').value,
					'cara_forma_mf': document.querySelector('#cara_forma_mf').value ? document.querySelector('#cara_forma_mf').value : document.querySelector('#cara_forma_mf1').value,
					'cara_tamano_mf': document.querySelector('#cara_tamano_mf').value ? document.querySelector('#cara_tamano_mf').value : document.querySelector('#cara_tamano_mf1').value,
					'caratez_mf': document.querySelector('#caratez_mf').value ? document.querySelector('#caratez_mf').value : document.querySelector('#caratez_mf1').value,
					'lobulo_mf': document.querySelector('#lobulo_mf').value ? document.querySelector('#lobulo_mf').value : document.querySelector('#lobulo_mf1').value,
					'forma_oreja_mf': document.querySelector('#forma_oreja_mf').value ? document.querySelector('#forma_oreja_mf').value : document.querySelector('#forma_oreja_mf1').value,
					'tamano_oreja_mf': document.querySelector('#tamano_oreja_mf').value ? document.querySelector('#tamano_oreja_mf').value : document.querySelector('#tamano_oreja_mf1').value,
					'colorC_mf': document.querySelector('#colorC_mf').value ? document.querySelector('#colorC_mf').value : document.querySelector('#colorC_mf1').value,
					'formaC_mf': document.querySelector('#formaC_mf').value ? document.querySelector('#formaC_mf').value : document.querySelector('#formaC_mf1').value,
					'tamanoC_mf': document.querySelector('#tamanoC_mf').value ? document.querySelector('#tamanoC_mf').value : document.querySelector('#tamanoC_mf1').value,
					'peculiarC_mf': document.querySelector('#peculiarC_mf').value ? document.querySelector('#peculiarC_mf').value : document.querySelector('#peculiarC_mf1').value,
					'cabello_descr_mf': document.querySelector('#cabello_descr_mf').value ? document.querySelector('#cabello_descr_mf').value : document.querySelector('#cabello_descr_mf1').value,
					'frente_altura_mf': document.querySelector('#frente_altura_mf').value ? document.querySelector('#frente_altura_mf').value : document.querySelector('#frente_altura_mf1').value,
					'frente_anchura_ms': document.querySelector('#frente_anchura_ms').value ? document.querySelector('#frente_anchura_ms').value : document.querySelector('#frente_anchura_mf1').value,
					'tipoF_mf': document.querySelector('#tipoF_mf').value ? document.querySelector('#tipoF_mf').value : document.querySelector('#tipoF_mf1').value,
					'frente_peculiar_mf': document.querySelector('#frente_peculiar_mf').value ? document.querySelector('#frente_peculiar_mf').value : document.querySelector('#frente_peculiar_mf1').value,
					'colocacion_ceja_mf': document.querySelector('#colocacion_ceja_mf').value ? document.querySelector('#colocacion_ceja_mf').value : document.querySelector('#colocacion_ceja_mf1').value,
					'ceja_mf': document.querySelector('#ceja_mf').value ? document.querySelector('#ceja_mf').value : document.querySelector('#ceja_mf1').value,
					'tamano_ceja_mf': document.querySelector('#tamano_ceja_mf').value ? document.querySelector('#tamano_ceja_mf').value : document.querySelector('#tamano_ceja_mf1').value,
					'grosor_ceja_mf': document.querySelector('#grosor_ceja_mf').value ? document.querySelector('#grosor_ceja_mf').value : document.querySelector('#grosor_ceja_mf1').value,
					'colocacion_ojos_mf': document.querySelector('#colocacion_ojos_mf').value ? document.querySelector('#colocacion_ojos_mf').value : document.querySelector('#colocacion_ojos_mf1').value,
					'forma_ojos_mf': document.querySelector('#forma_ojos_mf').value ? document.querySelector('#forma_ojos_mf').value : document.querySelector('#forma_ojos_mf1').value,
					'tamano_ojos_mf': document.querySelector('#tamano_ojos_mf').value ? document.querySelector('#tamano_ojos_mf').value : document.querySelector('#tamano_ojos_mf1').value,
					'colorO_mf': document.querySelector('#colorO_mf').value ? document.querySelector('#colorO_mf').value : document.querySelector('#colorO_mf1').value,
					'peculiaridad_ojos_mf': document.querySelector('#peculiaridad_ojos_mf').value ? document.querySelector('#peculiaridad_ojos_mf').value : document.querySelector('#peculiaridad_ojos_mf1').value,
					'nariz_tipo_mf': document.querySelector('#nariz_tipo_mf').value ? document.querySelector('#nariz_tipo_mf').value : document.querySelector('#nariz_tipo_mf1').value,
					'nariz_tamano_mf': document.querySelector('#nariz_tamano_mf').value ? document.querySelector('#nariz_tamano_mf').value : document.querySelector('#nariz_tamano_mf1').value,
					'nariz_base_mf': document.querySelector('#nariz_base_mf').value ? document.querySelector('#nariz_base_mf').value : document.querySelector('#nariz_base_mf1').value,
					'nariz_peculiar_mf': document.querySelector('#nariz_peculiar_mf').value ? document.querySelector('#nariz_peculiar_mf').value : document.querySelector('#nariz_peculiar_mf1').value,
					'nariz_descr_mf': document.querySelector('#nariz_descr_mf').value ? document.querySelector('#nariz_descr_mf').value : document.querySelector('#nariz_descr_mf1').value,
					'bigote_forma_mf': document.querySelector('#bigote_forma_mf').value ? document.querySelector('#bigote_forma_mf').value : document.querySelector('#bigote_forma_mf1').value,
					'bigote_tamaño_mf': document.querySelector('#bigote_tamaño_mf').value ? document.querySelector('#bigote_tamaño_mf').value : document.querySelector('#bigote_tamaño_mf1').value,
					'bigote_grosor_mf': document.querySelector('#bigote_grosor_mf').value ? document.querySelector('#bigote_grosor_mf').value : document.querySelector('#bigote_grosor_mf1').value,
					'bigote_peculiar_mf': document.querySelector('#bigote_peculiar_mf').value ? document.querySelector('#bigote_peculiar_mf').value : document.querySelector('#bigote_peculiar_mf1').value,
					'bigote_descr_mf': document.querySelector('#bigote_descr_mf').value ? document.querySelector('#bigote_descr_mf').value : document.querySelector('#bigote_descr_mf1').value,
					'boca_tamano_mf': document.querySelector('#boca_tamano_mf').value ? document.querySelector('#boca_tamano_mf').value : document.querySelector('#boca_tamano_mf1').value,
					'boca_peculiar_mf': document.querySelector('#boca_peculiar_mf').value ? document.querySelector('#boca_peculiar_mf').value : document.querySelector('#boca_peculiar_mf1').value,
					'labio_longitud_mf': document.querySelector('#labio_longitud_mf').value ? document.querySelector('#labio_longitud_mf').value : document.querySelector('#labio_longitud_mf1').value,
					'labio_posicion_mf': document.querySelector('#labio_posicion_mf').value ? document.querySelector('#labio_posicion_mf').value : document.querySelector('#labio_posicion_mf1').value,
					'labio_peculiar_mf': document.querySelector('#labio_peculiar_mf').value ? document.querySelector('#labio_peculiar_mf').value : document.querySelector('#labio_peculiar_mf1').value,
					'labio_grosor_mf': document.querySelector('#labio_grosor_mf').value ? document.querySelector('#labio_grosor_mf').value : document.querySelector('#labio_grosor_mf1').value,
					'dientes_tamano_mf': document.querySelector('#dientes_tamano_mf').value ? document.querySelector('#dientes_tamano_mf').value : document.querySelector('#dientes_tamano_mf1').value,
					'dientes_tipo_mf': document.querySelector('#dientes_tipo_mf').value ? document.querySelector('#dientes_tipo_mf').value : document.querySelector('#dientes_tipo_mf1').value,
					'dientes_peculiar_mf': document.querySelector('#dientes_peculiar_mf').value ? document.querySelector('#dientes_peculiar_mf').value : document.querySelector('#dientes_peculiar_mf1').value,
					'dientes_descr_mf': document.querySelector('#dientes_descr_mf').value ? document.querySelector('#dientes_descr_mf').value : document.querySelector('#dientes_descr_mf1').value,
					'barbilla_forma_mf': document.querySelector('#barbilla_forma_mf').value ? document.querySelector('#barbilla_forma_mf').value : document.querySelector('#barbilla_forma_mf1').value,
					'barbilla_tamano_mf': document.querySelector('#barbilla_tamano_mf').value ? document.querySelector('#barbilla_tamano_mf').value : document.querySelector('#barbilla_tamano_mf1').value,
					'barbilla_inclinacion_mf': document.querySelector('#barbilla_inclinacion_mf').value ? document.querySelector('#barbilla_inclinacion_mf').value : document.querySelector('#barbilla_inclinacion_mf1').value,
					'barbilla_peculiar_mf': document.querySelector('#barbilla_peculiar_mf').value ? document.querySelector('#barbilla_peculiar_mf').value : document.querySelector('#barbilla_peculiar_mf1').value,
					'barbilla_descr_mf': document.querySelector('#barbilla_descr_mf').value ? document.querySelector('#barbilla_descr_mf').value : document.querySelector('#barbilla_descr_mf1').value,
					'barba_tamano_mf': document.querySelector('#barba_tamano_mf').value ? document.querySelector('#barba_tamano_mf').value : document.querySelector('#barba_tamano_mf1').value,
					'barba_peculiar_mf': document.querySelector('#barba_peculiar_mf').value ? document.querySelector('#barba_peculiar_mf').value : document.querySelector('#barba_peculiar_mf1').value,
					'barba_descr_mf': document.querySelector('#barba_descr_mf').value ? document.querySelector('#barba_descr_mf').value : document.querySelector('#barba_descr_mf1').value,
					'cuello_tamano_mf': document.querySelector('#cuello_tamano_mf').value ? document.querySelector('#cuello_tamano_mf').value : document.querySelector('#cuello_tamano_mf1').value,
					'cuello_grosor_mf': document.querySelector('#cuello_grosor_mf').value ? document.querySelector('#cuello_grosor_mf').value : document.querySelector('#cuello_grosor_mf1').value,
					'cuello_peculiar_mf': document.querySelector('#cuello_peculiar_mf').value ? document.querySelector('#cuello_peculiar_mf').value : document.querySelector('#cuello_peculiar_mf1').value,
					'cuello_descr_mf': document.querySelector('#cuello_descr_mf').value ? document.querySelector('#cuello_descr_mf').value : document.querySelector('#cuello_descr_mf1').value,
					'hombro_posicion_mf': document.querySelector('#hombro_posicion_mf').value ? document.querySelector('#hombro_posicion_mf').value : document.querySelector('#hombro_posicion_mf1').value,
					'hombro_tamano_mf': document.querySelector('#hombro_tamano_mf').value ? document.querySelector('#hombro_tamano_mf').value : document.querySelector('#hombro_tamano_mf1').value,
					'hombro_grosor_mf': document.querySelector('#hombro_grosor_mf').value ? document.querySelector('#hombro_grosor_mf').value : document.querySelector('#hombro_grosor_mf1').value,
					'estomago_mf': document.querySelector('#estomago_mf').value ? document.querySelector('#estomago_mf').value : document.querySelector('#estomago_mf1').value,
					'escolaridad_mf': document.querySelector('#escolaridad_mf').value ? document.querySelector('#escolaridad_mf').value : document.querySelector('#escolaridad_mf1').value,
					'etnia_mf': document.querySelector('#etnia_mf').value ? document.querySelector('#etnia_mf').value : document.querySelector('#etnia_mf1').value,
					'estomago_descr_mf': document.querySelector('#estomago_descr_mf').value ? document.querySelector('#estomago_descr_mf').value : document.querySelector('#estomago_descr_mf1').value,
					'discapacidad_mf': document.querySelector('#discapacidad_mf').value ? document.querySelector('#discapacidad_mf').value : document.querySelector('#discapacidad_mf1').value,
					'diaDesaparicion': document.querySelector('#diaDesaparicion').value ? document.querySelector('#diaDesaparicion').value : document.querySelector('#diaDesaparicion1').value,
					'lugarDesaparicion': document.querySelector('#lugarDesaparicion').value ? document.querySelector('#lugarDesaparicion').value : document.querySelector('#lugarDesaparicion1').value,
					'vestimenta_mf': document.querySelector('#vestimenta_mf').value ? document.querySelector('#vestimenta_mf').value : document.querySelector('#vestimenta_mf1').value,
					// 'parentesco_mf': document.querySelector('#parentesco_mf').value?document.querySelector('#parentesco_mf').value:document.querySelector('#parentesco_mf1').value,

				};
				// console.log(id);
				$.ajax({
					data: data,
					url: "<?= base_url('/data/update-media-filiacion-by-id') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						// console.log(respobse.idcalidad);
						if (response.status == 1) {
							Swal.fire({
								icon: 'success',
								text: 'Persona media afiliación actualizada correctamente',
								confirmButtonColor: '#bf9b55',
							});
							document.getElementById("form_media_filiacion_insert").reset();
							$('#media_filiacion_modal').modal('hide');


						} else {
							Swal.fire({
								icon: 'error',
								text: 'No se actualizó la información de la persona media afiliación',
								confirmButtonColor: '#bf9b55',
							});
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus);
					}
				});
			}


			function actualizarParentesco() {
				const data = {
					'folio': document.querySelector('#input_folio_atencion').value,
					'year': document.querySelector('#year_select').value,
					'personaFisica1': document.querySelector('#personaFisica1').value,
					'personaFisica2': document.querySelector('#personaFisica2').value,
					'parentesco_mf': document.querySelector('#parentesco_mf').value,
				};
				$.ajax({
					data: data,
					url: "<?= base_url('/data/update-parentesco-by-id') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						if (response.status == 1) {
							let tabla_parentesco = document.querySelectorAll('#table-parentesco tr');
							tabla_parentesco.forEach(row => {
								if (row.id !== '') {
									row.remove();
								}
							});
							llenarTablaParentesco(response.parentescoRelacion, response.personaiduno, response.personaidDos, response.parentesco);

							Swal.fire({
								icon: 'success',
								text: 'Parentesco actualizado correctamente',
								confirmButtonColor: '#bf9b55',
							});
							$('#relacion_parentesco_modal').modal('hide');

						} else {
							Swal.fire({
								icon: 'error',
								text: 'No se actualizó la información del parentesco',
								confirmButtonColor: '#bf9b55',
							});
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus);
					}
				});
			}

			function insertarParentesco() {
				const data = {
					'folio': document.querySelector('#input_folio_atencion').value,
					'year': document.querySelector('#year_select').value,
					'personaFisica1': document.querySelector('#personaFisica1_I').value,
					'personaFisica2': document.querySelector('#personaFisica2_I').value,
					'parentesco_mf': document.querySelector('#parentesco_mf_I').value,
				};
				// console.log(data);
				$.ajax({
					data: data,
					url: "<?= base_url('/data/create-parentesco-by-id') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						if (response.status == 1) {
							$('#personaFisica2_I').empty();
							document.querySelector('#parentesco_mf_I').value = '';
							document.querySelector('#personaFisica1_I').value = '';

							let tabla_parentesco = document.querySelectorAll('#table-parentesco tr');
							tabla_parentesco.forEach(row => {
								if (row.id !== '') {
									row.remove();
								}
							});
							llenarTablaParentesco(response.parentescoRelacion, response.personaiduno, response.personaidDos, response.parentesco);

							Swal.fire({
								icon: 'success',
								text: 'Parentesco ingresado correctamente',
								confirmButtonColor: '#bf9b55',
							});
							$('#relacion_parentesco_modal_insert').modal('hide');

						} else {
							Swal.fire({
								icon: 'error',
								text: 'No se agregó la información del parentesco',
								confirmButtonColor: '#bf9b55',
							});
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus);
					}
				});
			}

			function actualizarVehiculo() {
				const data = {
					'folio': document.querySelector('#input_folio_atencion').value,
					'year': document.querySelector('#year_select').value,
					'tipo_vehiculo': document.querySelector('#tipo_vehiculo').value,
					'color_vehiculo': document.querySelector('#color_vehiculo').value,
					'description_vehiculo': document.querySelector('#description_vehiculo').value,
				};
				$.ajax({
					data: data,
					url: "<?= base_url('/data/update-vehiculo-by-id') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						// console.log(respobse.idcalidad);
						if (response.status == 1) {
							Swal.fire({
								icon: 'success',
								text: 'Vehículo actualizado correctamente',
								confirmButtonColor: '#bf9b55',
							});
						} else {
							Swal.fire({
								icon: 'error',
								text: 'No se actualizó la información del vehículo',
								confirmButtonColor: '#bf9b55',
							});
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus);
					}
				});
			}

			function insertarPersonaFisica() {
				const data = {
					'folio': document.querySelector('#input_folio_atencion').value,
					'year': document.querySelector('#year_select').value,
					'nombre': document.querySelector('#nombre_new').value,
					'primer_apellido': document.querySelector('#apellido_paterno_new').value,
					'segundo_apellido': document.querySelector('#apellido_materno_new').value,
					'fecha_nacimiento': document.querySelector('#fecha_nacimiento_new').value,
					'edad': document.querySelector('#edad_new').value,
					'sexo': document.querySelector('#sexo_new').value,
					'codigo_pais_pfc': document.querySelector('#codigo_pais_new').value,
					'codigo_pais_pfc_2': document.querySelector('#codigo_pais_2_new').value,
					'calidad_juridica': document.querySelector('#calidad_juridica_new').value,
					'municipio_origen': document.querySelector('#municipio_select_origen_new').value,
					'telefono': document.querySelector('#telefono_new').value,
					'telefono_adicional': document.querySelector('#telefono_new2').value,
					'nacionalidad_origen': document.querySelector('#nacionalidad_new').value,
					'estado_origen': document.querySelector('#estado_select_origen_new').value,
					'idioma': document.querySelector('#idioma_new').value,
					'pais_actual': document.querySelector('#pais_select_new').value,
					'estado_actual': document.querySelector('#estado_select_new').value,
					'municipio_actual': document.querySelector('#municipio_select_new').value,
					'localidad_actual': document.querySelector('#localidad_select_new').value,
					'colonia_actual': document.querySelector('#colonia_select_new').value,
					'colonia_actual_descr': document.querySelector('#colonia_new').value,
					'codigo_postal': document.querySelector('#cp_new').value,
					'calle': document.querySelector('#calle_new').value,
					'num_exterior': document.querySelector('#exterior_new').value,
					'num_interior': document.querySelector('#interior_new').value,
					'identificacion': document.querySelector('#identificacion_new').value,
					'numero_identificacion': document.querySelector('#numero_ide_new').value,
					'estado_civil': document.querySelector('#e_civil_new').value,
					'escolaridad': document.querySelector('#escolaridad_new').value,
					'ocupacion': document.querySelector('#ocupacion_new').value,
					'discapacidad': document.querySelector('#discapacidad_new').value,
					'leer': document.querySelector('#leer_new').value,
					'escribir': document.querySelector('#escribir_new').value,
					'facebook': document.querySelector('#facebook_new').value,
					'twitter': document.querySelector('#twitter_new').value,
					'instagram': document.querySelector('#instagram_new').value,
					'correo': document.querySelector('#correo_new').value,
					'desaparecida': document.querySelector('#desaparecida_new').value

				};
				// console.log(data);
				$.ajax({
					data: data,
					url: "<?= base_url('/data/create-persona_fisica-by-folio') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						if (response.status == 1) {
							document.getElementById("persona_fisica_form_insert").reset();

							let tabla_personas = document.querySelectorAll('#table-personas tr');
							tabla_personas.forEach(row => {
								if (row.id !== '') {
									row.remove();
								}
							});

							llenarTablaPersonas(response.personas);
							Swal.fire({
								icon: 'success',
								text: 'Persona fisica agregada correctamente',
								confirmButtonColor: '#bf9b55',
							});
							$('#insert_persona_fisica_modal').modal('hide');
							const delitosModalidadFiltro = response.delitosModalidadFiltro;
							const imputados = response.imputados;
							const victimas = response.victimas;
							const personas = response.personas;

							//SELECT CON DELITOS DEL IMPUTADO
							$('#delito_cometido').empty();
							let select_delitos_imputado = document.querySelector("#delito_cometido")
							delitosModalidadFiltro.forEach(modalidad => {
								const option = document.createElement('option');
								option.value = modalidad.DELITOMODALIDADID;
								option.text = modalidad.DELITOMODALIDADDESCR;
								select_delitos_imputado.add(option, null);

							});

							$('#victima_ofendido').empty();
							let select_victima_ofendido = document.querySelector("#victima_ofendido")
							victimas.forEach(victima => {
								const option = document.createElement('option');
								option.value = victima.PERSONAFISICAID;
								option.text = victima.NOMBRE + ' ' + victima.PRIMERAPELLIDO;
								select_victima_ofendido.add(option, null);

							});

							$('#imputado_delito_cometido').empty();

							let select_imputado_delito_cometido = document.querySelector("#imputado_delito_cometido")

							imputados.forEach(imputado => {
								const option = document.createElement('option');
								option.value = imputado.PERSONAFISICAID;
								option.text = imputado.NOMBRE + ' ' + imputado.PRIMERAPELLIDO;
								select_imputado_delito_cometido.add(option, null);

							});
							$('#imputado_arbol').empty();

							let select_imputado_mputado = document.querySelector("#imputado_arbol")
							imputados.forEach(imputado => {
								const option = document.createElement('option');
								option.value = imputado.PERSONAFISICAID;
								option.text = imputado.NOMBRE + ' ' + imputado.PRIMERAPELLIDO;
								select_imputado_mputado.add(option, null);

							});
							$('#personaFisica1_I').empty();

							let select_personaFisica1_I = document.querySelector("#personaFisica1_I")
							personas.forEach(persona => {
								const option = document.createElement('option');
								option.value = persona.PERSONAFISICAID;
								option.text = persona.NOMBRE + ' ' + persona.PRIMERAPELLIDO;
								select_personaFisica1_I.add(option, null);

							});
							// $('#media_filiacion_modal').modal('show');
							// form_media_filiacion_insert.addEventListener('submit', (event) => {

							// 	if (!form_media_filiacion_insert.checkValidity()) {
							// 		event.preventDefault();
							// 		event.stopPropagation();
							// 		form_media_filiacion_insert.classList.add('was-validated')
							// 	} else {
							// 		event.preventDefault();
							// 		event.stopPropagation();
							// 		form_media_filiacion_insert.classList.remove('was-validated')

							// 		// console.log(response.ultimoRegistro.PERSONAFISICAID);
							// 		actualizarPersonaMediaAfiliacion(response.ultimoRegistro.PERSONAFISICAID);
							// 	}

							// }, false);
						} else {
							Swal.fire({
								icon: 'error',
								text: 'No se agregó la información de la persona fisica',
								confirmButtonColor: '#bf9b55',
							});
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus);
					}
				});
			}

			function insertarRelacionIDO() {
				const data = {
					'folio': document.querySelector('#input_folio_atencion').value,
					'year': document.querySelector('#year_select').value,
					'victima': document.querySelector('#victima_ofendido').value,
					'delito': document.querySelector('#delito_cometido').value,
					'imputado': document.querySelector('#imputado_arbol').value,
				};
				// console.log(data);
				$.ajax({
					data: data,
					url: "<?= base_url('/data/create-relacion_ido-by-folio') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {

						if (response.status == 3) {
							Swal.fire({
								icon: 'error',
								text: 'Este árbol delicitivo ya existe',
								confirmButtonColor: '#bf9b55',
							});
						}
						if (response.status == 1) {
							let tabla_relacion_fis_fis = document.querySelectorAll('#table-delitos tr');
							tabla_relacion_fis_fis.forEach(row => {
								if (row.id !== '') {
									row.remove();
								}
							});

							llenarTablaFisFis(response.relacionFisFis);
							Swal.fire({
								icon: 'success',
								text: 'Árbol delictual ingresado correctamente',
								confirmButtonColor: '#bf9b55',
							});
							$('#insert_asignar_arbol_delictual_modal').modal('hide');
							document.getElementById("form_asignar_arbol_delictual_insert").reset();


						} else if (response.status == 0) {
							Swal.fire({
								icon: 'error',
								text: 'No se agregó la información de la relacion',
								confirmButtonColor: '#bf9b55',
							});
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus);
					}
				});
			}

			function insertar_impdelito() {
				const data = {
					'folio': document.querySelector('#input_folio_atencion').value,
					'year': document.querySelector('#year_select').value,
					'delito': document.querySelector('#delito_cometido_fisimpdelito').value,
					'imputado': document.querySelector('#imputado_delito_cometido').value,
				};
				$.ajax({
					data: data,
					url: "<?= base_url('/data/create-fisimpdelito-by-folio') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {

						if (response.status == 3) {
							Swal.fire({
								icon: 'error',
								text: 'Este delito ya existe en este folio',
								confirmButtonColor: '#bf9b55',
							});
						}
						if (response.status == 1) {
							let tabla_fisimpdelito = document.querySelectorAll('#table-delito-cometidos tr');
							tabla_fisimpdelito.forEach(row => {
								if (row.id !== '') {
									row.remove();
								}
							});

							llenarTablaImpDel(response.fisicaImpDelito);
							Swal.fire({
								icon: 'success',
								text: 'Relacion IMPUTADO-DELITO ingresado correctamente',
								confirmButtonColor: '#bf9b55',
							});
							$('#insert_asignar_delitos_cometidos_modal').modal('hide');
							document.getElementById("form_delitos_cometidos_insert").reset();

						} else if (response.status == 0) {
							Swal.fire({
								icon: 'error',
								text: 'No se agregó la información de la relacion',
								confirmButtonColor: '#bf9b55',
							});
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus);
					}
				});
			}

			function dateToString(_date) {
				let date = new Date(_date);
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
				return (dateTijuana.toLocaleDateString("es-ES", options)).toUpperCase();
			}
		})();
	};
</script>

<?php include 'video_denuncia_modals/info_folio_modal.php' ?>
<?php include 'video_denuncia_modals/salida_modal.php' ?>
<?php include 'video_denuncia_modals/persona_modal.php' ?>
<?php include 'video_denuncia_modals/relacion_parentesco_modal.php' ?>
<?php include 'video_denuncia_modals/relacion_parentesco_modal_insert.php' ?>
<?php include 'video_denuncia_modals/insert_persona_fisica_modal.php' ?>
<?php include 'video_denuncia_modals/vehiculo_modal.php' ?>
<?php include 'video_denuncia_modals/media_filiacion_modal.php' ?>
<?php include 'video_denuncia_modals/domicilio_modal.php' ?>
<?php include 'video_denuncia_modals/insert_asignar_arbol_delictual_modal.php' ?>
<?php include 'video_denuncia_modals/insert_asignar_delitos_cometidos_modal.php' ?>

<?php $this->endSection() ?>