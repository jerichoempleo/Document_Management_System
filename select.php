<?php
   require 'connect.php';
   $output = '';
   $sql = "SELECT * FROM OFFICE WHERE S_ID='".$_POST['SectorID']."'";
   $result = mysqli_query($conn, $sql);
   $output .= '<option value = "" disabled selected>Select Office</option>';
   while($row = mysqli_fetch_array($result)){
      $output .= '<option value = "'.$row["Office_ID"].'">'.$row["Office_Name"].'</option>';
   }
   echo $output;

   ?>