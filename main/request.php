<?php

require_once "../includes/connect.php";
session_start();
$id = $_GET['tid'];
$uid = $_SESSION["id"];
$action = $_GET["action"];
$sql = "INSERT INTO request (`task_id`, `prov_id`) VALUES ($id, $uid)";
$result = mysqli_query($conn, $sql);

if(empty($id) || empty($action)){
    header("Location: timeline.php?error=invalid");
}else{
    if($action == 'apply'){
        $sql = "INSERT INTO request (`task_id`, `prov_id`) VALUES ($id, $uid)";
        $result = mysqli_query($conn, $sql);
    }else{
        $sql = "DELETE FROM `request` WHERE `task_id` = $id AND prov_id = $uid";
        $result = mysqli_query($conn, $sql);
    }
}

if ($result) {
    header("Location: task-view.php?tid=$id");
    die();
}
else{
    header("Location: timeline.php?error=invalid");
}