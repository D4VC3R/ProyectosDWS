<?php
$titulo = "Detalles de usuario";
$tituloSeccion = $usuario->getUsername();
include_once DIR_BACKEND_TEMPLATE . "head.php";
include_once DIR_BACKEND_TEMPLATE . "header.php";
include_once DIR_BACKEND_TEMPLATE . "aside.php";
include_once DIR_BACKEND_TEMPLATE . "main.php";
?>

	<div class="userCard">
		<p>ID: <?=$usuario->getUuid()?></p>
		<h5>Nombre de usuario: <?=$usuario->getUsername()?></h5>
		<p>Email: <?=$usuario->getEmail()?></p>
		<p>Tipo de usuario: <?=$usuario->getType()->name?></p>
		<button onclick="">Editar</button>
		<button onclick="">Borrar</button>
	</div>


















<?php
include_once DIR_BACKEND_TEMPLATE . "footer.php";