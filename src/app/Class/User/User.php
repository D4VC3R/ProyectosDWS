<?php

namespace App\Class\User;
use App\Enum\UserType;
use App\Model\UserModel;
use DateTime;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class User implements \JsonSerializable
{
  private UuidInterface $uuid;
  private string $username;
  private string $email;
  private string $password;
  private DateTime | null $birthday;
  private array $friends;
  private UserType $type;

  /**
   * @param UuidInterface $uuid
   * @param string $username
   * @param string $email
   * @param string $password
   * @param UserType $type
   */
  public function __construct(UuidInterface $uuid, string $username, string $email, string $password, UserType $type)
  {
    $this->uuid = $uuid;
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
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

  public function getEmail(): string
  {
    return $this->email;
  }

  public function setEmail(string $email): User
  {
    $this->email = $email;
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


  public function getBirthday(): DateTime
  {
    return $this->birthday;
  }

  public function setBirthday(DateTime $birthday): User
  {
    $this->birthday = $birthday;
    return $this;
  }

  public function getFriends(): array
  {
    return $this->friends;
  }

  public function setFriends(array $friends): User
  {
    $this->friends = $friends;
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
  public function isAdmin():bool{
    return $this->getType()==UserType::ADMIN;
  }

  public function jsonSerialize(): mixed
  {
    return [
        "uuid"=>$this->getUuid(),
      "username"=>$this->getUsername(),
      "email"=>$this->getEmail(),
      "birthday"=>$this->getBirthday(),
      "friend"=>$this->getFriends(),
      "type"=>$this->getType()->name
    ];
  }

  public static function createFromArray(array $userData):?User
  {
    if (!isset($userData['uuid'])){
      $userData['uuid'] = Uuid::uuid4()->toString();
      $userData['password'] = password_hash($userData['password'],PASSWORD_DEFAULT);
    }
    $usuario = new User(
        Uuid::fromString($userData['uuid']),
        $userData['username'],
        $userData['email'],
        $userData['password'],
        UserType::stringToUserType($userData['type'])
    );
		if ($userData['birthday']){
			$usuario->setBirthday(DateTime::createFromFormat('d-m-Y', $userData['birthday']));
		}
		return $usuario;
  }

	public static function editFromArray(array $userData):?User{
		$usuarioAntiguo = UserModel::getUserByUuid($userData['uuid']);

		$usuarioAntiguo->setUsername($userData['username']??$usuarioAntiguo->getUsername());
		$usuarioAntiguo->setEmail($userData['email']??$usuarioAntiguo->getEmail());
		$usuarioAntiguo->setPassword(password_hash($userData['password'],PASSWORD_DEFAULT))??$usuarioAntiguo->getPassword();
		$usuarioAntiguo->setType(UserType::stringToUserType($userData['type'])??$usuarioAntiguo->getType()->name);
		$usuarioAntiguo->setBirthday($userData['birthday']??$usuarioAntiguo->getBirthday());

		return $usuarioAntiguo;
	}
}