<?php
    require_once 'config/Database.php';
    require_once 'models/Sale.php';

    $db = new Database();
    $conn = $db->getConnection();

    $data = new Sale($conn);
    $sales = $data->getAllSales();
?>

<!--begin::Row-->
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Data Penjualan</h3>
                    <a href="?page=create-sale" class="btn btn-success">Tambah Penjualan</a>
                </div>  
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
            <table class="table">
                <thead>
                <tr>
                    <th style="width: 10px">No</th>
                    <th>Nomor Struk</th>
                    <th>Nama Pembeli</th>
                    <th>Total Belanja</th>
                    <th>Tanggal Penjualan</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($sales as $no => $s) : ?>
                        <tr class="align-middle">
                            <td><?= $no+1 ?></td>
                            <td><?= $s['invoice_number'] ?></td>
                            <td><?= $s['customer_name'] ?></td>
                            <td><?= $s['total_amount'] ?></td>
                            <td><?= $s['sale_date'] ?></td>
                            <td>
                                <a class="btn btn-info" href="?page=edit-sale&id=<?= $p['id'] ?>">Edit</a>
                                <a class="btn btn-danger" href="controllers/SaleController.php?delete=<?= $p['id'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus penjualan ini?')">Delete</a>
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
