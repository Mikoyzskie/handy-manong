<?php

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $user = $_POST['user'];
    $pass = $_POST['password'];

    require_once "../includes/connect.php";

    $sql = "SELECT * FROM `admin` WHERE email = '$user'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result); 

    if($num == 0) {
        header("location: login.php?error=nouser");
    }else{
        
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        if($row['email'] == 'admin@admin.com'){
            if($row['password'] == $pass){
                $checkpass = true;
            }else{
                $checkpass = false;
            }
        }else{
            $checkpass = password_verify($pass, $row["password"]);
        }

        if($checkpass == true){
            session_start();
            $_SESSION["id"] = $row['id'];
            $_SESSION["user"]= $row['user'];
            $_SESSION["email"] = $row['email'];
            header("location: index.php");
            
        }else{
            header("location: login.php?error=incorrectpass");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
    <style>
        body{
            background-image: url(assets/img/profile_prov.jpg);
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }
        div.overlay{
            background-color: rgba(0, 0, 0, 0.7);
        }
    </style>
        <div id="layoutAuthentication" class="overlay">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <style>
                                    .transparent{
                                        background-color: rgba(255,255,255,0.6);
                                    }
                                </style>
                                <div class="card shadow-lg border-0 rounded-lg mt-5 transparent">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form action="login.php" method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" name="user" placeholder="name@example.com" />
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                           
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small text-dark" href="password.html">Forgot Password?</a>
                                                <button name="submit" type="submit" class="btn btn-primary">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
