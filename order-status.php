<?php
// Header
include('./assets/template/user/header.php');
// DB Connection
include('./assets/modules/dbconnection.php');
// Tracking Number 
if (!isset($_SESSION['tracking-number'])) {
    header("location: ./index.php");
}
// User Email
if (!isset($_SESSION['useremail'])) {
    header("location: ./index.php");
}

$code = $_SESSION['tracking-number'];

// Queries
// Courier Data
$data = $con->prepare('select * from package where PackageCode = ?');
$data->bindParam(1, $code);
$data->execute();
$dataCount = $data->rowCount();
$dataRecord = $data->fetchAll(PDO::FETCH_OBJ);

// Sender Id
$sender = $con->prepare('select CustomerId, CustomerEmail from customer');
$sender->execute();
$senderRecord = $sender->fetchAll(PDO::FETCH_OBJ);

// Countries
$country = $con->prepare('select CountryId, CountryName from country');
$country->execute();
$countryRecord = $country->fetchAll(PDO::FETCH_OBJ);

// Weight Id
$weight = $con->prepare('select WeightClassId, WeightClassName, WeightClassFromLimit,WeightClassToLimit from weightclass');
$weight->execute();
$weightRecord = $weight->fetchAll(PDO::FETCH_OBJ);

// Product Type
$productType = $con->prepare('select ProductTypeId, ProductTypeName from producttype');
$productType->execute();
$productTypeRecord = $productType->fetchAll(PDO::FETCH_OBJ);

// Delivery Service
$deliveryService = $con->prepare('select DeliveryServiceId, DeliveryServiceName, DeliveryServiceTimeFrom, DeliveryServiceTimeTo from deliveryservice');
$deliveryService->execute();
$deliveryServiceRecord = $deliveryService->fetchAll(PDO::FETCH_OBJ);

// Agent
$agent = $con->prepare('select AgentId, AgentEmail from agent');
$agent->execute();
$agentRecord = $agent->fetchAll(PDO::FETCH_OBJ);



?>

<!-- CSS Link -->
<link rel="stylesheet" href="./assets/CSS/userCSS/track-order.css">

<!-- Main Body Starts Here -->
<div class="container" style="margin-top: 100px;">
    <!-- Main Row -->
    <div class="row m-5">
        <!-- Card -->
        <div class="card w-100">
            <div class="card-body ">
                <?php
                if ($dataCount > 0) {

                    foreach ($dataRecord as $row) {
                ?>
                        <h3 class="card-title text-dark">Your Courier's Status</h5>
                            <h4 class="card-subtitle mb-2 text-muted">Tracking Number: <?php echo $_SESSION['tracking-number'] ?></h6>
                                <hr>
                                <?php ?>
                                <h3 class="text-dark">Courier Information: </h3>
                                <h5 class="text-dark">Current Status: <span class="text-success"><?php echo $row->PackageStatus ?></span></h5>
                                <div class="courier-info">
                                    <div class="row mt-4">
                                        <div class="col-xl-6 col-sm-12">
                                            <h5 class="text-dark">Basic Info</h5>
                                            <div class="mt-3">
                                                <p class="text-dark"><b>Sender Email</b>: <?php echo $row->PackageSenderId ?></p>
                                                <p class="text-dark"><b>Receiver Name</b>: <?php echo $row->PackageReceiverName ?></p>
                                                <p class="text-dark"><b>Receiver Number</b>: <?php echo $row->PackageReceiverNumber ?></p>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-12">
                                            <h5 class="text-dark">Address Information</h5>
                                            <div class="mt-3">
                                                <p class="text-dark"><b>Sender's Address</b>: <?php echo $row->PackageFromAddress ?></p>
                                                <p class="text-dark"><b>Receiver's Address</b>: <?php echo $row->PackageToAddress ?></p>
                                                <p class="text-dark"><b>Receiver's Zip Code</b>: <?php echo $row->PackageReceiverZipCode ?></p>
                                                <p class="text-dark"><b>Receiver's City</b>: <?php echo $row->PackageReceiverCity ?></p>
                                                <p class="text-dark"><b>Receiver's Country</b>: <?php echo $row->PackageReceiverCountry ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="card-link">Card link</a>
                                <a href="#" class="card-link">Another link</a>
                            <?php
                        }
                    } else {
                            ?>
                            <h3 class="card-title text-dark">No Courier Found</h5>
                            <?php
                        }
                            ?>
            </div>
        </div>
    </div>
</div>
<!-- Main Body Ends Here -->


<?php
// Footer
include('./assets/template/user/footer.php');

?>