<?php
// Header
include('../assets/template/admin/header.php');
// DB COnnection
include('../assets/modules/dbconnection.php');

// Product Type
$productType = $con->prepare('select ProductTypeId, ProductTypeName from producttype');
$productType->execute();
$productTypeRecord = $productType->fetchAll(PDO::FETCH_OBJ);
$productTypeCount = $productType->rowCount();

// Delivery Service
$deliveryService = $con->prepare('select DeliveryServiceId, DeliveryServiceName from deliveryservice');
$deliveryService->execute();
$deliveryServiceRecord = $deliveryService->fetchAll(PDO::FETCH_OBJ);
$deliveryServiceCount = $deliveryService->rowCount();

// Weight Class
$weightClass = $con->prepare('select WeightClassId, WeightClassName from weightclass');
$weightClass->execute();
$weightClassRecord = $weightClass->fetchAll(PDO::FETCH_OBJ);
$weightClassCount = $weightClass->rowCount();

// New Product Type
if (isset($_REQUEST['product-type-submit'])) {
    $productTypeName = $_REQUEST['product-type-name'];
    $productType = $con->prepare('insert into producttype(ProductTypeName) values(?)');
    $productType->bindParam(1, $productTypeName);
    $productType->execute();
?>
    <script>
        window.location.href = "./additives.php";
    </script>
<?php
}

// New Weight Class
if (isset($_REQUEST['weight-class-submit'])) {
    $weightClassName = $_REQUEST['weight-class-name'];
    $weightClass = $con->prepare('insert into weightclass(WeightClassName) values(?)');
    $weightClass->bindParam(1, $weightClassName);
    $weightClass->execute();
?>
    <script>
        window.location.href = "./additives.php";
    </script>
<?php
}
// New Delivery Service
if (isset($_REQUEST['delivery-service-submit'])) {
    $deliveryServiceName = $_REQUEST['delivery-service-name'];
    $deliveryService = $con->prepare('insert into deliveryservice(DeliveryServiceName) values(?)');
    $deliveryService->bindParam(1, $deliveryServiceName);
    $deliveryService->execute();
?>
    <script>
        window.location.href = "./additives.php";
    </script>
<?php
}

?>

