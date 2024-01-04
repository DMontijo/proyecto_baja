<div class="modal fade shadow" id="agregar_archivos_modal_anonima" role="dialog" aria-labelledby="agregar_archivos_modal" aria-hidden="true" data-backdrop="">
	<div class="modal-dialog modal-dialog-centered mw-100 w-75">
		<div class="modal-content" style="box-shadow: 0px 0px 55px 9px rgba(0,0,0,0.66)!important;">
			<div class="modal-header bg-blue text-white">
				<h5 class="modal-title font-weight-bold">AGREGAR UN NUEVO ARCHIVO</h5>
				<button type="button" class="close text-white" id="close" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body bg-light" style="height:70vh;overflow-y:auto;">

				<div class="tab-content pt-3" id="archivo_content">
					<div class="tab-pane fade show active" id="nav-archivo" role="tabpanel" aria-labelledby="nav-archivo-tab">
						<div class="row" style="font-size:10px;">
							<div class="col-12 col-sm-6 offset-sm-3">
								<p class="p-0 m-0"><strong>Documentos a anexar</strong></p>
								<input type="file" class="form-control" id="documentoArchivo" name="documentoArchivo" accept="image/jpeg, image/jpg, image/png, .doc, .pdf">
								<img id="viewDocumentoArchivo" class="img-fluid" src="" style="max-width:100px;">
								<button type="button" class="btn-sm btn-primary" style="width: 100%;" id="btnSubirArchivosAnonima">Subir documento</button>
							</div>
						</div>
					</div>

				</div>

				<div id="documentos_anexar_spinner" class="row text-center d-none" style="font-size:10px;">
					<div class="col-12 col-sm-6 offset-sm-3">
						<div class="spinner-border text-primary" role="status">
							<span class="visually-hidden">Subiendo...</span>
						</div>
						<h5 class="text-center">Subiendo</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	//Previsualizacion del documento a subir
	document.querySelector('#documentoArchivo').addEventListener('change', (e) => {
		let preview = document.querySelector('#viewDocumentoArchivo');
		if (e.target.files && e.target.files[0]) {
			let reader = new FileReader();
			reader.onload = function(e) {
				preview.setAttribute('src', e.target.result);
			}
			reader.readAsDataURL(e.target.files[0]);
		}
	});
	//Limpieza de elementos al cerrar modal
	$('#agregar_archivos_modal_anonima').on('hidden.bs.modal', function() {
		let preview = document.querySelector('#viewDocumentoArchivo');

		document.getElementById('documentoArchivo').value = '';
		preview.setAttribute('src', '');
	});
</script>