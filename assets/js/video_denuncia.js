import { VideoServiceAgent } from "../agent/agent.js";
const apiKey = document.getElementById("input_api").value;

const agentUUID = document.getElementById("input_uuid").value;
const disponible_connect = document.querySelector("#disponible");
const no_disponible_connect = document.querySelector("#no_disponible");

const aceptar_llamada = document.querySelector("#aceptar");
const rechazar_llamada = document.querySelector("#rechazar");

let main_video = document.querySelector("#main_video");
let agn_vf = document.querySelector("#agn_vf");
const startRecord = document.querySelector("#start-recording");
const stopRecord = document.querySelector("#stop-recording");
const video_agente = document.querySelector("#toogle-video-agent");
const audio_agente = document.querySelector("#toogle-audio-agent");
const video_denunciante = document.querySelector("#toogle-video-victim");
const audio_denunciante = document.querySelector("#toogle-audio-victim");
const marksRecording = document.querySelector("#marks-recording-modal");
let selectMarks = document.querySelector("#selectMarks");
let coment_marks = document.querySelector("#comentario_marca");
const enviar_marca = document.querySelector("#enviar_marca");
const desconectar_llamada = document.querySelector("#disconnect-call");
let guestUUID = "";
const denunciante_nombre_llamada = document.querySelector('#denunciante_nombre_llamada')
const botones = document.querySelector("#tools");
// const apiURI = "http://54.208.205.251";
const apiURI = "https://videodenunciabalancer.fgebc.gob.mx";
var totalSeconds = 0;
var myInterval;
const folio_llamada = document.querySelector('#folio_llamada_v');
const header_llamda = document.querySelector('#header-llamada');
const agentVideoService = new VideoServiceAgent(agentUUID, { apiURI, apiKey });

disponible_connect.addEventListener("click", () => {
	console.log("disponible_connect");
	agentVideoService.connetAgent(
		() => {
			disponible_connect.hidden = true;
			no_disponible_connect.hidden = false;
			console.log("connected");
			agentVideoService.registerOnGuestConnected(response => {
				$("#llamadaModal").modal("show");
				guestUUID = response.guest.uuid;
				// console.log(guestUUID);
				console.log("respuesta");
				console.log(response);
				// console.log(response.guest.details.DELITO);
				document.querySelector('#nombre_denunciante').value = response.guest.name;
				document.querySelector("#main_video_details_name").value =
					response.guest.name;
				document.querySelector("#genero_denunciante").value =
					response.guest.gender == 'FEMALE' ? 'FEMENINO': 'MASCULINO';
				document.querySelector("#correo_deunciante").value =
					response.guest.details.CORREO;
				document.querySelector("#delito_denunciante_llamada").value =
					response.details.delito;
				document.querySelector("#folio_llamada").value =
					response.details.folio;
				document.querySelector("#idioma_denunciante").value = response
					.guest.languages
					? response.guest.languages[0].title
					: "-";
			});
		},
		response => {
			Swal.fire({
				icon: "error",
				text: response.message,
				confirmButtonColor: "#bf9b55"
			});
		}
	);
});
no_disponible_connect.addEventListener("click",()=>{
	console.log("NO DISPONIBLE");
	agentVideoService.disconnectAgent(
		() => {
			console.log("ya no estas disponible");
		});
})
aceptar_llamada.addEventListener("click", () => {
	console.log("aceptada click");

	agentVideoService.acceptCall("agn_vf", "main_video", (response, agent, { guest, guestConnection}) => {
		$("#llamadaModal").modal("hide");
		document.querySelector("#secondary_video_details_name").innerHTML = `${agent.names} ${agent.lastnames}`;
		document.querySelector("#main_video_details_name").innerHTML = guest.name;
		folio_llamada.innerHTML = guestConnection.folio;
		botones.hidden = false;
		header_llamda.hidden= false;
		denunciante_nombre_llamada.innerHTML = guest.name;
		console.log("aceptada");
	});
});

startRecord.addEventListener("click", () => {

	agentVideoService.startRecording(() => {
		// marksRecording.disabled = false;
	
		// myInterval = setInterval(setTime, 1000);

		document.getElementById("grabacion").innerHTML = "REC: " ;

		document.getElementById("grabacion").style.display = "block";
		startRecord.style.backgroundColor = "#092B47";
	});
});

