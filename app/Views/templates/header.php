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
    <link rel="stylesheet" href="<?= base_url() ?>/assets/styles/style.css">

    <title>FGEBC <?php echo ' - '.$title ?></title>
</head>

<body>
    <header>
        <!--Versión escritorio-->
        <div class="container-fluid bg-primary p-0 d-none d-lg-block">
            <div class="container py-3 d-flex align-items-center">
                <div class="d-inline-block"><a href="<?=base_url()?>"><img src="<?=base_url()?>/assets/img/FGEBC.png" class="logo-header" alt="FGEBC Logo"></a></div>
                <div class="d-inline-block ms-3"><span class="fw-bolder text-white">FÍSCALIA GENERAL DEL ESTADO <br>DE
                        BAJA CALIFORNIA</span></div>
            </div>
        </div>
        <nav class="navbar navbar-expand navbar-dark bg-blue d-none d-lg-block">
            <div class="container">
                <ul class="navbar-nav mb-2 mb-lg-0 w-100 justify-content-around py-2 menu">
                    <li class="nav-item">
                        <a class="nav-link btn" href="https://www.fgebc.gob.mx/">INICIO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn" href="<?=base_url()?>">SERVICIOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn" href="https://www.fgebc.gob.mx/boletines">BOLETINES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn" href="https://www.fgebc.gob.mx/transparencia">TRANSPARENCIA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn" href="https://www.fgebc.gob.mx/conocenos">CONÓCENOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn" href="https://www.fgebc.gob.mx/cecc">CECC</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn" href="https://www.fgebc.gob.mx/monitorfgbc">MONITORFGBC</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn" href="https://www.fgebc.gob.mx/declaranet">DECLARANET</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!--Versión movil-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary d-block d-lg-none">
            <div class="container">
                <a class="navbar-brand d-block" href="<?=base_url()?>"><img src="<?=base_url()?>/assets/img/logo.png" class="logo-header-movil" alt="FGEBC Logo"></a><br>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav mb-2 mb-lg-0 w-100 justify-content-around py-2 menu">
                        <li class="nav-item">
                            <a class="nav-link btn" href="https://www.fgebc.gob.mx/">INICIO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn" href="<?=base_url()?>">SERVICIOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn" href="https://www.fgebc.gob.mx/boletines">BOLETINES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn" href="https://www.fgebc.gob.mx/transparencia">TRANSPARENCIA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn" href="https://www.fgebc.gob.mx/conocenos">CONÓCENOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn" href="https://www.fgebc.gob.mx/cecc">CECC</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn" href="https://www.fgebc.gob.mx/monitorfgbc">MONITORFGBC</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn" href="https://www.fgebc.gob.mx/declaranet">DECLARANET</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container-fluid bg-white p-0 py-5">