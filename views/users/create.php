<?php
    require_once 'config/Database.php';
    require_once 'models/Role.php';

    $db = new Database();
    $conn = $db->getConnection();

    $role = new Role($conn);
    $roles = $role->getAllRoles();
?>

<!--begin::Row-->
<div class="row g-4">
    <!--begin::Col-->
    <div class="col-md-12">
        <!--begin::Quick Example-->
        <div class="card card-primary card-outline mb-4">
            <!--begin::Header-->
            <div class="card-header"><div class="card-title">Tambah Pengguna</div></div>
            <!--end::Header-->
            <!--begin::Form-->
            <form action="controllers/UserController.php" method="POST">
            <!--begin::Body-->
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-md-4">
                    <label for="username" class="form-label">Username</label>
                    <input
                        type="text"
                        class="form-control"
                        id="username"
                        aria-describedby="username" name="username" placeholder="username"/>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="password" class="form-label">Password</label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            aria-describedby="password" name="password" placeholder="password"/>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="role" class="form-label">Role</label>
                        <select name="role_id" id="role_id" class="form-control">
                            <option disabled selected>-- Pilih Role Pengguna --</option>
                            <?php foreach ($roles as $r) : ?>
                                <option value="<?= $r['id'] ?>"><?= $r['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
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