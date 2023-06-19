<div class="modal fade" id="change_status_modal" role="dialog" aria-labelledby="changeStatusModal" aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-dialog-centered mw-100 w-75">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-primary text-white">
				<h5 class="modal-title font-weight-bold">CAMBIAR STATUS</h5>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body bg-light">
				<div class="row">
					<div class="col-12">
						<form id="form_change_status" name="form_change_status" class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
						<label for="status_doc_envio" class="form-label font-weight-bold">Estatus del envio:</label>
						<select class="form-control" id="status_req_envio" name="status_req_envio" required>
							<option  value="" disabled>Selecciona una opción</option>
							<option  value="N" >NO ENVIADO</option>
							<option  value="S"> ENVIADO</option>

						</select>

						<label for="status_doc_envio" class="form-label font-weight-bold">¿Se debe de enviar?</label>

						
						<select class="form-control" id="status_doc_envio" name="status_doc_envio" required>
							<option  value="" disabled>Selecciona una opción</option>
							<option  value="0" >NO</option>
							<option  value="1"> SI</option>

						</select>
						<input class="form-control" id="status_doc_id" name="status_doc_id" hidden>
						<input class="form-control" id="folio_id_doc" name="folio_id_doc" hidden>
						<input class="form-control" id="ano_doc" name="ano_doc" hidden>
						<button type="submit" class="btn btn-primary"><i class="fas fa-lock mr-2"></i>
											ACTUALIZAR STATUS</button>
						</form>
					

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('#form_change_status').submit(function (evt) {
    evt.preventDefault();
   cambiarStatusDocumentoForm();
});

//funcion pata cambiar el status de envio de los documentos, con la finalidad de que puedan volver a enviar
		function cambiarStatusDocumentoForm(){
			$.ajax({
			data: {
				'status_doc_envio': document.getElementById('status_doc_envio').value,
				'status_req_envio': document.getElementById('status_req_envio').value,

				'status_doc_id': document.getElementById('status_doc_id').value,
				'folio_id_doc': document.getElementById('folio_id_doc').value,
				'ano_doc': document.getElementById('ano_doc').value,

			},
			url: "<?= base_url('/data/change-status-doc') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				if (response.status == 1) {
					const documentos = response.documentos;
						let tabla_documentos = document.querySelectorAll('#table-documentos tr');
						tabla_documentos.forEach(row => {
							if (row.id !== '') {
								row.remove();
							}
						});
						llenarTablaDocumentos(documentos);
						Swal.fire({
							icon: 'success',
							text: 'Estatus del documento actualizado correctamente',
							confirmButtonColor: '#bf9b55',
						});
						location.reload();

					} else {
						Swal.fire({
							icon: 'error',
							text: 'No se actualizó el documento',
							confirmButtonColor: '#bf9b55',
						});
					}
			}
		});
		}
</script>