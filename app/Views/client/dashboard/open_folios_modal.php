<div class="modal fade" id="open_folios_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="open_folios_modal" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered  modal-dialog-scrollable">
		<div class="modal-content border-0" style="border-radius: 1.5em;">
			<div class="modal-header bg-primary text-white justify-content-center">
				<h5 class="modal-title"> <i class="bi bi-file-earmark-text-fill"></i> FOLIO ABIERTO O EN PROCESO</h5>
			</div>
			<div class="modal-body text-center">
				<p>El folio <span class="fw-bold" id="folio_num_span"></span> por el delito de <span class="fw-bold" id="folio_delito_span"></span> aún no ha sido atendido o esta en proceso.</p>
				<input type="text" id="open_input_year" hidden>
				<a id="btn-inicia-denuncia" class="btn btn-secondary mb-3" href="<?= base_url('denuncia/logout') ?>"><i class="bi bi-box-arrow-left"></i> Cerrar sesión</a>
				<button id="btn-inicia-denuncia" type="button" name="btn-inicia-denuncia" class="btn btn-primary  mb-3" onclick="iniciarDenuncia();"><i class="bi bi-camera-video-fill"></i> Iniciar denuncia</button>
			</div>
		</div>
	</div>
</div>

<script>
	function iniciarDenuncia() {
		$.ajax({
			data: {
				'id': '<?= $session->DENUNCIANTEID ?>',
				'folio': document.querySelector('#folio_num_span').innerHTML,
				'year': document.querySelector('#open_input_year').value
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
		}).fail(function(jqXHR, textStatus) {
			Swal.fire({
				icon: 'error',
				text: 'Error, contacte directo a la Físcalia General del Estado de Baja California.',
				confirmButtonColor: '#bf9b55',
			})
		});
	}
</script>
