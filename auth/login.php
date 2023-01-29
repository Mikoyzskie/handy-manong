<?php

if(isset($_POST['submit'])){

    $user = $_POST['email'];
    $pass = $_POST['password'];

    require_once "../includes/connect.php";


    $sql = "SELECT * FROM tbl_finder WHERE finder_email='$user'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result); 

if($num == 1) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    /* printf ("%s (%s)\n", $row["finder_email"], $row["finder_password"]); */
   
    $checkpass = password_verify($pass, $row["finder_password"]);

    if($checkpass == true){
        /* session_start();
        $_SESSION["id"]=$data[0];
        header("location: ../index.php?error=noerror"); */
        printf("password correct");
    }else{
        header("location: signin.php?error=invalidpass");
    }
}
else{
    header("location: signin.php??error=nouser");
}

}
else{
    header("location: /signin.php?error=invalid");
}

