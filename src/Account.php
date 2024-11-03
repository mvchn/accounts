<?php

namespace App;

use App\Exception\AccountException;
use App\Exception\ValidationException;

class Account
{
    private int $balance = 0;

    public function __toString(): string
    {
        return 'Balance: ' . $this->balance;
    }

    public function getBalance(): int
    {
        return $this->balance;
    }

    public function deposit(int $amount): self
    {
        $this->balance += $amount;

        return $this;
    }

    public function credit(int $amount): self
    {
        $this->balance -= $amount;

        return $this;
    }

    public function withdraw(int $amount): void
    {
        if ($amount <= 0) {
            throw new ValidationException(sprintf('Invalid amount: %d', $amount));
        }

        if ($this->balance < $amount) {
            throw new AccountException('Not enough money');
        }

        $this->balance -= $amount;
    }
}
