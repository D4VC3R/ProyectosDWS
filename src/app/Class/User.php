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
	protected Village $village;
	private UserType $type;


  public function __construct(UuidInterface $uuid, string $username, string $password, string $email, Village $residence, UserType $type)
  {
    $this->uuid = $uuid;
    $this->username = $username;
    $this->password = $password;
    $this->email = $email;
    $this->village = $residence;
    $this->type = $type;
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

  public function getVillage(): Village
  {
    return $this->village;
  }

  public function setVillage(Village $village): User
  {
    $this->village = $village;
    return $this;
  }

  public function getVillageName (): String
  {
    return $this->village->getName();
  }

  public function getType(): UserType
  {
    return $this->type;
  }

  public function setType(String $type): User
  {
    $this->type = UserType::stringToUserType($type);
    return $this;
  }



  public function jsonSerialize(): mixed
	{
		return [
			'username' => $this->username,
			'email' => $this->email,
			'village' => $this->village,
			'tipo' => $this->type->name
		];
	}

  public static function createFromArray(array $userData): User {

    if (!isset($userData['uuid'])){
      $userData['uuid']=Uuid::uuid4()->toString();
      $userData['password']=password_hash($userData['password'], PASSWORD_DEFAULT);
    }

    $usuario = new User(Uuid::fromString($userData['uuid']),
    $userData['username'],$userData['password'] ,$userData['email'],
    $userData['village'],$userData['type']);

    return $usuario;
  }


}