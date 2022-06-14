<div class="modal fade" id="open_folios_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="open_folios_modal" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered  modal-dialog-scrollable">
		<div class="modal-content border-0" style="border-radius: 1.5em;">
			<div class="modal-header bg-primary text-white justify-content-center">
				<h5 class="modal-title"> <i class="bi bi-file-earmark-text-fill"></i> FOLIO ABIERTO</h5>
			</div>
			<div class="modal-body text-center">
				<p>Ya cuentas con un folio abierto con número <span class="fw-bold" id="folio_num_span"></span> por el delito de <span class="fw-bold" id="folio_delito_span"></span>, continua con la denuncia.</p>
				<a id="btn-inicia-denuncia" class="btn btn-secondary" href="<?= base_url('denuncia/logout') ?>"><i class="bi bi-box-arrow-left"></i> Cerrar sesión</a>
				<button id="btn-inicia-denuncia" class="btn btn-primary"><i class="bi bi-camera-video-fill"></i> Iniciar denuncia</button>	
			</div>
		</div>
	</div>
</div>

<script>
	document.querySelector('#btn-inicia-denuncia').addEventListener('click', () => {
		$.ajax({
			data: {
				'id': '<?= $session->ID_DENUNCIANTE ?>',
				'edad': '<?= $session->EDAD ?>',
				'folio': document.querySelector('#folio_num_span').innerHTML
			},
			url: "<?= base_url('/data/get-link-videodenuncia') ?>",
			method: "POST",
			dataType: "json",
		}).done((response) => {
			if (response.status == 1) {
				window.location.href = response.url;
			} else {
				Swal.fire({
					icon: 'error',
					text: 'Error, contacte directo a la Físcalia General del Estado de Baja California.',
					confirmButtonColor: '#bf9b55',
				})
			}
		}).fail(function(jqXHR, textStatus) {});
	});
</script>
