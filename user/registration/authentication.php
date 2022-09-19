<!-- PHP Code Starts Here  -->
<?php
session_start();
include('../../assets/modules/dbconnection.php');

// Registration PHP Starts Here

if(isset($_REQUEST['register-form-btn'])){
  // Get All Values From Registration Form
  $useremail = $_REQUEST['log-password'];
  $registeremail = $_REQUEST['register-email'];
  $registerpassword = $_REQUEST['register-password'];
  $registernumber = $_REQUEST['register-number'];
  $registeraddress = $_REQUEST['register-address'];
  $registerzipcode = $_REQUEST['register-zip-code'];
  $registercity = $_REQUEST['register-city'];
  $registerstate = $_REQUEST['register-state'];
  $registercountry = $_REQUEST['register-country'];

  // Check to see if there are any other accounts using the same email
  // $query = $con -> prepare('select * from customer where customeremail = "murtazausmani985@gmail.com"');
  // $query -> execute();
  // $query_count = $query->rowCount();

  // If there is no account using the same email then proceed or else spit out an error
            $sql = $con->prepare('insert into customer(customername,customeremail,customerpassword, customerzipcode, customercountryid, customerstate, customercity, customeraddress, customernumber) values (?,?,?,?,?,?,?,?,?)');
            $sql->bindParam(1,$registername);
            $sql->bindParam(2,$registeremail);
            $sql->bindParam(3,$registerpassword);
            $sql->bindParam(4,$registerzipcode);
            $sql->bindParam(5,$registercountry);
            $sql->bindParam(6,$registerstate);
            $sql->bindParam(7,$registercity);
            $sql->bindParam(8,$registeraddress);
            $sql->bindParam(9,$registernumber);

            // Execute the script
            $sql->execute();

}

// Registration PHP Ends Here

// Log In PHP Starts Here
if(isset($_REQUEST['log-submit'])){
  $useremail = $_REQUEST['log-email'];
  $userpassword = $_REQUEST['log-password'];

  $sql = $con->prepare('select * from customer where customeremail = ? && customerpassword = ?');
  $sql -> bindParam(1, $useremail);
  $sql -> bindParam(2, $userpassword);
  $sql -> execute();
  $count = $sql -> rowCount();
  if($count > 0 ){
    $_SESSION['useremail'] = $useremail;
    header('location: ../../index.php');
  } else{
    $_SESSION['No-User-Found'] = 'Invalid Credentials Provided';
  }
}
// Log In PHP Ends Here

?>
<!-- PHP Code Ends Here -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- FontAwesome Kit -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Jquery JS Link -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <!-- CSS Link -->
    <link rel="stylesheet" href="../../assets/CSS/userCSS/registration.css" />

    <!-- Bootstrap Link -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />

  </head>
  <body>
    <!-- Main Content Starts Here -->
    <div class="register-container">
      <div class="forms-container">
        <div class="signin-signup">
          <!-- Sign In Form Starts Here -->
          <form action="" class="sign-in-form" method="POST" name="sign-in-form">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="email" placeholder="Email" name="log-email" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock" aria-hidden="true" id="eye" onclick="togglePassword()"></i>
              <input type="password" placeholder="Password" id="password" name="log-password" required/>
            </div>
            <input type="submit" value="Login" class="register-btn solid" name="log-submit" />
            <?php 

            if(isset($_SESSION['No-User-Found'])){
              ?>
              <div class="alert alert-danger" role="alert">
                Invalid Credentials Provided
              </div>
              <?php
              session_unset();
              session_destroy();
            }
            ?>

          </form>
          <!-- Sign In Form Ends Here -->

          <!-- Sign Up Form Starts Here -->
          <form action="" class="sign-up-form" method="POST" name="register-form">
            <h2 class="title">Sign up</h2>
            <!-- Inputs -->
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="register-name" required/>
            </div>

            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="register-email" required/>
            </div>

            <!-- MultiColumn -->
            <div class="input-field password-wrapper">
              <i class="fa-solid fa-eye" aria-hidden="true" id="eye" onclick="togglePassword()"></i>
              <input type="password" placeholder="Password" id="password" name="register-password" required/>
            </div>


            <div class="input-field">
              <i class="fas fa-phone"></i>
              <input type="number" placeholder="Phone Number" name="register-number" required/>
            </div>


            <div class="input-field">
                <i class="fas fa-address-book"></i>           
                <input type="text" placeholder="Home Address" name="register-address" required/>
            </div>

            <div class="input-field">
                <i class="fas fa-location-pin"></i>
                <input type="text" placeholder="Zip Code" name="register-zip-code" required/>
            </div>

            <div class="input-field">
                <i class="fas fa-city"></i>          
                <input type="text" placeholder="City" name="register-city" required/>
            </div>

            <!-- MultiColumns -->
            <div class="row">
              <div class="col-6">
            <div class="input-field">
                <i class="fas fa-solid fa-map-location-dot"></i>
                <input type="text" placeholder="State" name="register-state" required/>
            </div>
              </div>

              <div class="col-6">
            <div class="input-field">
                <i class="fas fa-flag"></i>
                <select name="register-country" class="register-country" id="">
                  <?php 
                  $sql = $con->prepare('select * from country');
                  $sql -> execute();
                  $record = $sql -> fetchAll(PDO::FETCH_OBJ); 
                  foreach($record as $row){
                    echo $row->CountryName;
                    ?>
                    <option class="" value="<?php echo $row-> CountryId ?>"> <?php echo $row-> CountryName ?> </option>
                    <?php
                  }
                  ?>
                </select>
            </div>
              </div>
            </div>

            <input type="submit" class="register-btn" value="Sign up" name="register-form-btn" />
          </form>
        <!-- Sign Up Form Ends Here -->
        </div>
      </div>

      <!-- Panels Starts Here -->
      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here?</h3>
            <p>
              Let's get started by creating your very own account through which you will be able to manage all of your couriers and more.
            </p>
            <button class="register-btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="../../assets/img/userimg/register-img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One Of Us?</h3>
            <p>
              Let's log you in to start working
            </p>
            <button class="register-btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="../../assets/img/userimg/register-img/register.svg" class="image" alt="" />
        </div>
      </div>
    <!-- Panels Ends Here -->
    </div>
    <!-- Main Content Ends Here -->

    <!-- JavaScript Link -->
    <script src="../../assets/JS/userJS/register.js"></script>

    <!-- Toggle Password JS -->
    <script src="../../assets/JS/togglePassword.js"></script>

  </body>
</html>
