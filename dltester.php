<?php 

require_once("connect.php");


$fname = $_GET['file_id'];
$file = ('admin/files/' . $fname);

    header ("Content-Type: ".filetype($file));
    header ("Content-Length: ".filesize($file));
    header ("Content-Disposition: attachment; filename={$file}");
    readfile($file);
    exit;





?>