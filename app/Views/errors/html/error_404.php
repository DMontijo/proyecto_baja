<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Bootstrap 5-->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/bootstrap/css/bootstrap.css">
    <!--Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <title>FGEBC - 404 Página no encontrada</title>
</head>

<body>
    <section class="container-fluid bg-primary">
        <div class="row vh-100 text-white align-items-center justify-content-center text-center">
            <div class="col-12">
                <a href="<?= base_url() ?>">
                    <img src="<?= base_url() ?>/assets/img/FGEBC.png" alt="FGEBC Logo" style="width:200px;">
                </a>
                <h1 class="display-1 fw-bolder">404</h1>
                <p>
                    <?php if (! empty($message) && $message !== '(null)') : ?>
                    <?= nl2br(esc($message)) ?>
                    <?php else : ?>
                    Sorry! Cannot seem to find the page you were looking for.
                    <?php endif ?>
                </p>
            </div>
        </div>
    </section>
</body>

</html>