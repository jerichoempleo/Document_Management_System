<?php
require 'connect.php';
include 'insideheader.php';
error_reporting(E_ALL);

/* session_start();
$user_id = $_SESSION['user_id']; */

$qry = $conn->query("SELECT * FROM dcrf_tmp1 where md5(Revision_ID) = '{$_GET['Revision_ID']}' ")->fetch_array();
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

     <title>View DC1</title>
   </head>
<body>
  <div class="container" style="margin-top: 80px;">
    
    <div class="content">
      <form action="#" method="POST" enctype="multipart/form-data" id="view1form"> 

      <input type="hidden" id="userid" name = "userid" value="<?php echo $User_ID ?>" readonly>

      <div class="title"><a href="../dltester.php?file_id=<?php echo $ftitle?>"><?php echo $ftitle ?></a></div>
      <input type="hidden" id = "title" name = "title" value="<?php echo $ftitle ?>" readonly>
      
       <div class="user-details">     
          <div class="input-box" style="width: 100%; height: 200px; pointer-events: none;">
            <span class="details">Notes</span>
            <span class="subdetails"><?php echo html_entity_decode($Notes) ?></span>
             <input type="hidden" name = "notes" value="<?php echo html_entity_decode($Notes) ?>" readonly>
          </div>

          <div class="input-box">
            <span class="details">Purpose</span>
            <span class="subdetails" style="background-color: maroon; font-weight: 600; width: 77px; text-align: center; color: white;"><?php echo $Action ?></span>
            <input type="hidden" name = "purpose" value="<?php echo $Action ?>" readonly>
          </div>

          <div class="input-box">
            <span class="details">DCRF ID</span>
            <span class="subdetails"><?php echo $Revision_ID ?></span>
             <input type="hidden" name = "id" value="<?php echo $Revision_ID ?>" readonly>
          </div>

          <div class="input-box">
            <span class="details">Status</span>
            <span class="subdetails">
              
              <?php 
                if ($Status == 0) {
                    echo "<span>Pending</span>";
                }
                else if ($Status == 2) {
                  echo "<span>Returned</span>";
                }
                else{
                    echo "<span>Approved</span>";
                }
            ?></span>
            <input type="hidden" name = "status" id="status" value="<?php 
                if ($Status == 0) {
                    echo "Pending";
                }
                else if ($Status == 2) {
                  echo "<span>Returned</span>";
                }
                else{
                    echo "Approved";
                }
            ?>" readonly>
          </div>

          <div class="input-box">
            <span class="details">Sector</span>
            <span class="subdetails"><?php echo $Sector ?></span>
            <input type="hidden" name = "sector" value="<?php echo $Sector ?>" readonly>
          </div>
         
          <div class="input-box">
            <span class="details">Author</span>
            <span class="subdetails"><?php echo $Author ?></span>
            <input type="hidden" name = "author" value="<?php echo $Author ?>" readonly>
          </div>

          <div class="input-box">
            <span class="details">Section</span>
            <span class="subdetails"><?php echo $Section ?></span>
            <input type="hidden" name = "section" value="<?php echo $Section ?>" readonly>
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
            <span class="details">Date Created</span>
            <span class="subdetails"><?php echo $New_Rev_DateCreated ?></span>
            <input type="hidden" name = "date" value="<?php echo $New_Rev_DateCreated ?>" readonly>
          </div>

          <div class="input-box">
            <span class="details">Revision</span>
            <span class="subdetails"><?php echo $Revision_no ?></span>
            <input type="hidden" name = "revisionNo" value="<?php echo $Revision_no ?>" readonly>
          </div>

        </div>  

        <!-- <div class="user-details">   

        </div>   -->

        <!-- <div class="user-details" style="margin-top: 20px;">

        </div>   -->

        <div class="user-details" style="margin-top: 30px;" id = "existing">
          <div class="input-box" <?php if($Action == "creation") {?> style = "display: none;" <?php } ?>>
            <span class="details">Affected Documents</span>
            <span class="subdetails"><?php echo $Old_Document ?></span>
            <input type="hidden" name = "affect" value="<?php echo $Old_Document ?>" readonly>
          </div>

          <div class="input-box" <?php if($Action == "creation") {?> style = "display: none;" <?php } ?>>
            <span class="details">Old Document Code</span>
            <span class="subdetails"><?php echo $Old_Document_Code ?></span>
            <input type="hidden" name = "oldcode" value="<?php echo $Old_Document_Code ?>" readonly>
          </div>

          <div class="input-box" <?php if($Action == "creation") {?> style = "display: none;" <?php } ?>>
            <span class="details">New Responsibilities</span>
            <span class="subdetails"><?php echo $New_Responsibilties ?></span>
            <input type="hidden" name = "newres" value="<?php echo $New_Responsibilties ?>" readonly>
          </div>

          <div class="input-box" <?php if($Action == "creation") {?> style = "display: none;" <?php } ?>>
            <span class="details">Old Revision Effectivity Date</span>
            <span class="subdetails"><?php echo $Old_Effectivity_Date?></span>
            <input type="hidden" name = "olddate" value="<?php echo $Old_Effectivity_Date ?>" readonly>
          </div>
        </div>  

        <div class="user-details" style="height: 400px;">     
          <div class="dc-notes" style="width: 100%; font-weight: 600; margin-top: 20px ">
            <span class="details">Document Controller Notes</span>
            <!-- <textarea name = "Apprnotes" id="Apprnotes" style="height: 100px; width: 600px; resize: none;" placeholder="Enter notes..." required></textarea> -->
            <textarea name="Apprnotes" id="Apprnotes"></textarea>
          </div>
        </div>

     
          <div class="user-details2" style="font-family: 'Poppins',sans-serif; margin-bottom: 10px; font-weight:600;">   
          <div class="input-box">
          <span class="details" <?php if($Status == 1 OR $Status == 2) {?> style = "display: none;" <?php } ?>>Submit Document<br>For Draft Approval</span>


          <!-- document Controller Name -->

      <?php 
          $select_user = mysqli_query($conn, "SELECT * FROM `reg_form` WHERE Reg_ID = '$user_id'") or die('query failed');
          if(mysqli_num_rows($select_user) > 0){
              $fetch_user = mysqli_fetch_assoc($select_user);
          };
      ?>
       <!-- document Controller Name -->
          <input type="hidden" name= "email" id="email" value="<?php echo ucwords(htmlentities($fetch_user['fname'])); ?>" class="form-control" readonly=""> 
          </div>
        </div>  

        <div class="button" style="margin-top: 0;">  
            <input type="hidden" name="appid" id="appid" value="<?php echo $Revision_ID; ?>">                     
            <input type="submit" name="approve" value="Endorse" <?php if($Status == 1 OR $Status == 2) {?> style = "display: none;" <?php } ?>>   
            <input type="submit" name="return" value="Return" <?php if($Status == 1 OR $Status == 2) {?> style = "display: none;" <?php } ?> style="margin-left: 20px;" id="returnBtn">      
        </div>
      

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
    $(document).on('submit', '#view1form', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("view1_form", true);

            bootbox.confirm({
	          title: 'Submit Document',
            message: 'Submit document for draft approval?',
            buttons: {
                cancel: {
                    label: '<i class="fa fa-times"></i> Cancel'
                },
                confirm: {
                    label: '<i class="fa fa-check"></i> Confirm'
                }
            },
            callback:function (result) {
              if(result){
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
                        text: "Document Submitted",
                        icon: "success",
                        }).then(function(){
                          window.location = "dc1.php";
                        
                        });
                    }
                    else if(res.status == 500){
                      Swal.fire({
                        title: "Failed",
                        text: "An Error Occured",
                        icon: "error",
                        }).then(function(){
                          window.location = "dc1.php";
                        
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
                        url: "return.php",
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
                                window.location = "dc1.php";
                              
                              });
                          }
                          else if(res.status == 500){
                            Swal.fire({
                              title: "Failed",
                              text: "An Error Occured",
                              icon: "error",
                              }).then(function(){
                                window.location = "dc1.php";
                              
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