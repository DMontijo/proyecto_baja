import { VideoServiceAgent } from "../agent/agent.js";
import { variables } from "./variables.js";

const { apiKey, apiURI } = variables;

const agentUUID = document.getElementById("input_uuid").value;

const disponible_connect = document.querySelector("#disponible");
const no_disponible_connect = document.querySelector("#no_disponible");

const aceptar_llamada = document.querySelector("#aceptar");
const rechazar_llamada = document.querySelector("#rechazar");

const video_container = document.getElementById("video_container");

const startRecord = document.querySelector("#start-recording");
const stopRecord = document.querySelector("#stop-recording");

// VIDEO Y AUDIO DE AGENTE SELECTER
const mediaDevicesModal = document.getElementById("media_devices_modal");
const mediaConfiguration = document.getElementById("media_configuration");
const $listaDeDispositivosVideo = document.querySelector("#listaDeDispositivosVideo");
const $listaDeDispositivosAudio = document.querySelector("#listaDeDispositivosAudio");
const $video = document.querySelector("#video");
const acceptConfiguration = document.querySelector("#acceptConfiguration");

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

//RECARGAR PAGINA DE DENUNCIANTE
const recargar_denunciante_btn = document.querySelector("#recargar_denunciante_btn");

// const recargar_agente = document.querySelector("#recargar_agente");

const marksRecording = document.querySelector("#marks-recording-modal");
const enviar_marca = document.querySelector("#enviar_marca");
const desconectar_llamada = document.querySelector("#disconnect-call");
const denunciante_nombre_llamada = document.querySelector(
	"#denunciante_nombre_llamada"
);
const folio_llamada = document.querySelector("#folio_llamada_v");
const header_llamda = document.querySelector("#header-llamada");

let selectMarks = document.querySelector("#selectMarks");
let coment_marks = document.querySelector("#comentario_marca");
let guestUUID = "";
var totalSeconds = 0;
var myInterval;

var audioSelected;
var videoSelected;

mediaConfiguration.addEventListener("click", async () => {
	$(mediaDevicesModal).modal("show");
	initMediaDevices();
});

const agentVideoService = new VideoServiceAgent(agentUUID, { apiURI, apiKey });
recargar_denunciante_btn.addEventListener("click", () => {
	console.log("RECARGANDO DENUNCIANTE")
	agentVideoService.refreshGuestConnection(() => {
		Swal.fire({
			icon: "success",
			text: "La conexion de denunciante se recargara en 3 segundos",
			showConfirmButton: true,
			confirmButtonColor: "#bf9b55",
			timer: 3000,
			timerProgressBar: true,
		});
	});
});
// recargar_agente.addEventListener("click", () => {
// 	console.log("ENTRANDO A RECARGAR LLAMADA");
// 	agentVideoService.reloadAgentVideoCall((resp) => {
// 		console.log(resp);
// 	});
// });
disponible_connect.addEventListener("click", () => {
	console.log("Conectando agente...");
	disponible_connect.disabled = true;
	agentVideoService.connetAgent(
		() => {
			console.log("¡Agente conectado con éxito!");
			disponible_connect.disabled = false;
			clearVideoCall();
			disponible_connect.hidden = true;
			no_disponible_connect.hidden = false;

			agentVideoService.registerOnGuestConnected(response => {
				try {
					deleteVideoElement();
				} catch (error) {}
				clearVideoCall();

				guestUUID = response.guest.uuid;
				console.log("Respuesta: ", response);
				document.querySelector("#nombre_denunciante").value =
					response.guest.name;
				document.querySelector("#main_video_details_name").value =
					response.guest.name;
				document.querySelector("#genero_denunciante").value =
					response.guest.gender == "FEMALE"
						? "FEMENINO"
						: "MASCULINO";
				document.querySelector("#correo_deunciante").value =
					response.guest.details.CORREO;
				document.querySelector("#delito_denunciante_llamada").value =
					response.details != null ? response.details.delito : "-";
				document.querySelector(
					"#descripcion_denunciante_llamada"
				).innerHTML =
					response.details != null
						? response.details.descripcion
						: "-";
				document.querySelector("#folio_llamada").value =
					response.details != null ? response.details.folio : "-";
				document.querySelector("#idioma_denunciante").value = response
					.guest.languages
					? response.guest.languages[0].title
					: "-";
				$("#llamadaModal").modal("show");
				disponible_connect.hidden = true;
				no_disponible_connect.hidden = false;
			});

			agentVideoService.registerOnGuestDisconnected(() => {
				aceptar_llamada.disabled = false;
				$("#llamadaModal").modal("hide");
				console.log("Guest disconnected con modal");

				// setTimeout(() => {
				// 	console.log("Desconectando agente...");
				// 	agentVideoService.disconnectAgent(() => {
				// 		console.log("¡Agente desconectado con éxito!");
				// 		clearVideoCall();
				// 	});
				// }, 2000);

				Swal.fire({
					icon: "error",
					text: "El usuario se desconecto.",
					showConfirmButton: false,
					timer: 3000,
					timerProgressBar: true,
				});
			});
		},
		response => {
			disponible_connect.disabled = false;
			try {
				agentVideoService.endVideoCall(() => {
					console.log("¡Llamada finalizada con éxito!");
				});
			} catch (error) {}
			try {
				agentVideoService.disconnectAgent(() => {
					console.log("¡Agente desconectado con éxito!");
				});
			} catch (error) {}
			disponible_connect.hidden = false;
			no_disponible_connect.hidden = true;
			clearVideoCall();
			Swal.fire({
				icon: "error",
				text: response.message,
				showConfirmButton: false,
				timer: 3000,
				timerProgressBar: true,
			});
		}
	);
});

