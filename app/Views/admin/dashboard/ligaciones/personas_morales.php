<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h1 class="mb-4 text-center font-weight-bold">LISTADO DE PERSONAS MORALES REGISTRADAS</h1>
                <a class="link link-primary" href="<?= base_url('admin/dashboard/folios_escritos') ?>" role="button"><i class="fas fa-reply"></i> REGRESAR A DENUNCIAS ESCRITAS</a>
            </div>
            <div class="col-12">

                <div class="card shadow border-0 rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mt-3" style="overflow-x:scroll;">
                                <table id="table-personas-morales" class="table table-bordered table-striped table-sm" data-page-length='50' style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">MARCA COMERCIAL</th>
                                            <th class="text-center">RAZÓN SOCIAL</th>
                                            <th class="text-center">RFC</th>
                                            <th class="text-center">GIRO</th>
                                            <th class="text-center">ESTADO</th>
                                            <th class="text-center">MUNICIPIO</th>
                                            <th class="text-center">SOLICITUD DE CAMBIO</th>
                                            v <th class="text-center">VENCIMIENTO</th>

                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($body_data->personasmorales as $index => $moral) { ?>
                                            <tr>
                                                <td class="text-center"><?= $moral->MARCACOMERCIAL ?></td>
                                                <td class="text-center"><?= $moral->RAZONSOCIAL ?></td>
                                                <td class="text-center"><?= $moral->RFC ?></td>
                                                <td class="text-center"><?= $moral->PERSONAMORALGIRODESCR ?></td>
                                                <td class="text-center"><?= $moral->ESTADODESCR ?></td>
                                                <td class="text-center"><?= $moral->MUNICIPIODESCR ?></td>
                                                <td class="text-center"><?= $moral->CAMBIO == "S" ? "SI" : "NO" ?></td>

                                                <?php if (isset($moral->FECHAFINPODER)) {
                                                    $date1 = new DateTime($moral->FECHAFINPODER);
                                                    $date2 = new DateTime(date("Y-m-d"));
                                                    $diff = $date1->diff($date2);
                                                    if ((intval($diff->format('%d')) <= 3) && (intval($diff->format('%y')) <= 0) && (intval($diff->format('%m')) <= 3)) { ?>
                                                        <td class="text-center text-danger font-weight-bold"> <?= intval($diff->format('%d'));?> DÍAS</td>
                                                    <?php } else { ?>
                                                        <td class="text-center text-success font-weight-bold"><?= intval($diff->format('%y'));?> AÑOS <?= intval($diff->format('%m'));?> MESES <?= intval($diff->format('%d'));?> DIAS</td>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <td class="text-center">SIN FECHA REGISTRADA</td>
                                                <?php } ?>

                                                <td class="text-center">
                                                    <a type="button" class="btn btn-success" href="<?= base_url('admin/dashboard/editar_persona_moral?id=' . $moral->PERSONAMORALID) ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
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
        </div>
    </div>
</section>
<script>
    $(function() {
        $("#table-personas-morales").DataTable({
            responsive: false,
            lengthChange: false,
            autoWidth: true,
            ordering: true,
            order: [
                [0, 'asc'],
                [2, 'asc'],
                [1, 'asc'],
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