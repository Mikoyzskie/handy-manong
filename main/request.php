<?php

require_once "../includes/connect.php";
session_start();
$id = $_GET['tid'];
$uid = $_SESSION["id"];
$action = $_GET["action"];


if(empty($id) || empty($action)){
    header("Location: timeline.php?error=invalid");
}else{
    if($action == "apply"){
        $sql = "INSERT INTO request (`task_id`, `prov_id`) VALUES ($id, $uid)";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: task-view.php?tid=$id");
            die();
        }
        else{
            header("Location: timeline.php?error=invalid");
        }
    }else if($action == "accept"){
        $sql = "UPDATE tbl_task SET task_status = 'Assigned' WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $sql1 = "UPDATE finder_request SET `status` = 'Accepted' WHERE task = $id";
        $result1 = mysqli_query($conn, $sql1);
        if ($result && $result1) {
            header("Location: task-view.php?tid=$id");
            die();
        }
        else{
            header("Location: timeline.php?error=invalid");
        }
    }else if($action == "deny"){
        $sql = "UPDATE tbl_task SET task_status = 'Available' WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $sql1 = "DELETE FROM `finder_request` WHERE `task` = $id";
        $result1 = mysqli_query($conn, $sql1);
        if ($result && $result1) {
            header("Location: task-view.php?tid=$id");
            die();
        }
        else{
            header("Location: timeline.php?error=invalid");
        }
    }else{
        $sql = "DELETE FROM `request` WHERE `task_id` = $id AND prov_id = $uid";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: task-view.php?tid=$id");
            die();
        }
        else{
            header("Location: timeline.php?error=invalid");
        }
    }
}

