<?php

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['avatarSubmit'])) {
    include "../includes/connect.php";
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