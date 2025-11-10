<?php
    require_once 'config/Database.php';
    require_once 'models/Role.php';

    $db = new Database();
    $conn = $db->getConnection();

    $data = new Role($conn);
    $roles = $data->getAllRoles();
?>

<!--begin::Row-->
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Data Roles</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
            <table class="table">
                <thead>
                <tr>
                    <th style="width: 10px">No</th>
                    <th>Nama Role</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($roles as $no => $r) : ?>
                        <tr class="align-middle">
                            <td><?= $no+1 ?></td>
                            <td><?= $r['name'] ?></td>
                            
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
