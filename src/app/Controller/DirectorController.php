<?php

namespace App\Controller;

use App\Interface\ControllerInterface;

class DirectorController implements ControllerInterface
{

    function index()
    {
        return "Los directores son: ";
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
        return "Voy a destruir el director con id $id";
    }

    function create()
    {

    }

    function edit($id)
    {

    }
}