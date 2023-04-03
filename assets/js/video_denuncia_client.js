import { VideoServiceGuest } from "../guest/guest.js";

const apiKey = "vspk_6258d819-105e-4487-b7f1-be72e892850e";
const guestUUID = document.getElementById("input_uuid").value;
let folio_completo = document.getElementById("input_folio").value;
const array = folio_completo.split("-");
let folio_SY = array[1];
let year_SF = array[0];
const delito = document.getElementById("input_delito").value;
const descripcion = document.getElementById("input_descripcion").value;
const texto_inicial = document.querySelector("#pantalla_inicial");
// const aceptar_llamada = document.querySelector("#aceptar");
const priority = document.querySelector("#input_priority").value;
let video_container = document.querySelector("#video_container");
const pantalla_final = document.querySelector("#pantalla_final");
// const recording = document.querySelector('#recording');
// const recording_stop = document.querySelector('#recording_stop');
// const video = document.querySelector('#togogle-video');
// const audio = document.querySelector('#toogle-audio');
// const audio_denunciante_prendido = document.querySelector('#audio_denunciante_prendido');
// const audio_denunciante_apagado = document.querySelector('#audio_denunciante_apagado');
// const camara_apagada_denunciante = document.querySelector('#camara_apagada_denunciante');
// const camara_prendida_denunciante = document.querySelector('#camara_prendida_denunciante');
// const denunciante_name = document.querySelector('#secondary_video_name');
const agente_name = document.querySelector("#main_video_details_name");
// const audio_denunciante_prendido_b = document.querySelector('#audio_denunciante_prendido_b');
// const audio_denunciante_apagado_b = document.querySelector('#audio_denunciante_apagado_b');
// const camara_apagada_denunciante_b = document.querySelector('#camara_apagada_denunciante_b');
// const camara_prendida_denunciante_b = document.querySelector('#camara_prendida_denunciante_b');
const apiURI = "https://videodenunciabalancer.fgebc.gob.mx";

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
		document.querySelector("#documentos_anexar_card").style.display = "none"
		video_container.style.display = "block";
		agente_name.innerHTML = "LIC. " + response.agent.name;
		// denunciante_name.innerHTML = guestData.name;
	}
);

guestVideoService.registerOnDisconnect(() => {
	pantalla_final.style.display = "block";
	video_container.style.display = "none";
	let url = document.querySelector("#input_base_url_endcall").value;
	window.location.href = url;
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
	// if (isRecording == true) {
	// 	recording.style.display = "block";
	// 	recording_stop.style.display = "none";

	// } else {
	// 	recording.style.display = "none";
	// 	recording_stop.style.display = "block";
	// }
});

$(function () {
	$("#geolocalizacion_modal").modal("show");
});

guestVideoService.saveGeolocation(() => {
	texto_inicial.style.display = "block";
	document.querySelector("#documentos_anexar_card").style.display = "block";
	$("#geolocalizacion_modal").modal("hide");
	guestVideoService.connectGuest(
		{ delito, folio: folio_SY + "/" + year_SF, descripcion },
		guest => {
			console.log(guest);
		}
	);
});
