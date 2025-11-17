<?php
$titulo = "Detalles de Usuario";
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
            <h3>Detalles del Usuario</h3>
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
                    <h4><?= $usuario->getUsername() ?></h4>
                    <hr>
                    <p><strong>Email:</strong> <?= $usuario->getEmail() ?></p>
                    <!-- El uuid pasa a string automaticamente porque está dentro de la etiqueta <code> -->
                    <p><strong>UUID:</strong> <code><?= $usuario->getUuid() ?></code></p>
                    <p><strong>Edad:</strong> <?= $usuario->getEdad() ?> años</p>
                    <?php
                    $badgeClass = match($usuario->getType()->name) {
                        'NORMAL' => 'bg-primary',
                        'ANUNCIOS' => 'bg-warning',
                        'PREMIUM' => 'bg-success',
                        default => 'bg-secondary'
                    };
                    ?>
                    <p><strong>Tipo:</strong> <span class="badge <?= $badgeClass ?>"><?= $usuario->getType()->name ?></span></p>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <div>
                <a href="/user" class="btn btn-secondary me-2">Volver</a>
                <a href="/user/<?= $usuario->getUuid() ?>/edit" class="btn btn-warning">Editar</a>
            </div>
            <form action="/user/<?= $usuario->getUuid() ?>" method="post" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');" class="m-0">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
    </div>
</div>


<?php
include_once(DIRECTORIO_TEMPLATE_BACKEND . "footer.php");
?>
