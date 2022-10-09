<?php
session_start();
if (!isset($_SESSION['admin-email'])) {
    header("location: ./login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Main Sidebar CSS -->
    <link rel="stylesheet" href="../assets/CSS/adminCSS/main-admin.css">

    <!-- Boxicon CSS -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <!-- Analytics CSS -->
    <link rel="stylesheet" href="../assets/CSS/adminCSS/analytics.css">

    <!-- FontAwesome Kit -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Jquery JS Link -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <!-- AJAX Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <!-- Table CSS -->
    <link rel="stylesheet" href="../assets/CSS/adminCSS/table.css">


    <title>Admin</title>
</head>

<body>
    <nav class="sidebar open">
        <header>
            <div class="image-text">
                <span class="image">
                    <!--<img src="logo.png" alt="">-->
                </span>

                <div class="text logo-text">
                    <img src="../assets/img/web-logo.png" alt="Logo" height="50px">
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search...">
                </li>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="./dashboard.php">
                            <i class="fa-solid fa-house icon"></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="./courier.php">
                            <i class="fa-solid fa-boxes-stacked icon"></i>
                            <span class="text nav-text">View/Manage Couriers</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="./new-courier.php">
                            <i class="fa-solid fa-box icon"></i>
                            <span class="text nav-text">Create New Courier</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="./courier-status.php">
                            <i class="fa-solid fa-cube icon"></i>
                            <span class="text nav-text">Manage Courier Status</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="./agent.php">
                            <i class='fa-solid fa-user-secret icon'></i>
                            <span class="text nav-text">Manage Agents</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="./new-agent.php">
                            <i class='fa-solid fa-plus icon'></i>
                            <span class="text nav-text">Create New Agent</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="./customer.php">
                            <i class="fa-solid fa-users icon"></i>
                            <span class="text nav-text">Manage Customer</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="../assets/modules/logout.php">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>

            </div>
        </div>

    </nav>

    <!-- Main Body Starts Here -->
    <section class="home">