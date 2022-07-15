<?= $this->extend('admin/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php

?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <form method="POST" action="<?php echo base_url('admin/dashboard/generaPDFE')?>">
            <input type="text" class="form-control" id="input_folio_atencion" name="input_folio_atencion" placeholder="Folio de atención..." value="<?= isset($body_data->folio) ? $body_data->folio : '' ?>">

                <h3 class="mb-4"><?php echo $body_data->constanciaExtravio[5]->TITULO ?></h3>
                <button type="submit" class="btn btn-primary" id="downloadPDF">
                    Descargar PDF
                </button>
                <button onclick="clickMe()" class="btn btn-secondary">Descargar RTF</button>
                <div class="card shadow border-0">
                    <div class="card-body" name="certificado" id="certificado" style="margin: 2%;">
                        <h5><?php echo $body_data->constanciaExtravio[5]->PLACEHOLDER ?></h5>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</section>
<script>
    function clickMe() {
        let certificado = document.getElementById("certificado").innerHTML;
        let obj = {
            'certificado': certificado
        };
        $.ajax({
            data: obj,
            method: "post",
            url: "<?php echo base_url('/data/convert'); ?>",
            dataType: "html",
            success: function(data) {
                console.log(data);
                alert("convertido a rtf");
            },
            error: function(jqXHR, exception) {
                var error_msg = '';
                if (jqXHR.status === 0) {
                    error_msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    // 404 page error
                    error_msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    // 500 Internal Server error
                    error_msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    // Requested JSON parse
                    error_msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    // Time out error
                    error_msg = 'Time out error.';
                } else if (exception === 'abort') {
                    // request aborte
                    error_msg = 'Ajax request aborted.';
                } else {
                    error_msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                // error alert message
                alert('error :: ' + error_msg);
            },
        });


    }
</script>
<?= $this->endSection() ?>