<?php
session_start();
if(isset($_POST['send'])){
    include '../includes/connect.php';   
    $user = $_SESSION["id"];
    
    $chat = $_POST["chat"];
    $task = $_GET["tid"];
    
    $sql = "INSERT INTO `messaging`(`user_id`, `msg_content`, `task_id`, `user_type`) VALUES ('$user','$chat','$task','provider')";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        header("Location: task-view.php?uid=$user&tid=$task");
        die();
    }
}
else{
    header("location: finder.php");
}