<?= $this->extend('client/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
	<div class="col-12">
		<div class="card rounded bg-yellow shadow text-center mb-4">
			<img src="<?= base_url() ?>/assets/img/banner.png" width="100%" height="100%" alt="" />
		</div>
		<div class="card rounded shadow">
			<div class="card-body p-0 py-3 p-sm-5">
				<div class="container">
					<h1 class="text-center fw-bolder pb-1 text-blue">DENUNCIA</h1>
					<p class="text-center fw-bold text-blue ">Llena los campos siguientes para continuar tu denuncia</p>
					<p class="text-center pb-5">Los campos con un <span class="asterisco-rojo">*</span> son obligatorios</p>
					<form action="<?= base_url() ?>/denuncia/dashboard/video-denuncia" class="row needs-validation" novalidate>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4">
							<label for="delito-text" class="form-label fw-bold input-required">Delito:</label>
							<select class="form-select" id="delito" name="delito" required>
								<option selected disabled value="">Elige la categoría</option>
								<option value="0">ABUSO DE AUTORIDAD</option>
								<option value="1">ABUSO DE CONFIANZA</option>
								<option value="2">ABUSO DE RETENCIÓN</option>
								<option value="3">ABUSO SEXUAL</option>
								<option value="4">AMENAZAS - EJECUTADAS CON ARMA DE FUEGO, ARMA BLANCA U OBJETO CONTUNDENTE.</option>
								<option value="5">ALLANAMIENTO DE MORADA, EJECUTADO CON VIOLENCIA.</option>
								<option value="6">ATAQUES A LA VÍAS DE COMUNICACIÓN Y A LOS MEDIOS DE TRANSPORTE.</option>
								<option value="7">BIGAMIA</option>
								<option value="8">COBRANZA ILEGITIMA.</option>
								<option value="9">CORRUPCIÓN</option>
								<option value="10">DAÑO EN PROPIEDAD AJENA</option>
								<option value="11">DAÑO EN PROPIEDAD AJENA AGRAVADO POR INCENDIO</option>
								<option value="12">DAÑO EN PROPIEDAD AJENA AGRAVADO POR INUNDACIÓN</option>
								<option value="13">DAÑO EN PROPIEDAD AJENA AGRAVADO POR EXPLOSIÓN</option>
								<option value="14">DAÑO EN PROPIEDAD AJENA CULPOSO</option>
								<option value="15">DELITOS CONTRA EL AMBIENTE</option>
								<option value="16">DELITOS CONTRA LA INTIMIDAD Y LA IMAGEN</option>
								<option value="17">DELITOS CONTRA INVIOLABILIDAD DEL SECRETO Y DE LOS SISTEMAS Y EQUIPO DE COMPUTO Y PROTECCIÓN DE LOS DATOS PERSONALES</option>
								<option value="18">DELITOS DE ABOGADOS</option>
								<option value="19">DELITOS ELECTORALES</option>
								<option value="20">DESPOJO, EJECUTADO CON VIOLENCIA.</option>
								<option value="21">EXTORSIÓN</option>
								<option value="22">FALSEDAD ANTE LAS AUTORIDADES</option>
								<option value="23">FALSIFICACIÓN DE DOCUMENTOS</option>
								<option value="24">FALSIFICAR SELLOS, MARCAS, LLAVE U OTROS OBJETOS.</option>
								<option value="25">FRAUDE</option>
								<option value="26">FRAUDE PROCESAL</option>
								<option value="27">HOSTIGAMIENTO</option>
								<option value="28">HOSTIGAMIENTO SEXUAL</option>
								<option value="29">INCESTO</option>
								<option value="30">INCUMPLIMIENTO DE OBLIGACIONES DE ASISTENCIA FAMILIAR</option>
								<option value="31">INHUMACIÓN Y EXHUMACIÓN DE CADÁVERES</option>
								<option value="32">LESIONES (NAC)</option>
								<option value="33">LESIONES CAUSADAS POR ANIMAL</option>
								<option value="34">LESIONES POR CULPA</option>
								<option value="35">LOCALIZACIÓN DE PERSONA</option>
								<option value="36">MALTRATO O CRUELDAD ANIMAL</option>
								<option value="37">OMISIÓN DE CUIDADO</option>
								<option value="38">PELIGRO DE CONTAGIO DE SALUD</option>
								<option value="39">PORNOGRAFÍA DE PERSONA MENOR DE 18 AÑOS</option>
								<option value="40">QUEBRANTAMIENTO DE SELLOS</option>
								<option value="41">RECEPCIÓN U OCULTACIÓN DE BIENES PRODUCTO DE UN DELITO</option>
								<option value="42">RESPONSABILIDAD MÉDICA Y TÉCNICA</option>
								<option value="43">ROBO</option>
								<option value="44">ROBO CALIFICADO A CASA HABITACIÓN</option>
								<option value="45">ROBO CALIFICADO A LUGAR CERRADO</option>
								<option value="46">ROBO CALIFICADO DE DEPENDIENTE</option>
								<option value="47">ROBO CON VIOELENCIA</option>
								<option value="48">ROBO DE VEHÍCULO</option>
								<option value="49">ROBO DE VEHÍCULO CON VIOLENCIA</option>
								<option value="50">SUSTRACCIÓN DE MENORES</option>
								<option value="51">USO DE DOCUMENTOS FALSOS</option>
								<option value="52">USURPACIÓN DE FUNCIONES PÚBLICAS</option>
								<option value="53">USURPACIÓN DE PROFESIONES</option>
								<option value="54">SUPLANTACIÓN, USURPACIÓN DE IDENTIDAD.</option>
								<option value="55">VIOLACIÓN DE CORRESPONDENCIA</option>
								<option value="56">VIOLENCIA FAMILIAR</option>
							</select>
							<div class="invalid-feedback">
								Selecciona el delito
							</div>
						</div>

						<div class="col-12 col-sm-6 col-md-6 col-lg-4">
							<label for="municipio" class="form-label fw-bold input-required">Municipio:</label>
							<select class="form-select" id="municipio" name="municipio" required>
								<option selected disabled value="">Elige el municipio</option>
								<option value="1">TIJUANA - ZONA COSTA - 204</option>
								<option value="2">PLAYAS DE ROSARITO - ZONA COSTA - 205</option>
								<option value="3">TECATE - ZONA COSTA - 203</option>
								<option value="4">MEXICALI (INCLUYE SAN FELIPE) - ZONA MEXICALI - 202</option>
								<option value="5">ENSENADA (INCLUYE SAN QUINTIN ) - ZONA ENSENADA - 201</option>
							</select>
							<div class="invalid-feedback">
								Por favor, selecciona un municipio.
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4">
							<label for="calle" class="form-label fw-bold input-required">Calle o avenida del delito:</label>
							<input type="text" class="form-control" id="calle" name="calle" required>
							<div class="invalid-feedback">
								Por favor, anexa una calle o avenida.
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4">
							<label for="exterior" class="form-label fw-bold input-required">No. exterior del delito:</label>
							<input type="text" class="form-control" id="exterior" name="exterior" required>
							<div class="invalid-feedback">
								Por favor, anexa un numero exterior del delito.
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4">
							<label for="interior" class="form-label fw-bold">No. interior del delito:</label>
							<input type="text" class="form-control" id="interior" name="interior">
							<div class="invalid-feedback">
								Por favor, anexa un numero interior del delito.
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4">
							<label for="colonia-text" class="form-label fw-bold input-required">Colonia del delito:</label>
							<select class="form-select" id="colonia" name="colonia" required>
								<option selected disabled value="">Elige la colonia</option>
								<option value="1">Ciudad morelos</option>
								<option value="2">Hechicera</option>
								<option value="3">Mexicali</option>
							</select>
							<div class="invalid-feedback">
								Por favor, selecciona una colonia.
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4">
							<label for="lugar" class="form-label fw-bold input-required">Lugar del delito:</label>
							<select class="form-select" id="lugar" name="lugar" required>
								<option selected disabled value="">Elige el lugar del delito</option>
								<option value="1">Instituciones privadas</option>
								<option value="2">Centro escolar</option>
								<option value="3">Centro recreativo</option>
							</select>
							<div class="invalid-feedback">
								Por favor, selecciona un lugar.
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4">
							<label for="clasificacion" class="form-label fw-bold">Clasificación del lugar</label>
							<input type="text" class="form-control" id="clasificacion" name="clasificacion">
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4">
							<label for="fecha" class="form-label fw-bold input-required">Fecha y hora del delito:</label>
							<input type="datetime-local" class="form-control" id="fecha" name="fecha" required>
							<div class="invalid-feedback">
								Por favor, anexa una fecha y hora.
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-4">
							<label for="responsable" class="form-label fw-bold ">¿Identifica al responsable del delito?</label>
							<br>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="responsable" id="SI" onclick="MostrarSiconoce();">
								<label class="form-check-label" for="flexRadioDefault1">SI</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="responsable" id="NO" onclick="Esconder();">
								<label class="form-check-label" for="flexRadioDefault2">NO</label>
							</div>
						</div>
						<!--Campos que salen si selecciona que si conoce al responsable-->
						<div id="siconoce" style="display:none" class="col-12">
							<div class="row">
								<div class="col-12 col-sm-6 col-md-6 col-lg-4">
									<label for="nombre_imputado" class="form-label fw-bold">Nombre(s) imputado</label>
									<input type="text" class="form-control" id="nombre_imputado" name="nombre_imputado">

								</div>
								<div class="col-12 col-sm-6 col-md-6 col-lg-4">
									<label for="alias" class="form-label fw-bold">Alias</label>
									<input type="text" class="form-control" id="alias" name="alias">
								</div>
								<div class="col-12 col-sm-6 col-md-6 col-lg-4">
									<label for="primer_apellido" class="form-label fw-bold">Primer apellido</label>
									<input type="text" class="form-control" id="primer_apellido" name="primer_apellido">
								</div>
								<div class="col-12 col-sm-6 col-md-6 col-lg-4">
									<label for="segundo_apellido" class="form-label fw-bold">Segundo apellido</label>
									<input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido">
								</div>
								<div class="col-12 col-sm-6 col-md-6 col-lg-4">
									<label for="municipio_imputado" class="form-label fw-bold">Municipio del imputado:</label>
									<select class="form-select" id="municipio_imputado" name="municipio_imputado">
										<option selected disabled value="">Elige el municipio del imputado</option>
										<option value="1">TIJUANA</option>
										<option value="2">PLAYAS DE ROSARITO</option>
										<option value="3">TECATE</option>
										<option value="4">MEXICALI</option>
										<option value="5">ENSENADA</option>
									</select>
								</div>
								<div class="col-12 col-sm-6 col-md-6 col-lg-4">
									<label for="calle_imputado" class="form-label fw-bold">Calle o avenida del imputado</label>
									<input type="text" class="form-control" id="calle_imputado" name="calle_imputado">
								</div>
								<div class="col-12 col-sm-6 col-md-6 col-lg-4">
									<label for="numero_ext_imputado" class="form-label fw-bold">Número exterior</label>
									<input type="text" class="form-control" id="numero_ext_imputado" name="numero_ext_imputado">
								</div>
								<div class="col-12 col-sm-6 col-md-6 col-lg-4">
									<label for="numero_int_imputado" class="form-label fw-bold">Número interior</label>
									<input type="text" class="form-control" id="numero_int_imputado" name="numero_int_imputado">
								</div>
								<div class="col-12 col-sm-6 col-md-6 col-lg-4">
									<label for="tel_imputado" class="form-label fw-bold">Teléfono del imputado</label>
									<input type="text" class="form-control" id="tel_imputado" name="tel_imputado">
								</div>
								<div class="col-12 col-sm-6 col-md-6 col-lg-4">
									<label for="fecha_nac_imputado" class="form-label fw-bold ">Fecha de nacimiento del imputado:</label>
									<input type="datetime" class="form-control" id="fecha_nac_imputado" name="fecha_nac_imputado">
								</div>
								<div class="col-12 col-sm-6 col-md-6 col-lg-4">
									<label for="sexo_imputado" class="form-label fw-bold ">Sexo biológico del imputado</label>
									<br>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="sexo_imputado" id="M">
										<label class="form-check-label" for="flexRadioDefault1">MASCULINO</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="sexo_imputado" id="F">
										<label class="form-check-label" for="flexRadioDefault2">FEMENINO</label>
									</div>
								</div>
								<div class="col-12 col-sm-6 col-md-6 col-lg-4">
									<label for="escolaridad_imputado" class="form-label fw-bold">Escolaridad del imputado</label>
									<input type="text" class="form-control" id="escolaridad_imputado" name="escolaridad_imputado">
								</div>
								<div class="col-12 col-sm-6 col-md-6 col-lg-4">
									<label for="description-text" class="form-label fw-bold">Descripcion:</label>
									<textarea class="form-control" id="description" name="description" maxlength="300"></textarea>
									<div class="invalid-feedback">
										Por favor, anexa una breve descripcion del delito
									</div>
									<div id="mensaje_ayuda" class="form-text">300 carácteres restantes</div>
								</div>
							</div>
						</div>

						<!-- 
						<div class="col-12 col-sm-6 col-md-6 col-lg-4">
							<label for="localidad" class="form-label fw-bold input-required">Localidad del delito:</label>
							<select class="form-select" id="localidad" name="localidad" required>
								<option selected disabled value="">Elige la localidad</option>
								<option value="1">Ciudad morelos</option>
								<option value="2">Hechicera</option>
								<option value="3">Mexicali</option>
							</select>
							<div class="invalid-feedback">
								Por favor, selecciona una localidad.
							</div>
						</div>
						 -->
						<!-- <div class="col-12 col-sm-6 col-md-6 col-lg-4">
							<label for="objetoImplicado-text" class="form-label fw-bold input-required">Describa el objeto implicado:</label>
							<textarea class="form-control" id="objetoImplicado" name="objetoImplicado" required></textarea>
							<div class="invalid-feedback">
								Por favor, describe el objeto implicado.
							</div>
						</div> -->

						<div class="col-12 " style="font-size: 14px; text-align:center;">
							<div class="row" style="margin-top: 50px;">

								<i class="bi bi-exclamation-triangle"> <span class="span-derechos_imp">Es muy importante que antes de iniciar tu video denuncia aceptes los derechos de víctima u ofendido. </span> </i>
								<br>
								<label>Para consultar la constancia de Derechos, da clic <a target="_blank" href="" class="enlace-derechos_imp" data-bs-toggle="modal" data-bs-target="#exampleModal">aquí</a></label>
								<br>

								<label> <input type="checkbox" name="derechos_imputado" id="derechos_imputado" value=""> Aceptar derechos de víctima u ofendido</label>

							</div>
						</div>

						<!-- Modal -->
						<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header bg-primary text-white">
										<h5 class="modal-title" id="exampleModalLabel">Derechos de víctima u ofendido</h5>
										<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<iframe id="pdfdoc" src="<?= base_url() ?>/assets/documentos/DERECHOS DE VÍCTIMA U OFENDIDO.pdf" width="100%" height="500px"></iframe>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
									</div>
								</div>
							</div>
						</div>

						<div class="col-12 text-center" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Aceptar derechos de víctima u ofendido">
							<button onclick="AceptarDerechos(event)" class="btn btn-primary mt-5" type="submit"><i class="bi bi-camera-video-fill"></i> Iniciar denuncia</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	(function() {
		'use strict'

		var forms = document.querySelectorAll('.needs-validation')

		Array.prototype.slice.call(forms)
			.forEach(function(form) {
				form.addEventListener('submit', function(event) {
					if (!form.checkValidity()) {
						event.preventDefault()
						event.stopPropagation()
					}
					form.classList.add('was-validated')
				}, false)
			})
	})()

	$('#description').keyup(function() {
		let ch = 150 - $(this).val().length;
		$('#mensaje_ayuda').text(ch + ' carácteres restantes');
	});

	function MostrarSiconoce() {
		document.getElementById('siconoce').style.display = "block";
	}

	function Esconder() {
		document.getElementById('siconoce').style.display = "none";
	}


	var myModal = document.getElementById('myModal')
	var myInput = document.getElementById('myInput')

	myModal.addEventListener('shown.bs.modal', function() {
		myInput.focus()
	})


	function AceptarDerechos(e) {
		var chk = document.getElementById("derechos_imputado").checked;
		if (!chk) {
			e.preventDefault();

			var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
			var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
				return new bootstrap.Popover(popoverTriggerEl)

			})
		}
	}
</script>

<?= $this->endSection() ?>
