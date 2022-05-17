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
		<textarea id="firma_url" class="form-control" rows="2" required hidden></textarea>
		<div class="invalid-feedback">
			Debes agregar tu firma para poder avanzar.
		</div>
	</div>
</div>
<script>
	(function() {
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

		clearBtn.addEventListener("click", function(e) {
			clearCanvas();
			drawText.innerHTML = '';
		}, false);

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

		canvas.addEventListener("mousedown", function(e) {
			let tint = '#000000';
			let punta = 3;
			drawing = true;
			lastPos = getMousePos(canvas, e);
		}, false);

		canvas.addEventListener("mouseup", function(e) {
			drawing = false;
			console.log('mouse levantado')
			canvas.fillStyle = "rgba(0,0,0,.4)";
			let dataUrl = canvas.toDataURL();
			drawText.innerHTML = dataUrl;
		}, false);

		canvas.addEventListener("mousemove", function(e) {
			mousePos = getMousePos(canvas, e);
		}, false);

		canvas.addEventListener("touchstart", function(e) {
			mousePos = getTouchPos(canvas, e);
			console.log(mousePos);
			e.preventDefault();
			let touch = e.touches[0];
			let mouseEvent = new MouseEvent("mousedown", {
				clientX: touch.clientX,
				clientY: touch.clientY
			});
			canvas.dispatchEvent(mouseEvent);
		}, false);

		canvas.addEventListener("touchend", function(e) {
			e.preventDefault();
			let mouseEvent = new MouseEvent("mouseup", {});
			canvas.dispatchEvent(mouseEvent);
		}, false);

		canvas.addEventListener("touchleave", function(e) {
			e.preventDefault();
			let mouseEvent = new MouseEvent("mouseup", {});
			canvas.dispatchEvent(mouseEvent);
		}, false);

		canvas.addEventListener("touchmove", function(e) {
			e.preventDefault();
			let touch = e.touches[0];
			let mouseEvent = new MouseEvent("mousemove", {
				clientX: touch.clientX,
				clientY: touch.clientY
			});
			canvas.dispatchEvent(mouseEvent);
		}, false);

		function getMousePos(canvasDom, mouseEvent) {
			let rect = canvasDom.getBoundingClientRect();
			return {
				x: mouseEvent.clientX - rect.left,
				y: mouseEvent.clientY - rect.top
			};
		}

		function getTouchPos(canvasDom, touchEvent) {
			let rect = canvasDom.getBoundingClientRect();
			console.log(touchEvent);
			return {
				x: touchEvent.touches[0].clientX - rect.left,
				y: touchEvent.touches[0].clientY - rect.top
			};
		}

		function renderCanvas() {
			if (drawing) {
				let tint = '#000000';
				let punta = 3;
				ctx.strokeStyle = tint.value;
				ctx.beginPath();
				ctx.moveTo(lastPos.x, lastPos.y);
				ctx.lineTo(mousePos.x, mousePos.y);
				console.log(punta.value);
				ctx.lineWidth = punta.value;
				ctx.stroke();
				ctx.closePath();
				lastPos = mousePos;
			}
		}

		function clearCanvas() {
			canvas.width = canvas.width;
		}

		(function drawLoop() {
			requestAnimFrame(drawLoop);
			renderCanvas();
		})();

	})();
</script>
