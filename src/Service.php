<?php

namespace App;

use App\Exception\ValidationException;

class Service
{
    private array $orders = [];

    public function __construct(private readonly string $name, private readonly string $type)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function orderRequest(array $form): void
    {
        $validator = new Validator();
        $validator->addRule('amount', 'required');
        $validator->addRule('currency', 'required');
        $errors = $validator->validate($form);
        if (count($errors) > 0) {
            throw new ValidationException("Validation error");
        }
        $order = new Order(new Money($form['amount'], $form['currency']));
        $order->send();
    }

    public function getActiveOrders(): array
    {
        return array_filter($this->orders, fn($order) => $order->getActive() === true);
    }
}
