<?php

namespace App;

use App\Exception\RecordNotFoundException;
use App\User;

class UserRepository extends AbstractRepository
{
    private array $users = [];

    public function addUser(User $user): void
    {
        $this->users[] = $user;
    }

    public function getUsers(): array
    {
        return $this->users;
    }

    public function getUser(int $id): User
    {
        foreach ($this->users as $user) {
            if ($user->getId() === $id) {
                return $user;
            }
        }

        throw new RecordNotFoundException(sprintf("User with id %d not found", $id));
    }

    public function fetchUsers(): array
    {
        $query = "SELECT * FROM app_users";
        $result = $this->db->query($query);
        $users = [];
        while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
            $user = new User($row['name'], $row['phone']);
            $user->setUserId($row['id']);
            $users[] = $user;
        }
        return $users;
    }

    public function insertUsers(array $users): void
    {
        foreach ($users as $user) {
            $query = sprintf(
                "INSERT INTO app_users (name, phone, created_at) VALUES ('%s', '%s', '%s')",
                $user->getName(),
                $user->getPhone(),
                $user->getCreatedAt()->format('Y-m-d H:i:s')
            );
            $this->db->exec($query);
            $userId = $this->db->lastInsertId();
            $user->setUserId($userId);
            echo "Last User ID: #$userId\n";
        }
    }
}
