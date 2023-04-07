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

        $("#table-cola").DataTable({
			responsive: false,
			lengthChange: false,
			autoWidth: true,
			ordering: true,
			order: [
				[0, 'asc'],
			],
			searching: true,
			pageLength: 10,
			// dom: 'Bfrtip',
			// buttons: [
			// 	'copy', 'excel', 'pdf'
			// ],
			language: {
				url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-MX.json'
			}
		});

        
		message.classList.add('d-none');
		table.classList.remove('d-none');
		filas.forEach(row => {
			row.remove();
		});
		priorityLists.forEach((cola, i) => {
           
            cola.guests.forEach((dataGuest)=>{
                let fila = document.createElement("tr");

                let td_1 = document.createElement("td");
                td_1.classList.add('text-center');
                let text_1 = document.createTextNode((dataGuest.guest.name).toUpperCase());

                let td_2 = document.createElement("td");
                td_2.classList.add('text-center');
                let text_2 = document.createTextNode(dataGuest.gender);
    
                let td_3 = document.createElement("td");
                td_3.classList.add('text-center');
                let text_3 = document.createTextNode(dataGuest.language);

                
                let td_4 = document.createElement("td");
                td_4.classList.add('text-center');
                let text_4 = document.createTextNode(dataGuest.details.delito);

                
                let td_5 = document.createElement("td");
                td_5.classList.add('text-center');
                let text_5 = document.createTextNode(dataGuest.priority);

                td_1.appendChild(text_1);
                td_2.appendChild(text_2);
                td_3.appendChild(text_3);
                td_4.appendChild(text_4);
                td_5.appendChild(text_5);

                fila.appendChild(td_1);
                fila.appendChild(td_2);
                fila.appendChild(td_3);
                fila.appendChild(td_4);
                fila.appendChild(td_5);

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