<?php
// Header
include('./assets/template/user/header.php');

// Tracking Number
if (isset($_POST['submit-tracking-number'])) {
  $_SESSION['tracking-number'] = "CR-" . $_POST['tracking-number'];
  header("location: ./order-status.php");
};
?>
<!-- Links to External Resources Starts Here -->

<!-- Home Css Link -->
<link rel="stylesheet" href="./assets/CSS/userCss/hero.css">

<!-- Links to External Resources Ends Here -->

<div class="container ">
  <!-- Hero Section Starts Here -->
  <main>
    <section class="section-hero section">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="section-hero-data">
            <p class="hero-top-data">DELIVERING THE FUTURE</p>
            <h3 class="hero-sub-heading"> <a class="hero-sub-heading-letter">B</a>uilding Stronger Connections with</h1>
              <h1 class="hero-heading">Innovative Global Solutions.</h1>
              <p class="hero-para">
                M&P helps you deliver on your commitments by <br> ensuring we fulfill ours.
              </p>
              <!-- Button -->
              <div class="input-group mb-3">
                <?php
                if (isset($_SESSION['useremail'])) {
                ?>
                  <form method="POST">
                    <div class="row">
                      <div class="col-10">
                        <!-- Tracking Number -->
                        <div class="row">
                          <div class="col-2 text-end mt-3 text-light">CR- </div>
                          <div class="col-10"><input type="number" class="form-control mt-2" placeholder="Tracking Number" aria-label="Recipient's username" aria-describedby="basic-addon2" name="tracking-number" required min="10000" max="99999"> </div>
                        </div>
                      </div>
                      <div class="col-2">
                        <!-- Submit -->
                        <button type="submit" class="btn" style="margin-top: 2px;" name="submit-tracking-number">
                          <span class="input-group-text hero-input-right w-100"><i class="fa-solid fa-truck-fast"></i></span>
                        </button>
                      </div>
                    </div>


                  </form>
                <?php
                } else {
                ?>
                  <button class="btn btn-color"><a href="./user/registration/authentication.php">Log In To Track Your Package</a></button>
                <?php
                }
                ?>

              </div>
          </div>
        </div>

        <!-- hero section right side  -->
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="section-hero-image">
            <!-- Hero Img -->
            <img src="./assets/img/userimg/hero-img.png" class="hero-img" alt="Package Being Delivered">
            <!-- Hero Img Ends -->
            <!-- Hero Animation -->
            <div class="animation">
              <div class="circle"></div>
              <div class="sec-circle"></div>
            </div>

          </div>
        </div>
      </div>


    </section>
  </main>
</div>
<!-- Hero Section Ends Here -->

<!-- Special Services Container Starts here -->
<div class="info-box">
  <div class="container">
    <div class="row">
      <!-- Icon With Text Starts Here-->
      <div class="col-lg-4 col-md-4 col-sm-12 info-box-content">
        <div class="row">
          <div class="col-4 text-end">
            <i class="fa-solid fa-clock"></i>
          </div>
          <div class="col-6 text-start">
            <p class="info-box-heading">Working Hours</p>
            <p class="info-box-sub-heading">Mon - Sat 09:00AM - 05:30PM</p>
          </div>
        </div>
      </div>
      <!-- Icon With Text Ends Here-->
      <!-- Icon With Text Starts Here-->
      <div class="col-lg-4 col-md-4 col-sm-12  info-box-content">
        <div class="row">
          <div class="col-4 text-end">
            <i class="fa-solid fa-envelope"></i>
          </div>
          <div class="col-6 text-start">
            <p class="info-box-heading">Email Now!</p>
            <p class="info-box-sub-heading">contact@mulphilog.com</p>
          </div>
        </div>
      </div>
      <!-- Icon With Text Ends Here-->
      <!-- Icon With Text Starts Here-->
      <div class="col-lg-4 col-md-4 col-sm-12 ">
        <div class="row">
          <div class="col-4 text-end">
            <i class="fa-solid fa-phone"></i>
          </div>
          <div class="col-6 text-start">
            <p class="info-box-heading">Get In Touch</p>
            <p class="info-box-sub-heading">(021) 111-202-202</p>
          </div>
        </div>
      </div>
      <!-- Icon With Text Ends Here-->

    </div>
  </div>

</div>
<!-- Special Services Container Ends here -->

<!-- Qualities Section Starts Here -->
<section class="qualities">
  <div class="qualities-row">
    <div class="qualities-column">
      <div class="qualities-card">
        <div class="qualities-icon-wrapper">
          <i class="fa-solid fa-hammer"></i>
        </div>
        <h3 class="qualities-h3">Fast</h3>
        <p class="qualities-p">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero hic
          excepturi laborum molestiae, repudiandae velit tenetur error
          voluptates numquam possimus ad. Iure similique deserunt doloremque
          nostrum? Quam iure ex labore.
        </p>
      </div>
    </div>
    <div class="qualities-column">
      <div class="qualities-card">
        <div class="qualities-icon-wrapper">
          <i class="fa-solid fa-hammer"></i>
        </div>
        <h3 class="qualities-h3">Secure</h3>
        <p class="qualities-p">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero hic
          excepturi laborum molestiae, repudiandae velit tenetur error
          voluptates numquam possimus ad. Iure similique deserunt doloremque
          nostrum? Quam iure ex labore.
        </p>
      </div>
    </div>
    <div class="qualities-column">
      <div class="qualities-card">
        <div class="qualities-icon-wrapper">
          <i class="fa-solid fa-hammer"></i>
        </div>
        <h3 class="qualities-h3">Reliable</h3>
        <p class="qualities-p">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero hic
          excepturi laborum molestiae, repudiandae velit tenetur error
          voluptates numquam possimus ad. Iure similique deserunt doloremque
          nostrum? Quam iure ex labore.
        </p>
      </div>
    </div>
  </div>
</section>
<!-- Qualities Section Ends Here -->



<!-- Main Content Ends Here -->

<?php
include('./assets/template/user/footer.php')
?>