<div class="modal fade" id="emergency_modal" tabindex="-1" aria-labelledby="emergency_modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content border-0 shadow-lg" style="border-radius: 1.5em;">
			<div class="modal-header bg-primary justify-content-center" style="border-radius: 1.5em 1.5em 0 0;">
				<h6 class="modal-title text-white fw-bold text-center" id="aviso_modalLabel">ESTA ACCIÓN SE REALIZARÁ CON UN APARATO TELEFÓNICO.</h6>
			</div>
			<div class="modal-body text-center">
				<p>Si no lo está realizando con un dispositivo móvil debe tener conectado y configurado un aparato telefónico en el computador o <strong>puede llamar directo al 911</strong>.</p>
				<p class="fs-5"><span class="fw-bold">¿DESEA CONTINUAR?</span></p>
			</div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
				<button type="button" class="btn btn-secondary" style="background-color: #092B47;" onclick="acceptEmergencyModal()">CONTINUAR</button>
			</div>
		</div>
	</div>
</div>

<script>
	const acceptEmergencyModal = () => {
		$('#emergency_modal').modal('hide');
		window.location = "tel:911";
	}
</script>
