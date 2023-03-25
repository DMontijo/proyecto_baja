import { VideoServiceAgent } from '../agent/agent.js';

const apiKey = document.getElementById('input_api').value;
const agentUUID = document.getElementById('input_uuid').value;
const disponible_connect = document.querySelector('#disponible');
const aceptar_llamada = document.querySelector('#aceptar');
const rechazar_llamada = document.querySelector('#rechazar');

let usr_vd = document.querySelector('#usr_vd');
let agn_vf = document.querySelector('#agn_vf');
const startRecord = document.querySelector('#start-recording');
const stopRecord = document.querySelector('#stop-recording');

let guestUUID = '';

const apiURI = 'http://54.85.151.185/';

const agentVideoService = new VideoServiceAgent(agentUUID, { apiURI, apiKey });

disponible_connect.addEventListener('click', () => {
    agentVideoService.connetAgent(() => {
        disponible_connect.hidden = true;
        console.log("conectado");
        // disconnectBtn.hidden = false;
        // disconnectBtn.disabled = false;
        // label.textContent = `Agent connected`;
        // label.classList.toggle('warning', false);
        // label.classList.toggle('avalible', true);

        agentVideoService.registerOnGuestConnected((response) => {
            $('#llamadaModal').modal('show');
            guestUUID = response.guest.uuid;
            console.log(response.guest.details.DELITO);

            document.querySelector('#nombre_denunciante').value = response.guest.name;
            document.querySelector('#genero_denunciante').value = response.guest.gender;
            document.querySelector('#correo_deunciante').value = response.guest.details.CORREO;
            document.querySelector('#idioma_denunciante').value = response.guest.languages[0].title;
            document.querySelector('#delito_denunciante').value = response.guest.details.DELITO;

            // incomeCallModal.show();
            // nameGuest.innerHTML = response.guest.name;
            // priorityGuest.innerHTML = 'Priority: ' + response.priority;
        });
    });
})

aceptar_llamada.addEventListener('click', () => {
    console.log("aceptada click");

    agentVideoService.acceptCall('agn_vf', 'usr_vd',() => {
        $('#llamadaModal').modal('hide');
        console.log("aceptada");

    });
});

startRecord.addEventListener('click', () => {
    agentVideoService.startRecording(() => {
        console.log("iniciando grabación");
    });
});

startRecord.addEventListener('click', () => {
    agentVideoService.stopRecording(() => {
        console.log("Deteniendo grabación");
    });
});