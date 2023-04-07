import { VideoServiceGuest } from "../guest/guest.js";
import { variables } from "./variables.js";

const { apiKey, apiURI } = variables;
const guestUUID = document.getElementById("input_uuid").value;

const delito = document.getElementById("input_delito").value;
const descripcion = document.getElementById("input_descripcion").value;
const texto_inicial = document.querySelector("#pantalla_inicial");
const priority = document.querySelector("#input_priority").value;
const video_container = document.querySelector("#video_container");
const pantalla_final = document.querySelector("#pantalla_final");
const agente_name = document.querySelector("#main_video_details_name");

let folio_completo = document.getElementById("input_folio").value;
let array = folio_completo.split("-");
let folio_SY = array[1];
let year_SF = array[0];

// const recording = document.querySelector('#recording');
// const recording_stop = document.querySelector('#recording_stop');
// const video = document.querySelector('#togogle-video');
// const audio = document.querySelector('#toogle-audio');
// const audio_denunciante_prendido = document.querySelector('#audio_denunciante_prendido');
// const audio_denunciante_apagado = document.querySelector('#audio_denunciante_apagado');
// const camara_apagada_denunciante = document.querySelector('#camara_apagada_denunciante');
// const camara_prendida_denunciante = document.querySelector('#camara_prendida_denunciante');
// const denunciante_name = document.querySelector('#secondary_video_name');
// const audio_denunciante_prendido_b = document.querySelector('#audio_denunciante_prendido_b');
// const audio_denunciante_apagado_b = document.querySelector('#audio_denunciante_apagado_b');
// const camara_apagada_denunciante_b = document.querySelector('#camara_apagada_denunciante_b');
// const camara_prendida_denunciante_b = document.querySelector('#camara_prendida_denunciante_b');

const guestVideoService = new VideoServiceGuest(
	guestUUID,
	folio_SY + "/" + year_SF,
	priority,
	{
		apiURI,
		apiKey
	}
);

guestVideoService.registerOnVideoReady(
	"secondary_video",
	"main_video",
	(response, guestData) => {
		texto_inicial.style.display = "none";
		video_container.style.display = "block";
		document.querySelector("#documentos_anexar_card").style.display =
			"block";
		agente_name.innerHTML = "LIC. " + response.agent.name;
		// denunciante_name.innerHTML = guestData.name;
	}
);

guestVideoService.registerOnDisconnect(e => {
	console.log("Desconectado", e);
	pantalla_final.style.display = "block";
	video_container.style.display = "none";
	document.querySelector("#documentos_anexar_card").style.display = "none";
	setTimeout(() => {
		deleteVideoElement();
	}, 2000);
});

guestVideoService.registerMediaRemoteToggling(response => {
	// if (response.hasOwnProperty('toogleVideoGuest')) {
	// 	// Verify if response.toogleVideoGuest is true/false
	// 	if (response.toogleVideoGuest == true) {
	// 		camara_prendida_denunciante.style.display = "block"
	// 		camara_apagada_denunciante.style.display = "none"
	// 		camara_prendida_denunciante_b.style.display = "block"
	// 		camara_apagada_denunciante_b.style.display = "none"
	// 	} else {
	// 		camara_prendida_denunciante.style.display = "none"
	// 		camara_apagada_denunciante.style.display = "block"
	// 		camara_prendida_denunciante_b.style.display = "none"
	// 		camara_apagada_denunciante_b.style.display = "block"
	// 	}
	// } else if (response.hasOwnProperty('toogleAudioGuest')) {
	// 	// Verify if response.toogleAudioGuest is true/false
	// 	if (response.toogleAudioGuest == true) {
	// 		audio_denunciante_prendido.style.display = "block"
	// 		audio_denunciante_apagado.style.display = "none"
	// 		audio_denunciante_prendido_b.style.display = "block"
	// 		audio_denunciante_apagado_b.style.display = "none"
	// 	} else {
	// 		audio_denunciante_prendido.style.display = "none"
	// 		audio_denunciante_apagado.style.display = "block"
	// 		audio_denunciante_prendido_b.style.display = "none"
	// 		audio_denunciante_apagado_b.style.display = "block"
	// 	}
	// }
});

guestVideoService.registerVideoRecordingStatus(isRecording => {
	console.log("isRecording", isRecording);
	if (isRecording) {
		Swal.fire({
			title: "Se inicio la grabación.",
			position: 'top-end',
			showConfirmButton: false,
			timer: 1500
		});
	} else {
		Swal.fire({
			position: 'top-end',
			title: "Se detuvo la grabación.",
			showConfirmButton: false,
			timer: 1500
		});
	}
});

guestVideoService.saveGeolocation(() => {
	console.log("Conectando denunciante...");
	texto_inicial.style.display = "block";
	guestVideoService.connectGuest(
		{ delito, folio: folio_SY + "/" + year_SF, descripcion },
		guest => {
			console.log("Denuciante conectado");
			console.log(guest);
		},
		error => {
			Swal.fire({
				icon: "error",
				title: "Hubo un error, se recargará la página",
				showConfirmButton: false,
				timer: 1000
			}).then(result => {
				location.reload;
			});
		}
	);
});

function deleteVideoElement() {
	const videos_array = document.querySelectorAll("video");

	videos_array.forEach(element => {
		element.remove();
	});
}
