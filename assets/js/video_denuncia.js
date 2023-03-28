import { VideoServiceAgent } from "../agent/agent.js";
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
const botones = document.querySelector("#tools-agent");
// const apiURI = "http://54.208.205.251";
const apiURI = "https://cc3d-2806-2f0-51e0-a3f5-8492-7afd-d723-78c2.ngrok.io";

const agentVideoService = new VideoServiceAgent(agentUUID, { apiURI, apiKey });

disponible_connect.addEventListener("click", () => {
	agentVideoService.connetAgent(
		() => {
			disponible_connect.hidden = true;
			no_disponible_connect.hidden = false;
			console.log("connected");
			agentVideoService.registerOnGuestConnected(response => {
				$("#llamadaModal").modal("show");
				guestUUID = response.guest.uuid;
				// console.log(guestUUID);
				console.log(response);
				// console.log(response.guest.details.DELITO);

				document.querySelector("#nombre_denunciante").value =
					response.guest.name;
				document.querySelector("#genero_denunciante").value =
					response.guest.gender;
				document.querySelector("#correo_deunciante").value =
					response.guest.details.CORREO;

				document.querySelector("#delito_denunciante_llamada").value =
					response.guest.details.DELITO;
				document.querySelector("#folio_llamada").value =
					response.guest.details.FOLIO;
				document.querySelector("#idioma_denunciante").value = response
					.guest.languages[0]
					? response.guest.languages[0].title
					: "-";
			});
		},
		response => {
			Swal.fire({
				icon: 'error',
				text: response.message,
				confirmButtonColor: '#bf9b55',
			});
		}
	);
});

aceptar_llamada.addEventListener("click", () => {
	console.log("aceptada click");

	agentVideoService.acceptCall("agn_vf", "usr_vd", () => {
		$("#llamadaModal").modal("hide");
		botones.hidden = false;
		document.querySelector("#nombre_agente").innerHTML="prueb";
		document.querySelector("#nombre_denunciante").innerHTML="prueb";

		console.log("aceptada");
	});
});

startRecord.addEventListener("click", () => {
	console.log("pre grabación");

	agentVideoService.startRecording(() => {
		marksRecording.disabled = false;
		document.getElementById("grabacion").style.display = "block";
		startRecord.style.backgroundColor = "#092B47";
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
		console.log(result);
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
	agentVideoService.endVideoCall(() => {
		disponible_connect.hidden = false;
		no_disponible_connect.hidden = true;
		botones.hidden = true;
	});
});

rechazar_llamada.addEventListener("click", () => {
	agentVideoService.refuseCall(() => {
		console.log("refuse call");
	});
});
