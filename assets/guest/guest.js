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
    
    // Audios
    #phoneRing = new Audio('../../assets/agent/assets/sounds/income_call.wav');
    #loggedInSound = new Audio('../../assets/agent/assets/sounds/login.m4a');
    #loggedOutSound = new Audio('../../assets/agent/assets/sounds/logout.m4a');


    #guestDetails;
    #videoCallService;

    /**
     * @param {string} guestUUID - Preexisting guest uuid
     * @param {string} folio - Complaint folio
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
    constructor(guestUUID, folio, config) {

        if (!guestUUID) throw ExceptionConstructorMissingParameter('guestUUID', 'VideoServiceGuest');
        this.#guestUUID = guestUUID;

        if (!folio) throw ExceptionConstructorMissingParameter('folio', 'VideoServiceGuest');
        this.#folio = folio;

        if (!config?.apiURI) throw ExceptionConstructorMissingParameter('config.apiURI', 'VideoServiceGuest');
        this.#apiURI = config.apiURI;

        if (!config?.apiKey) throw ExceptionConstructorMissingParameter('config.apiKey', 'VideoServiceGuest');
        this.#apiKey = config.apiKey


        // Setting API key for headers
        this.#socketHeaders['X-API-KEY'] = this.#apiKey;

        this.#guestUUID = guestUUID;
        this.#socketConfig = config.socketConfig ?? {};
    }

    /**
     * Register the connection of the guest
     * @param {Object} details - Details of the guest
     * @param {Function} callback - This method is executed after guest is connected to socket 
     */
    connectGuest(details, callback) {
        this.#guestDetails = details;

        if (this.#socket) {
            this.#socket.disconnect();
        }

        try {
            this.#socket = io(this.#apiURI, { ...this.#socketConfig, extraHeaders: this.#socketHeaders });
        } catch (err) {
            throw ExceptionSocketIONotImported();
        }

        this.#socket.on('exception', function (data) {
            console.warn('event', data);
        });

        this.#socket.on('disconnect', () => {
            this.#loggedOutSound.play();
        });


        this.#emit('connect-guest', {
            guest: this.#guestUUID,
            priority: this.#priority,
            folio: this.#folio,
            altitude: this.#position?.coords.altitude,
            latitude: this.#position?.coords.latitude,
            longitude: this.#position?.coords.longitude,
            details: this.#guestDetails
        }, response => {
            this.#guestConnectionId = response.id;
            this.#loggedInSound.play();

            if (typeof callback === 'function') callback(response);
        });

        this.#socket.on('mute-video', ({toggleVideo}) => {
            this.#videoCallService.publishVideo(toggleVideo.toogleVideoGuest);
        });
    
        this.#socket.on('mute-audio', ({toggleAudio}) => {
            this.#videoCallService.publishAudio(toggleAudio.toogleAudioGuest);
        });
    }

    /**
     * Accept incoming call
     * @param {string} localVideoSelector - Video local - little
     * @param {string} remoteVideoSelector - Video local - little
     * @param {Function} [callback] - This method is executed after call is connected, this will receive the details of guest connection
     */
    registerOnVideoReady(localVideoSelector, remoteVideoSelector, callback) {
        this.#socket.on('video-ready', function(response) {
            this.#loggedInSound.play();
            this.#videoCallService = new VideoCall({ remoteVideoSelector });

            if (typeof callback === 'function') callback(response);
            this.#videoCallService.connectVideoCall(response.token, localVideoSelector, () => {})
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
     * @param {string} _position - Get position
     * @param {function} [callback] - Callback that receive the position
     */
    successCallback = (_position) => {
        this.#position = _position;
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
