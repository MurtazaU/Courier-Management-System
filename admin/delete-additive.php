<?php
include('../assets/modules/dbconnection.php');

// Deleting Product Type
if (isset($_REQUEST['product-type-id'])) {
    $productType = $con->prepare('delete from producttype where ProductTypeId = ?');
    $productType->bindParam(1, $_REQUEST['product-type-id']);
    $productType->execute();
?>
    <script>
        window.location.href = "./additives.php";
    </script>
<?php
}

// Deleting Weight Class
if (isset($_REQUEST['weight-class-id'])) {
    $weightClass = $con->prepare('delete from weightclass where WeightClassId = ?');
    $weightClass->bindParam(1, $_REQUEST['weight-class-id']);
    $weightClass->execute();
?>
    <script>
        window.location.href = "./additives.php";
    </script>
<?php
}
// Deleting Product Type
if (isset($_REQUEST['delivery-service-id'])) {
    $deliveryServiceId = $con->prepare('delete from deliveryservice where DeliveryServiceId = ?');
    $deliveryServiceId->bindParam(1, $_REQUEST['delivery-service-id']);
    $deliveryServiceId->execute();
?>
    <script>
        window.location.href = "./additives.php";
    </script>
<?php
}
