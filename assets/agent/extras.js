/*****************************************
 *
 *  EXTRA SOCKETS CLASSES
 *
 * @author César Arley Ojeda Escobar
 ****************************************/

import { ExceptionConstructorMissingParameter, ExceptionSocketIONotImported } from './exceptions.js';

/**
 * This object can get rooms information in real time
 * 
 * @example
 * const roomsSockets = new RoomsSockets({ apiURL : 'localhost', apiKey : 'API_KEY'});
 * 
 * roomsSockets.registerToRoomsUpdate((response) => alert(response));
 */
export class RoomsSockets {

    #apiURI;
    #apiKey;
    #socket;
    #socketHeaders = {
        'ngrok-skip-browser-warning': 'true'
    }
    #socketConfig = {};

    /**
     * @param {Object} config - Basic configuration to use access API
     * @param {string} config.apiURI - URL where video service API is
     * @param {string} config.apiKey - API key to authorize connections
     * @param {Object} [config.socketConfig = {}] - Ohter optionals socket io config
     * 
     * @example
     * const roomsSockets = new RoomsSockets({ apiURL : 'localhost', apiKey : 'API_KEY'});
     * 
     * roomsSockets.registerToRoomsUpdate((response) => alert(response));
     * 
     */
    constructor(config) {
        if (!config?.apiURI) throw ExceptionConstructorMissingParameter('config.apiURI', 'RoomsSockets');
        this.#apiURI = config.apiURI;

        if (!config?.apiKey) throw ExceptionConstructorMissingParameter('config.apiKey', 'RoomsSockets');
        this.#apiKey = config.apiKey


        // Setting API key for headers
        this.#socketHeaders['X-API-KEY'] = this.#apiKey;

        this.#socketConfig = config.socketConfig ?? {};

        this.#createConnection();
    }

    /**
     * Create te connection
     */
    #createConnection() {

        if (this.#socket) {
            this.#socket.disconnect();
        }

        try {
            this.#socket = io(this.#apiURI, { ...this.#socketConfig, extraHeaders: this.#socketHeaders });
        } catch (err) {
            throw ExceptionSocketIONotImported();
        }

        this.#socket.on('exception', function (data) {
            console.warn('RoomsSockets event: ', data);
        });

        this.#socket.on('disconnect', () => {
            // TODO
        });
    }

    registerToRoomsUpdate(callback) {
        this.#socket.on('rooms-update', callback);
        this.#emit('register-to-rooms-updates');
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

/**
 * This object can get rooms information in real time
 * 
 * @example
 * const priorityLinesSockets = new PriorityLinesSockets({ apiURL : 'localhost', apiKey : 'API_KEY'});
 * 
 * priorityLinesSockets.registerToRoomsUpdate((response) => alert(response));
 */
export class PriorityLinesSockets {
    #apiURI;
    #apiKey;
    #socket;
    #socketHeaders = {
        'ngrok-skip-browser-warning': 'true'
    }
    #socketConfig = {};

    /**
     * @param {Object} config - Basic configuration to use access API
     * @param {string} config.apiURI - URL where video service API is
     * @param {string} config.apiKey - API key to authorize connections
     * @param {Object} [config.socketConfig = {}] - Ohter optionals socket io config
     * 
     * @example
     * const PriorityLinesSockets = new PriorityLinesSockets({ apiURL : 'localhost', apiKey : 'API_KEY'});
     * 
     * PriorityLinesSockets.registerToRoomsUpdate((response) => alert(response));
     * 
     */
    constructor(config) {
        if (!config?.apiURI) throw ExceptionConstructorMissingParameter('config.apiURI', 'PriorityLinesSockets');
        this.#apiURI = config.apiURI;

        if (!config?.apiKey) throw ExceptionConstructorMissingParameter('config.apiKey', 'PriorityLinesSockets');
        this.#apiKey = config.apiKey


        // Setting API key for headers
        this.#socketHeaders['X-API-KEY'] = this.#apiKey;

        this.#socketConfig = config.socketConfig ?? {};

        this.#createConnection();
    }

    /**
     * Create te connection
     */
    #createConnection() {

        if (this.#socket) {
            this.#socket.disconnect();
        }

        try {
            this.#socket = io(this.#apiURI, { ...this.#socketConfig, extraHeaders: this.#socketHeaders });
        } catch (err) {
            throw ExceptionSocketIONotImported();
        }

        this.#socket.on('exception', function (data) {
            console.warn('PriorityLinesSockets event: ', data);
        });

        this.#socket.on('disconnect', () => {
            // TODO
        });
    }

    registerToPriorityLineUpdate(callback) {
        this.#socket.on('priority-line-update', callback);
        this.#emit('register-to-priority-line-updates');
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