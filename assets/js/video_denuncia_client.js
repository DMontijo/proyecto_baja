import { VideoServiceGuest } from '../guest/guest.js';

const apiKey = 'vspk_988a387a-001c-4d80-a456-6debd55dba61';
const guestUUID = document.getElementById('input_uuid').value;
const folio = document.getElementById('input_folio').value;
const disponible_connect = document.querySelector('#disponible');
const aceptar_llamada = document.querySelector('#aceptar');
let usr_vd = document.querySelector('#usr_vd');
let agn_vf = document.querySelector('#agn_vf');
console.log(guestUUID);


// const apiURI = 'http://192.168.0.67:3000';
const apiURI = 'http://34.229.77.149';

const guestVideoService = new VideoServiceGuest(guestUUID, folio,{ apiURI, apiKey });

guestVideoService.connectGuest(() => {
    console.log(document.getElementById('video_m'));
    guestVideoService.registerOnVideoReady('video_d','video_m',() => {

        // incomeCallModal.show();
        // nameGuest.innerHTML = response.guest.name;
        // priorityGuest.innerHTML = 'Priority: ' + response.priority;
    });
});
    // guestVideoService.connectVideoCall(() => {
    //     guestVideoService.registerOnVideoReady((response) => {
    //       console.log(response);

    //         // incomeCallModal.show();
    //         // nameGuest.innerHTML = response.guest.name;
    //         // priorityGuest.innerHTML = 'Priority: ' + response.priority;
    //     });
    // });

// aceptar_llamada.addEventListener('click', () => {
//     guestVideoService.acceptCall('agn_vf', 'usr_vd',() => {
//         $('#llamadaModal').modal('hide');

//     });
// });