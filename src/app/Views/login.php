<?php
$titulo ="Login";
include_once DIR_BACKEND_TEMPLATE . "head.php";
?>

<body>
  <div class="contenedor">
    <form action="/user/login" method="post">
      <fieldset>
        <legend>Iniciar sesión</legend>
        <label for="username">Usuario: </label>
        <input type="text" name="username" id="username" class="formUsername">

        <label for="password">Contraseña: </label>
        <input type="password" name="password" id="password" class="formPswd">
      </fieldset>
      <button type="submit" class="formBtn">Iniciar Sesión</button>
    </form>
      <p> <?php if($error!=null) print_r($error) ; ?> </p>
  </div>



</body>
