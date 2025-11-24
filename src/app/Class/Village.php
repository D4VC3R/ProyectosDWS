<?php

namespace App\Class;

class Village
{
  private int $id;
  private string $name;
  private string $postalCode;
  private string $region;
  private array $coordinates;


  public function __construct(int $id, string $name, string $postalCode, string $region, array $coordinates)
  {
    $this->id = $id;
    $this->name = $name;
    $this->postalCode = $postalCode;
    $this->region = $region;
    $this->coordinates = $coordinates;
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function setName(string $name): Village
  {
    $this->name = $name;
    return $this;
  }

  public function getPostalCode(): string
  {
    return $this->postalCode;
  }

  public function setPostalCode(string $postalCode): Village
  {
    $this->postalCode = $postalCode;
    return $this;
  }

  public function getRegion(): string
  {
    return $this->region;
  }

  public function setRegion(string $region): Village
  {
    $this->region = $region;
    return $this;
  }

  public function getCoordinates(): array
  {
    return array_values($this->coordinates);
  }

  public function setCoordinates(array $coordinates): Village
  {
    $this->coordinates = $coordinates;
    return $this;
  }




}