no_disponible_connect.addEventListener("click", () => {
	console.log("Desconectando agente...");
	agentVideoService.disconnectAgent(() => {
		console.log("¡Agente desconectado con éxito!");
		clearVideoCall();
	});
});

aceptar_llamada.addEventListener("click", () => {
	console.log("Aceptando llamada...");
	aceptar_llamada.disabled = true;
	agentVideoService.acceptCall(
		"agn_vf",
		"main_video",
		(response, agent, { guest, guestConnection }) => {
			console.log("¡Llamada aceptada con éxito!");
			clearVideoCall();
			video_container.style.display = "block";
			document.querySelector(
				"#secondary_video_details_name"
			).innerHTML = `${agent.names} ${agent.lastnames}`;
			document.querySelector("#main_video_details_name").innerHTML =
				guest.name;
			folio_llamada.innerHTML = guestConnection.folio;
			denunciante_nombre_llamada.innerHTML = guest.name;
			disponible_connect.hidden = true;
			no_disponible_connect.hidden = true;
			header_llamda.hidden = false;
			$("#llamadaModal").modal("hide");
			aceptar_llamada.disabled = false;
			if (document.getElementById("input_folio_atencion").value == "") {
				try {
					let split = guestConnection.folio.split("/");
					document.getElementById("input_folio_atencion").value =
						split[0];
				} catch (error) {}
			}

			agentVideoService.registerOnGuestDisconnected(() => {
				aceptar_llamada.disabled = false;
				console.log("Guest disconnected");
				Swal.fire({
					icon: "error",
					text: "El usuario se desconecto.",
					showConfirmButton: false,
					timer: 3000,
					timerProgressBar: true,
				});
			});
		}
	);
});

desconectar_llamada.addEventListener("click", () => {
	console.log("Finalizando llamada...");
	agentVideoService.endVideoCall(() => {
		console.log("¡Llamada finalizada con éxito!");
		clearVideoCall();
		setTimeout(() => {
			console.log("Desconectando agente...");
			agentVideoService.disconnectAgent(() => {
				console.log("¡Agente desconectado con éxito!");
				clearVideoCall();
			});
		}, 2000);
	});
});

rechazar_llamada.addEventListener("click", () => {
	console.log("Rechazando llamada...");
	agentVideoService.transferCall(resp => {
		console.log("¡Llamada rechazada con éxito.!");
		clearVideoCall();
		console.log("Desconectando agente...");
		agentVideoService.disconnectAgent(() => {
			console.log("¡Agente desconectado con éxito!");
			clearVideoCall();
		});
	});
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
	agentVideoService.toggleAudio(isEnabled => {
		toogleAudioAgent(isEnabled);
	});
});

