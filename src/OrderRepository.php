<?php

namespace App;

use App\Exception\RecordNotFoundException;
use App\Order;

class OrderRepository extends AbstractRepository
{
    private array $orders = [];

    public function addOrder(Order $order): void
    {
        $this->orders[] = $order;
    }

    public function getOrders(): array
    {
        return $this->orders;
    }

    public function getOrder(int $id): Order
    {
        foreach ($this->orders as $order) {
            if ($order->getId() === $id) {
                return $order;
            }
        }

        throw new RecordNotFoundException(sprintf("Order with id %d not found", $id));
    }
}
