<?php
// Header
include('../assets/template/agent/header.php');
include('../assets/modules/dbconnection.php');

// Selected Courier
$courierId = $_GET['courier-id'];

// Default Data
$data = $con->prepare('select * from package where PackageId = ?');
$data->bindParam(1, $courierId);
$data->execute();
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

// Inserting Data
if (isset($_REQUEST['courier-submit'])) {
    $senderId = $_REQUEST['courier-sender-email'];
    $receiverName  = $_REQUEST['courier-receiver-name'];
    $senderAddress  = $_REQUEST['courier-sender-address'];
    $receiverAddress  = $_REQUEST['courier-receiver-address'];
    $receiverZipCode  = $_REQUEST['courier-receiver-zip-code'];
    $receiverCity  = $_REQUEST['courier-receiver-city'];
    $receiverCountry  = $_REQUEST['courier-receiver-country'];
    $weightId  = $_REQUEST['courier-weight-id'];
    $type  = $_REQUEST['courier-type'];
    $deliveryService  = $_REQUEST['courier-delivery-service'];
    $code = "Package" . rand(100, 999);
    $date = date('Y-m-d');
    $receiverNumber = $_REQUEST['courier-receiver-number'];

    // Inserting Data
    $sql = $con->prepare("update package set PackageSenderId = ?, PackageReceiverName = ?, PackageReceiverNumber = ?, PackageFromAddress = ?, PackageToAddress = ?, PackageReceiverZipCode = ?, PackageReceiverCity = ?, PackageReceiverCountry = ?, PackageWeightId = ?, PackageProductTypeId = ?, PackageDeliveryServiceId = ? where PackageId = ?");

    $sql->bindParam(1, $senderId);
    $sql->bindParam(2, $receiverName);
    $sql->bindParam(3, $receiverNumber);
    $sql->bindParam(4, $senderAddress);
    $sql->bindParam(5, $receiverAddress);
    $sql->bindParam(6, $receiverZipCode);
    $sql->bindParam(7, $receiverCity);
    $sql->bindParam(8, $receiverCountry);
    $sql->bindParam(9, $weightId);
    $sql->bindParam(10, $type);
    $sql->bindParam(11, $deliveryService);
    $sql->bindParam(12, $courierId);

    $sql->execute();
?>
    <script>
        window.location.href = "./manage-courier.php";
    </script>
<?php
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
                <h4 class="mb-0 fw-bold">Update Courier: ID = <?php echo $_GET['courier-id']; ?> </h4>
            </div>

            <!-- Card body -->
            <div class="card-body">
                <?php
                foreach ($dataRecord as $data) {
                ?>
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
                                    <?php
                                    foreach ($senderRecord as $row) {
                                        if ($row->CustomerId == $data->PackageSenderId) {
                                    ?>
                                            <option value="<?php echo $data->PackageSenderId ?>" selected><?php echo $row->CustomerEmail ?></option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="<?php echo $row->CustomerId ?>"><?php echo $row->CustomerEmail ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <?php
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="courier-receiver-name" class="form-label">Courier Receiver Name</label>
                                <input type="text" value="<?php echo $data->PackageReceiverName ?>" name="courier-receiver-name" required required class="form-control" id="courier-receiver-name" />
                            </div>
                            <div class="mb-3">
                                <label for="courier-receiver-number" class="form-label">Courier Receiver Number</label>
                                <input type="number" value="<?php echo $data->PackageReceiverNumber ?>" name="courier-receiver-number" class="form-control" id="courier-receiver-number" required />
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
                                        <input type="text" class="form-control" id="courier-sender-address" name="courier-sender-address" value="<?php echo $data->PackageFromAddress ?>" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="courier-receiver-address" class="form-label">Courier Receiver Address</label>
                                    <input type="text" class="form-control" id="courier-receiver-address" name="courier-receiver-address" value="<?php echo $data->PackageToAddress ?>" required />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="courier-receiver-zip-code" class="form-label">Courier Receiver's Zip Code</label>
                                    <input type="text" class="form-control" id="courier-receiver-zip-code" name="courier-receiver-zip-code" value="<?php echo $data->PackageReceiverZipCode ?>" required />
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="courier-receiver-city" class="form-label">Courier Receiver's City</label>
                                        <input type="text" class="form-control" id="courier-receiver-city" value="<?php echo $data->PackageReceiverCity ?>" name="courier-receiver-city" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="courier-receiver-country" class="form-label">Courier Receiver's Country</label>
                                        <select name="courier-receiver-country" id="courier-receiver-country" class="search-select form-select" required>
                                            <?php foreach ($countryRecord as $row) {
                                                if ($row->CountryId == $data->PackageReceiverCountry) {
                                            ?>
                                                    <option selected value="<?php echo $data->PackageReceiverCountry ?>"><?php echo $row->CountryName ?></option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option value="<?php echo $row->CountryId ?>"><?php echo $row->CountryName ?></option>
                                            <?php
                                                }
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
                                <label for="courier-weight-id" class="form-label">Courier Weight Class</label>
                                <select name="courier-weight-id" id="courier-weight-id" class="search-select form-select" required>
                                    <?php
                                    foreach ($weightRecord as $row) {
                                        if ($row->WeightClassId == $data->PackageWeightId) {
                                    ?>
                                            <option selected value="<?php echo $data->PackageWeightId ?>"><?php echo $row->WeightClassName ?></option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="<?php echo $row->WeightClassId ?>"><?php echo $row->WeightClassName ?></option>
                                    <?php
                                        }
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
                                            <?php
                                            foreach ($productTypeRecord as $row) {
                                                if ($row->ProductTypeId == $data->PackageProductTypeId) {
                                            ?>
                                                    <option selected value="<?php echo $data->PackageProductTypeId ?>"><?php echo $row->ProductTypeName ?></option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option value="<?php echo $row->ProductTypeId ?>"><?php echo $row->ProductTypeName ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="courier-delivery-service" class="form-label">Courier Delivery Service</label>
                                    <select name="courier-delivery-service" id="courier-delivery-service" class="search-select form-select" required>
                                        <?php
                                        foreach ($deliveryServiceRecord as $row) {
                                            if ($row->DeliveryServiceId == $data->PackageDeliveryServiceId) {
                                        ?>
                                                <option selected value="<?php echo $data->PackageDeliveryServiceId ?>"><?php echo $row->DeliveryServiceName ?></option>
                                            <?php
                                            } else {

                                            ?>
                                                <option value="<?php echo $row->DeliveryServiceId ?>"><?php echo $row->DeliveryServiceName ?></option>
                                        <?php
                                            }
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
        <?php
                }
        ?>


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
include('../assets/template/agent/footer.php');
?>