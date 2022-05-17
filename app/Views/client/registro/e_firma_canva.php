<div class="row text-center mt-3">
	<p> <span class="fw-bold">Coloca tu firma en el recuadro inferior</span><span class="asterisco-rojo">*</span>
		<br>Debe ser la misma que se encuentra en tu INE.
	</p>
	<div class="col-12">
		<button type="button" class="btn btn-secondary mb-3" id="crear_firma" hidden>Subir firma</button>
		<button type="button" class="btn btn-secondary mb-3" id="limpiar_firma">Borrar firma</button>
	</div>
	<div class="col-12">
		<canvas id="trazo_firma" width="300" height="300">
			Tu navegador no es compatible con la firma electrónica, debes abrirla chrome o microsoft edge.
		</canvas>
	</div>
	<div class="col-12">
		<textarea id="firma_url" hidden class="form-control" rows="2" required></textarea>
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

		var canvas = document.getElementById("trazo_firma");
		var ctx = canvas.getContext("2d");

		var drawText = document.getElementById("firma_url");
		var drawImage = document.getElementById("firma_imagen");
		var clearBtn = document.getElementById("limpiar_firma");
		var submitBtn = document.getElementById("crear_firma");

		clearBtn.addEventListener("click", function(e) {
			clearCanvas();
			drawImage.setAttribute("src", "");
		}, false);

		submitBtn.addEventListener("click", function(e) {
			console.log('Click en subir');
			canvas.fillStyle = "rgba(0,0,0,.4)";
			var dataUrl = canvas.toDataURL();
			drawText.innerHTML = dataUrl;
			// drawImage.setAttribute("src", dataUrl);
			document.getElementById("imgFirma").setAttribute("src", dataUrl);
		}, false);

		var drawing = false;
		var mousePos = {
			x: 0,
			y: 0
		};
		var lastPos = mousePos;

		canvas.addEventListener("mousedown", function(e) {
			var tint = '#000000';
			var punta = 3;
			console.log(e);
			drawing = true;
			lastPos = getMousePos(canvas, e);
		}, false);

		canvas.addEventListener("mouseup", function(e) {
			drawing = false;
		}, false);

		canvas.addEventListener("mousemove", function(e) {
			mousePos = getMousePos(canvas, e);
		}, false);

		canvas.addEventListener("touchstart", function(e) {
			mousePos = getTouchPos(canvas, e);
			console.log(mousePos);
			e.preventDefault();
			var touch = e.touches[0];
			var mouseEvent = new MouseEvent("mousedown", {
				clientX: touch.clientX,
				clientY: touch.clientY
			});
			canvas.dispatchEvent(mouseEvent);
		}, false);

		canvas.addEventListener("touchend", function(e) {
			e.preventDefault();
			var mouseEvent = new MouseEvent("mouseup", {});
			canvas.dispatchEvent(mouseEvent);
		}, false);

		canvas.addEventListener("touchleave", function(e) {
			e.preventDefault();
			var mouseEvent = new MouseEvent("mouseup", {});
			canvas.dispatchEvent(mouseEvent);
		}, false);

		canvas.addEventListener("touchmove", function(e) {
			e.preventDefault();
			var touch = e.touches[0];
			var mouseEvent = new MouseEvent("mousemove", {
				clientX: touch.clientX,
				clientY: touch.clientY
			});
			canvas.dispatchEvent(mouseEvent);
		}, false);

		function getMousePos(canvasDom, mouseEvent) {
			var rect = canvasDom.getBoundingClientRect();
			return {
				x: mouseEvent.clientX - rect.left,
				y: mouseEvent.clientY - rect.top
			};
		}

		function getTouchPos(canvasDom, touchEvent) {
			var rect = canvasDom.getBoundingClientRect();
			console.log(touchEvent);
			return {
				x: touchEvent.touches[0].clientX - rect.left,
				y: touchEvent.touches[0].clientY - rect.top
			};
		}

		function renderCanvas() {
			if (drawing) {
				var tint = '#000000';
				var punta = 3;
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
