<?php

namespace App;

class Order
{

    private $userName;

    private $serviceName;

    private int $capacity;

    private Money $amount;
    private bool $active;

    public function __construct(string $userName, string $serviceName, Money $amount)
    {
        $this->userName = $userName;
        $this->serviceName = $serviceName;
        $this->amount = $amount;
        $this->active = false;
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getServiceName(): string
    {
        return $this->serviceName;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;
        return $this;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function send(): void
    {
        throw new \Exception('Not implemented');
        $this->active = true;
    }
}
