

<?php

  $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

  switch($page){
    case 'users':
      $title = 'Users';
      $content = 'views/users/list.php';
      break;

    case 'products':
      $title = 'Products';
      $content = 'views/products/list.php';
      break;

    case 'roles':
      $title = 'Roles';
      $content = 'views/roles.php';
      break;
    
    case 'dashboard':
    default:
      $title = 'Dashboard';
      $content = 'views/dashboard.php';
      break;
  }

  require_once 'layouts/header.php';
  require_once 'layouts/sidebar.php';
  require_once $content;
  require_once 'layouts/footer.php';
?>