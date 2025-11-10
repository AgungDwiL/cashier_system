<?php
    require_once __DIR__ . "/../config/Database.php";

    class Product{
        private $conn;
        private $table_name = 'products';

        public $id;
        public $name;
        public $price;
        public $stock;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function getAllProducts(){
            $query = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function create(){
            $query = "INSERT INTO " . $this->table_name . " (name, price, stock) VALUES (:name, :price, :stock)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":price", $this->price);
            $stmt->bindParam(":stock", $this->stock);
            return $stmt->execute();
        }

        public function update(){
            $query = "UPDATE " . $this->table_name . " SET name = :name, price = :price, stock = :stock WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":price", $this->price);
            $stmt->bindParam(":stock", $this->stock);
            $stmt->bindParam(":id", $this->id);
            return $stmt->execute();
        }

        public function updateStock($id, $stock){
            $query = "UPDATE " . $this->table_name . " SET stock = :stock WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":stock", $stock);
            $stmt->bindParam(":id", $id);
            return $stmt->execute();
        }

        public function getProductById($id){
            $query = "SELECT * FROM " . $this->table_name . " WHERE products.id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function delete($id){
            $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id);
            return $stmt->execute();
        }
    }
?>