<div class="contenedor">

    <div class="row">
        <p class="display-4">Coloca tu firma en el recueadro inferior</p>
        <p>Debe ser la misma que se encuentra en tu INE.</p>
        <div class="col-md-12">
            <canvas id="draw-canvas" width="300" height="300">
                No tienes un buen navegador.
            </canvas>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- <input type="button" class="button" id="draw-submitBtn" value="Crear Imagen"></input> -->
            <input type="button" class="button" id="draw-clearBtn" value="Borrar Canvas"></input>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <textarea id="draw-dataUrl" class="form-control" rows="5">Para los que saben que es esto:</textarea>
        </div>
    </div>

    <div class="contenedor">
        <div class="col-md-12">
            <img id="draw-image" src="" alt="Tu Imagen aparecera Aqui!" />
        </div>
    </div>
</div>