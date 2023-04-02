<?php

if(empty($_GET['unicode']) && empty($_GET['userid'])){
    header("location: signin.php");
}else{
    $user = $_GET['userid'];
    $code = $_GET['unicode'];

    include "../includes/connect.php";

    $sql = "Select * from tbl_finder where finder_email='$user' AND unicode = '$code'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if($num == 0){
        header("Location: signin.php?error=invalid");
    }else{
        $query = "UPDATE tbl_finder SET `unicode` = 'verified' WHERE finder_email = '$user'";
        $results = mysqli_query($conn, $query);
        if ($results) {
            header("Location: signin.php?notif=verified");
            die();
        }
        else{
            header("Location: signin.php?error=invalid");
        }
    }
}