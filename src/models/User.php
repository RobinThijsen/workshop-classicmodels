<?php

namespace models;

use PDO;

class User extends Database
{
    public function getUserById(string|int $id): array|bool
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $result = Database::query($sql, ["id" => $id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByNameAndEmail(string $username, string $email): array|bool
    {
        $sql = "SELECT * FROM users WHERE username = :username AND email = :email";
        $result = Database::query($sql, ["username" => $username, "email" => $email]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByEmail(string $email): array|bool
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $result = Database::query($sql, ["email" => $email]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function insertNewUser(array $param = []): bool
    {
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        return Database::exec($sql, $param);
    }

    public function updateUsersUsernameAndEmail(array $param = []): bool
    {
        $sql = "UPDATE users SET username = :username AND email = :email WHERE id = :id";
        return Database::exec($sql, $param);
    }

    public function updateUsersUsername(array $param = []): bool
    {
        $sql = "UPDATE users SET username = :username WHERE id = :id";
        return Database::exec($sql, $param);
    }

    public function updateUsersEmail(array $param = []): bool
    {
        $sql = "UPDATE users SET email = :email WHERE id = :id";
        return Database::exec($sql, $param);
    }

    public function deleteUserById(string|int $id): bool
    {
        $sql = "DELETE FROM users WHERE id = :id";
        return Database::exec($sql, ["id" => $id]);
    }
}