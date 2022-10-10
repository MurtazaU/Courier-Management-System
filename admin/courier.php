<?php
// Header
include('../assets/template/admin/header.php');
// DB Connection
include('../assets/modules/dbconnection.php');

// New Couriers Analytics
$date = date("Y-m-d");
$newCouriers = $con->prepare('select * from package where PackageDateReceived = ?');
$newCouriers->bindParam(1, $date);
$newCouriers->execute();
$newCouriersCount = $newCouriers->rowCount();

// All Couriers Details
$couriers = $con->prepare('select * from package');
$couriers->execute();
// Total Courier Count
$totalCouriersCount = $couriers->rowCount();
$couriersRecord = $couriers->fetchAll(PDO::FETCH_OBJ);


// Sender Id
$sender = $con->prepare('select CustomerId, CustomerEmail from customer');
$sender->execute();
$senderRecord = $sender->fetchAll(PDO::FETCH_OBJ);

// Weight Id
$weight = $con->prepare('select WeightClassId, WeightClassName from weightclass');
$weight->execute();
$weightRecord = $weight->fetchAll(PDO::FETCH_OBJ);

// Product Type Id
$productType = $con->prepare('select ProductTypeId, ProductTypeName from producttype');
$productType->execute();
$productTypeRecord = $productType->fetchAll(PDO::FETCH_OBJ);

// Agent Id
$agent = $con->prepare('select AgentId, AgentEmail from agent');
$agent->execute();
$agentRecord = $agent->fetchAll(PDO::FETCH_OBJ);

// Delivery Service Id
$deliveryService  = $con->prepare('select DeliveryServiceId, DeliveryServiceName from deliveryservice');
$deliveryService->execute();
$deliveryServiceRecord = $deliveryService->fetchAll(PDO::FETCH_OBJ);

// Franchise Id
$franchise = $con->prepare('select FranchiseId, FranchiseName, FranchiseCity from franchise');
$franchise->execute();
$franchiseRecord = $franchise->fetchAll(PDO::FETCH_OBJ);
?>

