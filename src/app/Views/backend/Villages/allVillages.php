<?php
$titulo="Administración";
$tituloSeccion="Localidades.";
include_once(DIRECTORIO_TEMPLATE_BACKEND."head.php");
include_once(DIRECTORIO_TEMPLATE_BACKEND."header.php");
include_once (DIRECTORIO_TEMPLATE_BACKEND."aside.php");
include_once (DIRECTORIO_TEMPLATE_BACKEND."main.php");
include_once(DIRECTORIO_TEMPLATE_BACKEND."hamburger.php");
?>
  <div class="row">
    <?php
    foreach($villages as $residence){
      ?>
      <div class="card m-1" style="width: 18rem;">
        <img src="<?=DIRECTORIO_IMG_BACKEND?>village.png" class="card-img-top" alt="village">
        <div class="card-body">
          <h5 class="card-title"><?=$residence->getName()?></h5>
          <p class="card-text"><?=$residence->getPostalCode()?></p>
          <p class="card-text"><?=$residence->getRegion()?></p>
          <a href="/user/<?=$residence->getId()?>" class="btn btn-primary">Detalles</a>
        </div>
      </div>
      <?php
    }
    ?>
  </div>
<?php
include_once(DIRECTORIO_TEMPLATE_BACKEND."footer.php");
?>