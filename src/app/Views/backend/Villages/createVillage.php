<?php

$titulo = "Añadir pueblo";
include_once(DIRECTORIO_TEMPLATE_BACKEND . "head.php");
include_once(DIRECTORIO_TEMPLATE_BACKEND . "hamburger.php");

?>
<body class="d-flex align-items-center py-4 bg-body-tertiary">

<main class="form-signin w-100 m-auto text-center">
  <form action="/village" method="post">
    <a href="/control">
      <img class="mb-1" src="<?= DIRECTORIO_IMG_BACKEND?>userLogin.svg" alt="" width="150" height="97"/>
    </a>
    <h1 class="h3 mb-3 fw-normal">Añadir pueblo</h1>
    <div class="form-floating mb-1">
      <input
          type="text"
          name="name"
          class="form-control"
          id="createName"
          placeholder="Nombre del pueblo"
          required
      />
      <label for="name">Nombre del Pueblo</label>
    </div>
    <div class="form-floating mb-1">
      <input
          type="text" style="margin-bottom: 0"
          name="region"
          class="form-control"
          id="createRegion"
          placeholder="Region"
          required
      />
      <label for="residence">Región</label>
    </div>
    <div class="form-floating mb-1">
      <input
          type="number"
          name="postal"
          class="form-control"
          id="createPostalCode"
          placeholder="Código postal"
          required
      />
      <label for="postalCode">C.P.</label>
    </div>
    <button class="btn btn-success w-100 py-2" type="submit">
      Crear pueblo
    </button>
    <p class="mt-5 mb-3 text-body-secondary">&copy; David Cerdán - 2025</p>
  </form>
</main>
</body>
</html>
