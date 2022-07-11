<!DOCTYPE html>

<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="../assets/img/FGEBC.png" type="image/x-icon">
	<link rel="shortcut icon" href="../assets/img/FGEBC.png" type="image/x-icon">
	<!--Bootstrap 5-->
	<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
	<!--Bootstrap Icons-->
	<link rel="stylesheet" href="../assets/bootstrap/icons/bootstrap-icons.css">
	<!--Font-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
	<!--Sweet Alert 2-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
	<!--Styles-->
	<link rel="stylesheet" href="../assets/styles/global.css">
	<link rel="stylesheet" href="../assets/styles/client/style.css">

	<link rel="stylesheet" href="estilos.css?ver=111000011" type="text/css" />
	<title>FGEBC - Validar documentos</title>
</head>

<body style="font-family: 'Montserrat', sans-serif;">

	<nav class="navbar" style="background-color:#511229;">
		<div class="container">
			<a class="navbar-brand" href="https://cdt.fgebc.gob.mx/admin">
				<img src="../assets/img/FGEBC_SEJAP_LOGO.png" alt="" width="270" height="auto">
			</a>
		</div>
	</nav>

	<script type="text/javascript">
		var xmlHttp;

		function CreateXmlHttp() {
			if (window.XMLHttpRequest) {
				xmlHttp = new XMLHttpRequest();
			} else if (window.ActiveXObject) {
				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
		}

		function NumAleat() {
			Num = Math.floor((Math.random() * 10000000000) + 1);
			return Num;
		}
	</script>


	<script src="jquery.js" type="text/javascript"></script>
	<div class="container py-5" style="min-height: calc( 100vh - 120px );">

		<h1 id="titulo" class="text-center fw-bolder pb-1 text-blue">VALIDAR DOCUMENTO FIRMADO</h1>
		<div class="row">
			<div class="col-12 col-md-8 offset-md-2">
				<div id="DivDefault" style="display: block;">
					<table width="100%">
						<tr>
							<td align="center" valign="top" style="height: auto; width: 1000px; padding: 0px; margin: 0px; background-color: #FFFFFF;">
								<div id="Div_Cont1" style="padding: 10px;">

									<table width="100%" class="">

										<tr>
											<td align="center" valign="top" style="padding: 8px;">

												<div id="Div_Cont2" style="overflow-y: auto;">

													<blockquote>

														<form id="XML_upload_form" enctype="multipart/form-data" method="post" action="#">

															<table class="table table-bordered ">

																<thead>
																	<tr>
																		<th class="bg-primary text-white text-center" colspan="2">
																			Seleccione el archivo XML del documento a validar.
																		</th>
																	</tr>
																</thead>
																<tr>
																	<td>
																		Archivo .xml
																	</td>
																	<td valign="middle" height="" align="left">
																		<input class="form-control form-control-sm" accept=".xml" name="ArchXML" id="ArchXML" type="file" onchange="XML_fileSelected(this);" />
																	</td>
																</tr>

																<tr>
																	<td>
																		Archivo .pub
																	</td>
																	<td valign="middle" height="" align="left">
																		<input class="form-control form-control-sm" accept=".pub" name="ArchPUB" id="ArchPUB" type="file" onchange="XML_fileSelected(this);" />
																	</td>
																</tr>

																<tr>
																	<td class="text-center" colspan="2">
																		<input class="btn btn-secondary" type="button" onclick="XML_startUploading()" value="Validar firma de documento" />
																	</td>
																</tr>

															</table>

															<div id="XML_progress_info" style="display: none;">

																<table class="table border=" 0" width="50%" cellpadding="6" cellspacing="0">

																	<tr>
																		<td width="100%" align="left" valign="top" height="22">
																			<progress id="XML_progressBar" value="0" max="100" style="width:400px; height: 20px; display: none;"></progress>
																		</td>
																	</tr>

																</table>

																<div id="XML_progress"></div>
																<div id="XML_progress_percent">&nbsp;</div>
																<div class="XML_clear_both"></div>

																<div>
																	<div id="XML_b_transfered">&nbsp;</div>
																	<div class="XML_clear_both"></div>
																</div>

																<div id="XML_upload_response"></div>

															</div>
															<input type="hidden" name="RefAlfa" id="RefAlfa" size="12" />
														</form>
														<div id="RespServ" style="margin-top: 10px; margin-bottom: 10px;"></div>
													</blockquote>

												</div>

											</td>
										</tr>

									</table>

								</div>

							</td>
						</tr>
					</table>

				</div>
			</div>
		</div>
	</div>

	<footer class="container-fluid text-center text-white d-flex align-items-center justify-content-center footer py-3" style="background-color:#511229;">
		<span>© <?= date("Y") ?> Fiscalía General del Estado de Baja California</span>
	</footer>

	<script>
		$.ajax({
			url: "Funciones.js",
			dataType: "script",
			cache: false
		});

		$.ajax({
			url: "ScriptsJS_Modulo_ValidarDoc.js?sesion=" + NumAleat(),
			dataType: "script",
			cache: false
		});
	</script>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</html>
