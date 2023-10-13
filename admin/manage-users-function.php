<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage-Users-Function</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="css/newheader.css">
</head>
<body>


<?php
include('database-connect/connect.php');


//Manage User Delete Function
if(isset($_POST['delete_manage_users']))
{
    $id = $_POST['delete_ID'];

    $query = "DELETE FROM reg_form WHERE Reg_ID = '$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo '<script>Swal.fire({
            title: "Success",
            text: "User has been deleted successfully!",
            icon: "success",
            confirmButtonText: "OK"
        }).then(function() {
            window.location.href = "manage-users.php";
        });</script>';
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo '<script>Swal.fire({
            title: "Error",
            text: "Failed to delete user!",
            icon: "error",
            confirmButtonText: "OK"
        });</script>';
    }
}

?>

<?php 
    //Manage-Users Edit Function 
    if(isset($_POST['update_manage_users'])) //Button Name
    {       
        //Name attributes ang kinukuha dito pero dapat kapangalan ng nasa database
        $id = $_POST['edit_ID'];

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $User_Type = $_POST['User_Type'];
        $sector = $_POST['sector'];
        $office = $_POST['office'];
        $process = $_POST['process'];

        $query = "UPDATE reg_form SET fname='$fname', lname='$lname', email='$email', User_Type ='$User_Type', sector='$sector', office='$office', process='$process' WHERE Reg_ID='$id'  ";
        $query_run = mysqli_query($conn, $query);

        if($query_run) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo '<script>Swal.fire({
                title: "Success",
                text: "User has been updated successfully!",
                icon: "success",
                confirmButtonText: "OK"
            }).then(function() {
                window.location.href = "manage-users.php";
            });</script>';
        } else {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo '<script>Swal.fire({
                title: "Error",
                text: "Failed to update user!",
                icon: "error",
                confirmButtonText: "OK"
            });</script>';
        }
    } 
?>

<?php
//Sector Add Data
if(isset($_POST['add_manage_users']))
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $sector = $_POST['sector'];
    $office = $_POST['office'];
    $process = $_POST['process'];

    $query = "INSERT INTO reg_form(`fname`,`lname`,`email`,`sector`,`office`,`process`) VALUES ('$fname','$lname','$email','$sector','$office','$process')";
    $query_run = mysqli_query($conn, $query);

    /*if($query_run)
    {
        echo '<script> alert("Data Saved"); </script>';
        header("Location: manage-users.php");
    }
    else
    {
        echo '<script> alert("Data Not Saved"); </script>';
    }*/

    if($query_run) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo '<script>Swal.fire({
            title: "Success",
            text: "User has been added successfully!",
            icon: "success",
            confirmButtonText: "OK"
        }).then(function() {
            window.location.href = "manage-users.php";
        });</script>';
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo '<script>Swal.fire({
            title: "Error",
            text: "Failed to add user!",
            icon: "error",
            confirmButtonText: "OK"
        });</script>';
    }
}

?>
</body>
</html>