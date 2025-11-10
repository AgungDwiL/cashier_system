<?php
    require_once 'config/Database.php';
    require_once 'models/User.php';

    $db = new Database();
    $conn = $db->getConnection();

    $data = new User($conn);
    $users = $data->getAllUsers();
?>

<!--begin::Row-->
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Data Pengguna</h3>
                    <a href="?page=create-user" class="btn btn-success">Tambah Penguna</a>
                </div>  
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
            <table class="table">
                <thead>
                <tr>
                    <th style="width: 10px">No</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $no => $u) : ?>
                        <tr class="align-middle">
                            <td><?= $no+1 ?></td>
                            <td><?= $u['username'] ?></td>
                            <td><?= $u['role'] ?></td>
                            <td>
                                <a class="btn btn-info" href="?page=edit-user&id=<?= $u['id'] ?>">Edit</a>
                                <a class="btn btn-danger" href="controllers/UserController.php?delete=<?= $u['id'] ?>">Delete</a>
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
