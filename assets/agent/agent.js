/*****************************************
 *
 *  AGENT CONNECTIONS TO VIDEO SERVICE SDK
 *
 * @author César Arley Ojeda Escobar
 ****************************************/

import VideoCall from './VideoService.js';
import { ExceptionConstructorMissingParameter, ExceptionSocketIONotImported } from './exceptions.js';
/**
 * This is the main class to instanciate a connection with agents
 * 
 * @example
 * const videoServiceAgent = new VideoServiceAgent('AGENT_UUID', { apiURL : 'localhost', apiKey : 'API_KEY'});
 * 
 * agentVideoService.connetAgent();
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
    #startVideoCallTime;
    #socket;
    #socketHeaders = {
        'ngrok-skip-browser-warning': 'true'
    }
    #socketConfig = {};
    
    // Audios
    #phoneRing = new Audio('./assets/sounds/income_call.wav');
    #loggedInSound = new Audio('./assets/sounds/login.m4a');
    #loggedOutSound = new Audio('./assets/sounds/logout.m4a');


    #videoCallService;
    #sessionId;
    #connectionId;
    #recordingId;

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
     * agentVideoService.connetAgent();
     * agentVideoService.registerOnGuestConnected((response) => alert(response));
     * agentVideoService.disconnectAgent();
     * 
     */
    constructor(agentUUID, config) {

        if (!agentUUID) throw ExceptionConstructorMissingParameter('agentUUID', 'VideoServiceAgent');
        this.#agentUUID = agentUUID;

        if (!config?.apiURI) throw ExceptionConstructorMissingParameter('config.apiURI', 'VideoServiceAgent');
        this.#apiURI = config.apiURI;

        if (!config?.apiKey) throw ExceptionConstructorMissingParameter('config.apiKey', 'VideoServiceAgent');
        this.#apiKey = config.apiKey


        // Setting API key for headers
        this.#socketHeaders['X-API-KEY'] = this.#apiKey;

        this.#agentUUID = agentUUID;
        this.#socketConfig = config.socketConfig ?? {};
    }

    /**
     * Register the connection of the agent
     * 
     * @param {Function} callback - This method is executed after agent is connected to socket 
     */
    connetAgent(callback) {

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


        this.#emit('connect-agent', {
            agent: this.#agentUUID
        }, response => {
            this.#loggedInSound.play();

            if (typeof callback === 'function') callback(response);
        });
    }

    /**
     * Register the listener for guest connections
     * 
     * @param {Function} [callback] - This method is executed after gest is assigned to agent
     */
    registerOnGuestConnected(callback) {
        this.#socket.on('guest-connected', (response) => {
            this.#phoneRing.loop = true;
            this.#phoneRing.play();

            if (typeof callback === 'function') callback(response);
        });
    }

    /**
     * Close agent socket connection
     * 
     * @param {Function} [callback] - This method is executed after agent is disconnected
     */
    disconnectAgent(callback) {
        this.#socket.disconnect();

        if (typeof callback === 'function') callback(response);
    }

    /**
     * Accept incoming call
     * @param {string} localVideoSelector - Video local - little
     * @param {string} remoteVideoSelector - Video local - little
     * @param {Function} [callback] - This method is executed after call is connected, this will receive the details of guest connection
     */
    acceptCall(localVideoSelector, remoteVideoSelector, callback) {

        this.#emit('connect-call', {
            accepted: 'accepted-call'
        }, (response) => {

            this.#sessionId = response.sessionId;
            this.#connectionId = response.connectionId;
            this.#recordingId = response.recordingId;

            this.#phoneRing.pause();
            if (typeof callback === 'function') callback(response);

            
            this.#videoCallService = new VideoCall({ remoteVideoSelector });
            
            this.#videoCallService.registerOnSessionDisconnected();
            
            this.#videoCallService.connectVideoCall(response.token, localVideoSelector,() => {
                this.#startVideoCallTime = new Date();
                this.#phoneRing.pause();
            })


        });
    }

    /**
     * Refuse incoming call, this will free agent to receive new calls
     * 
     * @param {Function} [callback] - This method is executed after call is refused
     */
    refuseCall(callback) {
        this.#phoneRing.pause();

        if (typeof callback === 'function') callback(response);
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
        const _callback = callback ?? function(){};

        this.#socket.emit(eventName, _data, _callback);
    }
}
