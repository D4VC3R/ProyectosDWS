<?php

namespace App\Controller;

use App\Class\User;
use App\Interface\ControllerInterface;
use App\Model\UserModel;
use Ramsey\Uuid\Uuid;
use Respect\Validation\Validator as v;

class UserController implements ControllerInterface
{
    function index()
    {
        $usuarios = UserModel::getAllUsers();

        foreach ($usuarios as $usuario) {
            echo json_encode($usuario);
        }

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