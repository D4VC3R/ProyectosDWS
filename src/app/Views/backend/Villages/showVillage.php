<?php
$titulo = "Detalles de " . $village->getName();
$tituloSeccion = "Detalles";
include_once(DIRECTORIO_TEMPLATE_BACKEND . "head.php");
include_once(DIRECTORIO_TEMPLATE_BACKEND . "header.php");
include_once(DIRECTORIO_TEMPLATE_BACKEND . "aside.php");
include_once(DIRECTORIO_TEMPLATE_BACKEND . "main.php");
include_once(DIRECTORIO_TEMPLATE_BACKEND . "hamburger.php");
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Detalles</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="<?= DIRECTORIO_IMG_BACKEND ?>user.png"
                         class="img-thumbnail"
                         alt="Avatar"
                         style="max-width: 200px;">
                </div>
                <div class="col-md-8">
                    <h4><?= $village->getName() ?></h4>
                    <hr>
                    <p><strong>Región:</strong> <?= $village->getRegion() ?></p>
                    <!-- El uuid pasa a string automaticamente porque está dentro de la etiqueta <code> -->
                    <p><strong>C.P.:</strong> <code><?= $village->getPostalCode() ?></code></p>
                    <p><strong>Coordenadas:</strong> <?= $$village->getCoordinates() ?> años</p>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <div>
                <a href="/village" class="btn btn-secondary me-2">Volver</a>
                <a href="/user/<?= $village->getId() ?>/edit" class="btn btn-warning">Editar</a>
            </div>
            <form action="/user/<?= $village->getId() ?>"
                  method="post"
                  onsubmit="return confirm('¿Estás seguro de eliminar este pueblo?');"
                  class="m-0">
                <button type="submit"
                        class="btn btn-danger"
                >
                    Eliminar
                </button>
            </form>
        </div>
    </div>
</div>


<?php
include_once(DIRECTORIO_TEMPLATE_BACKEND . "footer.php");
?>
