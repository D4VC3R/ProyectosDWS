<?php

namespace App\Controller;

use App\Class\User;
use App\Enum\UserType;
use App\Interface\ControllerInterface;
use App\Model\UserModel;
use Ramsey\Uuid\Uuid;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

class UserController implements ControllerInterface
{
	function index()
	{
		$usuarios = UserModel::getAllUsers();
		if($_SERVER["REQUEST_URI"]=="api"){
			http_response_code(201);
			return json_encode($usuarios);
		}else{
			include_once DIRECTORIO_VISTAS_BACKEND."User/allUsers.php";
		}

	}

	function show($id)
	{
		$usuario = UserModel::getUserById($id);
		include_once DIRECTORIO_VISTAS_BACKEND . "User/showUser.php";
	}

	function create()
	{
		include_once DIRECTORIO_VISTAS_BACKEND . "User/createUser.php";
	}

	function store()
	{
		$resultado = User::validateUserCreation($_POST);

		if (!is_array($resultado)){
			UserModel::saveUser($resultado);
			header('Location: /user');
		}else{
			include_once DIRECTORIO_VISTAS_BACKEND . "User/createUser.php";
			foreach ($resultado as $error) {
				echo $error . "<br>";
			}
		}
	}

	function update($id)
	{
		$editData = json_decode(file_get_contents("php://input"), true);

		$editData['uuid'] = $id;

		$usuario = User::validateUserEdit($editData);

		UserModel::updateUser($usuario);
	}

	function destroy($id)
	{
		$usuario = UserModel::getUserById($id);

		if ($usuario === null) {
			http_response_code(404);
			echo "Usuario no encontrado.";
			return;
		}

		echo "Se ha eliminado el usuario: " . $usuario->getUsername();
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
				$_SESSION['type'] = $usuario->getType();
				if ($usuario->getType() === UserType::ADMIN) {
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

