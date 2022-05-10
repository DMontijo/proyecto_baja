<?= $this->extend('templates/admin_template') ?>
<?= $this->section('content') ?>
<style>
   .pagination > li > a, .pagination > li > span{background-color:#092b47 !important}
.pagination > li.active > a, .pagination > li.active > span{background-color:#092b47 !important}

</style>
<section class="content">
    <div class="container-fluid">
</br>
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
                            <td>1</td>
                            <td>Andrea Gutierrez</td>
                            <td>18/05/2021</td>
                            <td> 4451HC</td>
                            <td>Expediente</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
  $(function () {
    $("#videollamadasA").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print",]
    }).buttons().container().appendTo('#videollamadasA_wrapper .col-md-6:eq(0)');
});
</script>
<?= $this->endSection() ?>