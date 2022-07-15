<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PDF</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <style>
            /** 
                Establezca los márgenes de la página en 0, por lo que el pie de página y el encabezado
                puede ser de altura y anchura completas.
             **/
            @page {
                margin: 0cm 0cm;
            }

            /** Defina ahora los márgenes reales de cada página en el PDF **/
            body {
                margin-top: 3cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }

            /** Definir las reglas del encabezado **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 3cm;
            }

            /** Definir las reglas del pie de página **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                text-align: center;
                left: 0cm; 
                right: 0cm;
                height: 2cm;
            }
        </style>
</head>

<body>
  <header>
    <img src="<?= base_url() ?>/assets/img/FGEBC_SEJAP_LOGO.jpg" width="100%" height="100%" />
  </header>
<main>
      <div class="card-body" id="certificado" style="margin: 2%; margin-top: 10%;">
        <?php echo $certificadoMedico[5]->PLACEHOLDER?>
  </div>
</main>
<footer>
				<div>
					<span>© <?= date("Y") ?> Fiscalía General del Estado de Baja California</span>
				</div>
			</footer>

</body>

</html>