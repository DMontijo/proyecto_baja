import { VideoServiceGuest } from "../guest/guest.js";

const apiKey = "vspk_6258d819-105e-4487-b7f1-be72e892850e";
const guestUUID = document.getElementById("input_uuid").value;
const folio = document.getElementById("input_folio").value;
const texto_inicial = document.querySelector("#texto_inicial");
const aceptar_llamada = document.querySelector("#aceptar");
const priority = document.querySelector("#input_priority").value;
let video_d = document.querySelector("#video_d");
let video_m = document.querySelector("#video_m");
// const apiURI = 'http://192.168.0.67:3000';
// const apiURI = "http://54.208.205.251";
const apiURI ="https://cad0-2806-2f0-51c0-606f-1a9b-d4c2-4265-827a.ngrok.io";
const guestVideoService = new VideoServiceGuest(guestUUID, folio, priority, {
	apiURI,
	apiKey
});

guestVideoService.registerOnVideoReady("video_d", "video_m", (response) => {
	console.log(response);
	texto_inicial.style.display = "none";
	video_d.style.display = "block";
	video_m.style.display = "block";
});

guestVideoService.registerOnDisconnect(() => {
	console.log("desconectado");
	video_d.style.display = "none";
	video_m.style.display = "none";
	texto_inicial.style.display = "block";
	texto_inicial.innerHTML= "ESTIMADO (A) USUARIO (A), ¡GRACIAS POR SELECCIONAR EL SERVICIO DE VIDEO DENUNCIA!"+
	"En la Fiscalía General del Estado de Baja California día a día trabajamos para garantizarte un fácil acceso a la justicia desde cualquier lugar del mundo. "
})

guestVideoService.connectGuest(() => {
	texto_inicial.style.display = "block";
});
