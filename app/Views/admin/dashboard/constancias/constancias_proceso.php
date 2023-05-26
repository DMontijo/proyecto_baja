<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h1 class="mb-4 text-center font-weight-bold">CONSTANCIAS DE EXTRAVÍO EN PROCESO</h1>
                <a class="link link-primary" href="<?= base_url('admin/dashboard/constancias') ?>" role="button"><i
                        class="fas fa-reply"></i> REGRESAR A CONSTANCIAS</a>
            </div>
            <div class="col-12">
                <div class="card shadow border-0" style="overflow-x:auto;">
                    <div class="card-body">
                        <table id="extravios_abiertos" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">FOLIO</th>
                                    <th class="text-center">AÑO</th>
                                    <th class="text-center">FECHA</th>
                                    <th class="text-center">HORA</th>
                                    <th class="text-center">SOLICITANTE</th>
                                    <th class="text-center">CORREO</th>
                                    <th class="text-center">TELÉFONO</th>
                                    <th class="text-center">TIPO DE CONSTANCIA</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($body_data->constancia as $index => $constancia) { ?>
                                <tr>
                                    <td class="text-center font-weight-bold"><?= $constancia->CONSTANCIAEXTRAVIOID ?>
                                    </td>
                                    <td class="text-center"><?= $constancia->ANO ?></td>
                                    <td class="text-center"><?= $constancia->FECHA ?></td>
                                    <td class="text-center"><?= $constancia->HORA ?></td>
                                    <td class="text-center"><?= $constancia->NOMBRE ?></td>
                                    <td class="text-center"><?= $constancia->CORREO?></td>
                                    <td class="text-center"><?= $constancia->TELEFONO ?></td>
                                    <td class="text-center"><?= $constancia->EXTRAVIO == 'DOCUMENTOS'
																	? $constancia->TIPODOCUMENTO
																	: $constancia->EXTRAVIO ?></td>
                                    <td class="text-center">
                                        <form action="<?= base_url('/admin/dashboard/constancia_extravio_liberar')?>"
                                            method="post">
                                            <input type="text" hidden name="folio"
                                                value="<?=$constancia->CONSTANCIAEXTRAVIOID ?>">
                                            <input type="text" hidden name="year" value="<?=$constancia->ANO ?>">
                                            <button class="btn btn-primary text-white" type="submit">
                                                LIBERAR
                                            </button>
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

<?php if (session()->getFlashdata('message_error')) : ?>
<script>
Swal.fire({
    icon: 'error',
    html: '<strong><?= session()->getFlashdata('message') ?></strong>',
    confirmButtonColor: '#bf9b55',
})
</script>
<?php endif; ?>
<?php if (session()->getFlashdata('message_success')) : ?>
<script>
Swal.fire({
    icon: 'success',
    html: '<strong><?= session()->getFlashdata('message_success') ?></strong>',
    confirmButtonColor: '#bf9b55',
})
</script>
<?php endif; ?>
<?php if (session()->getFlashdata('message_warning')) : ?>
<script>
Swal.fire({
    icon: 'warning',
    html: '<strong><?= session()->getFlashdata('message_warning') ?></strong>',
    confirmButtonColor: '#bf9b55',
})
</script>
<?php endif; ?>
<script>
$(function() {
    $("#extravios_abiertos").DataTable({
        responsive: false,
        lengthChange: false,
        autoWidth: true,
        ordering: true,
        order: [
            // [0, 'asc'],
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
</script>

<?= $this->endSection() ?>
