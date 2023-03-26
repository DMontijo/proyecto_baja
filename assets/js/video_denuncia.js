import { VideoServiceAgent } from "../agent/agent.js";
import { RoomsSockets } from "../agent/extras.js";


const apiKey = document.getElementById("input_api").value;

const agentUUID = document.getElementById("input_uuid").value;
const disponible_connect = document.querySelector("#disponible");
const no_disponible_connect = document.querySelector("#no_disponible");

const aceptar_llamada = document.querySelector("#aceptar");
const rechazar_llamada = document.querySelector("#rechazar");

let usr_vd = document.querySelector("#usr_vd");
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
const botones = document.querySelector('#tools-agent');
const apiURI = "http://54.208.205.251";

const agentVideoService = new VideoServiceAgent(agentUUID, { apiURI, apiKey });

disponible_connect.addEventListener("click", () => {
	console.log(startRecord);
	agentVideoService.connetAgent(() => {
		disponible_connect.hidden = true;
		no_disponible_connect.hidden = false;

		console.log("conectado");
		// disconnectBtn.hidden = false;
		// disconnectBtn.disabled = false;
		// label.textContent = `Agent connected`;
		// label.classList.toggle('warning', false);
		// label.classList.toggle('avalible', true);

		agentVideoService.registerOnGuestConnected(response => {
			$("#llamadaModal").modal("show");
			guestUUID = response.guest.uuid;
            console.log(response);
			console.log(response.guest.details.DELITO);

			document.querySelector("#nombre_denunciante").value =
				response.guest.name;
			document.querySelector("#genero_denunciante").value =
				response.guest.gender;
			document.querySelector("#correo_deunciante").value =
				response.guest.details.CORREO;
			document.querySelector("#idioma_denunciante").value =
				response.guest.languages[0].title;
			document.querySelector("#delito_denunciante").value =
				response.guest.details.DELITO;
                document.querySelector("#folio_llamada").value =
				response.guest.details.FOLIO;

			// incomeCallModal.show();
			// nameGuest.innerHTML = response.guest.name;
			// priorityGuest.innerHTML = 'Priority: ' + response.priority;
		});
	});
});

aceptar_llamada.addEventListener("click", () => {
	console.log("aceptada click");

	agentVideoService.acceptCall("agn_vf", "usr_vd", () => {
		$("#llamadaModal").modal("hide");
        botones.hidden = false;

		console.log("aceptada");
	});
});

startRecord.addEventListener("click", () => {
	console.log("pre grabación");

	agentVideoService.startRecording(() => {
		marksRecording.disabled = false;
		document.getElementById("grabacion").style.display = "block";
	});
});

stopRecord.addEventListener("click", () => {
	agentVideoService.stopRecording(() => {
		marksRecording.disabled = true;
		document.getElementById("grabacion").style.display = "none";
		document.getElementById("grabacion_stop").style.display = "block";

		setTimeout(function() {
			document.getElementById("grabacion_stop").style.display = "none";
		}, 5000);
	});
});

video_agente.addEventListener("click", () => {
	agentVideoService.toggleVideo(() => {});
});

audio_agente.addEventListener("click", () => {
	agentVideoService.toggleAudio(() => {});
});

video_denunciante.addEventListener("click", () => {
	agentVideoService.toggleRemoteVideo(() => {});
});

audio_denunciante.addEventListener("click", () => {
	agentVideoService.toggleRemoteAudio(() => {
		console.log("cambio de audio denunciante");
	});
});

marksRecording.addEventListener("click", () => {
	$("#marksModal").modal("show");
	agentVideoService.getMarkTypes().then(result => {
		result.forEach(marcas => {
			const option = document.createElement("option");
			option.value = marcas.id;
			option.text = marcas.typeTitle;
			selectMarks.add(option, null);
		});
	});
});
enviar_marca.addEventListener("click", () => {
	console.log(agentVideoService.marksRecording());

	agentVideoService.emitMarkTime(
		agentVideoService.marksRecording(),
		coment_marks.value,
		selectMarks.value,
		() => {
			selectMarks.value = "";
			coment_marks.value = "";
			$("#marksModal").modal("hide");
		}
	);
});

desconectar_llamada.addEventListener("click", () => {
	agentVideoService.disconnectAgent(() => {
		disponible_connect.hidden = false;
		no_disponible_connect.hidden = true;
	});
});

rechazar_llamada.addEventListener("click", () => {
	agentVideoService.refuseCall(() => {
		console.log("refuse call");
	});
});
