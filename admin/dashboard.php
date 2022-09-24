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
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <!-- Card Starts Here -->
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <!-- Card Heading -->
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Orders</p>
                    <!-- Card Number -->
                    <h5 class="font-weight-bolder mb-0 color-orange">
                      <span class="color-orange">
                      +53,525
                      </span>
                    </h5>
                  </div>
                </div>
                <!-- Card Icon -->
                <div class="col-4 text-end">
                  <i class="fa fa-money color-orange"></i>
                </div>
              </div>
            </div>
          </div>
          <!-- Card Ends Here -->
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <!-- Card Starts Here -->
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <!-- Card Heading -->
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Customers</p>
                    <!-- Card Number -->
                    <h5 class="font-weight-bolder mb-0">
                      <span class="color-orange">
                        2,353
                      </span>
                    </h5>
                  </div>
                </div>
                <!-- Card Icon -->
                <div class="col-4 text-end">
                  <i class="fa fa-users color-orange"></i>
                </div>
              </div>
            </div>
            <!-- Card Ends Here -->
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <!-- Card Starts Here -->
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <!-- Card Heading -->
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Agents</p>
                    <!-- Card Number -->
                    <h5 class="font-weight-bolder mb-0">
                      <span class="color-orange">
                        +3,462
                      </span>
                    </h5>
                  </div>
                </div>
                <!-- Card Icon -->
                <div class="col-4 text-end">
                  <i class="fa fa-user color-orange"></i>
                </div>
              </div>
            </div>
            <!-- Card Ends Here -->
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <!-- Card Starts Here -->
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <!-- Card Heading -->
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Packages</p>
                    <!-- Card Number -->
                    <h5 class="font-weight-bolder mb-0">
                      <span class="color-orange">$103,430</span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <i class="fa fa-box color-orange"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Card Ends Here -->


        <!-- Main Tables Start Here -->
        <div class="row mt-5">

         <!-- Col Starts Here -->
         <div class="col-xl-6 col-sm-12">
         <div class="card">
            <!-- Card Starts Here -->
            <div class="card-body">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <!-- Card Heading -->
                    <p class="text-sm text-capitalize font-weight-bold "> <h5 class="color-orange text-center">Customers</h5></p>
                    <!-- Card Table -->
                    <table class="table ">
                      <!-- Table Head -->
                      <tr>
                        <th>ID#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact No.</th>
                        <th>Country</th>
                      </tr>
                    <!-- Table Body -->
                    <tbody>
                      <!-- Looping Over Data -->
                      <?php 
                      foreach($customerRecord as $row){
                        ?>
                      <tr class="table-row">
                        <td> <?php echo $row->CustomerId ?> </td>
                        <td> <?php echo $row->CustomerName ?> </td>
                        <td> <?php echo $row->CustomerEmail ?> </td>
                        <td> <?php echo $row->CustomerNumber ?> </td>
                        <td> <?php echo $row->CustomerCountryId ?> </td>
                      </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                  </table>
                  </div>
                </div>

                  
                </div>
              </div>
            </div>
          </div>
         <!-- Col Ends Here -->
          <div class="col-6"> 
            <div class="text-center">
              Ok
            </div>
          </div>
        </div>
        <!-- Main Tables End Here -->
      </div>


  <!-- Admin Footer -->
  <?php
  include('../assets/template/admin/footer.php');
  ?>