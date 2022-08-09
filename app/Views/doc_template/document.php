<html>

<head>
	<style>
		/** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
		@page {
			margin: 0cm 0cm;
		}

		/** Define now the real margins of every page in the PDF **/
		body {
			margin-top: 4cm;
			margin-left: 2cm;
			margin-right: 2cm;
			margin-bottom: 2cm;
			font-family: Arial, Helvetica, sans-serif;
			font-size: 12px;
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
			left: 0cm;
			right: 0cm;
			height: .5cm;
		}
	</style>
</head>

<body>
	<!-- Define header and footer blocks before your content -->
	<header>
		<table style="width:100%;">
			<tr>
				<td style="width: 30%;text-align:left;">
					<img src="http://localhost/proyecto_baja/assets/img/logo_fgebc.jpg" style="height:2cm;" />
				</td>
				<td style="width: 40%;text-align:center;">
					<h3 style="margin:0px;">FISCALÍA GENERAL DEL ESTADO DE BAJA CALIFORNIA</h3>
					<p><strong>CENTRO DE DENUNCIA TECNOLÓGICA</strong></p>
					<p><strong>CONSTANCIA EXTRAVÍO</strong></p>
				</td>
				<td style="width: 30%;text-align:right;">
					<img src="http://localhost/proyecto_baja/assets/img/logo_sejap.jpg" style="height:1cm;" />
				</td>
			</tr>
		</table>
	</header>

	<footer>
	</footer>

	<!-- Wrap the content of your PDF inside a main tag -->
	<main>
		<br>
		<?= $data ?>
	</main>
</body>

</html>
