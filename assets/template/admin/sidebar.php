<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courier Management System: Admin Panel</title>

    <!-- Sidebar CSS Link -->
    <link rel="stylesheet" href="../assets/CSS/adminCSS/sidebar.css">

        <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <!-- FontAwesome Kit -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
<div class="admin-container">

<!-- SideBar Starts Here -->

    <aside>
        <!-- Top Section -->
        <div class="top">
            <div class="logo-container">
                <img src="../assets/img/web-logo.png" class="logo" alt="Logo">
            </div>
            <div class="close" id="close-btn">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>

        <!-- Main Section -->
        <div class="sidebar">
            <!-- SideBar Links -->
            <a href="#" class="sidenav-link-container active">
                <i class="fa-solid fa-house sidenav-icon"></i>
                <h2 class="sidenav-link">Dashboard</h2>
            </a>
            <a href="#" class="sidenav-link-container">
                <i class="fa-solid fa-user sidenav-icon"></i>
                <h2 class="sidenav-link">Customers</h2>
            </a>
            <a href="#" class="sidenav-link-container">
                <i class="fa-solid fa-money-bill sidenav-icon"></i>
                <h2 class="sidenav-link">Orders</h2>
            </a>
            <a href="#" class="sidenav-link-container">
                <i class="fa-solid fa-chart-simple sidenav-icon"></i>
                <h2 class="sidenav-link">Analytics</h2>
            </a>
            <a href="#" class="sidenav-link-container">
                <i class="fa-solid fa-message sidenav-icon"></i>
                <h2 class="sidenav-link">Messages</h2>
                <!-- Message Count -->
                <span class="message-count">26</span>
            </a>
            <a href="#" class="sidenav-link-container">
                <i class="fa-solid fa-table-list sidenav-icon"></i>
                <h2 class="sidenav-link">Products</h2>
            </a>
            <a href="#" class="sidenav-link-container">
                <i class="fa-solid fa-circle-info sidenav-icon"></i>
                <h2 class="sidenav-link">Reports</h2>
            </a>
            <a href="#" class="sidenav-link-container">
                <i class="fa-solid fa-gear sidenav-icon"></i>
                <h2 class="sidenav-link">Settings</h2>
            </a>
            <a href="#" class="sidenav-link-container">
                <i class="fa-solid fa-plus sidenav-icon"></i>
                <h2 class="sidenav-link">Add Agent</h2>
            </a>
            <a href="#" class="sidenav-link-container">
                <i class="fa-solid fa-right-from-bracket sidenav-icon"></i>
                <h2 class="sidenav-link">Log Out</h2>
            </a>
            
        </div>
    </aside>
    <!-- Sidebar Ends Here -->