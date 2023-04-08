import { RoomsSockets } from "../agent/extras.js";
import { variables } from './variables.js';

const { apiKey, apiURI } = variables;

const roomsSockets = new RoomsSockets( { apiURI, apiKey });

roomsSockets.registerToRoomsUpdate((response)=>{
	let message = document.querySelector("#message");
	let table = document.querySelector("#table-usuarios-activos");
	let tbody = document.querySelector("#table-usuarios-activos tbody");
	let filas = document.querySelectorAll("#table-usuarios-activos tbody tr");
	const count = response.filter(i => i).length;

	console.log(count);
	
	if (count >= 1) {
		message.classList.add('d-none');
		table.classList.remove('d-none');
		filas.forEach(row => {
			row.remove();
		});
		response.forEach((user, i) => {
			let fila = document.createElement("tr");

			let td_1 = document.createElement("td");
			td_1.classList.add('text-center');
			let text_1 = document.createTextNode((user.host.agent.names + ' ' + user.host.agent.lastnames).toUpperCase());
			let td_2 = document.createElement("td");
			td_2.classList.add('text-center');
			let texto_activo = 'ACTIVO  - DISPONIBLE';
			let text_2 = document.createTextNode(texto_activo);
			td_2.classList.add('font-weight-bold');
			td_2.classList.add('text-success');

			td_1.appendChild(text_1);
			td_2.appendChild(text_2);
			fila.appendChild(td_1);
			fila.appendChild(td_2);
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
