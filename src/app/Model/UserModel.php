<?php

namespace App\Model;

use App\Class\User\User;
use PDO;
use PDOException;

class UserModel
{

  public static function getAllUsers():?array {

    try {
      $conexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASS);
      $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT * FROM test_user";

      $stmt = $conexion->prepare($sql);
      $stmt->execute();

      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if ($resultado){
        $usuarios = [];

        foreach ($resultado as $user){
          $usuarios[] = User::createFromArray($user);
        }
        return $usuarios;
      }
      return null;

    } catch(PDOException $e) {
      return null;
    }
  }

	public static function getUserByUuid(string $uuid):?User{

		try {
			$conexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASS);
			$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}catch (PDOException $e){
			return null;
		}

		$sql = "SELECT * FROM test_user where uuid=:uuid";

		$stmt = $conexion->prepare($sql);
		$stmt->bindValue('uuid', $uuid, PDO::PARAM_STR);
		$stmt->execute();

		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($resultado){
			return User::createFromArray($resultado);
		} else {
			return null;
		}
	}

  public static function getUserByUsername(string $username):?User{
    try {
      $conexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASS);
      $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
      return null;
    }

    $sql = "SELECT * FROM test_user WHERE username=?";

    $stmt = $conexion->prepare($sql);
    $stmt->bindValue(1,$username,PDO::PARAM_STR);

    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario){
      return User::createFromArray($usuario);
    } else {
      return null;
    }
  }

  public static function saveUser(User $user):bool{

    try {
      $conexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASS);
      $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    }catch (PDOException){
      return false;
    }

    $sql="INSERT INTO test_user (uuid, username, email, password, type) VALUES (:uuid, :username, :email, :password, :type)";

    $stmt = $conexion->prepare($sql);

    $stmt->bindValue("uuid", $user->getUuid());
    $stmt->bindValue("username", $user->getUsername());
    $stmt->bindValue("email", $user->getEmail());
    $stmt->bindValue("password", $user->getPassword());
    $stmt->bindValue("type", $user->getType()->name);

    $stmt->execute();
    return true;
  }

	public static function deleteUserByUuid(string $uuid):bool{
		try {
			$conexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASS);
			$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}catch (PDOException){
			return false;
		}

		$sql = "DELETE FROM test_user WHERE uuid=:uuid";

		$stmt = $conexion->prepare($sql);
		$stmt->bindValue("uuid", $uuid);
		$stmt->execute();

		if ($stmt->rowCount()>0){
			return true;
		} else {
			return false;
		}
	}

	public static function updateUser(User $user):bool{

		try {
			$conexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASS);
			$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}catch (PDOException){
			return false;
		}

		$sql = "UPDATE test_user SET username=:username, email=:email, password=:password, type=:type, birthday=:birthday WHERE uuid=:uuid";

		$stmt = $conexion->prepare($sql);

		$stmt->bindValue("uuid", $user->getUuid());
		$stmt->bindValue("username", $user->getUsername());
		$stmt->bindValue("email", $user->getEmail());
		$stmt->bindValue("password", $user->getPassword());
		$stmt->bindValue("type", $user->getType()->name);
		$stmt->bindValue("birthday",$user->getBirthday());

		$stmt->execute();

		if ($stmt->rowCount()>0){
			return true;
		} else {
			return false;
		}
	}


}