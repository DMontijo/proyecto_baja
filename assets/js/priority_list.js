import { PriorityLinesSockets } from '../agent/extras.js';
import { variables } from './variables.js';

const { apiKey, apiURI } = variables;

const priorityLinesSockets = new PriorityLinesSockets( { apiURI, apiKey });

priorityLinesSockets.registerToPriorityLineUpdate((priorityLists) => {
    console.log(priorityLists);

    let message = document.querySelector("#message");
	let table = document.querySelector("#table-cola");
	let tbody = document.querySelector("#table-cola tbody");
	let filas = document.querySelectorAll("#table-cola tbody tr");
	const count = priorityLists.filter(i => i).length;

	console.log(count);
	
	if (count >= 1) {
		message.classList.add('d-none');
		table.classList.remove('d-none');
		filas.forEach(row => {
			row.remove();
		});
		priorityLists.forEach((cola, i) => {
		console.log(cola);
		});
	} else {
		message.classList.remove('d-none');
		table.classList.add('d-none');
		filas.forEach(row => {
			row.remove();
		});
	}


})