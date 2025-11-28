<?php
$titulo = "Añadir usuario";
$tituloSeccion = "Creación de usuarios";
include_once DIR_BACKEND_TEMPLATE . "head.php";
include_once DIR_BACKEND_TEMPLATE . "header.php";
include_once DIR_BACKEND_TEMPLATE . "aside.php";
include_once DIR_BACKEND_TEMPLATE . "main.php";
?>

<form action="/user" method="post">
  <fieldset>
    <legend>Datos</legend>
    <label for="createName">Username: </label>
    <input type="text" name="username" id="createName" class="formUsername">
    <label for="createEmail">Email:</label>
    <input type="email" name="email" id="createEmail" class="formEmail">
    <label for="createPswd">Contraseña: </label>
    <input type="password" name="password" id="createPswd" class="formPswd">
    <label for="createType">Tipo de usuario: </label>
    <select id="createType" name="type">
      <option value="NORMAL" selected>Normal</option>
      <option value="PREMIUM">Premium</option>
      <option value="ADMIN">Administrador</option>
    </select>
  </fieldset>
  <button type="submit" class="formBtn">Crear</button>




</form>



















<?php
include_once DIR_BACKEND_TEMPLATE . "footer.php";