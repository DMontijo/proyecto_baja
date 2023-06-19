<div class="row text-center mt-3">
	<p> <span class="fw-bold">Coloca tu firma en el recuadro inferior</span><span class="asterisco-rojo">*</span>
		<br>Debe ser la misma que se encuentra en tu INE.
	</p>
	<div class="col-12">
		<button type="button" class="btn btn-secondary mb-3" id="crear_firma" hidden>Subir firma</button>
		<button type="button" class="btn btn-secondary mb-3" id="limpiar_firma"><i class="bi bi-eraser-fill"></i> Limpiar firma</button>
	</div>
	<div class="col-12">
		<canvas id="trazo_firma" width="300" height="300">
			Tu navegador no es compatible con la firma electrónica, debes abrirla chrome o microsoft edge.
		</canvas>
	</div>
	<div class="col-12">
		<textarea id="firma_url" name="firma_url" class="form-control" hidden required></textarea>
		<div class="invalid-feedback">
			Debes agregar tu firma para poder avanzar.
		</div>
	</div>
</div>
<script>
	(function() {
		/**
		 *  Se define la función requestAnimFrame como una función que utiliza diferentes implementaciones de requestAnimationFrame según la disponibilidad del navegador.
		 * 	Si el navegador no admite requestAnimationFrame, se verifica si existen otras implementaciones compatibles como webkitRequestAnimationFrame, mozRequestAnimationFrame, oRequestAnimationFrame, msRequestAnimationFrame.
		 * Si ninguna de estas implementaciones está disponible, se utiliza setTimeout con una duración de tiempo aproximada de 1 segundo dividida por 60 (aproximadamente 60 cuadros por segundo).
		 */

		window.requestAnimFrame = (function(callback) {
			return window.requestAnimationFrame ||
				window.webkitRequestAnimationFrame ||
				window.mozRequestAnimationFrame ||
				window.oRequestAnimationFrame ||
				window.msRequestAnimaitonFrame ||
				function(callback) {
					window.setTimeout(callback, 1000 / 60);
				};
		})();

		let canvas = document.getElementById("trazo_firma");
		let ctx = canvas.getContext("2d");

		let drawText = document.getElementById("firma_url");
		let drawImage = document.getElementById("firma_imagen");
		let clearBtn = document.getElementById("limpiar_firma");
		let submitBtn = document.getElementById("crear_firma");
		//Brrar el lienzo.

		clearBtn.addEventListener("click", function(e) {
			clearCanvas();
			drawText.innerHTML = '';
		}, false);
		//Obtiene la representación en formato de URL de los datos del lienzo.

		submitBtn.addEventListener("click", function(e) {
			canvas.fillStyle = "rgba(0,0,0,.4)";
			let dataUrl = canvas.toDataURL();
			drawText.innerHTML = dataUrl;
		}, false);

		let drawing = false;
		let mousePos = {
			x: 0,
			y: 0
		};
		let lastPos = mousePos;
		// Obtiene la posición del ratón en relación al lienzo

		canvas.addEventListener("mousedown", function(e) {
			let tint = '#000000';
			let punta = 3;
			drawing = true;
			lastPos = getMousePos(canvas, e);
		}, false);
		//Obtiene la representación en formato de URL de los datos del lienzo

		canvas.addEventListener("mouseup", function(e) {
			drawing = false;
			canvas.fillStyle = "rgba(0,0,0,.4)";
			let dataUrl = canvas.toDataURL();
			drawText.innerHTML = dataUrl;
		}, false);
		// Cuando el puntero del ratón sale del área del lienzo

		canvas.addEventListener("mousemove", function(e) {
			mousePos = getMousePos(canvas, e);
		}, false);
		// Cuando el puntero del ratón se mueve dentro del área del lienzo, se ejecuta una función que actualiza la variable mousePos con la posición actual d

		canvas.addEventListener("mouseout", function(e) {
			drawing = false;
			canvas.fillStyle = "rgba(0,0,0,.4)";
			let dataUrl = canvas.toDataURL();
			drawText.innerHTML = dataUrl;
		}, false);
		//Cuando se detecta un toque en el lienzo

		canvas.addEventListener("touchstart", function(e) {
			mousePos = getTouchPos(canvas, e);
			e.preventDefault();
			let touch = e.touches[0];
			let mouseEvent = new MouseEvent("mousedown", {
				clientX: touch.clientX,
				clientY: touch.clientY
			});
			canvas.dispatchEvent(mouseEvent);
		}, false);
		//Cuando se detecta el final de un toque en el lienzo

		canvas.addEventListener("touchend", function(e) {
			e.preventDefault();
			let mouseEvent = new MouseEvent("mouseup", {});
			canvas.dispatchEvent(mouseEvent);
		}, false);
		//Cuando el puntero táctil se mueve fuera del área del lienzo

		canvas.addEventListener("touchleave", function(e) {
			e.preventDefault();
			let mouseEvent = new MouseEvent("mouseup", {});
			canvas.dispatchEvent(mouseEvent);
		}, false);
		//Cuando el puntero táctil se mueve dentro del área del lienzo

		canvas.addEventListener("touchmove", function(e) {
			e.preventDefault();
			let touch = e.touches[0];
			let mouseEvent = new MouseEvent("mousemove", {
				clientX: touch.clientX,
				clientY: touch.clientY
			});
			canvas.dispatchEvent(mouseEvent);
		}, false);
		//Funcion para obtener la posición del ratón en relación con el lienzo.

		function getMousePos(canvasDom, mouseEvent) {
			let rect = canvasDom.getBoundingClientRect();
			return {
				x: mouseEvent.clientX - rect.left,
				y: mouseEvent.clientY - rect.top
			};
		}
		//Funcion para obtener la posición del toque en relación con el lienzo.

		function getTouchPos(canvasDom, touchEvent) {
			let rect = canvasDom.getBoundingClientRect();
			return {
				x: touchEvent.touches[0].clientX - rect.left,
				y: touchEvent.touches[0].clientY - rect.top
			};
		}
		//Funcion que se encarga de dibujar en el lienzo

		function renderCanvas() {
			if (drawing) {
				let tint = '#000000';
				let punta = 3;
				ctx.strokeStyle = tint.value;
				ctx.beginPath();
				ctx.moveTo(lastPos.x, lastPos.y);
				ctx.lineTo(mousePos.x, mousePos.y);
				ctx.lineWidth = punta.value;
				ctx.stroke();
				ctx.closePath();
				lastPos = mousePos;
			}
		}
		//Funcion que borra todo el contenido del lienzo

		function clearCanvas() {
			canvas.width = canvas.width;
		}
		//Funcion para actualizar el lienzo en cada cuadro de animación.

		(function drawLoop() {
			requestAnimFrame(drawLoop);
			renderCanvas();
		})();

	})();
</script>