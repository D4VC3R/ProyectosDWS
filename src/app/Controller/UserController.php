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
    UserModel::saveUser($user);
		header("Location: /user");
  }

  function edit($id)
  {
    // Crear getUserById y pasarle la info al formulario de edicion.
  }

  function update($id)
  {
    // Crear patch en UserModel y editFromArray en User
  }

  function delete($id)
  {
    if (UserModel::deleteUserByUuid($id)){
			header('Location: /user');

		}
  }

  function showLogin() {
    return include_once DIR_VIEWS . 'login.php';
  }

  function verify() {
    // Hacer getUserByUsername en UserModel y comprobar contraseña hasheada.
    // Si es admin entra al backend.
  }
  function logout(){
    return header('Location: /');
  }

}