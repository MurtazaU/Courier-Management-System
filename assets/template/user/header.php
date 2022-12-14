<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Courier Management System</title>

  <!-- Jquery JS Link -->
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

  <!-- Bootstrap CSS Link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

  <!-- FontAwesome Kit -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- OnScroll JQuery Function -->
  <script src="./assets/JS/userJS/onscroll.js"></script>

  <!-- Home Css Link -->
  <link rel="stylesheet" href="./assets/CSS/userCSS/home.css">

  <!-- Header Css Link -->
  <link rel="stylesheet" href="./assets/CSS/userCSS/header.css">

  <!-- Qualities CSS Link -->
  <link rel="stylesheet" href="./assets/CSS/userCSS/qualites.css">

</head>

<body>

  <!-- Top Bar Starts Here -->
  <div class="bar ">

    <div class="top-bar">
      <!-- Top Navbar -->
      <div>
        <div class="info-container">
          <i class="fa-sharp fa-solid fa-phone info"></i>: (021) 111-202-202
        </div>
        <ul class="info-list-container">
          <i class="fa-brands fa-whatsapp info right-info mt-1"></i>: +92 335-22212312
        </ul>
      </div>
    </div>
  </div>
  <!-- Top Bar Ends Here -->
  <!-- Navbar Starts Here -->
  <nav class="navbar navbar-expand-lg ">
    <div class="container-fluid ">
      <a class="navbar-brand " href="./index.php">
        <img src="./assets/img/web-logo.png" class="logo" alt="logo">
      </a>
      <button class="navbar-toggler  " type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon "></span>
      </button>
      <form class="d-flex ">
        <div class="collapse navbar-collapse" id="navbarContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link text-light  active" href="./index.php"><span class="nav-hover">Home </span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light " href="./about.php"> <span class="nav-hover">About Us </span> </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light " href="#"> <span class="nav-hover"> Our Services</span></a>
            </li>
            <?php
            if (isset($_SESSION['useremail'])) {
            ?>
              <li class="nav-item">
                <a class="nav-link text-light " href="./track-order.php"> <span class="nav-hover"> Track Package </span></a>
              </li>

              <li class="nav-item">
                <a class="nav-link text-light " href="./assets/modules/logout.php"> <span class="nav-hover"> Log Out </span></a>
              </li>

            <?php
            } else {

            ?>
              <li class="nav-item">
                <a class="nav-link text-light " href="./user/registration/authentication.php"> <span class="nav-hover"> Sign In/Sign Up</span></a>
              </li>

            <?php
            }
            ?>
          </ul>
        </div>
      </form>
    </div>
  </nav>
  <br>
  <br>
  <!-- Navbar Ends Here -->
  <!-- Main Navbar Ends Here -->