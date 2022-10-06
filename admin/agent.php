<?php 
include('../assets/template/admin/header.php');

include('../assets/modules/dbconnection.php');

// New Agents Analytics
$date = date("Y-m-d");
$newAgents = $con -> prepare('select * from agent where AgentRegistrationDate = ?');
$newAgents -> bindParam(1, $date);
$newAgents -> execute();
$newAgentsCount = $newAgents -> rowCount();

// All Agents Details
$agents = $con -> prepare('select * from agent');
$agents->execute();

// Total Agent Count
$totalAgentsCount = $agents->rowCount();
$agentsRecord = $agents->fetchAll(PDO::FETCH_OBJ);

// Franchise Id
$franchise = $con -> prepare('select FranchiseId, FranchiseCode, FranchiseAddress from franchise');
$franchise -> execute();
$franchiseRecord = $franchise -> fetchAll(PDO::FETCH_OBJ);

// Country Id
$country = $con -> prepare('select CountryId, CountryName from country');
$country -> execute();
$countryRecord = $country -> fetchAll(PDO::FETCH_OBJ);

?>

<!-- Main Content Starts Here -->
<div class="container">
        <h3 class="text mt-3">Agents</h3>
<!-- Analytics Start Here -->
    <div class="row mt-3">
      <div class="main-heading">
        <h2 class="text-center mb-3 text">Analytics</h2>
      </div>
          <!-- Card Starts Here -->
        <div class="col-xl-6 col-lg-6">
            <div class="card l-bg-cherry">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large">
                      <!-- Icon -->
                      <i class="fas fa-box"></i>
                    </div>
                    <div class="mb-4">
                      <!-- Main Heading -->
                        <h6 class="card-title mb-0">New Agents Today</h6>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                              <!-- Body Text -->
                                <?php echo $newAgentsCount ?>
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
            <!-- Card Starts Here -->
        <div class="col-xl-6 col-lg-6">
            <div class="card l-bg-orange-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large">
                      <!-- Icon -->
                      <i class="fas fa-boxes-stacked"></i>
                    </div>
                    <div class="mb-4">
                        <!-- Main Heading -->
                        <h6 class="card-title mb-0">Total Agents</h6>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                                <!-- Body Text -->
                                <?php echo $totalAgentsCount; ?>
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

  <!-- Tables Start Here -->
  
  <div class="row">
    <div class="col-12">
        <!-- Agents -->
        <table class="table text">
            <!-- Table Head -->
            <thead>
                <tr>
                <th class="table-row-head">ID#</th>
                <th class="table-row-head">Agent Name</th>
                <th class="table-row-head">Agent Email</th>
                <th class="table-row-head">Franchise Code</th>
                <th class="table-row-head">Franchise Address</th>
                <th class="table-row-head">Agent City</th>
                <th class="table-row-head">Agent State</th>
                <th class="table-row-head">Agent Country</th>
                <th class="table-row-head">Agent IP Address</th>
                <th class="table-row-head">Agent Registration Date</th>
                <th class="table-row-head">Actions</th>
                </tr>
            </thead>
            <!-- Table Body -->
            <tbody>
                <?php 
                // Main Loop
                foreach($agentsRecord as $row){
                ?>
                <tr>
                    <!-- iD -->
                <th><?php echo $row-> AgentId?></th>
                <!-- Name -->
                <td class="text"><?php echo $row->AgentName ?></td>
                <!-- Email -->
                <td class="text"><?php echo $row-> AgentEmail?></td>
                <!-- Franchise Code -->
                <td class="text">
                    <?php foreach($franchiseRecord as $franchise){ 
                    if($row->AgentFranchiseId == $franchise -> FranchiseId){
                        echo $franchise->FranchiseCode;
                    } 
                    } ?>
                </td>
                <!-- FranchiseAddress -->
                <td class="text">
                    <?php foreach($franchiseRecord as $franchise){ 
                    if($row->AgentFranchiseId == $franchise -> FranchiseId){
                        echo $franchise->FranchiseAddress;
                    } 
                    } ?>
                </td>
                <!-- City -->
                <td class="text"><?php echo $row-> AgentCity?></td>
                <!-- State -->
                <td class="text"><?php echo $row-> AgentState?></td>
                <!-- Country -->
                <td class="text">
                    <?php foreach($countryRecord as $country){ 
                    if($row->AgentCountryId == $country -> CountryId){
                        echo $country->CountryName;
                    } 
                    } ?>
                </td>
                <!-- IP Address -->
                <td class="text"><?php echo $row-> AgentIP?></td>
                <!-- Registration Date -->
                <td class="text"><?php echo $row-> AgentRegistrationDate?></td>

                <!-- Actions Start Here -->
                <td class="text">
                    <div class="row">
                        <div class="col-12">
                            <a href="./update-agent.php?agent-id=<?php echo $row->AgentId; ?>"><button type="submit" class="btn text"><i class="fa-solid fa-pen-to-square"></i></button></a>
                        </div>
                        <div class="col-12">
                            <a href="./delete-agent.php?agent-id=<?php echo $row->AgentId; ?>"><button type="submit" class="btn text"><i class="fa-solid fa-trash"></i></button></a>
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