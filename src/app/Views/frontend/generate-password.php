<?php
$titulo = "Generar Contraseña";
include DIRECTORIO_TEMPLATE_FRONTEND."head.php";
include DIRECTORIO_TEMPLATE_FRONTEND."header.php";
include DIRECTORIO_TEMPLATE_FRONTEND."subheader.php";
?>
<!--HTML personalizado para mi página-->
<div class="texto">
    <h1>Generador de constraseñas</h1>
    <?= generarPassword(12,true,true,true);?>
</div>

<?php
include DIRECTORIO_TEMPLATE_FRONTEND."footer.php";
