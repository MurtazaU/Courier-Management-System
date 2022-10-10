<?php
// Header
include('../assets/template/admin/header.php');
// DB COnnection
include('../assets/modules/dbconnection.php');


// All Franchise Details
$franchise = $con->prepare('select * from franchise');
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
    <h3 class="text mt-3">Franchsie</h3>
    <!-- Analytics Start Here -->
    <div class="row mt-3">
        <div class="main-heading">
            <h2 class="text-center mb-3 text">Analytics</h2>
        </div>
        <!-- Card Starts Here -->
        <div class="col-xl-12 col-lg-6">
            <div class="card l-bg-cherry">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large">
                        <!-- Icon -->
                        <i class="fas fa-building icon"></i>
                    </div>
                    <div class="mb-4">
                        <!-- Main Heading -->
                        <h6 class="card-title mb-0">Total Franchises</h6>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                                <!-- Body Text -->
                                <?php echo $franchiseCount; ?>
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
                <a href="./new-franchise.php">
                    <button class="btn l-bg-cherry mt-3 w-100">Create A New Franchise</button>
                </a>
            </div>
        </div>
    </section>
    <!-- New Section Ends Here -->

    <!-- Tables Start Here -->

    <div class="row">
        <div class="col-12">
            <!-- Agents -->
            <table class="table desc-table text">
                <!-- Table Head -->
                <thead>
                    <tr>
                        <th class="table-row-head">ID#</th>
                        <th class="table-row-head">Franchise Name</th>
                        <th class="table-row-head">Franchise Code</th>
                        <th class="table-row-head">Franchise Email</th>
                        <th class="table-row-head">Franchise Number</th>
                        <th class="table-row-head">Franchise Address</th>
                        <th class="table-row-head">Franchise City</th>
                        <th class="table-row-head">Franchise State</th>
                        <th class="table-row-head">Franchise Country Id</th>
                        <th class="table-row-head">Actions</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody>
                    <?php
                    // Main Loop
                    foreach ($franchiseRecord as $row) {
                    ?>
                        <tr>
                            <!-- iD -->
                            <th><?php echo $row->FranchiseId ?></th>
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
                            <!-- Actions Start Here -->
                            <td class="text">
                                <div class="row">
                                    <div class="col-12">
                                        <a href="./delete-franchise.php?franchise-id=<?php echo $row->FranchiseId; ?>"><button type="submit" class="btn text"><i class="fa-solid fa-trash"></i></button></a>
                                    </div>
                                </div>
                            </td>
                            <!-- Actions End Here -->
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