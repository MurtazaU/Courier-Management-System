<?php
// Header
include('../assets/template/admin/header.php');
// Db Connection
include('../assets/modules/dbconnection.php');

// Courier Id
$customerId = $_GET['customer-id'];

$sql = $con->prepare('select CustomerName, CustomerEmail, CustomerNumber from customer where CustomerId = ?');
$sql->bindParam(1, $customerId);
$sql->execute();
$customerRecord = $sql->fetchAll(PDO::FETCH_OBJ);


?>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <!-- Main Heading -->
        <h1 class="text text-center mt-3">Edit Courier's Status</h1>
    </div>
    <div class="row mt-5">
        <!-- Card -->
        <div class="card">
            <form method="POST">
                <div class="card-body">
                    <!-- Card Headings -->
                    <?php foreach ($customerRecord as $row) {
                    ?>
                        <h5 class="card-title">Customer Name = <?php echo $row->CustomerName ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">Customer's Email: &nbsp; <?php echo $row->CustomerEmail ?></h6>
                        <h6 class="card-subtitle mb-2 text-muted">Customer's Number: &nbsp; +<?php echo $row->CustomerNumber ?></h6>
                        <!-- Card Button -->
                        <div class="card-text">
                            <h3>Send A Delivery Message</h3>
                            <button class="btn btn-warning" name="inProgress">Courier has registered</button>
                            <button class="btn btn-primary" name="inProgress">Courier is on way</button>
                            <button class="btn btn-success" name="delivered">Courier has been delivered</button>
                        </div>
                    <?php
                    } ?>

                </div>
            </form>
        </div>
    </div>
</div>

<?php
// Header
include('../assets/template/admin/footer.php');
?>