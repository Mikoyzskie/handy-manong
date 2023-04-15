<?php

if(empty($_GET['unicode']) && empty($_GET['userid'])){
    header("location: login.php");
}else{
    $user = $_GET['userid'];
    $code = $_GET['unicode'];

    include "../includes/connect.php";

    $sql = "SELECT * FROM `admin` WHERE email='$user' AND code = '$code'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if($num == 0){
        header("Location: login.php?error=invalid");
    }else{
        $query = "UPDATE `admin` SET `code` = 'verified' WHERE email = '$user'";
        $results = mysqli_query($conn, $query);
        if ($results) {
            header("Location: login.php?notif=verified");
            die();
        }
        else{
            header("Location: login.php?error=invalid");
        }
    }
}