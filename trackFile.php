<?php
    include 'connect.php';
    include 'insideheader.php';
    include 'authUser.php';
    include 'subnavbar.php';
   
   /*  session_start();
    $user_id = $_SESSION['user_id']; */
    /* if(!isset($user_id)){
        header('location:login.php');
     }; */

    $sql = "SELECT * FROM logs WHERE User_ID = '$user_id'";
    $result = mysqli_query($conn, $sql);
    $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
   
    <link rel="stylesheet" href="style/table.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css" rel="stylesheet">
     
    <title>Track Documents</title> 

    
</head>
<body>


<section class="section">
       
<div class="tableSc">

<div class="title" style="font-size: 25px; font-weight: 500; position: relative; margin-bottom: 15px">
Track File</div>

<table id="Doc_Table" class="table table-striped" style="width:100%"  data-page-length='20'>
    <thead>
        <th>Log ID</th>
        <th>Document Title</th>
        <th>Acted By</th>
        <th>Status</th>
        <th>Date Initiated</th>
    </thead>

    <tbody>
    <?php foreach ($files as $file): ?>
        <tr>
        <td><?php echo $file['log_id']; ?></td>
        <td><?php echo $file['document_title']; ?></td>
        <td><?php echo $file['acted_by']; ?></td>
        <td><?php echo $file['action_made']; ?></td>
        <td><?php echo $file['action_date']; ?></td>
        </tr>
    <?php endforeach;?>
    
    </tbody>
</table>
</div>
    
</section>

<?php 
  include 'footer.php';
?>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#Doc_Table').DataTable();
});
</script>
</body>
</html>



