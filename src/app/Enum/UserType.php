<?php

namespace App\Enum;

enum UserType
{
  case ADMIN;
  case NORMAL;
  case PREMIUM;

  public static function stringToUserType(string $type):UserType{
    return match ($type){
      "admin"=>UserType::ADMIN,
      "normal"=>UserType::NORMAL,
      "premium"=>UserType::PREMIUM,
      "defaul"=>UserType::NORMAL
    };
  }
}
