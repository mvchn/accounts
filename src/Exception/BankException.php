<?php

namespace App\Exception;

class BankException extends \RuntimeException
{
    public function __construct(string $message)
    {
        parent::__construct(sprintf("Bank exception: %s", $message));
    }
}
