<nav class="navbar navbar-expand-md navbar-dark bg-primary">
	<div class="container-fluid">
		<a class="navbar-brand" href="<?= base_url() ?>/denuncia/dashboard"><img src="<?= base_url() ?>/assets/img/FGEBC_SEJAP_LOGO.png" class="logo-header" alt="FGEBC Logo"></a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navegacion" aria-controls="navegacion" aria-expanded="false" aria-label="FGEBC navegación denuncia">
			<i class="bi bi-list"></i>
		</button>
		<div class="collapse navbar-collapse" id="navegacion">
			<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link <?php if ('' === 'dashboard' || '' === 'video-denuncia') echo 'active'; ?>" href="<?= base_url() ?>/denuncia/dashboard"><i class="bi bi-camera-video-fill"></i> Denunciar</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php if ('' === 'denuncias') echo 'active'; ?>" href="<?= base_url() ?>/denuncia/dashboard/denuncias"><i class="bi bi-archive-fill"></i> Mis denuncias</a>
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
