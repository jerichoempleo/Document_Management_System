<?php

include 'adminlogin_includes/header.php';
include 'connect.php';

session_start();


if (isset($_POST['submit'])) {

  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['pass']);

  if ($email == "admin" && $password == "admin") {

    $_SESSION['admin'] = true;
    header('location:index.php');
    exit();
  } else {
   
    $_SESSION['status'] = "Username and password do not match! Try Again.";
  }
}



if (isset($message)) {
  foreach ($message as $msg) {
    echo "<div class='error-message'>$msg</div>";
  }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="login.css">-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
    
    
    <title>Admin Login</title>

    <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,600;0,700;1,100&family=Roboto:wght@300;400;500&family=Rubik:wght@300;400;500&display=swap');
      
       .hoverbtn:hover{
        background-color: maroon !important;
       }

       .hoverlink:hover{
        color: maroon !important;
       }

       .focus-form:focus{
        box-shadow: 0 0 4px darkred, 0 0 4px darkred;
        outline: 0 none;
       }

      /* .height{
        height: 100px !important;
      } */

    </style>
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
  
<section class="vh-100" style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0.897), rgba(0, 0, 0, 0.685)), url('adminlogin_includes/pup2.jpg') center no-repeat; background-size: cover; width: 100%; height: 100%;">
  <div class="container py-5 h-100" style = "width: 70%; margin-top: 40px;">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10" style = "padding-top: 50px;">
        <div class="card" style="border-radius: 1rem;" >
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="../admin/adminlogin_includes/pup2.jpg" style = "width: 450px; height: 100%; object-fit: cover; border-radius: 1rem; object-position: 60% 0;"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">
              <?php 
                 if(isset($_SESSION['status'])){
                  ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><span style="color: darkred;">Error!</span></strong> <?= $_SESSION['status']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  <?php 
                  unset($_SESSION['status']); 
                 }
              ?>
             
                <form action="#" method="post" id="loginForm">
                  <div class="d-flex align-items-center mb-3 pb-1">
                    <span class="h3 fw-bold mb-0">Admin Login</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3 title" style = "border-bottom: 2px solid rgb(107, 10, 10); padding: 2px;">Enter your information</h5>
                
                  <div class="form-outline mb-4">
                    <label><i class="fa-solid fa-envelope icon" style="padding-bottom:15px"></i> Username</label>
                    <input type="text" name="email" id="form2Example17" class="form-control form-control-lg focus-form" placeholder="Enter your username" style="font-size: 16px"/>
                  </div>

                  <div class="form-outline mb-4">
                  <label><i class="fa-solid fa-lock icon" style="padding-bottom:15px"></i> Password</label>
                    <input type="password" name="pass"id="form2Example27" class="form-control form-control-lg focus-form" placeholder="Enter your password"  style="font-size: 16px" />

                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block hoverbtn" type="submit" name="submit" value="Login" style = "background-color: #500415; width: 100%">Login</button>
                  </div>

                  <p class="mb-5 pb-lg-2" style="color: black;">Not an admin?<a href="../login.php" class="hoverlink"
                      style="color: black; text-decoration:none;"> Go to User Login Page</a>
                  </p>
                  
                </form>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
    include '../admin/adminlogin_includes/footer.php';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>

