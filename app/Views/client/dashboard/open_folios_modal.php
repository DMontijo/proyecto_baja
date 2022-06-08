<div class="modal fade" id="open_folios_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="open_folios_modal" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered  modal-dialog-scrollable">
		<div class="modal-content border-0" style="border-radius: 1.5em;">
			<div class="modal-header bg-primary text-white justify-content-center">
				<h5 class="modal-title"> <i class="bi bi-file-earmark-text-fill"></i> Folio de atención abierto</h5>
			</div>
			<div class="modal-body text-center">
				<p>Ya cuentas con un folio <span class="fw-bold" id="folio_num_span"></span> por el delito de <span class="fw-bold" id="folio_delito_span"></span>,continua con la denuncia.</p>
				<a class="btn btn-primary" href="<?= base_url('/denuncia/dashboard/video-denuncia') ?>"><i class="bi bi-camera-video-fill"></i> Iniciar denuncia</a>
				<p class="form-text text-center">Si deseas levantar una denuncia por el mismo delito no será posible hasta que finalices el primero.</p>
			</div>
		</div>
	</div>
</div>
