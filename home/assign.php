<?php

session_start();

if(empty($_SESSION['id'])){
    header("location: ../auth/signin.php?error=loginrequired");
}

$id = $_GET['tid'];
$user = $_GET['uid'];

if(empty($id) || empty($user)){
    header("location: ../auth/signin.php?error=noid");
}else{
    include '../includes/connect.php';
    $sql = "UPDATE tbl_task SET task_status = 'Assigned', task_provider = $user WHERE id = $id";
    $result = mysqli_query($conn, $sql);
        
    if ($result) {
        $query = "UPDATE request SET `status` = 'Assigned' WHERE task_id = $id";
        $results = mysqli_query($conn, $query);
        if ($results) {
            header("Location: finder.php");
            die();
        }
        else{
            header("Location: finder.php?error=invalid");
        }
    }
    else{
        header("Location: finder.php?error=invalid");
    }
}

