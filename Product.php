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

    public function create($title, $price, $category, $image_url) {
    $query = "INSERT INTO " . $this->table_name . " (title, price, category, image_url) VALUES (:title, :price, :category, :image_url)";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':image_url', $image_url);

    if($stmt->execute()) {
        return true;
    }
    return false;
}

    public function delete($id) {
            $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            return 
            $stmt->execute();
        }

        public function readOne($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $title, $price, $category, $image_url) {
        $query = "UPDATE " . $this->table_name . " SET title=:title, price=:price, category=:category, image_url=:image_url WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':id' => $id,
            ':title' => $title,
            ':price' => $price,
            ':category' => $category,
            ':image_url' => $image_url
        ]);
    }

}
?>