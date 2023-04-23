<?php
include "../includes/connect.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['avatarSubmit'])) {
    
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM `admin` WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if(empty($num)){
        header( "location: settings.php?error=invalid");
    }else{
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $filename = "../assets/images/uploads/".$row['avatar'];
        if (file_exists($filename)) {
            unlink($filename);
        }
        if ($_FILES["Image"]["error"] == UPLOAD_ERR_OK) {

            $target_dir = "../assets/images/uploads/";

            $newimage = $_FILES["file"]["name"];
            $new_avatar = basename($_FILES["image"]["name"]);
            $extension = pathinfo($new_avatar,PATHINFO_EXTENSION);
            $rename = 'upload'.date('Ymd').uniqid();

            $target_file = $target_dir . $rename.'.'. $extension;
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            
            $new_name = $rename.'.'.$extension;

            $query = "UPDATE `admin` SET `avatar` = '$new_name' WHERE id = $id";
            $results = mysqli_query($conn, $query);
            if ($results) {
                header("Location: admin.php?test=$extension");
                die();
            }
            else{
                header("Location: admin.php?error=invalid");
            }
        } else {
            header( "location: admin.php?error=invalid");
        }
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name_submit'])) {
    $id = $_SESSION["id"];
    $sql = "SELECT * FROM `admin` WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if(empty($num)){
        header( "location: admin.php?error=invalid");
    }else{
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if($_POST['name'] == $row['user']){
            header( "location: account.php");
        }else{
            $new_name = $_POST['name'];
            $query = "UPDATE `admin` SET `user` = '$new_name' WHERE id = $id";
            $results = mysqli_query($conn, $query);
            if ($results) {
                header("Location: admin.php");
                die();
            }
            else{
                header("Location: admin.php?error=invalid");
            }
        }
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['password_submit'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM `admin` WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if(empty($num)){
        header( "location: admin.php?error=invalid");
    }else{
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $pass = $_POST['old_pass'];
        $checkpass = password_verify($pass, $row["finder_password"]);
        $password = $_POST['new_pass'];
        $cpassword = $_POST['confirm_pass'];
        if($checkpass == true){
            if($password == $cpassword){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $query = "UPDATE `admin` SET `password` = '$hash' WHERE id = $id";
                $results = mysqli_query($conn, $query);
                if ($results) {
                    header("Location: admin.php?admin=success");
                    die();
                }
                else{
                    header("Location: admin.php?error=invalid");
                }
            }else{
                header( "location: admin.php?error=passnotmatch");
            }
        }else{
            $_SESSION["old_input_value"] = $pass;
            $_SESSION["new_input_value"] = $password;
            $_SESSION["confirm_input_value"] = $cpassword;
            header( "location: settings.php?error=incorrectpass");
        }
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email_submit'])){
    include '../includes/email.php';
    $email_subject = 'Update Email';
    $code = uniqid();
    $email = $_POST["email"];
    $folder = "admin";
    if($email == $_SESSION['email']){
        header("location: settings.php?status=emailduplicate");
    }else{
        $query = "SELECT * FROM `admin` WHERE email = '$email' OR update_email = '$email'";
        $result = mysqli_query($conn, $query);
        $num = mysqli_num_rows($result);
        if($num > 0){
            header("location: settings.php?status=emailpresent");
        }else{
            $email_content = updateEmail($code,$email,$folder);
            $result = composeEmail($email,$email_subject,$email_content);
            if (strpos($result, 'Mailer Error') !== false) {
                header("location: account.php?mailer=error");
            } else { 
                $old_email = $_SESSION['email'];  
                $query = "UPDATE `admin` SET `code` = '$code',`update_email` = '$email' WHERE email = '$old_email'";
        
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

if(!empty($_GET['action'])){
    if($_GET['action'] == 'delete'){
        if(!empty($_GET['id'])){
            $id = $_GET['id'];
        }else{
            header("location:index.php?error=invalid");
        }
        
        if(!empty($_GET['user']) && $_GET['user']=='finder'){
            $sql = "DELETE FROM `tbl_finder` WHERE `finder_id` = $id";
            
        }elseif(!empty($_GET['user']) && $_GET['user']=='provider'){
            $sql = "DELETE FROM `tbl_provider` WHERE `id` = $id";
        }else{
            header("location:index.php?error=invalid");
        }

        $result = mysqli_query($conn, $sql);

        if($result){
            header("location:index.php?delete=success");
        }else{
            header("location:index.php?error=invalid");
        }
    }elseif($_GET['action'] == 'verify'){
        if(!empty($_GET['id'])){
            $id = $_GET['id'];
        }else{
            header("location:index.php?error=invalid");
        }
        if(!empty($_GET['user']) && $_GET['user']=='finder'){
            $sql = "UPDATE `tbl_finder` SET `unicode` = 'verified' WHERE `finder_id` = $id";
        }elseif(!empty($_GET['user']) && $_GET['user']=='provider'){
            $sql = "UPDATE `tbl_provider` SET `code` = 'verified' WHERE `id` = $id";
        }else{
            header("location:index.php?error=invalid");
        }

        $result = mysqli_query($conn, $sql);

        if($result){
            header("location:index.php?verify=success");
        }else{
            header("location:index.php?error=invalid");
        }
    }elseif($_GET['action'] == 'taskdelete'){
        if(!empty($_GET['id'])){
            $id = $_GET['id'];
            $sql = "DELETE FROM `tbl_task` WHERE `id` = $id";
            $result = mysqli_query($conn, $sql);

            if($result){
                header("location:index.php?delete=success");
            }else{
                header("location:index.php?error=invalid");
            }
        }else{
            header("location:index.php?error=invalid");
        }
    }
}else{
    header("location:index.php?error=invalid");
}