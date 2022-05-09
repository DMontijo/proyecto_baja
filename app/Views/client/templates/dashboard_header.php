<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url() ?>/assets/img/FGEBC.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/img/FGEBC.png" type="image/x-icon">
    <!--Bootstrap 5-->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/bootstrap/css/bootstrap.css">
    <!--Bootstrap Icons-->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/bootstrap/icons/bootstrap-icons.css">
    <!--Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <!--Styles-->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/styles/global.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/styles/client/style.css">

    <title>FGEBC <?php echo ' - ' . $title ?></title>
</head>

<body>
    <script src="<?= base_url() ?>/assets/jQuery/jquery.js"></script>
    <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-primary header sticky-top">
        <div class="container">
            <a class="navbar-brand m-0 p-0" href="<?= base_url() ?>/denuncia/dashboard"><img src="<?= base_url() ?>/assets/img/FGEBC_SEJAP_LOGO.png" class="logo-header" alt="FGEBC Logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#dashboard_nav" aria-controls="dashboard_nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse bg-primary" id="dashboard_nav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php if ($menu === 'dashboard') echo 'active'; ?>" href="<?= base_url() ?>/denuncia/dashboard"><i class="bi bi-camera-video-fill"></i> Denunciar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($menu === 'denuncias') echo 'active'; ?>" href="<?= base_url() ?>/denuncia/dashboard/denuncias"><i class="bi bi-archive-fill"></i> Mis denuncias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>/denuncia"><i class="bi bi-box-arrow-left"></i> Cerrar sesión</a>
                    </li>
                </ul>
            </div>
            <div>
                <a class="text-white" href="#!" onclick="javascript:toggleFullScreen()">
                    <i class="bi bi-fullscreen"></i>
                </a>
            </div>
        </div>
    </nav> -->
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url() ?>/denuncia/dashboard"><img src="<?= base_url() ?>/assets/img/FGEBC_SEJAP_LOGO.png" class="logo-header" alt="FGEBC Logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navegacion" aria-controls="navegacion" aria-expanded="false" aria-label="FGEBC navegación denuncia">
                <i class="bi bi-list"></i>
            </button>
            <div class="collapse navbar-collapse" id="navegacion">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php if ($menu === 'dashboard' || $menu === 'video-denuncia') echo 'active'; ?>" href="<?= base_url() ?>/denuncia/dashboard"><i class="bi bi-camera-video-fill"></i> Denunciar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($menu === 'denuncias') echo 'active'; ?>" href="<?= base_url() ?>/denuncia/dashboard/denuncias"><i class="bi bi-archive-fill"></i> Mis denuncias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>/denuncia"><i class="bi bi-box-arrow-left"></i> Cerrar sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#!" onclick="javascript:toggleFullScreen()"><i class="bi bi-fullscreen"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid bg-white p-0 py-5 main bg-light">