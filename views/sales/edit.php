<?php 
    require_once 'config/Database.php';
    require_once 'models/Product.php';
    require_once 'models/Sale.php';
    require_once 'models/SaleDetail.php';

    $db = new Database();
    $conn = $db->getConnection();

    $product = new Product($conn);
    $sale = new Sale($conn);
    $saleDetail = new SaleDetail($conn);

    $products = $product->getAllProducts();
    $sale_id = $_GET['id'];
    $sale_data = $sale->getSaleById($sale_id);
    $sale_details = $saleDetail->getDetailsBySaleId($sale_id);
?>

<!--begin::Row-->
<div class="row g-4">
    <!--begin::Col-->
    <div class="col-md-12">
        <!--begin::Quick Example-->
        <div class="card card-primary card-outline mb-4">
            <!--begin::Header-->
            <div class="card-header"><div class="card-title">Edit Penjualan</div></div>
            <!--end::Header-->
            <!--begin::Form-->
            <form action="controllers/SaleController.php" method="POST">
            <input type="hidden" name="sale_id" value="<?= $sale_id ?>" >
            <!--begin::Body-->
            <div class="card-body">
                <div class="mb-3">
                    <label for="customer_name" class="form_label">Nama Pelanggan</label>
                    <input type="text" id="customer_name" placeholder="Nama Pelanggan..." name="customer_name" class="form-control" required value="<?= $sale_data['customer_name'] ?>" >
                </div>
                <div class="mb-3">
                    <label for="products" class="form_label">Pilih Produk</label>
                    <div id="product-list">
                        <?php foreach($sale_details as $i => $detail) : ?>
                            <div class="row mb-2 product-item">
                                <div class="col-md-4">
                                    <select class="form-control product" name="products[<?= $i ?>][product_id]" required>
                                        <option disabled selected>-- Pilih Produk --</option>
                                        <?php foreach ($products as $p) : ?>
                                            <option value="<?= $p['id'] ?>" 
                                                <?= $p['stock'] == 0 ? 'disabled' : '' ?>
                                                <?= $p['id'] == $detail['product_id'] ? 'selected' : '' ?>
                                                data-price="<?= $p['price'] ?>"
                                                data-stock="<?= $p['stock'] ?>"
                                            ><?= $p['name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-muted price-label"> Harga: - | Stok: -</small>
                                    <input type="hidden" name="products[0][price]" class="hidden_price">
                                </div>
                                <div class="col-md-4">
                                    <input type="number" placeholder="Jumlah Penjualan" class="form-control quantity" name="products[0][quantity]" required min="1" value="1">
                                </div>
                                <div class="col-md-4">
                                    <input type="number" placeholder="Subtotal" class="form-control subtotal" name="products[0][subtotal]" required readonly>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <button class="btn btn-success mt-1" style="width: 100%;" type="button" id="add-product">Tambah Produk</button>
                </div>
                 <div class="mb-3">
                    <label for="total_amount" class="form_label">Total Penjualan</label>
                    <input type="number" id="total_amount" placeholder="Total Penjualan..." name="total_amount" class="form-control" required readonly>
                </div>
            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button type="submit" name="create" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!--end::Footer-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Quick Example-->
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->

<script>
document.addEventListener("DOMContentLoaded", function() {
    function updatePrice(event) {
        var row = event.target.closest('.row');
        var subtotalInput = row.querySelector('.subtotal');
        var quantityInput = row.querySelector('.quantity');
        var selectedProduct = row.querySelector('.product').selectedOptions[0];
        var priceLabel = row.querySelector('.price-label');
        var hiddenPriceInput = row.querySelector('.hidden_price');

        var pricePerItem = selectedProduct ? parseFloat(selectedProduct.getAttribute("data-price")) || 0 : 0;
        var stockAvailable = selectedProduct ? parseInt(selectedProduct.getAttribute("data-stock")) || 0 : 0;
        var quantity = quantityInput.value ? parseInt(quantityInput.value) : 1;

        priceLabel.textContent = "Harga: Rp" + pricePerItem.toLocaleString("id-ID") + " | Stok: " + stockAvailable;
        hiddenPriceInput.value = pricePerItem;

        quantityInput.max = stockAvailable;
        if (quantity > stockAvailable) {
            quantityInput.value = stockAvailable;
            quantity = stockAvailable;
        }

        subtotalInput.value = pricePerItem * quantity;
        updateTotal();
    }

    function updateTotal() {
        var totalAmountInput = document.getElementById("total_amount");
        var total = 0;

        document.querySelectorAll(".subtotal").forEach(function(subtotalInput) {
            total += parseFloat(subtotalInput.value) || 0;
        });

        totalAmountInput.value = total;
    }

    function addRemoveEventListeners() {
        document.querySelectorAll(".remove-product").forEach(button => {
            button.addEventListener("click", function() {
                this.closest(".row").remove();
                updateTotal();
            });
        });
    }

    // Tambahkan event listener untuk produk dan quantity
    document.querySelectorAll(".product").forEach(el => el.addEventListener("change", updatePrice));
    document.querySelectorAll(".quantity").forEach(el => el.addEventListener("input", updatePrice));

    // Inisialisasi awal
    document.querySelectorAll(".product").forEach(el => updatePrice({ target: el }));

    // GANTI INI -> pakai add-product, bukan add-button
    document.getElementById("add-product").addEventListener("click", function() {
        var productList = document.getElementById("product-list");
        var count = productList.getElementsByClassName("row").length;

        var newRow = document.createElement("div");
        newRow.className = "row mb-2";
        newRow.innerHTML = `
            <div class="col-md-4">
                <select class="form-control product" name="products[${count}][product_id]" required>
                    <option value="">Pilih Produk</option>
                    <?php foreach ($products as $product) : ?>
                        <option value="<?= $product['id'] ?>" 
                                data-price="<?= $product['price'] ?>" 
                                data-stock="<?= $product['stock'] ?>"
                                <?= $product['stock'] == 0 ? 'disabled' : '' ?>>
                            <?= $product['stock'] == 0 ? $product['name'] . ' (Stok Habis)' : $product['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <small class="text-muted price-label">Harga: - | Stok: -</small>
                <input type="hidden" class="hidden_price" name="products[${count}][price]"> 
            </div>
            <div class="col-md-3">
                <input type="number" placeholder="Jumlah" class="form-control quantity" name="products[${count}][quantity]" required min="1" value="1">
            </div>
            <div class="col-md-3">
                <input type="text" placeholder="Subtotal" class="form-control subtotal" name="products[${count}][subtotal]" required readonly>
            </div>
            <div class="col-md-2 d-flex align-items-center">
                <button type="button" class="btn btn-danger remove-product">❌</button>
            </div>
        `;

        productList.appendChild(newRow);
        newRow.querySelector(".product").addEventListener("change", updatePrice);
        newRow.querySelector(".quantity").addEventListener("input", updatePrice);
        addRemoveEventListeners();
    });

    addRemoveEventListeners();
});
</script>