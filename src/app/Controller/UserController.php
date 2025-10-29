<?php

namespace App\Controller;

use App\Class\User;
use App\Enum\UserType;
use App\Interface\ControllerInterface;
use App\Model\UserModel;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

class UserController implements ControllerInterface
{
    function index()
    {
        $usuarios = UserModel::getAllUsers();

        include_once DIRECTORIO_VISTAS_BACKEND . "User/allusers.php";

    }

    function show($id)
    {
        $usuario = UserModel::getUserById($id);
        include_once DIRECTORIO_VISTAS_BACKEND . "User/showUser.php";

    }

    function store()
    {
        $resultado = User::validateUserCreation($_POST);
        !is_array($resultado)
            ?
            var_dump($resultado)
            :
            include_once DIRECTORIO_VISTAS_BACKEND . "User/createUser.php";
            foreach ($resultado as $error) {
                echo $error . "<br>";
            }

    }

    function update($id)
    {
        echo $id;

        parse_str(file_get_contents("php://input"), $editData);
        $editData["uuid"] = $id;
        $usuario = User::validateUserEdit($editData);
        var_dump($editData);
        var_dump($usuario);

    }

    function destroy($id)
    {
        $usuario = UserModel::getUserById($id);
        echo "Se ha eliminado el usuario: " . $usuario->getUsername();
        var_dump($usuario);
    }

    function create()
    {
        include_once DIRECTORIO_VISTAS_BACKEND . "User/createUser.php";
    }

    function edit($id)
    {
        $usuario = UserModel::getUserById($id);

        if ($usuario === null) {
            http_response_code(404);
            echo "Usuario no encontrado.";
            return;
        }
        include_once DIRECTORIO_VISTAS_BACKEND . "User/editUser.php";
    }

    function show_login()
    {
        include_once DIRECTORIO_VISTAS_BACKEND . "login.php";
    }

    function verify()
    {
        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        var_dump(password_verify($_POST['password'], $hash));
        var_dump($_POST);

        $usuarios = UserModel::getAllUsers();

        foreach ($usuarios as $usuario) {
            if ($usuario->getUsername() === $_POST['username'] && password_verify($usuario->getPassword(), $hash)) {
                $_SESSION['username'] = $usuario->getUsername();
                $_SESSION['uuid'] = $usuario->getUuid();
                if ($usuario->getTipo() === UserType::ADMIN) {
                    include_once DIRECTORIO_VISTAS_BACKEND . "welcome.php";
                } else {
                    include_once DIRECTORIO_VISTAS_FRONTEND . "indice.php";
                }
            }
        }
        echo "Usuario no encontrado.";
    }

    function logout()
    {
        session_destroy();
        header("Location: /login");
        exit;
    }
}

