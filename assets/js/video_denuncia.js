import { VideoServiceAgent } from "../agent/agent.js";
const apiKey = document.getElementById("input_api").value;
const agentUUID = document.getElementById("input_uuid").value;
// const apiURI = "https://videodenunciabalancer.fgebc.gob.mx";
const apiURI = "https://ef88-2806-2f0-51e0-a3f5-d1cf-8a97-8917-a925.ngrok.io";

const disponible_connect = document.querySelector("#disponible");
const no_disponible_connect = document.querySelector("#no_disponible");

const aceptar_llamada = document.querySelector("#aceptar");
const rechazar_llamada = document.querySelector("#rechazar");

const video_container = document.getElementById("video_container");

const startRecord = document.querySelector("#start-recording");
const stopRecord = document.querySelector("#stop-recording");

//VIDEO Y AUDIO AGENTE
const video_agente_on = document.querySelector("#on-video-agent");
const video_agente_off = document.querySelector("#off-video-agent");

const audio_agente_on = document.querySelector("#on-audio-agent");
const audio_agente_off = document.querySelector("#off-audio-agent");

//VIDEO Y AUDIO DENUNCIANTE
const video_denunciante_on = document.querySelector("#on-video-denunciante");
const video_denunciante_off = document.querySelector("#off-video-denunciante");

const audio_denunciante_on = document.querySelector("#on-audio-denunciante");
const audio_denunciante_off = document.querySelector("#off-audio-denunciante");

const marksRecording = document.querySelector("#marks-recording-modal");
const enviar_marca = document.querySelector("#enviar_marca");
const desconectar_llamada = document.querySelector("#disconnect-call");
const denunciante_nombre_llamada = document.querySelector("#denunciante_nombre_llamada");
const folio_llamada = document.querySelector("#folio_llamada_v");
const header_llamda = document.querySelector("#header-llamada");

let selectMarks = document.querySelector("#selectMarks");
let coment_marks = document.querySelector("#comentario_marca");
let guestUUID = "";
var totalSeconds = 0;
var myInterval;

const agentVideoService = new VideoServiceAgent(agentUUID, { apiURI, apiKey });

disponible_connect.addEventListener("click", () => {
	console.log("disponible_connect");
	agentVideoService.connetAgent(
		() => {
			console.log("Se conecto el agente");
			clearVideoCall();
			disponible_connect.hidden = true;
			no_disponible_connect.hidden = false;

			agentVideoService.registerOnGuestConnected(response => {
				try {
					deleteVideoElement();
				} catch (error) { }
				clearVideoCall();

				guestUUID = response.guest.uuid;
				console.log("Respuesta: ", response);
				document.querySelector("#nombre_denunciante").value = response.guest.name;
				document.querySelector("#main_video_details_name").value = response.guest.name;
				document.querySelector("#genero_denunciante").value = response.guest.gender == "FEMALE" ? "FEMENINO" : "MASCULINO";
				document.querySelector("#correo_deunciante").value = response.guest.details.CORREO;
				document.querySelector("#delito_denunciante_llamada").value = response.details != null ? response.details.delito : "-";
				document.querySelector("#descripcion_denunciante_llamada").innerHTML = response.details != null ? response.details.descripcion : "-";
				document.querySelector("#folio_llamada").value = response.details != null ? response.details.folio : "-";
				document.querySelector("#idioma_denunciante").value = response.guest.languages ? response.guest.languages[0].title : "-";
				$("#llamadaModal").modal("show");
				disponible_connect.hidden = true;
				no_disponible_connect.hidden = false;
			});
		},
		response => {
			disponible_connect.hidden = false;
			no_disponible_connect.hidden = true;
			Swal.fire({
				icon: "error",
				text: response.message,
				confirmButtonColor: "#bf9b55"
			});
		}
	);
});

no_disponible_connect.addEventListener("click", () => {
	console.log("NO DISPONIBLE");
	agentVideoService.disconnectAgent(() => {
		clearVideoCall();
	});
});

