<?php 
    require_once __DIR__ . '/../config/Database.php';

class Sale{
    private $conn;
    private $table_name = 'sales';

    public function __construct($db)
        {
            $this->conn = $db;
        }
    
    public function getSales(){
        $query = 'SELECT * FROM ' . $this->table_name;
        $stmp = $this->conn->prepare($query);
        return $stmp->fetchAll(PDO::FETCH_ASSOC);
    }
}