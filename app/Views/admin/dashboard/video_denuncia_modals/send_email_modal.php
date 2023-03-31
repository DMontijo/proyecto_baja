<div class="modal fade shadow" id="sendEmailDocModal" tabindex="-1" role="dialog" aria-labelledby="sendEmailModalLabel" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-dialog-centered mw-100 w-50">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-primary justify-content-center">
				<h5 class="modal-title text-white font-weight-bold" id="enviar_modalLabel">ENVIAR CORREO</h5>
				<h5 class="modal-title text-white font-weight-bold d-none" id="password_verifying_mail">Enviando correo</h5>

				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body text-center" id="load_mail">
				<input type="text" class="form-control d-none" id="expediente_modal_correo" name="expediente_modal_correo" required>
				<input type="text" class="form-control d-none" id="year_modal_correo" name="year_modal_correo" required>
				<select class="form-control" id="send_mail_select" name="send_mail_select" required></select>
				<br>
				<br>
				<div class="col-12">
					<button type="button" id="enviarcorreoDoc" name="enviarcorreoDoc" class="btn btn-secondary font-weight-bold">ENVIAR CORREO</button>
				</div>
			</div>
			<div id="loading_mail" class="modal-body text-center d-none" style="min-height:170px;">
				<div class="d-flex justify-content-center">
					<div class="spinner-border text-primary" role="status">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
