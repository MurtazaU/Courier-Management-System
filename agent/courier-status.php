<?php
// Header
include('../assets/template/agent/header.php');
// Db Connection
include('../assets/modules/dbconnection.php');

// Packages
$package = $con->prepare('select PackageId, PackageCode, PackageStatus, PackageDateReceived, PackageDateDelivered, PackageDeliveryServiceId from package where PackageFranchiseId = ?');
$package->bindParam(1, $_SESSION['agent-franchise-id']);
$package->execute();
$packageRecord = $package->fetchAll(PDO::FETCH_OBJ);
?>

<!-- Main Content Starts Here -->
<div class="container">
    <div class="row m-3">
        <h2 class="text-center text">View And Manage Courier's Status</h2>
    </div>
    <div class="row">
        <table class="table status-table">
            <thead>
                <tr>
                    <th class="text">ID</th>
                    <th class="text">Tracking Number</th>
                    <th class="text">Status</th>
                    <th class="text">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop -->
                <?php
                foreach ($packageRecord as $row) {
                ?>
                    <tr>
                        <th class="text" id="packageId"><?php echo $row->PackageId ?></th>
                        <td class="text" id="packageCode"><?php echo $row->PackageCode ?></td>
                        <td>
                            <div class="row">
                                <div class="status">
                                    <div class="status-text col-4">
                                        <?php
                                        // Received
                                        if ($row->PackageStatus == "Registered") {
                                        ?>
                                            <div class="status-primary ">Registered</div>
                                        <?php
                                        }
                                        // UnderWay
                                        if ($row->PackageStatus == "In Progress") {
                                        ?>
                                            <div class="status-red">In Progress</div>
                                        <?php
                                        }
                                        // Delivered
                                        if ($row->PackageStatus == "Delivered") {
                                        ?>
                                            <div class="status-green">Delivered</div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-6 ">
                                    <a href="./edit-courier-status.php?courier-id=<?php echo $row->PackageId ?>">
                                        <button type="button" class="btn btn-bg ">
                                            <i class="fa-solid fa-pencil"></i> &nbsp; Change Status
                                        </button>
                                    </a>
                                </div>
                                <div class="col-6"></div>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Main Content Ends Here -->

<?php

// Footer
include('../assets/template/agent/footer.php');
?>