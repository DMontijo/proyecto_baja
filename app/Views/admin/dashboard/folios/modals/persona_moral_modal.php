<div class="modal fade shadow" id="folio_persona_moral_modal" role="dialog" aria-labelledby="personaMoralModalLabel" aria-hidden="true" data-backdrop="">
	<div class="modal-dialog modal-dialog-centered mw-100 w-75">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-blue text-white">
				<h5 class="modal-title font-weight-bold">PERSONA MORAL</h5>
				<button type="button" class="close text-white" id="close" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body bg-light" style="height:70vh;overflow-y:auto;">
				<nav>
					<div class="nav nav-tabs" id="persona_moral_tabs" role="tablist">
						<a class="nav-item nav-link active" id="nav-persona-moral-tab" data-toggle="tab" href="#nav-persona-moral" role="tab" aria-controls="nav-persona-moral" aria-selected="true">Persona Moral</a>
						<a class="nav-item nav-link" id="nav-notificaciones-tab" data-toggle="tab" href="#nav-notificaciones" role="tab" aria-controls="nav-notificaciones" aria-selected="false">Notificaciones</a>
						<a class="nav-item nav-link" id="nav-poder-tab" data-toggle="tab" href="#nav-poder" role="tab" aria-controls="nav-poder" aria-selected="false">Poder</a>

					</div>
				</nav>
				<div class="tab-content pt-3" id="persona_moral_content">
					<div class="tab-pane fade show active" id="nav-persona-moral" role="tabpanel" aria-labelledby="nav-persona-moral-tab">
						<?= view('admin/dashboard/folios/forms/form_persona_moral') ?>

					</div>
					<div class="tab-pane fade" id="nav-notificaciones" role="tabpanel" aria-labelledby="nav-notificaciones-tab">
						<?= view('admin/dashboard/folios/forms/form_persona_moral_notificaciones') ?>

					</div>
					<div class="tab-pane fade" id="nav-poder" role="tabpanel" aria-labelledby="nav-poder-tab">
						<?= view('admin/dashboard/folios/forms/form_persona_moral_poder') ?>

					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
