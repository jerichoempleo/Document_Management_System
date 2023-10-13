<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process-Functions</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="css/newheader.css">
</head>
<body>
<?php
include('database-connect/connect.php'); 
//include('includes/scripts.php');  //Bakit naglagay ng script dito LOL. ps: mag error ang code kapag meron neto
?>

<?php
//Process Delete Function
if(isset($_POST['delete_process']))
{
    $id = $_POST['delete_ID'];

    $query = "DELETE FROM process WHERE Process_ID = '$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo '<script>Swal.fire({
            title: "Success",
            text: "Process has been deleted successfully!",
            icon: "success",
            confirmButtonText: "OK"
        }).then(function() {
            window.location.href = "process.php";
        });</script>';
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo '<script>Swal.fire({
            title: "Error",
            text: "Failed to delete process!",
            icon: "error",
            confirmButtonText: "OK"
        });</script>';
    }
}

?>

<?php 
    //Process Edit Function 
    if(isset($_POST['update_process'])) //Button Name
    {       
        //Name ang kinukuha dito
        $id = $_POST['edit_ID'];

        $Process_Name = $_POST['Process_Name'];
        $Process_Description = $_POST['Process_Description'];
        $Process_Type = $_POST['Process_Type'];

        $query = "UPDATE process SET Process_Name='$Process_Name', Process_Desciption='$Process_Description', Process_Type='$Process_Type' WHERE Process_ID='$id'  ";
        $query_run = mysqli_query($conn, $query);

        if($query_run) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo '<script>Swal.fire({
                title: "Success",
                text: "Process has been updated successfully!",
                icon: "success",
                confirmButtonText: "OK"
            }).then(function() {
                window.location.href = "process.php";
            });</script>';
        } else {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo '<script>Swal.fire({
                title: "Error",
                text: "Failed to updated process!",
                icon: "error",
                confirmButtonText: "OK"
            });</script>';
        }
    } 
?>

<?php
//Process Add Data
if(isset($_POST['add_process']))
{
    //Name attribute ang kinukuha
    $O_ID = $_POST['O_ID'];
    $Process_Name = $_POST['Process_Name'];
    $Process_Description = $_POST['Process_Description'];
    $Process_Type = $_POST['Process_Type'];

    $query = "INSERT INTO process (`O_ID`, `Process_Name`,`Process_Desciption`,`Process_Type`) VALUES ('$O_ID', '$Process_Name','$Process_Description','$Process_Type')";
    $query_run = mysqli_query($conn, $query);

    if($query_run) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo '<script>Swal.fire({
            title: "Success",
            text: "Process has been added successfully!",
            icon: "success",
            confirmButtonText: "OK"
        }).then(function() {
            window.location.href = "process.php";
        });</script>';
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo '<script>Swal.fire({
            title: "Error",
            text: "Failed to add process!",
            icon: "error",
            confirmButtonText: "OK"
        });</script>';
    }
}

?>


</body>
</html>