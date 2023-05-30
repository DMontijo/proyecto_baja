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
const $mediaConfiguration = document.getElementById("media_configuration");
const $listaDeDispositivosVideo = document.querySelector(
	"#listaDeDispositivosVideo"
);
const $listaDeDispositivosAudio = document.querySelector(
	"#listaDeDispositivosAudio"
);
const $video = document.querySelector("#video");
const $audio = document.querySelector("#audio");
const $acceptConfiguration = document.querySelector("#acceptConfiguration");
let videoStream;
let audioStream;

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
// const recargar_denunciante_btn = document.querySelector("#recargar_denunciante_btn");

// const recargar_agente = document.querySelector("#recargar_agente");

// const marksRecording = document.querySelector("#marks-recording-modal");
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

$mediaConfiguration.addEventListener("click", async () => {
	$(mediaDevicesModal).modal("show");
	initMediaDevices();
});

const agentVideoService = new VideoServiceAgent(agentUUID, { apiURI, apiKey });

// recargar_denunciante_btn.addEventListener("click", () => {
// 	console.log("RECARGANDO DENUNCIANTE")
// 	agentVideoService.refreshGuestConnection(() => {
// 		Swal.fire({
// 			icon: "success",
// 			text: "La conexion de denunciante se recargara en 3 segundos",
// 			showConfirmButton: true,
// 			confirmButtonColor: "#bf9b55",
// 			timer: 3000,
// 			timerProgressBar: true,
// 		});
// 	});
// });

// recargar_agente.addEventListener("click", () => {
// 	console.log("ENTRANDO A RECARGAR LLAMADA");
// 	agentVideoService.reloadAgentVideoCall((resp) => {
// 		console.log(resp);
// 	});
// });

disponible_connect.addEventListener("click", () => {
	console.log("Conectando agente...");
	if (!agentVideoService.videoStream && !agentVideoService.audioStream) {
		console.log(agentVideoService.videoStream, "video");
		console.log(agentVideoService.audioStream, "audio");
	}

	navigator.mediaDevices
		.getUserMedia({
			audio: true,
			video: true
		})
		.then(function() {
			disponible_connect.disabled = true;
			agentVideoService.connectAgent(
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
						console.log(response.guest.uuid, "response");
						guestUUID = response.guest.uuid;
						console.log("Respuesta: ", response);
						document.querySelector("#nombre_denunciante").value =
							response.guest.name;
						document.querySelector(
							"#main_video_details_name"
						).value = response.guest.name;
						document.querySelector("#genero_denunciante").value =
							response.guest.gender == "FEMALE"
								? "FEMENINO"
								: "MASCULINO";
						document.querySelector("#correo_deunciante").value =
							response.guest.details.CORREO;
						document.querySelector(
							"#delito_denunciante_llamada"
						).value =
							response.details != null
								? response.details.delito
								: "-";
						document.querySelector(
							"#descripcion_denunciante_llamada"
						).innerHTML =
							response.details != null
								? response.details.descripcion
								: "-";
						document.querySelector("#folio_llamada").value =
							response.details != null
								? response.details.folio
								: "-";
						document.querySelector(
							"#idioma_denunciante"
						).value = response.guest.languages
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
							timerProgressBar: true
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
					aceptar_llamada.disabled = false;
					Swal.fire({
						icon: "error",
						text: response.message,
						showConfirmButton: false,
						timer: 3000,
						timerProgressBar: true
					});
				}
			);
		})
		.catch(function() {
			Swal.fire({
				icon: "error",
				text: "Acepta los permisos de audio y video para comenzar.",
				showConfirmButton: true
			});
		});
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
			$mediaConfiguration.hidden = true;
			header_llamda.hidden = false;
			$("#llamadaModal").modal("hide");
			aceptar_llamada.disabled = false;
			if (document.getElementById("input_folio_atencion").value == "") {
				try {
					let split = guestConnection.folio.split("/");
					document.getElementById("input_folio_atencion").value =
						split[0];
					document.getElementById("buscar-btn").click();
				} catch (error) {}
			} else {
				try {
					// ../../data/restore-folio
					var xhttp = new XMLHttpRequest();

					var data = new FormData();
					data.append(
						"folio",
						document.getElementById("input_folio_atencion").value
					);
					data.append(
						"year",
						document.getElementById("year_select").value
					);

					xhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							// Maneja la respuesta del servidor aquí
						}
					};
					xhttp.open("POST", "../../data/restore-folio", true);
					xhttp.send(data);
					borrarTodo();

					let split = guestConnection.folio.split("/");
					document.getElementById("input_folio_atencion").value =
						split[0];
					document.getElementById("buscar-btn").click();
					// buscar_btn.classList.add("d-none");
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
					timerProgressBar: true
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
		// marksRecording.disabled = false;
		document.getElementById("grabacion").style.display = "block";
		document.getElementById("grabacion_stop").style.display = "none";
		startRecord.style.display = "none";
		stopRecord.style.display = "block";
	});
});

