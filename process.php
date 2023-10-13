<?php
   require 'connect.php';
   $output = '';
   $sql = "SELECT Process_Name FROM PROCESS WHERE O_ID='".$_POST['OfficeID']."'";
   $result = mysqli_query($conn, $sql);
   $output .= '<option value = "" disabled selected>Select Process</option>';
   while($row = mysqli_fetch_array($result)){
      $output .= '<option value = "'.$row["Process_Name"].'">'.$row["Process_Name"].'</option>';
   }
   echo $output;

   ?>