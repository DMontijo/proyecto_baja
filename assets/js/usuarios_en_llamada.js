import { RoomsSockets } from "../agent/extras.js";
import { variables } from './variables.js';

const { apiKey, apiURI } = variables;

const roomsSockets = new RoomsSockets({ apiURI, apiKey });

roomsSockets.registerToRoomsUpdate((response) => {
	let message = document.querySelector("#message");
	let table = document.querySelector("#table-usuarios-en-llamada");
	let tbody = document.querySelector("#table-usuarios-en-llamada tbody");
	let filas = document.querySelectorAll("#table-usuarios-en-llamada tbody tr");
	let texto_activo = '';
	const usuarios = response.filter(i => !(i.available));

	if (usuarios.length >= 1) {
		message.classList.add('d-none');
		table.classList.remove('d-none');
		filas.forEach(row => {
			row.remove();
		});
		usuarios.forEach((user, i) => {
			let fila = document.createElement("tr");

			let td_1 = document.createElement("td");
			let text_1 = document.createTextNode((user.host.agent.names + ' ' + user.host.agent.lastnames).toUpperCase());
			let td_2 = document.createElement("td");
			let text_2 = document.createTextNode('EN LLAMADA');
			let td_3 = document.createElement("td");
			let text_3 = document.createTextNode(user.users[0].guest.name);
			td_1.classList.add('text-center');
			td_2.classList.add('text-center');
			td_2.classList.add('text-danger');
			td_2.classList.add('font-weight-bold');
			td_3.classList.add('text-center');
			td_1.appendChild(text_1);
			td_2.appendChild(text_2);
			td_3.appendChild(text_3);
			fila.appendChild(td_1);
			fila.appendChild(td_2);
			fila.appendChild(td_3);
			tbody.appendChild(fila);
		});
	} else {
		message.classList.remove('d-none');
		table.classList.add('d-none');
		filas.forEach(row => {
			row.remove();
		});
	}
})
