<?php

namespace App\Controller;

use App\Interface\ControllerInterface;

class UserController implements ControllerInterface
{
    function index()
    {
        return "Hola";
    }

    function show($id)
    {
        return "Estos son los datos del usuario $id";
    }

    function store()
    {
        var_dump($_POST);
    }

    function update($id)
    {

    }

    function destroy($id)
    {

    }

    function create()
    {

    }

    function edit($id)
    {

    }
}