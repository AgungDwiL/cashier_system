

<?php

  $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

  switch($page){
    case 'users':
      $content = 'views/users/list.php';
      break;

    case 'products':
      $content = 'views/products/list.php';
      break;

    case 'roles':
      $content = 'views/roles.php';
      break;
    
    case 'dashboard':
    default:
      $content = 'views/dashboard.php';
      break;
  }

  require_once 'layouts/header.php';
  require_once 'layouts/sidebar.php';
  require_once $content;
  require_once 'layouts/footer.php';
?>