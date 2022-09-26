<?php 
include('../assets/template/admin/header.php');
include('../assets/modules/dbconnection.php');

// All Customers Table
$allCustomers = $con -> prepare('select * from customer');
$allCustomers -> execute();
$customerCount =  $allCustomers -> rowCount();
$customerRecord = $allCustomers -> fetchAll(PDO::FETCH_OBJ);
?>

<!-- Main Body Starts Here -->
<div class="container">

<!-- Analytics Start Here -->
    <div class="row mt-3">
      <div class="main-heading">
        <h2 class="text-center mb-3">Today's Analytics</h2>
      </div>
          <!-- Card Starts Here -->
        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-cherry">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large">
                      <!-- Icon -->
                      <i class="fas fa-box"></i>
                    </div>
                    <div class="mb-4">
                      <!-- Main Heading -->
                        <h6 class="card-title mb-0">New Packages</h6>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                              <!-- Body Text -->
                                3,243
                            </h2>
                        </div>
                    </div>
                    <!-- Progress Line -->
                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                        <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
            <!-- Card Ends Here -->
            <!-- Card Starts Here -->
        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-orange-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large">
                      <!-- Icon -->
                      <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="mb-4">
                        <h6 class="card-title mb-0">Newly Delivered Packages</h6>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                                $11.61k
                            </h2>
                        </div>
                        <div class="col-4 text-right">
                            <span>2.5% <i class="fa fa-arrow-up"></i></span>
                        </div>
                    </div>
                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                        <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card Ends Here -->
            <!-- Card Starts Here -->
        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-blue-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large">
                      <!-- Icon -->
                      <i class="fas fa-users"></i>
                    </div>
                    <div class="mb-4">
                      <!-- Main Heading -->
                        <h6 class="card-title mb-0">New Users</h6>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                              <!-- Body Text -->
                                15.07k
                            </h2>
                        </div>
                    </div>
                    <!-- Progress Underline -->
                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                        <div class="progress-bar l-bg-green" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card Ends Here -->
        <!-- Card Starts Here -->
        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-green-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large"><i class="fas fa-ticket-alt"></i></div>
                    <div class="mb-4">
                        <h6 class="card-title mb-0">New Agents</h6>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                                578
                            </h2>
                        </div>
                        <div class="col-4 text-right">
                            <span>10% <i class="fa fa-arrow-up"></i></span>
                        </div>
                    </div>
                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                        <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card Ends Here -->
       
    </div>
  <!-- Analytics End Here -->
</div>



  <!-- Admin Footer -->
  <?php
  include('../assets/template/admin/footer.php');
  ?>