<!-- Main Content Starts Here -->
<div class="container">
    <h3 class="text mt-3">Couriers</h3>
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
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="mb-4">
                        <!-- Main Heading -->
                        <h6 class="card-title mb-0">New Couriers Today</h6>
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
        <div class="col-xl-6 col-lg-6">
            <div class="card l-bg-orange-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large">
                        <!-- Icon -->
                        <i class="fas fa-boxes-stacked"></i>
                    </div>
                    <div class="mb-4">
                        <!-- Main Heading -->
                        <h6 class="card-title mb-0">Total Couriers</h6>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                                <!-- Body Text -->
                                <?php echo $totalCouriersCount; ?>
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

    <!-- New Section Starts Here -->
    <section>
        <div class="row m-5 mt-0">
            <div class="col-12">
                <a href="./new-courier.php">
                    <button class="btn l-bg-cherry mt-3 w-100">Create New Courier</button>
                </a>
            </div>
        </div>
    </section>
    <!-- New Section Ends Here -->

    <!-- Reports Section Starts Here -->
    <section class="report">
        <div class="row m-5 mt-0">
            <h2 class="text text-center">Download Report</h2>
            <div class="col-6">
                <h4 class="text text-center">Date Wise</h4>
                <!-- Date Wise Form -->
                <form method="POST" action="../assets/modules/download-report-by-date.php">
                    <div class="row">
                        <div class="col-8" style="width: 60%;">
                            <!-- Select -->
                            <select name="download-report-date-wise" id="ReportDateWise" class="form-select">
                                <option value="5">All Time</option>
                                <option value="1">Today</option>
                                <option value="2">Last 7 Days</option>
                                <option value="3">Last 14 Days</option>
                                <option value="4">Last 30 Days</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <!-- Download Button -->
                            <button name="report-date" type="submit" style="width: 100%;" class="btn l-bg-green-dark">Download</button>
                        </div>
                    </div>


                </form>

            </div>
            <div class="col-6">
                <h4 class="text text-center">City Wise</h4>
                <!-- Date Wise Form -->
                <form method="POST" action="../assets/modules/download-report-by-city.php">
                    <div class="row">
                        <div class="col-8" style="width: 60%;">
                            <!-- Select -->
                            <select name="download-report-city-wise" id="ReportDateWise" class="form-select">
                                <?php
                                foreach ($franchiseRecord as $row) {
                                ?>
                                    <option value="<?php echo $row->FranchiseCity ?>"><?php echo $row->FranchiseCity ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <!-- Download Button -->
                            <button name="report-city" type="submit" style="width: 100%;" class="btn l-bg-blue-dark">Download</button>
                        </div>
                        <p class="text text-muted">The above cities, are where our franchises are located.</p>
                    </div>


                </form>

            </div>
        </div>
    </section>
    <!-- Reports Section Ends Here -->


    <!-- Tables Start Here -->

    <div class="row">
        <div class="col-12">
            <!-- Couriers -->
            <table class="table desc-table text">
                <!-- Table Head -->
                <thead>
                    <tr>
                        <th class="table-row-head">ID#</th>
                        <th class="table-row-head">Sender Email</th>
                        <th class="table-row-head">Receiver Name</th>
                        <th class="table-row-head">Sender Address</th>
                        <th class="table-row-head">Receiver Address</th>
                        <th class="table-row-head">Receiver ZipCode</th>
                        <th class="table-row-head">Code</th>
                        <th class="table-row-head">Weight Class</th>
                        <th class="table-row-head">Product Type</th>
                        <th class="table-row-head">Agent</th>
                        <th class="table-row-head">Franchise</th>
                        <th class="table-row-head">Delivery Service</th>
                        <th class="table-row-head">Status</th>
                        <th class="table-row-head">Receiving Date</th>
                        <th class="table-row-head">Actions</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody>
                    <?php
                    // Main Loop
                    foreach ($couriersRecord as $row) {
                    ?>
                        <tr>
                            <th><?php echo $row->PackageId ?></th>
                            <td class="text"><?php foreach ($senderRecord as $sender) {
                                                    if ($row->PackageSenderId == $sender->CustomerId) {
                                                        echo $sender->CustomerEmail;
                                                    }
                                                } ?>
                            </td>
                            <td class="text"><?php echo $row->PackageReceiverName ?></td>
                            <td class="text"><?php echo $row->PackageFromAddress ?></td>
                            <td class="text"><?php echo $row->PackageToAddress ?></td>
                            <td class="text"><?php echo $row->PackageReceiverZipCode ?></td>
                            <td class="text"><?php echo $row->PackageCode ?></td>
                            <td class="text">
                                <?php foreach ($weightRecord as $weight) {
                                    if ($row->PackageWeightId == $weight->WeightClassId) {
                                        echo $weight->WeightClassName;
                                    }
                                } ?>
                            </td>
                            <td class="text">
                                <?php foreach ($productTypeRecord as $productType) {
                                    if ($row->PackageProductTypeId == $productType->ProductTypeId) {
                                        echo $productType->ProductTypeName;
                                    }
                                } ?>
                            </td>
                            <td class="text">
                                <?php foreach ($agentRecord as $agent) {
                                    if ($row->PackageAgentId == $agent->AgentId) {
                                        echo $agent->AgentEmail;
                                    }
                                } ?>
                            </td>
                            <td class="text">
                                <?php foreach ($franchiseRecord as $franchise) {
                                    if ($row->PackageFranchiseId == $franchise->FranchiseId) {
                                        echo $franchise->FranchiseName;
                                    }
                                } ?>
                            </td>
                            <td class="text">
                                <?php foreach ($deliveryServiceRecord as $deliveryService) {
                                    if ($row->PackageDeliveryServiceId == $deliveryService->DeliveryServiceId) {
                                        echo $deliveryService->DeliveryServiceName;
                                    }
                                } ?>
                            </td>
                            <td class="text"><?php echo $row->PackageStatus ?></td>
                            <td class="text"><?php echo $row->PackageDateReceived ?></td>
                            <td class="text">
                                <div class="row">
                                    <div class="col-12">
                                        <a href="./update-courier.php?courier-id=<?php echo $row->PackageId; ?>"><button type="submit" class="btn text"><i class="fa-solid fa-pen-to-square"></i></button></a>
                                    </div>
                                    <div class="col-12">
                                        <a href="./delete-courier.php?courier-id=<?php echo $row->PackageId; ?>"><button type="submit" class="btn text"><i class="fa-solid fa-trash"></i></button></a>
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