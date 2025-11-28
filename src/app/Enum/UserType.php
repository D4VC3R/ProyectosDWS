<?php

namespace App\Enum;

enum UserType
{
  case ADMIN;
  case NORMAL;
  case PREMIUM;

  public static function stringToUserType(string $type):UserType{
    return match ($type){
      "ADMIN"=>UserType::ADMIN,
      "NORMAL"=>UserType::NORMAL,
      "PREMIUM"=>UserType::PREMIUM,
      default=>UserType::NORMAL
    };
  }
}
