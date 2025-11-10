<?php
    if(!isset($_SESSION['user'])){
        header("Location: /cashier_system/login.php");
        exit();
    }