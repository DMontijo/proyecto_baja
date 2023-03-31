<html>

<head>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
	<style>
		/** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
		@page {
			margin: 0cm 0cm;
		}

		table {
			page-break-before: auto;
		}

		/** Define now the real margins of every page in the PDF **/
		body {
			margin-top: 4cm;
			margin-left: 2cm;
			margin-right: 2cm;
			margin-bottom: 2cm;
			font-family: 'Montserrat', Arial, Helvetica, sans-serif;
			font-size: 11px;
			color: #000000;
		}

		/** Define the header rules **/
		header {
			position: fixed;
			top: 1cm;
			left: 2cm;
			right: 2cm;
			height: 3cm;

			/** Extra personal styles **/
			/* background-color: #03a9f4; */
			line-height: normal;
		}

		/** Define the footer rules **/
		footer {
			position: fixed;
			bottom: 0cm;
			left: 2cm;
			right: 2cm;
			height: 2cm;
			border-top: 1px solid #000000;
		}

		/* footer .pagenum:before {
			content: counter(page);
		} */
	</style>
</head>

<body>
	<!-- Define header and footer blocks before your content -->
	<header>
		<table style="width:100%;">
			<tr>
				<td style="width: 30%;text-align:left;">
					<img src="<?= 'data:image/jpg;base64,' . $data->image1 ?>" style="height:2cm;" />
				</td>
				<td style="width: 40%;text-align:center;">
					<h3 style="margin:0px;">FISCALÍA GENERAL DEL ESTADO DE BAJA CALIFORNIA</h3>
					<p><strong>CENTRO DE DENUNCIA TECNOLÓGICA</strong></p>
				</td>
				<td style="width: 30%;text-align:right;">
					<!-- <img src="<?= 'data:image/jpg;base64,' . $data->image2 ?>" style="height:1cm;" /> -->
				</td>
			</tr>
		</table>
	</header>

	<footer>
		<!-- <div id="footer">
			<div class="pagenum-container">Page <span class="pagenum"></span></div>
		</div> -->
	</footer>

	<!-- Wrap the content of your PDF inside a main tag -->
	<main>
		<?= $data->placeholder ?>
		<!-- <div style="page-break-after:always;"></div> -->
		<br>
		<br>
		<div>
			<p class="p7" style="margin: 0px; text-align: center; color: #000000; background-color: #959393; padding: 10px;">
				<span style="color: #ffffff;"><strong>DATOS FIRMA ELECTR&Oacute;NICA</strong></span>
			</p>
		</div>
		<div style="display: flex; flex-direction: row; flex-wrap: wrap;">
			<div style="width: 75%; float: left;">
				<br>
				<p style="margin: 0px; text-align: left;">
					<strong>IDENTIFICADOR ELECTR&Oacute;NICO:</strong>
					<?= $data->numidenficador ?>
				</p>
				<p style="margin: 0px; text-align: left;">
					<strong>AGENTE DEL MINISTERIO P&Uacute;BLICO:</strong>
					<?= $data->agentefirma ?>
				</p>
				<p style="margin: 0px; text-align: left;">
					<strong>RFC AGENTE DEL MINISTERIO P&Uacute;BLICO:</strong>
					<?= $data->rfcfirma ?>
				</p>
				<p style="margin: 0px; text-align: left;">
					<strong>NO. DE CERTIFICACI&Oacute;N DE FIRMA
						ELECTR&Oacute;NICA:</strong>
					<?= $data->ncertificadofirma ?>
				</p>
				<p style="margin: 0px; text-align: left;">
					<strong>FECHA DE FIRMA:</strong> <?= $data->fechaf ?>
				</p>
				<p style="margin: 0px; text-align: left;">
					<strong>HORA DE FIRMA:</strong> <?= $data->horaf ?>
				</p>
				<p style="margin: 0px; text-align: left;">
					<strong>LUGAR DE FIRMA:</strong> <?= $data->lugarf ?>
				</p>
				<p style="margin: 0px; text-align: left;">
					&nbsp;
				</p>
			</div>
			<div style="width: 25%; float: right; word-wrap: break-word;">
				<br>
				<p style="margin: 0px; text-align: center;">
					<img src="<?= 'data:image/jpg;base64,' . $data->qrurl ?>" width="50px" height="50px" />
				</p>
				<p style="margin: 0px; text-align: center;">
					<?= $data->url ?>
				</p>
			</div>
		</div>
		<div style="display: flex; flex-direction: row; flex-wrap: wrap; word-wrap: break-word;">
			<div style="width: 30%;">
				<p style="margin: 0px; text-align: justify;">
					<strong>FIRMA ELECTR&Oacute;NICA</strong>
				</p>
			</div>
			<div style="width: 100%;">
				<p style="margin: 0px; text-align: justify;">
					<?= $data->firmaelectronica ?>
				</p>
			</div>
		</div>
		<div style="float: left;">
			<p style="margin: 0px; text-align: left;">
				<img src="<?= 'data:image/jpg;base64,' . $data->qr3 ?>" width="120px" height="120px" />
			</p>
		</div>
	</main>
</body>

</html>