stopRecord.addEventListener("click", () => {

	agentVideoService.stopRecording(() => {
		// marksRecording.disabled = true;
		document.getElementById("grabacion").style.display = "none";
		document.getElementById("grabacion_stop").style.display = "block";
		startRecord.style.backgroundColor = "#00000";

		setTimeout(function () {
			document.getElementById("grabacion_stop").style.display = "none";
		}, 5000);
	});
});

video_agente.addEventListener("click", () => {
	console.log("video a click");

	agentVideoService.toggleVideo((isVideoEnabled) => { 
		if (isVideoEnabled == true) {
			document.getElementById('camara_agente_prendida').style.display="block";
			document.getElementById('camara_agente_apagada').style.display="none";
		}else{
			document.getElementById('camara_agente_prendida').style.display="none";
			document.getElementById('camara_agente_apagada').style.display="block";
		}
	});
});

audio_agente.addEventListener("click", () => {
	console.log("audio a click");

	agentVideoService.toggleAudio((isAudioEnable) => {
		if (isAudioEnable == true) {
			document.getElementById('audio_agente_prendida').style.display="block";
			document.getElementById('audio_agente_apagada').style.display="none";
		}else{
			document.getElementById('audio_agente_prendida').style.display="none";
			document.getElementById('audio_agente_apagada').style.display="block";
		}
	 });
});

video_denunciante.addEventListener("click", () => {
	console.log("video d click");

	agentVideoService.toggleRemoteVideo((guestVideo) => { 
		if (guestVideo==true) {
			document.getElementById('camara_prendida_denunciante').style.display="block";
			document.getElementById('camara_apagada_denunciante').style.display="none";
		}else{
			document.getElementById('camara_prendida_denunciante').style.display="none";
			document.getElementById('camara_apagada_denunciante').style.display="block";
		}
	});
});

audio_denunciante.addEventListener("click", () => {
	console.log("audio d click");

	agentVideoService.toggleRemoteAudio((guestAudio) => {
		console.log("cambio de audio denunciante");
		if (guestAudio==true) {
			document.getElementById('audio_prendido_denunciante').style.display="block";
			document.getElementById('audio_apagado_denunciante').style.display="none";
		}else{
			document.getElementById('audio_prendido_denunciante').style.display="none";
			document.getElementById('audio_apagado_denunciante').style.display="block";
		}
	});
});
desconectar_llamada.addEventListener("click", () => {
	console.log("click en finalizar");
	agentVideoService.endVideoCall(() => {
		disponible_connect.hidden = false;
		botones.hidden = true;
		header_llamda.hidden= false;


	});
});

rechazar_llamada.addEventListener("click", () => {
	console.log("cick en rechazar");
	agentVideoService.refuseCall(() => {
		console.log("refuse call");
	});
});

// function pad(val) {
// 	var valString = val + "";
// 	if (valString.length < 2) {
// 	  return "0" + valString;
// 	} else {
// 	  return valString;
// 	}
//   }
//   function setTime() {
// 	++totalSeconds;
// 	secondsLabel.innerHTML = pad(totalSeconds % 60);
// 	minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
// 	hoursLabel.innerHTML = pad(parseInt(totalSeconds/3600));
//   }
// marksRecording.addEventListener("click", () => {
// 	$("#marksModal").modal("show");
// 	agentVideoService.getMarkTypes().then(result => {
// 		console.log(result);
// 		result.forEach(marcas => {
// 			const option = document.createElement("option");
// 			option.value = marcas.id;
// 			option.text = marcas.typeTitle;
// 			selectMarks.add(option, null);
// 		});
// 	});
// });

// enviar_marca.addEventListener("click", () => {
// 	// console.log(agentVideoService.marksRecording());

// 	agentVideoService.emitMarkTime(
// 		agentVideoService.marksRecording(),
// 		coment_marks.value,
// 		selectMarks.value,
// 		() => {
// 			selectMarks.value = "";
// 			coment_marks.value = "";
// 			$("#marksModal").modal("hide");
// 		}
// 	);
// });
