<?php
    include 'connect.php';
    include 'insideheader.php';

    $sql = "SELECT * FROM `reg_form` WHERE Reg_ID = '$user_id'";
    $sql_run = mysqli_query($conn, $sql);
    $usertype = mysqli_fetch_array($sql_run);

    if($usertype['User_Type'] != "IQMSO"){
        $_SESSION['user_id'] = $usertype['Reg_ID'];
        unset($user_id);
        session_destroy();
        header('location:../login.php');
    }
  /*   session_start();
    $user_id = $_SESSION['user_id']; */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/subnavbar.css">
    <link rel="stylesheet" href="style/table.css">

    <style>
        nav ul li.items{
            margin: 0 200px;
            right: 30px;
        }
    </style>

    <title>Document CR2</title> 

</head>
<body>

<nav>
      <ul>
         <li class="logo">Section</li>
         <li class="items"><a href="dc2.php">
            <i class="fa-solid fa-file-circle-check"></i> Approval List</a></li>
        <li class="items"><a href="docuList.php">
            <i class="fa-regular fa-file menuIcon"></i> Documented Information List</a></li>
         <li class="items"><a href="dc2inbox.php">
            <i class="fa-solid fa-inbox menuIcon"></i> Inbox</a></li>
        <li class="items"><a href="archive.php">
            <i class="fa-regular fa-trash-can"></i> Archiving</a></li>

         <li class="btn"><a href="#"><i class="fas fa-bars"></i></a></li>
      </ul>
</nav>

   <div class="tableSc">

   <div class="title" style="font-size: 25px; font-weight: 500; position: relative; margin-bottom: 15px">
   Approval List</div>
<!-- <div class="container wrapper" style="margin-top: 20px;" id="auto"> -->
    <div class="">
            <?php 
            $page = isset($_GET['page']) ? $_GET['page'] : 'connect';
            include $page.'.php';
            ?>
    </div>
<table id="Doc_Table" class="table table-striped" style="width:100%;"  data-page-length='20'>
      <thead>
          <tr>
              <th>Document Code</th>
              <th>Document Title</th>
              <th>Author</th>
              <th>Action</th>
              <th>Status</th>
              <th>Preview</th>
          </tr>
      </thead>
     
      <?php 
        $sql = "SELECT * FROM dcrf_tmp2";
        $result = mysqli_query($conn, $sql);
        $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
      
      ?>
      <tbody class="autoData">
      <?php foreach ($files as $file): ?>
        <tr>
        <td><?php echo $file['Document_Code']; ?></td>
        <td><?php echo $file['Document_Title']; ?></td>
        <td><?php echo $file['Author']; ?></td>
        <td><?php echo $file['Action']; ?></td>
        <td>
            <?php 
                if ($file['Status'] == 0) {
                    echo "<span>For Draft Approval</span>";
                }
                else if ($file['Status'] == 2) {
                    echo "<span>Returned</span>";
                }
                else{
                    echo "<span>Approved</span>";
                }
            ?>
        </td>
        <td><a href="view_document2.php?page=view_file&Revision_ID=<?php echo md5($file['Revision_ID']) ?>">View</a></td>
        </tr>
    <?php endforeach;?>
      </tbody>
  </table>
<!-- </div> -->
</div>

<?php 
  include 'footer.php';
?>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
      $("#Doc_Table").DataTable();
});

$(document).ready(function(){
    $('.btn').click(function(){
        $('.items').toggleClass("show");
        $('ul li').toggleClass("hide");
        });
});

</script>


</body>
</html>



