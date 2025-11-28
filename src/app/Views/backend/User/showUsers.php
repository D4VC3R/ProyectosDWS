<?php
$titulo = "Lista de usuarios";
$tituloSeccion = "Todos los usuarios";
include_once DIR_BACKEND_TEMPLATE . "head.php";
include_once DIR_BACKEND_TEMPLATE . "header.php";
include_once DIR_BACKEND_TEMPLATE . "aside.php";
include_once DIR_BACKEND_TEMPLATE . "main.php";
?>

  <div class="userPreviewContainer">
      <a href="user/create">Añadir usuario</a>
    <div class="userPreview">

      <?php
if (!$usuarios==null){
foreach ($usuarios as $usuario){
  ?>
      <div class="userCard">
        <h5><?=$usuario->getUsername()?></h5>
        <p><?=$usuario->getEmail()?></p>
        <p><?=$usuario->getUuid()?></p>
        <p><?=$usuario->getType()->name?></p>
        <a href="user/<?=$usuario->getUuid()?>">Detalles</a>
      </div>

    <?php
}
}
?>
    </div>
  </div>
<?php
include_once DIR_BACKEND_TEMPLATE . "footer.php";