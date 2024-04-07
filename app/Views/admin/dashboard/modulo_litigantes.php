<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php $session = session(); ?>
<div class="row" id="videoDen">
	<style>
		textarea {
			text-transform: uppercase !important;
		}
	</style>
	<div class="col-12 text-center mb-4 d-none" id="divFolioAtendidoLit" name="divFolioAtendidoLit">
		<h3 class="mb-4 text-center font-weight-bold" id="folio_atendido_lit" name="folio_atendido_lit"></h3>
	</div>

	<div id="card1" class="col-12">
		<div class="card rounded bg-white shadow" style="height: 190px;">
			<div class="card-body p-4">
				<div class="row p-0 m-0">
					<div class="col-12 p-0 m-0">
						<select class="form-control" id="year_select_lit" name="year_select_lit">
							<option disabled value="">Selecciona año del folio ...</option>
							<?php for ($i = date('Y'); $i >= 2020; $i--) { ?>
								<option <?= $i == date('Y') ? 'selected' : null ?> value="<?= $i ?>"><?= $i ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 p-0 m-0">
						<div class="input-group mb-1">
							<input type="text" class="form-control" id="input_folio_atencion_lit" placeholder="No. de folio" value="<?= isset($body_data->folio) ? $body_data->folio : '' ?>">
						</div>
					</div>
				</div>
				<button id="buscar-btn-lit" class="btn btn-secondary btn-block" role="button"><i class="fas fa-search"></i> Buscar</button>
				<button id="buscar-nuevo-btn-lit" class="btn btn-primary btn-block h-100 d-none m-0 p-0" role="button"><i class="fas fa-search"></i> BUSCAR NUEVO</button>
			</div>
		</div>
	</div>

	<div id="card2" class="col-12 col-sm-6 col-md-4 col-lg-4 d-none">
		<div class="card rounded bg-white shadow" style="min-height: 190px;">
			<div class="card-body">
				<label class="font-weight-bold">Delito:</label>
				<input class="form-control" type="text" id="delito_dash_lit">
				<label class="font-weight-bold">Descripción:</label>
				<textarea class="form-control" id="delito_descr_dash_lit"></textarea>
			</div>
		</div>
	</div>
	<div id="card3" class="col-12 col-sm-6 col-md-4 col-lg-4 d-none">
		<div class="card rounded bg-white shadow" style="height: 215px;">
			<div class="card-body">
				<button id="info-folio-btn" class="btn btn-primary btn-block h-100" role="button" data-toggle="modal" data-target="#info_folio_modal"><i class="fas fa-file-alt"></i> INFORMACIÓN DEL CASO</button>
			</div>
		</div>
	</div>
	<div id="card4" class="col-12 col-sm-6 col-md-4 col-lg-4 d-none">
		<div class="card rounded bg-white shadow" style="height: 215px;">
			<div class="card-body">
				<button id="salida-folio-btn" class="btn btn-primary btn-block h-100" role="button" data-toggle="modal" data-target="#salida_modal_litigantes"><i class="fas fa-sign-out-alt"></i> DAR SALIDA</button>
			</div>
		</div>
	</div>

	<div id="card8" class="col-12 col-sm-6 col-md-4 col-lg-3 d-none">
		<div class="card rounded bg-white shadow" style="height: 190px;">
			<div class="card-body">
				<button id="refresh-btn" class="btn btn-primary btn-block h-100" role="button"><i class="fas fa-search"></i> BUSCAR NUEVO</button>
			</div>
		</div>
	</div>

	<div id="card5" class="col-12 col-sm-6 col-md-4 col-lg-4 d-none">
		<div class="card rounded bg-white shadow" style="height: 215px;">
			<div class="card-body">
				<button id="folios-atendidos-btn" class="btn btn-primary btn-block h-50" role="button" data-toggle="modal" data-target="#folios_atendidos_modal"><i class="fas fa-file-alt"></i> FOLIOS DEL DENUNCIANTE</button>
				<button id="enviar_alertas" title="Pulsa este botón en caso de emergencia o folios de suma importancia." class="btn btn-primary btn-block h-50  "><i class="fas fa-exclamation-triangle"></i> ALERTA</button>
			</div>
		</div>
	</div>
	<div id="card6" class="col-12 col-sm-6 col-md-4 col-lg-4 d-none">
		<div class="card rounded bg-white shadow" style="height: 215px;">
			<div class="card-body">
				<a class="btn btn-primary btn-block h-50" target="_blank" href="https://www.diputados.gob.mx/LeyesBiblio/ref/cpf.htm"><i class="fas fa-file-alt"></i>
					Código Penal Federal</a>
				<a class="btn btn-primary btn-block h-50" target="_blank" href="https://www.congresobc.gob.mx/TrabajoLegislativo/Leyes"><i class="fas fa-file-alt"></i> Código Penal Estatal</a>
			</div>
		</div>
	</div>
	<div id="card7" class="col-12 col-sm-6 col-md-4 col-lg-4 d-none">
		<div class="card rounded bg-white shadow" style="height: 215px;">
			<div class="card-body">
				<label class="font-weight-bold h-25" for="notas">Breve descripción del caso:</label>
				<textarea class="form-control h-75 overflow-auto" id="notas_mp" placeholder="Descripción del caso..." rows="10" required maxlength="1000" onkeydown="pulsar(event)" onkeyup="contarCaracteres(this)"></textarea>
				<small id="numCaracter">1000 caracteres restantes</small>
			</div>
		</div>
	</div>
</div>


</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css?v=<?= rand() ?>">
<script>
	$(function() {
		$('[data-toggle="tooltip"]').tooltip()
	})

	//Declaracion de variables globales, se utilizan en diferentes funciones.
	const inputFolio = document.querySelector('#input_folio_atencion_lit');
	var charRemain;
	const inputF = document.getElementById('input_folio_atencion_lit').value;
	const buscar_btn = document.querySelector('#buscar-btn-lit');
	const buscar_nuevo_btn = document.querySelector('#buscar-nuevo-btn-lit');
	const info_folio_btn = document.querySelector('#info-folio-btn');
	const notas_mp = document.querySelector('#notas_mp');
	const year_select = document.querySelector('#year_select_lit');

	const card1 = document.querySelector('#card1');
	const card2 = document.querySelector('#card2');
	const card3 = document.querySelector('#card3');
	const card4 = document.querySelector('#card4');
	const card5 = document.querySelector('#card5');
	const card6 = document.querySelector('#card6');
	const card7 = document.querySelector('#card7');
	const card8 = document.querySelector('#card8');
	const divFolioAtendido = document.querySelector('#divFolioAtendidoLit');

	var respuesta;
	let map, infoWindow;
	let marker = null;
	let current = null;



	//Funcion para retornar cuando se presione la tecla ENTER al mismo tiempo que SHIFT, evitando su comportamiento normal
	function pulsar(e) {
		if (e.which === 13 && !e.shiftKey) {
			e.preventDefault();
			return false;
		}
	}

	//Funcion para contar caracteres restantes de los textarea
	function contarCaracteres(obj) {
		var maxLength = 1000;
		var strLength = obj.value.length;
		charRemain = (maxLength - strLength);

		if (charRemain < 0) {
			document.getElementById("numCaracter").innerHTML = '<span style="color: red;">Has superado el límite de ' +
				maxLength + ' caracteres </span>';
		} else {
			document.getElementById("numCaracter").innerHTML = charRemain + ' caracteres restantes';
		}
	}

	//Funcion para iterar el llenado de tabla de personas fisicas, recibe como parametro todas las personas fisicas
	function llenarTablaPersonas(personas) {
		for (let i = 0; i < personas.length; i++) {
			var btn =
				`<button type='button'  class='btn btn-primary' onclick='viewPersonaFisica(${personas[i].PERSONAFISICAID})'><i class='fas fa-eye'></i></button>`
			var btnDelete =
				`<button type='button'  class='btn btn-primary' onclick='deletePersonaFisicaById(${personas[i].PERSONAFISICAID})'><i class='fas fa-trash'></i></button>`
			var fila =
				`<tr id="row${i}">` +
				`<td class="text-center">${personas[i].DENUNCIANTE=='S'?'<strong>DENUNCIANTE</strong>':''}</td>` +
				`<td class="text-center">${personas[i].NOMBRE}</td>` +
				`<td class="text-center">${personas[i].PERSONACALIDADJURIDICADESCR}</td>` +
				`<td class="text-center">${btn} ${btnDelete}</td>` +
				`</tr>`;

			$('#table-personas tr:first').after(fila);
			$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
			var nFilas = $("#personas tr").length;
			$("#adicionados").append(nFilas - 1);
		}
	}

	//Funcion para iterar el llenado de tabla de personas morales, recibe como parametro todas las personas morales
	function llenarTablaPersonasMorales(personas_morales) {
		var btn =
			`<button type='button'  class='btn btn-primary' onclick='viewPersonaMoral(${personas_morales.PERSONAMORALID})'><i class='fas fa-eye'></i></button>`

		var fila =
			`<tr id="row">` +
			`<td class="text-center">${personas_morales.DENOMINACION}</td>` +
			`<td class="text-center">${personas_morales.MARCACOMERCIAL ? personas_morales.MARCACOMERCIAL : ""}</td>` +
			`<td class="text-center">${personas_morales.NOMBRE} ${personas_morales.APELLIDO_PATERNO} ${personas_morales.APELLIDO_MATERNO}</td>` +
			`<td class="text-center">${btn}</td>` +
			`</tr>`;

		$('#table-morales tr:first').after(fila);
		$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
		var nFilas = $("#personas-morales tr").length;
		$("#adicionados").append(nFilas - 1);

	}
	//Funcion para iterar el llenado de tabla de los folios del mismo denunciante, recibe como parametros todos los folios    

	function llenarTablaFolioDenunciantes(folioDenunciantes) {

		for (let i = 0; i < folioDenunciantes.length; i++) {
			$.ajax({
				data: {
					'folio': folioDenunciantes[i].FOLIOID,
					'year': folioDenunciantes[i].ANO
				},
				url: "<?= base_url('/data/delitos-iterado') ?>",
				method: "POST",
				dataType: "json",
				success: function(response) {
					let delito_descr = '';
					for (let index = 0; index < response.length; index++) {
						if (index == response.length - 1) {
							delito_descr += response[index].DELITOMODALIDADDESCR + '.';
						}
						if (index != response.length - 1) {
							delito_descr += response[index].DELITOMODALIDADDESCR + ',';

						}
					}
					var btn =

						`<button type='button'  class='btn btn-primary' onclick='viewFoliosDenunciantes(${folioDenunciantes[i].FOLIOID}, ${folioDenunciantes[i].ANO})'><i class='fas fa-eye'></i></button>`
					var fila =
						`<tr id="row${i}">` +
						`<td class="text-center">${folioDenunciantes[i].FOLIOID}</td>` +
						`<td class="text-center">${folioDenunciantes[i].ANO}</td>` +
						`<td class="text-center">${folioDenunciantes[i].EXPEDIENTEID ? folioDenunciantes[i].EXPEDIENTEID: ''}</td>` +
						`<td class="text-center">${folioDenunciantes[i].HECHODELITO ? folioDenunciantes[i].HECHODELITO : 'NO SELECCIONÓ NINGÚN DELITO'}</td>` +
						`<td class="text-center">${delito_descr ?delito_descr:''}</td>` +
						`<td class="text-center">${btn}</td>` +
						`</tr>`;


					$('#table-folios-atendidos tr:first').after(fila);
					$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
					var nFilas = $("#folios-atendidos tr").length;
					$("#adicionados").append(nFilas - 1);
				}
			});

		}
	}

	//Funcion para redirigir a remitir el folio
	function remitir() {
		window.location.href = `<?= base_url('/admin/dashboard/bandeja_remision?folio=') ?>${inputFolio.value}&year=${year_select.value}&municipioasignado=${input_municipio.value}&expediente=${inputExpediente.value}`;
	}
	//Funcion para visualizar la relacion de parentesco, recibe como parametro la persona fisica 1
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
				//  if (relacion_parentesco) {
				//Se asignan los valores del parentesco
				document.querySelector('#parentesco_mf').value = parentesco.PERSONAPARENTESCOID ? parentesco
					.PERSONAPARENTESCOID : '';
				document.querySelector('#personaFisica1').value = relacion_parentesco.PERSONAFISICAID1 ?
					relacion_parentesco.PERSONAFISICAID1 : '';
				document.querySelector('#personaFisica2').value = relacion_parentesco.PERSONAFISICAID2 ?
					relacion_parentesco.PERSONAFISICAID2 : '';
				document.getElementById("updateParentesco").style.display = "block";


				// } 
				// if(relacion_parentesco == null) {
				//  document.querySelector('#parentesco_mf').value = '';
				//  document.querySelector('#personaFisica1').value = '';
				//  document.querySelector('#personaFisica2').value = idPersonaFisica ? idPersonaFisica : '';
				//  document.getElementById("insertParentesco").style.display="block";
				//  document.getElementById("updateParentesco").style.display="none";

				// }
				$('#relacion_parentesco_modal').modal('show');
			},
			error: function(jqXHR, textStatus, errorThrown) {}
		});
	}
	//Funcion para eliminar el parentesco, se tiene que recibir por parametro la persona fisica1, personafisica2 y el parentesco a eliminar

	function eliminarparentesco(personofisica1, personafisica2, parentesco) {
		$.ajax({
			data: {
				'personafisica1': personofisica1,
				'personafisica2': personafisica2,
				'parentesco_mf': parentesco,
				'folio': inputFolio.value,
				'year': year_select.value,

			},
			url: "<?= base_url('/data/delete-parentesco-by-id') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				if (response.status == 1) {
					Swal.fire({
						icon: 'success',
						text: 'Relación parentesco eliminado correctamente',
						confirmButtonColor: '#bf9b55',
					});
					let tabla_parentesco = document.querySelectorAll('#table-parentesco tr');
					tabla_parentesco.forEach(row => {
						if (row.id !== '') {
							row.remove();
						}
					});
					llenarTablaParentesco(response.parentescoRelacion);

				} else {
					Swal.fire({
						icon: 'error',
						text: 'No se eliminó la relación parentesco correctamente',
						confirmButtonColor: '#bf9b55',
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {}
		});

	}

	//Funcion para actualizar el documento, recibe el placeholder actualizado
	function actualizarDocumento(placeholder) {

		const data = {
			'folio': document.querySelector('#input_folio_atencion_lit').value,
			'year': document.querySelector('#year_select_lit').value,
			'foliodocid': document.querySelector('#docid').value,
			'placeholder': placeholder
		};
		$.ajax({
			data: data,
			url: "<?= base_url('/data/update-documento-by-id') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				if (response.status == 1) {
					const documentos = response.documentos;
					//llena la tabla de documentos
					let tabla_documentos = document.querySelectorAll('#table-documentos tr');
					tabla_documentos.forEach(row => {
						if (row.id !== '') {
							row.remove();
						}
					});
					llenarTablaDocumentos(documentos);


					Swal.fire({
						icon: 'success',
						text: 'Documento actualizado correctamente',
						confirmButtonColor: '#bf9b55',
					});
					$('#documentos_modal_editar').modal('hide');
				} else {
					Swal.fire({
						icon: 'error',
						text: 'No se actualizó el documento',
						confirmButtonColor: '#bf9b55',
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus);
			}
		});

	}
	//Funcion para iterar el llenado de tabla de la relacion de parentescos, recibe como parametro toda la informacion de la relacion de parentescos
	function llenarTablaParentesco(relacion_parentesco) {

		for (let i = 0; i < relacion_parentesco.length; i++) {
			var btn =
				`<button type='button'  class='btn btn-primary' onclick='view_form_parentesco(${relacion_parentesco[i].IDP1})'><i class="fas fa-eye"></i></button>`
			var btnEliminar =
				`<button type='button'  class='btn btn-primary' onclick='eliminarparentesco(${relacion_parentesco[i].IDP1},${relacion_parentesco[i].IDP2},${relacion_parentesco[i].PARENTESCOID})'><i class="fas fa-trash"></i></button>`


			var fila2 =
				`<tr id="row${i}">` +
				`<td class="text-center">${relacion_parentesco[i].NOMBREP1}</td>` +
				`<td class="text-center">${relacion_parentesco[i].PERSONAPARENTESCODESCR}</td>` +
				`<td class="text-center">${relacion_parentesco[i].NOMBREP2}</td>` +
				`<td class="text-center">${btn}</td>` +
				`<td class="text-center">${btnEliminar}</td>` +

				`</tr>`;

			$('#table-parentesco tr:first').after(fila2);
			$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
			var nFilas = $("#parentesco tr").length;
			$("#adicionados").append(nFilas - 1);

		}
	}
	//Funcion para iterar el llenado de tabla de arbol delitivo, recibe como parametro toda la informacion del arbol delictivo

	function llenarTablaFisFis(relacionFisFis) {
		for (let i = 0; i < relacionFisFis.length; i++) {
			let tipo = relacionFisFis[i].PERSONAFISICAIDVICTIMA ? 0 : 1;
			var btn =
				`<button type='button' class='btn btn-primary' onclick='eliminarArbolDelictivo(${relacionFisFis[i].PERSONAFISICAIDVICTIMA ? relacionFisFis[i].PERSONAFISICAIDVICTIMA : relacionFisFis[i].PERSONAMORALIDVICTIMA}, ${relacionFisFis[i].PERSONAFISICAIDIMPUTADO}, ${relacionFisFis[i].DELITOMODALIDADID},${tipo})'><i class='fa fa-trash'></i></button>`
			var fila =
				`<tr id="row${i}">` +
				`<td class="text-center">${relacionFisFis[i].NOMBREI}</td>` +
				`<td class="text-center">${relacionFisFis[i].DELITOMODALIDADDESCR}</td>` +
				`<td class="text-center">${relacionFisFis[i].NOMBREV}</td>` +
				`<td class="text-center">${btn}</td>` +
				`</tr>`;

			$('#table-delitos-videodenuncia tr:first').after(fila);
			$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
			var nFilas = $("#delitos tr").length;
			$("#adicionados").append(nFilas - 1);
		}
	}

	//Funcion para eliminar el delito del imputado, recibe como parametro la victima, imputado y el id del delito
	function eliminarImputadoDelito(personafisicavictima, personafisicaimputado, delitoModalidadId) {
		$.ajax({
			data: {
				'personafisicavictima': personafisicavictima,
				'personafisicaimputado': personafisicaimputado,
				'delito': delitoModalidadId,
				'folio': inputFolio.value,
				'year': year_select.value,

			},
			url: "<?= base_url('/data/delete-fisimpdelito-by-folio') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {

				if (response.status == 1) {
					//Se llenan las tablas
					Swal.fire({
						icon: 'success',
						text: 'Delito del imputado y árbol delicitivo eliminado correctamente',
						confirmButtonColor: '#bf9b55',
					});
					let tabla_impdelito = document.querySelectorAll('#table-delito-cometidos tr');
					tabla_impdelito.forEach(row => {
						if (row.id !== '') {
							row.remove();
						}
					});
					let fisicaImpDelito = response.fisicaImpDelito;
					llenarTablaImpDel(fisicaImpDelito);
					let tabla_arbol = document.querySelectorAll('#table-delitos-videodenuncia tr');
					tabla_arbol.forEach(row => {
						if (row.id !== '') {
							row.remove();
						}
					});
					let relacionFisFis = response.relacionFisFis;
					llenarTablaFisFis(relacionFisFis);
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

	//Funcion para eliminar la relacion del arbol delictivo, recibe como parametro el imputado, victima y el id del delito
	function eliminarArbolDelictivo(personafisicavictima, personafisicaimputado, delitoModalidadId, tipo) {
		$.ajax({
			data: {
				'personafisicavictima': personafisicavictima,
				'personafisicaimputado': personafisicaimputado,
				'delito': delitoModalidadId,
				'folio': inputFolio.value,
				'year': year_select.value,
				'tipo': tipo,

			},
			url: "<?= base_url('/data/delete-arbol_delictivo-by-folio') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				if (response.status == 3) {
					//Validaccion de ultimo registro
					Swal.fire({
						title: 'Este es el ultimo registro, se eliminará el delito cometido de la denuncia',
						showDenyButton: true,
						showCancelButton: true,
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#bf9b55',
						denyButtonText: 'Cancelar',
					}).then((result) => {
						/* Read more about isConfirmed, isDenied below */
						if (result.isConfirmed) {
							eliminarImputadoDelito(personafisicavictima, personafisicaimputado,
								delitoModalidadId);
						}
					})
				}

				if (response.status == 1) {
					//Cuando el imputado tiene mas de 1 delito
					Swal.fire({
						icon: 'success',
						text: 'Árbol delictivo eliminado correctamente',
						confirmButtonColor: '#bf9b55',
					});
					let tabla_arbol = document.querySelectorAll('#table-delitos-videodenuncia tr');
					tabla_arbol.forEach(row => {
						if (row.id !== '') {
							row.remove();
						}
					});
					let relacionFisFis = response.relacionFisFis;
					llenarTablaFisFis(relacionFisFis);
					let tabla_impdelito = document.querySelectorAll('#table-delito-cometidos tr');
					tabla_impdelito.forEach(row => {
						if (row.id !== '') {
							row.remove();
						}
					});
					let fisicaImpDelito = response.fisicaImpDelito;
					llenarTablaImpDel(fisicaImpDelito);
				} else if (response.status == 0) {
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

	//Funcion para eliminar los objetos involucrados, recibe por parametro el id del objeto
	function eliminarObjetosInvolucrados(objetoid) {
		$.ajax({
			data: {
				'objetoid': objetoid,
				'folio': inputFolio.value,
				'year': year_select.value,

			},
			url: "<?= base_url('/data/delete-objeto-involucrado-by-folio') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {

				if (response.status == 1) {
					//Se llena la tabla de objetos
					Swal.fire({
						icon: 'success',
						text: 'Objeto involucrado eliminado correctamente',
						confirmButtonColor: '#bf9b55',
					});
					let tabla_objetos_involucrados = document.querySelectorAll(
						'#table-objetos-involucrados tr');
					tabla_objetos_involucrados.forEach(row => {
						if (row.id !== '') {
							row.remove();
						}
					});

					llenarTablaObjetosInvolucrados(response.objetos);
				} else {
					Swal.fire({
						icon: 'error',
						text: 'No se elimino el objeto involucrado',
						confirmButtonColor: '#bf9b55',
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {}
		});

	}

	// Funcion para visualizar la informacion del objeto involucrado, recibe por parametro el id del objeto
	function viewObjetoInvolucrado(objetoid) {
		$('#folio_objetos_update').modal('show');
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
				// Se llenan los valores
				document.querySelector('#objeto_id').value = objeto.OBJETOID ? objeto.OBJETOID : '';
				document.querySelector('#situacion_objeto_update').value = objeto.SITUACION ? objeto.SITUACION :
					'';
				document.querySelector('#objeto_update_clasificacion').value = objeto.CLASIFICACIONID ? objeto
					.CLASIFICACIONID : '';
				// document.querySelector('#objeto_update_subclasificacion').value = objeto_sub.OBJETOSUBCLASIFICACIONID ? objeto_sub.OBJETOSUBCLASIFICACIONID : '';
				$('#objeto_update_subclasificacion').empty();
				let select_objeto_update_subclasificacion = document.querySelector(
					"#objeto_update_subclasificacion");

				objeto_sub.forEach(objeto_sub => {
					const option = document.createElement('option');
					option.value = objeto_sub.SUBCLASIFICACIONID;
					option.text = objeto_sub.OBJETOSUBCLASIFICACIONDESCR;
					select_objeto_update_subclasificacion.add(option, null);
				});

				document.querySelector('#marca_objeto_update').value = objeto.MARCA ? objeto.MARCA : '';
				document.querySelector('#serie_objeto_update').value = objeto.NUMEROSERIE ? objeto.NUMEROSERIE :
					'';
				document.querySelector('#cantidad_objeto_update').value = objeto.CANTIDAD ? objeto.CANTIDAD :
					'';
				document.querySelector('#valor_objeto_update').value = objeto.VALOR ? objeto.VALOR : '';
				document.querySelector('#tipo_moneda_update').value = objeto.TIPOMONEDAID ? objeto
					.TIPOMONEDAID : '';
				document.querySelector('#descripcion_detallada_update').value = objeto.DESCRIPCIONDETALLADA ?
					objeto.DESCRIPCIONDETALLADA : '';
				document.querySelector('#propietario_update').value = objeto.PERSONAFISICAIDPROPIETARIO ? objeto
					.PERSONAFISICAIDPROPIETARIO : objeto.PERSONAMORALIDPROPIETARIO + " MORAL";
				document.querySelector('#participa_estado_objeto_update').value = objeto.PARTICIPAESTADO ?
					objeto.PARTICIPAESTADO : '';

			}
		});
	}

	//Funcion para iterar la tabla de relacion de imputado-delito, recibe la informacion de esta relacion
	function llenarTablaImpDel(impDelito) {
		for (let i = 0; i < impDelito.length; i++) {
			// var btn = `<button type='button'  class='btn btn-primary' onclick='eliminarImputadoDelito(${impDelito[i].PERSONAFISICAID},${impDelito[i].DELITOMODALIDADID})'><i class='fa fa-trash'></i></button>`

			var fila =
				`<tr id="row${i}">` +
				`<td class="text-center" value="${impDelito[i].PERSONAFISICAID}">${impDelito[i].NOMBRE}</td>` +
				`<td class="text-center" value="${impDelito[i].DELITOMODALIDADID}">${impDelito[i].DELITOMODALIDADDESCR}</td>` +
				// `<td class="text-center">${btn}</td>` +
				`</tr>`;

			$('#table-delito-cometidos tr:first').after(fila);
			$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
			var nFilas = $("#delito-cometidos tr").length;
			$("#adicionados").append(nFilas - 1);
		}
	}

	//Funcion para iterar la tabla de objetos involucrados, recibe por parametro la informacion de los objetos
	function llenarTablaObjetosInvolucrados(objetos) {
		for (let i = 0; i < objetos.length; i++) {
			var btnEliminar =
				`<button type='button'  class='btn btn-primary' onclick='eliminarObjetosInvolucrados(${objetos[i].OBJETOID})'><i class='fa fa-trash'></i></button>`
			var btnEditar =
				`<button type='button'  class='btn btn-primary' onclick='viewObjetoInvolucrado(${objetos[i].OBJETOID})'><i class='fa fa-eye'></i></button>`

			var fila =
				`<tr id="row${i}">` +
				`<td class="text-center" value="${objetos[i].CLASIFICACIONID}">${objetos[i].OBJETOCLASIFICACIONDESCR}</td>` +
				`<td class="text-center" value="${objetos[i].SUBCLASIFICACIONID}">${objetos[i].OBJETOSUBCLASIFICACIONDESCR}</td>` +
				`<td class="text-center">${btnEliminar}</td>` +
				`<td class="text-center">${btnEditar}</td>` +
				`</tr>`;

			$('#table-objetos-involucrados tr:first').after(fila);
			$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
			var nFilas = $("#objetos-involucrados tr").length;
			$("#adicionados").append(nFilas - 1);
		}
	}
	//Funcion para iterar la tabla de archivos externos, recibe por parametro la informacion de los archivos

	function llenarTablaArchivosExternos(archivos) {
		for (let i = 0; i < archivos.length; i++) {

			if (archivos[i].EXTENSION == 'pdf') {
				var img = `<a id="downloadArchivo" download=""><img src='<?= base_url() ?>/assets/img/file.png'));'  width="50px" height="50px"></img></a>`;
				// var frame = `<iframe src='${archivos[i].ARCHIVO}' width="100%" height="500px" frameborder="0"></iframe>`;
				var frame = `<a href="#" onclick="abrirPrevisualizador('${archivos[i].ARCHIVO}')">Abrir Previsualizador</a>`;

			} else if (archivos[i].EXTENSION == 'doc' || archivos[i].EXTENSION == 'docx') {
				var img = `<a id="downloadArchivo" download=""><img src='<?= base_url() ?>/assets/img/file.png'));'  width="50px" height="50px"></img></a>`;
				var frame = `<div id="docxViewer">No se puede visualizar este archivo, descargalo</div>`;

			} else {
				var img = `<a id="downloadArchivo" download=""><img src='${archivos[i].ARCHIVO}');' width="50px" height="50px"></img></a>`;
				var frame = "";

			}
			var btnEliminarArchivo =
				`<button type='button' id="deleteArchivobtn" class='btn btn-primary' onclick='deleteArchivo(${archivos[i].FOLIOARCHIVOID})'><i class='fas fa-trash'></i></button>`;
			var btnDescargar = `<a id="descargar_documento" class="btn btn-primary" download=""><i class='fas fa-download'></i></a>`

			var fila =
				`<tr id="row${i}">` +
				`<td class="text-center" value="${archivos[i].FOLIOARCHIVOID}">${archivos[i].ARCHIVODESCR}</td>` +
				`<td class="text-center" value="${archivos[i].FOLIOARCHIVOID}">${img}</td>` +
				`<td class="text-center" value="${archivos[i].FOLIOARCHIVOID}">${frame}</td>` +

				`<td class="text-center">${btnEliminarArchivo} ${btnDescargar}</td>` +

				`</tr>`;

			$('#table-archivos tr:first').after(fila);
			$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
			var nFilas = $("#archivos tr").length;
			$("#adicionados").append(nFilas - 1);

			///Funcion de descarga de archivos
			document.querySelector('#downloadArchivo').setAttribute('href', archivos[i].ARCHIVO);
			document.querySelector('#downloadArchivo').setAttribute('download', archivos[i].FOLIOID + '_' +
				archivos[i].ANO + '_' + archivos[i].FOLIOARCHIVOID + '.' + archivos[i].EXTENSION);
			document.querySelector('#descargar_documento').setAttribute('href', archivos[i].ARCHIVO);
			document.querySelector('#descargar_documento').setAttribute('download', archivos[i].FOLIOID + '_' +
				archivos[i].ANO + '_' + archivos[i].FOLIOARCHIVOID + '.' + archivos[i].EXTENSION);
		}
	}
	/**Funcion para abrir el archivo pdf en otra pestaña */
	function abrirPrevisualizador(url) {
		let url_sin = url.replace("data:application/pdf;base64,", "");
		//decodifica el base 64 y lo convierte en string
		const binaryData = atob(url_sin);
		//longitud del string
		const arrayBuffer = new ArrayBuffer(binaryData.length);
		//trata cada byte del ArrayBuffer como un número separado
		const uint8Array = new Uint8Array(arrayBuffer);

		for (let i = 0; i < binaryData.length; i++) {
			uint8Array[i] = binaryData.charCodeAt(i);
		}

		//Se construye el PDF
		const blob = new Blob([uint8Array], {
			type: 'application/pdf'
		});

		// Crea el link y lo abre en nueva pestaña
		const link = document.createElement('a');
		link.href = URL.createObjectURL(blob);
		link.target = "_blank"
		link.click();
	}
	//Funcion para iterar la tabla de vehiculos, recibe por parametro la informacion de los vehiculos

	function llenarTablaVehiculos(vehiculos) {
		for (let i = 0; i < vehiculos.length; i++) {
			var btnVehiculo =
				`<button type='button' class='btn btn-primary' onclick='viewVehiculo(${vehiculos[i].VEHICULOID})'><i class='fas fa-eye'></i></button>`;
			var btnEliminarVehiculo =
				`<button type='button' class='btn btn-primary' onclick='deleteVehiculo(${vehiculos[i].VEHICULOID})'><i class='fas fa-trash'></i></button>`;
			var fila3 =
				`<tr id="row${i}">` +
				`<td class="text-center">${vehiculos[i].PLACAS?vehiculos[i].PLACAS:'DESCONOCIDO'}</td>` +
				`<td class="text-center">${vehiculos[i].NUMEROSERIE?vehiculos[i].NUMEROSERIE:'DESCONOCIDO'}</td>` +
				`<td class="text-center">${btnVehiculo} ${btnEliminarVehiculo}</td>` +
				`</tr>`;

			$('#table-vehiculos tr:first').after(fila3);
			$("#adicionados").text("");
			var nFilas = $("#vehiculos tr").length;
			$("#vehiculos").append(nFilas - 1);
		}
	}

	//Evento al buscar un folio
	buscar_btn.addEventListener('click', (e) => {
		//Limpia todos los valores en caso de que hayan quedado
		borrarTodoConFolio();
		$.ajax({
			data: {
				'folio': inputFolio.value,
				'year': year_select.value
			},
			url: "<?= base_url('/data/get-folio-information-litigantes') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				respuesta = response;
				document.getElementById("form_parentesco_insert").reset();
				if (response.status === 1) {
					//respuestas de la funcion
					const folio = response.folio;
					const preguntas = response.respuesta.preguntas_iniciales;
					const personas = response.respuesta.personas;
					const personas_morales = response.respuesta.personas_morales;
					const domicilios = response.respuesta.domicilios;
					const vehiculos = response.respuesta.vehiculos;
					const relacion_parentesco = response.respuesta.parentescoRelacion;
					const relacionFisFis = response.respuesta.relacionFisFis;
					const fisicaImpDelito = response.respuesta.fisicaImpDelito;
					const delitosModalidadFiltro = response.respuesta.delitosModalidadFiltro;
					const personafisica = response.respuesta.personafisica;
					const imputados = response.respuesta.imputados;
					const victimas = response.respuesta.victimas;
					const objetos = response.respuesta.objetos;
					const documentos = response.respuesta.documentos;
					const correos = response.respuesta.correos;
					const archivos = response.respuesta.archivosexternos;
					const folioDenunciantes = response.respuesta.folioDenunciantes;
					const personasPropietarios = response.respuesta.personasPropietarios;
					const poderes = response.respuesta.poderes;


					//Cambios de estilos
					inputFolio.classList.add('d-none');
					buscar_btn.classList.add('d-none');
					year_select.classList.add('d-none');
					buscar_nuevo_btn.classList.remove('d-none');

					card2.classList.remove('d-none');
					card3.classList.remove('d-none');
					card4.classList.remove('d-none');
					card5.classList.remove('d-none');
					card6.classList.remove('d-none');
					card7.classList.remove('d-none');

					divFolioAtendido.classList.remove('d-none');
					document.querySelector('#folio_atendido_lit').innerHTML = 'FOLIO ATENDIDO: ' + folio.FOLIOID + '/' + folio.ANO;

					document.querySelector('#delito_dash_lit').value = folio.HECHODELITO;
					document.querySelector('#delito_descr_dash_lit').value = folio.HECHONARRACION;
					const option_vacio_vm = document.createElement('option');
					option_vacio_vm.value = '';
					option_vacio_vm.text = 'Selecciona ...';
					option_vacio_vm.disabled = true;
					option_vacio_vm.selected = true;
					const option_vacio_im = document.createElement('option');
					option_vacio_im.value = '';
					option_vacio_im.text = 'Selecciona ...';
					option_vacio_im.disabled = true;
					option_vacio_im.selected = true;
					if (victimas || imputados || correos || personas) {
						//Siempre se limpian los selects, se declaran, y se llenan con la respuesta correspondiente
						$('#victima_ofendido').empty();
						const option_vacio_vic = document.createElement('option');
						option_vacio_vic.value = '';
						option_vacio_vic.text = 'Selecciona ...';
						option_vacio_vic.disabled = true;
						option_vacio_vic.selected = true;

						let select_victima_ofendido = document.querySelector("#victima_ofendido");
						select_victima_ofendido.add(option_vacio_vic, null);
						victimas.forEach(victima => {
							let primer_apellido = victima.PRIMERAPELLIDO ? victima
								.PRIMERAPELLIDO : '';

							const option = document.createElement('option');
							option.value = victima.PERSONAFISICAID ? victima.PERSONAFISICAID : victima.PERSONAMORALID + ' MORAL';
							option.text = victima.NOMBRE ? victima.NOMBRE + ' ' + primer_apellido + ' | ' + victima.PFCJDESCR : victima.DENOMINACION + ' | ' + victima.PMCJDESCR;
							select_victima_ofendido.add(option, null);
						});

						$('#imputado_delito_cometido').empty();
						let select_imputado_delito_cometido = document.querySelector(
							"#imputado_delito_cometido");
						imputados.forEach(imputado => {
							let primer_apellido = imputado.PRIMERAPELLIDO ? imputado
								.PRIMERAPELLIDO : '';

							const option = document.createElement('option');
							option.value = imputado.PERSONAFISICAID;
							option.text = imputado.NOMBRE + ' ' + primer_apellido;
							select_imputado_delito_cometido.add(option, null);
						});
						$('#imputado_arbol').empty();
						const option_vacio_imp = document.createElement('option');
						option_vacio_imp.value = '';
						option_vacio_imp.text = 'Selecciona ...';
						option_vacio_imp.disabled = true;
						option_vacio_imp.selected = true;

						let select_imputado_mputado = document.querySelector("#imputado_arbol");
						select_imputado_mputado.add(option_vacio_imp, null);
						imputados.forEach(imputado => {
							let primer_apellido = imputado.PRIMERAPELLIDO ? imputado
								.PRIMERAPELLIDO : '';

							const option = document.createElement('option');
							option.value = imputado.PERSONAFISICAID;
							option.text = imputado.NOMBRE + ' ' + primer_apellido;
							select_imputado_mputado.add(option, null);
						});

						$('#personaFisica1_I').empty();
						const option_vacio = document.createElement('option');
						option_vacio.value = '';
						option_vacio.text = '';
						option_vacio.disabled = true;
						option_vacio.selected = true;
						let select_personaFisica1_I = document.querySelector("#personaFisica1_I");
						select_personaFisica1_I.add(option_vacio, null);
						personas.forEach(persona => {
							let primer_apellido = persona.PRIMERAPELLIDO ? persona
								.PRIMERAPELLIDO : '';

							const option = document.createElement('option');
							option.value = persona.PERSONAFISICAID;
							option.text = persona.NOMBRE + ' ' + primer_apellido;
							select_personaFisica1_I.add(option, null);
						});
						$('#personaFisica1').empty();
						let select_personaFisica1 = document.querySelector("#personaFisica1")
						const option_vacio_p = document.createElement('option');
						option_vacio_p.value = '';
						option_vacio_p.text = 'Selecciona ...';
						option_vacio_p.disabled = true;
						option_vacio_p.selected = true;
						select_personaFisica1.add(option_vacio_p, null);
						personas.forEach(persona => {
							let primer_apellido = persona.PRIMERAPELLIDO ? persona
								.PRIMERAPELLIDO : '';

							const option = document.createElement('option');
							option.value = persona.PERSONAFISICAID;
							option.text = persona.NOMBRE + ' ' + primer_apellido;
							select_personaFisica1.add(option, null);
						});
						$('#personaFisica2').empty();
						let select_personaFisica2 = document.querySelector("#personaFisica2")
						const option_vacio_pe2 = document.createElement('option');
						option_vacio_pe2.value = '';
						option_vacio_pe2.text = 'Selecciona ...';
						option_vacio_pe2.disabled = true;
						option_vacio_pe2.selected = true;
						select_personaFisica2.add(option_vacio_pe2, null);
						personas.forEach(persona => {
							let primer_apellido = persona.PRIMERAPELLIDO ? persona
								.PRIMERAPELLIDO : '';

							const option = document.createElement('option');
							option.value = persona.PERSONAFISICAID;
							option.text = persona.NOMBRE + ' ' + primer_apellido;
							select_personaFisica2.add(option, null);
						});
						$('#propietario').empty();
						let select_propietario = document.querySelector("#propietario");
						const option_vacio_prop = document.createElement('option');
						option_vacio_prop.value = '';
						option_vacio_prop.text = 'Selecciona ...';
						option_vacio_prop.disabled = true;
						option_vacio_prop.selected = true;

						select_propietario.add(option_vacio_prop, null);
						personasPropietarios.forEach(persona => {
							let primer_apellido = persona.PRIMERAPELLIDO ? persona
								.PRIMERAPELLIDO : '';

							const option = document.createElement('option');
							option.value = persona.PERSONAFISICAID ? persona.PERSONAFISICAID : persona.PERSONAMORALID + ' MORAL';
							option.text = persona.NOMBRE ? persona.NOMBRE + ' ' + primer_apellido : persona.DENOMINACION;
							select_propietario.add(option, null);
						});
						$('#propietario_vehiculo').empty();
						let select_propietario_prop_v = document.querySelector("#propietario_vehiculo");
						const option_vacio_prop_v = document.createElement('option');
						option_vacio_prop_v.value = '';
						option_vacio_prop_v.text = '';
						option_vacio_prop_v.disabled = true;
						option_vacio_prop_v.selected = true;

						select_propietario_prop_v.add(option_vacio_prop_v, null);
						personasPropietarios.forEach(persona => {
							let primer_apellido = persona.PRIMERAPELLIDO ? persona
								.PRIMERAPELLIDO : '';

							const option = document.createElement('option');
							option.value = persona.PERSONAFISICAID ? persona.PERSONAFISICAID : persona.PERSONAMORALID + ' MORAL';
							option.text = persona.NOMBRE ? persona.NOMBRE + ' ' + primer_apellido : persona.DENOMINACION;
							select_propietario_prop_v.add(option, null);
						});
						$('#propietario_vehiculo_add').empty();
						let select_propietario_prop_v_add = document.querySelector("#propietario_vehiculo_add");
						const option_vacio_prop_v_add = document.createElement('option');
						option_vacio_prop_v_add.value = '';
						option_vacio_prop_v_add.text = '';
						option_vacio_prop_v_add.disabled = true;
						option_vacio_prop_v_add.selected = true;

						select_propietario_prop_v_add.add(option_vacio_prop_v_add, null);
						personasPropietarios.forEach(persona => {
							let primer_apellido = persona.PRIMERAPELLIDO ? persona
								.PRIMERAPELLIDO : '';

							const option = document.createElement('option');
							option.value = persona.PERSONAFISICAID ? persona.PERSONAFISICAID : persona.PERSONAMORALID + ' MORAL';
							option.text = persona.NOMBRE ? persona.NOMBRE + ' ' + primer_apellido : persona.DENOMINACION;
							select_propietario_prop_v_add.add(option, null);
						});
						$('#propietario_update').empty();
						let select_propietario_update = document.querySelector("#propietario_update");
						select_propietario_update.add(option_vacio, null);
						personasPropietarios.forEach(persona => {
							let primer_apellido = persona.PRIMERAPELLIDO ? persona
								.PRIMERAPELLIDO : '';

							const option = document.createElement('option');
							option.value = persona.PERSONAFISICAID ? persona.PERSONAFISICAID : persona.PERSONAMORALID + ' MORAL';
							option.text = persona.NOMBRE ? persona.NOMBRE + ' ' + primer_apellido : persona.DENOMINACION;
							select_propietario_update.add(option, null);
						});
						$('#objeto_update_subclasificacion').empty();
						let select_objeto_update_subclasificacion = document.querySelector(
							"#objeto_update_subclasificacion");
						select_objeto_update_subclasificacion.add(option_vacio, null);
						objetos.forEach(objetos => {
							const option = document.createElement('option');
							option.value = objetos.SUBCLASIFICACIONID;
							option.text = objetos.OBJETOSUBCLASIFICACIONDESCR;
							select_objeto_update_subclasificacion.add(option, null);
						});
					}
					//DENUNCIA
					document.querySelector('#delito_delito').value = folio.HECHODELITO;
					document.querySelector('#municipio_delito').value = folio.HECHOMUNICIPIOID ? folio.HECHOMUNICIPIOID : '';

					//Coordenadas del mapa
					let mapa_denuncia = document.querySelector('#map_denuncia');
					mapa_denuncia.style.width = '100%';
					mapa_denuncia.style.height = '400px';
					if (folio.HECHOCOORDENADAX != null && folio.HECHOCOORDENADAY != null) {
						initMap(folio.HECHOCOORDENADAY, folio.HECHOCOORDENADAX);
					} else {
						initMap(32.521036, -117.015543)
					}
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
								let select_localidad = document.querySelector(
									'#localidad_delito');

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

					if (folio.HECHOCOLONIAID && folio.HECHOCOLONIAID != '0') {
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
								let select_colonia = document.querySelector(
									'#colonia_delito_select');
								let input_colonia = document.querySelector(
									'#colonia_delito');
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
					} else if (folio.HECHOCOLONIAID == '0') {
						document.querySelector('#colonia_delito').classList.remove('d-none');
						document.querySelector('#colonia_delito_select').classList.add('d-none');
						var option = document.createElement("option");
						option.text = 'OTRO';
						option.value = '0';
						document.querySelector('#colonia_delito_select').add(option);
						document.querySelector('#colonia_delito_select').value = '0';
						document.querySelector('#colonia_delito').value = folio.HECHOCOLONIADESCR;
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
					document.querySelector('#calle_delito').value = folio.HECHOCALLE ? folio.HECHOCALLE : '';
					document.querySelector('#exterior_delito').value = folio.HECHONUMEROCASA ? folio.HECHONUMEROCASA : '';
					document.querySelector('#interior_delito').value = folio.HECHONUMEROCASAINT ? folio.HECHONUMEROCASAINT : '';
					document.querySelector('#lugar_delito').value = folio.HECHOLUGARID ? folio.HECHOLUGARID : '';
					document.querySelector('#hora_delito').value = folio.HECHOHORA ? folio.HECHOHORA : '';
					document.querySelector('#fecha_delito').value = folio.HECHOFECHA ? folio.HECHOFECHA : '';
					document.querySelector('#narracion_delito').value = folio.HECHONARRACION ? folio.HECHONARRACION : '';
					document.querySelector('#autorizaFoto').value = folio.LOCALIZACIONPERSONAMEDIOS == 'S' ?
						'S' : 'N';
					// if (folio.HECHODELITO == "ROBO DE VEHÍCULO") {
					//  $('#v-pills-vehiculos-tab').css('display', 'block');
					// } else {
					//  $('#v-pills-vehiculos-tab').css('display', 'NONE');
					// }
					//PERSONAS  
					if (personas)
						llenarTablaPersonas(personas);
					//PERSONAS MORALES
					if (personas_morales) llenarTablaPersonasMorales(personas_morales);
					//VEHICULOS
					if (vehiculos) llenarTablaVehiculos(vehiculos);
					//PARENTESCO
					if (relacion_parentesco) llenarTablaParentesco(relacion_parentesco);

					//ARBOL DELICTUAL
					if (relacionFisFis) llenarTablaFisFis(relacionFisFis);

					//DELITOS COMETIDOS
					if (fisicaImpDelito) llenarTablaImpDel(fisicaImpDelito);

					//OBJETOS INVOLUCRADOS
					if (objetos) llenarTablaObjetosInvolucrados(objetos);

					//ARCHIVOS EXTERNOS
					if (archivos) llenarTablaArchivosExternos(archivos);

					//FOLIO DENUNCIANTES
					if (folioDenunciantes) llenarTablaFolioDenunciantes(folioDenunciantes);

					$('#lugar_delito').trigger('change');

				} else if (response.status === 2) {
					Swal.fire({
						icon: 'error',
						html: response.motivo + '<strong>' + response.agente + '</strong>',
						confirmButtonColor: '#bf9b55',
					});
				} else if(response.status==3) {
					Swal.fire({
						icon: 'error',
						text: 'El folio tiene pendiente subir la denuncia por escrito.',
						confirmButtonColor: '#bf9b55',
					})
				}
				else if(response.status==4) {
					let texto = 'El folio ya fue atendido por el agente<br><strong>' + response.agente +
						'</strong><br><br><strong>' + response.motivo + '</strong>';
					if (response.motivo == 'EXPEDIENTE') {
						texto = texto + '<br><br><strong>' + expedienteConGuiones(response.expediente) + '</strong>';
					}
					Swal.fire({
						icon: 'error',
						html: texto,
						confirmButtonColor: '#bf9b55',
					})
				}else if(response.status === 0) {
					card2.classList.add('d-none');
					card3.classList.add('d-none');
					card4.classList.add('d-none');
					card5.classList.add('d-none');
					card6.classList.add('d-none');

					Swal.fire({
						icon: 'error',
						text: 'El folio no existe o no pertenece a este modulo, verificalo de nuevo.',
						confirmButtonColor: '#bf9b55',
					})
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log('Error', textStatus, jqXHR, errorThrown);
			}
		});
	});

	//Funcion para borrar todos los valores
	function borrarTodoConFolio() {
		let currentTime = new Date();
		let year = currentTime.getFullYear()

		notas_mp.value = "";
		$('#send_mail_select').empty();
		// quill.root.innerHTML ='';
		// quill2.root.innerHTML='';

		tabla_personas = document.querySelectorAll('#table-personas tr');
		tabla_vehiculos = document.querySelectorAll('#table-vehiculos tr');
		tabla_parentesco = document.querySelectorAll('#table-parentesco tr');
		tabla_relacion_fis_fis = document.querySelectorAll('#table-delitos-videodenuncia tr');
		tabla_delito_cometido = document.querySelectorAll('#table-delito-cometidos tr');
		tabla_objetos_involucrados = document.querySelectorAll('#table-objetos-involucradoss tr');


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
		tabla_objetos_involucrados.forEach(row => {
			if (row.id !== '') {
				row.remove();
			}
		});

		card2.classList.add('d-none');
		card3.classList.add('d-none');
		card4.classList.add('d-none');
		card5.classList.add('d-none');
		card6.classList.add('d-none');
		card7.classList.add('d-none');
		card8.classList.add('d-none');

		// card6.classList.remove('d-none');

		document.querySelector('#delito_dash_lit').value = '';
		document.querySelector('#delito_descr_dash_lit').value = '';

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
		// document.querySelector('#zona_pfd').value = '';
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
		document.getElementById("form_objetos_involucrados").reset();
		document.getElementById("form_vehiculo").reset();
		divFolioAtendido.classList.add('d-none');

		// $('#v-pills-vehiculos-tab').css('display', 'NONE');
	}

	function borrarTodo() {
		let currentTime = new Date();
		let year = currentTime.getFullYear()
		buscar_nuevo_btn.classList.add('d-none');
		inputFolio.classList.remove('d-none');
		inputFolio.value = "";
		year_select.classList.remove('d-none');
		year_select.value = year;
		buscar_btn.classList.remove('d-none');
		notas_mp.value = "";
		// quill.root.innerHTML ='';
		// quill2.root.innerHTML='';
		tabla_personas_morales = document.querySelectorAll('#table-morales tr');
		tabla_personas = document.querySelectorAll('#table-personas tr');
		tabla_vehiculos = document.querySelectorAll('#table-vehiculos tr');
		tabla_parentesco = document.querySelectorAll('#table-parentesco tr');
		tabla_archivos = document.querySelectorAll('#table-archivos tr');

		tabla_relacion_fis_fis = document.querySelectorAll('#table-delitos-videodenuncia tr');
		tabla_delito_cometido = document.querySelectorAll('#table-delito-cometidos tr');
		tabla_objetos_involucrados = document.querySelectorAll('#table-objetos-involucradoss tr');


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
		tabla_objetos_involucrados.forEach(row => {
			if (row.id !== '') {
				row.remove();
			}
		});
		tabla_archivos.forEach(row => {
			if (row.id !== '') {
				row.remove();
			}
		});
		tabla_personas_morales.forEach(row => {
			if (row.id !== '') {
				row.remove();
			}
		});
		card2.classList.add('d-none');
		card3.classList.add('d-none');
		card4.classList.add('d-none');
		card5.classList.add('d-none');
		card6.classList.add('d-none');
		card7.classList.add('d-none');
		card8.classList.add('d-none');

		// card6.classList.remove('d-none');

		document.querySelector('#delito_dash_lit').value = '';
		document.querySelector('#delito_descr_dash_lit').value = '';

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
		// document.querySelector('#zona_pfd').value = '';
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

		//PERSONAS MORALES
		document.getElementById("persona_moral_form").reset();
		document.getElementById("persona_moral_poder_form").reset();
		document.getElementById("persona_moral_notificaciones_form").reset();



		//RESET FORM
		document.getElementById("form_asignar_arbol_delictual_insert").reset();
		document.getElementById("form_parentesco_insert").reset();
		document.getElementById("form_delitos_cometidos_insert").reset();
		document.getElementById("form_objetos_involucrados").reset();
		document.getElementById("form_vehiculo").reset();
		divFolioAtendido.classList.add('d-none');

		// $('#v-pills-vehiculos-tab').css('display', 'NONE');
	}

	//Funcion para darle formato al expediente, recibe por parametro el expediente sin formato
	function expedienteConGuiones(expediente) {
		const array = expediente.trim().split('');
		// return array[0] + '-' + array[1] + array[2] + '-' + array[3] + array[4] + array[5] + '-' + array[6] + array[7] + array[8] + array[9] + '-' + array[10] + array[11] + array[12] + array[13] + array[14];
		return array[1] + array[2] + array[4] + array[5] + '-' + array[6] + array[7] + array[8] + array[9] + '-' + array[10] + array[11] + array[12] + array[13] + array[14];
	}

	//Evento al buscar nuevo folio
	buscar_nuevo_btn.addEventListener('click', () => {
		// data = {
		//  'folio': inputFolio.value,
		//  'year': year_select.value,
		// }
		// $.ajax({
		//  data: data,
		//  url: "<?= base_url('/data/restore-folio') ?>",
		//  method: "POST",
		//  dataType: "json",

		// }).done(function(data) {}).fail(function(jqXHR, textStatus) {
		//  Swal.fire({
		//    icon: 'error',
		//    text: 'El folio quedó en proceso, comunicate con soporte técnico para devolver el estado a abierto.',
		//    confirmButtonColor: '#bf9b55',
		//  });
		// });
		Swal.fire({
			icon: 'warning',
			text: 'El folio quedó en proceso.',
			showConfirmButton: false,
			timer: 1500
		});
		borrarTodo();
	});


	//Funcion para llenar valores y abrir modal para firmar documentos por id, recibe por parametro el folio, año y id del documento
	function firmarDocumento(folio, ano, foliodocid) {
		document.querySelector('#folio_id').value = folio;
		document.querySelector('#documento_id').value = foliodocid;
		document.querySelector('#year_doc').value = ano;
		$('#contrasena_modal_doc_id').modal('show');
	}

	//Funcion para asignar un encargado al documento y que este lo firme, recibe por parametro el id del documento, folio y año
	function asignarEncargado(documento, folio, ano) {
		$('#documentos_generados_modal').modal('hide');
		$('#encargadosModal').modal('show');
		const btn_asignar_encargado = document.querySelector('#enviarEncargado');

		btn_asignar_encargado.addEventListener('click', (e) => {
			btn_asignar_encargado.disabled = true;

			$.ajax({
				data: {
					'foliodocid': documento,
					'folio': folio,
					'year': ano,
					'encargadoid': document.querySelector('#selectEncargado').value
				},
				url: "<?= base_url('/data/update-encargado') ?>",
				method: "POST",
				dataType: "json",
				success: function(response) {
					const documentos = response.documentos;
					if (response.status == 1) {
						btn_asignar_encargado.disabled = false;
						//LLena la tabla de documentos
						let tabla_documentos = document.querySelectorAll('#table-documentos tr');
						tabla_documentos.forEach(row => {
							if (row.id !== '') {
								row.remove();
							}
						});
						llenarTablaDocumentos(documentos);

						// Swal.fire({
						//  icon: 'success',
						//  text: 'Encargado asignado correctamente',
						//  confirmButtonColor: '#bf9b55',
						// });
						$('#encargadosModal').modal('hide');
					}

				},
				error: function(jqXHR, textStatus, errorThrown) {
					btn_asignar_encargado.disabled = false;

				}
			});
		});

	}

	//Funcion para asignar un agente al documento y que este lo firme, recibe por parametro el id del documento, folio y año
	function asignarAgente(documento, folio, ano) {
		$('#documentos_generados_modal').modal('hide');

		$('#asignarAgenteModal').modal('show');
		const btn_asignar_agente = document.querySelector('#enviarAgente');

		btn_asignar_agente.addEventListener('click', (e) => {
			btn_asignar_agente.disabled = true;
			$.ajax({
				data: {
					'foliodocid': documento,
					'folio': folio,
					'year': ano,
					'agenteid': document.querySelector('#selectAgente').value
				},
				url: "<?= base_url('/data/update-agente-asignado') ?>",
				method: "POST",
				dataType: "json",
				success: function(response) {
					const documentos = response.documentos;
					if (response.status == 1) {
						//Llena la tabla de documentos
						btn_asignar_agente.disabled = false;
						let tabla_documentos = document.querySelectorAll('#table-documentos tr');
						tabla_documentos.forEach(row => {
							if (row.id !== '') {
								row.remove();
							}
						});
						llenarTablaDocumentos(documentos);

						Swal.fire({
							icon: 'success',
							text: 'Agente asignado correctamente',
							confirmButtonColor: '#bf9b55',
						});
						$('#asignarAgenteModal').modal('hide');
					}

				},
				error: function(jqXHR, textStatus, errorThrown) {
					btn_asignar_agente.disabled = false;

				}
			});
		});

	}

	//Funcion para borrar un documento, se manda por parametro el folio, año y id del documento
	function borrarDocumento(folio, ano, foliodocid) {
		Swal.fire({
			title: '¿Estas seguro?',
			text: "¡Esta operacion es irevertible!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#bf9b55',
			confirmButtonText: '¡Si, eliminar!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					data: {
						'docid': foliodocid,
						'folio': folio,
						'year': ano,
					},
					url: "<?= base_url('/data/delete-documento') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						if (response.status == 1) {
							//Se llena la tabla de documentos
							const documentos = response.documentos;
							let tabla_documentos = document.querySelectorAll(
								'#table-documentos tr');
							tabla_documentos.forEach(row => {
								if (row.id !== '') {
									row.remove();
								}
							});
							llenarTablaDocumentos(documentos);
							Swal.fire(
								'Documento eliminado',
								'El documento se ha eliminado correctamente.',
								'success'
							);
						} else {
							Swal.fire(
								'¡Borrar!',
								'El documento no se elimino.',
								'error'
							)
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus);
						Swal.fire(
							'¡Borrar!',
							'El documento no se elimino.',
							'error'
						)
					}
				});
			}
		});
	}


	//Funcion para visualizar el documento para una posible edicion, recibe por parametro el id del documento
	function viewDocumento(foliodocid) {
		jQuery('.ql-toolbar').remove();
		$('#documentos_generados_modal').modal('hide');
		$('#documentos_modal_editar').modal('show');
		$.ajax({
			data: {
				'docid': foliodocid,
				'folio': inputFolio.value,
				'year': year_select.value,
			},
			url: "<?= base_url('/data/get-documento-by-id') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				let documentos = response.documentos;
				let documento_id = response.documentoporid;
				tinymce.get("documento_editar").setContent(documento_id);

				document.querySelector('#docid').value = foliodocid;
			}
		});
	}

	//Funcion para abrir una ventana para visualizar un folio del mismo denunciante
	function viewFoliosDenunciantes(folio, year) {
		window.open(`<?= base_url('/admin/dashboard/ver_folio_litigante?folio=') ?>` + folio + '&year=' + year, '_blank');
	}

	//Funcion para eliminar una persona fisica del folio, recibe por parametro el id de la persona fisica
	function deletePersonaFisicaById(personafisicaid) {
		const data = {
			'folio': document.querySelector('#input_folio_atencion_lit').value,
			'year': document.querySelector('#year_select_lit').value,
			'personafisica': personafisicaid
		}
		$.ajax({
			data: data,
			url: "<?= base_url('/data/delete-persona-fisica-by-id') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				if (response.status == 1) {
					const personasPropietarios = response.personasPropietarios;

					//Llenado de la tabla de personas
					let tabla_personas = document.querySelectorAll('#table-personas tr');
					tabla_personas.forEach(row => {
						if (row.id !== '') {
							row.remove();
						}
					});

					llenarTablaPersonas(response.personas);
					Swal.fire({
						icon: 'success',
						text: 'Persona fisica eliminada correctamente',
						confirmButtonColor: '#bf9b55',
					});
					const imputados = response.imputados;
					const victimas = response.victimas;
					const personas = response.personas;

					//Nuevo llenado de selects donde haya personas fisicas
					$('#victima_ofendido').empty();
					let select_victima_ofendido = document.querySelector("#victima_ofendido")
					victimas.forEach(victima => {
						let primer_apellido = victima.PRIMERAPELLIDO ? victima
							.PRIMERAPELLIDO : '';

						const option = document.createElement('option');
						option.value = victima.PERSONAFISICAID ? victima.PERSONAFISICAID : victima.PERSONAMORALID + ' MORAL';
						option.text = victima.NOMBRE ? victima.NOMBRE + ' ' + primer_apellido + ' | ' + victima.PFCJDESCR : victima.DENOMINACION + ' | ' + victima.PMCJDESCR;
						select_victima_ofendido.add(option, null);
					});

					$('#imputado_arbol').empty();
					let select_imputado_mputado = document.querySelector("#imputado_arbol")
					imputados.forEach(imputado => {
						let primer_apellido = imputado.PRIMERAPELLIDO ? imputado
							.PRIMERAPELLIDO : '';

						const option = document.createElement('option');
						option.value = imputado.PERSONAFISICAID;
						option.text = imputado.NOMBRE + ' ' + primer_apellido;
						select_imputado_mputado.add(option, null);

					});
					$('#personaFisica1_I').empty();
					let select_personaFisica1_I = document.querySelector("#personaFisica1_I")
					const option_vacio = document.createElement('option');
					option_vacio.value = '';
					option_vacio.text = '';
					option_vacio.disabled = true;
					option_vacio.selected = true;
					select_personaFisica1_I.add(option_vacio, null);
					personas.forEach(persona => {
						let primer_apellido = persona.PRIMERAPELLIDO ? persona
							.PRIMERAPELLIDO : '';

						const option = document.createElement('option');
						option.value = persona.PERSONAFISICAID;
						option.text = persona.NOMBRE + ' ' + primer_apellido;
						select_personaFisica1_I.add(option, null);
					});
					$('#personaFisica1').empty();
					let select_personaFisica1 = document.querySelector("#personaFisica1")
					const option_vacio_pe = document.createElement('option');
					option_vacio_pe.value = '';
					option_vacio_pe.text = 'Selecciona ...';
					option_vacio_pe.disabled = true;
					option_vacio_pe.selected = true;
					select_personaFisica1.add(option_vacio_pe, null);
					personas.forEach(persona => {
						let primer_apellido = persona.PRIMERAPELLIDO ? persona
							.PRIMERAPELLIDO : '';

						const option = document.createElement('option');
						option.value = persona.PERSONAFISICAID;
						option.text = persona.NOMBRE + ' ' + primer_apellido;
						select_personaFisica1.add(option, null);
					});
					$('#personaFisica2').empty();
					let select_personaFisica2 = document.querySelector("#personaFisica2")
					const option_vacio_pe2 = document.createElement('option');
					option_vacio_pe2.value = '';
					option_vacio_pe2.text = 'Selecciona ...';
					option_vacio_pe2.disabled = true;
					option_vacio_pe2.selected = true;
					select_personaFisica2.add(option_vacio_pe2, null);
					personas.forEach(persona => {
						let primer_apellido = persona.PRIMERAPELLIDO ? persona
							.PRIMERAPELLIDO : '';

						const option = document.createElement('option');
						option.value = persona.PERSONAFISICAID;
						option.text = persona.NOMBRE + ' ' + primer_apellido;
						select_personaFisica2.add(option, null);
					});
					$('#propietario').empty();
					let select_propietario = document.querySelector("#propietario");
					const option_vacio_pro = document.createElement('option');
					option_vacio_pro.value = '';
					option_vacio_pro.text = '';
					option_vacio_pro.disabled = true;
					option_vacio_pro.selected = true;
					select_propietario.add(option_vacio_pro, null);

					personasPropietarios.forEach(persona => {
						let primer_apellido = persona.PRIMERAPELLIDO ? persona
							.PRIMERAPELLIDO : '';

						const option = document.createElement('option');
						option.value = persona.PERSONAFISICAID ? persona.PERSONAFISICAID : persona.PERSONAMORALID + ' MORAL';
						option.text = persona.NOMBRE ? persona.NOMBRE + ' ' + primer_apellido : persona.DENOMINACION;
						select_propietario.add(option, null);
					});

					$('#propietario_vehiculo').empty();
					let select_propietario_v = document.querySelector("#propietario_vehiculo");
					const option_vacio_p = document.createElement('option');
					option_vacio_p.value = '';
					option_vacio_p.text = '';
					option_vacio_p.disabled = true;
					option_vacio_p.selected = true;
					select_propietario_v.add(option_vacio_p, null);
					personasPropietarios.forEach(persona => {
						let primer_apellido = persona.PRIMERAPELLIDO ? persona
							.PRIMERAPELLIDO : '';

						const option = document.createElement('option');
						option.value = persona.PERSONAFISICAID ? persona.PERSONAFISICAID : persona.PERSONAMORALID + ' MORAL';
						option.text = persona.NOMBRE ? persona.NOMBRE + ' ' + primer_apellido : persona.DENOMINACION;
						select_propietario_v.add(option, null);
					});

					$('#propietario_vehiculo_add').empty();
					let select_propietario_v_add = document.querySelector("#propietario_vehiculo_add");
					const option_vacio_p_add = document.createElement('option');
					option_vacio_p_add.value = '';
					option_vacio_p_add.text = '';
					option_vacio_p_add.disabled = true;
					option_vacio_p_add.selected = true;
					select_propietario_v_add.add(option_vacio_p_add, null);
					personasPropietarios.forEach(persona => {
						let primer_apellido = persona.PRIMERAPELLIDO ? persona
							.PRIMERAPELLIDO : '';

						const option = document.createElement('option');
						option.value = persona.PERSONAFISICAID ? persona.PERSONAFISICAID : persona.PERSONAMORALID + ' MORAL';
						option.text = persona.NOMBRE ? persona.NOMBRE + ' ' + primer_apellido : persona.DENOMINACION;
						select_propietario_v_add.add(option, null);
					});
					$('#propietario_update').empty();
					let select_propietario_update = document.querySelector(
						"#propietario_update");
					personasPropietarios.forEach(persona => {
						let primer_apellido = persona.PRIMERAPELLIDO ? persona
							.PRIMERAPELLIDO : '';

						const option = document.createElement('option');
						option.value = persona.PERSONAFISICAID ? persona.PERSONAFISICAID : persona.PERSONAMORALID + ' MORAL';
						option.text = persona.NOMBRE ? persona.NOMBRE + ' ' + primer_apellido : persona.DENOMINACION;
						select_propietario_update.add(option, null);
					});
				} else {
					Swal.fire({
						icon: 'error',
						text: 'No se eliminó la información de la persona fisica',
						confirmButtonColor: '#bf9b55',
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus);
			}
		});
	}

	//Funcion para viualizar la informacion de la persona fisica seleccionada, recibe por parametro el id de la persona fisica
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
					//LLenado de informacion en los valores
					if (personaFisica.FOTO) {
						extension = (((personaFisica.FOTO.split(';'))[0]).split('/'))[1];
						if (extension == 'pdf' || extension == 'doc') {
							document.querySelector('#fisica_foto').setAttribute('src', '<?= base_url() ?>/assets/img/file.png');

						} else {
							document.querySelector('#fisica_foto').setAttribute('src', personaFisica.FOTO);

						}

						document.querySelector('#fisica_foto_download').setAttribute('href', personaFisica
							.FOTO);
						document.querySelector('#fisica_foto_download').setAttribute('download', personaFisica
							.NOMBRE ? personaFisica.NOMBRE + '_' + personaFisica.PERSONAFISICAID + '_' +
							personaFisica.FOLIOID + '_' + personaFisica.ANO + '.' + extension :
							personaFisica.PERSONAFISICAID + '_' + personaFisica.FOLIOID + '_' +
							personaFisica.ANO + '.' + extension);
						document.querySelector('#contenedor_fisica_foto').classList.remove('d-none');
					} else {
						document.querySelector('#fisica_foto').setAttribute('src', '');
						document.querySelector('#fisica_foto_download').setAttribute('href', '');
						document.querySelector('#fisica_foto_download').setAttribute('download', '');
						document.querySelector('#contenedor_fisica_foto').classList.remove('d-none');
					}
					document.querySelector('#calidad_juridica_pf').value = personaFisica.CALIDADJURIDICAID ?
						personaFisica.CALIDADJURIDICAID : '';
					document.querySelector('#nombre_pf').value = personaFisica.NOMBRE ? personaFisica.NOMBRE :
						'';
					document.querySelector('#apellido_paterno_pf').value = personaFisica.PRIMERAPELLIDO ?
						personaFisica.PRIMERAPELLIDO : '';
					document.querySelector('#apellido_materno_pf').value = personaFisica.SEGUNDOAPELLIDO ?
						personaFisica.SEGUNDOAPELLIDO : '';
					document.querySelector('#sexo_pf').value = personaFisica.SEXO ? personaFisica.SEXO : '';
					document.querySelector('#tipo_identificacion_pf').value = personaFisica
						.TIPOIDENTIFICACIONID ? personaFisica.TIPOIDENTIFICACIONID : '';
					document.querySelector('#nacionalidad_pf').value = personaFisica.NACIONALIDADID ?
						personaFisica.NACIONALIDADID : '';
					document.querySelector('#edoc_pf').value = personaFisica.ESTADOCIVILID ? personaFisica
						.ESTADOCIVILID : '';
					document.querySelector('#idioma_pf').value = personaFisica.PERSONAIDIOMAID ? personaFisica
						.PERSONAIDIOMAID : '';
					document.querySelector('#fecha_nacimiento_pf').value = personaFisica.FECHANACIMIENTO ?
						personaFisica.FECHANACIMIENTO : '';
					document.querySelector('#edad_pf').value = personaFisica.EDADCANTIDAD ? personaFisica
						.EDADCANTIDAD : '';
					document.querySelector('#fotografia_actual_pf').value = personaFisica.FOTOGRAFIA_ACTUAL ? personaFisica
						.FOTOGRAFIA_ACTUAL : '';
					document.querySelector('#numero_identidad_pf').value = personaFisica.NUMEROIDENTIFICACION ?
						personaFisica.NUMEROIDENTIFICACION : '';
					document.querySelector('#codigo_pais_pf').value = personaFisica.CODIGOPAISTEL ?
						personaFisica.CODIGOPAISTEL : '52';
					document.querySelector('#codigo_pais_pf_2').value = personaFisica.CODIGOPAISTEL2 ?
						personaFisica.CODIGOPAISTEL2 : '52';
					personaFisica.CODIGOPAISTEL ? iti.setNumber('+' + personaFisica.CODIGOPAISTEL) : iti
						.setNumber('+52');
					personaFisica.CODIGOPAISTEL2 ? iti2.setNumber('+' + personaFisica.CODIGOPAISTEL2) : iti2
						.setNumber('+52');
					document.querySelector('#telefono_pf').value = personaFisica.TELEFONO ? personaFisica
						.TELEFONO : '';
					document.querySelector('#telefono_pf_2').value = personaFisica.TELEFONO2 ? personaFisica
						.TELEFONO2 : '';
					document.querySelector('#apodo_pf').value = personaFisica.APODO ? personaFisica.APODO : '';
					document.querySelector('#correo_pf').value = personaFisica.CORREO ? personaFisica.CORREO :
						'';
					document.querySelector('#edoorigen_pf').value = personaFisica.ESTADOORIGENID ? personaFisica
						.ESTADOORIGENID : '';
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
								document.querySelector('#munorigen_pf').value = personaFisica
									.MUNICIPIOORIGENID ? personaFisica.MUNICIPIOORIGENID : '';
							},
							error: function(jqXHR, textStatus, errorThrown) {}
						});
					} else {
						document.querySelector('#munorigen_pf').value = '';
					}
					document.querySelector('#escolaridad_pf').value = personaFisica.ESCOLARIDADID ?
						personaFisica.ESCOLARIDADID : '';
					document.querySelector('#ocupacion_pf').value = personaFisica.OCUPACIONID ? personaFisica
						.OCUPACIONID : '';

					document.querySelector('#descripcionFisica_pf').value = personaFisica.DESCRIPCION_FISICA ?
						personaFisica.DESCRIPCION_FISICA : '';
					document.querySelector('#facebook_pf').value = personaFisica.FACEBOOK ? personaFisica
						.FACEBOOK : '';
					document.querySelector('#instagram_pf').value = personaFisica.INSTAGRAM ? personaFisica
						.INSTAGRAM : '';
					document.querySelector('#twitter_pf').value = personaFisica.TWITTER ? personaFisica
						.TWITTER : '';
					document.querySelector('#denunciante_pf').value = personaFisica.DENUNCIANTE ? personaFisica
						.DENUNCIANTE : '';
					if (personaFisica.OCUPACIONDESCR) {
						document.querySelector('#ocupacion_pf_m').classList.remove('d-none');
						document.querySelector('#ocupacion_pf_m').value = personaFisica.OCUPACIONDESCR;
					}
					//PERSONA FISICA END
					//MEDIAFILIACION
					if (mediaFiliacion) {

						document.querySelector('#estatura_mf').value = mediaFiliacion.ESTATURA;
						document.querySelector('#peso_mf').value = mediaFiliacion.PESO;

						document.querySelector('#complexion_mf').value = mediaFiliacion.FIGURAID ?
							mediaFiliacion.FIGURAID : '';

						document.querySelector('#colortez_mf').value = mediaFiliacion.PIELCOLORID ?
							mediaFiliacion.PIELCOLORID : '';
						document.querySelector('#senas_mf').value = mediaFiliacion.SENASPARTICULARES;
						// document.querySelector('#identidadD').value = mediaFiliacion.IDENTIDAD ? mediaFiliacion.IDENTIDAD:'';
						document.querySelector('#colorC_mf').value = mediaFiliacion.CABELLOCOLORID ?
							mediaFiliacion.CABELLOCOLORID : '';
						document.querySelector('#tamanoC_mf').value = mediaFiliacion.CABELLOTAMANOID ?
							mediaFiliacion.CABELLOTAMANOID : '';
						document.querySelector('#formaC_mf').value = mediaFiliacion.CABELLOESTILOID ?
							mediaFiliacion.CABELLOESTILOID : '';
						document.querySelector('#peculiarC_mf').value = mediaFiliacion.CABELLOPECULIARID ?
							mediaFiliacion.CABELLOPECULIARID : '';

						document.querySelector('#peculiarC_mf').value = mediaFiliacion.CABELLOPECULIARID ?
							mediaFiliacion.CABELLOPECULIARID : '';
						document.querySelector('#cabello_descr_mf').value = mediaFiliacion.CABELLODESCR ?
							mediaFiliacion.CABELLODESCR : '';
						document.querySelector('#colocacion_ojos_mf').value = mediaFiliacion.OJOCOLOCACIONID ?
							mediaFiliacion.OJOCOLOCACIONID : '';
						document.querySelector('#forma_ojos_mf').value = mediaFiliacion.OJOFORMAID ?
							mediaFiliacion.OJOFORMAID : '';
						document.querySelector('#tamano_ojos_mf').value = mediaFiliacion.OJOTAMANOID ?
							mediaFiliacion.OJOTAMANOID : '';
						document.querySelector('#colorO_mf').value = mediaFiliacion.OJOCOLORID ? mediaFiliacion
							.OJOCOLORID : '';

						document.querySelector('#peculiaridad_ojos_mf').value = mediaFiliacion.OJOPECULIARID ?
							mediaFiliacion.OJOPECULIARID : '';
						document.querySelector('#frente_altura_mf').value = mediaFiliacion.FRENTEALTURAID ?
							mediaFiliacion.FRENTEALTURAID : '';
						document.querySelector('#frente_anchura_ms').value = mediaFiliacion.FRENTEANCHURAID ?
							mediaFiliacion.FRENTEANCHURAID : '';
						document.querySelector('#tipoF_mf').value = mediaFiliacion.FRENTEFORMAID ?
							mediaFiliacion.FRENTEFORMAID : '';
						document.querySelector('#frente_peculiar_mf').value = mediaFiliacion.FRENTEPECULIARID ?
							mediaFiliacion.FRENTEPECULIARID : '';
						document.querySelector('#colocacion_ceja_mf').value = mediaFiliacion.CEJACOLOCACIONID ?
							mediaFiliacion.CEJACOLOCACIONID : '';
						document.querySelector('#ceja_mf').value = mediaFiliacion.CEJAFORMAID ? mediaFiliacion
							.CEJAFORMAID : '';

						document.querySelector('#tamano_ceja_mf').value = mediaFiliacion.CEJATAMANOID ?
							mediaFiliacion.CEJATAMANOID : '';
						document.querySelector('#grosor_ceja_mf').value = mediaFiliacion.CEJAGROSORID ?
							mediaFiliacion.CEJAGROSORID : '';
						document.querySelector('#nariz_tipo_mf').value = mediaFiliacion.CEJATAMANOID ?
							mediaFiliacion.CEJATAMANOID : '';
						document.querySelector('#nariz_tamano_mf').value = mediaFiliacion.NARIZTAMANOID ?
							mediaFiliacion.NARIZTAMANOID : '';
						document.querySelector('#nariz_base_mf').value = mediaFiliacion.NARIZBASEID ?
							mediaFiliacion.NARIZBASEID : '';
						document.querySelector('#nariz_peculiar_mf').value = mediaFiliacion.NARIZPECULIARID ?
							mediaFiliacion.NARIZPECULIARID : '';
						document.querySelector('#nariz_descr_mf').value = mediaFiliacion.NARIZDESCR ?
							mediaFiliacion.NARIZDESCR : '';
						document.querySelector('#bigote_forma_mf').value = mediaFiliacion.BIGOTEFORMAID ?
							mediaFiliacion.BIGOTEFORMAID : '';
						document.querySelector('#bigote_tamaño_mf').value = mediaFiliacion.BIGOTETAMANOID ?
							mediaFiliacion.BIGOTETAMANOID : '';
						document.querySelector('#bigote_grosor_mf').value = mediaFiliacion.BIGOTEGROSORID ?
							mediaFiliacion.BIGOTEGROSORID : '';
						document.querySelector('#bigote_peculiar_mf').value = mediaFiliacion.BIGOTEPECULIARID ?
							mediaFiliacion.BIGOTEPECULIARID : '';
						document.querySelector('#bigote_descr_mf').value = mediaFiliacion.BIGOTEDESCR ?
							mediaFiliacion.BIGOTEDESCR : '';
						document.querySelector('#boca_tamano_mf').value = mediaFiliacion.BOCATAMANOID ?
							mediaFiliacion.BOCATAMANOID : '';
						document.querySelector('#boca_peculiar_mf').value = mediaFiliacion.BOCAPECULIARID ?
							mediaFiliacion.BOCAPECULIARID : '';
						document.querySelector('#labio_grosor_mf').value = mediaFiliacion.LABIOGROSORID ?
							mediaFiliacion.LABIOGROSORID : '';
						document.querySelector('#labio_longitud_mf').value = mediaFiliacion.LABIOLONGITUDID ?
							mediaFiliacion.LABIOLONGITUDID : '';
						document.querySelector('#labio_posicion_mf').value = mediaFiliacion.LABIOPOSICIONID ?
							mediaFiliacion.LABIOPOSICIONID : '';
						document.querySelector('#labio_peculiar_mf').value = mediaFiliacion.LABIOPECULIARID ?
							mediaFiliacion.LABIOPECULIARID : '';
						document.querySelector('#dientes_tamano_mf').value = mediaFiliacion.DIENTETAMANOID ?
							mediaFiliacion.DIENTETAMANOID : '';
						document.querySelector('#dientes_tipo_mf').value = mediaFiliacion.DIENTETIPOID ?
							mediaFiliacion.DIENTETIPOID : '';
						document.querySelector('#dientes_peculiar_mf').value = mediaFiliacion.DIENTEPECULIARID ?
							mediaFiliacion.DIENTEPECULIARID : '';
						document.querySelector('#dientes_descr_mf').value = mediaFiliacion.DIENTEDESCR ?
							mediaFiliacion.DIENTEDESCR : '';
						document.querySelector('#barbilla_forma_mf').value = mediaFiliacion.BARBILLAFORMAID ?
							mediaFiliacion.BARBILLAFORMAID : '';
						document.querySelector('#barbilla_tamano_mf').value = mediaFiliacion.BARBILLATAMANOID ?
							mediaFiliacion.BARBILLATAMANOID : '';
						document.querySelector('#barbilla_inclinacion_mf').value = mediaFiliacion
							.BARBILLAINCLINACIONID ? mediaFiliacion.BARBILLAINCLINACIONID : '';
						document.querySelector('#barbilla_peculiar_mf').value = mediaFiliacion
							.BARBILLAPECULIARID ? mediaFiliacion.BARBILLAPECULIARID : '';
						document.querySelector('#barbilla_descr_mf').value = mediaFiliacion.BARBILLADESCR ?
							mediaFiliacion.BARBILLADESCR : '';
						document.querySelector('#barba_tamano_mf').value = mediaFiliacion.BARBATAMANOID ?
							mediaFiliacion.BARBATAMANOID : '';
						document.querySelector('#barba_peculiar_mf').value = mediaFiliacion.BARBAPECULIARID ?
							mediaFiliacion.BARBAPECULIARID : '';
						document.querySelector('#barba_descr_mf').value = mediaFiliacion.BARBADESCR ?
							mediaFiliacion.BARBADESCR : '';
						document.querySelector('#cuello_tamano_mf').value = mediaFiliacion.CUELLOTAMANOID ?
							mediaFiliacion.CUELLOTAMANOID : '';
						document.querySelector('#cuello_grosor_mf').value = mediaFiliacion.CUELLOGROSORID ?
							mediaFiliacion.CUELLOGROSORID : '';
						document.querySelector('#cuello_peculiar_mf').value = mediaFiliacion.CUELLOPECULIARID ?
							mediaFiliacion.CUELLOPECULIARID : '';
						document.querySelector('#cuello_descr_mf').value = mediaFiliacion.CUELLODESCR ?
							mediaFiliacion.CUELLODESCR : '';
						document.querySelector('#hombro_posicion_mf').value = mediaFiliacion.HOMBROPOSICIONID ?
							mediaFiliacion.HOMBROPOSICIONID : '';
						document.querySelector('#hombro_tamano_mf').value = mediaFiliacion.HOMBROTAMANOID ?
							mediaFiliacion.HOMBROTAMANOID : '';
						document.querySelector('#hombro_grosor_mf').value = mediaFiliacion.HOMBROGROSORID ?
							mediaFiliacion.HOMBROGROSORID : '';
						document.querySelector('#estomago_mf').value = mediaFiliacion.ESTOMAGOID ?
							mediaFiliacion.ESTOMAGOID : '';
						document.querySelector('#estomago_descr_mf').value = mediaFiliacion.ESTOMAGOID ?
							mediaFiliacion.ESTOMAGOID : '';



						document.querySelector('#discapacidad_mf').value = mediaFiliacion.DISCAPACIDADDESCR;
						// document.querySelector('#origen_mf').value = mediaFiliacion.ORIGEN;

						document.querySelector('#diaDesaparicion').value = mediaFiliacion.FECHADESAPARICION ?
							mediaFiliacion.FECHADESAPARICION : '';

						document.querySelector('#lugarDesaparicion').value = mediaFiliacion.LUGARDESAPARICION;
						document.querySelector('#vestimenta_mf').value = mediaFiliacion.VESTIMENTADESCR;
						document.querySelector('#escolaridad_mf').value = mediaFiliacion.ESCOLARIDADID ?
							mediaFiliacion.ESCOLARIDADID : '';
						document.querySelector('#ocupacion_mf').value = mediaFiliacion.OCUPACIONID ?
							mediaFiliacion.OCUPACIONID : '';

						document.querySelector('#contextura_ceja_mf').value = mediaFiliacion.CONTEXTURAID ?
							mediaFiliacion.CONTEXTURAID : '';
						document.querySelector('#cara_forma_mf').value = mediaFiliacion.CARAFORMAID ?
							mediaFiliacion.CARAFORMAID : '';
						document.querySelector('#cara_tamano_mf').value = mediaFiliacion.CARATAMANOID ?
							mediaFiliacion.CARATAMANOID : '';
						document.querySelector('#caratez_mf').value = mediaFiliacion.CARATEZID ? mediaFiliacion
							.CARATEZID : '';
						document.querySelector('#lobulo_mf').value = mediaFiliacion.OREJALOBULOID ?
							mediaFiliacion.OREJALOBULOID : '';
						document.querySelector('#forma_oreja_mf').value = mediaFiliacion.OREJAFORMAID ?
							mediaFiliacion.OREJAFORMAID : '';
						document.querySelector('#tamano_oreja_mf').value = mediaFiliacion.OREJATAMANOID ?
							mediaFiliacion.OREJATAMANOID : '';

						document.querySelector('#hombro_tamano_mf').value = mediaFiliacion.HOMBROLONGITUDID ?
							mediaFiliacion.HOMBROLONGITUDID : '';



						document.querySelector('#escolaridad_mf').value = mediaFiliacion.PERSONAESCOLARIDADID ?
							mediaFiliacion.PERSONAESCOLARIDADID : '';

					}
					//PARENTESCO

					// if (relacion_parentesco) {
					//  document.querySelector('#parentesco_mf').value = parentesco.PERSONAPARENTESCOID ? parentesco.PERSONAPARENTESCOID : '';
					//  document.querySelector('#personaFisica1').value = relacion_parentesco.PERSONAFISICAID1 ? relacion_parentesco.PERSONAFISICAID1 : '';
					//  document.querySelector('#personaFisica2').value = idPersonaFisica ? idPersonaFisica : '';
					//  document.getElementById("updateParentesco").style.display="block";
					//  document.getElementById("insertParentesco").style.display="none";


					// } 
					// if(relacion_parentesco == null) {
					//  document.querySelector('#parentesco_mf').value = '';
					//  document.querySelector('#personaFisica1').value = '';
					//  document.querySelector('#personaFisica2').value = idPersonaFisica ? idPersonaFisica : '';
					//  document.getElementById("insertParentesco").style.display="block";
					//  document.getElementById("updateParentesco").style.display="none";

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
								document.querySelector('#municipio_pfd').value = domicilio
									.MUNICIPIOID ? domicilio.MUNICIPIOID : '';
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

					if (domicilio.ESTADOID && domicilio.MUNICIPIOID && domicilio.LOCALIDADID && domicilio
						.COLONIAID) {
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
						document.querySelector('#colonia_pfd').value = domicilio.COLONIADESCR ? domicilio
							.COLONIADESCR : '';
					}
					document.querySelector('#cp_pfd').value = domicilio.CP ? domicilio.CP : '';
					document.querySelector('#calle_pfd').value = domicilio.CALLE ? domicilio.CALLE : '';
					if (domicilio.NUMEROCASA && domicilio.NUMEROCASA.includes('M.')) {
						document.getElementById('lblExterior_pfd').innerHTML = "Manzana";
						document.getElementById('lblInterior_pfd').innerHTML = "Lote";
						document.querySelector('#checkML_pfd').checked = true;
						document.querySelector('#checkML_pfd').value = "on";

					}
					document.querySelector('#exterior_pfd').value = domicilio.NUMEROCASA ? domicilio
						.NUMEROCASA.replace('M.', '') : '';
					document.querySelector('#interior_pfd').value = domicilio.NUMEROINTERIOR ? domicilio
						.NUMEROINTERIOR.replace('L.', '') : '';
					document.querySelector('#referencia_pfd').value = domicilio.REFERENCIA ? domicilio
						.REFERENCIA : '';

					// document.querySelector('#zona_pfd').value = domicilio.ZONA ? domicilio.ZONA : '';
					$('#ocupacion_pf').trigger('change');

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

	//Funcion para viualizar la informacion de la persona moral seleccionada, recibe por parametro el id de la persona moral
	function viewPersonaMoral(id) {
		$.ajax({
			data: {
				'id': id,
				'folio': inputFolio.value,
				'year': year_select.value,
			},
			url: "<?= base_url('/data/get-persona-moral-by-id') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				if (response.status == 1) {
					let personaMoral = response.personaMoral;
					let notificacion = response.personaMoralNotificacion;
					let foliopersonaMoral = response.foliopersonaMoral;
					let poderesPersonaMoral = response.poderes;

					let folio = response.folio;
					// let poder = response.relacionMoralFisica;
					let idPersonaMoral = response.idPersonaMoral;
					document.querySelectorAll('#pm_id').forEach(element => {
						element.value = id;
					});
					document.querySelector('#razon_social_pm').value = foliopersonaMoral.DENOMINACION ? foliopersonaMoral.DENOMINACION : '';
					document.querySelector('#marca_comercial_pm').value = foliopersonaMoral.MARCACOMERCIAL ? foliopersonaMoral
						.MARCACOMERCIAL : '';

					document.querySelector('#calle_pm').value = foliopersonaMoral.CALLE ? foliopersonaMoral
						.CALLE : '';
					document.querySelector('#n_exterior_pm').value = foliopersonaMoral.NUMERO ? foliopersonaMoral
						.NUMERO : '';
					document.querySelector('#n_interior_pm').value = foliopersonaMoral.NUMEROINTERIOR ? foliopersonaMoral
						.NUMEROINTERIOR : '';
					document.querySelector('#referencia_pm').value = foliopersonaMoral.REFERENCIA ? foliopersonaMoral
						.REFERENCIA : '';
					document.querySelector('#telefono_pm').value = foliopersonaMoral.TELEFONO ? foliopersonaMoral
						.TELEFONO : '';
					document.querySelector('#correo_pm').value = foliopersonaMoral.CORREO ? foliopersonaMoral
						.CORREO : '';
					document.querySelector('#giro_pm').value = foliopersonaMoral.PERSONAMORALGIROID ? foliopersonaMoral.PERSONAMORALGIROID : '';

					document.querySelector('#estado_pm').value = foliopersonaMoral.ESTADOID ? foliopersonaMoral
						.ESTADOID : '';
					if (foliopersonaMoral.ESTADOID && foliopersonaMoral.MUNICIPIOID) {
						let data = {
							'estado_id': foliopersonaMoral.ESTADOID
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
									document.querySelector('#municipio_pm').add(option);
								});
								document.querySelector('#municipio_pm').value = foliopersonaMoral
									.MUNICIPIOID ? foliopersonaMoral.MUNICIPIOID : '';
							},
							error: function(jqXHR, textStatus, errorThrown) {}
						});
					} else {
						document.querySelector('#municipio_pm').value = '';
					}
					if (foliopersonaMoral.ESTADOID && foliopersonaMoral.MUNICIPIOID && foliopersonaMoral.LOCALIDADID) {
						let data = {
							'estado_id': foliopersonaMoral.ESTADOID,
							'municipio_id': foliopersonaMoral.MUNICIPIOID
						};

						$.ajax({
							data: data,
							url: "<?= base_url('/data/get-localidades-by-municipio') ?>",
							method: "POST",
							dataType: "json",
							success: function(response) {
								let localidades = response.data;
								let select_localidad = document.querySelector('#localidad_pm');

								localidades.forEach(localidad => {
									var option = document.createElement("option");
									option.text = localidad.LOCALIDADDESCR;
									option.value = localidad.LOCALIDADID;
									select_localidad.add(option);
								});

								select_localidad.value = foliopersonaMoral.LOCALIDADID;
							},
							error: function(jqXHR, textStatus, errorThrown) {}
						});
					} else {
						document.querySelector('#localidad_pm').value = '';
					}
					if (foliopersonaMoral.ESTADOID && foliopersonaMoral.MUNICIPIOID && foliopersonaMoral.LOCALIDADID && foliopersonaMoral
						.COLONIAID) {
						document.querySelector('#colonia_pfd').classList.add('d-none');
						document.querySelector('#colonia_pfd_select').classList.remove('d-none');
						let data = {
							'estado_id': foliopersonaMoral.ESTADOID,
							'municipio_id': foliopersonaMoral.MUNICIPIOID,
							'localidad_id': foliopersonaMoral.LOCALIDADID
						};
						$.ajax({
							data: data,
							url: "<?= base_url('/data/get-colonias-by-estado-municipio-localidad') ?>",
							method: "POST",
							dataType: "json",
							success: function(response) {
								let select_colonia = document.querySelector('#colonia_pm_select');
								let input_colonia = document.querySelector('#colonia_pm');
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
								select_colonia.value = foliopersonaMoral.COLONIAID;

								input_colonia.value = '-';
							},
							error: function(jqXHR, textStatus, errorThrown) {}
						});
					} else {
						document.querySelector('#colonia_pm').classList.remove('d-none');
						document.querySelector('#colonia_pm_select').classList.add('d-none');
						var option = document.createElement("option");
						option.text = 'OTRO';
						option.value = '0';
						document.querySelector('#colonia_pm_select').add(option);
						document.querySelector('#colonia_pm_select').value = '0';
						document.querySelector('#colonia_pm').value = foliopersonaMoral.COLONIADESCR ? foliopersonaMoral
							.COLONIADESCR : '';
					}

					//NOTIFICACIONES
					document.querySelector('#n_id').value = notificacion.NOTIFICACIONID;

					document.querySelector('#calle_pm_noti').value = notificacion.CALLE ? notificacion
						.CALLE : '';
					document.querySelector('#n_exterior_pm_noti').value = notificacion.NUMERO ? notificacion
						.NUMERO : '';
					document.querySelector('#n_interior_pm_noti').value = notificacion.NUMEROINTERIOR ? notificacion
						.NUMEROINTERIOR : '';
					document.querySelector('#referencia_pm_noti').value = notificacion.REFERENCIA ? notificacion
						.REFERENCIA : '';
					document.querySelector('#telefono_pm_noti').value = notificacion.TELEFONO ? notificacion
						.TELEFONO : '';
					document.querySelector('#correo_pm_noti').value = notificacion.CORREO ? notificacion
						.CORREO : '';

					document.querySelector('#estado_pm_noti').value = notificacion.ESTADOID ? notificacion
						.ESTADOID : '';
					if (notificacion.ESTADOID && notificacion.MUNICIPIOID) {
						let data = {
							'estado_id': notificacion.ESTADOID
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
									document.querySelector('#municipio_pm_noti').add(option);
								});
								document.querySelector('#municipio_pm_noti').value = notificacion
									.MUNICIPIOID ? notificacion.MUNICIPIOID : '';
							},
							error: function(jqXHR, textStatus, errorThrown) {}
						});
					} else {
						document.querySelector('#municipio_pm_noti').value = '';
					}
					if (notificacion.ESTADOID && notificacion.MUNICIPIOID && notificacion.LOCALIDADID) {
						let data = {
							'estado_id': notificacion.ESTADOID,
							'municipio_id': notificacion.MUNICIPIOID
						};

						$.ajax({
							data: data,
							url: "<?= base_url('/data/get-localidades-by-municipio') ?>",
							method: "POST",
							dataType: "json",
							success: function(response) {
								let localidades = response.data;
								let select_localidad = document.querySelector('#localidad_pm_noti');

								localidades.forEach(localidad => {
									var option = document.createElement("option");
									option.text = localidad.LOCALIDADDESCR;
									option.value = localidad.LOCALIDADID;
									select_localidad.add(option);
								});

								select_localidad.value = notificacion.LOCALIDADID;
							},
							error: function(jqXHR, textStatus, errorThrown) {}
						});
					} else {
						document.querySelector('#localidad_pm_noti').value = '';
					}
					if (notificacion.ESTADOID && notificacion.MUNICIPIOID && notificacion.LOCALIDADID && notificacion
						.COLONIAID) {
						document.querySelector('#colonia_pm_noti').classList.add('d-none');
						document.querySelector('#colonia_pm_noti_select').classList.remove('d-none');
						let data = {
							'estado_id': notificacion.ESTADOID,
							'municipio_id': notificacion.MUNICIPIOID,
							'localidad_id': notificacion.LOCALIDADID
						};
						$.ajax({
							data: data,
							url: "<?= base_url('/data/get-colonias-by-estado-municipio-localidad') ?>",
							method: "POST",
							dataType: "json",
							success: function(response) {
								let select_colonia = document.querySelector('#colonia_pm_noti_select');
								let input_colonia = document.querySelector('#colonia_pm_noti');
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
								select_colonia.value = notificacion.COLONIAID;

								input_colonia.value = '-';
							},
							error: function(jqXHR, textStatus, errorThrown) {}
						});
					} else {
						document.querySelector('#colonia_pm_noti').classList.remove('d-none');
						document.querySelector('#colonia_pm_noti_select').classList.add('d-none');
						var option = document.createElement("option");
						option.text = 'OTRO';
						option.value = '0';
						document.querySelector('#colonia_pm_noti_select').add(option);
						document.querySelector('#colonia_pm_noti_select').value = '0';
						document.querySelector('#colonia_pm_noti').value = notificacion.COLONIADESCR ? notificacion
							.COLONIADESCR : '';
					}

					//PODER
					// Inicializamos variables para las fechas más recientes de ACTIVO 0 y ACTIVO 1
					let fechaActivo0MasReciente = null;
					let fechaActivo1MasReciente = null;

					// Filtra los objetos con ACTIVO igual a 0 y 1

					for (const item of poderesPersonaMoral) {
						const fechaItem = new Date(item.FECHAREGISTRO);

						if (item.ACTIVO === "0" && (!fechaActivo0MasReciente || fechaItem > fechaActivo0MasReciente)) {
							fechaActivo0MasReciente = fechaItem;
						} else if (item.ACTIVO === "1" && (!fechaActivo1MasReciente || fechaItem > fechaActivo1MasReciente)) {
							fechaActivo1MasReciente = fechaItem;
						}
					}
					// Compara las fechas obtenidas
					if (fechaActivo0MasReciente > fechaActivo1MasReciente) {
						document.getElementById('alert_poder_reciente').classList.remove('d-none')
					} else {
						document.getElementById('alert_poder_reciente').classList.add('d-none')
					}
					// if (fechaActivo0 > fechaActivo1) {
					// 	document.getElementById('alert_poder_reciente').classList.remove('d-none')
					// }else{
					// 	document.getElementById('alert_poder_reciente').classList.add('d-none')
					// }
					if (foliopersonaMoral.ACTIVO == 0) {
						document.getElementById('alert_poder').classList.remove('d-none')
						document.getElementById('btnActualizarPoderFolio').classList.remove('d-none')
					} else {
						document.getElementById('alert_poder').classList.add('d-none')
						document.getElementById('btnActualizarPoderFolio').classList.add('d-none')
					}
					//LLenado de informacion en los valores
					if (foliopersonaMoral.PODERARCHIVO) {
						extension = (((foliopersonaMoral.PODERARCHIVO.split(';'))[0]).split('/'))[1];
						if (extension == 'pdf' || extension == 'doc') {
							document.querySelector('#moral_poder').setAttribute('src', '<?= base_url() ?>/assets/img/file.png');

						} else {
							document.querySelector('#moral_poder').setAttribute('src', foliopersonaMoral.PODERARCHIVO);

						}

						document.querySelector('#moral_poder_download').setAttribute('href', foliopersonaMoral
							.PODERARCHIVO);
						document.querySelector('#moral_poder_download').setAttribute('download',
							'PODER_' + foliopersonaMoral.DENOMINACION + '.' + extension);
						document.querySelector('#contenedor_moral_poder').classList.remove('d-none');
					} else {
						document.querySelector('#moral_poder').setAttribute('src', '');
						document.querySelector('#moral_poder_download').setAttribute('href', '');
						document.querySelector('#moral_poder_download').setAttribute('download', '');
						document.querySelector('#contenedor_moral_poder').classList.remove('d-none');
					}

					document.querySelector('#volumen_pm').value = foliopersonaMoral.PODERVOLUMEN ? foliopersonaMoral
						.PODERVOLUMEN : '';
					document.querySelector('#notario_pm').value = foliopersonaMoral.PODERNONOTARIO ? foliopersonaMoral
						.PODERNONOTARIO : '';
					document.querySelector('#poder_pm').value = foliopersonaMoral.PODERNOPODER ? foliopersonaMoral
						.PODERNOPODER : '';

					document.querySelector('#cargo_pm').value = foliopersonaMoral.CARGO ? foliopersonaMoral.CARGO : '';
					document.querySelector('#btnLigacion').href = `<?= base_url('admin/dashboard/editar_persona_moral?id=') ?>${personaMoral.PERSONAMORALID}`;
					document.querySelector('#btnLigacion').target = "_blank";

					$('#folio_persona_moral_modal').modal('show');

				} else {
					Swal.fire({
						icon: 'error',
						html: 'No se encontro a la persona moral',
						confirmButtonColor: '#bf9b55',
					})
				}
			}
		});
	}
	//Funcion para viualizar la informacion del vehiculo  seleccionada, recibe por parametro el id del vehiculo

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
					//Respuestas
					const vehiculo = response.vehiculo;
					const distribuidorVehiculo = response.distribuidorVehiculo;
					const marcaVehiculo = response.marcaVehiculo;
					const lineaVehiculo = response.lineaVehiculo;
					const versionVehiculo = response.versionVehiculo;
					const color = response.color;
					const tipov = response.tipov;

					//Llenado de informacion en los valores
					document.querySelector('#vehiculoid').value = id;
					document.querySelector('#situacion_vehiculo').value = vehiculo.SITUACION ?
						vehiculo.SITUACION : '';
					document.querySelector('#propietario_vehiculo').value = vehiculo.PERSONAFISICAIDPROPIETARIO ?
						vehiculo.PERSONAFISICAIDPROPIETARIO : vehiculo.PERSONAMORALIDPROPIETARIO + " MORAL";
					document.querySelector('#tipo_placas_vehiculo').value = vehiculo.TIPOPLACA ? vehiculo
						.TIPOPLACA : '';
					document.querySelector('#placas_vehiculo').value = vehiculo.PLACAS ? vehiculo.PLACAS : '';
					document.querySelector('#estado_vehiculo_ad').value = vehiculo.ESTADOIDPLACA ? vehiculo
						.ESTADOIDPLACA : '';
					document.querySelector('#color_tapiceria_vehiculo').value = vehiculo.SEGUNDOCOLORID ?
						vehiculo.SEGUNDOCOLORID : '';
					document.querySelector('#modelo_vehiculo').value = vehiculo.ANOVEHICULO ? vehiculo
						.ANOVEHICULO : '';

					if (vehiculo.ESTADOEXTRANJEROIDPLACA) {
						document.getElementById("estado_extranjero_vehiculo_ad").style.display = "block";
						document.getElementById("estado_vehiculo_ad").style.display = "none";
						document.querySelector('#estado_extranjero_vehiculo_ad').value = vehiculo
							.ESTADOEXTRANJEROIDPLACA ? vehiculo.ESTADOEXTRANJEROIDPLACA : '';
					}
					document.querySelector('#serie_vehiculo').value = vehiculo.NUMEROSERIE ? vehiculo
						.NUMEROSERIE : '';
					document.querySelector('#num_chasis_vehiculo').value = vehiculo.NUMEROCHASIS ? vehiculo
						.NUMEROCHASIS : '';
					document.querySelector('#marca_ad_exacta').value = vehiculo.MARCADEXAC ? vehiculo
						.MARCADEXAC : '';

					document.querySelector('#distribuidor_vehiculo_ad').value = vehiculo
						.VEHICULODISTRIBUIDORID ? vehiculo.VEHICULODISTRIBUIDORID : '';

					document.querySelector('#transmision_vehiculo').value = vehiculo.TRANSMISION ? vehiculo
						.TRANSMISION : '';
					document.querySelector('#traccion_vehiculo').value = vehiculo.TRACCION ? vehiculo.TRACCION :
						'';
					document.querySelector('#seguro_vigente_vehiculo').value = vehiculo.SEGUROVIGENTE ? vehiculo
						.SEGUROVIGENTE : '';
					document.querySelector('#servicio_vehiculo_ad').value = vehiculo.VEHICULOSERVICIOID ?
						vehiculo.VEHICULOSERVICIOID : '';

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
						document.querySelector('#downloadImage').setAttribute('download', vehiculo.FOLIOID +
							'_' + vehiculo.ANO + '_' + vehiculo.VEHICULOID + '_vehiculo.' + extension);
						document.querySelector('#downloadImage').classList.remove('d-none');
					} else {
						document.querySelector('#foto_vehiculo').setAttribute('src',
							'<?= base_url() ?>/assets/img/no_image.jpeg');
						document.querySelector('#downloadImage').setAttribute('href', '');
						document.querySelector('#downloadImage').setAttribute('download', '');
						document.querySelector('#downloadImage').classList.add('d-none');
					}
					if (vehiculo.DOCUMENTO) {
						extension = (((vehiculo.DOCUMENTO.split(';'))[0]).split('/'))[1];
						if (extension == 'pdf' || extension == 'doc') {
							document.querySelector('#doc_vehiculo').setAttribute('src',
								'<?= base_url() ?>/assets/img/file.png');
						} else {
							document.querySelector('#doc_vehiculo').setAttribute('src', vehiculo.DOCUMENTO);
						}
						document.querySelector('#downloadDoc').setAttribute('href', vehiculo.DOCUMENTO);
						document.querySelector('#downloadDoc').setAttribute('download', vehiculo.FOLIOID + '_' +
							vehiculo.ANO + '_' + vehiculo.VEHICULOID + '_documento.' + extension);
						document.querySelector('#downloadDoc').classList.remove('d-none');
					} else {
						document.querySelector('#doc_vehiculo').setAttribute('src',
							'<?= base_url() ?>/assets/img/no_image.jpeg');
						document.querySelector('#downloadDoc').setAttribute('href', '');
						document.querySelector('#downloadDoc').setAttribute('download', '');
						document.querySelector('#downloadDoc').classList.add('d-none');
					}
					let select_distribuidor = document.querySelector('#distribuidor_vehiculo_ad');

					if (marcaVehiculo) {
						let select_marca = document.querySelector('#marca_ad');
						clearSelect(select_marca);
						const option_marca = document.createElement('option');
						option_marca.value = marcaVehiculo.VEHICULOMARCAID;
						option_marca.text = marcaVehiculo.VEHICULOMARCADESCR;
						select_marca.add(option_marca, null);
					}
					if (lineaVehiculo) {
						let select_linea = document.querySelector('#linea_vehiculo_ad');
						clearSelect(select_linea);

						const option_modelo = document.createElement('option');
						option_modelo.value = lineaVehiculo.VEHICULOMODELOID;
						option_modelo.text = lineaVehiculo.VEHICULOMODELODESCR;
						select_linea.add(option_modelo, null);
					}
					if (versionVehiculo) {
						let select_version = document.querySelector('#version_vehiculo_ad');
						clearSelect(select_version);
						const option_version = document.createElement('option');
						option_version.value = versionVehiculo.VEHICULOVERSIONID;
						option_version.text = versionVehiculo.VEHICULOVERSIONDESCR;
						select_version.add(option_version, null);
					}
					document.querySelector('#marca_ad').value = vehiculo.MARCAID ? vehiculo.MARCAID : '';
					document.querySelector('#linea_vehiculo_ad').value = vehiculo.MODELOID ? vehiculo.MODELOID : '';
					document.querySelector('#version_vehiculo_ad').value = vehiculo.VEHICULOVERSIONID ?
						vehiculo.VEHICULOVERSIONID : '';
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

	//Funcion para eliminar un archivo externo, recibe por parametro el id del archivo
	function deleteArchivo(archivoid) {
		$.ajax({
			data: {
				'archivoid': archivoid,
				'folio': inputFolio.value,
				'year': year_select.value,
			},
			url: "<?= base_url('/data/delete-archivo-by-id') ?>",
			method: "POST",
			dataType: "json",
			beforeSend: function() {
				document.getElementById('deleteArchivobtn').disabled = true;

			},
			success: function(response) {
				if (response.status == 1) {
					const archivos = response.archivos.archivosexternos;
					//llena la tabla de archivos externos
					Swal.fire({
						icon: 'success',
						text: 'Archivo eliminado correctamente',
						confirmButtonColor: '#bf9b55',
					});
					let tabla_archivos = document.querySelectorAll(
						'#table-archivos tr');
					tabla_archivos.forEach(row => {
						if (row.id !== '') {
							row.remove();
						}
					});
					llenarTablaArchivosExternos(archivos);
					document.getElementById('deleteArchivobtn').disabled = false;

				} else {
					document.getElementById('deleteArchivobtn').disabled = false;

				}
			}
		});

	}

	//Funcion para eliminar un vehiculo, recibe por parametro el id del vehiculo
	function deleteVehiculo(vehiculoid) {
		$.ajax({
			data: {
				'vehiculoid': vehiculoid,
				'folio': inputFolio.value,
				'year': year_select.value,
			},
			url: "<?= base_url('/data/delete-vehiculo-by-id') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				if (response.status == 1) {
					const vehiculos = response.vehiculos;

					//Llenado de la tabla de vehiculos
					Swal.fire({
						icon: 'success',
						text: 'Vehículo eliminado correctamente',
						confirmButtonColor: '#bf9b55',
					});
					let tabla_vehiculo = document.querySelectorAll('#table-vehiculos tr');
					tabla_vehiculo.forEach(row => {
						if (row.id !== '') {
							row.remove();
						}
					});
					llenarTablaVehiculos(vehiculos);
				}
			}
		});
	}
	// Cuando se oculta el modal con el ID 'info_folio_modal'
	$(document).on('hidden.bs.modal', '#info_folio_modal', function() {
		let tabs = document.querySelectorAll('#info_tabs .nav-link');
		let contents = document.querySelectorAll('#info_content .tab-pane');
		// Remueve la clase 'active' de todas las pestañas
		tabs.forEach(element => {
			element.classList.remove('active');
		});
		// Remueve las clases 'show' y 'active' de todos los contenidos
		contents.forEach(element => {
			element.classList.remove('show');
			element.classList.remove('active');
		});
		// Agrega la clase 'active' a la primera pestaña y agrega las clases 'show' y 'active' al primer contenido

		tabs[0].classList.add('active');
		contents[0].classList.add('show');
		contents[0].classList.add('active');
	})
	// Cuando se oculta el modal con el ID 'persona fisica'

	$(document).on('hidden.bs.modal', '#folio_persona_fisica_modal', function() {
		let tabs = document.querySelectorAll('#persona_tabs .nav-item');
		let contents = document.querySelectorAll('#persona_content .tab-pane');
		// Remueve la clase 'active' de todas las pestañas

		tabs.forEach(element => {
			element.classList.remove('active');
		});
		// Remueve las clases 'show' y 'active' de todos los contenidos

		contents.forEach(element => {
			element.classList.remove('show');
			element.classList.remove('active');
		});
		// Agrega la clase 'active' a la primera pestaña y agrega las clases 'show' y 'active' al primer contenido

		tabs[0].classList.add('active');
		contents[0].classList.add('show');
		contents[0].classList.add('active');
	})

	// Cuando se oculta el modal con el ID 'persona modal'

	$(document).on('hidden.bs.modal', '#folio_persona_moral_modal', function() {
		let tabs = document.querySelectorAll('#persona_moral_tabs .nav-item');
		let contents = document.querySelectorAll('#persona_moral_content .tab-pane');
		// Remueve la clase 'active' de todas las pestañas

		tabs.forEach(element => {
			element.classList.remove('active');
		});
		// Remueve las clases 'show' y 'active' de todos los contenidos

		contents.forEach(element => {
			element.classList.remove('show');
			element.classList.remove('active');
		});
		// Agrega la clase 'active' a la primera pestaña y agrega las clases 'show' y 'active' al primer contenido

		tabs[0].classList.add('active');
		contents[0].classList.add('show');
		contents[0].classList.add('active');
	})

	//Limpia las opciones del select para que quede vacio
	function clearSelect(select_element) {
		for (let i = select_element.options.length; i >= 1; i--) {
			select_element.remove(i);
		}
	}

	//Elimina todos los guiones del elemento
	function clearGuion(e) {
		e.target.value = e.target.value.replace(/-/g, "");
	}
	//Elimina todos los caracteres especiales del texto
	function clearText(text) {
		return text
			.normalize('NFD')
			.replaceAll(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi, "$1")
			.normalize()
			.replaceAll('´', '');
	}

	// Funcion para eliminar los guiones del valor del campo y limita la longitud del valor al maxLength especificado.
	function clearInputPhone(e) {
		e.target.value = e.target.value.replace(/-/g, "");
		if (e.target.value.length > e.target.maxLength) {
			e.target.value = e.target.value.slice(0, e.target.maxLength);
		};
	}

	//Convierte todo el elemento a mayusculas
	function mayuscTextarea(e) {
		e.value = e.value.toUpperCase();
	}

	//DELITO FORM ******************************************************************

	var iti
	var iti2

	//Carga todos los formularios y elementos para llenar la denuncia, asi como las acciones submit de los formularios
	window.onload = function() {
		(function() {
			'use strict'
			var form_delito = document.querySelector('#denuncia_form');
			var form_persona_fisica = document.querySelector('#persona_fisica_form');
			var form_persona_moral = document.querySelector('#persona_moral_form');
			var form_persona_notificaciones = document.querySelector('#persona_moral_notificaciones_form');

			var form_persona_fisica_domicilio = document.querySelector('#persona_fisica_domicilio_form');
			var form_media_filiacion = document.querySelector('#form_media_filiacion');
			var form_media_filiacion_insert = document.querySelector('#form_media_filiacion_insert');
			var form_vehiculo = document.querySelector('#form_vehiculo');
			var form_parentesco = document.querySelector('#form_parentesco');
			var form_parentesco_insert = document.querySelector('#form_parentesco_insert');
			var form_relacion_ido_insert = document.querySelector('#form_asignar_arbol_delictual_insert');
			var form_fisimpdelito = document.querySelector('#form_delitos_cometidos_insert');
			var form_objetosinvolucrados = document.querySelector('#form_objetos_involucrados');
			var form_objetosinvolucrados_update = document.querySelector('#form_objetos_involucrados_update');
			var form_vehiculo_agregar = document.querySelector('#form_vehiculo_agregar');

			var selectPersonaFisica1 = document.querySelector('#personaFisica1_I');
			var form_persona_fisica_insert = document.querySelector('#persona_fisica_form_insert');
			var selectPlantilla = document.querySelector('#plantilla');
			var selectObjetoClasificacion = document.querySelector('#objeto_clasificacion');
			var selectObjetoClasificacionUpdate = document.querySelector('#objeto_update_clasificacion');

			var btn_insertar_parentesco = document.querySelector('#insertParentescoModal');
			var btnRefrescarArchivos = document.querySelector('#refrescarArchivos');
			var btnAgregarArchivos = document.querySelector('#agregarArchivosAdmin');
			var btnSubirArchivos = document.querySelector('#btnSubirArchivos');


			var btn_insertar_persona_fisica = document.querySelector('#insertPersonaFisicaModal');
			var btn_asignar_delitos = document.querySelector('#insertArbolDelictual');
			var btn_m_agregar_vehiculo = document.querySelector('#insertVehiculoModal');

			// var btn_delito_imputado = document.querySelector('#insertDelitoImputado');
			var btn_delito_cometido = document.querySelector('#insertDelitoCometido');
			var btn_objeto_involucrado_modal = document.querySelector('#modalObjetoInvolucrado');
			var btn_certificadoMedico = document.querySelector('#certificadoM');
			var btn_recepcionV = document.querySelector('#recepcionV');
			var btn_proteccionA = document.querySelector('#proteccionA');
			var btn_proteccionPer = document.querySelector('#proteccionPer');
			var btn_proteccionRon = document.querySelector('#proteccionRon');
			var btn_enviar_alertas = document.querySelector('#enviar_alertas');

			var btn_guardarFolioDoc = document.querySelector('#guardarFolioDoc');
			var btn_actualizarFolioDoc = document.querySelector('#actualizarFolioDoc');

			var refresh_btn = document.querySelector('#refresh-btn');

			var inputsText = document.querySelectorAll('input[type="text"]');
			var inputsEmail = document.querySelectorAll('input[type="email"]');
			var expediente_modal = document.querySelector('#expediente_modal');
			var year_modal = document.querySelector('#year_modal');
			var folio_modal = document.querySelector('#folio_modal');


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
			document.querySelector('#btnActualizarPoderFolio').addEventListener('click', (e) => {
				let data = {
					'folio': inputFolio.value,
					'year': year_select.value,
				}
				$.ajax({
					data: data,
					url: "<?= base_url('/data/change-poder-archivo') ?>",
					method: "POST",
					dataType: "json",
					beforeSend: function() {
						document.querySelector('#btnActualizarPoderFolio').classList.add('disabled');

					},
					success: function(response) {
						if (response.status == 1) {
							Swal.fire({
								icon: 'success',
								text: 'Poder actualizado correctamente',
								confirmButtonColor: '#bf9b55',
							});
							const archivos = response.archivos;
							if (archivos) {
								let tabla_archivos = document.querySelectorAll(
									'#table-archivos tr');
								tabla_archivos.forEach(row => {
									if (row.id !== '') {
										row.remove();
									}
								});
								llenarTablaArchivosExternos(archivos);
							}
							$('#folio_persona_moral_modal').modal('hide');
							document.querySelector('#btnActualizarPoderFolio').classList.remove('disabled');

						} else {
							Swal.fire({
								icon: 'error',
								text: 'No se actualizó el poder',
								confirmButtonColor: '#bf9b55',
							});
							document.querySelector('#btnActualizarPoderFolio').classList.remove('disabled');

						}


					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			});
			document.querySelector('#estado_pm').addEventListener('change', (e) => {
				let select_municipio = document.querySelector('#municipio_pm');
				select_municipio.disabled = true;
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
						select_municipio.disabled = false;
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			});
			document.querySelector('#municipio_pm').addEventListener('change', (e) => {
				let select_localidad = document.querySelector('#localidad_pm');
				let select_colonia = document.querySelector('#colonia_pm_select');
				let input_colonia = document.querySelector('#colonia_pm');

				let estado = document.querySelector('#estado_pm').value;
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
						select_localidad.disabled = false;
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			});

			document.querySelector('#localidad_pm').addEventListener('change', (e) => {
				let select_colonia = document.querySelector('#colonia_pm_select');
				let input_colonia = document.querySelector('#colonia_pm');

				let estado = document.querySelector('#estado_pm').value;
				let municipio = document.querySelector('#municipio_pm').value;
				let localidad = e.target.value;

				clearSelect(select_colonia);
				select_colonia.value = '';

				let data = {
					'estado_id': estado,
					'municipio_id': municipio,
					'localidad_id': localidad
				};


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
							select_colonia.disabled = false;

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
			document.querySelector('#colonia_pm_select').addEventListener('change', (e) => {
				let select_colonia = document.querySelector('#colonia_pm_select');
				let input_colonia = document.querySelector('#colonia_pm');

				if (e.target.value === '0') {
					select_colonia.classList.add('d-none');
					input_colonia.classList.remove('d-none');
					input_colonia.value = '';
					input_colonia.focus();
				} else {
					input_colonia.value = '-';
				}
			});

			document.querySelector('#estado_pm_noti').addEventListener('change', (e) => {
				let select_municipio = document.querySelector('#municipio_pm_noti');
				document.querySelector('#colonia_pm_noti').classList.add('d-none');
				document.querySelector('#colonia_pm_noti_select').classList.remove('d-none');
				select_municipio.disabled = true;
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
						select_municipio.disabled = false;
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			});
			document.querySelector('#municipio_pm_noti').addEventListener('change', (e) => {
				let select_localidad = document.querySelector('#localidad_pm_noti');
				let select_colonia = document.querySelector('#colonia_pm_noti_select');
				let input_colonia = document.querySelector('#colonia_pm_noti');

				let estado = document.querySelector('#estado_pm_noti').value;
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
						select_localidad.disabled = false;
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			});

			document.querySelector('#localidad_pm_noti').addEventListener('change', (e) => {

				let select_colonia = document.querySelector('#colonia_pm_noti_select');
				let input_colonia = document.querySelector('#colonia_pm_noti');
				let estado = document.querySelector('#estado_pm_noti').value;
				let municipio = document.querySelector('#municipio_pm_noti').value;

				let localidad = e.target.value;

				clearSelect(select_colonia);
				select_colonia.value = '';

				let data = {
					'estado_id': estado,
					'municipio_id': municipio,
					'localidad_id': localidad
				};

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
							select_colonia.disabled = false;

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
			document.querySelector('#colonia_pm_noti_select').addEventListener('change', (e) => {
				let select_colonia = document.querySelector('#colonia_pm_noti_select');
				let input_colonia = document.querySelector('#colonia_pm_noti');

				if (e.target.value === '0') {
					select_colonia.classList.add('d-none');
					input_colonia.classList.remove('d-none');
					input_colonia.value = '';
					input_colonia.focus();
				} else {
					input_colonia.value = '-';
				}
			});
			document.querySelector('#ocupacion_pf').addEventListener('change', (e) => {
				let select_ocupacion = document.querySelector('#ocupacion_pf');
				let input_ocupacion = document.querySelector('#ocupacion_pf_m');

				if (e.target.value === '999') {
					input_ocupacion.classList.remove('d-none');
					input_ocupacion.value = "";
					input_ocupacion.focus();
				} else {
					input_ocupacion.classList.add('d-none');
					input_ocupacion.value = '';
				}
			});
			document.querySelector('#subirFotoPersona').addEventListener('change', (e) => {
				let preview = document.querySelector('#fisica_foto');
				if (e.target.files && e.target.files[0]) {
					let reader = new FileReader();
					reader.onload = function(e) {
						preview.setAttribute('src', e.target.result);
					}
					reader.readAsDataURL(e.target.files[0]);
				}
			});
			$('#delito_cometido').select2({
				theme: "bootstrap"
			});

			form_delito.addEventListener('submit', (event) => {
				if (!form_delito.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
					form_delito.classList.add('was-validated')
				} else {
					event.preventDefault();
					event.stopPropagation();
					form_delito.classList.remove('was-validated')
					actualizarDenuncia();
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

			form_persona_moral.addEventListener('submit', (event) => {
				if (!form_persona_moral.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
					form_persona_moral.classList.add('was-validated')
				} else {
					event.preventDefault();
					event.stopPropagation();
					form_persona_moral.classList.remove('was-validated')
					actualizarPersonaMoral();
				}


			}, false);
			form_persona_notificaciones.addEventListener('submit', (event) => {
				if (!form_persona_notificaciones.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
					form_persona_notificaciones.classList.add('was-validated')
				} else {
					event.preventDefault();
					event.stopPropagation();
					form_persona_notificaciones.classList.remove('was-validated')
					actualizarPersonaMoralNotificacion();
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
			form_objetosinvolucrados.addEventListener('submit', (event) => {
				if (!form_objetosinvolucrados.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
					form_objetosinvolucrados.classList.add('was-validated')
				} else {
					event.preventDefault();
					event.stopPropagation();
					form_objetosinvolucrados.classList.remove('was-validated')
					agregarObjetosInvolucrados();
				}
			}, false);
			form_objetosinvolucrados_update.addEventListener('submit', (event) => {
				if (!form_objetosinvolucrados_update.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
					form_objetosinvolucrados_update.classList.add('was-validated')
				} else {
					event.preventDefault();
					event.stopPropagation();
					form_objetosinvolucrados_update.classList.remove('was-validated')
					let objeto_id = document.querySelector('#objeto_id').value;

					actualizarObjetosInvolucrados(objeto_id);
				}
			}, false);

			form_vehiculo_agregar.addEventListener('submit', (event) => {
				if (!form_vehiculo_agregar.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
					form_vehiculo_agregar.classList.add('was-validated')
				} else {
					event.preventDefault();
					event.stopPropagation();
					form_vehiculo_agregar.classList.remove('was-validated')
					agregarVehiculo();
				}
			}, false);
			btn_insertar_parentesco.addEventListener('click', (event) => {
				document.getElementById("form_media_filiacion_insert").reset();
				document.querySelector('#personaFisica1_I').value = '';
				document.querySelector('#personaFisica2_I').value = '';

				$('#relacion_parentesco_modal_insert').modal('show');
			}, false);
			btnAgregarArchivos.addEventListener('click', (e) => {
				$('#agregar_archivos_modal').modal('show');

			});
			btnSubirArchivos.addEventListener('click', (e) => {
				e.preventDefault();
				crearArchivos();

			});

			//Evento para refrescar la tabla de archivos y visualizar si el denunciante subio archivos
			btnRefrescarArchivos.addEventListener('click', (e) => {
				$.ajax({
					data: {
						'folio': inputFolio.value,
						'year': year_select.value,
					},
					url: "<?= base_url('/data/refresh_archivos') ?>",
					method: "POST",
					dataType: "json",
					beforeSend: function() {
						document.querySelector('#loading_archivos').classList.remove('d-none');
						document.querySelector('#refrescarArchivos').classList.add('d-none');

					},
					success: function(response) {
						const archivos = response.archivosexternos;
						if (archivos) {
							let tabla_archivos = document.querySelectorAll(
								'#table-archivos tr');
							tabla_archivos.forEach(row => {
								if (row.id !== '') {
									row.remove();
								}
							});
							llenarTablaArchivosExternos(archivos);
						}
						document.querySelector('#loading_archivos').classList.add('d-none');
						document.querySelector('#refrescarArchivos').classList.remove('d-none');

					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			});
			btn_insertar_persona_fisica.addEventListener('click', (event) => {
				$('#insert_persona_fisica_modal').modal('show');
			}, false);
			btn_asignar_delitos.addEventListener('click', (event) => {
				document.getElementById("form_asignar_arbol_delictual_insert").reset();
				document.querySelector('#imputado_arbol').value = '';
				document.querySelector('#delito_cometido').value = '';
				document.querySelector('#victima_ofendido').value = '';

				$('#insert_asignar_arbol_delictual_modal').modal('show');
			}, false);
			btn_objeto_involucrado_modal.addEventListener('click', (event) => {
				$('#folio_objetos').modal('show');
			}, false);

			btn_m_agregar_vehiculo.addEventListener('click', (event) => {
				$('#agregar_vehiculos').modal('show');
			}, false);
			// btn_delito_imputado.addEventListener('click', (event) => {
			//  $('#insert_asignar_delitos_cometidos_modal').modal('show');
			// }, false);

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

			//CHECK MANZANA-LOTE
			document.querySelector('#checkML_new').value = "off";
			document.querySelector('#checkML_pfd').value = "off";

			var checkML_pfd = document.getElementById('checkML_pfd');
			checkML_pfd.addEventListener('click', function() {
				if (checkML_pfd.checked) {
					document.getElementById('lblExterior_pfd').innerHTML = "Manzana";
					document.getElementById('lblInterior_pfd').innerHTML = "Lote";
					document.querySelector('#checkML_pfd').value = "on";

				} else {
					document.getElementById('lblExterior_pfd').innerHTML = "Número exterior";
					document.getElementById('lblInterior_pfd').innerHTML = "Número interior";
					document.querySelector('#checkML_pfd').value = "off";


				}
			});
			var checkML_new = document.getElementById('checkML_new');
			checkML_new.addEventListener('click', function() {
				if (checkML_new.checked) {
					document.getElementById('lblExterior_new').innerHTML = "Manzana";
					document.getElementById('lblInterior_new').innerHTML = "Lote";
					document.querySelector('#checkML_new').value = "on";

				} else {
					document.getElementById('lblExterior_new').innerHTML = "Número exterior";
					document.getElementById('lblInterior_new').innerHTML = "Número interior";
					document.querySelector('#checkML_new').value = "off";

				}
			});

			//Rellena los select del modelo del vehiculo desde el año 1800 hasta el actual
			let startYear = 1800;
			let endYear = new Date().getFullYear();
			for (let i = endYear; i > startYear; i--) {
				$('#modelo_vehiculo').append($('<option />').val(i).html(i));
				$('#modelo_vehiculo_add').append($('<option />').val(i).html(i));

			}


			//Evento change para filtrar las personas que no se hayan seleccionado
			selectPersonaFisica1.addEventListener("change", function() {
				let personaFisica2_I = document.querySelector("#personaFisica2_I")

				var datos = {
					"id": selectPersonaFisica1.value,
					'folio': document.querySelector('#input_folio_atencion_lit').value,
					'year': document.querySelector('#year_select_lit').value,
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
								let primer_apellido = element.PRIMERAPELLIDO ? element
									.PRIMERAPELLIDO : '';
								const option = document.createElement('option');
								option.value = element.PERSONAFISICAID;
								option.text = element.NOMBRE + ' ' + primer_apellido;
								personaFisica2_I.add(option, null);
							});
						}
					},
				});
			});

			//Evento change de estados para mostrar estado extranjero
			document.querySelector('#estado_vehiculo_ad').addEventListener('change', (e) => {
				let select_estado = document.querySelector('#estado_vehiculo_ad');
				let select_estado_extr = document.querySelector('#estado_extranjero_vehiculo_ad');
				if (select_estado.value == 33) {
					let select_estado = document.querySelector('#estado_vehiculo_ad');
					document.getElementById("estado_extranjero_vehiculo_ad").style.display = "block";
					document.getElementById("estado_vehiculo_ad").style.display = "none";
				}
			});
			document.querySelector('#estado_vehiculo_add_ad').addEventListener('change', (e) => {
				let select_estado_add = document.querySelector('#estado_vehiculo_add_ad');
				let select_estado_extr_add = document.querySelector('#estado_extranjero_vehiculo_add_ad');
				if (select_estado_add.value == 33) {
					let select_estado_add = document.querySelector('#estado_vehiculo_add_ad');
					document.getElementById("estado_extranjero_vehiculo_add_ad").style.display = "block";
					document.getElementById("estado_vehiculo_add_ad").style.display = "none";
				}
			});
			let select_estado_extr = document.querySelector('#estado_extranjero_vehiculo_ad');
			let select_estado_extr_add = document.querySelector('#estado_extranjero_vehiculo_add_ad');

			//Evento change para devolver a estado normal en vehiculos
			document.querySelector('#estado_extranjero_vehiculo_ad').addEventListener('change', (e) => {
				if (select_estado_extr.value == 0) {
					let select_estado = document.querySelector('#estado_vehiculo_ad');
					let select_estado_extr = document.querySelector('#estado_extranjero_vehiculo_ad');
					document.getElementById("estado_vehiculo_ad").style.display = "block";
					document.getElementById("estado_extranjero_vehiculo_ad").style.display = "none";
				}
			});
			document.querySelector('#estado_extranjero_vehiculo_add_ad').addEventListener('change', (e) => {
				if (select_estado_extr_add.value == 0) {
					let select_estado_add = document.querySelector('#estado_vehiculo_add_ad');
					let select_estado_extr_add = document.querySelector('#estado_extranjero_vehiculo_add_ad');
					document.getElementById("estado_vehiculo_add_ad").style.display = "block";
					document.getElementById("estado_extranjero_vehiculo_ad").style.display = "none";
				}
			});


			//Evento change para obtener las marcas de acuerdo al distribuidor. Limpia los select para que no se acumulen
			document.querySelector('#distribuidor_vehiculo_ad').addEventListener('change', (e) => {

				let select_marca = document.querySelector('#marca_ad');
				let select_linea = document.querySelector('#linea_vehiculo_ad');
				let select_version = document.querySelector('#version_vehiculo_ad');

				clearSelect(select_marca);
				clearSelect(select_linea);
				clearSelect(select_version);

				select_marca.disabled = true;
				select_linea.disabled = true;
				select_version.disabled = true;


				let data = {
					'distribuidor_vehiculo': e.target.value,
				}

				$.ajax({
					data: data,
					url: "<?= base_url('/data/get-marca-by-dist') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						let marcaVehiculo = response.data;
						//Itera el select de marcas
						marcaVehiculo.forEach(marca_vehiculo => {
							let option = document.createElement("option");
							option.text = marca_vehiculo.VEHICULOMARCADESCR;
							option.value = marca_vehiculo.VEHICULOMARCAID;
							select_marca.add(option);
						});
						select_marca.value = '1';
						select_marca.disabled = false;
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});

			});

			document.querySelector('#marca_add_ad').disabled = true;
			document.querySelector('#linea_vehiculo_add_ad').disabled = true;
			document.querySelector('#version_vehiculo_add_ad').disabled = true;

			document.querySelector('#distribuidor_vehiculo_add_ad').addEventListener('change', (e) => {

				let select_marca_add = document.querySelector('#marca_add_ad');
				let select_linea_add = document.querySelector('#linea_vehiculo_add_ad');
				let select_version_add = document.querySelector('#version_vehiculo_add_ad');

				clearSelect(select_marca_add);
				clearSelect(select_linea_add);
				clearSelect(select_version_add);

				select_marca_add.disabled = true;
				select_linea_add.disabled = true;
				select_version_add.disabled = true;


				let data = {
					'distribuidor_vehiculo': e.target.value,
				}

				$.ajax({
					data: data,
					url: "<?= base_url('/data/get-marca-by-dist') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						let marcaVehiculo = response.data;
						//Itera el select de marcas

						marcaVehiculo.forEach(marca_vehiculo => {
							let option = document.createElement("option");
							option.text = marca_vehiculo.VEHICULOMARCADESCR;
							option.value = marca_vehiculo.VEHICULOMARCAID;
							select_marca_add.add(option);
						});
						select_marca_add.value = '1';
						select_marca_add.disabled = false;
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});

			});
			//Evento change para obtener el modelo de acuerdo a la marca. Limpia los select para que no se acumulen

			document.querySelector('#marca_ad').addEventListener('change', (e) => {
				let select_linea = document.querySelector('#linea_vehiculo_ad');
				let select_version = document.querySelector('#version_vehiculo_ad');
				let select_distribuidor = document.querySelector('#distribuidor_vehiculo_ad');

				clearSelect(select_linea);
				clearSelect(select_version);

				select_linea.disabled = true;
				select_version.disabled = true;

				// select_linea.value = '';
				// select_version.value = '';

				// select_version.classList.remove('d-none');

				let data = {
					'marca': e.target.value,
					'dist': select_distribuidor.value,
				}

				$.ajax({
					data: data,
					url: "<?= base_url('/data/get-modelo-by-marca') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						let lineaVehiculo = response.data;
						//Itera el select de lineas

						lineaVehiculo.forEach(linea_vehiculo => {
							var option = document.createElement("option");
							option.text = linea_vehiculo.VEHICULOMODELODESCR;
							option.value = linea_vehiculo.VEHICULOMODELOID;
							select_linea.add(option);
						});
						select_linea.disabled = false;
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			});
			document.querySelector('#marca_add_ad').addEventListener('change', (e) => {
				let select_linea_add = document.querySelector('#linea_vehiculo_add_ad');
				let select_version_add = document.querySelector('#version_vehiculo_add_ad');
				let select_distribuidor_add = document.querySelector('#distribuidor_vehiculo_add_ad');

				clearSelect(select_linea_add);
				clearSelect(select_version_add);

				select_linea_add.disabled = true;
				select_version_add.disabled = true;

				// select_linea.value = '';
				// select_version.value = '';

				// select_version.classList.remove('d-none');

				let data = {
					'marca': e.target.value,
					'dist': select_distribuidor_add.value,
				}

				$.ajax({
					data: data,
					url: "<?= base_url('/data/get-modelo-by-marca') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						let lineaVehiculo = response.data;
						//Itera el select de mdoelo

						lineaVehiculo.forEach(linea_vehiculo => {
							var option = document.createElement("option");
							option.text = linea_vehiculo.VEHICULOMODELODESCR;
							option.value = linea_vehiculo.VEHICULOMODELOID;
							select_linea_add.add(option);
						});
						select_linea_add.disabled = false;

					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			});

			//Evento change para obtener la version de acuerdo al modelo. Limpia los select para que no se acumulen

			document.querySelector('#linea_vehiculo_ad').addEventListener('change', (e) => {
				let select_version = document.querySelector('#version_vehiculo_ad');
				let select_distribuidor = document.querySelector('#distribuidor_vehiculo_ad');
				let select_marca = document.querySelector('#marca_ad');

				clearSelect(select_version);

				select_version.disabled = true;

				let data = {
					'linea_vehiculo': e.target.value,
					'dist': select_distribuidor.value,
					'marca': select_marca.value,
				}

				$.ajax({
					data: data,
					url: "<?= base_url('/data/get-version-by-modelo') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						let versionVehiculo = response.data;
						//Itera el select de modelo

						versionVehiculo.forEach(version_vehiculo => {
							var option = document.createElement("option");
							option.text = version_vehiculo.VEHICULOVERSIONDESCR;
							option.value = version_vehiculo.VEHICULOVERSIONID;
							select_version.add(option);
						});
						select_version.disabled = false;


					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			});

			document.querySelector('#linea_vehiculo_add_ad').addEventListener('change', (e) => {
				let select_version_add = document.querySelector('#version_vehiculo_add_ad');
				let select_distribuidor_add = document.querySelector('#distribuidor_vehiculo_add_ad');
				let select_marca_add = document.querySelector('#marca_add_ad');

				clearSelect(select_version_add);

				select_version_add.disabled = true;

				let data = {
					'linea_vehiculo': e.target.value,
					'dist': select_distribuidor_add.value,
					'marca': select_marca_add.value,
				}

				$.ajax({
					data: data,
					url: "<?= base_url('/data/get-version-by-modelo') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						let versionVehiculo = response.data;
						//Itera el select de version

						versionVehiculo.forEach(version_vehiculo => {
							var option = document.createElement("option");
							option.text = version_vehiculo.VEHICULOVERSIONDESCR;
							option.value = version_vehiculo.VEHICULOVERSIONID;
							select_version_add.add(option);
						});

						select_version_add.disabled = false;

					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			});

			//Evento para enviar alertas cuando el folio es un caso especial
			btn_enviar_alertas.addEventListener('click', (event) => {
				const data = {
					'folio': document.querySelector('#input_folio_atencion_lit').value,
					'year': document.querySelector('#year_select_lit').value
				};
				$.ajax({
					data: data,
					url: "<?= base_url('/data/email-alerts') ?>",
					method: "POST",
					dataType: "json",
					beforeSend: function() {
						document.querySelector('#enviar_alertas').disabled = true;;

					},
					success: function(response) {
						document.querySelector('#enviar_alertas').disabled = false;;

						if (response.status == 1) {
							Swal.fire({
								icon: 'success',
								text: 'Se ha enviado la alerta correctamente',
								timer: 3000,
							});
						} else {
							Swal.fire({
								icon: 'error',
								text: 'No se enviaron las alertas',
								timer: 3000,
							});
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						document.querySelector('#enviar_alertas').disabled = false;;
						console.log(textStatus);
					}
				});
			}, false);


			//Evento change de clasificacion de objetos para obtener la subclasificacion, se limpia el select de subclasificacion para no acumular
			selectObjetoClasificacion.addEventListener("change", function() {
				let objetoSubclasificacion = document.querySelector("#objeto_subclasificacion")

				var datos = {
					"objeto_clasificacion_id": selectObjetoClasificacion.value,
				}

				$.ajax({
					method: 'POST',
					url: "<?= base_url('/data/get-objeto-sub-by-cat') ?>",
					data: datos,
					dataType: 'JSON',
					//data: {nombre:n},
					success: function(response) {
						const objetoSub = response.objetoSub;
						if (response.status == 1) {
							$('#objeto_subclasificacion').empty();

							objetoSub.forEach(element => {
								const option = document.createElement('option');
								option.value = element.OBJETOSUBCLASIFICACIONID;
								option.text = element.OBJETOSUBCLASIFICACIONDESCR;
								objetoSubclasificacion.add(option, null);
							});
						}
					},
				});
			});

			selectObjetoClasificacionUpdate.addEventListener("change", function() {
				let objetoSubclasificacionUpdate = document.querySelector("#objeto_update_subclasificacion")
				$('#objeto_update_subclasificacion').empty();

				var datos = {
					"objeto_clasificacion_id": selectObjetoClasificacionUpdate.value,
				}

				$.ajax({
					method: 'POST',
					url: "<?= base_url('/data/get-objeto-sub-by-cat') ?>",
					data: datos,
					dataType: 'JSON',
					//data: {nombre:n},
					success: function(response) {
						const objetoSub = response.objetoSub;
						if (response.status == 1) {
							$('#objeto_update_subclasificacion').empty();

							objetoSub.forEach(element => {
								const option = document.createElement('option');
								option.value = element.OBJETOSUBCLASIFICACIONID;
								option.text = element.OBJETOSUBCLASIFICACIONDESCR;
								objetoSubclasificacionUpdate.add(option, null);
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
					insertar_impdelito();
					insertarRelacionIDO();
				}
			}, false);
			// form_fisimpdelito.addEventListener('submit', (event) => {
			//  if (!form_fisimpdelito.checkValidity()) {
			//    event.preventDefault();
			//    event.stopPropagation();
			//    form_fisimpdelito.classList.add('was-validated')
			//  } else {
			//    event.preventDefault();
			//    event.stopPropagation();
			//    form_fisimpdelito.classList.remove('was-validated')
			//    insertar_impdelito();
			//  }
			// }, false);


			//DENUNCIA

			document.querySelector('#narracion_delito').addEventListener('input', (event) => {
				event.target.value = clearText(event.target.value).toUpperCase(); //Convierte a mayusculas
			}, false)

			//Se modifica el select para tener un filtro de busqueda
			$('#lugar_delito').select2({
				theme: "bootstrap"
			});

			//Evento change para obtener la localidad de acuerdo al municipio. Limpia los select para que no se acumulen

			document.querySelector('#municipio_delito').addEventListener('change', (e) => {
				//municipio del hecho mp
				let select_localidad = document.querySelector('#localidad_delito');
				let select_colonia = document.querySelector('#colonia_delito_select');
				let input_colonia = document.querySelector('#colonia_delito')

				//deshabilita los select de localidad y colonia en caso de que cambien de municipio

				select_localidad.disabled = true;
				select_colonia.disabled = true;

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
						clearSelect(select_localidad);
						clearSelect(select_colonia);
						localidades.forEach(localidad => {
							var option = document.createElement("option");
							option.text = localidad.LOCALIDADDESCR;
							option.value = localidad.LOCALIDADID;
							select_localidad.add(option);
						});
						select_localidad.disabled = false;
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			});
			//Evento change para obtener la colonia de acuerdo al municipio, localidad y estado. Limpia los select para que no se acumulen

			document.querySelector('#localidad_delito').addEventListener('change', (e) => {
				let select_colonia = document.querySelector('#colonia_delito_select');
				let input_colonia = document.querySelector('#colonia_delito');

				select_colonia.disabled = true;

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
						select_colonia.disabled = false;
					},
					error: function(jqXHR, textStatus, errorThrown) {

					}
				});
			});

			//Evento change de colonias para modifica estilos 
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

			//Funcion  para actualizar los hechos de la denuncia
			function actualizarDenuncia() {
				const data = {
					'folio': document.querySelector('#input_folio_atencion_lit').value,
					'year': document.querySelector('#year_select_lit').value,
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
					'latitud': document.querySelector('#latitud_denuncia').value,
					'longitud': document.querySelector('#longitud_denuncia').value,
					'autoriza_foto': document.querySelector('#autorizaFoto').value


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
			//Funcion  para actualizar las preguntas de la denuncia

			//PERSONA FISICA
			//Evento change para obtener los municipios de acuerdo al estado. Limpia los select para que no se acumulen

			document.querySelector('#edoorigen_pf').addEventListener('change', (e) => {
				let select_municipio = document.querySelector('#munorigen_pf');
				select_municipio.disabled = true;
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
						select_municipio.disabled = false;
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
			$('#ocupacion_new').select2({
				theme: "bootstrap"
			});
			$('#ocupacion_pf').select2({
				theme: "bootstrap"
			});

			//Obtiene la edad de acuerdo a la fecha de nacimiento
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
			document.querySelector('#municipio_select_origen_new').disabled = true;


			//Evento change para obtener los municipios de acuerdo al estado. Limpia los select para que no se acumulen

			document.querySelector('#nacionalidad_new').addEventListener('change', (e) => {
				let select_estado = document.querySelector('#estado_select_origen_new');
				let select_municipio = document.querySelector('#municipio_select_origen_new');

				//select_municipio.disabled = true;

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
							//select_municipio.disabled = false;
						},
						error: function(jqXHR, textStatus, errorThrown) {}
					});

				} else {
					clearSelect(select_municipio);
					select_estado.value = '';
					select_municipio.value = '';
				}
			});
			//Evento change para obtener los municipios de acuerdo al estado. Limpia los select para que no se acumulen

			document.querySelector('#estado_select_origen_new').addEventListener('change', (e) => {
				let select_municipio = document.querySelector('#municipio_select_origen_new');
				select_municipio.disabled = true;

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
						select_municipio.disabled = false;
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			});

			document.querySelector('#municipio_select_new').disabled = true;
			document.querySelector('#localidad_select_new').disabled = true;
			document.querySelector('#colonia_select_new').disabled = true;

			//Evento change para obtener los municipios de acuerdo al estado. Limpia los select para que no se acumulen
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
					//Evento change para obtener las localidades de acuerdo al municipio. Limpia los select para que no se acumulen

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
			//Evento change para obtener los municipios de acuerdo al estado. Limpia los select para que no se acumulen

			document.querySelector('#estado_select_new').addEventListener('change', (e) => {
				let select_municipio = document.querySelector('#municipio_select_new');
				let select_localidad = document.querySelector('#localidad_select_new');
				let select_colonia = document.querySelector('#colonia_select_new');
				let input_colonia = document.querySelector('#colonia_new');

				select_municipio.disabled = true;
				select_localidad.disabled = true;
				select_colonia.disabled = true;

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
						select_municipio.disabled = false;
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
			//Evento change para obtener las localidades de acuerdo al municipio. Limpia los select para que no se acumulen

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
						select_localidad.disabled = false;
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			});
			//Evento change para obtener los colonias de acuerdo al estado, municipio y localidad. Limpia los select para que no se acumulen

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
							select_colonia.disabled = false;

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

			//Evento change de colonias para modficar estilos
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

			//Obtiene la edad aroximada de acuerdo a la fecha de nacimiento
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

			//Funcion para eliminar los guiones y limita la longitud
			function clearInputPhone(e) {
				e.target.value = e.target.value.replace(/-/g, "");
				if (e.target.value.length > e.target.maxLength) {
					e.target.value = e.target.value.slice(0, e.target.maxLength);
				};
			}

			//Funcion para actualizar la informacion de la persona fisica
			function actualizarPersona() {
				var packetData = new FormData();
				packetData.append("subirFotoPersona", $("#subirFotoPersona")[0].files[0]);
				packetData.append("folio", document.querySelector('#input_folio_atencion_lit').value);
				packetData.append("year", document.querySelector('#year_select_lit').value);
				packetData.append("tipo_identificacion_pf", document.querySelector('#tipo_identificacion_pf')
					.value);
				packetData.append("numero_identidad_pf", document.querySelector('#numero_identidad_pf').value);
				packetData.append("nombre_pf", document.querySelector('#nombre_pf').value);
				packetData.append("apellido_paterno_pf", document.querySelector('#apellido_paterno_pf').value);
				packetData.append("apellido_materno_pf", document.querySelector('#apellido_materno_pf').value);
				packetData.append("nacionalidad_pf", document.querySelector('#nacionalidad_pf').value);
				packetData.append("idioma_pf", document.querySelector('#idioma_pf').value);
				packetData.append("edoorigen_pf", document.querySelector('#edoorigen_pf').value);
				packetData.append("munorigen_pf", document.querySelector('#munorigen_pf').value);
				packetData.append("telefono_pf", document.querySelector('#telefono_pf').value);
				packetData.append("codigo_pais_pf", document.querySelector('#codigo_pais_pf').value);
				packetData.append("codigo_pais_pf_2", document.querySelector('#codigo_pais_pf_2').value);
				packetData.append("telefono_pf_2", document.querySelector('#telefono_pf_2').value);
				packetData.append("correo_pf", document.querySelector('#correo_pf').value);
				packetData.append("fecha_nacimiento_pf", document.querySelector('#fecha_nacimiento_pf').value);
				packetData.append("edad_pf", document.querySelector('#edad_pf').value);
				packetData.append("sexo_pf", document.querySelector('#sexo_pf').value);
				packetData.append("ocupacion_pf", document.querySelector('#ocupacion_pf').value);
				packetData.append("escolaridad_pf", document.querySelector('#escolaridad_pf').value);
				packetData.append("descripcionFisica_pf", document.querySelector('#descripcionFisica_pf').value);
				packetData.append("calidad_juridica_pf", document.querySelector('#calidad_juridica_pf').value);
				packetData.append("apodo_pf", document.querySelector('#apodo_pf').value);
				packetData.append("denunciante_pf", document.querySelector('#denunciante_pf').value);
				packetData.append("facebook_pf", document.querySelector('#facebook_pf').value);
				packetData.append("instagram_pf", document.querySelector('#instagram_pf').value);
				packetData.append("twitter_pf", document.querySelector('#twitter_pf').value);
				packetData.append("pf_id", document.querySelector('#pf_id').value);
				packetData.append("ocupacion_descr", document.querySelector('#ocupacion_pf_m').value);
				packetData.append("fotografia_actual_pf", document.querySelector('#fotografia_actual_pf').value);
				packetData.append("edoc_pf", document.querySelector('#edoc_pf').value);

				// const data = {
				//  'folio': document.querySelector('#input_folio_atencion_lit').value,
				//  'year': document.querySelector('#year_select_lit').value,
				//  'pf_id': document.querySelector('#pf_id').value,
				//  'tipo_identificacion_pf': document.querySelector('#tipo_identificacion_pf').value,
				//  'numero_identidad_pf': document.querySelector('#numero_identidad_pf').value,
				//  'nombre_pf': document.querySelector('#nombre_pf').value,
				//  'apellido_paterno_pf': document.querySelector('#apellido_paterno_pf').value,
				//  'apellido_materno_pf': document.querySelector('#apellido_materno_pf').value,
				//  'nacionalidad_pf': document.querySelector('#nacionalidad_pf').value,
				//  'idioma_pf': document.querySelector('#idioma_pf').value,
				//  'edoorigen_pf': document.querySelector('#edoorigen_pf').value,
				//  'munorigen_pf': document.querySelector('#munorigen_pf').value,
				//  'telefono_pf': document.querySelector('#telefono_pf').value,
				//  'codigo_pais_pf': document.querySelector('#codigo_pais_pf').value,
				//  'telefono_pf_2': document.querySelector('#telefono_pf_2').value,
				//  'codigo_pais_pf_2': document.querySelector('#codigo_pais_pf_2').value,
				//  'correo_pf': document.querySelector('#correo_pf').value,
				//  'fecha_nacimiento_pf': document.querySelector('#fecha_nacimiento_pf').value,
				//  'edad_pf': document.querySelector('#edad_pf').value,
				//  'edoc_pf': document.querySelector('#edoc_pf').value,
				//  'sexo_pf': document.querySelector('#sexo_pf').value,
				//  'ocupacion_pf': document.querySelector('#ocupacion_pf').value,
				//  'escolaridad_pf': document.querySelector('#escolaridad_pf').value,
				//  'descripcionFisica_pf': document.querySelector('#descripcionFisica_pf').value,
				//  'calidad_juridica_pf': document.querySelector('#calidad_juridica_pf').value,
				//  'apodo_pf': document.querySelector('#apodo_pf').value,
				//  'denunciante_pf': document.querySelector('#denunciante_pf').value,
				//  'facebook_pf': document.querySelector('#facebook_pf').value,
				//  'instagram_pf': document.querySelector('#instagram_pf').value,
				//  'twitter_pf': document.querySelector('#twitter_pf').value,
				// };

				$.ajax({
					data: packetData,
					url: "<?= base_url('/data/update-persona-fisica-by-id') ?>",
					method: "POST",
					dataType: "json",
					contentType: false,
					processData: false,
					cache: false,
					success: function(response) {
						const personas = response.personas;
						const imputados = response.imputados;
						const victimas = response.victimas;
						let relacionFisFis = response.relacionFisFis;
						let fisicaImpDelito = response.fisicaImpDelito;
						const personasPropietarios = response.personasPropietarios;


						if (response.status == 1) {
							//Llena tabla de personas e itera los selects donde se usen la informacion de las personas fisicas
							let tabla_personas = document.querySelectorAll('#table-personas tr');
							tabla_personas.forEach(row => {
								if (row.id !== '') {
									row.remove();
								}
							});

							llenarTablaPersonas(response.personas);
							$('#personaFisica1_I').empty();
							let select_personaFisica1_I = document.querySelector("#personaFisica1_I")
							const option_vacio = document.createElement('option');
							option_vacio.value = '';
							option_vacio.text = 'Selecciona ...';
							option_vacio.disabled = true;
							option_vacio.selected = true;
							select_personaFisica1_I.add(option_vacio, null);
							personas.forEach(persona => {
								let primer_apellido = persona.PRIMERAPELLIDO ? persona
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = persona.PERSONAFISICAID;
								option.text = persona.NOMBRE + ' ' + primer_apellido;
								select_personaFisica1_I.add(option, null);
							});

							$('#personaFisica1').empty();
							let select_personaFisica1 = document.querySelector("#personaFisica1")
							const option_vacio_p = document.createElement('option');
							option_vacio_p.value = '';
							option_vacio_p.text = 'Selecciona ...';
							option_vacio_p.disabled = true;
							option_vacio_p.selected = true;
							select_personaFisica1.add(option_vacio_p, null);
							personas.forEach(persona => {
								let primer_apellido = persona.PRIMERAPELLIDO ? persona
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = persona.PERSONAFISICAID;
								option.text = persona.NOMBRE + ' ' + primer_apellido;
								select_personaFisica1.add(option, null);
							});
							$('#personaFisica2').empty();
							let select_personaFisica2 = document.querySelector("#personaFisica2")
							const option_vacio_pe2 = document.createElement('option');
							option_vacio_pe2.value = '';
							option_vacio_pe2.text = 'Selecciona ...';
							option_vacio_pe2.disabled = true;
							option_vacio_pe2.selected = true;
							select_personaFisica2.add(option_vacio_pe2, null);
							personas.forEach(persona => {
								let primer_apellido = persona.PRIMERAPELLIDO ? persona
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = persona.PERSONAFISICAID;
								option.text = persona.NOMBRE + ' ' + primer_apellido;
								select_personaFisica2.add(option, null);
							});
							$('#propietario').empty();
							let select_propietario = document.querySelector("#propietario");
							select_propietario.add(option_vacio, null);
							personasPropietarios.forEach(persona => {
								let primer_apellido = persona.PRIMERAPELLIDO ? persona
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = persona.PERSONAFISICAID ? persona.PERSONAFISICAID : persona.PERSONAMORALID + ' MORAL';
								option.text = persona.NOMBRE ? persona.NOMBRE + ' ' + primer_apellido : persona.DENOMINACION;
								select_propietario.add(option, null);
							});

							$('#propietario_vehiculo').empty();
							let select_propietario_v = document.querySelector("#propietario_vehiculo");
							select_propietario_v.add(option_vacio, null);
							personasPropietarios.forEach(persona => {
								let primer_apellido = persona.PRIMERAPELLIDO ? persona
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = persona.PERSONAFISICAID ? persona.PERSONAFISICAID : persona.PERSONAMORALID + ' MORAL';
								option.text = persona.NOMBRE ? persona.NOMBRE + ' ' + primer_apellido : persona.DENOMINACION;
								select_propietario_v.add(option, null);
							});


							$('#propietario_vehiculo_add').empty();
							let select_propietario_v_add = document.querySelector("#propietario_vehiculo_add");
							select_propietario_v_add.add(option_vacio, null);
							personasPropietarios.forEach(persona => {
								let primer_apellido = persona.PRIMERAPELLIDO ? persona
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = persona.PERSONAFISICAID ? persona.PERSONAFISICAID : persona.PERSONAMORALID + ' MORAL';
								option.text = persona.NOMBRE ? persona.NOMBRE + ' ' + primer_apellido : persona.DENOMINACION;
								select_propietario_v_add.add(option, null);
							});
							$('#imputado_arbol').empty();
							let select_imputado_mputado = document.querySelector("#imputado_arbol");
							select_imputado_mputado.add(option_vacio, null);
							imputados.forEach(imputado => {
								let primer_apellido = imputado.PRIMERAPELLIDO ? imputado
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = imputado.PERSONAFISICAID;
								option.text = imputado.NOMBRE + ' ' + primer_apellido;
								select_imputado_mputado.add(option, null);

							});

							$('#victima_ofendido').empty();
							let select_victima_ofendido = document.querySelector("#victima_ofendido");
							select_victima_ofendido.add(option_vacio, null);
							victimas.forEach(victima => {
								let primer_apellido = victima.PRIMERAPELLIDO ? victima
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = victima.PERSONAFISICAID ? victima.PERSONAFISICAID : victima.PERSONAMORALID + ' MORAL';
								option.text = victima.NOMBRE ? victima.NOMBRE + ' ' + primer_apellido + ' | ' + victima.PFCJDESCR : victima.DENOMINACION + ' | ' + victima.PMCJDESCR;
								select_victima_ofendido.add(option, null);
							});

							document.getElementById('subirFotoPersona').value = '';


							Swal.fire({
								icon: 'success',
								text: 'Persona física actualizada correctamente',
								confirmButtonColor: '#bf9b55',
							});
							let tabla_arbol = document.querySelectorAll(
								'#table-delitos-videodenuncia tr');
							tabla_arbol.forEach(row => {
								if (row.id !== '') {
									row.remove();
								}
							});
							llenarTablaFisFis(relacionFisFis);
							let tabla_fisimpdelito = document.querySelectorAll(
								'#table-delito-cometidos tr');
							tabla_fisimpdelito.forEach(row => {
								if (row.id !== '') {
									row.remove();
								}
							});
							llenarTablaImpDel(fisicaImpDelito);
							let tabla_parentesco = document.querySelectorAll('#table-parentesco tr');
							tabla_parentesco.forEach(row => {
								if (row.id !== '') {
									row.remove();
								}
							});
							llenarTablaParentesco(response.parentescoRelacion);


							// $('#propietario_update').empty();
							// let select_propietario_update = document.querySelector("#propietario_update");
							// select_propietario_update.add(option_vacio, null);
							// personas.forEach(persona => {
							//  const option = document.createElement('option');
							//  option.value = persona.PERSONAFISICAID;
							//  option.text = persona.NOMBRE + ' ' + persona.PRIMERAPELLIDO;
							//  select_propietario_update.add(option, null);
							// });
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

			//Eventochange de pais para obtener los municipios y localidades  cuando es diferente a MX

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
			//Evento change para obtener los municipios de acuerdo al estado. Limpia los select para que no se acumulen

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

				select_municipio.disabled = true;
				select_localidad.disabled = true;
				select_colonia.disabled = true;

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
						select_municipio.disabled = false;
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
			//Evento change para obtener las localidades de acuerdo al municipio. Limpia los select para que no se acumulen

			document.querySelector('#municipio_pfd').addEventListener('change', (e) => {
				let select_localidad = document.querySelector('#localidad_pfd');
				let select_colonia = document.querySelector('#colonia_pfd_select');
				let input_colonia = document.querySelector('#colonia_pfd');

				let estado = document.querySelector('#estado_pfd').value;
				let municipio = e.target.value;

				clearSelect(select_localidad);
				clearSelect(select_colonia);

				select_localidad.value = '';
				select_localidad.disabled = true;
				select_colonia.disabled = true;


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
						select_localidad.disabled = false;
					},
					error: function(jqXHR, textStatus, errorThrown) {}
				});
			});
			//Evento change para obtener las colonias de acuerdo a la localidad. Limpia los select para que no se acumulen

			document.querySelector('#localidad_pfd').addEventListener('change', (e) => {
				let select_colonia = document.querySelector('#colonia_pfd_select');
				let input_colonia = document.querySelector('#colonia_pfd');

				let estado = document.querySelector('#estado_pfd').value;
				let municipio = document.querySelector('#municipio_pfd').value;
				let localidad = e.target.value;

				clearSelect(select_colonia);
				select_colonia.value = '';

				select_colonia.disabled = true;

				let data = {
					'estado_id': estado,
					'municipio_id': municipio,
					'localidad_id': localidad
				};

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

							select_colonia.disabled = false;
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

			//Evento change de colonias para modificar estilos
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

			//Fujcion para actualziar el domicilio de la persona fisica
			function actualizarDomicilio() {
				const data = {
					'folio': document.querySelector('#input_folio_atencion_lit').value,
					'year': document.querySelector('#year_select_lit').value,
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
					'checkML_pfd': document.querySelector('#checkML_pfd').value,
				};

				$.ajax({
					data: data,
					url: "<?= base_url('/data/update-persona-fisica-domicilio-by-id') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						if (response.status == 1) {
							Swal.fire({
								icon: 'success',
								text: 'Domicilio actualizado correctamente',
								confirmButtonColor: '#bf9b55',
							});
							document.getElementById('lblExterior_pfd').innerHTML = "Número exterior";
							document.getElementById('lblInterior_pfd').innerHTML = "Número interior";
							document.querySelector('#checkML_pfd').value = "off";
							$('#folio_persona_fisica_modal').modal('hide');

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
			//Fujcion para actualizar el folio persona moral
			function actualizarPersonaMoral() {
				const data = {
					'folio': document.querySelector('#input_folio_atencion_lit').value,
					'year': document.querySelector('#year_select_lit').value,
					'pm_id': document.querySelector('#pm_id').value,
					'razon_social_pm': document.querySelector('#razon_social_pm').value,
					'marca_comercial_pm': document.querySelector('#marca_comercial_pm').value,
					'estado_pm': document.querySelector('#estado_pm').value,
					'municipio_pm': document.querySelector('#municipio_pm').value,
					'localidad_pm': document.querySelector('#localidad_pm').value,
					'colonia_pm_select': document.querySelector('#colonia_pm_select').value,
					'colonia_pm': document.querySelector('#colonia_pm').value,
					'calle_pm': document.querySelector('#calle_pm').value,
					'n_exterior_pm': document.querySelector('#n_exterior_pm').value,
					'n_interior_pm': document.querySelector('#n_interior_pm').value,
					'referencia_pm': document.querySelector('#referencia_pm').value,
					'telefono_pm': document.querySelector('#telefono_pm').value,
					'correo_pm': document.querySelector('#correo_pm').value,
					'giro_pm': document.querySelector('#giro_pm').value,


				};

				$.ajax({
					data: data,
					url: "<?= base_url('/data/update-persona-moral-by-id') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						const personas = response.personas;
						const imputados = response.imputados;
						const victimas = response.victimas;
						let relacionFisFis = response.relacionFisFis;
						let fisicaImpDelito = response.fisicaImpDelito;
						const personasPropietarios = response.personasPropietarios;
						const personas_morales = response.personas_morales;

						if (response.status == 1) {
							//Llena tabla de personas e itera los selects donde se usen la informacion de las personas morales
							let tabla_personas_morales = document.querySelectorAll('#table-morales tr');
							tabla_personas_morales.forEach(row => {
								if (row.id !== '') {
									row.remove();
								}
							});
							llenarTablaPersonasMorales(response.personas_morales);
							$('#personaFisica1_I').empty();
							let select_personaFisica1_I = document.querySelector("#personaFisica1_I")
							const option_vacio = document.createElement('option');
							option_vacio.value = '';
							option_vacio.text = 'Selecciona ...';
							option_vacio.disabled = true;
							option_vacio.selected = true;
							select_personaFisica1_I.add(option_vacio, null);
							personas.forEach(persona => {
								let primer_apellido = persona.PRIMERAPELLIDO ? persona
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = persona.PERSONAFISICAID;
								option.text = persona.NOMBRE + ' ' + primer_apellido;
								select_personaFisica1_I.add(option, null);
							});

							$('#personaFisica1').empty();
							let select_personaFisica1 = document.querySelector("#personaFisica1")
							const option_vacio_p = document.createElement('option');
							option_vacio_p.value = '';
							option_vacio_p.text = 'Selecciona ...';
							option_vacio_p.disabled = true;
							option_vacio_p.selected = true;
							select_personaFisica1.add(option_vacio_p, null);
							personas.forEach(persona => {
								let primer_apellido = persona.PRIMERAPELLIDO ? persona
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = persona.PERSONAFISICAID;
								option.text = persona.NOMBRE + ' ' + primer_apellido;
								select_personaFisica1.add(option, null);
							});
							$('#personaFisica2').empty();
							let select_personaFisica2 = document.querySelector("#personaFisica2")
							const option_vacio_pe2 = document.createElement('option');
							option_vacio_pe2.value = '';
							option_vacio_pe2.text = 'Selecciona ...';
							option_vacio_pe2.disabled = true;
							option_vacio_pe2.selected = true;
							select_personaFisica2.add(option_vacio_pe2, null);
							personas.forEach(persona => {
								let primer_apellido = persona.PRIMERAPELLIDO ? persona
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = persona.PERSONAFISICAID;
								option.text = persona.NOMBRE + ' ' + primer_apellido;
								select_personaFisica2.add(option, null);
							});
							$('#propietario').empty();
							let select_propietario = document.querySelector("#propietario");
							select_propietario.add(option_vacio, null);
							personasPropietarios.forEach(persona => {
								let primer_apellido = persona.PRIMERAPELLIDO ? persona
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = persona.PERSONAFISICAID ? persona.PERSONAFISICAID : persona.PERSONAMORALID + ' MORAL';
								option.text = persona.NOMBRE ? persona.NOMBRE + ' ' + primer_apellido : persona.DENOMINACION;
								select_propietario.add(option, null);
							});

							$('#propietario_vehiculo').empty();
							let select_propietario_v = document.querySelector("#propietario_vehiculo");
							select_propietario_v.add(option_vacio, null);
							personasPropietarios.forEach(persona => {
								let primer_apellido = persona.PRIMERAPELLIDO ? persona
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = persona.PERSONAFISICAID ? persona.PERSONAFISICAID : persona.PERSONAMORALID + ' MORAL';
								option.text = persona.NOMBRE ? persona.NOMBRE + ' ' + primer_apellido : persona.DENOMINACION;
								select_propietario_v.add(option, null);
							});


							$('#propietario_vehiculo_add').empty();
							let select_propietario_v_add = document.querySelector("#propietario_vehiculo_add");
							select_propietario_v_add.add(option_vacio, null);
							personasPropietarios.forEach(persona => {
								let primer_apellido = persona.PRIMERAPELLIDO ? persona
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = persona.PERSONAFISICAID ? persona.PERSONAFISICAID : persona.PERSONAMORALID + ' MORAL';
								option.text = persona.NOMBRE ? persona.NOMBRE + ' ' + primer_apellido : persona.DENOMINACION;
								select_propietario_v_add.add(option, null);
							});
							$('#imputado_arbol').empty();
							let select_imputado_mputado = document.querySelector("#imputado_arbol");
							select_imputado_mputado.add(option_vacio, null);
							imputados.forEach(imputado => {
								let primer_apellido = imputado.PRIMERAPELLIDO ? imputado
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = imputado.PERSONAFISICAID;
								option.text = imputado.NOMBRE + ' ' + primer_apellido;
								select_imputado_mputado.add(option, null);

							});

							$('#victima_ofendido').empty();
							let select_victima_ofendido = document.querySelector("#victima_ofendido");
							select_victima_ofendido.add(option_vacio, null);
							victimas.forEach(victima => {
								let primer_apellido = victima.PRIMERAPELLIDO ? victima
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = victima.PERSONAFISICAID ? victima.PERSONAFISICAID : victima.PERSONAMORALID + ' MORAL';
								option.text = victima.NOMBRE ? victima.NOMBRE + ' ' + primer_apellido + ' | ' + victima.PFCJDESCR : victima.DENOMINACION + ' | ' + victima.PMCJDESCR;
								select_victima_ofendido.add(option, null);
							});


							Swal.fire({
								icon: 'success',
								text: 'Persona moral actualizada correctamente',
								confirmButtonColor: '#bf9b55',
							});
							$('#folio_persona_moral_modal').modal('hide');

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

			//Funcion para actualizar el folio persona moral notificacion
			function actualizarPersonaMoralNotificacion() {
				const data = {
					'folio': document.querySelector('#input_folio_atencion_lit').value,
					'year': document.querySelector('#year_select_lit').value,
					'pm_id': document.querySelector('#pm_id').value,
					'n_id': document.querySelector('#n_id').value,
					'estado_pm_noti': document.querySelector('#estado_pm_noti').value,
					'municipio_pm_noti': document.querySelector('#municipio_pm_noti').value,
					'localidad_pm_noti': document.querySelector('#localidad_pm_noti').value,
					'colonia_pm_noti_select': document.querySelector('#colonia_pm_noti_select').value,
					'colonia_pm_noti': document.querySelector('#colonia_pm_noti').value,
					'calle_pm_noti': document.querySelector('#calle_pm_noti').value,
					'n_exterior_pm_noti': document.querySelector('#n_exterior_pm_noti').value,
					'n_interior_pm_noti': document.querySelector('#n_interior_pm_noti').value,
					'referencia_pm_noti': document.querySelector('#referencia_pm_noti').value,
					'telefono_pm_noti': document.querySelector('#telefono_pm_noti').value,
					'correo_pm_noti': document.querySelector('#correo_pm_noti').value
				};

				$.ajax({
					data: data,
					url: "<?= base_url('/data/update-persona-moral-notificacion-by-id') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						if (response.status == 1) {
							Swal.fire({
								icon: 'success',
								text: 'Notificación actualizada correctamente',
								confirmButtonColor: '#bf9b55',
							});
							$('#folio_persona_moral_modal').modal('hide');

						} else {
							Swal.fire({
								icon: 'error',
								text: 'No se actualizó la Notificación',
								confirmButtonColor: '#bf9b55',
							});
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						Swal.fire({
							icon: 'error',
							text: 'No se actualizó la Notificación',
							confirmButtonColor: '#bf9b55',
						});
					}
				});
			}

			//Funcion para actualizar la media filiacio de la persona fisica
			function actualizarPersonaMediaAfiliacion(id) {
				const data = {
					'folio': document.querySelector('#input_folio_atencion_lit').value,
					'year': document.querySelector('#year_select_lit').value,
					'pf_id': id,
					'ocupacion_mf': document.querySelector('#ocupacion_mf').value ? document.querySelector(
						'#ocupacion_mf').value : document.querySelector('#ocupacion_mf1').value,
					'estatura_mf': document.querySelector('#estatura_mf').value ? document.querySelector(
						'#estatura_mf').value : document.querySelector('#estatura_mf1').value,
					'peso_mf': document.querySelector('#peso_mf').value ? document.querySelector('#peso_mf')
						.value : document.querySelector('#peso_mf1').value,
					'senas_mf': document.querySelector('#senas_mf').value ? document.querySelector('#senas_mf')
						.value : document.querySelector('#senas_mf1').value,
					'colortez_mf': document.querySelector('#colortez_mf').value ? document.querySelector(
						'#colortez_mf').value : document.querySelector('#colortez_mf1').value,
					'complexion_mf': document.querySelector('#complexion_mf').value ? document.querySelector(
						'#complexion_mf').value : document.querySelector('#complexion_mf1').value,
					'contextura_ceja_mf': document.querySelector('#contextura_ceja_mf').value ? document
						.querySelector('#contextura_ceja_mf').value : document.querySelector(
							'#contextura_ceja_mf1').value,
					'cara_forma_mf': document.querySelector('#cara_forma_mf').value ? document.querySelector(
						'#cara_forma_mf').value : document.querySelector('#cara_forma_mf1').value,
					'cara_tamano_mf': document.querySelector('#cara_tamano_mf').value ? document.querySelector(
						'#cara_tamano_mf').value : document.querySelector('#cara_tamano_mf1').value,
					'caratez_mf': document.querySelector('#caratez_mf').value ? document.querySelector(
						'#caratez_mf').value : document.querySelector('#caratez_mf1').value,
					'lobulo_mf': document.querySelector('#lobulo_mf').value ? document.querySelector(
						'#lobulo_mf').value : document.querySelector('#lobulo_mf1').value,
					'forma_oreja_mf': document.querySelector('#forma_oreja_mf').value ? document.querySelector(
						'#forma_oreja_mf').value : document.querySelector('#forma_oreja_mf1').value,
					'tamano_oreja_mf': document.querySelector('#tamano_oreja_mf').value ? document
						.querySelector('#tamano_oreja_mf').value : document.querySelector('#tamano_oreja_mf1')
						.value,
					'colorC_mf': document.querySelector('#colorC_mf').value ? document.querySelector(
						'#colorC_mf').value : document.querySelector('#colorC_mf1').value,
					'formaC_mf': document.querySelector('#formaC_mf').value ? document.querySelector(
						'#formaC_mf').value : document.querySelector('#formaC_mf1').value,
					'tamanoC_mf': document.querySelector('#tamanoC_mf').value ? document.querySelector(
						'#tamanoC_mf').value : document.querySelector('#tamanoC_mf1').value,
					'peculiarC_mf': document.querySelector('#peculiarC_mf').value ? document.querySelector(
						'#peculiarC_mf').value : document.querySelector('#peculiarC_mf1').value,
					'cabello_descr_mf': document.querySelector('#cabello_descr_mf').value ? document
						.querySelector('#cabello_descr_mf').value : document.querySelector('#cabello_descr_mf1')
						.value,
					'frente_altura_mf': document.querySelector('#frente_altura_mf').value ? document
						.querySelector('#frente_altura_mf').value : document.querySelector('#frente_altura_mf1')
						.value,
					'frente_anchura_ms': document.querySelector('#frente_anchura_ms').value ? document
						.querySelector('#frente_anchura_ms').value : document.querySelector(
							'#frente_anchura_mf1').value,
					'tipoF_mf': document.querySelector('#tipoF_mf').value ? document.querySelector('#tipoF_mf')
						.value : document.querySelector('#tipoF_mf1').value,
					'frente_peculiar_mf': document.querySelector('#frente_peculiar_mf').value ? document
						.querySelector('#frente_peculiar_mf').value : document.querySelector(
							'#frente_peculiar_mf1').value,
					'colocacion_ceja_mf': document.querySelector('#colocacion_ceja_mf').value ? document
						.querySelector('#colocacion_ceja_mf').value : document.querySelector(
							'#colocacion_ceja_mf1').value,
					'ceja_mf': document.querySelector('#ceja_mf').value ? document.querySelector('#ceja_mf')
						.value : document.querySelector('#ceja_mf1').value,
					'tamano_ceja_mf': document.querySelector('#tamano_ceja_mf').value ? document.querySelector(
						'#tamano_ceja_mf').value : document.querySelector('#tamano_ceja_mf1').value,
					'grosor_ceja_mf': document.querySelector('#grosor_ceja_mf').value ? document.querySelector(
						'#grosor_ceja_mf').value : document.querySelector('#grosor_ceja_mf1').value,
					'colocacion_ojos_mf': document.querySelector('#colocacion_ojos_mf').value ? document
						.querySelector('#colocacion_ojos_mf').value : document.querySelector(
							'#colocacion_ojos_mf1').value,
					'forma_ojos_mf': document.querySelector('#forma_ojos_mf').value ? document.querySelector(
						'#forma_ojos_mf').value : document.querySelector('#forma_ojos_mf1').value,
					'tamano_ojos_mf': document.querySelector('#tamano_ojos_mf').value ? document.querySelector(
						'#tamano_ojos_mf').value : document.querySelector('#tamano_ojos_mf1').value,
					'colorO_mf': document.querySelector('#colorO_mf').value ? document.querySelector(
						'#colorO_mf').value : document.querySelector('#colorO_mf1').value,
					'peculiaridad_ojos_mf': document.querySelector('#peculiaridad_ojos_mf').value ? document
						.querySelector('#peculiaridad_ojos_mf').value : document.querySelector(
							'#peculiaridad_ojos_mf1').value,
					'nariz_tipo_mf': document.querySelector('#nariz_tipo_mf').value ? document.querySelector(
						'#nariz_tipo_mf').value : document.querySelector('#nariz_tipo_mf1').value,
					'nariz_tamano_mf': document.querySelector('#nariz_tamano_mf').value ? document
						.querySelector('#nariz_tamano_mf').value : document.querySelector('#nariz_tamano_mf1')
						.value,
					'nariz_base_mf': document.querySelector('#nariz_base_mf').value ? document.querySelector(
						'#nariz_base_mf').value : document.querySelector('#nariz_base_mf1').value,
					'nariz_peculiar_mf': document.querySelector('#nariz_peculiar_mf').value ? document
						.querySelector('#nariz_peculiar_mf').value : document.querySelector(
							'#nariz_peculiar_mf1').value,
					'nariz_descr_mf': document.querySelector('#nariz_descr_mf').value ? document.querySelector(
						'#nariz_descr_mf').value : document.querySelector('#nariz_descr_mf1').value,
					'bigote_forma_mf': document.querySelector('#bigote_forma_mf').value ? document
						.querySelector('#bigote_forma_mf').value : document.querySelector('#bigote_forma_mf1')
						.value,
					'bigote_tamaño_mf': document.querySelector('#bigote_tamaño_mf').value ? document
						.querySelector('#bigote_tamaño_mf').value : document.querySelector('#bigote_tamaño_mf1')
						.value,
					'bigote_grosor_mf': document.querySelector('#bigote_grosor_mf').value ? document
						.querySelector('#bigote_grosor_mf').value : document.querySelector('#bigote_grosor_mf1')
						.value,
					'bigote_peculiar_mf': document.querySelector('#bigote_peculiar_mf').value ? document
						.querySelector('#bigote_peculiar_mf').value : document.querySelector(
							'#bigote_peculiar_mf1').value,
					'bigote_descr_mf': document.querySelector('#bigote_descr_mf').value ? document
						.querySelector('#bigote_descr_mf').value : document.querySelector('#bigote_descr_mf1')
						.value,
					'boca_tamano_mf': document.querySelector('#boca_tamano_mf').value ? document.querySelector(
						'#boca_tamano_mf').value : document.querySelector('#boca_tamano_mf1').value,
					'boca_peculiar_mf': document.querySelector('#boca_peculiar_mf').value ? document
						.querySelector('#boca_peculiar_mf').value : document.querySelector('#boca_peculiar_mf1')
						.value,
					'labio_longitud_mf': document.querySelector('#labio_longitud_mf').value ? document
						.querySelector('#labio_longitud_mf').value : document.querySelector(
							'#labio_longitud_mf1').value,
					'labio_posicion_mf': document.querySelector('#labio_posicion_mf').value ? document
						.querySelector('#labio_posicion_mf').value : document.querySelector(
							'#labio_posicion_mf1').value,
					'labio_peculiar_mf': document.querySelector('#labio_peculiar_mf').value ? document
						.querySelector('#labio_peculiar_mf').value : document.querySelector(
							'#labio_peculiar_mf1').value,
					'labio_grosor_mf': document.querySelector('#labio_grosor_mf').value ? document
						.querySelector('#labio_grosor_mf').value : document.querySelector('#labio_grosor_mf1')
						.value,
					'dientes_tamano_mf': document.querySelector('#dientes_tamano_mf').value ? document
						.querySelector('#dientes_tamano_mf').value : document.querySelector(
							'#dientes_tamano_mf1').value,
					'dientes_tipo_mf': document.querySelector('#dientes_tipo_mf').value ? document
						.querySelector('#dientes_tipo_mf').value : document.querySelector('#dientes_tipo_mf1')
						.value,
					'dientes_peculiar_mf': document.querySelector('#dientes_peculiar_mf').value ? document
						.querySelector('#dientes_peculiar_mf').value : document.querySelector(
							'#dientes_peculiar_mf1').value,
					'dientes_descr_mf': document.querySelector('#dientes_descr_mf').value ? document
						.querySelector('#dientes_descr_mf').value : document.querySelector('#dientes_descr_mf1')
						.value,
					'barbilla_forma_mf': document.querySelector('#barbilla_forma_mf').value ? document
						.querySelector('#barbilla_forma_mf').value : document.querySelector(
							'#barbilla_forma_mf1').value,
					'barbilla_tamano_mf': document.querySelector('#barbilla_tamano_mf').value ? document
						.querySelector('#barbilla_tamano_mf').value : document.querySelector(
							'#barbilla_tamano_mf1').value,
					'barbilla_inclinacion_mf': document.querySelector('#barbilla_inclinacion_mf').value ?
						document.querySelector('#barbilla_inclinacion_mf').value : document.querySelector(
							'#barbilla_inclinacion_mf1').value,
					'barbilla_peculiar_mf': document.querySelector('#barbilla_peculiar_mf').value ? document
						.querySelector('#barbilla_peculiar_mf').value : document.querySelector(
							'#barbilla_peculiar_mf1').value,
					'barbilla_descr_mf': document.querySelector('#barbilla_descr_mf').value ? document
						.querySelector('#barbilla_descr_mf').value : document.querySelector(
							'#barbilla_descr_mf1').value,
					'barba_tamano_mf': document.querySelector('#barba_tamano_mf').value ? document
						.querySelector('#barba_tamano_mf').value : document.querySelector('#barba_tamano_mf1')
						.value,
					'barba_peculiar_mf': document.querySelector('#barba_peculiar_mf').value ? document
						.querySelector('#barba_peculiar_mf').value : document.querySelector(
							'#barba_peculiar_mf1').value,
					'barba_descr_mf': document.querySelector('#barba_descr_mf').value ? document.querySelector(
						'#barba_descr_mf').value : document.querySelector('#barba_descr_mf1').value,
					'cuello_tamano_mf': document.querySelector('#cuello_tamano_mf').value ? document
						.querySelector('#cuello_tamano_mf').value : document.querySelector('#cuello_tamano_mf1')
						.value,
					'cuello_grosor_mf': document.querySelector('#cuello_grosor_mf').value ? document
						.querySelector('#cuello_grosor_mf').value : document.querySelector('#cuello_grosor_mf1')
						.value,
					'cuello_peculiar_mf': document.querySelector('#cuello_peculiar_mf').value ? document
						.querySelector('#cuello_peculiar_mf').value : document.querySelector(
							'#cuello_peculiar_mf1').value,
					'cuello_descr_mf': document.querySelector('#cuello_descr_mf').value ? document
						.querySelector('#cuello_descr_mf').value : document.querySelector('#cuello_descr_mf1')
						.value,
					'hombro_posicion_mf': document.querySelector('#hombro_posicion_mf').value ? document
						.querySelector('#hombro_posicion_mf').value : document.querySelector(
							'#hombro_posicion_mf1').value,
					'hombro_tamano_mf': document.querySelector('#hombro_tamano_mf').value ? document
						.querySelector('#hombro_tamano_mf').value : document.querySelector('#hombro_tamano_mf1')
						.value,
					'hombro_grosor_mf': document.querySelector('#hombro_grosor_mf').value ? document
						.querySelector('#hombro_grosor_mf').value : document.querySelector('#hombro_grosor_mf1')
						.value,
					'estomago_mf': document.querySelector('#estomago_mf').value ? document.querySelector(
						'#estomago_mf').value : document.querySelector('#estomago_mf1').value,
					'escolaridad_mf': document.querySelector('#escolaridad_mf').value ? document.querySelector(
						'#escolaridad_mf').value : document.querySelector('#escolaridad_mf1').value,
					'etnia_mf': document.querySelector('#etnia_mf').value ? document.querySelector('#etnia_mf')
						.value : document.querySelector('#etnia_mf1').value,
					'estomago_descr_mf': document.querySelector('#estomago_descr_mf').value ? document
						.querySelector('#estomago_descr_mf').value : document.querySelector(
							'#estomago_descr_mf1').value,
					'discapacidad_mf': document.querySelector('#discapacidad_mf').value ? document
						.querySelector('#discapacidad_mf').value : document.querySelector('#discapacidad_mf1')
						.value,
					'diaDesaparicion': document.querySelector('#diaDesaparicion').value ? document
						.querySelector('#diaDesaparicion').value : document.querySelector('#diaDesaparicion1')
						.value,
					'lugarDesaparicion': document.querySelector('#lugarDesaparicion').value ? document
						.querySelector('#lugarDesaparicion').value : document.querySelector(
							'#lugarDesaparicion1').value,
					'vestimenta_mf': document.querySelector('#vestimenta_mf').value ? document.querySelector(
						'#vestimenta_mf').value : document.querySelector('#vestimenta_mf1').value,
					// 'parentesco_mf': document.querySelector('#parentesco_mf').value?document.querySelector('#parentesco_mf').value:document.querySelector('#parentesco_mf1').value,

				};
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


			//Funcion para actualizar el parentesco entre dos personas fisicas
			function actualizarParentesco() {
				const data = {
					'folio': document.querySelector('#input_folio_atencion_lit').value,
					'year': document.querySelector('#year_select_lit').value,
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
							llenarTablaParentesco(response.parentescoRelacion);


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

			//Funcion para agregar parentescos
			function insertarParentesco() {
				const data = {
					'folio': document.querySelector('#input_folio_atencion_lit').value,
					'year': document.querySelector('#year_select_lit').value,
					'personaFisica1': document.querySelector('#personaFisica1_I').value,
					'personaFisica2': document.querySelector('#personaFisica2_I').value,
					'parentesco_mf': document.querySelector('#parentesco_mf_I').value,
				};

				$.ajax({
					data: data,
					url: "<?= base_url('/data/create-parentesco-by-id') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						if (response.status == 1) {
							//Llena la tabla de parentescos
							$('#personaFisica2_I').empty();
							document.querySelector('#parentesco_mf_I').value = '';
							document.querySelector('#personaFisica1_I').value = '';

							let tabla_parentesco = document.querySelectorAll('#table-parentesco tr');
							tabla_parentesco.forEach(row => {
								if (row.id !== '') {
									row.remove();
								}
							});
							llenarTablaParentesco(response.parentescoRelacion);


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

			//Funcion para actualizar la informacion de un vehiculo
			function actualizarVehiculo() {
				var packetData = new FormData();

				packetData.append("subirDoc", $("#subirDoc")[0].files[0]);
				packetData.append("subirFotoV", $("#subirFotoV")[0].files[0]);


				packetData.append("folio", document.querySelector('#input_folio_atencion_lit').value);
				packetData.append("year", document.querySelector('#year_select_lit').value);

				packetData.append("tipo_vehiculo", document.querySelector('#tipo_vehiculo').value);
				packetData.append("color_vehiculo", document.querySelector('#color_vehiculo').value);
				packetData.append("tipo_placas_vehiculo", document.querySelector('#tipo_placas_vehiculo').value);
				packetData.append("placas_vehiculo", document.querySelector('#placas_vehiculo').value);
				packetData.append("estado_vehiculo_ad", document.querySelector('#estado_vehiculo_ad').value);
				packetData.append("estado_extranjero_vehiculo_ad", document.querySelector(
					'#estado_extranjero_vehiculo_ad').value);
				packetData.append("serie_vehiculo", document.querySelector('#serie_vehiculo').value);
				packetData.append("num_chasis_vehiculo", document.querySelector('#num_chasis_vehiculo').value);
				packetData.append("distribuidor_vehiculo_ad", document.querySelector('#distribuidor_vehiculo_ad')
					.value);
				packetData.append("marca_ad", document.querySelector('#marca_ad').value);
				packetData.append("linea_vehiculo_ad", document.querySelector('#linea_vehiculo_ad').value);
				packetData.append("version_vehiculo_ad", document.querySelector('#version_vehiculo_ad').value);
				packetData.append("transmision_vehiculo", document.querySelector('#transmision_vehiculo').value);
				packetData.append("traccion_vehiculo", document.querySelector('#traccion_vehiculo').value);
				packetData.append("seguro_vigente_vehiculo", document.querySelector('#seguro_vigente_vehiculo')
					.value);
				packetData.append("servicio_vehiculo_ad", document.querySelector('#servicio_vehiculo_ad').value);
				packetData.append("description_vehiculo", document.querySelector('#description_vehiculo').value);
				packetData.append("modelo_vehiculo", document.querySelector('#modelo_vehiculo').value);
				packetData.append("color_tapiceria_vehiculo", document.querySelector('#color_tapiceria_vehiculo')
					.value);
				packetData.append("marca_exacta", document.querySelector('#marca_ad_exacta').value);
				packetData.append("situacion", document.querySelector('#situacion_vehiculo').value);
				packetData.append("propietario_vehiculo", document.querySelector('#propietario_vehiculo').value);
				packetData.append("vehiculoid", document.querySelector('#vehiculoid').value);


				$.ajax({
					url: "<?= base_url('/data/update-vehiculo-by-id') ?>",
					method: "POST",
					dataType: 'json',
					contentType: false,
					data: packetData,
					processData: false,
					cache: false,
					success: function(response) {
						if (response.status == 1) {
							const vehiculos = response.vehiculos;
							Swal.fire({
								icon: 'success',
								text: 'Vehículo actualizado correctamente',
								confirmButtonColor: '#bf9b55',
							});
							//actualiza la tabla del vehiculo
							let tabla_vehiculo = document.querySelectorAll('#table-vehiculos tr');
							tabla_vehiculo.forEach(row => {
								if (row.id !== '') {
									row.remove();
								}
							});
							llenarTablaVehiculos(vehiculos);
							document.getElementById('subirFotoV').value = '';
							document.getElementById('subirDoc').value = '';

							$('#folio_vehiculo_modal').modal('hide');

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

			//funcion para subir archivos externos
			async function crearArchivos() {
				document.getElementById('archivo_content').classList.add('d-none');
				document.getElementById('documentos_anexar_spinner').classList.remove('d-none');
				let documento;
				let nombre_documento;
				//se comprime el archivo
				if ($("#documentoArchivo")[0].files && $("#documentoArchivo")[0].files[0]) {
					if ($("#documentoArchivo")[0].files[0].type == "image/jpeg" || $("#documentoArchivo")[0].files[0].type == "image/png" || $("#documentoArchivo")[0].files[0].type == "image/jpg") {
						nombre_documento = $("#documentoArchivo")[0].files[0].name;
						documento = await comprimirImagen($("#documentoArchivo")[0].files[0], 50);
					} else {
						nombre_documento = $("#documentoArchivo")[0].files[0].name;
						documento = $("#documentoArchivo")[0].files[0];
					}
				} else {
					document.getElementById('archivo_content').classList.remove('d-none');
					document.getElementById('documentos_anexar_spinner').classList.add('d-none');
					Swal.fire({
						icon: 'error',
						text: 'Debes seleccionar un documento.',
						showConfirmButton: false,
						timer: 1000
					});
					return
				}
				var packetData = new FormData();
				packetData.append("documentoArchivo", documento);
				packetData.append("folio", document.querySelector('#input_folio_atencion_lit').value);
				packetData.append("year", document.querySelector('#year_select_lit').value);
				packetData.append("nombreDocumento", nombre_documento);

				$.ajax({
					url: "<?= base_url('/data/create_archivos_admin') ?>",
					method: "POST",
					dataType: 'json',
					contentType: false,
					data: packetData,
					processData: false,
					cache: false,
					success: function(response) {
						const archivos = response.archivos.archivosexternos;
						document.getElementById('archivo_content').classList.remove('d-none');
						document.getElementById('documentos_anexar_spinner').classList.add('d-none');
						if (response.status == 1) {
							$('#agregar_archivos_modal').modal('hide');

							Swal.fire({
								icon: 'success',
								text: 'Documento agregado correctamente.',
								showConfirmButton: false,
								timer: 1000
							});

							let preview = document.querySelector('#viewDocumentoArchivo');

							document.getElementById('documentoArchivo').value = '';
							preview.setAttribute('src', '');
							//actualiza la tabla de archivos externos
							let tabla_archivos = document.querySelectorAll(
								'#table-archivos tr');
							tabla_archivos.forEach(row => {
								if (row.id !== '') {
									row.remove();
								}
							});
							llenarTablaArchivosExternos(archivos);

						} else if (response.status == 0) {
							Swal.fire({
								icon: 'error',
								text: 'No se subio el documento.',
								showConfirmButton: false,
								timer: 1000
							});
						} else if (response.status == 2) {
							Swal.fire({
								icon: 'error',
								text: 'Debes seleccionar un documento.',
								showConfirmButton: false,
								timer: 1000
							});
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus);
						document.getElementById('archivo_content').classList.remove('d-none');
						document.getElementById('documentos_anexar_spinner').classList.add('d-none');
						Swal.fire({
							icon: 'error',
							text: 'No se subio el documento.',
							showConfirmButton: false,
							timer: 1000
						});
					}
				});

			}

			//Funcion para comprimir las imagenes dado a un porcentaje
			function comprimirImagen(imagenComoArchivo, porcentajeCalidad) {
				return new Promise((resolve, reject) => {
					const $canvas = document.createElement("canvas");
					const imagen = new Image();
					imagen.onload = () => {
						$canvas.width = imagen.width;
						$canvas.height = imagen.height;
						$canvas.getContext("2d").drawImage(imagen, 0, 0);
						$canvas.toBlob(
							(blob) => {
								if (blob === null) {
									return reject(blob);
								} else {
									resolve(blob);
								}
							},
							"image/jpeg", porcentajeCalidad / 100
						);
					};
					imagen.src = URL.createObjectURL(imagenComoArchivo);
				});
			};

			//Funcion para agregar vehiculos al folio
			function agregarVehiculo() {
				var packetData = new FormData();

				packetData.append("subirDoc", $("#subirDocAdd")[0].files[0]);
				packetData.append("subirFotoV", $("#subirFotoVAdd")[0].files[0]);
				packetData.append("folio", document.querySelector('#input_folio_atencion_lit').value);
				packetData.append("year", document.querySelector('#year_select_lit').value);
				packetData.append("tipo_vehiculo", document.querySelector('#tipo_vehiculo_add').value);
				packetData.append("color_vehiculo", document.querySelector('#color_vehiculo_add').value);
				packetData.append("tipo_placas_vehiculo", document.querySelector('#tipo_placas_vehiculo_add').value);
				packetData.append("placas_vehiculo", document.querySelector('#placas_vehiculo_add').value);
				packetData.append("estado_vehiculo_ad", document.querySelector('#estado_vehiculo_add_ad').value);
				packetData.append("estado_extranjero_vehiculo_ad", document.querySelector(
					'#estado_extranjero_vehiculo_add_ad').value);
				packetData.append("serie_vehiculo", document.querySelector('#serie_vehiculo_add').value);
				packetData.append("num_chasis_vehiculo", document.querySelector('#num_chasis_vehiculo_add').value);
				packetData.append("distribuidor_vehiculo_ad", document.querySelector('#distribuidor_vehiculo_add_ad')
					.value);
				packetData.append("marca_ad", document.querySelector('#marca_add_ad').value);
				packetData.append("linea_vehiculo_ad", document.querySelector('#linea_vehiculo_add_ad').value);
				packetData.append("version_vehiculo_ad", document.querySelector('#version_vehiculo_add_ad').value);
				packetData.append("transmision_vehiculo", document.querySelector('#transmision_vehiculo_add').value);
				packetData.append("traccion_vehiculo", document.querySelector('#traccion_vehiculo_add').value);
				packetData.append("seguro_vigente_vehiculo", document.querySelector('#seguro_vigente_vehiculo_add')
					.value);
				packetData.append("servicio_vehiculo_ad", document.querySelector('#servicio_vehiculo_add_ad').value);
				packetData.append("description_vehiculo", document.querySelector('#description_vehiculo_add').value);
				packetData.append("modelo_vehiculo", document.querySelector('#modelo_vehiculo_add').value);
				packetData.append("color_tapiceria_vehiculo", document.querySelector('#color_tapiceria_vehiculo_add')
					.value);
				packetData.append("marca_exacta", document.querySelector('#marca_ad_exacta_add').value);
				packetData.append("situacion", document.querySelector('#situacion_vehiculo_add').value);
				packetData.append("propietario_vehiculo", document.querySelector('#propietario_vehiculo_add').value);


				$.ajax({
					url: "<?= base_url('/data/create-vehiculo-by-id') ?>",
					method: "POST",
					dataType: 'json',
					contentType: false,
					data: packetData,
					processData: false,
					cache: false,
					success: function(response) {
						if (response.status == 1) {
							const vehiculos = response.vehiculos;
							Swal.fire({
								icon: 'success',
								text: 'Vehículo agregado correctamente',
								confirmButtonColor: '#bf9b55',
							});
							//actualiza la tabla de vehiculos
							let tabla_vehiculo = document.querySelectorAll('#table-vehiculos tr');
							tabla_vehiculo.forEach(row => {
								if (row.id !== '') {
									row.remove();
								}
							});
							llenarTablaVehiculos(vehiculos);
							document.getElementById('subirFotoVAdd').value = '';
							document.getElementById('subirDocAdd').value = '';

							$('#agregar_vehiculos').modal('hide');
							document.getElementById("form_vehiculo_agregar").reset();
							document.querySelector('#doc_vehiculo_add').setAttribute('src', '');
							document.querySelector('#foto_vehiculo_add').setAttribute('src', '');


						} else {
							Swal.fire({
								icon: 'error',
								text: 'No se agrego la información del vehículo',
								confirmButtonColor: '#bf9b55',
							});
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus);
					}
				});
			}

			//Funcion para agregar una persona fisica con los datos del formulario
			function insertarPersonaFisica() {
				const data = {
					'folio': document.querySelector('#input_folio_atencion_lit').value,
					'year': document.querySelector('#year_select_lit').value,
					'nombre': document.querySelector('#nombre_new').value,
					'primer_apellido': document.querySelector('#apellido_paterno_new').value,
					'segundo_apellido': document.querySelector('#apellido_materno_new').value,
					'fecha_nacimiento': document.querySelector('#fecha_nacimiento_new').value,
					'edad': document.querySelector('#edad_new').value,
					'sexo': document.querySelector('#sexo_new').checked ? document.querySelector('#sexo_new')
						.value : null,
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
					'desaparecida': document.querySelector('#desaparecida_new').value,
					'ocupacion_descr': document.querySelector('#ocupacion_descr_new').value,
					'checkML_new': document.querySelector('#checkML_new').value,


				};
				$.ajax({
					data: data,
					url: "<?= base_url('/data/create-persona_fisica-by-folio') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						if (response.status == 1) {
							const personasPropietarios = response.personasPropietarios;

							document.getElementById("persona_fisica_form_insert").reset();

							//se actualiza la tabla de personas fisicas y se vuelve a rellenar los selects y tablas donde se utilicen la informacion de personas fisicas
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
							// $('#delito_cometido').empty();
							// let select_delitos_imputado = document.querySelector("#delito_cometido")
							// delitosModalidadFiltro.forEach(modalidad => {
							//  const option = document.createElement('option');
							//  option.value = modalidad.DELITOMODALIDADID;
							//  option.text = modalidad.DELITOMODALIDADDESCR;
							//  select_delitos_imputado.add(option, null);

							// });
							$('#victima_ofendido').empty();
							let select_victima_ofendido = document.querySelector("#victima_ofendido")
							victimas.forEach(victima => {
								let primer_apellido = victima.PRIMERAPELLIDO ? victima
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = victima.PERSONAFISICAID ? victima.PERSONAFISICAID : victima.PERSONAMORALID + ' MORAL';
								option.text = victima.NOMBRE ? victima.NOMBRE + ' ' + primer_apellido + ' | ' + victima.PFCJDESCR : victima.DENOMINACION + ' | ' + victima.PMCJDESCR;
								select_victima_ofendido.add(option, null);
							});

							$('#imputado_arbol').empty();
							let select_imputado_mputado = document.querySelector("#imputado_arbol")
							imputados.forEach(imputado => {
								let primer_apellido = imputado.PRIMERAPELLIDO ? imputado
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = imputado.PERSONAFISICAID;
								option.text = imputado.NOMBRE + ' ' + primer_apellido;
								select_imputado_mputado.add(option, null);

							});
							$('#personaFisica1_I').empty();
							let select_personaFisica1_I = document.querySelector("#personaFisica1_I")
							const option_vacio = document.createElement('option');
							option_vacio.value = '';
							option_vacio.text = '';
							option_vacio.disabled = true;
							option_vacio.selected = true;
							select_personaFisica1_I.add(option_vacio, null);
							personas.forEach(persona => {
								let primer_apellido = persona.PRIMERAPELLIDO ? persona
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = persona.PERSONAFISICAID;
								option.text = persona.NOMBRE + ' ' + primer_apellido;
								select_personaFisica1_I.add(option, null);
							});
							$('#personaFisica1').empty();
							let select_personaFisica1 = document.querySelector("#personaFisica1")
							const option_vacio_pe = document.createElement('option');
							option_vacio_pe.value = '';
							option_vacio_pe.text = 'Selecciona ...';
							option_vacio_pe.disabled = true;
							option_vacio_pe.selected = true;
							select_personaFisica1.add(option_vacio_pe, null);
							personas.forEach(persona => {
								let primer_apellido = persona.PRIMERAPELLIDO ? persona
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = persona.PERSONAFISICAID;
								option.text = persona.NOMBRE + ' ' + primer_apellido;
								select_personaFisica1.add(option, null);
							});
							$('#personaFisica2').empty();
							let select_personaFisica2 = document.querySelector("#personaFisica2")
							const option_vacio_pe2 = document.createElement('option');
							option_vacio_pe2.value = '';
							option_vacio_pe2.text = 'Selecciona ...';
							option_vacio_pe2.disabled = true;
							option_vacio_pe2.selected = true;
							select_personaFisica2.add(option_vacio_pe2, null);
							personas.forEach(persona => {
								let primer_apellido = persona.PRIMERAPELLIDO ? persona
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = persona.PERSONAFISICAID;
								option.text = persona.NOMBRE + ' ' + primer_apellido;
								select_personaFisica2.add(option, null);
							});
							$('#propietario').empty();
							let select_propietario = document.querySelector("#propietario");
							const option_vacio_pro = document.createElement('option');
							option_vacio_pro.value = '';
							option_vacio_pro.text = '';
							option_vacio_pro.disabled = true;
							option_vacio_pro.selected = true;
							select_propietario.add(option_vacio_pro, null);

							personasPropietarios.forEach(persona => {
								let primer_apellido = persona.PRIMERAPELLIDO ? persona
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = persona.PERSONAFISICAID ? persona.PERSONAFISICAID : persona.PERSONAMORALID + ' MORAL';
								option.text = persona.NOMBRE ? persona.NOMBRE + ' ' + primer_apellido : persona.DENOMINACION;
								select_propietario.add(option, null);
							});

							$('#propietario_vehiculo').empty();
							let select_propietario_v = document.querySelector("#propietario_vehiculo");
							const option_vacio_p = document.createElement('option');
							option_vacio_p.value = '';
							option_vacio_p.text = '';
							option_vacio_p.disabled = true;
							option_vacio_p.selected = true;
							select_propietario_v.add(option_vacio_p, null);
							personasPropietarios.forEach(persona => {
								let primer_apellido = persona.PRIMERAPELLIDO ? persona
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = persona.PERSONAFISICAID ? persona.PERSONAFISICAID : persona.PERSONAMORALID + ' MORAL';
								option.text = persona.NOMBRE ? persona.NOMBRE + ' ' + primer_apellido : persona.DENOMINACION;
								select_propietario_v.add(option, null);
							});


							$('#propietario_vehiculo_add').empty();
							let select_propietario_v_add = document.querySelector("#propietario_vehiculo_add");
							const option_vacio_p_add = document.createElement('option');
							option_vacio_p_add.value = '';
							option_vacio_p_add.text = '';
							option_vacio_p_add.disabled = true;
							option_vacio_p_add.selected = true;
							select_propietario_v_add.add(option_vacio_p_add, null);
							personasPropietarios.forEach(persona => {
								let primer_apellido = persona.PRIMERAPELLIDO ? persona
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = persona.PERSONAFISICAID ? persona.PERSONAFISICAID : persona.PERSONAMORALID + ' MORAL';
								option.text = persona.NOMBRE ? persona.NOMBRE + ' ' + primer_apellido : persona.DENOMINACION;
								select_propietario_v_add.add(option, null);
							});

							$('#propietario_update').empty();
							let select_propietario_update = document.querySelector(
								"#propietario_update");
							personasPropietarios.forEach(persona => {
								let primer_apellido = persona.PRIMERAPELLIDO ? persona
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = persona.PERSONAFISICAID ? persona.PERSONAFISICAID : persona.PERSONAMORALID + ' MORAL';
								option.text = persona.NOMBRE ? persona.NOMBRE + ' ' + primer_apellido : persona.DENOMINACION;
								select_propietario_update.add(option, null);
							});

							$('#municipio_pfd').empty();

							$('#localidad_pfd').empty();
							document.getElementById('lblExterior_new').innerHTML = "Número exterior";
							document.getElementById('lblInterior_new').innerHTML = "Número interior";
							document.querySelector('#checkML_new').value = "off";
							$('#folio_persona_fisica_modal').modal('show');
							viewPersonaFisica(response.ultimoRegistro.PERSONAFISICAID);
							// form_media_filiacion_insert.addEventListener('submit', (event) => {

							//  if (!form_media_filiacion_insert.checkValidity()) {
							//    event.preventDefault();
							//    event.stopPropagation();
							//    form_media_filiacion_insert.classList.add('was-validated')
							//  } else {
							//    event.preventDefault();
							//    event.stopPropagation();
							//    form_media_filiacion_insert.classList.remove('was-validated')

							//    // console.log(response.ultimoRegistro.PERSONAFISICAID);
							//    actualizarPersonaMediaAfiliacion(response.ultimoRegistro.PERSONAFISICAID);
							//  }

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


			//funcion para agregar un arbol delictual
			function insertarRelacionIDO() {
				const data = {
					'folio': document.querySelector('#input_folio_atencion_lit').value,
					'year': document.querySelector('#year_select_lit').value,
					'victima': document.querySelector('#victima_ofendido').value,
					'delito': document.querySelector('#delito_cometido').value,
					'imputado': document.querySelector('#imputado_arbol').value,
					'tentativa': document.querySelector('#tentativa').checked ? document.querySelector('#tentativa').value : null,
					'conviolencia': document.querySelector('#conviolencia').checked ? document.querySelector('#conviolencia').value : null,

				};
				$.ajax({
					data: data,
					url: "<?= base_url('/data/create-relacion_ido-by-folio') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						if (response.status == 3) {
							Swal.fire({
								icon: 'error',
								text: 'Esta relación de delito ya existe',
								confirmButtonColor: '#bf9b55',
							});
						} else if (response.status == 1) {


							//llena la tabla de arbol delictivo
							let tabla_relacion_fis_fis = document.querySelectorAll(
								'#table-delitos-videodenuncia tr');
							tabla_relacion_fis_fis.forEach(row => {
								if (row.id !== '') {
									row.remove();
								}
							});

							llenarTablaFisFis(response.relacionFisFis);
							$('#insert_asignar_arbol_delictual_modal').modal('hide');
							document.getElementById("form_asignar_arbol_delictual_insert").reset();
							Swal.fire({
								icon: 'success',
								text: 'Delito agregado correctamente',
								confirmButtonColor: '#bf9b55',
							});

						} else if (response.status == 0) {
							Swal.fire({
								icon: 'error',
								text: 'No se agregó el delito.',
								confirmButtonColor: '#bf9b55',
							});
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus);
					}
				});
			}

			//funcion para asignar un delito a un imputado
			function insertar_impdelito() {
				const data = {
					'folio': document.querySelector('#input_folio_atencion_lit').value,
					'year': document.querySelector('#year_select_lit').value,
					'delito': document.querySelector('#delito_cometido').value,
					'imputado': document.querySelector('#imputado_arbol').value,
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
							let tabla_fisimpdelito = document.querySelectorAll(
								'#table-delito-cometidos tr');
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
							// $('#insert_asignar_delitos_cometidos_modal').modal('hide');
							// document.getElementById("form_delitos_cometidos_insert").reset();
							// const delitosModalidadFiltro = response.delitosModalidadFiltro;
							// $('#delito_cometido').empty();
							// let select_delitos_imputado = document.querySelector("#delito_cometido")
							// delitosModalidadFiltro.forEach(modalidad => {
							//  const option = document.createElement('option');
							//  option.value = modalidad.DELITOMODALIDADID;
							//  option.text = modalidad.DELITOMODALIDADDESCR;
							//  select_delitos_imputado.add(option, null);

							// });

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

			//funcion para agregar objetos involucrados al folio
			function agregarObjetosInvolucrados() {

				const data = {
					'folio': document.querySelector('#input_folio_atencion_lit').value,
					'year': document.querySelector('#year_select_lit').value,
					'situacion': document.querySelector('#situacion_objeto').value,
					'clasificacionid': document.querySelector('#objeto_clasificacion').value,
					'subclasificacionid': document.querySelector('#objeto_subclasificacion').value,
					'marca': document.querySelector('#marca_objeto').value,
					'numserie': document.querySelector('#serie_objeto').value,
					'cantidad': document.querySelector('#cantidad_objeto').value,
					'valor': document.querySelector('#valor_objeto').value,
					'moneda': document.querySelector('#tipo_moneda').value,
					'descripciondetallada': document.querySelector('#descripcion_detallada').value,
					'propietario': document.querySelector('#propietario').value,
					'participaestado': document.querySelector('#participa_estado_objeto').value,
				};
				$.ajax({
					data: data,
					url: "<?= base_url('/data/create-objeto-involucrado-by-folio') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						const objetos = response.objetos;
						const personas = response.personas;
						const personasPropietarios = response.personasPropietarios;

						if (response.status == 1) {
							document.getElementById("form_objetos_involucrados").reset();
							$('#objeto_subclasificacion').empty();
							// $('#propietario').empty();
							$('#propietario').empty();
							let select_propietario = document.querySelector("#propietario");
							const option_vacio = document.createElement('option');
							option_vacio.value = "";
							option_vacio.text = "";
							option_vacio.disabled = true;
							option_vacio.selected = true;
							select_propietario.add(option_vacio, null);
							personasPropietarios.forEach(persona => {
								let primer_apellido = persona.PRIMERAPELLIDO ? persona
									.PRIMERAPELLIDO : '';

								const option = document.createElement('option');
								option.value = persona.PERSONAFISICAID ? persona.PERSONAFISICAID : persona.PERSONAMORALID + ' MORAL';
								option.text = persona.NOMBRE ? persona.NOMBRE + ' ' + primer_apellido : persona.DENOMINACION;
								select_propietario.add(option, null);
							});
							let tabla_objetos_involucrados = document.querySelectorAll(
								'#table-objetos-involucrados tr');
							tabla_objetos_involucrados.forEach(row => {
								if (row.id !== '') {
									row.remove();
								}
							});

							llenarTablaObjetosInvolucrados(response.objetos);

							Swal.fire({
								icon: 'success',
								text: 'Objeto añadido correctamente',
								confirmButtonColor: '#bf9b55',
							});
							$('#folio_objetos').modal('hide');

						} else if (response.status == 0) {
							Swal.fire({
								icon: 'error',
								text: 'No se agregó el objeto involucrado',
								confirmButtonColor: '#bf9b55',
							});
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus);
					}
				});
			}

			//funcion para actualizar la informacion del objeto involucrado de acuerdo a su id
			function actualizarObjetosInvolucrados(objetoid) {

				const data = {
					'folio': document.querySelector('#input_folio_atencion_lit').value,
					'year': document.querySelector('#year_select_lit').value,
					'objetoid': objetoid,
					'situacion': document.querySelector('#situacion_objeto_update').value,
					'clasificacionid': document.querySelector('#objeto_update_clasificacion').value,
					'subclasificacionid': document.querySelector('#objeto_update_subclasificacion').value,
					'marca': document.querySelector('#marca_objeto_update').value,
					'numserie': document.querySelector('#serie_objeto_update').value,
					'cantidad': document.querySelector('#cantidad_objeto_update').value,
					'valor': document.querySelector('#valor_objeto_update').value,
					'moneda': document.querySelector('#tipo_moneda_update').value,
					'descripciondetallada': document.querySelector('#descripcion_detallada_update').value,
					'propietario': document.querySelector('#propietario_update').value,
					'participaestado': document.querySelector('#participa_estado_objeto_update').value,
				};
				$.ajax({
					data: data,
					url: "<?= base_url('/data/update-objeto-involucrado-by-id') ?>",
					method: "POST",
					dataType: "json",
					success: function(response) {
						const objetos = response.objetos;
						let objeto_sub = response.objetosub;
						if (response.status == 1) {
							document.getElementById("form_objetos_involucrados_update").reset();

							let tabla_objetos_involucrados = document.querySelectorAll(
								'#table-objetos-involucrados tr');
							tabla_objetos_involucrados.forEach(row => {
								if (row.id !== '') {
									row.remove();
								}
							});

							llenarTablaObjetosInvolucrados(objetos);
							Swal.fire({
								icon: 'success',
								text: 'Objeto actualizado correctamente',
								confirmButtonColor: '#bf9b55',
							});
							$('#folio_objetos_update').modal('hide');
							$('#objeto_update_subclasificacion').empty();

						} else if (response.status == 0) {
							Swal.fire({
								icon: 'error',
								text: 'No se agregó el objeto involucrado',
								confirmButtonColor: '#bf9b55',
							});
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus);
					}
				});
			}

			//funcion para actualiar el pantesco entre 2 personas
			function actualizarParentesco() {
				const data = {
					'folio': document.querySelector('#input_folio_atencion_lit').value,
					'year': document.querySelector('#year_select_lit').value,
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
							llenarTablaParentesco(response.parentescoRelacion);


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


			//Se convierte las fechas en horario de Tijuana
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

	//Se inicializa el mapa del delito
	const initMap = (coordenaday, coordenadax) => {
		const position = {
			lat: parseFloat(coordenaday),
			lng: parseFloat(coordenadax)
		};
		const BAJACALIFORNIA_BOUNDS = {
			north: 32.718754,
			south: 28,
			west: -118.407649,
			east: -112.65424,
			// 28,-118.407649 – 32.718754,-112.65424
			// Check bound in https://developers-dot-devsite-v2-prod.appspot.com/maps/documentation/utils/geocoder
		};
		map = new google.maps.Map(document.getElementById("map_denuncia"), {
			center: position,
			zoom: 15,
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
		addMarker(position, map, 'denuncia');

		locationButton.addEventListener("click", () => {
			currentPosition();
		});
	};

	//funcion para obtener la posicion actual
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

	//Funcion para manejar los errores de localizacion
	const handleLocationError = (browserHasGeolocation, infoWindow, pos) => {
		infoWindow.setPosition(pos);
		infoWindow.setContent(
			browserHasGeolocation ?
			"Error: The Geolocation service failed." :
			"Error: Your browser doesn't support geolocation."
		);
		infoWindow.open(map);
	};

	//Funcion para añadir la longitud y posicion al mapa
	const addMarker = (position, map, prov) => {

		marker ? (marker.setMap(null), (marker = null)) : null;
		marker = new google.maps.Marker({
			position,
		});
		if (prov == 'current' || prov == 'denuncia') {
			document.getElementById('longitud_denuncia').value = position['lng'];
			document.getElementById('latitud_denuncia').value = position['lat'];

		} else {
			document.getElementById('longitud_denuncia').value = position;
			let stringpos = document.getElementById('longitud_denuncia').value
			if (typeof stringpos == 'string') {
				stringpos = stringpos.replace('(', '');
				stringpos = stringpos.replace(')', '');
				stringpos = stringpos.replace(' ', '');

				let arr = stringpos.split(',');
				const positionMake = {
					lat: arr[0],
					lng: arr[1]
				};
				document.getElementById('longitud_denuncia').value = positionMake['lng'];
				document.getElementById('latitud_denuncia').value = positionMake['lat'];

			}
		}


		// map.setCenter(position);
		marker.setMap(map);
	};

	window.initMap = initMap;
</script>
<?php include 'litigantes_modals/info_folio_modal.php' ?>
<?php include 'video_denuncia_modals/folios_atendidos_modal.php' ?>
<?php include 'video_denuncia_modals/load_save_archivos_modal.php' ?>
<?php include 'video_denuncia_modals/insert_persona_fisica_modal.php' ?>
<?php include 'video_denuncia_modals/insert_asignar_arbol_delictual_modal.php' ?>
<?php include 'video_denuncia_modals/insert_asignar_delitos_cometidos_modal.php' ?>
<?php include 'video_denuncia_modals/agregar_vehiculos_modal.php' ?>
<?php include 'video_denuncia_modals/objetos_involucrados_modal.php' ?>
<?php include 'video_denuncia_modals/relacion_parentesco_modal_insert.php' ?>
<?php include 'video_denuncia_modals/agregar_archivosExternos_modal.php' ?>
<?php include 'video_denuncia_modals/relacion_parentesco_modal.php' ?>
<?php include 'video_denuncia_modals/vehiculo_modal.php' ?>
<?php include 'video_denuncia_modals/objetos_involucrados_modal_update.php' ?>

<?php include 'litigantes_modals/salida_modal_litigantes.php' ?>
<?php include 'video_denuncia_modals/persona_modal.php' ?>
<?php include 'video_denuncia_modals/persona_moral_modal.php' ?>
<?php include 'video_denuncia_modals/media_filiacion_modal.php' ?>
<?php include 'video_denuncia_modals/domicilio_modal.php' ?>





<?php $this->endSection() ?>