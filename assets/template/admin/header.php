<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Admin  
  </title>
  <!-- Links Starts Here -->

  <!-- Main Admin CSS Links -->
  <link id="pagestyle" href="../assets/css/adminCSS/main-admin.css" rel="stylesheet" />
  <link href="../assets/css/adminCSS/custom-admin.css" rel="stylesheet" />

  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/adminCSS/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->

  <!-- Links Ends Here -->
</head>

<!-- Body Starts Here -->
<body class="g-sidenav-show  bg-gray-100">
  <!-- Sidebar Starts here -->
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#">
        <img src="../assets/img/web-logo.png" class="navbar-brand-img h-100" alt="main_logo">
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <!-- Nav-links Container Starts Here -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="#" >
              <!-- Icon -->
                <i class="fa fa-home"></i>
            <!-- Icon Text -->
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./pages/tables.html">
              <!-- Icon -->
              <i class="fa fa-table"></i>
              <!-- Icon Text -->
            <span class="nav-link-text ms-1">Tables</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="./pages/billing.html">
            <!-- Icon -->
            <i class="fa fa-money-bill"></i>
            <span class="nav-link-text ms-1">Billing</span>
          </a>
        </li>
      </ul>
      <!-- Nav-Links Ends Here -->
    </div>
    <!-- Sidebar Footer Starts Here -->
    <div class="sidenav-footer mx-3 ">
      <a class="btn bg-gradient-primary mt-3 w-100" href="../assets/modules/logout.php">Log Out</a>
    </div>
    <!-- Sidebar Footer Ends Here -->
  </aside>
  <!-- Sidebar Ends Here -->

<!-- Main Body Starts Here -->
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div>
          </div>
          <!-- Navbar Links Start Here -->
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Sign In</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->