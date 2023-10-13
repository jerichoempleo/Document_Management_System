<?php 
     $sql = "SELECT * FROM `reg_form` WHERE Reg_ID = '$user_id'";
     $sql_run = mysqli_query($conn, $sql);
     $usertype = mysqli_fetch_array($sql_run);
 
     if($usertype['User_Type'] != "PO"){
         $_SESSION['user_id'] = $usertype['Reg_ID'];
         unset($user_id);
         session_destroy();
         header('location:login.php');
     }

?>