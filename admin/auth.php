<?php

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "../includes/connect.php";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['finder_submit'])) {
    $finder_name = $_POST["name"];
    $finder_email = $_POST["email"];
    $password = $_POST["password"]; 
    $cpassword = $_POST["cpassword"];

    $sql = "SELECT * FROM tbl_finder WHERE finder_email = '$finder_email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if(empty($num)){
        if($password == $cpassword) {
            require "../includes/email.php";
            $email_subject = 'Confirmation Email';
            $code = uniqid();
            $email = $finder_email;
            $folder = "auth";
            $email_content = email($code,$email,$folder);
            $result = composeEmail($finder_email,$email_subject,$email_content);
            if (strpos($result, 'Mailer Error') !== false) {
                header("location: finder.php?error=smtp");
                
            } else {

                $hash = password_hash($password, PASSWORD_DEFAULT);
                    
                // Password Hashing is used here. 
                $sql = "INSERT INTO `tbl_finder` ( `finder_name`, 
                    `finder_email`, `finder_password`, `unicode`) VALUES ('$finder_name','$finder_email','$hash', '$code')";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    header("location: finder.php?finder=success");
                }
            }
        }
    }else{
        header("location: finder.php?errorfinder=exist");
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['admin_submit'])) {
    $finder_name = $_POST["name"];
    $finder_email = $_POST["email"];
    $password = $_POST["password"]; 
    $cpassword = $_POST["cpassword"];

    $sql = "SELECT * FROM `admin` WHERE email = '$finder_email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if(empty($num)){
        if($password == $cpassword) {
            require "../includes/email.php";
            $email_subject = 'Confirmation Email';
            $code = uniqid();
            $email = $finder_email;
            $folder = "admin";
            $email_content = email($code,$email,$folder);
            $result = composeEmail($finder_email,$email_subject,$email_content);
            if (strpos($result, 'Mailer Error') !== false) {
                header("location: index.php?error=smtp");
                
            } else {

                $hash = password_hash($password, PASSWORD_DEFAULT);
                    
                // Password Hashing is used here. 
                $sql = "INSERT INTO `admin` ( `user`, 
                    `email`, `password`, `code`) VALUES ('$finder_name','$finder_email','$hash', '$code')";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    header("location: index.php?admin=success");
                }
            }
        }
    }else{
        header("location: index.php?erroradmin=exist");
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['provider_submit'])) {
    $prov_fname = $_POST["fname"];
    $prov_lname = $_POST["lname"];
    $prov_email = $_POST["email"];
    $password = $_POST["password"]; 
    $cpassword = $_POST["cpassword"];
    $catArray = $_POST["category"];
    $category = implode(',',$catArray);      
    
    $sql = "SELECT * FROM tbl_provider WHERE prov_email='$prov_email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result); 
    require "../includes/email.php";
    if($num == 0) {
        if($password == $cpassword) {
            if(empty($catArray)){
                header("location: provider.php?error=catempty");
            }else{
                $email_subject = 'Confirmation Email';
                $code = uniqid();
                $email = $prov_email;
                $folder = "main";
                $email_content = email($code,$email,$folder);
                $result = composeEmail($email,$email_subject,$email_content);
                if (strpos($result, 'Mailer Error') !== false) {
                    header("location: provider.php?error=smtp");
                } else {

                    $hash = password_hash($password, PASSWORD_DEFAULT);
                        
                    // Password Hashing is used here.
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO `tbl_provider`(`prov_firstname`, `prov_lastname`, `prov_category`, `prov_password`, `prov_email`,`code`) 
                    VALUES ('$prov_fname','$prov_lname','$category','$hash','$prov_email','$code')";
                    $results = mysqli_query($conn, $sql);

                    if ($results) {
                        header("location: provider.php?provider=success");
                    }else{
                        header("location: provider.php?error=invalid");
                    }
                }
            }
        }else { 
            header("location: provider.php?error=passnnotmatch"); 
        }      
    }else{
        header("location: provider.php?error=userexists");
    }
}

header("location: index.php");