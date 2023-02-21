<?php

require_once "../includes/connect.php";
session_start();
$id = $_GET['tid'];
$uid = $_SESSION["id"];
$sql = "INSERT INTO request (`task_id`, `prov_id`) VALUES ($id, $uid)";
$result = mysqli_query($conn, $sql);
    
if ($result) {
    header("Location: timeline.php");
    die();
}
else{
    header("Location: timeline.php?error=invalid");
}