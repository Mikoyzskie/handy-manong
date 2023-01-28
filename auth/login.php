<?php

if(isset($_POST['submit'])){

    $user = $_POST['user'];
    $pass = $_POST['pass'];

require_once "../includes/connect.php";

$check="SELECT * FROM tbladmin WHERE user = '$user'";
$rs = mysqli_query($con,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] = 1) {
    $hash = $data[2];
   
    $checkpass = password_verify($pass, $hash);

    if($checkpass == true){
        session_start();
        $_SESSION["id"]=$data[0];
        header("location: ../");
    }else{
        header("location: ../");
    }
}
else{
    header("location: ../admin/index.php?error=nouser");
}

}
else{
    header("location: /signin.php");
}

