<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Bootstrap 5-->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/bootstrap/css/bootstrap.min.css">
    <!--Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <!--Styles-->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/styles/global.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/styles/home.css">

    <title>FGEBC <?php echo ' - '.$title ?></title>
</head>

<body>
    <header>
        <!--Versión escritorio-->
        <div class="container-fluid bg-primary p-0 d-none d-lg-block">
            <div class="container py-3 d-flex align-items-center">
                <div class="d-inline-block"><a href="<?=base_url()?>"><img src="<?=base_url()?>/assets/img/logo.png" class="logo-header" alt="FGEBC Logo"></a></div>
                <div class="d-inline-block ms-3"><span class="fw-bolder text-white">FÍSCALIA GENERAL DEL ESTADO <br>DE
                        BAJA CALIFORNIA</span></div>
            </div>
        </div>
    </header>
    <div class="container-fluid bg-white p-0 py-5">