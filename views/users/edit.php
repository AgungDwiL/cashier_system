<?php
    require_once 'config/Database.php';
    require_once 'models/Role.php';
    require_once 'models/User.php';

    $db = new Database();
    $conn = $db->getConnection();

    $role = new Role($conn);
    $roles = $role->getAllRoles();

    $user = new User($conn);
    $u = $user->getUserById($_GET['id']);
?>

<!--begin::Row-->
<div class="row g-4">
    <!--begin::Col-->
    <div class="col-md-12">
        <!--begin::Quick Example-->
        <div class="card card-primary card-outline mb-4">
            <!--begin::Header-->
            <div class="card-header"><div class="card-title">Edit Pengguna</div></div>
            <!--end::Header-->
            <!--begin::Form-->
            <form action="controllers/UserController.php" method="POST">
            <!--begin::Body-->
            <div class="card-body">
                <div class="row">
                    <input type="hidden" value="<?= $u['id']?>" name="id">
                    <div class="mb-3 col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input
                        type="text"
                        class="form-control"
                        id="username"
                        aria-describedby="username" name="username" placeholder="username" value="<?= $u['username'] ?>"/>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="role" class="form-label">Role</label>
                        <select name="role_id" id="role_id" class="form-control">
                            <option disabled selected>-- Pilih Role Pengguna --</option>
                            <?php foreach ($roles as $r) : ?>
                                <option value="<?= $r['id'] ?>" <?= $u['role_id'] == $r['id'] ? 'selected' : ''?>><?= $r['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
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