<?php
require 'connect.php';
include 'insideheader.php';
include 'subnavbar.php';

/* session_start();
    $user_id = $_SESSION['user_id']; */

$qry = $conn->query("SELECT dc.Document_ID, dc.Section, dc.Document_Code, dc.Document_Type, dc.Document_Title, dc.Uploader, dc.Approver, dc.Revision_no, dc.Effectivity_Date, dt.Revision_ID, dt.Action, dt.Old_Document, dt.Old_Document_Code, dt.New_Responsibilties, dt.Old_Effectivity_Date 
FROM document dc, dcrf_table dt where dc.DCRF_ID = dt.Revision_ID AND md5(Document_ID) = '{$_GET['Document_ID']}' ")->fetch_array();
foreach($qry as $k => $v){
	if($k == 'Document_Title')
		$k = 'ftitle';
	$$k = $v;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4@4/bootstrap-4.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="style/view.css">
    
	<title>Process Owner View Document</title> 

</head>
<body>

<div class="container">
	<div class="content">
	<form action="#" method="POST" enctype="multipart/form-data" id="viewPOform">
		<div class="title"><a href="dltester.php?file_id=<?php echo $ftitle?>"><?php echo $ftitle ?></a></div>
	
		<div class="user-details">    
		  <div class="input-box">
            <span class="details">Section</span>
           
            <input type="show" value="<?php echo $Section ?>" readonly>
      </div>

      <div class="input-box">
            <span class="details">Document ID</span>
            
            <input type="show" value="<?php echo $Document_ID ?>" readonly>
      </div>

      <div class="input-box">
            <span class="details">DCRF ID</span>
            
            <input type="show" value="<?php echo $Revision_ID ?>" readonly>
      </div>

		  <div class="input-box">
            <span class="details">Document Code</span>
            
            <input type="show" value="<?php echo $Document_Code ?>" readonly>
          </div>

          <div class="input-box">
            <span class="details">Document Type</span>
            
            <input type="show" value="<?php echo $Document_Type ?>" readonly>
          </div>

		  <div class="input-box">
            <span class="details">Author</span>
           
            <input type="show" value="<?php echo $Uploader ?>" readonly>
          </div>

		  <div class="input-box">
            <span class="details">Revision No</span>
           
            <input type="show" value="<?php echo $Revision_no ?>" readonly>
          </div>

		  <div class="input-box">
            <span class="details">Effectivity Date</span>
            
            <input type="show" value="<?php echo $Effectivity_Date ?>" readonly>
          </div>

          <div class="input-box">
            <span class="details">Purpose of Change</span>
            <span class="subdetails" style="background-color: maroon; font-weight: 600; width: 77px; text-align: center; color: white;"><?php echo $Action ?></span>
          </div>
        </div>  

		<div class="user-details">     
          <div class="input-box" <?php if($Action == 'creation') {?> style = "display: none;" <?php } ?>>
            <span class="details">Affected Document</span>
           
            <input type="show" value="<?php echo $Old_Document ?>" readonly>
          </div>

		  <div class="input-box" <?php if($Action == 'creation') {?> style = "display: none;" <?php } ?>>
            <span class="details">Old Document Code</span>
            
            <input type="show" value="<?php echo $Old_Document_Code ?>" readonly>
          </div>

		  <div class="input-box" <?php if($Action == 'creation') {?> style = "display: none;" <?php } ?>>
            <span class="details">New Responsibilties</span>
            
            <input type="show" value="<?php echo $New_Responsibilties ?>" readonly>
          </div>

		  <div class="input-box" <?php if($Action == 'creation') {?> style = "display: none;" <?php } ?>>
            <span class="details">Old Effectivity Date</span>
           <!--  <span class="subdetails"><?php echo $Old_Effectivity_Date ?></span> -->
            <input type="show" value="<?php echo $Old_Effectivity_Date ?>" readonly>
          </div>

        </div>
		
		<div class="user-details">  
		  <div class="input-box">
			<span class="details">Signed By:</span>
			<span class="subdetails" style="background-color: maroon; font-weight: 600; width: 150px; text-align: center; color: white;"><?php echo $Approver?></span>
          </div>
       </div>
	</form>
	</div>
</div>

<?php
  include 'footer.php';
?>

</body>
</html>






