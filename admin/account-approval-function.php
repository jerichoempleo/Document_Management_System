

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Approval</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="css/newheader.css">
</head>
<body>
    <?php
    include('database-connect/connect.php');
    ?>

    <?php 
    if(isset($_POST['approve'])) {
        $id = $_POST['approve_ID'];

        $select = "UPDATE reg_form SET status = 'approved' WHERE Reg_ID = '$id'";
        $result = mysqli_query($conn, $select);

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo '<script>Swal.fire({
         title: "Success",
         text: "Account has been approved!",
         icon: "success",
         confirmButtonText: "OK"
        }).then(function() {
         window.location.href = "manage-users.php";
        });</script>';
        }

    if(isset($_POST['deny'])) {
        $id = $_POST['deny_ID'];

        $select = "DELETE FROM reg_form WHERE Reg_ID = '$id'";
        $result = mysqli_query($conn, $select);

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
         echo '<script>Swal.fire({
         title: "Success",
         text: "Account has been denied!",
         icon: "success",
         confirmButtonText: "OK"
        }).then(function() {
        window.location.href = "account-approval.php";
     });</script>';
    }
    ?>

</body>
</html>

