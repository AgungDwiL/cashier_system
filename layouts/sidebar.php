<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
<!--begin::Sidebar Brand-->
<div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="./index.html" class="brand-link">
    <!--begin::Brand Image-->
    <img
        src="template/dist/assets/img/AdminLTELogo.png"
        alt="AdminLTE Logo"
        class="brand-image opacity-75 shadow"
    />
    <!--end::Brand Image-->
    <!--begin::Brand Text-->
    <span class="brand-text fw-light">AdminLTE 4</span>
    <!--end::Brand Text-->
    </a>
    <!--end::Brand Link-->
</div>
<!--end::Sidebar Brand-->
<!--begin::Sidebar Wrapper-->
<div class="sidebar-wrapper">
    <nav class="mt-2">
    <!--begin::Sidebar Menu-->
    <ul
        class="nav sidebar-menu flex-column"
        data-lte-toggle="treeview"
        role="menu"
        data-accordion="false"
    >
        <li class="nav-item">
        <a href="?page=dashboard" class="nav-link">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>Dashboard</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="?page=products" class="nav-link">
            <i class="nav-icon bi bi-box"></i>
            <p>Produk</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="?page=users" class="nav-link">
            <i class="nav-icon bi bi-people"></i>
            <p>Pengguna</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="?page=roles" class="nav-link">
            <i class="nav-icon bi bi-gear"></i>
            <p>Role</p>
        </a>
        </li>
    </ul>
    <!--end::Sidebar Menu-->
    </nav>
</div>
<!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->

<!--begin::App Main-->
<main class="app-main">
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!-- begin::Row-->
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0"><?php echo $title; ?></h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <?php 
              $lastKey = array_key_last($breadcrumb);
              foreach ($breadcrumb as $name => $link){
                if ($link){
                  echo "<li class='breadcrumb-item'>
                          <a href='$link'>$name</a>
                        </li>";
                } else{
                  echo "<li class='breadcrumb-item' active aria-current='page'>$name</li>";
                }
              }
            ?>
          </ol>
        </div>
      </div>
      <!--end::Row -->
    </div>
    <!--end::Container-->
  </div>
  <!--end::App Content Header-->
        
  <!--begin::App Content-->
  <div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">