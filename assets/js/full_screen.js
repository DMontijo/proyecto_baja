"use strict";

/**
 * Función para cambiar entre pantalla completa o normal
 */
function toggleFullScreen() {
	// Comprueba si el documento está actualmente en modo de pantalla completa.
	if (
		(document.fullScreenElement && document.fullScreenElement !== null) || // Standard
		(!document.mozFullScreen && !document.webkitIsFullScreen) // Firefox y Chrome/Safari
	) {
		// Si el documento no está en modo de pantalla completa, trata de cambiar a modo de pantalla completa.
		if (document.documentElement.requestFullScreen) {
			// Standard
			document.documentElement.requestFullScreen();
		} else if (document.documentElement.mozRequestFullScreen) {
			// Firefox
			document.documentElement.mozRequestFullScreen();
		} else if (document.documentElement.webkitRequestFullScreen) {
			// Chrome/Safari
			document.documentElement.webkitRequestFullScreen(
				Element.ALLOW_KEYBOARD_INPUT // Permite la entrada del teclado en modo de pantalla completa.
			);
		}
	} else {
		// Si el documento está en modo de pantalla completa, trata de salir de ese modo.
		if (document.cancelFullScreen) {
			// Standard
			document.cancelFullScreen();
		} else if (document.mozCancelFullScreen) {
			// Firefox
			document.mozCancelFullScreen();
		} else if (document.webkitCancelFullScreen) {
			// Chrome/Safari
			document.webkitCancelFullScreen();
		}
	}
}
