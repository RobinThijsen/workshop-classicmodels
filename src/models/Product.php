<?php

namespace models;

use PDO;

class Product extends Database
{

    public function getProducts(int $limit): array|bool
    {
        $sql = "SELECT * FROM products LIMIT :lmt";
        $result = Database::query($sql, ["lmt" => $limit]);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById(string|int $id): array|bool
    {
        $sql = "SELECT * FROM products WHERE productCode = :productCode";
        $result = Database::query($sql, ["productCode" => $id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function getProductsByName(string $name): array|bool
    {

        $sql = "SELECT * FROM products WHERE productName LIKE :productName ORDER BY productName";
        $result = Database::query($sql, ["productName" => "%" . $name . "%"]);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductsAndCountByProductLine(string $productLine, int $limit): array|bool
    {
        $sql = "SELECT *, count(*) as count FROM products WHERE productLine LIKE :productLine LIMIT :limit";
        $result = Database::query($sql, ["productLine" => $productLine, "limit" => $limit]);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}