<?php

namespace App;

class User
{
    private int $id = 0;
    private string $name;

    private string $phone;

    private ?string $email;

    private \DateTime $createdAt;

    public function __construct(string $name, string $phone)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->createdAt = new \DateTime();
    }

    public function __toString(): string
    {
        return sprintf("#%d, %s", $this->id, $this->name);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setUserId(int $id): void
    {
        $this->id = $id;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }
}
