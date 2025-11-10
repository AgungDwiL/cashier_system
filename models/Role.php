<?php
    require_once __DIR__ . "/../config/Database.php";

    class Role{
        private $conn;
        private $table_name = 'roles';

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function getAllRoles(){
            $query = "SELECT * FROM " . $this->table_name;
            $stnt = $this->conn->prepare($query);
            $stnt->execute();
            return $stnt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>