<?php

namespace App\Tests;

use App\User;
use App\UserRepository;
use App\Exception\RecordNotFoundException;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    private \PDO $db;

    public function setUp(): void
    {
        $this->db = new \PDO(sprintf('sqlite:%s', __DIR__ . '/../var/data/test.db'));
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->db->exec('DROP TABLE IF EXISTS app_users');
        $this->db->exec('CREATE TABLE app_users(
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    email VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)');
    }

    public function testNotFound(): void
    {
        $repository = new UserRepository($this->db);
        $this->expectException(RecordNotFoundException::class);
        $repository->getUser(1);
    }

    public function testGetUser(): void
    {
        $repository = new UserRepository($this->db);
        $user = new User('Test User', '+1234567890');
        $user->setUserId(1);
        $repository->addUser($user);
        $this->assertCount(1, $repository->getUsers());
        $this->assertEquals('Test User', $repository->getUser(1)->getName());
    }

    public function testInsertSuccess(): void
    {
        $repository = new UserRepository($this->db);
        $users = [
            new User('Test User', '+1234567890'),
            new User('Admin User', '+0987654321'),
        ];
        $repository->insertUsers($users);
        $this->assertCount(2, $repository->fetchUsers());

        $user = $repository->fetchOne(1);
        $this->assertEquals('Test User', $user['name']);

        $users = $repository->fetchAll();
        $this->assertCount(2, $users);
    }

    public function __tearDown(): void
    {
        $this->db->exec('DROP TABLE app_users');
    }
}
