<?php

namespace App\Model;

use App\Class\User;
use PDO;
use PDOException;
use App\Class\Database;

class UserModel{

	public static function getAllUsers(): ?array
		{
			try {
				$conexion = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
				$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				return null;
			}

			$sql = "SELECT * FROM test_user";

			$sentenciaPreparada = $conexion->prepare($sql);
			$sentenciaPreparada->execute();
			$resultado = $sentenciaPreparada->fetchAll(PDO::FETCH_ASSOC);

			if ($resultado){
				$usuarios = [];
				foreach($resultado as $user){
					$usuarios[]=User::createFromArray($user);
				}
				return $usuarios;
			}else{
				return null;
			}
		}

	public static function getUserById(string $uuid): ?User{
		try {
			$conexion = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			return null;
		}
		$sql = "SELECT * FROM test_user WHERE uuid = :uuid";

		$sentenciaPreparada = $conexion->prepare($sql);
		$sentenciaPreparada->execute(['uuid' => $uuid]);
		$resultado = $sentenciaPreparada->fetch(PDO::FETCH_ASSOC);
		if ($resultado){
			return User::createFromArray($resultado);
		}else{
			return null;
		}
	}

	public static function getUserByUsername(string $username): ?User{
		try {
			$conexion = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			return null;
		}
		$sql = "SELECT * FROM test_user WHERE username = :username";

		$sentenciaPreparada = $conexion->prepare($sql);
		$sentenciaPreparada->execute(['username' => $username]);
		$resultado = $sentenciaPreparada->fetch(PDO::FETCH_ASSOC);
		if ($resultado){
			return User::createFromArray($resultado);
		}else{
			return null;
		}
	}

	public static function getUserByEmail(string $email): ?User{
		try {
			$conexion = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			return null;
		}
		$sql = "SELECT * FROM test_user WHERE email = :email";

		$sentenciaPreparada = $conexion->prepare($sql);
		$sentenciaPreparada->execute(['email' => $email]);
		$resultado = $sentenciaPreparada->fetch(PDO::FETCH_ASSOC);
		if ($resultado){
			return User::createFromArray($resultado);
		}else{
			return null;
		}
	}

	public static function saveUser(User $user):bool{

		try {
			$conexion = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
			return false;
		}
		$sql = "INSERT INTO test_user values(:uuid,:username,:password,:email,:village,:type)";
		$sentenciaPreparada = $conexion->prepare($sql);

		$sentenciaPreparada->bindValue('uuid', $user->getUuid());
    return self::isValid($sentenciaPreparada, $user);
  }

	public static function updateUser(User $user):bool{

		try {
			$conexion = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
			return false;
		}
		$sql = "UPDATE test_user SET username=:username, password=:password, email=:email, village=:village, type=:type WHERE uuid=:uuid";
		$sentenciaPreparada = $conexion->prepare($sql);

    return self::isValid($sentenciaPreparada, $user);
  }
	public static function deleteUser(User $user):bool{
		return true;
	}
	public static function deleteUserById(string $id):bool{
		try {
            $conexion = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch (\PDOException $error){
			echo $error;
			return false;
		}

		$sql = "DELETE FROM test_user WHERE uuid=:uuid";
		$sentenciaPreparada = $conexion->prepare($sql);

		$sentenciaPreparada->bindValue('uuid',$id);

		$sentenciaPreparada->execute();

		if($sentenciaPreparada->rowCount()>0){
			return true;
		}else{
			return false;
		}
	}

  /**
   * @param false|\PDOStatement $sentenciaPreparada
   * @param User $user
   * @return bool
   */
  public static function isValid(false|\PDOStatement $sentenciaPreparada, User $user): bool
  {
    $sentenciaPreparada->bindValue('username', $user->getUsername());
    $sentenciaPreparada->bindValue('password', $user->getPassword());
    $sentenciaPreparada->bindValue('email', $user->getEmail());
    $sentenciaPreparada->bindValue('village', $user->getVillageName());
    $sentenciaPreparada->bindValue('type', $user->getType()->name);

    $sentenciaPreparada->execute();

    if ($sentenciaPreparada->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }
}