<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<style type="text/css">
		/* CLIENT-SPECIFIC STYLES */
		body,
		table,
		td,
		a {
			-webkit-text-size-adjust: 100%;
			-ms-text-size-adjust: 100%;
		}

		table,
		td {
			mso-table-lspace: 0pt;
			mso-table-rspace: 0pt;
		}

		img {
			-ms-interpolation-mode: bicubic;
		}

		/* RESET STYLES */
		img {
			border: 0;
			height: auto;
			line-height: 100%;
			outline: none;
			text-decoration: none;
		}

		table {
			border-collapse: collapse !important;
		}

		body {
			height: 100% !important;
			margin: 0 !important;
			padding: 0 !important;
			width: 100% !important;
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif !important;
			font-size: 16px;
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6,
		p {
			margin-top: 0 !important;
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
			color: #092b47 !important;
		}


		/* iOS BLUE LINKS */
		a[x-apple-data-detectors] {
			/* color: inherit !important; */
			text-decoration: none !important;
			font-size: inherit !important;
			font-family: inherit !important;
			font-weight: inherit !important;
			line-height: inherit !important;
			color: #bf9b55 !important;
		}

		/* ANDROID CENTER FIX */
		div[style*="margin: 16px 0;"] {
			margin: 0 !important;
		}

		.body {
			margin: 50px 0px 50px 0px;
		}

		.body .btn {
			padding: 15px 10px;
			border: none;
			color: #ffffff;
			background-color: #bf9b55;
			font-weight: bold;
			border-radius: 5px;
			cursor: pointer;
			text-decoration: none;
			font-size: 14px;
		}

		.body .btn:hover {
			background-color: #a18347;
		}

		.footer p {
			font-size: .8em !important;
		}
	</style>
</head>

<body style="margin: 0 !important; padding: 0 !important; background-color: #7D7D7D!important;" bgcolor="#7D7D7D">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="center" style="background-color: #7D7D7D!important;padding-top: 50px;padding-bottom: 50px" bgcolor="#7D7D7D">
				<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
					<tr>
						<td valign="top" style="font-size: 0; background-color: #511229!important;height: 200px;background-image: url('https://yocontigo-it.com.mx/justicia/public/assets/img/email/LINEAS_CABECERA_CORREO.png ');background-repeat: no-repeat;
							background-size: 600px 200px;" bgcolor="#511229">
						</td>
					</tr>
					<tr>
						<td style="padding: 0px 50px 50px 50px; background-color: #ffffff!important;" bgcolor="#ffffff">
							<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
								<td style="background-color: #E5E4E3!important;" bgcolor="#E5E4E3">
									<div style="background-color: #E5E4E3!important; margin-top: -100px;padding: 0px 20px 0px 20px;text-align: center;">
										<img src="https://yocontigo-it.com.mx/justicia/public/assets/img/email/LOGO_CORREO.png" alt="Logo" style="margin-top: -100px;width: 200px;">
										<div class="body">
											<p>
												Usted ha generado un nuevo registro en el Centro de Denuncia Tecnológica.
												<br>Para acceder debes ingresar los siguientes datos
											</p>
											<p>
												USUARIO: <?= $email ?><br>
												CONTRASEÑA: <?= $password ?>
											</p>
											<a class="btn" href="<?= base_url('/denuncia') ?>">
												INICIAR VIDEO DENUNCIA
											</a>
										</div>
										<div class="footer">
											<p>Si usted no ha realizado esta acción ignore este mensaje.</p>
										</div>
									</div>
								</td>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>

</html>
