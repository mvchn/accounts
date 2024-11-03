<?php

namespace App\Tests;

use App\Bank;
use App\Account;
use App\Exception\BankException;
use PHPUnit\Framework\TestCase;

class BankTest extends TestCase
{
    public function testValidationException(): void
    {
        $bank = new Bank();
        $from = (new Account(1))->deposit(100);
        $to = new Account(2);

        $this->expectException(BankException::class);
        $bank->transfer($from, $to, 0);
    }

    public function testBankException(): void
    {
        $bank = new Bank();
        $from = new Account(1);
        $from->deposit(100);
        $to = new Account(2);

        $this->expectException(BankException::class);
        $bank->transfer($from, $to, 150);
    }

    public function testTransferSuccess(): void
    {
        $bank = new Bank();
        $from = new Account(1);
        $from->deposit(100);
        $to = new Account(2);

        $bank->transfer($from, $to, 50);

        $this->assertEquals(50, $from->getBalance());
        $this->assertEquals(50, $to->getBalance());
    }
}