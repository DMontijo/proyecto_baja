<?= $this->extend('admin/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
            <h3 class="mb-4"><?php echo $body_data->constanciaPertenencia[3]->TITULO?></h3>
            <input type="button" class="btn btn-primary btn-block py-2 mb-2 font-weight-bold" onclick="printDiv();" value="Imprimir" />
            <div class="card shadow border-0">
					<div class="card-body" style="margin: 2%;" id="pertenencia">
            <h5><?php echo $body_data->constanciaPertenencia[3]->PLACEHOLDER?></h5>
                    </div>
            </div>
            </div>
        </div>
    </div>
</section>
<script>
    function printDiv() {
        var mywindow = window.open('', 'PRINT', 'height=600,width=700');
        mywindow.document.write('<html><head>');
        //mywindow.document.write('<style>.tabla{width:100%;border-collapse:collapse;margin:16px 0 16px 0;}.tabla th{border:1px solid #ddd;padding:4px;background-color:#d4eefd;text-align:left;font-size:15px;}.tabla td{border:1px solid #ddd;text-align:left;padding:6px;}</style>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(document.getElementById('pertenencia').innerHTML);
        mywindow.document.write('</body></html>');
        mywindow.document.close(); 
        mywindow.focus();
        mywindow.print();
        mywindow.close();
        return true;
    }
    
</script>
<?= $this->endSection() ?>