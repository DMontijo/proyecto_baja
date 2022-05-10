<div class="container" style="min-height:90vh;">

    <div class=" card d-none d-lg-block" style="font-size: 12px; color:var(--gris1); col-10">
        <div class="row card-body" style="background-color: var(--azul)">
            <div class="col-10">
                <p>Para realizar una video denuncia ó solicitar constancia de extravío acepta términos y condiciones, aviso de privacidad y derechos del ofendido. Puedes consultarlos <a onclick="window.open(); return false;" href="" style="color: azul">aquí</a></p>
            </div>

            <form name="che" action="" enctype="text/plain" class="col-2">
                <div>
                    <div class="form-check">
                        <input title="Aceptar términos y condiciones, aviso de privacidad, derechos del ofendido." class="form-check-input" type="checkbox" name="miCheck" onclick="handleClick()" id="aceptar_todos">
                        <p class="form-check-label" for="AceptarTodos">Aceptar todos</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>

    <!--Versión escritorio-->

    <section class="row align-content-center justify-content-center">
        <div class="col-sm-4 col-md-3 d-none d-lg-block">
            <div class="card text-center bg-transparent border-0">
                <div class="card-body" data-bs-toggle="popover" data-bs-placement="top">
                    <a href="<?= base_url() ?>/denuncia" class="text-decoration-none" onclick="handleClickBTN(event)" name="VideoDenuncia" id="VideoDenuncia">
                        <img src="<?= base_url() ?>/assets/img/icons/video_denuncia.png" class="w-75" alt="Video Denuncia">
                        <p class="fw-bold fs-5 mt-2  text-dark ">Video Denuncia</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-4 col-md-3 d-none d-lg-block" id="Constancia">
            <div class="card text-center bg-transparent border-0">
                <div class="card-body">
                    <a href="" class="text-decoration-none" onclick="" name="constancia" id="constancia">
                        <img src="<?= base_url() ?>/assets/img/icons/constancia.png" class="w-75" alt="Constancia extravío">
                        <p class="fw-bold fs-5 mt-2  text-dark ">Constancia extravío</p>
                    </a>
                </div>
            </div>
        </div>
        <!-- <div class="col-sm-4 col-md-3 d-none d-lg-block">
            <div class="card text-center bg-transparent border-0">
                <div class="card-body">
                    <a href="" class="text-decoration-none">
                        <img src="<?= base_url() ?>/assets/img/icons/consulta_ciudadana.png" class="w-75" alt="Consulta ciudadana de expediente">
                        <p class="fw-bold fs-5 mt-2  text-dark ">Consulta ciudadana de expediente</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-3 d-none d-lg-block">
            <div class="card text-center bg-transparent border-0">
                <div class="card-body">
                    <a href="" class="text-decoration-none">
                        <img src="<?= base_url() ?>/assets/img/icons/buzon_fiscal.png" class="w-75" alt="Buzón físcal">
                        <p class="fw-bold fs-5 mt-2  text-dark ">Buzón físcal</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-3 d-none d-lg-block">
            <div class="card text-center bg-transparent border-0">
                <div class="card-body">
                    <a href="" class="text-decoration-none">
                        <img src="<?= base_url() ?>/assets/img/icons/buzon_visitaduria.png" class="w-75" alt="Buzón visitaduría">
                        <p class="fw-bold fs-5 mt-2  text-dark ">Buzón visitaduría</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-3 d-none d-lg-block">
            <div class="card text-center bg-transparent border-0">
                <div class="card-body">
                    <a href="" class="text-decoration-none">
                        <img src="<?= base_url() ?>/assets/img/icons/personas_no_localizadas.png" class="w-75" alt="Personas no localizadas">
                        <p class="fw-bold fs-5 mt-2  text-dark ">Personas no localizadas</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-3 d-none d-lg-block">
            <div class="card text-center bg-transparent border-0">
                <div class="card-body">
                    <a href="https://consultapublicamx.plataformadetransparencia.org.mx/vut-web/faces/view/consultaPublica.xhtml?idEntidad=MDI=&idSujetoObligado=MTM4MTA=#inicio" class="text-decoration-none">
                        <img src="<?= base_url() ?>/assets/img/icons/sipot.png" class="w-75" alt="SIPOT">
                        <p class="fw-bold fs-5 mt-2  text-dark ">SIPOT</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-3 d-none d-lg-block">
            <div class="card text-center bg-transparent border-0">
                <div class="card-body">
                    <a href="" class="text-decoration-none">
                        <img src="<?= base_url() ?>/assets/img/icons/proveedores.png" class="w-75" alt="Proveedores">
                        <p class="fw-bold fs-5 mt-2  text-dark ">Proveedores</p>
                    </a>
                </div>
            </div>
        </div> -->
    </section>

    <!--Versión movil-->
    <section class="row d-block d-lg-none">
        <div class="container card rounded" style="font-size: 12px; color:white;">
            <div class="row card-body box-checks" style="background-color: var(--azul)">
                <div class="col-12">
                    <p>Para realizar una video denuncia ó solicitar constancia de extravío acepta términos y condiciones, aviso de privacidad y derechos del ofendido. Puedes consultarlos <a href="#" class="text-yellow">aquí</a></p>
                </div>
                <div class="col-12">
                    <div class="form-check" onclick=”disableSending();”>
                        <input class="form-check-input" type="checkbox" value="" id="aceptar_todos">
                        <a href="#" class="form-check-label" for="AceptarTodos">Aceptar todos</a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="col-12">
            <a href="" class="text-decoration-none">
                <div class="card text-white bg-light border-0 shadow rounded-3 mb-4">
                    <div class="card-body d-flex">
                        <div class="w-75 d-flex align-items-center" style="height:100px">
                            <p class="fw-bold d-fle p-0 m-0 text-dark fs-4">Video Denuncia</p>
                        </div>
                        <div class="w-25 d-flex align-items-center justify-content-end" style="height:100px">
                            <img src="<?= base_url() ?>/assets/img/icons/video_denuncia.png" class="movil-icon" alt="Video Denuncia">
                        </div>
                    </div>
                </div>
            </a>
            <a href="" class="text-decoration-none">
                <div class="card text-white bg-light border-0 shadow rounded-3 mb-4">
                    <div class="card-body d-flex">
                        <div class="w-75 d-flex align-items-center" style="height:100px">
                            <p class="fw-bold d-fle p-0 m-0 text-dark fs-4">Constancia extravío</p>
                        </div>
                        <div class="w-25 d-flex align-items-center justify-content-end" style="height:100px">
                            <img src="<?= base_url() ?>/assets/img/icons/constancia.png" class="movil-icon" alt="Constancia extravío">
                        </div>
                    </div>
                </div>
            </a>
            <!-- <a href="" class="text-decoration-none">
                <div class="card text-white bg-light border-0 shadow rounded-3 mb-4">
                    <div class="card-body d-flex">
                        <div class="w-75 d-flex align-items-center" style="height:100px">
                            <p class="fw-bold d-fle p-0 m-0 text-dark fs-4">Consulta ciudadana de expediente</p>
                        </div>
                        <div class="w-25 d-flex align-items-center justify-content-end" style="height:100px">
                            <img src="<?= base_url() ?>/assets/img/icons/consulta_ciudadana.png" class="movil-icon"
                                alt="Consulta ciudadana de expedi">
                        </div>
                    </div>
                </div>
            </a>
            <a href="" class="text-decoration-none">
                <div class="card text-white bg-light border-0 shadow rounded-3 mb-4">
                    <div class="card-body d-flex">
                        <div class="w-75 d-flex align-items-center" style="height:100px">
                            <p class="fw-bold d-fle p-0 m-0 text-dark fs-4">Buzón físcal</p>
                        </div>
                        <div class="w-25 d-flex align-items-center justify-content-end" style="height:100px">
                            <img src="<?= base_url() ?>/assets/img/icons/buzon_fiscal.png" class="movil-icon"
                                alt="Buzón físcal">
                        </div>
                    </div>
                </div>
            </a>
            <a href="" class="text-decoration-none">
                <div class="card text-white bg-light border-0 shadow rounded-3 mb-4">
                    <div class="card-body d-flex">
                        <div class="w-75 d-flex align-items-center" style="height:100px">
                            <p class="fw-bold d-fle p-0 m-0 text-dark fs-4">Buzón visitaduría</p>
                        </div>
                        <div class="w-25 d-flex align-items-center justify-content-end" style="height:100px">
                            <img src="<?= base_url() ?>/assets/img/icons/buzon_visitaduria.png" class="movil-icon"
                                alt="Buzón visitaduría">
                        </div>
                    </div>
                </div>
            </a>
            <a href="" class="text-decoration-none">
                <div class="card text-white bg-light border-0 shadow rounded-3 mb-4">
                    <div class="card-body d-flex">
                        <div class="w-75 d-flex align-items-center" style="height:100px">
                            <p class="fw-bold d-fle p-0 m-0 text-dark fs-4">Personas no localizadas</p>
                        </div>
                        <div class="w-25 d-flex align-items-center justify-content-end" style="height:100px">
                            <img src="<?= base_url() ?>/assets/img/icons/personas_no_localizadas.png" class="movil-icon"
                                alt="Personas no localizadas">
                        </div>
                    </div>
                </div>
            </a>
            <a href="" class="text-decoration-none">
                <div class="card text-white bg-light border-0 shadow rounded-3 mb-4">
                    <div class="card-body d-flex">
                        <div class="w-75 d-flex align-items-center" style="height:100px">
                            <p class="fw-bold d-fle p-0 m-0 text-dark fs-4">SIPOT</p>
                        </div>
                        <div class="w-25 d-flex align-items-center justify-content-end" style="height:100px">
                            <img src="<?= base_url() ?>/assets/img/icons/sipot.png" class="movil-icon" alt="SIPOT">
                        </div>
                    </div>
                </div>
            </a>
            <a href="" class="text-decoration-none">
                <div class="card text-white bg-light border-0 shadow rounded-3 mb-4">
                    <div class="card-body d-flex">
                        <div class="w-75 d-flex align-items-center" style="height:100px">
                            <p class="fw-bold d-fle p-0 m-0 text-dark fs-4">Proveedores</p>
                        </div>
                        <div class="w-25 d-flex align-items-center justify-content-end" style="height:100px">
                            <img src="<?= base_url() ?>/assets/img/icons/proveedores.png" class="movil-icon"
                                alt="Proveedores">
                        </div>
                    </div>
                </div>
            </a> -->
        </div>
    </section>

</div>

<script>
    // function handleClick() {
    //     var chk=document.getElementById("aceptar_todos").checked;
    //     let vd = document.getElementById("VideoDenuncia")
    //     chk ? vd.href = "<?= base_url() ?>/denuncia" : vd.href = "";
    // }

    function handleClickBTN(e) {
        var chk = document.getElementById("aceptar_todos").checked;
        //chk ? alert("ok") : (alert("acepta los terminos porfavor"));
        if (!chk) {
            e.preventDefault();
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        }
    }

    //let vd = document.getElementById("VideoDenuncia").href = ""
</script>

<script>

</script>