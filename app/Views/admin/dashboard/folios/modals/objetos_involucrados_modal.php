<div class="modal fade shadow" id="folio_objetos_ver" role="dialog" aria-labelledby="folio_objetos_ver" aria-hidden="true" data-backdrop="">
	<div class="modal-dialog modal-dialog-centered mw-100 w-75">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-blue text-white">
				<h5 class="modal-title font-weight-bold">OBJETOS INVOLUCRADOS</h5>
				<button type="button" class="close text-white" id="close" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body bg-light" style="height:70vh;overflow-y:auto;">

				<div class="tab-content pt-3" id="persona_content">
					<div class="tab-pane fade show active" id="nav-form_objetos_involucrados" role="tabpanel" aria-labelledby="nav-form_objetos_involucrados-tab">
						<?= view('admin/dashboard/folios/forms/form_objetos_involucrados') ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	//Se deshabilitan todos los elementos input, select y textarea

	$("input").prop('disabled', true);
	$("select").prop('disabled', true);
	$("textarea").prop('disabled', true);
</script>