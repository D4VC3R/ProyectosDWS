<?php

namespace App\Class;

use App\Enum\TipoUsuario;

class User
{
    private string $username;
    private string $password;
    private string $email;
    private int $edad;
    private array $votaciones;
    private TipoUsuario $tipo;

    public function __construct(string $username, string $password, string $email, int $edad){
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->edad = $edad;
        $this->votaciones = [];
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
}

