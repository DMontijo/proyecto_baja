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
            document.querySelector('#filtrogenero').innerHTML = cola.gender =='MALE' ? 'MASCULINO' : 'FEMENINO';
            document.querySelector('#filtroidioma').innerHTML = cola.language;
            cola.guests.forEach((dataGuest)=>{
                let fila = document.createElement("tr");

                let td_1 = document.createElement("td");
                td_1.classList.add('text-center');
                let text_1 = document.createTextNode((dataGuest.guest.name).toUpperCase());
                let td_2 = document.createElement("td");
                td_2.classList.add('text-center');
                let text_2 = document.createTextNode(dataGuest.priority);
                td_2.classList.add('font-weight-bold');
                td_2.classList.add('text-success');
    
                td_1.appendChild(text_1);
                td_2.appendChild(text_2);
                fila.appendChild(td_1);
                fila.appendChild(td_2);
                tbody.appendChild(fila);
            })
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