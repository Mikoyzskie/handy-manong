<?php

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['finder_submit'])) {
      
    // Include file which makes the
    // Database Connection.
    include '../includes/connect.php';   
    
    $finder_name = $_POST["name"];
    $finder_email = $_POST["email"];
    $password = $_POST["password"]; 
    $cpassword = $_POST["cpassword"];
    
    $sql = "SELECT * FROM tbl_finder WHERE finder_email='$finder_email'";
    
    $result = mysqli_query($conn, $sql);
    
    $num = mysqli_num_rows($result); 
    
    // This sql query is use to check if
    // the username is already present 
    // or not in our Database
    if($num == 0) {
        if($password == $cpassword) {

            include '../includes/email.php';
            $email_subject = 'Confirmation Email';
            $code = uniqid();
            $email = $finder_email;
            $folder = "auth";
            $email_content = email($code,$email,$folder);
            $result = composeEmail($finder_email,$email_subject,$email_content);
            if (strpos($result, 'Mailer Error') !== false) {
                $showError = $result;
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
        else { 
            header("location: finder.php?errorfinder=passwordnotmatch"); 
        }      
    }else{
        header("location: finder.php?errorfinder=exist"); 
    }  
}else{
    header("location: index.php?error=invalid");
}