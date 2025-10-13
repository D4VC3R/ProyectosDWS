<?php
$tituloSeccion = "Añadir Película";
$titulo = "Añadir Película";
include_once(DIRECTORIO_TEMPLATE_ADMIN."head.php");
include_once(DIRECTORIO_TEMPLATE_ADMIN."header.php");
include_once (DIRECTORIO_TEMPLATE_ADMIN."aside.php");
include_once (DIRECTORIO_TEMPLATE_ADMIN."main.php");
include_once(DIRECTORIO_TEMPLATE_ADMIN."hamburger.php");
?>

    <form action="/pelicula" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="FormControlInputTitulo" class="form-label">Titulo</label>
            <input type="text" class="form-control" name="titulo" id="FormControlInputTitulo" placeholder="Introduce el título">
        </div>
        <div class="mb-3">
            <label for="FormControlInputFecha" class="form-label">Fecha de estreno</label>
            <input type="date" class="form-control" name="fecha_estreno" id="FormControlInputFecha" >
        </div>
        <div class="mb-3">
            <label for="FormControlSelectGenero" class="form-label">Género</label>
            <select class="form-select" name="genero" id="FormControlSelectGenero" aria-label="Default select example">
                <option selected value="accion">Acción</option>
                <option value="drama">Drama</option>
                <option value="comedia">Comedia</option>
                <option value="terror">Terror</option>
                <option value="cienciaFiccion">Fantasía</option>
                <option value="animación">Animación</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="FormControlInputTitulo" class="form-label">Descripción</label>
            <input type="text" class="form-control" name="titulo" id="FormControlInputDescripcion" placeholder="Descripción breve">
        </div>
        <div class="mb-3">
            <fieldset name="idomas">
                <legend>Lenguajes Disponibles</legend>
                <div class="form-check">
                    <input class="form-check-input" name="idiomas[]" type="checkbox" value="español" id="checkEspañol">
                    <label class="form-check-label" for="checkEspañol">
                        Español
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="idiomas[]" type="checkbox" value="ingles" id="checkIngles" checked>
                    <label class="form-check-label" for="checkIngles">
                        Ingles
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="idiomas[]" type="checkbox" value="frances" id="checkDefault">
                    <label class="form-check-label" for="checkFrances">
                        Frances
                    </label>
                </div>
            </fieldset>

        </div>
        <div class="mb-3">
            <label class="form-label" for="FormControlFilePoster">Poster de la película</label>
            <input type="file" name="poster" id="FormControlFilePoster">
        </div>

        <div class="mb-3">
            <input type="submit" value="Enviar">
        </div>

    </form>








<?php
include_once(DIRECTORIO_TEMPLATE_ADMIN."footer.php");
