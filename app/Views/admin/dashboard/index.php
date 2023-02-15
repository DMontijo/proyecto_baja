<?= $this->extend('admin/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>
<?php $rolesToMonitor = [1, 2, 6, 7, 11]; ?>
<?php
helper('fiel_helper');
$session = session();
$user_id = session('ID');
$directory = FCPATH . 'uploads/FIEL/' . $user_id;
$file_key = $user_id . '_key.key';
$file_cer = $user_id . '_cer.cer';
$file_text = $user_id . "_data.txt";
?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <?php if (file_exists($directory . '/' . $file_key) && file_exists($directory . '/' . $file_cer)) { ?>
        <?php if (file_exists($directory . '/' . $file_text)) { ?>
        <?php $validacion = (object)validarFiel($user_id);
				if ($validacion->valida) { ?>
        <?php if ($validacion->restante >= 60) { ?>
        <div class="alert alert-success text-right font-weight-bold" role="alert">
            FIEL CARGADA CORRECTAMENTE - VIGENCIA: <?= $validacion->fechafinal ?><br>
            DÍAS RESTANTES: <?=$validacion->restante?>
        </div>
        <?php } else { ?>
        <div class="alert alert-warning text-right font-weight-bold" role="alert">
            FIEL CARGADA CORRECTAMENTE - VIGENCIA: <?= $validacion->fechafinal ?><br>
            DÍAS RESTANTES: <?=$validacion->restante?>
        </div>
        <?php } ?>
        <?php } else { ?>
        <div class="alert alert-danger text-right font-weight-bold" role="alert">
            FIEL INVÁLIDA
        </div>
        <?php } ?>
        <?php } else { ?>
        <div class="alert alert-success text-right font-weight-bold" role="alert">
            FIEL CARGADA CORRECTAMENTE - VIGENCIA: NO SE PUEDE VALIDAR
        </div>
        <?php } ?>
        <?php } else { ?>
        <div class="alert alert-warning text-right font-weight-bold" role="alert">
            NO TIENES UNA FIEL CARGADA
        </div>
        <?php } ?>
    </div>
    <?php if (in_array(session('ROLID'), $rolesToMonitor)) { ?>
    <div class="col-4">
        <div class="card shadow" style="border-radius:10px;">
            <div class="card-body text-center">
                <h5 class="card-title">USUARIOS ACTIVOS</h5>
                <h4 class="font-weight-bold" id="card_active_users">0</h4>
                <a type="button" href="<?= base_url('admin/dashboard/usuarios_activos') ?>"
                    class="btn btn-primary font-weight-bold mt-4 text-white">VER MÁS</a>
            </div>
        </div>
    </div>
    <?php }; ?>
    <div class="col-4">
        <div class="card shadow" style="border-radius:10px;">
            <div class="card-body text-center">
                <h5 class="card-title">FOLIOS GENERADOS</h5>
                <h4 class="font-weight-bold"><?= $body_data->cantidad_folios ?></h4>
                <a type="button" href="<?= base_url('admin/dashboard/folios') ?>"
                    class="btn btn-primary font-weight-bold mt-4 text-white">VER MÁS</a>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card shadow" style="border-radius:10px;">
            <div class="card-body text-center">
                <h5 class="card-title">EXPEDIENTES GENERADOS</h5>
                <h4 class="font-weight-bold"><?= $body_data->cantidad_expedientes ?></h4>
                <a type="button" href="<?= base_url('admin/dashboard/folios_expediente') ?>"
                    class="btn btn-primary font-weight-bold mt-4 text-white">VER MÁS</a>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card shadow" style="border-radius:10px;">
            <div class="card-body text-center">
                <h5 class="card-title">DERIVACIONES GENERADAS</h5>
                <h4 class="font-weight-bold"><?= $body_data->cantidad_derivados ?></h4>
                <a type="button" href="<?= base_url('admin/dashboard/folios_derivados') ?>"
                    class="btn btn-primary font-weight-bold mt-4 text-white">VER MÁS</a>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card shadow" style="border-radius:10px;">
            <div class="card-body text-center">
                <h5 class="card-title">CANALIZACIONES GENERADAS</h5>
                <h4 class="font-weight-bold"><?= $body_data->cantidad_canalizados ?></h4>
                <a type="button" href="<?= base_url('admin/dashboard/folios_canalizados') ?>"
                    class="btn btn-primary font-weight-bold mt-4 text-white">VER MÁS</a>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card shadow" style="border-radius:10px;">
            <div class="card-body text-center">
                <h5 class="card-title">FOLIOS ASIGNADOS PARAR FIRMA</h5>
                <h4 class="font-weight-bold"><?= $body_data->cantidad_documentos ?></h4>
                <a type="button" href="<?= base_url('admin/dashboard/documentos') ?>"
                    class="btn btn-primary font-weight-bold mt-4 text-white">VER MÁS</a>
            </div>
        </div>
    </div>
</div>
<script>
window.onload = function() {
    getUsuarios();
    setInterval(() => {
        getUsuarios();
    }, 10000);

}
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
            document.querySelector('#card_active_users').innerHTML = response.count;
        },
        error: function(jqXHR, textStatus, errorThrown) {
            document.querySelector('#card_active_users').innerHTML = 0;
        }
    });
}
</script>
<?php if (session()->getFlashdata('acceso_denegado')) : ?>
<script>
Swal.fire({
    icon: 'error',
    html: '<strong><?= session()->getFlashdata('acceso_denegado') ?></strong>',
    confirmButtonColor: '#bf9b55',
})
</script>
<?php endif; ?>
<?= $this->endSection() ?>