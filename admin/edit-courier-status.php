<?php
// Header
include('../assets/template/admin/header.php');
// Db Connection
include('../assets/modules/dbconnection.php');

// Courier Id
$courierId = $_GET['courier-id'];

$sql = $con->prepare('select PackageStatus, PackageCode from package where PackageId = ?');
$sql->bindParam(1, $courierId);
$sql->execute();
$packageRecord = $sql->fetchAll(PDO::FETCH_OBJ);

// In Progress
if (isset($_REQUEST['inProgress'])) {
    $null = null;
    $progress = "In Progress";
    $inProgressStatus = $con->prepare('update package set PackageStatus = ?, PackageDateDelivered = ? where PackageId = ?');
    $inProgressStatus->bindParam(1, $progress);
    $inProgressStatus->bindParam(2, $null);
    $inProgressStatus->bindParam(3, $courierId);
    $inProgressStatus->execute();
?>
    <script>
        location.href = "./courier-status.php"
    </script>
<?php
}

// Delivered
if (isset($_REQUEST['delivered'])) {
    $date = date("Y-m-d");
    $delivered = "Delivered";
    $deliveryStatus = $con->prepare('update package set PackageStatus = ?, PackageDateDelivered = ? where PackageId = ?');
    $deliveryStatus->bindParam(1, $delivered);
    $deliveryStatus->bindParam(2, $date);
    $deliveryStatus->bindParam(3, $courierId);
    $deliveryStatus->execute();
?>
    <script>
        location.href = "./courier-status.php"
    </script>
<?php
}

?>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <!-- Main Heading -->
        <h1 class="text text-center mt-3">Edit Courier's Status</h1>
    </div>
    <div class="row mt-5">
        <!-- Card -->
        <?php foreach ($packageRecord as $row) { ?>
            <div class="card">
                <form method="POST">
                    <div class="card-body">
                        <!-- Card Headings -->
                        <h5 class="card-title">Courier Id = <?php echo $courierId ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">Tracking Number: &nbsp; <?php echo $row->PackageCode ?></h6>
                        <h6 class="card-subtitle mb-2 text-muted">Courier's Current Status: &nbsp; <?php echo $row->PackageStatus ?></h6>
                        <!-- Card Button -->
                        <div class="card-text">
                            <h3>Change Courier's Status To</h3>
                            <button class="btn btn-warning" name="inProgress">In Progress</button>
                            <button class="btn btn-success" name="delivered">Delivered</button>
                        </div>
                    </div>
                </form>
            </div>
        <?php } ?>
    </div>
</div>

<?php
// Header
include('../assets/template/admin/footer.php');
?>