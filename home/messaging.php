<?php

if(isset($_POST['send'])){
    include '../includes/connect.php';   
    
    $chat = $_POST["chat"];
    $sql = "INSERT INTO `messaging`(`user_id`, `msg_content`, `task_id`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]')";
}
else{
    header("location: finder.php");
}