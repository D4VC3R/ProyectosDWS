<?php
$tituloSeccion = "Añadir Película";
$titulo = "Añadir Película";
include_once(DIRECTORIO_TEMPLATE_ADMIN."head.php");
include_once(DIRECTORIO_TEMPLATE_ADMIN."header.php");
include_once (DIRECTORIO_TEMPLATE_ADMIN."aside.php");
include_once (DIRECTORIO_TEMPLATE_ADMIN."main.php");
include_once(DIRECTORIO_TEMPLATE_ADMIN."hamburger.php");
?>

<form action = "/pelicula" method="post">
  <div class="mb-3">
    <label for="FormControlInputTitulo" class="form-label">Título</label>
      <input type="text" class="form-control" name="titulo" id="FormControlInputTitulo" placeholder="Título">
  </div>
    <div class="mb-3">
        <label for="FormControlInputFecha" class="form-label">Fecha de estreno</label>
        <input type="date" class="form-control" name="fechaEstreno" id="FormControlInputFecha" placeholder="Fecha de estreno">
    </div>
    <div class="mb-3">
        <label for="FormControlSelectGenero" class = "form-label">Género</label>
        <select class="custom-select" aria-label="Default select example" name="genero" id="FormControlSelectGenero">
            <option selected>Acción</option>
            <option value="comedia">Comedia</option>
            <option value="drama">Drama</option>
            <option value="fantasia">Fantasía</option>
        </select>
    </div>
    <div class="mb-3">
        <input type="submit" value="Enviar">
    </div>
</form>








<?php
include_once(DIRECTORIO_TEMPLATE_ADMIN."footer.php");
