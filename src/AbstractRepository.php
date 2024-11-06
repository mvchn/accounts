<?php

namespace App;

abstract class AbstractRepository
{
    private string $table;

    protected \PDO $db;

    public function __construct(\PDO $db, string $table)
    {
        $this->db = $db;
        $this->table = $table;
    }
    public function fetchAll(): array
    {
        $query = sprintf("SELECT * FROM %s", $this->table);
        $result = $this->db->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fetchOne(int $id): array
    {
        $query = sprintf("SELECT * FROM %s WHERE id = %d", $this->table, $id);
        $result = $this->db->query($query);
        return $result->fetch(\PDO::FETCH_ASSOC);
    }
}
