<div class="modal fade shadow" id="media_filiacion_modal" role="dialog" aria-labelledby="mediaFiliacionILabel" aria-hidden="true" data-backdrop="">
	<div class="modal-dialog modal-dialog-centered mw-100 w-75">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-blue text-white">
				<h5 class="modal-title font-weight-bold">MEDIA FILIACIÓN</h5>
				<button type="button" class="close text-white" id="close" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body bg-light" style="height:70vh;overflow-y:auto;">

				<div class="tab-content pt-3" id="media_filiacion_modal_content">
					<div class="tab-pane fade show active" id="nav-media_filiacion_modal" role="tabpanel" aria-labelledby="nav-media_filiacion_modal-tab">
						<?= view('admin/dashboard/video_denuncia_forms/form_media_filiacion_insert') ?>
					</div>

				</div>

			</div>
		</div>
	</div>
</div>