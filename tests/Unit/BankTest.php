<?php

namespace App\Tests\Unit;

use App\Account;
use App\Bank;
use App\Exception\BankException;
use App\Service;
use App\User;
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

    public function testSubscribeService(): void
    {
        $bank = new Bank();
        $user = new User('Test User', '+1234567890');
        $service = new Service('Test Service', 'test');

        $bank->subscribeService($user, $service);
        $this->assertTrue(true);
    }
}
