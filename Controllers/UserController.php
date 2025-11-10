<?php 
    require_once __DIR__ . "/../config/Database.php";
    require_once __DIR__ . "/../models/User.php";

    $db = new Database();
    $conn = $db->getConnection();
    $user = new User($conn);

    if(isset($_POST['create']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role_id = $_POST['role_id'];

        if($user->create($username, $password, $role_id)){
            $_SESSION['success'] = 'Pengguna berhasil ditambahkan.';
            header('Location: ../index.php?page-user');
        }
    }
?>