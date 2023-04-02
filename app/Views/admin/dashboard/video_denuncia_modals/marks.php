<div class="modal fade shadow" id="marksModal" tabindex="-1" role="dialog" aria-labelledby="marksModalLabel" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-dialog-centered mw-100 w-50">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-primary justify-content-center">
				<h5 class="modal-title font-weight-bold text-white">REGISTRO DE MARCAS</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>

			</div>

			<div class="modal-body text-center" id="">
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
					<label for="selectMarks" class="form-label font-weight-bold">Registro:</label>
					<select id="selectMarks" class="form-control">
						<option disabled selected value="">Selecciona una marca</option>
					</select>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
					<label for="genero_denunciante" class="form-label font-weight-bold">Comentario:</label>
					<textarea class="form-control" id="comentario_marca"></textarea>
				</div>
				<button class="btn btn-success" id="enviar_marca"> Enviar</button>
			</div>
		</div>
	</div>
</div>
<script>
	$("#marksModal").on('hidden.bs.modal', function () {
		document.getElementById('selectMarks').value = '';
		document.getElementById('comentario_marca').value = '';

	});
</script>