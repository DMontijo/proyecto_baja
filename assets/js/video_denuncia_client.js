import { VideoServiceGuest } from "../guest/guest.js";

const apiKey = "vspk_6258d819-105e-4487-b7f1-be72e892850e";
const guestUUID = document.getElementById("input_uuid").value;
const folio = document.getElementById("input_folio").value;
const texto_inicial = document.querySelector("#texto_inicial");
const aceptar_llamada = document.querySelector("#aceptar");
let video_d = document.querySelector("#video_d");
let video_m = document.querySelector("#video_m");
console.log(guestUUID);

// const apiURI = 'http://192.168.0.67:3000';
const apiURI = "http://54.85.151.185/";

const guestVideoService = new VideoServiceGuest(guestUUID, folio, {
	apiURI,
	apiKey
});

guestVideoService.connectGuest(() => {
	texto_inicial.style.display = "block";


	guestVideoService.registerOnVideoReady("video_d", "video_m", () => {
		texto_inicial.style.display = "none";
		video_d.style.display = "block";
		video_m.style.display = "block";
	});
});
