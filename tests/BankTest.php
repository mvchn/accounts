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
        $from = (new Account())->deposit(100);
        $to = new Account();

        $this->expectException(BankException::class);
        $bank->transfer($from, $to, 0);
    }

    public function testBankException(): void
    {
        $bank = new Bank();
        $from = new Account();
        $from->deposit(100);
        $to = new Account();

        $this->expectException(BankException::class);
        $bank->transfer($from, $to, 150);
    }

    public function testTransferSuccess(): void
    {
        $bank = new Bank();
        $from = new Account();
        $from->deposit(100);
        $to = new Account();

        $bank->transfer($from, $to, 50);

        $this->assertEquals(50, $from->getBalance());
        $this->assertEquals(50, $to->getBalance());
    }
}