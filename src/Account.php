<?php

namespace App;

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
        if ($this->balance < $amount) {
            throw new \Exception('Not enough money');
        }

        $this->balance -= $amount;
    }
}
