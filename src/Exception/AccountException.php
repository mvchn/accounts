<?php

namespace App\Exception;

class AccountException extends \RuntimeException implements \Throwable
{
    public function __construct(string $message)
    {
        parent::__construct("Account exception: $message");
    }

}