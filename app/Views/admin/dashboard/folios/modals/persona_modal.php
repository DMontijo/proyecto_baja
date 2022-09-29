<div class="modal fade shadow" id="folio_persona_fisica_modal" tabindex="-1" role="dialog" aria-labelledby="personaFisicaModalLabel" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-dialog-centered mw-100 w-50">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-blue text-white">
				<h5 class="modal-title font-weight-bold">PERSONA FÍSICA</h5>
				<button type="button" class="close text-white" id="close" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body bg-light">
				<ul class="nav nav-tabs" id="persona_tabs" role="tablist">
					<li class="nav-item" role="persona_fisica">
						<a class="nav-link active" id="persona" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Persona</a>
					</li>
					<li class="nav-item" role="persona_fisica_dom">
						<a class="nav-link" id="domicilio" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Domicilio</a>
					</li>
					<li class="nav-item" role="persona_fisica_mf">
						<a class="nav-link" id="nav-media-filiacion-tab" data-toggle="tab" href="#nav-media-filiacion" role="tab" aria-controls="nav-media-filiacion" aria-selected="false">Media Filiación</a>
					</li>

				</ul>
				<div class="tab-content" id="persona_content">
					<div class="tab-pane fade py-3 show active" id="home" role="tabpanel" aria-labelledby="persona">
						<div class="container_tab" style="height:70vh;overflow-y:scroll;">
							<?= view('admin/dashboard/folios/forms/form_persona_fisica') ?>
						</div>
					</div>

					<div class="tab-pane fade py-3" id="profile" role="tabpanel" aria-labelledby="domicilio">
						<div class="container_tab" style="height:70vh;overflow-y:scroll;">
							<?= view('admin/dashboard/folios/forms/form_domicilio') ?>
						</div>
					</div>
					<div class="tab-pane fade py-3" id="nav-media-filiacion" role="tabpanel" aria-labelledby="nav-media-filiacion-tab">
						<div class="container_tab" style="height:70vh;overflow-y:scroll;">
							<?= view('admin/dashboard/folios/forms/form_media_filiacion') ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$("input").prop('disabled', true);
	$("select").prop('disabled', true);
	$("textarea").prop('disabled', true);
</script>	