<?php
// Header
include('../assets/template/admin/header.php');
// DB COnnection
include('../assets/modules/dbconnection.php');


// All Country Details
$country = $con->prepare('select * from country');
$country->execute();

// Total Country Count
$countryCount = $country->rowCount();
$countryRecord = $country->fetchAll(PDO::FETCH_OBJ);

?>

<!-- Main Content Starts Here -->
<div class="container">
    <h3 class="text mt-3">Countries</h3>
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
                        <i class="fas fa-earth-americas"></i>
                    </div>
                    <div class="mb-4">
                        <!-- Main Heading -->
                        <h6 class="card-title mb-0">Total countries</h6>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                                <!-- Body Text -->
                                <?php echo $countryCount; ?>
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
                <a href="./new-country.php">
                    <button class="btn l-bg-cherry mt-3 w-100">Add A New country</button>
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
                        <th class="table-row-head">Country Name</th>
                        <th class="table-row-head">Actions</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody>
                    <?php
                    // Main Loop
                    foreach ($countryRecord as $row) {
                    ?>
                        <tr>
                            <!-- iD -->
                            <th><?php echo $row->CountryId ?></th>
                            <!-- Name -->
                            <td class="text"><?php echo $row->CountryName ?></td>
                            <!-- Actions Start Here -->
                            <td class="text">
                                <div class="row">
                                    <div class="col-12">
                                        <a href="./delete-country.php?country-id=<?php echo $row->CountryId; ?>"><button type="submit" class="btn text"><i class="fa-solid fa-trash"></i></button></a>
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