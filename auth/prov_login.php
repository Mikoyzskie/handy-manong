<?php

if(isset($_POST['submit'])){

    $user = $_POST['email'];
    $pass = $_POST['password'];

    require_once "../includes/connect.php";


    $sql = "SELECT * FROM tbl_provider WHERE prov_email='$user'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result); 

if($num == 1) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    /* printf ("%s (%s)\n", $row["finder_email"], $row["finder_password"]); */
   
    $checkpass = password_verify($pass, $row["prov_password"]);

    if($checkpass == true && $row['code'] == 'verified'){
        session_start();
        $_SESSION["id"] = $row['id'];
        $_SESSION["category"]= $row['prov_category'];
        $_SESSION["email"] = $row['prov_email'];
        header("location: ../main/timeline.php");
        
    }else{
        if($row['code'] != 'verified'){
            header("location: ../main/login.php?error=notverfied");
        }else{
            header("location: ../main/login.php?error=incorrectpass");
        }
    }
}
else{
    header("location: ../main/login.php?error=nouser");
}

}
else{
    header("location: ../main/login.php?error=invalid");
}

