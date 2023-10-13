<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sector-functions</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="css/newheader.css">
</head>
<body>
<?php
include('database-connect/connect.php');


//Sectors Delete Function
if(isset($_POST['delete_sectors']))
{
    $id = $_POST['delete_ID'];

    $query = "DELETE FROM sector WHERE Sector_ID = '$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo '<script>Swal.fire({
            title: "Success",
            text: "Sector has been deleted successfully!",
            icon: "success",
            confirmButtonText: "OK"
        }).then(function() {
            window.location.href = "sectors.php";
        });</script>';
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo '<script>Swal.fire({
            title: "Error",
            text: "Failed to delete sector!",
            icon: "error",
            confirmButtonText: "OK"
        });</script>';
    }
}

?>

<?php 
    //Sector Edit Function 
    if(isset($_POST['update_sector'])) //Button Name
    {       
        //Name attributes ang kinukuha dito
        $id = $_POST['edit_ID'];

        $Sector_Name = $_POST['Sector_Name'];
        $Sector_Description = $_POST['Sector_Description'];
        $Sector_Head = $_POST['Sector_Head'];

        $query = "UPDATE sector SET Sector_Name='$Sector_Name', Sector_Description='$Sector_Description', Sector_Head='$Sector_Head' WHERE Sector_ID='$id'  ";
        $query_run = mysqli_query($conn, $query);

        if($query_run) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo '<script>Swal.fire({
                title: "Success",
                text: "Sector has been updated successfully!",
                icon: "success",
                confirmButtonText: "OK"
            }).then(function() {
                window.location.href = "sectors.php";
            });</script>';
        } else {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo '<script>Swal.fire({
                title: "Error",
                text: "Failed to update sector!",
                icon: "error",
                confirmButtonText: "OK"
            });</script>';
        }
    } 
?>

<?php
//Sector Add Data
if(isset($_POST['add_sectors']))
{
    $Sector_Name = $_POST['Sector_Name'];
    $Sector_Description = $_POST['Sector_Description'];
    $Sector_Head = $_POST['Sector_Head'];

    $query = "INSERT INTO sector(`Sector_Name`,`Sector_Description`,`Sector_Head`) VALUES ('$Sector_Name','$Sector_Description','$Sector_Head')";
    $query_run = mysqli_query($conn, $query);

    if($query_run) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo '<script>Swal.fire({
            title: "Success",
            text: "Sector has been added successfully!",
            icon: "success",
            confirmButtonText: "OK"
        }).then(function() {
            window.location.href = "sectors.php";
        });</script>';
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo '<script>Swal.fire({
            title: "Error",
            text: "Failed to add sector!",
            icon: "error",
            confirmButtonText: "OK"
        });</script>';
    }
}

?>



</body>
</html>