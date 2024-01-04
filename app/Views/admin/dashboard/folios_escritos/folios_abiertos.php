<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center mb-4">
				<h1 class="mb-4 text-center font-weight-bold">FOLIOS ABIERTOS (DENUNCIA ESCRITA)</h1>
                <a class="link link-primary" href="<?= base_url('admin/dashboard/folios_escritos') ?>" role="button"><i class="fas fa-reply"></i> REGRESAR A DENUNCIAS ESCRITAS</a>
			</div>
			<div class="col-12">
				<div class="card shadow border-0" style="overflow-x:auto;">
					<div class="card-body">
						<table id="folios_abiertos" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th class="text-center">FOLIO</th>
									<th class="text-center">FECHA REGISTRO</th>
									<th class="text-center">DELITO</th>
									<th class="text-center">DENUNCIANTE</th>
									<!-- <th class="text-center">ESTADO</th> -->
									<th class="text-center"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($body_data->folio as $index => $folio) { ?>
									<tr>
										<td class="text-center font-weight-bold"><?= $folio->FOLIOID . '/' . $folio->ANO ?></td>
										<td class="text-center"><?= date('d-m-Y H:i:s', strtotime($folio->FECHAREGISTRO)) ?></td>
										<td class="text-center"><?= $folio->HECHODELITO ?></td>
										<td class="text-center"><?= $folio->NOMBRE ?> <?= $folio->APELLIDO_PATERNO ?> <?= $folio->APELLIDO_MATERNO ? $folio->APELLIDO_MATERNO : '' ?></td>
										<!-- <td class="text-center"><?= $folio->STATUS ?></td> -->
										<td class="text-center">
											<a type="button" href="<?= base_url('/admin/dashboard/denuncia-escrita?folio=') . $folio->FOLIOID . '&year=' . $folio->ANO  ?>" class="btn btn-primary text-white"><i class="fas fa-eye"></i></a>
											<?php if (session('ROLID') == 1 || session('ROLID') == 6 || session('ROLID') == 7) { ?>

											<button type="button" class="btn btn-primary"onclick='asignarAgente(<?=$folio->FOLIOID?>,<?=$folio->ANO?>)' ><i class="fas fa-user-tag"></i></button>
											<?php } ?>

										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php include('asignar_agente_modal.php') ?>

<script>
	$(function() {
		$("#folios_abiertos").DataTable({
			responsive: false,
			lengthChange: false,
			autoWidth: true,
			ordering: true,
			order: [
				[0, 'asc'],
			],
			searching: true,
			pageLength: 25,
			// dom: 'Bfrtip',
			// buttons: [
			// 	'copy', 'excel', 'pdf'
			// ],
			language: {
				url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-MX.json'
			}
		});
	});
	//Funcion para asignar un agente al documento y que este lo firme, recibe por parametro el id del documento, folio y año

	function asignarAgente(folio, ano) {
		$('#asignarAgenteModal').modal('show');
		const btn_asignar_agente = document.querySelector('#enviarAgente');

		btn_asignar_agente.addEventListener('click', (e) => {
			btn_asignar_agente.disabled = true;
			$.ajax({
				data: {
					'folio': folio,
					'year': ano,
					'agenteid': document.querySelector('#selectAgente').value
				},
				url: "<?= base_url('/data/update-agente-atencion') ?>",
				method: "POST",
				dataType: "json",
				success: function(response) {
					const documentos = response.documentos;
					if (response.status == 1) {
						

						Swal.fire({
							icon: 'success',
							text: 'Agente asignado correctamente',
							confirmButtonColor: '#bf9b55',
						});
						$('#asignarAgenteModal').modal('hide');
						location.reload();
					}

				},
				error: function(jqXHR, textStatus, errorThrown) {
					btn_asignar_agente.disabled = false;

				}
			});
		});

	}
</script>

<?= $this->endSection() ?>
