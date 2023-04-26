/*****************************************
 *
 *  AGENT CONNECTIONS TO VIDEO SERVICE SDK
 *
 * @author César Arley Ojeda Escobar
 ****************************************/

import VideoCall from "./VideoService.js";
import {
	ExceptionConstructorMissingParameter,
	ExceptionSocketIONotImported
} from "./exceptions.js";
/**
 * This is the main class to instanciate a connection with agents
 *
 * @example
 * const videoServiceAgent = new VideoServiceAgent('AGENT_UUID', { apiURL : 'localhost', apiKey : 'API_KEY'});
 *
 * agentVideoService.connectAgent();
 * agentVideoService.registerOnGuestConnected((response) => alert(response));
 * agentVideoService.disconnectAgent();
 */

export class VideoServiceAgent {
	/**
	 * Agent UUID required to authorizate any request
	 */
	#agentUUID;
	#apiURI;
	#apiKey;
	#socket;
	#socketHeaders = {
		"ngrok-skip-browser-warning": "true"
	};
	#socketConfig = {};

	// Audios
	#phoneRing = new Audio("../../assets/agent/assets/sounds/income_call.wav");
	#loggedInSound = new Audio("../../assets/agent/assets/sounds/login.m4a");
	#loggedOutSound = new Audio("../../assets/agent/assets/sounds/logout.m4a");

	agentVideo = true;
	agentAudio = true;
	guestAudio = true;
	guestVideo = true;

	/**
	 * @type {MediaStream} 
	 */
	videoStream = undefined;

	/**
	* @type {MediaStream} 
	*/
	audioStream = undefined;

	guestData = {};
	agentData = {};

	#videoCallService;
	#sessionId;
	#connectionId;
	#recordingId;

	#localVideoSelector;

	/**
	 * @param {string} agentUUID - Preexisting agent uuid
	 * @param {string} folio - Complaint folio
	 * @param {Object} config - Basic configuration to use access API
	 * @param {string} config.apiURI - URL where video service API is
	 * @param {string} config.apiKey - API key to authorize connections
	 * @param {Object} [config.socketConfig = {}] - Ohter optionals socket io config
	 *
	 * @example
	 * const videoServiceAgent = new VideoServiceAgent('AGENT_UUID', { apiURL : 'localhost', apiKey : 'API_KEY'});
	 *
	 * agentVideoService.connectAgent();
	 * agentVideoService.registerOnGuestConnected((response) => alert(response));
	 * agentVideoService.disconnectAgent();
	 *
	 */
	constructor(agentUUID, config) {
		if (!agentUUID)
			throw ExceptionConstructorMissingParameter(
				"agentUUID",
				"VideoServiceAgent"
			);
		this.#agentUUID = agentUUID;

		if (!config?.apiURI)
			throw ExceptionConstructorMissingParameter(
				"config.apiURI",
				"VideoServiceAgent"
			);
		this.#apiURI = config.apiURI;

		if (!config?.apiKey)
			throw ExceptionConstructorMissingParameter(
				"config.apiKey",
				"VideoServiceAgent"
			);
		this.#apiKey = config.apiKey;

		// Setting API key for headers
		this.#socketHeaders["X-API-KEY"] = this.#apiKey;

		this.#agentUUID = agentUUID;
		this.#socketConfig = config.socketConfig ?? {};
	}

	/**
	 * Register the connection of the agent
	 *
	 * @param {Function} callback - This method is executed after agent is connected to socket
	 * @param {Function} onerrror - This method is executed if an exception occours
	 */
	connectAgent(callback, onerror) {
		if (this.#socket) {
			this.#socket.disconnect();
		}

		try {
			this.#socket = io(this.#apiURI, {
				...this.#socketConfig,
				extraHeaders: this.#socketHeaders
			});
		} catch (err) {
			throw ExceptionSocketIONotImported();
		}

		this.#socket.on("exception", function (response) {
			console.warn("event", response ? response : "No event");
			if (typeof onerror === "function") onerror(response);
		});

		this.#socket.on("disconnect", () => {
			try {
				this.#loggedOutSound.play();
			} catch (error) { }
		});

		this.#emit(
			"connect-agent",
			{
				agent: this.#agentUUID
			},
			response => {
				// this.#preventUserCloseWindow();
				this.agentData = response.agent;
				try {
					this.#loggedInSound.play();
				} catch (error) { }

				if (typeof callback === "function") callback(response);
			}
		);
	}

	/**
	 * Register the listener for guest connections
	 *
	 * @param {Function} [callback] - This method is executed after gest is assigned to agent
	 */
	registerOnGuestConnected(callback) {
		this.#socket.on("guest-connected", response => {
			this.guestData = response;
			this.#phoneRing.loop = true;
			this.#phoneRing.play();

			if (typeof callback === "function") callback(response);
		});
	}

	/**
	 * Register on guest disconnect event
	 */
	registerOnGuestDisconnected(callback) {
		this.#socket.on("guest-disconnected", () => {
			this.#phoneRing.pause();
			if (typeof callback === "function") callback();
		});
	}

	/**
	 * Close agent socket connection
	 *
	 * @param {Function} [callback] - This method is executed after agent is disconnected
	 */
	disconnectAgent(callback) {
		try {
			// this.#allowUserToCloseWindow();
			this.#phoneRing.pause();
			this.#socket.disconnect();
			this.#videoCallService?.session.disconnect();
		} catch (e) {
			console.warn(e);
		}

		if (typeof callback === "function") callback();
	}

	/**
	 * Terminates the video call
	 *
	 * @param {function} callback - This function will be called after the video is closed
	 */
	endVideoCall(callback) {
		try {
			this.#emit("close-video-call");
		} catch (e) {
			console.warn(e);
		} finally {
			if (typeof callback === "function") callback();
		}
	}

	/**
	 * Accept incoming call
	 * @param {string} localVideoSelector - Video local - little
	 * @param {string} remoteVideoSelector - Video local - little
	 * @param {Function} [callback] - This method is executed after call is connected, this will receive the details of guest connection
	 */
	acceptCall(localVideoSelector, remoteVideoSelector, callback) {
		this.#localVideoSelector = localVideoSelector;
		this.#emit(
			"connect-call",
			{
				accepted: "accepted-call"
			},
			response => {
				this.#sessionId = response.sessionId;
				this.#connectionId = response.connectionId;
				this.#recordingId = response.recordingId;

				this.#phoneRing.pause();
				console.log(this.agentData);

				if (typeof callback === "function")
					callback(response, this.agentData, this.guestData);

				this.#videoCallService = new VideoCall({ remoteVideoSelector,
					audioSource: this.audioStream,
					videoSource: this.videoStream,
				});

				this.#videoCallService.registerOnSessionDisconnected();

				this.#videoCallService.connectVideoCall(
					response.token,
					localVideoSelector,
					() => {
						this.#phoneRing.pause();
					}
				);
			}
		);
	}

	/**
	 * Refuse incoming call, this will free agent to receive new calls
	 *
	 * @param {Function} [callback] - This method is executed after call is refused
	 */
	refuseCall(callback) {
		this.#phoneRing.pause();

		this.#emit(
			"refuse-call",
			{
				requeue: false
			},
			response => {
				if (typeof callback === "function") callback(response);
			}
		);
	}

	/**
	 * Transfer incoming call, this will put the guest in the priority line again, and free the agent
	 * to receive new calls.
	 *
	 * @param {Function} [callback] - This method is executed after call is transferred
	 */
	transferCall(callback) {
		this.#phoneRing.pause();

		this.#emit(
			"refuse-call",
			{
				requeue: true
			},
			response => {
				if (typeof callback === "function") callback(response);
			}
		);
	}

	/**
	 * This function will start the recording and enable the marks
	 *
	 * @param {Function} [callback] - This method is executed after recording start
	 */
	startRecording(callback) {
		const markTime = this.marksRecording();
		this.emitMarkTime(markTime, "start-recording", "3");

		if (typeof callback === "function") callback();
	}

	/**
	 * This function will stop the recording and enable the marks
	 *
	 * @param {Function} [callback] - This method is executed after recording start
	 */
	stopRecording(callback) {
		const markTime = this.marksRecording();
		this.emitMarkTime(markTime, "stop-recording", "4");

		if (typeof callback === "function") callback();
	}

	/**
	 *
	 * @deprecated
	 */
	getValuesForm(messageText, selectedMark) {
		selectedMark = selectedMark.options[selectedMark.selectedIndex].value;

		emitMarkTime(markTime, messageText, selectedMark);
	}

	/**
	 * Generates a MarkTime string with the form '00:00:00'
	 * @return {string} MarkTime string
	 */
	marksRecording() {
		const now = new Date();

		const videoMS = now.getTime() - this.#videoCallService.startVideoCallTime.getTime();

		const d = new Date(Date.UTC(0, 0, 0, 0, 0, 0, videoMS));
		const parts = [d.getUTCHours(), d.getUTCMinutes(), d.getUTCSeconds()];
		return parts.map(s => String(s).padStart(2, "0")).join(":");
	}

	/**
	 * This function will send a MarkTime to the server
	 *
	 * @param {string} markTime - MarkTime string
	 * @param {string} messageTextMark - Message text
	 * @param {string} selectedMark - Selected Mark id
	 * @param {function} callback - function to be executed when the MarkTime is sent
	 */
	emitMarkTime(markTime, messageTextMark, selectedMark, callback = () => { }) {
		this.#emit(
			"mark-recording",
			{
				markTime,
				messageText: messageTextMark,
				recordingMarkTypeId: selectedMark,
				recordingId: this.#recordingId.toString()
			},
			response => {
				if (typeof callback === "function") callback(response);
			}
		);
	}

	/**
	 * Helper to prevent the Agent to close the tab
	 */
	#preventUserCloseWindow() {
		var preventClose = function (e) {
			e.preventDefault();
			e.returnValue = "Se cerrara la sesión si cierras la ventana.";
			return "Se cerrara la sesión si cierras la ventana.";
		};
		window.removeEventListener("beforeunload", null, false);
		window.addEventListener("beforeunload", preventClose, true);
	}

	/**
	 * Helper to disable function to avoid the Agent to close the window
	 */
	#allowUserToCloseWindow() {
		window.addEventListener("beforeunload", () => { });
	}

	/**
	 * This function return marks types
	 */

	async getMarkTypes() {
		const getRecordingsMarkType = `${this.#apiURI}/recordings-mark-type`;
		const typeMarks = await fetch(getRecordingsMarkType, {
			method: "GET",
			cache: "no-cache",
			headers: {
				"Content-Type": "application/json",
				"Access-Control-Allow-Origin": "*",
				"Access-Control-Allow-Credentials": "true",
				"Access-Control-Allow-Headers": "*",
				"ngrok-skip-browser-warning": "true",
				"X-API-KEY": this.#apiKey
			}
		})
			.then(response => {
				return response.json();
			})
			.catch(error => {
				return error.json();
			});

		return typeMarks;
	}
	/**
	 *  Toggle audio for local publisher
	 *
	 * @param {Function} callback - This function will be called when the audio has been toggled
	 */
	toggleAudio(callback) {
		this.#videoCallService.toggleAudio();

		if (typeof callback === "function")
			callback(this.#videoCallService.isAudioEnabled);
	}

	/**
	 *  Toggle video for local publisher
	 *
	 * @param {Function} callback - This function will be called when the video has been toggled
	 */
	toggleVideo(callback) {
		this.#videoCallService.toggleVideo();

		if (typeof callback === "function")
			callback(this.#videoCallService.isVideoEnabled);
	}

	/**
	 * Toggle guest audio
	 *
	 * @param {Function} callback - This function will be called when the audio has been toggled
	 */
	toggleRemoteAudio(callback) {
		this.guestAudio = !this.guestAudio;
		this.#emit(
			"toggle-audio-guest",
			{ toogleAudioGuest: this.guestAudio },
			() => {
				if (typeof callback === "function") callback(this.guestAudio);
			}
		);
	}

	/**
	 * Toggle guest video
	 *
	 * @param {Function} callback - This function will be called when the video has been toggled
	 */
	toggleRemoteVideo(callback) {
		this.guestVideo = !this.guestVideo;
		this.#emit(
			"toggle-video-guest",
			{ toogleVideoGuest: this.guestVideo },
			() => {
				if (typeof callback === "function") callback(this.guestVideo);
			}
		);
	}

	/**
	 * This function will emit a signal to the guest to reload its page
	 *
	 * @param {function} callback - function to be executed after the guest has reloaded
	 */
	refreshGuestConnection(callback = () => { }) {
		this.#emit("refresh-guest-connection",
			response => {
				if (typeof callback === "function") callback(response);
			}
		);
	}

	/**
	 * This function will emit a signal to reload connection to video call
	 * 
	 * @param {function} callback - function to be executed after the agent video connection reload
	 */
	reloadAgentVideoCall(callback) {
		this.#emit('reload-agent-video-call', {}, async (response) => {
			console.log(response);
			this.#connectionId = response.connectionId;
			await this.#videoCallService.forceDisconnection();
			this.#videoCallService.connectVideoCall(
				response.token,
				this.#localVideoSelector,
				typeof callback === "function" ?  callback(response): undefined
			);
		})
	}

	/**
	 * This method set the videoStream for agent
	 * 
	 * @param {MediaStream} videoStream - videoStream
	 */
	set videoStream(videoStream) {
		this.videoStream = videoStream;
	}

	/**
	 * This method set the audioStream for agent
	 * 
	 * @param {MediaStream} audioStream - audioStream
	 */
	set audioStream(audioStream) {
		this.audioStream = audioStream;
	}

	/**
	 * Helper to protect emit events of socket
	 *
	 * @param {string} eventName - The new of the event to emit
	 * @param {object} [data] - Data to be sended within the event
	 * @param {function} [callback] - Callback that receive the response
	 */
	#emit(eventName, data, callback) {
		const _data = data ?? {};
		const _callback = callback ?? function () { };

		this.#socket.emit(eventName, _data, _callback);
	}
}
