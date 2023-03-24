/*****************************************
 *
 *  VIDEO SERVICE
 *
 * @author César Arley Ojeda Escobar
 ****************************************/

import { ExceptionOpenViduNotImported, ExceptionMissingParameter, ExceptionConstructorMissingParameter } from "./exceptions.js";


/**
 * VideoCall service class, this is used to connect to OpenVidu
 */
export default class VideoCall {


    #token;
    
    #OV;
    #session;
    #remoteVideoSelector;
    #localVideoSelector;
    #resolution;
    #publishAudio;
    #publishVideo;

    #publisherGuest;

    /**
     * VideoCall service class, this is used to connect to OpenVidu
     * 
     * @param {Object} config - Configurations for OpenVidu
     * @param {string} config.remoteVideoSelector - Video remote - big
     * @param {string} [config.resolution] - Resolution for LocalVideo
     * @param {boolean} [config.startWithAudio = true] - Start with audio or muted (dafault: true);
     * @param {boolean} [config.startWithVideo = true] - Start with video or dark (default: true);
     * @example
     * 
     * const videoService = new VideoService();
     */
    constructor(config = {}) {
        try {
            this.#OV = new OpenVidu();
            this.#session = this.#OV.initSession();
        } catch (e) {
            throw new ExceptionOpenViduNotImported();
        };

        if (!config.remoteVideoSelector) throw ExceptionConstructorMissingParameter('remoteVideoSelector', 'VideoCall');
        this.#remoteVideoSelector = config.remoteVideoSelector;

        this.#resolution = config.resolution ?? "1280x720";
        this.#publishAudio = typeof config.startWithAudio !== 'undefined' ? config.startWithAudio : true;
        this.#publishVideo = typeof config.startWithVideo !== 'undefined' ? config.startWithVideo : true;
 
        this.#session.on('streamCreated', event => {
            this.#session.subscribe(event.stream, this.#remoteVideoSelector);
        });
    
    }

    /**
     * Register the listener for OpenVidu session disconnected
     *
     * @param {Function} callback - This method is executed after session is disconnected
     */
    registerOnSessionDisconnected(callback) {
        this.#session.on('sessionDisconnected', event => {
            if (typeof callback === 'function') callback(event);
        });
    }

    /**
     * Start connection to session
     *
     * @param {string} token - Token to connect OpenVidu
     * @param {string} localVideoSelector - Video local - little
     * @param {Function} callback - This method is executed after connection is made
     */
    connectVideoCall(token, localVideoSelector, callback) {
        if (!token) throw ExceptionMissingParameter('token', 'connectVideoCall');
        this.#token = token;

        if (!localVideoSelector) throw ExceptionMissingParameter('localVideoSelector', 'connectVideoCall');
        this.#localVideoSelector = localVideoSelector;

        this.#session.connect(this.#token)
        .then(() => {
            this.#publisherGuest = this.#OV.initPublisher(this.#localVideoSelector, {
                audioSource: undefined,             // The source of audio. If undefined default microphone
                videoSource: undefined,             // The source of video. If undefined default webcam
                publishAudio: this.#publishAudio,   // Whether you want to start publishing with your audio unmuted or not
                publishVideo: this.#publishVideo,   // Whether you want to start publishing with your video enabled or not
                resolution: this.#resolution,       // The resolution of your video
                frameRate: 30,			            // The frame rate of your video
                insertMode: 'APPEND',	            // How the video is inserted in the target element 'video-container'
                mirror: false       	            // Whether to mirror your local video or not
            });

            this.#session.publish(this.#publisherGuest);

            if (typeof callback === 'function') callback();
        })
        .catch(error => {
            console.log('There was an error connecting to the session:', error);
        });
    }

    publishVideo(toogle) {
        this.#publisherGuest.publishVideo(toogle);
    }

    publishAudio(toogle) {
        this.#publisherGuest.publishAudio(toogle);
    }
}