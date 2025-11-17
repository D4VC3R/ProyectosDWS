<?php

namespace App\Class;

use App\Controller\UserController;
use App\Enum\UserType;
use App\Model\UserModel;
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
	private UserType $type;




	public function __construct(UuidInterface $uuid, string $username, string $password, string $email,
															UserType      $type=UserType::NORMAL, int $edad=18){
		$this->username = $username;
		$this->password = $password;
		$this->email = $email;
		$this->uuid = $uuid;
		$this->type = $type;
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

	public function getType(): UserType
	{
		return $this->type;
	}

	public function setType(UserType $type): User
	{
		$this->type = $type;
		return $this;
	}

	public function jsonSerialize(): mixed
	{
		return [
			'username' => $this->username,
			'password' => $this->password,
			'email' => $this->email,
			'edad' => $this->edad??"Sin datos",
			'tipo' => $this->type->name
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
		$usuario->setType(UserType::stringToUserType($userData['type']));

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

		$usuarioEditado = UserModel::getUserById($userData['uuid']);
		if(isset($userData['username'])){
			$usuarioEditado->setUsername($userData['username']);
		}
		if(isset($userData['email'])){
			$usuarioEditado->setEmail($userData['email']);
		}
		if(isset($userData['edad'])){
			$usuarioEditado->setEdad($userData['edad']);
		}
		if(isset($userData['tipo'])){
			$usuarioEditado->setType($userData['tipo']);
		}
		return $usuarioEditado;
	}

	public static function createFromArray(array $userData): User{

		if (!key_exists('uuid', $userData)){
			$userData['uuid'] = Uuid::uuid4()->toString();
		}

		$usuario = new User(
			Uuid::fromString($userData['uuid']),
			$userData['username'],
			$userData['password'],
			$userData['email']
		);

		$usuario->setEdad($userData['edad']);
		$usuario->setType(UserType::stringToUserType($userData['type']));
		return $usuario;
	}
}

