<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3 class="mb-4 font-weight-bold text-center">USUARIOS ACTIVOS PARA VIDEODENUNCIA</h3>
				<div class="card shadow border-0 rounded">
					<div class="card-body">
						<div class="row">
							<div class="col-12 mt-3" style="overflow-x:scroll;">
								<p id="message" class="mb-3 text-primary font-weight-bold text-center"> No hay ningún usuario conectado</p>
								<table id="table-usuarios-activos" class="table table-bordered table-hover table-striped d-none">
									<thead>
										<tr>
											<th class="text-center">NOMBRE</th>
											<th class="text-center">ESTADO</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript" src="<?= base_url() ?>/assets/agent/assets/openvidu-browser-2.25.0.min.js"></script>
<script src="https://cdn.socket.io/4.6.0/socket.io.min.js" integrity="sha384-c79GN5VsunZvi+Q/WObgk2in0CbZsHnjEqvFxC5DxHn9lTfNce2WW6h2pH6u/kF+" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>/assets/js/usuarios_activos.js" type="module"></script>
<script>
	// window.onload = function() {
	// 	getUsuarios();
	// 	setInterval(() => {
	// 		getUsuarios();
	// 	}, 10000);

	// }
	const getUsuarios = () => {
		$.ajax({
			data: {
				'u': 24,
				'token': '198429b7cc8a2a5733d97bc13153227dd5017555',
				'a': 'status'
			},
			url: "<?= base_url('/data/get-active-users') ?>",
			method: "POST",
			dataType: "json",
			success: function(response) {
				console.log(response);
				let message = document.querySelector("#message");
				let table = document.querySelector("#table-usuarios-activos");
				let tbody = document.querySelector("#table-usuarios-activos tbody");
				let filas = document.querySelectorAll("#table-usuarios-activos tbody tr");
				if (response.count > 0) {
					message.classList.add('d-none');
					table.classList.remove('d-none');
					filas.forEach(row => {
						row.remove();
					});
					response.users.forEach((user, i) => {
						let fila = document.createElement("tr");

						let td_1 = document.createElement("td");
						td_1.classList.add('text-center');
						let text_1 = document.createTextNode((user.name).toUpperCase());
						let td_2 = document.createElement("td");
						td_2.classList.add('text-center');
						let texto_activo = 'ACTIVO - ' + (user.evento == 'vlon' ? 'DISPONIBLE' : 'NO DISPONIBLE');
						let text_2 = document.createTextNode(texto_activo);
						td_2.classList.add('font-weight-bold');
						td_2.classList.add('text-success');

						td_1.appendChild(text_1);
						td_2.appendChild(text_2);
						fila.appendChild(td_1);
						fila.appendChild(td_2);
						tbody.appendChild(fila);
					});
				} else {
					message.classList.remove('d-none');
					table.classList.add('d-none');
					filas.forEach(row => {
						row.remove();
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {}
		});
	}
</script>
<?= $this->endSection() ?>
