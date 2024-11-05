<?php

namespace App;

class Order
{

    private Money $amount;
    private bool $active;

    public function __construct(Money $amount)
    {
        $this->amount = $amount;
        $this->active = false;
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function send(): void
    {
        $this->active = true;
    }
}