<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php $session = session(); ?>
<div class="row" id="videoDen">
	<div id="card1" class="col-3">
		<div class="card rounded bg-white shadow" style="height: 190px;">
			<div class="card-body">
				<div class="row">
					<div class="col-12">
						<div class="form-group mb-1">
							<div class="input-group mb-1">
								<input type="text" class="form-control" id="input_folio_atencion" placeholder="Folio de atención..." value="<?= isset($body_data->folio) ? $body_data->folio : '' ?>">
							</div>
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
				<textarea class="form-control" id="notas_mp" placeholder="Descripción del caso..." rows="10" required maxlength="300"></textarea>
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

	const card1 = document.querySelector('#card1');
	const card2 = document.querySelector('#card2');
	const card3 = document.querySelector('#card3');
	const card4 = document.querySelector('#card4');
	const card5 = document.querySelector('#card5');
	var respuesta;

	buscar_btn.addEventListener('click', (e) => {
		$.ajax({
			data: {
				'folio': inputFolio.value
			},
			url: "<?= base_url('/data/get-folio-information') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				respuesta = (response);
				if (response.status === 1) {
					const folio = response.folio;
					const preguntas = response.preguntas_iniciales;
					const personas = response.personas;
					const domicilios = response.domicilio;
					const vehiculos = response.vehiculos;
					const folioM = response.folioMunicipio;
					const folioC = response.folioColonia;
					const foliol = response.folioLugar;

					console.log('status 1')
					inputFolio.classList.add('d-none');
					buscar_btn.classList.add('d-none');
					buscar_nuevo_btn.classList.remove('d-none');

					card2.classList.remove('d-none');
					card3.classList.remove('d-none');
					card4.classList.remove('d-none');
					card5.classList.remove('d-none');

					document.querySelector('#delito_dash').value = folio.DELITODENUNCIA;
					document.querySelector('#delito_descr_dash').value = folio.HECHONARRACION;
					//PREGUNTAS INICIALES
					document.querySelector('#es_menor').value = preguntas.ES_MENOR;
					document.querySelector('#eres_tu').value = preguntas.ERES_TU;
					document.querySelector('#es_tercera_edad').value = preguntas.ES_TERCERA_EDAD;
					document.querySelector('#tiene_discapacidad').value = preguntas.TIENE_DISCAPACIDAD;
					document.querySelector('#fue_con_arma').value = preguntas.FUE_CON_ARMA;
					document.querySelector('#esta_desaparecido').value = preguntas.ESTA_DESAPARECIDO;
					document.querySelector('#lesiones').value = preguntas.LESIONES;
					document.querySelector('#lesiones_visibles').value = preguntas.LESIONES_VISIBLES;

					//DENUNCIA
					document.querySelector('#delito').value = folio.DELITODENUNCIA;
					document.querySelector('#municipio').value = folioM.MUNICIPIODESCR;
					document.querySelector('#colonia').value = folioC.COLONIADESCR;
					document.querySelector('#calle').value = folio.HECHOCALLE;
					document.querySelector('#exterior').value = folio.HECHONUMEROCASA;
					document.querySelector('#interior').value = folio.HECHONUMEROCASAINT;
					document.querySelector('#lugar').value = foliol.HECHODESCR;
					document.querySelector('#hora').value = folio.HECHOHORA;
					document.querySelector('#fecha').value = folio.HECHOFECHA;
					document.querySelector('#narracion').value = folio.HECHONARRACION;

					if (folio.DELITODENUNCIA == "ROBO DE VEHÍCULO") {
						$('#v-pills-vehiculos-tab').css('display', 'block');

					} else {
						$('#v-pills-vehiculos-tab').css('display', 'NONE');
					}


					//PERSONAS
					var k = 1; //contador para asignar id al boton que borrara la fila
					for (let i = 0; i < personas.length; i++) {
						var btn = `<button type='button'  class='btn btn-primary' onclick='viewPersonaFisica(${personas[i].PERSONAFISICAID},${personas[i].CALIDADJURIDICAID})'><i class='fas fa-eye'></i></button>`

						var fila = '<tr id="row' + i + '"><td>' +
							personas[i].NOMBRE + '</td><td>' +
							personas[i].PERSONACALIDADJURIDICADESCR +
							'</td><td>' + btn + '</td></tr>'; //esto seria lo que contendria la fila

						$('#table-personas tr:first').after(fila);
						$("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
						var nFilas = $("#personas tr").length;
						$("#adicionados").append(nFilas - 1);
					}

					for (let i = 0; i < domicilios.length; i++) {
						var btnDomicilio = `<button type='button' class='btn btn-primary' onclick='viewDomicilio(${personas[i].PERSONAFISICAID})'><i class='fas fa-eye'></i></button>`

						var fila2 = '<tr id="row' + i + '"><td>' +
							personas[i].NOMBRE + '</td><td>' +
							personas[i].PERSONACALIDADJURIDICADESCR +
							'</td><td>' + btnDomicilio + '</td></tr>';
						k++;
						//DOMICILIO

						$('#table-domicilio tr:first').after(fila2);
						$("#adicionados").text("");
						var nFilas = $("#domicilio tr").length;
						$("#adicionados").append(nFilas - 1);


					}
					for (let i = 0; i < personas.length; i++) {
						var btnVehiculo = `<button type='button' class='btn btn-primary' onclick='viewVehiculo(${k})'><i class='fas fa-eye'></i></button>`;
						var fila3 = '<tr id="row' + i + '"><td>' +
							vehiculos[i].PLACAS + '</td><td>' +
							vehiculos[i].NUMEROSERIE +
							'</td><td>' + btnVehiculo + '</td></tr>';
						k++;
						$('#table-vehiculos tr:first').after(fila3);
						$("#adicionados").text("");
						var nFilas = $("#vehiculos tr").length;
						$("#vehiculos").append(nFilas - 1);


					}
					/*	$("#table-personas").DataTable({
							"responsive": true,
							"lengthChange": false,
							"autoWidth": false,
						});

						$("#table-domicilio").DataTable({
							"responsive": true,
							"lengthChange": false,
							"autoWidth": false,
						});


						$("#table-vehiculos").DataTable({
							"responsive": true,
							"lengthChange": false,
							"autoWidth": false,
						});*/

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

	buscar_nuevo_btn.addEventListener('click', () => {

		location.reload();
		buscar_nuevo_btn.classList.add('d-none');
		inputFolio.classList.remove('d-none');
		buscar_btn.classList.remove('d-none');

		card2.classList.add('d-none');
		card3.classList.add('d-none');
		card4.classList.add('d-none');
		card5.classList.add('d-none');
	});
</script>

<script>
	function viewPersonaFisica(id, calidad) {
		$.ajax({
			data: {
				'folio': document.querySelector('#input_folio_atencion').value,
				'id': id,
				'idcalidad': calidad
			},
			url: "<?= base_url('/data/get-persona-fisica-by-id') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				const calidad = response.calidadjuridica;
				const personaid = response.personaid;
				const tipoi = response.tipoidentificacion;
				const nacionalidad = response.nacionalidad;
				const edocivil = response.edocivil;
				const pidioma = response.idioma;
				const desaparecida = response.personaDesaparecida;
				document.querySelector('#img_denunciante').setAttribute('src', 'data:image/jpg;base64,' + personaid.FOTO);
				document.querySelector('#calidad_juridicaP').value = calidad.PERSONACALIDADJURIDICADESCR;
				document.querySelector('#nombrePersona').value = personaid.NOMBRE;
				document.querySelector('#apellido_paternoP').value = personaid.PRIMERAPELLIDO;
				document.querySelector('#apellido_maternoP').value = personaid.SEGUNDOAPELLIDO;
				document.querySelector('#sexoP').value = personaid.SEXO == 'F' ? 'FEMENINO' : 'MASCULINO';
				document.querySelector('#denunciantep').value = personaid.DENUNCIANTE == 'S' ? 'SI' : 'NO';
				document.querySelector('#vivaP').value = personaid.VIVA == 'S' ? 'SI' : 'NO';
				document.querySelector('#desaparecidaP').value = personaid.DESAPARECIDA == 'N' ? 'NO' : 'S';
				if (personaid.CALIDADJURIDICAID == 1) {
					document.getElementById("img_denuncianteDiv").style.display = "block";
				}else{
					document.getElementById("img_denuncianteDiv").style.display = "none";

				}
			
				if (personaid.TIPOIDENTIFICACIONID == null) {
					document.querySelector('#tipoiP').value = "NULL";
				} else {
					document.querySelector('#tipoiP').value = tipoi.PERSONATIPOIDENTIFICACIONDESCR;
				}
				if (personaid.NACIONALIDADID == null) {
					document.querySelector('#nacionalidadp').value = "NULL";
				} else {
					document.querySelector('#nacionalidadp').value = nacionalidad.PERSONANACIONALIDADDESCR;
				}
				if (personaid.ESTADOCIVILID == null) {
					document.querySelector('#edocp').value = "NULL";
				} else {
					document.querySelector('#edocp').value = edocivil.PERSONAESTADOCIVILDESCR;
				}
				if (personaid.PERSONAIDIOMAID == null) {
					document.querySelector('#idiomap').value = "NULL";
				} else {
					document.querySelector('#idiomap').value = pidioma.PERSONAIDIOMADESCR;
				}
				document.querySelector('#fecha_nacimientoP').value = personaid.FECHANACIMIENTO;
				document.querySelector('#edadP').value = personaid.EDAD;
				document.querySelector('#numero_identidadP').value = personaid.NUMEROIDENTIFICACION;
				document.querySelector('#telefonoP').value = personaid.TELEFONO;
				document.querySelector('#apodo').value = personaid.APODO;
				document.querySelector('#correoP').value = personaid.CORREO;

				console.log(desaparecida);

				//desaparecida
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
						document.querySelector('#diaDesaparicion').value = desaparecida[index].DIA_DESAPARICION;
						document.querySelector('#lugarDesaparicion').value = desaparecida[index].LUGAR_DESAPARICION;
						document.querySelector('#vestimentaD').value = desaparecida[index].VESTIMENTA;
						document.querySelector('#parentescoD').value = desaparecida[index].PARENTESCO;
						//document.querySelector('#fotoDes').value = desaparecida[index].FOTOGRAFIA;
						document.querySelector('#autorizaFoto').value = desaparecida[index].AUTORIZA_FOTO;
					}

					document.getElementById("personadesaparecida").style.display = "block";

				} else {
					document.getElementById("personadesaparecida").style.display = "none";
				}
				$('#folio_persona_fisica_modal').modal('show');

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
				var qpais = document.querySelector('#paisp').value;
				var qestado = document.querySelector('#estadoper').value;
				var qmunicipio = document.querySelector('#municipiop').value;
				var qlocalidad = document.querySelector('#localidadp').value;

				if (persondom.PAIS == null) {
					document.querySelector('#paisp').value = "NULL";
				} else {
					document.querySelector('#paisp').value = persondom.PAIS;
				}
				if (persondom.ESTADOID == null) {
					document.querySelector('#estadoper').value = "NULL";
				} else {
					document.querySelector('#estadoper').value = estado.ESTADODESCR;
				}
				if (persondom.MUNICIPIOID == null) {
					document.querySelector('#municipiop').value = "NULL";
				} else {
					document.querySelector('#municipiop').value = municipio.MUNICIPIODESCR;
				}
				if (persondom.LOCALIDADID == null) {
					document.querySelector('#localidadp').value = "NULL";
				} else {
					document.querySelector('#localidadp').value = localidad.LOCALIDADDESCR;
				}
				document.querySelector('#coloniap').value = persondom.COLONIADESCR;
				document.querySelector('#cp').value = persondom.CP;
				document.querySelector('#callep').value = persondom.CALLE;
				document.querySelector('#exteriorp').value = persondom.NUMEROCASA;
				document.querySelector('#interiorp').value = persondom.NUMEROINTERIOR;
				document.querySelector('#zonap').value = persondom.ZONA == 'U' ? 'URBANA' : 'RURAL';;
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
				document.querySelector('#color_vehiculo').value = color.VEHICULOCOLORDESCR;
				document.querySelector('#foto_vehiculo').setAttribute('src', 'data:image/jpg;base64,' + vehiculo.FOTO);
				document.querySelector('#downloadImage').setAttribute('href', 'data:image/jpg;base64,' + vehiculo.FOTO);
				document.querySelector('#description_vehiculo').value = vehiculo.SENASPARTICULARES;
				document.querySelector('#doc_vehiculo').setAttribute('src', 'data:image/jpg;base64,' + vehiculo.DOCUMENTO);
				document.querySelector('#downloadDoc').setAttribute('href', 'data:image/jpg;base64,' + vehiculo.DOCUMENTO);

				$('#folio_vehiculo_modal').modal('show');
			}
		});
	}


</script>

<?php include('video_denuncia_modals/info_folio_modal.php') ?>
<?php include('video_denuncia_modals/salida_modal.php') ?>
<?php include('video_denuncia_modals/persona_modal.php') ?>
<?php include('video_denuncia_modals/vehiculo_modal.php') ?>
<?php include('video_denuncia_modals/domicilio_modal.php') ?>
<?php $this->endSection() ?>