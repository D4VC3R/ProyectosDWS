<?php

$titulo = "Añadir pueblo";
include_once(DIRECTORIO_TEMPLATE_BACKEND . "head.php");
include_once(DIRECTORIO_TEMPLATE_BACKEND . "hamburger.php");

?>
<body class="d-flex align-items-center py-4 bg-body-tertiary">

<main class="form-signin w-100 m-auto text-center">
  <form action="/village/<?=$village->getId()?>" method="post">
    <a href="/control">
      <img class="mb-1" src="<?= DIRECTORIO_IMG_BACKEND?>userLogin.svg" alt="" width="150" height="97"/>
    </a>
    <h1 class="h3 mb-3 fw-normal">Añadir pueblo</h1>
    <div class="form-floating mb-1">
      <input
          type="text"
          name="name"
          class="form-control"
          id="editVillageName"
          placeholder="Nombre del pueblo"
          value="<?=$village->getName()?>"
          required
      />
      <label for="name">Nombre del Pueblo</label>
    </div>
    <div class="form-floating mb-1">
      <input
          type="text" style="margin-bottom: 0"
          name="region"
          class="form-control"
          id="editVillageRegion"
          placeholder="Region"
          value="<?=$village->getRegion()?>"
          required
      />
      <label for="residence">Región</label>
    </div>
    <div class="form-floating mb-1">
      <input
          type="number"
          name="postal"
          class="form-control"
          id="editVPostalCode"
          placeholder="Código postal"
          value="<?=$village->getPostalCode()?>"
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

<script>

    function peticionPUT(){

        let vName = document.getElementById('editVillageName');
        let vRegion = document.getElementById('editVillageRegion);
        let vPostal = document.getElementById('editVPostalCode');


        const myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");

        const raw = JSON.stringify({
            "name": vName.value,
            "region": vRegion.value,
            "postal": vPostal.value
        });

        const requestOptions = {
            method: "PUT",
            headers: myHeaders,
            body: raw,
            redirect: "follow"
        };

        fetch("http://localhost:8080/user/<?=$village->getId()?>", requestOptions)
            .then((response) => response.text())
            .then((result) => backToVillages())
            .catch((error) => console.error(error));
    }

    function backToVillages(){
        window.location.replace("http://localhost:8080/village")
    }
</script>
</body>
</html>
