<?php

namespace App\Class;

use App\Enum\UserType;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class User implements \JsonSerializable
{
    private UuidInterface $uuid;
    private string $username;
    private string $password;
    private string $email;
    private int $edad;
    private array $votaciones;
    private UserType $tipo;




    public function __construct(UuidInterface $uuid, string $username, string $password, string $email,
                                UserType      $tipo=UserType::NORMAL, int $edad=0){
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->votaciones = [];
        $this->uuid = $uuid;
        $this->tipo = $tipo;
        $this->edad = $edad;
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function setUuid(UuidInterface $uuid): User
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): User
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    public function getEdad(): int
    {
        return $this->edad;
    }

    public function setEdad(int $edad): User
    {
        $this->edad = $edad;
        return $this;
    }

    public function getVotaciones(): array
    {
        return $this->votaciones;
    }

    public function setVotaciones(array $votaciones): User
    {
        $this->votaciones = $votaciones;
        return $this;
    }

    public function getTipo(): UserType
    {
        return $this->tipo;
    }

    public function setTipo(UserType $tipo): User
    {
        $this->tipo = $tipo;
        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'username' => $this->username,
            'password' => $this->password,
            'email' => $this->email,
            'edad' => $this->edad??"Sin datos",
            'votaciones' => $this->votaciones,
            'tipo' => $this->tipo->name
        ];
    }
    public static function validateUserCreation(array $userData):User|array{

        try {
            v::key('username', v::stringType())
                ->key('password', v::stringType()->length(3, 16))
                ->key('email', v::email())
                ->key('edad', v::intVal()->min(18))
                ->key('type', v::in(["normal", "anuncios", "admin"])
                )->assert($userData);
        }catch(NestedValidationException $errores){

            return $errores->getMessages();
        }

        $usuario = new User(
            Uuid::uuid4(),
            $userData['username'],
            $userData['password'],
            $userData['email']);

        $usuario->setEdad($userData['edad']);
        $usuario->setTipo(UserType::stringToUserType($userData['type']));

        return $usuario;
    }

    public static function validateUserEdit(array $userData):User|array{
        try {
            v::key('uuid', v::uuid())
                ->optional(v::key('username', v::stringType()))
                ->optional(v::key('password', v::stringType()->length(3, 16)))
                ->optional(v::key('email', v::email()))
                ->optional(v::key('edad', v::intVal()->min(18)))
                ->optional(v::key('type',v::in(["normal", "anuncios", "admin"]))
                )->assert($userData);
        }catch(NestedValidationException $errores){
            return $errores->getMessages();
        }
        // TODO buscar el usuario en la base de datos y modificarlo.
        return new User(
            Uuid::fromString($userData['uuid']),
            $userData['username'],
            $userData['password'],
            $userData['email'],
            UserType::stringToUserType($userData['type']
            )
        );
    }
}

