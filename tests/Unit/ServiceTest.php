<?php

namespace App\Tests\Unit;

use App\Order;
use App\Service;
use PHPUnit\Framework\TestCase;

class ServiceTest extends TestCase
{
    public function testOrder(): void
    {
        $order = new Order('test', 'test', new \App\Money(100, 'USD'));
        $order->setCapacity(10);
        $this->assertEquals(10, $order->getCapacity());
        $this->assertFalse($order->isActive());
        $this->assertFalse($order->isActive());
    }

    public function testOrderException(): void
    {
        $order = new Order('test', 'test', new \App\Money(100, 'USD'));
        $this->expectException(\Exception::class);
        $order->send();
    }

    public function testOrderRequest(): void
    {
        $service = new Service('test', 'test');
        $order = $service->orderRequest(['amount' => 1, 'currency' => 'USD', 'capacity' => 1, 'user_name' => 'test', 'service_name' => 'test']);
        $this->assertEquals('test', $order->getUserName());
        $this->assertEquals('test', $order->getServiceName());
    }
}
