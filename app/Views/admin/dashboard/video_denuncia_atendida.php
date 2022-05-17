<?= $this->extend('admin/templates/dashboard_template') ?>
<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<script src="<?= base_url() ?>/assets/DataTables/jquery/jquery.min.js"></script>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Videollamadas atendidas</h3>
            </div>

            <div class="card-body">

                <table id="videollamadasA" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre del denunciante</th>
                            <th>Fecha</th>
                            <th>Folio</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php for ($i = 0; $i < 10; $i++) { ?>
                            <td>1</td>
                            <td>Andrea Gutierrez</td>
                            <td>18/05/2021</td>
                            <td> 4451HC</td>
                            <td>Expediente</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script>
    $(function() {
        $("#videollamadasA").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", ]
        }).buttons().container().appendTo('#videollamadasA_wrapper .col-md-6:eq(0)');
    });
</script>

<?= $this->endSection() ?>