aceptar_llamada.addEventListener("click", () => {
	console.log("Clic en aceptar llamada");

	agentVideoService.acceptCall("agn_vf", "main_video",
		(response, agent, { guest, guestConnection }) => {
			clearVideoCall();
			video_container.style.display = "block";
			document.querySelector("#secondary_video_details_name").innerHTML = `${agent.names} ${agent.lastnames}`;
			document.querySelector("#main_video_details_name").innerHTML = guest.name;
			folio_llamada.innerHTML = guestConnection.folio;
			denunciante_nombre_llamada.innerHTML = guest.name;
			disponible_connect.hidden = true;
			no_disponible_connect.hidden = true;
			header_llamda.hidden = false;
			$("#llamadaModal").modal("hide");

			agentVideoService.registerOnGuestDisconnected(() => {
				console.log("Guest disconnected");
			})
		}
	);
});

video_agente_on.addEventListener("click", e => {
	agentVideoService.toggleVideo(isEnabled => {
		toogleVideoAgent(isEnabled);
	});
});

video_agente_off.addEventListener("click", e => {
	agentVideoService.toggleVideo(isEnabled => {
		toogleVideoAgent(isEnabled);
	});
});

audio_agente_on.addEventListener("click", () => {
	agentVideoService.toggleAudio(isEnable => {
		toogleAudioAgent(isEnable);
	});
});

audio_agente_off.addEventListener("click", () => {
	agentVideoService.toggleAudio(isEnable => {
		toogleAudioAgent(isEnable);
	});
});

video_denunciante_on.addEventListener("click", e => {
	agentVideoService.toggleRemoteVideo(isEnabled => {
		toogleVideoDenunciante(isEnabled);
	});
});

video_denunciante_off.addEventListener("click", e => {
	agentVideoService.toggleRemoteVideo(isEnabled => {
		toogleVideoDenunciante(isEnabled);
	});
});

audio_denunciante_on.addEventListener("click", () => {
	agentVideoService.toggleRemoteAudio(isEnable => {
		toogleAudioDenunciante(isEnable);
	});
});

audio_denunciante_off.addEventListener("click", () => {
	agentVideoService.toggleRemoteAudio(isEnable => {
		toogleAudioDenunciante(isEnable);
	});
});

desconectar_llamada.addEventListener("click", () => {
	console.log("Clic en colgar llamada");
	agentVideoService.endVideoCall(() => {
		console.log("Llamada colgada");
		agentVideoService.disconnectAgent(() => {
			clearVideoCall();
		});
	});
});

rechazar_llamada.addEventListener("click", () => {
	console.log("Clic en rechazar llamada");

	agentVideoService.transferCall((resp) => {
		console.log("Respues de rechazar", resp);
		$("#llamadaModal").modal("hide");
		agentVideoService.disconnectAgent(() => {
			clearVideoCall();
		});
	});
});

startRecord.addEventListener("click", () => {
	agentVideoService.startRecording(() => {
		marksRecording.disabled = false;
		document.getElementById("grabacion").style.display = "block";
		document.getElementById("grabacion_stop").style.display = "none";
		startRecord.style.display = "none";
		stopRecord.style.display = "block";
	});
});

