<?php

namespace App\Controller;

use App\Class\User;
use App\Interface\ControllerInterface;
use App\Model\UserModel;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

class UserController implements ControllerInterface
{
    function index()
    {
        $usuarios = UserModel::getAllUsers();

        include_once DIRECTORIO_VISTAS_BACKEND."User/allusers.php";

    }

    function show($id)
    {
        return "Estos son los datos del usuario $id";
    }

    function store()
    {
        var_dump(User::validateUserCreation($_POST));
    }

    function update($id)
    {
        echo $id;

        parse_str(file_get_contents("php://input"),$editData);
        $editData["uuid"] = $id;
        $usuario = User::validateUserEdit($editData);
        var_dump($editData);
        var_dump($usuario);
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

    function show_login(){
        include_once DIRECTORIO_VISTAS_FRONTEND."login.php";
    }

    function verify(){
        var_dump($_POST);
    }
}