<?php
    session_start();
    require_once __DIR__ . "/../config/Database.php";
    require_once __DIR__ . "/../models/Product.php";

    $db = new Database();
    $conn = $db->getConnection();
    $product = new Product($conn);

    if(isset($_POST['create']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
        $product->name = $_POST['name'];
        $product->price = $_POST['price'];
        $product->stock = $_POST['stock'];

        if($product->create()){
            $_SESSION['success'] = 'Produk berhasil ditambahkan.';
            header('Location: ../index.php?page-product');
        }
    }

    if(isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
        $product->id = $_POST['id'];
        $product->name = $_POST['name'];
        $product->price = $_POST['price'];
        $product->stock = $_POST['stock'];

        if($product->update()){
            $_SESSION['success'] = 'Produk berhasil diperbarui.';
            header('Location: ../index.php?page-product');
        }
    }

    if(isset($_GET['delete'])){
        $product->delete($_GET['delete']);
        $_SESSION['success'] = "Produk berhasil dihapus";
        header('Location: ../index.php?page-product');
    }
?>