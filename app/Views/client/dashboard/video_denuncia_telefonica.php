<?= $this->extend('client/templates/dashboard_template') ?>

<?= $this->section('title') ?>
<?php echo $header_data->title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php $session = session(); ?>
<style>
    #video_container {
        width: 100%;
        min-height: 70vh;
    }

    #secondary_videos_container {
        max-width: 200px;
        min-width: 150px;
        padding: 10px;
        padding-top: 30px;
        /* background-color: white; */
        height: calc(70vh - 70px);
        margin-top: -70vh;
        margin-left: auto;
        overflow-y: auto;
        transition: 0.5s;
    }

    @media only screen and (max-width: 600px) {
        #secondary_videos_container {
            max-width: 150px;
            min-width: 150px;
        }
    }

    .secondary_video {
        width: 100%;
        height: 100px;
        z-index: 1 !important;
        margin-bottom: 10px;
        background-color: black;
    }

    #secondary_video_details {
        /* background-color: transparent; */
        width: 100%;
    }

    #secondary_video video {
        box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 1);
        -webkit-box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 1);
        -moz-box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 1);
        width: 100% !important;
        height: 100% !important;
        border: white 2px solid;
    }

    #main_video {
        width: 100% !important;
        min-height: 70vh;
        max-height: 70vh;
        background-color: black;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #main_video video {
        max-width: 100%;
        max-height: 70vh;
    }

    #main_video_details {
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.5s;
        position: absolute;
        width: 100%;
        top: 0;
    }

    #main_video_details_name {
        display: inline-block;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        max-width: 300px;
        font-weight: bold;
    }

    #network_quality_group {
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.5s;
        position: absolute;
        width: 100%;
        top: 90%;
    }

    #tools-group {
        padding: 10px;
        background-color: rgba(0, 0, 0, 0);
        height: 70px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: -70px;
        z-index: 1;
        transition: 0.5s;
    }

    #tools-group:hover {
        background-color: rgba(0, 0, 0, .3);
    }
</style>
<div class="container-fluid mb-5">
    <div class="row d-block">
        <div class="col-12 p-0 m-0" id="pantalla_final">
            <div class="card text-center">
                <div class="card-body p-0 m-0 p-5 d-flex justify-content-center align-items-center">
                    <div class="text-center" style="max-width:500px;">
                        <img src="<?= base_url() ?>/assets/img/FGEBC.png" alt="Loader FGEBC" class="mb-3" style="width:250px;">
                        <p class="fw-bold">En estos momentos el servicio de video denuncia se encuentra en mantenimiento. Su denuncia será atendida vía telefónica , disculpe las molestias. </p>
                        <div class="d-grid gap-2">
                            <a href="<?= base_url('/denuncia/dashboard/denuncias') ?>" type="button" name="" id="" class="btn btn-primary">IR A MIS DENUNCIAS</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>

<script src="<?= base_url() ?>/assets/js/video_denuncia_client.js?v=<?= rand() ?>" type="module"></script>

<?= $this->endSection() ?>