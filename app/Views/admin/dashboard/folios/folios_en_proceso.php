<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center mb-4">
				<h1 class="mb-4 text-center font-weight-bold">FOLIOS EN PROCESO</h1>
				<a class="link link-primary" href="<?= base_url('admin/dashboard/folios') ?>" role="button"><i class="fas fa-reply"></i> REGRESAR A FOLIOS</a>
			</div>
			<div class="col-12">
				<div class="card shadow border-0" style="overflow-x:auto;">
					<div class="card-body">
						<table id="folios_sin_firma" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th class="text-center">FOLIO</th>
									<th class="text-center">DELITO COMENTADO</th>
									<th class="text-center">EN ATENCIÓN POR</th>
									<th class="text-center"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($body_data->folio as $index => $folio) { ?>
									<tr>
										<td class="text-center font-weight-bold"><?= $folio->FOLIOID . '/' . $folio->ANO ?></td>
										<td class="text-center"><?= $folio->HECHODELITO ?></td>
										<td class="text-center"><?= $folio->NOMBRE ?> <?= $folio->APELLIDO_PATERNO ?> <?= $folio->APELLIDO_MATERNO ?></td>
										<td class="text-center">
											<form id="<?= 'form_' . $folio->FOLIOID ?>"action="<?= base_url('admin/dashboard/liberar_folio') ?>" name="formulario_liberacion" method="POST"onsubmit="return confirmarLiberacion(this)">
												<input type="text" name="folio" value="<?= $folio->FOLIOID ?>" hidden >
												<input type="text" name="year" value="<?= $folio->ANO ?>" hidden >
												<input type="text" id="agenteatencion" value="<?= $folio->NOMBRE . ' ' . $folio->APELLIDO_PATERNO?>" hidden>
												<button type="submit" class="btn btn-primary">LIBERAR</button>
											</form>
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
<script>
	function confirmarLiberacion(element) {
		event.preventDefault();

		Swal.fire({
			icon: 'warning',
			title: "¿Estás seguro de liberar este folio? El folio esta siendo atendido por "+document.getElementById('agenteatencion').value ,
			showCancelButton: true,
			confirmButtonColor: "#bf9b55",
			confirmButtonText: "Aceptar",
			cancelButtonText: "Cancelar",
		}).then(result => {
			if (result.dismiss === Swal.DismissReason.cancel) {}else{
				element.submit();
				// console.log(document.getElementById('folio').value);	
				// document.getElementsByName('formulario_liberacion').submit();
			}
		})
	}
	$(function() {
		$("#folios_sin_firma").DataTable({
			responsive: false,
			lengthChange: false,
			autoWidth: true,
			ordering: true,
			order: [
				[0, 'asc'],
			],
			searching: true,
			pageLength: 100,
			// dom: 'Bfrtip',
			// buttons: [
			// 	'copy', 'excel', 'pdf'
			// ],
			language: {
				url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-MX.json'
			}
		});
	});
</script>

<?= $this->endSection() ?>