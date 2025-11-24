<?php

namespace App\Model;

use PDO;
use PDOException;
use App\Class\Village;

class VillageModel
{
public static function getAllVillages():array|null
{
  try {
    $conexion = new \PDO("mysql:host=".DB_SERVER."dbname=".DB_NAME,DB_USERNAME,DB_PASSWORD);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }  catch (PDOException $e){
    return null;
  }

  // Falta seguir con el SQL.
}
}