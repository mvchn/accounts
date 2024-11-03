<?php

namespace App\Tests;

use App\Money;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testCreatedSuccess(): void
    {
        $money = new Money(100, 'USD');
        $this->assertEquals(100, $money->getAmount());
        $this->assertEquals('USD', $money->getCurrency());
    }
}
