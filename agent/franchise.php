<?php
// Header
include('../assets/template/agent/header.php');
// DB COnnection
include('../assets/modules/dbconnection.php');


// All Franchise Details
$franchise = $con->prepare('select * from franchise where FranchiseId = ?');
$franchise->bindParam(1, $_SESSION['agent-franchise-id']);
$franchise->execute();

// Total Franchise Count
$franchiseCount = $franchise->rowCount();
$franchiseRecord = $franchise->fetchAll(PDO::FETCH_OBJ);

// Country Id
$country = $con->prepare('select CountryId, CountryName from country');
$country->execute();
$countryRecord = $country->fetchAll(PDO::FETCH_OBJ);

?>

<!-- Main Content Starts Here -->
<div class="container">
    <h3 class="text mt-3 mb-5 text-center">Your Franchsie</h3>

    <!-- Tables Start Here -->

    <div class="row">
        <div class="col-12">
            <!-- Agents -->
            <table class="table desc-table text">
                <!-- Table Head -->
                <thead>
                    <tr>
                        <th class="table-row-head">Franchise Name</th>
                        <th class="table-row-head">Franchise Code</th>
                        <th class="table-row-head">Franchise Email</th>
                        <th class="table-row-head">Franchise Number</th>
                        <th class="table-row-head">Franchise Address</th>
                        <th class="table-row-head">Franchise City</th>
                        <th class="table-row-head">Franchise State</th>
                        <th class="table-row-head">Franchise Country Id</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody>
                    <?php
                    // Main Loop
                    foreach ($franchiseRecord as $row) {
                    ?>
                        <tr>
                            <!-- Name -->
                            <td class="text"><?php echo $row->FranchiseName ?></td>
                            <!-- Code -->
                            <td class="text"><?php echo $row->FranchiseCode ?></td>
                            <!-- Email -->
                            <td class="text"><?php echo $row->FranchiseEmail ?></td>
                            <!-- Number -->
                            <td class="text"><?php echo $row->FranchiseNumber ?></td>
                            <!-- Address -->
                            <td class="text">
                                <?php echo $row->FranchiseAddress ?>
                            </td>
                            <!-- City -->
                            <td class="text">
                                <?php echo $row->FranchiseCity ?>
                            </td>
                            <!-- State -->
                            <td class="text">
                                <?php echo $row->FranchiseState ?>
                            </td>
                            <!-- Country -->
                            <td class="text">
                                <?php foreach ($countryRecord as $country) {
                                    if ($row->FranchiseCountryId == $country->CountryId) {
                                        echo $country->CountryName;
                                    }
                                } ?>
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
include('../assets/template/agent/footer.php');
?>