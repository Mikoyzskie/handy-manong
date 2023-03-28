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

    if($row['unicode'] !== 'verified'){
        session_start();
        $_SESSION["email_login_failed"] = $user;
        $_SESSION["password_login_failed"] = $pass;
        header("location: signin.php?error=verify");
    }
   
    $checkpass = password_verify($pass, $row["finder_password"]);

    if(($checkpass == true) && $row['unicode'] == 'verified'){
        $id = $row['finder_id'];
        $query = "UPDATE tbl_finder SET `forgot_unicode` = null WHERE finder_id = $id";
        $results = mysqli_query($conn, $query);

        session_start();
        $_SESSION["id"] = $row['finder_id'];
        $_SESSION["name"]=$row['finder_name'];
        $_SESSION["avatar"]=$row['avatar'];
        $_SESSION["email"]=$row['finder_email'];
        header("location: ../home/finder.php");
        
    }else{
        session_start();
        $_SESSION["email_login_failed"] = $user;
        $_SESSION["password_login_failed"] = $pass;
        header("location: signin.php?error=incorrectpass");
    }
}
else{
    session_start();
    $_SESSION["email_login_failed"] = $user;
    $_SESSION["password_login_failed"] = $pass;
    header("location: signin.php?error=incorrectpass");
    header("location: signin.php?error=nouser");
}

}
else{
    header("location: /signin.php?error=invalid");
}

