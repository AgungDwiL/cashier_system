<?php
    session_start();
    require_once __DIR__ . '/../config/Database.php';
    require_once __DIR__ . '/../models/Sale.php';
    require_once __DIR__ . '/../models/SaleDetail.php';
    require_once __DIR__ . '/../models/Product.php';


    class SaleController{
        private $sale;
        private $saleDetail;
        private $product;

        public function __construct()
        {
            $database = new Database();
            $db = $database->getConnection();
            $this->sale = new Sale($db);
            $this->saleDetail = new SaleDetail($db);
            $this->product = new Product($db);
        }

        private function redirectWithMessage($message, $location){
            $_SESSION['success'] = $message;
            header("Location: $location");
            exit();
        }

        function store($customer_name, $total_amount, $products){
            $invoice_number = 'INV-' . time();

            if ($this->sale->create($invoice_number, $customer_name, $total_amount)){
                $sale_id = $this->sale->getLastInsertId();

                foreach ($products as $product){
                    $this->saleDetail->create(
                        $sale_id,
                        $product['product_id'],
                        $product['quantity'],
                        $product['price'],
                        $product['subtotal'],
                    );

                    $p = $this->product->getProductById($product['product_id']);
                    
                    $this->product->id = $p['id'];
                    $this->product->name = $p['name'];
                    $this->product->price = $p['price'];
                    $this->product->stock = $p['stock'] - $product['quantity'];
                    $this->product->update();
                }
                $this->redirectWithMessage("Penjualan berhasil ditambahkan.", "../index.php?page=sales" );
            }
            $this->redirectWithMessage("Penjualan gagal ditambahkan.", "../index.php?page=sales" );
        }

        public function delete($sale_id){
            $this->saleDetail->deleteDetailById($sale_id);
            $this->sale->destroy($sale_id);
            $this->redirectWithMessage("Penjualan berhasil dihapus.", "../index.php?page=sales" );
        }

        function edit($sale_id, $customer_name, $total_amount, $products)
        {
            $this->sale->update($sale_id, $customer_name, $total_amount);
            $this->saleDetail->deleteDetailById($sale_id);

            foreach ($products as $product){
                $this->saleDetail->create(
                    $sale_id,
                    $product['product_id'],
                    $product['quantity'],
                    $product['price'],
                    $product['subtotal'],
                );

                $p = $this->product->getProductById($product['product_id']);
                
                $newStock =  $p['stock'] - $product['quantity'];
                $this->product->updateStock($p['id'], $newStock);
            }
                
            $this->redirectWithMessage("Penjualan berhasil ditambahkan.", "../index.php?page=sales" );
        }
    }

    $saleController = new SaleController();
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])){
        $customer_name = $_POST['customer_name'];
        $total_amount = $_POST['total_amount'];
        $products = $_POST['products'];

        $saleController->store($customer_name, $total_amount, $products);
    } elseif($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])){
        $sale_id = $_POST['sale_id'];
        $customer_name = $_POST['customer_name'];
        $total_amount = $_POST['total_amount'];
        $products = $_POST['products'];

        $saleController->edit($sale_id, $customer_name, $total_amount, $products);
    } elseif(isset($_GET['delete'])){
        $saleController->delete($_GET['delete']);
    }