<?php
    require_once 'config/Database.php';
    require_once 'models/Product.php';

    $db = new Database();
    $conn = $db->getConnection();

    $product = new Product($conn);
    $p = $product->getProductById($_GET['id']);
?>

<!--begin::Row-->
<div class="row g-4">
    <!--begin::Col-->
    <div class="col-md-12">
        <!--begin::Quick Example-->
        <div class="card card-primary card-outline mb-4">
            <!--begin::Header-->
            <div class="card-header"><div class="card-title">Edit Produk</div></div>
            <!--end::Header-->
            <!--begin::Form-->
            <form action="controllers/ProductController.php" method="POST">
            <!--begin::Body-->
            <div class="card-body">
                <div class="row">
                    <input type="hidden" value="<?= $p['id']?>" name="id">
                    <div class="mb-3 col-md-4">
                    <label for="name" class="form-label">Nama Produk</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        aria-describedby="name" name="name" placeholder="Nama produk..." value="<?= $p['name'] ?>"/>
                    </div>
                    <div class="mb-3 col-md-4">
                    <label for="price" class="form-label">Harga Produk</label>
                    <input
                        type="number"
                        class="form-control"
                        id="price"
                        aria-describedby="price" name="price" placeholder="Harga produk..." value="<?= $p['price'] ?>" />
                    </div>
                    <div class="mb-3 col-md-4">
                    <label for="stock" class="form-label">Stok Produk</label>
                    <input
                        type="number"
                        class="form-control"
                        id="stock"
                        aria-describedby="stock" name="stock" placeholder="Stok produk..." value="<?= $p['stock'] ?>" />
                    </div>
                </div>
            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
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