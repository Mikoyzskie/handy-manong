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
                $query = "UPDATE tbl_finder SET `finder_password` = '$hash' WHERE finder_id = $id";
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

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email_submit'])){
    include '../includes/email.php';
    $email_subject = 'Update Email';
    $code = uniqid();
    $email = $_POST["email"];
    if($email == $_SESSION['email']){
        header("location: account.php?status=emailduplicate");
    }else{
        $query = "SELECT * FROM tbl_finder WHERE finder_email = '$email' OR update_email = '$email'";
        $result = mysqli_query($conn, $query);
        $num = mysqli_num_rows($result);
        if($num > 0){
            header("location: account.php?status=emailpresent");
        }else{
            $email_content = updateEmail($code,$email);
            $result = composeEmail($email,$email_subject,$email_content);
            if (strpos($result, 'Mailer Error') !== false) {
                header("location: account.php?mailer=error");
            } else { 
                $old_email = $_SESSION['email'];  
                $query = "UPDATE tbl_finder SET `update_code` = '$code',`update_email` = '$email' WHERE finder_email = '$old_email'";
        
                $result = mysqli_query($conn, $query);
        
                if ($result) {
                    header("location: account.php?status=success");
                }else{
                    header("location: account.php?status=invalid");
                }
            }
        }
    }
}

if(!empty($_GET['unicode']) || !empty($_GET['userid'])){
    $email = $_GET['userid'];
    $code = $_GET['unicode'];

    $query = "UPDATE tbl_finder SET `update_code` = NULL,`update_email` = NULL,finder_email = '$email'  WHERE update_code = '$code' AND update_email = '$email'";
        
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("location: account.php?status=success");
    }else{
        header("location: account.php?status=invalid");
    }
}