<!-- Main Content Starts Here -->
<div class="container">
    <h3 class="text mt-3">Additional Courier Options</h3>
    <!-- Analytics Start Here -->
    <div class="row mt-3">
        <div class="main-heading">
            <h2 class="text-center mb-3 text">Analytics</h2>
        </div>
        <!-- Card Starts Here -->
        <div class="col-xl-4 col-lg-6">
            <div class="card l-bg-cherry">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large">
                        <!-- Icon -->
                    </div>
                    <div class="mb-4">
                        <!-- Main Heading -->
                        <h6 class="card-title mb-0">Total Product Types</h6>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                                <!-- Body Text -->
                                <?php echo $productTypeCount; ?>
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
        <div class="col-xl-4 col-lg-6">
            <div class="card l-bg-green-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large">
                        <!-- Icon -->
                    </div>
                    <div class="mb-4">
                        <!-- Main Heading -->
                        <h6 class="card-title mb-0">Total Weight Classes</h6>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                                <!-- Body Text -->
                                <?php echo $weightClassCount; ?>
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
        <div class="col-xl-4 col-lg-6">
            <div class="card l-bg-blue-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large">
                        <!-- Icon -->
                    </div>
                    <div class="mb-4">
                        <!-- Main Heading -->
                        <h6 class="card-title mb-0">Total Delivery Services</h6>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                                <!-- Body Text -->
                                <?php echo $deliveryServiceCount; ?>
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

    <!-- Product Type Starts Here -->
    <div class="row">
        <div class="col-8">
            <!-- Agents -->
            <h2 class="text text-center">Product Types</h2>
            <table class="table desc-table text">
                <!-- Table Head -->
                <thead>
                    <tr>
                        <th class="table-row-head">ID#</th>
                        <th class="table-row-head">Product Type</th>
                        <th class="table-row-head">Actions</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody>
                    <?php
                    // Main Loop
                    foreach ($productTypeRecord as $row) {
                    ?>
                        <tr>
                            <!-- iD -->
                            <th><?php echo $row->ProductTypeId ?></th>
                            <!-- Name -->
                            <td class="text"><?php echo $row->ProductTypeName ?></td>
                            <!-- Actions Start Here -->
                            <td class="text">
                                <div class="row">
                                    <div class="col-12">
                                        <a href="./delete-additive.php?product-type-id=<?php echo $row->ProductTypeId; ?>"><button type="submit" class="btn text"><i class="fa-solid fa-trash"></i></button></a>
                                    </div>
                                </div>
                            </td>
                            <!-- Actions End Here -->
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="col-4">
            <h2 class="text text-center">Add New Product Type</h2>
            <!-- Main Content Starts Here -->
            <div class="card">
                <!-- Form -->
                <form method="POST">
                    <!-- Card body -->
                    <div class="card-body">
                        <!-- Basic Info section -->
                        <div class="row gx-xl-5">
                            <div class="col-md-4">
                                <h5>Name</h5>
                            </div>
                            <!-- Form Inputs Start Here -->

                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" for="product-type-name">Product Type Name</label>
                                    <input type="text" name="product-type-name" id="product-type-name" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer text-end bg-light border-0">
                        <button type="submit" class="btn btn-primary btn-rounded btn-submit" name="product-type-submit">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Product Type Ends Here -->

    <!-- Weight Class Starts Here -->
    <div class="row">
        <div class="col-8">
            <!-- Agents -->
            <h2 class="text text-center">Weight Class</h2>
            <table class="table desc-table text">
                <!-- Table Head -->
                <thead>
                    <tr>
                        <th class="table-row-head">ID#</th>
                        <th class="table-row-head">Weight Class</th>
                        <th class="table-row-head">Actions</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody>
                    <?php
                    // Main Loop
                    foreach ($weightClassRecord as $row) {
                    ?>
                        <tr>
                            <!-- iD -->
                            <th><?php echo $row->WeightClassId ?></th>
                            <!-- Name -->
                            <td class="text"><?php echo $row->WeightClassName ?></td>
                            <!-- Actions Start Here -->
                            <td class="text">
                                <div class="row">
                                    <div class="col-12">
                                        <a href="./delete-additive.php?weight-class-id=<?php echo $row->WeightClassId; ?>"><button type="submit" class="btn text"><i class="fa-solid fa-trash"></i></button></a>
                                    </div>
                                </div>
                            </td>
                            <!-- Actions End Here -->
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="col-4">
            <h2 class="text text-center">Add New Weight Class</h2>
            <!-- Main Content Starts Here -->
            <div class="card">
                <!-- Form -->
                <form method="POST">
                    <!-- Card body -->
                    <div class="card-body">
                        <!-- Basic Info section -->
                        <div class="row gx-xl-5">
                            <div class="col-md-4">
                                <h5>Name</h5>
                            </div>
                            <!-- Form Inputs Start Here -->

                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" for="weight-class-name">Weight Class Name</label>
                                    <input type="text" name="weight-class-name" id="weight-class-name" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer text-end bg-light border-0">
                        <button type="submit" class="btn btn-primary btn-rounded btn-submit" name="weight-class-submit">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Weight Class Ends Here -->

    <!-- Delivery service Starts Here -->
    <div class="row">
        <div class="col-8">
            <!-- Agents -->
            <h2 class="text text-center">Delivery Service</h2>
            <table class="table desc-table text">
                <!-- Table Head -->
                <thead>
                    <tr>
                        <th class="table-row-head">ID#</th>
                        <th class="table-row-head">Delivery Service</th>
                        <th class="table-row-head">Actions</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody>
                    <?php
                    // Main Loop
                    foreach ($deliveryServiceRecord as $row) {
                    ?>
                        <tr>
                            <!-- iD -->
                            <th><?php echo $row->DeliveryServiceId ?></th>
                            <!-- Name -->
                            <td class="text"><?php echo $row->DeliveryServiceName ?></td>
                            <!-- Actions Start Here -->
                            <td class="text">
                                <div class="row">
                                    <div class="col-12">
                                        <a href="./delete-additive.php?delivery-service-id=<?php echo $row->DeliveryServiceId; ?>"><button type="submit" class="btn text"><i class="fa-solid fa-trash"></i></button></a>
                                    </div>
                                </div>
                            </td>
                            <!-- Actions End Here -->
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="col-4">
            <h2 class="text text-center">Add New Delivery Service</h2>
            <!-- Main Content Starts Here -->
            <div class="card">
                <!-- Form -->
                <form method="POST">
                    <!-- Card body -->
                    <div class="card-body">
                        <!-- Basic Info section -->
                        <div class="row gx-xl-5">
                            <div class="col-md-4">
                                <h5>Name</h5>
                            </div>
                            <!-- Form Inputs Start Here -->

                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" for="delivery-service-name">Delivery Service Name</label>
                                    <input type="text" name="delivery-service-name" id="delivery-service-name" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer text-end bg-light border-0">
                        <button type="submit" class="btn btn-primary btn-rounded btn-submit" name="delivery-service-submit">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delivery service Ends Here -->

    <!-- Tables End Here -->
</div>

<!-- Main Content Ends Here -->

<?php
include('../assets/template/admin/footer.php');
?>