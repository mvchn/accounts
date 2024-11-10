<?php

namespace App\Tests\Unit;

use App\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    public function testValidate(): void
    {
        $validator = new Validator();
        $errors = $validator->validate(['name' => 'test']);
        $this->assertEmpty($errors);
    }

    public function testValidateRequired(): void
    {
        $validator = new Validator();
        $validator->addRule('name', 'required');
        $errors = $validator->validate([]);
        $this->assertArrayHasKey('name', $errors);
    }
}
