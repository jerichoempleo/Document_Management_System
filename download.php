<?php 

require_once("connect.php");

if (isset($_GET['file_id'])) {
    $id = mysqli_real_escape_string($conn,$_GET['file_id']);

    // fetch file to download from database
    $sql = "SELECT * FROM  document WHERE Document_ID=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'admin/files/' . $file['Document_Title'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('admin/files/' . $file['Document_Title']));
        readfile('admin/files/' . $file['Document_Title']);

        $newCount = $file['Downloads'] + 1;
        $updateQuery = "UPDATE document SET Downloads=$newCount WHERE Document_ID=$id";
        mysqli_query($conn, $updateQuery);
        exit;
    }

}


?>