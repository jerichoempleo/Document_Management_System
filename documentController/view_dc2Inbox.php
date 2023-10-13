<?php
require 'connect.php';
include 'insideheader.php';

/* session_start();
$user_id = $_SESSION['user_id']; */

$qry = $conn->query("SELECT * FROM dc_inbox where md5(id) = '{$_GET['id']}' ")->fetch_array();
foreach($qry as $k => $v){
	if($k == 'Document_Title')
		$k = 'ftitle';
	$$k = $v;
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="../style/view.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4@4/bootstrap-4.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dc View 2</title>
   </head>
<body>
  <div class="container" style="margin-top: 80px;">
    
    <div class="content">
      <form action="#" method="POST" enctype="multipart/form-data" id="viewinboxform"> 

      <input type="hidden" name = "userid" id="userid" value="<?php echo $User_ID ?>" readonly>

      <div class="title">
        <h6 style="font-family: 'Poppins',sans-serif;">Filename:</h6>
        <a href="../dltester.php?file_id=<?php echo $ftitle?>"><?php echo $ftitle ?></a>
        
      </div>
      <input type="hidden" name = "title" id= "title" value="<?php echo $ftitle ?>" readonly>
      
      <div class="user-details">     
          <div class="input-box" style="width: 100%; height: 200px; pointer-events: none;">
            <span class="details">QMR Notes</span>
            <span class="subdetails"><?php echo html_entity_decode($Notes) ?></span>
             <input type="hidden" name = "notes" value="<?php echo html_entity_decode($Notes) ?>" readonly>
          </div>
         
          <div class="input-box">
            <span class="details">DCRF ID</span>
            <span class="subdetails"><?php echo $DCRF_ID ?></span>
             <input type="hidden" name = "id" value="<?php echo $DCRF_ID ?>" readonly>
          </div>

          <div class="input-box">
            <span class="details">Author</span>
            <span class="subdetails"><?php echo $Author ?></span>
            <input type="hidden" name = "author" value="<?php echo $Author ?>" readonly>
          </div>

          <div class="input-box">
            <span class="details">Section</span>
            <span class="subdetails"><?php echo $Section ?></span>
            <input type="hidden" name = "docSection" id="docSection" value="<?php echo $Section ?>" readonly>
          </div>

          <div class="input-box">
            <span class="details">Document Code</span>
            <span class="subdetails"><?php echo $Document_Code ?></span>
            <input type="hidden" name = "code" value="<?php echo $Document_Code ?>" readonly>
          </div>

          <div class="input-box">
            <span class="details">Subject/Document Title</span>
            <span class="subdetails"><?php echo $ftitle ?></span>
          </div>

          <div class="input-box">
            <span class="details">Document Type</span>
            <span class="subdetails"><?php echo $Document_Type ?></span>
            <input type="hidden" name = "doctype" value="<?php echo $Document_Type ?>" readonly>
          </div>

          <div class="input-box">
            <span class="details">Date Submitted</span>
            <span class="subdetails"><?php echo $Effectivity_Date ?></span>
            <input type="hidden" name = "date" value="<?php echo $Effectivity_Date ?>" readonly>
          </div>

          <div class="input-box" style="display: none;">
            <span class="details">Revision</span>
            <span class="subdetails"><?php echo $Revision_no ?></span>
            <input type="hidden" name = "revisionNo" value="<?php echo $Revision_no ?>" readonly>
          </div>

          <div class="input-box">
            <span class="details">Status</span>
            <span class="subdetails">
              
              <?php 
                if ($Status == 2) {
                  echo "<span>Returned</span>";
                }
                else if ($Status == 4){
                  echo "<span>Returned</span>";
              }
                else if ($Status == 1){
                    echo "<span>Approved</span>";
                }
                else if ($Status == 3){
                  echo "<span>Approved</span>";
              }
            ?></span>
             <input type="hidden" name = "status" value="<?php 
                if ($Status == 2) {
                  echo "<span>Returned</span>";
                }
                else if ($Status == 1){
                    echo "Approved";
                }
            ?>" readonly>
          </div>
          
            <div class="dc-notes" style="width: 100%; font-weight: 600; margin-top: 20px ">
              <span class="details">Document Controller Final Notes</span>
            <!--  <textarea name = "Apprnotes" id="Apprnotes" style="height: 100px; width: 600px; resize: none;" placeholder="Enter notes..." required></textarea> -->
              <textarea name="Apprnotes" id="Apprnotes"></textarea>
            </div>
          

    </div> <!-- user-details -->

    <form action = "view_dc2Inbox.php?id=<?php echo $id; ?>" method="POST"> 
        <div class="user-details2" style="font-family: 'Poppins',sans-serif; margin-bottom: 10px;">     
          <div class="input-box" <?php if($Status == 3 OR $Status == 4 OR $Status == 2) {?> style = "display: none;" <?php } ?>>
          <span class="details">Upload Document</span>
          <input type="file" name="myfile" id = "myfile" multiple class="form-control" required style="width: 333px;">

            <!-- document Controller Name -->
          <?php 
          $select_user = mysqli_query($conn, "SELECT * FROM `reg_form` WHERE Reg_ID = '$user_id'") or die('query failed');
          if(mysqli_num_rows($select_user) > 0){
              $fetch_user = mysqli_fetch_assoc($select_user);
          };
          ?>
       <!-- document Controller Name -->

          <input type="hidden" name= "email" id = "email" value="<?php echo ucwords(htmlentities($fetch_user['fname'])); ?>" class="form-control" readonly=""> 
          </div>
        </div>  

        <div class="button" style="margin-top: 0;">  
        <input type="hidden" name="appid" id="appid" value="<?php echo $id; ?>">                    
            <input type="submit" class="btn btn-sm btn-success" name="upload" value="Upload" <?php if($Status == 3 OR $Status == 4 OR $Status == 2) {?> style = "display: none;" <?php } ?>> 
            <input type="submit" class="btn btn-sm btn-success" name="return" value="Return" <?php if($Status == 3 OR $Status == 4 OR $Status == 1) {?> style = "display: none;" <?php } ?> style="margin-left: 20px;" id="returnBtn">           
        </div>
        </form>

      </form>
    </div>
  </div>



<?php 
  include 'footer.php';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

<script>
    $(document).on('submit', '#viewinboxform', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("view_inboxform", true);

            bootbox.confirm({
	          title: 'Upload Document',
            message: 'Upload Document?',
            buttons: {
                cancel: {
                    label: '<i class="fa fa-times"></i> Cancel'
                },
                confirm: {
                    label: '<i class="fa fa-check"></i> Confirm'
                }
            },
            callback:function (result) {
                if (result){
                      $.ajax({
                      type: "POST",
                      url: "action.php",
                      data: formData,
                      processData: false,
                      contentType: false,
                      success: function (response) {
                          
                          var res = jQuery.parseJSON(response);

                          if(res.status == 200){
                            Swal.fire({
                              title: "Success",
                              text: "Document Uploaded",
                              icon: "success",
                              }).then(function(){
                                window.location = "dc2inbox.php";
                              
                              });
                          }
                          else if(res.status == 500){
                            Swal.fire({
                              title: "Failed",
                              text: "An Error Occured",
                              icon: "error",
                              }).then(function(){
                                window.location = "dc2inbox.php";
                              
                              });
                          }
                      }
                  });
                }	
              }
            })
        });

          /********************************returnFile************************/
      $(document).ready(function() {
          $('#returnBtn').on('click', function(e) {
            e.preventDefault();
         /*  $("#returnBtn").attr("disabled", "disabled"); */
          var appid = $('#appid').val();
          var userid = $('#userid').val();
          var title = $('#title').val();
          var email = $('#email').val();
          var Apprnotes = CKEDITOR.instances['Apprnotes'].getData();

          bootbox.confirm({
          title: 'Return Document',
                message: 'Are you sure you want to return this document?',
                buttons: {
                    cancel: {
                        label: '<i class="fa fa-times"></i> Cancel'
                    },
                    confirm: {
                        label: '<i class="fa fa-check"></i> Confirm'
                    }
                },callback:function (result) {
                    if (result){
                            $.ajax({
                            url: "returnInbox.php",
                            type: "POST",
                            data: {
                              appid: appid,
                              userid: userid,
                              title: title,
                              email: email,
                              Apprnotes: Apprnotes				
                            },
                            cache: false,
                            success: function(response){
                              var res = JSON.parse(response);

                              if(res.status == 200){
                                Swal.fire({
                                  title: "Success",
                                  text: "Document Returned",
                                  icon: "success",
                                  }).then(function(){
                                    window.location = "dc2inbox.php";
                                  
                                  });
                              }
                              else if(res.status == 500){
                                Swal.fire({
                                  title: "Failed",
                                  text: "An Error Occured",
                                  icon: "error",
                                  }).then(function(){
                                    window.location = "dc2inbox.php";
                                  
                                  });
                              }     
                              
                         }
                    });
                  }	
               }
            })     
      });
});
      
</script>

<script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
<script>
   CKEDITOR.replace( 'Apprnotes' );
   CKEDITOR.config.autoParagraph = false;
</script>

</body>
</html>