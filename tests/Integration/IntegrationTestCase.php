<?php

namespace App\Tests\Integration;

use PHPUnit\Framework\TestCase;

abstract class IntegrationTestCase extends TestCase
{
    protected \PDO $db;

    public function setUp(): void
    {
        $this->db = new \PDO(sprintf('sqlite:%s', __DIR__ . '/../../var/data/test.db'));
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
}
