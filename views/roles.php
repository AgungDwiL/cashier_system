<?php
    require_once 'config/Database.php';
    require_once 'models/Role.php';

    $db = new Database();
    $conn = $db->getConnection();

    $data = new Role($conn);
    $roles = $data->getAllRoles();
?>

<table>
    <thead>
        <tr>
            <td>No</td>
            <td>Nama Role</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($roles as $no => $r) : ?>
            <tr>
                <td><?= $no+1 ?></td>
                <td><?= $r['name'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>