<?php 
include('../assets/modules/dbconnection.php');
session_start();
if(isset($_REQUEST['adminSubmit'])){
    $email = $_REQUEST['adminEmail'];
    $password = $_REQUEST['adminPassword'];

    // Database
    $sql = $con -> prepare('select * from admin where AdminEmail = ? && AdminPassword = ?');
    $sql -> bindParam(1, $email);
    $sql -> bindParam(2, $password);
    // Execute Query
    $sql -> execute();
    $count = $sql ->rowCount();
    if($count == 1){
        $_SESSION['admin-email'] = $email;
        header("Location: ./dashboard.php");
    } else{
        ?>
        <div class="alert alert-danger text-center" role="alert">
        Kindly check your credentials. No admin found.
        </div>
        <?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Icons -->
    <link
      href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css"
      rel="stylesheet"
    />

    <!-- Custom CSS Link -->
    <link rel="stylesheet" href="../assets/CSS/adminCSS/login.css">

    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <!-- FontAwesome Kit -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Log In As An Admin</title>
  </head>
<body>
  <div class="container">
    <div class="row mt-5">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto glass-form">
        <!-- Form Container Starts Here -->
        <div class="  rounded-3 my-5 ">
          <div class="card-body p-4 p-sm-5">
            <h3 class=" text-center mb-5">Sign In</h3>
            <!-- Form Starts Here -->
            <form method="POST">
                <!-- Email Input -->
              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" name="adminEmail" placeholder="name@example.com" required>
                <label for="floatingInput">Email address</label>
              </div>
              <!-- Password Input -->
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" name="adminPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
              </div>
              <!-- Submit Button -->
              <div class="d-grid">
                <input type="submit" name="adminSubmit" value="Log in" class="btn btn-primary btn-login text-uppercase fw-bold"/>
              </div>
                          <p class="text-center mt-3">Log In As A User? <a href="../user/registration/authentication.php">Click Here</a></p>
            </form>
            <!-- Form Starts Here -->
          </div>
        </div>
    <!-- Form Container Ends Here -->
      </div>
    </div>
  </div>
</body>