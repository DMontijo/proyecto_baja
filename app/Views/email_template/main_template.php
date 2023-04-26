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
			font-family: Helvetica, Arial, sans-serif !important;
			font-size: 16px;
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6,
		p {
			margin-top: 0px !important;
			margin-bottom: 10px;
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

		body {
			font-size: 15px !important;
		}

		.body {
			background-color: #e5e4e3 !important;
			padding: 20px 50px;
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
			margin: 15px;
		}

		.body .btn:hover {
			background-color: #a18347;
		}

		.footer {
			background-color: #e5e4e3 !important;
			padding: 20px;
			text-align: center;
		}

		.footer p {
			font-size: 0.8em !important;
			margin: 0px;
		}
	</style>
</head>

<body style="margin: 0 !important; padding: 0 !important; background-color: #7D7D7D!important;" bgcolor="#7D7D7D">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="center" style="background-color: #7D7D7D!important;padding-top: 50px;padding-bottom: 50px" bgcolor="#7D7D7D">
				<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
					<tr border="0" valign="top" style="text-align: center;font-size: 0; background-color: #511229!important; background-repeat: no-repeat;" bgcolor="#511229">
						<td style="height: 90px;">
							<img src="<?= base_url('assets/img/FGEBC.png') ?>" width="150px" alt="FGEBC Logo" style="margin-bottom: -70px;margin-top: 10px;">
						</td>
					</tr>
					<tr>
						<td style="padding: 0px 50px 50px 50px; background-color: #ffffff!important;" bgcolor="#ffffff">
							<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:500px;">
								<tr>
									<td class="body" bgcolor="#E5E4E3" style="padding: 80px 10px 20px 10px;">
										<?= $this->renderSection('body') ?>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>

</html>
