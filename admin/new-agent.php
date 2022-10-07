<?php 
// Header
include('../assets/template/admin/header.php');
include('../assets/modules/dbconnection.php');

$franchise = $con -> prepare('select FranchiseId,FranchiseCode from franchise');
$franchise -> execute();
$franchiseRecord = $franchise -> fetchAll(PDO::FETCH_OBJ);

// Inserting Data
if(isset($_POST['submit'])){
    $agentName = $_POST['agent-name'];
    $agentEmail = $_POST['agent-email'];
    $agentPassword = $_POST['agent-password'];
    $confirmPassword = $_POST['confirm-agent-password'];
    $agentFranchiseId = $_POST['agent-franchise'];
    $date = date("Y-m-d");

    // Check to see if there is already an agent with the same email
    $check = $con -> prepare('select * from agent where AgentEmail = ?');
    $check-> bindParam( 1, $agentEmail);
    $check -> execute();
    $checkCount = $check -> rowCount();

    if($confirmPassword == $agentPassword){
        if($checkCount == 0){
        // Query
        $sql = $con -> prepare('insert into agent(AgentName, AgentEmail, AgentPassword, AgentFranchiseId, AgentRegistrationDate) values (?,?,?,?,?)');
        $sql -> bindParam(1, $agentName);
        $sql -> bindParam(2, $agentEmail);
        $sql -> bindParam(3, $agentPassword);
        $sql -> bindParam(4, $agentFranchiseId);
        $sql -> bindParam(5, $date);
        $sql -> execute();
    } else{
        echo    '<div class="alert text text-center alert-danger" role="alert">
                There is already another Agent account registered with the same email
                </div>';
    }} else {
        echo    '<div class="alert text text-center alert-danger" role="alert">
                Kindly Match Your Passwords
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
    <form method="POST" >
      <!-- Card header -->
      <div class="card-header py-4 px-5 bg-light border-0">
        <h4 class="mb-0 fw-bold">Add New Agent</h4>
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
              <label class="form-label" for="agent-name"
                    >Agent Name</label
                >
                <input type="text" name="agent-name" id="agent-name" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="agent-email" class="form-label"
                    >Agent Email</label
                >
               <input type="email" required name="agent-email" id="agent-email" class="form-control" />
            </div>

            <div class="mb-3">
              <label for="agent-password" class="form-label"
                    >Agent Password</label
                >
              <input type="password" name="agent-password" class="form-control" id="agent-password" required/>
            </div>
            <div class="mb-3">
              <label for="confirm-agent-password" class="form-label"
                    >Confirm Agent Password</label
                >
              <input type="password" name="confirm-agent-password" class="form-control" id="confirm-agent-password" required/>
            </div>
          </div>
        </div>

        <hr class="my-5" />

        <!-- Address section -->
        <div class="row gx-xl-5">
          <div class="col-md-4">
            <h5>Franchise</h5>
          </div>

          <div class="col-md-8">
            <div class="row ">
              <div class="col-md-12">
                <div class="mb-3">
                  <label for="agent-franchise" class="form-label">Agent Franchise</label>
                  <select name="agent-franchise" id="agent-franchise" class="search-select form-select" required>
                    <option selected disabled></option>
                    <?php foreach($franchiseRecord as $row){
                      ?>
                        <option value="<?php echo $row->FranchiseId ?>"><?php echo $row->FranchiseCode ?></option>
                      <?php
                    }
                    ?>
                  </select>
                  <p class="text-muted text">At the franchise's page, you can view the details of the franchise.</p>
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