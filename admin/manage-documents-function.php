<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage-Documents-Function</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="css/newheader.css">
</head>
<body>
<?php 
include('database-connect/connect.php');

//Manage Documents Archive/Delete Function

if(isset($_POST['delete_document'])){

    $id = $_POST['delete_ID'];
 
    date_default_timezone_set('Asia/Manila');
    $date = date('Y/m/d h:i:s a', time());
    //$docu_id = mysqli_real_escape_string($conn, $_POST['delete_ID']);
    $queryArchive = mysqli_query($conn, "SELECT * FROM document WHERE Document_ID = '$id'");
    while($fetch = mysqli_fetch_array($queryArchive)){
        mysqli_query($conn, "INSERT INTO archive VALUES('', '$fetch[User_ID]', '$fetch[Document_ID]', '$fetch[Document_Code]', '$fetch[Document_Title]', '$fetch[Revision_no]', '$fetch[Uploader]', '$fetch[Approver]', '$date')") or die(mysqli_error($conn));
   }
    
    //$fetch = mysqli_fetch_array($queryArchive);
 
    // Insert the document into archive_document table
    //mysqli_query($conn, "INSERT INTO archive_document (Archive_ID, Doc_ID, Document_Title, Uploader, Size, Downloads, Date_Archive) VALUES (' ', '$fetch[Document_ID]', '$fetch[Document_Title]', '$fetch[Uploader]', '$fetch[Size]', '$fetch[Downloads]', '$date')" ) or die (mysqli_error($conn));
 
    // Delete the document from document table
    $query = "DELETE FROM document WHERE Document_ID = '$id' ";
    $query_run = mysqli_query($conn, $query);
    
    
 
    if($query_run and $queryArchive) {
     echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
     echo '<script>Swal.fire({
         title: "Success",
         text: "Document has been deleted successfully!",
         icon: "success",
         confirmButtonText: "OK"
     }).then(function() {
         window.location.href = "manage-documents.php";
     });</script>';
 } else {
     echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
     echo '<script>Swal.fire({
         title: "Error",
         text: "Failed to delete document!",
         icon: "error",
         confirmButtonText: "OK"
     });</script>';
 }
 
}

 ?>
<?php /* NOT NEEDED BUT FOR FUTURE REFERENCE 
//Manage Documents Delete Function
if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM document WHERE Document_ID = '$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        header('location:manage-documents.php');
    }
    else {
        die(mysqli_query($conn, $query));
    }
} */
?> 



<?php 
    //Manage-Documents Edit Function 
    if(isset($_POST['update_manage_documents'])) //Button Name
    {       
       
        $id = $_POST['edit_ID'];

        $Document_Title = $_POST['Document_Title'];
      

        $query = "UPDATE document SET Document_Title='$Document_Title' WHERE Document_ID='$id'  ";
        $query_run = mysqli_query($conn, $query);

        if($query_run) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo '<script>Swal.fire({
                title: "Success",
                text: "Document title has been updated successfully!",
                icon: "success",
                confirmButtonText: "OK"
            }).then(function() {
                window.location.href = "manage-documents.php";
            });</script>';
        } else {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo '<script>Swal.fire({
                title: "Error",
                text: "Failed to update document!",
                icon: "error",
                confirmButtonText: "OK"
            });</script>';
        }
    } 
?>
</body>
</html>
