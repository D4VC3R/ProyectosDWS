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
        $usuario = UserModel::getUserById($id);

        if ($usuario === null){
            http_response_code(404);
            echo "Usuario no encontrado.";
            return;
        }

        include_once DIRECTORIO_VISTAS_BACKEND."User/showUser.php";
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
        $usuario = UserModel::getUserById($id);
        var_dump($usuario);
    }

    function create()
    {
        include_once DIRECTORIO_VISTAS_BACKEND."createUser.php";
    }

    function edit($id)
    {
        $usuario = UserModel::getUserById($id);

        if ($usuario === null) {
            http_response_code(404);
            echo "Usuario no encontrado.";
            return;
        }
        include_once DIRECTORIO_VISTAS_BACKEND."User/editUser.php";
    }

    function show_login(){
        include_once DIRECTORIO_VISTAS_FRONTEND."login.php";
    }

    function verify(){
        var_dump($_POST);
    }

    function show_register(){

    }
}