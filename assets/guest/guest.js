/*****************************************
 *
 *  AGENT CONNECTIONS TO VIDEO SERVICE SDK
 *
 * @author César Arley Ojeda Escobar
 ****************************************/

import VideoCall from './VideoService.js';
import { ExceptionConstructorMissingParameter, ExceptionSocketIONotImported } from './exceptions.js';
/**
 * This is the main class to instanciate a connection with guests
 * 
 * @example
 * const videoServiceGuest = new VideoServiceGuest('GUEST_UUID', { apiURL : 'localhost', apiKey : 'API_KEY'});
 * 
 * guestVideoService.connectGuest();
 * guestVideoService.registerOnGuestConnected((response) => alert(response));
 * guestVideoService.disconnectGuest();
 */

export class VideoServiceGuest {
    /**
     * Guest UUID required to authorizate any request
     */
    #guestUUID;
    #folio;
    #apiURI;
    #apiKey;
    #socket;
    #socketHeaders = {
        'ngrok-skip-browser-warning': 'true'
    }
    #priority;
    #position;
    #socketConfig = {};

    agentData = {};
    guestData = {};
    
    // Audios
    #phoneRing = new Audio('../../assets/agent/assets/sounds/income_call.wav');
    #loggedInSound = new Audio('../../assets/agent/assets/sounds/login.m4a');
    #loggedOutSound = new Audio('../../assets/agent/assets/sounds/logout.m4a');

    #guestDetails;
    #videoCallService;
    #guestConnectionId;
    
    isRecording = false;

    /**
     * @param {string} guestUUID - Preexisting guest uuid
     * @param {string} folio - Complaint folio
     * @param {string} priority - Complaint priority
     * @param {Object} config - Basic configuration to use access API
     * @param {string} config.apiURI - URL where video service API is
     * @param {string} config.apiKey - API key to authorize connections
     * @param {Object} [config.socketConfig = {}] - Ohter optionals socket io config
     * 
     * @example
     * const videoServiceGuest = new VideoServiceGuest('GUEST_UUID', { apiURL : 'localhost', apiKey : 'API_KEY'});
     * 
     * guestVideoService.connetGuest();
     * guestVideoService.registerOnGuestConnected((response) => alert(response));
     * guestVideoService.disconnectGuest();
     * 
     */
    constructor(guestUUID, folio, priority, config) {

        if (!guestUUID) throw ExceptionConstructorMissingParameter('guestUUID', 'VideoServiceGuest');
        this.#guestUUID = guestUUID;

        if (!folio) throw ExceptionConstructorMissingParameter('folio', 'VideoServiceGuest');
        this.#folio = folio;
        
        if (!priority) throw ExceptionConstructorMissingParameter('priority', 'VideoServiceGuest');
        this.#priority = priority;

        if (!config?.apiURI) throw ExceptionConstructorMissingParameter('config.apiURI', 'VideoServiceGuest');
        this.#apiURI = config.apiURI;

        if (!config?.apiKey) throw ExceptionConstructorMissingParameter('config.apiKey', 'VideoServiceGuest');
        this.#apiKey = config.apiKey


        // Setting API key for headers
        this.#socketHeaders['X-API-KEY'] = this.#apiKey;

        this.#guestUUID = guestUUID;
        this.#socketConfig = config.socketConfig ?? {};

        try {
            this.#socket = io(this.#apiURI, { ...this.#socketConfig, extraHeaders: this.#socketHeaders });
        } catch (err) {
            throw ExceptionSocketIONotImported();
        }
    }

    /**
     * Register the connection of the guest
     * @param {Object} details - Details of the guest
     * @param {Function} callback - This method is executed after guest is connected to socket 
     */
    connectGuest(details, callback) {
        this.#guestDetails = details;

        this.#socket.on('exception', function (data) {
            console.warn('event', data);
        });

        this.#emit('connect-guest', {
            uuid: this.#guestUUID,
            priority: this.#priority,
            folio: this.#folio,
            altitude: this.#position?.coords.altitude,
            latitude: this.#position?.coords.latitude,
            longitude: this.#position?.coords.longitude,
            details: this.#guestDetails
        }, response => {
            const { guestConnection, guest } = response;
            this.#guestConnectionId = guestConnection.id;

            this.guestData = guest;

            if (typeof callback === 'function') callback(guest);
        });

        
    }

    /**
     * Register media interaction for agent toggling
     * 
     * @param {Function} callback - callback function
     */
    registerMediaRemoteToggling(callback) {
        this.#socket.on('mute-video', ({toggleVideo}) => {
            this.#videoCallService.toggleVideo(toggleVideo.toogleVideoGuest);
            if (typeof callback === 'function') callback(toggleVideo);
        });
    
        this.#socket.on('mute-audio', ({toggleAudio}) => {
            this.#videoCallService.toggleAudio(toggleAudio.toogleAudioGuest);
            if (typeof callback === 'function') callback(toggleAudio);
        });
    }
    
    /**
     * Register callback for call close event
     * @param {Function} [callback] - This method is executed after call is connected, this will receive the details of guest connection
    */
   registerOnDisconnect(callback) {
       this.#socket.on('disconnect-guest', (resp) => {
           try {
                this.#socket.disconnect();
                this.#loggedOutSound.play();
            } catch (e) {
                console.warn(e)
            }

            if (typeof callback === 'function') callback(resp);
        });
    }

    /**
     * Accept incoming call
     * @param {string} localVideoSelector - Video local - little
     * @param {string} remoteVideoSelector - Video local - little
     * @param {Function} [callback] - This method is executed after call is connected, this will receive the details of guest connection
     */
    registerOnVideoReady(localVideoSelector, remoteVideoSelector, callback) {
        this.#socket.on('video-ready', (response) => {
            this.agentData = response.agent;
            if (typeof callback === 'function') callback(response, this.guestData);

            this.#videoCallService = new VideoCall({ remoteVideoSelector });
            this.#videoCallService.connectVideoCall(response.token, localVideoSelector, () => {})
        });
    }


    /**
     * Register recording status changes
     * @param {Function} [callback] - This method is executed after recording status changes
     */
    registerVideoRecordingStatus(callback) {
        this.#socket.on('recording-status', ({ isRecording }) => {
            this.isRecording = isRecording;
            if (typeof callback === 'function') callback(isRecording);
        });
    }

    /**
     * Close guest socket connection
     * 
     * @param {Function} [callback] - This method is executed after guest is disconnected
     */
    disconnectGuest(callback) {
        try {
            this.#videoCallService?.session.disconnect();
            this.#socket.disconnect();
        } catch (e) {
            console.error(e)
        }


        if (typeof callback === 'function') callback(response);
    }

    /**
     * Helper to get position
     * 
     * @param {function} [callback] - Callback to be called when position is available
     */
    saveGeolocation = (callback) => {
        navigator.geolocation.getCurrentPosition((_position) => {
            this.#position = _position;

            if (typeof callback === 'function') callback();
        }, () => {
            if (typeof callback === 'function') callback();
        });
    };

    /**
     * Helper to protect emit events of socket
     * 
     * @param {string} eventName - The new of the event to emit
     * @param {object} [data] - Data to be sended within the event
     * @param {function} [callback] - Callback that receive the response
     */
    #emit(eventName, data, callback) {
        const _data = data ?? {};
        const _callback = callback ?? function(){};

        this.#socket.emit(eventName, _data, _callback);
    }
}