<div class="modal fade shadow" id="folio_persona_fisica_modal" role="dialog" aria-labelledby="personaFisicaModalLabel" aria-hidden="true" data-backdrop="">
	<div class="modal-dialog modal-dialog-centered mw-100 w-75">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-blue text-white">
				<h5 class="modal-title font-weight-bold">PERSONA FÍSICA</h5>
				<button type="button" class="close text-white" id="close" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body bg-light" style="height:70vh;overflow-y:auto;">
				<nav>
					<div class="nav nav-tabs" id="persona_tabs" role="tablist">
						<a class="nav-item nav-link active" id="nav-persona-fisica-tab" data-toggle="tab" href="#nav-persona-fisica" role="tab" aria-controls="nav-persona-fisica" aria-selected="true">Person Física</a>
						<a class="nav-item nav-link" id="nav-media-filiacion-tab" data-toggle="tab" href="#nav-media-filiacion" role="tab" aria-controls="nav-media-filiacion" aria-selected="false">Media Filiacion</a>
						<a class="nav-item nav-link" id="nav-domicilio-tab" data-toggle="tab" href="#nav-domicilio" role="tab" aria-controls="nav-domicilio" aria-selected="false">Domicilio</a>
						<a class="nav-item nav-link" id="nav-parentesco-tab" data-toggle="tab" href="#nav-parentesco" role="tab" aria-controls="nav-parentesco" aria-selected="false">Parentesco</a>

					</div>
				</nav>
				<div class="tab-content pt-3" id="persona_content">
					<div class="tab-pane fade show active" id="nav-persona-fisica" role="tabpanel" aria-labelledby="nav-persona-fisica-tab">
						<?= view('admin/dashboard/video_denuncia_forms/form_persona_fisica') ?>
					</div>
					<div class="tab-pane fade" id="nav-media-filiacion" role="tabpanel" aria-labelledby="nav-media-filiacion-tab">
						<?= view('admin/dashboard/video_denuncia_forms/form_media_filiacion') ?>
					</div>
					<div class="tab-pane fade" id="nav-domicilio" role="tabpanel" aria-labelledby="nav-domicilio-tab">
						<?= view('admin/dashboard/video_denuncia_forms/form_domicilio') ?>
					</div>
					<div class="tab-pane fade" id="nav-parentesco" role="tabpanel" aria-labelledby="nav-parentesco-tab">
						<?= view('admin/dashboard/video_denuncia_forms/form_parentesco') ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>