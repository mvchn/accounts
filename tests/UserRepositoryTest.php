<?php

namespace App\Tests;

use App\User;
use App\UserRepository;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    public function testGetUser(): void
    {
        $db = new \PDO('sqlite::memory:');
        $repository = new UserRepository($db);
        $user = new User('John Doe', '+1234567890');
        $user->setUserId(1);
        $repository->addUser($user);
        $this->assertEquals('John Doe', $repository->getUser(1)->getName());
    }
}