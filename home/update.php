<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
include "../includes/connect.php";
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['avatarSubmit'])) {
    
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM tbl_finder WHERE finder_id = $id";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if(empty($num)){
        header( "location: account.php?error=invalid");
    }else{
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $filename = "../assets/images/uploads/".$row['avatar'];
        if (file_exists($filename)) {
            unlink($filename);
        }
        if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
            $target_dir = "../assets/images/uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            $new_avatar = basename($_FILES["image"]["name"]);
            $query = "UPDATE tbl_finder SET `avatar` = '$new_avatar' WHERE finder_id = $id";
            $results = mysqli_query($conn, $query);
            if ($results) {
                header("Location: profile.php");
                die();
            }
            else{
                header("Location: account.php?error=invalid");
            }
        } else {
            header( "location: account.php?error=invalid");
        }
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name_submit'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM tbl_finder WHERE finder_id = $id";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if(empty($num)){
        header( "location: account.php?error=invalid");
    }else{
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if($_POST['name'] == $row['finder_name']){
            header( "location: account.php");
        }else{
            $new_name = $_POST['name'];
            $query = "UPDATE tbl_finder SET `finder_name` = '$new_name' WHERE finder_id = $id";
            $results = mysqli_query($conn, $query);
            if ($results) {
                header("Location: profile.php");
                die();
            }
            else{
                header("Location: account.php?error=invalid");
            }
        }
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['password_submit'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM tbl_finder WHERE finder_id = $id";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if(empty($num)){
        header( "location: account.php?error=invalid");
    }else{
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $pass = $_POST['old_pass'];
        $checkpass = password_verify($pass, $row["finder_password"]);
        $password = $_POST['new_pass'];
        $cpassword = $_POST['confirm_pass'];
        if($checkpass == true){
            if($password == $cpassword){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $query = "UPDATE tbl_finder SET `finder_password` = '$password' WHERE finder_id = $id";
                $results = mysqli_query($conn, $query);
                if ($results) {
                    header("Location: profile.php");
                    die();
                }
                else{
                    header("Location: account.php?error=invalid");
                }
            }else{
                header( "location: account.php?error=passnotmatch");
            }
        }else{
            $_SESSION["old_input_value"] = $pass;
            $_SESSION["new_input_value"] = $password;
            $_SESSION["confirm_input_value"] = $cpassword;
            header( "location: account.php?error=incorrectpass");
        }
    }
}