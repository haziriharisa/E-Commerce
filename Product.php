<?php
class Product {
    private $conn;
    private $table_name = "products";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readAll($sort = 'default') {
        $query = "SELECT * FROM " . $this->table_name;

        switch ($sort) {
            case 'price-asc': $query .= " ORDER BY price ASC"; break;
            case 'price-desc': $query .= " ORDER BY price DESC"; break;
            default: $query .= " ORDER BY id ASC"; break;
        }

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>