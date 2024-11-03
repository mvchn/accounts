<?php

namespace App;

class Money
{
    public function __construct(private readonly int $amount, private readonly string $currency)
    {
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}
