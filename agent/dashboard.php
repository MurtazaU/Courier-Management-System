<?php
include('../assets/template/agent/header.php');
include('../assets/modules/dbconnection.php');

// Getting Agent's Data
$agent = $con->prepare('select AgentFranchiseId, AgentEmail from agent where AgentEmail = ?');
$agent->bindParam(1, $_SESSION['agent-email']);
$agent->execute();
$agentRecord = $agent->fetchAll(PDO::FETCH_OBJ);

foreach ($agentRecord as $agent) {
    if ($agent->AgentEmail == $_SESSION['agent-email']) {
        $_SESSION['agent-franchise-id'] = $agent->AgentFranchiseId;
    }
}


// Date
$date = date("Y-m-d");
// New Couriers For Your Franchise
$newCouriers = $con->prepare('select PackageId from package where PackageDateReceived = ? && PackageFranchiseId =?');
$newCouriers->bindParam(1, $date);
$newCouriers->bindParam(2, $_SESSION['agent-franchise-id']);
$newCouriers->execute();
$newCouriersCount = $newCouriers->rowCount();

// Couriers In Your Franchise
$courier = $con->prepare('select PackageId, PackageSenderId, PackageAgentId, PackageCode, PackageStatus, PackageReceiverName from package Where PackageFranchiseId = ? ORDER BY RAND() Limit 6');
$courier->bindParam(1, $_SESSION['agent-franchise-id']);
$courier->execute();
$courierRecord = $courier->fetchAll(PDO::FETCH_OBJ);
$courierCount = $courier->rowCount();

// Agents For Courier
$courierAgent = $con->prepare('select AgentId, AgentEmail from agent');
$courierAgent->execute();
$courierAgentRecord = $courierAgent->fetchAll(PDO::FETCH_OBJ);

// Customer For Courier
$courierCustomer = $con->prepare('select CustomerId, CustomerEmail from customer');
$courierCustomer->execute();
$courierCustomerRecord = $courierCustomer->fetchAll(PDO::FETCH_OBJ);

// Received Courier
$received = "Registered";
$receivedCourier = $con->prepare('select PackageId from package where PackageStatus = ? && PackageFranchiseId = ?');
$receivedCourier->bindParam(1, $received);
$receivedCourier->bindParam(2, $_SESSION['agent-franchise-id']);
$receivedCourier->execute();
$receivedCourierCount = $receivedCourier->rowCount();

// In Progress Courier
$inProgress = "In Progress";
$inProgressCourier = $con->prepare('select PackageId from package where PackageStatus = ? && PackageFranchiseId = ?');
$inProgressCourier->bindParam(1, $inProgress);
$inProgressCourier->bindParam(2, $_SESSION['agent-franchise-id']);
$inProgressCourier->execute();
$inProgressCourierCount = $inProgressCourier->rowCount();

// Delivered Courier
$delivered = "Delivered";
$deliveredCourier = $con->prepare('select PackageId from package where PackageStatus = ? && PackageFranchiseId = ?');
$deliveredCourier->bindParam(1, $delivered);
$deliveredCourier->bindParam(2, $_SESSION['agent-franchise-id']);
$deliveredCourier->execute();
$deliveredCourierCount = $deliveredCourier->rowCount();

// Agents
$agent = $con->prepare('select AgentId, AgentEmail, AgentRegistrationDate, AgentFranchiseId, AgentName from agent ORDER BY RAND() Limit 4');
$agent->execute();
$agentRecord = $agent->fetchAll(PDO::FETCH_OBJ);

// Franchise
$franchise = $con->prepare('select FranchiseId, FranchiseName, FranchiseCode, FranchiseAddress, FranchiseCity, FranchiseState, FranchiseCountryId from franchise ORDER BY RAND() Limit 6');
$franchise->execute();
$franchiseRecord = $franchise->fetchAll(PDO::FETCH_OBJ);

?>

<!-- Main Body Starts Here -->
<div class="container">
    <!-- Analytics Start Here -->
    <div class="row mt-3">
        <div class="main-heading">
            <h2 class="text-center mb-3 text">Today's Analytics</h2>
        </div>
        <!-- Card Starts Here -->
        <div class="col-xl-12 col-lg-4">
            <div class="card l-bg-cherry">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large">
                        <!-- Icon -->
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="mb-4">
                        <!-- Main Heading -->
                        <h6 class="card-title mb-0">New Couriers Registered In Your Franchise</h6>
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
    </div>
    <!-- Analytics End Here -->

    <!-- Courier Table Starts Here -->
    <div class="row">
        <h3 class="text-center m-3 text">Couriers In Your Franchise</h3>
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
                    if ($courierCount != 0) {

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
                    } else {
                        ?>
                        <div class="alert alert-primary" role="alert">
                            There Are No Couriers Registered In Your Franchise
                        </div>
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
                                    <h6 class="card-title mb-0">Registered</h6>
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

</div>



<!-- Admin Footer -->
<?php
include('../assets/template/agent/footer.php');
?>