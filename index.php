

<?php
  session_start();
  require_once 'config/Auth.php';
  $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

  switch($page){
    case 'users':
      $title = 'Data Pengguna';
      $breadcrumb = ["Home" => "index.php", "Pengguna" => "" ];
      $content = 'views/users/list.php';
      break;
    
    case 'create-user':
      $title = 'Tambah Pengguna';
      $breadcrumb = ["Home" => "index.php", "Pengguna" => "?page=users", "Tambah Pengguna" => "" ];
      $content = 'views/users/create.php';
      break;

    case 'edit-user':
      $title = 'Edit Pengguna';
      $breadcrumb = ["Home" => "index.php", "Pengguna" => "?page=users", "Edit Pengguna" => "" ];
      $content = 'views/users/edit.php';
      break;

    case 'products':
      $title = 'Data Produk';
      $breadcrumb = ["Home" => "index.php", "Produk" => "" ];
      $content = 'views/products/list.php';
      break;
    
    case 'create-product':
      $title = 'Tambah Produk';
      $breadcrumb = ["Home" => "index.php", "Produk" => "?page=products", "Tambah Produk" => "" ];
      $content = 'views/products/create.php';
      break;

    case 'edit-product':
      $title = 'Edit Product';
      $breadcrumb = ["Home" => "index.php", "Produk" => "?page=products", "Edit Product" => "" ];
      $content = 'views/products/edit.php';
      break;
    
    case 'sales':
      $title = 'Data Penjualan';
      $breadcrumb = ["Home" => "index.php", "Penjualan" => "" ];
      $content = 'views/sales/list.php';
      break;

    case 'roles':
      $title = 'Data Role';
      $breadcrumb = ["Home" => "index.php", "Role" => "" ];
      $content = 'views/roles.php';
      break;
    
    case 'dashboard':
    default:
      $title = 'Dashboard';
      $breadcrumb = ["Home" => ""];
      $content = 'views/dashboard.php';
      break;
  }

  require_once 'layouts/header.php';
  require_once 'layouts/sidebar.php';
  require_once $content;
  require_once 'layouts/footer.php';
?>