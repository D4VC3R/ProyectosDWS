<?php

namespace App\Controller;

use App\Class\User\User;
use App\Interface\ControllerInterface;
use App\Model\UserModel;

class UserController implements ControllerInterface
{

  function index()
  {
    $usuarios = UserModel::getAllUsers();
    include_once DIR_USER_BACK_VIEWS . 'showUsers.php';
  }

  function show($id)
  {
    $usuario = UserModel::getUserByUuid($id);
		include_once DIR_USER_BACK_VIEWS . 'userDetails.php';
  }

  function create()
  {
    return include_once DIR_USER_BACK_VIEWS . 'createUser.php';
  }

  function store()
  {
    $user = User::createFromArray($_POST);

    if(UserModel::saveUser($user)){
			/*http_response_code(200);
			return json_encode([
				"error" => false,
				"message" => "Usuario creado con éxito.",
				"code" => 200*/
	    $mensaje = "Usuario creado con éxito";
	    $usuarios = UserModel::getAllUsers();
			include_once DIR_USER_BACK_VIEWS . 'showUsers.php';

		} else {
			http_response_code(401);
			return json_encode([
				"error" => true,
				"message" => "No se pudo crear al usuario, por lo que sea.",
				"code" => 401
			]);
		}

  }

  function edit($id)
  {
    $user = UserModel::getUserByUuid($id);
		return include_once DIR_USER_BACK_VIEWS . 'editUser.php';
  }

  function update($id)
  {
    // Crear update en UserModel y editFromArray en User
		$editData = json_decode(file_get_contents("php://input"), true);
		$editData['uuid']=$id;
		$usuarioAntiguo = UserModel::getUserByUuid($id);

		$editedUser = User::editFromArray($editData, $usuarioAntiguo);

		if (UserModel::updateUser($editedUser)){
			http_response_code(200);
			return json_encode([
				"error" => false,
				"message" => "Usuario editado correctamente.",
				"code" => 200
			]);
		}else {
			http_response_code(400);
			return json_encode([
				"error" => true,
				"message" => "Hubo un problema al editar el usuario.",
				"code" => 401
			]);
		}

  }

  function delete($id)
  {
		$usuarioCaput = UserModel::getUserByUuid($id);

    if (UserModel::deleteUserByUuid($id)){
			http_response_code(200);
			return json_encode([
				"error" => false,
				"message" => "El usuario ". $usuarioCaput->getUsername() ." se ha borrado correctamente.",
				"code" => 200
			]);
		} else {
			http_response_code(401);
			return json_encode([
				"error" => true,
				"message" => "No se pudo borrar a ". $usuarioCaput->getUsername(),
				"code" => 401
			]);
		}
  }

  function showLogin() {
    $error = null;
    return include_once DIR_VIEWS . 'login.php';
  }

  function verify() {
    // Hacer getUserByUsername en UserModel y comprobar contraseña hasheada.
    // Si es admin entra al backend.
    $usuario = UserModel::getUserByUsername($_POST['username']);

    if (!$usuario){
      $error = "Nombre de usuario incorrecto.";
      return include_once DIR_VIEWS."login.php";
    }

    if (password_verify($_POST['password'],$usuario->getPassword())){
      $_SESSION['user']=$usuario;

      if ($usuario->isAdmin()){
        header('Location: /admin');
      } else {
        header('Location: /');
      }
    } else {
      $error = "Fallo de autentificación.";
      include_once DIR_VIEWS."login.php";
    }
  }

  function logout()
	{
    session_destroy();
    header('Location: /');
  }

}