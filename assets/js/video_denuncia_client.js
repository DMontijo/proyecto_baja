import { VideoServiceGuest } from "../guest/guest.js";

const apiKey = "vspk_6258d819-105e-4487-b7f1-be72e892850e";
const guestUUID = document.getElementById("input_uuid").value;
const folio = document.getElementById("input_folio").value;
const texto_inicial = document.querySelector("#pantalla_inicial");
const aceptar_llamada = document.querySelector("#aceptar");
const priority = document.querySelector("#input_priority").value;
let video_container = document.querySelector("#video_container");
let video_m = document.querySelector("#video_m");
const pantalla_final = document.querySelector('#pantalla_final');
const recording = document.querySelector('#recording');
const recording_stop = document.querySelector('#recording_stop');
const video = document.querySelector('#togogle-video');
const audio = document.querySelector('#toogle-audio');
const audio_denunciante_prendido = document.querySelector('#audio_denunciante_prendido');
const audio_denunciante_apagado = document.querySelector('#audio_denunciante_apagado');
const camara_apagada_denunciante = document.querySelector('#camara_apagada_denunciante');
const camara_prendida_denunciante = document.querySelector('#camara_prendida_denunciante');
const denunciante_name =document.querySelector('#main_video_details_name');
const agente_name = document.querySelector('#secondary_video_details_name')
const audio_denunciante_prendido_b = document.querySelector('#audio_denunciante_prendido_b');
const audio_denunciante_apagado_b = document.querySelector('#audio_denunciante_apagado_b');
const camara_apagada_denunciante_b = document.querySelector('#camara_apagada_denunciante_b');
const camara_prendida_denunciante_b = document.querySelector('#camara_prendida_denunciante_b');
// const apiURI = 'http://192.168.0.67:3000';
// const apiURI = "http://54.208.205.251";
const apiURI ="https://3455-2806-2f0-51e0-a3f5-6791-6b4d-9cba-8698.ngrok.io";

const guestVideoService = new VideoServiceGuest(guestUUID, folio, priority, {
	apiURI,
	apiKey
});

guestVideoService.registerOnVideoReady("main_video", "secondary_video", (response, guestData) => {

	texto_inicial.style.display = "none";
	video_container.style.display = "block";
	agente_name.innerHTML= response.agent.name;
	denunciante_name.innerHTML= guestData.name;
});

guestVideoService.registerOnDisconnect(() => {
	pantalla_final.style.display= "block";
	video_container.style.display ="none"
})

guestVideoService.registerMediaRemoteToggling((response) => {
	if (response.hasOwnProperty('toogleVideoGuest')) {
		// Verify if response.toogleVideoGuest is true/false

		if (response.toogleVideoGuest == true) {
			camara_prendida_denunciante.style.display = "block"
			camara_apagada_denunciante.style.display="none"
			camara_prendida_denunciante_b.style.display = "block"
			camara_apagada_denunciante_b.style.display="none"
		}else{
			camara_prendida_denunciante.style.display = "none"
			camara_apagada_denunciante.style.display="block"
			camara_prendida_denunciante_b.style.display = "none"
			camara_apagada_denunciante_b.style.display="block"
		}

	} else if (response.hasOwnProperty('toogleAudioGuest')) {
		// Verify if response.toogleAudioGuest is true/false
		if (response.toogleAudioGuest == true) {
			audio_denunciante_prendido.style.display = "block"
			audio_denunciante_apagado.style.display="none"
			audio_denunciante_prendido_b.style.display = "block"
			audio_denunciante_apagado_b.style.display="none"
		}else{
			audio_denunciante_prendido.style.display = "none"
			audio_denunciante_apagado.style.display="block"
			audio_denunciante_prendido_b.style.display = "none"
			audio_denunciante_apagado_b.style.display="block"
		}
	}
});

guestVideoService.registerVideoRecordingStatus((isRecording) => {
	console.log('isRecording', isRecording);
	if(isRecording== true){
		recording.style.display="block";
		recording_stop.style.display="none";

	}else{
		recording.style.display="none";
		recording_stop.style.display="block";

	}
})

$(function() {
	$("#geolocalizacion_modal").modal("show");
});
guestVideoService.saveGeolocation(() => {
	texto_inicial.style.display = "block";
	$("#geolocalizacion_modal").modal("hide");
	guestVideoService.connectGuest((guest) => {

	});
});
