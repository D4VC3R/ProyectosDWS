<?php

namespace App\Controller;

use App\Interface\ControllerInterface;

class MovieController implements ControllerInterface
{

    function index()
    {

    }

    function show($id)
    {

    }

    function store()
    {

    }

    function update($id)
    {

    }

    function destroy($id)
    {

    }

    function create()
    {
    include_once DIRECTORIO_VISTAS_BACKEND."Movie/addPelicula.php";
    }

    function edit($id)
    {

    }
}