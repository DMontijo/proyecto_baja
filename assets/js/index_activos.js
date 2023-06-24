import { RoomsSockets } from "../agent/extras.js";
import { variables } from "./variables.js";
import { PriorityLinesSockets } from "../agent/extras.js";

const { apiKey, apiURI } = variables;

const roomsSockets = new RoomsSockets({ apiURI, apiKey });

const priorityLinesSockets = new PriorityLinesSockets({ apiURI, apiKey });

/**
 * Registra una función callback para ejecutar cuando ocurra una actualización de las salas
 */
roomsSockets.registerToRoomsUpdate(response => {
	// Cuenta el número de usuarios activos (disponibles)
	const countUserActivos = response.filter(i => i.available).length;
	// Cuenta el número de usuarios en llamada (no disponibles)
	const countUsersLlamada = response.filter(i => !i.available).length;

	// Actualiza la interfaz de usuario con el número de usuarios activos y en llamada
	document.getElementById("card_active_users").innerHTML = countUserActivos;
	document.getElementById("card_en_llamada").innerHTML = countUsersLlamada;
});

/**
 * Registra una función callback para ejecutar cuando ocurra una actualización en la línea de prioridad
 */
priorityLinesSockets.registerToPriorityLineUpdate(priorityLists => {
	let countCola = 0;
	// Para cada elemento en la lista de prioridad, suma la longitud de la lista de invitados (guests) al contador
	priorityLists.forEach(element => {
		countCola = countCola + element.guests.length;
	});
	// Actualiza la interfaz de usuario con el número de usuarios en la línea de prioridad
	document.getElementById("lista_prioridad_users").innerHTML = countCola;
});
