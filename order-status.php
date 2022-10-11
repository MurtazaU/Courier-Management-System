<?php
// Header
include('./assets/template/user/header.php');
if (!isset($_SESSION['tracking-number'])) {
    header("location: ./index.php");
}
?>

<!-- CSS Link -->
<link rel="stylesheet" href="./assets/CSS/userCSS/track-order.css">

<!-- Main Body Starts Here -->
<div class="container" style="margin-top: 100px;">
    <!-- Main Row -->
    <div class="row m-5">
        <!-- Card -->
        <div class="card w-100">
            <div class="card-body">
                <h5 class="card-title text-dark">Your Order's Status</h5>
                <h6 class="card-subtitle mb-2 text-muted">Order Number: <?php echo $_SESSION['tracking-number'] ?></h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div>
</div>
<!-- Main Body Ends Here -->


<?php
// Footer
include('./assets/template/user/footer.php');

?>