<?php
include('../assets/template/admin/header.php');
include('../assets/modules/dbconnection.php');

// Data
$date = date("Y-m-d");
// New Couriers
$newCouriers = $con->prepare('select PackageId from package where PackageDateReceived = ?');
$newCouriers->bindParam(1, $date);
$newCouriers->execute();
$newCouriersCount = $newCouriers->rowCount();

// New Customers
$customer = $con->prepare('select CustomerId from customer where CustomerRegistrationDate = ?');
$customer->bindParam(1, $date);
$customer->execute();
$newCustomer = $customer->rowCount();

// New Agents
$agent = $con->prepare('select AgentId from agent where AgentRegistrationDate = ?');
$agent->bindParam(1, $date);
$agent->execute();
$newAgent = $agent->rowCount();

// Total Couriers
$courier = $con->prepare('select PackageId, PackageSenderId, PackageAgentId, PackageCode, PackageStatus, PackageReceiverName from package ORDER BY RAND() Limit 6');
$courier->execute();
$courierRecord = $courier->fetchAll(PDO::FETCH_OBJ);

// Agents For Courier
$courierAgent = $con->prepare('select AgentId, AgentEmail from agent');
$courierAgent->execute();
$courierAgentRecord = $courierAgent->fetchAll(PDO::FETCH_OBJ);

// Customer For Courier
$courierCustomer = $con->prepare('select CustomerId, CustomerEmail from customer');
$courierCustomer->execute();
$courierCustomerRecord = $courierCustomer->fetchAll(PDO::FETCH_OBJ);

// Received Courier
$received = "Received";
$receivedCourier = $con->prepare('select PackageId from package where PackageStatus = ?');
$receivedCourier->bindParam(1, $received);
$receivedCourier->execute();
$receivedCourierCount = $receivedCourier->rowCount();

// In Progress Courier
$inProgress = "In Progress";
$inProgressCourier = $con->prepare('select PackageId from package where PackageStatus = ?');
$inProgressCourier->bindParam(1, $inProgress);
$inProgressCourier->execute();
$inProgressCourierCount = $inProgressCourier->rowCount();

// Delivered Courier
$delivered = "Received";
$deliveredCourier = $con->prepare('select PackageId from package where PackageStatus = ?');
$deliveredCourier->bindParam(1, $received);
$deliveredCourier->execute();
$deliveredCourierCount = $deliveredCourier->rowCount();

// Customer
$customer = $con->prepare('select CustomerId, CustomerName, CustomerEmail, CustomerCountryId, CustomerNumber from customer ORDER BY RAND() Limit 4');
$customer->execute();
$customerRecord = $customer->fetchAll(PDO::FETCH_OBJ);

// Agents
$agent = $con->prepare('select AgentId, AgentEmail, AgentRegistrationDate, AgentFranchiseId, AgentName from agent ORDER BY RAND() Limit 4');
$agent->execute();
$agentRecord = $agent->fetchAll(PDO::FETCH_OBJ);

// Agent Franchise
$agentFranchise = $con->prepare('select FranchiseId, FranchiseName from franchise');
$agentFranchise->execute();
$agentFranchiseRecord = $agentFranchise->fetchAll(PDO::FETCH_OBJ);
$totalFranchiseCount = $agentFranchise->rowCount();

// Franchise
$franchise = $con->prepare('select FranchiseId, FranchiseName, FranchiseCode, FranchiseAddress, FranchiseCity, FranchiseState, FranchiseCountryId from franchise ORDER BY RAND()');
$franchise->execute();
$franchiseRecord = $franchise->fetchAll(PDO::FETCH_OBJ);

// Counties For All
$country = $con->prepare('select CountryId, CountryName from country');
$country->execute();
$countryRecord = $country->fetchAll(PDO::FETCH_OBJ);

?>

