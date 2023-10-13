<?php

include 'connect.php';
include 'header.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['pass']));

   $select = mysqli_query($conn, "SELECT * FROM `reg_form` WHERE email = '$email' AND pass = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['Reg_ID'];
      header('location:admin/upload.php');
   }else{
      $message[] = 'incorrect password or email!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="login.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
     
    <title>Login Form</title> 
</head>
<body>
   
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
    <section class="registration-container">
        
        <div class="reg-body">
            <div class="reg-container">
                <header> Admin Login </header>

                <form action="#" method="post">
                    <div class="tab first">
                        <div class="details">
                            <span class="title">Enter your Information</span>

                            <div class="fields">
                               
                                
                                <div class="input-field">
                                    <label>Email</label>
                                    <input type="text" name="email" placeholder="Enter your email" required>
                                </div>

                                <div class="input-field">
                                    <label>Password</label>
                                    <input type="password" name="pass" placeholder="Enter your password" required>
                                </div>

                        
                            </div>

                                                                             
                        </div>

                        <input type="submit" name="submit" value="Login" class = "logBtn">
                        

                        
                        <!-- <h4>Don't have an account?</h4>
                        <div class="RegBtn" name="Register_Btn">
                            <span class="btnText"><u><a href = "register.php">Register Here</a></u></span>
                            <i class="uil uil-navigator"></i>
                        </div> -->
                                               
                    </div>
                    


                


                  
                </form>
            </div>
        </div>
      

    </section>

    

</body>
</html>



