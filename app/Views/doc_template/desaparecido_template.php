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
			/* font-family: 'Montserrat', Arial, Helvetica, sans-serif; */
			font-family: Arial, Helvetica, sans-serif;
			font-size: 11pt;
			color: #000000;
		}

		/** Define the header rules **/
		header {
			position: fixed;
			top: -190px;
			left: 0cm;
			right: 0cm;
			height: 16cm;
		}

		/** Define the footer rules **/
		footer {
			position: fixed;
			bottom: 0cm;
			left: 2cm;
			right: 2cm;
			height: 5cm;
		}

		/* footer .pagenum:before {
			content: counter(page);
		} */
	</style>
</head>

<body>
	<!-- Define header and footer blocks before your content -->
	<header>
		<center>
			<img src="<?= 'data:image/png;base64,' . $data->image1 ?>" height="100%" />
		</center>
	</header>

	<footer>
		<div style="border-style: solid; border-top-width: 2px; border-right-width: 2px; border-bottom-width: 2px; border-left-width: 2px; width: 70%; margin: 0 auto; font-size: 11pt;border-start-end-radius: 10%; border-start-start-radius: 10%; background-color: #511229; color: white;">
			<p style="text-align:center;">
				Si tienes información comunicate a la Unidad Especializada para la Investigación y <br> Persecución de Delitos de Desaparición Forzada de Personas y Desaparición Cometida por <br> Particulares al (686) 9046600, extensiones 4029, 2064, 2488 y 4394. También a los números <br>089 y 911.
			</p>
		</div>

	</footer>

	<!-- Wrap the content of your PDF inside a main tag -->
	<main>
		<br><br>
		<?= $data->placeholder ?>
	</main>
</body>

</html>
