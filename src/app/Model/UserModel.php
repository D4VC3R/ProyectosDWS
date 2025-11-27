<?php

namespace App\Model;

use App\Class\User\User;
use PDO;
use PDOException;

class UserModel
{

  public static function getAllUsers():?array {

    try {
      $conexion = new PDO("mysql:host=".DB_HOST."dbname=".DB_NAME,DB_USER,DB_PASS, DB_PORT);
      $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT * FROM test_user";

      $stmt = $conexion->prepare($sql);
      $stmt->execute();

      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if ($resultado){
        $usuarios = [];
        foreach ($resultado as $user){
          User::createFromArray($user);
        }
        return $usuarios;
      }
      return null;

    } catch(PDOException $e) {
      return null;
    }

  }

}