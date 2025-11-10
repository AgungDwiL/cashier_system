<?php 
    require_once __DIR__ . '/../config/Database.php';

class Sale{
    private $conn;
    private $table_name = 'sale_details';

    public function __construct($db)
        {
            $this->conn = $db;
        }
    
    public function getDetailsBySaleId($sale_id){
        $query = 'SELECT sale_details.*, products.name as product_name FROM ' . $this->table_name . ' LEFT JOIN products on sales_details.product_id = products.id WHERE sale_id = :sale_id';
        $stmp = $this->conn->prepare($query);
        $stmp->bindParam(':sale_id', $sale_id);
        return $stmp->fetchAll(PDO::FETCH_ASSOC);
    }
}