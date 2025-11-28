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
    // Crear getUserById en UserModel y mostrarlo en userDetails
  }

  function create()
  {
    return include_once DIR_USER_BACK_VIEWS . 'createUser.php';
  }

  function store()
  {
    $user = User::createFromArray($_POST);
    UserModel::saveUser($user);
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
    // Crear deleteUserById en UserModel
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