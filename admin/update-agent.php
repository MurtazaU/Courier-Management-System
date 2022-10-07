<?php
// Header
include('../assets/template/admin/header.php');
include('../assets/modules/dbconnection.php');

// Selected Agent
$agentId = $_GET['agent-id'];

// Default Data
$data = $con->prepare('select * from agent where AgentId = ?');
$data->bindParam(1, $agentId);
$data->execute();
$dataRecord = $data->fetchAll(PDO::FETCH_OBJ);

// Franchise
$franchise = $con->prepare('select FranchiseId, FranchiseCode from franchise');
$franchise->execute();
$franchiseRecord = $franchise->fetchAll(PDO::FETCH_OBJ);

// Countries
$country = $con->prepare('select CountryId, CountryName from country');
$country->execute();
$countryRecord = $country->fetchAll(PDO::FETCH_OBJ);


// Inserting Data
if (isset($_REQUEST['submit'])) {
    $agentName = $_REQUEST['agent-name'];
    $agentEmail = $_REQUEST['agent-email'];
    $agentFranchise = $_REQUEST['franchise-code'];
    $agentCity = $_REQUEST['agent-city'];
    $agentState = $_REQUEST['agent-state'];
    $agentCountry = $_REQUEST['agent-country'];

    // Inserting Data
    $sql = $con->prepare("update agent set AgentName = ?, AgentEmail = ?, AgentFranchiseId = ?, AgentCity = ?, AgentState = ?, AgentCountryId = ? where AgentId = ?");

    $sql->bindParam(1, $agentName);
    $sql->bindParam(2, $agentEmail);
    $sql->bindParam(3, $agentFranchise);
    $sql->bindParam(4, $agentCity);
    $sql->bindParam(5, $agentState);
    $sql->bindParam(6, $agentCountry);
    $sql->bindParam(7, $agentId);

    $sql->execute();
 ?>
  <script>
        window.location.href = "./agent.php";
     </script>
 <?php
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
                <h4 class="mb-0 fw-bold">Update Agent: ID = <?php echo $_GET['agent-id']; ?> </h4>
            </div>

            <!-- Card body -->
            <div class="card-body">
                <?php
                foreach ($dataRecord as $data) {
                ?>
                    <!-- Basic Info section -->
                    <div class="row gx-xl-5">
                        <div class="col-md-4">
                            <h5>Basic Info</h5>
                        </div>
                        <!-- Form Inputs Start Here -->
                        <div class="col-md-8">

                            <!-- Agent Name -->
                            <div class="mb-3">
                                <label for="agent-name" class="form-label">Agent Name</label>
                                <input type="text" value="<?php echo $data->AgentName ?>" name="agent-name" class="form-control" id="agent-name" />
                            </div>
                            <!-- Agent Email -->
                            <div class="mb-3">
                                <label for="agent-email" class="form-label">Agent Email</label>
                                <input type="email" value="<?php echo $data->AgentEmail ?>" name="agent-email" class="form-control" id="agent-email">
                            </div>
                        </div>
                    </div>

                    <hr class="my-5" />

                    <!-- Address section -->
                    <div class="row gx-xl-5">
                        <div class="col-md-4">
                            <h5>Address</h5>
                        </div>

                        <div class="col-md-8">
                            <div class="row ">
                                <!-- Franchise Code -->
                                <div class="col-md-12">
                                    <label for="franchise-code" class="form-label">Franchise Code</label>
                                    <select name="franchise-code" id="franchise-code" class="search-select form-select">
                                        <?php foreach ($franchiseRecord as $row) {
                                            if ($row->FranchiseId == $data->AgentFranchiseId) {
                                        ?>
                                                <option selected value="<?php echo $row->FranchiseId ?>"><?php echo $row->FranchiseCode ?></option>
                                            <?php
                                            } else {
                                            ?>
                                                <option value="<?php echo $row->FranchiseId ?>"><?php echo $row->FranchiseCode ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <p class="text-muted text">On the franchise page, you can see the franchise's address.</p>
                                <!-- City -->
                                <div class="mb-3">
                                    <label for="agent-city" class="form-label">Agent City</label>
                                    <input type="text" value="<?php echo $data->AgentCity ?>" name="agent-city" class="form-control" id="agent-city">
                                </div>
                                <!-- State -->
                                <div class="mb-3">
                                    <label for="agent-state" class="form-label">Agent State</label>
                                    <input type="text" value="<?php echo $data->AgentState ?>" name="agent-state" class="form-control" id="agent-state">
                                </div>
                                <!-- Agent Country -->
                                <div class="col-md-12">
                                    <label for="agent-country" class="form-label">Agent Country</label>
                                    <select name="agent-country" id="agent-country" class="search-select form-select">
                                        <?php foreach ($countryRecord as $row) {
                                            if ($row->countryId == $data->AgentCountryId) {
                                        ?>
                                                <option selected value="<?php echo $row->CountryId ?>"><?php echo $row->CountryName ?></option>
                                            <?php
                                            } else {
                                            ?>
                                                <option value="<?php echo $row->CountryId ?>"><?php echo $row->CountryName ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

            </div>
        <?php
                }
        ?>


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