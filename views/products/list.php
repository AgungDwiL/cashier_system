<?php
    require_once 'config/Database.php';
    require_once 'models/Product.php';

    $db = new Database();
    $conn = $db->getConnection();

    $data = new Product($conn);
    $products = $data->getAllProducts();
?>

<!--begin::Row-->
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Data Produk</h3>
                    <a href="?page=create-product" class="btn btn-success">Tambah Produk</a>
                </div>  
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
            <table class="table">
                <thead>
                <tr>
                    <th style="width: 10px">No</th>
                    <th>Nama Produk</th>
                    <th>Harga Produk</th>
                    <th>Stok Produk</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $no => $p) : ?>
                        <tr class="align-middle">
                            <td><?= $no+1 ?></td>
                            <td><?= $p['name'] ?></td>
                            <td><?= $p['price'] ?></td>
                            <td><?= $p['stock'] ?></td>
                            <td>
                                <a class="btn btn-info" href="?page=edit-product&id=<?= $p['id'] ?>">Edit</a>
                                <a class="btn btn-danger" href="controllers/ProductController.php?delete=<?= $p['id'] ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
