<?php

namespace App\Model;

use App\Class\User;
use PDO;
use PDOException;

class UserModel{

	public static function getAllUsers(): ?array
		{
			try {
				$conexion = new PDO("mysql:host=mariadb;dbname=proyecto1", "davcerval", "davcerval");
				$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				return null;
			}

			$sql = "SELECT * FROM user";

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
			$conexion = new PDO("mysql:host=mariadb;dbname=proyecto1", "davcerval", "davcerval");
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			return null;
		}
		$sql = "SELECT * FROM user WHERE uuid = :uuid";

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
			$conexion = new PDO("mysql:host=mariadb;dbname=proyecto1", "davcerval", "davcerval");
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			return null;
		}
		$sql = "SELECT * FROM user WHERE username = :username";

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
			$conexion = new PDO("mysql:host=mariadb;dbname=proyecto1", "davcerval", "davcerval");
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			return null;
		}
		$sql = "SELECT * FROM user WHERE email = :email";

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
			$conexion = new PDO("mysql:host=mariadb;dbname=proyecto1", "davcerval", "davcerval");
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
			return false;
		}
		$sql = "INSERT INTO user values(:uuid,:username,:password,:email,:edad,:type)";
		$sentenciaPreparada = $conexion->prepare($sql);

		$sentenciaPreparada->bindValue('uuid', $user->getUuid());
		$sentenciaPreparada->bindValue('username', $user->getUsername());
		$sentenciaPreparada->bindValue('password', $user->getPassword());
		$sentenciaPreparada->bindValue('email', $user->getEmail());
		$sentenciaPreparada->bindValue('edad', $user->getEdad());
		$sentenciaPreparada->bindValue('type', $user->getType()->name);

		$sentenciaPreparada->execute();

		if ($sentenciaPreparada->rowCount()>0) {
			return true;
		}else{
			return false;
		}
	}

	public static function updateUser(User $user):bool{

		try {
			$conexion = new PDO("mysql:host=mariadb;dbname=proyecto1", "davcerval", "davcerval");
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
			return false;
		}
		$sql = "UPDATE user SET username=:username, password=:password, email=:email, edad=:edad, type=:type WHERE uuid=:uuid";
		$sentenciaPreparada = $conexion->prepare($sql);

		$sentenciaPreparada->bindValue('username', $user->getUsername());
		$sentenciaPreparada->bindValue('password', $user->getPassword());
		$sentenciaPreparada->bindValue('email', $user->getEmail());
		$sentenciaPreparada->bindValue('edad', $user->getEdad());
		$sentenciaPreparada->bindValue('type', $user->getType()->name);

		$sentenciaPreparada->execute();

		if ($sentenciaPreparada->rowCount()>0) {
			return true;
		}else{
			return false;
		}
	}
	public static function deleteUser(User $user):bool{
		return true;
	}
}