<?php

namespace App\Tests;

use App\Money;
use App\Order;
use App\OrderRepository;

class OrderRepositoryTest extends IntegrationTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->db->exec('DROP TABLE IF EXISTS app_orders');
        $this->db->exec('CREATE TABLE app_orders(
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    profile_id INTEGER DEFAULT NULL,
    user_name VARCHAR(255) NOT NULL,
    service_name VARCHAR(255) NOT NULL,
    amount INTEGER NOT NULL,
    currency VARCHAR(3) NOT NULL,
    capacity INTEGER NOT NULL,
    active BOOLEAN NOT NULL,
    started_at TIMESTAMP DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)');
    }

    public function testCreateOrder(): void
    {
        $repository = new OrderRepository($this->db, 'app_orders');
        $order = new Order('Test Service', 'Test User', new Money(100, 'USD'));
        $order->setCapacity(1);
        $repository->insertOrder($order);

        $this->assertEquals(100, $order->getAmount()->getAmount());
    }
}
