<?php
    $conn = new mysqli('localhost', 'root', '', 'Draft_Database');
    if($conn -> connect_error){
        die('No Database Established:' .$conn->connect_error);
    }
?>