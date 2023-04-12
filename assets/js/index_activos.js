import { RoomsSockets } from "../agent/extras.js";
import { variables } from "./variables.js";
import { PriorityLinesSockets } from "../agent/extras.js";

const { apiKey, apiURI } = variables;

const roomsSockets = new RoomsSockets({ apiURI, apiKey });

const priorityLinesSockets = new PriorityLinesSockets({ apiURI, apiKey });

roomsSockets.registerToRoomsUpdate(response => {
	const countUser = response.filter(i => i.available).length;

	document.getElementById("card_active_users").innerHTML = countUser;
});

priorityLinesSockets.registerToPriorityLineUpdate(priorityLists => {
	let countCola = 0;
	priorityLists.forEach(element => {
		countCola = countCola + element.guests.length;
	});
	document.getElementById("lista_prioridad_users").innerHTML = countCola;
});
