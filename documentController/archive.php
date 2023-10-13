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
    
    $sql = "SELECT * FROM document";
    $result = mysqli_query($conn, $sql);

    $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <link rel="stylesheet" href="style/subnavbar.css">
    <link rel="stylesheet" href="style/table.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css" rel="stylesheet">
     
    <title>Archive DC</title> 

    <style>
        nav ul li.items{
            margin: 0 200px;
            right: 30px;
        }
    </style>
    
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

<section class="section">


        <?php
            $select_user = mysqli_query($conn, "SELECT * FROM `reg_form` WHERE Reg_ID = '$user_id'") or die('query failed');
            if(mysqli_num_rows($select_user) > 0){
                $fetch_user = mysqli_fetch_assoc($select_user);
            };
        ?>

        <!-- <p> Username : <span><?php echo $fetch_user['fname']; ?></span> </p>
        <p> Email : <span><?php echo $fetch_user['email']; ?></span> </p> -->

       
    
   

    <div class="tableSc">
    <div class="title" style="font-size: 25px; font-weight: 500; position: relative; margin-bottom: 15px">
    Archive Document</div>
    
    <table id="Doc_Table" class="table table-striped" style="width:100%">
        <thead>
            <th>ID</th>
            <th>Code</th>
            <th>Filename</th>
            <th>Author</th>
            <th>Size</th>
            <th>Revision No</th>
            <th>Action</th>
        </thead>

        <tbody>
        <?php foreach ($files as $file): ?>
            <tr>
            <td><?php echo $file['Document_ID']; ?></td>
            <td><?php echo $file['Document_Code']; ?></td>
            <td><?php echo $file['Document_Title']; ?></td>
            <td><?php echo $file['Uploader']; ?></td>
            <td><?php echo floor($file['Size'] / 1000) . ' KB'; ?></td>
            <td><?php echo $file['Revision_no']; ?></td>
            <td class="action"><button type="button" value="<?=$file['Document_ID'];?>" class="deleteDocuBtn btn btn-danger btn-sm">Delete</button></td>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function () {
        $('#Doc_Table').DataTable();
    });

    $(document).ready(function(){
            $('.btn').click(function(){
            $('.items').toggleClass("show");
            $('ul li').toggleClass("hide");
            });
    });

    $(document).on('click', '.deleteDocuBtn', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this document?'))
            {
                var docu_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "action.php",
                    data: {
                        'delete_docu': true,
                        'docu_id': docu_id
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        console.log(response);

                        if(res.status == 200){
                        swal({
                            title: "Success",
                            text: "Document Deleted",
                            icon: "success",
                            }).then(function(){
                            window.location = "archive.php";
                            
                            });
                        }
                        else if(res.status == 500){
                        swal({
                            title: "Failed",
                            text: "An Error Occured",
                            icon: "error",
                            }).then(function(){
                            window.location = "archive.php";
                            
                            });
                        }
                    }
                });
            }
        });
</script>

</body>
</html>



