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
            $stnt = $this->conn->prepare($query);
            $stnt->execute();
            return $stnt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>