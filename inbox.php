<?php
    include 'connect.php';
    include 'insideheader.php';
    include 'authUser.php';
    include 'subnavbar.php';
   
   /*  session_start();
    $user_id = $_SESSION['user_id']; */
/* 
    if(!isset($user_id)){
        header('location:login.php');
     }; */
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
   
    <link rel="stylesheet" href="style/table.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css" rel="stylesheet">
     
    <title>Inbox</title> 

    <style>
        table.dataTable tr:hover td {
            background-color: lightgray !important;
            cursor: pointer;
        }
    </style>

    
</head>
<body>

<section class="section">
       
<div class="tableSc">

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; background-color: inherit;">
        <i class="fa-solid fa-xmark" style="font-size: 20px;"></i>
        </button>
      </div>
      <div class="modal-body">
        <h6> From:
            <span class="email-from"></span>
            <span>
                <span style="float: right;" class="email-date"></span>
            </span>
        </h6>
        <p class="email-body"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: maroon;">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="title" style="font-size: 25px; font-weight: 500; position: relative; margin-bottom: 15px">
Inbox</div>

<table id="Doc_Table" class="table table-striped" style="width:100%"  data-page-length='20'>
    <thead style="display: none;">
        <th></th>
        <th>Sender</th>
        <th>Document Title</th>
        <th>Status</th>
        <th>Date</th>   
        <th>Delete</th> 
    </thead>

    <?php 
        $sql = "SELECT * FROM inbox WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $sql);
        $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?>
    <tbody>
    <?php foreach ($files as $file): ?>
        <tr>
            <td class="action"><input type="checkbox"/></td>
            <td class="name viewInboxBtn" width = "10%" data-id='<?php echo $file['id']; ?>'><a href="#"><?php echo $file['Sender']; ?></a></td>
            <td class="name viewInboxBtn" data-id='<?php echo $file['id']; ?>'><a href="#"><?php echo $file['Document_Title']; ?></a></td>
            <td class="subject viewInboxBtn" width = "50%" data-id='<?php echo $file['id']; ?>'><a href="#"><?php echo $file['description']; ?></a></td>
            <td class="time viewInboxBtn" data-id='<?php echo $file['id']; ?>'><?php echo $file['date']; ?></td>
           <!--  <td class="view"><button data-id='<?php echo $file['id']; ?>' type="button" class="viewInboxBtn btn btn-danger btn-sm" style = "background-color: darkred;">View</button></td> -->
            <td class="time"><button type="button" value="<?=$file['id']; ?>" class="deleteInboxBtn btn btn-danger btn-sm" style = "background-color: darkred;"><i class="fa-regular fa-trash-can" style="font-size: 20px;"></i></button></td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function () {
        $('#Doc_Table').DataTable();
});

$(document).on('click', '.deleteInboxBtn', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this message?'))
            {
                var id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "action.php",
                    data: {
                        'delete_inbox': true,
                        'id': id
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        console.log(response);

                        if(res.status == 200){
                        swal({
                            title: "Success",
                            text: "Inbox Deleted",
                            icon: "success",
                            }).then(function(){
                            window.location = "inbox.php";
                            
                            });
                        }
                        else if(res.status == 500){
                        swal({
                            title: "Failed",
                            text: "Failed, An Error Occured",
                            icon: "error",
                            }).then(function(){
                            window.location = "inbox.php";
                            
                            });
                        }
                    }
                });
            }
        });
</script>

<script>
    $(document).ready(function(){
        $(document).on("click", ".viewInboxBtn", function (){
            var id = $(this).data('id');
           /*  alert(id) */
            $.ajax({
                    type: "POST",
                    url: "modal.php",
                    data: {
                        'checking_view': true,
                        'id': id
                    },
                    success: function (response) {
                        // console.log(response);
                        $.each(response, function (key, view) { 
                            // console.log(studview['fname']);
                            $('.modal-title').text(view['Document_Title']);
                            $('.email-from').text(view['Sender']);
                            $('.email-date').text(view['date']);
                            $('.email-body').text(view['description']);
                        });
                        $('#exampleModal').modal('show');
                    }
                });
        }); 
    });
</script>

</body>
</html>



