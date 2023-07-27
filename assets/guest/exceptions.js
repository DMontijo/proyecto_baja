export function ExceptionSocketIONotImported() {
    
    const error = new Error();
    error.message = `
Socket IO module has not been imported, use:

<script src="https://cdn.socket.io/4.6.0/socket.io.min.js" 
integrity="sha384-c79GN5VsunZvi+Q/WObgk2in0CbZsHnjEqvFxC5DxHn9lTfNce2WW6h2pH6u/kF+"
crossorigin="anonymous"></script>

or look in docs https://socket.io/docs/v4/client-installation/

`;
    error.name = 'ExceptionSocketIONotImported';
    return error;
}

export function ExceptionOpenViduNotImported() {
    const error = new Error();
    error.message = `
    OpenVidu module has not been imported, use:

    <script type="text/javascript" src="./agent/assets/openvidu-browser-2.27.0.min.js"></script>
    `;
    error.name = 'ExceptionOpenViduNotImported';
    return error;
}

export function ExceptionConstructorMissingParameter(valueName, className) {
    const error = new Error();
    error.message = `The class ${className} requires ${valueName} but it was not propertly passed`;
    error.name = 'ExceptionConstructorMissingParameter';
    return error;
}

export function ExceptionMissingParameter(valueName, functionName) {
    const error = new Error();
    error.message = `The function ${functionName} requires ${valueName} but it was not propertly passed`;
    error.name = 'ExceptionMissingParameter';
    return error;
}

export function ExceptionOpenViduSessionNotCreated() {
    const error = new Error();
    error.message = 'OpenVidu session has not been created';
    error.name = 'ExceptionOpenViduSessionNotCreated';
    return error;
}
