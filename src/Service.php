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

    public function orderRequest(array $form): Order
    {
        $validator = new Validator();
        $validator->addRule('amount', 'required');
        $validator->addRule('currency', 'required');
        $validator->addRule('user_name', 'required');     //TODO: maybe user relation?
        $validator->addRule('service_name', 'required');  //TODO: maybe $this->name?
        $validator->addRule('capacity', 'integer');
        $errors = $validator->validate($form);
        if (count($errors) > 0) {
            throw new ValidationException("Validation error");
        }

        $order = new Order($form['user_name'], $form['service_name'], new Money($form['amount'], $form['currency']));
        $order->setCapacity($form['capacity']);

        return $order;
    }
}
