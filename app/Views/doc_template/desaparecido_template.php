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
			margin-left: 1cm;
			margin-right: 1cm;
			margin-bottom: 2.5cm;
			font-family: 'Montserrat', Arial, Helvetica, sans-serif;
			font-size: 9pt;
			color: #000000;
		}

		/** Define the header rules **/
		header {
			position: fixed;
			top: -200px;
			left: 0cm;
			right: 0cm;
		}

		/** Define the footer rules **/
		footer {
			position: fixed;
			bottom: 0cm;
		}

		main {
			/* border: 1px solid red; */
			max-height: 14cm;
			overflow: hidden !important;
		}
	</style>
</head>

<body>
	<!-- Define header and footer blocks before your content -->
	<header>
		<center>
			<img src="<?= 'data:image/png;base64,' . $data->image1 ?>" width="50%;" />
		</center>
	</header>

	<!-- Wrap the content of your PDF inside a main tag -->
	<main>
		<?= $data->placeholder ?>
	</main>

	<footer>
		<div style="width: 70%; margin: 0 auto; font-size: 9pt; background-color: #511229; color: white; border-top-left-radius: 30px; border-top-right-radius: 30px;">
			<p style="text-align:center; padding:20px 50px 20px 50px;">
				Si tienes información comunicate a la Unidad Especializada para la Investigación y Persecución de Delitos de Desaparición Forzada de Personas y Desaparición Cometida por <br> Particulares al 686-904-6600, extensiones 4029, 2064, 2488 y 4394. También a los números 089 y 911.
			</p>
		</div>
	</footer>
</body>

</html>