stopRecord.addEventListener("click", () => {
	agentVideoService.stopRecording(() => {
		// marksRecording.disabled = true;
		document.getElementById("grabacion").style.display = "none";
		document.getElementById("grabacion_stop").style.display = "block";
		startRecord.style.display = "block";
		stopRecord.style.display = "none";

		setTimeout(function() {
			document.getElementById("grabacion_stop").style.display = "none";
		}, 3000);
	});
});

// marksRecording.addEventListener("click", () => {
// 	$("#marksModal").modal("show");
// 	clearSelect(selectMarks);
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

enviar_marca.addEventListener("click", () => {
	if (selectMarks.value == "" || coment_marks.value == "") {
		Swal.fire({
			icon: "error",
			text: "Por favor, completa todos los campos.",
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

$acceptConfiguration.addEventListener("click", () => {
	if (!audioStream) return;
	if (!videoStream) return;

	audioStream.getTracks().forEach(function(track) {
		track.stop();
	});

	videoStream.getTracks().forEach(function(track) {
		track.stop();
	});

	$(mediaDevicesModal).modal("hide");
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
	$mediaConfiguration.hidden = false;
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
	return !!(
		navigator.getUserMedia ||
		navigator.mozGetUserMedia ||
		navigator.mediaDevices.getUserMedia ||
		navigator.webkitGetUserMedia ||
		navigator.msGetUserMedia
	);
}

function _getUserMediaAudio() {
	return (
		navigator.getUserMedia ||
		navigator.mozGetUserMedia ||
		navigator.mediaDevices.getUserMedia ||
		navigator.webkitGetUserMedia ||
		navigator.msGetUserMedia
	).apply(navigator, arguments);
}

function _getUserMediaVideo() {
	return (
		navigator.getUserMedia ||
		navigator.mozGetUserMedia ||
		navigator.mediaDevices.getUserMedia ||
		navigator.webkitGetUserMedia ||
		navigator.msGetUserMedia
	).apply(navigator, arguments);
}

const llenarSelectConDispositivosDisponiblesVideo = idDeDispositivo => {
	// console.log($listaDeDispositivosVideo);
	// if(!$listaDeDispositivosVideo){
	// 	$('#listDevicesVideo').empty(listDevicesVideo);
	// 	const selectElement = document.createElement('select');
	// 	selectElement.setAttribute('name', 'listaDeDispositivosVideo');
	// 	selectElement.setAttribute('id', 'listaDeDispositivosVideo');
	// 	selectElement.setAttribute('class', 'form-control');
	// 	$('#listDevicesVideo').appendChild(selectElement);
	// }

	if ($listaDeDispositivosVideo.length) $($listaDeDispositivosVideo).empty();

	navigator.mediaDevices.enumerateDevices().then(function(dispositivos) {
		const dispositivosDeVideo = [];
		dispositivos.forEach(function(dispositivo) {
			const tipo = dispositivo.kind;

			if (tipo === "videoinput") {
				dispositivosDeVideo.push(dispositivo);
			}
		});

		if (dispositivosDeVideo.length > 0) {
			dispositivosDeVideo.forEach(dispositivo => {
				const option = document.createElement("option");
				option.value = dispositivo.deviceId;
				option.text = dispositivo.label;
				if (dispositivo.deviceId === idDeDispositivo) {
					option.selected = true;
				}
				$listaDeDispositivosVideo.appendChild(option);
			});
		}
	});
};

const llenarSelectConDispositivosDisponiblesAudio = idDeDispositivo => {
	$($listaDeDispositivosAudio).empty();

	navigator.mediaDevices.enumerateDevices().then(function(dispositivos) {
		const dispositivosDeAudio = [];
		dispositivos.forEach(function(dispositivo) {
			const tipo = dispositivo.kind;

			if (tipo === "audioinput") {
				dispositivosDeAudio.push(dispositivo);
			}
		});

		if (dispositivosDeAudio.length > 0) {
			dispositivosDeAudio.forEach(dispositivo => {
				const option = document.createElement("option");
				option.value = dispositivo.deviceId;
				option.text = dispositivo.label;
				if (dispositivo.deviceId === idDeDispositivo) {
					option.selected = true;
				}
				$listaDeDispositivosAudio.appendChild(option);
			});
		}
	});
};

const llenarSelectConDispositivosDisponiblesVideoIOS = () => {
	//console.log('llenando video');
	navigator.mediaDevices.enumerateDevices().then(function(dispositivos) {
		const dispositivosDeVideo = [];
		dispositivos.forEach(function(dispositivo) {
			const tipo = dispositivo.kind;
			if (tipo === "videoinput") {
				dispositivosDeVideo.push(dispositivo);
			}
		});

		if (dispositivosDeVideo.length > 0) {
			dispositivosDeVideo.forEach(dispositivo => {
				const option = document.createElement("option");
				option.value = dispositivo.deviceId;
				option.text = dispositivo.label;
				$listaDeDispositivosVideo.appendChild(option);
			});
		}
	});
};
const llenarSelectConDispositivosDisponiblesAudioIOS = () => {
	//console.log('llenando audio');
	navigator.mediaDevices.enumerateDevices().then(function(dispositivos) {
		const dispositivosDeAudio = [];
		dispositivos.forEach(function(dispositivo) {
			const tipo = dispositivo.kind;
			if (tipo === "audioinput") {
				dispositivosDeAudio.push(dispositivo);
			}
		});

		if (dispositivosDeAudio.length > 0) {
			dispositivosDeAudio.forEach(dispositivo => {
				const option = document.createElement("option");
				option.value = dispositivo.deviceId;
				option.text = dispositivo.label;
				$listaDeDispositivosAudio.appendChild(option);
			});
		}
	});
};

function initMediaDevices() {
	var isSafari =
		navigator.vendor &&
		navigator.vendor.indexOf("Apple") > -1 &&
		navigator.userAgent &&
		navigator.userAgent.indexOf("CriOS") == -1 &&
		navigator.userAgent.indexOf("FxiOS") == -1;
	let platform = navigator.platform;

	if (!tieneSoporteUserMedia()) {
		alert("Tu navegador no soporta esta característica");
		$estado.innerHTML =
			"Tu navegador no soporta este funcionamiento. Sube una foto desde tu dispositivo.";
		return;
	}

	let dispositivosDeVideo;
	let dispositivosDeAudio;

	if (!isSafari && platform != "iPhone") {
		navigator.mediaDevices.enumerateDevices().then(function(dispositivos) {
			dispositivosDeVideo = [];
			dispositivosDeAudio = [];

			dispositivos.forEach(function(dispositivo) {
				const tipo = dispositivo.kind;

				if (tipo === "videoinput") {
					dispositivosDeVideo.push(dispositivo);
				}

				if (tipo === "audioinput") {
					dispositivosDeAudio.push(dispositivo);
				}
			});

			if (dispositivosDeVideo.length > 0) {
				mostrarStreamVideo(dispositivosDeVideo.deviceId);
			}

			if (dispositivosDeAudio.length > 0) {
				mostrarStreamAudio(dispositivosDeAudio.deviceId);
			}
		});

		const mostrarStreamVideo = idDeDispositivo => {
			_getUserMediaVideo(
				{
					video: {
						deviceId: idDeDispositivo
					}
				},
				function(streamObtenidoVideo) {
					llenarSelectConDispositivosDisponiblesVideo(
						idDeDispositivo
					);

					$listaDeDispositivosVideo.onchange = () => {
						if (videoStream) {
							videoStream.getTracks().forEach(function(track) {
								track.stop();
							});
						}
						mostrarStreamVideo($listaDeDispositivosVideo.value);
					};

					videoStream = streamObtenidoVideo;
					agentVideoService.videoStream = idDeDispositivo;
					console.log(agentVideoService.videoStream);
					$video.srcObject = streamObtenidoVideo;
					$video.play();

					$("#media-devices-alert").attr("hidden", true);
					$("#media-devices-selectors").removeAttr("hidden");
				},
				function(error) {
					let listDevices = document.getElementById(
						"listDevicesVideo"
					);
					if ($video) $video.remove();
					$("#listDevicesVideo").empty();

					let spanElement = document.createElement("span");
					spanElement.textContent =
						"Permiso denegado, vuelve a recargar";
					spanElement.setAttribute("id", "listaDeDispositivosVideo");
					listDevices.appendChild(spanElement);
					console.log("Permiso denegado o error: ", error);
					$acceptConfiguration.setAttribute("disabled", true);
				}
			);
		};

		const mostrarStreamAudio = idDeDispositivo => {
			_getUserMediaAudio(
				{
					audio: {
						deviceId: idDeDispositivo
					}
				},
				function(streamObtenidoAudio) {
					llenarSelectConDispositivosDisponiblesAudio(
						idDeDispositivo
					);

					$listaDeDispositivosAudio.onchange = () => {
						if (audioStream) {
							audioStream.getTracks().forEach(function(track) {
								track.stop();
							});
						}
						mostrarStreamAudio($listaDeDispositivosAudio.value);
					};

					audioStream = streamObtenidoAudio;
					agentVideoService.audioStream = idDeDispositivo;
					console.log(agentVideoService.audioStream);
					$audio.srcObject = streamObtenidoAudio;
					$audio.play();

					$("#media-devices-alert").attr("hidden", true);
					$("#media-devices-selectors").removeAttr("hidden");
				},
				function(error) {
					let listDevices = document.getElementById(
						"listDevicesAudio"
					);
					$audio.remove();
					$("#listDevicesAudio").empty();

					let spanElement = document.createElement("span");
					spanElement.textContent =
						"Permiso denegado, vuelve a recargar";
					spanElement.setAttribute("id", "listaDeDispositivosAudio");
					listDevices.appendChild(spanElement);

					console.log("Permiso denegado o error: ", error);
					$acceptConfiguration.setAttribute("disabled", true);
				}
			);

			if (streamObtenidoAudio && streamObtenidoAudio)
				$($acceptConfiguration).removeAttr("disabled");
		};
	} else {
		const mostrarStreamVideo = (camera_selected = null) => {
			
			let options = {
				video: {
					deviceId: {
					  exact: camera_selected.deviceId ? camera_selected.deviceId : camera_selected,
					}
				},
				audio: true
			};

			navigator.mediaDevices.getUserMedia(options).then(function(streamObtenido) {
				// console.log('camara selected', streamObtenido);
				$listaDeDispositivosVideo.onchange = () => {
					// console.log('anterior',videoStream);
					videoStream.getTracks().forEach(function(track) {
						track.stop();
					});
					mostrarStreamVideo($listaDeDispositivosVideo.value);
				};

				videoStream = streamObtenido;
				agentVideoService.videoStream = camera_selected.deviceId ? camera_selected.deviceId : camera_selected;
				// console.log('service',agentVideoService.videoStream);

				$video.srcObject = videoStream;
				$video.play();
				if (audioStream && videoStream) $($acceptConfiguration).removeAttr("disabled");

			});
		}; 

		const mostrarStreamAudio = (audio_selected = null) => {

			let options = {
				audio: {
					deviceId: {
					  exact: audio_selected.deviceId ? audio_selected.deviceId : audio_selected,
					}
				},
			};

			navigator.mediaDevices.getUserMedia(options).then(function(streamObtenido) {
				// console.log('camara selected', streamObtenido);
				$listaDeDispositivosAudio.onchange = () => {
					// console.log('anterior',audioStream);
					audioStream.getTracks().forEach(function(track) {
						track.stop();
					});
					mostrarStreamAudio($listaDeDispositivosAudio.value);
				};

				audioStream = streamObtenido;
				agentVideoService.audioStream = audio_selected.deviceId ? audio_selected.deviceId : audio_selected;

				$audio.srcObject = audioStream;
				$audio.play();
				if (audioStream && videoStream) $($acceptConfiguration).removeAttr("disabled");

			});

			$("#media-devices-alert").attr("hidden", true);
			$("#media-devices-selectors").removeAttr("hidden");
			// console.log('audio w', audioStream);
			// console.log('video w', videoStream);
			// if (audioStream && videoStream) $($acceptConfiguration).removeAttr("disabled");
		};

		const mostrarStream = (idDeDispositivo = null) => {
			let options = {
				video: true,
				deviceId: idDeDispositivo,
				audio: true
			};
			idDeDispositivo = null ? delete options.deviceId : idDeDispositivo;
			
			navigator.mediaDevices.getUserMedia(options).then(function(streamObtenido) {
					navigator.mediaDevices.enumerateDevices().then(function(dispositivos) {
						dispositivosDeVideo = [];
						dispositivosDeAudio = [];
						dispositivos.forEach(function(dispositivo) {
							const tipo = dispositivo.kind;
							if (tipo === "videoinput") {
								dispositivosDeVideo.push(dispositivo);
							}
							if (tipo === "audioinput") {
								dispositivosDeAudio.push(dispositivo);
							}
						});
						
						if (dispositivosDeVideo.length > 0) {
							llenarSelectConDispositivosDisponiblesVideoIOS();
							mostrarStreamVideo(dispositivosDeVideo[0]);
						}

						if (dispositivosDeAudio.length > 0) {
							llenarSelectConDispositivosDisponiblesAudioIOS();
							mostrarStreamAudio(dispositivosDeAudio[0]);
						}
					});
				})
				.catch(function(err) {
					console.log("Permiso denegado o error: ", err);
					$estado.classList.remove("d-none");
				});
		};
		mostrarStream();
	}
}
