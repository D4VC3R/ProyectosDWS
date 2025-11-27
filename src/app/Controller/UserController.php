<?php

namespace App\Controller;

use App\Interface\ControllerInterface;

class UserController implements ControllerInterface
{

  function index()
  {
    // Crear getAllUsers en UserModel y mostrarlos en showUsers
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
    // Crear createUserFrom array en User e insertUser en UserModel.
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