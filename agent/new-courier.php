<?php
// Header
include('../assets/template/agent/header.php');
include('../assets/modules/dbconnection.php');

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

// Franchise
$franchise = $con->prepare('select FranchiseId, FranchiseName, FranchiseCity from franchise where FranchiseId = ?');
$franchise->bindParam(1, $_SESSION['agent-franchise-id']);
$franchise->execute();
$franchiseRecord = $franchise->fetchAll(PDO::FETCH_OBJ);

// Agent Email Id
$agent = $con->prepare('select AgentId, AgentEmail from agent where AgentEmail = ?');
$agent->bindParam(1, $_SESSION['agent-email']);
$agent->execute();
$agentRecord = $agent->fetchAll(PDO::FETCH_OBJ);

foreach ($agentRecord as $agent) {
    if ($agent->AgentEmail == $_SESSION['agent-email']) {
        $_SESSION['agent-id'] = $agent->AgentId;
    }
}


// Inserting Data
if (isset($_REQUEST['courier-submit'])) {
    $senderId = $_REQUEST['courier-sender-email'];
    $agentId = $_SESSION['agent-id'];
    $receiverName  = $_REQUEST['courier-receiver-name'];
    $senderAddress  = $_REQUEST['courier-sender-address'];
    $receiverAddress  = $_REQUEST['courier-receiver-address'];
    $receiverZipCode  = $_REQUEST['courier-receiver-zip-code'];
    $receiverCity  = $_REQUEST['courier-receiver-city'];
    $receiverCountry  = $_REQUEST['courier-receiver-country'];
    $weightId  = $_REQUEST['courier-weight-id'];
    $type  = $_REQUEST['courier-type'];
    $deliveryService  = $_REQUEST['courier-delivery-service'];
    $code = "CR-" . rand(100, 99999);
    $date = date('Y-m-d');
    $status = "Registered";
    $receiverNumber = $_REQUEST['courier-receiver-number'];
    $franchiseId = $_SESSION['agent-franchise-id'];

    foreach ($franchiseRecord as $row) {
        if ($row->FranchiseId == $franchiseId) {
            $registrationCity = $row->FranchiseCity;
        }
    }

    $codeQuery = $con->prepare('select PackageCode from package where PackageCode = ?');
    $codeQuery->bindParam(1, $code);
    $codeQuery->execute();
    $codeCount = $codeQuery->rowCount();

    if ($codeCount > 0) {
        $newCode = "CR-" . rand(100, 99999);
        // Inserting Data
        $sql = $con->prepare('insert into package(PackageSenderId, PackageReceiverName, PackageReceiverNumber, PackageFromAddress, PackageToAddress, PackageReceiverZipCode, PackageReceiverCity, PackageReceiverCountry, PackageCode, PackageWeightId, PackageProductTypeId, PackageAgentId, PackageFranchiseId, PackageDeliveryServiceId, PackageStatus, PackageDateReceived, PackageRegistrationCity) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $sql->bindParam(1, $senderId);
        $sql->bindParam(2, $receiverName);
        $sql->bindParam(3, $receiverNumber);
        $sql->bindParam(4, $senderAddress);
        $sql->bindParam(5, $receiverAddress);
        $sql->bindParam(6, $receiverZipCode);
        $sql->bindParam(7, $receiverCity);
        $sql->bindParam(8, $receiverCountry);
        $sql->bindParam(9, $newCode);
        $sql->bindParam(10, $weightId);
        $sql->bindParam(11, $type);
        $sql->bindParam(12, $agentId);
        $sql->bindParam(13, $franchiseId);
        $sql->bindParam(14, $deliveryService);
        $sql->bindParam(15, $status);
        $sql->bindParam(16, $date);
        $sql->bindParam(17, $registrationCity);

        $sql->execute();
    } else {
        // Inserting Data
        $sql = $con->prepare('insert into package(PackageSenderId, PackageReceiverName, PackageReceiverNumber, PackageFromAddress, PackageToAddress, PackageReceiverZipCode, PackageReceiverCity, PackageReceiverCountry, PackageCode, PackageWeightId, PackageProductTypeId, PackageAgentId, PackageFranchiseId, PackageDeliveryServiceId, PackageStatus, PackageDateReceived, PackageRegistrationCity) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $sql->bindParam(1, $senderId);
        $sql->bindParam(2, $receiverName);
        $sql->bindParam(3, $receiverNumber);
        $sql->bindParam(4, $senderAddress);
        $sql->bindParam(5, $receiverAddress);
        $sql->bindParam(6, $receiverZipCode);
        $sql->bindParam(7, $receiverCity);
        $sql->bindParam(8, $receiverCountry);
        $sql->bindParam(9, $code);
        $sql->bindParam(10, $weightId);
        $sql->bindParam(11, $type);
        $sql->bindParam(12, $agentId);
        $sql->bindParam(13, $franchiseId);
        $sql->bindParam(14, $deliveryService);
        $sql->bindParam(15, $status);
        $sql->bindParam(16, $date);
        $sql->bindParam(17, $registrationCity);

        $sql->execute();
    }
}

?>

<!-- Select 2 Link -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


<!-- Main Content Starts Here -->
<div class="container my-5">
    <div class="card mx-lg-5 p-lg-5">
        <!-- Form -->
        <form method="POST">
            <!-- Card header -->
            <div class="card-header py-4 px-5 bg-light border-0">
                <h4 class="mb-0 fw-bold">Create A New Courier</h4>
            </div>

            <!-- Card body -->
            <div class="card-body">
                <!-- Basic Info section -->
                <div class="row gx-xl-5">
                    <div class="col-md-4">
                        <h5>Basic Info</h5>
                    </div>
                    <!-- Form Inputs Start Here -->

                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label" for="courier-sender-email">Courier Sender Email</label>
                            <select name="courier-sender-email" class="search-select form-select" id="courier-sender-email" required>
                                <option selected disabled></option>
                                <?php
                                foreach ($senderRecord as $row) {
                                ?>
                                    <option value="<?php echo $row->CustomerId ?>"><?php echo $row->CustomerEmail ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="courier-agent-email" class="form-label">Agent Email</label>
                            <input type="email" value="<?php echo $_SESSION['agent-email'] ?>" name="courier-agent-email" id=" courier-agent-email" class="form-control" required disabled>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="courier-receiver-name" class="form-label">Courier Receiver Name</label>
                            <input type="text" name="courier-receiver-name" class="form-control" id="courier-receiver-name" required />
                        </div>
                        <div class="mb-3">
                            <label for="courier-receiver-number" class="form-label">Courier Receiver Number</label>
                            <input type="number" name="courier-receiver-number" class="form-control" id="courier-receiver-number" required />
                            <p class="text-muted">Kindly write the receiver's number containing your country code</p>
                        </div>
                    </div>
                </div>

                <hr class="my-5" />

                <!-- Address section -->
                <div class="row gx-xl-5">
                    <div class="col-md-4">
                        <h5>Address</h5>
                    </div>

                    <div class="col-md-8">
                        <div class="row ">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="courier-sender-address" class="form-label">Courier Sender Address</label>
                                    <input type="text" class="form-control" id="courier-sender-address" name="courier-sender-address" required />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="courier-receiver-address" class="form-label">Courier Receiver Address</label>
                                <input type="text" class="form-control" id="courier-receiver-address" name="courier-receiver-address" required />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="courier-receiver-zip-code" class="form-label">Courier Receiver's Zip Code</label>
                                <input type="text" class="form-control" id="courier-receiver-zip-code" name="courier-receiver-zip-code" required />
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="courier-receiver-city" class="form-label">Courier Receiver's City</label>
                                    <input type="text" class="form-control" id="courier-receiver-city" name="courier-receiver-city" required />
                                </div>
                                <div class="col-md-6">
                                    <label for="courier-receiver-country" class="form-label">Courier Receiver's Country</label>
                                    <select name="courier-receiver-country" id="courier-receiver-country" class="search-select form-select" required>
                                        <option selected disabled></option>
                                        <?php foreach ($countryRecord as $row) {
                                        ?>
                                            <option value="<?php echo $row->CountryId ?>"><?php echo $row->CountryName ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <hr class="my-5" />

                <!-- Additional Info -->
                <div class="row gx-xl-5">
                    <div class="col-md-4">
                        <h5>Additional Info</h5>
                    </div>

                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="courier-franchise-id" class="form-label">Courier Franchise</label>
                            <input type="text" required value="<?php
                                                                foreach ($franchiseRecord as $franchise) {
                                                                    if ($franchise->FranchiseId == $_SESSION['agent-franchise-id']) {
                                                                        echo $franchise->FranchiseName;
                                                                    }
                                                                }
                                                                ?>" name="courier-franchise-id" id="courier-franchise-id" class="form-control" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="courier-weight-id" class="form-label">Courier Weight Class</label>
                            <select name="courier-weight-id" id="courier-weight-id" class="search-select form-select" required>
                                <option disabled selected></option>
                                <?php
                                foreach ($weightRecord as $row) {
                                ?>
                                    <option value="<?php echo $row->WeightClassId ?>"><?php echo $row->WeightClassName ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <!-- Limits -->
                            <div>
                                <?php
                                foreach ($weightRecord as $row) {
                                ?>
                                    <p class="text-muted"><?php echo $row->WeightClassName ?>: <?php echo $row->WeightClassFromLimit ?> - <?php echo $row->WeightClassToLimit ?></p>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="courier-type" class="form-label">Courier Type</label>
                                    <select name="courier-type" id="courier-type" class="search-select form-select" required>
                                        <option disabled selected></option>
                                        <?php
                                        foreach ($productTypeRecord as $row) {
                                        ?>
                                            <option value="<?php echo $row->ProductTypeId ?>"><?php echo $row->ProductTypeName ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="courier-delivery-service" class="form-label">Courier Delivery Service</label>
                                <select name="courier-delivery-service" id="courier-delivery-service" class="search-select form-select" required>
                                    <option disabled selected></option>
                                    <?php
                                    foreach ($deliveryServiceRecord as $row) {
                                    ?>
                                        <option value="<?php echo $row->DeliveryServiceId ?>"><?php echo $row->DeliveryServiceName ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <!-- Limits -->
                                <div>
                                    <?php
                                    foreach ($deliveryServiceRecord as $row) {
                                    ?>
                                        <p class="text-muted"><?php echo $row->DeliveryServiceName ?>: <?php echo $row->DeliveryServiceTimeFrom ?> - <?php echo $row->DeliveryServiceTimeTo ?></p>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Card footer -->
            <div class="card-footer text-end py-4 px-5 bg-light border-0">
                <button type="submit" class="btn btn-primary btn-rounded btn-submit" name="courier-submit">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Select 2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.search-select').select2();
    });
</script>
<?php
// Footer
include('../assets/template/admin/footer.php');
?>