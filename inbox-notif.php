<?php
include 'connect.php';

session_start();
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM inbox WHERE user_id = '$user_id'";
$result = $conn->query($sql);

echo $result->num_rows;

$conn->close();
?>