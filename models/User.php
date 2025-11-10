<?php
    require_once __DIR__ . "/../config/Database.php";

    class User{
        private $conn;
        private $table_name = 'users';

        private $id;
        private $username;
        private $password;
        private $role;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function getAllUsers(){
            $query = "SELECT users.*, roles.name as role FROM " . $this->table_name . " LEFT JOIN roles ON users.role_id = roles.id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function create($username, $password, $role_id){
            $query = "INSERT INTO " . $this->table_name . " (username, password, role_id) VALUES (:username, :password, :role_id)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", password_hash($password, PASSWORD_BCRYPT));
            $stmt->bindParam(":role_id", $role_id);
            return $stmt->execute();
        }

        public function update($id, $username, $role_id){
            $query = "UPDATE " . $this->table_name . " SET username = :username, role_id = :role_id WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":role_id", $role_id);
            $stmt->bindParam(":id", $id);
            return $stmt->execute();
        }

        public function getUserById($id){
            $query = "SELECT users.*, roles.name as role FROM " . $this->table_name . " LEFT JOIN roles ON users.role_id = roles.id WHERE users.id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>