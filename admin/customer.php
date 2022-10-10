<?php
include('../assets/template/admin/header.php');

include('../assets/modules/dbconnection.php');

// New Customer Analytics
$date = date("Y-m-d");
$newCustomers = $con->prepare('select * from customer where CustomerRegistrationDate = ?');
$newCustomers->bindParam(1, $date);
$newCustomers->execute();
$newCustomersCount = $newCustomers->rowCount();

// All Customers Details
$customers = $con->prepare('select * from customer');
$customers->execute();
// Total Courier Count
$totalCustomersCount = $customers->rowCount();
$customersRecord = $customers->fetchAll(PDO::FETCH_OBJ);

// Countrier
$country = $con->prepare('select CountryId, CountryName from country');
$country->execute();
$countryRecord = $country->fetchAll(PDO::FETCH_OBJ);

?>

<!-- Main Content Starts Here -->
<div class="container">
    <h3 class="text mt-3">Customers</h3>
    <!-- Analytics Start Here -->
    <div class="row mt-3">
        <div class="main-heading">
            <h2 class="text-center mb-3 text">Analytics</h2>
        </div>
        <!-- Card Starts Here -->
        <div class="col-xl-6 col-lg-6">
            <div class="card l-bg-cherry">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large">
                        <!-- Icon -->
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="mb-4">
                        <!-- Main Heading -->
                        <h6 class="card-title mb-0">New Customers Today</h6>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                                <!-- Body Text -->
                                <?php echo $newCustomersCount ?>
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
        <div class="col-xl-6 col-lg-6">
            <div class="card l-bg-orange-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large">
                        <!-- Icon -->
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="mb-4">
                        <!-- Main Heading -->
                        <h6 class="card-title mb-0">Total Customers</h6>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                                <!-- Body Text -->
                                <?php echo $totalCustomersCount; ?>
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


    </div>
    <!-- Analytics End Here -->

    <!-- Tables Start Here -->

    <div class="row">
        <div class="col-12">
            <!-- Customers -->
            <table class="table desc-table text">
                <!-- Table Head -->
                <thead>
                    <tr>
                        <th class="table-row-head">ID#</th>
                        <th class="table-row-head">Name</th>
                        <th class="table-row-head">Email</th>
                        <th class="table-row-head">Number</th>
                        <th class="table-row-head">Address</th>
                        <th class="table-row-head">Zip Code</th>
                        <th class="table-row-head">City</th>
                        <th class="table-row-head">State</th>
                        <th class="table-row-head">Country</th>
                        <th class="table-row-head">Registration Date</th>
                        <th class="table-row-head">Message</th>
                        <th class="table-row-head">Action</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody>
                    <?php
                    // Main Loop
                    foreach ($customersRecord as $row) {
                    ?>
                        <tr>
                            <th><?php echo $row->CustomerId ?></th>
                            <td class="text"><?php echo $row->CustomerName ?></td>
                            <td class="text"><?php echo $row->CustomerEmail ?></td>
                            <td class="text"><?php echo $row->CustomerNumber ?></td>
                            <td class="text"><?php echo $row->CustomerAddress ?></td>
                            <td class="text"><?php echo $row->CustomerZipCode ?></td>
                            <td class="text"><?php echo $row->CustomerCity ?></td>
                            <td class="text"><?php echo $row->CustomerState ?></td>
                            <td class="text"><?php
                                                foreach ($countryRecord as $country) {
                                                    if ($row->CustomerCountryId == $country->CountryId) {
                                                        echo $country->CountryName;
                                                    }
                                                }
                                                ?></td>
                            <td class="text"><?php echo $row->CustomerRegistrationDate ?></td>
                            <td class="text">
                                <div class="row">
                                    <div class="col-12">
                                        <a href="./send-sms.php?customer-id=<?php echo $row->CustomerId; ?>"><button type="submit" class="btn text"><i class="fa-regular fa-comment"></i></button></a>
                                    </div>
                                </div>
                            </td>
                            <td class="text">
                                <div class="row">
                                    <div class="col-12">
                                        <a href="./delete-customer.php?customer-id=<?php echo $row->CustomerId; ?>"><button type="submit" class="btn text"><i class="fa-solid fa-trash"></i></button></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tables End Here -->
</div>

<!-- Main Content Ends Here -->

<?php
include('../assets/template/admin/footer.php');
?>