stopRecord.addEventListener("click", () => {
	agentVideoService.stopRecording(() => {
		marksRecording.disabled = true;
		document.getElementById("grabacion").style.display = "none";
		document.getElementById("grabacion_stop").style.display = "block";
		startRecord.style.display = "block";
		stopRecord.style.display = "none";

		setTimeout(function () {
			document.getElementById("grabacion_stop").style.display = "none";
		}, 3000);
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
	// console.log(agentVideoService.marksRecording());
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

// function pad(val) {
// 	var valString = val + "";
// 	if (valString.length < 2) {
// 		return "0" + valString;
// 	} else {
// 		return valString;
// 	}
// }

// function setTime() {
// 	++totalSeconds;
// 	secondsLabel.innerHTML = pad(totalSeconds % 60);
// 	minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
// 	hoursLabel.innerHTML = pad(parseInt(totalSeconds / 3600));
// }

function deleteVideoElement() {
	const videos_array = document.querySelectorAll("video");

	videos_array.forEach(element => {
		element.remove();
	});
}

function toogleVideoAgent(isEnabled) {
	if (isEnabled == true) {
		document.getElementById("camara_agente_prendida").style.display = "block";
		document.getElementById("camara_agente_apagada").style.display = "none";
		video_agente_on.style.display = "block";
		video_agente_off.style.display = "none";
	} else {
		document.getElementById("camara_agente_prendida").style.display = "none";
		document.getElementById("camara_agente_apagada").style.display = "block";
		video_agente_on.style.display = "none";
		video_agente_off.style.display = "block";
	}
}

function toogleAudioAgent(isEnable) {
	if (isEnable == true) {
		document.getElementById("audio_agente_prendida").style.display = "block";
		document.getElementById("audio_agente_apagada").style.display = "none";
		audio_agente_on.style.display = "block";
		audio_agente_off.style.display = "none";
	} else {
		document.getElementById("audio_agente_prendida").style.display = "none";
		document.getElementById("audio_agente_apagada").style.display = "block";
		audio_agente_on.style.display = "none";
		audio_agente_off.style.display = "block";
	}
}

function toogleVideoDenunciante(isEnabled) {
	console.log('Dentro de toogle video denunciante', isEnable);
	if (isEnabled == true) {
		document.getElementById("camara_prendida_denunciante").style.display = "block";
		document.getElementById("camara_apagada_denunciante").style.display = "none";
		video_denunciante_on.style.display = "block";
		video_denunciante_off.style.display = "none";
	} else {
		document.getElementById("camara_prendida_denunciante").style.display = "none";
		document.getElementById("camara_apagada_denunciante").style.display = "block";
		video_denunciante_on.style.display = "none";
		video_denunciante_off.style.display = "block";
	}
}

function toogleAudioDenunciante(isEnable) {
	console.log('Dentro de toogle audio denunciante', isEnable);
	if (isEnable == true) {
		document.getElementById("audio_prendido_denunciante").style.display = "block";
		document.getElementById("audio_apagado_denunciante").style.display = "none";
		audio_denunciante_on.style.display = "block";
		audio_denunciante_off.style.display = "none";
	} else {
		document.getElementById("audio_prendido_denunciante").style.display = "none";
		document.getElementById("audio_apagado_denunciante").style.display = "block";
		audio_denunciante_on.style.display = "none";
		audio_denunciante_off.style.display = "block";
	}
}

function clearVideoCall() {
	video_container.style.display = "none";
	clearToolsBar();
	document.querySelector("#nombre_denunciante").value = '';
	document.querySelector("#main_video_details_name").innerHTML = '';
	document.querySelector("#secondary_video_details_name").innerHTML = "";
	document.querySelector("#genero_denunciante").value = '';
	document.querySelector("#correo_deunciante").value = '';
	document.querySelector("#delito_denunciante_llamada").value = '';
	document.querySelector("#descripcion_denunciante_llamada").innerHTML = '';
	document.querySelector("#folio_llamada").value = '';
	document.querySelector("#idioma_denunciante").value = '';
	folio_llamada.innerHTML = "";
	denunciante_nombre_llamada.innerHTML = "";
	disponible_connect.hidden = false;
	no_disponible_connect.hidden = true;
	header_llamda.hidden = true;
	$("#llamadaModal").modal("hide");
}

function clearToolsBar() {
	document.getElementById("audio_agente_prendida").style.display = "block";
	document.getElementById("audio_agente_apagada").style.display = "none";
	document.getElementById("camara_agente_prendida").style.display = "block";
	document.getElementById("camara_agente_apagada").style.display = "none";
	video_agente_on.style.display = "block";
	video_agente_off.style.display = "none";
	audio_agente_on.style.display = "block";
	audio_agente_off.style.display = "none";

	document.getElementById("audio_prendido_denunciante").style.display = "block";
	document.getElementById("audio_apagado_denunciante").style.display = "none";
	document.getElementById("camara_prendida_denunciante").style.display = "block";
	document.getElementById("camara_apagada_denunciante").style.display = "none";
	video_denunciante_on.style.display = "block";
	video_denunciante_off.style.display = "none";
	audio_denunciante_on.style.display = "block";
	audio_denunciante_off.style.display = "none";
}
