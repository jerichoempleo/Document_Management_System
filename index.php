<?php
    include 'connect.php';
    include 'insideheader.php';
    include 'authUser.php';
    include 'subnavbar.php';
    
    /* if(!isset($user_id)){
        header('location:login.php');
     }; */

    $sql = "SELECT * FROM document WHERE User_ID = '$user_id'";
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
     
    <title>Documented Information</title> 

    
</head>
<body>


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
    <div class="">
         <?php 
          $page = isset($_GET['page']) ? $_GET['page'] : 'connect';
          include $page.'.php';
          ?>
      </div>
<div class="title" style="font-size: 25px; font-weight: 500; position: relative; margin-bottom: 15px">
Documented Information</div>
<table id="Doc_Table" class="table table-striped" style="width:100%"  data-page-length='15'>

        <thead>
            <th>ID</th>
            <th>Filename</th>
            <th>User</th>
            <th>Size</th>
            <th>Downloads</th>
            <th>Action</th>
        </thead>

        <tbody>
        <?php foreach ($files as $file): ?>
            <tr>
            <td><?php echo $file['Document_ID']; ?></td>
            <td><?php echo $file['Document_Title']; ?></td>
            <td><?php echo $file['Uploader']; ?></td>
            <td><?php echo floor($file['Size'] / 1000) . ' KB'; ?></td>
            <td><?php echo $file['Downloads']; ?></td>
            <td><a href="download.php?file_id=<?php echo $file['Document_ID'] ?>">Download</a>
            <a href="view_file.php?page=view_docu&Document_ID=<?php echo md5($file['Document_ID']) ?>">View</a></td>
            </tr>
        <?php endforeach;?>
        
        </tbody>
    </table>
</div>
    
    
<!-- <div class="overlay" id="divOne">
		<div class="wrapper">
			<h2>Please Fill up The Form</h2><a class="close" href="index.php">&times;</a>
			<div class="content">
				<div class="container">
					<form action="uploadTest.php" method="post" enctype="multipart/form-data">
                        
                        <label>Section</label>
						<input type="text" name ="DocSection" id="DocSection" placeholder="Section...">
						
                        <label>Document Code</label>
						<input type="text" name = "DocCode" id ="DocCode">

                        <label>Document Title</label>
						<input type="text" name ="docuTitle" id="docuTitle" readonly ="">
						                       
                        <input type="hidden" name= "email" value="<?php echo ucwords(htmlentities($fetch_user['fname'])); ?>" class="form-control" readonly="">
						
                        <label>Revision No.</label>
						<input type="text" name ="RevNo" id="RevNo" readonly ="">

                        <label>Revision Notes</label> 
						<input type = "text" placeholder="Notes..." name= "notes">
						
                        <input type="file" name="myfile[]" multiple class="form-control"> <br>
                                   
                        <input type="submit" name = "save" value="Submit">

					</form>
				</div>
			</div>
		</div>
	</div> -->
   
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



