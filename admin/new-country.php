<?php
// Header
include('../assets/template/admin/header.php');
include('../assets/modules/dbconnection.php');

// Inserting Data
if (isset($_POST['submit'])) {
    $countryName = $_POST['country-name'];

    // Check to see if there is already an agent with the same code
    $check = $con->prepare('select * from country where CountryName = ?');
    $check->bindParam(1, $countryName);
    $check->execute();
    $checkCount = $check->rowCount();

    if ($checkCount == 0) {
        // Query
        $sql = $con->prepare('insert into country(countryName) values (?)');
        $sql->bindParam(1, $countryName);
        $sql->execute();
    } else {
        echo    '<div class="alert text text-center alert-danger" role="alert">
                There is already another country added with the same name
                </div>';
    }
}
?>

<!-- Main Content Starts Here -->
<div class="container my-5">
    <div class="card mx-lg-5 p-lg-5">
        <!-- Form -->
        <form method="POST">
            <!-- Card header -->
            <div class="card-header py-4 px-5 bg-light border-0">
                <h4 class="mb-0 fw-bold">Add New country</h4>
            </div>

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
                            <label class="form-label" for="country-name">Country Name</label>
                            <input type="text" name="country-name" id="country-name" class="form-control" required>
                        </div>
                    </div>
                </div>

                <hr class="my-5" />
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