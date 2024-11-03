<?php

namespace App;

use App\Exception\AccountException;

class Account
{
    private int $balance = 0;

    public function getBalance(): int
    {
        return $this->balance;
    }

    public function deposit(int $amount): void
    {
        $this->balance += $amount;
    }

    public function credit(int $amount): void
    {
        $this->balance -= $amount;
    }

    public function withdraw(int $amount): void
    {
        if ($amount < 0) {
            throw new AccountException('Invalid amount');
        }

        if ($this->balance < $amount) {
            throw new AccountException('Not enough money');
        }

        $this->balance -= $amount;
    }
}
