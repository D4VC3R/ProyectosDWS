<?php

namespace App\Enum;

enum UserType
{
    case NORMAL;
    case PREMIUM;
    case ADMIN;


    public static function stringToUserType(string $tipoUsuario): UserType
    {
        return match (strtolower($tipoUsuario)) {
            "normal" => UserType::NORMAL,
            "premium" => UserType::PREMIUM,
            "admin" => UserType::ADMIN,
            default => UserType::NORMAL
        };
    }
}
