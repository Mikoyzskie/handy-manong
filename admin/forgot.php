<?php
session_start();

if(!empty($_GET['email']) && $_GET['email']=='sent'){
  $showAlert = 'Email Sent';
}else if(!empty($_GET['password']) && $_GET['password']=='reset'){
  $showAlert = 'Password Changed';
}else{
  $showAlert = false;
}


$showError = false; 
if(isset($_POST['pass'])){
    include "../includes/connect.php";
    $email = $_POST["email"];
    $sql = "SELECT * FROM `admin` WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result); 

    if($num == 0){
        header("location: login.php?error=nouser");
    }else{
        include "../includes/email.php";
        $email_subject = 'Reset Password';
        $code = uniqid();
        $folder = 'admin';
        $email_content = forgot($code,$email,$folder);
        $finder_email = $email;
        $result = composeEmail($finder_email,$email_subject,$email_content);
          if (strpos($result, 'Mailer Error') !== false) {
            header("location: forgot.php?error=smtp");
          } else {
          include "../includes/connect.php";
          $query = "UPDATE `admin` SET `forgot_unicode` = '$code' WHERE email = '$email'";
          $results = mysqli_query($conn, $query);
          if($results){
            header("location: forgot.php?email=sent");
          }
        }
        
    }
}

if(isset($_POST['reset'])){
  $email = $_POST['email'];
  $passCode = $_POST['code'];
  
  include "../includes/connect.php";
  $sql = "SELECT * FROM `admin` WHERE email='$email' AND forgot_unicode = '$passCode'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result); 

    if($num == 0){
      header("location: forgot.php?error=nouser");
    }else{
      $password = $_POST['password'];
      $cpassword = $_POST['cpassword'];

      if($password == $cpassword){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE `admin` SET `forgot_unicode` = null,password = '$hash' WHERE email = '$email'";
        $results = mysqli_query($conn, $query);
          if($result){
            header("location: forgot.php?password=reset");
          }
      }else{
        $showError = "Password does not match.";
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
        <title>Password Reset - Handy Manong</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="icon" type="image/x-icon" href="../assets/images/hard-hat.png" />
    </head>
    <style>
        body{
            background-image: url(assets/img/forgot.jpg);
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }
        div.overlay{
            background-color: rgba(0, 0, 0, 0.7);
        }
    </style>
    <body>
    <style>
        div.alert{
            position: absolute!important;
            top: 20px!important;
            right: 20px!important;
            z-index: 2000!important;
        }
        div.alert.close{
            display:none;
        }
        div.alert-success.close{
            display:none;
        }
        button.close-danger{
            border: 2px solid #8C2F25;
            color: #8C2F25;
            background: transparent;
            margin-left: 40px;
            border-radius: 5px;
        }
        button.close-success{
            border: 2px solid #3E7423;
            color: #3E7423;
            background: transparent;
            margin-left: 40px;
            border-radius: 5px;
        }
    </style>
  <?php
    
    if($showAlert) {
    
        echo ' <div class="alert alert-success 
            alert-dismissible fade show" role="alert">
    
            <strong>Success!</strong> '.$showAlert.'
            <button type="button" onclick = "closeAlert();" class="close-success">
            x
        </button> 
        </div> '; 
    }
    
    if($showError) {
    
        echo ' <div class="alert alert-danger 
            alert-dismissible fade show" role="alert"> 
        <strong>Error!</strong> '. $showError.'
    
       <button type="button" class="close-danger">
            x
        </button>
     </div> '; 
   }
   
  ?>
        <div id="layoutAuthentication" class="overlay">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Password Recovery</h3></div>
                                    <div class="card-body">
                                        <div class="small mb-3 text-muted">Enter your email address and we will send you a link to reset your password.</div>
                                        <?php if(empty($_GET['action'])):?>
                                        <form role="form" method="post" action="password.php">
                                        <!-- <label>Name</label>
                                        <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Enter your name" aria-label="Name" aria-describedby="name-addon">
                                        </div> -->
                                        <label>Email Address</label>
                                        <div class="mb-3">
                                        <input type="email" class="form-control" placeholder="Enter your email address" aria-label="Email" aria-describedby="email-addon" name="email" required autocomplete="off"/>
                                        </div>
                                    
                                        <div class="d-flex align-items-center">
                                        <a href="login.php" class="text-xs font-weight-bold ms-auto">Sign In Instead</a>
                                        </div>
                                        <div class="text-center">
                                        <button type="submit" class="btn btn-dark w-100 mt-4 mb-3" name="pass">Submit</button>
                                        
                                        </div>
                                    </form>
                                    <?php endif;?>
                                    <?php if(!empty($_GET['action'] ) && $_GET['action'] == 'reset'):?>
                                        <form role="form" method="post" action="forgot.php">
                                        <!-- <label>Name</label>
                                        <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Enter your name" aria-label="Name" aria-describedby="name-addon">
                                        </div> -->
                                        
                                        <input type="hidden" name="email" value = "<?php echo $_GET['email']?>">
                                        <input type="hidden" name="code" value = "<?php echo $_GET['unicode']?>">
                                        <label>New Password</label>
                                        <div class="mb-3">
                                        <input type="password" class="form-control" placeholder="Enter new password" aria-label="Email" aria-describedby="email-addon" name="password" required autocomplete="off"/>
                                        </div>
                                        <label>Confirm Password</label>
                                        <div class="mb-3">
                                        <input type="password" class="form-control" placeholder="Confirm Password" aria-label="Email" aria-describedby="email-addon" name="cpassword" required autocomplete="off"/>
                                        </div>
                                    
                                        <div class="d-flex align-items-center">
                                        <a href="login.php" class="text-xs font-weight-bold ms-auto">Sign In Instead?</a>
                                        </div>
                                        <div class="text-center">
                                        <button type="submit" class="btn btn-dark w-100 mt-4 mb-3" name="reset">Reset</button>
                                        
                                        </div>
                                    </form>
                                    <?php endif;?>
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
        <script>
            const button = document.querySelector('.close-danger');
            button.addEventListener('click', closeAlert, false);

            const close = document.querySelector('.close-success');
            close.addEventListener('click', closeAlert, false)
            
            function closeAlert(){
                const closeDanger = document.querySelector('.alert');
                closeDanger.classList.add('close');
            }
            
            
        </script>
    </body>
</html>
