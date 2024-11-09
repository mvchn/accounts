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

    public function insertOrder(Order $order): void
    {
        $query = sprintf(
            "INSERT INTO app_orders (service_name, user_name, amount, currency, capacity, active, started_at, created_at) VALUES ('%s', '%s', %d, '%s', %d, %d, '%s', '%s')",
            $order->getServiceName(),
            $order->getUserName(),
            $order->getAmount()->getAmount(),
            $order->getAmount()->getCurrency(),
            $order->isActive(),
            $order->getCapacity(),
            (new \DateTime())->format('Y-m-d H:i:s'),
            (new \DateTime())->format('Y-m-d H:i:s')
        );
        $this->db->exec($query);
    }
}
