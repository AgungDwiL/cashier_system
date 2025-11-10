<!--begin::Row-->
<div class="row g-4">
    <!--begin::Col-->
    <div class="col-md-12">
        <!--begin::Quick Example-->
        <div class="card card-primary card-outline mb-4">
            <!--begin::Header-->
            <div class="card-header"><div class="card-title">Tambah Produk</div></div>
            <!--end::Header-->
            <!--begin::Form-->
            <form action="controllers/ProductController.php" method="POST">
            <!--begin::Body-->
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-md-4">
                    <label for="name" class="form-label">Nama Produk</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        aria-describedby="name" name="name" placeholder="Nama produk..."/>
                    </div>
                    <div class="mb-3 col-md-4">
                    <label for="price" class="form-label">Harga Produk</label>
                    <input
                        type="text"
                        class="form-control"
                        id="price"
                        aria-describedby="price" name="price" placeholder="Harga produk..."/>
                    </div>
                    <div class="mb-3 col-md-4">
                    <label for="stock" class="form-label">Nama Produk</label>
                    <input
                        type="text"
                        class="form-control"
                        id="stock"
                        aria-describedby="stock" name="stock" placeholder="Stok produk..."/>
                    </div>
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