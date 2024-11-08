<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Validator;

class ValidatorTest extends TestCase
{
    public function testValidate(): void
    {
        $validator = new Validator();
        $errors = $validator->validate(['name' => 'test']);
        $this->assertEmpty($errors);
    }
}
