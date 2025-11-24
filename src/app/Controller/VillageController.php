<?php

namespace App\Controller;

use App\Interface\ControllerInterface;

class VillageController implements ControllerInterface
{

  function index()
  {
      include_once DIRECTORIO_VISTAS_BACKEND . "Villages/allVillages.php";
  }

  function show($id)
  {
    include_once DIRECTORIO_VISTAS_BACKEND . "Villages/showVillage.php";
  }

  function store()
  {
    // TODO: Implement store() method.
  }

  function update($id)
  {
    // TODO: Implement update() method.
  }

  function destroy($id)
  {
    // TODO: Implement destroy() method.
  }

  function create()
  {
    include_once DIRECTORIO_VISTAS_BACKEND . "Villages/createVillage.php";
  }

  function edit($id)
  {
    include_once DIRECTORIO_VISTAS_BACKEND . "Villages/editVillage.php";
  }
}