<?php

namespace App\Model;

use App\Class\User;
use App\Enum\UserType;
use Ramsey\Uuid\Uuid;

class UserModel
{
    public static function getAllUsers(): array{
        $usuario1 = new User(
            Uuid::fromString('550e8400-e29b-41d4-a716-446655440000'),
            "pabloM",
            "molbap",
            "pablom@mail.com",

        );
        $usuario2 = new User(
            Uuid::fromString('6ba7b810-9dad-11d1-80b4-00c04fd430c8'),
            "pabloC",
            "colbap",
            "pabloc@mail.com",
            UserType::ADMIN,
            22
        );
        $usuarios = [$usuario1, $usuario2];

        return $usuarios;
    }

    public static function getUserById(string $uuid): ?User
    {
        $usuarios = self::getAllUsers();

        foreach ($usuarios as $usuario) {
            if ($usuario->getUuid()->toString() === $uuid) {
                return $usuario;
            }
        }
        return null;
    }
}