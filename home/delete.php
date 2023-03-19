<?php
require_once "../includes/connect.php";
$id = $_GET['tid'];
$sql = "DELETE FROM `tbl_task` WHERE `id` = $id";
$result = mysqli_query($conn, $sql);
    
if ($result) {
    header("Location: finder.php");
    die();
}
else{
    header("Location: finder.php?error=invalid");
}