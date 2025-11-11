<?php
    require_once 'config/Database.php';
    require_once 'models/Sale.php';
    require_once 'models/SaleDetail.php';

    $db = new Database();
    $conn = $db->getConnection();

    $sale = new Sale($conn);
    $saleDetail = new SaleDetail($conn);

    $sale_id = $_GET['id'];
    $sale_data = $sale->getSaleById($sale_id);
    $sale_details = $saleDetail->getDetailsBySaleId($sale_id);
?>

<!--begin::Row-->
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr>
                        <td colspan="2">Nomor Faktur</td>
                        <td colspan="3"><?= $sale_data['invoice_number'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Nomor Pelanggan</td>
                        <td colspan="3"><?= $sale_data['customer_name'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Total Penjualan</td>
                        <td colspan="3">Rp<?= number_format($sale_data['total_amount'], 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Tanggal Penjualan</td>
                        <td colspan="3"><?= date("d M Y", strtotime($sale_data['sales_date']))  ?></td>
                    </tr>
                <tr>
                    <th style="width: 10px">No</th>
                    <th>Nama Produk</th>
                    <th>Kuantitas</th>
                    <th>Harga Per Unit</th>
                    <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($sale_details as $no => $detail) : ?>
                        <tr class="align-middle">
                            <td><?= $no+1 ?></td>
                            <td><?= $detail['product_name'] ?></td>
                            <td><?= $detail['quantity'] ?></td>
                            <td><?= $detail['price'] ?></td>
                            <td>Rp<?= number_format($detail['subtotal'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
