<div class="modal fade" id="take_photo_modal" tabindex="-1" aria-labelledby="take_photo_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="bs">Tomar foto</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="row">
                    <div class="col-12">
                        <p class="fw-bolder">Selecciona el dispositivo</p>
                    </div>
                    <div class="col-6 offset-3 mb-3">
                        <select class="form-select" name="listaDeDispositivos" id="listaDeDispositivos"></select>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" id="boton">Tomar foto</button>
                        <p class="fw-bold text-primary" id="estado"></p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="ratio ratio-16x9">
                        <video class="rounded" muted="muted" id="video"></video>
                        <canvas id="canvas" class="d-none"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const $video = document.querySelector("#video");
    const $canvas = document.querySelector("#canvas");
    const $boton = document.querySelector("#boton");
    const $estado = document.querySelector("#estado");
    const $listaDeDispositivos = document.querySelector("#listaDeDispositivos");

    function tieneSoporteUserMedia() {
        return !!(navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator
            .webkitGetUserMedia || navigator.msGetUserMedia)
    }

    function _getUserMedia() {
        return (navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator
            .webkitGetUserMedia || navigator.msGetUserMedia).apply(navigator, arguments);
    }

    const llenarSelectConDispositivosDisponibles = () => {
        navigator
            .mediaDevices
            .enumerateDevices()
            .then(function(dispositivos) {
                const dispositivosDeVideo = [];
                dispositivos.forEach(function(dispositivo) {
                    const tipo = dispositivo.kind;
                    if (tipo === "videoinput") {
                        dispositivosDeVideo.push(dispositivo);
                    }
                });

                // Vemos si encontramos algún dispositivo, y en caso de que si, entonces llamamos a la función
                if (dispositivosDeVideo.length > 0) {
                    // Llenar el select
                    dispositivosDeVideo.forEach(dispositivo => {
                        const option = document.createElement('option');
                        option.value = dispositivo.deviceId;
                        option.text = dispositivo.label;
                        $listaDeDispositivos.appendChild(option);
                    });
                }
            });
    }

    (function() {
        // Comenzamos viendo si tiene soporte, si no, nos detenemos
        if (!tieneSoporteUserMedia()) {
            alert("Tu navegador no soporta esta característica");
            $estado.innerHTML = "Tu navegador no soporta este funcionamiento. Toma una foto";
            return;
        }
        //Aquí guardaremos el stream globalmente
        let stream;

        // Comenzamos pidiendo los dispositivos
        navigator
            .mediaDevices
            .enumerateDevices()
            .then(function(dispositivos) {
                // Vamos a filtrarlos y guardar aquí los de vídeo
                const dispositivosDeVideo = [];

                // Recorrer y filtrar
                dispositivos.forEach(function(dispositivo) {
                    const tipo = dispositivo.kind;
                    if (tipo === "videoinput") {
                        dispositivosDeVideo.push(dispositivo);
                    }
                });

                // Vemos si encontramos algún dispositivo, y en caso de que si, entonces llamamos a la función
                // y le pasamos el id de dispositivo
                if (dispositivosDeVideo.length > 0) {
                    // Mostrar stream con el ID del primer dispositivo, luego el usuario puede cambiar
                    mostrarStream(dispositivosDeVideo[0].deviceId);
                }
            });



        const mostrarStream = idDeDispositivo => {
            _getUserMedia({
                    video: {
                        // Justo aquí indicamos cuál dispositivo usar
                        deviceId: idDeDispositivo,
                    }
                },
                function(streamObtenido) {
                    // Aquí ya tenemos permisos, ahora sí llenamos el select,
                    // pues si no, no nos daría el nombre de los dispositivos
                    llenarSelectConDispositivosDisponibles();

                    // Escuchar cuando seleccionen otra opción y entonces llamar a esta función
                    $listaDeDispositivos.onchange = () => {
                        // Detener el stream
                        if (stream) {
                            stream.getTracks().forEach(function(track) {
                                track.stop();
                            });
                        }
                        // Mostrar el nuevo stream con el dispositivo seleccionado
                        mostrarStream($listaDeDispositivos.value);
                    }

                    // Simple asignación
                    stream = streamObtenido;

                    // Mandamos el stream de la cámara al elemento de vídeo
                    $video.srcObject = stream;
                    $video.play();

                    //Escuchar el click del botón para tomar la foto
                    $boton.addEventListener("click", function() {

                        //Pausar reproducción
                        $video.pause();

                        //Obtener contexto del canvas y dibujar sobre él
                        let contexto = $canvas.getContext("2d");
                        $canvas.width = $video.videoWidth;
                        $canvas.height = $video.videoHeight;
                        contexto.drawImage($video, 0, 0, $canvas.width, $canvas.height);

                        let foto = $canvas.toDataURL();
                        console.log(document.getElementById('documento'));
                        //Reanudar reproducción
                        $video.play();
                    });
                },
                function(error) {
                    console.log("Permiso denegado o error: ", error);
                    $estado.innerHTML = "No se puede acceder a la cámara, o no diste permiso.";
                });
        }
    })();
</script>