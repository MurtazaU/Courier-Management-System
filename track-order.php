<?php
// Header
include('./assets/template/user/header.php');

// Button
if (isset($_POST['submit-tracking-number'])) {
    $_SESSION['tracking-number'] = "CR-" . $_POST['tracking-number'];
    header("location: ./order-status.php");
}
?>

<!-- CSS Link -->
<link rel="stylesheet" href="./assets/CSS/userCSS/track-order.css">

<!-- Main Body Starts Here -->
<div class="container" style="margin-top: 100px;">
    <!-- Main Row -->
    <div class="row m-5">
        <!-- Condition -->
        <?php
        if (!isset($_SESSION['useremail'])) {
        ?>
            <!-- Card -->
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title text-dark">Please Login First To View Your Courier's Status</h5>
                </div>
            </div>
        <?php
        } else {
        ?>
            <!-- Card -->
            <div class="card w-100 m-lg-5">
                <div class="card-body">
                    <h5 class="card-title text-dark">Search For Your Order's Status</h5>
                    <h6 class="text-dark">Make Sure To Write The Correct Tracking Number</h6>
                    <form method="POST">
                        <div class="row">
                            <div class="col-xl-6 col-sm-12">
                                <!-- Tracking Number -->
                                <div class="row">
                                    <div class="col-2 text-end mt-3">CR - </div>
                                    <div class="col-10"><input type="number" class="form-control mt-2" placeholder="Enter Tracking Number" aria-label="Recipient's username" aria-describedby="basic-addon2" name="tracking-number" required min="10000" max="99999"> </div>
                                </div>

                            </div>
                            <div class="col-xl-6 col-sm-12 ">
                                <!-- Submit -->
                                <button type="submit" class="btn" style=" margin-top: 2px;" name="submit-tracking-number">
                                    <span class="input-group-text hero-input-right  px-5 py-2" style="background:#f46711; color: white;"><i class="fa-solid fa-truck-fast"></i></span>
                                </button>
                            </div>
                        </div>
                        <h6 class="text-dark">Remember, only the couriers associated with the email address you are currently logged in with will be shown</h6>
                    </form>
                </div>
            </div>

        <?php }  ?>
    </div>
</div>
<!-- Main Body Ends Here -->


<?php
// Footer
include('./assets/template/user/footer.php');

?>