<?php
// Header
include('../assets/template/admin/header.php');
include('../assets/modules/dbconnection.php');

$country = $con->prepare('select CountryId, CountryName from country');
$country->execute();
$countryRecord = $country->fetchAll(PDO::FETCH_OBJ);

// Inserting Data
if (isset($_POST['submit'])) {
    $franchiseName = $_POST['franchise-name'];
    $franchiseAddress = $_POST['franchise-address'];
    $franchiseNumber = $_POST['franchise-number'];
    $franchiseCity = $_POST['franchise-city'];
    $franchiseState = $_POST['franchise-state'];
    $franchiseCountryId = $_POST['franchise-country'];
    $franchiseEmail = $_POST['franchise-email'];
    $franchiseCode = 'FR-' . rand(100, 999);

    // Check to see if there is already an agent with the same code
    $check = $con->prepare('select * from franchise where FranchiseCode = ?');
    $check->bindParam(1, $franchiseCode);
    $check->execute();
    $checkCount = $check->rowCount();

    if ($checkCount == 0) {
        // Query
        $sql = $con->prepare('insert into franchise(FranchiseName, FranchiseCode, FranchiseAddress, FranchiseNumber, FranchiseEmail, FranchiseCity, FranchiseState, FranchiseCountryId) values (?,?,?,?,?,?,?,?)');
        $sql->bindParam(1, $franchiseName);
        $sql->bindParam(2, $franchiseCode);
        $sql->bindParam(3, $franchiseAddress);
        $sql->bindParam(4, $franchiseNumber);
        $sql->bindParam(5, $franchiseEmail);
        $sql->bindParam(6, $franchiseCity);
        $sql->bindParam(7, $franchiseState);
        $sql->bindParam(8, $franchiseCountryId);
        $sql->execute();
    } else {
        echo    '<div class="alert text text-center alert-danger" role="alert">
                There is already another Franchise created with the same email
                </div>';
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
                <h4 class="mb-0 fw-bold">Create New Franchise</h4>
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
                            <label class="form-label" for="franchise-name">Franchise Name</label>
                            <input type="text" name="franchise-name" id="franchise-name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="franchise-address" class="form-label">Franchise Address</label>
                            <input type="text" name="franchise-address" class="form-control" id="franchise-address" required />
                        </div>

                        <div class="mb-3">
                            <label for="franchise-email" class="form-label">Franchise Email</label>
                            <input type="email" name="franchise-email" class="form-control" id="franchise-email" required />
                        </div>

                        <div class="mb-3">
                            <label for="franchise-number" class="form-label">Franchise Number</label>
                            <input type="number" name="franchise-number" class="form-control" id="franchise-number" required />
                        </div>
                    </div>
                </div>

                <hr class="my-5" />

                <!-- Address section -->
                <div class="row gx-xl-5">
                    <div class="col-md-4">
                        <h5>Region</h5>
                    </div>

                    <div class="col-md-8">
                        <div class="row ">
                            <div class="mb-3">
                                <label for="franchise-city" class="form-label">Franchise City</label>
                                <input type="text" name="franchise-city" class="form-control" id="franchise-city" required />
                            </div>
                            <div class="mb-3">
                                <label for="franchise-state" class="form-label">Franchise State</label>
                                <input type="text" name="franchise-state" class="form-control" id="franchise-state" required />
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="franchise-country" class="form-label">Franchise Country</label>
                                    <select name="franchise-country" id="franchise-country" class="search-select form-select" required>
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


            </div>

            <!-- Card footer -->
            <div class="card-footer text-end py-4 px-5 bg-light border-0">
                <button type="submit" class="btn btn-primary btn-rounded btn-submit" name="submit">
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