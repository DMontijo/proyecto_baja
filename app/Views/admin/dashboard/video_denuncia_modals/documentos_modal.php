<div class="modal fade shadow" id="documentos_modal" tabindex="-1" role="dialog" aria-labelledby="DocumentosModal" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-100 w-75">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-blue text-white">
				<h5 class="modal-title font-weight-bold">AGREGAR DOCUMENTO</h5>
				<button type="button" class="close text-primary" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body bg-light">
				<?php echo view('/admin/dashboard/wyswyg/documento'); ?>
			</div>
		</div>
	</div>
</div>
