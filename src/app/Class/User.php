<?php

namespace App\Class;

use App\Enum\TipoUsuario;
use Ramsey\Uuid\UuidInterface;

class User implements \JsonSerializable
{
    private UuidInterface $uuid;
    private string $username;
    private string $password;
    private string $email;
    private int $edad;
    private array $votaciones;
    private TipoUsuario $tipo;




    public function __construct(UuidInterface $uuid, string $username, string $password, string $email,
    TipoUsuario $tipo=TipoUsuario::NORMAL, int $edad=0){
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

    public function getTipo(): TipoUsuario
    {
        return $this->tipo;
    }

    public function setTipo(TipoUsuario $tipo): User
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
}

