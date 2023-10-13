<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offices-Functions</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="css/newheader.css">
</head>
<body>
<?php
include('database-connect/connect.php');


//Office Delete Function
if(isset($_POST['delete_offices']))
{
    $id = $_POST['delete_ID'];

    $query = "DELETE FROM office WHERE Office_ID = '$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo '<script>Swal.fire({
            title: "Success",
            text: "Office has been deleted successfully!",
            icon: "success",
            confirmButtonText: "OK"
        }).then(function() {
            window.location.href = "offices.php";
        });</script>';
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo '<script>Swal.fire({
            title: "Error",
            text: "Failed to delete office!",
            icon: "error",
            confirmButtonText: "OK"
        });</script>';
    }
}

?>

<?php 
    //Office Edit Function 
    if(isset($_POST['update_office'])) //Button Name
    {       
        //Name ang kinukuha dito
        $id = $_POST['edit_ID'];

        $Office_Name = $_POST['Office_Name'];
        $Office_Description = $_POST['Office_Description'];
        $Office_Head = $_POST['Office_Head'];

        $query = "UPDATE office SET Office_Name='$Office_Name', Office_Description='$Office_Description', Office_Head='$Office_Head' WHERE Office_ID='$id'  ";
        $query_run = mysqli_query($conn, $query);

        if($query_run) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo '<script>Swal.fire({
                title: "Success",
                text: "Office has been updated successfully!",
                icon: "success",
                confirmButtonText: "OK"
            }).then(function() {
                window.location.href = "offices.php";
            });</script>';
        } else {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo '<script>Swal.fire({
                title: "Error",
                text: "Failed to update office!",
                icon: "error",
                confirmButtonText: "OK"
            });</script>';
        }
    } 
?>

<?php
//Office Add Data
if(isset($_POST['add_offices']))
{
    //Name attribute ang kinukuha
    $S_ID = $_POST['S_ID'];
    $Office_Name = $_POST['Office_Name'];
    $Office_Description = $_POST['Office_Description'];
    $Office_Head = $_POST['Office_Head'];

    $query = "INSERT INTO office (`S_ID`, `Office_Name`,`Office_Description`,`Office_Head`) VALUES ('$S_ID', '$Office_Name','$Office_Description','$Office_Head')";
    $query_run = mysqli_query($conn, $query);

    if($query_run) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo '<script>Swal.fire({
            title: "Success",
            text: "Office has been added successfully!",
            icon: "success",
            confirmButtonText: "OK"
        }).then(function() {
            window.location.href = "offices.php";
        });</script>';
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo '<script>Swal.fire({
            title: "Error",
            text: "Failed to add office!",
            icon: "error",
            confirmButtonText: "OK"
        });</script>';
    }
}

?>


</body>
</html>