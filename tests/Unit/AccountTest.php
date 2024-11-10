<?php

namespace App\Tests\Unit;

use App\Account;
use App\Exception\AccountException;
use App\Exception\ValidationException;
use PHPUnit\Framework\TestCase;

class AccountTest extends TestCase
{
    public function testCreation(): void
    {
        $account = new Account(1);
        $this->assertEquals(1, $account->getId());
        $this->assertEquals(0, $account->getBalance());
    }
    public function testGetBalance(): void
    {
        $account = new Account(1);
        $account->deposit(100);
        $this->assertEquals(100, $account->getBalance());
    }

    public function testDeposit(): void
    {
        $account = new Account(1);
        $account->credit(100);
        $this->assertEquals(-100, $account->getBalance());
    }

    public function testWithdraw(): void
    {
        $account = new Account(1);
        $account->deposit(100);
        $account->withdraw(50);
        $this->assertEquals(50, $account->getBalance());
    }

    public function testWithdrawException(): void
    {
        $account = new Account(1);
        $account->deposit(100);
        $this->expectException(AccountException::class);
        $account->withdraw(150);
    }

    public function testWithdrawAmountException(): void
    {
        $account = new Account(1);
        $account->deposit(100);
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Invalid amount: -1');
        $account->withdraw(-1);
    }

    public function testCredit(): void
    {
        $account = new Account(1);
        $account->deposit(100);
        $account->credit(150);
        $this->assertEquals(-50, $account->getBalance());
    }
}