audio_agente_off.addEventListener("click", () => {
	agentVideoService.toggleAudio(isEnabled => {
		toogleAudioAgent(isEnabled);
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
	agentVideoService.toggleRemoteAudio(isEnabled => {
		toogleAudioDenunciante(isEnabled);
	});
});

audio_denunciante_off.addEventListener("click", () => {
	agentVideoService.toggleRemoteAudio(isEnabled => {
		toogleAudioDenunciante(isEnabled);
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

		setTimeout(function() {
			document.getElementById("grabacion_stop").style.display = "none";
		}, 3000);
	});
});

marksRecording.addEventListener("click", () => {
	$("#marksModal").modal("show");
	clearSelect(selectMarks);
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
	if (selectMarks.value == "" || coment_marks.value == "") {
		Swal.fire({
			icon: "error",
			text: "Por favor, completa todos los campos .",
			showConfirmButton: true,
			confirmButtonColor: "#bf9b55"
		});
	} else {
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
	}
});

acceptConfiguration.addEventListener("click", () => {
	videoSelected = $("#listaDeDispositivosVideo option:selected").text();
	audioSelected = $("#listaDeDispositivosAudio option:selected").text();
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
		document.getElementById("camara_agente_prendida").style.display =
			"block";
		document.getElementById("camara_agente_apagada").style.display = "none";
		video_agente_on.style.display = "block";
		video_agente_off.style.display = "none";
	} else {
		document.getElementById("camara_agente_prendida").style.display =
			"none";
		document.getElementById("camara_agente_apagada").style.display =
			"block";
		video_agente_on.style.display = "none";
		video_agente_off.style.display = "block";
	}
}

function toogleAudioAgent(isEnabled) {
	if (isEnabled == true) {
		document.getElementById("audio_agente_prendida").style.display =
			"block";
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
	console.log("Dentro de toogle video denunciante", isEnabled);
	if (isEnabled == true) {
		document.getElementById("camara_prendida_denunciante").style.display =
			"block";
		document.getElementById("camara_apagada_denunciante").style.display =
			"none";
		video_denunciante_on.style.display = "block";
		video_denunciante_off.style.display = "none";
	} else {
		document.getElementById("camara_prendida_denunciante").style.display =
			"none";
		document.getElementById("camara_apagada_denunciante").style.display =
			"block";
		video_denunciante_on.style.display = "none";
		video_denunciante_off.style.display = "block";
	}
}

function toogleAudioDenunciante(isEnabled) {
	console.log("Dentro de toogle audio denunciante", isEnabled);
	if (isEnabled == true) {
		document.getElementById("audio_prendido_denunciante").style.display =
			"block";
		document.getElementById("audio_apagado_denunciante").style.display =
			"none";
		audio_denunciante_on.style.display = "block";
		audio_denunciante_off.style.display = "none";
	} else {
		document.getElementById("audio_prendido_denunciante").style.display =
			"none";
		document.getElementById("audio_apagado_denunciante").style.display =
			"block";
		audio_denunciante_on.style.display = "none";
		audio_denunciante_off.style.display = "block";
	}
}

function clearVideoCall() {
	video_container.style.display = "none";
	clearToolsBar();
	document.querySelector("#nombre_denunciante").value = "";
	document.querySelector("#main_video_details_name").innerHTML = "";
	document.querySelector("#secondary_video_details_name").innerHTML = "";
	document.querySelector("#genero_denunciante").value = "";
	document.querySelector("#correo_deunciante").value = "";
	document.querySelector("#delito_denunciante_llamada").value = "";
	document.querySelector("#descripcion_denunciante_llamada").innerHTML = "";
	document.querySelector("#folio_llamada").value = "";
	document.querySelector("#idioma_denunciante").value = "";
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

	document.getElementById("audio_prendido_denunciante").style.display =
		"block";
	document.getElementById("audio_apagado_denunciante").style.display = "none";
	document.getElementById("camara_prendida_denunciante").style.display =
		"block";
	document.getElementById("camara_apagada_denunciante").style.display =
		"none";
	video_denunciante_on.style.display = "block";
	video_denunciante_off.style.display = "none";
	audio_denunciante_on.style.display = "block";
	audio_denunciante_off.style.display = "none";
}

function clearSelect(select_element) {
	for (let i = select_element.options.length; i >= 1; i--) {
		select_element.remove(i);
	}
}

function tieneSoporteUserMedia() {
	return !!(navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia)
}

function _getUserMedia() {
	return (navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia).apply(navigator, arguments);
}

const llenarSelectConDispositivosDisponibles = () => {
	$($listaDeDispositivosAudio).empty();
	$($listaDeDispositivosVideo).empty();

	navigator.mediaDevices.enumerateDevices().then(function(dispositivos) {
		const dispositivosDeVideo = [];
		const dispositivosDeAudio = [];
		dispositivos.forEach(function(dispositivo) {
			const tipo = dispositivo.kind;

			if (tipo === "videoinput") {
				dispositivosDeVideo.push(dispositivo);
			}

			if (tipo === "audioinput") {
				dispositivosDeAudio.push(dispositivo)
			}
		});

		if (dispositivosDeVideo.length > 0) {
			dispositivosDeVideo.forEach(dispositivo => {
				const option = document.createElement('option');
				option.value = dispositivo.deviceId;
				option.text = dispositivo.label;
				$listaDeDispositivosVideo.appendChild(option);
			});
		}

		if (dispositivosDeAudio.length > 0) {
			dispositivosDeAudio.forEach(dispositivo => {
				const option = document.createElement('option');
				option.value = dispositivo.deviceId;
				option.text = dispositivo.label;
				$listaDeDispositivosAudio.appendChild(option);
			});
		}
	});
}

function initMediaDevices() {
	var isSafari = navigator.vendor && navigator.vendor.indexOf('Apple') > -1 &&
		navigator.userAgent &&
		navigator.userAgent.indexOf('CriOS') == -1 &&
		navigator.userAgent.indexOf('FxiOS') == -1;


	if (!tieneSoporteUserMedia()) {
		alert("Tu navegador no soporta esta característica");
		$estado.innerHTML = "Tu navegador no soporta este funcionamiento. Sube una foto desde tu dispositivo.";
		return;
	}
	let stream;

	if (!isSafari) {
		navigator.mediaDevices.enumerateDevices().then(function(dispositivos) {

			console.log('dispositivos', dispositivos);
			const dispositivosDeVideo = [];

			dispositivos.forEach(function(dispositivo) {
				const tipo = dispositivo.kind;
				if (tipo === "videoinput") {
					dispositivosDeVideo.push(dispositivo);
				}
			});

			if (dispositivosDeVideo.length > 0) {
				mostrarStream(dispositivosDeVideo[0].deviceId);
			}
		});

		const mostrarStream = idDeDispositivo => {
			console.log(idDeDispositivo, 'idDispositivo');
			_getUserMedia({
					audio: true,
					video: {
						deviceId: idDeDispositivo,
					}
				},
				function(streamObtenido) {
					// $estado.classList.add('d-none');
					llenarSelectConDispositivosDisponibles();

					$listaDeDispositivosVideo.onchange = () => {
						if (stream) {
							stream.getTracks().forEach(function(track) {
								track.stop();
							});
						}
						mostrarStream($listaDeDispositivosVideo.value);
					}

					stream = streamObtenido;

					$video.srcObject = stream;
					$video.play();

					$('#media-devices-alert').attr('hidden', true);
					$('#media-devices-selectors').removeAttr('hidden');
				},
				function(error) {
					console.log("Permiso denegado o error: ", error);
					// $estado.classList.remove('d-none');
				});
		}
	} else {
		const mostrarStream = (idDeDispositivo = null) => {
			console.log(idDeDispositivo, 'idDispositivo');
			let options = {
				audio: true, 
				video: true,
				deviceId: idDeDispositivo
			}
			idDeDispositivo = null ? delete options.deviceId : idDeDispositivo;
			navigator.mediaDevices.getUserMedia(options).then(function(streamObtenido) {

				navigator.mediaDevices.enumerateDevices().then(function(dispositivos) {
					const dispositivosDeVideo = [];
					dispositivos.forEach(function(dispositivo) {
						const tipo = dispositivo.kind;
						if (tipo === "videoinput") {
							dispositivosDeVideo.push(dispositivo);
						}
					});
					llenarSelectConDispositivosDisponibles();

					$listaDeDispositivosVideo.onchange = () => {
						console.log('Cambiando dispositivo');
						if (stream) {
							stream.getTracks().forEach(function(track) {
								track.stop();
							});
						}
						mostrarStream($listaDeDispositivosVideo.value);
					}

					if (dispositivosDeVideo.length > 0) {
						$estado.classList.add('d-none');

						stream = streamObtenido;

						$video.srcObject = stream;
						$video.play();
					}
				});
			}).catch(function(err) {
				console.log("Permiso denegado o error: ", error);
				$estado.classList.remove('d-none');
			});
		}

		mostrarStream();
	}
};