<!-- Main Body Starts Here -->
<div class="container">
    <!-- Analytics Start Here -->
    <div class="row mt-3">
        <div class="main-heading">
            <h2 class="text-center mb-3 text">Today's Analytics</h2>
        </div>
        <!-- Card Starts Here -->
        <div class="col-xl-4 col-lg-4">
            <div class="card l-bg-cherry">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large">
                        <!-- Icon -->
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="mb-4">
                        <!-- Main Heading -->
                        <h6 class="card-title mb-0">New Couriers</h6>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                                <!-- Body Text -->
                                <?php echo $newCouriersCount ?>
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
        <div class="col-xl-4 col-lg-4">
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
                                <?php echo $newCustomer; ?>
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
        <div class="col-xl-4 col-lg-4">
            <div class="card l-bg-green-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large">
                        <!-- Icon -->
                        <i class="fas fa-building-shield"></i>
                    </div>
                    <div class="mb-4">
                        <!-- Main Heading -->
                        <h6 class="card-title mb-0">New Agents</h6>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                                <!-- Body Text -->
                                <?php echo $newAgent ?>
                            </h2>
                        </div>
                    </div>
                    <!-- Progress Underline -->
                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                        <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card Ends Here -->
    </div>
    <!-- Analytics End Here -->

    <!-- Courier Table Starts Here -->
    <div class="row">
        <h3 class="text-center m-3 text">Couriers</h3>
        <div class="col-xl-8 col-sm-12" style="overflow-x:auto;">
            <table class="table desc-table text">
                <!-- Table Head -->
                <thead>
                    <tr class="desc-tr">
                        <th class="table-row-head desc-th">ID#</th>
                        <th class="table-row-head desc-tr">Sender Email</th>
                        <th class="table-row-head desc-th">Receiver Name</th>
                        <th class="table-row-head desc-th">Code</th>
                        <th class="table-row-head desc-th">Agent</th>
                        <th class="table-row-head desc-th">Status</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody class="desc-tbody">
                    <!-- Loop -->
                    <?php
                    foreach ($courierRecord as $row) {
                    ?>
                        <tr>
                            <th><?php echo $row->PackageId ?></th>
                            <td><?php foreach ($courierCustomerRecord as $customer) {
                                    if ($row->PackageSenderId == $customer->CustomerId) {
                                        echo $customer->CustomerEmail;
                                    }
                                } ?></td>
                            <td><?php echo $row->PackageReceiverName ?></td>
                            <td><?php echo $row->PackageCode ?></td>
                            <td><?php foreach ($courierAgentRecord as $agent) {
                                    if ($row->PackageAgentId == $agent->AgentId) {
                                        echo $agent->AgentEmail;
                                    }
                                } ?></td>
                            <td><?php echo $row->PackageStatus ?></td>

                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <a href="./courier.php">
                <button class="btn l-bg-cherry mt-3 w-100">View, Edit, And Create New Couriers</button>
            </a>
        </div>
        <!-- Analytics -->
        <div class="col-xl-4 col-sm-12">
            <div class="row">

                <div class="col-xl-6 col-sm-12">
                    <!-- Card Starts Here -->
                    <div class="col-xl-12 col-lg-12">
                        <div class="card l-bg-green-dark">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large">
                                    <!-- Icon -->
                                    <i class="fas fa-boxes-stacked icon"></i>
                                </div>
                                <div class="mb-4">
                                    <!-- Main Heading -->
                                    <h6 class="card-title mb-0">Received Couriers</h6>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0">
                                            <!-- Body Text -->
                                            <?php echo $receivedCourierCount ?>
                                        </h2>
                                    </div>
                                </div>
                                <!-- Progress Underline -->
                                <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                    <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card Ends Here -->
                </div>
                <div class="col-xl-6 col-sm-12">
                    <!-- Card Starts Here -->
                    <div class="col-xl-12 col-lg-12">
                        <div class="card l-bg-blue-dark">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large">
                                    <!-- Icon -->
                                    <i class="fas fa-boxes-stacked icon"></i>
                                </div>
                                <div class="mb-4">
                                    <!-- Main Heading -->
                                    <h6 class="card-title mb-0">In Progress</h6>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0">
                                            <!-- Body Text -->
                                            <?php echo $inProgressCourierCount ?>
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
                </div>
            </div>
            <!-- 4 Col Card -->
            <div class="col-xl-12 col-sm-12">
                <!-- Card Starts Here -->
                <div class="col-xl-12 col-lg-12">
                    <div class="card l-bg-cherry">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large">
                                <!-- Icon -->
                                <i class="fas fa-boxes-stacked icon"></i>
                            </div>
                            <div class="mb-4">
                                <!-- Main Heading -->
                                <h6 class="card-title mb-0">Delivered Couriers</h6>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        <!-- Body Text -->
                                        <?php echo $deliveredCourierCount ?>
                                    </h2>
                                </div>
                            </div>
                            <!-- Progress Underline -->
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card Ends Here -->
            </div>
        </div>

    </div>
    <!-- Courier Table Ends Here -->

    <!-- Agent And User Table Starts Here -->
    <div class="row">
        <!-- Customer Table -->
        <div class="col-xl-6 col-sm-12">
            <h3 class="text m-3 text-center">Customers</h3>
            <div class="col-xl-12 col-sm-12" style="overflow-x:auto;">
                <table class="table desc-table text">
                    <!-- Table Head -->
                    <thead>
                        <tr class="desc-tr">
                            <th class="table-row-head desc-th">ID#</th>
                            <th class="table-row-head desc-tr">Name</th>
                            <th class="table-row-head desc-th">Email</th>
                            <th class="table-row-head desc-th">Number</th>
                            <th class="table-row-head desc-th">Country</th>
                        </tr>
                    </thead>
                    <!-- Table Body -->
                    <tbody class="desc-tbody">
                        <!-- Loop -->
                        <?php
                        foreach ($customerRecord as $row) {
                        ?>
                            <tr>
                                <td><?php echo $row->CustomerId; ?></td>
                                <td><?php echo $row->CustomerName; ?></td>
                                <td><?php echo $row->CustomerEmail; ?></td>
                                <td><?php echo $row->CustomerNumber; ?></td>
                                <td><?php foreach ($countryRecord as $country) {
                                        if ($row->CustomerCountryId == $country->CountryId) {
                                            echo $country->CountryName;
                                        }
                                    } ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <a href="./customer.php">
                    <button class="btn l-bg-cherry mt-3 w-100">View, And Edit All Customers OR Send SMS</button>
                </a>
            </div>
        </div>
        <!-- Agent Table -->
        <div class="col-xl-6 col-sm-12">
            <h3 class="text m-3 text-center">Agents</h3>
            <div class="col-xl-12 col-sm-12" style="overflow-x:auto;">
                <table class="table desc-table text">
                    <!-- Table Head -->
                    <thead>
                        <tr class="desc-tr">
                            <th class="table-row-head desc-th">ID#</th>
                            <th class="table-row-head desc-tr">Agent Name</th>
                            <th class="table-row-head desc-th">Agent Email</th>
                            <th class="table-row-head desc-th">Agent Franchise</th>
                            <th class="table-row-head desc-th">Registration Date</th>
                        </tr>
                    </thead>
                    <!-- Table Body -->
                    <tbody class="desc-tbody">
                        <!-- Loop -->
                        <?php
                        foreach ($agentRecord as $row) {
                        ?>
                            <tr>
                                <td><?php echo $row->AgentId; ?></td>
                                <td><?php echo $row->AgentName; ?></td>
                                <td><?php echo $row->AgentEmail; ?></td>
                                <td><?php foreach ($agentFranchiseRecord as $franchise) {
                                        if ($franchise->FranchiseId == $row->AgentFranchiseId) {
                                            echo $franchise->FranchiseName;
                                        }
                                    } ?></td>
                                <td><?php echo $row->AgentRegistrationDate; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <a href="./agent.php">
                    <button class="btn l-bg-cherry mt-3 w-100">View, Edit And Create New Agents</button>
                </a>
            </div>
        </div>
    </div>
    <!-- Agent And User Table Ends Here -->
    <!-- Franchise Table Starts Here -->
    <div class="row">
        <h3 class="text-center m-3 text">Franchises</h3>
        <!-- Analytics -->
        <div class="col-xl-4 col-sm-12">
            <div class="row">

                <div class="col-xl-12 col-sm-12">
                    <!-- Card Starts Here -->
                    <div class="col-xl-12 col-lg-12">
                        <div class="card l-bg-green-dark">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large">
                                    <!-- Icon -->
                                    <i class="fas fa-building icon"></i>
                                </div>
                                <div class="mb-4">
                                    <!-- Main Heading -->
                                    <h6 class="card-title mb-0">All Franchises</h6>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0">
                                            <!-- Body Text -->
                                            <?php echo $totalFranchiseCount ?>
                                        </h2>
                                    </div>
                                </div>
                                <!-- Progress Underline -->
                                <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                    <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card Ends Here -->
                </div>

            </div>
        </div>
        <div class="col-xl-8 col-sm-12" style="overflow-x:auto;">
            <table class="table desc-table text">
                <!-- Table Head -->
                <thead>
                    <tr class="desc-tr">
                        <th class="table-row-head desc-th">ID#</th>
                        <th class="table-row-head desc-tr">Franchise Name</th>
                        <th class="table-row-head desc-th">Franchise Code</th>
                        <th class="table-row-head desc-th">Address</th>
                        <th class="table-row-head desc-th">City</th>
                        <th class="table-row-head desc-th">State</th>
                        <th class="table-row-head desc-th">Country</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody class="desc-tbody">
                    <!-- Loop -->
                    <?php
                    foreach ($franchiseRecord as $row) {

                    ?>
                        <tr>
                            <th><?php echo $row->FranchiseId ?></th>
                            <th><?php echo $row->FranchiseName ?></th>
                            <td><?php echo $row->FranchiseCode ?></td>
                            <td><?php echo $row->FranchiseAddress ?></td>
                            <td><?php echo $row->FranchiseCity ?></td>
                            <td><?php echo $row->FranchiseState ?></td>
                            <td><?php foreach ($countryRecord as $country) {
                                    if ($row->FranchiseCountryId == $country->CountryId) {
                                        echo $country->CountryName;
                                    }
                                } ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <a href="./courier.php">
                <button class="btn l-bg-cherry mt-3 w-100">View, Edit, And Create Franchises</button>
            </a>
        </div>


    </div>
    <!-- Franchise Table Ends Here -->

</div>



<!-- Admin Footer -->
<?php
include('../assets/template/admin/footer.php');
?>